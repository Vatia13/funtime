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

if($_GET['section']=='ajax'){
    if($_POST['action'] == 'load_date'){
        if(isset($_POST['id'])){
            if(intval($_POST['id']) > 0){

                $date = date('Y-m-d H:i:s',strtotime($_POST['date']));
                if($DB->execute('INSERT INTO #__bade (cat_id,date) VALUES ("'.intval($_POST['id']).'","'.strtotime($date).'")')){
                    die('success');
                }else{
                    die('wrong');
                }
            }
        }
    }

    if($_POST['action'] == 'image'){
        if(isset($_POST['date'])){
            if(intval($_POST['date']) > 0 && intval($_POST['cat']) > 0){
                $success = 'success';
                $user_id = intval($_POST['user']);
                if($user->get_property('gid') == 30 or $user->get_property('gid') == 21 or $user->get_property('gid') == 22){
                    $check = $DB->getOne('SELECT count(id) FROM #__bade WHERE date="'.intval($_POST['date']).'" and user_id="'.$user_id.'" and user_gid <= 0');
                    $check2 = $DB->getOne('SELECT count(id) FROM #__bade WHERE date="'.intval($_POST['date']).'" and user_id="'.$user_id.'" and user_gid > 0');
                    if($check > 0){
                        $sql_update = "user_id='0',img='0'";
                        $success = 'success1';
                    }elseif($check2 > 0){
                        $sql_update = "user_id='0',img='1'";
                        $success = 'success2';
                    }else{
                        $sql_update = "user_id='".$user_id."',img='1'";
                    }
                }else{
                    $check_gid = $DB->getOne('SELECT count(id) FROM #__bade WHERE date="'.intval($_POST['date']).'" and user_gid > 0');
                    if($check_gid > 0){
                        $sql_update = "img='".$_POST['value']."',user_id='0',user_gid='0'";
                    }else{
                        $sql_update = "img='".$_POST['value']."',user_id='0',user_gid='3'";
                    }
                }

                if($DB->execute("UPDATE #__bade SET {$sql_update} WHERE date='".intval($_POST['date'])."' AND cat_id='".intval($_POST['cat'])."' ")){
                    die($success);
                }else{
                    die('wrong');
                }
            }
        }
    }

    if($_POST['action'] == 'facebook'){
        if(isset($_POST['date'])){
            if(intval($_POST['date']) > 0 && intval($_POST['cat']) > 0){
                if($DB->execute("UPDATE #__bade SET fb='".$_POST['value']."' WHERE date='".intval($_POST['date'])."' AND cat_id='".intval($_POST['cat'])."' ")){
                    die('success');
                }else{
                    die('wrong');
                }
            }
        }
    }
}



function badeStartDate($date){
    return date('Y-m-d',$date).'T'.date('H:i:s',$date);
}
function badeEndDate($date){
    $t = date('H:i',$date);
    $t = strtotime($t) + 60 * 60;
    return date('Y-m-d',$date).'T'.date('H:i:s',$t);
}
if($_GET['parse']=='json'){
    $result = array();
    $date = array();
    $array_all = array();
    $news = array();
    $time = time();
    if($_POST['start'] && $_POST['end']){
        $registry['rubrics'] = $DB->getAll('select #__category.name,#__category.users,#__category.cat_chpu,#__category.id,#__bade.date,#__bade.img,#__bade.user_id,#__bade.fb
                                            FROM #__category
                                            LEFT JOIN #__bade ON #__bade.cat_id = #__category.id
                                            WHERE #__category.section="post" AND #__category.bade="0" AND #__bade.date between "'.$_POST['start'].'" AND "'.$_POST['end'].'"');
        $i=0;foreach($registry['rubrics'] as $item):$i++;
            $new_date = $item['date'] + 3600 * 24 * 7;
            $date['cat'][] = $item['id'];
            $date['new_date'][] = $new_date;
            $date['date'][] = $item['date'];
        endforeach;
        if(count($date['new_date']) > 0){
            $registry['all'] = $DB->getAll('SELECT #__bade.date FROM #__bade WHERE #__bade.date IN ('.join(',',$date['new_date']).')');

            foreach($registry['all'] as $item){
                $array_all[] = $item['date'];
            }
            foreach($date['new_date'] as $key=>$d){
                if(!in_array($d,$array_all)){
                    $DB->execute('INSERT INTO #__bade (cat_id,date) VALUES ("'.$date['cat'][$key].'","'.$d.'")');
                }
            }
        }
        //print_r($registry['all']);
        $registry['news'] = $DB->getAll('SELECT #__news.moderate,#__news.user,#__news.cat,#__news.user_block,#__news.group,#__news.chpu,#__news.id,#__news.date,#__news.banner
                                         FROM #__news WHERE moderate<>10 AND #__news.date IN ('.join(',',$date['date']).')');

        if(count($registry['news']) > 0){
            foreach($registry['news'] as $key=>$item){
                $news[$item['date']]['moderate'] = $item['moderate'];
                $news[$item['date']]['user_block'] = $item['user_block'];
                $news[$item['date']]['user'] = $item['user'];
                $news[$item['date']]['group'] = $item['group'];
                $news[$item['date']]['id'] = $item['id'];
                $news[$item['date']]['chpu'] = $item['chpu'];
                $news[$item['date']]['banner'] = $item['banner'];
                $news[$item['date']]['cat'] = $item['cat'];
                $registry['added_banners'][] = $item['cat'];

            }
        }



        if($user->get_property('gid') == 24 or $user->get_property('gid') == 25){
            if(count($registry['added_banners']) > 0){
                $registry['banners'] = $DB->getAll("SELECT cat_id,published_at,finished_at FROM #__banner_list WHERE
                                            #__banner_list.type='1' and #__banner_list.status='2'
                                            and UNIX_TIMESTAMP(#__banner_list.published_at) < {$time}
                                            and UNIX_TIMESTAMP(#__banner_list.finished_at) > {$time}
                                            and cat_id IN (".join(',',$registry['added_banners']).") GROUP BY cat_id");
                if(count($registry['banners']) > 0){
                    foreach($registry['banners'] as $item):
                        $registry['banners_added'][$item['cat_id']]['cat'] = $item['cat_id'];
                        $registry['banners_added'][$item['cat_id']]['published'] = $item['published_at'];
                        $registry['banners_added'][$item['cat_id']]['finished'] = $item['finished_at'];
                    endforeach;
                }
            }
        }


        if(count($registry['rubrics']) > 0){
            $start_new = strtotime('2015-09-1');
            $i=0;foreach($registry['rubrics'] as $item):

                $users = unserialize($item['users']);
                $group = unserialize($news[$item['date']]['group']);
                $result[$i]['title'] = '<div onClick="window.open(\'/'.$item['cat_chpu'].'/'.$news[$item['date']]['chpu'].'/\');">'.$item['name'].'</div>';
                $result[$i]['start'] = badeStartDate($item['date']);
                $result[$i]['end'] = badeEndDate($item['date']);
                $checked = ($item['img'] > 0) ? 'checked' : '';
                $value =  ($item['img'] <= 0) ? 1 : 0;
                $fb_val =  ($item['fb'] <= 0) ? 1 : 0;
                $fb_checked = ($item['fb'] > 0) ? 'checked' : '';
                if(!$news[$item['date']]['id']){

                    if($user->get_property('gid') == 18){
                        if(in_array($user->get_property('userID'),$users)){
                            $result[$i]['color'] = 'red';
                            $result[$i]['title'] = '<div onClick="window.open(\'/apanel/index.php?component=article&section=add&cat='.$item['id'].'&Y='.date('Y',$item['date']).'&M='.date('m',$item['date']).'&D='.date('d',$item['date']).'&H='.date('H',$item['date']).'&I='.date('i',$item['date']).'\');">'.$item['name'].'</div>';
                            $result[$i]['title'] .= '<input onClick="checkImage('.$user->get_property('userID').','.$item['date'].','.$item['id'].',jQuery(this),\'image\','.$user->get_property('gid').')" type="checkbox" name="img" value="'.$value.'" '.$checked.'/>';
                        }else{
                            $result[$i]['color'] = 'grey';
                        }

                    }else{

                        $result[$i]['color'] = 'grey';
                        if($user->get_property('gid') <> 23){
                            $result[$i]['title'] = '<div onClick="window.open(\'/apanel/index.php?component=article&section=add&cat='.$item['id'].'&Y='.date('Y',$item['date']).'&M='.date('m',$item['date']).'&D='.date('d',$item['date']).'&H='.date('H',$item['date']).'&I='.date('i',$item['date']).'\');">'.$item['name'].'</div>';
                            //$result[$i]['url'] = '/apanel/index.php?component=article&section=add&cat='.$item['id'].'&Y='.date('Y',$item['date']).'&M='.date('m',$item['date']).'&D='.date('d',$item['date']).'&H='.date('H',$item['date']).'&I='.date('i',$item['date']);
                            // $result[$i]['target'] = '_blank';
                        }
                    }

                    if($user->get_property('gid') == 30) {
                        if($checked == 'checked'){
                            if($item['user_id'] > 0){
                                $result[$i]['title'] .= '<input onClick="checkImage(' . $user->get_property('userID') . ',' . $item['date'] . ',' . $item['id'] . ',jQuery(this),\'image\',' . $user->get_property('gid') . ')" type="checkbox" name="img" value="' . $value . '" '.$checked.'/>';
                                $result[$i]['color'] = 'green';
                            }else{
                                $result[$i]['title'] .= '<input onClick="checkImage(' . $user->get_property('userID') . ',' . $item['date'] . ',' . $item['id'] . ',jQuery(this),\'image\',' . $user->get_property('gid') . ')" type="checkbox" name="img" value="' . $value . '" />';
                                $result[$i]['color'] = 'red';
                            }
                        }else{
                            $result[$i]['title'] .= '<input onClick="checkImage(' . $user->get_property('userID') . ',' . $item['date'] . ',' . $item['id'] . ',jQuery(this),\'image\',' . $user->get_property('gid') . ')" type="checkbox" name="img" value="' . $value . '" />';
                        }
                    }


                    if($user->get_property('gid') == 21 or $user->get_property('gid') == 22) {
                        if($checked == 'checked'){
                            if($item['user_id'] > 0){
                                $result[$i]['title'] .= '<input onClick="checkImage(' . $user->get_property('userID') . ',' . $item['date'] . ',' . $item['id'] . ',jQuery(this),\'image\',' . $user->get_property('gid') . ')" type="checkbox" name="img" value="' . $value . '" '.$checked.'/>';
                            }else{
                                $result[$i]['title'] .= '<input onClick="checkImage(' . $user->get_property('userID') . ',' . $item['date'] . ',' . $item['id'] . ',jQuery(this),\'image\',' . $user->get_property('gid') . ')" type="checkbox" name="img" value="' . $value . '" />';
                            }
                        }else{
                            $result[$i]['title'] .= '<input onClick="checkImage(' . $user->get_property('userID') . ',' . $item['date'] . ',' . $item['id'] . ',jQuery(this),\'image\',' . $user->get_property('gid') . ')" type="checkbox" name="img" value="' . $value . '" />';
                        }
                    }

                    if($user->get_property('gid') == 24 or $user->get_property('gid') == 25){
                        // if(in_array(25,$group) or in_array(24,$group) or in_array(0,$group)){
                        $checkimg = ($item['img'] > 0 && $item['user_id'] > 0) ? '<span><img src="images/picture.png" style="position:absolute;right:5px;top:0;width:12px;"/></span>' : '';
                        $result[$i]['title'] .= $checkimg;
                        // }
                    }

                }else{
                    if(!in_array($user->get_property('gid'),$group)){
                        if(!in_array(0,$group)){
                            $result[$i]['color'] = 'grey';
                        }

                    }
                    if($user->get_property('gid') == 24 or $user->get_property('gid') == 25){
                        if($news[$item['date']]['moderate'] == 1){
                            if($item['date'] >= $start_new){
                                if($news[$item['date']]['banner'] > 0 or $registry['banners_added'][$news[$item['date']]['cat']]['cat'] <= 0){
                                    $result[$i]['color'] = 'green';
                                }else{
                                    if($item['date'] >= strtotime($registry['banners_added'][$news[$item['date']]['cat']]['published']) && $item['date'] <= strtotime($registry['banners_added'][$news[$item['date']]['cat']]['finished'])){
                                        $result[$i]['color'] = 'CornflowerBlue';
                                    }else {
                                        $result[$i]['color'] = 'green';
                                    }
                                }
                            }else{
                                $result[$i]['color'] = 'green';
                            }
                            //$result[$i]['published_at'] = $registry['banners_added'][$news[$item['date']]['cat']]['published'];


                        }elseif($news[$item['date']]['moderate'] == 3){
                            $result[$i]['color'] = 'red';
                        }elseif($news[$item['date']]['moderate'] == 2){
                            if(!in_array(22,$group) and !in_array(21,$group) and !in_array(23,$group) and !in_array(24,$group) and !in_array(25,$group)){
                                $result[$i]['color'] = 'grey';
                            }else{
                                if($user->get_property("userID") == $item['user_id']){
                                    $result[$i]['color'] = 'orange';
                                }
                            }

                        }elseif($news[$item['date']]['moderate'] == 4){
                            $result[$i]['color'] = 'blue';
                        }

                        if(in_array(23,$group)){
                            $result[$i]['color'] = 'purple';
                        }
                    }

                    if($user->get_property('gid') == 19){
                        if($news[$item['date']]['moderate'] == 1){
                            $result[$i]['color'] = 'green';
                            $result[$i]['title'] .= '<input style="width:35px; height:35px;" onClick="checkImage('.$user->get_property('userID').','.$item['date'].','.$item['id'].',jQuery(this),\'facebook\','.$user->get_property('gid').')" type="checkbox" name="fb" value="'.$fb_val.'" '.$fb_checked.'/>';
                        }else{
                            $result[$i]['color'] = 'grey';
                        }
                    }

                    if($user->get_property('gid') == 22 or $user->get_property('gid') == 21){
                        if($news[$item['date']]['moderate'] == 1){
                            $result[$i]['color'] = 'green';
                        }elseif($news[$item['date']]['moderate'] == 3){
                            if(in_array(23,$group)){
                                $result[$i]['color'] = 'darkorchid';
                            }else{
                                $result[$i]['color'] = 'red';
                            }

                        }elseif($news[$item['date']]['moderate'] == 2){
                            if(in_array('23',$group)){
                                $result[$i]['color'] = 'darkorchid';
                            }else{
                                if(!in_array(22,$group) and !in_array(21,$group) and !in_array(23,$group) and !in_array(24,$group) and !in_array(25,$group)){
                                    $result[$i]['color'] = 'grey';
                                }else{

                                    $result[$i]['color'] = 'orange';
                                }
                            }
                        }elseif($news[$item['date']]['moderate'] == 4){
                            $result[$i]['color'] = 'blue';
                        }
                        if($item['user_id'] > 0 && $item['img'] > 0){
                            $checked = 'checked';
                        }else{
                            $checked = '';
                        }
                        $result[$i]['title'] .= '<input onClick="checkImage('.$user->get_property('userID').','.$item['date'].','.$item['id'].',jQuery(this),\'image\','.$user->get_property('gid').')" type="checkbox" name="img" value="'.$value.'" '.$checked.'/>';

                    }

                    if($user->get_property('gid') == 23){
                        if((in_array(24,$group) and in_array(25,$group)) or in_array(0,$group) or $news[$item['date']]['moderate'] == 1){
                            $result[$i]['color'] = 'green';
                        }
                        if(in_array(23,$group) and $news[$item['date']]['moderate'] == 3){
                            $result[$i]['color'] = 'red';
                        }

                        if(in_array(23,$group) and $news[$item['date']]['moderate'] == 2){
                            $result[$i]['color'] = 'orange';
                        }
                    }

                    if($user->get_property('gid') == 18){
                        if($news[$item['date']]['moderate'] == 2  and !in_array(22,$group) and !in_array(21,$group) and !in_array(23,$group) and !in_array(24,$group) and !in_array(25,$group)){
                            $result[$i]['color'] = 'orange';
                        }elseif((in_array(21,$group) or in_array(22,$group)) and $news[$item['date']]['moderate'] != 1 and !in_array(23,$group)){
                            if(in_array($user->get_property('userID'),$users)){
                                $result[$i]['title'] .= '<input onClick="checkImage('.$user->get_property('userID').','.$item['date'].','.$item['id'].',jQuery(this),\'image\')" type="checkbox" name="img" value="'.$value.'" '.$checked.'/>';
                                $result[$i]['color'] = 'purple';
                            }
                        }else{
                            if(in_array($user->get_property('userID'),$users)){
                                $result[$i]['title'] .= '<input onClick="checkImage('.$user->get_property('userID').','.$item['date'].','.$item['id'].',jQuery(this),\'image\','.$user->get_property('gid').')" type="checkbox" name="img" value="'.$value.'" '.$checked.'/>';
                                $result[$i]['color'] = 'green';
                            }else{
                                $result[$i]['color'] = 'grey';
                            }
                        }
                    }

                    if($user->get_property('gid') == 30){
                        if($item['user_id'] > 0) {
                            $result[$i]['title'] .= '<input test-data="'.$user->get_property('userID').'" onClick="checkImage('.$user->get_property('userID').',' . $item['date'] . ',' . $item['id'] . ',jQuery(this),\'image\','.$user->get_property('gid').')" type="checkbox" name="img" value="' . $value . '" checked="checked" />';
                            $result[$i]['color'] = 'green';
                        }else{
                            $result[$i]['title'] .= '<input onClick="checkImage('.$user->get_property('userID').',' . $item['date'] . ',' . $item['id'] . ',jQuery(this),\'image\','.$user->get_property('gid').')" type="checkbox" name="img" value="' . $value . '" />';
                            if($item['img'] > 0){
                                $result[$i]['color'] = 'red';
                            }else{
                                $result[$i]['color'] = 'grey';
                            }

                        }
                    }







                    //$result[$i]['url'] = '/'.$item['cat_chpu'].'/'.$news[$item['date']]['chpu'].'/';
                    //$result[$i]['target'] = '_blank';
                }

                if($news[$item['date']]['moderate'] > 0){
                    if($user->get_property('gid') == 24 or $user->get_property('gid') == 25){
                        if(in_array(25,$group) or in_array(24,$group) or in_array(0,$group)){
                            $checkimg = ($item['img'] > 0 && $item['user_id'] > 0) ? '<img src="images/picture.png" style="position:absolute;right:5px;top:0;width:12px;"/>' : '';
                            $result[$i]['title'] .= $checkimg.' <br> <span onClick="window.open(\'/apanel/index.php?component=article&section=edit&edit='.$news[$item['date']]['id'].'\');"><img src="'.$theme_admin.'images/user_edit.png" width="16" alt="რედაქტირება" title="რედაქტირება"></span>';
                        }
                    }
                    if(time() < $item['date']){
                        if($user->get_property('gid') == 22 or $user->get_property('gid') == 21){
                            if(!in_array('23',$group)){
                                $result[$i]['title'] .=' <br> <span onClick="window.open(\'/apanel/index.php?component=article&section=edit&edit='.$news[$item['date']]['id'].'\');"><img src="'.$theme_admin.'images/user_edit.png" width="16" alt="რედაქტირება" title="რედაქტირება"></span>';
                            }
                        }

                        if($user->get_property('gid') == 18){
                            if($news[$item['date']]['moderate'] == 2  and !in_array(22,$group) and !in_array(21,$group) and !in_array(23,$group) and !in_array(24,$group) and !in_array(25,$group)) {
                                $result[$i]['title'] .= '<br> <span onClick="window.open(\'/apanel/index.php?component=article&section=edit&edit=' . $news[$item['date']]['id'] . '\');"><img src="'.$theme_admin.'images/user_edit.png" width="16" alt="რედაქტირება" title="რედაქტირება"></span>';
                            }
                        }

                        if($user->get_property('gid') == 23){
                            if(($news[$item['date']]['moderate'] == 2 or $news[$item['date']]['moderate'] == 3) and in_array(23,$group)) {
                                $result[$i]['title'] .= '<br> <span onClick="window.open(\'/apanel/index.php?component=article&section=edit&edit=' . $news[$item['date']]['id'] . '\');"><img src="'.$theme_admin.'images/user_edit.png" width="16" alt="რედაქტირება" title="რედაქტირება"></span>';
                            }
                        }
                    }
                }
                if($user->get_property('gid')!=18 && $user->get_property('gid')!=30 && $user->get_property('gid')!=19 && $user->get_property('gid')!=20 && $user->get_property('gid') != 23 and $news[$item['date']]['moderate'] <> 1 && $news[$item['date']]['id'] > 0){
                    if(in_array(25,$group) or in_array(24,$group) or in_array(21,$group) or in_array(22,$group)) {
                        $cont = ($news[$item['date']]['user_block'] <= 0) ? '<span onClick="block_article(this,' . $user->get_property("userID") . ',' . $news[$item['date']]['id'] . ');return false;" ><img src="' . $theme_admin . 'images/open.png" alt="ბლოკირება" title="ბლოკირება" width="21" border="0" /></span>' : '<span onClick="unblock_article(this,' . $user->get_property("userID") . ',' . $news[$item['date']]['id'] . ');return false;" ><img src="' . $theme_admin . 'images/locked.png" alt="ბლოკის მოხსნა" title="ბლოკის მოხსნა" width="21" border="0" /></span>';
                        $result[$i]['title'] .= $cont;
                    }
                }

                if($user->get_property('gid') == 23){
                    if($news[$item['date']]['id'] > 0 and ($news[$item['date']]['moderate'] == 3 or $news[$item['date']]['moderate'] == 2) and in_array(23,$group)){
                        $cont = ($news[$item['date']]['user_block'] <= 0) ? '<span onClick="block_article(this,' . $user->get_property("userID") . ',' . $news[$item['date']]['id'] . ');return false;" ><img src="' . $theme_admin . 'images/open.png" alt="ბლოკირება" title="ბლოკირება" width="21" border="0" /></span>' : '<span onClick="unblock_article(this,' . $user->get_property("userID") . ',' . $news[$item['date']]['id'] . ');return false;" ><img src="' . $theme_admin . 'images/locked.png" alt="ბლოკის მოხსნა" title="ბლოკის მოხსნა" width="21" border="0" /></span>';
                        $result[$i]['title'] .= $cont;
                    }
                }






                $i++;

            endforeach;
        }
    }
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    die();
}

$all = $DB->getAll('SELECT * FROM #__category WHERE podcat=0 && section="post" && stat="0" '.$sql_gid.' order by name ASC');
$i=0;
foreach($all as $nu):
    $category[$nu['id']][0]=$nu;
    $i++;
endforeach;

$all = $DB->getAll('SELECT * FROM #__category WHERE podcat>0 && section="post" && stat="0" '.$sql_gid.' order by name ASC');
$i=0;
foreach($all as $nu):
    $category[$nu['podcat']][]=$nu;
    $i++;
endforeach;

