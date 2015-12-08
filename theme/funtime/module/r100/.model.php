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
if($registry['post'][0]['id'] > 0){
    $left = " and #__news.id!=".$registry['post'][0]['id'];
}else{
    $left = "";
}
$registry['saknatuna'] = $DB->getAll('SELECT #__news.*,#__users.realname,#__category.name,#__category.cat_chpu FROM #__news
                                         LEFT JOIN #__users ON #__users.id = #__news.user
                                         LEFT JOIN #__category ON #__category.id = #__news.cat
                                         WHERE #__news.moderate = 1 and #__category.test = 1 and #__news.date <= '.$time.' '.$left.' ORDER BY #__news.date DESC LIMIT 7');