<?defined('_JEXEC') or die('Restricted access');?>
<?if ($user->get_property('userID')>0):?>

	<?if (count($registry['user_data'])>0):?>
		<?foreach($registry['user_data'] as $num):?>
<div class="news-center">
<div class="menu-top5">Настройки профиля</div>
<?if(!empty($message[0])):?>
     <div class="<?=$message[0]?>_box">
	<?=$message[1]?>
     </div>
<?endif;?>
<div class="menu-body5">
	<form method="post" action="" enctype="multipart/form-data"/>
		<?if (generate_avatar_markup($user->get_property('userID'))==''):
			$img_path='<img src="/img/no_avatar.png" alt="" class="photo" width="150" />'; 
			else:
			$img_path=generate_avatar_markup($user->get_property('userID'));
		endif;?>
		<table class="user-table">
		<tr><td width="250" align="center" valign="top">
			<?=$img_path;?><br/>
			<input type="checkbox" name="del_ava" value="1"/> <span class="link1n">Удалить аватор</span><br />
			Загрузить аватор: <input type="file" name="photo"/>
		</td><td valign="top">
		<input type="hidden" name="event" value="setup"/>
		<input type="hidden" name="update" value="1"/>
		
		<table>
		<tr><td>Ф.И.О.:</td><td><input class="inputbox" type="text" name="realname" value="<?=$num['realname']?>"/></td></tr>
		<tr><td>Пароль:</td><td><input class="inputbox" type="password" name="pwd" value=""/></td></tr>
		<tr><td>Повторить пароль:</td><td><input class="inputbox" type="password" name="pwd2" value=""/></td></tr>
		<tr><td>E-Mail:</td><td><input class="inputbox" type="text" name="email" value="<?=$num['email']?>"/></td></tr>
		<tr><td>ICQ UIN:</td><td><input class="inputbox" type="text" name="icq" value="<?=$num['icq']?>"/></td></tr>
		<tr><td>Сайт:</td><td><input class="inputbox" type="text" name="url" value="<?=$num['url']?>"/></td></tr>
		<tr><td>Номер телефона:</td><td><input class="inputbox" type="text" name="phone" value="<?=$num['phone']?>"/></td></tr>
		<tr><td>Заметка:</td><td><input class="inputbox" type="text" name="title" value="<?=$num['title']?>"/></td></tr>
		</table>
		</td></tr></table>
	<input type="submit" class="button" value="Сохранить" />
	</form>
</div>
</div>

        	<?endforeach;?>
	<?endif?>
<?else:?>
<?@include('.access.php');?>
<?endif?>