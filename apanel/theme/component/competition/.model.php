<?php
/**
 *
 * CMS It-Solutions 0.1
 * Author: LTS
 * E-mail: levanitsikarishvili0@gmail.com
 * URL: www.it-solutions.ge
 *
 */

defined('_JEXEC') or die('Restricted access');
$registry['competition'] = $DB->getAll("SELECT * FROM #__competition");
