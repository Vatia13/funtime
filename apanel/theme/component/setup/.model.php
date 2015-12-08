<?php
/**
 *
 * CMS It-Solutions 0.1
 * Author: Vati Child
 * E-mail: vatia0@gmail.com
 * URL: www.it-solutions.ge
 *
 */

defined('_JEXEC') or die('Restricted access');

if ($user->get_property('userID')>0):
	if ($_POST['update']==1) {

	if ($_POST['del_ava']==1) {$SQL_PHOTO=" `photo` = '', ";@unlink($user->get_property('photo'));}

	if ($_POST['pwd']>'' and ($_POST['pwd']==$_POST['pwd2'])) 
		{
		$salt=$DB->getOne("SELECT `#__users`.`salt` FROM `#__users` WHERE `#__users`.`id`=".$user->get_property('userID'));
		$password=sha1($salt.sha1($_POST['pwd']));
		$SQL_PWD=", `password` = '$password'";
		}
	if ($err==0) {
  	   if ($_FILES["photo"]["size"]>0) 
		{
		if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
			{
			$filename = $_FILES['photo']['tmp_name'];
			$ext = substr($_FILES['photo']['name'], 
				1 + strrpos($_FILES['photo']['name'], "."));
			if (filesize($filename) > $max_image_size) 
				{
				$message="Ошибка: Размер фото не может превышать: $max_image_size Kb";
				} elseif (!in_array($ext, $valid_types)) 
					{
					$message="Ошибка: Данный формат фото не поддерживается. <p>Выберите для загрузки фото в формате: GIF, JPG, PNG</p>";
					} else 
					{
		 			$size = GetImageSize($filename);
		 			if (($size) && ($size[0] < $max_image_width) 
						&& ($size[1] < $max_image_height)) {
						@unlink($user->get_property('photo'));
						$dir="../img/uploads/".$user->get_property('userID');
						$newname=rand(100000,99999999);
						while (file_exists($dir."/$newname".'_ava'.".$ext"))
							$newname=rand(100000,99999999);
						if (!is_dir($dir)) {@mkdir($dir, 0777, true);}
						if (@move_uploaded_file($filename, $dir."/$newname".'_ava'.".$ext")) {
						$path=$dir."/$newname".'_ava'.".$ext";
						$SQL_PHOTO=" `photo` = '$path', ";
						} else {
							$message='Ошибка: неудалось загрузить фото на сервер. Код: 0197838';
							}
						} else {
							$err=4;
							$message="Ошибка: Разрешение фото не может превышать: $max_image_width x $max_image_height";
							}
					}
			} else {
                         $SQL_PHOTO='';
			}
		} 
	$profile=$_POST['profile'];
	foreach ($profile as $key => $val):
		$save_data[$key]=PHP_slashes(htmlspecialchars($val));
	endforeach;
	$profile=serialize($save_data);		
	$sql="UPDATE `#__users` SET
		`family` = '".$_POST['fam']."', 
		`name` = '".$_POST['name']."',
		`name_two` = '".$_POST['sr']."', 
		$SQL_PWD $SQL_PHOTO 
		`wm` = '".$_POST['wm']."', 
		`desc` = '".htmlspecialchars($_POST['desc'])."',
		`profile` = '".$profile."'
	 	WHERE `id` ='".$user->get_property('userID')."' LIMIT 1 ;";
	   $DB->execute($sql);
	   $message='Данные профиля успешно обновлены';
	   }
	}
	$all = $DB->getAll('SELECT * FROM #__users WHERE userID='.$user->get_property('userID'));
	$profile=$DB->getAll("SELECT * FROM #__profile ORDER BY num ASC");
	$profile_val=$all[0]['profile'];
	$profile_val=unserialize($profile_val);
	foreach ($profile as $val)
		{
		$type=explode('|',$val['type']);
		if ($type[0]=='input') $form[]='<input class="inputbox" type="text" name="profile['.$val['id'].']" value="'.$profile_val[$val['id']].'" />';
		if ($type[0]=='textarea') $form[]='<textarea class="inputbox" name="profile['.$val['id'].']">'.$profile_val[$val['id']].'</textarea>';
		if ($type[0]=='select') 
			{
			$select='<select class="inputbox" name="profile['.$val['id'].']">';
			$i=0;
			foreach ($type as $t)
				{
				if($i==0):$i++;continue;endif;
				$i++;
				if($t==$profile_val[$val['id']]) $sel='selected'; else $sel=''; 
				$select.='<option value="'.$t.'" '.$sel.'>'.$t.'</option>';
				}
			$select.='</select>';
			$form[]=$select;
			}
		$name[]=$val['desc'];
		}

endif;
