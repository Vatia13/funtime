<?defined('_JEXEC') or die('Restricted access');?>

<?if ( !$user->is_loaded() ):?>
<div class="news-center">
  <div class="menu-top-w">Вход в систему</div>

<form method="post" action="" />
<br/>
<table class="regs-table">
	 <tr><td width="150">Логин: </td><td><input type="text" class="inputbox" name="uname" /></td></tr>
	 <tr><td>Пароль: </td><td><input type="password" class="inputbox" name="pwd" /></td></tr>
</table>

<p align="center" style="width:460px">
	<input type="hidden" name="event" value="signup"/>
	<input type="submit" class="button" value="Войти" />
</p>
</form>
	<p align="left" class="recovery">
	<a href="/com/confirm/" class="link4">Забыли пароль?</a> | <a href="/com/signup"  class="link4">Регистрация</a><br>
	</p>
</div>
<?else:?>
<div class="news-center">
  <div class="menu-top-w">Выход из системы</div>
<br/>
<p align="center" class="recovery">
	<a href="/com/setup/" class="link4">Сменить пароль</a> | 
	<a href="/?logout=1" class="link4">Выход</a>
</p><br/>
</div>
<?endif;?>