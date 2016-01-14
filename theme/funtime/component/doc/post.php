<?defined('_JEXEC') or die('Restricted access');?>
<?//get_module('popular-articles');?>

<div id="content" style="position:relative;">

    <? if($registry['post'][0]['id'] > 0){ ?>
    <?if($registry['deviceType'] == 'computer' or $registry['deviceType'] == 'tablet'):?>


    <?if($registry['post'][0]['type'] == 1):?>
        <?get_module('photocontest');?> <!-- ფოტოკონკურსის მოდული -->
    <?else:?>
        <?if($registry['post'][0]['style'] > 0):?>
            <?get_module('r'.$registry['post'][0]['style']);?> <!-- რუბრიკები დიზაინის მიხედვით -->
        <?endif;?>
    <?endif;?>
    <div class="content">
        <!-- დამატებითი ინფორმაცია (skype,facebook,email,phone) -->
        <?php @include('.informer.php'); ?>
        <!-- // --> 
        
        <!-- YOUTUBE ფლეიერი -->
            <?php @include('.youtube.php'); ?>
        <!-- // -->

        <!-- სლაიდერი (ძველი და ახალი) -->
        <?php @include('.slide.php'); ?>
        <!-- // -->

        <!-- წყარო -->
        <?php @include('.wyaro.php'); ?>
        <!-- // -->

        <!-- ვიქტორინის მოდული -->
        <?if($registry['post'][0]['test'] > 0):?>
            <? get_module('vic');?>
        <?endif;?>
        <!-- // -->
        
        <!-- სოციალური ქსელი -->
        <?php @include('.socials.php'); ?>
        <!-- // -->
        <?get_module('popular-articles');?> <!-- პოპულარული სიახლეები -->
    </div>
</div>

<br>

<div class="fix"></div>
<?else:?>
    <?if($registry['post'][0]['type'] == 1):?> 
        <!--ფოტოკონკურსი მობილურ ვერსიაზე დროებით გამორთულია.-->
        <?get_module('photocontest');?> 
    <?else:?>
        <?get_module('rm');?> <!-- წაკითხვის გვერდზე - მობილური ვერსიის დიზაინი -->
    <?endif;?>
<?endif;?>
<?}else{
echo '<div class="content"><div class="warning_box ">სტატია არ მოიძებნა.</div></div>';
}?>
<?if(!$_GET['new_slider'] && $registry['post'][0]['slide_type'] == '1' && $registry['deviceType'] != 'phone'):?>
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
    <?if(!$_GET['new_slider'] && $registry['post'][0]['slide_type'] == '1' && $registry['deviceType'] != 'phone'):?>
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
        <?include('new_slider.php');?> <!-- ახალი სლაიდერის სტილები და ჯავასკრიპტი -->
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


