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


if ($user->get_property('userID')>0):
	$registry['user_data'] = $DB->getAll('SELECT * FROM #__users WHERE id='.$user->get_property('userID'));

	if ($_POST['update']==1) 
	{
		$realname=PHP_slashes(htmlspecialchars(strip_tags($_POST['realname'])));
		$phone=PHP_slashes(htmlspecialchars(strip_tags($_POST['phone'])));
		$icq=PHP_slashes(htmlspecialchars(strip_tags($_POST['icq'])));
		$url=PHP_slashes(htmlspecialchars(strip_tags($_POST['url'])));
		$title=PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])));
		$email=$_POST['email'];

		if(!email_check($email)) 
			{
			$message[0]='error';
			$message[1]="Ошибка: Указан не верный E-Mail адрес.";
			}
		if ($_POST['del_ava']==1) 
			{
			$filetypes = array('jpg', 'gif', 'png');
			foreach ($filetypes as $cur_type):
				@unlink('forum/img/avatars/'.$user->get_property('userID').'.'.$cur_type);
			endforeach;
			}

		if ($_POST['pwd']>'' and ($_POST['pwd']==$_POST['pwd2'])) 
			{
			$salt=$DB->getOne("SELECT `#__users`.`salt` FROM `#__users` WHERE `#__users`.`id`=".$user->get_property('userID'));
			$password=sha1($salt.sha1($_POST['pwd']));
			$SQL_PWD=", `password` = '$password'";
			}

		if ($_POST['pwd']>'' and ($_POST['pwd']<>$_POST['pwd2'])) 
			{
			$message[0]='error';
			$message[1]="Ошибка: Вероятно вы пытаетесь сменить пароль. Поля \"Пароль\" и \"Повторить пароль\" 
					должны содержать одинаковую информацию. Если же вы не желаете менять пароль, 
					то проследите чтобы при сохранении данных профиля эти поля были пустыми.";
			}
		if (empty($message[0])) 
		{
	
		if ($_FILES["photo"]["size"]>0) 
		{
		if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
			{
			$filename = $_FILES['photo']['tmp_name'];
			$ext = substr($_FILES['photo']['name'], 
				1 + strrpos($_FILES['photo']['name'], "."));
			if (filesize($filename) > $registry['img']['max_image_size']) 
				{
				$message[0]='error';
				$message[1]="Ошибка: Размер фото не может превышать: {$registry['img']['max_image_size']} Kb";
				} elseif (!in_array($ext, $registry['img']['valid_types'])) 
					{
					$message[0]='error';
					$message[1]="Ошибка: Данный формат фото не поддерживается. <p>Выберите для загрузки фото в формате: GIF, JPG, PNG</p>";
					} else 
					{
		 			$size = GetImageSize($filename);
		 			if (($size) && ($size[0] < $registry['img']['max_image_width']) 
						&& ($size[1] < $registry['img']['max_image_height'])) {
						//@unlink($user->get_property('photo'));
						$dir="forum/img/avatars";
						$newname=rand(100000,99999999);
						//while (file_exists($dir."/$newname".'_ava'.".$ext"))
						//	$newname=rand(100000,99999999);
						if (!is_dir($dir)) {@mkdir($dir, 0777, true);}
						@unlink($dir."/".$user->get_property('userID').".*");
						if (@move_uploaded_file($filename, $dir."/".$user->get_property('userID').".$ext")) {
						if (!is_dir($dir)) {@mkdir($dir, 0755, true);}
						//$path='../'.$dir."/$newname".'_ava'.".$ext";
						//$SQL_PHOTO=" `photo` = '$path', ";
						$message[0]='valid';
						$message[1]="Фото профиля обновлено.";
						} else {
							$message[0]='error';
							$message[1]='Ошибка: Не удалось загрузить фото на сервер. Код: 0197838';
							}
						} else {
							$err=4;
							$message[0]='error';
							$message[1]="Ошибка: Разрешение фото не может превышать: {$registry['img']['max_image_width']} x {$registry['img']['max_image_height']}";
							}
					}
			}
		} 

		$sql="UPDATE `#__users` SET
			`email` = '$email', 
			`phone` = '$phone', 
			`icq` = '$icq', 
			`url` = '$url', 
			`title` = '$title', 
			`realname` = '$realname'
			$SQL_PWD
		 	WHERE `id` ='".$user->get_property('userID')."' LIMIT 1 ;";
		$DB->execute($sql);
		$message[0]='valid';
		if(!empty($message[1]))$message[1].='<br/>';
		$message[1].='Данные профиля успешно обновлены';

		$registry['user_data'] = $DB->getAll('SELECT * FROM #__users WHERE id='.$user->get_property('userID'));
		}
	}
endif;
