<?php defined('_JEXEC') or die('Restricted access'); ?>
<?if(is_array($registry['wyaro']) && !empty($registry['wyaro']['title'])): $wurl = 'http://'.str_replace('http://','',$registry['wyaro']['url']);?>
    <div class="fix"></div>
    <br>
    <a href="<?=$wurl;?>" target="_blank" style="float:right;text-decoration:none;color:#000;font-size:18px;font-family:'Open Sans sens-serif';"><span style="color:#ff894f;font-family:'BPGIngiri2008Regular';">წყარო:</span> <?=$registry['wyaro']['title'];?></a>
    <div class="fix"></div>
<?endif;?>