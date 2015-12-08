<?defined('_JEXEC') or die('Restricted access');
if ($user->get_property('userID')>0 OR $user->get_property('gid')>=18):?>


<script type="text/javascript">
    function checkForm() {
	if (document.forms.form.elements['title'].value.length == 0) {
		alert('Пожалуйста заполните поле "Тема"');
        	return false;
    	}
        return true;
   }

  function showOption(el)
  {
  disState = el.options[el.selectedIndex].value;
	if(disState == 1) {OpenOpen('recip1');CloseClose('recip2');CloseClose('recip3');}
	if(disState == 2) {OpenOpen('recip2');CloseClose('recip1');CloseClose('recip3');}
	if(disState == 3) {OpenOpen('recip3');CloseClose('recip2');CloseClose('recip1');}
	if(disState == 1) {OpenOpen('recip11');CloseClose('recip12');CloseClose('recip13');}
	if(disState == 2) {OpenOpen('recip12');CloseClose('recip11');CloseClose('recip13');}
	if(disState == 3) {OpenOpen('recip13');CloseClose('recip12');CloseClose('recip11');}
  }
</script>

<!-- Load jQuery -->
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1");
</script>

<!-- Load TinyMCE -->
<script type="text/javascript" src="/<?=$theme?>js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '/<?=$theme?>js/tiny_mce/tiny_mce.js',
			relative_urls : false,
			// General options
			theme : "advanced",language:"ru",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,emotions",
			theme_advanced_buttons3 : "",
			theme_advanced_buttons4 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});
</script>
<!-- /TinyMCE -->

<div class="menu-top5">Новое сообщение</div>
<div class="menu-body5">
<?@include('.menu.php');?>
<div class="massage-slash"></div>
    <div class="message-block">
	<div class="message"><?=$message;?></div>

	<form method="post" name="form" onSubmit="return checkForm()" action=""/>
	<input type="hidden" name="event" value="message"/>
	<input type="hidden" name="add" value="1"/>
	<table>
	<tr><td width="200">Получатель:</td><td><select name="recipient" class="inputbox" onchange="showOption(this)">
		<option value="2" selected>Выбрать из общего списка</option>
		<option value="1">Выбрать из личных контактов</option>
		<option value="3">Вписать имя(никнейм) самостоятельно</option>
		</select></td></tr>
	<tr><td><div id="recip2" style="display:block;">Общий список пользователей:</div></td>
		<td><div id="recip12" style="display:block"><select name="friends2" class="inputbox">
		<?foreach($all_user as $a_us):?>
			<option value="<?=$a_us['userID'];?>" <?if($a_us['userID']==intval($_GET['value'])):?>selected<?endif;?>><?=$a_us['username'];?></option>
		<?endforeach;?>
		</select></div></td></tr>
	<tr><td><div id="recip1" style="display:none;">Список личных контактов:</div></td>
		<td><div id="recip11" style="display:none;"><select name="friends1" class="inputbox">
		<?foreach($friend_user as $a_us):?>
			<option value="<?=$a_us['userID'];?>"><?=$a_us['username'];?></option>
		<?endforeach;?>
		</select></div></td></tr>
	<tr><td><div id="recip3" style="display:none;">Никнейм получателя:</div></td>
	<td><div id="recip13" style="display:none;"><input class="inputbox" type="text" name="friends3" value=""/></div></td></tr>

	<tr><td>Тема: </td><td><input class="inputbox" type="text" name="title" value=""/></td></tr>

		<tr><td>Текст сообщения:</td><td>
	<textarea name="textarea1" class="tinymce" id="textarea1" style="width: 400px;height:150px;"></textarea></td></tr>
	</table>
	<p align="right">&nbsp;<br/><input type="submit" class="delcheck" value="Отправить"/></p>
	* Максимальное число символов - 2000<br/>
	</form>
    </div>
  </div>
<?else:?>
<?@include('.access.php');?>
<?endif;?>