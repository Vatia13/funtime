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
if(isset($_GET['edit']) && intval($_GET['edit'] > 0)){
    if($num['cat'] > 0){
        $time = time();
        $registry['added_banners'] = $DB->getAll("SELECT banner_id FROM #__banners_added WHERE news_id='".$num['id']."'");
        $added = array();
        if(count($registry['added_banners']) > 0){
            foreach($registry['added_banners'] as $item):
                $added[] = $item['banner_id'];
            endforeach;
        }
        if(count($added) > 0){
            $sql_not = ' and #__banner_list.id NOT IN ('.join(',',$added).')';
        }else{
            $sql_not = '';
        }
        $registry['banners'] = $DB->getAll("SELECT #__banner_list.company,#__banner_list.title,#__banner_list.id,#__banner_list.published_at,CONCAT_WS('x',size_x,size_y) as size,info FROM #__banner_list WHERE
                                            #__banner_list.type='1' and (#__banner_list.status='2' or #__banner_list.status='1') and #__banner_list.cat_id='".$num['cat']."'
                                            and (UNIX_TIMESTAMP(#__banner_list.published_at) <= $time and UNIX_TIMESTAMP(#__banner_list.finished_at) >= $time)
                                            {$sql_not}");

         //print_r(date('Y-m-d H:i:s',$time)."------".$registry['banners'][0]['published_at']);

    }
}
