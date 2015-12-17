<?defined('_JEXEC') or die('Restricted access');?>
<div class="post-r3">
<div class="content">
    <!-- BANNER PLACE-->
    <div class="index-banner-place">
        <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
            <?if(function_exists('get_banner')):?>
                <?if(get_banner('F1',$registry['post'][0]['cat_id']) == true):?>
                    <?=get_banner('F1',$registry['post'][0]['cat_id']);?>
                <?else:?>
                    <object data="/img/F1_800x100.swf" type="application/x-shockwave-flash" width="800" height="100"><param name="wmode" value="opaque" /></object>
                <?endif;?>
            <?endif;?>
        </div>
    </div>
    <br>
    <!-- END BANNER PLACE-->

    <?if(get_banner('ბრენდირება L',$registry['post'][0]['cat_id']) == true):?>
        <div class="brand_left">
            <?=get_banner('ბრენდირება L',$registry['post'][0]['cat_id']);?>
        </div>
    <?endif;?>
    <?if(get_banner('ბრენდირება R',$registry['post'][0]['cat_id']) == true):?>
        <div class="brand_right">
            <?=get_banner('ბრენდირება R',$registry['post'][0]['cat_id']);?>
        </div>
    <?endif;?>

    <div class="post-title">
        <h1><?=$registry['post'][0]['title'];?></h1>
        <?if(count($registry['slide']['img']) > 1):?>
            <div class="post-slide-message">ფოტოსლაიდი <?=count($registry['slide']['img']);?> ფოტო</div>
        <?endif;?>
        <?if(!empty($registry['post'][0]['title_short'])):?><h3><?=$registry['post'][0]['title_short']?></h3><?endif;?>
    </div>

    <div class="post-image" style="border:25px solid <?=$registry['color']['frame'];?>">
        <h3 style="background-color:<?=$registry['color']['rubric'];?>; opacity:0.8; <?if(count($registry['slide']['img']) > 1):?>background-image:url('/<?=$theme?>images/main_icon.png');background-repeat:no-repeat;background-position:right 10px center;padding:18px 60px 15px 10px;<?else:?>padding:18px 10px 15px 10px;<?endif;?>"><?=$registry['post'][0]['name'];?></h3>
        <img src="/img/uploads/news/read/<?=$registry['post'][0]['img'];?>" width="660" height="435"/>
    </div>

    <div class="post-time">
        <span><?=gedate('l',$registry['post'][0]['date']);?></span> <span><?=gedate('H:i',$registry['post'][0]['date']);?></span> | <span><?=gedate('d.m.Y',$registry['post'][0]['date']);?></span>
    </div>
    <div class="post-author">
        <div class="post-avatar" align="center">
            <div style="background:url('/forum/img/avatars/<?=$registry['post'][0]['user'];?>.jpg') 50% 40% no-repeat;"></div>
        </div>
        <div><span>ავტორი:</span> <span><?=$registry['post'][0]['realname'];?></span></div>
    </div>
    <?if($registry['post'][0]['moderate'] == 1):?>
    <div class="post-socials">
        <ul>
            <li>
                <div class="fb-like" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/" data-width="80" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
            </li>
            <li>
                <div class="fb-share-button" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/" data-layout="button_count"></div>
            </li>
            <li>
                <img src="/<?=$theme?>/images/comments.png">
                <span class="tooltip"></span><div class="fb-comments-count" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/">0</div>
            </li>
        </ul>
    </div>
    <?endif;?>
    <div class="post-short">
        <?if(firstSymbol($registry['post'][0]['text_short'],1) != false):?>
            <span><?=firstSymbol($registry['post'][0]['text_short']); ?></span>
            <?=preg_replace('/'.firstSymbol($registry['post'][0]['text_short']).'/',' ',$registry['post'][0]['text_short'],1);?>
        <?else:?>
            <?=$registry['post'][0]['text_short'];?>
        <?endif;?>
    </div>

    <div class="fix"></div>
    <br><br>
    <!-- BANNER PLACE-->
    <div class="index-banner-place">
        <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
            <?if(function_exists('get_banner')):?>
                <?if(get_banner('F2',$registry['post'][0]['cat_id']) == true):?>
                    <?=get_banner('F2',$registry['post'][0]['cat_id']);?>
                <?else:?>
                    <object data="/img/F2_800x100.swf" type="application/x-shockwave-flash" width="800" height="100"><param name="wmode" value="opaque" /></object>
                <?endif;?>
            <?endif;?>
        </div>
    </div>
    <br>
    <!-- END BANNER PLACE-->

        <div class="post-content">
            <div style="float:left;">
                <?=$registry['post'][0]['text'];?>
            </div>
            <? get_banners_f();?>
        </div>
    </div>
    <div class="fix"></div>

</div>
