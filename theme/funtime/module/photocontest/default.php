<?php
defined('_JEXEC') or die('Restricted access');

$registry['contest'] = getAllcache("SELECT id,gallery,date,updated_at FROM #__news_gallery_com WHERE news_id='".$registry['post'][0]['id']."'",300,'contest/'.$registry['post'][0]['id']);
$registry['out_of_date'] = 0;
if(count($registry['contest']) > 0):
$registry['contest_gallery'] = unserialize($registry['contest'][0]['gallery']);
    $cookies = array();

    if(count($registry['contest_gallery']) > 0){
        for($i=1;$i<=count($registry['contest_gallery']);$i++){
            if(!empty($_COOKIE['guestv_'.$registry['post'][0]['id'].'_'.$i])){
                $cookies[$i] = $_COOKIE['guestv_'.$registry['post'][0]['id'].'_'.$i];
            }
        }
    }

$registry['votes_i'] = $DB->getAll("SELECT uid,star FROM #__news_gallery_votes WHERE news_id='".$registry['post'][0]['id']."' and ip='".ip2long(getIP())."'");

    //if(count($registry['votes']) <= 0) {
        if(count($cookies) > 0){
        $registry['votes_c'] = $DB->getAll("SELECT uid,star FROM #__news_gallery_votes WHERE news_id='".$registry['post'][0]['id']."' and cookie IN (".join(',',$cookies).") ");
        }
    //}
    if(count($registry['votes_i']) > 0 and count($registry['votes_c']) > 0){
        $registry['votes'] = array_map("unserialize", array_unique(array_map("serialize",array_merge($registry['votes_i'],$registry['votes_c']))));
    }elseif(count($registry['votes_i']) > 0 and count($registry['votes_c']) <= 0){
        $registry['votes'] = $registry['votes_i'];
    }elseif(count($registry['votes_i']) <= 0 and count($registry['votes_c']) > 0){
        $registry['votes'] = $registry['votes_c'];
    }



    if(count($registry['votes']) > 0) {
        $votes = array();
        foreach ($registry['votes'] as $vote):
            $votes['user']['id'][] = $vote['uid'];
            $votes['user']['star'][$vote['uid']] = $vote['star'];
        endforeach;
    }
endif;
?>
<style>


    .read_top{
        display:table;
    }
    .read_top div {
        position:relative;
        display:table-cell;
    }
    .read_top div:nth-child(1){
        width:15%;
    }
    .read_top div:nth-child(1) h2{
        padding:15px 15px 13px 15px;
        background-color:#33337c;
        font-family:'BPGNinoMtavruliRegular';
        color:#FFF;
        font-size:20px;
    }

    .read_top div:nth-child(2){
        text-align:center;
        position:relative;
        width:60%;
        top:-8px;
        left:5%;
    }

    .read_top div:nth-child(3){
        float:right;
        top:-10px;
        color:#186d9e;
    }
    .contest_number{
        position:relative;
        color:#ff5704;
        font-family:'Tahoma';
        font-weight:bold;
        font-size:38px;
        width:40px;
        height:40px;
        padding:14px;
        display:inline-block;
        border:1px solid #ff5704;
        border-radius:100%;
        -moz-border-radius:100%;
        -webkit-border-radius:100%;
        text-align:center;
    }

    .contest_number b{
        position:relative;
        top:-3px;
    }
    .read_contest .contest_top{
        margin:20px 0;
    }
    .read_contest .contest_name{
        display:inline-block;
        background-color:#27bfc4;
        color:#FFF;
        font-family:'BPGIngiri2008Regular';
        margin-left:15px;
        padding:3px;
        top:-14px;
        position:relative;
        border:1px dashed #FFF;
        vertical-align:middle;
        box-shadow: 4px 2px 8px #888888;
    }
    .read_contest .contest_name div{
        border:1px dashed #FFF;
        padding:6px 20px;
    }



    .read_contest .contest_rate{
        border:2px solid #ff5704;
        float:right;
        border-radius:5px;
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        position:relative;
        height:68px;
        margin-right:5px;
    }
    .read_contest .contest_rate div{
        display:inline-block;
        position:relative;
    }
    .read_contest .no_star{
        background-color:#ff5704;
        font-family:"BPGNinoMtavruliRegular";
        color:#FFF;
        padding:20px 15px;
        border-radius:5px;
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        float:right;
        position:relative;
        margin-right:5px;
    }
    .read_contest .contest_rate .momeci{
        font-family:'BPGIngiri2008Regular';
        display:block;
    }
    .read_contest .contest_rate .contest_stars{
        width:200px;
        text-align:center;
        background-color:#ff5704;
        padding:4px 0 0 0;
        font-family:"BPGNinoMtavruliRegular";
        color:#FFF;

    }
    .contest_rate .contest_stars a{
        text-decoration:none;
    }

    .read_contest .contest_rate .contest_stars_num{
        color:#ff5704;
        font-weight:bold;
        vertical-align:middle;
        top:-25px;
        padding:0 10px;
        font-size:22px;
        font-family:"BPGNinoMtavruliRegular";
    }
    .star{
        cursor:pointer;
    }
    .contest_gallery{
        list-style:none;
        margin:0 0 20px 0;
        padding:0 0 30px 0;
        border-bottom:1px solid #27bfc4;
        max-width:1200px;
    }
    .contest_gallery li{
        position:relative;
    }
    .contest_gallery li.contest_img_small{
        float:left;
        width:31.2%;
        margin:0 3% 0 0;
    }
    .contest_gallery li.contest_img_medium{
        float:left;
        width:49%;
        height:400px;
        overflow:hidden;
        margin:0 2% 0 0;
    }
    .contest_gallery li.contest_img_large{
        width:100%;
        margin:0;
        text-align:center;
        height:650px;
        overflow:hidden;
    }

    .contest_gallery li.contest_img_small:nth-child(3n){
        margin:0;
    }
    .contest_gallery li.contest_img_medium:nth-child(2n){
        margin:0;
    }
    .fb_share_contest{
        position:absolute;
        background:url('/img/icons/fshare1.png') no-repeat;
        background-size:90px 40px;
        width:90px;
        height:40px;
        z-index:1;
        display:block;
        top:5px;
        right:5px;
        cursor:pointer;
    }

    .short-desc{

        line-height:1.6em;
        font-family:'BPGIngiri2008Regular';
        margin:0 10px;
    }


    @media screen and (max-width:600px){

        .pp_pic_holder.facebook { position:absolute;width: 96%!important; overflow: hidden; }
        div.facebook  .pp_content_container .pp_left { padding-left: 0!important; }
        div.facebook .pp_content_container .pp_right { padding-right: 0!important; }
        .pp_content { width: 100%!important; height: auto!important; }
        .pp_fade { width: 100%!important; height: 100%!important; }

        a.pp_expand, a.pp_contract, .pp_hoverContainer, .pp_gallery, .pp_top, .pp_bottom { display: none!important; }
        #pp_full_res img { width: 100%!important; height: auto!important; }
        .pp_details { width: 98%!important; padding-top: 10px; padding-bottom: 10px; background-color: #fff; margin-top: -2px!important; }
        a.pp_close { right: 10px!important; top: 10px!important; }
        div.facebook .ppt{
            width:90% !important;
            top:0 !important;
            left:0 !important;
        }
        div.facebook .pp_close{
            top:0 !important;
            right:0 !important;
        }
        .read_top{
            display:block;
        }
        .read_top .post-title{
            width:100%;
            margin-top:30px;
            left:0;
        }
        .read_top div{
            display:block;
        }
        .read_top div:nth-child(1) {
            text-align:center;
            width:100%;
        }
        .contest_top{
            display:inline-block;
        }
        .read_top .post-title h1{
            font-family:'BPGNinoMtavruliRegular';
            font-size:14px;
        }

        .contest_gallery li.contest_img_medium{
            float:left;
            width:49%;
            height:120px;
            overflow:hidden;
            margin:0 2% 0 0;
        }

        .contest_gallery li.contest_img_large{
            width:100%;
            margin:0;
            text-align:center;
            height:25%;
            overflow:hidden;
        }

        .contest_top .contest_number{
            margin-left:15px;
        }

        .read_contest .contest_rate{
            width:100%;
            margin:10px 5px 0 15px;
            float:none;
            height:48px;
        }
        .fb_share_contest{
            background-size:61px 24px;
            width:61px;
            height:24px;
        }
        .read_contest .contest_rate .contest_stars{
            width:70%;
            font-size:14px;
            display:inline-block;
        }
        .read_contest .contest_rate .contest_stars .momeci{
            display:inherit;
            font-family:'BPGNinoMtavruliRegular';
        }
        .read_contest .contest_rate .contest_stars_num{
            width:25%;
            padding:2px;
            text-align:center;
            top:-14px;
            display:inline-block;
        }
        .read_contest .contest_rate img{
            width:24px;
        }

        .index-banner-place{
            display:none;
        }
        .content{
            position:relative;
            width:100%;
            max-width:600px;
            margin:0 auto;
            background:#FFF;
            padding-bottom:400px;
            margin-bottom:200px;
        }
        .fb_share_contest {
            background: url('/img/icons/facebook.png') no-repeat;
            background-size:24px 24px;
            width:24px;
            height:24px;
        }



    }

</style>


<? if($registry['brand'] == 1) :?>
<div class="content">
    <!-- BANNER PLACE-->
    <div class="index-banner-place">
        <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
            <?if(function_exists('get_banner')):?>
                <?if(get_banner('F1',$registry['post'][0]['cat_id']) == true):?>
                    <?=get_banner('F1',$registry['post'][0]['cat_id']);?>
                <?else:?>
                    <object data="/img/F1_800x100.swf" type="application/x-shockwave-flash" width="800" height="100"><param name="wmode" value="opaque" /></object>
                <?endif;?>
            <?endif;?>
        </div>
    </div>
    <!-- END BANNER PLACE-->
    <?//=get_banner_place(0,'/img/F1_800x100.swf',800,100);?>
    <? else:?>

    <div class="content">
        <?endif;?>
        <?if(get_banner('ბრენდირება L',$registry['post'][0]['cat_id']) == true):?>
            <div class="brand_left">
                <?=get_banner('ბრენდირება L',$registry['post'][0]['cat_id']);?>
            </div>
        <?endif;?>
        <?if(get_banner('ბრენდირება R',$registry['post'][0]['cat_id']) == true):?>
            <div class="brand_right">
                <?=get_banner('ბრენდირება R',$registry['post'][0]['cat_id']);?>
            </div>
        <?endif;?>
    <div class="read_top">
        <div><h2>ფოტოკონკურსი</h2></div>
        <div class="post-title"><h1><?=$registry['post'][0]['title'];?></h1></div>
        <div class="post-time">
            <span><?=gedate('l',$registry['post'][0]['date']);?></span> <span><?=gedate('H:i',$registry['post'][0]['date']);?></span> <span><?=gedate('d.m.Y',$registry['post'][0]['date']);?></span>
        </div>
    </div>
        <div class="short-desc">
            <?if(!empty($registry['post'][0]['text_short'])):?>
                <?=$registry['post'][0]['text_short'];?>
            <?endif;?>
        </div>
    <div class="fix"></div>
    <div class="read_contest">
      <?php $i=0; foreach($registry['contest_gallery'] as $item): $i++;?>
          <?php if($i==4 && $registry['deviceType'] != 'phone'):?>
        </div>
</div>
<div class="fix"></div>

<div class="content">
    <!-- BANNER PLACE-->
    <div class="index-banner-place">
        <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
            <?if(function_exists('get_banner')):?>
                <?if(get_banner('F2',$registry['post'][0]['cat_id']) == true):?>
                    <?=get_banner('F2',$registry['post'][0]['cat_id']);?>
                <?else:?>
                    <object data="/img/F2_800x100.swf" type="application/x-shockwave-flash" width="800" height="100"><param name="wmode" value="opaque" /></object>
                <?endif;?>
            <?endif;?>
        </div>
    </div>

    <!-- END BANNER PLACE-->
    <div class="read_contest">
        <?endif;?>
        <?php if($i==7 && $registry['deviceType'] != 'phone'):?>
    </div>
</div>
<div class="fix"></div>

<div class="content">
    <!-- BANNER PLACE-->
    <div class="index-banner-place">
        <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
            <?if(function_exists('get_banner')):?>
                <?if(get_banner('F3',$registry['post'][0]['cat_id']) == true):?>
                    <?=get_banner('F3',$registry['post'][0]['cat_id']);?>
                <?else:?>
                    <object data="/img/F2_800x100.swf" type="application/x-shockwave-flash" width="800" height="100"><param name="wmode" value="opaque" /></object>
                <?endif;?>
            <?endif;?>
        </div>
    </div>

    <!-- END BANNER PLACE-->
    <div class="read_contest">
        <?endif;?>
        <div class="contest_top">
          <span class="contest_number"><b><?php echo $i;?></b></span>
          <div class="contest_name">
              <div>
              <?php
              $s = explode(' ',$item['name']);
              for($c=0;$c<count($s);$c++){
                echo $s[$c].' ';
                  if($c == 1){
                      echo "<br>";
                  }
              }
              ?>
             </div>
          </div>
            <?php $days = time() - $registry['post'][0]['date'];?>
            <?php if(get_country_code() == 'GE'):
                if(!in_array($i,$votes['user']['id'])): $hover_stars = 'hover_stars'; endif;
                if(!in_array($i,$votes['user']['id'])): $addStar = "onClick='addStar(this)'"; endif;
                $vote_star1 = ($votes['user']['star'][$i] > 0) ? 'star.png' : 'star1.png';
                $vote_star2 = ($votes['user']['star'][$i] > 1) ? 'star.png' : 'star1.png';
                $vote_star3 = ($votes['user']['star'][$i] > 2) ? 'star.png' : 'star1.png';

                $contest_out = "<div class='contest_rate contest_id_".$i."'>
    <div class='contest_stars  ".$hover_stars." '>";
                if(abs($days / (3600 * 24)) > 7):
                        $contest_out .= "<div style='padding:5px;'>მიმდინარე კვირის კონკურსი დასრულებულია</div>";
                        $registry['out_of_date'] = 1;
                else:
                    $contest_out .= "<span><span class='momeci'>მომეცი</span> სამი ვარსკვლავი</span>
        <div>
            <a ".$addStar." class='star' data-star='1' data-user='".$i."' data-id='".$registry['post'][0]['id']."'>
            <img src='/img/icons/".$vote_star1."' width='24' />
            </a>
            <a ".$addStar." class='star' data-star='2' data-user='".$i."' data-id='".$registry['post'][0]['id']."'>
            <img src='/img/icons/".$vote_star2."' width='24' />
            </a>
            <a ".$addStar." class='star' data-star='3' data-user='".$i."' data-id='".$registry['post'][0]['id']."'>
            <img src='/img/icons/".$vote_star3."' width='24' />
            </a>
        </div>";
                endif;
                $contest_out .="</div>
    <div class='contest_stars_num user_".$i."'>";
      if($registry['post'][0]['contest_rate'] <= 0 || abs($days / (3600 * 24)) > 7):
                $sum = $DB->getOne("SELECT SUM(star) FROM #__news_gallery_votes WHERE uid='".$i."' and news_id='".$registry['post'][0]['id']."'");
        $contest_out .= ($sum) ? $sum : 0;
     else:
          $contest_out .= 'ხმის მიცემა ფარულია';
     endif;
        $contest_out .="</div></div>";
            else:
                $contest_out .="<div class='no_star'>ვარსკვლავის მიცემა შესაძლებელია მხოლოდ საქართველოდან.</div>";
            endif;
            echo $contest_out;
            ?>
        </div>
        <div class="fix"></div>
        <div class="read_block">
            <ul class="contest_gallery" <?php if(count($item['img']) > 1):?>style="float:left;"<?php endif;?>>
                <?php if(count($item['img']) > 2):?>
                <?php for($a=0;$a<count($item['img']);$a++):?>
                    <li class="contest_img_small contest_person_<?=$i;?>">
                        <a target="_blank" class="fb_share_contest"   href="https://www.facebook.com/dialog/feed?app_id=1391061841189461&link=http://www.funtime.ge/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/&title=<?php echo str_replace(' ','+',$registry['post'][0]['title']);?>&picture=http://www.funtime.ge/img/uploads/news/fb/<?=date('Y-m',strtotime($registry['contest'][0]['updated_at']));?>/<?=last_par_url($item['img'][$a]);?>&description=<?=$item['name'];?>&redirect_uri=https://www.facebook.com/">
                        </a>
                        <a rel="prettyPhoto[contest_gallery]" data-star="<?=str_replace('ხმის მიცემა ფარულია','?',$contest_out);?>" data-facebook="https://www.facebook.com/dialog/feed?app_id=1391061841189461&link=http://www.funtime.ge/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/&title=<?php echo str_replace(' ','+',$registry['post'][0]['title']);?>&picture=http://www.funtime.ge/img/uploads/news/fb/<?=date('Y-m',strtotime($registry['contest'][0]['updated_at']));?>/<?=last_par_url($item['img'][$a]);?>&description=<?=$item['name'];?>&redirect_uri=https://www.facebook.com/" class="contest_img_small" href="<?php echo $item['img'][$a];?>"><img src="<?php echo $item['img'][$a];?>" width="100%" height="500" alt="<?=$i;?>. <?php echo $item['name'];//$item['img_name'][$a];?>"/></a>
                    </li>
                <?php endfor;?>
                <?elseif(count($item['img']) == 2):?>
                    <?php for($a=0;$a<count($item['img']);$a++):?>
                    <li class="contest_img_medium">
                        <a target="_blank" class="fb_share_contest" href="https://www.facebook.com/dialog/feed?app_id=1391061841189461&link=http://www.funtime.ge/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/&title=<?php echo str_replace(' ','+',$registry['post'][0]['title']);?>&picture=http://www.funtime.ge/img/uploads/news/fb/<?=date('Y-m',strtotime($registry['contest'][0]['updated_at']));?>/<?=last_par_url($item['img'][$a]);?>&description=<?=$item['name'];?>&redirect_uri=https://www.facebook.com/">
                        </a>
                        <a rel="prettyPhoto[contest_gallery]" data-star="<?=str_replace('ხმის მიცემა ფარულია','',$contest_out);?>" data-facebook="https://www.facebook.com/dialog/feed?app_id=1391061841189461&link=http://www.funtime.ge/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/&title=<?php echo str_replace(' ','+',$registry['post'][0]['title']);?>&picture=http://www.funtime.ge/img/uploads/news/fb/<?=date('Y-m',strtotime($registry['contest'][0]['updated_at']));?>/<?=last_par_url($item['img'][$a]);?>&description=<?=$item['name'];?>&redirect_uri=https://www.facebook.com/" class="contest_img_medium"  href="<?php echo $item['img'][$a];?>"><img src="<?php echo $item['img'][$a];?>" width="100%" alt="<?=$i;?>. <?php echo $item['name'];//$item['img_name'][$a];?>"/></a>
                    </li>
                    <?php endfor; ?>
                <?else:?>
                    <li class="contest_img_large">
                        <a target="_blank" class="fb_share_contest" href="https://www.facebook.com/dialog/feed?app_id=1391061841189461&link=http://www.funtime.ge/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/&title=<?php echo str_replace(' ','+',$registry['post'][0]['title']);?>&picture=http://www.funtime.ge/img/uploads/news/fb/<?=date('Y-m',strtotime($registry['contest'][0]['updated_at']));?>/<?=last_par_url($item['img'][$a]);?>&description=<?=$item['name'];?>&redirect_uri=https://www.facebook.com/">
                        </a>
                        <a rel="prettyPhoto[contest_gallery]" data-star="<?=$contest_out;?>" data-facebook="https://www.facebook.com/dialog/feed?app_id=1391061841189461&link=http://www.funtime.ge/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/&title=<?php echo str_replace(' ','+',$registry['post'][0]['title']);?>&picture=http://www.funtime.ge/img/uploads/news/fb/<?=date('Y-m',strtotime($registry['contest'][0]['updated_at']));?>/<?=last_par_url($item['img'][$a]);?>&description=<?=$item['name'];?>&redirect_uri=https://www.facebook.com/" class="contest_img_large" href="<?php echo $item['img'][0];?>"><img src="<?php echo $item['img'][0];?>" width="100%" alt="<?=$i;?>. <?php echo $item['name'];//$item['img_name'][$a];?>"/></a>
                    </li>
                <?endif;?>

            </ul>

        </div>
      <?php $contest_out = '';
      endforeach;?>
    </div>
</div>
<div class="fix"></div>
<script>
    $(document).ready(function(){
        $('.hover_stars').hover(function(){
            var contest = this;
            $('a',this).hover(function(){
                var num = $(this).index() + 1;
                for(var i = 1; i<=num; i++){
                    $('a:nth-child('+i+') img',contest).attr("src","/img/icons/star.png");
                }
            },function(){
                for(var i = 0; i<=4; i++){
                    $('a:nth-child('+i+') img',contest).attr("src","/img/icons/star1.png");
                }
            });
        });
    });


    function addStar(event){
        var star = $(event).data("star");
        var user = $(event).data("user");
        var id = $(event).data("id");
        var hidden = '<?php echo $registry['post'][0]['contest_rate'];?>';
        var num = 0;
        if(star > 0 && user > 0 && id > 0){
            $.ajax({
                url:'/lib/ajax-admin.php',
                type:'POST',
                data:{star:star,user:user,id:id,action:'addStar',ref:'<?=$_SERVER['HTTP_REFERER'];?>'},
                success:function(request){

                        var sumNum = document.getElementsByClassName('user_'+user);
                        num = sumNum[0].innerText;
                        var sum = parseInt(request) + parseInt(num);
                    if(hidden <= 0){
                        $('.user_'+user).html(sum);
                    }
                        var user_html = (hidden <= 0) ? $('.contest_id_'+user+'').html() : $('.contest_id_'+user+'').html().replace('ხმის მიცემა ფარულია','?');

                        for(var i = 1; i<=request; i++){
                            $('.contest_id_'+user+' a:nth-child('+i+')').replaceWith('<img src="/img/icons/star.png" width="24" />');
                            var d = "<div class='contest_rate contest_id_"+user+"'>"+user_html+"</div>";
                            $('.read_block .contest_person_'+user+'').find('a:nth-child(2)').attr('data-star',d);
                        }
                        if(request < 3){
                            for(var i = request; i<=3; i++){
                                $('.contest_id_'+user+' a:nth-child('+i+')').replaceWith('<img src="/img/icons/star1.png" width="24" />');
                            }
                        }
                }
            });
        }
    }



</script>

