<?defined('_JEXEC') or die('Restricted access');?>

<div class="two-article">
 <?foreach($registry['two-article'] as $item):?>
     <?php
     $title_length = string_length($item['title']);
     if(!empty($item['text_short'])){
         $short_length = string_length($item['text_short']);
         $short_text = $item['text_short'];
     }else{
         $short_length = string_length($item['title_short']);
         $short_text = $item['title_short'];
     }
     $content_length = $title_length + $short_length;
     $short_length = 130 - $title_length + 25;
     $this['slide'] = get_serialize($item['slide']);
     ?>
<div class="two-article-content" <?if($registry['deviceType'] == 'computer' or $registry['deviceType'] == 'tablet'):?> style="max-height:220px;overflow:hidden;" <?endif;?>>

    <div class="two-time-m"><span><?=gedate('l H:i',$item['date']);?> </span> / <span> <?=gedate('d.m.Y',$item['date']);?></span></div>
    <div class="two-title-m"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><?=$item['title'];?></a></div>
    <div class="two-article-image">
        <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/"><h3 style="<?if(count($this['slide']['img']) > 1):?>background-image:url('/<?=$theme?>images/main_icon.png');background-repeat:no-repeat;background-size:30px 30px;background-position:right 10px center;padding:10px 50px 6px 10px;<?elseif($item['style']==12):?>background-image:url('/<?=$theme?>images/vcam.png');background-repeat:no-repeat;background-size:30px 26px;background-position:right 10px center;padding:10px 50px 6px 10px;<?else:?>padding:10px 10px 6px 10px;<?endif;?>"><?=$item['name'];?></h3></a>
        <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=substr($item['thumbs'],2);?>" width="380" alt="<?=$item['title'];?>" title="<?=$item['title'];?>"></a>
    </div>
    <div class="two-article-desc">
        <div class="two-title"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><?=$item['title'];?></a></div>
        <div class="fix"></div>
        <br>
        <div class="two-more"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/">ვრცლად</a></div>
        <div class="two-time"><span><?=gedate('l H:i',$item['date']);?> </span> / <span> <?=gedate('d.m.Y',$item['date']);?></span></div>
        <div class="two-short"><?=title_filter($short_text,$short_length);?></div>
        <br><br>
        <div class="fb-like" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
    </div>
</div>
  <?endforeach;?>
</div>