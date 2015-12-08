<?php defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','tools','view')):?>
<!-- Load jQuery -->
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1");
</script>

<!-- Load TinyMCE -->
<script type="text/javascript" 
src="<?=$theme_admin?>js/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '<?=$theme_admin?>js/tinymce/tiny_mce.js',
			relative_urls : false,
			// General options
			theme : "advanced",language:"ru",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl",

			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			//content_css : "css/content.css",

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

	<script type="text/javascript">
	  function showOption(el)
	  {
		disState = el.options[el.selectedIndex].value;
			if(disState == '1') {CloseClose('t1');}
			if(disState == '2') {CloseClose('t1');}
			if(disState == '3') {CloseClose('t1');}
			if(disState == '4') {OpenOpen('t1');}
	  }
	</script>
<h2>Рассылки</h2>

<form method="post" action="" enctype="multipart/form-data">
	<input name="mail" value="1" type="hidden"/>
	<table class="formadd">
	<tbody>
		<tr><td class="td1">Тип рассылки</td><td>
			<select name="mail" class="inputbox" onchange="showOption(this)">
			<option value="1">на email всем пользователям</option>
			<option value="4">свой список email</option>
		</select>

		<div style="display:none" id="t1"><p><textarea name="sbeml" style="width:200px;height:100px;">Список адресов эл. почты, каждый с новой строки.</textarea></p></div>
		</td>

		<tr><td class="td1">Тема сообщения</td><td><input name="subject" value="" class="inputbox" type="text"/></td></tr>
	</tbody></table>

	<span class="title-table">Текст сообщения</span>
	<textarea class="tinymce" id="textarea1" name="text" style="height:300px;"></textarea>
	<br/>
	<input type="submit" value="Разослать"/>
</form>

<?endif?>