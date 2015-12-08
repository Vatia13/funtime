<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','vote','edit')):?>
	<?if (count($title)>0):?>
	<h2>Редактирование опроса</h2>

		<form method="post" action="index.php?component=votes"/>
		<input type="hidden" name="event" value="votes"/>
		<input type="hidden" name="update" value="1"/>
		<input type="hidden" name="id" value="<?=$title[0]['id']?>"/>

		<table class="formadd">
		<tr><td><span class="nb2">Заголовок опроса:</span></td><td>
		<input class="inputbox" type="text" name="name" value="<?=$title[0]['name']?>"/></td></tr>

		<?for($i=1;$i<=10;$i++):?>
			<tr><td><span class="nb2">Вопрос <?=$i?>:</span></td><td>
			<input type="hidden" name="id<?=$i?>" value="<?=$all[$i-1]['id']?>"/>
			<input class="inputbox" type="text" name="vote<?=$i?>" value="<?=$all[$i-1]['name']?>"/></td></tr>
		<?endfor;?>

		<tr><td><input type="submit" value="обновить"/></td></tr>
		</table></form>

	<?else:?>Вы пытаетесь редактировать не существующий опрос. Перейдите в раздел опросов.<?endif?>
<?endif?>
<p><a href="index.php?component=votes"><< Назад</a></p>