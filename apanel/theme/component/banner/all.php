<?php defined('_JEXEC') or die('Restricted access'); ?>
<h3>ყველა ბანერი</h3>
<form action="/apanel/index.php" method="get">
<table class="formadd" width="100%">
    <tbody>
    <tr>
        <td>
            <input type="hidden" value="banner" name="component"/>
            <input type="hidden" value="all" name="section"/>
            <select name="status">
                <option value="">სტატუსი</option>
                <option value="1">თავისუფალი</option>
                <option value="2">დაკავებული</option>
            </select>
        </td>
        <td>
            <input type="submit" name="გაფილტვრა" class="btn-green" style="border:none"/>
        </td>
    </tr>
    </tbody>
</table>
</form>
<table id="rounded-corner">
    <thead>
    <tr>
        <th scope="col" class="rounded">კომპანიის დასახელება</th>
        <th scope="col" class="rounded">ბანერის დასახელება</th>
        <th scope="col" class="rounded">პოზიცია</th>
        <th scope="col" class="rounded">ზომა</th>
        <th scope="col" class="rounded">კატეგორია</th>
        <th scope="col" class="rounded">ჩართვის თარიღი</th>
        <th scope="col" class="rounded">გამორთვის თარიღი</th>
        <th scope="col" class="rounded"></th>
    </tr>
    </thead>
    <tbody>
    <?if(count($registry['new_banners']) > 0): ?>
        <?foreach($registry['new_banners'] as $s): foreach($s as $key=>$item): $info = unserialize($item['info']);

            if($_GET['status'] == '2'){
                $banner_status = $item['status'] == '2';
            }

            if($_GET['status'] == '0' or $_GET['status'] == '1'){
                $banner_status = $item['status'] < '2';
            }
            if(!isset($_GET['status'])){
                $banner_status = $item['status'] >= '0';
            }
            ?>
            <?if($banner_status):?>
                <tr <?if(strtotime($item['finished_at']) > time() && $item['status'] == 2):?>class="table_green"<?elseif(strtotime($item['finished_at']) > time() && $item['status'] == 1):?>class="table_orange"<?else:?>class="table_grey"<?endif;?>>
                    <td><?if(!empty($item['company'])):?><?=$item['company'];?><?else:?><a href="/apanel/index.php?component=banner&section=add&cat=<?=$item['cat_id'];?>&title=<?=$item['title'];?>" style="width:100%;height:24px;display:block;"></a><?endif;?></td>
                    <td><?if(!empty($info)):?><?=$info['banner'];?><?else:?><a href="/apanel/index.php?component=banner&section=add&cat=<?=$item['cat_id'];?>&title=<?=$item['title'];?>" style="width:100%;height:24px;display:block;"></a><?endif;?></td>
                    <td><?=$item['title'];?></td>
                    <td><?=$item['size_x'];?>X<?=$item['size_y'];?></td>
                    <td><? if($item['cat_id'] == 1):?>პირველი გვერდი<?elseif($item['cat_id']==2):?>ტესტები<?else:?><?=$item['name'];?><?endif;?></td>
                    <td><?if($item['published_at'] != $item['finished_at']):if(strtotime($item['published_at']) > 0) :?><?=date('Y-m-d',strtotime($item['published_at']));?><?endif;endif;?></td>
                    <td><?if($item['published_at'] != $item['finished_at']):if(strtotime($item['finished_at']) > 0) :?><?=date('Y-m-d',strtotime($item['finished_at']));?><?endif;endif;?></td>

                    <td align="center" class="option_icons">
                        <?if($item['status'] > 0):?>
                        <?if(get_access('admin','banners','edit')):?>
                            <a href="/apanel/index.php?component=banner&section=edit&edit=<?=$item['id'];?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="რედაქტირება" title="რედაქტირება" border="0" /></a>

                            <a onclick="confirmDelete(<?=$item['id'];?>)"><img src="<?=$theme_admin?>images/trash.png" alt="წაშლა" title="წაშლა" border="0" /></a>
                        <?endif;?>
                            <?else:?>
                    <a href="/apanel/index.php?component=banner&section=add&cat=<?=$item['cat_id'];?>&title=<?=$item['title'];?>">დამატება</a>
                    <?endif;?>
                    </td>
                </tr>
            <?endif;?>
        <?endforeach;?>
        <?endforeach;?>
    <?else:?>
        <tr><td colspan="6">ამ რუბრიკაზე არცერთი საბანერო პოზიცია არ მოიძებნა.</td></tr>
    <?endif;?>
    </tbody>
</table>
<?if ($total>1) echo '<center><div class="pagination" style="margin-bottom:10px; margin-top:10px;">'
    .$pervpage.$page2left.$page1left.'<span class="">'.$page.'</span>'.$page1right.$page2right
    .$nextpage.'</div></center>';?>
<script>
    function confirmDelete(id){
        var del = confirm('ნამდვილად გსურთ გაყიდული ადგილი #' + id + ' წაშლა?');
        if(del == true){
            window.location.href = '/apanel/index.php?component=banner&del='+id;
        }
    }
</script>