<?php defined('_JEXEC') or die('Restricted access'); ?>
<script>
	function ban_onchange(){
		document.getElementById("btn").click(); 
		}
	function ref(vl){
		var element = document.getElementById('slctbox');
		element.value = vl;
		ban_onchange();
		}
</script>
<h3 class="left">ბანერები</h3>
<a href="/apanel/index.php?component=banners&section=add" class="btn-green right" >+ ბანერის დამატება რუბრიკაზე</a>
<?if(get_access('admin','banners','view')):?>
    <br><br><br><br>
    <form action="" method="post" id="ban_onch">
        <select name="banner_cat" onChange="ban_onchange()" id="slctbox">
            <option value="0" id="active">ყველა</option>
            <option value="1" <?if($_SESSION['banner_cat'] == 1):?>selected<?endif;?>>მთავარი გვერდი</option>
            <option value="2" <?if($_SESSION['banner_cat'] == 2):?>selected<?endif;?>>ტესტები</option>
            <option value="3" <?if($_SESSION['banner_cat'] == 3):?>selected<?endif;?>>ვიქტორინა</option>
            <option value="4" <?if($_SESSION['banner_cat'] == 4):?>selected<?endif;?>>თავსატეხი</option>
            <?foreach($category as $cat):?>
                <?foreach($cat as $ca):?>
                    <?if($ca['podcat']==0):?>
                        <option value="<?=$ca['id']?>" <?if($ca['id']==$_SESSION['banner_cat']):?>selected<?endif;?>>- <?=$ca['name']?></option>
                    <?else:?>
                        <option value="<?=$ca['id']?>" <?if($ca['id']==$_SESSION['banner_cat']):?>selected<?endif;?>>--- <?=$ca['name']?></option>
                    <?endif;?>
                <?endforeach;?>
            <?endforeach;?>
        </select>
        <input style="display:none;"  type="submit" name="submit" value="გაფილტვრა" class="btn" id="btn"/>
        <input type="button" name="button" value="გასუფთავება" class="btn" onClick="ref(0)"/>
    </form>
    <br>
    <table id="rounded-corner">
        <thead>
        <tr>
            <th align="left" class="rounded">ID</th>
            <th align="left" class="rounded">რუბრიკა</th>
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
                  <td class="tab-cell-1"><?=$item['name'];?></td>
                  <td><?=$item['width'];?>x<?=$item['height'];?></td>
                  <?if(get_access('admin','banners','edit')):?>
                  <td align="center"><a href="/apanel/index.php?component=banners&section=edit&edit=<?=$item['id'];?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="რედაქტირება" title="რედაქტირება" border="0" /></a></td>

                  <td align="center"><?if($item['cat_id'] > 0):?><a href="/apanel/index.php?component=banners&banner=del&del=<?=$item['id'];?>"><img src="<?=$theme_admin?>images/trash.png" alt="წაშლა" title="წაშლა" border="0" /></a> <?endif;?></td>

                  <?endif;?>
              </tr>
          <?endforeach;?>
        </tbody>
    </table>
    <?if ($total>1) echo '<center><div class="pagination" style="margin-bottom:10px; margin-top:10px;">'
        .$pervpage.$page2left.$page1left.'<span class="">'.$page.'</span>'.$page1right.$page2right
        .$nextpage.'</div></center>';?>
<?endif;?>
