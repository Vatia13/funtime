<?defined('_JEXEC') or die('Restricted access');?>
<div class="test-rubric">
    <ul class="test-rubric-title">
        <li>&nbsp;</li>
        <li>საცდელი რუბრიკა</li>
        <li>&nbsp;</li>
    </ul>
</div>
<div class="fix"></div>
<div class="test-rubrics">
    <ul>
        <?foreach($registry['test-rubrics'] as $item):?>
        <li>
            <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/"><div class="test-rubric-name"><?=$item['name']?></div></a>
            <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><img src="<?=substr($item['thumbs'],2);?>" width="350px" height="248"></a>
            <br><br>
            <div class="test-rubric-time"><span><?=gedate('l H:i',$item['date']);?></span> | <span><?=gedate('d.m.Y',$item['date']);?></span></div>
            <br>
            <a href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$item['cat_chpu'];?>/<?=$item['chpu'];?>/"><span><?=title_filter($item['title'],100);?></span></a>
        </li>
        <?endforeach;?>
    </ul>
</div>
<div class="fix"></div>