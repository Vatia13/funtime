<?defined('_JEXEC') or die('Restricted access');?>
<?//get_module('popular-articles');?>

<div id="content">

    <? if($registry['post'][0]['id'] > 0){ ?>
    <?if($registry['deviceType'] == 'computer' or $registry['deviceType'] == 'tablet'):?>


    <?if($registry['post'][0]['type'] == 1):?>
        <?get_module('photocontest');?>
    <?else:?>
        <?if($registry['post'][0]['style'] > 0):?>
            <?get_module('r'.$registry['post'][0]['style']);?>
        <?endif;?>
    <?endif;?>
    <div class="content">
        <? if(is_array($registry['informer'])): $website = 'http://'.str_replace('http://','',$registry['informer']['website']);?>
            <ul style="list-style:none;margin:0;padding:0;">
                <?if(!empty($registry['informer']['address'])):?>
                <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"><img src="/img/icons/info-address.png"> <span style="position:relative;bottom:10px;left:15px"><?=$registry['informer']['address'];?></span></li>
                <?endif;?>
                <?if(!empty($registry['informer']['facebook'])):?>
                <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"> <a href="<?=$registry['informer']['facebook'];?>" style="text-decoration:none;color:#000;" target="_blank"><img src="/img/icons/info-facebook.png"><span style="position:relative;bottom:10px;left:15px">Facebook</span></a></li>
                <?endif;?>
                <?if(!empty($registry['informer']['skype'])):?>
                <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"> <a href="skype:<?=$registry['informer']['skype'];?>" style="text-decoration:none;color:#000;"><img src="/img/icons/info-skype.png"><span style="position:relative;bottom:10px;left:15px"><?=$registry['informer']['skype'];?></span></a></li>
                <?endif;?>
                <?if(!empty($registry['informer']['mobile'])):?>
                <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"> <a href="tel:<?=$registry['informer']['mobile'];?>" style="text-decoration:none;color:#000;"><img src="/img/icons/info-mobile.png"><span style="position:relative;bottom:10px;left:15px"><?=$registry['informer']['mobile'];?></span></a></li>
                <?endif;?>
                <?if(!empty($registry['informer']['phone'])):?>
                <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"> <a href="tel:<?=$registry['informer']['phone'];?>" style="text-decoration:none;color:#000;"><img src="/img/icons/info-phone.png"><span style="position:relative;bottom:10px;left:15px"><?=$registry['informer']['phone'];?></span></a></li>
                <?endif;?>
                <?if(!empty($registry['informer']['email'])):?>
                <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"> <a href="mailto:<?=$registry['informer']['email'];?>" style="text-decoration:none;color:#000;"><img src="/img/icons/inf-email.png"><span style="position:relative;bottom:10px;left:15px"><?=$registry['informer']['email'];?></span></a></li>
                <?endif;?>
                <?if(!empty($registry['informer']['website'])):?>
                <li style="font-family:'BPGIngiri2008Regular';margin:10px 0px;"> <a href="<?=$website;?>" style="text-decoration:none;color:#000;"  target="_blank"><img src="/img/icons/inf-web.png"><span style="position:relative;bottom:10px;left:15px"><?=$registry['informer']['website'];?></span></a></li>
                <?endif;?>
            </ul>
        <?endif;?>
        <div class="fix"></div>
        <?if(!empty($registry['post'][0]['youtube']) && $registry['post'][0]['style'] != 12):?>
            <br><br>
            <iframe id="ytplayer" type="text/html" width="1130" height="670" src="https://www.youtube.com/embed/<?=$registry['post'][0]['youtube'];?>?theme=light" frameborder="0" allowfullscreen></iframe>
        <?endif;?>
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
                        //http://funtime.ge/funtime.php?image=<?=$image_url[$i];
                        ?>
                        <li>
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
                            <span><?=strip_tags($registry['slider']['name'][$i]);?></span>
                        <?endif;?>
                            <a href="<?=$registry['slider']['img'][$i];?>" data-facebook="https://www.facebook.com/dialog/feed?app_id=1391061841189461&link=http://www.funtime.ge/<?=$registry['post'][0]['cat_chpu']?>/<?=$registry['post'][0]['chpu']?>/&title=<?echo str_replace(' ','+',$registry['post'][0]['title']);?>&picture=http://www.funtime.ge/img/uploads/news/fb/<?=date('Y-m',strtotime($registry['post'][0]['time']));?>/<?=$registry['post'][0]['id'].'_'.last_par_url($registry['slider']['img'][$i]);?>&description=<?=strip_tags($registry['post'][0]['text_short'])?>&redirect_uri=https://www.facebook.com/" title="<?=$registry['slider']['name'][$i];?>" rel="prettyPhoto[pp_gal2]" >
                                <img src="<?=$registry['slider']['img'][$i];?>" style="max-width:940px !important;" title="<?=strip_tags($registry['slider']['name'][$i]);?>" data-description="<?=$registry['slider']['name'][$i];?>">
                            </a>
                        </li>
                    <?endfor;?>
                </ul>
            <?endif;?>
        <?endif;?>
        <?if(is_array($registry['wyaro']) && !empty($registry['wyaro']['title'])): $wurl = 'http://'.str_replace('http://','',$registry['wyaro']['url']);?>

            <div class="fix"></div>
            <br>
            <a href="<?=$wurl;?>" target="_blank" style="float:right;text-decoration:none;color:#000;font-size:18px;font-family:'Open Sans sens-serif';"><span style="color:#ff894f;font-family:'BPGIngiri2008Regular';">წყარო:</span> <?=$registry['wyaro']['title'];?></a>
            <div class="fix"></div>
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
    <?if($registry['post'][0]['type'] == 1):?>
        <!--ფოტოკონკურსი მობილურ ვერსიაზე დროებით გამორთულია.-->
        <?get_module('photocontest');?>
    <?else:?>
    <?get_module('rm');?>
    <?endif;?>
<?endif;?>
<?}else{
echo '<div class="content"><div class="warning_box ">სტატია არ მოიძებნა.</div></div>';
}?>
<?if(!$_GET['new_slider'] && $registry['post'][0]['slide_type'] == '1'):?>
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
<?endif;?>
<?if($registry['pbanners'][2]['id'] > 0):?>
    <? $slide_banner1 = $registry['pbanners'][2]['id'];?>
<?else:?>
    <? $slide_banner1 = '';?>
<?endif;?>

<?if($registry['pbanners'][3]['id'] > 0):?>
    <? $slide_banner2 = $registry['pbanners'][3]['id'];?>
<?else:?>
    <? $slide_banner2 = '';?>
<?endif;?>


<!-- pretty Photo -->
<?if($registry['post'][0]['type'] == 1):?>
    <script src="/<?=$theme?>js/touchwipe.js?ver=0.1"></script>
    <link type="text/css" rel="stylesheet" href="/<?=$theme?>css/prettyPhotoOriginal.css?ver=0.11" />
    <script src="/<?=$theme?>js/jquery.prettyPhotoOriginal.js?ver=0.11"></script>
    <script type="text/javascript" charset="utf-8">
        function setupSwipe() {
            $(function() {
                $("#pp_full_res").swipe( {
                    swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
                        if(direction == 'left'){
                            $.prettyPhoto.changePage('next')
                        }else{
                            $.prettyPhoto.changePage('previous')
                        }
                    },
                    threshold:0,
                    fingers:'all'
                });
            });
        }
        $(document).ready(function() {
            $(".contest_gallery li a[rel^='prettyPhoto']").prettyPhoto({
                theme:'facebook',
                opacity:1,
                deeplinking:false,
                facebook:true,
                star_rate:true,
                autoplay_slideshow: false,
                show_title: true,
                overlay_gallery: '<?=($registry['deviceType'] == 'phone') ? false : true?>',
                allow_resize: true,
                out_of_date: '<?=$registry['out_of_date'];?>',
                changepicturecallback:function() {
                    setupSwipe();
                },
                deviceType:'<?=$registry['deviceType']?>',
                social_tools:'<a target="_blank" class="fb_share_contest" href="https://www.facebook.com/dialog/feed?app_id=1391061841189461&link=http://www.funtime.ge/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/&title=<?php echo str_replace(' ','+',$registry['post'][0]['title']);?>&redirect_uri=https://www.facebook.com/&picture=http://www.funtime.ge/img/uploads/news/fb/<?=date('Y-m',strtotime($registry['contest'][0]['updated_at']));?>/{pic}&description={name}"> </a>'
            });
        });
    </script>
<?else:?>
    <?if(!$_GET['new_slider'] && $registry['post'][0]['slide_type'] == '1'):?>
<link type="text/css" rel="stylesheet" href="/<?=$theme?>css/prettyPhotoNew6.css?ver=0.5" />
<script src="/<?=$theme?>js/jquery.prettyPhoto7.js?ver=0.5"></script>


<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){

        $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',banner1:'<?if(function_exists('get_banner')):?><?if(get_banner('SL1 L',$registry['post'][0]['cat_id']) == true):?><?=get_banner('SL1 L',$registry['post'][0]['cat_id']);?><?endif;?><?endif;?>',banner2:'<?if(function_exists('get_banner')):?><?if(get_banner('SL1 R',$registry['post'][0]['cat_id']) == true):?><?=get_banner('SL1 R',$registry['post'][0]['cat_id'],'banner2');?><?endif;?><?endif;?>',theme:'facebook',slideshow:3000, autoplay_slideshow: false,social_tools:false});
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

        $(".gallery2:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',banner1:'<?if(function_exists('get_banner')):?><?if(get_banner('SL1 L',$registry['post'][0]['cat_id']) == true):?><?=get_banner('SL1 L',$registry['post'][0]['cat_id']);?><?endif;?><?endif;?>',banner2:'<?if(function_exists('get_banner')):?><?if(get_banner('SL1 R',$registry['post'][0]['cat_id']) == true):?><?=get_banner('SL1 R',$registry['post'][0]['cat_id'],'banner2');?><?endif;?><?endif;?>',theme:'facebook',slideshow:3000, autoplay_slideshow: false,social_tools:false});
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
    <?else:?>
        <?include('new_slider.php');?>
    <?endif;?>
<?endif;?>

<!-- end pretty Photo -->
<?if($registry['deviceType'] == 'computer' or $registry['deviceType'] == 'tablet'):?>
<? get_module('new-articles');?>
<?endif;?>
<script>
    $(document).ready(function(){
       //var uagent = '<?=$_SERVER['HTTP_USER_AGENT'];?>';
       var iOS = /iPad|iPhone|iPod/i.test( navigator.userAgent );
       var Android = /Android/i.test( navigator.userAgent );
        if(/Android|iPhone|iPod/i.test( navigator.userAgent )){
            var bannerNum = $('div.mobile-content a').length;
        }else{
            var bannerNum = $('div.post-content a').length;
        }
        var object;

        for(var i=0;i<bannerNum;i++){
            if(/Android|iPhone|iPod/i.test( navigator.userAgent )){
                object = $('.mobile-content a:eq('+i+')');
            }else{
                object = $('.post-content a:eq('+i+')');
            }

            if(!object.attr('title')){
                return;
            }
            if(object.attr('title').indexOf("http") > -1){
                if(iOS){
                    console.log('iOS');
                    object.attr('href',object.attr('title'));
                    object.attr('title','iOS');
                }else if(Android){
                    object.attr('title','Android');
                    console.log('Android');
                }else{
                    object.attr('href','http://infos.ge/');
                    object.attr('title','infos.ge');
                }
            }
        }
    });
</script>


