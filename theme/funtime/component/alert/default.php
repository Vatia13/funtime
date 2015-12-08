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

$err='';
if($_POST['add']==1)
	{
	if(!empty($_POST['alert']) and email_check($_POST['email']))
		{
		$text=PHP_slashes(htmlspecialchars(markhtml($_POST['alert'])));
		$email=htmlspecialchars($_POST['email']);
		$idd=intval($_POST['idd']);
		   $sql="INSERT INTO `#__alert` (`fore`, `text`, `email`) VALUES 
			('$idd','$text','$email')";
		   $DB->execute($sql);

		$err='oke';
		} else $err='pub1';
	}
?>
<div class="fore-old-call">
<img src="/<?=$theme?>images/alert.png" width="279" height="22" border="0" alt="Пожаловаться на прогноз" title="Пожаловаться на прогноз"/>
<div class="border"></div>
<br/>

<div class="filtre-block linkss">

<?if($err=='pub1') echo '<span class="public-error">Ошибка: вы не описали вашу жалобу или не указали E-Mail...</span>';?>
<?if($err=='oke') echo '<span class="public-error">Ваша жалоба отправлена администратору на расмотрение.</span>';?>

<form method="post" action="">
<table class="pub-tab">
<input type="hidden" name="add" value="1">
<input type="hidden" name="idd" value="<?=intval($_GET['value']);?>">
<tr>
<td valign="top">Ваша жалоба: <br/>(опишите как можно подробнее)</td>
<td class="public-tab-value">
<div class="in-block-area">
	<textarea name="alert" class="public-textarea"></textarea>
</td></tr>

<td valign="top">Ваша E-Mail:</td>
<td class="public-tab-value">
<div class="in-block">
	<input type="text" name="email" value="" />
</td></tr>

</table>

<center><input type="submit" class="alert-submit" value="Отправить"></center>
</form>

</div></div>
