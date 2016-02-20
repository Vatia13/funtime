<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php if(get_access('admin','stat','view',false) or in_array($user->get_property('username'),array('statistika','mkevlishvili'))):?>
    <?php statistic_directory();?>
    <div class="statistics"><a href="/apanel/index.php?component=statistic" <?if(!$_GET['section']):?>class="active_s"<?endif;?>>რუბრიკები</a><a href="/apanel/index.php?component=statistic&section=authors" <?if($_GET['section'] == 'authors' or $_GET['author'] > 0):?>class="active_s"<?endif;?>>ავტორები</a><a href="/apanel/index.php?component=statistic&section=post" <?if($_GET['section'] == 'post' && !$_GET['author']):?>class="active_s"<?endif;?>>სტატიები</a></a>
        <form action="" method="post" name="rubric_filter">
            <input type="text" name="from" value="<?if($_POST['from']){echo $_POST['from'];}else{ echo $_GET['from'];}?>" placeholder="დან" class="calendar input_80"/>
            <input type="text" name="to" value="<?if($_POST['to']){echo $_POST['to'];}else{ echo $_GET['to'];}?>" placeholder="მდე" class="calendar input_80"/>
            <select name="options">
                <option value="views" <?if(($_COOKIE['options'] == 'views' and empty($_POST['options'])) or $_POST['options']=='views'):?>selected<?endif;?>>საერ.ჩვენების მიხედვით</option>
                <option value="uniquev" <?if(($_COOKIE['options'] == 'uniquev' and empty($_POST['options'])) or $_POST['options']=='uniquev'):?>selected<?endif;?>>უნიკ.ჩვენების მიხედვით</option>
            </select>
            <select name="sort">
                <option value="desc" <?if(($_COOKIE['sort'] == 'desc' and empty($_POST['sort'])) or $_POST['sort']=='desc'):?>selected<?endif;?>>კლებადობით</option>
                <option value="asc" <?if(($_COOKIE['sort'] == 'asc' and empty($_POST['sort'])) or $_POST['sort']=='asc'):?>selected<?endif;?>>ზრდადობით</option>
            </select>
            <select name="stat">
                <option value="active" <?if(($_COOKIE['stat'] == 'active' and empty($_POST['stat'])) or $_POST['stat']=='active'):?>selected<?endif;?>>აქტიური</option>
                <option value="passive" <?if(($_COOKIE['stat'] == 'passive' and empty($_POST['stat'])) or $_POST['stat']=='passive'):?>selected<?endif;?>>პასიური</option>
            </select>
            <input type="submit" name="filter" value="ფილტრი" class="btn-green" style="border:none;position:relative;top:-2px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php  
		foreach($registry['post'] as $item):
		$sum_uniq= $sum_uniq + $item['uniquev'];
		endforeach;?> 
            <input type="text" placeholder="სულ: <?=$sum_uniq?>" readonly>
         </form> 
        
    </div>
    <table id="rounded-corner">
        <thead>
        <tr>
            <th scope="col" class="rounded">№</th>
            <th scope="col" class="rounded">ავტორი</th>
            <th scope="col" class="rounded">სათაური</th>
            <th scope="col" class="rounded">რუბრიკა</th>
            <th scope="col" class="rounded">საერთო ჩვენება</th>
            <th scope="col" class="rounded">უნიკ.ჩვენება</th>
        </tr>
        </thead>
        <tbody>
        <?php if(count($registry['post']) > 0): $i=0; foreach($registry['post'] as $item): $i++;?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $item['realname']?></td>
                <td><?php echo $item['title']?></td> 
                <td><?php echo $item['name']?></td>
                <td><?php if(empty($item['views'])): echo "---"; else: echo $item['views']; endif;?></td>
                <td><?php if(empty($item['uniquev'])): echo "---"; else: echo $item['uniquev']; endif;?></td>
            </tr>
        <?php endforeach;?>
        <?php endif;?>
        </tbody>
    </table>
    <?if ($total>1) echo '<center><div class="pagination" style="margin-bottom:10px; margin-top:10px;">'
        .$pervpage.$page2left.$page1left.'<span class="">'.$page.'</span>'.$page1right.$page2right
        .$nextpage.'</div></center>';?>
<?php endif;?>
