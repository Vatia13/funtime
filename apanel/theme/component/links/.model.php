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

if ($user->get_property('userID')==1 OR $user->get_property('gid')==25):
	if (!empty($_GET['delete']))
		{
		$del = $DB->getAll("SELECT `#__links`.* FROM `#__links` WHERE `#__links`.`id` = ".intval($_GET['delete'])." LIMIT 1");
		if(!empty($del[0]['photo']))@unlink($del[0]['photo']);
		$sql="DELETE FROM `#__links` WHERE `#__links`.`id` = ".intval($_GET['delete'])." LIMIT 1";
		$DB->execute($sql);
		header('Location: ?component=links');

		}

	if ($_POST['add']==1 or $_POST['update']==1) {

		$id=intval($_POST['id']);
		$block=intval($_POST['block']);
		$linktype=intval($_POST['linktype']);
		$show=intval($_POST['show']);

		if($linktype==1):
			$ankor=PHP_slashes(htmlspecialchars(strip_tags($_POST['ankor'])));
		endif;

		if($linktype==1 OR $linktype==2):
			$url=PHP_slashes(htmlspecialchars(strip_tags($_POST['url'])));
			$noindex=intval($_POST['noindex']);
			$nofollow=intval($_POST['nofollow']);
		endif;

		if($linktype==3):
			$ankor=PHP_slashes($_POST['html']);
		endif;

		if($linktype==2):
			if($_FILES["photo"]["size"]>0):
			$imgpath=save_image_on_server($_FILES["photo"],'../img/uploads/banner/',$registry['img']);
			if(!empty($imgpath[1]))
				{
				$path=$imgpath[1];//str_replace('../','',$imgpath[1]).'|';
				if($_POST['update']==1) $SQL_PHOTO=" `photo` = '$path', ";
				if($_POST['add']==1) $SQL_PHOTO=$path;

				}
			endif;
		endif;
		if($_POST['update']==1) 
			$sql="UPDATE `#__links`	SET 
			`url` = '$url', 
			`ankor` = '$ankor', 
			`noindex` = '$noindex', 
			`nofollow` = '$nofollow', 
			$SQL_PHOTO 
			`show` = '$show',
			`block`='$block'
			WHERE `id`='$id' 
			LIMIT 1; ";

		if($_POST['add']==1)
			$sql="	INSERT INTO `#__links` (`url`,`ankor`,`noindex`,`nofollow`,`type`,`photo`,`show`,`block`) 
			VALUES ('$url','$ankor','$noindex','$nofollow','$linktype','$SQL_PHOTO','$show','$block');";
		$DB->execute($sql);
	}

	$all = $DB->getAll('SELECT * FROM #__links ORDER BY id DESC');
endif;
