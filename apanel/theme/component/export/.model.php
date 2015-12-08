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

function recRMDir($path){ 
    if (substr($path, strlen($path)-1, 1) != '/') $path .= '/'; 
    if ($handle = @opendir($path)){ 
        while ($obj = readdir($handle)){ 
            if ($obj != '.' && $obj != '..'){ 
                if (is_dir($path.$obj)){ 
                    if (!recRMDir($path.$obj)) return false; 
                }elseif (is_file($path.$obj)){ 
                    if (!unlink($path.$obj))    return false; 
                    } 
            } 
        } 
          closedir($handle); 
          return true; 
    } 
   return false; 
}

function filter($data) {
	$data = html_entity_decode($data);
	if(function_exists('htmlspecialchars_decode'))$data = htmlspecialchars_decode($data);
	$data = strip_tags($data);
	$data = str_replace("\n\r","[br]",$data);
	$data = str_replace("\n","[br]",$data);
	return $data;
}
function cleardata($data) {
	$newdata=array();
	if(is_array($data)) {
	foreach($data as $key=>$item)
		{
		$item=filter($item);
		$newdata[$key]=$item;
		}
	} else $newdata=filter($data);
	return $newdata;
}

if(($_GET['section']=='import') and isset($_POST['import']) and get_access('admin','tools','view', false)) {

	if($_FILES["file"]["size"]>0)
	{
	$userID=$user->get_property('userID');
	$date=time();
		if (is_uploaded_file($_FILES['file']['tmp_name'])) 
			{
			$filename = $_FILES['file']['tmp_name'];
			$ext = substr($_FILES['file']['name'], 
				1 + strrpos($_FILES['file']['name'], "."));
			$valid_types=array('csv', 'CSV');
			if (!in_array($ext, $valid_types)) 
				{
				 $message[0]='error';
				 $message[1]="Ошибка: Данный формат фото не поддерживается. Выберите для загрузки файл в формате: CSV";
				} else 
				{
				$dir="../tmp";
				$newname=rand(100000,99999999);
					while (file_exists("$dir/$newname.$ext")) $newname=rand(100000,99999999);

					if (!is_dir($dir)) {@mkdir($dir, 0777, true);}

					if (@move_uploaded_file($filename, "$dir/$newname.$ext")) {


					$i=0;$add=0;$update=0;
					$continue=0;
					$file_handle = fopen("$dir/$newname.$ext", "r");
					while (!feof($file_handle)) {
					   $line = fgets($file_handle);
					   $i++;
					   if($i==1) continue;
					   $item=explode(';',$line);
					   if(count($item) > 1)
						{
						$arrDeal = array("rent" => 2, "sale" => 1);
						$arrRyn = array("new" => 1, "used" => 2);
						$arrSel = array("yes" => 2, "no" => 1);
						$arrSel2 = array("yes" => 1, "no" => 0);
						$arrSan = array("join" => 2, "sep" => 1); //sep - раздельный, join - совместный
						$arrMat = array("brick" => 1, "panel" => 2, "monolith" => 3, "other" => 4);

						$id=intval($item[0]);
						$deal=intval($item[1]);
						$tip=intval($item[2]);
						$ryn=intval($item[3]);
						$region=intval($item[4]);
						$city=intval($item[5]);
						$area=intval($item[6]);
						$adres=str_replace('[br]',"\n",PHP_slashes(htmlspecialchars(strip_tags($item[7]))));
						$price=intval($item[8]);
						$pricekv=intval($item[9]);
						$komn=intval($item[10]);
						$plosh=explode('/',$item[11]);
						$plosh1=@round($plosh[0],2);
						$plosh2=@round($plosh[1],2);
						$plosh3=@round($plosh[2],2);
						$ploshearth=@round($item[12],2);
						$etag=str_replace('[br]',"\n",PHP_slashes(htmlspecialchars(strip_tags($item[13]))));

						$bal=intval($arrSel[$item[15]]);
						if($bal==0)$bal=intval($item[15]);

						$material=intval($arrMat[$item[14]]);
						if($material==0)$material=intval($item[14]);

						$san=intval($arrSan[$item[16]]);
						if($san==0)$san=intval($item[16]);

						$lift=intval($arrSel[$item[17]]);
						if($lift==0)$lift=intval($item[17]);

						$detail=str_replace('[br]',"\n",PHP_slashes(htmlspecialchars(strip_tags($item[18]))));

						$hotenable=intval($arrSel2[$item[19]]);
						if($hotenable==0)$hotenable=intval($item[19]);

						$hottitle=str_replace('[br]',"\n",PHP_slashes(htmlspecialchars(strip_tags($item[20]))));
						$hotdesc=str_replace('[br]',"\n",PHP_slashes(htmlspecialchars(strip_tags($item[21]))));
						$title=str_replace('[br]',"\n",PHP_slashes(htmlspecialchars(strip_tags($item[22]))));
						$metak=str_replace('[br]',"\n",PHP_slashes(htmlspecialchars(strip_tags($item[23]))));
						$metad=str_replace('[br]',"\n",PHP_slashes(htmlspecialchars(strip_tags($item[24]))));

						if($deal==0) $deal = intval($arrDeal[$item[1]]);
						if($tip==0) {$continue++;continue;}
						if($ryn==0) $ryn = intval($arrRyn[$item[3]]);
						if($ryn==0) $ryn = 1;

						if($id>0) 
							{
							$update++; 
							$sql="UPDATE `#__real_prodaja` SET
							`tip` = '$tip',
							`ryn` = '$ryn',
							`region` = '$region',
							`city` = '$city',
							`area` = '$area',
							`adres` = '$adres',
							`price` = '$price',
							`pricekv` = '$pricekv',
							`komn` = '$komn',
							`plosh1` = '$plosh1',
							`plosh2` = '$plosh2',
							`plosh3` = '$plosh3',
							`ploshearth` = '$ploshearth',
							`etag` = '$etag',
							`bal` = '$bal',
							`lift` = '$lift',
							`san` = '$san',
							`detail` = '$detail',
							`hotenable` = '$hotenable',
							`material` = '$material',
							`hottitle` = '$hottitle',
							`hotdesc` = '$hotdesc',
							`title` = '$title',
							`metak` = '$metak',
							`metad` = '$metad'
							WHERE `id` = '$id' LIMIT 1";
							} else 
							{
							$add++;
							$sql="INSERT INTO `#__real_prodaja` (`user`,`tip`,`ryn`,`region`,`city`,`area`,`adres`,`price`,`pricekv`,`komn`,
							`plosh1`,`plosh2`,`plosh3`,`ploshearth`,`etag`,`bal`,`lift`,`san`,`detail`,`hotenable`,
							`material`,`hottitle`,`hotdesc`,`title`,`metak`,`metad`)
							VALUE ('$userID','$tip','$ryn','$region','$city','$area','$adres','$price','$pricekv','$komn',
							'$plosh1','$plosh2','$plosh3','$ploshearth','$etag','$bal','$lift','$san','$detail','$hotenable',
							'$material','$hottitle','$hotdesc','$title','$metak','$metad');";
							}
 						 $sql = iconv('windows-1251','UTF-8',$sql);
						 $DB->execute($sql);
						}
					}
					fclose($file_handle);
					 $message[0]='valid';
					 $message[1]="Импорт успешно завешон.<br/>Добавлено: $add записей<br/>
						Обновлено: $update записей<br/> Пропущено: $continue записей";
                                         $LOG->saveLog($user->get_property('userID'),"Импорт CVS: Обновлено - $update, Пропущено - $continue");

					@unlink("$dir/$newname.$ext");
					}
				}
			}
	} else {
		 $message[0]='error';
		 $message[1]="Ошибка: Проверьте корректность файла";
	}
}

if(($_GET['section']=='export') and get_access('admin','tools','view', false)) {

	$tip=intval($_POST['tip']);
        if($tip>0) $cat_sql=" and `#__real_prodaja`.`tip` = '$tip'";
	$sql="SELECT `#__real_prodaja`.*,`#__regions`.`region_name_ru`,`#__cities`.`city_name_ru`,
			`#__real_cat`.`name` as `tip_name`, `#__real_cat`.`table`,`#__real_material`.`name` as `mat_name`,
			`#__users`.`username`, (SELECT #__real_image.path FROM #__real_image WHERE #__real_image.idrealty=`#__real_prodaja`.id and #__real_image.first<2 ORDER BY #__real_image.first DESC LIMIT 1) as imagefirst
		FROM `#__real_prodaja` 
		LEFT JOIN `#__regions` ON `#__real_prodaja`.`region`=`#__regions`.`id_region`
		LEFT JOIN `#__cities` ON `#__real_prodaja`.`city`=`#__cities`.`id_city`
		LEFT JOIN `#__real_cat` ON `#__real_prodaja`.`tip`=`#__real_cat`.`id`
		LEFT JOIN `#__users` ON `#__users`.`id`=`#__real_prodaja`.`user`
		LEFT JOIN `#__real_material` ON `#__real_prodaja`.`material`=`#__real_material`.`id`
		WHERE (`#__real_prodaja`.`moderate`='1' or `#__real_prodaja`.`moderate`='0') $cat_sql $tip_sql $sql_search $sql_onmy
		ORDER BY id ASC";

	$registry['realty'] = $DB->getAll($sql);

        $output='';
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"realty.db.csv\"");
	$output.="ID объекта;Тип сделки;Тип недвижимости;Рынок;Регион;Город;Район;Адрес;Цена;Цена за М2;Кол-во комнат;Площадь М2(общая/жилая/кухня);Площадь участка(сот.);Этаж;Тип дома;Балкон;Санузел;Лифт;Доп. информация;Горячее предложение;Краткий заголовок;Краткое описание;SEO Title;SEO Meta Keywords;SEO Mata Desc;\n";

	foreach ($registry['realty'] as $i)
		{
		$i=cleardata($i);
		$output.="{$i['id']};{$i['type_deal']};{$i['tip']};{$i['ryn']};{$i['region']};{$i['city']};{$i['area']};{$i['adres']};{$i['price']};{$i['pricekv']};{$i['komn']};{$i['plosh1']}/{$i['plosh2']}/{$i['plosh3']};{$i['ploshearth']};{$i['etag']};{$i['tip']};{$i['bal']};{$i['san']};{$i['lift']};{$i['detail']};{$i['hotenable']};{$i['hottitle']};{$i['hotdesc']};{$i['title']};{$i['metak']};{$i['metad']};\n";
		}
	$output = iconv('UTF-8','windows-1251',$output);
	echo $output;
        $LOG->saveLog($user->get_property('userID'),"Экспорт CVS: Объектов - ".count($registry['realty']).", Кат - $tip");
	exit;
}


if((empty($_GET['section']) OR $_GET['section']=='default') and get_access('admin','tools','view', false)) {

	$sql="SELECT `#__real_cat`.* FROM `#__real_cat` ORDER BY `#__real_cat`.`table` ASC, `#__real_cat`.`id` ASC";
	$registry['real_cat']=getAllcache($sql,600);
}
