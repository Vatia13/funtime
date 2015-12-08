<?php defined('_JEXEC') or die('Restricted access'); ?>
<table id="rounded-corner">
    <thead>
    <tr>
        <th scope="col" class="rounded">რუბრიკის დასახელება</th>
        <th scope="col" class="rounded">ბანერების რაოდენობა</th>
        <th scope="col" class="rounded">დაკავებული</th>
        <th scope="col" class="rounded">უფასოდ გაცემული</th>
        <th scope="col" class="rounded">თავისუფალი ბანერები</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><a href="/apanel/index.php?component=banner&ban=all&cat=1">პირველი გვერდი</a></td><td><?=$banner_sum[1];?></td><td><?=($bleft[1][1] > 0) ? $bleft[1][1] : 0;?></td><td><?=($gleft[1][1] > 0) ? $gleft[1][1] : 0;?></td><td><?=($left[1][1] > 0) ? $banner_sum[1] - $left[1][1] : $banner_sum[1];?></td>
    </tr>
    <tr>
        <td><a href="/apanel/index.php?component=banner&ban=all&cat=2">ტესტები</a></td><td><?=$banner_sum[2];?></td><td><?=($bleft[2][2] > 0) ? $bleft[2][2] : 0;?></td><td><?=($gleft[2][2] > 0) ? $gleft[2][2] : 0;?></td><td><?=($left[2][2] > 0) ? $banner_sum[2] - $left[2][2] : $banner_sum[2];?></td>
    </tr>
    <tr>
        <td><a href="/apanel/index.php?component=banner&ban=all&cat=3">ვიქტორინა</a></td><td><?=$banner_sum[3];?></td><td><?=($bleft[3][3] > 0) ? $bleft[3][3] : 0;?></td><td><?=($gleft[3][3] > 0) ? $gleft[3][3] : 0;?></td><td><?=($left[2][2] > 0) ? $banner_sum[2] - $left[2][2] : $banner_sum[2];?></td>
    </tr>
    <tr>
        <td><a href="/apanel/index.php?component=banner&ban=all&cat=4">თავსატეხი</a></td><td><?=$banner_sum[4];?></td>
        <td><?=($bleft[4][4] > 0) ? $bleft[4][4] : 0;?></td><td><?=($gleft[4][4] > 0) ? $gleft[4][4] : 0;?></td><td><?=($left[2][2] > 0) ? $banner_sum[2] - $left[2][2] : $banner_sum[2];?></td>
    </tr>
    <?if(count($category) > 0):?>
    <?foreach($category as $cat):?>
    <?foreach($cat as $ca):?>
            <tr>
                <td><a href="/apanel/index.php?component=banner&ban=all&cat=<?=$ca['id'];?>"><?=$ca['name'];?></a></td>

                <td><?=$banner_sum[$ca['id']];?></td>
                <td><?=($bleft[$ca['id']][$ca['id']] > 0) ? $bleft[$ca['id']][$ca['id']] : 0;?></td>
                <td><?=($gleft[$ca['id']][$ca['id']] > 0) ? $gleft[$ca['id']][$ca['id']] : 0;?></td>
                <td><?=($left[$ca['id']][$ca['id']] > 0) ? $banner_sum[$ca['id']] - $left[$ca['id']][$ca['id']] : $banner_sum[$ca['id']];?></td>
            </tr>
            <?endforeach;?>
        <?endforeach;?>
    <?endif;?>
    </tbody>
</table>
<?if ($total>1) echo '<center><div class="pagination" style="margin-bottom:10px; margin-top:10px;">'
    .$pervpage.$page2left.$page1left.'<span class="">'.$page.'</span>'.$page1right.$page2right
    .$nextpage.'</div></center>';?>
