<?php defined('_JEXEC') or die('Restricted access');
$bImg = ($registry['last_test'][0]['type'] == 1) ? 'vik':'test';
?>
<div style="position:relative;">
<div class="front-test" style="background-image:url('/<?=$theme;?>images/<?=$bImg;?>.png');">
    <a href="/com/test/view/<?=$registry['last_test'][0]['id'];?>"></a>
    <div class="front-test-content">
        <a href="/com/test/view/<?=$registry['last_test'][0]['id'];?>">
            <img src="<?=$registry['last_test'][0]['img'];?>" height="115" align="left">
            <br><b><?=$registry['last_test'][0]['title'];?></b><br>
            <span><?=word_num($registry['last_test'][0]['lid'],20);?>...</span>
        </a>
        <div class="other-tests">
            <a href="/com/test/?type=<?=$registry['last_test'][0]['type'];?>">ყველა ტესტის ნახვა</a>
        </div>
    </div>
</div>
</div>