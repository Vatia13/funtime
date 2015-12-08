<?defined('_JEXEC') or die('Restricted access');?>
<div class="news-center">

<?if($registry['step']==1):?>
  <div class="menu-top-w">Восстановление пароля</div>
	<form method="post" action="" />
	<input name="confirm" type="hidden" value="1"/>
	<table class="regs-table">
		<tbody><tr>
			<td colspan="2" height="40">
				<p>Пожалуйста, введите адрес электронной почты, указанный в вашей учетной записи. На этот адрес будет отправлен код подтверждения, получив который Вы сможете ввести новый пароль.</p>
			</td>
		</tr>
		<tr>
			<td height="40">
				<label for="email">E-mail адрес:</label>

			</td>
			<td>
				<input class="inputbox" name="email" type="text"/>
			</td>
		</tr>
	</tbody>
	</table>
	<input type="submit" value="отправить"/>
	</form>
<?endif;?>

<?if($registry['step']==2):?>
  <div class="menu-top-w">Подтвердите вашу учетную запись.</div>
	<form method="post" action="" />
	<input name="checkcode" type="hidden" value="1"/>
	<table class="regs-table">
		<tbody><tr>
			<td colspan="2" height="40">
			<p>На указанный вами e-mail было отправлено письмо, содержащее специальный код. Для подтверждения того, что вы являетесь владельцем учетной записи, скопируйте этот код в поле "Код подтверждения".</p>
			</td>
		</tr>
		<tr>
			<td height="40">
				<label for="code">Код подтверждения:</label>
			</td>
			<td>
				<input class="inputbox" id="code" name="code" type="text"/>
			</td>
		</tr>
	</tbody>
	</table>
	<input type="submit" value="отправить"/>
	</form>
<?endif;?>

<?if($registry['step']==3):?>
  <div class="menu-top-w">Укажите новый пароль</div>
	<form method="post" action="" />
	<input name="newpass" type="hidden" value="1"/>
	<input name="code" type="hidden" value="<?=$registry['code']?>"/>
	<table class="regs-table">
		<tbody><tr>
			<td colspan="2" height="40">
			<p>Введите новый пароль для доступа в личный кабинет.</p>
			</td>
		</tr>
		<tr>
			<td height="40">
				<label for="pass">Новый пароль:</label>
			</td>
			<td>
				<input class="inputbox" name="pass" type="password"/>
			</td>
		</tr>
	</tbody>
	</table>
	<input type="submit" value="отправить"/>
	</form>
<?endif;?>

<?if($registry['step']==4):?>
  <div class="menu-top-w">Новый пароль установлен</div>
	<table class="regs-table">
		<tbody><tr>
			<td colspan="2" height="40">
			<p>Поздравляем, вы только, что установили новый пароль для входа в личный кабинет.</p>
			</td>
		</tr>
	</tbody>
	</table>
	<p align="center" class="recovery">
		<a href="/com/login/" class="out-link">Вход для пользователей</a>
	</p>
<?endif;?>

<?if($registry['step']==5):?>
  <div class="menu-top-w">Ошибка</div>
	<table class="regs-table">
		<tbody><tr>
			<td colspan="2" height="40">
			<p><?=$message[1]?></p>
			</td>
		</tr>
	</tbody>
	</table>
	<p align="center" class="recovery">
	<a href="/com/login/" class="out-link">Вход для пользователей</a>
	</p>
<?endif;?>

  </div>