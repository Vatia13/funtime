<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','user','view')):?>

<div class="message"><?=$message?></div>

	<?if (count($all)>0):?>
	<h2>მომხმარებლები</h2>
        <a href="?component=users&section=add" class="btn-green right"><strong>+</strong> დამატება</a>
        <table id="rounded-corner">
		<thead>
		    	<tr>
		        <th scope="col" class="rounded-company">ID</th>
		            <th scope="col" class="rounded">მომხმარებელი</th>
                    <th scope="col" class="rounded">სახელი, გვარი</th>
		            <th scope="col" class="rounded">ჯგუფი</th>
					<th scope="col" class="rounded">ფოტოს ატვირთვა</th>
                    <th scope="col" class="rounded">სტატუსი</th>
		            <th scope="col" class="rounded<?if(!get_access('admin','user','del',false)):?>-q4<?endif?>">რედაქტირება</th>
		            <?if(get_access('admin','user','del',false)):?><th scope="col" class="rounded-q4">წაშლა</th><?endif?>
		        </tr>
		</thead>
		<tfoot>
		    	<tr>
	        	<td colspan="<?if(!get_access('admin','user','del',false)):?>3<?else:?>4<?endif?>" class="rounded-foot-left">
			    </td>
                <td></td>
                <td></td>
	        	<td class="rounded-foot-right">&nbsp;</td>
			</tr>
		</tfoot>
		<tbody>
		<?foreach($all as $num): if($num['id'] != 696):?>
			<tr>
				<td>
				<?=$num['id']?>
				</td>
				<td><a href="?component=users&section=edit&edit=<?=$num['id']?>" class="news-url"><?=$num['username']?></a></td>
                <td><?=$num['realname']?></td>

				<td><img src="images/<?if($num['gid']==25):?>useradmin<?elseif($num['gid']==0):?>usera<?else:?>user<?endif;?>.png" width="16" height="16" border="0" alt="<?=$num['name']?>" title="<?=$num['name']?>" style="margin-right:10px;"/>
					<?if($num['gid']==0):?><a href="?component=users&activ=<?=$num['id']?>" title="გააქტიურება"><?endif?><?=$num['name']?><?if($num['gid']==0):?></a><?endif?></td>

                <?if(get_access('admin','user','edit',false)):?>
					<td align="center">
						<?if($registry['onmy']<=0):?>
						<?if($num['show_img'] == 1):?>
							<a href="<?=$_SERVER['REQUEST_URI'];?>&user=<?=$num['id']?>&show_img=0"><img src="<?=$theme_admin?>images/success.png"></a>
						<?else:?>
							<a href="<?=$_SERVER['REQUEST_URI'];?>&user=<?=$num['id']?>&show_img=1"><img src="<?=$theme_admin?>images/error.png"></a>
						<?endif;?>
						<?endif;?>
					</td>
                <td align="center">
					<?if($registry['onmy']<=0):?>
                    <?if($num['status'] == 1):?>
                        <a href="/apanel/index.php?component=users&user=<?=$num['id']?>&status=0"><img src="<?=$theme_admin?>images/error.png"></a>
                    <?else:?>
                        <a href="/apanel/index.php?component=users&user=<?=$num['id']?>&status=1"><img src="<?=$theme_admin?>images/success.png"></a>
                    <?endif;?>
					<?endif;?>
                </td>
                <?endif;?>

				<td align="center"><a href="?component=users&section=edit&edit=<?=$num['id']?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="" title="" border="0" /></a></td>
				<?if(get_access('admin','user','del',false)):?><td align="center"><a onclick="deleteUser(<?=$num['id']?>,'<?=$num['realname']?>','<?=$num['name']?>')" class="ask"><img src="<?=$theme_admin?>images/trash.png" alt="" title="" border="0" /></a></td><?endif?>
				</td></tr>
	        <?endif;endforeach;?>
		</tbody>
	</table>
	<?if ($total>1) echo '<p><div class="pagination" style="margin-bottom:10px; margin-top:10px;">'
		.$pervpage.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right
		.$nextpage.'</div></p>';?>

	<?else:?>მომხმარებელი არ მოიძებნა.
	<?endif;?>


<?endif;?>
