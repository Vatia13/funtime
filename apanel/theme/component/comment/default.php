<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','comments','view')):?>

<?if(!empty($_GET['status'])):?>
     <div class="<?=$_GET['status']?>_box">
	<?if($_GET['t']==1):?>Запись успешно добавлена.<?endif;?>
	<?if($_GET['t']==2):?>Запись успешно обновлена.<?endif;?>
	<?if($_GET['t']==3):?>Запись удалена.<?endif;?>
	<?if($_GET['t']==4):?>Запись одобрена и опубликована.<?endif;?>
     </div>
<?endif;?>

<div class="message"><?=$message;?></div>
		<h2>Комментарии</h2>
	<?if (count($all)>0):?>
		<table id="rounded-corner">
		<thead>
		    	<tr>
		        <th scope="col" class="rounded-company">ID: Комментарий</th>
		            <th scope="col" class="rounded">Запись</th>
		            <th scope="col" class="rounded">Дата</th>
		            <th scope="col" class="rounded<?if(!get_access('admin','comments','del')):?>-q4<?endif?>">Ред.</th>
		            <?if(get_access('admin','comments','del')):?><th scope="col" class="rounded-q4">Удалить</th><?endif?>
		        </tr>
		</thead>
		<tfoot>
		    	<tr>
	        	<td colspan="<?if(!get_access('admin','comments','del')):?>3<?else:?>4<?endif?>" class="rounded-foot-left">
			</td>
	        	<td class="rounded-foot-right">&nbsp;</td>
			</tr>
		</tfoot>
		<tbody>
		<?foreach($all as $num):?>
			<tr><td width="320" class="tab-cell-1">
				<?=$num['id']?>: <?=html_entity_decode($num['message'])?></td>
				<td class="tab-cell-1"><a href="/doc/<?=$num['cat_chpu']?>/<?=$num['chpu']?>.html"><?=$num['title']?>/<?=$num['name']?></a></td>
				<td class="tab-cell-1"><?=date('d-m-y h:m',$num['date'])?></td>
				<td align="center">
				<a href="?component=comment&section=edit&edit=<?=$num['id']?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="" title="" border="0" /></a></td>
				</td>
				<?if(get_access('admin','comments','del')):?><td align="center"><a href="?component=comment&delete=<?=$num['id']?>" class="ask"><img src="<?=$theme_admin?>images/trash.png" alt="" title="" border="0" /></a></td><?endif?>
				</tr>
	        <?endforeach;?>
		    </tbody>
		</table>

<?if ($total>1) echo '<p><div class="pagination" style="margin-bottom:10px; margin-top:10px;">'
	.$pervpage.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right
	.$nextpage.'</div></p>';?>

	<?else:?>
		<div class="massage">Запись отсутствуют. Вы можете добавить новую запись.</div>
        <?endif;?>
<?endif;?>
