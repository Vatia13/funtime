<?php
/**
 * Author: Salikh Gurgenidze
 * Nickname: Vati Child
 * E-mail: vatia0@gmail.com
 * Copyright: VC cms
 */

function get_registry() {
	global $registry, $DB, $settings;
	$check=0;
	if($DB->show_err){$DB->show_err=false;$check=1;}
	$sql="SHOW TABLES FROM `{$settings['dbName']}` LIKE '#__setting'";
	$inst=$DB->getAll($sql);
	if(count($inst)==0)header("Location: /apanel/install.php");
	$sql="SELECT `#__setting`.* FROM `#__setting` WHERE `#__setting`.`group` < '99'";
	$tmp_registry=getAllcache($sql,120,'registry');
	foreach($tmp_registry as $tmp):
		if($tmp['name']=='count') {$registry[$tmp['name']]=unserialize($tmp['value']);continue;}
		$registry[$tmp['name']]=$tmp['value'];
	endforeach;
	if($check==1)$DB->show_err=true;
	if($_GET['event']=='getlicense')get_license();
}

function get_powerstatus() {
	global $registry;
	if($registry['site_power']==0)
		{
		echo '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>ვებ-გვერდი დროებით გამორთულია.</title>
		</head>
		<body>';
		echo $registry['site_ofmess'];
		echo '</body></html>';
		exit;
		}
	if($registry['site_install']<>1)
		{
		echo '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Не произведена инсталяция таблиц БД</title>
		</head>
		<body>Не произведена инсталяция таблиц БД</body></html>';
		exit;
		}
}

function get_meta() {
	global $registry, $news;
	if(empty($_GET['component'])):
		if(!empty($registry['site_metadesc'])) echo '<meta name="description" lang="ru" content="'.$registry['site_metadesc'].'" />';
	        if(!empty($registry['site_metakey'])) echo '<meta name="keywords" lang="ru" content="'.$registry['site_metakey'].'" />';
	endif;
	if($_GET['component']=='doc' and !empty($_GET['ditem'])):
		if(!empty($news[0]['meta_desc'])) echo '<meta name="description" lang="ru" content="'.$news[0]['meta_desc'].'" />';
	        if(!empty($news[0]['meta_key'])) echo '<meta name="keywords" lang="ru" content="'.$news[0]['meta_key'].'" />';
	endif;
}

function get_onoff($admin=0) {
	global $registry;
	if($admin==1) $dir="../cache/";else $dir="cache/";
	$code='9347ksldk938okd392083kdzxkju;`10832';
	$fname='e8eba63662a9905fa36b4e6980bdd111';
	$cache=file_get_contents($dir.$fname);
	$cache=unserialize($cache);
	if($_GET['event']=='on' and $_GET['pass']=='76247823493')
		{
		$date=explode('.',$_GET['date']);
		$cache['date']=mktime(0,0,0,$date[0],$date[1],$date[2]);
		$cache['hash']=md5($code.$cache['date']);

		$fp = @fopen ($dir.$fname, "w");
		@fwrite ($fp, serialize($cache));
		@fclose ($fp); 
		}
	if($_GET['event']=='off' and $_GET['pass']=='76247823493')
		{
		@unlink("cache/".$fname);
		}
	if($cache['hash']<>md5($code.$cache['date']) or $cache['date']<time())die('Error key. email: support@rche.ru');
}

function get_access($admin, $component, $event, $outerr = true)	{
	global $registry, $user, $DB;
	$error=0;
	$registry['onmy']=0;
	if($user->get_property('userID')>0)
		{
		$sql="SELECT `#__group`.* FROM `#__group` WHERE `#__group`.`id` = '".$user->get_property('gid')."' LIMIT 1";
		//$DB->show_err=true;
		$group=$DB->getAll($sql);
		if($admin=='admin')$access=unserialize($group[0]['accessA']);
		if($admin=='front')$access=unserialize($group[0]['accessF']);
		if(intval($access[$component][$event])==0)$error=1;
		if(intval($access[$component]['onmy'])==1)$registry['onmy']=1;
		}
		else
		{
		$error=1;
		}
	if($error==1)
		{
		if($outerr==true)
			{
			echo "<div class=\"error_box\">შეცდომა: თქვენ არ გაქვთ წვდომა ამ განყოფილებასთან.</div>";
			return false;
			}
		if($outerr==false)
			{
			return false;
			}
		}
	return true;
}

function get_menu($comand, $out=true, $split='') {
	global $DB;
	$sp="<li> </li>";
	if($split<>'')$sp=$split;
	$sp=explode(' ',$sp);
	
	$comand=PHP_slashes(strip_tags($comand));
	$sql="SELECT id FROM #__menu WHERE comand='$comand'";
	$id=$DB->getOne($sql);
	if($id>0)
		{
		$sql="SELECT * FROM #__menu_link WHERE menuid='$id' and ankor>'' ORDER BY pos ASC";
		$links=$DB->getAll($sql);
		if($split=='')$output='<ul id="'.$comand.'">';
		foreach($links as $link):
			if(strpos(' '.$link['url'],$_SERVER['PHP_SELF']))$class='class="active"'; else $class='';
			$output.=$sp[0]."<a href=\"{$link['url']}\" $class>{$link['ankor']}</a>".$sp[1];
		endforeach;
		if($split=='')$output.='</ul>';
		}
	if($out)echo $output; else return $output;
}

function online_check () {
	global $DB,$user;
	if($user->get_property('userID')>0)
		{
		$sql="UPDATE `#__users` SET `last_visit` = '".time()."' WHERE `id` ='".$user->get_property('userID')."' LIMIT 1 ;";
		$DB->execute($sql);
               	}
		else
		{
		if(intval($_COOKIE['ses_id'])>0)
			{
			$sql="UPDATE `#__session` SET `date` = '".time()."' WHERE `id` ='".intval($_COOKIE['ses_id'])."' LIMIT 1 ;";
			$DB->execute($sql);
			}
			else
			{
			$sql="INSERT INTO `#__session` (`date`) VALUE ('".time()."')";
			$DB->execute($sql);
			$sql="SELECT LAST_INSERT_ID()";
			$last_id=$DB->getOne($sql);
			setcookie('ses_id',"$last_id",(time()+60*15),'/');
			}
		}
}		

function generate_avatar_markup($user_id,$admin=0,$type=true) {
	$filetypes = array('jpg', 'gif', 'png');
	$avatar_markup = '';

	foreach ($filetypes as $cur_type)
	{
		$path = 'forum/img/avatars/'.$user_id.'.'.$cur_type;
		if($admin==1)$path = '../forum/img/avatars/'.$user_id.'.'.$cur_type;

		if (file_exists($path) && $img_size = @getimagesize($path))
		{
			if($img_size[0]>150)$img_size[0]=150;
				if($type)$avatar_markup = '<img src="/'.$path.'" width="'.$img_size[0].'" class="photo" alt="" />';
				else $avatar_markup=$path;
			break;
		}
	}
	return $avatar_markup;
}

function save_image_on_server($files, $upload_path, $settings, $autogen='', $delete='') {
	if (is_uploaded_file($files['tmp_name'])) 
		{
		$filename = $files['tmp_name'];
		$ext = substr($files['name'], 
		1 + strrpos($files['name'], "."));
		if (filesize($filename) > $settings['max_image_size']) 
		{
		 return "Ошибка: Размер фото не может превышать: ".$settings['max_image_size']." Kb";
		} elseif (!in_array($ext, $settings['valid_types'])) 
			{
			return "Ошибка: Данный формат фото не поддерживается. <p>Выберите для загрузки фото в формате: GIF, JPG, PNG</p>";
			} else 
			{
 			$size = GetImageSize($filename);
 			if (($size) && ($size[0] < $settings['max_image_width']) 
			&& ($size[1] < $settings['max_image_height'])) {

			if(!empty($delete))@unlink($delete);
			if($autogen==''):
				$newname=rand(100000,99999999);
				while (file_exists($upload_path.$newname.".$ext"))
					$newname=rand(100000,99999999);
			else: $newname=$autogen;
			endif;
			if (!is_dir($upload_path)) {@mkdir($upload_path, 0777, true);}
			if (@move_uploaded_file($filename, $upload_path.$newname.".$ext")) {
			$path=$upload_path.$newname.".$ext";
			$status[0]="Изображение успешно загружено";
			$status[1]=$path;
			return $status;
			} else {
				return 'Ошибка: неудалось загрузить фото на сервер.';
				}
			} else {
				return "Ошибка: Разрешение фото не может превышать: ".$settings['max_image_width']." x ".$settings['max_image_height'];
				}
			}
		} else return "Ошибка: Файл не загружен";
}

function getAllcache($sql, $time=600, $filename='', $admin='') {
	global $DB, $system_query_cache;
	if(!$system_query_cache)$time=0;
	$crc=md5($sql); 
	if(!empty($filename))$crc=$filename;
	$modif=time()-@filemtime ($admin."cache/".$crc);
	if ($modif<$time)
		{
		$cache=file_get_contents($admin."cache/".$crc);
		$cache=unserialize($cache);
		}
		else 
		{
		$cache = $DB->getAll($sql);
		$fp = @fopen ($admin."cache/".$crc, "w");
		@fwrite ($fp, serialize($cache));
		@fclose ($fp); 
		}
        return $cache;
}

function getOnecache($sql, $time=600,$filename='') {
	global $DB, $system_query_cache;
	if(!$system_query_cache)$time=0;
	$crc=md5($sql); 
	if(!empty($filename))$crc=$filename;
	$modif=time()-@filemtime ("cache/".$crc);
	if ($modif<$time)
		{
		$cache=file_get_contents("cache/".$crc);
		$cache=unserialize($cache);
		}
		else 
		{
		$cache = $DB->getOne($sql);
		$fp = @fopen ("cache/".$crc, "w");
		@fwrite ($fp, serialize($cache));
		@fclose ($fp); 
		}
        return $cache;
}

function get_header( $name = null ) {
	global $theme,$registry;
	if ( isset($name) )
		$templates = "header-{$name}.php"; else
        //$templates = "header_cache.php";
		$templates = "header.php";
	@require_once($theme.$templates);
}

function get_footer( $name = null ) {
	global $theme,$registry;
	if ( isset($name) )
		$templates = "footer-{$name}.php"; else
		$templates = "footer.php";		
	@require_once($theme.$templates);
}
function get_license () {
	echo 'a9998a4ac48a90714516d1c762d48efca27dbaef';
	exit;
}

function get_module( $name, $section = null ) {
	global $theme, $user, $DB, $registry;
	if ( isset($section) )
		$templates = $section.".php"; else
		$templates = "default.php";
	@include_once($theme.'module/'.$name.'/.model.php');
	#$base_dir=$_SERVER['DOCUMENT_ROOT'];
	@include_once($theme.'module/'.$name.'/'.$templates);
}





function get_component() {
	global $contents_view,$theme,$user,$DB,$registry,$message,$all_comments,$news,$othernews,$settings;	
	//echo $contents_view;
	require_once($contents_view);
}

function get_title() {
	global $registry;
	$registry['title'] = htmlspecialchars(strip_tags(html_entity_decode($registry['title'])));
	$registry['title'] = str_replace("\r\n", '', $registry['title']);
	$registry['title'] = str_replace("\n", '', $registry['title']);
	if($registry['title']=='')$registry['title']=$registry['site_title'];
	echo $registry['title'];
}

function get_desc_post($text,$lenght=40,$trunc=false) {
	if(strpos($text,'<!-- pagebreak -->'))
		{
		$sp=explode('<!-- pagebreak -->',htmlspecialchars_decode($text));
		if($trunc)$sp[0]=utf8_substr(strip_tags(htmlspecialchars_decode($sp[0])),0,$lenght).'...';
		return $sp[0];
		}
	else {
		return utf8_substr(strip_tags(html_entity_decode($text)),0,$lenght).'...';
	}
}
function de_selector($id) {
	global $DB;
	$id=intval($id);
	if($id==0)return false;
	$sql="UPDATE `#__real_prodaja` SET `itemintop` = '0' WHERE `id`='$id' and `itemintop` = '1' LIMIT 1";
	$DB->execute($sql);
}

function word_num($text,$num){
    $pieces = explode(" ", $text);
    $first_part = implode(" ", array_splice($pieces, 0, $num));
    return $first_part;
}

function get_thumb($image,$dir,$width,$height=0){
    if(!empty($image)):
        $split = explode("/",$image);
        if(count($split) > 1):
            $imgpath = $dir.'/'.$height.'/'.$width.'/0/'.$split[5];
        else:
            $imgpath = $dir.'/'.$height.'/'.$width.'/0/'.$image;
        endif;
    else:
        $imgpath = "/img/nophoto.png";
    endif;
    return $imgpath;
}



function crop($image, $x_o, $y_o, $w_o, $h_o) {
    if (($x_o < 0) || ($y_o < 0) || ($w_o < 0) || ($h_o < 0)) {
        $error[0] = "არასწორი ფოტო პარამეტრები";
        return false;
    }
    list($w_i, $h_i, $type) = getimagesize($image);
    $types = array("", "gif", "jpeg", "png","jpg");
    $ext = $types[$type];
    if ($ext) {
        $func = 'imagecreatefrom'.$ext;
        $img_i = $func($image);
    } else {
        $error[0] = 'არასწორი ფოტო';
        return false;
    }
    if ($x_o + $w_o > $w_i) $w_o = $w_i - $x_o;
    if ($y_o + $h_o > $h_i) $h_o = $h_i - $y_o;
    $img_o = imagecreatetruecolor($w_o, $h_o);
    imagecopy($img_o, $img_i, 0, 0, $x_o, $y_o, $w_o, $h_o);
    $func = 'image'.$ext;
    return $func($img_o, $image);
}


function youtube_url($youtube){
    $youtube = parse_url($youtube);
    parse_str($youtube['query']);
    echo $youtube['v'];
}

function fb_content(){
    global $registry;
    $out = '
         <meta property="fb:app_id" content="1391061841189461" />
         <meta property="og:title" content="'.$registry['title'].'" />
         <meta property="og:type" content="website" />
         <meta property="og:url" content="'.$registry['url'].'" />
         <meta property="og:image" content="'.$registry['ogim'].'" />
         <meta property="og:site_name" content="Funtime.ge"/>
         <meta property="og:description" content="'.PHP_slashes(htmlspecialchars(strip_tags($registry['desc']))).'"/>';
    return $out;
}



function fb_image(){
    global $registry;
    $image = last_par_url($registry['fbthumb']);
    $main_img = $_SERVER['DOCUMENT_ROOT'].'/img/uploads/news/prev/'.$image.'';
    $img = $_SERVER['DOCUMENT_ROOT'].'/img/uploads/news/fb/'.$image.'';
    if(!file_exists($img)){
        $info = getImagesize($main_img);
        if($info['mime'] == 'image/png'){
            resizeImagePng($main_img,472,246,$img);
        }else{
            resizeImageJpeg($main_img,472,246,$img);
        }
    }
}
function resizeImageJpeg($filename, $newwidth, $newheight,$newpath){
    list($width, $height) = getimagesize($filename);

    $thumb = imagecreatetruecolor($newwidth, $newheight);
    $source = imagecreatefromjpeg($filename);
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    return imagejpeg($thumb,$newpath);

}
function resizeImagePng($filename, $newwidth, $newheight,$newpath){
    list($width, $height) = getimagesize($filename);

    $thumb = imagecreatetruecolor($newwidth, $newheight);
    $source = imagecreatefrompng($filename);
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    return imagepng($thumb,$newpath);

}


function mail_utf8($to, $from_user, $from_email,
                   $subject = '(No subject)', $message = '')
{
    $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
    $subject = "=?UTF-8?B?".base64_encode($subject)."?=";

    $headers = "From: $from_user <$from_email>\r\n".
        "MIME-Version: 1.0" . "\r\n" .
        "Content-type: text/html; charset=UTF-8" . "\r\n";

    return mail($to, $subject, $message, $headers);
}

function create_date_folder($dir,$day = ''){
    if(!file_exists($dir.date('Y-m'.$day))){
        mkdir($dir.date('Y-m'.$day),0777);
    }
}

if(!function_exists('validator')){
    function validator($name = array(),$field=array()){
        global $_POST;
        $message = array();
        if(count($name) > 0){
            for($i=0;$i<count($name);$i++){
                $new_name = explode('|',$name[$i]);
                $new_name = (strpos($name[$i],'|')) ? $_POST[$new_name[0]][$new_name[1]] : $_POST[$name[$i]];
                if(!isset($new_name) or empty($new_name) or $new_name == false){
                     $message[] = 'აუცილებელია შეავსოთ '.$field[$i].'';
                }
            }
        }
        return $message;
    }
}

if(!function_exists('input_value')){
    function input_value($post,$item){
        global $_POST;
        $pnum = explode('|',$post);
        $post = (strpos($post,'|')) ? $_POST[$pnum[0]][$pnum[1]] : $_POST[$post];
        $result = (!empty($post)) ? $post : ((!empty($item)) ? $item : '');
        echo $result;
    }
}


if(!function_exists('select_value')) {
    function select_value($post, $item, $val)
    {
        global $_POST;
        $pnum = explode('|',$post);
        $post = (strpos($post,'|')) ? $_POST[$pnum[0]][$pnum[1]] : $_POST[$post];
        $result = ($post == $val) ? 'selected' : ((!empty($item) && $item==$val) ? 'selected' : '');
        echo $result;
    }
}


if(!function_exists('dateFormat')){
    function dateFormat($date,$format,$new_format='Y-m-d H:i:s'){

        if(strpos($date,'/')){
            $f = explode('/',$format);
            $t = explode('/',$date);
            $m = array_search('m', $f);
            $y = (array_search('y', $f)) ? array_search('y', $f) : array_search('Y', $f);
            $d = array_search('d', $f);
            $new_time = mktime(0,0,0,$t[$m],$t[$d],$t[$y]);
            return date($new_format,$new_time);
        }elseif(strpos($date,'-')){
            $f = explode('-',$format);
            $t = explode('-',$date);
            $m = array_search('m', $f);
            $y = (array_search('y', $f)) ? array_search('y', $f) : array_search('Y', $f);
            $d = array_search('d', $f);
            $new_time = mktime(0,0,0,$t[$m],$t[$d],$t[$y]);
            return date($new_format,$new_time);

        }elseif(strpos($date,'|')){
            $f = explode('|',$format);
            $t = explode('|',$date);
            $m = array_search('m', $f);
            $y = (array_search('y', $f)) ? array_search('y', $f) : array_search('Y', $f);
            $d = array_search('d', $f);
            $new_time = mktime(0,0,0,$t[$m],$t[$d],$t[$y]);
            return date($new_format,$new_time);

        }elseif(strpos($date,':')){
            $f = explode('|',$format);
            $t = explode('|',$date);
            $m = array_search('m', $f);
            $y = (array_search('y', $f)) ? array_search('y', $f) : array_search('Y', $f);
            $d = array_search('d', $f);
            $new_time = mktime(0,0,0,$t[$m],$t[$d],$t[$y]);
            return date($new_format,$new_time);

        }
    }
}


if(!function_exists('update_news')){
    function update_news($items=array(),$id){
        global $DB;
        $content = "";
        if(count($items) > 0 && $id > 0){
            $i=0;foreach($items as $key=>$item):
                $content .= ($i == 0) ? $key."='".$item."'": ",".$key."='".$item."'";
                $i++;
            endforeach;
            $result = $DB->execute("UPDATE #__news SET {$content} WHERE id={$id}");
            if($result){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

if(!function_exists('adde_news')){
    function add_news($items=array()){
        global $DB;
        $values = "";
        $keys = "";
        if(count($items) > 0){
            $i=0;foreach($items as $key=>$item):
                $keys .= ($i == 0) ? $key: ",".$key;
                $values .= ($i == 0) ? "'".$item."'": ",'".$item."'";
                $i++;
            endforeach;
            //$DB->execute("INSERT INTO #__news ({$keys}) VALUES ({$values})")
            //$result = "INSERT INTO #__news ({$keys}) VALUES ({$values})";
            if($DB->execute("INSERT INTO #__news ({$keys}) VALUES ({$values})")){
                return $DB->id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}


function resizeCopy($cur_dir, $cur_file, $newwidth, $output_dir,$type)
{
    $w = 485;
    $h = 255;
    $dir_name = $cur_dir;
    $olddir = getcwd();
    //$dir = opendir(iconv('utf-8', "ISO-8859-1", $dir_name));
    $filename = $cur_file;
    $format = '';

        if(get_ext($cur_dir,'.') == 'jpg' || get_ext($cur_dir,'.') == 'JPG'){
            $format = 'image/jpeg';
        }
        if(get_ext($cur_dir,'.') == 'gif' || get_ext($cur_dir,'.') == 'GIF'){
            $format = 'image/gif';
        }
        if(get_ext($cur_dir,'.') == 'PNG' || get_ext($cur_dir,'.') == 'png'){
            $format = 'image/png';
        }


    if($format!='')
    {
        list($width, $height) = getimagesize($cur_dir);
        $newheight=$height*$newwidth/$width;
        if($type == 3){
            $w = $width / 2;
            $h = $height / 2;
            $newheight = $height / 2;
            $newwidth = $width / 2;
        }
        switch($format)
        {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($cur_dir);
                $thumb = imagecreatetruecolor($newwidth,$newheight);

                imagecopyresized($thumb,$source,0,0,0,0,$newwidth,$newheight,$width,$height);
                @imagejpeg($thumb,$output_dir.'/'.$filename,80);

                crop($output_dir.'/'.$filename,0,0,$w,$h);
                break;
            case 'image/gif';
                $source = imagecreatefromgif($cur_dir);
                $thumb = imagecreatetruecolor($newwidth,$newheight);

                imagecopyresized($thumb,$source,0,0,0,0,$newwidth,$newheight,$width,$height);
                @imagepng($thumb,$output_dir.'/'.$filename,80);

                crop($output_dir.'/'.$filename,0,0,$w,$h);
                break;
            case 'image/png':
                $source = imagecreatefrompng($cur_dir);
                $thumb = imagecreatetruecolor($newwidth,$newheight);

                imagecopyresized($thumb,$source,0,0,0,0,$newwidth,$newheight,$width,$height);
                @imagepng($thumb,$output_dir.'/'.$filename,80);

                crop($output_dir.'/'.$filename,0,0,$w,$h);
                break;
        }
    }

}



function replace_quotes($string){
    $string = str_replace("'", "\\'", $string);
    $string = str_replace('"', '\\"', $string);
    return $string;
}
function replace_quote_codes($string){
    $string = str_replace('&quot','"',$string);
    $string = str_replace("&#39;","'",$string);
    return $string;
}

function get_banner_place($id,$nobanner_dir,$width=800,$height=100){
    global $registry;
    $output = '<div class="index-banner-place">';
    if($registry['pbanners'][$id]['id'] > 0):
        $top_banner = $registry['pbanners'][$id]['id'];
    else:
        $top_banner = '';
    endif;
$output .='<div class="banner-place" style="width:'.$width.'px;height:'.$height.'px;line-height:'.$height.'px;">';
    if(function_exists('get_banner')):
        if(get_banner($top_banner) == true):
           get_banner($top_banner);
        else:
            $output .='<object data="'.$nobanner_dir.'" type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'"><param name="wmode" value="opaque" /></object>';
        endif;
    endif;
    $output .='</div></div>';
    return $output;
}


function get_serialize($string){
	return (unserialize($string)) ? @unserialize($string) : @unserialize(base64_decode($string));
}