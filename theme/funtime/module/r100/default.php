<?defined('_JEXEC') or die('Restricted access');?>

<div class="post-r100">
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
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td valign="top" width="745">
                <div class="post-title">
                    <h1><?=$registry['post'][0]['title'];?></h1>
                    <?if(count($registry['slide']['img']) > 1):?>
                        <div class="post-slide-message">ფოტოსლაიდი <?=count($registry['slide']['img']);?> ფოტო</div>
                    <?endif;?>
                    <?if(!empty($registry['post'][0]['title_short'])):?><h3><?=$registry['post'][0]['title_short']?></h3><?endif;?>
                    <div class="post-time">
                        <span><?=gedate('l',$registry['post'][0]['date']);?></span> <span><?=gedate('H:i',$registry['post'][0]['date']);?></span> <span><?=gedate('d.m.Y',$registry['post'][0]['date']);?></span>
                    </div>
                </div>

                <div class="post-image" style="border:25px solid <?=$registry['color']['frame'];?>">
                    <h3 style="background-color:<?=$registry['color']['rubric'];?>; opacity:0.8; <?if(count($registry['slide']['img']) > 1):?>background-image:url('/<?=$theme?>images/main_icon.png');background-repeat:no-repeat;background-position:right 10px center;padding:18px 60px 15px 10px;<?else:?>padding:18px 10px 15px 10px;<?endif;?>"><?=$registry['post'][0]['name'];?></h3>
                    <img src="/img/uploads/news/read/<?=$registry['post'][0]['img'];?>" width="695" height="445"/>
                </div>
                <div class="fix"></div>
                <br>
                <div class="post-short">
                    <?if(firstSymbol($registry['post'][0]['text_short'],1) != false):?>
                        <span><?=firstSymbol($registry['post'][0]['text_short']); ?></span>
                        <? $short_text = preg_replace('/'.firstSymbol($registry['post'][0]['text_short']).'/',' ',$registry['post'][0]['text_short'],1); echo $short_text;?>
                    <?else:?>
                        <?=$registry['post'][0]['text_short'];?>
                    <?endif;?>

                </div>
            </td>
            <td valign="top" align="right">
                <div class="saknatuna">
                    <ul>
                        <?foreach($registry['saknatuna'] as $item):?>
                            <li>
                                <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"> <img src="<?=substr($item['thumbs'],2);?>" width="100" alt="<?=$item['title'];?>" title="<?=$item['title'];?>" align="left"> <?$str = get_serie($item['title']); $title = str_replace('('.$str.')','',$item['title']); echo $title;  if(!empty($str)): echo '<br>('.$str.')'; endif;?> </a>
                                <br><div class="two-time"><span><?=gedate('H:i',$item['date']);?> </span> / <span> <?=gedate('d.m.Y',$item['date']);?></span></div>
                            </li>
                        <?endforeach;?>
                    </ul>
                </div>
            </td>
        </tr>
    </table>



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
        <? $ex_text_img = explode('<img',$registry['post'][0]['text']); $imgnum = count($ex_text_img) - 1;?>
        <div <?if($imgnum > 6):?>style="float:left;max-width:940px;min-height:3668px;margin-right:30px;"<?endif;?>><?=$registry['post'][0]['text'];?><div class="fix"></div></div>
        <?if($imgnum > 6):?>
        <div>
                <div class="saknatuno-banner-place">
                    <?if(function_exists('get_banner')):?>
                        <?if(get_banner('F6',$registry['post'][0]['cat_id']) == true):?>
                            <?=get_banner('F6',$registry['post'][0]['cat_id']);?>
                        <?else:?>
                            <span>სარეკლამო ბანერი (200x500)</span>
                        <?endif;?>
                    <?endif;?>
                </div>
            <br>
            <div class="saknatuno-banner-place">
                <?if(function_exists('get_banner')):?>
                    <?if(get_banner('F7',$registry['post'][0]['cat_id']) == true):?>
                        <?=get_banner('F7',$registry['post'][0]['cat_id']);?>
                    <?else:?>
                        <span>სარეკლამო ბანერი (200x500)</span>
                    <?endif;?>
                <?endif;?>
            </div>
            <br>
            <div class="saknatuno-banner-place">
                <?if(function_exists('get_banner')):?>
                    <?if(get_banner('F8',$registry['post'][0]['cat_id']) == true):?>
                        <?=get_banner('F8',$registry['post'][0]['cat_id']);?>
                    <?else:?>
                        <span>სარეკლამო ბანერი (200x500)</span>
                    <?endif;?>
                <?endif;?>
            </div>
            <br>
            <div class="saknatuno-banner-place">
                <?if(function_exists('get_banner')):?>
                    <?if(get_banner('F9',$registry['post'][0]['cat_id']) == true):?>
                        <?=get_banner('F9',$registry['post'][0]['cat_id']);?>
                    <?else:?>
                        <span>სარეკლამო ბანერი (200x500)</span>
                    <?endif;?>
                <?endif;?>
            </div>
            <br>
            <div class="saknatuno-banner-place">
                <?if(function_exists('get_banner')):?>
                    <?if(get_banner('F10',$registry['post'][0]['cat_id']) == true):?>
                        <?=get_banner('F10',$registry['post'][0]['cat_id']);?>
                    <?else:?>
                        <span>სარეკლამო ბანერი (200x500)</span>
                    <?endif;?>
                <?endif;?>
            </div>
            <br>
            <div class="saknatuno-banner-place">
                <?if(function_exists('get_banner')):?>
                    <?if(get_banner('F11',$registry['post'][0]['cat_id']) == true):?>
                        <?=get_banner('F11',$registry['post'][0]['cat_id']);?>
                    <?else:?>
                        <span>სარეკლამო ბანერი (200x500)</span>
                    <?endif;?>
                <?endif;?>
            </div>
            <br>
            <div class="saknatuno-banner-place">
                <?if(function_exists('get_banner')):?>
                    <?if(get_banner('F12',$registry['post'][0]['cat_id']) == true):?>
                        <?=get_banner('F12',$registry['post'][0]['cat_id']);?>
                    <?else:?>
                        <span>სარეკლამო ბანერი (200x500)</span>
                    <?endif;?>
                <?endif;?>
            </div>
        </div>
        <?endif;?>

    </div>
    <div class="fix"></div>
</div>
</div>
