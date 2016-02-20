<?php defined('_JEXEC') or die('Restricted access');
if (get_access('admin','competition','view')):
?>
<h3>ფოტო კონკურსში მონაწილეები</h3>
<table id="rounded-corner">
    <thead>
    <tr>
        <th scope="col" class="rounded-company">ID</th>
        <th scope="col" class="rounded">სახელი</th>
        <th scope="col" class="rounded">გვარი</th>
        <th scope="col" class="rounded">ასაკი</th>
        <th scope="col" class="rounded">ტელეფონი</th>
        <th scope="col" class="rounded">ip მისამართი</th>
        <th scope="col" class="rounded">დრო-თარიღი</th>
    </tr>
    </thead>
    <tbody>
    <?foreach($registry['competition'] as $item):?>
    <tr>
        <td><?=$item['ID'];?></td>
        <td><?=$item['fname'];?></td>
        <td><?=$item['lname'];?></td>
        <td><?=$item['age'];?></td>
        <td><?=$item['phone'];?></td>
        <td><?=$item['user_ip'];?></td>
        <td><?=$item['insert_date'];?></td>
    </tr>
    <?endforeach;?>
    </tbody>
</table>
<?php endif;?>