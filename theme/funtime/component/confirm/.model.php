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

$registry['step']=1;
if($_GET['value']==2)$registry['step']=2;
if($_POST['confirm']==1):
	if(email_check($_POST['email'])):
		$email=htmlspecialchars(strip_tags($_POST['email']));
		$check = $DB->getAll(' 	SELECT `#__users`.*
			FROM `#__users`
			WHERE `#__users`.`email`=\''.$email.'\' LIMIT 1');

		if(count($check)>0):

			$code=rand(1000000,9999999).'JHYTT'.rand(1000000,9999999);
			$m= new Mail; // начинаем
			$m->From($registry['emailsup']); // от кого отправляется почта
			$m->To($check[0]['email']); // кому адресованно
			$m->text_html="text/html";
			$m->Subject( "Запрос сброса пароля на сайте ".$_SERVER['HTTP_HOST']);


			$m->Body( "
Здравствуйте,<br/>
Это письмо отправлено вам сайтом: <a href=\"".$_SERVER['HTTP_HOST']."\">".$_SERVER['HTTP_HOST']."</a><br/>
Администрацией сайта была получена заявка на восстановление вашего пароля. 
Для восстановления пароля вам требуется ввести код подтверждения, указанный ниже, 
в поле специальной формы на нашем сайте.<br/>
Код подтверждения: $code<br/>
Для ввода кода подтверждения перейдите по ссылке:<br/>
<a href=\"http://".$_SERVER['HTTP_HOST']."/com/confirm/default/2\">http://".$_SERVER['HTTP_HOST']."/com/confirm/default/2</a><br/>
Спасибо." );    
			$m->Priority(3) ;    // приоритет письма
			$m->Send();    // а теперь пошла отправка
			$registry['step']=2;
		$DB->execute("INSERT INTO `#__confirm` (`user_id` ,`code`) VALUES ('".$check[0]['id']."', '$code');");
		else:
			$registry['step']=5;
			$err='Пользователя с указанным вами email не существует...';
		endif;
	endif;
endif;
if($_POST['checkcode']==1):
	if(!empty($_POST['code'])):
		$registry['code']=htmlspecialchars(strip_tags($_POST['code']));
		$check = $DB->getAll('SELECT `#__confirm`.`user_id` 
			FROM `#__confirm`
			WHERE `#__confirm`.`code`=\''.$registry['code'].'\' LIMIT 1');

		if(count($check)>0):
			$registry['step']=3;
		else:
			$registry['step']=5;
			$err='Указанный вами код не верен...';
		endif;
	endif;
endif;
if($_POST['newpass']==1):
	if(!empty($_POST['code']) and !empty($_POST['pass'])):
		$registry['code']=htmlspecialchars(strip_tags($_POST['code']));
		$check = $DB->getAll('SELECT `#__confirm`.`user_id` 
			FROM `#__confirm`
			WHERE `#__confirm`.`code`=\''.$registry['code'].'\' LIMIT 1');

		if(count($check)>0):
			$password=htmlspecialchars(strip_tags($_POST['pass']));
	
			$salt=generate_password(7);

			$password=sha1($salt.sha1($password));

			$sql="UPDATE `#__users` SET `password` = '$password', `salt`='$salt' WHERE `#__users`.`id` =".$check[0]['user_id'];
			$DB->execute($sql);
			$DB->execute("DELETE FROM `#__confirm` WHERE `#__confirm`.`user_id` =".$check[0]['user_id']);
			$registry['step']=4;
		else:
			$registry['step']=5;
			$message[1]='Ошибка восстановления прав доступа...';
		endif;
	endif;
endif;
