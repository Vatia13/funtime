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

$err=0;
$userid=intval($_GET['value']);
if($userid==0) $err=1;

if($err==0)
	{
	$all = $DB->getAll('SELECT `#__users`.*,`#__groups`.`g_title`, (SELECT `city_name_ru` FROM `#__cities` WHERE `#__cities`.`id_city`=`#__users`.`city`) as `city_name_ru`
				FROM `#__users` 	
				LEFT JOIN `#__groups` ON `#__groups`.`g_id`=`#__users`.`group_id`
				WHERE `#__users`.`id`='.$userid);
	if (generate_avatar_markup($userid)==''):
		$img_path='<img src="/'.$theme.'images/no_photo125x100.png" alt="" class="photo" width="'.$avator_width_profile.'" height="'.$avator_height_profile.'"/>'; 
		else:
		$img_path=generate_avatar_markup($userid);
	endif;
	}
