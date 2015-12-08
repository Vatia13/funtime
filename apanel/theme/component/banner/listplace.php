<?php defined('_JEXEC') or die('Restricted access'); ?>
<?if(get_access('admin','banners','view')):?>
<h4>საბანერო ადგილები</h4>
<table id="rounded-corner">
    <thead>
    <tr>
        <th scope="col" class="rounded-company">ID</th>
        <th scope="col" class="rounded">დასახელება</th>
        <th scope="col" class="rounded">ზომა</th>
        <th scope="col" class="rounded">კატეგორია</th>
        <th scope="col" class="rounded-q4"/>
    </tr>
    </thead>
    <tbody>
    <?if(count($registry['banners']) > 0):?>
        <?foreach($registry['banners'] as $item):?>
            <tr>
                <td><?=$item['id'];?></td>
                <td><?=$item['title'];?></td>
                <td><?=$item['size_x'];?>X<?=$item['size_y'];?></td>
                <td><? if($item['cat_id'] == 1):?>პირველი გვერდი<?elseif($item['cat_id']==2):?>ტესტები<?else:?><?=$item['name'];?><?endif;?></td>
                <td align="center" class="option_icons">
            <?if(get_access('admin','banners','edit')):?>
                    <a href="/apanel/index.php?component=banner&section=editplace&edit=<?=$item['id'];?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="რედაქტირება" title="რედაქტირება" border="0" /></a>

                    <a onclick="confDel(<?=$item['id'];?>)"><img src="<?=$theme_admin?>images/trash.png" alt="წაშლა" title="წაშლა" border="0" /></a>
            <?endif;?>
                </td>
            </tr>
        <?endforeach;?>
    <?endif;?>
    </tbody>
</table>
<?if ($total>1) echo '<center><div class="pagination" style="margin-bottom:10px; margin-top:10px;">'
    .$pervpage.$page2left.$page1left.'<span class="">'.$page.'</span>'.$page1right.$page2right
    .$nextpage.'</div></center>';?>
<script>
    function confDel(id){
        var del = confirm('ნამდვილად გსურთ საბანერო პოზიცია #' + id + ' წაშლა?');
        if(del == true){
            window.location.href = '/apanel/index.php?component=banner&place='+id;
        }
    }
</script>
<?endif;?>