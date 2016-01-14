<?php defined('_JEXEC') or die('Restricted access'); ?>

<? if(is_array($registry['informer'])): $website = 'http://'.str_replace('http://','',$registry['informer']['website']);?>
    <ul style="list-style:none;margin:0;padding:0;">
        <?if(!empty($registry['informer']['address'])):?>
            <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"><img src="/img/icons/info-address.png"> <span style="position:relative;bottom:10px;left:15px"><?=$registry['informer']['address'];?></span></li>
        <?endif;?>
        <?if(!empty($registry['informer']['facebook'])):?>
            <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"> <a href="<?=$registry['informer']['facebook'];?>" style="text-decoration:none;color:#000;" target="_blank"><img src="/img/icons/info-facebook.png"><span style="position:relative;bottom:10px;left:15px">Facebook</span></a></li>
        <?endif;?>
        <?if(!empty($registry['informer']['skype'])):?>
            <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"> <a href="skype:<?=$registry['informer']['skype'];?>" style="text-decoration:none;color:#000;"><img src="/img/icons/info-skype.png"><span style="position:relative;bottom:10px;left:15px"><?=$registry['informer']['skype'];?></span></a></li>
        <?endif;?>
        <?if(!empty($registry['informer']['mobile'])):?>
            <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"> <a href="tel:<?=$registry['informer']['mobile'];?>" style="text-decoration:none;color:#000;"><img src="/img/icons/info-mobile.png"><span style="position:relative;bottom:10px;left:15px"><?=$registry['informer']['mobile'];?></span></a></li>
        <?endif;?>
        <?if(!empty($registry['informer']['phone'])):?>
            <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"> <a href="tel:<?=$registry['informer']['phone'];?>" style="text-decoration:none;color:#000;"><img src="/img/icons/info-phone.png"><span style="position:relative;bottom:10px;left:15px"><?=$registry['informer']['phone'];?></span></a></li>
        <?endif;?>
        <?if(!empty($registry['informer']['email'])):?>
            <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"> <a href="mailto:<?=$registry['informer']['email'];?>" style="text-decoration:none;color:#000;"><img src="/img/icons/inf-email.png"><span style="position:relative;bottom:10px;left:15px"><?=$registry['informer']['email'];?></span></a></li>
        <?endif;?>
        <?if(!empty($registry['informer']['website'])):?>
            <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"> <a href="<?=$website;?>" style="text-decoration:none;color:#000;"  target="_blank"><img src="/img/icons/inf-web.png"><span style="position:relative;bottom:10px;left:15px"><?=$registry['informer']['website'];?></span></a></li>
        <?endif;?>
    </ul>
<?endif;?>
<div class="fix"></div>