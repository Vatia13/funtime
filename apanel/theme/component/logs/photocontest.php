<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php if(count($registry['contest']) > 0):?>
    <a href="<?=$_SERVER['REQUEST_URI'];?>&show=browser" style="font-size:20px;color:green;text-decoration:underline">მაჩვენე აიპები ბრაუზერის ინფორმაციით</a>
    <table width="100%" border="1">
        <tr>
            <th>კონკურსანტის ID</th><th>ვარსკვლავი</th><th>User Agent</th><th>IP მისამართი</th>
        </tr>
    <?php $star = 0; ?>
    <?php foreach($registry['contest'] as $item): ?>
        <tr>
            <td align="center"><?php echo $_GET['uid'];?></td>
            <td align="center"><?php echo $item['star']; $star = $star + $item['star'];?></td>
            <td>
               <?php $browser = unserialize(base64_decode($item['browser'])); //print_r($browser)?>
                <?php if($browser['browser_name_regex']):?>
                <b>ბრაუზერი</b> - <?php echo $browser['browser'];?><br>
                <b>ბრაუზერის ტიპი</b> - <?php echo $browser['browser_type'];?><br>
                <b>ბრაუზერის მარკა</b> - <?php echo $browser['browser_maker'];?><br>
                <b>მშობელი</b> - <?php echo $browser['parent'];?><br>
                <b>მოწყობილობის სახელი</b> - <?php echo $browser['device_name'];?><br>
                <b>მოწყობილობის ტიპი</b> - <?php echo $browser['device_type'];?><br>
                <b>მოწყობილობის კოდური სახელი</b> - <?php echo $browser['device_code_name'];?><br>
                <b>კომენტარი</b> - <?php echo $browser['comment'];?><br>
                <b>პლატფორმა</b> - <?php echo $browser['platform'];?><br>
                <b>პლატფორმის აღწერა</b> - <?php echo $browser['platform_description'];?><br>
                <b>პლატფორმის ბიტები</b> - <?php echo $browser['platform_bits'];?><br>
                <?php endif;?>
            </td>
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
