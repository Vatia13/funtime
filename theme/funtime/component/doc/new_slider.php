<?php defined('_JEXEC') or die('Restricted access'); ?>
<script src="/<?=$theme?>js/touchwipe.js?ver=0.1"></script>
<link type="text/css" rel="stylesheet" href="/<?=$theme?>css/new_slider/prettyPhotoOriginal<?=($registry['deviceType'] != 'phone') ? '1':'';?>.css?ver=0.9" />
<script src="/<?=$theme?>js/new_slider/jquery.prettyPhotoOriginal.js?ver=0.9"></script>
<?if(function_exists('get_banner')):?>
    <?if(get_banner('SL2',$registry['post'][0]['cat_id']) == true):?>
        <? $sl = '<div class="index-banner-place" style="position:relative;top:5px;"><div class="banner-place" style="width:340px;height:200px;">'.get_banner("SL2",$registry["post"][0]["cat_id"]).'</div></div>'; ?>
        <?else:?>
        <? $sl = '';?>
    <?endif;?>
<?endif;?>
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
        $(".gallery li a[rel^='prettyPhoto[pp_gal2]']").prettyPhoto({
            theme:'facebook',
            opacity:1,
            banner:'<?=$sl;?>',
            deeplinking:false,
            facebook:true,
            star_rate:true,
            autoplay_slideshow: false,
            show_title: true,
            overlay_gallery: false,
            allow_resize: true,
            out_of_date: '<?=$registry['out_of_date'];?>',
            slide_effect: '<?=($registry['deviceType'] != 'phone') ? 'other' : 'fade';?>',
            changepicturecallback:function() {
                setupSwipe();
            },
            deviceType:'<?=$registry['deviceType']?>',
            social_tools:'<a target="_blank" class="fb_share_contest" href="https://www.facebook.com/dialog/feed?app_id=1391061841189461&link=http://www.funtime.ge/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/&title=<?php echo str_replace(' ','+',$registry['post'][0]['title']);?>&redirect_uri=https://www.facebook.com/&picture=http://www.funtime.ge/img/uploads/news/fb/<?=date('Y-m',strtotime($registry['post'][0]['updated_at']));?>/{pic}&description={name}"> </a>'
        });

        //$(".pp_pic_holder,.pp_content")
        <?if($registry['deviceType'] != 'phone'):?>
        var imageNum = $('.gallery li').length;
        var w = 0;
        for(var i = 1; i <= imageNum; i++){

            if($('.gallery li:nth-child('+i+') .zoom-pic img').height() > $('.gallery li:nth-child('+i+') .zoom-pic img').width()){
                w = $('.gallery li:nth-child('+i+')').width();
                $('.gallery li:nth-child('+i+')').width((w / 2) - 5);
                $('.gallery li:nth-child('+i+') .zoom-pic img').width((w / 2) - 5);
            }
        }
        <?endif;?>
    });
</script>
