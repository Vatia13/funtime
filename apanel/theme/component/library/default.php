<?php defined('_JEXEC') or die('Restricted access'); ?>
<?if(get_access('admin','library','view')): 
    $key = ($user->get_property('userID') == 758) ? 'f511422113d2vedc5c426b7y14cby679' : 'a651481913d2fedc5c880b5f14cb9859';

    ?>
<table class="formadd">
    <tr>
        <th>ატვირთე ფოტო სერვერზე</th>
    </tr>
    <tr>
        <td align="center">
            <i>პრევიუ ფოტო (655x440)</i><br>
            <i>Facebook ფოტო (470x247)</i><br>
        </td>
    </tr>
    <tr>
        <td align="center"><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=<?=$key;?>" class="btn-blue iframe-btn" type="button">ფოტო</a></td>
    </tr>
    <tr>
        <td align="center"><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=<?=$key;?>&no_wm=1" class="btn-blue iframe-btn" type="button">ფოტო (ლოგოს გარეშე)</a></td>
    </tr>
</table>
<?endif;?>