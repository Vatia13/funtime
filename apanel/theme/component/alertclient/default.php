<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','alert','view')):?>

<?@include('.sort.php');?>
	<?if (count($registry['clients'])>0):?>
		<h2>Напоминания о клиентах</h2>
		<table id="rounded-corner">
		<thead>
		    	<tr>
		        <th scope="col" class="rounded-company">ID</th>
		        <th scope="col" class="rounded">Город</th>
		        <th scope="col" class="rounded">Ф.И.О</th>
		        <th scope="col" class="rounded">Телефон</th>
		        <th scope="col" class="rounded">Дата с</th>
		        <th scope="col" class="rounded">Дата по</th>
		        <th scope="col" class="rounded">Статус</th>
	            	<th scope="col" class="rounded-q4"></th>
		        </tr>
		</thead>
		<tfoot>
		    	<tr>
	        	<td colspan="7" class="rounded-foot-left"></td>
	        	<td class="rounded-foot-right">&nbsp;</td>
			</tr>
		</tfoot>
		<tbody>

		<?foreach($registry['clients'] as $item):?>
			<tr><td><?=$item['id']?></td>
			<td><?=$item['city_name_ru']?></td>
			<td><?=$item['fio']?></td>
			<td><?=$item['phone']?></td>
			<td><?if(!empty($item['date1'])):?><?=date('d.m.Y',$item['date1'])?><?else:?>-- -- ---<?endif?></td>
			<td><?if(!empty($item['date2'])):?><?=date('d.m.Y',$item['date2'])?><?else:?>-- -- ---<?endif?></td>
			<td><?if($item['status']==1):?>В поиске<?else:?>Снял<?endif?></td>
			<td align="center"><a href="?component=alertclient&section=edit&value=<?=$item['id']?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="" title="" border="0" /></a>
			<?if(get_access('admin','alert','del',false)):?>
			<a href="?component=alertclient&delete=<?=$item['id']?>" class="ask"><img src="<?=$theme_admin?>images/trash.png" alt="" title="" border="0" /></a></td>
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
<a href="?component=alertclient&section=add" class="bt_green"><span class="bt_green_lft"></span><strong>Добавить</strong><span class="bt_green_r"></span></a>
<?endif;?>
