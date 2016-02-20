<?defined('_JEXEC') or die('Restricted access');?>
<div id="content">
    <?if($registry['posts'][0]['cat_id'] != 116):?>

    <?if($registry['deviceType'] == 'computer' or $registry['deviceType'] == 'tablet'):?>

        <div class="content">
            <!-- BANNER PLACE-->
            <div class="index-banner-place">
                <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
                    <?if(function_exists('get_banner')):?>
                        <?if(get_banner('F1',1) == true):?>
                            <?=get_banner('F1',1);?>
                        <?else:?>
                            <span>სარეკლამო ბანერი (800x100)</span>
                        <?endif;?>
                    <?endif;?>
                </div>
            </div>
            <!-- END BANNER PLACE-->
        <div class="category-title" data-id="<?=$registry['posts'][0]['cat_id'];?>"><h2><?=$registry['posts'][0]['name'];?></h2></div>
        <div class="category-post-list">
            <ul>
                <?foreach($registry['posts'] as $item):
                    $title_length = string_length($item['title']);
                    if(!empty($item['title_short'])){
                        $short_length = string_length($item['title_short']);
                        $short_text = $item['title_short'];
                    }else{
                        $short_length = string_length($item['text_short']);
                        $short_text = $item['text_short'];
                    }
                    $content_length = $title_length + $short_length;
                    $short_length = 165 - $title_length;
                    $this['slide'] = get_serialize($item['slide']);
                    ?>

                    <li data-last_id="<?=$item['id'];?>">
                        <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=substr($item['thumbs'],2);?>" width="558" alt="<?=$registry['posts'][0]['alt_search']?>"/>
                            <?if(count($this['slide']['img']) > 1):?><h3 style="background-image:url('/<?=$theme?>images/main_icon.png');background-repeat:no-repeat;background-position:right 10px center;padding:30px 50px 27px 10px;"></h3><?endif;?>
                            <?if($item['style'] == 12):?><h3 style="background-image:url('/<?=$theme?>images/vcam.png');background-repeat:no-repeat;background-position:right 10px center;padding:30px 50px 27px 10px;"></h3><?endif;?>
                        </a>
                        <div class="category-post-title"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><?=title_filter($item['title'],60);?></a></div>
                        <div class="category-post-short"><?=title_filter($short_text,$short_length);?></div>
                        <div class="category-post-time">
                            <table class="time-like">
                                <tr>
                                    <td><?=gedate('l H:i',$item['date']);?> | <?=gedate('d.m.Y',$item['date']);?></td>
                                    <td valign="center">
                                        <span>ავტორი:</span> <?=$item['realname'];?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><div class="fb-like" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/" data-width="80" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> <div class="fb-share-button" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/" data-layout="button_count"></div></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </li>
                <?endforeach;?>
            </ul>
        </div>
        <div class="fix"></div>
        <div id="preload_gif" align="center"></div>


        <script>
            $(window).bind('scroll',function(){
                didScroll = true;
                var cid = $('.category-title').data('id');
                var last_id = $('.category-post-list li:last-child').data('last_id');
                var count = $('.category-post-list ul li').length;
                if($(window).scrollTop() + $(window).height() >= $(document).height() - $("#footer").height() - 150){
                    var back = $(window).scrollTop() - 200;
                    if (typeof flag != 'undefined' && flag) return;
                    $.ajax({
                        url:'/lib/ajax-admin.php',
                        type:"POST",
                        data:{last_id:last_id,cid:cid,num:count,action:'load_cat'},
                        beforeSend:function(data){
                            $('#preload_gif').html('<img src="../img/245.GIF" />');
                        },
                        success:function(data){
                            if(last_id != data){
                                if(data == '0'){

                                }else{
                                    $('.category-post-list ul').append(data);
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
        </script>
        </div>
    <?else:?>
        <div class="content">
    <h2><?=$registry['posts'][0]['name'];?></h2>
    <ul class="mobile-cat" data-id="<?=$registry['posts'][0]['cat_id'];?>">
        <?foreach($registry['posts'] as $item):?>
            <li data-last_id="<?=$item['id'];?>">
                <ul>
                    <li><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><?=$item['title'];?></a><br><div class="sak-time"><span><?=gedate('l H:i',$item['date']);?> </span>  <span> <?=gedate('d.m.Y',$item['date']);?></span></div></li>
                    <li><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=substr($item['thumbs'],2);?>" width="100%" alt="<?=$item['alt_search'];?>" title="<?=$item['title'];?>"></a></li>
                </ul>
            </li>
        <?endforeach;?>
    </ul>
    <script>
        $(window).bind('scroll',function(){
            didScroll = true;
            var cid = $('.mobile-cat').data('id');
            var last_id = $('.mobile-cat > li:last-child').data('last_id');
            var count = $('.mobile-cat > li').length;

            if($(window).scrollTop() + $(window).height() == $(document).height()){
                var back = $(window).scrollTop() - 200;
                if (typeof flag != 'undefined' && flag) return;
                $.ajax({
                    url:'/lib/ajax-admin.php',
                    type:"POST",
                    data:{last_id:last_id,cid:cid,num:count,action:'catMobile'},
                    beforeSend:function(data){
                        $('#preload_gif').html('<img src="../img/245.GIF" />');
                    },
                    success:function(data){
                        if(last_id != data){
                            if(data == '0'){

                            }else{
                                $('.mobile-cat').append(data);
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
    </script>
            </div>
<?endif;?>
<?else:?>
    <div class="content">
    <?if($registry['deviceType'] == 'computer' or $registry['deviceType'] == 'tablet'):?>
        <div class="saknatuno-title" data-id="<?=$registry['posts'][0]['cat_id'];?>"><h2><?=$registry['posts'][0]['name'];?></h2></div>
        <div class="saknatuno-post-list">
            <ul>
                <?foreach($registry['posts'] as $item):?>
                    <li data-last_id="<?=$item['id'];?>">
                        <div class="saknatuno-image"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=substr($item['thumbs'],2);?>" width="215" align="left" alt="<?=$registry['posts'][0]['alt_search']?>"/></a></div>
                        <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><?=$item['title'];?></a>
                        <br>
                        <div class="saknatuno-time"><span><?=gedate('H:i',$item['date']);?> </span> / <span> <?=gedate('d.m.Y',$item['date']);?></span></div>
                        <div class="fix"></div>
                    </li>
                <?endforeach;?>
            </ul>
        </div>
        <div class="fix"></div>
        <div id="preload_gif" align="center"></div>
    <?else:?>
        <h2><?=$registry['posts'][0]['name'];?></h2>
        <ul class="mobile-cat">
            <?foreach($registry['posts'] as $item):?>
                <li data-last_id="<?=$item['id'];?>">
                    <ul>
                        <li><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><?=$item['title'];?></a><br><div class="sak-time"><span><?=gedate('l H:i',$item['date']);?> </span>  <span> <?=gedate('d.m.Y',$item['date']);?></span></div></li>
                        <li><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=substr($item['thumbs'],2);?>" width="100%" alt="<?=$item['alt_search'];?>" title="<?=$item['title'];?>"></a></li>
                    </ul>
                </li>
            <?endforeach;?>
        </ul>
        <script>
            $(window).bind('scroll',function(){
                didScroll = true;
                var cid = 116;
                var last_id = $('.mobile-cat > li:last-child').data('last_id');
                var count = $('.mobile-cat > li').length;

                if($(window).scrollTop() + $(window).height() == $(document).height()){
                    var back = $(window).scrollTop() - 200;
                    if (typeof flag != 'undefined' && flag) return;
                    $.ajax({
                        url:'/lib/ajax-admin.php',
                        type:"POST",
                        data:{last_id:last_id,cid:cid,num:count,action:'catMobile'},
                        beforeSend:function(data){
                            $('#preload_gif').html('<img src="../img/245.GIF" />');
                        },
                        success:function(data){
                            if(last_id != data){
                                if(data == '0'){

                                }else{
                                    $('.mobile-cat').append(data);
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
        </script>
        </div>
    <?endif;?>

    <?if($registry['deviceType'] == 'computer' or $registry['deviceType'] == 'tablet'):?>
        <script>
            $(window).bind('scroll',function(){
                didScroll = true;
                var cid = $('.saknatuno-title').data('id');
                var last_id = $('.saknatuno-post-list li:last-child').data('last_id');
                var count = $('.saknatuno-post-list ul li').length;
                if($(window).scrollTop() + $(window).height() >= $(document).height() - $("#footer").height() - 100){
                    var back = $(window).scrollTop() - 50;
                    if (typeof flag != 'undefined' && flag) return;
                    $.ajax({
                        url:'/lib/ajax-admin.php',
                        type:"POST",
                        data:{last_id:last_id,cid:cid,num:count,action:'load_sak'},
                        beforeSend:function(data){
                            $('#preload_gif').html('<img src="../img/245.GIF" />');
                        },
                        success:function(data){
                            if(last_id != data){
                                if(data == '0'){

                                }else{
                                    $('.saknatuno-post-list ul').append(data);
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
        </script>
    <?endif;?>
<?endif;?>
</div>