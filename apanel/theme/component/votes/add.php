<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','vote','edit')):?>
	<h2>Добавление опроса</h2>

		<form method="post" action="index.php?component=votes"/>
		<input type="hidden" name="event" value="votes"/>
		<input type="hidden" name="add" value="1"/>

		<table class="formadd">
		<tr><td><span class="nb2">Заголовок опроса:</span></td><td>
		<input class="inputbox" type="text" name="name" value=""/></td></tr>

		<?for($i=1;$i<=10;$i++):?>
			<tr><td><span class="nb2">Вопрос <?=$i?>:</span></td><td>
			<input class="inputbox" type="text" name="vote<?=$i?>" value=""/></td></tr>
		<?endfor;?>

		<tr><td><input type="submit" value="Добавить"/></td></tr>
		</table></form>
<?endif?>
<p><a href="index.php?component=votes"><< Назад</a></p>