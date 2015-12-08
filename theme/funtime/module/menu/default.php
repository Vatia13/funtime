<?php defined('_JEXEC') or die(); ?>
<?if(count($registry['rubrics']) > 0):?>
<ul class="bottom-rubrics">
    <?foreach($registry['rubrics'] as $item):?>
    <li><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu']?>/"><?=$item['name']?></a></li>
    <?endforeach;?>
</ul>
    <div class="fix"></div>
<?endif;?>