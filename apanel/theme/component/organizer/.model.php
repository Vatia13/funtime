<?php defined('_JEXEC') or die('Restricted access');
$all = $DB->getAll('SELECT * FROM #__category WHERE podcat=0 and section="post" and stat="0" order by name asc');
$i=0;
$items[] = 1;
$items[] = 2;
if(count($all) > 0){
    foreach($all as $nu):
        $category[$nu['id']][0]=$nu;
        $items[] = $nu['id'];
        $i++;
    endforeach;

}
$fifteen = time() + 3600 * 24 * 15;
$registry['last_banners_count']=$DB->getOne("SELECT count(id) FROM #__banner_list WHERE type='1' and status='2' and UNIX_TIMESTAMP(finished_at) <= $fifteen and UNIX_TIMESTAMP(published_at) > 0");
$time = time();
$time_before = $time - (3600 * (date('H') + 1));
if(!$_GET['section'] or $_GET['section'] == 'other'){
    $sql_search = '';

    if(intval($_GET['cat']) > 0){
        $sql_search .= " and cat_id='".intval($_GET['cat'])."'";
    }

    if(isset($_GET['company'])){
        if(!empty($_GET['company'])){
            $sql_search .= " and company LIKE '%".PHP_slashes(htmlspecialchars(strip_tags($_GET['company'])))."%' ";
        }
    }

    if(!empty($_GET['person'])){
        $person = PHP_slashes(htmlspecialchars(strip_tags($_GET['person'])));
        $sql_search .= " and info LIKE '%".$person."%'";
    }

    if(!empty($_GET['from']) or !empty($_GET['to'])){
        if(!empty($_GET['from'])){
            $from = dateFormat($_GET['from'],'d/m/Y');
        }else{
            $from = date('Y').'-'.date('m').'-1 00:00:00';
        }

        if(!empty($_GET['to'])){
            $to = dateFormat($_GET['to'],'d/m/Y');
        }else{
            $to = date('Y-m-d H:i:s',(time() + 3600 * 24 * 30 * 12));
        }

        $sql_search .= " and (UNIX_TIMESTAMP(contact_at) BETWEEN ".strtotime($from)." AND ".strtotime($to).")";
    }

    if(empty($from) and empty($to)){
        $future_date = " and UNIX_TIMESTAMP(contact_at) >= {$time_before}";
    }else{
        $future_date = "";
    }


    if(isset($_GET['status'])){
        if(intval($_GET['status']) > 0){
            $sql_search .= " and status='".intval($_GET['status'])."'";
        }else{


            $sql_search .= " and status='0' {$future_date}";
        }
    }else{
        $sql_search .= " and status='0' {$future_date}";
    }




    //---------------------------------------------
    $page	                = intval($_GET['page']);

    // Переменная хранит число сообщений выводимых на станице
    $num = 15;
    // Извлекаем из URL текущую страницу
    if ($page==0) $page=1;
    // Определяем общее число сообщений в базе данных
    $posts = $DB->getOne("SELECT count(`#__banner_orders`.`id`) FROM `#__banner_orders` WHERE 1 {$sql_search}");
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
    // Проверяем нужны ли стрелки назад
    $link_url = '/apanel/index.php?component=organizer';

    if($_GET['cat'] > 0){
        $link_url = $link_url . '&cat='.$_GET['cat'];
    }

    if($_GET['company'] > 0){
        $link_url = $link_url . '&company='.$_GET['company'];
    }
    if(!empty($_GET['person'])){
        $link_url = $link_url . '&person='.$_GET['person'];
    }

    if(!empty($_GET['from'])){
        $link_url = $link_url . '&from='.$_GET['from'];
    }

    if(!empty($_GET['to'])){
        $link_url = $link_url . '&to='.$_GET['to'];
    }

    if($_GET['status'] > 0){
        $link_url = $link_url . '&status='.$_GET['status'];
    }
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

    $registry['banners'] = $DB->getAll("SELECT #__banner_orders.*,#__category.name FROM #__banner_orders
                                       LEFT JOIN #__category ON #__category.id=#__banner_orders.cat_id WHERE 1 {$sql_search} order by contact_at ASC LIMIT $start,$num");
}

if($_GET['section'] == 'addother' or $_GET['section'] == 'editother'){
    $registry['company'] = $DB->getAll("SELECT company,info FROM #__banner_orders WHERE 1 GROUP BY company ASC");
    if($_GET['section'] == 'editother'){
        if($_GET['edit'] > 0){
            $registry['banner'] = $DB->getAll("SELECT * FROM #__banner_orders WHERE id='".intval($_GET['edit'])."' ");
            if($_GET['answer'] == 1){
                if($DB->execute("UPDATE #__banner_orders SET status='1' WHERE id='".intval($_GET['edit'])."'")){
                    header('location:/apanel/index.php?component=organizer&section=other');
                }
            }
            if($_GET['answer'] == 2){
                if($DB->execute("UPDATE #__banner_orders SET status='2' WHERE id='".intval($_GET['edit'])."'")){
                    header('location:/apanel/index.php?component=organizer&section=other');
                }
            }
        }
    }

    if(isset($_POST['addother']) or isset($_POST['editother'])) {
        $company = PHP_slashes(htmlspecialchars(strip_tags($_POST['company'])));
        $cat = intval($_POST['cat']);
        $info = serialize($_POST['info']);
        $contact_at = PHP_slashes(htmlspecialchars(strip_tags($_POST['contact_at'])));
        $contact_at = dateFormat($contact_at, 'd/m/Y');
        $contact_at = date('Y-m-d',strtotime($contact_at)).' '.PHP_slashes(htmlspecialchars(strip_tags($_POST['hour']))).':'.PHP_slashes(htmlspecialchars(strip_tags($_POST['min'])));

        $desc = PHP_slashes(htmlspecialchars(strip_tags($_POST['description'])));
        $validator = validator(['company', 'info|person', 'info|phone', 'cat', 'description', 'contact_at'], ['კომპანიის დასახელება','საკონტაქტო პირი','ტელეფონის ნომერი','რუბრიკის დასახელება','შეთავაზების მოკლე აღწერა','დაკავშირების თარიღი']);
        if (count($validator) <= 0) {
            if($_POST['addother']) {
                if($DB->execute("INSERT INTO `#__banner_orders` (cat_id,description,company,info,contact_at,other) VALUES ('$cat','$desc','$company','$info','$contact_at','1')")){
                    header('location:/apanel/index.php?component=organizer&section=other&message[0]=valid&message[1]=ოპერაცია წარმატებით დასრულდა');
                }else{
                    echo 'nono';
                }
            }
            if($_POST['editother']){
                if($DB->execute("UPDATE #__banner_orders SET cat_id='$cat',description='$desc',company='$company',info='$info',contact_at='$contact_at' WHERE id='".intval($_GET['edit'])."'")){
                    header('location:/apanel/index.php?component=organizer&section=other&message[0]=valid&message[1]=ოპერაცია წარმატებით დასრულდა');
                }else{
                    echo 'nono';
                }

            }

        } else {
            $message[0] = 'error';
        }

    }

}

if($_GET['section'] == 'add' or $_GET['section'] == 'edit'){
    if($_GET['section'] == 'edit'){
        if($_GET['edit'] > 0){
            $registry['banner'] = $DB->getAll("SELECT * FROM #__banner_orders WHERE id='".intval($_GET['edit'])."' ");
            if($_GET['answer'] == 1){
                if($DB->execute("UPDATE #__banner_orders SET status='1' WHERE id='".intval($_GET['edit'])."'") && $DB->execute("INSERT INTO #__banner_list (cat_id,title,company,size_x,size_y,type,info,status) VALUES ('".$registry['banner'][0]['cat_id']."','".$registry['banner'][0]['title']."','".$registry['banner'][0]['company']."','".$registry['banner'][0]['size_x']."','".$registry['banner'][0]['size_y']."','1','".$registry['banner'][0]['info']."','2')")){
                    header('location:/apanel/index.php?component=banner&section=edit&edit='.$DB->id);
                }
            }
            if($_GET['answer'] == 2){
                if($DB->execute("UPDATE #__banner_orders SET status='2' WHERE id='".intval($_GET['edit'])."'")){
                    header('location:/apanel/index.php?component=organizer');
                }
            }
        }
    }
    $registry['company'] = $DB->getAll("SELECT company,info FROM #__banner_orders WHERE 1 GROUP BY company ASC");
    if(isset($_POST['add']) or isset($_POST['edit'])) {
        $company = PHP_slashes(htmlspecialchars(strip_tags($_POST['company'])));
        $cat = intval($_POST['cat']);
        $info = serialize($_POST['info']);
        $title = PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])));
        $contact_at = PHP_slashes(htmlspecialchars(strip_tags($_POST['contact_at'])));
        $contact_at = dateFormat($contact_at, 'd/m/Y');

        $size_x = intval($_POST['size_x']);
        $size_y = intval($_POST['size_y']);
        $desc = PHP_slashes(htmlspecialchars(strip_tags($_POST['description'])));
        $validator = validator(['company', 'info|person', 'info|phone', 'cat', 'title', 'contact_at'], ['კომპანიის დასახელება','საკონტაქტო პირი','ტელეფონის ნომერი','რუბრიკის დასახელება','საბანერო ადგილი','დაკავშირების თარიღი']);
        if (count($validator) <= 0) {
            if($_POST['add']) {
                if($_POST['info_num'] > 0){

                    $info_num = array();
                    $err = array(0,0,0);
                    for($i=1;$i<=$_POST['info_num'];$i++):
                        $info_num['cat'] = intval($_POST['cat_'.$i]);
                        $info_num['title'] = PHP_slashes(htmlspecialchars(strip_tags($_POST['title_'.$i])));
                        $info_num['contact_at'] = PHP_slashes(htmlspecialchars(strip_tags($_POST['contact_at_'.$i])));
                        $info_num['contact_at'] = dateFormat($info_num['contact_at'], 'd/m/Y');
                        $info_num['size_x'] = intval($_POST['size_x_'.$i]);
                        $info_num['size_y'] = intval($_POST['size_y_'.$i]);
                        $info_num['desc'] = PHP_slashes(htmlspecialchars(strip_tags($_POST['description_'.$i])));
                        $info_num['other'] = intval($_POST['other_'.$i]);
                        if($info_num['other'] > 0){
                            $validator = validator(['cat_'.$i,  'contact_at_'.$i], ['რუბრიკის დასახელება (ბლოკი '.($i+1).')','დაკავშირების თარიღი (ბლოკი '.($i+1).')']);
                            if (count($validator) <= 0) {
                                $DB->execute("INSERT INTO `#__banner_orders` (cat_id,description,company,info,contact_at,other) VALUES ('".$info_num['cat']."','".$info_num['desc']."','$company','$info','".$info_num['contact_at']."','1')");
                                $arr[$i] = 0;
                            }else{
                                $arr[$i] = 1;
                                $message[0] = 'error';
                                $message[1] = 'თქვენ გამოგრჩათ რუბრიკა, დაკავშირების თარიღი '.($i + 1).' ბლოკში (სხვა შეთავაზება)';
                            }
                        }else{
                            $validator = validator(['cat_'.$i, 'title_'.$i, 'contact_at_'.$i], ['რუბრიკის დასახელება (ბლოკი '.($i+1).')','საბანერო ადგილი (ბლოკი '.($i+1).')','დაკავშირების თარიღი (ბლოკი '.($i+1).')']);
                            if (count($validator) <= 0) {
                                $DB->execute("INSERT INTO `#__banner_orders` (cat_id,title,description,company,size_x,size_y,info,contact_at) VALUES ('".$info_num['cat']."','".$info_num['title']."','".$info_num['desc']."','$company','".$info_num['size_x']."','".$info_num['size_y']."','$info','".$info_num['contact_at']."')");
                                $arr[$i] = 0;
                            }else{
                                $arr[$i] = 1;
                                $message[0] = 'error';
                                $message[1] = 'თქვენ გამოგრჩათ რუბრიკა, პოზიცია ან დაკავშირების თარიღი '.($i + 1).' ბლოკში';
                            }
                        }
                    endfor;
                }
                if(!in_array(1,$arr)):
                    if($DB->execute("INSERT INTO `#__banner_orders` (cat_id,title,description,company,size_x,size_y,info,contact_at) VALUES ('$cat','$title','$desc','$company','$size_x','$size_y','$info','$contact_at')")){
                        header('location:/apanel/index.php?component=organizer&message[0]=valid&message[1]=ოპერაცია წარმატებით დასრულდა');
                    }else{
                        echo 'nono';
                    }
                endif;
            }
            if($_POST['edit']){
                if($DB->execute("UPDATE #__banner_orders SET cat_id='$cat',title='$title',description='$desc',company='$company',size_x='$size_x',size_y='$size_y',info='$info',contact_at='$contact_at' WHERE id='".intval($_GET['edit'])."'")){
                    header('location:/apanel/index.php?component=organizer&message[0]=valid&message[1]=ოპერაცია წარმატებით დასრულდა');
                }else{
                    echo 'nono';
                }

            }

        } else {
            $message[0] = 'error';
        }

    }



}




if(get_access('admin','banners','edit',false)):
    if(intval($_GET['del']) > 0){
        $title = $DB->getOne("SELECT title FROM #__banner_orders WHERE id='".intval($_GET['del'])."'");
        $DB->execute("DELETE FROM #__banner_orders WHERE id='".intval($_GET['del'])."'");
        $LOG->saveLog($user->get_property('userID'),'შეთავაზების წაშლა / ID: '.intval($_GET['del']).' TITLE: '.$title);
        header('location:/apanel/index.php?component=organizer&message[0]=valid&message[1]=შეთავაზება წარმატებით წაიშალა.');
    }
endif;