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

$registry['banners'] = $DB->getAll("SELECT * FROM #__banners order by id asc");
if($_GET['edit'] > 0 && $_GET['section'] == 'edit'){
    $id = intval($_GET['edit']);
    $registry['banner'] = $DB->getAll("SELECT * FROM #__banners WHERE id='".$id."'");

if($_POST['add'] == 1){
    $date_dd=intval($_POST['date_dd']);
    $date_mm=intval($_POST['date_mm']);
    $date_yy=intval($_POST['date_yy']);
    $style = intval($_POST['style']);
    if($date_dd>31)$date_dd=31;
    if($date_dd<1)$date_dd=1;
    if($date_mm>12)$date_mm=12;
    if($date_mm<1)$date_mm=1;
    if($date_yy>2100)$date_yy=2100;
    if($date_yy<2011)$date_yy=2011;
    $time_hh=intval($_POST['time_hh']);
    $time_mm=intval($_POST['time_mm']);
    if($time_hh>23)$time_hh=23;
    if($time_hh<0)$time_hh=0;
    if($time_mm>59)$time_mm=59;
    if($time_mm<0)$time_mm=0;
    $date=mktime($time_hh,$time_mm,0,$date_mm,$date_dd,$date_yy);
    $url = PHP_slashes(htmlspecialchars(strip_tags($_POST['url'])));
    $banner = PHP_slashes(htmlspecialchars(strip_tags($_POST['banner'])));
    $id = intval($_POST['id']);
    if(!empty($banner) or !empty($url)){
        $DB->execute("UPDATE #__banners SET date='{$date}',url='{$url}',banner='{$banner}' WHERE id='{$id}' ");
        header('location:/apanel/index.php?component=banners&section=edit&edit='.$id.'&message=1');
    }else{
        $message[0] = "error";
        $message[1] = "გთხოვთ აირჩიოთ ბანერი ან ჩაწეროთ ბმული.";
    }
}

}