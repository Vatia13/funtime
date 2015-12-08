<?defined('_JEXEC') or die('Restricted access');?>
<?//get_module('popular-articles');?>

<div id="content">

    <? if($registry['post'][0]['id'] > 0){ ?>
    <?if($registry['deviceType'] == 'computer'):?>
    <?if($registry['post'][0]['style'] > 0):?>
        <?get_module('r'.$registry['post'][0]['style']);?>
    <?endif;?>
    <div class="content">
        <div class="fix"></div>
        <?if(!empty($registry['post'][0]['youtube'])):?>
            <br><br>
            <iframe id="ytplayer" type="text/html" width="1130" height="670" src="https://www.youtube.com/embed/<?=$registry['post'][0]['youtube'];?>?theme=light" frameborder="0" allowfullscreen></iframe>
        <?endif;?>
        <?if(!empty($registry['post'][0]['slide'])): $registry['slider'] = unserialize($registry['post'][0]['slide']);?>
            <?if(count($registry['slider']['img']) > 1):?>
                <br><br>
                <ul class="pgwSlideshow gallery2 clearfix">
                    <?$image_url = array(); for($i=0;$i<count($registry['slider']['img']);$i++):
                        $image_url[$i] = str_replace('http://funtime.ge:80/','',$registry['slider']['img'][$i]);
                        ?>
                        <li title="<?=$registry['slider']['name'][$i];?>"><img src="http://funtime.ge/funtime.php?image=<?=$image_url[$i];?>" title="<?=$registry['slider']['name'][$i];?>" data-description="<?=$registry['slider']['name'][$i];?>"></li>
                    <?endfor;?>
                </ul>
            <?endif;?>
        <?endif;?>
        <?if($registry['post'][0]['test'] > 0):?>
            <? get_module('vic');?>
        <?endif;?>
        <div class="fix"></div>

        <?get_module('post-share');?>

        <div class="fix"></div>
        <?if($registry['post'][0]['moderate'] == 1):?>
            <div class="fb-comments" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
        <?endif;?>

        <div class="fix"></div>
        <?get_module('popular-articles');?>
    </div>
</div>


<br>
<div class="fix"></div>
<?else:?>
    <?get_module('rm');?>
<?endif;?>
<?}else{
echo '<div class="content"><div class="warning_box ">სტატია არ მოიძებნა.</div></div>';
}?>

<script>
    $(document).ready(function() {
        var options = {
            transitionEffect : 'fading',
            displayControls: false,
            displayList: true,
            maxHeight : 500
        }
        $('.pgwSlideshow').pgwSlideshow(options);

    });
</script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $("area[rel^='prettyPhoto']").prettyPhoto();

        $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:3000, autoplay_slideshow: false,social_tools:false});
        $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});

        $("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
            custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
            changepicturecallback: function(){ initialize(); }
        });

        $("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
            custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
            changepicturecallback: function(){ _bsap.exec(); }
        });


        $("area[rel^='prettyPhoto']").prettyPhoto();

        $(".gallery2:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:3000, autoplay_slideshow: false,social_tools:false});
        $(".gallery2:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});

        $("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
            custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
            changepicturecallback: function(){ initialize(); }
        });

        $("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
            custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
            changepicturecallback: function(){ _bsap.exec(); }
        });
    });
</script>