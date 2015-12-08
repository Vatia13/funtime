<?php
if($_POST){
    require_once('../config.php');
    require_once('dbsql.class.php');
    require_once('ajax.class.php');
    require_once('../sys/functions.php');
    require_once('../sys/functions.cms.php');
    $DB=new DB_Engine('mysql', $settings['dbHost'], $settings['dbUser'], $settings['dbPass'], $settings['dbName']);
    $ajax = new ajax($DB,'osr_',$registry);
    $ajax->$_POST['action']($_POST);
}else{
    die("hello kiddies");
}