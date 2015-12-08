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

if (!empty($_POST['username']) and $err==0){
  $data = array(
	'username' => $_POST['username'],
	'family'=>$_POST['fam'],
	'name'=>$_POST['name'],
	'name_two'=>$_POST['sc'],
	'email' => $_POST['email'],
	'password' => $_POST['pwd'],
	'wm' => $_POST['wm'],
	'active' => $activated
  );
  $userID = $user->insertUser($data);
  if ($userID==0)
  	echo 'Пользователь с таким логином или email иже существует';
  else {
  	$oke=1;
	$code=rand(1000000,9999999).'JHYTT'.rand(1000000,9999999);
	$emailsup = $DB->getOne("SELECT `#__setting`.`value` FROM `#__setting` WHERE `#__setting`.`name`='emailsup'");
	$m= new Mail; // начинаем
	$m->From($emailsup); // от кого отправляется почта
	$m->To($_POST['email']); // кому адресованно
	$m->Subject( "Активация учетной записи" );
	$m->Body( "Для активации учетной записи перейдите по указанной ниже ссылке:\n\n".
		'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?component=activate&id='.$userID.'&code='.$code.
		"\n\n Логин: ".$_POST['username']."\n Пароль: ".$_POST['pwd']."" );    
	$m->Priority(3) ;    // приоритет письма
	$m->Send();    // а теперь пошла отправка

	$DB->execute("INSERT INTO `#__activate` (`user_id` ,`code`) VALUES ('$userID', '$code');");
	}
}
if ($oke==0) {
	echo '<h1>Регистрация</h1>
	<p><form method="post" action="" />
	 Никнейм: <input type="text" name="username" /><br /><br />
	 Фамилия: <input type="text" name="fam" /><br /><br />
	 Имя: <input type="text" name="name" /><br /><br />
	 Отчество: <input type="text" name="sr" /><br /><br />
	 Пароль: <input type="password" name="pwd" /><br /><br />
	 Повторить пароль: <input type="password" name="pwd2" /><br /><br />
	 Электронная почта: <input type="text" name="email" /><br /><br />
	 R-кошелек: <input type="text" name="wm" /><br /><br />
	 <input type="hidden" name="event" value="signup"/><br /><br />
	 <input type="submit" value="отправить" />
	</form>
	</p>';
	}
	else
	{
	echo 'Поздравляем! Вы успешно зарегистрировались. Для подтверждения и активации вашей учетной записи на указанный вами email было высланно письмо. Перейдите по указанной в ней ссылке.';
	}
