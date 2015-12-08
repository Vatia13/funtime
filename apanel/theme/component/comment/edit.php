<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','comments','edit')):
	$id=intval($_GET['edit']);
	$all = $DB->getAll('SELECT #__comments.*, #__users.url,#__users.username, #__users.email as useremail 
			FROM #__comments
			LEFT JOIN #__users ON #__comments.user=#__users.id WHERE #__comments.id='.$id);
	if (count($all)>0):
		foreach($all as $num):?>
		<h2>Редактирование записи, ID <?=$num['id']?>: </h2>
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
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,images,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,images,cleanup,code,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl",

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

		<form method="post" action="?component=comment" enctype="multipart/form-data">
		<input type="hidden" name="event" value="comment"/>
		<input type="hidden" name="update" value="1"/>
		<input type="hidden" name="id" value="<?=$num['id']?>"/>
		<table width="800">
<tr><td width="200">Дата публикации: </td><td>
	<select name="date_dd">
	  <?for ($i=1;$i<=31;$i++):?>
		<?if ($i<10) $dddd='0';else $dddd='';?>
		<?if ($i==intval(date('d',$num['date'])) and empty($_POST['date_dd'])) $sel="selected"; else $sel="";?>
		<?if ($i==$_POST['date_dd']) $sel="selected";?>
		<option value="<?=$i?>" <?=$sel?>><?=$dddd.$i?></option>
	   <?endfor;?>
	</select>

	<select name="date_mm">
	  <?for ($i=1;$i<=12;$i++):?>
		<?if ($i<10) $dddd='0';else $dddd='';?>
		<?if ($i==intval(date('m',$num['date'])) and empty($_POST['date_mm'])) $sel="selected"; else $sel="";?>
		<?if ($i==$_POST['date_mm']) $sel="selected";?>
		<option value="<?=$i?>" <?=$sel?>><?=$dddd.$i?></option>
	   <?endfor;?>
	</select>

	<select name="date_yy">
	  <?for ($i=2011;$i<=2100;$i++):?>
		<?if ($i==date('Y',$num['date']) and empty($_POST['date_yy'])) $sel="selected"; else $sel="";?>
		<?if ($i==$_POST['date_yy']) $sel="selected";?>
		<option value="<?=$i?>" <?=$sel?>><?=$i?></option>
	  <?endfor;?>
	</select>
	<select name="time_hh">
	  <?for($t=0;$t<=23;$t++):?>
		<?if ($t<10) $dddd='0';else $dddd='';?>
		<?if ($t==intval(date('H',$num['date'])) and empty($_POST['time_hh'])) $sel="selected"; else $sel="";?>
		<?if ($t==$_POST['time_hh']) $sel="selected";?>
		<option value="<?=$t?>" <?=$sel?>><?=$dddd.$t?></option>
	  <?endfor;?>
	</select>
	<select name="time_mm">';
	  <?for($t=0;$t<=59;$t++):?>
		<?if ($t<10) $dddd='0';else $dddd='';?>
		<?if ($t==intval(date('m',$num['date'])) and empty($_POST['time_mm'])) $sel="selected"; else $sel="";?>
		<?if ($t==$_POST['time_mm']) $sel="selected";?>
		<option value="<?=$t?>" <?=$sel?>><?=$dddd.$t?></option>
	  <?endfor;?>
	</select></td></tr>
<tr><td width="200">Имя пользователя: </td><td><?if(intval($num['user'])>0):?><?=$num['username']?><?else:?><?=$num['name']?><?endif?></td></tr>
<tr><td width="200">E-Mail пользователя: </td><td><?if(intval($num['user'])>0):?><?=$num['useremail']?><?else:?><?=$num['email']?><?endif?></td></tr>
<tr><td width="200">Web Url: </td><td><?if(intval($num['user'])==0):?><?=$num['web']?><?else:?><?=$num['url']?><?endif?></td></tr>
</table>

<textarea name="message" class="tinymce" id="textarea1" style="width: 600px;height:300px;"><?=html_entity_decode($num['message'])?></textarea>
<input type="submit" value="Сохранить">
</form>
		<?endforeach;?>
	<?else:?><?endif;?>
<?endif?>
<p><a href="index.php?component=article"><< Назад</a></p>