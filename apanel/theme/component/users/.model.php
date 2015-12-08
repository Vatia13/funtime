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

if(get_access('admin','user','del',false)):
	if (!empty($_GET['delete']))
		{
		$sql="DELETE FROM `#__users` WHERE `#__users`.`id` = ".intval($_GET['delete'])." LIMIT 1";
		$DB->execute($sql);
		if(!empty($_GET['page'])) $page='&section=default&page='.$_GET['page'];
		$LOG->saveLog($user->get_property('userID'),'მომხმარებლები: მომხმარებლის წაშლა / ID: '.intval($_GET['delete']));
		header('Location: ?component=users'.$page);
		}
endif;
	if (!empty($_GET['activ']))
		{
		$sql="UPDATE `#__users` SET `group_id` = '3' WHERE `id`='".intval($_GET['activ'])."' LIMIT 1; ";
		$DB->execute($sql);
		header('Location ?component=users');
		}
if(get_access('admin','user','edit',false)):
	if ($_POST['gredit']==1) 
		{
		$idd=intval($_POST['idd']);
		$name=PHP_slashes(htmlspecialchars($_POST['name']));
		if(is_array($_POST['accessA']))$accessA=serialize($_POST['accessA']); else $access=NULL;
	   	$DB->execute("UPDATE `#__group` SET 
		`name` = '$name',
		`accessA` = '$accessA'
		WHERE `id` =".$idd." LIMIT 1 ;");
		}

	if ($_POST['add']==1) {
	if ($_POST['pwd']>'' and ($_POST['pwd']==$_POST['pwd2'])) 
		{
		$login=PHP_slashes(htmlspecialchars($_POST['login']));
		$all = $DB->getAll("SELECT `#__users`.`id` FROM `#__users` WHERE `username`='$login' LIMIT 1");
		if(!empty($login) and count($all)==0)
		{
		$salt=generate_password(7);

		$password=$_POST['pwd'];

		$password=sha1($salt.sha1($password));


		$date=time();
		$group=intval($_POST['group']);

		$title=PHP_slashes(htmlspecialchars($_POST['title']));
		$realname=PHP_slashes(htmlspecialchars($_POST['realname']));
		$icq=PHP_slashes(htmlspecialchars($_POST['icq']));

		$email=PHP_slashes(htmlspecialchars($_POST['email']));
		$phone=PHP_slashes(htmlspecialchars($_POST['phone']));
		$sql = "INSERT INTO `#__users` 
		(`id`,`group_id`,`username`,`password`,`salt`,`email`,`title`,`realname`,`icq`,`url`,`email_setting`,`show_smilies`,`show_img`,`show_img_sig`,
		`show_avatars`,`show_sig`,`language`,`style`,`registered`,`pun_bbcode_enabled`,
		`pun_bbcode_use_buttons`,`city`,`region`,`profile`,`phone`) 

		VALUES ('','$group','$login','$password','$salt','$email','$title','$realname','$icq','$url','1','1','0','1','1','1',
		'English','Oxygen','$date','1','1','','','','$phone')";

		$DB->execute($sql);
		   $message[0]='valid';
		   $message[1].='ახალი მომხმარებელი წარმატებით დაემატა.';
		   $LOG->saveLog($user->get_property('userID'),'მომხმარებლები: მომხმარებლის დამატება. ჩანაწერი / ID '.$DB->id.' ('.$login.')');
		}
		else {
		$message[0]='error';
		$message[1]="შეცდომა: თქვენ არ მიუთითეთ \"მომხმარებელი\" ან ასეთი \"მომხმარებელი\" უკვე გამოიყენება.";
		}
		}
		else {
		$message[0]='error';
		$message[1]="შეცდომა: არ ემთხვევა პაროლები.";
		}
	}
	if ($_POST['update']==1) {
	$idd=intval($_POST['id']);
	$upd = $DB->getAll("SELECT * FROM #__users WHERE id='$idd' LIMIT 1;");

	$group=intval($_POST['group']);
	if ($_POST['del_ava']==1) {
		$filetypes = array('jpg', 'gif', 'png');
		foreach ($filetypes as $cur_type):
			@unlink('../forum/img/avatars/'.$idd.'.'.$cur_type);
		endforeach;
		}

	if ($_POST['pwd']>'' and ($_POST['pwd']==$_POST['pwd2'])) 
		{
		$password=sha1($upd[0]['salt'].sha1($_POST['pwd']));
		$SQL_PWD="`password` = '$password',";
		}
	if ($_POST['pwd']>'' and ($_POST['pwd']<>$_POST['pwd2'])) 
		{
		$message[0]='error';
		$message[1]="შეცდომა: სავარაუდოდ თქვენ ცდილობთ შეცვალოთ პაროლი. ველები \"პაროლი\" და \"გაიმეორე პაროლი\" უნდა შეიცავდეს ერთნაერ ინფორმაციას. თუ არ გსურთ პაროლის შეცვლა, დაუკვირდით რომ მონაცემების შენახვისას პაროლის და გაიმეორე პაროლის ველები იყოს ცარიელი.";
		}
	if (empty($message[0])) {
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
				$message[1]="შეცდომა: პოტოს ზომა არ უნდა აღემატებოდეს: {$registry['img']['max_image_size']} Kb";
				} elseif (!in_array($ext, $registry['img']['valid_types'])) 
					{
					$message[0]='error';
					$message[1]="შეცდომა: არასწორი ფორმატი. <p>ფოტოს ასატვირთად აირჩიეთ შემდეგი ფორმატები: GIF, JPG, PNG</p>";
					} else 
					{
		 			$size = GetImageSize($filename);
		 			if (($size) && ($size[0] < $registry['img']['max_image_width']) 
						&& ($size[1] < $registry['img']['max_image_height'])) {
						$dir="../forum/img/avatars";
						$newname=rand(100000,99999999);
						if (!is_dir($dir)) {@mkdir($dir, 0777, true);}
						@unlink($dir."/".$idd.".*");
						if (@move_uploaded_file($filename, $dir."/".$idd.".$ext")) {
						if (!is_dir($dir)) {@mkdir($dir, 0755, true);}
						$message[0]='valid';
						$message[1]="პროფილის ფოტო წარმატებით შეიცვალა.";
						} else {
							$message[0]='error';
							$message[1]='შეცდომა: ვერ ხერხდება ფოტოს სერვერზე ატვირთვა. კოდი: 0197838';
							}
						} else {
							$message[0]='error';
							$message[1]="შეცდომა: ფოტოს პიქსელები არ შეიძლება აღემატებოდეს: {$registry['img']['max_image_width']} x {$registry['img']['max_image_height']}";
							}
					}
			}
		} 

	$profile=serialize($save_data);
	$title=PHP_slashes(htmlspecialchars($_POST['title']));
    $username=PHP_slashes(htmlspecialchars($_POST['username']));
	$realname=PHP_slashes(htmlspecialchars($_POST['realname']));
	$icq=PHP_slashes(htmlspecialchars($_POST['icq']));
	$url=PHP_slashes(htmlspecialchars($_POST['url']));
	$vip=intval($_POST['vip']);
	$email=PHP_slashes(htmlspecialchars($_POST['email']));
	$phone=PHP_slashes(htmlspecialchars($_POST['phone']));
	   $DB->execute("UPDATE `#__users` SET
	    `username` = '$username',
		`realname` = '$realname', 
		`title` = '$title', 
		`url` = '$url', 
		`group_id`='$group', $SQL_PWD
		`icq` = '$icq',
		`email` = '$email',
		`phone` = '$phone',
		`vip` = '$vip'
		WHERE `id` =".$idd." LIMIT 1 ;");
	   $message[0]='valid';
	   if(!empty($message[1]))$message[1].='<br/>';
	   $message[1].='პროფილი "<b>'.$upd[0]['username'].'"-ს მონაცემები</b> წარმატებით შეიცვალა';
           $LOG->saveLog($user->get_property('userID'),'მომხმარებლები: მომხმარებლის რედაქტირება. ჩანაწერი / ID '.$idd);
	   }
	}

	if(!empty($_GET['edit'])):
	$profile=$DB->getAll("SELECT * FROM #__profile ORDER BY num ASC");
	$profile_val=$DB->getOne("SELECT profile FROM #__users WHERE id=".intval($_GET['edit']));
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
endif; //access edit

if(get_access('admin','user','view',false)):
	if($registry['onmy']==1)$sql_onmy="WHERE #__users.id = '".$user->get_property('userID')."'";

	if(empty($_GET['section']) or $_GET['section']=='default') {	
//---------------------------------------------
	$page	                = intval($_GET['page']);

	// Переменная хранит число сообщений выводимых на станице 
	$num = 25;
	// Извлекаем из URL текущую страницу 
	if ($page==0) $page=1;
	// Определяем общее число сообщений в базе данных 
	$posts = $DB->getOne("SELECT count(#__users.id) FROM #__users $sql_onmy $filter_p");
	// Находим общее число страниц 
	$total = intval(($posts - 1) / $num) + 1;  

	// Определяем начало сообщений для текущей страницы 
	$page = intval($page);  
	// Если значение $page меньше единицы или отрицательно 
	// переходим на первую страницу 
	// А если слишком большое, то переходим на последнюю 
	if(empty($page) or $page < 0) $page = 1; 
	if($page > $total) $page = $total; 
	// Вычисляем начиная к какого номера 
	// следует выводить сообщения 
	$start = $page * $num - $num;

	// Проверяем нужны ли стрелки назад 
	$link_url='index.php?component=users&section=default';
	if ($page != 1) $pervpage = '<a href="'.$link_url.'&page=-1"><<</a> 
                               <a href="'.$link_url.'&page='. ($page - 1).'"><</a> '; 
	// Проверяем нужны ли стрелки вперед 
	if ($page != $total) $nextpage = '  <a href="'.$link_url.'&page='. ($page + 1).'">></a>
                                   <a href="'.$link_url.'&page='.$total.'">>></a> '; 
	// Находим две ближайшие станицы с обоих краев, если они есть 
	if($page - 2 > 0) $page2left = ' <a href="'.$link_url.'&page='. ($page - 2) .'">'. ($page - 2) .'</a>  '; 
	if($page - 1 > 0) $page1left = '<a href="'.$link_url.'&page='. ($page - 1) .'">'. ($page - 1) .'</a>  '; 
	if($page + 2 <= $total) $page2right = '  <a href="'.$link_url.'&page='. ($page + 2).'">'. ($page + 2) .'</a>'; 
	if($page + 1 <= $total) $page1right = '  <a href="'.$link_url.'&page='. ($page + 1).'">'. ($page + 1) .'</a>';

//---------------------------------------------

	$all = $DB->getAll("SELECT `#__users`.*, `#__group`.`name`,`#__group`.`id` as `gid` 
		FROM `#__users` LEFT JOIN `#__group` ON `#__users`.`group_id`=`#__group`.`pungid` $sql_onmy ORDER BY username ASC LIMIT $start, $num");
	}
endif;

if(get_access('admin','group','view',false)):
	if($_GET['section']=='group'):	
		$all = $DB->getAll("SELECT `#__group`.* FROM `#__group`");
	endif;
endif;

if(get_access('admin','group','edit',false)):
	if($_GET['section']=='gredit')
		{
		$id=intval($_GET['edit']);
		$sql="SELECT `#__group`.* FROM `#__group` WHERE `id`='$id'";
		$registry['groupitem'] = $DB->getAll($sql);
		$registry['groupitem'][0]['accessA']=unserialize($registry['groupitem'][0]['accessA']);
		}
endif;

if(get_access('admin','user','edit',false)):
	if($_GET['section']=='edit')
		{
		$id=intval($_GET['edit']);
		$registry['edituser'] = $DB->getAll('SELECT * FROM #__users WHERE #__users.id='.$id);
		$registry['group'] = $DB->getAll('SELECT * FROM `#__group` ORDER BY id ASC');
		}
endif;
if(get_access('admin','user','edit',false)):
	if($_GET['section']=='add')
	{
	$registry['group'] = $DB->getAll('SELECT * FROM `#__group` ORDER BY id ASC');
	}
endif;
if(isset($_GET['status']) && isset($_GET['user'])):
   if(get_access('admin','user','edit',false)):
     $DB->execute('UPDATE #__users SET status="'.intval($_GET['status']).'" WHERE id='.intval($_GET['user']));
   header('location:/apanel/index.php?component=users');
   endif;
endif;

if(isset($_GET['show_img']) && isset($_GET['user'])):
	if(get_access('admin','user','edit',false)):
		$DB->execute('UPDATE #__users SET show_img="'.intval($_GET['show_img']).'" WHERE id='.intval($_GET['user']));
		$uri = str_replace('&show_img=1','',$_SERVER['REQUEST_URI']);
		$uri = str_replace('&show_img=0','',$uri);
		header('location:'.$uri);
	endif;
endif;