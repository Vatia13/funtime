<?defined('_JEXEC') or die('Restricted access');?>
<div class="mobile-content">
    <div class="post-time"><span><?=gedate('l H:i',$registry['post'][0]['date']);?> </span> <span> <?=gedate('d.m.Y',$registry['post'][0]['date']);?></span></div>
    <h1><?=$registry['post'][0]['title'];?></h1>
    <?if($registry['post'][0]['style'] == 12):?>
        <div class="author"><span>ავტორი:</span> <span><?=$registry['post'][0]['realname'];?></span></div><br>
        <br><br>
        <iframe id="ytplayer" type="text/html" width="100%"  src="https://www.youtube.com/embed/<?=$registry['post'][0]['youtube'];?>?theme=light" frameborder="0" allowfullscreen></iframe>
    <?else:?>
        <img src="/img/uploads/news/read/<?=$registry['post'][0]['img'];?>" width="100%">
    <?endif;?>
    <br><br>
    <div class="fix"></div>
    <?if($registry['post'][0]['moderate'] == 1):?>
        <div class="post-socials">
            <ul>
                <li>
                    <div class="fb-like" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/" data-width="80" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                </li>
                <li>
                    <div class="fb-share-button" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/" data-layout="button_count"></div>
                </li>
            </ul>
        </div>
    <?endif;?>
    <?if($registry['post'][0]['style'] != 12):?>
    <div class="author"><span>ავტორი:</span> <span><?=$registry['post'][0]['realname'];?></span></div><br>

    <div class="post-short">
        <?if(firstSymbol($registry['post'][0]['text_short'],1) != false):?>
            <span><?=firstSymbol($registry['post'][0]['text_short']); ?></span>
            <?=preg_replace('/'.firstSymbol($registry['post'][0]['text_short']).'/',' ',strip_tags($registry['post'][0]['text_short']),1);?>
        <?else:?>
            <?=strip_tags($registry['post'][0]['text_short']);?>
        <?endif;?>
    </div>
    <div class="fix"></div>
    <?=str_replace("&nbsp;",' ',$registry['post'][0]['text']);?>
    <div class="fix"></div>
    <?if(!empty($registry['post'][0]['youtube']) && $registry['post'][0]['style'] != 12):?>
        <br><br>
        <iframe id="ytplayer" type="text/html" width="100%"  src="https://www.youtube.com/embed/<?=$registry['post'][0]['youtube'];?>?theme=light" frameborder="0" allowfullscreen></iframe>
    <?endif;?>
    <?if(!empty($registry['post'][0]['slide'])): $registry['slider'] = (unserialize($registry['post'][0]['slide']) <> "") ? unserialize($registry['post'][0]['slide']) : unserialize(base64_decode($registry['post'][0]['slide']));?>
        <?if(count($registry['slider']['img']) > 1):?>

            <ul class="mobile-slider gallery">
                <?$image_url = array(); for($i=0;$i<count($registry['slider']['img']);$i++):
                    $image_url[$i] = str_replace('http://funtime.ge:80/','',$registry['slider']['img'][$i]);
                    ?>
                    <li><a href="<?=$registry['slider']['img'][$i];?>"  data-facebook="https://www.facebook.com/dialog/feed?app_id=1391061841189461&link=http://www.funtime.ge/<?=$registry['post'][0]['cat_chpu']?>/<?=$registry['post'][0]['chpu']?>/&title=<?echo str_replace(' ','+',$registry['post'][0]['title']);?>&picture=<?=$registry['slider']['img'][$i];?>&description=<?=strip_tags($registry['post'][0]['text_short'])?>&redirect_uri=https://www.facebook.com/" rel="prettyPhoto[pp_gal2]" ><img src="<?=$registry['slider']['img'][$i];?>" title="<?=strip_tags($registry['slider']['name'][$i]);?>" data-description="<?=$registry['slider']['name'][$i];?>"></a></li>
                <?endfor;?>
            </ul>
        <?endif;?>
    <?endif;?>
    <?endif;?>
    <div class="fix"></div>

    <?if($registry['post'][0]['test'] > 0):?>
        <? get_module('vic');?>
    <?endif;?>
    <div class="fix"></div>

</div>
<div class="fb-comments" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
<br><br>