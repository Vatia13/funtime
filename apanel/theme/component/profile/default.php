<?defined('_JEXEC') or die('Restricted access');?>
<?if ($user->get_property('userID')==1 OR $user->get_property('gid')>=25):?>
<div class="message"><?=$message;?></div>
<h1>Анкета пользователя</h1>

<h3>Предпросмотр анкеты</h3>
<div class="profile-pre">
  <form action="" method="post">
	 <table>
	 <tr><td width="25"><b>№</b></td><td width="250"><b>Название</b></td><td><b>Тип</b></td><td><b>Действия</b></td></tr>
	 <?$i=0;foreach ($name as $n):?>
	 <tr><td><?=$num[$i]?></td><td width="250"><?=$n?>:</td><td><?=$form[$i]?></td>
		<td align="center">
			<a href="?component=profile&section=edit&edit=<?=$idd[$i]?>"><img src="images/edit.png" width="16" height="16" border="0" alt="edit" title="редактировать"/></a>
			<a href="?component=profile&delete=<?=$idd[$i]?>"><img src="images/cross.png" width="16" height="16" border="0" alt="del" title="удалить"/></a>
		</td></tr>
	 <?$i++;endforeach;?>
	 </table>
  </form>
  <p align="center"><b>Внимания!</b> При удалении поля, так же удаляются все записи пользователей соответствующие удаляемому полю.</p><p></p>
</div>

<h3>Добавить поле</h3>
  <form action="" method="post">
	<script type="text/javascript">
	  function showOption(el)
	  {
		disState = el.options[el.selectedIndex].value;
			if(disState == '1' || disState == '2') {CloseClose('add-pole');CloseClose('add-name');}
			if(disState == '3') {OpenOpen('add-pole');OpenOpen('add-name');}
	  }
	</script>
  <table>
   <tr><td width="250">Название:</td><td><input type="text" class="inputbox" name="desc" value="" /></td></tr>
   <tr><td width="250">Тип:</td><td>
   <select name="type" onchange="showOption(this)" class="inputbox" >
	<option value="1">Строка</option>
	<option value="2">Текстовый блок</option>
	<option value="3">Выпадающий cписок</option>
   </select>
   </td></tr>
   <tr><td width="250"><div id="add-name" style="display: none;">Значение:</div></td><td>
	<div id="add-pole" style="display: none;">
	     <div id="parentId">
	        <div>
	            <input name="vall[]" type="text" class="inputbox" />
	            <a onclick="return deleteField(this)" href="#" class="link">[X]</a>
	        </div>
	     </div>
	     <a onclick="return addField()" href="#" class="link">Добавить поле</a>
	</div>
   </td></tr>
   <tr><td width="250">Очередность отображения:</td><td><input type="text" name="num" value="" class="inputbox" /></td></tr>
  </table>

  <table><tr><td class="login-tr">
	<input type="submit" class="login-submit" value="Добавить" />
  </td></tr></table>
  <input name="event" value="add" type="hidden">
  </form>
<p><a href="index.php?component=users"><< Назад</a></p>
<?endif;?>