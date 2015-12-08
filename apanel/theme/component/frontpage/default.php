<?defined('_JEXEC') or die('Restricted access');?>
<? if($user->get_property('userID')==1 OR $user->get_property('gid')<=26):?>

    <h2>სტატიები</h2>
<?if($_GET['msg'] > 0){
        if($_GET['msg'] == 1){
            echo '<div class="valid_box">სტატია წარმატებით გაიგზავნა რედაქტორთან.</div>';
        }elseif($_GET['msg'] == 2){
            echo '<div class="valid_box">სტატია წარმატებით გაიგზავნა სტილისტ-კორექტორთან.</div>';
        }elseif($_GET['msg'] == 3){
            echo '<div class="valid_box">სტატია წარმატებით გაიგზავნა ადმინისტრატორთან.</div>';
        }else{
            echo '<div class="valid_box">სტატიის რედაქტირება წარმატებით დასრულდა.</div>';
        }
    }
?>
    <form method="post" name="post_filter">
    <table class="formadd" width="100%">
        <thead>
        <tr>
            <th align="left">რუბრიკები</th>
            <th align="left">თარიღი</th>
            <th align="left"></th>
            <?if($user->get_property('gid') !== 18):?>
            <th align="left">სტატუსი</th>
            <th align="left">ავტორი</th>
            <?endif;?>
            <th align="left"></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <select name="filter-cat" onchange="regUpen(this);windowPath('?news=1');">
                    <option value="">ყველა რუბრიკა</option>
                    <?foreach($category as $cat):?>
                        <?foreach($cat as $ca):?>
                            <?if($ca['podcat']==0):?>
                                <option value="<?=$ca['id']?>" <?if(($ca['id']==$_COOKIE['filter-cat'] and empty($_POST['filter-cat'])) or $ca['id']==$_POST['filter-cat']):?>selected<?endif;?>>- <?=$ca['name']?></option>
                            <?else:?>
                                <option value="<?=$ca['id']?>" <?if(($ca['id']==$_COOKIE['filter-cat'] and empty($_POST['filter-cat'])) or $ca['id']==$_POST['filter-cat']):?>selected<?endif;?>>--- <?=$ca['name']?></option>
                            <?endif;?>
                        <?endforeach;?>
                    <?endforeach;?>
                </select>
            </td>

            <td>
                <input type="text" name="from" value="<?if(isset($_COOKIE['from']) or !empty($_COOKIE['from'])):?><?=$_COOKIE['from'];?><?else:?><?=$_POST['from'];?><?endif;?>" class="calendar input_80" placeholder="დან"/>
            </td>
            <td>
                <input type="text" name="to" value="<?if(isset($_COOKIE['to']) or !empty($_COOKIE['to'])):?><?=$_COOKIE['to'];?><?else:?><?=$_POST['to'];?><?endif;?>" class="calendar input_80" placeholder="მდე"/>
            </td>
            <?if($user->get_property('gid') !== 18):?>
            <td>
                <select name="status" onchange="regUpen(this);windowPath('?news=1');">
                    <option value="">ყველა</option>
                    <option value="1" <?if((1==$_COOKIE['status'] and empty($_POST['status'])) or 1==$_POST['status']):?>selected<?endif;?>>გამოქვეყნებული</option>
                    <option value="4" <?if((4==$_COOKIE['status'] and empty($_POST['status'])) or 4==$_POST['status']):?>selected<?endif;?>>გარედაქტირებული</option>
                    <option value="2" <?if((2==$_COOKIE['status'] and empty($_POST['status'])) or 2==$_POST['status']):?>selected<?endif;?>>შენახული</option>
                    <option value="3" <?if((3==$_COOKIE['status'] and empty($_POST['status'])) or 3==$_POST['status']):?>selected<?endif;?>>გასარედაქტირებელი</option>
                </select>
            </td>

            <td>
                <select name="author" onchange="regUpen(this);windowPath('?news=1');">
                    <option value="">ყველა</option>
                    <?php foreach($registry['authors'] as $author): ?>
                    <option value="<?=$author['id'];?>" <?if(($author['id']==$_COOKIE['author'] and empty($_POST['author'])) or $author['id']==$_POST['author']):?>selected<?endif;?>><?=$author['realname'];?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <?endif;?>
            <td>
                <a class='btn' onclick="clearAll(['filter-cat','from','to','status','author','mzaval']);windowPath('?news=1');">გაწმენდა</a>
            </td>
            <td width="<?if($user->get_property('gid') == 18 or ($user->get_property('gid') == 22)):?>60%<?else:?>40%<?endif;?>">
                <?if($user->get_property('gid') != 23):?>
                <a href="?component=article&section=add" class="btn-green right"><strong>+</strong> დამატება</a>
                <?endif;?>
            </td>
        </tr>
        </tbody>
    </table>
    </form>
	<? if(count($all)>0):?>
		<table id="rounded-corner">
		<thead>
		    	<tr>
		        <th scope="col" class="rounded-company">ID</th>
                    <th scope="col" class="rounded">სათაური</th>
		            <th scope="col" class="rounded">რუბრიკა</th>
                    <th scope="col" class="rounded">ავტორი</th>
		            <th scope="col" class="rounded">თარიღი</th>
                    <th scope="col" class="rounded">გადახედვა</th>
		            <th scope="col" class="rounded-q4"></th>
		        </tr>
		</thead>
		<tbody>
		<?foreach($all as $num): $gr = unserialize($num['group']);?>
			<tr><td class="tab-cell-1"><?=$num['id']?></td>
                <td>
                    <a href="?component=article&section=edit&edit=<?=$num['id']?>" class="news-url <?if($num['favorit']==1):?>bold<?endif;?>"
                    <?if($num['moderate']==4):?>
                        style="color:#041d6d;"
                    <?else:?>
                    <?if($num['moderate'] == 3):?>style="<?if(in_array('23',$gr) && ($user->get_property('gid') == 22 or $user->get_property('gid') == 21)):?>color:darkorchid;<?else:?>color:red;<?endif;?>"<?endif;?>
                    <?if($num['moderate'] == 2):?>style="<?if(in_array('23',$gr) && ($user->get_property('gid') == 22 or $user->get_property('gid') == 21)):?>color:darkorchid;<?else:?>color:#ffec64;<?endif;?>"<?endif;?>
                    <?if($num['moderate']==1):?>style="color:green"<?endif;?>
                    <?endif;?>
                    <?if($num['favorit']==1):?>title="მთავარი სტატია"<?endif;?>><?=$num['title']?></a>

                </td>
				<td class="tab-cell-1">
                    <?if($num['podcat']>0):?>
						<?foreach($category as $cat):?>
						<?if($cat[0]['id']==$num['podcat']):?><?=$cat[0]['name']?><?endif?>
						<?endforeach?>
						>> 
						<?endif;?>
						<?=$num['name']?>
                </td>
                <td>
                    <?=$num['realname']?>
                </td>
				<td class="tab-cell-1"><?=date('d-m-y H:i',$num['date'])?></td>
                <td class="tab-cell-1" align="center"><img src="<?=$theme_admin;?>images/eye-icon.png" onclick="return window.open('http://funtime.ge/<?=$num['cat_chpu'];?>/<?=$num['chpu'];?>/', 'Print News', 'height=850,width=1250');" width="24"></td>
				<td align="center" width="100" class="option_icons">
            <?if($user->get_property('gid')!=18 && $num['moderate'] !=1):?>
                    <?if($num['user_block']<=0):?>
                        <a onclick="block_article(this,<?=$user->get_property('userID');?>,<?=$num['id']?>)"><img src="<?=$theme_admin?>images/open.png" alt="ბლოკირება" title="ბლოკირება" width="21" border="0" /></a>
                    <?else:?>

                        <a onclick="unblock_article(this,<?=$user->get_property('userID');?>,<?=$num['id']?>)"><img src="<?=$theme_admin?>images/locked.png" alt="ბლოკის მოხსნა" title="ბლოკის მოხსნა" width="21" border="0" /></a>

                    <?endif;?>
            <?endif;?>
            <?if(get_access('admin','article','edit',false)):?>
                <?if($num['user_block'] > 0){?>
                <? if($num['user_block'] == $user->get_property('userID')){?>
                <a href="/apanel/index.php?component=article&section=edit&edit=<?=$num['id'];?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="რედაქტირება" title="რედაქტირება" border="0" /></a>
                <?}?>
                <?}else{?>
                <a href="/apanel/index.php?component=article&section=edit&edit=<?=$num['id'];?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="რედაქტირება" title="რედაქტირება" border="0" /></a>
                <?}?>
            <?endif;?>
            <?if(get_access('admin','article','del',false)):?>
                <?if($num['user_block'] > 0){?>
                <? if($num['user_block'] == $user->get_property('userID')){?>
				<a onclick="deletePost(<?=$num['id'];?>)"><img src="<?=$theme_admin?>images/trash.png" alt="წაშლა" title="წაშლა" border="0" /></a>
                <?}?>
                <?}else{?>
                    <a onclick="deletePost(<?=$num['id'];?>)" class="ask"><img src="<?=$theme_admin?>images/trash.png" alt="წაშლა" title="წაშლა" border="0" /></a>
                <?}?>
            <?endif;?>
                </td>

				</tr>

	        <?endforeach;?>
		    </tbody>
		</table>
        <?if ($total>1) echo '<center><div class="pagination" style="margin-bottom:10px; margin-top:10px;">'
            .$pervpage.$page2left.$page1left.'<span class="">'.$page.'</span>'.$page1right.$page2right
            .$nextpage.'</div></center>';?>

	<?else:?>
        <p>სტატიები არ მოიძებნა.</p>
	<?endif?>


<?else:?>


<?endif?>