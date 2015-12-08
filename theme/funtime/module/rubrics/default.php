<?php defined('_JEXEC') or die('Restricted access');?>
<div class="rubrics">
    <div style="display:none;position:fixed;width:280px;background-color:#27bfc4;height:50px;"><span style="color:#ff5704;font-weight:bold;position:relative;top:25px;left:40px;font-size:20px;">რუბრიკები</span>
    <a style="color:#7d84a6;font-size:27px;position:absolute;right:15px;top:25px;cursor:pointer;" onclick="showRubrics();">X</a></div>
    <ul>
        <?foreach($registry['rubrics'] as $item):?>
        <li><a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu']?>/"><?=$item['name']?></a></li>
        <?endforeach;?>
    </ul>
</div>