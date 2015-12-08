<?php
/**
 * Created by IT-SOLUTIONS.
 * IS CMS
 * User: Vati Child
 * Date: 3/7/15
 * Time: 11:09 PM
 */
defined('_JEXEC') or die();
if(get_access('admin','contact','edit',false)):
if($_POST['save']){
    $address_ge = PHP_slashes(htmlspecialchars(strip_tags($_POST['address_ge'])));
    $reclam = PHP_slashes(htmlspecialchars(strip_tags($_POST['reclam'])));
    $phone1 = PHP_slashes(htmlspecialchars(strip_tags($_POST['phone1'])));
    $phone2 = PHP_slashes(htmlspecialchars(strip_tags($_POST['phone2'])));
    $email = PHP_slashes(htmlspecialchars(strip_tags($_POST['email'])));
    $coords = PHP_slashes(htmlspecialchars(strip_tags($_POST['coords'])));
    if($DB->execute("UPDATE #__contact SET address_ge='$address_ge',reclam='$reclam',phone1='$phone1',phone2='$phone2',email='$email',coords='$coords' WHERE id=1")){
        header('location:/apanel/index.php?component=contact');
    }
}
$registry['contact'] = $DB->getAll("SELECT * FROM #__contact WHERE id=1");
endif;