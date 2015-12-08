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

if ($user->get_property('userID')>0 OR $user->get_property('gid')>=18)
	{
	if ($_GET['section']=='delete')
		{
		$sql="DELETE FROM `#__news` WHERE `#__news`.`moderate`='1' and `#__news`.`user`='".$user->get_property('userID')."' and `#__news`.`id` = ".intval($_GET['value'])." LIMIT 1";
		$DB->execute($sql);
		header('location: /com/addart/');
		}
	if ($_POST['update']==1 OR $_POST['add']==1) 
		{
		if ($_POST['title']=='') {
			$message[0]='error';
			$message[1]= 'Вы не заполнили поля "заголовок".';
			}
		if (empty($message[0])) 
			{
			$max_img_size_art_prev = $DB->getOne("SELECT `value` FROM `#__setting` WHERE `name`='max_img_size_art_prev' LIMIT 1;");
			$max_img_width_art_prev = $DB->getOne("SELECT `value` FROM `#__setting` WHERE `name`='max_img_width_art_prev' LIMIT 1;");
			$max_img_height_art_prev = $DB->getOne("SELECT `value` FROM `#__setting` WHERE `name`='max_img_height_art_prev' LIMIT 1;");
                        $max_img_size_art_prev=$max_img_size_art_prev*1024;

			$title=PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])));
			$chpu=PHP_slashes(htmlspecialchars(strip_tags($_POST['chpu'])));
			if ($chpu=='')$chpu=generate_chpu($title);
			$cat=intval($_POST['cat']);
			$comments=intval($_POST['comments']);
			$text=PHP_slashes(markhtml($_POST['textarea1']));
			$date=time();
			$show_date=intval($_POST['show_date']);
			$original_url=htmlspecialchars(strip_tags($_POST['original_url']));
			$tags=$tags_ru=htmlspecialchars(strip_tags($_POST['tags']));
			$tags=explode(',',$tags);
			$tags_en='';
			foreach($tags as $tag):
				$t_en=generate_chpu($tag);
				if(empty($tags_en))$tags_en=$t_en; else $tags_en=$tags_en.', '.$t_en;
				$DB->show_err=FALSE;
				$sql="	INSERT INTO `#__tags` (`name_rus`, `name_eng`, `count`) 
					VALUES ('".strtolower($tag)."', '".$t_en."','0')";
				$DB->execute($sql);
				$sql="	UPDATE `#__tags` SET `count`=`count`+1
					WHERE `name_rus`='".strtolower($tag)."'";
				$DB->execute($sql);
			endforeach;

			if($_FILES["photo"]["size"]>0):
			$imgpath=save_image_on_server($_FILES["photo"],'img/uploads/news/prev/',$registry['img']);
			if(!empty($imgpath[1]))
				{
				$path=$imgpath[1];//str_replace('../','',$imgpath[1]).'|';
				if($_POST['update']==1) $SQL_PHOTO=" `thumbs` = '$path', ";
				if($_POST['add']==1) $SQL_PHOTO=$path;
				}
			endif;

			if ($_POST['update']==1) 
				{
		        	$sql="UPDATE `#__news` SET 
				`cat` = '$cat', 
				`title` = '$title',
				`text` = '$text',
				`chpu` = '$chpu',
				`show_date` = '$show_date',
				`tags_ru` = '$tags_ru',
				`tags_en` = '$tags_en',
				$SQL_PHOTO
				`original_url` = '$original_url',
				`comments` = '$comments'
				WHERE `id`='".intval($_POST['id'])."' LIMIT 1; ";
				$DB->execute($sql);
				$message[0]='valid';
				if(!empty($message[1]))$message[1].='<br/>';
				$message[1].='Запись успешно обновлена';
			   	}

			if ($_POST['add']==1) 
				{
				$sql="	UPDATE `#__users` SET `rate`=`rate`+100
					WHERE `userID`='".$user->get_property('userID')."'";
				$DB->execute($sql);

				$test_chpu = $DB->getOne("SELECT count(#__news.id) FROM `#__news` WHERE `chpu`='$chpu'");
				if($test_chpu>0)$chpu=rand(100,9999).'_'.$chpu;
				$sql="INSERT INTO `#__news` (`id` ,`user`, `cat`, `title`, `text`, `rate`,`chpu`,`date`,`show_date`,`tags_ru`,`tags_en`,`original_url`,`thumbs`,`comments`,`moderate`) VALUES 
			('', '".$user->get_property('userID')."','$cat','$title','$text','0','$chpu','$date','$show_date','$tags_ru','$tags_en','$original_url','$SQL_PHOTO','$comments','1')";
				$DB->execute($sql);
				$message[0]='valid';
				if(!empty($message[1]))$message[1].='<br/>';
				$message[1].='Запись успешно добавлена';
				}
			}
		}
	$filter_p='';

//---------------------------------------------
	$page	                = intval($_GET['value']);

	// Переменная хранит число сообщений выводимых на станице 
	$num = 15;
	// Извлекаем из URL текущую страницу 
	if ($page==0) $page=1;
	// Определяем общее число сообщений в базе данных 
	$posts = $DB->getOne("SELECT count(#__news.id) FROM #__news $filter_p WHERE #__news.moderate=1 and #__news.user=".$user->get_property('userID'));
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
	$link_url='/com/addart/default';
	if ($page != 1) $pervpage = '<a href="'.$link_url.'/-1"><<</a> 
                               <a href="'.$link_url.'/'. ($page - 1).'"><</a> '; 
	// Проверяем нужны ли стрелки вперед 
	if ($page != $total) $nextpage = '  <a href="'.$link_url.'/'. ($page + 1).'">></a>
                                   <a href="'.$link_url.'/'.$total.'">>></a> '; 
	// Находим две ближайшие станицы с обоих краев, если они есть 
	if($page - 2 > 0) $page2left = ' <a href="'.$link_url.'/'. ($page - 2) .'">'. ($page - 2) .'</a>  '; 
	if($page - 1 > 0) $page1left = '<a href="'.$link_url.'/'. ($page - 1) .'">'. ($page - 1) .'</a>  '; 
	if($page + 2 <= $total) $page2right = '  <a href="'.$link_url.'/'. ($page + 2).'">'. ($page + 2) .'</a>'; 
	if($page + 1 <= $total) $page1right = '  <a href="'.$link_url.'/'. ($page + 1).'">'. ($page + 1) .'</a>';

//---------------------------------------------

		$all = $DB->getAll('SELECT * FROM #__category WHERE podcat=0');
		$i=0;
		foreach($all as $nu):
			$registry['category_a'][$nu['id']][0]=$nu;
			$i++;
		endforeach;
	
		$all = $DB->getAll('SELECT * FROM #__category WHERE podcat>0');
		$i=0;
		foreach($all as $nu):
			$registry['category_a'][$nu['podcat']][]=$nu;
			$i++;
		endforeach;
	$registry['mynews'] = $DB->getAll("SELECT #__news.*, #__category.name FROM #__news LEFT JOIN #__category ON #__category.id=#__news.cat $filter_p 
	WHERE `#__news`.`moderate`='1' and `#__news`.`user`='".$user->get_property('userID')."' ORDER BY `#__news`.`id` DESC LIMIT $start, $num");
}
