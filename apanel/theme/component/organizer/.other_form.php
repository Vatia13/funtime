<?php defined('_JEXEC') or die('Restricted access');?>
<?if(!empty($message[0])):?>
    <div class="<?=$message[0]?>_box">
        <?if(count($validator) > 0):?>
            <ul>
                <?for($i=0;$i<count($validator);$i++):?>
                    <li><?=$validator[$i]?></li>
                <?endfor;?>
            </ul>
        <?else:?>
            <?=$message[1];?>
        <?endif;?>
    </div>
<?endif;?>
<?
if(!empty($registry['banner'][0]['info'])){
    $info = unserialize($registry['banner'][0]['info']);
}else{
    $info = array('person','banner','phone','email');
}
?>
<form action="" method="post">
    <table class="formadd" style="border:1px solid #e7e7e7;padding:10px;margin:10px 0;">
        <tr>
            <td class="td1">კომპანიის დასახელება</td>
            <td>
                <input type="text" name="company" value="<?input_value('company',$registry['banner'][0]['company']);?>">
                <select name="chose_company">
                    <option>---</option>
                    <?if(count($registry['company']) > 0):?>
                        <?foreach($registry['company'] as $item): $cinfo = unserialize($item['info']); $json_info = json_encode($cinfo,JSON_UNESCAPED_UNICODE);?>
                            <option value="<?=$item['company']?>" data-info='<?=$json_info;?>' <?select_value('chose_company',$registry['banner'][0]['company'],$item['company']);?>><?=$item['company']?></option>
                        <?endforeach;endif;?>
                </select>
            </td>
        </tr>
        <tr>
            <td>საკონტაქტო პირი</td>
            <td>
                <input type="text" name="info[person]" value="<?input_value('info|person',$info['person']);?>"/>
            </td>
        </tr>
        <tr>
            <td>ტელეფონის ნომერი</td>
            <td>
                <input type="text" name="info[phone]" value="<?input_value('info|phone',$info['phone']);?>"/>
            </td>
        </tr>
        <tr>
            <td>ელ.ფოსტა</td>
            <td>
                <input type="text" name="info[email]" value="<?input_value('info|email',$info['email']);?>"/>
            </td>
        </tr>
    </table>
    <table class="formadd" style="border:1px solid #e7e7e7;padding:10px;margin:10px 0;">
        <tr><td class="td1">რუბრის დასახელება</td><td>
                <select name="cat" class="input_150">
                    <option value="">---</option>
                    <option value="1" <?select_value('cat',(($registry['banner'][0]['cat_id']) ? $registry['banner'][0]['cat_id'] : $_GET['cat']),1);?>>პირველი გვერდი</option>
                    <option value="2" <?select_value('cat',(($registry['banner'][0]['cat_id']) ? $registry['banner'][0]['cat_id'] : $_GET['cat']),2);?>>ტესტები</option>
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
                                            <option value="<?=$ca['id']?>" <?select_value('cat',(($registry['banner'][0]['cat_id']) ? $registry['banner'][0]['cat_id'] : $_GET['cat']),$ca['id']);?>>- <?=$ca['name']?></option>
                                        <?else:?>
                                            <option value="<?=$ca['id']?>" <?select_value('cat',(($registry['banner'][0]['cat_id']) ? $registry['banner'][0]['cat_id'] : $_GET['cat']),$ca['id']);?>>--- <?=$ca['name']?></option>
                                        <?endif;?>
                                    <?endif;?>
                                <?endif;?>
                            <?}else{?>
                                <?if($ca['podcat']==0):?>
                                    <option value="<?=$ca['id']?>" <?select_value('cat',(($registry['banner'][0]['cat_id']) ? $registry['banner'][0]['cat_id'] : $_GET['cat']),$ca['id']);?>>- <?=$ca['name']?></option>
                                <?else:?>
                                    <option value="<?=$ca['id']?>" <?select_value('cat',(($registry['banner'][0]['cat_id']) ? $registry['banner'][0]['cat_id'] : $_GET['cat']),$ca['id']);?>>--- <?=$ca['name']?></option>
                                <?endif;?>
                            <?}?>
                        <?endforeach;?>
                    <?endforeach;?>
                </select>
            </td></tr>
        <tr>
        <tr>
            <td>შეთავაზების მოკლე აღწერა </td>
            <td>
                <textarea name="description" rows="5" cols="35"><?input_value('description',$registry['banner'][0]['description']);?></textarea>
            </td>
        </tr>
        <tr>
            <td>
                დაკავშირების თარიღი</td>
            <td>
                <input type="text" class="calendar" name="contact_at" value="<?input_value('contact_at',(!empty($registry['banner'][0]['contact_at'])) ? date('d/m/Y',strtotime($registry['banner'][0]['contact_at'])) : '');?>"/>


                    <select name="hour">
                        <?for($i=0;$i<=23;$i++):?>
                            <?if($i < 10): $i = '0'.$i; endif;?>
                            <option val="<?=$i;?>" <?select_value('hour',(strtotime($registry['banner'][0]['contact_at']) > 0) ? date('H',strtotime($registry['banner'][0]['contact_at'])) : $_POST['hour'],$i);?>><?=$i;?></option>
                        <?endfor;?>
                    </select>

                <select name="min">
                    <?for($i=0;$i<=59;$i++):?>
                        <?if($i < 10): $i = '0'.$i; endif;?>
                        <option val="<?=$i;?>" <?select_value('min',(strtotime($registry['banner'][0]['contact_at']) > 0) ? date('i',strtotime($registry['banner'][0]['contact_at'])) : $_POST['min'],$i);?>><?=$i;?></option>
                    <?endfor;?>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" name="<?=$_GET['section'];?>" value="გაგზავნა" class="btn-green" style="border:none;"/>
</form>

<script>
    $('select[name="chose_company"]').change(function(){
        var data = JSON.parse($('option:selected',this).attr('data-info'));
        if(data.phone != ''){
            $('input[name="info[phone]"]').val(data.phone);
        }
        if(data.person != ''){
            $('input[name="info[person]"]').val(data.person);
        }
        if(data.email != ''){
            $('input[name="info[email]"]').val(data.email);
        }
        $('input[name="company"]').val($(this).val());
    });

    $('select[name="cat"]').change(function(){
        if($(this).val() == 116){

        }
    });
</script>