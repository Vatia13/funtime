<?php defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','tools','view')):?>
<h2>Парсер курса валют</h2>

<?if(!empty($message[0])):?>
     <div class="<?=$message[0]?>_box">
	<?=$message[1]?>
     </div>
<?endif;?>

<table class="tablelinks">
	<tr><td width="120" class="row"><b>Сокращение</b></td>
	<td width="200" class="row"><b>Единиц</b></td>
	<td width="120" class="row"><b>Текущее значение</b></td></tr>
<?foreach($cbr as $cur):?>
	<tr><td><?=$cur['name']?></td><td><?=$cur['value']?></td><td style="color:<?if(strpos('se'.$cur['difference'],'+')):?>green<?elseif(strpos('se'.$cur['difference'],'-')):?>red<?else:?>black<?endif?>"><?=$cur['difference']?></td></tr>
<?endforeach;?>
</table>
<form method="post" action="">
	<input name="cbr" type="hidden" value="1"/>
	<input name="reload" type="hidden" value="1"/>
	<input name="submit" type="submit" value="Обновить"/>
</form>
<br/><br/>
<h2>Cсылка для запуска через Cron-Tab</h2>
<input type="text" class="inputbox" style="width:500px" value="<?echo 'http://'.$_SERVER['HTTP_HOST'];?>/com/parserfincron/default/startparsercbr876/"/>
<?endif;?>