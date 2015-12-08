<? defined('_JEXEC') or die('Restricted access');
$sum = array();
foreach($registry['point'] as $point):
    $sum [] = max($point);
endforeach;
$sum = array_sum($sum);

?>
<div class="test-result" align="center">
    <h3>თქვენ დააგროვეთ <span><?=$sum;?></span> ქულიდან <span><?=$registry['myres'];?></span> ქულა </h3>
    <b>შედეგები:</b>
    <br><br>
    <table border="0" cellspacing="10" cellpadding="10" class="vik_results">
        <tr>

    <?$i=-1;foreach($registry['question'] as $q):$i++;?>
            <td valign="top">
               <table>
                   <tr><th><?=$q;?></th></tr>
                       <?for($a=0;$a<count($registry['answer'][$registry['answer_keys'][$i]]);$a++):?>

                         <tr>
                             <td <?if($registry['point'][$i][$a] > 0 and $_POST['ans'][$i] == $a):?>style="color:green"<?elseif($registry['point'][$i][$a] > 0):?>style="color:green;"<?elseif($_POST['ans'][$i] == $a):?>style="color:red;"<?else:?><?endif;?>>
                                 <?=$a+1;?>. <?=$registry['answer'][$registry['answer_keys'][$i]][$a];?>
                             </td>
                             <td><?if($registry['point'][$i][$a] > 0 and $_POST['ans'][$i] == $a):?><img src="/<?=$theme;?>images/success.png" width="16"><?elseif($_POST['ans'][$i] == $a):?><img src="/<?=$theme;?>images/error.png" width="16"><?endif;?></td>
                         </tr>

                       <?endfor?>
               </table>
            </td>
        <?if($i % 3 == 2):?></tr><tr><?endif;?>
    <?endforeach;?>
        </tr>
    </table>
    <br><br>
    <a class="facebook-btn" href="http://www.facebook.com/sharer.php?u=http://funtime.ge/com/test/share/<?=$registry['test'][0]['id'];?>/<?=$registry['myres'];?>/<?=$registry['random'];?>"
       onclick="shareWindow('Facebook',this);return false;" ></a>

</div>

