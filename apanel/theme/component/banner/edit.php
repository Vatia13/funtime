<?php defined('_JEXEC') or die('Restricted access'); ?>
<?if(get_access('admin','banners','edit')):?>
<?php if($registry['count_orders'] > 0):?>
    <div class="info_box">ყურადღება! მსგავსი შეთავაზება გაგზავნილია კიდევ <?=$registry['count_orders'];?> კომპანიასთან.</div>
<?endif;?>
    <h3>საბანერო ადგილი</h3>
<?if(!empty($message[0])):?>
    <div class="<?=$message[0]?>_box">
        <?if(count($validator) > 0):?>
            <ul>
                <?for($i=0;$i<count($validator);$i++):?>
                    <li><?=$validator[$i]?></li>
                <?endfor;?>
            </ul>
        <?else:?>
            <?=$message[1];?>
        <?endif;?>
    </div>
<?endif;?>
<?php include('.form.php'); ?>
<?endif;?>