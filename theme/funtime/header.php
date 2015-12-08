<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<link rel="shortcut icon" href="/<?=$theme?>images/favicon.ico" type="image/x-icon"/>
<link rel="icon" href="/<?=$theme?>images/favicon.ico" type="image/x-icon"/>
<?get_meta()?>
<title><?get_title();?></title>
    <link href="/<?=$theme?>css/style.css?ver=0.1" rel="stylesheet" type="text/css" id="style" />
    <?if(get_banner('ბრენდირება L',$registry['post'][0]['cat_id']) == false):?>
        <link href="/<?=$theme?>css/responsive.css?ver=0.8" rel="stylesheet" type="text/css"/>
    <?else:?>
        <link href="/<?=$theme?>css/responsive_zoom.css?ver=0.1" rel="stylesheet" type="text/css"/>
    <?endif;?>
<link href="/<?=$theme?>css/fb.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<script src="/<?=$theme?>js/jquery-1.11.0.min.js"></script>
<script src="/<?=$theme?>js/jquery-migrate-1.2.1.min.js"></script>
<script src="/<?=$theme?>js/jquery-ui.js"></script>
<script src="/<?=$theme?>js/keyboard.js"></script>
    <script>
        var brand = 0;
        <?if($registry['post'][0]['cat_id'] == 205 || $registry['post'][0]['cat_id'] == 212):?>
        brand = 1;
        <?endif;?>
    </script>
<script language="JavaScript" type="text/javascript" src="/<?=$theme?>js/functions.js?ver=0.2"></script>
    <!--
<script language="JavaScript" type="text/javascript" src="/<?=$theme?>js/rubric.scroll.js"></script>
<script>
$(function() {
var nicesx = $(".rubrics").niceScroll({touchbehavior:false,cursorcolor:"#ff5704",cursoropacitymax:0.6,cursorwidth:8});
});
</script>-->
    <?if(isset($_GET['pitem']) && isset($_GET['pcat'])):?>
        <link type="text/css" rel="stylesheet" href="/<?=$theme?>css/rainbow.css" />
    <?if(!$_GET['new_slider'] && $registry['post'][0]['slide_type'] == '1'):?>
    <link type="text/css" rel="stylesheet" href="/<?=$theme?>css/pgwslider.css" />
        <script src="/<?=$theme?>js/pgwslider.js"></script>
    <?endif;?>
    <?endif;?>
    <script src="/<?=$theme?>js/scrollToTop.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#toTop").scrollToTop(1000);
        });
    </script>

    <?php @include_once('.extra.php');?>
<script type="text/javascript" src="/<?=$theme?>js/swiffy.js"></script>
<script type="text/javascript" src="/<?=$theme?>js/Tweenlite.min.js"></script>
</head>
<body style="<?if($registry['deviceType'] == 'tablet'):?>zoom:85%;<?endif;?><?php if($registry['post'][0]['cat']=='123'):?> background:url('<?=$registry['horo_img'];?>') 50% 0 no-repeat fixed; background-size:cover;<?endif;?>">
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1391061841189461',
            xfbml      : true,
            version    : 'v2.2'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

</script>

<a href="#top" id="toTop"></a>
<div id="container" <?if($registry['deviceType'] == 'tablet'):?>style="margin-top:-50px;"<?endif;?>>
<?if($registry['deviceType'] == 'computer'):?>
<div class="header-bg" style="background:url('<?=$registry['header_img'];?>') repeat-x;"></div>
<?endif;?>
<?get_module('rubrics');?>
<?get_module('facebook');?>
<?get_module('message');?>
    <div id="header">
        <div class="header">

            <ul class="header-left">
                <li><a onclick="showRubrics();" class="menu-btn"></a></li>
                <li><a href="/" class="logo"></a></li>
            </ul>
            <ul class="header-right">
                <li>
                    <form action="/com/search/" method="get" name="src">
                        <input type="checkbox" name="kbd" id="geoKeys" value="0" checked="checked" style="display:none;"/>
                        <input type="text" onkeypress="return makeGeo(this,event);" name="text" value="<?=$_GET['s'];?>" id="search"/> <a onclick="if(document.getElementById('search').value == ''){$('#search_ex,.close-search').slideDown(200); return false;}else{document.src.submit();}" class="search-btn"></a>
                    </form>
                </li>
                <li class="header-contact" style="padding-right:0;"><a href="/com/contacts">კონტაქტი</a></li>
                <li><div style="<?if($registry['deviceType'] == 'computer'):?>padding:25px 0 15px 0;position:relative;<?else:?>position:relative;top:20px;<?endif;?>" class="fb-like" data-href="https://www.facebook.com/funtime.ge" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></li>
                <li><a href="https://www.facebook.com/funtime.ge" target="_blank" class="fb-btn"></a></li>
            </ul>
        </div>
    </div>
