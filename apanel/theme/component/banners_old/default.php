<?php defined('_JEXEC') or die('Restricted access'); ?>

<h3 class="left">ბანერები</h3>
<a href="/apanel/index.php?component=banners&section=add" class="btn-green right" >+ ბანერის დამატება რუბრიკაზე</a>
<?if(get_access('admin','banners','view')):?>
    <br><br><br><br>
    <form action="" method="post">
        <select name="banner_cat">
            <option value="">ყველა</option>
            <option value="1" <? echo ($_POST['banner_cat'] == 1) ? 'selected' : '';?>>ძირითადი</option>
            <option value="2" <? echo ($_POST['banner_cat'] == 2) ? 'selected' : '';?>>რუბრიკებში</option>
        </select>
        <input type="submit" name="submit" value="გაფილტვრა" class="btn"/>
    </form>
    <br>
    <table id="rounded-corner">
        <thead>
        <tr>
            <th align="left" class="rounded">ID</th>
            <th align="left" class="rounded">პოზიცია</th>
            <th align="left" class="rounded">ზომა</th>
            <?if(get_access('admin','banners','edit')):?>
            <th class="rounded" >რედ</th>
            <th class="rounded" >წაშლა</th>
            <?endif;?>
        </tr>
        </thead>
        <tbody>
          <?foreach($registry['banners'] as $item):?>
              <tr>
                   <td class="tab-cell-1"><?=$item['id'];?></td>
                  <td><a href="/apanel/index.php?component=banners&section=edit&edit=<?=$item['id'];?>" <?if($item['date'] <= time()):?>style="color:red;"<?endif;?>><?=$item['position'];?></a></td>
                  <td><?=$item['width'];?>x<?=$item['height'];?></td>
                  <?if(get_access('admin','banners','edit')):?>
                  <td align="center"><a href="/apanel/index.php?component=banners&section=edit&edit=<?=$item['id'];?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="რედაქტირება" title="რედაქტირება" border="0" /></a></td>

                  <td align="center"><?if($item['cat_id'] > 0):?><a href="/apanel/index.php?component=banners&banner=del&del=<?=$item['id'];?>"><img src="<?=$theme_admin?>images/trash.png" alt="წაშლა" title="წაშლა" border="0" /></a> <?endif;?></td>

                  <?endif;?>
              </tr>
          <?endforeach;?>
        </tbody>
    </table>

<?endif;?>
