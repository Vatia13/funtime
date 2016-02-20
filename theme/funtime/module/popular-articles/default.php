<?php defined('_JEXEC') or die('Restricted access');?>
<?if(count($registry['popular']) > 0):?>
<div class="popular-articles">
    <h3>კვირის პოპულარული რუბრიკები</h3>
    <ul>
        <?foreach($registry['popular'] as $item):?>
            <li>
                <div class="popular-articles-img">
<a href="/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=substr($item['thumbs'],2)?>" width="269" alt="<?=$registry['popular'][0]['alt_search']?>"></a>
                </div>
                <div class="popular-articles-title">
                    <a href="/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><?=$item['title'];?></a>
                </div>
            </li>
        <?endforeach;?>
    </ul>
    <div class="fix"></div>
</div>
<?endif;?>