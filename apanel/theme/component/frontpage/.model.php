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
if($_GET['news'] > 0){
if ($user->get_property('userID')==1 OR $user->get_property('gid')<=26):
    //authors
    $sql = "SELECT realname,id FROM #__users WHERE group_id = 3 or group_id=6 order by realname asc";
    $registry['authors'] = $DB->getAll($sql);
    //front page posts
    $filter_p = '';
    if((!empty($_POST['filter-cat']) OR !empty($_COOKIE['filter-cat'])) and $_POST['filter-cat']!=='none'):
        if(!empty($_POST['filter-cat'])):
            $val=intval($_POST['filter-cat']);
            setcookie('filter-cat',$val,time()+3600,'/');
        else:
            $val=intval($_COOKIE['filter-cat']);
        endif;
        $filter_p.="AND `#__news`.`cat`=".$val." ";
    endif;
    if((!empty($_POST['from']) OR !empty($_COOKIE['from']))):
        if(!empty($_POST['from'])):
            $val=$_POST['from'];
            setcookie('from',$val,time()+3600,'/');
        else:
            $val=$_COOKIE['from'];
        endif;
        $ds = explode('/',$val);
        $from= mktime(0,0,0,$ds[1],$ds[0],$ds[2]);
        $filter_p.="AND `#__news`.`date` >= '".$from."'";
    else:
        $val = '1/'.date('m/Y');
        $ds = explode('/',$val);
        $from= mktime(0,0,0,$ds[1],$ds[0],$ds[2]);
        $filter_p.="AND `#__news`.`date` >= '".$from."'";
    endif;
    //end from
    if((!empty($_POST['to']) OR !empty($_COOKIE['to']))):
        if(!empty($_POST['to'])):
            $tval=$_POST['to'];
            setcookie('to',$tval,time()+3600,'/');
        else:
            $tval=$_COOKIE['to'];
        endif;
        //$to = date('d/m/Y H:i',$tval);
        $df = explode('/',$tval);
        $to= mktime(0,0,0,$df[1],$df[0],$df[2]);
        //endto
        $filter_p.=" AND `#__news`.`date` <= '".$to."'";
    endif;
    if((!empty($_POST['status']) OR !empty($_COOKIE['status'])) and $_POST['status']!=='none'):
        if(!empty($_POST['status'])):
            $val=intval($_POST['status']);
            setcookie('status',$val,time()+3600,'/');
        else:
            $val=intval($_COOKIE['status']);
        endif;
        $filter_p.=" AND `#__news`.`moderate`=".$val;
    else:
        $filter_p.=" AND `#__news`.`moderate` <> 10";
    endif;
    if((!empty($_POST['author']) OR !empty($_COOKIE['author'])) and $_POST['author']!=='none'):
        if(!empty($_POST['author'])):
            $val=intval($_POST['author']);
            setcookie('status',$val,time()+3600,'/');
        else:
            $val=intval($_COOKIE['author']);
        endif;
        $filter_p.=" AND `#__news`.`user`=".$val;
    endif;
    if($_POST['filter-cat']=='none'){setcookie('filter-cat','',time()-3600,'/');}
    if(empty($_POST['from'])){setcookie('from','',time()-3600,'/');}
    if(empty($_POST['to'])){setcookie('to','',time()-3600,'/');}

    if(get_access('admin','article','view', false)):

        if($registry['onmy']==1)$sql_onmy="and (`#__news`.`user` = '".$user->get_property('userID')."' or `#__news`.`redactor` = '".$user->get_property('userID')."' or `#__news`.`corrector` = '".$user->get_property('userID')."')";
        if($user->get_property('gid') != 25):
        $filter_p.=" and (#__news.group LIKE '%:\"".$user->get_property('gid')."\";%' or #__news.group LIKE '%i:".$user->get_property('gid').";%' or #__news.group LIKE '%a:1:{i:0;i:0;}%')";
        endif;

        /* სტატიები რომელ რუბრიკებზეც მონიშნულია მომხმარებელი */
        if($user->get_property('gid') == 21): $sql_gid = ' && #__category.users LIKE "%\"'.$user->get_property('userID').'\"%"'; endif;
//---------------------------------------------
        $page	                = intval($_GET['page']);

        // Переменная хранит число сообщений выводимых на станице
        $num = 15;
        // Извлекаем из URL текущую страницу
        if ($page==0) $page=1;
        // Определяем общее число сообщений в базе данных
        $posts = $DB->getOne("SELECT count(`#__news`.`id`) FROM `#__news` LEFT JOIN #__category ON #__category.id=#__news.cat WHERE `#__news`.`id`>'0' and #__category.section='post' $sql_onmy $filter_p $sql_gid");
        //$postsmoder = $DB->getOne("SELECT count(`#__news`.`id`) FROM `#__news` LEFT JOIN #__category ON #__category.id=#__news.cat WHERE `moderate`='1' and `#__news`.`id`>'0' and #__category.section='post' $filter_p $sql_onmy");
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
        $link_url='index.php?news=1&';
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

        $all = $DB->getAll('SELECT * FROM #__category WHERE podcat=0 && section="post" && stat="0" '.$sql_gid.' order by name ASC');
        $i=0;
        foreach($all as $nu):
            $category[$nu['id']][0]=$nu;
            $i++;
        endforeach;

        $all = $DB->getAll('SELECT * FROM #__category WHERE podcat>0 && section="post" && stat="0" '.$sql_gid.' order by name ASC');
        $i=0;
        foreach($all as $nu):
            $category[$nu['podcat']][]=$nu;
            $i++;
        endforeach;

        $all = $DB->getAll("SELECT #__news.*, #__category.name, #__category.podcat,#__category.cat_chpu,#__users.realname
			FROM #__news LEFT JOIN #__category ON #__category.id=#__news.cat
			LEFT JOIN #__users ON #__users.id=#__news.user
			WHERE #__news.id>0 and (#__category.section='post' or #__news.cat=0) $sql_onmy $filter_p $sql_gid
			ORDER BY `#__news`.`time` DESC LIMIT $start, $num");
        $groups = $DB->getAll('SELECT `#__group`.* FROM `#__group` ORDER BY id DESC');
    endif;
//end

endif;

if(get_access('admin','article','del',false)):
   if(isset($_GET['del']) > 0){
       $del_id = intval($_GET['del']);
       if($registry['onmy']==1)$sql_onmy="and news.user = '".$user->get_property('userID')."'";
       $title = $DB->getOne("SELECT title FROM #__news WHERE id='{$del_id}'");
       $DB->execute("UPDATE #__news SET moderate=10 WHERE id='{$del_id}'  {$sql_onmy}");

       $LOG->saveLog($user->get_property('userID'),'სტატია: ჩანაწერის წაშლა / ID: '.intval($del_id).' TITLE: '.replace_quotes($title));
       header("location:/apanel/index.php?news=1");
   }
   if($_GET['cache'] == 'clear'){
       $files = glob('../cache/{,.}*', GLOB_BRACE);
       foreach($files as $file){ // iterate files
           if(is_file($file))
               unlink($file); // delete file
       }
       $files = glob('../cache/news/{,.}*', GLOB_BRACE);
       foreach($files as $file){ // iterate files
           if(is_file($file))
               unlink($file); // delete file
       }
       $files = glob('../cache/popular/{,.}*', GLOB_BRACE);
       foreach($files as $file){ // iterate files
           if(is_file($file))
               unlink($file); // delete file
       }
       $files = glob('../cache/contest/{,.}*', GLOB_BRACE);
       foreach($files as $file){ // iterate files
           if(is_file($file))
               unlink($file); // delete file
       }
       $files = glob('../cache/banners/{,.}*', GLOB_BRACE);
       foreach($files as $file){ // iterate files
           if(is_file($file))
               unlink($file); // delete file
       }
       function rrmdir($dir) {
           if (is_dir($dir)) {
               $objects = scandir($dir);
               foreach ($objects as $object) {
                   if ($object != "." && $object != ".." && $object!=date('Y-m-d')) {
                       if (filetype($dir."/".$object) == "dir")
                           rrmdir($dir."/".$object);
                       else unlink   ($dir."/".$object);
                   }
               }
               reset($objects);
               rmdir($dir);
           }
       }
       rrmdir('../cache/ip');

       header('location:/apanel/index.php?component=bade');
   }
endif;
}else{
    if($user->get_property('gid') == 20){
        header('location:/apanel/index.php?component=organizer');
    }else{
        header('location:/apanel/index.php?component=bade');
    }

}


