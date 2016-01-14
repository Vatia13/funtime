<?php defined('_JEXEC') or die('Restricted access'); ?>

<div class="fix"></div>

<?get_module('post-share');?> <!-- სოციალურ ქსელებზე გაზიარების მოდული -->

<!-- ფეისბუქ კომენტარები -->
<div class="fix"></div>
<?if($registry['post'][0]['moderate'] == 1):?>
    <div class="fb-comments" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
<?endif;?>
<!-- // -->
<div class="fix"></div>