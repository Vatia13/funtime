<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','tools','view')):?>

<?if (count($registry['logs'])>0):?>
		<h2>Просмотр логов</h2>
		<table id="rounded-corner">
		<thead>
		    	<tr>
		        <th scope="col" class="rounded-company">ID</th>
		        <th scope="col" class="rounded">Дата</th>
                        <th scope="col" class="rounded">Логин</th>
                        <th scope="col" class="rounded">Действие</th>
			<?if(get_access('admin','tools','del',false)):?>
		            <th scope="col" class="rounded-q4" width="30"></th>
		        <?endif?>
		        </tr>
		</thead>
		<tfoot>
		    	<tr>
	        	<td colspan="<?if(!get_access('admin','tools','del',false)):?>3<?else:?>4<?endif?>" class="rounded-foot-left"></td>
	        	<td class="rounded-foot-right">&nbsp;</td>
			</tr>
		</tfoot>
		<tbody>

		<?foreach($registry['logs'] as $item):?>
			<tr><td><?=$item['id']?></td>
			<td><?=date('d.m.Y H:i',$item['date'])?></td>
                        <td><?=$item['username']?><br/><small><?=$item['realname']?><br/><?=$item['ip']?></small></td>
                        <td><a href="index.php?component=logs&section=view&value=<?=$item['id']?>"><?=$item['desc']?></a></td>
			<?if(get_access('admin','tools','del',false)):?>
			<td align="center"><a href="?component=logs&delete=<?=$item['id']?>" class="ask"><img src="<?=$theme_admin?>images/trash.png" alt="" title="" border="0" /></a></td>
			<?endif?>
			</tr>
		<?endforeach;?>
		</tbody>
		</table>

<?if ($total>1) echo '<center><div class="pagenation" style="margin-bottom:10px; margin-top:10px;">'
	.$pervpage.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right
	.$nextpage.'</div></center>';?>

	<?else:?>
	Записи отсутствуют.
	<?endif;?>
<?endif;?>
