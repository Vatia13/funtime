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

if ($user->is_active() and $user->get_property('gid')==25) {

	if ($_POST['event']=='add')
		{
		$type=PHP_slashes(htmlspecialchars($_POST['type']));
		$numm=intval($_POST['num']);
		$typet='';
		if($type==1)$typet='input';
		if($type==2)$typet='textarea';
		if($type==3)
			{
			$typet='select';
			foreach((array)$_POST['vall'] as $val):
				if (!empty($val)) $typet.='|'.htmlspecialchars($val);
			endforeach;
			}
		if($numm==0)$numm=$DB->getOne("SELECT `num` FROM `#__profile` ORDER BY `num` DESC")+1;
		$DB->execute("INSERT INTO `#__profile` (`desc` ,`type`,`num`) 
					VALUES ('".PHP_slashes(htmlspecialchars($_POST['desc']))."','$typet','".$numm."');");
		$massage='Новое поле успешно добавлено ';
		}

	if (!empty($_GET['delete']))
		{
		$DB->execute("DELETE FROM `#__profile` WHERE `#__profile`.`id` =".intval($_GET['delete']));
		$message='Запись удалена';
		header("Location: ?component=profile");
		}
	if (!empty($_GET['edit']))
		{
		$anket=$DB->getAll("SELECT * FROM #__profile WHERE id=".intval($_GET['edit']));
		}
	if ($_POST['event']=='update' and intval($_POST['id'])>0)
		{
		//$registry->set('error','Запись успешно обновлена');
		$DB->execute("UPDATE `#__profile` SET `desc` = '".PHP_slashes(htmlspecialchars($_POST['desc']))."', 
						   `num` = '".intval($_POST['num'])."'
					WHERE `#__profile`.`id` = '".intval($_POST['id'])."' LIMIT 1 ;");
		header("Location: ?component=profile");
		}

	if (empty($_GET['edit'])):
	$profile=$DB->getAll("SELECT * FROM #__profile ORDER BY num ASC");

	$count=0;
	foreach ($profile as $val)
		{
		$count++;
		$type=explode('|',$val['type']);

		if ($type[0]=='input') $form[]='<input type="text" name="profile['.$val['id'].']" value="'.$value.'" />';
		if ($type[0]=='textarea') $form[]=' <script type="text/javascript">
				  WYSIWYG.attach(\''.$count.'textar\', prof); // default setup
				  </script><textarea id="'.$count.'textar" name="profile['.$val['id'].']">'.$value.'</textarea>';
		if ($type[0]=='select') 
			{
			$select='<select name="profile['.$val['id'].']">';
			$i=0;
			foreach ($type as $t)
				{
				if($i==0):$i++;continue;endif;
				$i++;
				if($t==$value) $sel='selected'; else $sel=''; 
				$select.='<option value="'.$t.'" '.$sel.'>'.$t.'</option>';
				}
			$select.='</select>';
				$form[]=$select;
			}
		$name[]=$val['desc'];
		$num[]=$val['num'];
		$idd[]=$val['id'];
		}
	endif;
}
