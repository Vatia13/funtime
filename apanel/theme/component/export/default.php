<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','tools','view')):?>

<h2>Экспорт в CSV</h2>

<div class="cat-sort"><form method="post" id="sort-form" action="?component=export&section=export">
<table class="formadd" id="sort-table">

<tr><td>Категория</td><td>
	<select name="tip" class="inputbox">
	<option value="0" <?if($registry['cat']==0):?>selected="selected"<?endif?>>все</option>
		<?foreach($registry['real_cat'] as $realcat):?>
			<?if($realcat['table']==1 and $realcat['section']==1):?><option value="<?=$realcat['id']?>" <?if($realcat['id']==$registry['cat']):?>selected="selected"<?endif?>><?=$realcat['name']?></option><?endif;?>
		<?endforeach;?>
	</select>
</td></tr>
</table>

<input type="submit" value="Экспорт"/>
</form>
</div>
<br/><br/>
<h2>Импорт из CSV</h2>

<div class="cat-sort"><form method="post" id="sort-form" action="?component=export&section=import"  enctype="multipart/form-data">
<table class="formadd" id="sort-table">

<tr><td>Укажите файл</td><td>
	<input type="file" name="file"/>	
</td></tr>
</table>
<input type="hidden" name="import" value="1"/>
<input type="submit" value="Импорт"/>
</form>
</div>
<?endif;?>
