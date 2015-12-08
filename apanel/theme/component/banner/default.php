<?php defined('_JEXEC') or die('Restricted access'); ?>
<?if(get_access('admin','banners','view')):?>
<?if($registry['last_banners_count'] > 0):?>
    <div class="info_box">ყურადღება! 15 დღის შიგნით თავისუფლდება <?=$registry['last_banners_count'];?> საბანერო ადგილი</div>
    <div align="center">
        <button class="btn show_banners">მაჩვენე ბანერები რომლებიც თავისუფლდება 15 დღის შიგნით</button>
        <button class="btn hide_banners" style="display:none;">დამალე ბანერები</button>
    </div>
    <br>
    <div class="last_banners" style="display:none;"></div>
    <br><br>
<?endif;?>
<h3><?php if($_GET['cat'] > 0):?>ბანერები - <?php echo ($_GET['cat']==1) ? 'პირველი გვერდი' : (($_GET['cat']==2) ? 'ტესტი' : (($registry['banners'][0]['name']) ? $registry['banners'][0]['name'] : $DB->getOne("SELECT name FROM #__category WHERE id='".intval($_GET['cat'])."'")));?><?else:?>ბანერების ადმინისტრატორი<?endif;?></h3>
<?php if($_GET['cat'] > 0):?>
<a href="/apanel/index.php?component=banner&section=add&cat=<?=$_GET['cat'];?>" class="btn-green left">+ ბანერის გაყიდვა</a> <a href="/apanel/index.php?component=banner&section=addplace&cat=<?=$_GET['cat'];?>" class="btn-blue right">+ საბანერო ადგილების დამატება</a> <div style="clear:both;"></div><br>
<?else:?>
    <a href="/apanel/index.php?component=banner&section=add" class="btn-green left">+ ბანერის გაყიდვა</a> <a href="/apanel/index.php?component=banner&section=addplace&cat=<?=$_GET['cat'];?>" class="btn-blue right">+ საბანერო ადგილების დამატება</a> <div style="clear:both;"></div><br>
<?endif;?>
<?if(isset($_GET['message'])):?>
    <?if(count($_GET['message']) > 0):?>
        <?for($i=0;$i<count($_GET['message']);$i++):?>
            <? $message[$i] = $_GET['message'][$i]; ?>
        <?endfor;?>
    <?endif;?>
<?endif;?>
<?if(!empty($message[0])):?>
    <div class="<?=$message[0]?>_box">
        <?for($i=1;$i<=count($message);$i++):?>
            <?=$message[$i]?>
        <?endfor;?>
    </div>
<?endif;?>
<?php if($_GET['ban'] == 'all'):?>
    <?include_once('.inside.php');?>
<?else:?>
    <?include_once('.front.php');?>
<?endif;?>
<script>
    jQuery(document).ready(function($){
        $('.show_banners').click(function(){
            $.ajax({
                url:'/apanel/index.php?component=banner&section=ajax',
                type:'POST',
                data:{action:'last_banners'},
                success:function(data){
                    $('.show_banners').hide();
                    $('.hide_banners').show();
                    if(data == 0){
                        $('.last_banners').html('<font color="red">ჯერჯერობით არცერთ ბანერს არ ეწურება ვადა.</font>').show();
                    }else{
                        $('.last_banners').html(data).slideDown(400);
                    }

                }
            });
        });
        $('.hide_banners').click(function(){
            if($('.last_banners').is(':hidden')){
                $('.hide_banners').html('დამალე ბანერები');
            }else{
                $('.hide_banners').html('მაჩვენე ბანერები რომლებიც თავისუფლდება 15 დღის შიგნით');
            }
            $('.last_banners').slideToggle(400);

        });
    });
</script>
<?endif;?>
