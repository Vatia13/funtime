$(function(){
    if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        if($(window).width() < 900){
        $("#style").attr('href','/theme/funtime/css/mobile.css');
        $("#container").css("margin","0px auto");
        var rubricsH = $(window).height();
        $('.rubrics').css('height',rubricsH+'px');
        $('.main-article').attr('style','');
        $('.main-article ul li').attr('style','');
        $('object').remove();
            $('.main-image h3').remove();
            $('.five-image h3').remove();
            $('.two-article-image h3').remove();
            $('.bottom-footer').hide();
        $('img').css({'max-width':$('.mobile-content').width()+'px','height':'auto','margin':'0px','padding':'0px'});
        $('.index-banner-place').remove();
        $('.index-vertical-banner').remove();
        $('.main-more').remove();
        $('.two-more').remove();
        $('.two-time').remove();
        $('.two-title').remove();
        $('img').attr('width','100%');
        $('.main-title').prependTo('.main-article ul li');
        $('.main-time').prependTo('.main-article ul li');
        $('.header').append('<input type="text" onkeypress="return makeGeo(this,event);" onkeyup="$(\'#search\').val(this.value)" name="text" value="" id="search_ex" placeholder="ძებნა"/>');
        $('.header').append('<a href="#" class="close-search">X</a>');
        $('.header-bg').remove();
        $('.close-search').click(function(){
            $(this).slideUp(200);
            $('#search_ex').slideUp(200);
            $('#search').val('');
        });
/*
        var imgH = $(".mobimg").height();
        $('.saknatuna ul li').css('min-height',imgH+'px');
        $('.five-article ul li').css('height',imgH+'px');
*/
        $(window).bind('scroll',function(){
            didScroll = true;
            var last_id = $('.five-article > ul > li.mob:last-child').data('last_id');
            var count = $('.five-article > ul > li.mob').length;

            if($(window).scrollTop() + $(window).height() == $(document).height()){
                var back = $(window).scrollTop() - 200;
                if (typeof flag != 'undefined' && flag) return;
                $.ajax({
                    url:'/lib/ajax-admin.php',
                    type:"POST",
                    data:{last_id:last_id,num:count,action:'LoadMobile'},
                    beforeSend:function(data){
                        $('#preload_gif').html('<img src="../img/245.GIF" />');
                    },
                    success:function(data){
                        if(last_id != data){
                            if(data == '0'){

                            }else{
                                $('.five-article > ul').append(data);
                                $('html,body').animate({scrollTop:back}, 'slow');
                                flag = false;
                            }
                        }
                    },
                    complete:function(data){
                        try{
                            FB.XFBML.parse();
                        }catch(ex){}
                        $('#preload_gif').html("");
                    }
                });
                flag = true;
            }
        });

        var playerh = $("#ytplayer").width() / 1.8;
        $("#ytplayer").height(playerh);
    }
    }
});