<?php defined('_JEXEC') or die('Restricted access'); ?>
<div class="saknatuna">
    <div class="saklink">
        <a href="/saknatuno-ambebi/"><img src="/<?=$theme?>/images/saknatuna.png" alt="<?=$registry['saknatuna'][0]['alt_search']?>"></a>
    </div>
    <ul>
        <?foreach($registry['saknatuna'] as $item):?>
        <li class="web"> 
           <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"> <img src="<?=substr($item['thumbs'],2);?>" width="100" alt="<?=$item['alt_search'];?>" title="<?=$item['title'];?>" align="left"> <?$str = get_serie($item['title']); $title = str_replace('('.$str.')','',$item['title']); echo $title; if(!empty($str)): echo '<br>('.$str.')'; endif;?> </a>
            <br><div class="two-time"><span><?=gedate('H:i',$item['date']);?> </span> / <span> <?=gedate('d.m.Y',$item['date']);?></span></div>
        </li>
        <li class="mob">
            <ul>
                <li><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/">
                        <?=$item['title'];?>
                    </a><br><div class="sak-time"><span><?=gedate('l H:i',$item['date']);?> </span>  <span> <?=gedate('d.m.Y',$item['date']);?></span></div></li><li><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=substr($item['thumbs'],2);?>" width="100%" alt="<?=$item['alt_search'];?>" title="<?=$item['title'];?>"></a></li>
            </ul>
        </li>
        <?endforeach;?>
    </ul>
</div>