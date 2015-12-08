<?defined('_JEXEC') or die('Restricted access');?>
<div id="image_size">

</div>

<?if(get_access('admin','setting','view')):?>
<?if(!empty($message[0])):?>
     <div class="<?=$message[0]?>_box">
	<?=$message[1]?>
     </div>
<?endif;?>

<style>
.inputbox {
	width:300px;
	color:#555;
	font:12px tahoma;
}
select.inputbox {
	width:100px;
}
textarea.inputbox {
	height:70px;
}
</style>

<form method="post" action="" enctype="multipart/form-data"/>
<input type="hidden" name="event" value="setting"/>
<input type="hidden" name="update" value="1"/>

<h2>პარამეტრები</h2>
<table class="formadd">
		<tr><td class="td1">საიტის სათაური</td>
		<td>
		<input class="inputbox" type="text" name="site_title" value="<?=$registry['site_title']?>"/></td>
		</td>
        </tr>
		<tr><td class="td1">სტატუსი</td>
		<td>
		<select name="site_power" class="inputbox">
			<option value="1" <?if($registry['site_power']==1):?>selected<?endif?>>ჩართული</option>
			<option value="0" <?if($registry['site_power']==0):?>selected<?endif?>>გამორთული</option>
		</select>
		</td>

		<tr><td class="td1">შეტყობინება გამორთულზე</td>
		<td>
		<textarea name="site_ofmess" class="inputbox"><?=$registry['site_ofmess']?></textarea>
		</td>
        <tr>
        <td class="td1">Header ფოტო (1920x150)</td>
        <td>
            <input type="text" name="header_img" id="header_img" onChange="get_image_size('<?if($_POST['header_img']):?><?=$_POST['header_img'];?><?else:?><?=$registry['header_img'];?><?endif;?>',this);" value="<?if($_POST['header_img']):?><?=$_POST['header_img'];?><?else:?><?=$registry['header_img'];?><?endif;?>"/>
            <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=f511422113d2vedc5c426b7y14cby679&field_id=header_img" class="btn-blue iframe-btn" >აირჩიეთ ფოტო</a></td>
        </tr>
    <td class="td1">ჰოროსკოპი ფოტო</td>
    <td>
        <input type="text" name="horo_img" id="horo_img"  value="<?if($_POST['horo_img']):?><?=$_POST['horo_img'];?><?else:?><?=$registry['horo_img'];?><?endif;?>"/>
        <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=f511422113d2vedc5c426b7y14cby679&field_id=horo_img" class="btn-blue iframe-btn" >აირჩიეთ ფოტო</a></td>
    </tr>
		<tr><td class="td1">Rss რაოდენობა</td>
		<td>
		<select name="site_rssnum" class="inputbox" >
			<option value="5" <?if($registry['site_rssnum']==5):?>selected<?endif?>>5</option>
			<option value="10" <?if($registry['site_rssnum']==10):?>selected<?endif?>>10</option>
			<option value="15" <?if($registry['site_rssnum']==15):?>selected<?endif?>>15</option>
			<option value="25" <?if($registry['site_rssnum']==25):?>selected<?endif?>>25</option>
			<option value="50" <?if($registry['site_rssnum']==50):?>selected<?endif?>>50</option>
			<option value="100" <?if($registry['site_rssnum']==100):?>selected<?endif?>>100</option>
		</select>
		</td>
</table>
<!--
<span class="title-table">მომხმარებლების რეგისტრაცია</span>
<table class="formadd">
		<tr><td class="td1">Разрешить регистрацию пользователей</td>
		<td>
		<select name="user_register" class="inputbox">
			<option value="1" <?if($registry['user_register']==1):?>selected<?endif?>>Да</option>
			<option value="0" <?if($registry['user_register']==0):?>selected<?endif?>>Нет</option>
		</select>
		</td>

		<tr><td class="td1">Разрешить регистрацию Риэлтеров</td>
		<td>
		<select name="user_realty" class="inputbox">
			<option value="1" <?if($registry['user_realty']==1):?>selected<?endif?>>Да</option>
			<option value="0" <?if($registry['user_realty']==0):?>selected<?endif?>>Нет</option>
		</select>
		</td>

		<tr><td class="td1">მომხმარებლის აქტივაცია</td>
		<td>
		<select name="user_active" class="inputbox">
			<option value="1" <?if($registry['user_active']==1):?>selected<?endif?>>კი</option>
			<option value="0" <?if($registry['user_active']==0):?>selected<?endif?>>არა</option>
		</select>
		</td>
</table>
-->


<table class="formadd">
		<tr><td class="td1">&lt;META&gt; Description</td>
		<td>
		<textarea name="site_metadesc" class="inputbox"><?=$registry['site_metadesc']?></textarea>
		</td>

		<tr><td class="td1">&lt;META&gt; Keywords</td>
		<td>
		<textarea name="site_metakey" class="inputbox"><?=$registry['site_metakey']?></textarea>
		</td>
</table>


<table class="formadd">
		<tr><td class="td1">დახმარების ცენტრის ელ-ფოსტა</td>
		<td>
		<input class="inputbox" type="text" name="emailsup" value="<?=$registry['emailsup']?>"/></td>
		</td>
        </tr>
		<tr><td class="td1">ადმინისტრატორის ელ-ფოსტა</td>
		<td>
		<input class="inputbox" type="text" name="email_admin" value="<?=$registry['email_admin']?>"/></td>
		</td>
       </tr>
</table>



<input type="submit" value="შენახვა" />
</form>

<?endif;?>

