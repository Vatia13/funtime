<?php
if(!empty($_POST['changereg']))
	{
	//if(intval($_POST['changereg'])==-1) $_POST['changereg']=0;
	setcookie('changereg',intval($_POST['changereg']),time()+3600*48,'/');
	$changereg=intval($_POST['changereg']); 
	}
	else
	{
	if(!empty($_COOKIE['changereg']))
		{
		$changereg=intval($_COOKIE['changereg']);
		if($changereg==-1)$changereg=0;
		}
		else $changereg=$registry['region_default'];
	}

$registry['changereg']=$changereg;



$registry['ogim'] = "http://funtime.ge/img/fbs.png";
$registry['desc'] = "ინტერნეტჟურნალი";
$registry['url'] = "http://funtime.ge";

$registry['header_img'] = getOnecache('SELECT value FROM #__setting WHERE name="header_img"',2000,'header');
$registry['deviceType'] = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

create_date_folder($_SERVER['DOCUMENT_ROOT'].'/img/uploads/news/fb/');
create_date_folder($_SERVER['DOCUMENT_ROOT'].'/img/uploads/news/read/');
create_date_folder($_SERVER['DOCUMENT_ROOT'].'/img/uploads/news/prev/');

create_date_folder($_SERVER['DOCUMENT_ROOT'].'/cache/ip/','-d');


