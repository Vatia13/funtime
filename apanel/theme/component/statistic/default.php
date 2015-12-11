<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php if(get_access('admin','stat','view',false) or in_array($user->get_property('username'),array('statistika','mkevlishvili'))):?>

<?php statistic_directory();?>

    <div class="statistics"><a href="/apanel/index.php?component=statistic" <?if(!$_GET['section']):?>class="active_s"<?endif;?>>რუბრიკები</a><a href="/apanel/index.php?component=statistic&section=authors" <?if($_GET['section'] == 'authors'):?>class="active_s"<?endif;?>>ავტორები</a><a href="/apanel/index.php?component=statistic&section=post" <?if($_GET['section'] == 'post'):?>class="active_s"<?endif;?>>სტატიები</a></a>
    <form action="" method="post" name="rubric_filter">
        <input type="text" name="from" value="<?=$_POST['from'];?>" placeholder="დან" class="calendar input_80"/>
        <input type="text" name="to" value="<?=$_POST['to'];?>" placeholder="მდე" class="calendar input_80"/>
        <select name="options">
            <option value="views" <?if(!$_POST['options'] or $_POST['options'] == 'views'):?>selected<?endif;?>>საერ.ჩვენების მიხედვით</option>
            <option value="unique" <?if($_POST['options'] == 'unique'):?>selected<?endif;?>>უნიკ.ჩვენების მიხედვით</option>
            <option value="news" <?if($_POST['options'] == 'news'):?>selected<?endif;?>>სტატიების რაოდენობის მიხედვით</option>
        </select>
        <select name="sort">
            <option value="desc" <?if(!$_POST['sort'] or $_POST['sort'] == 'desc'):?>selected<?endif;?>>კლებადობით</option>
            <option value="asc" <?if($_POST['sort'] == 'asc'):?>selected<?endif;?>>ზრდადობით</option>
        </select>
        <select name="stat">
            <option value="active" <?if(($_COOKIE['stat'] == 'active' and empty($_POST['stat'])) or $_POST['stat']=='active'):?>selected<?endif;?>>აქტიური</option>
            <option value="passive" <?if(($_COOKIE['stat'] == 'passive' and empty($_POST['stat'])) or $_POST['stat']=='passive'):?>selected<?endif;?>>პასიური</option>
        </select>
        <input type="submit" name="filter" value="ფილტრი" class="btn-green" style="border:none;position:relative;top:-2px;" >
    </form>
    </div>
    <table id="rounded-corner">
        <thead>
        <tr>
            <th scope="col" class="rounded">№</th>
            <th scope="col" class="rounded">რუბრიკა</th>
            <th scope="col" class="rounded">სტატიები</th>
            <th scope="col" class="rounded">საერთო ჩვენება</th>
            <th scope="col" class="rounded">უნიკ.ჩვენება</th>
        </tr>
        </thead>
        <tbody>
        <?php if(count($registry['counts']) > 0): $i=0; foreach($registry['counts'] as $item): $i++;?>
            <tr>
                <td><?php echo $i;?></td>
                <td><a href="/apanel/index.php?component=statistic&section=post&cat=<?php echo $item['cat'];?>"><?php echo $item['name']?></a></td>
                <td><?php echo $item['news'];?></td>
                <td><?php if(empty($item['views'])): echo "---"; else: echo $item['views']; endif;?></td>
                <td><?php if(empty($item['unique'])): echo "---"; else: echo $item['unique']; endif;?></td>
            </tr>
        <?php endforeach;?>
        <?php endif;?>
        </tbody>
    </table>
<?php endif;?>