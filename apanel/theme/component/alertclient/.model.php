<?php
/**
 *
 * CMS It-Solutions 0.1
 * Author: Vati Child
 * E-mail: vatia0@gmail.com
 * URL: www.it-solutions.ge
 *
 */

unset($message);

if((isset($_POST['add']) OR isset($_POST['edit'])) and get_access('admin','alert','edit', false)) {

	$status=intval($_POST['status']);
	$id=intval($_POST['id']);
	$phone=PHP_slashes(htmlspecialchars(strip_tags($_POST['phone'])));
	$fio=PHP_slashes(htmlspecialchars(strip_tags($_POST['fio'])));
	$date_dd1=intval($_POST['date_dd1']);
	$date_mm1=intval($_POST['date_mm1']);
	$date_yy1=intval($_POST['date_yy1']);

	$date_dd2=intval($_POST['date_dd2']);
	$date_mm2=intval($_POST['date_mm2']);
	$date_yy2=intval($_POST['date_yy2']);

	 if($date_dd1>31)$date_dd1=31;
	 if($date_dd1<1)$date_dd1=1;
	 if($date_mm1>12)$date_mm1=12;
	 if($date_mm1<1)$date_mm1=1;
	 if($date_yy1>2100)$date_yy1=2100;
	 if($date_yy1<2011)$date_yy1=2011;
	$date1=mktime(10,0,0,$date_mm1,$date_dd1,$date_yy1);

	 if($date_dd2>31)$date_dd2=31;
	 if($date_dd2<1)$date_dd2=1;
	 if($date_mm2>12)$date_mm2=12;
	 if($date_mm2<1)$date_mm2=1;
	 if($date_yy2>2100)$date_yy2=2100;
	 if($date_yy2<2011)$date_yy2=2011;
	$date2=mktime(10,0,0,$date_mm2,$date_dd2,$date_yy2);

	$city=intval($_POST['city']);
	$region=intval($_POST['region']);


	if($fio>'') {
	$userID=$user->get_property('userID');
	if (isset($_POST['edit'])) {
		$sql="UPDATE `#__clients` SET `fio` = '$fio',`phone` = '$phone', `date1` = '$date1', 
			`date2` = '$date2', `status` = '$status',`city`='$city',`region`='$region' WHERE `id`='$id' LIMIT 1; ";
		$DB->execute($sql);
		}

	if (isset($_POST['add'])) {
		$sql="INSERT INTO `clients` (`user`,`fio`,`phone`,`date1`,`date2`,`status`,`city`,`region`) 
			VALUES ('$userID', '$fio', '$phone','$date1','$date2','$status','$city','$region');";
		$DB->execute($sql);
		}
	 $message[0]='valid';
	 $message[1]="Запись добавлена/изменена. Спасибо!";

	} else {
		 $message[0]='error';
		 $message[1]="Неправильно заполнены поля";
		}
}

if($_GET['section']=='edit' and get_access('admin','alert','edit', false) and intval($_GET['value'])>0) {
	$id=intval($_GET['value']);

   	$sql="SELECT `#__clients`.* FROM `#__clients` WHERE `#__clients`.`id` = '$id' LIMIT 1";
        $registry['clients']=$DB->getAll($sql);
}

if(intval($_GET['delete'])>0 and get_access('admin','alert','del', false)) {
	$id=intval($_GET['delete']);
	if($registry['onmy']==1) $sql_onmy="and user = '".$user->get_property('userID')."'";

	$sql="DELETE FROM `#__clients` WHERE `#__clients`.`id` = '$id' $sql_onmy LIMIT 1";
	$DB->execute($sql);
	header('Location: ?component=alertclient');
}


if((empty($_GET['section']) or $_GET['section']=='default') and get_access('admin','alert','view', false)) {
	if($registry['onmy']==1) $sql_onmy="and user = '".$user->get_property('userID')."'";

	if(isset($_POST['sort']['status']))$status=intval($_POST['sort']['status']);
		elseif(isset($_GET['status']) and empty($_POST['sort']['rubric']))$status=intval($_GET['status']);

	if(intval($status)>0) $sql_status=" and `#__clients`.`status` = '$status'";

	if(isset($_POST['sort']['city']))$city=intval($_POST['sort']['city']);
		elseif(isset($_GET['city']) and empty($_POST['sort']['rubric']))$city=intval($_GET['city']);

	if(isset($_POST['sort']['region']))$reg=intval($_POST['sort']['region']);
		elseif(isset($_GET['region']) and empty($_POST['sort']['rubric']))$reg=intval($_GET['region']);

	if(intval($city)>0) $sql_city=" and `#__clients`.`city` = '$city'";

	$page	                = intval($_GET['page']);
	$num = 20;
	if ($page==0) $page=1;
	$posts = $DB->getOne("SELECT count(#__clients.id) FROM #__clients WHERE `#__clients`.`id` >= '1' $sql_status $sql_onmy $sql_city");
	$registry['posts']=$posts;
	$total = intval(($posts - 1) / $num) + 1;  
	$page = intval($page);  
	if(empty($page) or $page < 0) $page = 1; 
	if($page > $total) $page = $total; 
	$start = $page * $num - $num;
	$link_url='index.php?component=alertclient&section=default&region='.$reg.'&status='.$city;
	if ($page != 1) $pervpage = '<a href="'.$link_url.'&page=-1">первая...</a> 
                               <a href="'.$link_url.'&page='. ($page - 1).'">предыдущая...</a> '; 
	if ($page != $total) $nextpage = '  <a href="'.$link_url.'&page='. ($page + 1).'">следующая...</a>
                                   <a href="'.$link_url.'&page='.$total.'">последняя...</a> '; 
	if($page - 2 > 0) $page2left = ' <a href="'.$link_url.'&page='. ($page - 2) .'">'. ($page - 2) .'</a>  '; 
	if($page - 1 > 0) $page1left = '<a href="'.$link_url.'&page='. ($page - 1) .'">'. ($page - 1) .'</a>  '; 
	if($page + 2 <= $total) $page2right = '  <a href="'.$link_url.'&page='. ($page + 2).'">'. ($page + 2) .'</a>'; 
	if($page + 1 <= $total) $page1right = '  <a href="'.$link_url.'&page='. ($page + 1).'">'. ($page + 1) .'</a>';
	$DB->show_err=true;
   	$sql="SELECT `#__clients`.*, `#__cities`.`city_name_ru`
		FROM `#__clients`
		LEFT JOIN `#__cities` ON `#__clients`.`city` = `#__cities`.`id_city`
		WHERE `#__clients`.`id` >= '1' $sql_status $sql_onmy $sql_city
		ORDER BY `#__clients`.`fio` ASC LIMIT $start, $num";
        $registry['clients']=$DB->getAll($sql);
	$registry['sort']['status']=$status;
	$registry['sort']['city']=$city;
	$registry['sort']['region']=$reg;

}