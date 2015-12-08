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
$time = time();
$registry['last_test'] = getAllcache("SELECT #__tests.* FROM #__tests WHERE status=0 and type='0' and date < {$time} ORDER BY date DESC LIMIT 1",600,'tests');
