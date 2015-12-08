<?defined('_JEXEC') or die('Restricted access');?>
<?php
$title_length = string_length($registry['three-big-article'][0]['title']);
if(!empty($registry['three-big-article'][0]['text_short'])){
    $short_length = string_length($registry['three-big-article'][0]['text_short']);
    $short_text = $registry['three-big-article'][0]['text_short'];
}else{
    $short_length = string_length($registry['three-big-article'][0]['title_short']);
    $short_text = $registry['three-big-article'][0]['title_short'];
}
$content_length = $title_length + $short_length;
$short_length = 300 - $title_length;
?>
<div class="three-article">
    <ul>
        <li>
            <div class="three-big-img">
                <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['three-big-article'][0]['cat_chpu'];?>/"><h3><?=$registry['three-big-article'][0]['name']?></h3></a>
                <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['three-big-article'][0]['cat_chpu'];?>/<?=$registry['three-big-article'][0]['chpu'];?>/"><img src="<?=substr($registry['three-big-article'][0]['thumbs'],2);?>" width="698" alt="<?=$registry['three-big-article'][0]['title']?>" title="<?=$registry['three-big-article'][0]['title']?>"></a>
            </div>
            <div class="three-big-desc">
                <div class="three-big-title"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['three-big-article'][0]['cat_chpu'];?>/<?=$registry['three-big-article'][0]['chpu'];?>/"><?=title_filter($registry['three-big-article'][0]['title'],100);?></a></div>
                <?if($short_length > 35):?>
                <div class="three-big-short"><i><?=title_filter($short_text,$short_length);?></i></div>
                <?endif;?>
                <div class="three-big-more"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['three-big-article'][0]['cat_chpu'];?>/<?=$registry['three-big-article'][0]['chpu'];?>/">ვრცლად</a></div>
            </div>
            <div class="three-big-author">
                <span>ავტორი:</span> <strong><?=$registry['three-big-article'][0]['realname']?></strong>
            </div>
            <div class="fix"></div>
            <div class="line"></div>
            <div class="three-big-time">
                <table class="time-like">
                    <tr>
                        <td><i><?=gedate('l H:i',$registry['three-big-article'][0]['date']);?> | <?=gedate('d.m.Y',$registry['three-big-article'][0]['date']);?></i></td>
                        <td>
                            <div id="facebook_like_button_holder">
                                <div class="fb-like" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/" data-layout="button_count" data-action="recommend" data-show-faces="true" data-share="false"></div>

                                <div id="fake_facebook_button"></div>
                            </div>
                        </td>
                        <td valign="center"><img src="/<?=$theme;?>images/fb_c.png" align="left"><div class="fb-comments-count-out" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/">0</div></td>
                    </tr>
                </table>
             </div>
        </li>
        <li>
            <?foreach($registry['three-short-article'] as $item):?>
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
                ?>
            <div class="three-short-img">
                <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/"><h3><?=$item['name'];?></h3></a>
                <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=get_thumb($item['thumbs'],'/images/news/prev','370');?>" width="370" alt="<?=$item['title'];?>" title="<?=$item['title'];?>"></a>
            </div>
            <div class="three-short-desc">
                <div class="three-short-title"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><?=title_filter($item['title'],150);?></a></div>
                <?if($short_length > 35):?>
                <div class="three-short-short"><i><?=title_filter($short_text,$short_length);?></i></div>
                <?endif;?>
                <div class="three-short-time">
                    <table class="time-like-short">
                        <tr>
                            <td><i><?=gedate('l H:i',$item['date']);?> | <?=gedate('d.m.Y',$item['date']);?></i></td>
                            <td>
                                <div id="facebook_like_button_holder">
                                    <div class="fb-like" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/" data-layout="button_count" data-action="recommend" data-show-faces="true" data-share="false"></div>

                                    <div id="fake_facebook_button"></div>
                                </div>
                            </td>
                        </tr>
                    </table>
            </div>
            <br><br>
            <?endforeach;?>
        </li>
    </ul>
    <div class="fix"></div>
</div>