<?php defined('_JEXEC') or die('Restricted access'); ?>
<h3>ბანერები</h3>
<?if(get_access('admin','banners','view')):?>
    <table id="rounded-corner">
        <thead>
        <tr>
            <th align="left" class="rounded">ID</th>
            <th align="left" class="rounded">პოზიცია</th>
            <th align="left" class="rounded">ზომა</th>
            <?if(get_access('admin','banners','edit')):?>
            <th class="rounded" >რედ</th>
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
                  <?endif;?>
              </tr>
          <?endforeach;?>
        </tbody>
    </table>

<?endif;?>
