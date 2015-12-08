<?defined('_JEXEC') or die('Restricted access');
if ($user->get_property('userID')>0 OR $user->get_property('gid')>=18):?>
<div class="menu-top5">Корзина</div>
<div class="menu-body5">
<?@include('.menu.php');?>
<div class="massage-slash"></div>
    <div class="message-block">
	<div class="message"><?=$message;?></div>
	<?if(count($all_mess)):?>
		<h1 style="margin:0;"><?=$all_mess[0]['subject']?></h1>
		<div class="mess-date"><?=date('d.m.Y h:s',$all_mess[0]['date'])?></div>
		<div class="mess-text"><p><?=htmlspecialchars_decode($all_mess[0]['message'])?></p></div>
		<a href="/com/message/new/<?=$all_mess[0]['from']?>" class="link4">Ответить на сообщение</a><br/>
		<a href="/com/message/add/<?=$all_mess[0]['from']?>" class="link4">Дабавить пользователя в контакты</a>
		<p align="right">Отправитель: <a href="/com/profile/default/<?=$all_mess[0]['from']?>" class="link4"><?=$mess_from?></a><br/>
		   Получатель: <a href="/com/profile/default/<?=$all_mess[0]['to']?>" class="link4"><?=$mess_to?></a><br/>
		</p>
	<?else:?>
		Сообщения с таким ID не существует
	<?endif;?>
    </div>
  </div>
<?else:?>
<?@include('.access.php');?>
<?endif;?>