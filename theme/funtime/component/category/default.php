<?defined('_JEXEC') or die('Restricted access');?>
  <div class="cnews fullnews">
	<div class="cnews-top"></div>
	<div class="cnews-bottom"></div>
	<div class="cnews-cont">
	<div class="title"><?=$title;?></div>
	<div class="text">
	<?foreach($catsall as $ne):?>
		<?if ($style==1): $style=0;$stw=''; else: $style=0;$stw='-grey'; endif?>
		<p>
		<a href="/doc/<?=$ne['cat_chpu']?>" class="news-text-doc"><?=$ne['name']?></a>
	        </p>
	<?endforeach;?>
<?if ($total>1) echo '<div class="navigation" align="center" style="margin-bottom:10px; margin-top:10px;">'
		.$pervpage.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right
		.$nextpage.'</div>';?>
	</div>
	</div>
  </div>
