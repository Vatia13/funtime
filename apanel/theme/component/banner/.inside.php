<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="/apanel/index.php" method="get">
    <table class="formadd" width="100%">
        <tbody>
        <tr>
            <td>სტატუსი</td>
            <td>
                <input type="hidden" value="banner" name="component"/>
                <input type="hidden" value="all" name="ban"/>
                <?if(isset($_GET['page'])):?>
                    <input type="hidden" value="<?=$_GET['page'];?>" name="page"/>
                <?endif;?>

                <select name="status">
                    <option value="">---</option>
                    <option value="1" <?if($_GET['status'] == 1):?>selected<?endif;?>>თავისუფალი</option>
                    <option value="2" <?if($_GET['status'] == 2):?>selected<?endif;?>>დაკავებული</option>
                </select>
            </td>

            <td>რუბრიკა</td>
            <td>
                <select name="cat" class="input_150">
                    <option value="">აირჩიეთ რუბრიკა</option>
                    <option value="1" <?if($_GET['cat'] == 1):?>selected<?endif;?>>მთავარი გვერდი</option>
                    <option value="2" <?if($_GET['cat'] == 2):?>selected<?endif;?>>ტესტები</option>
                    <option value="3" <?if($_GET['cat'] == 3):?>selected<?endif;?>>ვიქტორინა</option>
                    <option value="4" <?if($_GET['cat'] == 4):?>selected<?endif;?>>თავსატეხი</option>
                    <?foreach($category as $cat):?>
                        <?foreach($cat as $ca):?>
                            <?if($ca['podcat']==0):?>
                                <option value="<?=$ca['id']?>" <?if($ca['id']==$_GET['cat']):?>selected<?endif;?>>- <?=$ca['name']?></option>
                            <?else:?>
                                <option value="<?=$ca['id']?>" <?if($ca['id']==$_GET['cat']):?>selected<?endif;?>>--- <?=$ca['name']?></option>
                            <?endif;?>
                        <?endforeach;?>
                    <?endforeach;?>
                </select>
            </td>
            <td>თარიღი</td>
            <td><input type="text" name="from" value="<?=$_GET['from'];?>" placeholder="დან" class="calendar"/></td>
            <td><input type="text" name="to" value="<?=$_GET['to'];?>" placeholder="მდე" class="calendar"/></td>
            <td>კომპანია</td>
            <td>
                <input type="text" value="<?=$_GET['company'];?>" name="company"/>
            </td>
            <td width="35%" align="right">საკონტაქტო (პირი / ტელეფნი / ელ.ფოსტა)</td>
            <td><input type="text" name="person" value="<?=$_GET['person'];?>" /></td>
           <td>
                <input type="submit" name="filter"  value="გაფილტვრა" class="btn-green" style="border:none"/>
            </td>
            <td width="50%"></td>
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
    <?if(count($registry['banners']) > 0): $ready = array();?>
        <?foreach($registry['banners'] as $item): $info = unserialize($item['info']);?>
                <tr <?if(strtotime($item['finished_at']) > time() && $item['status'] == 2):?>class="table_green"<?elseif(strtotime($item['finished_at']) > time() && $item['status'] == 1):?>class="table_orange"<?else:?>class="table_grey"<?endif;?>>
                    <td><?if(!empty($item['company'])):?><?=$item['company'];?><?else:?><a href="/apanel/index.php?component=banner&section=add&cat=<?=$item['cat_id'];?>&title=<?=$item['title'];?>" style="width:100%;height:24px;display:block;"></a><?endif;?></td>
                    <td><?if(!empty($info)):?><?=$info['banner'];?><?else:?><a href="/apanel/index.php?component=banner&section=add&cat=<?=$item['cat_id'];?>&title=<?=$item['title'];?>" style="width:100%;height:24px;display:block;"></a><?endif;?></td>
                    <td><?=$item['title'];?></td>
                    <td><?=$item['size_x'];?>X<?=$item['size_y'];?></td>
                    <td><? if($item['cat_id'] == 1):?>პირველი გვერდი<?elseif($item['cat_id']==2):?>ტესტები<?else:?><?=$item['name'];?><?endif;?></td>
                    <td><?if(strtotime($item['published_at']) > 0 and $item['type'] > '0') :?><?=date('Y-m-d',strtotime($item['published_at']));?><?endif;?></td>
                    <td><?if(strtotime($item['finished_at']) > 0 and $item['type'] > '0') :?><?=date('Y-m-d',strtotime($item['finished_at']));?><?endif;?></td>
                    <td align="center" class="option_icons">
                        <?if($item['status'] > 0):?>
                            <?if(get_access('admin','banners','edit')):?>
                                <a href="/apanel/index.php?component=banner&cat=<?=$_GET['cat']?>&section=edit&edit=<?=$item['id'];?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="რედაქტირება" title="რედაქტირება" border="0" /></a>

                                <a onclick="confirmDelete(<?=$item['id'];?>)"><img src="<?=$theme_admin?>images/trash.png" alt="წაშლა" title="წაშლა" border="0" /></a>
                            <?endif;?>
                        <?else:?>
                            <a href="/apanel/index.php?component=banner&section=add&cat=<?=$item['cat_id'];?>&title=<?=$item['title'];?>">დამატება</a>
                        <?endif;?>
                    </td>
                </tr>
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
        var del = confirm('ნამდვილად გსურთ საბანერო პოზიცია #' + id + ' წაშლა?');
        if(del == true){
            window.location.href = '/apanel/index.php?component=banner&del='+id;
        }
    }
</script>