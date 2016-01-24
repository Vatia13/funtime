  <?php defined('_JEXEC') or die('Restricted access'); ?>
<script>
	function print_page(){
		window.print();
		}
</script>
<div class="fix"></div>
    <?if($registry['deviceType'] == 'computer' or $registry['deviceType'] == 'tablet'):?>
    	<span style="cursor:pointer"><div onClick="print_page();"><strong style="color:#ff5704; font-family: 'BPGNinoMediumCapsRegular'; position: relative; bottom: 10px;">სტატიის ამობეჭდვა</strong>&nbsp;&nbsp;<img style="cursor:pointer;" src="/<?=$theme?>/images/print.png" width="32"></div></span>
    <?endif;?> 
<?get_module('post-share');?> <!-- სოციალურ ქსელებზე გაზიარების მოდული -->

<!-- ფეისბუქ კომენტარები -->
<div class="fix"></div>
<?if($registry['post'][0]['moderate'] == 1):?>
    <div class="fb-comments" data-href="http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
<?endif;?>
<!-- // -->
<div class="fix"></div> 