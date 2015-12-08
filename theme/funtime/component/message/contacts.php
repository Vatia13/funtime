<?defined('_JEXEC') or die('Restricted access');
if ($user->get_property('userID')>0 OR $user->get_property('gid')>=18):?>
<div class="menu-top5">Корзина</div>
<div class="menu-body5">
<?@include('.menu.php');?>
<div class="massage-slash"></div>
    <div class="message-block">
	<div class="message"><?=$message;?></div>
	<table width="718" class="message-cell-title">
	<tr><td width="150">Ник пользователя</td><td width="320"></td><td width="103"></td><td width="103"></td></tr>
	</table>
	<?if(count($all_cont)):?>
		<?foreach($all_cont as $num):?>
			<table width="716" class="message-cell-body">
			<tr>
				<td width="149">
				<a href="/com/profile/default/<?=$num['contact']?>" class="link4"><?if(utf8_strlen($num['username'])>8):?><?=utf8_substr($num['username'],0,8)?>...<?else:?><?=$num['username']?><?endif;?></a>
				</td>
				<td width="320"></td>
				<td class="mess-date" width="103"></td>
				<td align="center" width="102">
					<a href="/com/message/new/<?=$num['contact']?>"><img src="/<?=$theme?>images/messagen/reply.png" width="25" height="25" border="0" style="margin:0 15px 3px 0;" alt="Новое сообщение" title="Новое сообщение"/></a>
					<a href="/com/message/delc/<?=$num['contact']?>"><img src="/<?=$theme?>images/messagen/del.png" width="30" height="30" border="0" alt="Удалить" title="Удалить"/></a>
				</td>
			</tr>
			</table>
	        <?endforeach;?>

	<?if ($total>1) echo '<div class="pagenation" align="center" style="margin-bottom:10px; margin-top:10px;">'
		.$pervpage.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right
		.$nextpage.'</div>';?>
	<?else:?>
		<p>Нет сообщений в корзине</p>
	<?endif;?>
  </div>
<?else:?>
<?@include('.access.php');?>
<?endif;?>
