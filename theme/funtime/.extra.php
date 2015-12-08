<?=fb_content();?>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-57795451-1', 'auto');
    ga('send', 'pageview');

</script>
<?php if($registry['post'][0]['cat']=='123'):?>
    <style>
        .content{
            background-color:#FFF;
            padding:50px 20px;
            opacity:0.9;
        }

    </style>
<?php endif;?>
<?php if($registry['post'][0]['cat']=='132'):?>
    <script>(function() {

            var _fbq = window._fbq || (window._fbq = []);

            if (!_fbq.loaded) {

                var fbds = document.createElement('script');

                fbds.async = true;

                fbds.src = '//connect.facebook.net/en_US/fbds.js';

                var s = document.getElementsByTagName('script')[0];

                s.parentNode.insertBefore(fbds, s);

                _fbq.loaded = true;

            }

            _fbq.push(['addPixelId', '1628889367395919']);

        })();

        window._fbq = window._fbq || [];

        window._fbq.push(['track', 'PixelInitialized', {}]);

    </script>

    <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=1628889367395919&amp;ev=PixelInitialized" /></noscript>
<?php endif;?>
<?if($registry['deviceType'] == 'tablet'):?>
    <style>
        .fb-like,.fb-share-button,.pp_overlay,.pp_pic_holder{
            zoom:120% !important;
        }
    </style>
<?endif;?>