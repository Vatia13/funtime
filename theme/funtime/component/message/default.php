<?defined('_JEXEC') or die('Restricted access');
if ($user->get_property('userID')>0 OR $user->get_property('gid')>=18):?>
<style>
</style>
<div class="menu-top5">Входящие</div>
<div class="menu-body5">
<?@include('.menu.php');?>
<div class="massage-slash"></div>
    <div class="message-block">
	<div class="message"><?=$message;?></div>
	<table width="718" class="message-cell-title">
	<tr><td width="150">Отправитель</td><td width="320">Сообщение</td><td width="103">Дата</td><td width="103"></td></tr>
	</table>
	<form action="" method="post">
	<input name="delcheck" type="hidden" value="1"/>
	<?if(count($all_mess)):?>
		<?foreach($all_mess as $num):?>
			<table width="716" class="message-cell-body">
			<tr>
				<td width="149">
				<input type="checkbox" name="mess[]" value="<?=$num['id']?>" class="ckeckbox"/>
				  <?if($num['view']==0):?>
					<img src="/<?=$theme?>images/messagen/stara.png" width="19" height="19" alt="новое" title="Новое сообщение" class="stara"/>
				  <?else:?>
					<img src="/<?=$theme?>images/messagen/starn.png" width="19" height="19" alt="прочитанное" title="Прочитанное сообщение" class="stara"/>
				  <?endif;?>
				  <a href="/com/message/view/<?=$num['id']?>">
				  <?if($num['view']==0):?>
					<img src="/<?=$theme?>images/messagen/mailnew.png" width="32" height="28" alt="Прочитанное" title="Не прочитанное" class="mailnew"/>
				  <?else:?>
					<img src="/<?=$theme?>images/messagen/mailsee.png" width="32" height="28" alt="Прочитанное" title="Прочитанное" class="mailsee"/>
				  <?endif;?>
				  </a>
				<a href="/com/profile/default/<?=$num['userID']?>" class="link6"><?if(utf8_strlen($num['username'])>8):?><?=utf8_substr($num['username'],0,8)?>...<?else:?><?=$num['username']?><?endif;?></a>
				</td>
				<td width="320"><a href="/com/message/view/<?=$num['id']?>" class="link<?if($num['view']==0):?>5<?else:?>4<?endif;?>"><?=$num['subject']?></a></td>
				<td class="mess-date" width="103"><?=date('d.m.Y h:s',$num['date'])?></td>
				<td align="center" width="102">
					<a href="/com/message/new/<?=$num['from']?>"><img src="/<?=$theme?>images/messagen/reply.png" width="25" height="25" border="0" style="margin:0 15px 3px 0;" alt="ответить" title="Ответить"/></a>
					<a href="/com/message/del/<?=$num['id']?>"><img src="/<?=$theme?>images/messagen/del.png" width="30" height="30" border="0" alt="в корзину" title="В корзину"/></a>
				</td>
			</tr>
			</table>
	        <?endforeach;?>

	<?if ($total>1) echo '<div class="pagenation" align="center" style="margin-bottom:10px; margin-top:10px;">'
		.$pervpage.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right
		.$nextpage.'</div>';?>
	<p align="right">&nbsp;<br/><input type="submit" class="delcheck" value="Удалить отмеченные"/></p>
	</form>
	<?else:?>
		<p>Нет входящих сообщений</p>
	<?endif;?>
  </div>
</div>
<?else:?>
<?@include('.access.php');?>
<?endif;?>