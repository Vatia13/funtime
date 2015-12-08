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

$sql = "SELECT * FROM #__category WHERE section='post' and stat='0' order by name ASC";
$registry['rubrics'] = getAllcache($sql,3600,'rubrics');