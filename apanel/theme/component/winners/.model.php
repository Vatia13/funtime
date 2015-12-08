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
//---------------------------------------------
$page	                = intval($_GET['page']);

// Переменная хранит число сообщений выводимых на станице
$num = 15;
// Извлекаем из URL текущую страницу
if ($page==0) $page=1;
// Определяем общее число сообщений в базе данных
$posts = $DB->getOne("SELECT count(`#__vic_winners`.`id`) FROM `#__vic_winners` WHERE `#__vic_winners`.`id`>'0'");
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
$link_url='index.php?component=winners';
if ($page != 1) $pervpage = '<a href="'.$link_url.'&page=-1">პირველი...</a>
                               <a href="'.$link_url.'&page='. ($page - 1).'">წინა...</a> ';
if ($page != $total) $nextpage = '  <a href="'.$link_url.'&page='. ($page + 1).'">შემდეგი...</a>
                                   <a href="'.$link_url.'&page='.$total.'">ბოლო...</a> ';
// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 2 > 0) $page2left = ' <a href="'.$link_url.'&page='. ($page - 2) .'">'. ($page - 2) .'</a>  ';
if($page - 1 > 0) $page1left = '<a href="'.$link_url.'&page='. ($page - 1) .'">'. ($page - 1) .'</a>  ';
if($page + 2 <= $total) $page2right = '  <a href="'.$link_url.'&page='. ($page + 2).'">'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = '  <a href="'.$link_url.'&page='. ($page + 1).'">'. ($page + 1) .'</a>';

//---------------------------------------------
$registry['winners'] = $DB->getAll("SELECT * FROM #__vic_winners ORDER BY date desc LIMIT $start,$num");
