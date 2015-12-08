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

if($_POST['submit']){
    $name = PHP_slashes(htmlspecialchars(strip_tags($_POST['name'])));
    if($_FILES['img']['size'] > 0){
        $filename = time();
        $path = save_image_on_server($_FILES['img'],'../img/uploads/styles/',$registry['img']);
        $DB->execute('INSERT INTO #__news_style (name,img) VALUES ("'.$name.'","'.$path[1].'")');
    }
}