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

if(get_access('admin','tools','edit',false)) {

	if(isset($_POST['add']) or isset($_POST['edit']))
		{
		$message=array();
		$name = PHP_slashes(strip_tags($_POST['name']));
		$comand = PHP_slashes(strip_tags($_POST['comand']));
		$item = $_POST['item'];
		$id = intval($_POST['id']);
		if(empty($name)): $message[0]='error';$message[1]="Укажите \"Название меню\"";endif;
		if(empty($comand)): $message[0]='error';$message[1]="Укажите \"Команду вызова\"";endif;

		if(empty($message[0]))
			{
			if(isset($_POST['add'])) {
				$sql="SELECT * FROM #__menu WHERE `comand` LIKE '$comand%' ORDER BY id DESC LIMIT 1";
				$test=$DB->getAll($sql);
				if(count($test)>0)$comand=$comand.($test[0]['id']+1);

				$sql="INSERT INTO #__menu (`name`,`comand`) VALUE ('$name','$comand')";
				$DB->execute($sql);
				$lastid=$DB->id;
				}

			if(isset($_POST['edit'])) {
				$sql="SELECT * FROM #__menu WHERE `id`<>'$id' and `comand` LIKE '$comand%' ORDER BY id DESC LIMIT 1";
				$test=$DB->getAll($sql);
				if(count($test)>0)$comand=$comand.($test[0]['id']+1);

				$sql="UPDATE #__menu SET `name`='$name',`comand`='$comand' WHERE `id`='$id' LIMIT 1";
				$DB->execute($sql);
				$lastid=$id;
			}

			foreach($item as $it):
				$it['ankor']=PHP_slashes(strip_tags($it['ankor']));
				$it['url']=PHP_slashes(strip_tags($it['url']));
				$it['pos']=intval($it['pos']);
				$it['id']=intval($it['id']);
				if($it['id']>0) 
				$sql="UPDATE #__menu_link SET 
					`ankor`='{$it['ankor']}',
					`url`='{$it['url']}',
					`pos`='{$it['pos']}'
					 WHERE `id`='{$it['id']}' and `menuid`='$lastid' LIMIT 1";
				else 
				$sql="INSERT INTO #__menu_link (`menuid`,`ankor`,`url`,`pos`) 
					VALUE ('$lastid','{$it['ankor']}','{$it['url']}','{$it['pos']}')";

				$DB->execute($sql);
			endforeach;
			$message[0]='valid';$message[1]="Новое меню успешно добавлено";
			}
		}

}

if(get_access('admin','tools','del',false)) {
	if(isset($_GET['delete']))
		{
	        $id=intval($_GET['delete']);
	 	$sql="DELETE FROM #__menu WHERE id = '$id' LIMIT 1";
		$DB->execute($sql);
	 	$sql="DELETE FROM #__menu_link WHERE menuid = '$id'";
		$DB->execute($sql);
		}
}

if(get_access('admin','tools','view',false)) {
 	$sql="SELECT * FROM #__menu ORDER BY id ASC";
	$registry['allmenu']=$DB->getAll($sql);
}

if(get_access('admin','tools','edit',false)) {
	if($_GET['section']=='edit')
		{
	        $id=intval($_GET['edit']);
	 	$sql="SELECT * FROM #__menu WHERE id='$id' LIMIT 1";
		$menu=$DB->getAll($sql);
		$registry['menu']=$menu[0];

	 	$sql="SELECT * FROM #__menu_link WHERE menuid='$id' ORDER BY pos ASC";
		$registry['menulink']=$DB->getAll($sql);
		}

}
