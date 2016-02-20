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

if($registry['post'][0]['id'] > 0){
    $time = time();

$registry['new-articles'] = getAllcache("SELECT #__news.title,#__news.alt_search,#__news.thumbs,#__news.chpu,#__category.cat_chpu FROM #__news LEFT JOIN #__category ON #__category.id = #__news.cat WHERE #__news.cat != '116' and #__news.id!='".intval($registry['post'][0]['id'])."' and #__news.moderate='1' and date <= ".$time." ORDER BY #__news.date desc LIMIT 4",300,'new/new-articles-'.$registry['post'][0]['id']);
}