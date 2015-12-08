<?php
/**
 *
 * CMS osRealty 2.1.x
 * Autor: Roman Chernyshov
 * E-mail: support@osRealty.ru
 * URL: www.osRealty.ru
 *
 */

defined('_JEXEC') or die('Restricted access');

if(!empty($_GET['dcat']))$where='WHERE `#__category`.`cat_chpu`=\''.PHP_slashes(htmlspecialchars($_GET['dcat'])).'\''; else $where='';

	$news = $DB->getAll('SELECT `#__news`.*, `#__category`.`name`, `#__category`.`cat_chpu` FROM `#__news` LEFT JOIN `#__category` ON `#__news`.`cat`=`#__category`.`id`
			'.$where.' ORDER BY `#__news`.`date` DESC LIMIT 10');
	if(count($news)==0)header("Location: /");

	$config['domen'] 	= $_SERVER['HTTP_HOST'];
	$config['site_title'] 	= $DB->getOne('SELECT `#__setting`.`value` FROM `#__setting` WHERE `#__setting`.`name`=\'site_title\' LIMIT 1');

	$rss = new rss('utf-8');

	$rss->channel('RSS - '.$news[0]['name'], 'http://'.$config['domen'], $config['site_title']);

	$rss->language('ru-RU');
	$rss->copyright('Copyright by '.$config['domen'].' '.date('Y'));
	$rss->managingEditor('support@'.str_replace('www.','',$config['domen']));
	$rss->category($news[0]['name']);

	$rss->startRSS();

	foreach($news as $ne):
		$rss->itemTitle($ne['title']);
		$rss->itemLink('http://'.$config['domen'].'/doc/'.$ne['cat_chpu'].'/'.$ne['chpu'].'/');
		$rss->itemDescription(strip_tags($ne['text']));
		$rss->itemAuthor('support@'.str_replace('www.','',$config['domen']));
		$rss->itemGuid('http://'.$config['domen'].'/doc/'.$ne['cat_chpu'].'/'.$ne['chpu'].'/');
		$rss->itemSource($config['site_title'], 'http:/'.$config['domen'].'/rss/'.$ne['name'].'/');
		$rss->addItem();
	$count++;
	endforeach;
	echo $rss->RSSdone();
	exit;
