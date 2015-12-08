<? defined('_JEXEC') or die('Restricted access'); ?>
<div class="test-result" align="center">
    <h3>თქვენ დააგროვეთ <span><?=$registry['myres'];?></span> ქულა </h3>
    <b>თქვენი შედეგია:</b>
    <br><br>
    <?=$registry['resultinfo'];?>
    <br><br>
    <a class="facebook-btn" href="http://www.facebook.com/sharer.php?u=http://funtime.ge/com/test/share/<?=$registry['test'][0]['id'];?>/<?=$registry['myres'];?>/<?=$registry['random'];?>"
       onclick="shareWindow('Facebook',this);return false;" ></a>

</div>

