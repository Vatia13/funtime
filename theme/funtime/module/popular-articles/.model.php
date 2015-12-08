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
$lastWeek = time() - (7 * 24 * 60 * 60);
$date = date('Y-m-d',$lastWeek);
$sql_filter_view = 'and #__news_view.date > "'.$date.'"';


$registry['popular'] = getAllcache('SELECT #__news.*,#__category.cat_chpu,
                                        (SELECT SUM(#__news_view.view) FROM #__news_view WHERE #__news_view.news_id = #__news.id '.$sql_filter_view.') as views
                                        FROM #__news
                                        LEFT JOIN #__category ON #__category.id = #__news.cat
                                        WHERE #__news.moderate=1 and  #__news.cat <> "116" and #__news.chpu <> "'.$registry["post"][0]["chpu"].'" ORDER BY views
                                        DESC LIMIT 4',3600,'popular/popular_cache_'.$registry["post"][0]["chpu"]);
