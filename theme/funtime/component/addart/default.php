<?defined('_JEXEC') or die('Restricted access');?>
<?if ($user->get_property('userID')>0 and $user->get_property('gid')>=18):?>

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
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup|,forecolor,backcolor",
			theme_advanced_buttons3 : "charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl",

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
<div class="news-center">
<div class="menu-top5">Добавить материал</div>
<?if(!empty($message[0])):?>
     <div class="<?=$message[0]?>_box">
	<?=$message[1]?>
     </div>
<?endif;?>
<div class="menu-body5" style="text-align:left">

<form method="post" action="" enctype="multipart/form-data"/>
<input type="hidden" name="event" value="article"/>
<input type="hidden" name="add" value="1"/>
<table>

<tr><td width="150">Заголовок: </td><td><input class="inputbox" type="text" name="title" value=""/></td></tr>
<tr><td>Теги: </td><td><input class="inputbox" type="text" name="tags" value=""/> <i>(через запятую)</i></td></tr>
<tr><td>Ссылка на первоисточник: </td><td><input class="inputbox" type="text" name="original_url" value=""/> <i>(пример: http://rche.ru)</i></td></tr>
<tr><td>Изображение для превью: </td><td><input class="inputbox" type="file" name="photo"/></td></tr>
<tr><td>Категория:</td><td>
<select name="cat" class="inputbox">
		<?foreach($registry['category_a'] as $cat):?>
			<?foreach($cat as $ca):?>
			<?if($ca['podcat']==0):?>
				<option value="<?=$ca['id']?>">- <?=$ca['name']?></option>
				<?else:?>
				<option value="<?=$ca['id']?>">--- <?=$ca['name']?></option>
				<?endif;?>
			<?endforeach;?>
		<?endforeach;?>
</select>
</td></tr>
<tr><td>Комментарии:</td><td><select name="comments" class="inputbox">
	<option value="1">Разрешить</option>
	<option value="0">Запретить</option>
	</select></td></tr>
</table>
Текст:<br/>
<textarea name="textarea1" id="textarea1" class="tinymce" style="width: 450px;height:200px;">Текст...</textarea><br/>
<input type="submit" value="Сохранить">
<br/>* материал будет опубликован после проверки модератором
</form>

</div>
</div>

<div class="news-center">
<div class="menu-top5">Ожидают модерации</div>
<div class="menu-body5" style="text-align:left">

<?if(count($registry['mynews'])>0):?>
		<table>
		<tr><td width="320" class="tab-cell-1">
			ID: Заголовок новости</td>
			<td class="tab-cell-1" width="150">Категория</td>
			<td class="tab-cell-1" width="150">Дата добавления</td>
			<td align="center"></td></tr>
		<?foreach($registry['mynews'] as $num):?>
			<tr><td width="320" class="tab-cell-1">
				<?=$num['id']?>: <a href="/com/addart/edit/<?=$num['id']?>" class="link4"><?=$num['title']?></a></td>
				<td class="tab-cell-1"><?=$num['name']?></td>
				<td class="tab-cell-1"><?=date('d-m-y h:m',$num['date'])?></td>
				<td align="center">
					<a href="/com/addart/edit/<?=$num['id']?>"><img src="/<?=$theme?>images/edit.png" width="16" height="16" border="0" alt="edit" title="редактировать"/></a>
					<a href="/com/addart/delete/<?=$num['id']?>"><img src="/<?=$theme?>images/cross.png" width="16" height="16" border="0" alt="del" title="удалить"/></a>
				</td></tr>
	        <?endforeach;?>
		</table>
<?else:?>
На модерации материала нет.
<?endif;?>
</div>
</div>

<?else:?>У вас нет прав для доступа в этот раздел. Авторизируйтесь пожалуйста.<?endif;?>