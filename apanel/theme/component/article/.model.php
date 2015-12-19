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
setcookie('article_edit',$_GET['edit'],time() + 3600, '/');
if (!empty($_GET['moderate']) and get_access('admin','article','edit', false))
{

    if($registry['onmy']==1)$sql_onmy="and news.user = '".$user->get_property('userID')."'";

    $sql="UPDATE `#__news` SET
			`moderate` = '0'
			WHERE `id`='".intval($_GET['moderate'])."' $sql_onmy LIMIT 1; ";
    $DB->execute($sql);
    $t=4;
    header('location: ?component=article&status=valid&t='.$t);
}
/*
if (!empty($_GET['delete']) and get_access('admin','article','del', false))
{
    if($registry['onmy']==1)$sql_onmy="and news.user = '".$user->get_property('userID')."'";

    $sql="DELETE FROM `#__news` WHERE `#__news`.`id` = ".intval($_GET['delete'])." $sql_onmy LIMIT 1";
    $DB->execute($sql);
    $t=3;
    $LOG->saveLog($user->get_property('userID'),'Материалы: Удаление записи / ID: '.intval($_GET['delete']));
    header('location: ?component=article&status=error&t='.$t);
}*/
if($_GET['section'] == 'add' or $_GET['section'] == 'edit'):
    if (($_POST['update']==1 OR $_POST['add']==1) and get_access('admin','article','edit', false))
    {
        if($registry['onmy']==1)$sql_onmy="and news.user = '".$user->get_property('userID')."'";


        if($_GET['edit'] > 0){
            if(isset($_POST['phconc'])){
                if($_POST['phconc'] == true) {
                    if (is_array($_POST['concurs']) && count($_POST['concurs']) > 0) {
                        $concurs = serialize($_POST['concurs']);

                        $i=0;foreach($_POST['concurs'] as $con):
                            if(count($con['img']) < 3):
                                for($a=0; $a<count($con['img']); $a++):
                                    if(!file_exists($_SERVER['DOCUMENT_ROOT']."/img/uploads/news/fb/".date('Y-m')."/".get_ext($con['img'][$a],'/'))):
                                        resizeCopy($_SERVER['DOCUMENT_ROOT'].str_replace('http://funtime.ge:80','',generate_unknown($con['img'][$a])), get_ext($con['img'][$a],'/'), 485, $_SERVER['DOCUMENT_ROOT']."/img/uploads/news/fb/".date('Y-m'),false);
                                    endif;
                                endfor;
                            else:
                                for($a=0; $a<count($con['img']); $a++):
                                    if(!file_exists($_SERVER['DOCUMENT_ROOT']."/img/uploads/news/fb/".date('Y-m')."/".get_ext($con['img'][$a],'/'))):
                                        resizeCopy($_SERVER['DOCUMENT_ROOT'].str_replace('http://funtime.ge:80','',generate_unknown($con['img'][$a])), get_ext($con['img'][$a],'/'), 285, $_SERVER['DOCUMENT_ROOT']."/img/uploads/news/fb/".date('Y-m'),3);
                                    endif;
                                endfor;
                            endif;
                            $i++;endforeach;

                        $check_concurs = $DB->getOne("SELECT id FROM #__news_gallery_com WHERE news_id=" . intval($_GET['edit']));
                        if ($check_concurs > 0) {
                            $DB->execute("UPDATE #__news_gallery_com SET gallery='{$concurs}',updated_at='".date('Y-m-d H:i:s')."' WHERE news_id=" . intval($_GET['edit']));
                        } else {
                            $DB->execute("INSERT INTO #__news_gallery_com (news_id,gallery,date,updated_at) VALUES ('" . intval($_GET['edit']) . "','" . $concurs . "','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')");
                        }
                    }else{
                        $concurs = "";
                        $check_concurs = $DB->getOne("SELECT id FROM #__news_gallery_com WHERE news_id=" . intval($_GET['edit']));
                        if ($check_concurs > 0) {
                            $DB->execute("UPDATE #__news_gallery_com SET gallery='{$concurs}' WHERE news_id=" . intval($_GET['edit']));
                        }
                    }
                }
            }
        }


        $title=PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])));
        $youtube=PHP_slashes(htmlspecialchars(strip_tags($_POST['youtube'])));
        $youtube = parse_url($youtube);
        parse_str($youtube['query'],$youtube);
        $youtube = $youtube['v'];
        $title_short=PHP_slashes(htmlspecialchars(strip_tags($_POST['title_short'])));
        $chpu=PHP_slashes(htmlspecialchars(strip_tags($_POST['chpu'])));
        $meta_desc=PHP_slashes(htmlspecialchars(strip_tags($_POST['meta_desc'])));
        $meta_key=PHP_slashes(htmlspecialchars(strip_tags($_POST['meta_key'])));
        $framecolor=PHP_slashes(htmlspecialchars(strip_tags($_POST['framecolor'])));
        $rubcolor=PHP_slashes(htmlspecialchars(strip_tags($_POST['rubcolor'])));
        $color = array('frame'=>$framecolor,'rubric'=>$rubcolor);
        $fb_sql=PHP_slashes(htmlspecialchars(strip_tags($_POST['fbf'])));
        $info = serialize($_POST['info']);
        $color = serialize($color);
        $sponsored = intval($_POST['sponsored']);
        $phg=PHP_slashes(htmlspecialchars(strip_tags($_POST['phg'])));
        $slide_type = (isset($_POST['slide_type']) > 0) ? '1' : '0';
        if($chpu == $num['chpu']){
            $chpu=generate_ge($title);
        }
        $SQL_PHOTO = '';
        $cat=intval($_POST['cat']);
        if(empty($_POST['copy']['title']) && !empty($_POST['copy']['url'])){
            $error[0] = 'გთხვოთ, ჩაწეროთ წყაროს სათაური.';
        }elseif(!empty($_POST['copy']['title']) && empty($_POST['copy']['url'])){
            $error[0] = 'გთხვოთ, ჩაწეროთ წყაროს ბმული.';
        }else{
            $copy = serialize($_POST['copy']);
        }

        $numbers = array();
        for($i=0;$i<=100;$i++){
            if($i<10){
                $numbers[] = '0'.$i.'';
            }else{
                $numbers[] = ''.$i.'';
            }
        }


        $slider_images = array();
        if(count($_POST['slide']['name']) > 0){
            foreach($_POST['slide']['name'] as $item):
                if(!empty($item)):
                    $slider_images['name'][] = stripslashes($item);
                endif;
            endforeach;
        }
        if(count($_POST['slide']['img']) > 0) {
            $i = 0;
            foreach ($_POST['slide']['img'] as $item):
                if (!empty($item)):
                    $slider_images['img'][] = $item;
                    if (!isset($slider_images['name'][$i])) {
                        $slider_images['name'][$i] = '';
                    }
                    $i++;
                endif;
            endforeach;
        }
        if(count($slider_images['img']) == 1){
            $slide = array();
            $slide_dir = first_par_url($slider_images['img'][0]);
            $slidefiles =glob($_SERVER['DOCUMENT_ROOT'].generate_unknown($slide_dir).'*.{jpeg,gif,png,jpg,JPG,PNG,GIF,JPEG}', GLOB_BRACE);

            $slicount = count($slidefiles);
            // echo generate_unknown($_SERVER['DOCUMENT_ROOT'].$slide_dir);
            if($slicount > 0){
               $i=0; foreach($slidefiles as $fs){
                    if(str2int(last_par_url($fs)) > 0){
                        $slide['img'][] = 'http://funtime.ge:80' . $slide_dir . last_par_url($fs);
                        $slide['name'][] = isset($slider_images['name'][$i]) ? $slider_images['name'][$i] : '';
                        $i++;
                    }
                }
            }

            $slide = base64_encode(serialize(array('img'=>$slide['img'],'name'=>$slide['name'])));

        }else{
            $slide = base64_encode(serialize($slider_images));
        }

        $operation=intval($_POST['op']);
        $comments=intval($_POST['comments']);
        $favorit_news=intval($_POST['favorit_news']);
        $text=str_replace("'", "`",PHP_slashes( $_POST['textarea1']));
        if(!empty($_POST['sakimg'])){

            $sak_dir = first_par_url($_POST['sakimg']);
            $sakfiles =glob($_SERVER['DOCUMENT_ROOT'].generate_unknown($sak_dir).'*.{jpeg,gif,png,jpg,JPG,PNG,GIF,JPEG}', GLOB_BRACE);

            $sakcount = count($sakfiles);
            sort($sakfiles);
            // echo generate_unknown($_SERVER['DOCUMENT_ROOT'].$slide_dir);
            for($i=0;$i<$sakcount; $i++){
                if(in_array(get_file_name(last_par_url($sakfiles[$i])),$numbers)) {
                    $sakim .= '<p><img src="http://funtime.ge:80' . $sak_dir . last_par_url($sakfiles[$i]) . '" width="700"/></p>';
                }
            }
            $text .= '<div class="fix"></div>'.$sakim;
        }
        $text_short=PHP_slashes($_POST['lidi']);
        $date_dd=intval($_POST['date_dd']);
        $date_mm=intval($_POST['date_mm']);
        $date_yy=intval($_POST['date_yy']);
        $style = intval($_POST['style']);
        $user_id = intval($_POST['author']);
        $test = intval($_POST['victo']);
        if(isset($_POST['author']) > 0){
            $author = $user_id;
        }else{
            $author = $user->get_property('userID');
        }
        if($date_dd>31)$date_dd=31;
        if($date_dd<1)$date_dd=1;
        if($date_mm>12)$date_mm=12;
        if($date_mm<1)$date_mm=1;
        if($date_yy>2100)$date_yy=2100;
        if($date_yy<2011)$date_yy=2011;
        $time_hh=intval($_POST['time_hh']);
        $time_mm=intval($_POST['time_mm']);
        if($time_hh>23)$time_hh=23;
        if($time_hh<0)$time_hh=0;
        if($time_mm>59)$time_mm=59;
        if($time_mm<0)$time_mm=0;
        $date=mktime($time_hh,$time_mm,0,$date_mm,$date_dd,$date_yy);
        $date_time = date("Y-m-d H:i:s",$date);//"$date_dd/$date_mm/$date_yy";
        $send_time = unserialize($_POST['send_time']);

        if($operation == 2){
            $group=serialize($_POST['group']);
            if($_POST['add'] == 1){
                $moderate = 2;
            }else{
                $moderate = "`moderate` = '2',";
            }


        }elseif($operation == 3){
            if($user->get_property('gid') == 22 or $user->get_property('gid') == 21){$_POST['group'] = array(1=>24,2=>25,3=>22,4=>21);$msg = 3; $sql_users = "redactor='{$user->get_property('userID')}',";
                if(count($send_time) > 0){
                    for($i=0;$i<=count($send_time);$i++){
                        if($i==1){
                            $send_time[1] = time();
                        }
                    }
                }else{
                    $send_time = array(0=>time(),1=>'',2=>'');
                }
            }
            $group=serialize($_POST['group']);
            $block_edit = "user_block='0',";
            if($_POST['add'] == 1){
                $moderate = 4;
            }else{
                $moderate = "`moderate` = '4',";
            }
        }elseif($operation == 4){
            $block_edit = "user_block='0',";
            $_POST['group'] = array(1=>24,2=>25,3=>22,4=>21);$msg = 3;
            $group=serialize($_POST['group']);
            if($_POST['add'] == 1){
                $moderate = 3;
            }else{
                $moderate = "`moderate` = '3',";
            }
        }else{
            if($user->get_property('gid') == 18){$_POST['group'] = array(0=>22,1=>25,2=>21,3=>24);$msg = 1; $send_time = array(0=>time(),1=>'',2=>'');}
            if($user->get_property('gid') == 22  or $user->get_property('gid') == 21){$_POST['group'] = array(0=>23,1=>24,2=>25,3=>22,4=>21);$msg = 2; $sql_users = "redactor='{$user->get_property('userID')}',";
                if(count($send_time) > 0){
                    for($i=0;$i<=count($send_time);$i++){
                        if($i==1){
                            $send_time[1] = time();
                        }
                    }
                }else{
                    $send_time = array(0=>'',1=>time(),2=>'');
                }
            }
            if($_POST['add'] == 1){
                $moderate = 3;
            }else{
                $moderate = "`moderate` = '3',";
            }

            if($user->get_property('gid') == 23){$_POST['group'] = array(0=>24,1=>25,2=>22,3=>21);$msg = 3; $sql_users = "corrector='{$user->get_property('userID')}',";

                if(count($send_time) > 0){
                    print_r($send_time);

                    for($i=0;$i<=count($send_time);$i++){
                        if($i==1){
                            $send_time[2] = time();
                        }
                    }

                }else{
                    $send_time = array(0=>'',1=>'',2=>time());
                }
                if($_POST['add'] == 1){
                    $moderate = 4;
                }else{
                    $moderate = "`moderate` = '4',";
                }
            }


            if($user->get_property('gid') == 24 or $user->get_property('gid') == 25){
                if($_POST['add'] == 1){
                    $_POST['group'] = array(0=>23,1=>25,2=>22,3=>21);$msg = 2;
                }else{
                    $_POST['group'] = array(0=>0);$msg = 4; $moderate = "`moderate` = '1',";
                }
            }
            $group=serialize($_POST['group']);
            $block_edit = "user_block='0',";
        }
        $send_time = serialize($send_time);

        $show_date=intval($_POST['show_date']);
        $original_url='';
        $tags_en = '';
        $tags_ru = '';
        /*
        $tags=$tags_ru=htmlspecialchars(strip_tags($_POST['tags']));
        $tags=explode(',',$tags);
        $tags_en='';
        foreach($tags as $tag):
            $t_en=generate_chpu($tag);
            if(empty($tags_en))$tags_en=$t_en; else $tags_en=$tags_en.', '.$t_en;
            $DB->show_err=FALSE;
            $sql="	INSERT INTO `#__tags` (`name_rus`, `name_eng`, `count`)
                        VALUES ('".strtolower($tag)."', '".$t_en."','0')";
            $DB->execute($sql);
            $sql="	UPDATE `#__tags` SET `count`=`count`+1
                        WHERE `name_rus`='".strtolower($tag)."'";
            $DB->execute($sql);
        endforeach;
    */
        if(!empty($phg)){
            $phg_check = $DB->getOne('SELECT id FROM #__phgrapher WHERE name="'.$phg.'" ');
            if(!$phg_check){
                $DB->execute('INSERT INTO #__phgrapher (name) VALUES ("'.$phg.'")');
            }
        }

        if($favorit_news==1)
        {
            $sql="UPDATE `#__news` SET `favorit`='0' WHERE `id`>0; ";
            $DB->execute($sql);
        }

        if ($_POST['update']==1)
        {

            if(!empty($title)){
                if($cat > 0){
                    if(!empty($text_short) or $style == 12){
                        if(!empty($text) or $style == 12){
                            $error[0] = "";
                            if($user->get_property('gid') == 24 or $user->get_property('gid') == 25){
                                if(!empty($_POST['photop']) && $_FILES["photo"]["size"]<=0){
                                    $photop = PHP_slashes(htmlspecialchars(strip_tags($_POST['photop'])));
                                    $SQL_PHOTO=" `thumbs` = '$photop', ";
                                    $registry['fbthumb'] = $photop;
                                }else{
                                    $pix = @GetImageSize($_FILES["photo"]['tmp_name']);
                                    if($pix[0] >= 650 && $pix[1] >= 435){
                                        $rand = rand(100,99999);
                                        $name = time().'_'.$rand;
                                        $registry['fbthumb'] = $name.'.jpg';
                                        $prev_sql = date('Y-m').'/'.$name.'.jpg';
                                        $imgdir = '../img/uploads/news/prev/'.$prev_sql;
                                        move_uploaded_file($_FILES['photo']['tmp_name'],$imgdir);
                                        if(!empty($imgdir))
                                        {
                                            $totalpath=$imgdir;//str_replace('../','',$imgpath[1]).'|';
                                            if ($_POST['update']==1) $SQL_PHOTO=" `thumbs` = '$totalpath', ";
                                            if ($_POST['add']==1) $SQL_PHOTO=$totalpath;
                                            if($pix[0] > 655 && $pix[1] > 440){
                                                crop($totalpath,$_POST['pleft'],$_POST['ptop'],655,440);
                                            }
                                        }else{
                                            if($operation == 1){
                                                $error[0] = "გთხოვთ აირჩიოთ ფოტო პრევიუ.";
                                            }
                                        }
                                    }else{
                                        if($operation == 1){
                                            $error[0] = "პრევიუ ფოტოს სიგრძე სავალდებულიოა იყოს არანაკლებ 655px და სიმაღლე არანაკლებ 440px.";
                                        }
                                    }
                                }
                                if(empty($style) && $operation != 2){
                                    if($_POST['cat_type'] <= 0){
                                        $error[0] = "გთხოვთ აირჩიოთ დიზაინი";
                                    }
                                }else{

                                    if($_POST['style'] == 100){
                                        $size = array(0=>695,1=>445);
                                        $sizex = '695x445';
                                    }else{
                                        $sizex = $DB->getOne("SELECT size FROM #__news_style WHERE id='".$style."'");
                                        $size = explode('x',$sizex);
                                    }

                                    $SQL_STYLE = "`style` = '$style',";
                                    if(!empty($_POST['desimg']) && $_FILES['img']['size'] <= 0  && $_POST['imgsz'] == $sizex){
                                        $img = PHP_slashes(htmlspecialchars(strip_tags($_POST['desimg'])));
                                        $SQL_IMG = '`img` = "'.$img.'",';

                                    }else{
                                        if($style != 12){
                                            if($_FILES['img']['size'] > 0){
                                                $px = @GetImageSize($_FILES['img']['tmp_name']);
                                                if($px[0] >= $size[0] && $px[1] >= $size[1]){
                                                    if($_FILES['img']['type'] == 'image/jpeg' or $_FILES['img']['type'] == 'image/gif' or $_FILES['img']['type'] == 'image/png'){

                                                        $rand = rand(100,99999);
                                                        $name = time().'_'.$rand;
                                                        $read_sql = date('Y-m').'/'.$name.'.jpg';
                                                        move_uploaded_file($_FILES['img']['tmp_name'],'../img/uploads/news/read/'.$read_sql);
                                                        if($px[0] > $size[0] && $px[1] > $size[1]){
                                                            crop('../img/uploads/news/read/'.$read_sql,$_POST['left'],$_POST['top'],$size[0],$size[1]);
                                                        }
                                                        $SQL_IMG = '`img` = "'.$read_sql.'",';
                                                        $SQL_STYLE = "`style` = '$style',";
                                                    }else{
                                                        if($operation == 1){
                                                            $error[0] = "გთხოვთ აირჩიოთ JPG,PNG,GIF ფორმატის ფოტო";
                                                        }
                                                    }
                                                }else{
                                                    if($operation == 1){
                                                        $error[0] = "ფოტოს სიგრძე სავალდებულოა იყოს არანაკლებ ".$size[0]."px და სიმაღლე არანაკლებ ".$size[1]."px";
                                                    }
                                                }
                                            }else{
                                                if($operation == 1){
                                                    $error[0] = "თქვენ ცდილობთ შეცვალოთ დიზაინი რომლის ფოტოს ზომა არ ემთხვევა წინა დიზაინის ფოტოს ზომას რაც აუცილებლად მოითხოვს დიზაინის ფოტოს თავიდან ატვირთვას";
                                                }
                                            }
                                        }
                                    }
                                }

                            }
                            if($_FILES['fb']['size'] > 0){
                                $px = @GetImageSize($_FILES['fb']['tmp_name']);
                                if($px[0] == 470 && $px[1] == 247){
                                    $rand = rand(100,99999);
                                    $name = time().'_'.$rand;
                                    $fb_sql = date('Y-m').'/'.$name.'.jpg';
                                    $imgdir = '../img/uploads/news/fb/'.$fb_sql;
                                    move_uploaded_file($_FILES['fb']['tmp_name'],$imgdir);
                                }else{
                                    $error[0] = "Facebook ფოტოს ზომა: 470x247";
                                }
                            }
                            if(empty($error[0])){
                                //$test_chpu = $DB->getOne("SELECT count(#__news.id) FROM `#__news` WHERE `chpu`='$chpu'");
                                // if($test_chpu>0)$chpu=rand(100,9999).'_'.$chpu;
                                $sql="UPDATE `#__news` SET
				`cat` = '$cat',
				`test` = '$test',
				`user` = '$author',
				`send_time` = '$send_time',
				$sql_users
				`title` = '$title',
				`title_short`='$title_short',
				`text` = '$text',
				`text_short`='$text_short',
				`chpu` = '$chpu',
				`show_date` = '$show_date',
				`tags_ru` = '$tags_ru',
				`tags_en` = '$tags_en',
				`time` = '$date_time',
				`date`='$date',
				`favorit`='$favorit_news',
				$SQL_PHOTO
				$SQL_IMG
                `fb`='$fb_sql',
				`slide` = '$slide',
				`slide_type` = '$slide_type',
				`original_url` = '$original_url',
				`comments` = '$comments',
				`group` = '$group',
				$moderate
				`meta_desc`='$meta_desc',
				`meta_key`='$meta_key',
				$block_edit
				`op` = '$operation',
				$SQL_STYLE
				`youtube` = '$youtube',
				`color` = '$color',
				`info` = '$info',
				`copy` = '$copy',
				`sponsored` = '$sponsored',
				`phg` = '$phg'

				WHERE `#__news`.`id`='".intval($_POST['id'])."' LIMIT 1; ";
                                $DB->execute($sql);

                                $t=2;
                                $LOG->saveLog($user->get_property('userID'),'სტატიები: შენახვა | რედაქტირება | გამოქვეყნება / ID: '.intval($_POST['id']));
                                //fb_image();

                                if($_POST['preview'] == 0){
                                    if($user->get_property('userID') != 696){
                                        header('Location: /apanel/index.php?news=1&close=1&msg='.$msg);
                                    }
                                }else{
                                    if($user->get_property('userID') != 696){
                                        header('Location: /apanel/index.php?component=article&section=edit&edit='.$_GET['edit']);
                                    }
                                }
                            }else{
                                $message[0] = 'error';
                                $message[1] = $error[0];
                            }
                        }else{
                            $message[0] = 'error';
                            $message[1] = 'ტექსტი ცარიელია';
                        }
                    }else{
                        $message[0] = 'error';
                        $message[1] = 'ლიდი ცარიელია';
                    }
                }else{
                    $message[0] = 'error';
                    $message[1] = 'გთხოვთ აირჩიოთ რუბრიკა.';
                }

            }else{
                $message[0] = 'error';
                $message[1] = 'გთხოვთ ჩაწეროთ სათაური';
            }

        }

        if ($_POST['add']==1)
        {
            if(empty($error[0])){

                if(!empty($title)){

                    if($cat > 0){
//                        if(!empty($text_short)){
//                            if(!empty($text)){

                                $sql="	UPDATE `#__users` SET `karma`=`karma`+1
					WHERE `id`='".$user->get_property('userID')."'";
                                $DB->execute($sql);

                                $test_chpu = $DB->getOne("SELECT count(#__news.id) FROM `#__news` WHERE `chpu`='$chpu'");
                                if($test_chpu>0)$chpu=rand(100,9999).'_'.$chpu;

                                $sql="INSERT INTO `osr_news`(`user`, `redactor`, `corrector`, `send_time`, `cat`, `test`, `title`, `title_short`, `text`, `text_short`, `rate`, `chpu`, `time`, `date`, `show_date`, `view`, `tags_ru`, `tags_en`, `original_url`, `thumbs`, `img`, `slide`, `youtube`, `comments`, `moderate`, `group`, `favorit`, `meta_desc`, `meta_key`, `user_block`, `op`, `style`, `color`,`info`,`copy`,`phg`) VALUES
                                                                         ('$author',0,0,'$send_time','$cat',0,'$title','$title_short','$text','$text_short',0,'$chpu','$date_time','$date','$show_date',1,'$tags_ru','$tags_en','$original_url','$SQL_PHOTO','','$slide','$youtube','$comments','$moderate','$group','$favorit_news','$meta_desc','$meta_key',0,'$operation',0,0,'$info','$copy','$phg')";

                                if($DB->execute($sql)){
                                    $t=1;
                                    $LOG->saveLog($user->get_property('userID'),'სტატიები: დამატება / ID: '.$DB->id);
                                    header('Location: /apanel/index.php?news=1&msg='.$msg);
                                }
//                            }else{
//                                $message[0] = 'error';
//                                $message[1] = 'ტექსტი ცარიელია';
//                            }
//                        }else{
//                            $message[0] = 'error';
//                            $message[1] = 'ლიდი ცარიელია';
//                        }
                    }else{
                        $message[0] = 'error';
                        $message[1] = 'გთხოვთ აირჩიოთ რუბრიკა.';
                    }
                }else{
                    $message[0] = 'error';
                    $message[1] = 'გთხოვთ ჩაწეროთ სათაური';
                }
            }else{
                $message[0] = 'error';
                $message[1] = $error[0];
            }

        }


    }

    $filter_p='';
    if((!empty($_POST['filter-cat']) OR !empty($_COOKIE['filter-cat'])) and $_POST['filter-cat']!=='none'):
        if(!empty($_POST['filter-cat'])):
            $val=intval($_POST['filter-cat']);
            setcookie('filter-cat',$val,time()+36000,'/');
        else:
            $val=intval($_COOKIE['filter-cat']);
        endif;
        $filter_p=" and `#__news`.`cat` =".$val;
    endif;
    if($_POST['filter-cat']=='none')
    {
        setcookie('filter-cat','',time()-36000,'/');
    }

    if(get_access('admin','article','view', false)):

        if($registry['onmy']==1)$sql_onmy="and `#__news`.`user` = '".$user->get_property('userID')."'";
        /*
        //---------------------------------------------
            $page	                = intval($_GET['page']);

            // Переменная хранит число сообщений выводимых на станице
            $num = 15;
            // Извлекаем из URL текущую страницу
            if ($page==0) $page=1;
            // Определяем общее число сообщений в базе данных
            $posts = $DB->getOne("SELECT count(`#__news`.`id`) FROM `#__news` WHERE `#__news`.`id`>'0' $sql_onmy $filter_p");
            $postsmoder = $DB->getOne("SELECT count(`#__news`.`id`) FROM `#__news` WHERE `moderate`='1' and `#__news`.`id`>'0' $filter_p $sql_onmy");
            $registry['posts']=$posts;
            $registry['postsmoder']=$postsmoder;
            // Находим общее число страниц
            $total = intval(($posts - 1) / $num) + 1;

            // Определяем начало сообщений для текущей страницы
            $page = intval($page);
            // Если значение $page меньше единицы или отрицательно
            // переходим на первую страницу
            // А если слишком большое, то переходим на последнюю
            if(empty($page) or $page < 0) $page = 1;
            if($page > $total) $page = $total;
            // Вычисляем начиная к какого номера
            // следует выводить сообщения
            $start = $page * $num - $num;

            // Проверяем нужны ли стрелки назад
            $link_url='index.php?component=article&section=default';
            if ($page != 1) $pervpage = '<a href="'.$link_url.'&page=-1">პირველი...</a>
                                       <a href="'.$link_url.'&page='. ($page - 1).'">წინა...</a> ';
            if ($page != $total) $nextpage = '  <a href="'.$link_url.'&page='. ($page + 1).'">შემდეგი...</a>
                                           <a href="'.$link_url.'&page='.$total.'">ბოლო...</a> ';
            // Находим две ближайшие станицы с обоих краев, если они есть
            if($page - 2 > 0) $page2left = ' <a href="'.$link_url.'&page='. ($page - 2) .'">'. ($page - 2) .'</a>  ';
            if($page - 1 > 0) $page1left = '<a href="'.$link_url.'&page='. ($page - 1) .'">'. ($page - 1) .'</a>  ';
            if($page + 2 <= $total) $page2right = '  <a href="'.$link_url.'&page='. ($page + 2).'">'. ($page + 2) .'</a>';
            if($page + 1 <= $total) $page1right = '  <a href="'.$link_url.'&page='. ($page + 1).'">'. ($page + 1) .'</a>';

        //---------------------------------------------
        */
        $all = $DB->getAll('SELECT * FROM #__category WHERE podcat=0 and section="post" and stat="0" order by name asc');
        $i=0;
        foreach($all as $nu):
            $category[$nu['id']][0]=$nu;
            $i++;
        endforeach;

        $all = $DB->getAll('SELECT * FROM #__category WHERE podcat>0 and section="post" and stat="0" order by name asc');
        $i=0;
        foreach($all as $nu):
            $category[$nu['podcat']][]=$nu;
            $i++;
        endforeach;
        /*
               $all = $DB->getAll("SELECT #__news.*, #__category.name, #__category.podcat
                       FROM #__news LEFT JOIN #__category ON #__category.id=#__news.cat
                       WHERE #__news.id>0 $sql_onmy $filter_p
                       ORDER BY `#__news`.`id` DESC LIMIT $start, $num");
       */
        $groups = $DB->getAll('SELECT `#__group`.* FROM `#__group` ORDER BY id DESC');
    endif;


    $registry['design'] = $DB->getAll("SELECT * FROM #__news_style order by id ASC");

    $sql = "SELECT realname,id FROM #__users WHERE group_id = 3 or group_id=6 order by realname asc";
    $registry['authors'] = $DB->getAll($sql);


    if($_GET['component'] == 'article' && $_GET['section'] == 'edit' && $_GET['edit'] > 0){
        $registry['victo'] = $DB->getAll("SELECT * FROM #__tests WHERE type='1'");
    }
endif;

if($_GET['section'] == 'ajax'){
    @include('.ajax_call.php');
}
