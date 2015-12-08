<? defined('_JEXEC') or die('Restricted access'); ?>
<?if(get_access('admin','tests','view')):?>
<h2 class="left">ტესტები</h2><a href="/apanel/index.php?component=test&section=add" class="btn-green right">+ ტესტის დამატება</a>
<table id="rounded-corner">
    <thead>
         <th class="rounded-company">ID</th>
         <th>სათაური</th>
         <th>ტიპი</th>
         <th>შეავსო</th>
         <th>კითხვა</th>
         <th>ქულა</th>
         <th>თარიღი</th>
         <?if(get_access('admin','tests','edit',false)):?>
         <th>სტატუსი</th>
         <th>რედ.</th>
         <?endif;?>
         <th>წაშლა</th>
    </thead>
    <tbody>
         <?if(count($registry['tests']) > 0):?>
             <? foreach($registry['tests'] as $item): $csum = 0;?>
                 <tr>
                 <?
                 $qnum = unserialize($item['question']); $qnum = count($qnum);
                 $sum = unserialize($item['point']);
                 foreach($sum as $su){
                     $csum = $csum + max($su);
                 }
                 ?>
                 <td align="center"><?=$item['id'];?></td><td><a href="/com/test/view/<?=$item['id'];?>" target="_blank"><?=$item['title'];?></a></td><td><? echo ($item['type'] == 1) ? "ვიქტორინა" : "ტესტი";?></td><td><?=$item['done'];?></td><td><?=$qnum;?></td><td><?=$csum;?></td>
                 <td><?=date('d/m/Y',$item['date']);?></td>
                     <?if(get_access('admin','tests','edit',false)):?>
                     <?if($item['status'] == 0):?>
                     <td align="center"><a href="/apanel/index.php?component=test&value=<?=$item['id']?>&status=1"><img src="<?=$theme_admin?>images/module_key_plus.png" alt="გამორთვა" title="გამორთვა" border="0" /></a></td>
                     <?else:?>
                         <td align="center"><a href="/apanel/index.php?component=test&value=<?=$item['id']?>&status=0"><img src="<?=$theme_admin?>images/module_key_min.png" alt="ჩართვა" title="ჩართვა" border="0" /></a></td>
                     <?endif;?>
                 <?endif;?>
                 <?if(get_access('admin','tests','edit',false)):?>
                 <td align="center"><a href="/apanel/index.php?component=test&section=edit&edit=<?=$item['id'];?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="რედაქტირება" title="რედაქტირება" border="0" /></a></td>
                 <?endif;?>
                 <?if(get_access('admin','tests','del',false)):?>
                 <td align="center"><a onclick="deleteTest(<?=$item['id'];?>)"><img src="<?=$theme_admin?>images/trash.png" alt="წაშლა" title="წაშლა" border="0" /></a></td>
                 <?endif;?>
                 </tr>
             <?endforeach;?>
         <?endif;?>
    </tbody>
    <tfoot>

    </tfoot>
</table>
<?endif;?>