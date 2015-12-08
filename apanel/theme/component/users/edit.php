<?defined('_JEXEC') or die('Restricted access');?>

<?if(!empty($message[0])):?>
     <div class="<?=$message[0]?>_box">
	<?=$message[1]?>
     </div>
<?endif;?>
<?if(get_access('admin','user','edit')):
	if (count($registry['edituser'])>0):
		foreach($registry['edituser'] as $num):?>

		<h2>პროფილის რედაქტირება</h2>

		<form method="post" action="" name="edituser" enctype="multipart/form-data"/>
		<input type="hidden" name="id" value="<?=$num['id']?>"/>
		<input type="hidden" name="event" value="users"/>
		<input type="hidden" name="update" value="1"/>



		<h2><?=$num['username']?></h2>
		<table class="formadd">
            <tr><td class="td1">ფოტო</td>
                <td>
                    <?if (generate_avatar_markup($num['id'],1)==''):
                        $img_path='<img src="/img/no_avatar.png" alt="" class="photo" width="100"/>';
                    else:
                        $img_path=generate_avatar_markup($num['id'],1);
                    endif;?>
                    <?=$img_path?>
                </td>
            </tr>
            <tr><td class="td1">მომხმარებელი</td><td><input type="text" name="username" value="<?=$num['username']?>" <?if($registry['onmy']==1):?>disabled<?endif;?>/></td></tr>
		    <tr><td class="td1">სახელი, გვარი</td><td><input type="text" name="realname" value="<?=$num['realname']?>"/></td></tr>
		    <?if($registry['onmy']<>1):?>
		    <tr><td class="td1">ჯგუფი</td><td><select name="group" >
			<?foreach($registry['group'] as $item):?>
                <?if($item['pungid'] == 1 && $user->get_property('gid') == 25):?>
				<option value="<?=$item['pungid']?>" <?if ($item['pungid']==$num['group_id']):?>selected<?endif?>><?=$item['name']?></option>
                <?else:?>
                    <option value="<?=$item['pungid']?>" <?if ($item['pungid']==$num['group_id']):?>selected<?endif?>><?=$item['name']?></option>
                <?endif;?>
			<?endforeach?>
			</select></td>
			</tr>
				<?else:?>
				<input type="hidden" name="group" value="<?=$num['group_id'];?>" />
			<?endif;?>
		    <tr><td class="td1">პაროლი</td><td><input  type="password" name="pwd" value=""/></td></tr>
		    <tr><td class="td1">გაიმეორე პაროლი</td><td><input  type="password" name="pwd2" value=""/></td></tr>
		    <tr><td class="td1">ელ-ფოსტა</td><td><input type="text" name="email" value="<?=$num['email']?>"/></td></tr>
		    <tr><td class="td1">ტელეფონი</td><td><input type="text" name="phone" value="<?=$num['phone']?>"/></td></tr>
		    <tr><td class="td1">ფოტო</td><td><input type="file" name="photo" /></td></tr>
            <tr><td class="td1"></td><td><a onclick="document.edituser.submit();" class="btn-green left">შენახვა</a></td></tr>
		</table>


</form>
<a href="index.php?component=users" class="back">&larr; უკან</a>
		<?endforeach;?>
	<?else:?>ჩანაწერები არ მოიძებნა.<?endif;?>
<?endif?>  
