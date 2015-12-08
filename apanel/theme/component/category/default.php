<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','category','view')):?>
    <?if(!empty($message[0])):?>
        <div class="<?=$message[0]?>_box">
            <?=$message[1]?>
        </div>
    <?endif;?>
	<?if (count($category)>0):?>
		<h2><?php if($_GET['sec'] == 'post'):?>რუბრიკები<?php else:?>კატეგორიები<?php endif;?></h2>
		<table id="rounded-corner">
		<thead>
		    	<tr>
		        <th scope="col" class="rounded-company"><?php if($_GET['sec'] == 'post'):?>რუბრიკა<?php else:?>კატეგორია<?php endif;?></th>
                    <th>სტატუსი</th>

		            <th scope="col" class="rounded<?if(!get_access('admin','category','del',false)):?>-q4<?endif?>">რედაქტირება</th>
			<?if(get_access('admin','category','del',false)):?>
		            <th scope="col" class="rounded-q4">წაშლა</th>
		        <?endif?>
		        </tr>
		</thead>
		<tfoot>
		    	<tr>
	        	<td colspan="<?if(!get_access('admin','category','del',false)):?>1<?else:?>2<?endif?>" class="rounded-foot-left">
			</td>
	        	<td class="rounded-foot-right">&nbsp;</td>
			</tr>
		</tfoot>
		<tbody>

		<?foreach($category as $cat):?>
			<?foreach($cat as $ca):?>
                   <?php if($ca['section'] == $_GET['sec']):?>
			<?if($ca['podcat']==0):?>
				<tr><td width="450">
				<img src="images/index.png" width="16" height="16" border="0" alt=""/>
				<?=$ca['name']?>
				</td>
                    <td align="center">
                        <?if($ca['stat'] == 1):?>
                            <a href="/apanel/index.php?component=category&cat=<?=$ca['id']?>&status=0"><img src="<?=$theme_admin?>images/error.png"></a>
                        <?else:?>
                            <a href="/apanel/index.php?component=category&cat=<?=$ca['id']?>&status=1"><img src="<?=$theme_admin?>images/success.png"></a>
                        <?endif;?>
                    </td>

				<td align="center"><a href="?component=category&section=edit&sec=<?php echo $ca['section'];?>&edit=<?=$ca['id']?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="" title="" border="0" /></a></td>

                    <?if(get_access('admin','category','del',false)):?>
				<td align="center"><a onclick="deleteCat(<?=$ca['id']?>,'<?=$ca['section']?>')" class="ask"><img src="<?=$theme_admin?>images/trash.png" alt="" title="" border="0" /></a></td>
				<?endif?>
				</tr>
				<?else:?>

				<tr><td>
				<img src="images/item.png" width="16" height="16" border="0" alt="" style="margin-left:15px;"/>
				<?=$ca['name']?>
				</td>
				<td align="center"><a href="?component=category&section=edit&sec=<?php echo $ca['section'];?>&edit=<?=$ca['id']?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="" title="" border="0" /></a></td>
				<?if(get_access('admin','category','del',false)):?>
				<td align="center"><a onclick="deleteCat(<?=$ca['id']?>,'<?=$ca['section']?>')" class="ask"><img src="<?=$theme_admin?>images/trash.png" alt="" title="" border="0" /></a></td>
				<?endif?>
				</tr>
				<?endif;?>
                    <?php endif;?>
			<?endforeach;?>
		<?endforeach;?>
		</tbody>
		</table>
	<?else:?>
	რუბრიკები არ მოიძებნა.
	<?endif;?>
<?endif;?>
<?if(get_access('admin','category','edit',false)):?>
<br/>

<form method="post" name="rubric" action="" />
<input type="hidden" name="event" value="category"/>
<input type="hidden" name="cat" value="<?php echo $_GET['sec'];?>"/>
<input type="hidden" name="add" value="1"/>
<table  class="formadd">
    <tr>
        <th><?php if($_GET['sec'] == 'post'):?>რუბრიკის დამატება<?php else:?>კატეგორიის დამატება<?php endif;?></th><?php if($_GET['sec'] == 'post'):?><th>ავტორები</th><?php endif;?>
    </tr>
    <tr>
        <td>
            <table>
                <?php if($_GET['sec'] == 'post'):?>
                <tr>
                    <td>საკნატუნო ამბები</td><td>
                        <select name="test">
                            <option value="0">არა</option>
                            <option value="1" <?if($_POST['test'] == 1):?>selected<?endif;?>>კი</option>

                        </select>
                    </td>
                </tr>
    <tr>
        <td>ფოტოკონკურსი</td>
        <td>
            <input type="checkbox" name="type" value="1" />
        </td>
    </tr>
                <tr>
                    <td>ბადის გარეშე</td>
                    <td>
                        <input type="checkbox" name="bade" value="1"/>
                    </td>
                </tr>
                <?endif;?>
                <tr><td><?php if($_GET['sec'] == 'post'):?>რუბრიკის დასახელებაა<?php else:?>კატეგორიის დასახელება<?php endif;?></td><td><input type="text" name="name" value=""/></td></tr>
                <tr><td>ბმული ლათინურად<br/><i>(ავტოგენერაცია)</i></td><td><input type="text" name="chpu" value=""/></td></tr>
            </table>
        </td>
        <?php if($_GET['sec'] == 'post'):?>
        <td valign="top">
            <? foreach($registry['authors'] as $author):?>
                <input type="checkbox" name="author[]" value="<?=$author['id']?>"/><?=$author['realname']?>
            <?endforeach;?>
        </td>
        <?php endif;?>
    </tr>
</table>

<a onclick="document.rubric.submit();" class="btn-green right">დამატება</a>
</form>
<?endif?>