<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','tools','view')):?>
<h2>Рекламные блоки на сайте</h2>
<?if (count($all)>0):?>
<div class="message"><?=$message?></div>
	<table class="tablelinks">
	 <tr><td width="20" class="row"><b>id</b></td>
		<td width="200" class="row">Анкор</td>
		<td width="50" class="row">noindex</td>
		<td width="50" class="row">nofollow</td>
		<td width="50" class="row">Блок</td>
		<td width="50" class="row">Тип</td>
		<td width="50" class="row">Показывать</td>
	<?foreach($all as $num):?>
	 <tr><td class="column"><?=$num['id']?></td>
	<td>
	<?if($num['type']==1) echo $num['ankor'];?>
	<?if($num['type']==2):
	$size = @GetImageSize($num['photo']);
	if($size[0]>200)
		$w=100;
		else 
		{
		$w='';
		if($size[1]>100)$h=100; else $h='';
		}
	?>
	<img src="<?=$num['photo']?>" width="<?=$w?>" height="<?=$h?>"/>
	<?endif;?>
	<?if($num['type']==3):?>HTML code<?endif;?>
	</td>
	<td align="center">
		<?if($num['noindex']==1):?>
			<img src="images/check.png" width="16" height="16" border="0" alt="edit" title="Да"/>
		<?else:?>
			<img src="images/minus.png" width="16" height="16" border="0" alt="edit" title="Нет"/>
		<?endif;?>
	</td><td align="center">
       		<?if($num['nofollow']==1):?>
			<img src="images/check.png" width="16" height="16" border="0" alt="edit" title="Да"/>
		<?else:?>
			<img src="images/minus.png" width="16" height="16" border="0" alt="edit" title="Нет"/>
		<?endif;?>
	</td>
	<td align="center">
		<?if($num['block']==1):?>Реклама на главной внизу<?endif;?>
		<?if($num['block']==2):?>Реклама в объявлениях<?endif;?>
		<?if($num['block']==3):?>Реклама в статьях<?endif;?>
		<?if($num['block']==3):?>Реклама в сайдбаре<?endif;?>
	</td>
	<td align="center">
		<?if($num['type']==1):?>Ссылка<?endif;?>
		<?if($num['type']==2):?>Баннер<?endif;?>
		<?if($num['type']==3):?>Произвольный HTML код<?endif;?>
	</td>
	<td align="center">
       		<?if($num['show']==1):?>
			<img src="images/check.png" width="16" height="16" border="0" alt="edit" title="Да"/>
		<?else:?>
			<img src="images/minus.png" width="16" height="16" border="0" alt="edit" title="Нет"/>
		<?endif;?>
	</td>
	<td>
	<a href="?component=links&section=edit&id=<?=$num['id']?>"><img src="images/edit.png" width="16" height="16" border="0" alt="edit" title="редактировать"/></a> 
	<a href="javascript://" onclick="if (!confirm('Вы подтверждаете удаление?')) return false; else location.href='?component=links&delete=<?=$num['id']?>'"><img src="images/cross.png" width="16" height="16" border="0" alt="del" title="удалить"/></a>
	</td>
	 </tr>
	<?endforeach;?>
	</table>
<?else:?>Отсутствуют<?endif;?>
<style>
#t4,#t44,#t3,#t33 {display:none;}
</style>
	<script type="text/javascript">
	  function showOption(el)
	  {
		disState = el.options[el.selectedIndex].value;
			if(disState == '1') {OpenOpen('t1');OpenOpen('t11');OpenOpen('t2');OpenOpen('t22');CloseClose('t3');CloseClose('t33');CloseClose('t4');CloseClose('t44');}
			if(disState == '3') {OpenOpen('t3');OpenOpen('t33');CloseClose('t1');CloseClose('t11');CloseClose('t2');CloseClose('t22');CloseClose('t4');CloseClose('t44');CloseClose('t5');CloseClose('t55');CloseClose('t6');CloseClose('t66');}
			if(disState == '2') {OpenOpen('t4');OpenOpen('t44');OpenOpen('t2');OpenOpen('t22');CloseClose('t1');CloseClose('t11');CloseClose('t3');CloseClose('t33');}
	  }
	</script>
<p>&nbsp;</p>
<h2>Добавить</h2>
<form method="post" action="" enctype="multipart/form-data"/>
<input type="hidden" name="event" value="links"/>
<input type="hidden" name="add" value="1"/>
<table class="formadd">
<tr><td class="td1">Тип блока</td><td>
	<select name="linktype" onchange="showOption(this)" class="inputbox">
		<option value="1">Ссылка</option>
		<option value="2">Баннер</option>
		<option value="3">Произвольный HTML код</option>
	</select>
	</td></tr>
<tr><td class="td1">Расположение</td><td>
	<select name="block" class="inputbox">
		<option value="1">Реклама на главной внизу</option>
		<option value="2">Реклама в объявлениях</option>
		<option value="3">Реклама в статьях</option>
		<option value="4">Реклама в сайдбаре</option>
	</select>
	</td></tr>
<tr><td class="td1"><div id="t4">Изображение</div></td><td><div id="t44"><input class="inputbox" type="file" style="width:170px;" name="photo"/></div></td></tr>

<tr><td class="td1"><div id="t1">Текст ссылки<br/> <i>(пример: www.sitename.ru)</i></div></td><td><div id="t11"><input class="inputbox" type="text" style="width:170px;" name="ankor" value=""/></div></td></tr>
<tr><td class="td1"><div id="t2">Ссылка<br/> <i>(пример: http://sitename.ru)</i></div></td><td><div id="t22"><input class="inputbox" type="text" style="width:170px;" name="url" value=""/></div></td></tr>

<tr><td class="td1"><div id="t3">HTML код</div></td><td><div id="t33"><textarea name="html" style="width:300px;height:100px;"></textarea></div></td></tr>

<tr><td class="td1"><div id="t5">noindex</div></td><td><div id="t55"><input type="checkbox" name="noindex" value="1" checked/></div></td></tr>
<tr><td class="td1"><div id="t6">nofollow</td><td><div id="t66"><input type="checkbox" name="nofollow" value="1" checked/></div></td></tr>
<tr><td class="td1">Показывать</td><td><input type="checkbox" name="show" value="1" checked/></td></tr>

<tr><td><input type="submit" value="добавить" /></td></tr>
</table></form>

<?endif;?>
