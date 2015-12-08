<?php defined('_JEXEC') or die('Restricted access');
if (get_access('admin','winners','view')):
?>
<h3>გამარჯვებულები</h3>
<table id="rounded-corner">
    <thead>
    <tr>
        <th scope="col" class="rounded-company">ID</th>
        <th scope="col" class="rounded">სახელი, გვარი</th>
        <th scope="col" class="rounded">ტელეფონი</th>
        <th scope="col" class="rounded">თარიღი</th>
    </tr>
    </thead>
    <tbody>
    <?foreach($registry['winners'] as $item):?>
    <tr>
        <td><?=$item['id'];?></td>
        <td><?=$item['name'];?></td>
        <td><?=$item['phone'];?></td>
        <td><?=$item['date'];?></td>
    </tr>
    <?endforeach;?>
    </tbody>
</table>
    <?if ($total>1) echo '<center><div class="pagination" style="margin-bottom:10px; margin-top:10px;">'
    .$pervpage.$page2left.$page1left.'<span class="">'.$page.'</span>'.$page1right.$page2right
    .$nextpage.'</div></center>';?>
<?php endif;?>