<?defined('_JEXEC') or die('Restricted access');?>
<?if ($user->get_property('userID')>0 OR $user->get_property('gid')>18):
	$id=intval($_GET['value']);
	$all = $DB->getAll('SELECT #__news.* FROM #__news WHERE #__news.id='.$id);
	if (count($all)>0):
		foreach($all as $num):
		if (!empty($num['thumbs']))://http://rche.ru/cms/images/1/100/100/1/83341552_ava.png
			$split=explode('/',$num['thumbs']);
			//$img_path='/images/'.$user->get_property('userID').'/blog/'.$avator_width_profile.'/'.$avator_height_profile.'/'.$avator_sc_profile.'/'.$split[4];
			$img_path='/images/news/prev/100/100/0/'.$split[5];
		endif;?>
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
<div class="menu-top5">Редактирование записи, <?=$num['title']?></div>
<?if(!empty($message[0])):?>
     <div class="<?=$message[0]?>_box">
	<?=$message[1]?>
     </div>
<?endif;?>
<div class="menu-body5" style="text-align:left">

		<form method="post" action="" enctype="multipart/form-data">
		<input type="hidden" name="event" value="article"/>
		<input type="hidden" name="update" value="1"/>
		<input type="hidden" name="id" value="<?=$num['id']?>"/>
		<table>
		<tr><td width="150">Заголовок: </td><td><input class="inputbox" type="text" name="title" value="<?=$num['title']?>"/></td></tr>
		<tr><td>Теги: </td><td><input class="inputbox" type="text" name="tags" value="<?=$num['tags_ru']?>"/> <i>(через запятую)</i></td></tr>
		<tr><td>Ссылка на первоисточник: </td><td><input class="inputbox" type="text" name="original_url" value="<?=$num['original_url']?>"/> <i>(пример: http://rche.ru)</i></td></tr>
		<tr><td>Изображение для превью:<br/><?if(!empty($img_path)):?><img src="<?=$img_path?>" alt="картинка превью" class="imgadm" width="<?=$avator_width_profile?>" height="<?=$avator_height_profile?>"/><?endif;?></td><td valign="top"><input class="inputbox" type="file" name="photo"/></td></tr>
		</td></tr>
		<tr><td>Категория:</td><td><select name="cat" class="inputbox">
		<?foreach($registry['category_a'] as $cat):?>
			<?foreach($cat as $ca):?>
			<?if($ca['podcat']==0):?>
				<option value="<?=$ca['id']?>" <?if($ca['id']==$num['cat']):?>selected<?endif;?>>- <?=$ca['name']?></option>
				<?else:?>
				<option value="<?=$ca['id']?>" <?if($ca['id']==$num['cat']):?>selected<?endif;?>>--- <?=$ca['name']?></option>
				<?endif;?>
			<?endforeach;?>
		<?endforeach;?>
		<?if ($num['show_date']==1) $shy=' selected'; else $shn=' selected';?>
		<?if ($num['comments']==1) $shy2=' selected'; else $shn2=' selected';?>
		<tr><td>Комментарии:</td><td><select name="comments" class="inputbox">
			<option value="1" <?=$shy2?>>Разрешить</option>
			<option value="0" <?=$shn2?>>Запретить</option>
		</select></td></tr>
		</table>
		Текст:<br/>
	<textarea name="textarea1" id="textarea1" class="tinymce" style="width: 450px;height:200px;"><?=$num['text']?></textarea><br/>
<input type="submit" value="Сохранить">
<br/>* материал будет опубликован после проверки модератором
</form>

<p><a href="/comm/addart/" class="link4"><< Назад</a></p>
</div>
</div>

		<?endforeach;?>
	<?else:?>Для редактирования записи перейдите в раздел "опубликовать новость", затем кликните "Редактировать".<?endif;?>
<?else:?>У вас нет прав для доступа в этот раздел. Авторизируйтесь пожалуйста.<?endif?>