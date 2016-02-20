 <?php defined('_JEXEC') or die('Restricted access'); ?>
<?  
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$test = explode('/',$actual_link); 
if($test[3] != "saknatuno-ambebi"){
if($registry['post'][0]['slide_type'] == '0'){
 if(empty($registry['post'][0]['phg'])){?>
<div style="position:absolute; left:100%; top:46px;">
	<? get_banners_f(); ?>
</div>
<? } else{?>

<div style="position:absolute; left:100%; top:70px;">
	<? get_banners_f(); ?>
</div>
<? }}} ?>
<?if(!empty($registry['post'][0]['slide'])): $registry['slider'] = (unserialize($registry['post'][0]['slide']) <> "") ? unserialize($registry['post'][0]['slide']) : unserialize(base64_decode($registry['post'][0]['slide']));?>
    <?if(count($registry['slider']['img']) > 1):?>
        <br>
        <div class="fix"></div>
        <?if(!empty($registry['post'][0]['phg'])):?>
            <div style="float:left;text-decoration:none;color:#000;font-size:20px;font-family:'Open Sans sens-serif';"><span style="color:#ed4321;font-family:'BPGIngiri2008Regular';">ფოტოგრაფი:</span> <?=$registry['post'][0]['phg'];?></div>
        <?endif;?>
        <div class="fix"></div>
        <br>

        <ul class="pgwSlideshow <?if($_GET['new_slider'] > 0 or $registry['post'][0]['slide_type'] == '0'):?>gallery<?else:?>gallery2<?endif;?> clearfix">
            <?$image_url = array(); for($i=0;$i<count($registry['slider']['img']);$i++):

                $image_url[$i] = str_replace('http://funtime.ge:80/','',$registry['slider']['img'][$i]);

                if($registry['deviceType'] != 'phone' && ($_GET['new_slider'] > 0 or $registry['post'][0]['slide_type'] == '0')) {
                    $sinfo = @getimagesize($_SERVER['DOCUMENT_ROOT'].str_replace('http://funtime.ge:80','',generate_unknown($registry['slider']['img'][$i])));

                    if ($sinfo[0] > $sinfo[1]) {
                        $style = '';
                    } else {
                        $style = 'style="max-width:465px;width:48%;"';
                    }
                }else{
                    $style = '';
                }
                ?>
                <li <?=$style;?>>
                    <?if($_GET['new_slider'] > 0 or $registry['post'][0]['slide_type'] == '0'):
                        if(!file_exists($_SERVER['DOCUMENT_ROOT']."/img/uploads/news/fb/".date('Y-m',strtotime($registry['post'][0]['time']))."/".$registry['post'][0]['id'].'_'.get_ext($registry['slider']['img'][$i],'/'))):
                            $image_info = getimagesize($_SERVER['DOCUMENT_ROOT'].str_replace('http://funtime.ge:80','',generate_unknown($registry['slider']['img'][$i])));
                            if($image_info[0] > $image_info[1]){
                                $iwidth = 485;
                            }else{
                                $iwidth = 285;
                            }
                            resizeCopy($_SERVER['DOCUMENT_ROOT'].str_replace('http://funtime.ge:80','',generate_unknown($registry['slider']['img'][$i])), $registry['post'][0]['id'].'_'.get_ext($registry['slider']['img'][$i],'/'), $iwidth, $_SERVER['DOCUMENT_ROOT']."/img/uploads/news/fb/".date('Y-m',strtotime($registry['post'][0]['time'])),false);
                        endif;
                        //print_r();
                        ?>
                        <span><?=$registry['slider']['name'][$i];?></span>

                    <?endif;?>
                    <div style="position:relative; margin-top:10px;">
                        <?if($_GET['new_slider'] > 0 or $registry['post'][0]['slide_type'] == '0'):?>
                            <a style="position:absolute;right:10px;top:10px; z-index:9;" href="https://www.facebook.com/dialog/feed?app_id=1391061841189461&link=http://www.funtime.ge/<?=$registry['post'][0]['cat_chpu']?>/<?=$registry['post'][0]['chpu']?>/&title=<?echo str_replace(' ','+',strip_tags($registry['post'][0]['title']));?>&picture=http://www.funtime.ge/img/uploads/news/fb/<?=date('Y-m',strtotime($registry['post'][0]['time']));?>/<?=$registry['post'][0]['id'].'_'.last_par_url($registry['slider']['img'][$i]);?>&description=<?=strip_tags($registry['post'][0]['text_short'])?>&redirect_uri=https://www.facebook.com/" target="_blank">
                                <img src="/img/sharefb.png" width="100px"> 
                            </a>
                        <?endif;?> 
                        <a class="zoom-pic" href="<?=$registry['slider']['img'][$i];?>" data-facebook="https://www.facebook.com/dialog/feed?app_id=1391061841189461&link=http://www.funtime.ge/<?=$registry['post'][0]['cat_chpu']?>/<?=$registry['post'][0]['chpu']?>/&title=<?echo str_replace(' ','+',strip_tags($registry['post'][0]['title']));?>&picture=http://www.funtime.ge/img/uploads/news/fb/<?=date('Y-m',strtotime($registry['post'][0]['time']));?>/<?=$registry['post'][0]['id'].'_'.last_par_url($registry['slider']['img'][$i]);?>&description=<?=strip_tags($registry['post'][0]['text_short'])?>&redirect_uri=https://www.facebook.com/" title="<?=strip_tags($registry['slider']['name'][$i]);?>" rel="prettyPhoto[pp_gal2]" >
                            <img src="<?=$registry['slider']['img'][$i];?>" <?php if($_GET['new_slider'] > 0 or $registry['post'][0]['slide_type'] == '0'):?>style="max-width:940px !important;width:100%;"<?php endif;?> alt="<?=$registry['post'][0]['alt_search']?>" title="<?=strip_tags(addslashes($registry['slider']['name'][$i]));?>" data-description="<?=addslashes(htmlentities($registry['slider']['name'][$i]));?>">
                        </a>  
                    </div> 
                </li>
            <?endfor;?>
        </ul>

    <?endif;?>
<?endif;?>
