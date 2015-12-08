<?defined('_JEXEC') or die('Restricted access');
if ($user->get_property('userID')>0 OR $user->get_property('gid')>=18):
	$all_mess=$DB->getAll('SELECT `#__message`.*
				FROM `#__message` 
				WHERE `#__message`.`id`=\''.intval($_GET['value']).'\' and `#__message`.`to`=\''.$user->get_property('userID').'\'
				LIMIT 1');
	if(count($all_mess)>0):
		if($all_mess[0]['tresh']==0):
			$sql="UPDATE `#__message` SET `tresh` = '1' WHERE `#__message`.`id` =".intval($_GET['value']);
			$DB->execute($sql);
			header('Location: /com/message');
		else:
			$sql="DELETE FROM `#__message` WHERE `#__message`.`id` = ".intval($_GET['value']);
			$DB->execute($sql);
			header('Location: /com/message/tresh');
		endif;
	endif;
endif;
