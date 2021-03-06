<?defined('_JEXEC') or die('Restricted access');?>
<div class="five-article">
    <ul>
        <?foreach($registry['five-article'] as $item):
            $this['slide'] = get_serialize($item['slide']);
            ?>
        <?if($registry['deviceType'] == 'computer' or $registry['deviceType'] == 'tablet'):?>
        <li class="web">
            <div class="five-rubric">
                <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/"><?=$item['name'];?></a><br>
                <div class="five-time"><?=gedate('d.m.Y',$item['date']);?></div>
                <br><br>
                <div class="fb-like" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
            </div>
            <div class="five-title">
                <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/">
				
					<?=$item['title'];?>
                
                </a><br>
                <br>
                <? 
				if(strlen($item['text_short'])>160){ echo mb_substr(strip_tags($item['text_short']),0,160,"utf-8")." ..."; }
				else{ echo strip_tags($item['text_short']); } 
                 ?>
				
                <div class="fix"></div>

            </div>
            <div class="five-image">
            <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/"><h3 style="<?if(count($this['slide']['img']) > 1):?>background-image:url('/<?=$theme?>images/main_icon.png');background-repeat:no-repeat;background-size:30px 30px;background-position:right 10px center;padding:10px 50px 7px 10px;<?elseif($item['style']==12):?>background-image:url('/<?=$theme?>images/vcam.png');background-repeat:no-repeat;background-size:30px 26px;background-position:right 10px center;padding:10px 50px 7px 10px;<?else:?>padding:10px 10px 7px 10px;<?endif;?>"><?=$item['name'];?></h3></a>
 <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=substr($item['thumbs'],2)?>" width="400" alt="<?=$registry['five-article'][0]['alt_search']?>"></a>
            </div>
        </li>
        <?else:?>
        <li class="mob"  data-last_id="<?=$item['id'];?>">
            <ul>
                <li><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><?=$item['title'];?></a><div class="five-time"><span><?=gedate('l H:i',$item['date']);?> </span> <span> <?=gedate('d.m.Y',$item['date']);?></span></div></li>
                <li><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=substr($item['thumbs'],2)?>" width="100%" alt="<?=$registry['five-article'][0]['alt_search']?>"></a></li>
            </ul>
        </li>
        <?endif;?>
        <?endforeach;?>
    </ul>
</div>
<div class="fix"></div>