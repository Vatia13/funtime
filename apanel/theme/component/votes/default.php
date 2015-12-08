<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','vote','view')):?>
	<?if (count($all)>0):?>
<?if(!empty($message[0])):?>
     <div class="<?=$message[0]?>_box">
	<?=$message[1]?>
     </div>
<?endif;?>

<h2>Опросы</h2>

<form method="post" action="?component=votes&section=edit"/>
<input type="hidden" name="update" value="1"/>

	<table id="rounded-corner">
	<thead>
	    	<tr>
	        <th scope="col" class="rounded-company">ID</th>
	            <th scope="col" class="rounded">Заголовок опроса</th>
	            <th scope="col" class="rounded">Активный опрос</th>
	            <th scope="col" class="rounded<?if(!get_access('admin','vote','del')):?>-q4<?endif?>">Ред.</th>
	            <?if(get_access('admin','vote','del')):?><th scope="col" class="rounded-q4">Удалить</th><?endif?>
	        </tr>
	</thead>
	<tfoot>
	    	<tr>
        	<td colspan="<?if(!get_access('admin','vote','del')):?>3<?else:?>4<?endif?>" class="rounded-foot-left">
		</td>
        	<td class="rounded-foot-right">&nbsp;</td>
		</tr>
	</tfoot>
	<tbody>
	<?foreach($all as $num):?>
		<tr>
			<td>
			<?=$num['id']?>
			</td>
			<td width="300"><a href="?component=votes&section=edit&edit=<?=$num['id']?>" class="news-url"><?=$num['name']?></a></td>
			<td align="center">
				<?if($num['select']==1):?><img src="<?=$theme_admin?>images/valid.png" width="16" height="16" alt="" title="" border="0" />
				<?else:?><a href="?component=votes&activ=<?=$num['id']?>">Активировать</a><?endif?></td>
			<td align="center"><a href="?component=votes&section=edit&edit=<?=$num['id']?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="" title="" border="0" /></a></td>
			<?if(get_access('admin','vote','del')):?><td align="center"><a href="?component=votes&delete=<?=$num['id']?><?if(!empty($_GET['page'])):?>&page=<?=$_GET['page']?><?endif?>" class="ask"><img src="<?=$theme_admin?>images/trash.png" alt="" title="" border="0" /></a></td><?endif?>
			</td></tr>
        <?endforeach;?>
	</tbody>
	</table>
	<?else:?>Опросы отсутствуют. Вы можете добавить новые опросы.<?endif;?>

<a href="?component=votes&section=add" class="bt_green"><span class="bt_green_lft"></span><strong>Добавить</strong><span class="bt_green_r"></span></a>

<?endif?>
