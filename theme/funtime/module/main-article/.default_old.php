<?php defined('_JEXEC') or die('Restricted access');?>
<?php
$title_length = string_length($registry['main-article'][0]['title']);
if(!empty($registry['main-article'][0]['text_short'])){
    $short_length = string_length($registry['main-article'][0]['text_short']);
    $short_text = $registry['main-article'][0]['text_short'];
}else{
    $short_length = string_length($registry['main-article'][0]['title_short']);
    $short_text = $registry['main-article'][0]['title_short'];

}
$content_length = $title_length + $short_length;
$short_length = 115 - $title_length;
$color = unserialize($registry['main-article'][0]['color']);
$slide = unserialize($registry['main-article'][0]['slide']);
?>
<div class="main-article" style="border:3px solid <?=$color['frame']?>;">
    <ul>
        <li  style="border:17px solid <?=$color['frame']?>">
            <div class="main-image">
                <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['main-article'][0]['cat_chpu'];?>/"><h3 style="background-color:<?=$color['rubric']?>;<?if(count($slide['img']) > 1):?>background-image:url('<?=$theme?>images/main_icon.png');background-repeat:no-repeat;background-position:right 10px center;padding:18px 60px 15px 10px;<?else:?>padding:18px 10px 15px 10px;<?endif;?>"><?=$registry['main-article'][0]['name']?></h3></a>
                <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['main-article'][0]['cat_chpu'];?>/<?=$registry['main-article'][0]['chpu'];?>/"> <img src="<?=$registry['main-article'][0]['thumbs'];?>" width="654px" alt="<?=$registry['main-article'][0]['title']?>" title="<?=$registry['main-article'][0]['title']?>"></a>
            </div>
        </li>
        <li>

            <div class="main-desc">

                <div class="main-title"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['main-article'][0]['cat_chpu'];?>/<?=$registry['main-article'][0]['chpu'];?>/"><?=$registry['main-article'][0]['title'];?></a></div>
                <?if($short_length > 35):?>
                <div class="main-short"><?if(!empty($registry['main-article'][0]['title_short'])):?><?=$registry['main-article'][0]['title_short'];?><?else:?><?=title_filter($short_text,$short_length);?><?endif;?></div>
                <?endif;?>
                <div class="main-more"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['main-article'][0]['cat_chpu'];?>/<?=$registry['main-article'][0]['chpu'];?>/">ვრცლად</a></div>
                <br>
                <div class="main-time"><span><?=gedate('l H:i',$registry['main-article'][0]['date']);?> </span> / <span> <?=gedate('d.m.Y',$registry['main-article'][0]['date']);?></span></div>
                <?if($registry['deviceType'] == 'computer'):?><br><?endif;?>
                <div class="fb-like" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['main-article'][0]['cat_chpu'];?>/<?=$registry['main-article'][0]['chpu'];?>/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                <?if($registry['deviceType'] != 'computer'):?><br><br><?endif;?>
            </div>
        </li>

    </ul>
    <div class="fix"></div>
</div>