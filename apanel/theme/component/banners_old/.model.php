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

if($_POST['submit']){
     if($_POST['banner_cat'] == 1){
         $banner_sql = ' WHERE #__banners.cat_id=0';
         $banner_order = 'order by #__banners.id asc';
     }elseif($_POST['banner_cat'] == 2){
         $banner_sql = ' LEFT JOIN #__category ON #__category.id=#__banners.cat_id WHERE #__category.stat="0" and #__banners.cat_id > 0';
         $banner_order = $banner_order = 'order by #__category.name asc';
     }else{
         $banner_sql = ' LEFT JOIN #__category ON #__category.id=#__banners.cat_id WHERE #__category.stat="0" or #__banners.cat_id=0';
         $banner_order = $banner_order = 'order by #__category.name asc';
     }
}
$registry['banners'] = $DB->getAll("SELECT #__banners.* FROM #__banners $banner_sql $banner_order");
if($_GET['edit'] > 0 && $_GET['section'] == 'edit'){
    $id = intval($_GET['edit']);
    $registry['banner'] = $DB->getAll("SELECT #__banners.* FROM #__banners WHERE #__banners.id='".$id."'");

if($_POST['edit'] == 1){
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
    if($_POST['title']){
      $title = PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])));
        $sql_title = ",position='{$title}'";
    }else{
        $sql_title = '';
    }

    $id = intval($_POST['id']);
    if(!empty($banner)){
        $DB->execute("UPDATE #__banners SET date='{$date}',url='{$url}',banner='{$banner}' $sql_title WHERE id='{$id}' ");
        clear_cache();
        header('location:/apanel/index.php?component=banners&section=edit&edit='.$id.'&message=1');
    }else{
        $message[0] = "error";
        $message[1] = "გთხოვთ აირჩიოთ ბანერი ან ჩაწეროთ ბმული.";
    }
}

}

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
    $filter_cat = intval($_POST['filter-cat']);

    $title = PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])));

 if(!empty($filter_cat)){
    if(!empty($banner)){
        $sum = $DB->getOne("SELECT count(id) FROM #__banners WHERE cat_id='$filter_cat'");
       if($sum < 5){
           if($sum > 2){$bw=230;$bh=600;}else{$bw=800;$bh=100;}
         if($DB->execute("INSERT INTO #__banners (date,url,cat_id,banner,width,height,position) VALUES ('$date','$url','$filter_cat','$banner','$bw','$bh','$title')")){
             clear_cache();
             header('location:/apanel/index.php?component=banners');
         }
       }else{
           $message[0] = "error";
           $message[1] = "რუბრიკაზე მაქსიმალური 4 ბანერი უკვე დამატებულია. თუ გსურთ უკვე დამატებული ბანერის ახლით შეცვლა გთხოვთ გამოიყენოთ რედაქტირების ფუნქცია.";
       }
    }else{
        $message[0] = "error";
        $message[1] = "გთხოვთ აირჩიოთ ბანერი ან ჩაწეროთ ბმული.";
    }
 }else{
     $message[0] = "error";
     $message[1] = "აუცილებელია რუბრიკის არჩევა.";
 }

}

$all = $DB->getAll('SELECT * FROM #__category WHERE podcat=0 && section="post" && stat="0" order by name asc');
$i=0;
foreach($all as $nu):
    $category[$nu['id']][0]=$nu;
    $i++;
endforeach;

$all = $DB->getAll('SELECT * FROM #__category WHERE podcat>0 && section="post" && stat="0" order by name asc');
$i=0;
foreach($all as $nu):
    $category[$nu['podcat']][]=$nu;
    $i++;
endforeach;

if(get_access('admin','banners','view',false)):
if($_GET['banner'] == 'del' && $_GET['del'] > 0){
    if($DB->execute('DELETE FROM #__banners WHERE id="'.intval($_GET['del']).'"')){
        header('location:/apanel/index.php?component=banners');
    }

}
endif;