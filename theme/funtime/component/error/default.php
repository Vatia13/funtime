<?defined('_JEXEC') or die('Restricted access');?>
<?if($_GET['value']=='fail'):?>
	<div class="int-tit-menu"><div class="int-tit-menu-l"></div><div class="int-tit-menu-r"></div>
	<div class="title">Операция прервана</div></div><div id="news_bodys_profile">
	<div class="int-profile-body-public">
		Операция оплаты была прервана.
	</div></div>
<?endif?>

<?if(empty($_GET['value'])):?>
	<?@include('.err404.php');?>
<?endif?>