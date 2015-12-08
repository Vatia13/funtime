<?defined('_JEXEC') or die('Restricted access');?>

<?if(!empty($message[0])):?>
     <div class="<?=$message[0]?>_box">
	<?=$message[1]?>
     </div>
<?endif;?>
<?if(get_access('admin','user','edit')):?>

<?if($message[0]=='valid'):?>
	<a href="?component=users">ყველა მომხმარებელი</a><br/>
	<a href="?component=users&section=add">მომხმარებლის დამატება</a><br/>
<?else:?>
		<h2>მომხმარებლის დამატება: </h2>

		<form method="post" action="" name="adduser" enctype="multipart/form-data"/>

		<input type="hidden" name="event" value="users"/>
		<input type="hidden" name="add" value="1"/>

		<table class="formadd">
		<tr><td class="td1">მომხმარებელი</td><td><input type="text" name="login" value="<?=$_POST['login']?>"/></td></tr>
		<tr><td class="td1">სახელი, გვარი</td><td><input type="text" name="realname" value="<?=$_POST['realname']?>"/></td></tr>
		<tr><td class="td1">ჯგუფი</td><td><select name="group" >
			<?foreach($registry['group'] as $item):?>
				<option value="<?=$item['pungid']?>" <?if ($item['pungid']==$num['group_id']):?>selected<?endif?>><?=$item['name']?></option>
			<?endforeach?>
		</select></td></tr>
		<tr><td class="td1">პაროლი</td><td><input type="password" name="pwd" value=""/></td></tr>
		<tr><td class="td1">გაიმეორე პაროლი</td><td><input  type="password" name="pwd2" value=""/></td></tr>
		<tr><td class="td1">ელ-ფოსტა</td><td><input type="text" name="email" value="<?=$_POST['email']?>"/></td></tr>
		<tr><td class="td1">ტელეფონი</td><td><input type="text" name="phone" value="<?=$_POST['phone']?>"/></td></tr>
        <tr><td class="td1"><a href="index.php?component=users" class="back">&larr; ყველა მომხმარებელი</a></td><td> <a onclick="document.adduser.submit();" class="btn-green left">დამატება</a></td></tr>
		</table>


</form>
<?endif;?>
<?endif?>
