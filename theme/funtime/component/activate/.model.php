<?php

defined('_JEXEC') or die('Restricted access');


$all = $DB->getAll('SELECT * FROM #__activate WHERE user_id='.intval($_GET['id']));

	if (count($all)>0):
	foreach($all as $num):
		if ($_GET['code']==$num['code']):
		  $phone=$DB->getOne("SELECT `#__users`.`phone` FROM `#__users` WHERE `#__users`.`id` =".intval($_GET['id'])." LIMIT 1 ;");
		  if(!empty($phone)) $group=5; else $group=3;
		  $DB->execute("UPDATE `#__users` SET `group_id` = '$group' WHERE `#__users`.`id` =".intval($_GET['id'])." LIMIT 1 ;");
                  $DB->execute("DELETE FROM `#__activate` WHERE `#__activate`.`user_id` = ".intval($_GET['id'])." LIMIT 1");
		  $message[0]='valid';
		  $message[1]='Ваша учетная запись активированна.<br/>Теперь вы можете <a href="/com/login/">войти</a> на сайт под своим логином.';
		else:
		  $message[0]='error';
		  $message[1]='Код активации указан не верно.';
		endif;
	endforeach;
	else: $message[0]='warning';$message[1]='Вы пытаетесь активировать уже активированную учетную запись.'; endif;