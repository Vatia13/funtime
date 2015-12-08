<?defined('_JEXEC') or die('Restricted access');?>
<style>
.comm-area {
	width:400px;
	height:150px;
	border:1px solid #D7D7D7;
}
#comments span {
	color: red;
}
.comm-body {
	border:1px dotted #D7D7D7;
	padding:10px;
	margin:10px 0;
}
.comm-date {
	color:#ABABAB;
	font:10px tahoma;
	margin:0 10px;
}
</style>
<script>
scroll(1,<?=intval($scroll);?>);
</script>
<h2>Ответить</h2>
	<script type="text/javascript" src="/<?=$theme?>js/scripts/wysiwyg.js"></script>
	<script type="text/javascript" src="/<?=$theme?>js/scripts/wysiwyg-settings.js"></script>
	<script type="text/javascript">
	var mysettings = new WYSIWYG.Settings();
	// define the location of the openImageLibrary addon
	mysettings.ImagePopupFile = "/theme/doctor/js/addons/imagelibrary/insert_image.php";
	// define the width of the insert image popup
	mysettings.ImagePopupWidth = 600;
	// define the height of the insert image popup
	mysettings.ImagePopupHeight = 300; 
	WYSIWYG.attach('text', myset); // default setup
	</script>
<div class="message"><?=$message?></div>
<form action="" method="post" id="comments" name="comments">
	<input type="hidden" name="add-comm" value="1"/>
Текст: <span>*</span><br/>
<textarea name="text" id="text" class="comm-area"></textarea><br/>
* Для сохранения записи нажмите пиктограмку "Дискета"
</form>
