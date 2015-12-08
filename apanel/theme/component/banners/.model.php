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


    session_start();
if($_POST['submit']){
    if($_POST['banner_cat'] > 0){
        $_SESSION['banner_cat'] = ($_POST['banner_cat'] > 0) ? $_POST['banner_cat'] : $_SESSION['banner_cat'];
        $banner_sql = ' WHERE #__banners.cat_id='.intval($_SESSION['banner_cat']);
    }else{
        $_SESSION['banner_cat'] = 0;
        $banner_sql = ' WHERE 1';
    }
}
if($_SESSION['banner_cat'] > 0){
    $banner_sql = ' WHERE #__banners.cat_id='.intval($_SESSION['banner_cat']);
}


if($_GET['component'] == 'banners'){
    $page	                = intval($_GET['page']);

    // Переменная хранит число сообщений выводимых на станице
    $num = 15;
    // Извлекаем из URL текущую страницу
    if ($page==0) $page=1;
    // Определяем общее число сообщений в базе данных
    $posts = $DB->getOne("SELECT count(id) FROM #__banners $banner_sql");
    //$postsmoder = $DB->getOne("SELECT count(`#__news`.`id`) FROM `#__news` WHERE `moderate`='1' and `#__news`.`id`>'0' $filter_p $sql_onmy");
    //$registry['posts']=$posts;
    ///$registry['postsmoder']=$postsmoder;
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
    $link_url='index.php?component=banners';
    if ($page != 1) $pervpage = '<a href="'.$link_url.'&page=-1">პირველი...</a>
                                       <a href="'.$link_url.'&page='. ($page - 1).'">წინა...</a> ';
    if ($page != $total) $nextpage = '  <a href="'.$link_url.'&page='. ($page + 1).'">შემდეგი...</a>
                                           <a href="'.$link_url.'&page='.$total.'">ბოლო...</a> ';
    // Находим две ближайшие станицы с обоих краев, если они есть
    if($page - 2 > 0) $page2left = ' <a href="'.$link_url.'&page='. ($page - 2) .'">'. ($page - 2) .'</a>  ';
    if($page - 1 > 0) $page1left = '<a href="'.$link_url.'&page='. ($page - 1) .'">'. ($page - 1) .'</a>  ';
    if($page + 2 <= $total) $page2right = '  <a href="'.$link_url.'&page='. ($page + 2).'">'. ($page + 2) .'</a>';
    if($page + 1 <= $total) $page1right = '  <a href="'.$link_url.'&page='. ($page + 1).'">'. ($page + 1) .'</a>';
    $registry['banners'] = $DB->getAll("SELECT #__banners.* FROM #__banners $banner_sql ORDER BY date DESC LIMIT $start,$num");
    //---------------------------------------------
}



if($_GET['edit'] > 0 && $_GET['section'] == 'edit'){
    $id = intval($_GET['edit']);
    $registry['banner'] = $DB->getAll("SELECT #__banners.* FROM #__banners WHERE #__banners.id='".$id."'");

    if($_POST['edit'] == 1){

        $style = intval($_POST['style']);
        if(isset($_POST['date']) && !empty($_POST['date'])){
            $dt = explode('/',$_POST['date']);
            if(count($dt) > 0){
                $finished_at = mktime(0,0,0,$dt[1],$dt[0],$dt[2]);
            }
        }

        if(isset($_POST['published_at']) && !empty($_POST['published_at'])){
            $dt = explode('/',$_POST['published_at']);
            if(count($dt) > 0){
                $published_at = mktime(0,0,0,$dt[1],$dt[0],$dt[2]);
            }
        }
        $url = PHP_slashes(htmlspecialchars(strip_tags($_POST['url'])));
        $banner = PHP_slashes(htmlspecialchars(strip_tags($_POST['banner'])));
        $name = PHP_slashes(htmlspecialchars(strip_tags($_POST['name'])));
        $filter_cat = intval($_POST['filter-cat']);
        $title = PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])));
        $script = (!empty($_POST['script'])) ? base64_encode($_POST['script']) : '';
       // $image_dir = PHP_slashes(htmlspecialchars(strip_tags($_POST['image_dir'])));

        $id = intval($_POST['id']);
        if(!empty($filter_cat)) {
            if (!empty($name)) {
                $banner_info = explode('|',$name);
                $banner_size = explode('x',$banner_info[1]);
                if(!empty($_POST['published_at']) && !empty($_POST['date'])){
                    if($published_at < $finished_at) {
                        if (!empty($banner)) {
                            $DB->execute("UPDATE #__banners SET date='{$finished_at}',published_at='{$published_at}',url='{$url}',banner='{$banner}',script='{$script}',cat_id='{$filter_cat}',position='{$title}',name='{$banner_info[0]}',width='{$banner_size[0]}',height='{$banner_size[1]}' WHERE id='{$id}' ");
                            clear_cache();
                            header('location:/apanel/index.php?component=banners&section=edit&edit='.$id.'&message=1');
                        } else {
                            $message[0] = "error";
                            $message[1] = "გთხოვთ აირჩიოთ ბანერი ან ჩაწეროთ ბმული.";
                        }
                    }else{
                        $message[0] = "error";
                        $message[1] = "შეცდომა:გამორთვის თარიღი ნაკლებია ჩართვის თარიღზე.";
                    }
                }else{
                    $message[0] = "error";
                    $message[1] = "აირჩიეთ ჩართვის/გამორთვის თარიღი.";
                }
            }else{
                $message[0] = "error";
                $message[1] = "აუცილებელია აირჩიოთ პოზიცია.";
            }
        }else{
            $message[0] = "error";
            $message[1] = "აუცილებელია რუბრიკის არჩევა.";
        }
    }

}

if($_POST['add'] == 1){

    $style = intval($_POST['style']);

    if(isset($_POST['date']) && !empty($_POST['date'])){
        $dt = explode('/',$_POST['date']);
        if(count($dt) > 0){
            $finished_at = mktime(0,0,0,$dt[1],$dt[0],$dt[2]);
        }
    }

    if(isset($_POST['published_at']) && !empty($_POST['published_at'])){
        $dt = explode('/',$_POST['published_at']);
        if(count($dt) > 0){
            $published_at = mktime(0,0,0,$dt[1],$dt[0],$dt[2]);
        }
    }



    $url = PHP_slashes(htmlspecialchars(strip_tags($_POST['url'])));
    $banner = PHP_slashes(htmlspecialchars(strip_tags($_POST['banner'])));
    $name = PHP_slashes(htmlspecialchars(strip_tags($_POST['name'])));
    $filter_cat = intval($_POST['filter-cat']);
    $title = PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])));
    $script = (!empty($_POST['script'])) ? trim(base64_encode($_POST['script'])) : '';
    //$image_dir = PHP_slashes(htmlspecialchars(strip_tags($_POST['image_dir'])));
    if(!empty($filter_cat)){
        if(!empty($name)){
            $banner_info = explode('|',$name);
            $banner_size = explode('x',$banner_info[1]);
            if(!empty($_POST['published_at']) && !empty($_POST['date'])){
                if($published_at < $finished_at){
                    if(!empty($banner)){
                        if($DB->execute("INSERT INTO #__banners (date,published_at,name,url,cat_id,banner,width,height,position,script) VALUES ('$finished_at','$published_at','$banner_info[0]','$url','$filter_cat','$banner','$banner_size[0]','$banner_size[1]','$title','$script')")){
                            clear_cache();
                            header('location:/apanel/index.php?component=banners');
                        }
                    }else{
                        $message[0] = "error";
                        $message[1] = "გთხოვთ აირჩიოთ ბანერი ან ჩაწეროთ ბმული.";
                    }
                }else{
                    $message[0] = "error";
                    $message[1] = "შეცდომა:გამორთვის თარიღი ნაკლებია ჩართვის თარიღზე.";
                }
            }else{
                $message[0] = "error";
                $message[1] = "აირჩიეთ ჩართვის/გამორთვის თარიღი.";
            }
        }else{
            $message[0] = "error";
            $message[1] = "აუცილებელია აირჩიოთ პოზიცია.";
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