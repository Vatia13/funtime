<?php
/**
 *
 * CMS osRealty 2.1.x
 * Autor: Roman Chernyshov
 * E-mail: support@osRealty.ru
 * URL: www.osRealty.ru
 *
 */

defined('_JEXEC') or die('Restricted access');

if ($user->get_property('userID')>0 OR $user->get_property('gid')>=18):

if(!empty($_POST['delcheck'])) 
	{
	foreach($_POST['mess'] as $mess):
		$sql="UPDATE `#__message` SET `tresh` = '1' WHERE `#__message`.`id` ='".intval($mess)."' and `#__message`.`to`=".$user->get_property('userID');
		$DB->execute($sql);
	endforeach;
	}
if(!empty($_POST['delchecktresh'])) 
	{
	foreach($_POST['mess'] as $mess):
		$sql="DELETE FROM `#__message` WHERE `#__message`.`id` ='".intval($mess)."' and `#__message`.`to`=".$user->get_property('userID');
		$DB->execute($sql);
	endforeach;
	}
if($_GET['section']=='new')
	{
	$all_user=$DB->getAll('SELECT `#__users`.`id` as `userID`, `#__users`.`username` FROM `#__users` ORDER BY username ASC');
	$friend_user=$DB->getAll('SELECT `#__users`.`id` as `userID`, `#__users`.`username`
					FROM `#__message_contacts` 
					LEFT JOIN `#__users` ON `#__message_contacts`.`contact`=`#__users`.`id`
					WHERE `#__message_contacts`.`user`='.$user->get_property('userID'));
	}
if($_GET['section']=='view')
	{
	$all_mess=$DB->getAll('SELECT `#__message`.*
				FROM `#__message` 
				WHERE `#__message`.`id`=\''.intval($_GET['value']).'\' and (`#__message`.`from`=\''.$user->get_property('userID').'\' or `#__message`.`to`=\''.$user->get_property('userID').'\')
				LIMIT 1');
	if(count($all_mess)>0)
		{
		$mess_to=$DB->getOne('SELECT `#__users`.`username`,`#__users`.`id`  as `userID` FROM `#__users` WHERE `#__users`.`id`='.$all_mess[0]['to']);
		$mess_from=$DB->getOne('SELECT `#__users`.`username`,`#__users`.`id` as `userID` FROM `#__users` WHERE `#__users`.`id`='.$all_mess[0]['from']);
		if($all_mess[0]['to']==$user->get_property('userID') and $all_mess[0]['view']==0)
			{
			$sql="UPDATE `#__message` SET `view` = '1' WHERE `#__message`.`id` =".intval($_GET['value']);
			$DB->execute($sql);
			}
		}
	}
if($_GET['section']=='add')
	{
	$testuniq=$DB->getOne('SELECT count(`#__message_contacts`.`id`)
				FROM `#__message_contacts` 
				WHERE `#__message_contacts`.`contact`=\''.intval($_GET['value']).'\' and `#__message_contacts`.`user`=\''.$user->get_property('userID').'\'');
	$testreal=$DB->getOne('SELECT count(`#__users`.`id`)
				FROM `#__users` 
				WHERE `#__users`.`id`=\''.intval($_GET['value']).'\'');
	if($testuniq==0 and $testreal==1):
				$sql="	INSERT INTO `#__message_contacts` (`user`, `contact`) 
					VALUES ('".$user->get_property('userID')."', '".intval($_GET['value'])."')";
				$DB->execute($sql);
	endif;

	header('Location: /com/message/contacts/');
	}
if(!empty($_POST['add']))
	{
	$err=0;
        $recipient=intval($_POST['recipient']);
	if($recipient<1 OR $recipient>3): $err=1; $message="Ошибка: Вы не указали получателя сообщения";endif;
	if($recipient==1): $friends=intval($_POST['friends1']);$where="`punbb_users`.`id`='$friends'";endif;
	if($recipient==2): $friends=intval($_POST['friends2']);$where="`punbb_users`.`id`='$friends'";endif;
	if($recipient==3): $friends=PHP_slashes(htmlspecialchars($_POST['friends3']));$where="`#__users`.`username`='$friends'";endif;
	if($err==0)
		{
		$test_user=$DB->getAll('SELECT `#__users`.`id` as `userID`,`#__users`.`username`,`#__users`.`email` FROM `#__users` WHERE '.$where);	
		if(count($test_user)==0 or count($test_user)>1):$err=1; $message="Ошибка: Вы указали несуществующего получателя";endif;
		if($err==0)
			{
			$subject=PHP_slashes(utf8_substr(htmlspecialchars(strip_tags($_POST['title'])),0,250));
			$mess=PHP_slashes(utf8_substr(htmlspecialchars(markhtml($_POST['textarea1'])),0,2000));
			if(empty($subject)):$err=1; $message="Ошибка: Вы не указали тему сообщения";endif;
			if(empty($mess)):$err=1; $message="Ошибка: Вы не указали текс сообщения";endif;
			if($err==0)
				{
				$sql="	INSERT INTO `#__message` (`from`, `to`, `date`,`subject`,`message`,`view`,`tresh`) 
					VALUES ('".$user->get_property('userID')."', '".$test_user[0]['userID']."','".time()."',
						'$subject','$mess','0','0')";
				$DB->execute($sql);
				$message="Ваше сообщение успешно отправлено пользователю ".$test_user[0]['username'];

		$sql="SELECT LAST_INSERT_ID()";
		$last_id=$DB->getOne($sql);
		$emailsup = $DB->getOne('SELECT `#__setting`.`value` 
			FROM `#__setting`
			WHERE `#__setting`.`name`=\'emailsup\'');

		$m= new Mail; // начинаем
		$m->From($emailsup); // от кого отправляется почта
		$m->To($test_user[0]['email']); // кому адресованно
		$m->text_html="text/html";
		$m->Subject("Новое личное сообщение на сайте ".$_SERVER['HTTP_HOST']);
                $m->Body( "
<p>Здравствуйте, ".$test_user[0]['username']."!</p>
<p>Вам пришло новое личное сообщение на сайте \"".$_SERVER['HTTP_HOST']."\" с темой:</p>

<p>$subject</p>

<p>Вы можете прочитать это сообщение, перейдя по следующей ссылке:</p>

<a href=\"http://".$_SERVER['HTTP_HOST']."/com/message/view/$last_id\">http://".$_SERVER['HTTP_HOST']."/com/message/view/$last_id</a>

" );
			$m->Priority(3) ;    // приоритет письма
			$m->Send();    // а теперь пошла отправка


				}
			}
		}
	}
if(empty($_GET['section']) or $_GET['section']=='outbox' or $_GET['section']=='tresh')
	{
	//---------------------------------------------
	$page	                = intval($_GET['page']);
	$num = 20;
	if ($page==0) $page=1;
	if(empty($_GET['section'])):$from_to='to';$to_from='from';$tresh=0;endif;
	if($_GET['section']=='outbox'):$from_to='from';$to_from='to';$tresh=0;endif;
	if($_GET['section']=='tresh'):$from_to='to';$to_from='from';$tresh=1;endif;
	$posts = $DB->getOne('SELECT count(`#__message`.`id`) FROM `#__message` WHERE `#__message`.`'.$from_to.'`='.$user->get_property('userID').' and `#__message`.`tresh`='.$tresh);
	$total = intval(($posts - 1) / $num) + 1;  

	$page = intval($page);  
	if(empty($page) or $page < 0) $page = 1; 
	if($page > $total) $page = $total; 
	$start = $page * $num - $num;

	if(empty($_GET['section']))$link_url='/index.php?component=message';
	if($_GET['section']=='outbox')$link_url='/index.php?component=message&section=outbox';
	if($_GET['section']=='tresh')$link_url='/index.php?component=message&section=tresh';
	if ($page != 1) $pervpage = '<a href="'.$link_url.'&page=-1"><<</a> 
                               <a href="'.$link_url.'&page='. ($page - 1).'"><</a> '; 
	if ($page != $total) $nextpage = '  <a href="'.$link_url.'&page='. ($page + 1).'">></a>
                                   <a href="'.$link_url.'&page='.$total.'">>></a> '; 
	if($page - 2 > 0) $page2left = ' <a href="'.$link_url.'&page='. ($page - 2) .'">'. ($page - 2) .'</a>  '; 
	if($page - 1 > 0) $page1left = '<a href="'.$link_url.'&page='. ($page - 1) .'">'. ($page - 1) .'</a>  '; 
	if($page + 2 <= $total) $page2right = '  <a href="'.$link_url.'&page='. ($page + 2).'">'. ($page + 2) .'</a>'; 
	if($page + 1 <= $total) $page1right = '  <a href="'.$link_url.'&page='. ($page + 1).'">'. ($page + 1) .'</a>';

	$all_mess=$DB->getAll('SELECT `#__message`.`id`,`#__message`.`from`,`#__message`.`view`, `#__message`.`subject`, `#__message`.`date`, `#__users`.`username`, `#__users`.`id`  as `userID`
				FROM `#__message` 
				LEFT JOIN `#__users` ON `#__message`.`'.$to_from.'`=`#__users`.`id`
				WHERE `#__message`.`'.$from_to.'`=\''.$user->get_property('userID').'\' and `#__message`.`tresh`='.$tresh.'
				ORDER BY date DESC
				LIMIT '.$start.','.$num);
	}
if($_GET['section']=='contacts')
	{
	//---------------------------------------------
	$page	                = intval($_GET['page']);
	$num = 20;
	if ($page==0) $page=1;
	$posts = $DB->getOne('SELECT count(`#__message_contacts`.`id`) FROM `#__message_contacts` WHERE `#__message_contacts`.`user`='.$user->get_property('userID'));
	$total = intval(($posts - 1) / $num) + 1;  
	$page = intval($page);  
	if(empty($page) or $page < 0) $page = 1; 
	if($page > $total) $page = $total; 
	$start = $page * $num - $num;
	$link_url='/index.php?component=message&section=contacts';
	if ($page != 1) $pervpage = '<a href="'.$link_url.'&page=-1"><<</a> 
                               <a href="'.$link_url.'&page='. ($page - 1).'"><</a> '; 
	if ($page != $total) $nextpage = '  <a href="'.$link_url.'&page='. ($page + 1).'">></a>
                                   <a href="'.$link_url.'&page='.$total.'">>></a> '; 
	if($page - 2 > 0) $page2left = ' <a href="'.$link_url.'&page='. ($page - 2) .'">'. ($page - 2) .'</a>  '; 
	if($page - 1 > 0) $page1left = '<a href="'.$link_url.'&page='. ($page - 1) .'">'. ($page - 1) .'</a>  '; 
	if($page + 2 <= $total) $page2right = '  <a href="'.$link_url.'&page='. ($page + 2).'">'. ($page + 2) .'</a>'; 
	if($page + 1 <= $total) $page1right = '  <a href="'.$link_url.'&page='. ($page + 1).'">'. ($page + 1) .'</a>';

	$all_cont=$DB->getAll('SELECT `#__users`.`username`,`#__message_contacts`.`contact`
				FROM `#__message_contacts` 
				LEFT JOIN `#__users` ON `#__message_contacts`.`contact`=`#__users`.`id`
				WHERE `#__message_contacts`.`user`=\''.$user->get_property('userID').'\'
				ORDER BY `#__users`.`username` ASC
				LIMIT '.$start.','.$num);
	}

$count_new_mess=$DB->getOne('SELECT count(`#__message`.`id`)
			FROM `#__message` 
			WHERE `#__message`.`tresh`=\'0\' and `#__message`.`view`=\'0\' and `#__message`.`to`=\''.$user->get_property('userID').'\'');
$count_tresh=$DB->getOne('SELECT count(`#__message`.`id`)
			FROM `#__message` 
			WHERE `#__message`.`tresh`=\'1\' and `#__message`.`to`=\''.$user->get_property('userID').'\'');
$count_outbox=$DB->getOne('SELECT count(`#__message`.`id`)
			FROM `#__message` 
			WHERE `#__message`.`tresh`=\'0\' and `#__message`.`view`=\'0\' and `#__message`.`from`=\''.$user->get_property('userID').'\'');
$count_contacts=$DB->getOne('SELECT count(`#__message_contacts`.`id`)
			FROM `#__message_contacts` 
			WHERE `#__message_contacts`.`user`=\''.$user->get_property('userID').'\'');


endif;