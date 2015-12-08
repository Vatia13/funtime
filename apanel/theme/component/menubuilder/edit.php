<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','tools','edit')):?>

<?if(!empty($message[0])):?>
     <div class="<?=$message[0]?>_box">
	<?=$message[1]?>
     </div>
<?endif;?>
<?if($message[0]!='valid'):?>
<h2>Редактирование меню</h2>

<form method="post" action="" />
<input type="hidden" name="event" value="menubuilder"/>
<input type="hidden" name="edit" value="1"/>
<input type="hidden" name="id" value="<?=$registry['menu']['id']?>"/>
<span class="title-table">Основные настройки</span>
<table class="formadd">
<tr><td class="td1">Название меню</td><td><input class="inputbox" type="text" name="name" value="<?if(isset($_POST['name'])):?><?=$_POST['name']?><?else:?><?=$registry['menu']['name']?><?endif?>"/></td></tr>
<tr><td class="td1">Команда вызова <br/><i>например: menu1 </i></td><td><input class="inputbox" type="text" name="comand" value="<?if(isset($_POST['comand'])):?><?=$_POST['comand']?><?else:?><?=$registry['menu']['comand']?><?endif?>"/></td></tr>
</table>

<span class="title-table">Ссылки меню</span>
<table class="formadd" id="linktable">
<tr><td class="td1">Название ссылки</td><td>Ссылка (URL)</td><td>Позиция</td></tr>
<?foreach($registry['menulink'] as $item):?>
	<tr><td class="td1">
	<input type="hidden" name="item[<?=$item['id']?>][id]" value="<?=$item['id']?>"/>
	<input class="inputbox" type="text" name="item[<?=$item['id']?>][ankor]" value="<?=$item['ankor']?>"/></td>
	<td><input class="inputbox" type="text" name="item[<?=$item['id']?>][url]" value="<?=$item['url']?>"/></td>
	<td><input class="inputbox inputbox_60" type="text" name="item[<?=$item['id']?>][pos]" value="<?=$item['pos']?>"/></td></tr>
<?endforeach;?>
</table>

<div align="right"><a href="javascript://" onclick="addTableRow($('#linktable'));">Добавить поле</a></div>



<input type="hidden" value="<?=$item['pos']?>" id="countrow"/>
<a href="index.php?component=menubuilder"><< Назад</a>  <input type="submit" value="Сохранить" />
</form>

<p>* Для вставки меню в HTML шаблон сайта используйте команду: &lt;?php get_menu('name_menu'); ?&gt;</p>

<script type="text/javascript">
function addTableRow(jQtable){
	jQtable.each(function(){
		countrow = $("#countrow").val();
                countrow = parseInt(countrow) + 1;
		$("#countrow").val(countrow);

		var tds = '<tr>';
		i = 0;
		jQuery.each($('tr:last td', this), 
			function() {
				i = i + 1;
				if(i == 1) center = 'align="center"'; else center = '';
				if(i == 1) content = '<input class="inputbox" type="text" name="item[' + countrow + '][ankor]" value=""/>';
				if(i == 2) content = '<input class="inputbox" type="text" name="item[' + countrow + '][url]" value=""/>';
				if(i == 3) content = '<input class="inputbox inputbox_60" type="text" name="item[' + countrow + '][pos]" value="' + countrow + '"/>';
				tds += '<td '+center+'>'+content+'</td>';}
			);
		tds += '</tr>';
		if($('tbody', this).length > 0){$('tbody', this).append(tds);
		}else {$(this).append(tds);}
	});
}
</script>
<?endif;?>
<?endif;?>
