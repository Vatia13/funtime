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
$time = time();
$all = $DB->getAll('SELECT * FROM #__category WHERE podcat=0 and section="post" and stat="0" order by name asc');
$i=0;
$items[] = 1;
$items[] = 2;
$items[] = 3;
$items[] = 4;
if(count($all) > 0){
foreach($all as $nu):
    $category[$nu['id']][0]=$nu;
    $items[] = $nu['id'];
    $i++;
endforeach;

}

$DB->execute("UPDATE #__banner_list SET #__banner_list.type='2' WHERE #__banner_list.status > '0' and UNIX_TIMESTAMP(finished_at) < {$time} and UNIX_TIMESTAMP(published_at) > 0");

$fifteen = time() + 3600 * 24 * 15;
$registry['last_banners_count']=$DB->getOne("SELECT count(id) FROM #__banner_list WHERE type='1' and status='2' and UNIX_TIMESTAMP(finished_at) <= $fifteen and UNIX_TIMESTAMP(published_at) > 0");

if(!$_GET['section'] && $_GET['ban'] == 'all'){

    //---------------------------------------------
    if(intval($_GET['cat']) > 0){
        $sql_cat = " and `#__banner_list`.`cat_id`='".intval($_GET['cat'])."'";
        $cache = $_GET['cat'];
    }else{
        $sql_cat = '';
        $cache = '';
    }
    if(isset($_GET['status'])){
        if(!empty($_GET['status'])){
            if($_GET['status'] < 2){
                $sql_status = " and `#__banner_list`.`status`<'2'";
            }else{
                $sql_status = " and `#__banner_list`.`status`='2'";
            }
        }
    }

    if(isset($_GET['from'])){
        $published_at = PHP_slashes(htmlspecialchars(strip_tags($_GET['from'])));
        $published_at = dateFormat($published_at,'d/m/Y');
    }
    if(isset($_GET['to'])){
        $finished_at = PHP_slashes(htmlspecialchars(strip_tags($_GET['to'])));
        $finished_at =dateFormat($finished_at,'d/m/Y');
    }

    if(isset($_GET['company'])){
        if(!empty($_GET['company'])){
           $sql_comp = " and company LIKE '%".PHP_slashes(htmlspecialchars(strip_tags($_GET['company'])))."%' ";
        }
    }
    if(!empty($_GET['person'])){
        $person = PHP_slashes(htmlspecialchars(strip_tags($_GET['person'])));
        $sql_person = " and info LIKE '%".$person."%'";
    }

    $sql_date = '';
    if(!empty($published_at) or !empty($finished_at)){
        if(empty($finished_at)){
            $finished_at = $time + 24 * 3600 * 700;
        }

        if(empty($published_at)){
            $published_at = $time;
        }

        if(strtotime($finished_at) > $time):
        $sql_date = " and ((UNIX_TIMESTAMP(`#__banner_list`.`published_at`) between ".strtotime($published_at)." AND ".strtotime($finished_at).") or (UNIX_TIMESTAMP(`#__banner_list`.`finished_at`) between ".strtotime($published_at)." AND ".strtotime($finished_at)."))";
        endif;

    }else{
        $sql_date = " and (UNIX_TIMESTAMP(`#__banner_list`.`finished_at`) > {$time} or `#__banner_list`.`finished_at` = `#__banner_list`.`published_at`)";

    }




    //---------------------------------------------
    $page	                = intval($_GET['page']);

    // Переменная хранит число сообщений выводимых на станице
    $num = 15;
    // Извлекаем из URL текущую страницу
    if ($page==0) $page=1;
    // Определяем общее число сообщений в базе данных
    $posts = $DB->getOne("SELECT count(`#__banner_list`.`id`) FROM `#__banner_list` WHERE `#__banner_list`.`type`<>'2' {$sql_date} {$sql_cat} {$sql_status} {$sql_comp}");
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
    $link_url = '/apanel/index.php?component=banner&ban=all';

    if($_GET['cat'] > 0){
        $link_url = $link_url . '&cat='.$_GET['cat'];
    }
    if($_GET['status'] > 0){
        $link_url = $link_url . '&status='.$_GET['status'];
    }
    if($_GET['company'] > 0){
        $link_url = $link_url . '&company='.$_GET['company'];
    }
    if(!empty($_GET['from'])){
        $link_url = $link_url . '&from='.$_GET['from'];
    }
    if(!empty($_GET['to'])){
        $link_url = $link_url . '&to='.$_GET['to'];
    }

    $link_url = $link_url . '&';
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


    $registry['banners'] = $DB->getAll("SELECT #__banner_list.*,#__category.name FROM #__banner_list
                                       LEFT JOIN #__category ON #__category.id=#__banner_list.cat_id WHERE `#__banner_list`.`type`<>'2' {$sql_date} {$sql_cat} {$sql_status} {$sql_comp} {$sql_person}
                                       order by #__banner_list.status,#__category.name ASC LIMIT $start,$num");

   // if(!$_GET['status'] and !$_GET['cat']){
    $registry['free'] = $DB->getAll("SELECT cat_id,title,size_x,size_y FROM #__banner_place");
    $free_places = array();
    $reload = 0;


    if(count($registry['free']) > 0){
        if(empty($published_at) or empty($finished_at)){
            $check_del = $DB->getOne("SELECT count(id) FROM #__banner_list WHERE #__banner_list.type='0' and UNIX_TIMESTAMP(#__banner_list.finished_at) > {$time}");

            if($check_del > 0){
                if($DB->execute("DELETE FROM #__banner_list WHERE #__banner_list.type='0' and UNIX_TIMESTAMP(#__banner_list.finished_at) > {$time}")){
                    $reload = 1;
                }
            }
        }
        if(empty($published_at)){
            $published_at = date('Y-m-d H:i:s');
        }
        if(empty($finished_at)){
            $finished_at = date('Y-m-d H:i:s');
        }
        if(strtotime($finished_at) >= ($time-3600)):
            foreach($registry['free'] as $item):
                $registry['fr']['cat_title'][] = $item['cat_id'].'-'.$item['title'];
                $registry['fr']['cat_id'][] = $item['cat_id'];
                $registry['fr']['title'][] = $item['title'];
                $registry['fr']['size_x'][] = $item['size_x'];
                $registry['fr']['size_y'][] = $item['size_y'];
                if($check <= 0):
                endif;
            endforeach;
            $check = $DB->getAll("SELECT CONCAT_WS('-',cat_id,title) as cat_title FROM #__banner_list WHERE CONCAT_WS('-',cat_id,title) IN ('".join("','",$registry['fr']['cat_title'])."') and #__banner_list.type <> '2' {$sql_date}");
            if(count($check) > 0){
                foreach($check as $c){
                    $registry['check'][] = $c['cat_title'];
                }
                if(count($registry['fr']['cat_title']) > 0){
                    foreach($registry['fr']['cat_title'] as $key=>$f){
                        if(!in_array($f,$registry['check'])){
                            $reload = 1;
                            $DB->execute("INSERT INTO #__banner_list (cat_id,title,size_x,size_y,type,published_at,finished_at) VALUES ('".$registry['fr']['cat_id'][$key]."','".$registry['fr']['title'][$key]."','".$registry['fr']['size_x'][$key]."','".$registry['fr']['size_y'][$key]."','0','$published_at','$finished_at')");
                        }
                    }
                }
            }
            if($reload == true){
                header('location:http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]); exit();
            }
        endif;
    }

   // }








}

if(!$_GET['section'] && !$_GET['cat'] && count($items) > 0){
    $registry['count_places'] = $DB->getAll('SELECT cat_id FROM #__banner_place WHERE cat_id IN ('.join(',',$items).')');
    foreach($registry['count_places'] as $t){
        $cats[] = $t['cat_id'];
    }
    if(count($cats) > 0){
    $banner_sum = array_count_values($cats);
    }
    $time = time();
    $registry['free_places'] = $DB->getAll('SELECT cat_id FROM #__banner_list WHERE type="1" and status<>"1" and UNIX_TIMESTAMP(finished_at) > '.$time.' and cat_id IN ('.join(',',$items).') GROUP BY title,cat_id');

    $free = array();
    if(count($registry['free_places']) > 0){
        foreach($registry['free_places'] as $t){
            $free[$t['cat_id']][] = $t['cat_id'];
        }
        if(count($free)>0){
        foreach($registry['free_places'] as $t){
            $left[$t['cat_id']] = array_count_values($free[$t['cat_id']]);
        }
        }
    }


    $registry['busy_places'] = $DB->getAll('SELECT cat_id FROM #__banner_list WHERE type="1" and status="2" and UNIX_TIMESTAMP(finished_at) > '.$time.' and cat_id IN ('.join(',',$items).') GROUP BY title,cat_id');

    $busy = array();
    $bleft = array();
    if(count($registry['busy_places']) > 0){
        foreach($registry['busy_places'] as $t){
            $busy[$t['cat_id']][] = $t['cat_id'];
        }
        if(count($busy)>0){
            foreach($registry['busy_places'] as $t){
                $bleft[$t['cat_id']] = array_count_values($busy[$t['cat_id']]);
            }
        }
    }

    $registry['gift_places'] = $DB->getAll('SELECT cat_id FROM #__banner_list WHERE type="1" and status="1" and UNIX_TIMESTAMP(finished_at) > '.$time.' and cat_id IN ('.join(',',$items).') GROUP BY title,cat_id');

    $gift = array();
    $gleft = array();
    if(count($registry['gift_places']) > 0){
        foreach($registry['gift_places'] as $t){
            $gift[$t['cat_id']][] = $t['cat_id'];
        }
        if(count($gift)>0){
            foreach($registry['gift_places'] as $t){
                $gleft[$t['cat_id']] = array_count_values($gift[$t['cat_id']]);
            }
        }
    }


}

if($_GET['section'] == 'addplace'){
    if($_POST['add']){
        $info = array();
        if($_POST['cat'] > 0){
        if(count($_POST['title']) > 0){
            $i=0;foreach($_POST['title'] as $item):$i++;
                $title = PHP_slashes(htmlspecialchars(strip_tags($item)));
                $sizex = intval($_POST['sizex'][$i]);
                $sizey = intval($_POST['sizey'][$i]);
                $cat = intval($_POST['cat']);
                $info[$i]['title'] = $title;
                $info[$i]['size_x'] = $sizex;
                $info[$i]['size_y'] = $sizey;
                $info[$i]['cat_id'] = $cat;
                if(empty($title)){
                    $message[$i] = 'ჩაწერეთ #'.$i.' საბანერო ადგილის დასახელება მაგ:F'.$i.'<br>';
                }
                //$DB->execute('INSERT INTO #__banner_place (cat_id,title,size_x,size_y,type) VALUES ("'.$cat.'","'.$title.'","'.$sizex.'","'.$sizey.'","0")');
            endforeach;
            if(count($message) > 0){
                $message[0] = 'error';
            }else{
                foreach($info as $item):
                    $DB->execute('INSERT INTO #__banner_place (cat_id,title,size_x,size_y) VALUES ("'.$item['cat_id'].'","'.$item['title'].'","'.$item['size_x'].'","'.$item['size_y'].'")');
                endforeach;
                header('location:/apanel/index.php?component=banner&message[0]=valid&message[1]=საბანერო ადგილი წარმატებით დაემატა');
            }

        }else{
            $message[0] = 'error';
            $message[1] = 'აუცილებელია აირჩიოთ ბანერების რაოდენობა';
        }
        }else{
            $message[0] = 'error';
            $message[1] = 'აუცილებელია აირჩიოთ რუბრიკა.';
        }
    }



    //---------------------------------------------
    $page	                = intval($_GET['page']);

    // Переменная хранит число сообщений выводимых на станице
    $num = 15;
    // Извлекаем из URL текущую страницу
    if ($page==0) $page=1;
    // Определяем общее число сообщений в базе данных
    $posts = $DB->getOne("SELECT count(`#__banner_place`.`id`) FROM `#__banner_place`");
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
    $link_url='/apanel/index.php?component=banner&section=addplace&';
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

    $registry['banners'] = $DB->getAll("SELECT #__banner_place.id,#__banner_place.cat_id,#__banner_place.title,#__banner_place.size_x,#__banner_place.size_y,#__category.name FROM #__banner_place
                                       LEFT JOIN #__category ON #__category.id=#__banner_place.cat_id WHERE 1 order by #__category.name DESC LIMIT $start,$num");

}

if($_GET['section'] == 'editplace'){


    if(isset($_GET['edit']) && intval($_GET['edit']) > 0){
    $registry['banner'] = $DB->getAll("SELECT #__banner_place.id,#__banner_place.cat_id,#__banner_place.title,#__banner_place.size_x,#__banner_place.size_y FROM #__banner_place WHERE #__banner_place.id='".intval($_GET['edit'])."' LIMIT 1");

        if($_POST['save']){
            $info = array();
            if(intval($_POST['cat']) > 0){
                if(!empty($_POST['title'])){
                    $sizex = (intval($_POST['size_x']) > 0) ? ',size_x='.intval($_POST['size_x']) : '';
                    $sizey = (intval($_POST['size_y']) > 0) ? ',size_y='.intval($_POST['size_y']) : '';
                    if($DB->execute("UPDATE #__banner_place SET cat_id='".intval($_POST['cat'])."',title='".PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])))."' $sizex $sizey WHERE id='".intval($_GET['edit'])."'")){
                        header('location:/apanel/index.php?component=banner&message[0]=valid&message[1]=საბანერო ადგილის რედაქტირება წარმატებით დასრულდა');
                    }else{
                        header('location:/apanel/index.php?component=banner&message[0]=error&message[1]=შეცდომა ვერ ხერხდება საბანერო ადგილის რედაქტირება');
                    }
                }else{
                    $message[0] = 'error';
                    $message[1] = 'ჩაწერეთ #F1 საბანერო ადგილის დასახელება მაგ:F1';
                }
            }else{
                $message[0] = 'error';
                $message[1] = 'გთხოვთ აირჩიოთ რუბრიკა';
            }
        }

    }


}

if(get_access('admin','banners','edit',false)):
    if(intval($_GET['del']) > 0){
        $title = $DB->getOne("SELECT title FROM #__banner_list WHERE id='".intval($_GET['del'])."'");
        $DB->execute("DELETE FROM #__banner_list WHERE id='".intval($_GET['del'])."'");
        $LOG->saveLog($user->get_property('userID'),'საბანერო პოზიციის წაშლა / ID: '.intval($_GET['del']).' TITLE: '.$title);
        header('location:/apanel/index.php?component=banner&message[0]=valid&message[1]=ბანერი წარმატებით წაიშალა.');
    }

    if(intval($_GET['place']) > 0){
        $title = $DB->getOne("SELECT title FROM #__banner_place WHERE id='".intval($_GET['place'])."'");
        $DB->execute("DELETE FROM #__banner_place WHERE id='".intval($_GET['place'])."'");
        $LOG->saveLog($user->get_property('userID'),'საბანერო პოზიციის წაშლა / ID: '.intval($_GET['place']).' TITLE: '.$title);
        header('location:/apanel/index.php?component=banner&section=addplace&message[0]=valid&message[1]=საბანერო პოზიცია წარმატებით წაიშალა.');
    }
endif;

if($_GET['section'] == 'add' or $_GET['section'] == 'edit'){
    if($_GET['section'] == 'edit'){
        if($_GET['edit'] > 0){

            $registry['banner'] = $DB->getAll("SELECT * FROM #__banner_list WHERE id='".intval($_GET['edit'])."' ");
            if(isset($_SERVER['HTTP_REFERER'])){
                $url = parse_url($_SERVER['HTTP_REFERER']);

                if(strpos($url['query'],'component=organizer') !== false){
                    $registry['count_orders'] = $DB->getOne("SELECT count(id) FROM #__banner_orders WHERE cat_id='".$registry['banner'][0]['cat_id']."' and title='".$registry['banner'][0]['title']."' and status='0'");

                }
            }
        }
    }else{
        $edit_sql = '';
    }
    $registry['company'] = $DB->getAll("SELECT company,info FROM #__banner_list WHERE type<>'0' GROUP BY company ASC");

    if(isset($_POST['add']) or isset($_POST['edit'])){
        $company = PHP_slashes(htmlspecialchars(strip_tags($_POST['company'])));
        $cat = intval($_POST['cat']);
        $info = serialize($_POST['info']);
        $status = intval($_POST['status']);
        $title = PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])));
        $published_at = PHP_slashes(htmlspecialchars(strip_tags($_POST['published_at'])));
        $finished_at = PHP_slashes(htmlspecialchars(strip_tags($_POST['finished_at'])));
        $published_at = dateFormat($published_at,'d/m/Y');
        $finished_at =dateFormat($finished_at,'d/m/Y');
        $size_x = intval($_POST['size_x']);
        $size_y = intval($_POST['size_y']);
        if(isset($_POST['type'])){
            if($_POST['type'] > 0){
                $type = intval($_POST['type']);
            }
        }else{
            $type = 1;
        }
         $validator = validator(['company','cat','info|person','info|phone','status','published_at','finished_at'],['კომპანიის დასახელება','რუბრიკის დასახელება','საკონტაქტო პირი','ტელეფონის ნომერი','უფასო / ფასიანი','ბანერის განთავსების ვადა (დან)','ბანერის განთავსების ვადა (მდე)']);
        if(count($validator) <= 0){
            if(strtotime($published_at) < strtotime($finished_at)){
            if($_POST['add']):
                $DB->execute("DELETE FROM #__banner_list WHERE status<'2' and cat_id='$cat' AND title='$title' AND (published_at BETWEEN '$published_at' AND '$finished_at' or finished_at BETWEEN '$published_at' AND '$finished_at' or published_at = finished_at or finished_at='$finished_at' or published_at='$published_at')");
                $dates = $DB->getRow("SELECT published_at,finished_at FROM #__banner_list WHERE status<>'1' AND type<>'2' and cat_id='$cat' AND title='$title' AND (published_at BETWEEN '$published_at' AND '$finished_at' or finished_at BETWEEN '$published_at' AND '$finished_at')");
                if(!$dates){
                    if($DB->execute("INSERT INTO #__banner_list (cat_id,title,company,size_x,size_y,type,info,status,published_at,finished_at) VALUES ('$cat','$title','$company','$size_x','$size_y','$type','$info','$status','$published_at','$finished_at')")){
                        header('location:/apanel/index.php?component=banner&message[0]=valid&message[1]=ოპერაცია წარმატებით დასრულდა');
                    }else{
                        echo 'nono';
                    }
                }else{
                    $message[0] = 'error';
                    $message[1] = 'საბანერო ადგილი ამ თარიღით უკვე დაკავებულია. '.date('Y-m-d',strtotime($dates['published_at'])).' დან / '.date('Y-m-d',strtotime($dates['finished_at'])).' მდე';
                }
            endif;
            if($_POST['edit']):
                $dates = $DB->getRow("SELECT published_at,finished_at FROM #__banner_list WHERE id <> '".intval($_GET['edit'])."' and status<>'1' AND type<>'2' and cat_id='$cat' AND title='$title' AND (published_at BETWEEN '$published_at' AND '$finished_at' or finished_at BETWEEN '$published_at' AND '$finished_at')");
                if(!$dates) {
                    if ($DB->execute("UPDATE #__banner_list SET cat_id='$cat',title='$title',company='$company',size_x='$size_x',size_y='$size_y',info='$info',status='$status',published_at='$published_at',finished_at='$finished_at' WHERE id='" . intval($_GET['edit']) . "'")) {
                        header('location:/apanel/index.php?component=banner&message[0]=valid&message[1]=ოპერაცია წარმატებით დასრულდა');
                    } else {
                        echo 'nono';
                    }
                }else{
                    $message[0] = 'error';
                    $message[1] = 'საბანერო ადგილი ამ თარიღით უკვე დაკავებულია. '.date('Y-m-d',strtotime($dates['published_at'])).' დან / '.date('Y-m-d',strtotime($dates['finished_at'])).' მდე';
                }
            endif;
            }else{
                $message[0] = 'error';
                $message[1] = 'ბანერის განთავსების ვადა არასწორია!';
            }
        }else{
            $message[0] = 'error';
        }
    }

}

if($_GET['section'] == 'ajax'){
    if($_POST['action'] == 'get_positions'){
        $time = time();
        if(isset($_POST['edit']) && $_POST['edit']==1){
            $edit_sql = " title='".PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])))."')";
        }
        $last_options = array();
        $positions = $DB->getAll("SELECT title,id,finished_at FROM #__banner_place WHERE cat_id='".intval($_POST['id'])."' GROUP by title order by title ASC");
        if(count($positions) > 0){
            foreach($positions as $item):

                 $new_options[$item['title']]['title'] = $item['title'];
                 $new_options[$item['title']]['id'] = $item['id'];

            endforeach;

            $i=0;foreach($new_options as $item){
                $last_options[$i]['title'] = $item['title'];
                $last_options[$i]['id'] = $item['id'];
                $i++;
            }
        }
        echo json_encode($last_options);
        die();
    }

    if($_POST['action'] == 'get_size'){
        $size = $DB->getAll("SELECT size_x,size_y FROM #__banner_place WHERE id='".intval($_POST['id'])."'");
        echo json_encode($size);
        die();
    }


    if($_POST['action'] == 'last_banners'){
        $fifteen = time() + 3600 * 24 * 15;
        $registry['last_banners']=$DB->getAll("SELECT #__banner_list.*,#__category.name FROM #__banner_list  LEFT JOIN #__category ON #__category.id=#__banner_list.cat_id WHERE #__banner_list.type='1' and #__banner_list.status='2' and UNIX_TIMESTAMP(finished_at) <= $fifteen and UNIX_TIMESTAMP(published_at) > 0 ORDER BY finished_at ASC");
        if(count($registry['last_banners']) > 0){

            $output .='<table id="rounded-corner">
                <thead>
                <tr>
                    <th scope="col" class="rounded">კომპანიის დასახელება</th>
                    <th scope="col" class="rounded">ბანერის დასახელება</th>
                    <th scope="col" class="rounded">პოზიცია</th>
                    <th scope="col" class="rounded">ზომა</th>
                    <th scope="col" class="rounded">კატეგორია</th>
                    <th scope="col" class="rounded">ჩართვის თარიღი</th>
                    <th scope="col" class="rounded">გამორთვის თარიღი</th>
                </tr>
                </thead>
                <tbody>';
            foreach($registry['last_banners'] as $item): $info = unserialize($item['info']);
                $output .='<tr class="table_green">
                            <td>'.$item["company"].'</td>
                            <td>'.$info["banner"].'</td>
                            <td>'.$item['title'].'</td>
                            <td>'.$item['size_x'].'X'.$item['size_y'].'</td>';
                if($item['cat_id'] == 1):
                    $name = 'პირველი გვერდი';
                elseif($item['cat_id']==2):
                    $name ='ტესტები';
                else:
                    $name = $item['name'];
                endif;
                $output .='<td>'.$name.'</td>
                            <td>'.date('Y-m-d',strtotime($item['published_at'])).'</td>
                            <td>'.date('Y-m-d',strtotime($item['finished_at'])).'</td>
                        </tr>';
            endforeach;
            $output .='</tbody></table>';

            echo $output;

        }else{
            echo 0;
        }
        die();
    }

    if($_POST['action'] == 'banner_added'){
        if($DB->execute("INSERT INTO #__banners_added (banner_id,news_id) VALUES ('".intval($_POST['id'])."','".intval($_POST['news'])."')")){
            if($_POST['length'] <= 1){
               $DB->execute("UPDATE #__news SET banner='1' WHERE id='".intval($_POST['news'])."'");
            }
            echo 1;
            die();
        }
    }

    if($_POST['action'] == 'no_banners'){
        $DB->execute("UPDATE #__news SET banner='1' WHERE id='".intval($_POST['news'])."' and banner<>'1'");
        die();
    }

    if($_POST['action'] == 'yes_banners'){
        $DB->execute("UPDATE #__news SET banner='0' WHERE id='".intval($_POST['news'])."' and banner<>'0'");
        die();
    }
}



