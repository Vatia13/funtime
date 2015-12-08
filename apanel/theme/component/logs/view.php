<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','tools','view')):?>
<h2>Просмотр события ID <?=$registry['logs'][0]['id']?></h2>
<?if (count($registry['logs'])>0):?>
    Дата: <?=date('d.m.Y H:i',$registry['logs'][0]['date'])?><br/>
    IP адрес: <?=$registry['logs'][0]['ip']?><br/>
    Пользователь: <?=$registry['logs'][0]['username']?> / <?=$registry['logs'][0]['realname']?><br/>
    Действие: <?=$registry['logs'][0]['desc']?><br/>
    
        <pre><?=$registry['logs'][0]['log']?></pre>

	<?else:?>
	Записи отсутствуют.
	<?endif;?>
<?endif;?>


