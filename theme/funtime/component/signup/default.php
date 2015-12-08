<?defined('_JEXEC') or die('Restricted access');?>
<?if ($user->get_property('userID')==0 and $registry['user_register']==1):?>
<div class="news-center">
	<div class="menu-top-w">
	Регистрация
	</div>
<?if(!empty($message[0])):?>
     <div class="<?=$message[0]?>_box">
	<?=$message[1]?>
     </div>
<?endif;?>

<?if ($message[0]<>'valid'):?>
<form method="post" action="" />
<input type="hidden" name="add" value="1"/>
	<script type="text/javascript">
	  function showOption(el)
	  {
		disState = el.options[el.selectedIndex].value;
			if(disState == '1') {cc('l1');cc('l2');cc('v1');cc('v2');}
			if(disState == '2') {oo('l1');oo('l2');oo('v1');oo('v2');}
	  }
	</script>
<?if($_POST['group']==2):?>
	<style>
	#l1,#l2,#v1,#v2 {display:block;}
	</style>
<?endif?>
<table class="regs-table">
	 <tr><td>Зарегистрироваться как: </td><td>
		<select name="group" onchange="showOption(this)" class="inputbox">
		<option value="1" <?if($_POST['group']==1):?>selected<?endif?>>Пользователь</option>
		<?if($registry['user_realty']==1):?><option value="2" <?if($_POST['group']==2):?>selected<?endif?>>Риэлтор</option><?endif;?>
		</select>
		</td></tr>
	 <tr><td>Логин <span class="red">*</span>: </td><td><input type="text" name="login" class="inputbox" value="<?=$_POST['login']?>"/></td></tr>
	 <tr><td>Пароль <span class="red">*</span>: </td><td><input type="password" name="pwd" class="inputbox"/></td></tr>
	 <tr><td>Повторить пароль <span class="red">*</span>: </td><td><input type="password" name="pwd2" class="inputbox"/></td></tr>
	 <tr><td>Электронная почта <span class="red">*</span>: </td><td><input type="text" name="email" class="inputbox" value="<?=$_POST['email']?>"/></td></tr>
	 <tr><td><div id="l1">ФИО <span class="red">*</span>: </div></td><td><div id="v1"><input type="text" name="fio" class="inputbox" value="<?=$_POST['fio']?>"/></div></td></tr>
	 <tr><td><div id="l2">Телефон <span class="red">*</span>: </div></td><td><div id="v2"><input type="text" name="phone" class="inputbox" value="<?=$_POST['phone']?>"/></div></td></tr>
</table>

<p align="center">
	<input type="hidden" name="event" value="signup"/>
	<input type="submit" class="signup-but" value="Зарегистрироваться" />
</p>
</form>

Поля отмеченные звездочкой (<span class="red">*</span>) обязательны для заполнения.
<?endif;?>
  </div>
<?else:?>
	<?@include('.access.php');?>
<?endif;?>