<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','category','edit')):?>
<h2>რუბრიკის რედაქტირება</h2>
<?if(!empty($message[0])):?>
        <div class="<?=$message[0]?>_box">
            <?=$message[1]?>
        </div>
<?endif;?>
<form method="post" name="rubric" action="" />
<input type="hidden" name="event" value="category"/>
<input type="hidden" name="edit" value="1"/>
<input type="hidden" name="idd" value="<?=$item[0]['id']?>"/>
    <table  class="formadd">
        <tr>
            <th><?php if($_GET['sec'] == 'post'):?>რუბრიკის დამატება<?php else:?>კატეგორიის დამატება<?php endif;?></th><?php if($_GET['sec'] == 'post'):?><th>ავტორები</th><?php endif;?>
        </tr>
        <tr>
            <td>
                <table>
                    <tr><td><?php if($_GET['sec'] == 'post'):?>საკნატუნო ამბები<?php else:?>კატეგორიის დამატება<?php endif;?></td><td>
                            <select name="test">
                                <option value="0">არა</option>
                                <option value="1" <?if(1==$item[0]['test']):?>selected<?endif;?>>კი</option>
                            </select>
                        </td>
                    </tr>
                    <?php if($_GET['sec'] == 'post'):?>
    <tr>
        <td>ფოტოკონკურსი</td>
        <td>
            <input type="checkbox" name="type" value="1" <?if($item[0]['type'] == '1'):?>checked<?endif;?>/>
        </td>
    </tr>
    <tr>
        <td>ბადის გარეშე</td>
        <td>
            <input type="checkbox" name="bade" value="1" <?if($item[0]['bade'] == '1'):?>checked<?endif;?>/>
        </td>
    </tr>
<?php endif;?>
                    <tr>
                        <td>აირჩიეთ დიზაინი</td>
                        <td>
                            <select name="design">
                                <option value="0">---</option>
                                <?php for($i=1;$i<=12;$i++):?>
                                    <option value="<?=$i?>" <?if($i == $item[0]['design']):?>selected<?endif;?>><?=$i?></option>
                                <?php endfor;?>
                            </select>
                        </td>
                    </tr>
                    <tr><td><?php if($_GET['sec'] == 'post'):?>რუბრიკის დასახელება<?php else:?>კატეგორიის დასახელება<?php endif;?></td><td><input type="text" name="name" value="<?=$item[0]['name']?>"/></td></tr>
                    <tr><td>ბმული ლათინურად<br/><i>(ავტოგენერაცია)</i></td><td><input type="text" name="chpu" value="<?=$item[0]['cat_chpu']?>"/></td></tr>
                </table>
            </td>
        <?php if($_GET['sec'] == 'post'):?>
            <td valign="top">
                <? $users = unserialize($item[0]['users']);
                foreach($registry['authors'] as $author):?>
                    <input type="checkbox" name="author[]" value="<?=$author['id']?>" <?if(in_array($author['id'],$users)):?>checked<?endif;?>/><?=$author['realname']?>
                <?endforeach;?>
            </td>
        <?php endif;?>
        </tr>
    </table>
<a href="index.php?component=category"><< უკან</a> <a onclick="document.rubric.submit();" class="btn-green right">რედაქტირება</a>
</form>

<?endif;?>