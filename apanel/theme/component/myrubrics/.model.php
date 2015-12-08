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
$filter_p = "";
$filter_g = "";
if(isset($_GET['from']) or isset($_GET['to'])){
    if($_GET['from']){
    $df = explode('/',$_GET['from']);
    $from= mktime(0,0,0,$df[1],$df[0],$df[2]);
        $filter_p.="AND `#__news`.`date` >= '".$from."'";
        $filter_g .= "&from=".$_GET['from'];
    }
    if($_GET['to']){
        $dt = explode('/',$_GET['to']);
        $to= mktime(0,0,0,$dt[1],$dt[0],$dt[2]);
        $filter_p.=" AND `#__news`.`date` <= '".$to."'";
        $filter_g .= "&to=".$_GET['to'];
    }

}
//---------------------------------------------
$page	                = intval($_GET['page']);

// Переменная хранит число сообщений выводимых на станице
$num = 15;
// Извлекаем из URL текущую страницу
if ($page==0) $page=1;
// Определяем общее число сообщений в базе данных
$posts = $DB->getOne("SELECT count(`#__news`.`id`) FROM `#__news` WHERE (`#__news`.`user` = ".$user->get_property('userID')." or `#__news`.`redactor` = '".$user->get_property('userID')."' or `#__news`.`corrector` = '".$user->get_property('userID')."') $filter_p");
//$postsmoder = $DB->getOne("SELECT count(`#__news`.`id`) FROM `#__news` LEFT JOIN #__category ON #__category.id=#__news.cat WHERE `moderate`='1' and #__category.section='post' and (`#__news`.`user` = {$user->get_property("userID")} or `#__news`.`redactor` = {$user->get_property("userID")} or `#__news`.`corrector` = {$user->get_property("userID")})  $filter_p");

$registry['posts']=$posts;
$registry['postsmoder']=$postsmoder;
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

$link_url='index.php?component=myrubrics'.$filter_g.'&';
if ($page != 1) $pervpage = '<a href="'.$link_url.'page=-1">პირველი...</a>
                               <a href="'.$link_url.'page='. ($page - 1).'">წინა...</a> ';
if ($page != $total) $nextpage = '  <a href="'.$link_url.'page='. ($page + 1).'">შემდეგი...</a>
                                   <a href="'.$link_url.'page='.$total.'">ბოლო...</a> ';
// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 2 > 0) $page2left = ' <a href="'.$link_url.'page='. ($page - 2) .'">'. ($page - 2) .'</a>  ';
if($page - 1 > 0) $page1left = '<a href="'.$link_url.'page='. ($page - 1) .'">'. ($page - 1) .'</a>  ';
if($page + 2 <= $total) $page2right = '  <a href="'.$link_url.'page='. ($page + 2).'">'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = '  <a href="'.$link_url.'page='. ($page + 1).'">'. ($page + 1) .'</a>';

//---------------------------------------------

$all = $DB->getAll('SELECT * FROM #__category WHERE podcat=0 && section="post"');
$i=0;
foreach($all as $nu):
    $category[$nu['id']][0]=$nu;
    $i++;
endforeach;

$all = $DB->getAll('SELECT * FROM #__category WHERE podcat>0 && section="post"');
$i=0;
foreach($all as $nu):
    $category[$nu['podcat']][]=$nu;
    $i++;
endforeach;

$all = $DB->getAll("SELECT #__news.*, #__category.name, #__category.podcat,#__users.realname
			FROM #__news LEFT JOIN #__category ON #__category.id=#__news.cat
			LEFT JOIN #__users ON #__users.id=#__news.user
			WHERE (`#__news`.`user` = ".$user->get_property('userID')." or `#__news`.`redactor` = ".$user->get_property('userID')." or `#__news`.`corrector` = ".$user->get_property('userID').") and (#__category.section='post' or #__news.cat=0) $filter_p
			ORDER BY `#__news`.`moderate` DESC LIMIT $start, $num");


//end