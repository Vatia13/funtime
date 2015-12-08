<?php

defined('_JEXEC') or die('Restricted access');

if($registry['doctype']=='post') include('post.php');
if($registry['doctype']=='category' or $registry['doctype']=='nopost') include('category.php');
if($registry['doctype']=='404') include('.err404.php');