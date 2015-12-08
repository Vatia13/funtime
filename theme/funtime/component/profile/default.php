<?defined('_JEXEC') or die('Restricted access');?>
<?if(count($all)>0):?>
<style>
.uname {
	color: #333333;
	font:12px arial;
}
.green {
	color:#00B711;
}
.red {
	color:#C10E22;
}
.uname table td {
	padding:5px 0;
}
</style>
  <div class="menu-top5">Профиль пользователя <?=$all[0]['username']?></div>
  <div class="menu-body5">
	<div class="message"><?=$message;?></div>

		<table>
		<tr><td width="250" align="center" valign="top">
			<?=$img_path;?><br/>
		</td><td valign="top">
			<div class="uname">
			<table>
			<tr><td width="100">Логин:</td><td><?=$all[0]['username']?> <?if($all[0]['last_visit']>(time()-15*60)):?>(<span class="green">Online</span>)<?else:?>(<span class="red">Offline</span>)<?endif;?></td></tr>
			<?if(!empty($all[0]['realname'])):?><tr><td>Имя:</td><td><?=$all[0]['realname']?></td></tr><?endif;?>
			<tr><td>Группа:</td><td><?=$all[0]['g_title']?></td></tr>
			<?if(!empty($all[0]['city_name_ru'])):?><tr><td>Город:</td><td><?=$all[0]['city_name_ru']?></td></tr><?endif;?>
			<tr><td>Рейтинг:</td><td><?=intval($all[0]['karma'])?> BL</td></tr>
			</table>
			</div>
		</td></tr></table>

  <?if ($user->get_property('userID')>0):?>


  <?else:?>
	<h1>Только просмотр</h1>
	<p>Для просмотра подробной информации о пользователе или отправки сообщения 
	<a href="/forum/login.php" class="link4">пожалуйста авторизируйтесь.</a></p>

	<p>Информацмя:</p>
	<ul>
	<li>В целях защиты информации о пользователях, а также предотвращения нежелательных сообщений, мы ограничили количество отображаемой информации о пользователе для не авторизированных пользователей.</li>
	</ul>
  <?endif?>
</div>
<?else:?>
  <?@include('.access.php');?>
<?endif?>
