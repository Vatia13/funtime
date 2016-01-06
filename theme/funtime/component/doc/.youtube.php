<?php defined('_JEXEC') or die('Restricted access'); ?>
<?if(!empty($registry['post'][0]['youtube']) && $registry['post'][0]['style'] != 12):?>
<br><br>
<iframe id="ytplayer" type="text/html" width="1130" height="670" src="https://www.youtube.com/embed/<?=$registry['post'][0]['youtube'];?>?theme=light" frameborder="0" allowfullscreen></iframe>
<?endif;?>
