<?defined('_JEXEC') or die('Restricted access');
if ($user->get_property('userID')>0 OR $user->get_property('gid')>=18):?>
    <div class="message-menu">
	<a href="/com/message" class="input">Входящие <?if($count_new_mess>0) echo '('.$count_new_mess.')';?></a>
	<a href="/com/message/outbox" class="out">Отправленные <?if($count_outbox>0) echo '('.$count_outbox.')';?></a>
	<a href="/com/message/tresh" class="tresh">Корзина <?if($count_tresh>0) echo '('.$count_tresh.')';?></a>
	<a href="/com/message/contacts" class="contacts">Контакты <?if($count_contacts>0) echo '('.$count_contacts.')';?></a>
	<a href="/com/message/new" class="new">Новое</a>
    </div>
<?else:?>У вас нет прав для доступа к данному разделу. Авторизируйтесь пожалуйста.<?endif;?>