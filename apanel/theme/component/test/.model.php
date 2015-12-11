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
if(!$_GET['section']){
    $registry['tests'] = $DB->getAll("SELECT #__tests.* FROM #__tests WHERE #__tests.id > 0 order by id desc");
    if(get_access('admin','tests','edit',false)):
    if(intval($_GET['value']) > 0){
        $val = intval($_GET['value']);
        $status = intval($_GET['status']);
        if($DB->execute("UPDATE #__tests SET status='{$status}' WHERE id='{$val}'")){
            header('location:/apanel/index.php?component=test');
        }
    }
    endif;
    if(get_access('admin','tests','del',false)):
      if(intval($_GET['delete']) > 0){
          $del = intval($_GET['delete']);
          if($DB->execute("DELETE FROM #__tests WHERE id='{$del}'")){
              header('location:/apanel/index.php?component=test');
          }
      }
    endif;
}
if(get_access('admin','tests','edit',false)):
if($_GET['section'] == 'add'){
    if($_POST){
         $title = PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])));
         $lid = PHP_slashes(htmlspecialchars(strip_tags($_POST['lid'])));
         $img = PHP_slashes(htmlspecialchars(strip_tags($_POST['img'])));
         $question = base64_encode(serialize($_POST['question']));
         $answer = base64_encode(serialize($_POST['answer']));
         $point = base64_encode(serialize($_POST['point']));
         $result = base64_encode(serialize($_POST['result']));
        $date_dd=intval($_POST['date_dd']);
        $date_mm=intval($_POST['date_mm']);
        $date_yy=intval($_POST['date_yy']);
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
        $type = intval($_POST['type']);
         if($DB->execute("INSERT INTO #__tests (title,lid,img,question,answer,point,result,type,date) VALUES ('$title','$lid','$img','$question','$answer','$point','$result','$type','$date') ")){
             header('location:/apanel/index.php?component=test&success=add');
         }

    }
}

if($_GET['section'] == 'edit' && $_GET['edit'] > 0){
    $value = intval($_GET['edit']);
    $registry['test'] = $DB->getAll("SELECT #__tests.* FROM #__tests WHERE #__tests.id = {$value} order by id desc");

    $registry['question'] = get_serialize($registry['test'][0]['question']);
    $registry['answer'] = get_serialize($registry['test'][0]['answer']);
    $registry['point'] = get_serialize($registry['test'][0]['point']);
    $registry['result'] = get_serialize($registry['test'][0]['result']);
    if($registry['answer']){
        $registry['answer_keys'] = array_keys($registry['answer']);
    }
    if($registry['result']){
        $registry['result_keys'] = array_keys($registry['result']);
    }
    if($_POST){
        $title = PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])));
        $lid = PHP_slashes(htmlspecialchars(strip_tags($_POST['lid'])));
        $img = PHP_slashes(htmlspecialchars(strip_tags($_POST['img'])));
        $question = base64_encode(serialize($_POST['question']));
        $answer = base64_encode(serialize($_POST['answer']));
        $point = base64_encode(serialize($_POST['point']));
        $result = base64_encode(serialize($_POST['result']));
        $date_dd=intval($_POST['date_dd']);
        $date_mm=intval($_POST['date_mm']);
        $date_yy=intval($_POST['date_yy']);
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
        $type = intval($_POST['type']);
        $date=mktime($time_hh,$time_mm,0,$date_mm,$date_dd,$date_yy);
        if($DB->execute("UPDATE #__tests SET title='{$title}',lid='{$lid}',img='{$img}',question='{$question}',answer='{$answer}',point='{$point}',result='{$result}',type='{$type}',date='{$date}' WHERE id='{$value}'")){
            header('location:/apanel/index.php?component=test&success=edit');
        }
    }
}
endif;

