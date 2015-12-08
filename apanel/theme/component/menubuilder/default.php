<?php defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','tools','view')):?>
<h2>Конструктор меню</h2>
<div class="message"><?=$message;?></div>
	<?if (count($registry['allmenu'])>0):?>
		<table id="rounded-corner">
		<thead>
		    	<tr>
		        <th scope="col" class="rounded-company">Название меню</th>
		        <th scope="col" class="rounded">Команда вызова</th>
		            <th scope="col" class="rounded<?if(!get_access('admin','tools','del',false)):?>-q4<?endif?>">Ред.</th>
			<?if(get_access('admin','tools','del',false)):?>
		            <th scope="col" class="rounded-q4">Удалить</th>
		        <?endif?>
		        </tr>
		</thead>
		<tfoot>
		    	<tr>
	        	<td colspan="<?if(!get_access('admin','tools','del',false)):?>2<?else:?>3<?endif?>" class="rounded-foot-left">
			</td>
	        	<td class="rounded-foot-right">&nbsp;</td>
			</tr>
		</tfoot>
		<tbody>

		<?foreach($registry['allmenu'] as $ca):?>
				<tr>
				<td width="350"><?=$ca['name']?></td>
				<td><?=$ca['comand']?></td>
				<td align="center"><a href="?component=menubuilder&section=edit&edit=<?=$ca['id']?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="" title="" border="0" /></a></td>
				<?if(get_access('admin','tools','del',false)):?>
				<td align="center"><a href="?component=menubuilder&delete=<?=$ca['id']?>" class="ask"><img src="<?=$theme_admin?>images/trash.png" alt="" title="" border="0" /></a></td>
				<?endif?>
				</tr>
		<?endforeach;?>
		</tbody>
		</table>
	<?else:?>
	Меню отсутствуют. Вы можете добавить новые меню.
	<?endif;?>
<a href="?component=menubuilder&section=add" class="bt_green"><span class="bt_green_lft"></span><strong>Добавить</strong><span class="bt_green_r"></span></a>
<br/><br/><br/>
<p>* Для вставки меню в HTML шаблон сайта используйте команду: &lt;?php get_menu('name_menu'); ?&gt;</p>
<?endif?>