<?defined('_JEXEC') or die('Restricted access');?>

<div class="post-r12">

    <div class="content">
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
        <div class="post-time">
            <span><?=gedate('l',$registry['post'][0]['date']);?></span> <span><?=gedate('H:i',$registry['post'][0]['date']);?></span>  <span><?=gedate('d.m.Y',$registry['post'][0]['date']);?></span>
        </div>
        <div class="fix"></div>
        <div class="post-title">
            <h1><?=$registry['post'][0]['title'];?></h1>
            <?if(count($registry['slide']['img']) > 1):?>
                <div class="post-slide-message">ფოტოსლაიდი <?=count($registry['slide']['img']);?> ფოტო</div>
            <?endif;?>

        </div>
        <div class="fix"></div>

        <div class="post-author">
            <div><span>ავტორი:</span> <span><?=$registry['post'][0]['realname'];?></span></div>
        </div>
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
        <div class="fix"></div>

        <div class="post-video" >
            <ul>
                <li>
                    <div class="video-banner-place">
                        <?if(function_exists('get_banner')):?>
                            <?if(get_banner('ვიდეო L',$registry['post'][0]['cat_id']) == true):?>
                                <?=get_banner('ვიდეო R',$registry['post'][0]['cat_id']);?>
                            <?else:?>
                                <span>სარეკლამო ბანერი (150x500)</span>
                            <?endif;?>
                        <?endif;?>
                    </div>
                </li>
                <li> <iframe id="ytplayer" type="text/html" width="100%" style="height:500px;" src="https://www.youtube.com/embed/<?=$registry['post'][0]['youtube'];?>?theme=light&autoplay=1" frameborder="0" allowfullscreen></iframe></li>
                <li>
                    <div class="video-banner-place">
                        <?if(function_exists('get_banner')):?>
                            <?if(get_banner('ვიდეო L',$registry['post'][0]['cat_id']) == true):?>
                                <?=get_banner('ვიდეო R',$registry['post'][0]['cat_id']);?>
                            <?else:?>
                                <span>სარეკლამო ბანერი (150x500)</span>
                            <?endif;?>
                        <?endif;?>
                    </div>
                </li>
            </ul>
        </div>

    <div class="fix"></div><br><br>
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


        <!--
        <div class="post-short">
            <?//if(firstSymbol($registry['post'][0]['text_short'],1) != false):?>
                <span><?//=firstSymbol($registry['post'][0]['text_short']); ?></span>
                <?//=preg_replace('/'.firstSymbol($registry['post'][0]['text_short']).'/',' ',$registry['post'][0]['text_short'],1);?>
            <?//else:?>
                <?//=$registry['post'][0]['text_short'];?>
            <?//endif;?>
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

    <div class="fix"></div>
    <br><br>
-->
    </div>
</div>

