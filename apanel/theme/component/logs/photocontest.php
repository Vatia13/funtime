<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php if(count($registry['contest']) > 0):?>
    <table width="100%" border="1">
        <tr>
            <th>კონკურსანტის ID</th><th>ვარსკვლავი</th><th>IP მისამართი</th>
        </tr>
    <?php $star = 0; ?>
    <?php foreach($registry['contest'] as $item): ?>
        <tr>
            <td align="center"><?php echo $_GET['uid'];?></td>
            <td align="center"><?php echo $item['star']; $star = $star + $item['star'];?></td>
            <td align="center"><?php echo long2ip($item['ip']);?></td>
        </tr>
    <?php endforeach;?>
        <tr>
            <th></th>
            <th>სულ: <?php echo $star;?> ვარსკვლავი</th>
            <th>IP - რაოდენობა : <?php echo count($registry['contest']);?></th>
        </tr>
    </table>
<?php endif;?>
