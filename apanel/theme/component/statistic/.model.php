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
if(isset($_POST['stat'])){
    if($_POST['stat'] == 'active'){
        $stat = '0';
    }else{
        $stat = '1';
    }
    setcookie('stat',$stat,time()+3600,'/');
}elseif($_COOKIE['stat']){
    if($_COOKIE['stat'] == 'active'){
        $stat = '0';
    }else{
        $stat = '1';
    }
}else{
    $stat = '0';
}

if($_POST['from'] or $_GET['from']){
    if(!empty($_POST['from'])){
        $from = PHP_slashes(htmlspecialchars(strip_tags($_POST['from'])));
    }else{
        $from = PHP_slashes(htmlspecialchars(strip_tags($_GET['from'])));
    }
    $from_url = '&from='.$from;
    $from = explode('/',$from);
    $from = $from[1].'-'.$from[0].'-'.$from[2];
    $from_explode = explode('-',$from);
    $from_extra = $from_explode[2].'-'.$from_explode[0].'-'.$from_explode[1];

    if(!empty($_POST['to']) or !empty($_GET['to'])){
        if(!empty($_POST['to'])){
            $to = PHP_slashes(htmlspecialchars(strip_tags($_POST['to'])));
        }else{
            $to = PHP_slashes(htmlspecialchars(strip_tags($_GET['to'])));
        }
        $to_url = '&to='.$to;
        $to = explode('/',$to);
        $to = $to[1].'-'.$to[0].'-'.$to[2];
        $to_explode = explode('-',$to);
        $to_extra = $to_explode[2].'-'.$to_explode[0].'-'.$to_explode[1];


    }else{
        $to = date('m/d/Y');
        $to_extra = date('Y-m-d');
        $to_url = '&to='.$to;
    }


}else{
     $from_extra = date('Y-m').'-01';
     $to_extra = date('Y-m-d');
}
$sql_filter_view = 'and (#__news_view.date >= "'.$from_extra.'" and #__news_view.date <= "'.$to_extra.'")';
$sql_filter_unique = 'and (#__unique_visitors.date >= "'.$from_extra.'" and #__unique_visitors.date <= "'.$to_extra.'")';
$sql_filter_news = 'and (#__news.time >= "'.$from_extra.' 00:00:00" and #__news.time <= "'.$to_extra.' 23:59:00")';

if($_GET['component'] == 'statistic' && !$_GET['section']){
    if(!$_POST['options']){
        $sql_order = 'views';
    }else{
        $sql_order = PHP_slashes(htmlspecialchars(strip_tags($_POST['options'])));
    }
    if(!$_POST['sort']){
        $sql_sort = 'desc';
    }else{
        $sql_sort = PHP_slashes(htmlspecialchars(strip_tags($_POST['sort'])));
    }
    $filter_cache = $sql_sort.'-'.$sql_order.'-'.$from_extra.$to_extra;

    $date = date('d-m-Y');
    if($user->get_property('gid') == 21){$redaqtor2 = ' and #__category.id = 116'; $rcache='-redactor';}
    $registry['rubric'] = array();
    /* PLAYGROUND */
    //print_r($sql_sort);

    $registry['count_views'] = $DB->getAll('SELECT b.name,#__news_view.cat,SUM(#__news_view.view) as views,(SELECT count(#__news.id) FROM #__news WHERE #__news.cat = #__news_view.cat and moderate=1) as news FROM #__news_view LEFT JOIN #__category as b ON b.id=#__news_view.cat WHERE b.section="post" and b.stat="'.$stat.'" '.$sql_filter_view.' GROUP BY #__news_view.cat ORDER BY views '.$sql_sort.'');
    if(count($registry['count_views']) > 0){
        foreach($registry['count_views'] as $v){
            $registry['view_cats'][] = $v['cat'];
        }
    }
    $uniq_sql = 'SELECT #__unique_visitors.cat,count(#__unique_visitors.id) as uniq FROM #__unique_visitors WHERE #__unique_visitors.cat IN ('.join(',',$registry['view_cats']).') '.$sql_filter_unique.' GROUP BY cat';
    $registry['unique'] = $DB->getAll($uniq_sql);
    if(count($registry['unique']) > 0){
        foreach($registry['unique'] as $u){
            $registry['uniques'][$u['cat']] = $u['uniq'];
        }
    }
    if(count($registry['count_views'])){
        foreach($registry['count_views'] as $key=>$v){
            $registry['counts'][$v['cat']]['cat'] = $v['cat'];
            $registry['counts'][$v['cat']]['name'] = $v['name'];
            $registry['counts'][$v['cat']]['views'] = $v['views'];
            $registry['counts'][$v['cat']]['news'] = $v['news'];
            $registry['counts'][$v['cat']]['unique'] = $registry['uniques'][$v['cat']];
        }
    }
    function sortByOrder($a, $b) {
        return $a['unique'] - $b['unique'];
    }


    if($sql_order == 'unique'){
        if($sql_sort == 'desc'){
            usort($registry['counts'], function($a, $b) {
                return  $b['unique'] - $a['unique'];
            });
        }else{
            usort($registry['counts'], function($a, $b) {
                return  $a['unique'] - $b['unique'];
            });
        }
    }

    if($sql_order == 'views'){
        if($sql_sort == 'desc'){
            usort($registry['counts'], function($a, $b) {
                return  $b['views'] - $a['views'];
            });
        }else{
            usort($registry['counts'], function($a, $b) {
                return  $a['views'] - $b['views'];
            });
        }
    }

    if($sql_order == 'news'){
        if($sql_sort == 'desc'){
            usort($registry['counts'], function($a, $b) {
                return  $b['news'] - $a['news'];
            });
        }else{
            usort($registry['counts'], function($a, $b) {
                return  $a['news'] - $b['news'];
            });
        }
    }

    //var_dump($registry['cats']);
//    $registry['rubric'] = getAllcache('SELECT #__category.*,
//    (SELECT SUM(#__news_view.view) FROM #__news_view WHERE #__news_view.cat = #__category.id '.$sql_filter_view.') as views,
//    (SELECT count(#__unique_visitors.id) FROM #__unique_visitors WHERE #__unique_visitors.cat = #__category.id '.$sql_filter_unique.') as uniquev,
//    (SELECT count(#__news.id) FROM #__news WHERE #__news.cat = #__category.id '.$sql_filter_news.') as news
//     FROM #__category WHERE #__category.section="post" and #__category.stat="'.$stat.'" '.$redaqtor2.' order by '.$sql_order.' '.$sql_sort.'',3600,'statistika/rubrics'.$filter_cache.$rcache,'../');
}
if($_GET['component'] == 'statistic' && $_GET['section'] == 'authors'){
    if($_POST['author']){
        $author = PHP_slashes(htmlspecialchars(strip_tags($_POST['author'])));
        $sql_author = "AND #__users.realname LIKE '%".$author."%'";
    }
    if(!$_POST['options']){
        $sql_order = 'views';
    }else{
        $sql_order = PHP_slashes(htmlspecialchars(strip_tags($_POST['options'])));
    }
    if(!$_POST['sort']){
        $sql_sort = 'desc';
    }else{
        $sql_sort = PHP_slashes(htmlspecialchars(strip_tags($_POST['sort'])));
    }
    $filter_cache = $sql_sort.'-'.$sql_order.'-'.$from_extra.$to_extra;
    if($user->get_property('gid') == 21){
        $redactor_join = " LEFT JOIN #__category ON #__category.users LIKE CONCAT('%',#__users.id,'%') ";
        $redactor_where = " #__category.id=116 and ";
        $redaqtor2 = ' and #__category.id = 116'; $rcache='-redactor';
    }
/* PLAYGROUND */

    $registry['count_views'] = $DB->getAll('SELECT b.realname,#__news_view.user,SUM(#__news_view.view) as views,(SELECT count(#__news.id) FROM #__news WHERE #__news.user = #__news_view.user and moderate=1) as news FROM #__news_view LEFT JOIN #__users as b ON b.id=#__news_view.user WHERE  (b.group_id = 3 or b.group_id = 2) and  b.status=0 '.$sql_author.' '.$sql_filter_view.' GROUP BY #__news_view.user ORDER BY views '.$sql_sort.'');

    if(count($registry['count_views']) > 0){
        foreach($registry['count_views'] as $v){
            $registry['view_users'][] = $v['user'];
        }
    }

   $uniq_sql = 'SELECT #__unique_visitors.user,count(#__unique_visitors.id) as uniq FROM #__unique_visitors WHERE #__unique_visitors.user IN ('.join(',',$registry['view_users']).') '.$sql_filter_unique.' GROUP BY user';
   $registry['unique'] = $DB->getAll($uniq_sql);

    if(count($registry['unique']) > 0){
        foreach($registry['unique'] as $u){
            $registry['uniques'][$u['user']] = $u['uniq'];
        }
    }
    if(count($registry['count_views'])){
        foreach($registry['count_views'] as $key=>$v){
            $registry['counts'][$v['user']]['user'] = $v['user'];
            $registry['counts'][$v['user']]['realname'] = $v['realname'];
            $registry['counts'][$v['user']]['views'] = $v['views'];
            $registry['counts'][$v['user']]['news'] = $v['news'];
            $registry['counts'][$v['user']]['unique'] = $registry['uniques'][$v['user']];
        }
    }
    function sortByOrder($a, $b) {
        return $a['unique'] - $b['unique'];
    }


    if($sql_order == 'unique'){
        if($sql_sort == 'desc'){
            usort($registry['counts'], function($a, $b) {
                return  $b['unique'] - $a['unique'];
            });
        }else{
            usort($registry['counts'], function($a, $b) {
                return  $a['unique'] - $b['unique'];
            });
        }
    }

    if($sql_order == 'views'){
        if($sql_sort == 'desc'){
            usort($registry['counts'], function($a, $b) {
                return  $b['views'] - $a['views'];
            });
        }else{
            usort($registry['counts'], function($a, $b) {
                return  $a['views'] - $b['views'];
            });
        }
    }

    if($sql_order == 'news'){
        if($sql_sort == 'desc'){
            usort($registry['counts'], function($a, $b) {
                return  $b['news'] - $a['news'];
            });
        }else{
            usort($registry['counts'], function($a, $b) {
                return  $a['news'] - $b['news'];
            });
        }
    }
//    $registry['authors'] = getAllcache("SELECT #__users.*,
//    (SELECT count(id) FROM #__news WHERE #__news.user = #__users.id ".$sql_filter_news.") as news,
//    (SELECT count(#__unique_visitors.id) FROM #__unique_visitors WHERE #__unique_visitors.user = #__users.id ".$sql_filter_unique.") as uniquev,
//    (SELECT SUM(#__news_view.view) FROM #__news_view WHERE #__news_view.user = #__users.id ".$sql_filter_view.") as views
//    FROM #__users $redactor_join WHERE $redactor_where (group_id = 3 or group_id = 2) $sql_author order by $sql_order $sql_sort",3600,'statistika/authors'.$filter_cache.$rcache,'../');
}


if($_GET['component'] == 'statistic' && $_GET['section'] == 'post'){
        if((!empty($_POST['options']) OR !empty($_COOKIE['options']))):
            if(!empty($_POST['options'])):
                $sql_order = PHP_slashes(htmlspecialchars(strip_tags($_POST['options'])));
                setcookie('options',$sql_order,time()+36000,'/');
            else:
                $sql_order=PHP_slashes(htmlspecialchars(strip_tags($_COOKIE['options'])));
            endif;
        else:
            $sql_order = 'views';
        endif;
    if((!empty($_POST['sort']) OR !empty($_COOKIE['sort'])) and $_POST['sort']!==0):
        if(!empty($_POST['sort'])):
            $sql_sort = PHP_slashes(htmlspecialchars(strip_tags($_POST['sort'])));
            setcookie('sort',$sql_sort,time()+36000,'/');
        else:
            $sql_sort=PHP_slashes(htmlspecialchars(strip_tags($_COOKIE['sort'])));
        endif;
    else:
        $sql_sort = 'desc';
    endif;
    if($user->get_property('gid') == 21){

        $redaqtor2 = ' and #__category.id = 116'; $rcache='-redactor';
    }
    if(intval($_GET['author']) > 0){$sql_author = 'and `#__news`.`user`="'.intval($_GET['author']).'"'; $link = '&author='.intval($_GET['author']);}
    if(intval($_GET['cat']) > 0){$sql_author = 'and `#__news`.`cat`='.intval($_GET['cat']);$link = '&cat='.intval($_GET['cat']);}
    //---------------------------------------------
    $page	                = intval($_GET['page']);

    // Переменная хранит число сообщений выводимых на станице
    $num = 20;
    // Извлекаем из URL текущую страницу
    if ($page==0) $page=1;
    // Определяем общее число сообщений в базе данных
    $posts = $DB->getOne("SELECT count(`#__news`.`id`),
    (SELECT count(#__unique_visitors.id) FROM #__unique_visitors WHERE #__unique_visitors.user = #__news.user) as uniquev,
    (SELECT SUM(#__news_view.view) FROM #__news_view WHERE #__news_view.news_id = #__news.id) as views
    FROM `#__news` LEFT JOIN #__category ON #__category.id=#__news.cat
    WHERE `#__news`.`id`>'0' $redaqtor2 $sql_author and #__category.section='post' and #__category.stat='".$stat."' ".$sql_filter_news." order by $sql_order $sql_sort");
    //$postsmoder = $DB->getOne("SELECT count(`#__news`.`id`) FROM `#__news` LEFT JOIN #__category ON #__category.id=#__news.cat WHERE `moderate`='1' $sql_author and `#__news`.`id`>'0' and #__category.section='post'");
    $registry['posts']=$posts;
    if($registry['posts'] > 0){
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
    $link_url='/apanel/index.php?component=statistic&section=post'.$link.''.$from_url.''.$to_url.'&';
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
    $registry['post'] = $DB->getAll("SELECT #__news.*, #__category.name, #__category.podcat,#__users.realname,
            (SELECT count(#__unique_visitors.id) FROM #__unique_visitors WHERE #__unique_visitors.news_id = #__news.id ".$sql_filter_unique.") as uniquev,
            (SELECT SUM(#__news_view.view) FROM #__news_view WHERE #__news_view.news_id = #__news.id ".$sql_filter_view.") as views
			FROM #__news LEFT JOIN #__category ON #__category.id=#__news.cat
			LEFT JOIN #__users ON #__users.id=#__news.user
			WHERE #__news.id>0 and moderate=1 and #__category.stat='".$stat."' $redaqtor2 $sql_author and #__news.cat=#__category.id ".$sql_filter_news."
			ORDER BY $sql_order $sql_sort LIMIT $start,$num");
    }else{
        $registry['post'] = array();
    }
    //$registry['cat'] = $DB->getAll("SELECT #__news.* FROM #__news WHERE cat='".intval($_GET['cat'])."'");
}

function statistic_directory(){
    global $DB;
    $out = '<div class="directory">';
    if($_REQUEST['component'] == 'statistic' and !$_REQUEST['section']){
       $out .= '<h2>სტატისტიკა</h2>';
    }elseif($_REQUEST['component'] == 'statistic' and $_REQUEST['section'] == 'authors'){
       $out .= '<a href="/apanel/index.php?component=statistic">სტატისტიკა</a> &rarr; ავტორები';
    }elseif($_REQUEST['component'] == 'statistic' and $_REQUEST['section'] == 'post' and $_REQUEST['author'] > 0){
        $author = $DB->getOne('SELECT realname FROM #__users WHERE id = '.intval($_REQUEST['author']));
        $out .= '<a href="/apanel/index.php?component=statistic">სტატისტიკა</a> &rarr;
                 <a href="/apanel/index.php?component=statistic&section=authors">ავტორები</a> &rarr; '.$author;
    }else{
        $out .= '<a href="/apanel/index.php?component=statistic">სტატისტიკა</a> &rarr; სტატიები';
    }
    $out .= '</div>';
    print $out;
}