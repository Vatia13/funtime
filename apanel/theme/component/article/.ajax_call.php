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

if($_POST['update'] == 1 or $_POST['add'] == 1){

    $user_id = (intval($_POST['author']) > 0) ? intval($_POST['author']) : $user->get_property('userID');

    $cat=intval($_POST['cat']);
    $title=PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])));
    $youtube=PHP_slashes(htmlspecialchars(strip_tags($_POST['youtube'])));
    $text_short=PHP_slashes($_POST['lidi']);
    $youtube = parse_url($youtube);
    parse_str($youtube['query'],$youtube);
    $youtube = $youtube['v'];
    $title_short=PHP_slashes(htmlspecialchars(strip_tags($_POST['title_short'])));
    $chpu = PHP_slashes(htmlspecialchars($_POST['chpu']));
    if(!empty($chpu) && $chpu != 'undefined'){
        $chpu=generate_ge($chpu);
    }else{
        $chpu=generate_ge($title);
    }

    $slide_type = ($_POST['slide_type'] == 1) ? '1' : '0';

    $meta_desc=PHP_slashes(htmlspecialchars(strip_tags($_POST['meta_desc'])));
    $meta_key=PHP_slashes(htmlspecialchars(strip_tags($_POST['meta_key'])));
    $framecolor=PHP_slashes(htmlspecialchars(strip_tags($_POST['framecolor'])));
    $rubcolor=PHP_slashes(htmlspecialchars(strip_tags($_POST['rubcolor'])));
    $color = array('frame'=>$framecolor,'rubric'=>$rubcolor);
    $color = serialize($color);
    $victorina = intval($_POST['victorina']);
    $date = strtotime($_POST['published_at']);
    $tm =PHP_slashes(htmlspecialchars(strip_tags($_POST['published_at'])));
    $style = intval($_POST['design']);
    $text=PHP_slashes($_POST['body']);
    $phg=PHP_slashes(htmlspecialchars(strip_tags($_POST['photographer'])));
    $sponsored = intval($_POST['sponsored']);
    $ctitle = PHP_slashes(htmlspecialchars(strip_tags($_POST['ctitle'])));
    $curl = PHP_slashes(htmlspecialchars(strip_tags($_POST['curl'])));
    $copy = array('title'=>$ctitle,'url'=>$curl);
    $copy = serialize($copy);
    $response = array();

    $info = array(
        'address'=>$_POST['address'],
        'facebook'=>$_POST['facebook'],
        'skype'=>$_POST['skype'],
        'mobile'=>$_POST['mobile'],
        'phone'=>$_POST['phone'],
        'email'=>$_POST['email'],
        'website'=>$_POST['website']
    );
    $info = serialize($info);
    $slider_images = array();
    foreach(json_decode($_POST['slider_name']) as $item):
        //if(!empty($item)):
            $slider_images['name'][] = stripslashes($item);
        //endif;
    endforeach;
    $i=0;foreach(json_decode(stripslashes($_POST['slider_img'])) as $item):
        if(!empty($item)):
            $slider_images['img'][] = $item;
            if(!isset($slider_images['name'][$i])){
                $slider_images['name'][$i] = '';
            }
            $i++;
        endif;
    endforeach;
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
//        for($i=0;$i<$slicount; $i++){
//            if(in_array(get_file_name(last_par_url($slidefiles[$i])),$numbers)){
//            $slide['img'][] = 'http://funtime.ge:80'.$slide_dir.last_par_url($slidefiles[$i]);
//            $slide['name'][] = '';
//            }
//        }


        $slide = base64_encode(serialize(array('img'=>$slide['img'],'name'=>$slide['name'])));

    }else{
        $slide = base64_encode(serialize($slider_images));
    }

    if($_POST['update'] == 1){
        $id = intval($_POST['id']);
        $numbers = array();
        for($i=0;$i<=100;$i++){
            if($i<10){
                $numbers[] = '0'.$i.'';
            }else{
                $numbers[] = ''.$i.'';
            }
        }

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


        $concurs_images = array();
        $concurs_img = json_decode(stripslashes($_POST['concurs_img']));
        $concurs_img_name = json_decode(stripslashes($_POST['concurs_img_name']));
        $concurs_name = json_decode(stripslashes($_POST['concurs_name']));
        $i=0;foreach($concurs_name as $item): $i++;
            if(!empty($item)):
                $concurs_images[$i]['name'] = $item;
                $a=0;foreach($concurs_img[$i-1] as $img):
                if(!empty($img)):
                    $concurs_images[$i]['img'][$a] = $img;
                endif;
                $a++;endforeach;

                $b=0;foreach($concurs_img_name[$i-1] as $img_name):
                if(!empty($img_name)):
                    $concurs_images[$i]['img_name'][$b] = $img_name;
                endif;
                $b++;endforeach;
            endif;

        endforeach;


        if (is_array($concurs_images) && count($concurs_images) > 0) {
            $concurs = serialize($concurs_images);

            $i=0;foreach($concurs_images as $con):
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

            $check_concurs = $DB->getOne("SELECT id FROM #__news_gallery_com WHERE news_id=" . intval($id));
            if ($check_concurs > 0) {
                $DB->execute("UPDATE #__news_gallery_com SET gallery='{$concurs}',updated_at='".date('Y-m-d H:i:s')."' WHERE news_id=" . intval($id));
            } else {
                $DB->execute("INSERT INTO #__news_gallery_com (news_id,gallery,date,updated_at) VALUES ('" . intval($id) . "','" . $concurs . "','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')");
            }
        }else{
            $concurs = "";
            $check_concurs = $DB->getOne("SELECT id FROM #__news_gallery_com WHERE news_id=" . intval($id));
            if ($check_concurs > 0) {
                $DB->execute("UPDATE #__news_gallery_com SET gallery='{$concurs}' WHERE news_id=" . intval($id));
            }
        }



        $photop= '';
        if(!empty($_POST['photop']) && $_FILES["photo"]["size"]<=0){
            $photop = PHP_slashes(htmlspecialchars(strip_tags($_POST['photop'])));
            $SQL_PHOTO=" `thumbs` = '$photop', ";
            $totalpath = $photop;
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
                }
            }
        }

        $read_sql = '';
        if(!empty($style)){
            if($style == 100){
                $size = array(0=>695,1=>445);
                $sizex = '695x445';
            }else{
                $sizex = $DB->getOne("SELECT size FROM #__news_style WHERE id='".$style."'");
                $size = explode('x',$sizex);
            }

            if(!empty($_POST['desimg']) && $_FILES['img']['size'] <= 0  && $_POST['imgsz'] == $sizex){
                $img = PHP_slashes(htmlspecialchars(strip_tags($_POST['desimg'])));
                $SQL_IMG = '`img` = "'.$img.'",';
                $read_sql = $img;
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
                            }
                        }
                    }
                }
            }
        }

        $fb_sql = '';
        if(!empty($_POST['fbf']) && $_FILES['fb']['size'] < 0){
            $fb_sql = PHP_slashes(htmlspecialchars(strip_tags($_POST['fbf'])));
        }else{
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
        }


    }



    if(empty($error[0])){


        if($_POST['update'] == 1){
            if(update_news([
                'user'=>$user_id,
                'cat'=>$cat,
                'title'=>$title,
                'title_short'=>$title_short,
                'youtube'=>$youtube,
                'chpu'=>$chpu,
                'meta_desc'=>$meta_desc,
                'meta_key'=>$meta_key,
                'color'=>$color,
                'info'=>$info,
                'test'=>$victorina,
                'date'=>$date,
                'time'=>$tm,
                'style'=>$style,
                'text_short'=>$text_short,
                'text'=>$text,
                'phg'=>$phg,
                'sponsored'=>$sponsored,
                'copy'=>$copy,
                'slide'=>$slide,
                'slide_type'=>$slide_type,
                'thumbs'=>$totalpath,
                'img'=>$read_sql,
                'fb'=>$fb_sql
            ],$id)){
                $response['photop'] = (!empty($totalpath)) ? $totalpath : '';
                $response['desimg']= (!empty($read_sql)) ? $read_sql : '';
                $response['facebook'] = (!empty($fb_sql)) ? $fb_sql : '';
                $response['slide'] = json_encode(unserialize(base64_decode($slide)));
                $response['body'] = stripslashes($text);
                echo json_encode($response);
            }
        }
        if($_POST['add'] == 1){

            if(!empty($title) && !empty($cat)){
                $test_chpu = $DB->getOne("SELECT count(#__news.id) FROM `#__news` WHERE `chpu`='$chpu'");
                if($test_chpu>0)$chpu=rand(100,9999).'_'.$chpu;
                $result = add_news([
                    'user'=>$user_id,
                    'cat'=>$cat,
                    'title'=>$title,
                    'chpu'=>$chpu,
                    'title_short'=>$title_short,
                    'youtube'=>$youtube,
                    'info'=>$info,
                    'date'=>$date,
                    'time'=>$tm,
                    'slide'=>$slide,
                    'slide_type'=>$slide_type,
                    'text_short'=>$text_short,
                    'text'=>$text,
                    'phg'=>$phg,
                    'sponsored'=>$sponsored,
                    'copy'=>$copy,
                    'moderate'=>2
                ]);

                if($result > 0){
                    $response['body'] = stripslashes($text);
                    $response['id'] = $result;
                    echo json_encode($response);
                }
            }else{
                echo 1;
            }
        }
    }else{
        //$response['ajerror'] = "Facebook ფოტოს ზომა: 470x247";
        echo 0;
    }

}

if($_POST['action'] == 'get_images_from_dir'){
    $slide = array();
    $slide_dir = first_par_url($_POST['url']);
    $slidefiles =glob($_SERVER['DOCUMENT_ROOT'].generate_unknown($slide_dir).'*.{jpeg,gif,png,jpg,JPG,PNG,GIF,JPEG}', GLOB_BRACE);

    $slicount = count($slidefiles);
    // echo generate_unknown($_SERVER['DOCUMENT_ROOT'].$slide_dir);
    if($slicount > 0){
        foreach($slidefiles as $fs){
            if(str2int(last_par_url($fs)) > 0){
                $slide[] = 'http://funtime.ge:80' . $slide_dir . last_par_url($fs);
            }
        }
    }
    sort($slide);

    $slide = array('img'=>$slide);

    echo json_encode($slide);

}

die();