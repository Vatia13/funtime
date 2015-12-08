<?defined('_JEXEC') or die('Restricted access');?>
<div id="contentLoads">
    <div class="five-article">

    </div>
    <div class="fix"></div>
</div>
<script>
    $(document).ready(function(){
        $('#LoadMore').click(function(){
            var theme = '<?=$theme;?>';
            //var cid = $('.category-title').data('id');
            var last_id = $('#contentLoads .five-article li:last-child').data('id');
            var num = $('#contentLoads .five-article ul li').length;
            if(typeof last_id === 'undefined'){
                last_id = 8;
            }
            if(num == 0){
                num = 8;
            }else{
                num = num + 8;
            }

                if (typeof flag != 'undefined' && flag) return;

                var back = $(window).scrollTop() - 110;
                $.ajax({
                    url:'/lib/ajax-admin.php',
                    type:"POST",
                    data:{last_id:last_id,num:num,action:'loadMore'},
                    beforeSend:function(data){
                        $('#LoadMore').html('<img src="../img/loadmore.gif" />');
                    },
                    success:function(data){
                        if(last_id != data){
                            if(data == '0'){

                            }else{
                                $('#contentLoads .five-article').append(data);
                                $('#LoadMore').html('<img src="' + theme + 'images/arrow_down.png" height="20" />');
                                $('html,body').animate({scrollTop:back}, 1200);
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

        });
    });
</script>
