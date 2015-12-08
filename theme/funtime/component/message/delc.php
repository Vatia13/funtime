<?defined('_JEXEC') or die('Restricted access');
if ($user->get_property('userID')>0 OR $user->get_property('gid')>=18):
		$sql="DELETE FROM `#__message_contacts` WHERE `#__message_contacts`.`contact` = '".intval($_GET['value'])."' and `#__message_contacts`.`user`='".$user->get_property('userID')."'";
		$DB->execute($sql);
		header('Location: /com/message/contacts');
endif;
