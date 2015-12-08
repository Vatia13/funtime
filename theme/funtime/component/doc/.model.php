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
//PAGES
$time = time();
if(isset($_GET['pitem']) && isset($_GET['pcat'])){
    $registry['doctype'] = 'post';
    $title = PHP_slashes(htmlspecialchars(strip_tags($_GET['pitem'])));

    if($user->get_property('gid') !== 24 and $user->get_property('gid') !== 25){
        $sql_user = ' and #__news.date <= '.$time.'';
    }
    $registry['post'] = getAllcache('SELECT #__news.*,#__users.realname,#__category.name,#__category.cat_chpu,#__category.id as cat_id,#__category.type FROM #__news
                                         LEFT JOIN #__users ON #__users.id = #__news.user
                                         LEFT JOIN #__category ON #__category.id = #__news.cat
                                         WHERE #__news.chpu = "'.$title.'" and #__news.moderate <> 10  ',300,'news/'.$_GET['pitem']);
    //$registry['pbanners'] = $DB->getAll("SELECT id FROM #__banners WHERE cat_id='{$registry['post'][0]['cat']}'");
    $registry['color'] = unserialize($registry['post'][0]['color']);
    $registry['informer'] = unserialize($registry['post'][0]['info']);
    $registry['wyaro'] = unserialize($registry['post'][0]['copy']);

    if($registry['post'][0]['id'] > 0){
        $registry['slide'] = unserialize($registry['post'][0]['slide']);
        if(count($registry['slide']['img']) > 1):
            $phslide = " - ფოტოსლაიდი ".count($registry['slide']['img'])." ფოტო";
        endif;
        $registry['title'] = $registry['post'][0]['title'].$phslide;
        $main_img_dir = $_SERVER['DOCUMENT_ROOT'].'/img/uploads/news/prev/'.last_par_url($registry['post'][0]['thumbs']).'';
        $fb_img_dir = $_SERVER['DOCUMENT_ROOT'].'/img/uploads/news/fb/'.$registry['post'][0]['fb'].'';
        if(file_exists($fb_img_dir)){
            $registry['ogim'] = 'http://funtime.ge/img/uploads/news/fb/'.$registry['post'][0]['fb'];
        }else{
            $registry['ogim'] = 'http://funtime.ge/img/uploads/news/prev/'.last_par_url($registry['post'][0]['thumbs']);
        }
        if($registry['post'][0]['style'] == 12){
            $registry['desc'] = '';
        }else{
            $registry['desc'] = strip_tags($registry['post'][0]['text_short']);
        }

        $registry['url'] = 'http://'.$_SERVER['SERVER_NAME'].'/'.$registry['post'][0]['cat_chpu'].'/'.$registry['post'][0]['chpu'].'/';

        $date = date('Y-m-d');

        $check_view= $DB->getOne('SELECT count(id) FROM #__news_view WHERE news_id="'.$registry["post"][0]["id"].'" and date="'.$date.'"');
        if($check_view <= 0){
            $DB->execute('INSERT INTO #__news_view (view,news_id,date,cat,user) VALUES (1,"'.$registry["post"][0]["id"].'","'.$date.'","'.$registry['post'][0]['cat'].'","'.$registry['post'][0]['user'].'")');
        }else{
            $DB->execute('UPDATE #__news_view SET view=view+1 WHERE news_id="'.$registry["post"][0]["id"].'" and date="'.$date.'"');
        }

        /*
             if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/cache/ip/'.$date.'/unique_visitors')){
                 $f = @fopen($_SERVER['DOCUMENT_ROOT'].'/cache/ip/'.$date.'/unique_visitors','w');
                 @fclose($f);
             }else{
                 $file_unique = $_SERVER['DOCUMENT_ROOT'].'/cache/ip/'.$date.'/unique_visitors';

                 $current = file_get_contents($file_unique);
                 $cr = explode(',',$current);
                 if(count($cr) > 0){
                     if(strpos($current,getIP()."|".$registry["post"][0]["id"]."|".$registry['post'][0]['cat']."|".$registry['post'][0]['user']."|".$date) == false){
                         $current = $current . getIP()."|".$registry["post"][0]["id"]."|".$registry['post'][0]['cat']."|".$registry['post'][0]['user']."|".$date.",";
                         file_put_contents($file_unique, $current);
                     }
                 }
             }

                //$check_visitor = $DB->getOne('SELECT id FROM #__unique_visitors WHERE news_id="'.$registry["post"][0]["id"].'" and ip="'.getIP().'" and date="'.$date.'"');

                 $DB->execute('INSERT INTO #__unique_visitors (news_id,cat,user,ip,date) VALUES ("'.$registry["post"][0]["id"].'","'.$registry['post'][0]['cat'].'","'.$registry['post'][0]['user'].'","'.getIP().'","'.$date.'")');
              }*/
        if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/cache/ip/'.$date.'/'.getIP().'-'.$registry["post"][0]["id"])){
            $DB->execute('INSERT INTO #__unique_visitors (news_id,cat,user,ip,date) VALUES ("'.$registry["post"][0]["id"].'","'.$registry['post'][0]['cat'].'","'.$registry['post'][0]['user'].'","'.getIP().'","'.$date.'")');
        }
        $check_visitor = getOnecache('SELECT id FROM #__unique_visitors WHERE news_id="'.$registry["post"][0]["id"].'" and ip="'.getIP().'" and date="'.$date.'"',86400,'ip/'.$date.'/'.getIP().'-'.$registry["post"][0]["id"]);


    }
}

if(isset($_GET['dcat'])){
    $registry['doctype'] = 'category';
    $title = PHP_slashes(htmlspecialchars(strip_tags($_GET['dcat'])));
    $registry['posts'] = getAllcache('SELECT #__news.*,#__category.name,#__users.realname,#__category.cat_chpu,#__category.id as cat_id FROM #__news
                                         LEFT JOIN #__category ON #__category.id = #__news.cat
                                         LEFT JOIN #__users ON #__users.id = #__news.user
                                         WHERE #__category.cat_chpu = "'.$title.'" and #__category.section = "post" and #__news.moderate=1 and #__news.date <= '.$time.' order by #__news.date DESC LIMIT 14',600,$_GET['dcat']);
    $registry['title'] = $registry['posts'][0]['name'];
}

