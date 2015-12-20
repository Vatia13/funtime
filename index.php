<?php
/**
 *
 * CMS It-Solutions 0.1
 * Author: Vati Child
 * E-mail: vatia0@gmail.com
 * URL: www.it-solutions.ge
 *
 */

require_once('config.php');

if($antiddos):
  require_once('lib/antiddos.class.php');
  $ad = new antiDdos(false);
  $ad->dir = 'tmp/';
  $ad->ddos = 2;
  $ad->start();
endif;

if ($timer_generate) {require_once('lib/timer.class.php');$timer = new timer();$timer->start_timer();}
require_once('sys/functions.php');
require_once('sys/functions.cms.php');
if (count($_GET)>0 OR count($_POST)>0) require_once('sys/get.control.php');
require_once('lib/access.class.php');
require_once('lib/mail.class.php');
require_once('lib/dbsql.class.php');
require_once('lib/class.get.image.php');
require_once('lib/markhtml.php');
require_once('lib/osrLogs.php');
require_once('lib/Mobile_Detect.php');
require_once 'vendor/autoload.php';
$detect = new Mobile_Detect;
if ($component=='rss') require_once 'lib/rss.class.php';

//export
$user=new flexibleAccess('',$settings);
$DB=new DB_Engine('mysql', $settings['dbHost'], $settings['dbUser'], $settings['dbPass'], $settings['dbName']);
$DB->show_err=true;
$DB->prefix=$settings['dbPrefix'];
get_registry();
get_powerstatus();
$LOG=new osrLogs($registry, $DB);
if ($_POST['export']==1):$export=1;include('export.php');endif;

if ( $_GET['logout'] == 1 ) $user->logout('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
if ( !$user->is_loaded())
	{if ( isset($_POST['uname']) && isset($_POST['pwd'])){
	  if ( !$user->login($_POST['uname'],$_POST['pwd'],$_POST['remember'] )){
	    $err=2;
		 header('Location: /com/login/');
	  }else header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);}
	} else 
	if (!$user->is_active() AND $_GET['code']=='') $err=1; 

@include($theme.'.model.php');

if($component=='')$com_path='frontpage';else $com_path=$component;
if($section=='')$sec_path='default';else $sec_path=$section;
$contents_view=$theme.'component/'.$com_path.'/'.$sec_path.'.php';

if(!file_exists($contents_view)) {$contents_view=$theme.'component/error/default.php';$exists=false;} else $exists=true;
if(!$exists)$model='error';else$model=$com_path;

$model_path=$theme.'component/'.$model.'/.model.php';;
if(file_exists($model_path))include($model_path);

$page_title=$com_path;
if ($other_internal and !empty($component) and $exists) require_once $theme.'internal.php'; else require_once $theme.'index.php';

if ($timer_generate) {
	echo 'queries: '.count($DB->sqls).'<br/>';
	echo 'time queries: '.$DB->AllTimeQueries.'<br/>';
	echo 'time generate: '.round($firstTime = $timer->end_timer(),5).'s';

	if($_GET['debug']==1)
		{
		require_once('lib/dbug.class.php');
		new dbug($DB->sqls);
		}
	}
