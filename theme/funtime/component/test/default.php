<? defined('_JEXEC') or die('Restricted access'); ?>
<div id="content">
    <div class="content">
    <h2 class="test-h2"><?if($_GET['type'] == 1):?>ვიქტორინა<?else:?>ტესტი<?endif;?></h2>
<?if(count($registry['tests']) > 0):?>
    <div class="test-list">
        <ul>
            <?foreach($registry['tests'] as $item):?>
            <li data-last_id="<?=$item['id'];?>"><a href="/com/test/view/<?=$item['id'];?>"><img src="<?=$item['img'];?>" align="left" height="130"><?=$item['title'];?><br><br><span><?=$item['lid'];?></span></a></li>
            <?endforeach;?>
        </ul>
        <div class="fix"></div>
        <div id="preload_gif" align="center"></div>
    </div>
<?else:?>
<div class="info_box">ამჟამად ყველა ტესტი გამორთულია</div>
<?endif;?>
    </div>
</div>

<script>
    $(window).bind('scroll',function(){
        didScroll = true;
        var last_id = $('.test-list ul li:last-child').data('last_id');
        var count = $('.test-list ul li').length;
        var tp = '<?=$_GET['type'];?>';
        if($(window).scrollTop() + $(window).height() >= $(document).height() - $("#footer").height() - 150){
            var back = $(window).scrollTop() - 200;
            if (typeof flag != 'undefined' && flag) return;
            $.ajax({
                url:'/lib/ajax-admin.php',
                type:"POST",
                data:{last_id:last_id,tp:tp,num:count,action:'load_test'},
                beforeSend:function(data){
                    $('#preload_gif').html('<img src="/img/245.GIF" />');
                },
                success:function(data){
                    if(last_id != data){
                        if(data == '0'){

                        }else{
                            $('.test-list ul').append(data);
                            $('html,body').animate({scrollTop:back}, 'slow');
                            flag = false;
                        }
                    }
                },
                complete:function(data){
                    $('#preload_gif').html("");
                }
            });
            flag = true;
        }
    });
</script>