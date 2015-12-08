<?defined('_JEXEC') or die('Restricted access');?>
<div class="menu-top5">Помощь</div>
<div class="menu-body5">
<p>
<h1>Все вопросы:</h1>
	<ul>
<?foreach($help as $ne):?>
	<li><a href="#help<?=$ne['id']?>" class="quote-link"><?=$ne['title']?></a></li>
<?endforeach;?>
	</ul>
</p>

<p>
<?foreach($help as $ne):?>

	<h2 id="help<?=$ne['id']?>" name="help<?=$ne['id']?>"><?=$ne['title']?></h2>

	<?=html_entity_decode($ne['text'])?>

<?endforeach;?>
</p>
</div>