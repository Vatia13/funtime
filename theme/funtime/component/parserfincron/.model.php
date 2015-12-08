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

if($_GET['parse'] == 'd4ab858a3767646c6b40d8d55603597c'){
$date = date('Y-m-d');
$file_unique = $_SERVER['DOCUMENT_ROOT'].'/cache/ip/'.$date.'/unique_visitors';
$content = file_get_contents($file_unique);

$content = explode(',',$content);

$contents = array();
foreach($content as $key=>$cont){
    $contents[$key] = explode('|',$cont);
}



}