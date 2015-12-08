<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Дата в прошлом
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <link rel="shortcut icon" href="/<?=$theme?>images/favicon.ico" type="image/x-icon"/>
    <link rel="icon" href="/<?=$theme?>images/favicon.ico" type="image/x-icon"/>
    <?get_meta()?>
    <title><?get_title();?></title>
    <link href="/<?=$theme?>css/style.css" rel="stylesheet" type="text/css" id="style" />
    <link href="/<?=$theme?>css/fb.css" rel="stylesheet" type="text/css" />
    <script src="/<?=$theme?>js/jquery-1.11.0.min.js"></script>
    <script src="/<?=$theme?>js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/<?=$theme?>js/jquery-ui.js"></script>
    <script src="/<?=$theme?>js/keyboard.js"></script>
    <script language="JavaScript" type="text/javascript" src="/<?=$theme?>js/funtime.functions.js"></script>
    <!--
<script language="JavaScript" type="text/javascript" src="/<?=$theme?>js/rubric.scroll.js"></script>
<script>
$(function() {
var nicesx = $(".rubrics").niceScroll({touchbehavior:false,cursorcolor:"#ff5704",cursoropacitymax:0.6,cursorwidth:8});
});
</script>-->
    <?if(isset($_GET['pitem']) && isset($_GET['pcat'])):?>
        <link type="text/css" rel="stylesheet" href="/<?=$theme?>css/rainbow.css" />
        <link type="text/css" rel="stylesheet" href="/<?=$theme?>css/pgwslider.css" />
        <link type="text/css" rel="stylesheet" href="/<?=$theme?>css/prettyPhoto.css" />
        <script src="/<?=$theme?>js/pgwslider.js"></script>
        <script src="/<?=$theme?>js/jquery.prettyPhoto.js"></script>
    <?endif;?>
    <?=fb_content();?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-57795451-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>
<body <?if($registry['deviceType'] == 'tablet'):?>style="zoom:85%"<?endif;?>>

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

<div id="container" <?if($registry['deviceType'] == 'tablet'):?>style="margin-top:-150px;"<?endif;?>>
    <div class="header-bg" style="background:url('<?=$registry['header_img'];?>') repeat-x;"></div>
    <?get_module('rubrics');?>
    <?get_module('facebook');?>
    <?get_module('message');?>
    <div id="header">
        <div class="header">

            <ul class="header-left">
                <li><a onclick="showRubrics()" class="menu-btn"></a></li>
                <li><a href="/" class="logo"></a></li>
                <li>საიტი მუშაობს სატესტო რეჟიმში</li>
            </ul>
            <ul class="header-right">
                <li>
                    <form action="/com/search/" method="get" name="src">
                        <input type="checkbox" name="kbd" id="geoKeys" value="0" checked="checked" style="display:none;"/>
                        <input type="text" onkeypress="return makeGeo(this,event);" name="text" value="<?=$_GET['s'];?>" id="search"/> <a onclick="if(document.getElementById('search').value == ''){$('#search_ex,.close-search').slideDown(200); return false;}else{document.src.submit();}" class="search-btn"></a>
                    </form>
                </li>

                <li><a onclick="showFacebook()" class="fb-btn"></a></li>
            </ul>
        </div>
    </div>
