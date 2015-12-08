<?defined('_JEXEC') or die('Restricted access');?>
<!-- Load jQuery -->

<!-- Load TinyMCE -->
<script type="text/javascript" 
	src="/<?=$theme?>js/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '/<?=$theme?>js/tinymce/tiny_mce.js',
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
<script>
    function checkForm() {
	if (document.forms.comments.elements['name'].value.length == 0) {
		alert('Пожалуйста заполните поле "Имя"');
        	return false;
    	}
	if (document.forms.comments.elements['email'].value.length == 0) {
		alert('Пожалуйста заполните поле "Эл. почта"');
        	return false;
    	}
	if (document.forms.comments.elements['message'].value.length == 0) {
		alert('Пожалуйста заполните поле "Комментарий"');
        	return false;
    	}
	if (document.forms.comments.elements['capcha'].value.length == 0) {
		alert('Пожалуйста введите код с картинки');
        	return false;
    	}
        return true;
   }
scroll(1,<?=intval($scroll);?>);
</script>
<h2>Комментарии</h2>
<?foreach($all_comments as $comm):?>
<div class="comm-body">
	<?if($comm['user']>0):?>
		<a class="comm-user" href="/com/profile/default/<?=$comm['user']?>/"><?=$comm['username']?></a>
	<?else:?>
		<?if($comm['web']>''):?>
		<noindex><a class="comm-user" rel="nofollow" href="http://<?=str_replace('http://','',$comm['web'])?>"><?=$comm['name']?></a></noindex>
		<?else:?>
		<a class="comm-user" href="mailto:<?=$comm['email']?>"><?=$comm['name']?></a>
		<?endif;?>
	<?endif;?>
	<span class="comm-date"><?=date('d.m.Y, h:s',$comm['date'])?></span>
	<p><?=html_entity_decode($comm['message'])?></p>
	<?if ($user->get_property('gid')==25):?>
	<p align="right">
		<?/*<a href="?component=category&section=edit&edit=<?=$ca['id']?>"><img src="images/edit.png" width="16" height="16" border="0" alt="edit" title="редактировать"/></a>*/?>
		<a href="#"  onclick="if (!confirm('Вы подтверждаете удаление?')) return false; else location.href='/?component=doc&dcat=<?=$_GET['dcat']?>&ditem=<?=$_GET['ditem']?>&delcom=<?=$comm['id']?>'"><img src="/<?=$theme?>images/cross.png" width="16" height="16" border="0" alt="del" title="удалить"/></a>
	</p>
	<?endif?>
</div>
<?endforeach;?>
<?if(!empty($message)):?><div class="message"><?=$message?></div><?endif?>
<form action="" method="post" id="comments" name="comments" onSubmit="return checkForm()">
	<input type="hidden" name="add-comm" value="1"/>
<?if ($user->get_property('userID')>0):?>
	<input type="hidden" name="login" value="1"/>
<?else:?>
	<input type="hidden" name="login" value="0"/>
Имя: <span>*</span><br/>
	<input type="text" name="name" value="" class="inputbox"/><br/>
Эл. почта: <span>*</span><br/>
	<input type="text" name="email" value="" class="inputbox"/><br/>
Веб-сайт:<br/>
	<input type="text" name="web" value="" class="inputbox"/><br/>
<?endif;?>
Текст комментария: <span>*</span><br/>
<textarea id="message" name="message" class="tinymce"></textarea><br/>

<?if ($user->get_property('userID')==0):?>
	<img src="/lib/capcha.php" alt="картинка" width="120" height="50"/><br/>
	Введите код с картинки: <span>*</span><br/>
	<input type="text" name="capcha" value="" class="inputbox"/><br/>
<?endif;?>
<input type="submit" class="button" value="Комментировать" style="width:150px;"/>
</form>
