<?php
/**
 *
 * CMS osRealty 2.1.x
 * Autor: Roman Chernyshov
 * E-mail: support@osRealty.ru
 * URL: www.osRealty.ru
 *
 */

defined('_JEXEC') or die('Restricted access');

if ($user->get_property('userID')==0):

	if ($_POST['add']==1) {
	if ($_POST['pwd']>'' and ($_POST['pwd']==$_POST['pwd2'])) 
		{
		$login=PHP_slashes(htmlspecialchars($_POST['login']));
		$email=PHP_slashes(htmlspecialchars($_POST['email']));
		$fio=PHP_slashes(htmlspecialchars($_POST['fio']));
		$phone=PHP_slashes(htmlspecialchars($_POST['phone']));
		$group=intval($_POST['group']);
		if($group==0)$group=1;
		if($registry['user_realty']==0)$group=1;

		$all = $DB->getAll("SELECT `#__users`.`id` FROM `#__users` WHERE `username`='$login' LIMIT 1");
		$allem = $DB->getAll("SELECT `#__users`.`id` FROM `#__users` WHERE `email`='$email' LIMIT 1");
		if(!empty($login) and count($all)==0)
		  {
		  if (email_check($email) or count($allem)>0)
		    {
		    if($group==1 or ($group==2 and !empty($fio)))
			{
		    	if($group==1 or ($group==2 and !empty($phone)))
			  {
			  $salt=generate_password(7);

			  $password=$_POST['pwd'];

			  $password=sha1($salt.sha1($password));

			  $date=time();
			  //if($group==1)$group=3;//18
			  //if($group==2)$group=5;//23
			  $group=0;
			  if($registry['user_active']==0)$group=3;
			  $sql = "INSERT INTO `#__users` 
				(`id`,`group_id`,`username`,`password`,`salt`,`email`,`title`,`realname`,`icq`,`url`,`email_setting`,`show_smilies`,`show_img`,`show_img_sig`,
				`show_avatars`,`show_sig`,`language`,`style`,`registered`,`pun_bbcode_enabled`,
				`pun_bbcode_use_buttons`,`city`,`region`,`profile`,`phone`) 

				VALUES ('','$group','$login','$password','$salt','$email','','$fio','','','1','1','1','1','1','1',
				'English','Oxygen','$date','1','1','','','','$phone')";

			  $DB->execute($sql);

			  $userID=$DB->id;
			  if($registry['user_active']==1)
				{
				  $code=rand(1000000,9999999).'JHYTT'.rand(1000000,9999999);
				  $m= new Mail; // начинаем
				  $m->From($registry['emailsup']); // от кого отправляется почта
				  $m->To($email); // кому адресованно
				  $m->text_html="text/html";
				  $m->Subject( "Активация учетной записи - ".$registry['domen']);
				  $m->Body( "Для активации учетной записи перейдите по указанной ниже ссылке:<br>".
					'<a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?component=activate&id='.$userID.'&code='.$code.'">Активировать учетную запись</a>'.
					"<p> Логин: ".$login."<br> Пароль: ".$_POST['pwd']."</p>" );    
				  $m->Priority(3) ;    // приоритет письма
				  $m->Send();    // а теперь пошла отправка
		
				  $DB->execute("INSERT INTO `#__activate` (`user_id` ,`code`) VALUES ('$userID', '$code');");

				  $message[0]='valid';
				  $message[1].='
					Поздравляем! Вы успешно зарегистрировались. Для подтверждения и активации вашей 
					учетной записи на указанный вами email было высланно письмо. Перейдите по указанной в ней ссылке.
					';
				}
				else 
				{
				  $message[0]='valid';
				  $message[1].='
					Поздравляем! Вы успешно зарегистрировались. Для входа на сайт используйте свой логин и пароль.
					';
				}
			  } else {
				 $message[0]='error';
				 $message[1]="Ошибка: Вы не указали ФИО.";
				 }

			} else {
				$message[0]='error';
				$message[1]="Ошибка: Вы не указали ФИО.";
				}
		    } else {
			   $message[0]='error';
			   $message[1]="Ошибка: Неверно указан адрес эл. почты.";
			   }
	 	  } else {
			$message[0]='error';
			$message[1]="Ошибка: Вы не указали \"Логин\" или такой \"Логин\" уже используется другим пользователем.";
			}
		}
		else {
			$message[0]='error';
			$message[1]="Ошибка: Пароли не совпадают.";
			}
		}
endif;
