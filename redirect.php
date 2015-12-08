<?php
/**
 *
 * CMS osRealty 2.1.x
 * Autor: Roman Chernyshov
 * E-mail: support@osRealty.ru
 * URL: www.osRealty.ru
 *
 */

$http='http';


if(!empty($_GET['url'])){
    header('refresh:3;url='.$http.'://'.$_GET['url']);
    echo "<div align=center><img src='img/loading.gif'></div>";
}else{
    exit;
}


