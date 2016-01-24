<?defined('_JEXEC') or die('Restricted access');?>

<?if($registry['deviceType'] == 'computer' or $registry['deviceType'] == 'tablet'):?>
<div class="height"></div>

<div class="content" style="margin-top:40px;">

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
    <div class="search-title"><?if($_GET['text'] != "archive"):?><h2>ძიების შედეგი:</h2> <!--<h3>&laquo;<?=$_GET['text'];?>&raquo;</h3>--><?else:?><h2>არქივი</h2><?endif;?></div>
    <?if($_GET['text'] != "archive"):?>
    <!--<div class="search-num">ნაპოვნია: <?//=count($registry['search'])?></div>-->
    <?endif;?>
    <div class="search-posts">
        <ul>
            <?$i=0;foreach($registry['search'] as $item):$i++;
                $title_length = string_length($item['title']);
                if(!empty($item['title_short'])){
                    $short_length = string_length($item['title_short']);
                    $short_text = $item['title_short'];
                }else{
                    $short_length = string_length($item['text_short']);
                    $short_text = $item['text_short'];
                }
                $content_length = $title_length + $short_length;
                $short_length = 135 - $title_length;
                $this['slide'] = get_serialize($item['slide']);
                ?>
            <li data-last_id="<?=$item['id'];?>">
                <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/"><h3 style="<?if(count($this['slide']['img']) > 1):?>background-image:url('/<?=$theme?>images/main_icon.png');background-repeat:no-repeat;background-size:30px 30px;background-position:right 10px center;padding:10px 50px 7px 10px;<?elseif($item['style']==12):?>background-image:url('/<?=$theme?>images/vcam.png');background-repeat:no-repeat;background-size:30px 26px;background-position:right 10px center;padding:10px 50px 7px 10px;<?else:?>padding:10px 10px 7px 10px;<?endif;?>"><?=$item['name'];?></h3></a>
                <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=substr($item['thumbs'],2);?>" width="363" title="<?=$item['title'];?>" height="225"/></a>
                <br><br>
                <div class="search-post-title"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><?=title_filter($item['title'],60);?></a></div>
                <div class="search-post-short"><?=title_filter($short_text,$short_length);?></div>
                <table class="time-like-short">
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

            </li>
            <?endforeach;?>
        </ul>
    </div>
    <div class="fix"></div>
    <div id="preload_gif" align="center"></div>
</div>

<script>
    $(window).bind('scroll',function(){
        didScroll = true;
        var text = '<?=$registry['title'];?>';
        var last_id = $('.search-posts ul li:last-child').data('last_id');
        var count = $('.search-posts ul li').length;
        if($(window).scrollTop() + $(window).height() >= $(document).height() - $("#footer").height() - 150){
            var back = $(window).scrollTop() - 200;
            if (typeof flag != 'undefined' && flag) return;
            $.ajax({
                url:'/lib/ajax-admin.php',
                type:"POST",
                data:{last_id:last_id,txt:text,num:count,action:'load_search'},
                beforeSend:function(data){
                    $('#preload_gif').html('<img src="/img/245.GIF" />');
                },
                success:function(data){
                    if(last_id != data){
                        if(data == '0'){

                        }else{
                            $('.search-posts ul').append(data);
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
<?else:?>
    <div class="content">
   <h2>ძიების შედეგები</h2>
    <ul class="mobile-cat" style="margin-top:50px;">
        <?foreach($registry['search'] as $item):?>
            <li data-last_id="<?=$item['id'];?>">
                <ul>
                    <li><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><?=$item['title'];?></a><br><div class="sak-time"><span><?=gedate('l H:i',$item['date']);?> </span>  <span> <?=gedate('d.m.Y',$item['date']);?></span></div></li>
                    <li><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=substr($item['thumbs'],2);?>" width="100%" alt="<?=$item['title'];?>" title="<?=$item['title'];?>"></a></li>
                </ul>
            </li>
        <?endforeach;?>
    </ul>
    <script>
        $(window).bind('scroll',function(){
            didScroll = true;
            var text = '<?=$registry['title'];?>';
            var last_id = $('.mobile-cat > li:last-child').data('last_id');
            var count = $('.mobile-cat > li').length;

            if($(window).scrollTop() + $(window).height() == $(document).height()){
                var back = $(window).scrollTop() - 200;
                if (typeof flag != 'undefined' && flag) return;
                $.ajax({
                    url:'/lib/ajax-admin.php',
                    type:"POST",
                    data:{last_id:last_id,num:count,txt:text,action:'srcMobile'},
                    beforeSend:function(data){
                        $('#preload_gif').html('<img src="/img/245.GIF" />');
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