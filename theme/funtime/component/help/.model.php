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


$help = $DB->getAll('SELECT `#__news`.*, `#__category`.`name`, `#__category`.`cat_chpu` FROM `#__news` LEFT JOIN `#__category` ON `#__news`.`cat`=`#__category`.`id`
		WHERE `#__category`.`cat_chpu`=\'help\' AND date<'.time().' ORDER BY `#__news`.`date` ASC ');

