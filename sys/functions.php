<?php
/**
 * Author: Salikh Gurgenidze
 * Nickname: Vati Child
 * E-mail: vatia0@gmail.com
 * Copyright: VC cms
 */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

function add_pr ($str,$count) {
    $str=iconv('UTF-8','WINDOWS-1251',$str);
    $i = 0;$no_pr = 0;$j = 1;
    while ($i < strlen($str))
    {
        $text[$j] = $text[$j].$str[$i];
        if ($str[$i] == ' '){$no_pr = 0;$j = $j+1;}
        if ($str[$i] != ' '){$no_pr = $no_pr+1;}
        if ($no_pr == $count){$text[$j] = $text[$j].' ';$no_pr = 0;}
        $i = $i+1;
    }
    while ($j != 0){$st = $st.$text[$j];$j = $j-1;}
    $st=iconv('WINDOWS-1251','UTF-8',$st);
    return $st;
}

function PHP_slashes($string,$type='add') {
    if ($type == 'add')
    {
        if (get_magic_quotes_gpc())
        {
            return $string;
        }
        else
        {
            if (function_exists('addslashes'))
            {
                return addslashes($string);
            }
            else
            {
                return mysql_real_escape_string($string);
            }
        }
    }
    else if ($type == 'strip')
    {
        return stripslashes($string);
    }
    else
    {
        die('error in PHP_slashes (mixed,add | strip)');
    }
}

if(!function_exists('utf8_strlen')) {
    function utf8_strlen($s)
    {
        return preg_match_all('/./u', $s, $tmp);
    }
}

if(!function_exists('utf8_substr')) {
    function utf8_substr($s, $offset, $len = 'all')
    {
        if ($offset<0) $offset = utf8_strlen($s) + $offset;
        if ($len!='all')
        {
            if ($len<0) $len = utf8_strlen2($s) - $offset + $len;
            $xlen = utf8_strlen($s) - $offset;
            $len = ($len>$xlen) ? $xlen : $len;
            preg_match('/^.{' . $offset . '}(.{0,'.$len.'})/us', $s, $tmp);
        }
        else
        {
            preg_match('/^.{' . $offset . '}(.*)/us', $s, $tmp);
        }
        return (isset($tmp[1])) ? $tmp[1] : false;
    }
}
if(!function_exists('utf8_strpos')) {
    function utf8_strpos($str, $needle, $offset = null)
    {
        if (is_null($offset))
        {
            return mb_strpos($str, $needle);
        }
        else
        {
            return mb_strpos($str, $needle, $offset);
        }
    }
}
if(!function_exists('generate_chpu')) {
    function generate_chpu ($str)
    {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '',  'ы' => 'y',   'ъ' => '',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '',  'Ы' => 'Y',   'Ъ' => '',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        $str = strtr($str, $converter);
        $str = strtolower($str);
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        $str = trim($str, "-");
        return $str;
    }
}

if(!function_exists('generate_ge')) {
    function generate_ge ($str)
    {
        //$str = iconv('windows-1251','utf-8',$str);
        $converter = array(
            'ა' => 'a',   'ბ' => 'b',   'ვ' => 'v',
            'გ' => 'g',   'დ' => 'd',   'წ' => 'w',
            'ე' => 'e',   'ჟ' => 'zh',  'ზ' => 'z',
            'ი' => 'i',   'კ' => 'k',
            'ლ' => 'l',   'მ' => 'm',   'ნ' => 'n',
            'ო' => 'o',   'პ' => 'p',   'რ' => 'r',
            'ს' => 's',   'ტ' => 't',   'უ' => 'u',
            'ფ' => 'f',   'ჰ' => 'h',   'ც' => 'c',
            'ჩ' => 'ch',  'შ' => 'sh',  'თ' => 't',
            'ყ' => 'y',   'იუ' => 'yu',
            'ჯ' => 'j',   'ხ' => 'x',
            'ხ' => 'x', 'ქ' => 'q', 'ზ' => 'z',
            'ძე' => 'dze', 'ძ' => 'Z',

            'ა' => 'A',   'ბ' => 'B',   'ვ' => 'V',
            'გ' => 'G',   'დ' => 'D',   'ჯ' => 'J',
            'ე' => 'E',   'ჟ' => 'Zh',  'ზ' => 'Z',
            'ი' => 'I',   'ყ' => 'Y',   'კ' => 'K',
            'ლ' => 'L',   'მ' => 'M',   'ნ' => 'N',
            'ო' => 'O',   'პ' => 'P',   'რ' => 'R',
            'ს' => 'S',   'ტ' => 'T',   'უ' => 'U',
            'ფ' => 'F',   'ჰ' => 'H',    'ც' => 'C',
            'ჩ' => 'Ch',  'შ' => 'Sh',   'ხ' => 'X',
            'ჭ' => 'W',   'ფ' => 'f',   'ღ' => 'R',
            'ქ' => 'Q', 'ძე' => 'DZE',
        );
        $str = strtr($str, $converter);
        $str = strtolower($str);
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        $str = trim($str, "-");
        return $str;
    }
}



function generate_unknown($str){
    $convert = array (
        '%E1%83%90'=>'ა',
        '%E1%83%91'=>'ბ',
        '%E1%83%92'=>'გ',
        '%E1%83%93'=>'დ',
        '%E1%83%94'=>'ე',
        '%E1%83%95'=>'ვ',
        '%E1%83%96'=>'ზ',
        '%E1%83%97'=>'თ',
        '%E1%83%98'=>'ი',
        '%E1%83%99'=>'კ',
        '%E1%83%9A'=>'ლ',
        '%E1%83%9B'=>'მ',
        '%E1%83%9C'=>'ნ',
        '%E1%83%9D'=>'ო',
        '%E1%83%9E'=>'პ',
        '%E1%83%9F'=>'ჟ',
        '%E1%83%A0'=>'რ',
        '%E1%83%A1'=>'ს',
        '%E1%83%A2'=>'ტ',
        '%E1%83%A3'=>'უ',
        '%E1%83%A4'=>'ფ',
        '%E1%83%A5'=>'ქ',
        '%E1%83%A6'=>'ღ',
        '%E1%83%A7'=>'ყ',
        '%E1%83%A8'=>'შ',
        '%E1%83%A9'=>'ჩ',
        '%E1%83%AA'=>'ც',
        '%E1%83%AB'=>'ძ',
        '%E1%83%AC'=>'წ',
        '%E1%83%AD'=>'ჭ',
        '%E1%83%AE'=>'ხ',
        '%E1%83%AF'=>'ჯ',
        '%E1%83%B0'=>'ჰ',
        '%20'=>' ');
    $str = strtr($str, $convert);
    return $str;

}
function generate_password($number) {
    $arr = array('a','b','c','d','e','f',
        'g','h','i','j','k','l',
        'm','n','o','p','r','s',
        't','u','v','x','y','z',
        'A','B','C','D','E','F',
        'G','H','I','J','K','L',
        'M','N','O','P','R','S',
        'T','U','V','X','Y','Z',
        '1','2','3','4','5','6',
        '7','8','9','0');
    $pass = "";
    for($i = 0; $i < $number; $i++)
    {
        $index = rand(0, count($arr) - 1);
        $pass .= $arr[$index];
    }
    return $pass;
}






function genpass($number, $param = 1) {
    $arr = array('a','b','c','d','e','f',
        'g','h','i','j','k','l',
        'm','n','o','p','r','s',
        't','u','v','x','y','z',
        'A','B','C','D','E','F',
        'G','H','I','J','K','L',
        'M','N','O','P','R','S',
        'T','U','V','X','Y','Z',
        '1','2','3','4','5','6',
        '7','8','9','0','.',',',
        '(',')','[',']','!','?',
        '&','^','%','@','*','$',
        '<','>','/','|','+','-',
        '{','}','`','~');

    $pass = "";
    for($i = 0; $i < $number; $i++)
    {
        if ($param>count($arr)-1)$param=count($arr) - 1;
        if ($param==1) $param=48;
        if ($param==2) $param=58;
        if ($param==3) $param=count($arr) - 1;

        $index = rand(0, $param);
        $pass .= $arr[$index];
    }
    return $pass;
}

function parseString( $str , $val, $par) {
    if ($par==1)$str = str_replace('\\','',preg_replace("/['\"`!\\/@№;:?#$%^&*()_]/","",@strval($str))); // удаляет все кавычки вообще
    if ($val>=1)$str = trim( $str ); // удаляет пробельные символы вначале и в конце строки
    if ($val>=2)$str = str_replace(' ','',$str); // удаляет вообще все пробелы
    if ($val>=3)$str = preg_replace("/[^\x20-\xFF]/","",@strval($str)); // удаляет непечатаемые, опасные символы
    if ($val>=4)$str = strip_tags( $str ); // удаляет все html тэги
    if ($val>=5)$str = htmlspecialchars( $str, ENT_QUOTES ); // все специальные символы типа кавычек и т.п. перекодируются в вид html сущностей типа "<" и др
    if ($val>=6)$str = mysql_real_escape_string( $str ); // выполняется экранирование строки для sql запроса специальной функцией
    return $str;
}

function email_check($email) {
    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",trim($email)))
    {
        return false;
    }
    else return true;
}

function isIP($ip) {
    return (bool)(ip2long($ip)>0);
}

function getIP() {
    if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
    return $_SERVER['REMOTE_ADDR'];
}

function get_country_code(){
    include_once('geoip/geoip.php');
    $ip = getIP();
    if((strpos($ip, ":") === false)) {
        //ipv4
        $gi = geoip_open("geoip/GeoIP.dat",GEOIP_STANDARD);
        $country = geoip_country_code_by_addr($gi, $ip);
    }
    else {
        //ipv6
        $gi = geoip_open("geoip/GeoIPv6.dat",GEOIP_STANDARD);
        $country = geoip_country_code_by_addr_v6($gi, $ip);
    }
    return $country;
}




function rdate($param, $time=0) {
    if(intval($time)==0)$time=time();
    $MonthNames=array("Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
    if(strpos($param,'M')===false) return date($param, $time);
    else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
}

function gedate($format, $timestamp = 0, $nominative_month = false)
{
    if(!$timestamp) $timestamp = time();
    elseif(!preg_match("/^[0-9]+$/", $timestamp)) $timestamp = strtotime($timestamp);

    $F = $nominative_month ? array(1=>"იანვარი", "თებერვალი", "მარტი", "აპრილი", "მაისი", "ივნისი", "ივლისი", "აგვისტო", "სექტემბერი", "ოქტომბერი", "ნოემბერი", "დეკემბერი") : array(1=>"Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
    $M = array(1=>"იან", "თებ", "მარ", "აპრ", "მაი", "ივნ", "ივლ", "აგვ", "სექ", "ოქტ", "ნოე", "დეკ");
    $l = array("კვირა", "ორშაბათი", "სამშაბათი", "ოთხშაბათი", "ხუთშაბათი", "პარასკევი", "შაბათი");
    $D = array("კვ", "ორ", "სმ", "ოთ", "ხთ", "პრ", "შბ");

    $format = str_replace("F", $F[date("n", $timestamp)], $format);
    $format = str_replace("M", $M[date("n", $timestamp)], $format);
    $format = str_replace("l", $l[date("w", $timestamp)], $format);
    $format = str_replace("D", $D[date("w", $timestamp)], $format);

    return date($format, $timestamp);
}

function string_length($string){
    $string = str_replace(array("\t","\r\n","\n","\0","\v"," "),'', $string);

    return mb_strlen($string, "UTF-8");
}

function filter_html($string){
    $string = str_replace("&quot;",'"',"$string");
    return $string;
}

function title_filter($title,$num){
    $output = '';
    $title_length = mb_strlen($title,"utf-8");
    $title = mb_substr(filter_html($title),0,$num,"utf-8");

    if($title_length >= $num):
        $title = explode(' ',$title);
        $last_word = count($title) - 1;
        for($i=0;$i<$last_word;$i++):
            $output .= $title[$i].' ';
        endfor;
        $output .= '...';
    else:
        $output .= $title;
    endif;
    return strip_tags($output);
}

function firstSymbol($string,$check=0){
    $string = PHP_slashes(htmlspecialchars(strip_tags($string)));
    if($check == 1){
        $first = mb_substr($string,0,1,"utf-8");
    }
    if($first == "&"){
        return false;
    }else{
        return mb_substr($string,0,1,"utf-8");
    }

}
function noFirst($char,$string){
    $find = $char.'(.*)';
    $replace = '\\1';
    echo mb_ereg_replace( $find, $replace, $string );
}

function str_split_unicode($str, $l = 0) {
    if ($l > 0) {
        $ret = array();
        $len = mb_strlen($str, "UTF-8");
        for ($i = 0; $i < $len; $i += $l) {
            $ret[] = mb_substr($str, $i, $l, "UTF-8");
        }
        return $ret;
    }
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}


function last_par_url($string){
    $par = explode('/',$string);
    $last = count($par) - 1;
    return $par[$last];
}

function last_par_url2($string){
    $par = explode('/',$string);
    $last = count($par) - 1;
    $las = $last - 1;
    return $par[$las].'/'.$par[$last];
}

function first_par_url($string){
    $par = explode('/',$string);
    $last = count($par) - 1;
    $string = str_replace('%20',' ',$string);
    $string = str_replace($par[$last],'',$string);
    $string = str_replace('http://funtime.ge:80','',$string);
    $string = str_replace('http://funtime.ge','',$string);
    return $string;
}
function get_ext($string,$ext){
    $par = explode($ext,$string);
    $last = count($par) - 1;
    return $par[$last];
}
function get_file_name($string){
    $par = explode('.',$string);
    return $par[0];
}

function get_banner($id,$cat_id=0,$class = ''){
    global $DB,$registry;
    if($cat_id > 0){
        $time = time();
        $registry['banner'] = getAllcache("SELECT url,width,height,banner,script,date FROM #__banners WHERE name='{$id}' and cat_id='{$cat_id}' and published_at < {$time} and date > {$time} ORDER BY date DESC LIMIT 1",80000,'banners/'.$id.'_'.$cat_id);
    }else{
        $registry['banner'] = $DB->getAll("SELECT url,width,height,banner,script,date FROM #__banners WHERE id='{$id}' LIMIT 1");
    }
    $banner_ext = get_ext($registry['banner'][0]['banner'],'.');
    if($registry['banner'][0]['date'] >= time()){
        if(!empty($registry['banner'][0]['url']))
            if($banner_ext == 'gif' or $banner_ext == 'jpg'):
                return '<a href="'.$registry['banner'][0]['url'].'" class="'.$class.'" target="_blank" style="position:absolute;display:block;width:'.$registry['banner'][0]['width'].'px;height:'.$registry['banner'][0]['height'].'px;"></a><img src="'.$registry['banner'][0]['banner'].'" width="'.$registry['banner'][0]['width'].'" height="'.$registry['banner'][0]['height'].'"/>';
            elseif($banner_ext=='html'):
                return '<iframe src="'.$registry['banner'][0]['banner'].'" type="application/x-shockwave-flash" width="'.$registry['banner'][0]['width'].'" height="'.$registry['banner'][0]['height'].'" frameBorder="0"></iframe>';
            else:
                return '<a href="'.$registry['banner'][0]['url'].'" class="'.$class.'" target="_blank" style="position:absolute;display:block;width:'.$registry['banner'][0]['width'].'px;height:'.$registry['banner'][0]['height'].'px;"></a><object data="'.$registry['banner'][0]['banner'].'"  data-url="'.$banner_ext.'" type="application/x-shockwave-flash" width="'.$registry['banner'][0]['width'].'" height="'.$registry['banner'][0]['height'].'"><param name="wmode" value="opaque" /></object>';
            endif;
        else
            if($banner_ext == 'gif' or $banner_ext == 'jpg'):
                return '<img src="'.$registry['banner'][0]['banner'].'" width="'.$registry['banner'][0]['width'].'" height="'.$registry['banner'][0]['height'].'"/>';
            elseif($banner_ext == 'js'):
                return '<script src="'.$registry['banner'][0]['banner'].'"></script>'.base64_decode($registry['banner'][0]['script']);
            elseif($banner_ext=='html'):
                return '<iframe src="'.$registry['banner'][0]['banner'].'" type="application/x-shockwave-flash" width="'.$registry['banner'][0]['width'].'" height="'.$registry['banner'][0]['height'].'" frameBorder="0"></iframe>';
            else:
                return '<object data="'.$registry['banner'][0]['banner'].'" type="application/x-shockwave-flash" width="'.$registry['banner'][0]['width'].'" height="'.$registry['banner'][0]['height'].'"><param name="wmode" value="opaque" /></object>';
            endif;
    }else{
        return false;
    }
}

function get_serie($title){
    preg_match_all('#\((.*?)\)#', $title, $match);
    $last = count($match) - 1;
    $l = count($match[$last]) - 1;
    return $match[$last][$l];
}

function bigintval($value) {
    $value = trim($value);
    if (ctype_digit($value)) {
        return $value;
    }
    $value = preg_replace("/[^0-9](.*)$/", '', $value);
    if (ctype_digit($value)) {
        return $value;
    }
    return 0;
}


function getRedBullBanner(){
    $output = '<canvas id="banner800X100" width="800" height="100"></canvas>
    <script src="/html5/RedBull/JS/RedBullBanner_800X100.js?ver=1"></script>
    <script>
        var banner_800X100;
        function initProject()
        {
            banner_800X100 = new RedBullBanner_800X100("banner800X100",onBanner800X100Click);
        }

        function onBanner800X100Click()
        {
            window.open("http://mywings.redbull.com/ge-ka/", "_blank");
        }
        window.onLoad = initProject();
    </script>';
    return $output;
}

function str2int($string) {
    $length = strlen($string);
    for ($i = 0, $int = ''; $i < $length; $i++) {
        if (is_numeric($string[$i]))
            $int .= $string[$i];
        else break;
    }

    return (int) $int;
}


function clear_cache(){
    $files = glob('../cache/{,.}*', GLOB_BRACE);
    foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
    }
    $files = glob('../cache/news/{,.}*', GLOB_BRACE);
    foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
    }
    $files = glob('../cache/popular/{,.}*', GLOB_BRACE);
    foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
    }
    $files = glob('../cache/contest/{,.}*', GLOB_BRACE);
    foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
    }
    $files = glob('../cache/banners/{,.}*', GLOB_BRACE);
    foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
    }
    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != ".." && $object!=date('Y-m-d')) {
                    if (filetype($dir."/".$object) == "dir")
                        rrmdir($dir."/".$object);
                    else unlink   ($dir."/".$object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
    rrmdir('../cache/ip');
}


function get_banners_f(){ global $registry;?>
<?if(function_exists('get_banner')):?>
    <?if(get_banner('F6',$registry['post'][0]['cat_id']) == true):?>
        <div style="float:right;position:relative;top:0;width:200px;<?if(get_banner('F9',$registry['post'][0]['cat_id']) == false):?>position:fixed;right:0;top:20%;z-index:999;<?endif;?>">
            <div class="saknatuno-banner-place">
                <?=get_banner('F6',$registry['post'][0]['cat_id']);?>
            </div>
            <br>
            <?if(get_banner('F7',$registry['post'][0]['cat_id']) == true):?>
                <div class="saknatuno-banner-place">
                    <?=get_banner('F7',$registry['post'][0]['cat_id']);?>
                </div>
                <br>
            <?endif;?>
            <?if(get_banner('F8',$registry['post'][0]['cat_id']) == true):?>
                <div class="saknatuno-banner-place">
                    <?=get_banner('F8',$registry['post'][0]['cat_id']);?>
                </div>
                <br>
            <?endif;?>
            <?if(get_banner('F9',$registry['post'][0]['cat_id']) == true):?>
                <div class="saknatuno-banner-place">
                    <?=get_banner('F9',$registry['post'][0]['cat_id']);?>
                </div>
                <br>
            <?endif;?>
            <?if(get_banner('F10',$registry['post'][0]['cat_id']) == true):?>
                <div class="saknatuno-banner-place">
                    <?=get_banner('F10',$registry['post'][0]['cat_id']);?>
                </div>
                <br>
            <?endif;?>
            <?if(get_banner('F11',$registry['post'][0]['cat_id']) == true):?>
                <div class="saknatuno-banner-place">
                    <?=get_banner('F11',$registry['post'][0]['cat_id']);?>
                </div>
                <br>
            <?endif;?>
            <?if(get_banner('F12',$registry['post'][0]['cat_id']) == true):?>
                <div class="saknatuno-banner-place">
                    <?=get_banner('F12',$registry['post'][0]['cat_id']);?>
                </div>
                <br>
            <?endif;?>
        </div>
    <?endif;?>
<?endif;?>
<?
}
?>