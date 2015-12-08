<?defined('_JEXEC') or die('Restricted access');?>
<?if ($user->get_property('userID')==1 OR $user->get_property('gid')>=25):?>
<h2>Анкета пользователя - редактирование</h2>

  <div class="line" style="width:628px"></div>
  <div class="setting">
  <form action="" method="post">

<script type="text/javascript">
  function showOption(el)
  {
	disState = el.options[el.selectedIndex].value;
		if(disState == 'input' || disState == 'textarea') {CloseClose('add-pole');CloseClose('add-name');}
		if(disState == 'select') {OpenOpen('add-pole');OpenOpen('add-name');}
  }
</script>

	 <table>

	 <tr><td width="250">Название:</td><td><input type="text" name="desc" class="inputbox" value="<?=$anket[0]['desc']?>" /></td></tr>
	 <tr><td width="250">Очередность отображения:</td><td><input type="text" class="inputbox" name="num" value="<?=$anket[0]['num']?>" /></td></tr>
	 </table>

	 <table><tr><td class="login-tr">
		<input type="submit" class="login-submit" value="Обновить" />
	 </td></tr></table>
         <input name="event" value="update" type="hidden">
         <input name="id" value="<?=$anket[0]['id']?>" type="hidden">
  </form>
</div>
<p><a href="index.php?component=users"><< Назад</a></p>
<?endif?>