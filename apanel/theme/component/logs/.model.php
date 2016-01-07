<?php defined('_JEXEC') or die('Restricted access');
unset($message);

if(intval($_GET['delete'])>0 and get_access('admin','tools','del', false)) {
	$id=intval($_GET['delete']);

	$sql="DELETE FROM `#__logs` WHERE `#__logs`.`id` = '$id' LIMIT 1";
	$DB->execute($sql);
	header('Location: ?component=logs');
}


if((empty($_GET['section']) or $_GET['section']=='default') and get_access('admin','tools','view', false)) {

	$page	                = intval($_GET['page']);
	$num = 25;
	if ($page==0) $page=1;
	$posts = $DB->getOne("SELECT count(#__logs.id) FROM #__logs");
	$registry['posts']=$posts;
	$total = intval(($posts - 1) / $num) + 1;  
	$page = intval($page);  
	if(empty($page) or $page < 0) $page = 1; 
	if($page > $total) $page = $total; 
	$start = $page * $num - $num;
	$link_url='index.php?component=logs&section=default&region='.$reg.'&city='.$city;
	if ($page != 1) $pervpage = '<a href="'.$link_url.'&page=-1">первая...</a> 
                               <a href="'.$link_url.'&page='. ($page - 1).'">предыдущая...</a> '; 
	if ($page != $total) $nextpage = '  <a href="'.$link_url.'&page='. ($page + 1).'">следующая...</a>
                                   <a href="'.$link_url.'&page='.$total.'">последняя...</a> '; 
	if($page - 2 > 0) $page2left = ' <a href="'.$link_url.'&page='. ($page - 2) .'">'. ($page - 2) .'</a>  '; 
	if($page - 1 > 0) $page1left = '<a href="'.$link_url.'&page='. ($page - 1) .'">'. ($page - 1) .'</a>  '; 
	if($page + 2 <= $total) $page2right = '  <a href="'.$link_url.'&page='. ($page + 2).'">'. ($page + 2) .'</a>'; 
	if($page + 1 <= $total) $page1right = '  <a href="'.$link_url.'&page='. ($page + 1).'">'. ($page + 1) .'</a>';
	$DB->show_err=true;
   	$sql="SELECT `#__logs`.*, `#__users`.`username`, `#__users`.`realname`
		FROM `#__logs`
                LEFT JOIN `#__users` ON `#__logs`.`user` = `#__users`.`id`
		ORDER BY `#__logs`.`date` DESC LIMIT $start, $num";
        $registry['logs']=$DB->getAll($sql);
}

if($_GET['section']=='view' and get_access('admin','tools','view', false) and intval($_GET['value'])>0) {
	$id=intval($_GET['value']);

   	$sql="SELECT `#__logs`.* , `#__users`.`username`, `#__users`.`realname`
            FROM `#__logs` 
            LEFT JOIN `#__users` ON `#__logs`.`user` = `#__users`.`id`
            WHERE `#__logs`.`id` = '$id' LIMIT 1";
        $registry['logs']=$DB->getAll($sql);
}

if($_GET['section'] == 'photocontest'){
	if(intval($_GET['uid']) > 0 && intval($_GET['news_id']) > 0){
		if(isset($_GET['show'])){
			$browser = ' AND browser != ""';
		}else{
			$browser = '';
		}
		$registry['contest'] = $DB->getAll("SELECT ip,star,browser FROM #__news_gallery_votes WHERE
                                           news_id='".intval($_GET['news_id'])."' and uid='".intval($_GET['uid'])."' {$browser} group by ip");
	}
}