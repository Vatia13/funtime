<?defined('_JEXEC') or die('Restricted access');?>
<div class="menu">
<ul>
	<li><a <?if(!isset($_GET['component'])):?>class="current"<?endif?> href="index.php">მთავარი</a></li>
	<li><a <?if($_GET['component']=="support"):?>class="current"<?endif?> href="?component=support">დახმარება</a></li>
	<li><a href="/" target="_blank">საიტზე გადასვლა</a></li>
</ul>
</div>