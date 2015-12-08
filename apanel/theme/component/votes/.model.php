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

if(get_access('admin','vote','del',false)):
	if (!empty($_GET['delete']))
		{
		$sql="DELETE FROM `#__vote` WHERE `#__vote`.`id` = ".intval($_GET['delete'])." LIMIT 1";
		$DB->execute($sql);
		$sql="DELETE FROM `#__vote` WHERE `#__vote`.`type` = ".intval($_GET['delete']);
		$DB->execute($sql);
		header('Location: ?component=votes');
		}
endif;
	if (!empty($_GET['activ']))
		{
		$DB->execute("UPDATE `#__vote` SET `select` = '0';");
		$sql="UPDATE `#__vote` SET `select` = '1' WHERE `id`='".intval($_GET['activ'])."' LIMIT 1; ";
		$DB->execute($sql);
		header('Location: ?component=votes');
		}

if(get_access('admin','vote','edit',false)):
	if ($_POST['update']==1) {
	if ($err==0) {
		for($i=1;$i<=10;$i++)
			{
			$sql="UPDATE `#__vote` SET `name` = '".htmlspecialchars(strip_tags($_POST['vote'.$i]))."' 
				WHERE `id`='".intval($_POST['id'.$i])."' LIMIT 1; ";
			$DB->execute($sql);
			}
		$sql="UPDATE `#__vote` SET `name` = '".htmlspecialchars(strip_tags($_POST['name']))."' 
			WHERE `id`='".intval($_POST['id'])."' LIMIT 1; ";
		$DB->execute($sql);
		$message[0]='valid';
		$message[1]='Данные опроса успешно обновлены';
	   }
	}


	if ($_POST['add']==1) {
		$cookie='vote'.rand(10000,99999999);
		$DB->execute("UPDATE `#__vote` SET `select` = '0';");
		$sql="INSERT INTO `#__vote` (`type`,`name`,`select`,`cookie`)
			VALUES ('0', '".htmlspecialchars(strip_tags($_POST['name']))."','1','$cookie');";
		$DB->execute($sql);
		$lastID=$DB->getOne('SELECT LAST_INSERT_ID();');
		for($i=1;$i<=10;$i++)
			{
			$sql="INSERT INTO `#__vote` (`type`,`idvote`,`name`)
			VALUES ('$lastID', '$i','".htmlspecialchars(strip_tags($_POST['vote'.$i]))."');";
			$DB->execute($sql);
			}
		$message[0]='valid';
		$message[1]='Опрос успешно добавлен и активирован';
	}
endif;
if(get_access('admin','vote','view',false)):
	if(empty($_GET['section']))
		{
		$all = $DB->getAll('SELECT * FROM #__vote WHERE type=0 ORDER BY id ASC');
		}
endif;
if(get_access('admin','vote','edit',false)):
	if($_GET['section']=='edit')
		{
		$id=intval($_GET['edit']);
		$title = $DB->getAll('SELECT * FROM #__vote WHERE id='.$id);
		$all = $DB->getAll('SELECT * FROM #__vote WHERE type='.$id.' ORDER BY id ASC');
		}
endif;