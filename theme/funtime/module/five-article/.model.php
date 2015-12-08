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
$registry['five-article'] = getAllcache('SELECT #__news.*,#__users.realname,#__category.name,#__category.cat_chpu FROM #__news
                                         LEFT JOIN #__users ON #__users.id = #__news.user
                                         LEFT JOIN #__category ON #__category.id = #__news.cat
                                         WHERE #__news.moderate = 1 and #__category.test = 0 and #__category.section = "post" and #__news.date <= '.$time.' ORDER BY #__news.date DESC LIMIT 3,5',300,'five_article');