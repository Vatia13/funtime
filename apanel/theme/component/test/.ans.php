<?php
/**
 *
 * CMS It-Solutions 0.1
 * Author: Vati Child
 * E-mail: vatia0@gmail.com
 * URL: www.it-solutions.ge
 *
 */

defined('_JEXEC') or die('Restricted access');
?>
<h3></h3>

<table id="rounded-corner" class="answer-answer">
    <thead>
    <tr>
        <th class="rounded">შედეგი</th><th class="rounded">მინ. ქულა</th><th class="rounded">მაქს. ქულა</th><th class="rounded">კითხვის წაშლა</th>
    </tr>
    </thead>
    <tbody>
    <tr data-id="0">
        <td><textarea name="result[0][text]" class="form-control" style="width:550px;height:90px;"><?=$registry['result'][$registry['result_keys'][0]]['text'];?></textarea></td>
        <td align="center"><input type="text" name="result[0][min]" value="<?=$registry['result'][$registry['result_keys'][0]]['min'];?>" class="form-control" style="width:50px;text-align: center;"></td>
        <td align="center"><input type="text" name="result[0][max]" value="<?=$registry['result'][$registry['result_keys'][0]]['max'];?>" class="form-control" style="width:50px;text-align: center;"></td>
        <td align="center"><a onclick="removeResult(this)" style="cursor:pointer;"><img src="theme/images/error.png"></a></td>
    </tr>
    <?if(count($registry['result']) > 0):?>
        <?for($i=1;$i<count($registry['result']);$i++):?>
            <tr data-id="<?=$i;?>">
                <td><textarea name="result[<?=$i;?>][text]" class="form-control" style="width:550px;height:90px;"><?=$registry['result'][$registry['result_keys'][$i]]['text'];?></textarea></td>
                <td align="center"><input type="text" name="result[<?=$i;?>][min]" value="<?=$registry['result'][$registry['result_keys'][$i]]['min'];?>" class="form-control" style="width:50px;text-align: center;"></td>
                <td align="center"><input type="text" name="result[<?=$i;?>][max]" value="<?=$registry['result'][$registry['result_keys'][$i]]['max'];?>" class="form-control" style="width:50px;text-align: center;"></td>
                <td align="center"><a onclick="removeResult(this)" style="cursor:pointer;"><img src="theme/images/error.png"></a></td>
            </tr>
        <?endfor;?>
    <?endif;?>
    </tbody>
    <tfoot>
    <tr>
        <td><a class="btn-blue" onclick="addResult(this)">+ მეტი შედეგი</a></td><td></td><td></td><td></td>
    </tr>
    </tfoot>
</table>
</br></br>