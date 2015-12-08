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

if(get_access('admin','comments','del',false)) {
	if (!empty($_GET['delete']))
		{
		$sql="DELETE FROM `#__comments` WHERE `#__comments`.`id` = ".intval($_GET['delete'])." LIMIT 1";
		$DB->execute($sql);
		$t=3;
		header('location: ?component=comment&status=error&t='.$t);
		}
}
if(get_access('admin','comments','edit',false)) {
	if ($_POST['update']==1 OR $_POST['add']==1) 
		{
		if ($_POST['message']=='') {$err=8;$message= 'Комментарий не может быть пустым';}
		if ($err==0) 
			{
			$message=PHP_slashes(htmlspecialchars(strip_tags($_POST['message'])));

			if ($_POST['update']==1) 
				{
		        	$sql="UPDATE `#__comments` SET 
				`message` = '$message'
				WHERE `id`='".intval($_POST['id'])."' LIMIT 1; ";
				$DB->execute($sql);
				$t=2;
			   	}
			header('Location: index.php?component=comment&status=valid&t='.$t);
			}
		}
}

if(get_access('admin','comments','view',false)) {
	$filter_p='';
	if((!empty($_POST['filter-cat']) OR !empty($_COOKIE['filter-cat'])) and $_POST['filter-cat']!=='none'):
		if(!empty($_POST['filter-cat'])):
			$val=intval($_POST['filter-cat']); 
			setcookie('filter-cat',$val,time()+36000,'/');
			else:
			 $val=intval($_COOKIE['filter-cat']);
			endif;
		$filter_p=" WHERE #__news.cat =".$val;
	endif;
	if($_POST['filter-cat']=='none')
		{
		setcookie('filter-cat','',time()-36000,'/');
		}

//---------------------------------------------
	$page	                = intval($_GET['page']);

	// Переменная хранит число сообщений выводимых на станице 
	$num = 15;
	// Извлекаем из URL текущую страницу 
	if ($page==0) $page=1;
	// Определяем общее число сообщений в базе данных 
	$posts = $DB->getOne("SELECT count(#__comments.id) FROM #__comments WHERE #__comments.table=1");
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
	$link_url='index.php?component=comment&section=default';
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

		$all = $DB->getAll("
			SELECT #__comments.*, #__news.title, #__news.chpu, #__category.name,
			#__category.cat_chpu, #__category.podcat 
			FROM #__comments
			LEFT JOIN #__news ON #__comments.news=#__news.id
			LEFT JOIN #__category ON #__category.id=#__news.cat 
			WHERE #__comments.table=1
			ORDER BY `#__comments`.`id` DESC LIMIT $start, $num");
}
