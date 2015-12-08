<?php
/**
 *
 * CMS osRealty 2.1.x
 * Autor: Roman Chernyshov
 * E-mail: support@osRealty.ru
 * URL: www.osRealty.ru
 *
 */

defined('_JEXEC') or die('Restricted access');

if(get_access('admin','tools','view',false)):
	$datacbr = $DB->getOne("SELECT `#__setting`.`value` FROM `#__setting` WHERE `#__setting`.`name`='datacbr'");
	$dopusk=$datacbr+1;
	if(!empty($_POST['cbr']) and ($dopusk<time())):
		$sql="UPDATE `#__setting` SET `value` = '".time()."' WHERE `name`='datacbr' LIMIT 1; ";
		$DB->execute($sql);
	endif;

	if($_POST['reload']==1 and ($dopusk<time() or empty($_POST['cbr'])))
	  {
	    if($_POST['market']==1 or $_POST['currencies']==1)$url="http://www.google.com/finance";
	    if($_POST['cbr']==1)$url="http://www.cbr.ru/currency_base/D_print.aspx?date_req=".date('d.m.Y',time());
	    $html = file_get_contents($url); //read the file
	    if($_POST['cbr']==1)
		{
		$pos=utf8_strpos($html,'<div class="header2"');
		$html=utf8_substr($html,$pos,utf8_strlen($html));
		 $message[0]='valid';
		 $message[1]='Котировки успешно обновлены';

		}
	    $dom = new domDocument;
	    @$dom->loadHTML($html);
	    $dom->preserveWhiteSpace = false;
	    if($_POST['market']==1):$block = $dom->getElementById('markets');$sql_table='#__parser_market';endif;
	    if($_POST['currencies']==1):$block = $dom->getElementById('currencies');$sql_table='#__parser_curr';endif;
	    if($_POST['cbr']==1):$sql_table='#__parser_cbr';endif;
	    if($_POST['market']==1 or $_POST['currencies']==1)$tables = $block->getElementsByTagName('table');
	    if($_POST['cbr']==1):$tables = $dom->getElementsByTagName('table');endif;

	    $rows = $tables->item(0)->getElementsByTagName('tr');
	    $i=0;
	    foreach ($rows as $row)
	    {
		if($_POST['cbr']==1 and $i==0):
			$i++;continue;
			endif;
	        $cols = $row->getElementsByTagName('td');
	        $market[$i][0]=$cols->item(0)->nodeValue;
	        $market[$i][1]=$cols->item(1)->nodeValue;
	        $market[$i][2]=$cols->item(2)->nodeValue;
		if($_POST['cbr']==1):
		        $market[$i][0]=$cols->item(1)->nodeValue;
		        $market[$i][1]=$cols->item(2)->nodeValue;
		        $market[$i][2]=$cols->item(4)->nodeValue;
		endif;
		$check=0;
		$check = $DB->getOne("SELECT `$sql_table`.`id` FROM `$sql_table` WHERE `$sql_table`.`name`='".$market[$i][0]."' LIMIT 1");
		if($check>0):
			$sql="UPDATE `$sql_table` SET $dop `value` = '".$market[$i][1]."', `difference`='".$market[$i][2]."' WHERE `id`='$check' LIMIT 1; ";
			$DB->execute($sql);
		else:
			$sql="INSERT INTO `$sql_table` (`name`,`value`,`difference`) VALUE ('".$market[$i][0]."', '".$market[$i][1]."', '".$market[$i][2]."');";
			$DB->execute($sql);
		endif;
		$i++;

    	    }
	  }
	  else
	  {
		 $message[0]='valid';
		 $message[1]='Последнее обновление котировок '.date('d.m.Y H:i',$datacbr);;
	  }

	$cbr = $DB->getAll('SELECT * FROM `#__parser_cbr`');
endif;
