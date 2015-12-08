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
<table id="rounded-corner" class="question-answer">
    <thead>
    <tr>
        <th class="rounded">კითხვა</th><th class="rounded">პასუხები</th><th class="rounded">ქულა</th><th class="rounded">კითხვის წაშლა</th>
    </tr>
    </thead>
    <tbody>
    <tr data-id="0">
        <td><input type="text" name="question[]" value="<?=$registry['question'][0];?>" class="form-control" style="width:400px;" ></td>
        <td align="right">
            <input type="text" name="answer[0][]" value="<?=$registry['answer'][$registry['answer_keys'][0]][0];?>" class="form-control" style="width:300px;" ></br>
            <input type="text" name="answer[0][]" value="<?=$registry['answer'][$registry['answer_keys'][0]][1];?>" class="form-control" style="width:300px;" ></br>
            <?if(count($registry['answer'][$registry['answer_keys'][0]]) > 2):?>
                <?for($i=2;$i<count($registry['answer'][$registry['answer_keys'][0]]);$i++):?>
                    <input type="text" name="answer[0][]" value="<?=$registry['answer'][$registry['answer_keys'][0]][$i];?>" class="form-control" style="width:300px;" ></br>
                <?endfor;?>
            <?endif;?>
            <div></div>
            <a class="btn-blue" style="color:#FFF;" onclick="addAnswer(this)">+ მეტი პასუხი</a>
        </td>
        <td>
            <div>
            <span><input type="text" name="point[0][]" value="<?if($registry['point'][$registry['answer_keys'][0]][0] > 0):?><?=$registry['point'][$registry['answer_keys'][0]][0];?><?else:?>0<?endif;?>" class="form-control" style="width:50px;text-align:center;" ></br></span>
            <span><input type="text" name="point[0][]" value="<?if($registry['point'][$registry['answer_keys'][0]][1] > 0):?><?=$registry['point'][$registry['answer_keys'][0]][1];?><?else:?>0<?endif;?>" class="form-control" style="width:50px;text-align:center;" ></br></span>
                <?if(count($registry['point'][$registry['answer_keys'][0]]) > 2):?>
                    <?for($i=2;$i<count($registry['point'][$registry['answer_keys'][0]]);$i++):?>
                        <span><input type="text" name="point[0][]" value="<?if($registry['point'][$registry['answer_keys'][0]][$i] > 0):?><?=$registry['point'][$registry['answer_keys'][0]][$i];?><?else:?>0<?endif;?>" class="form-control" style="width:50px;text-align:center;" ></br></span>
                    <?endfor;?>
                <?endif;?>
            </div>
            <a style="height:28px;"></a>
        </td>
        <td align="center"><a onclick="removeQuestion(this)" style="cursor:pointer;"><img src="theme/images/error.png"></a></td>
    </tr>
    <?if(count($registry['question']) > 1):?>
        <?for($i=1;$i<count($registry['question']);$i++):?>
            <tr data-id="<?=$i?>">
                <td><input type="text" name="question[]" value="<?=$registry['question'][$i];?>" class="form-control" style="width:400px;" ></td>
                <td align="right">
                    <input type="text" name="answer[<?=$i;?>][]" value="<?=$registry['answer'][$registry['answer_keys'][$i]][0];?>" class="form-control" style="width:300px;" ></br>
                    <input type="text" name="answer[<?=$i;?>][]" value="<?=$registry['answer'][$registry['answer_keys'][$i]][1];?>" class="form-control" style="width:300px;" ></br>
                    <?if(count($registry['answer'][$i]) > 2):?>
                        <?for($a=2;$a<count($registry['answer'][$registry['answer_keys'][$i]]);$a++):?>
                            <input type="text" name="answer[<?=$i;?>][]" value="<?=$registry['answer'][$registry['answer_keys'][$i]][$a];?>" class="form-control" style="width:300px;" ></br>
                        <?endfor;?>
                    <?endif;?>
                    <div></div>
                    <a class="btn-blue" style="color:#FFF;" onclick="addAnswer(this)">+ მეტი პასუხი</a>
                </td>
                <td>
                    <div>
                        <span><input type="text" name="point[<?=$i;?>][]" value="<?if($registry['point'][$registry['answer_keys'][$i]][0] > 0):?><?=$registry['point'][$registry['answer_keys'][$i]][0];?><?else:?>0<?endif;?>" class="form-control" style="width:50px;text-align:center;" ></br></span>
                        <span><input type="text" name="point[<?=$i;?>][]" value="<?if($registry['point'][$registry['answer_keys'][$i]][1] > 0):?><?=$registry['point'][$registry['answer_keys'][$i]][1];?><?else:?>0<?endif;?>" class="form-control" style="width:50px;text-align:center;" ></br></span>
                        <?if(count($registry['point'][$registry['answer_keys'][$i]]) > 2):?>
                            <?for($b=2;$b<count($registry['point'][$registry['answer_keys'][$i]]);$b++):?>
                                <span><input type="text" name="point[<?=$i;?>][]" value="<?if($registry['point'][$registry['answer_keys'][$i]][$b] > 0):?><?=$registry['point'][$registry['answer_keys'][$i]][$b];?><?else:?>0<?endif;?>" class="form-control" style="width:50px;text-align:center;" ></br></span>
                            <?endfor;?>
                        <?endif;?>
                    </div>
                    <a style="height:28px;"></a>
                </td>
                <td align="center"><a onclick="removeQuestion(this)" style="cursor:pointer;"><img src="theme/images/error.png"></a></td>
            </tr>
        <?endfor;?>
    <?endif;?>
    </tbody>
    <tfoot>
    <tr>
        <td><a class="btn-blue" onclick="addQuestion(this)">+ მეტი კითხვა</a></td><td></td><td></td><td></td>
    </tr>
    </tfoot>
</table>

<br><br>