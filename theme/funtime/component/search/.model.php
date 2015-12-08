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
$value = PHP_slashes(htmlspecialchars(strip_tags($_GET['text'])));
if($value == 'archive'){
    $sql_search = '';
}else{
$sql_search = '(#__news.title LIKE "%'.$value.'%" or #__news.text LIKE "%'.$value.'%" or #__news.text_short LIKE "%'.$value.'%") and';
}
$registry['search'] = $DB->getAll('SELECT #__news.*,#__category.name,#__users.realname,#__category.cat_chpu,#__category.id as cat_id FROM #__news
                                         LEFT JOIN #__category ON #__category.id = #__news.cat
                                         LEFT JOIN #__users ON #__users.id = #__news.user
                                         WHERE '.$sql_search.' #__news.moderate=1 and #__category.section="post" and #__news.date <= '.$time.' order by #__news.date DESC LIMIT 21');
$registry['title'] = $value;

