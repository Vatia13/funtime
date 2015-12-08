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

if(get_access('admin','category','del',false)){
    if (!empty($_GET['delete']))
    {
        $sql="DELETE FROM `#__category` WHERE `#__category`.`id` = ".intval($_GET['delete'])." LIMIT 1";
        $DB->execute($sql);
        header('Location: ?component=category&sec='.$_GET['sec'].'');
    }
}
if(get_access('admin','category','edit',false)){
    $name=htmlspecialchars(strip_tags($_POST['name']));
    $stat=intval($_POST['test']);
    $chpu=htmlspecialchars(strip_tags($_POST['chpu']));
    $authors = serialize($_POST['author']);
    $cat = htmlspecialchars(strip_tags($_POST['cat']));
    $design = intval($_POST['design']);
    $bade = intval($_POST['bade']);
    $type = intval($_POST['type']);
    if ($chpu=='')$chpu=generate_ge($name);
    if ($_POST['edit']==1) {

        if ($err==0) {
            if($bade > 0 && $_GET['edit'] > 0){
                $time = time();
                $DB->execute('DELETE FROM #__bade WHERE cat_id='.intval($_GET['edit']));
            }

            $sql="UPDATE `#__category` SET `name` = '".$name."',`test` = '".$stat."', `cat_chpu` = '".$chpu."', `users` = '".$authors."', `design` = '".$design."',`type`='".$type."',`bade`='".$bade."'
			WHERE `id`='".intval($_POST['idd'])."' LIMIT 1; ";
            $DB->execute($sql);
            $message[0] = 'valid';
            $message[1] = 'ჩანაწერი წარმატებით შეიცვალა';
        }
    }


    if ($_POST['add']==1) {
        if(!empty($name)){
            if(count($_POST['author']) > 0){
                $sql="INSERT INTO `#__category` (`id`,`test`,`name`,`cat_chpu`,`users`,`section`,`bade`,`type`) VALUES ('', '$stat', '$name', '$chpu','$authors','$cat','$bade','$type');";
                $DB->execute($sql);
                $message[0] = 'valid';
                $message[1] ='ჩანაწერი წარმატებით დაემატა.';
            }else{
                $message[0] = 'error';
                $message[1] ='გთხოვთ აირჩიოთ ავტორები.';
            }
        }else{
            $message[0] = 'error';
            $message[1] ='გთხოვთ ჩაწეროთ რუბრიკის დასახელება.';
        }
    }

    $sql = "SELECT realname,id FROM #__users WHERE group_id = 3 or group_id=6";
    $registry['authors'] = $DB->getAll($sql);
}

if(get_access('admin','category','view',false)){
    if(empty($_GET['section'])):
        $all = $DB->getAll('SELECT * FROM #__category WHERE podcat=0 order by name asc');
        $i=0;
        foreach($all as $num):
            $category[$num['id']][0]=$num;
            $i++;
        endforeach;

        $all = $DB->getAll('SELECT * FROM #__category WHERE podcat>0 order by name asc');
        $i=0;
        foreach($all as $num):
            $category[$num['podcat']][]=$num;
            $i++;
        endforeach;
    else:
        $all = $DB->getAll('SELECT * FROM #__category WHERE podcat=0 order by name asc');
        $item = $DB->getAll('SELECT * FROM #__category WHERE id='.intval($_GET['edit']));
    endif;
}

if(isset($_GET['status']) && isset($_GET['cat'])):
    if(get_access('admin','category','edit',false)):
        if($_GET['status'] == 0){
            $sql_bade = ",bade='1'";
        }else{
            $sql_bade = "";
        }
        $DB->execute('UPDATE #__category SET stat="'.intval($_GET['status']).'" '.$sql_bade.' WHERE id='.intval($_GET['cat']));
        $time = time();
        $DB->execute('DELETE FROM #__bade WHERE date > '.$time.' and cat_id='.intval($_GET['cat']));
        header('location:/apanel/index.php?component=category&sec=post');
    endif;
endif;