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

$all = $DB->getAll('SELECT * FROM #__activate WHERE user_id='.intval($_GET['id']));

if (count($all)>0): foreach($all as $num)
	{
	if ($_GET['code']==$num['code']) 
		{
		$DB->execute("UPDATE `#__users` SET `active` = '1' WHERE `#__users`.`userID` =".intval($_GET['id']." LIMIT 1 ;"));
		$DB->execute("DELETE FROM `#__activate` WHERE `#__activate`.`user_id` = ".intval($_GET['id'])." LIMIT 1");
		echo 'Ваша учетная запись активированна. Теперь вы можете зайти на сайт под своим логином.';
		} else echo 'Код активации указан не верно.';
	} else: echo 'Вы пытаетесь активировать уже активированную учетную запись.'; endif;
