<?defined('_JEXEC') or die('Restricted access');?>
<br>
<div class="fb-like" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
<?if($registry['post'][0]['sponsored'] == '1'):?><img src="/img/sponsored.png" width="30" height="30" style="position:relative;float:right;bottom:25px;"/><?endif;?>
<br><br>