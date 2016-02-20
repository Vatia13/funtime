<div style="background-color:#FFF;" class="bottom-footer">
<div id="footer" style="height:111px;">
    <?if(!$_GET):?>
    <div id="LoadMore" class="load_more">
        <img src="<?=$theme;?>images/arrow_down.png" height="20"/>
    </div>
    <?endif;?>
    <div class="footer">
        <table>
            <tr>
                <td valign="top">
                    <ul class="mmenu">
                        <li><a href="/">მთავარი</a></li>
                        <li><a href="/com/search/?text=archive">არქივი</a></li>
                        <li><a href="/com/contacts">კონტაქტი</a></li>
                    </ul>
                    <div class="fix"></div>
                    <br>
                    <a href="https://www.facebook.com/pages/FunTime/852950968060770?fref=ts" target="_blank" class="footer-fb">
                    </a>
                    <div class="fix"></div>
                    <br>
                    <!-- TOP.GE COUNTER CODE -->
                    <script language="JavaScript" type="text/javascript" src="http://counter.top.ge/cgi-bin/cod?100+98094"></script>
                    <noscript>
                        <a target="_top" href="http://counter.top.ge/cgi-bin/showtop?98094">
                            <img src="http://counter.top.ge/cgi-bin/count?ID:98094+JS:false" border="0" alt="TOP.GE" /></a>
                    </noscript>
                    <!-- / END OF COUNTER CODE -->
                    <!-- MMI CMeter -->
                    <noscript>
                        <img
                            src="http://gejuke.mmi.bemobile.ua/bug/pic.gif?siteid=funtime.ge"
                            alt=""
                            />
                    </noscript>
                    <script language="javascript">
                        var tns_already, tnscm_adn = tnscm_adn || [];
                        (function(c,m){if(c.indexOf&&c.indexOf(m)<0){c.unshift(m);}}(tnscm_adn,"inline_cm"));
                        if ("undefined"==typeof(tns_already) || null==tns_already || 0==tns_already)
                        {
                            tns_already=1;
                            var i=new Image();
                            i.src="http://gejuke.mmi.bemobile.ua/bug/pic.gif?siteid=funtime.ge&j=1&nocache="+Math.random();

                            (function(){
                                var p=document.getElementsByTagName('head')[0];
                                var s=document.createElement("script");
                                s.type="text/javascript";
                                s.src="http://gesource.mmi.bemobile.ua/cm/cm.js";
                                s.async = true;
                                p.appendChild(s);
                            })();
                        };
                    </script>
                    <!-- /MMI CMeter -->
                </td>
                <td colspan="2">
                    <?get_module('menu');?>
                </td>
                <td valign="top">
                    <a href="http://it-solutions.ge" class="powered left" target="_blank"></a>
                </td>
            </tr>
        </table>




        <a href="/" class="footer-logo">
            <br>
            <span>&copy; All Rights Reserved.</span>
        </a>

    </div>
</div></div>
</div>
<script language="JavaScript" type="text/javascript" src="/<?=$theme?>js/mobile.js?ver=<?=rand(0,9999999);?>"  async></script>
<script>
    $(document).ready(function(){
        $('.bottom-footer').height($('.bottom-rubrics').height() + 50);
    });

</script>
<?if(function_exists('get_banner')):?>
    <?if(get_banner('FM',(isset($registry['post'][0]['cat_id'])) ? $registry['post'][0]['cat_id'] : 1) == true):?>
        <?if($registry['deviceType'] == 'phone'):?>
            <div id="banner_bg" style="position:fixed;left:0;top:0;background-color:#FFF;width:100%;height:100%;z-index:999;">
                <div class="banner-place" id="mobile-banner" style="position:relative;width:90%;margin:5px auto;text-align:center;display:block;">
                    <?=get_banner('FM',(isset($registry['post'][0]['cat_id'])) ? $registry['post'][0]['cat_id'] : 1);?>
                </div>
                <div id="bannerTime" style="font-size:22px;color:red;position:absolute;bottom:5%;text-align:center;width:100%;font-family:'BPGNinoMediumCapsRegular'">
                    რეკლამა გაითიშება <span>3</span> წამში
                </div>
            </div>
            <script>
                $(document).ready(function(){
                    console.log(window.innerHeight);
                    var bannerHeight = window.innerHeight - window.innerHeight / 100;

                    $('.banner-place').css('height',bannerHeight+'px');
                    $('#mobile-banner').find('img').css({'height':bannerHeight+'px','width':'auto'});
                    var sec = 3;
                    var interval = setInterval(function(){
                        $("#bannerTime span").text(sec);
                        if(sec <= 0){
                            $("#banner_bg").remove();
                            clearInterval(interval);
                        }
                        sec--;
                    },1000);
                });
            </script>
        <?endif;?>
    <?endif;?>
<?endif;?>
<script>
    var trackOutboundLink = function(url) {
        ga('send', 'event', 'outbound', 'click', url, {
            'transport': 'beacon',
            'hitCallback': function(){document.location = url;}
        });
    }
</script>
</body>
</html>