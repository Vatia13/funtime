<?defined('_JEXEC') or die('Restricted access');?>
<?
if ($user->get_property('userID')==1 OR $user->get_property('gid')==25):

	$all = $DB->getAll('SELECT * FROM #__links WHERE id='.intval($_GET['id']));
?>

<?if (count($all)>0):?>
	<h2>Редактирование записи ID: <?=$all[0]['id']?></h2>
	<?foreach($all as $num):?>

<form method="post" action="index.php?component=links" enctype="multipart/form-data"/>
	<input type="hidden" name="event" value="links"/>
	<input type="hidden" name="linktype" value="<?=$num['type']?>"/>
	<input type="hidden" name="update" value="1"/>
	<input type="hidden" name="id" value="<?=$num['id']?>"/>
	<table class="formadd">

	<tr><td class="td1">Блок:</td><td>
	<select name="block" class="inputbox">
		<option value="1" <?if($num['block']==1):?>selected<?endif;?>>Реклама на главной внизу</option>
		<option value="2" <?if($num['block']==2):?>selected<?endif;?>>Реклама в объявлениях</option>
		<option value="3" <?if($num['block']==3):?>selected<?endif;?>>Реклама в статьях</option>
		<option value="4" <?if($num['block']==4):?>selected<?endif;?>>Реклама в сайдбаре</option>
	</select>
	</td></tr>

	<?if($num['type']==1):?>
	<tr><td class="td1">Текст ссылки</td><td><input class="inputbox" type="text" style="width:170px;" name="ankor" value="<?=$num['ankor']?>"/></td></tr>
	<tr><td class="td1">Ссылка</td><td><input class="inputbox" type="text" style="width:170px;" name="url" value="<?=$num['url']?>"/></td></tr>
	<tr><td class="td1">noindex</td><td><input type="checkbox" name="noindex" value="1" <?if($num['noindex']==1):?>checked<?endif;?>/></td></tr>
	<tr><td class="td1">nofollow</td><td><input type="checkbox" name="nofollow" value="1" <?if($num['nofollow']==1):?>checked<?endif;?>/></td></tr>
	<tr><td class="td1">Показывать</td><td><input type="checkbox" name="show" value="1" <?if($num['show']==1):?>checked<?endif;?>/></td></tr>
	<?endif;?>
	<?if($num['type']==2):?>
	<tr><td class="td1">Изображение<br/><img src="<?=$num['photo']?>" width="200"/></td><td><input class="inputbox" type="file" style="width:170px;" name="photo"/></td></tr>
	<tr><td class="td1">Ссылка</td><td><input class="inputbox" type="text" style="width:170px;" name="url" value="<?=$num['url']?>"/></td></tr>
	<tr><td class="td1">noindex</td><td><input type="checkbox" name="noindex" value="1" <?if($num['noindex']==1):?>checked<?endif;?>/></td></tr>
	<tr><td class="td1">nofollow</td><td><input type="checkbox" name="nofollow" value="1" <?if($num['nofollow']==1):?>checked<?endif;?>/></td></tr>
	<tr><td class="td1">Показывать</td><td><input type="checkbox" name="show" value="1" <?if($num['show']==1):?>checked<?endif;?>/></td></tr>
	<?endif;?>
	<?if($num['type']==3):?>
	<tr><td class="td1">HTML код</td><td><textarea name="html"  style="width:300px;height:100px;"><?=$num['ankor']?></textarea></td></tr>
	<tr><td class="td1">Показывать</td><td><input type="checkbox" name="show" value="1" <?if($num['show']==1):?>checked<?endif;?>/></td></tr>
	<?endif;?>
	<tr><td><input type="submit" value="Сохранить" /></td></tr>
	</table></form>
	<?endforeach;?>
<?else:?>Запись отсутствует.<?endif;?>
<p><a href="index.php?component=links"><< Назад</a></p>
<?else:?>
	У вас нет прав для доступа в этот раздел. Авторизируйтесь пожалуйста.
<?endif;?>