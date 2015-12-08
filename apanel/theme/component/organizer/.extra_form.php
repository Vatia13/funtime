<?php defined('_JEXEC') or die('Restricted access');?>
<?=$_POST['other'.$i];?>
<table class="formadd" style="border:1px solid #e7e7e7;padding:10px;margin:10px 0;">
    <tr><td class="td1">რუბრის დასახელება</td><td>
            <select name="cat_<?=$i;?>" class="input_150">
                <option value="">---</option>
                <option value="1" <?if($_POST['cat_'.$i] == 1):?>selected<?php endif;?>>პირველი გვერდი</option>
                <option value="2" <?if($_POST['cat_'.$i] == 2):?>selected<?php endif;?>>ტესტები</option>
                <?$catnum = array();foreach($category as $cat):?>
                    <?foreach($cat as $ca):?>
                        <? if($user->get_property('gid') == 18 or $user->get_property('gid') == 21){?>
                            <? $authors = unserialize($ca['users']);?>
                            <?if(in_array($user->get_property('userID'),$authors)):?>
                                <? $catnum[] = $ca['id']; ?>
                            <?endif;?>
                        <?}?>
                    <?endforeach;?>
                <?endforeach;?>
                <?foreach($category as $cat):?>
                    <?foreach($cat as $ca):?>
                        <? if($user->get_property('gid') == 18 or $user->get_property('gid') == 21){?>
                            <? $authors = unserialize($ca['users']);?>
                            <?if(in_array($user->get_property('userID'),$authors)):?>
                                <?  if(count($catnum) < 2): ?>
                                    <option value="<?=$ca['id']?>" selected>- <?=$ca['name']?></option>
                                <? else:?>
                                    <?if($ca['podcat']==0):?>
                                        <option value="<?=$ca['id']?>" <?if($_POST['cat_'.$i] == $ca['id']):?>selected<?php endif;?>>- <?=$ca['name']?></option>
                                    <?else:?>
                                        <option value="<?=$ca['id']?>" <?if($_POST['cat_'.$i] == $ca['id']):?>selected<?php endif;?>>--- <?=$ca['name']?></option>
                                    <?endif;?>
                                <?endif;?>
                            <?endif;?>
                        <?}else{?>
                            <?if($ca['podcat']==0):?>
                                <option value="<?=$ca['id']?>" <?if($_POST['cat_'.$i] == $ca['id']):?>selected<?php endif;?>>- <?=$ca['name']?></option>
                            <?else:?>
                                <option value="<?=$ca['id']?>" <?if($_POST['cat_'.$i] == $ca['id']):?>selected<?php endif;?>>--- <?=$ca['name']?></option>
                            <?endif;?>
                        <?}?>
                    <?endforeach;?>
                <?endforeach;?>
            </select>
        </td></tr>
    <tr>
    <?if($_POST['other_'.$i] <= 0):?>
    <tr>
        <td>საბანერო ადგილის დასახელება</td>
        <td>
            <select name="title_<?=$i;?>">
                <option>---</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>ბანერის ზომა (x-y)</td>
        <td>
            <input type="text" class="input_60" name="size_x_<?=$i;?>" value="<?=$_POST['size_x_'.$i];?>" placeholder="X"/>
            <input type="text" class="input_60" name="size_y_<?=$i;?>" value="<?=$_POST['size_y_'.$i];?>" placeholder="Y"/>
        </td>
    </tr>
    <?endif;?>
    <tr>
        <td><?if($_POST['other_'.$i] <= 0):?>შენიშვნა<?else:?>შეთავაზების მოკლე აღწერა<?endif;?></td>
        <td>
            <textarea name="description_<?=$i;?>" rows="5" cols="35"><?=$_POST['description_'.$i];?></textarea>
        </td>
    </tr>

    <tr>
        <td>დაკავშირების თარიღი</td><td><input type="text" class="calendar" name="contact_at_<?=$i;?>" value="<?=$_POST['contact_at_'.$i];?>"/>
            <?if($_POST['other_'.$i] > 0):?>
                <select name="hour_<?=$i;?>">
                    <?for($v=0;$v<=23;$v++):?>
                        <?if($v < 10): $v = '0'.$v; endif;?>
                        <option val="<?=$v;?>" <?if($_POST['hour_'.$i] == $v):?>selected<?endif;?>><?=$v;?></option>
                    <?endfor;?>
                </select>

                <select name="min_<?=$i;?>">
                    <?for($v=0;$v<=59;$v++):?>
                        <?if($v < 10): $v = '0'.$v; endif;?>
                        <option val="<?=$v;?>" <?if($_POST['min_'.$i] == $v):?>selected<?endif;?>><?=$v;?></option>
                    <?endfor;?>
                </select>
                <input type="hidden" value="1" name="other_<?=$i;?>" />
            <?endif;?>
        </td>
    </tr>
</table>