<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of osrLogs
 *
 * @author osRealty
 */
class osrLogs {
    //put your code here
    public $registry;
    public $DB;
    function __construct($registry, $DB) {
                $this->registry=$registry;
                $this->DB=$DB;
    }
    function saveLog($user, $desc) {
        $date= time();
        $ip  = $this->get_ip();
        $log.= "<pre>_GET \r\n";
        /*
  foreach($_GET as $k => $v) {
      $log.= "$k => $v \r\n";
  }

  $log.= "_POST \r\n";
  foreach($_POST as $k => $v) {
      $log.= "$k => $v \r\n";
  }*/
        $log.= "_SESSION \r\n";
        foreach($_SESSION as $k => $v) {
            $log.= "$k => $v \r\n";
        }
        $log.= "_COOKIE \r\n";
        foreach($_COOKIE as $k => $v) {
            $log.= "$k => $v \r\n";
        }
        $log.= "</pre>";
        //echo $log;exit;
        $sql="INSERT INTO `#__logs` (`date`,`user`,`ip`,`desc`,`log`) 
              VALUES ('$date','$user','$ip','$desc','$log')";
        $this->DB->execute($sql);
    }
    function get_ip() {
        if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
        return $_SERVER['REMOTE_ADDR'];
    }
}

?>
