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

if(get_access('admin','tools','view',false)):
$i=0;

if ($_POST['mail']==1 or $_POST['mail']==3) {
	$subject=strip_tags($_POST['subject']);
	$emailsup = $DB->getOne("SELECT `#__setting`.`value` FROM `#__setting` WHERE `#__setting`.`name`='emailsup'");
	$sql='SELECT `#__users`.`password`,`#__users`.`userID`,`#__users`.`email` FROM `#__users` WHERE `#__users`.`alertmail`=1';
	$mailarr=$DB->getAll($sql);
        $i=0;
	foreach($mailarr as $mail)
	{
	$endsub='<p><a href="http://'.$_SERVER['HTTP_HOST'].'/com/mail/del/'.$mail['userID'].'/'.$mail['password'].'">Отписаться от рассылки.</p>';

	if(email_check($mail['email'])):
	$m= new Mail; // начинаем
	$m->From($emailsup); // от кого отправляется почта
	$m->To( $mail['email'] ); // кому адресованно
	$m->Subject($subject);
	$m->Body($_POST['text'].$endsub);
	$m->Priority(3) ;    // приоритет письма
	$m->Send();    // а теперь пошла отправка
	$i++;
	endif;
	}
	echo '<p>Рыссылка успешно завершена. Разослано '.$i.' пользователям на email</p>';
	}
if ($_POST['mail']==4) {
	$subject=$_POST['subject'];
	$emailsup = $DB->getOne('SELECT `#__setting`.`value` 
	FROM `#__setting`
	WHERE `#__setting`.`name`=\'emailsup\'');

        $i=0;
	$mailarr=explode('
',$_POST['sbeml']);

	foreach($mailarr as $mail)
	{
	$m= new Mail; // начинаем
	$m->From($emailsup); // от кого отправляется почта
	$m->To( $mail ); // кому адресованно
	$m->Subject($subject);
	$m->Body($_POST['text']);
	$m->Priority(3) ;    // приоритет письма
	$m->Send();    // а теперь пошла отправка
	$i++;
	}
	echo '<p>Рыссылка успешно завершена. Разослано '.$i.' пользователям на email</p>';
	}
endif;
