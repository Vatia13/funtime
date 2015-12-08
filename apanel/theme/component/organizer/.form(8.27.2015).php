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
    <input type="hidden" name="info_num" value="<?=($_POST['info_num'] > 0) ? $_POST['info_num'] : 0;?>"/>
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
            <td>საბანერო ადგილის დასახელება</td>
            <td>
                <select name="title">
                    <option>---</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>ბანერის ზომა (x-y)</td>
            <td>
                <input type="text" class="input_60" name="size_x" value="<?input_value('size_x',$registry['banner'][0]['size_x']);?>" placeholder="X"/>
                <input type="text" class="input_60" name="size_y" value="<?input_value('size_y',$registry['banner'][0]['size_y']);?>" placeholder="Y"/>
            </td>
        </tr>
        <tr>
            <td>შენიშვნა</td>
            <td>
                <textarea name="description" rows="5" cols="35"><?input_value('description',$registry['banner'][0]['description']);?></textarea>
            </td>
        </tr>
        <tr>
            <td>დაკავშირების თარიღი</td><td><input type="text" class="calendar" name="contact_at" value="<?input_value('contact_at',(!empty($registry['banner'][0]['contact_at'])) ? date('d/m/Y',strtotime($registry['banner'][0]['contact_at'])) : '');?>"/></td>
        </tr>
    </table>
    <?if($_GET['section'] == 'add'):?>
    <div id="add_info">
        <?php if($_POST['info_num'] > 0):?>
        <?php for($i=1;$i<=$_POST['info_num'];$i++):?>
                <?php @include('.extra_form.php');?>

        <?php endfor;?>
        <?endif;?>
    </div>
    <?php if($_POST['info_num'] > 0):?>
    <?php for($i=1;$i<=$_POST['info_num'];$i++):?>
        <script>
            jQuery(document).ready(function($){
                changeCat(<?=$i;?>,"select[name='cat_<?=$i;?>']",'<?=$_POST['title_'.$i];?>');
            });

        </script>
    <?php endfor;?>
    <?endif;?>
    <a onClick="addOrganInfo()" style="padding:7px 15px;cursor:pointer;font-family:BPGMrgvlovani;background-color:cornflowerblue;max-width:140px;float:left;border-radius:5px;color:#FFF;text-align:center;margin:0 10px 0 0;">+მეტი</a>
        <a onClick="addOtherInfo()" style="padding:7px 15px;cursor:pointer;font-family:BPGMrgvlovani;background-color:purple;max-width:140px;float:left;border-radius:5px;color:#FFF;text-align:center;margin:0 10px 0 20px;">+სხვა შეთავაზება</a>
    <a onClick="removeOrganInfo()" class="remove_last" style="display:none;padding:7px 15px;cursor:pointer;font-family:BPGMrgvlovani;background-color:#cc0000;max-width:140px;float:left;border-radius:5px;color:#FFF;text-align:center;margin:0 10px 0 250px;">- ბოლოს წაშლა</a>

    <?endif;?>
    <input type="submit" name="<?=$_GET['section'];?>" value="გაგზავნა" class="btn-green right" style="border:none;"/>
</form>

<? $cat = ($_POST['cat'] > 0) ? $_POST['cat'] : (($_GET['cat'] > 0) ? $_GET['cat'] : $registry['banner'][0]['cat_id']); ?>
<? $title = (!empty($_POST['title'])) ? $_POST['title'] : ((!empty($_GET['title'])) ? $_GET['title'] : $registry['banner'][0]['title']); ?>
<script>
    jQuery(document).ready(function($){
        var cat = '<?=$cat;?>';
        var title = '<?=$title;?>';

        var selected;
        if(cat > 0){

            $.ajax({
                url:'/apanel/index.php?component=banner&section=ajax',
                type:'POST',
                dataType:'JSON',
                data:{action:'get_positions',edit:1,title:title,id:cat},
                success:function(data){
                    data = JSON.parse(data);
                    var html = '<option>---</option>';
                    if(data.length > 0){

                        for(var i=0;i<=(data.length-1);i++){
                            if(data[i].title == title){selected = 'selected';}else{selected = '';}
                            html += '<option value="' + data[i].title + '" data-id="' + data[i].id + '" ' + selected +'>' + data[i].title + '</option>';
                        }
                        $('select[name="title"]').html(html);

                        if(title != ''){
                            var id = $('option[value="'+title+'"]').attr('data-id');

                            if(id > 0){
                                $.ajax({
                                    url:'/apanel/index.php?component=banner&section=ajax',
                                    type:'POST',
                                    dataType:'JSON',
                                    data:{action:'get_size',id:id},
                                    success:function(data){
                                        data = JSON.parse(data);
                                        if(data[0].size_x > 0 && data[0].size_y > 0){
                                            $('input[name="size_x"]').val(data[0].size_x);
                                            $('input[name="size_y"]').val(data[0].size_y);
                                        }else{
                                            alert('ბანერზე ამ დასახელებით არ არის მითითებული ზომები');

                                        }
                                    }
                                });
                            }

                        }
                    }else{
                        alert('ამ რუბრიკაზე არ არის დამატებული საბანერო ადგილები');
                        $('select[name="title"]').html(html);
                        $('input[name="size_x"]').val('');
                        $('input[name="size_y"]').val('');
                    }


                }
            });
        }
        $('select[name="cat"]').change(function(){
            if($(this).val() > 0){
                $.ajax({
                    url:'/apanel/index.php?component=banner&section=ajax',
                    type:'POST',
                    dataType:'JSON',
                    data:{action:'get_positions',id:$(this).val()},
                    success:function(data){
                        data = JSON.parse(data);
                        var html = '<option>---</option>';
                        if(data.length > 0){
                            $('input[name="size_x"]').val('');
                            $('input[name="size_y"]').val('');
                            for(var i=0;i<=(data.length-1);i++){
                                html += '<option value="' + data[i].title + '" data-id="' + data[i].id + '">' + data[i].title + '</option>';
                            }
                            $('select[name="title"]').html(html);
                        }else{
                            alert('ამ რუბრიკაზე არ არის დამატებული საბანერო ადგილები ან/და ყველა საბანერო ადგილი უკვე დაკავებულია');
                            $('select[name="title"]').html(html);
                            $('input[name="size_x"]').val('');
                            $('input[name="size_y"]').val('');
                        }

                    }
                });
            }

        });


        $('select[name="title"]').change(function(){
            var title = $('option:selected',this).val();
            var id = $('option:selected',this).attr('data-id');
            if(title != '' && id > 0){
                $.ajax({
                    url:'/apanel/index.php?component=banner&section=ajax',
                    type:'POST',
                    dataType:'JSON',
                    data:{action:'get_size',id:id},
                    success:function(data){
                        data = JSON.parse(data);
                        if(data[0].size_x > 0 && data[0].size_y > 0){
                            $('input[name="size_x"]').val(data[0].size_x);
                            $('input[name="size_y"]').val(data[0].size_y);
                        }else{
                            alert('ბანერზე ამ დასახელებით არ არის მითითებული ზომები');
                        }
                    }
                });
            }
        });
    });

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

    <?if($_GET['section'] == 'add'):?>


    var addOrganInfo = function(){
        var tableNum = $("input[name='info_num']").val();
        tableNum = parseInt(tableNum) + 1;
        $('.remove_last').show();
       // var catSelected,titleSelected;
        var cat = '<?=$_POST['cat'];?>';
        var html = '<table class="formadd" style="border:1px solid #e7e7e7;padding:10px;margin:10px 0;">' +
            '<tr><td class="td1">რუბრის დასახელება</td><td>'+
        '<select name="cat_'+tableNum+'" onChange="changeCat('+tableNum+',this);" class="input_150">'+
        '<option value="">---</option>'+

        '<option value="1">პირველი გვერდი</option>'+
        '<option value="2">ტესტები</option>'+
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
        '<option value="<?=$ca['id']?>" selected>- <?=$ca['name']?></option>'+
        <? else:?>
        <?if($ca['podcat']==0):?>
        '<option value="<?=$ca['id']?>" >- <?=$ca['name']?></option>'+
        <?else:?>
        '<option value="<?=$ca['id']?>">--- <?=$ca['name']?></option>'+
        <?endif;?>
        <?endif;?>
        <?endif;?>
        <?}else{?>
        <?if($ca['podcat']==0):?>
            '<option value="<?=$ca['id']?>">- <?=$ca['name']?></option>'+
        <?else:?>
        '<option value="<?=$ca['id']?>">--- <?=$ca['name']?></option>'+
        <?endif;?>
        <?}?>
        <?endforeach;?>
        <?endforeach;?>

                    '</select></td></tr><tr><tr><td>საბანერო ადგილის დასახელება</td><td>' +
                    '<select name="title_' + tableNum + '" onChange="changeTitle(' + tableNum + ',this);" >' +
                    '<option>---</option>' +
                    '</select>' +
                    '</td>' +
                    '</tr>' +
                    '<tr><td>ბანერის ზომა (x-y)</td><td>' +
                    '<input type="text" class="input_60" name="size_x_' + tableNum + '" value="" placeholder="X"/>' +
                    '<input type="text" class="input_60" name="size_y_' + tableNum + '" value="" placeholder="Y"/>' +
                    '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>შენიშვნა</td>' +
                    '<td>' +
                    '<textarea name="description_' + tableNum + '" rows="5" cols="35"></textarea>' +
                    '</td></tr><tr>' +
                    '<td>დაკავშირების თარიღი</td><td><input type="text" class="calendar" value="" name="contact_at_' + tableNum + '" /></td>' +
                    '</tr></table>';

        $("#add_info").append(html);
        $("input[name='info_num']").val(tableNum);
        $('.calendar').simpleDatepicker();
    };


    var addOtherInfo = function(){
        var tableNum = $("input[name='info_num']").val();
        tableNum = parseInt(tableNum) + 1;
        // var catSelected,titleSelected;
        var cat = '<?=$_POST['cat'];?>';
        var html = '<table class="formadd" style="border:1px solid #e7e7e7;padding:10px;margin:10px 0;">' +
            '<tr><td class="td1">რუბრის დასახელება</td><td>'+
            '<select name="cat_'+tableNum+'" onChange="changeCat('+tableNum+',this);" class="input_150">'+
            '<option value="">---</option>'+

            '<option value="1">პირველი გვერდი</option>'+
            '<option value="2">ტესტები</option>'+
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
            '<option value="<?=$ca['id']?>" selected>- <?=$ca['name']?></option>'+
            <? else:?>
            <?if($ca['podcat']==0):?>
            '<option value="<?=$ca['id']?>" >- <?=$ca['name']?></option>'+
            <?else:?>
            '<option value="<?=$ca['id']?>">--- <?=$ca['name']?></option>'+
            <?endif;?>
            <?endif;?>
            <?endif;?>
            <?}else{?>
            <?if($ca['podcat']==0):?>
            '<option value="<?=$ca['id']?>">- <?=$ca['name']?></option>'+
            <?else:?>
            '<option value="<?=$ca['id']?>">--- <?=$ca['name']?></option>'+
            <?endif;?>
            <?}?>
            <?endforeach;?>
            <?endforeach;?>
            '<tr>' +
            '<td>შეთავაზების მოკლე აღწერა</td>' +
            '<td>' +
            '<textarea name="description_' + tableNum + '" rows="5" cols="35"></textarea>' +
            '</td></tr><tr>' +
            '<td>დაკავშირების თარიღი</td><td><input type="text" class="calendar" value="" name="contact_at_' + tableNum + '" /> ' +
            '<select name="hour_' + tableNum + '">'+
        <?for($i=0;$i<=23;$i++):?>
        <?if($i < 10): $i = '0'.$i; endif;?>
            '<option val="<?=$i;?>"><?=$i;?></option>'+
        <?endfor;?>
            '</select><select name="min_' + tableNum + '">'+
        <?for($i=0;$i<=59;$i++):?>
        <?if($i < 10): $i = '0'.$i; endif;?>
        '<option val="<?=$i;?>"><?=$i;?></option>'+
        <?endfor;?>
            '</select><input type="hidden" value="1" name="other_' + tableNum + '" /></td></tr></table>';

        $("#add_info").append(html);
        $("input[name='info_num']").val(tableNum);
        $('.calendar').simpleDatepicker();
    };

    var removeOrganInfo = function(){
        var tableNum = $("input[name='info_num']").val();
        tableNum = parseInt(tableNum) - 1;

        if(tableNum <= 0){
            $('.remove_last').hide();
            tableNum = 0;
        }
        $("input[name='info_num']").val(tableNum);
        $("#add_info > table:last-child").remove();
    };


    var changeCat = function(num,t,title){
            var e = $(t);
            if(e.val() > 0){
                $.ajax({
                    url:'/apanel/index.php?component=banner&section=ajax',
                    type:'POST',
                    dataType:'JSON',
                    data:{action:'get_positions',id:e.val()},
                    success:function(data){
                        var selected;
                        data = JSON.parse(data);
                        var html = '<option>---</option>';
                        if(data.length > 0){
                            $('input[name="size_x_'+num+'"]').val('');
                            $('input[name="size_y_'+num+'"]').val('');
                            for(var i=0;i<=(data.length-1);i++){
                                if(data[i].title == title){selected = 'selected';}else{selected = '';}
                                html += '<option value="' + data[i].title + '" data-id="' + data[i].id + '" ' + selected +'>' + data[i].title + '</option>';
                            }
                            $('select[name="title_'+num+'"]').html(html);
                            if(title != ''){
                                var id = $('option[value="'+title+'"]').attr('data-id');

                                if(id > 0){
                                    $.ajax({
                                        url:'/apanel/index.php?component=banner&section=ajax',
                                        type:'POST',
                                        dataType:'JSON',
                                        data:{action:'get_size',id:id},
                                        success:function(data){
                                            data = JSON.parse(data);
                                            if(data[0].size_x > 0 && data[0].size_y > 0){
                                                $('input[name="size_x_'+num+'"]').val(data[0].size_x);
                                                $('input[name="size_y_'+num+'"]').val(data[0].size_y);
                                            }else{
                                                alert('ბანერზე ამ დასახელებით არ არის მითითებული ზომები');

                                            }
                                        }
                                    });
                                }

                            }
                        }else{
                            alert('ამ რუბრიკაზე არ არის დამატებული საბანერო ადგილები ან/და ყველა საბანერო ადგილი უკვე დაკავებულია');
                            $('select[name="title_'+num+'"]').html(html);
                            $('input[name="size_x_'+num+'"]').val('');
                            $('input[name="size_y_'+num+'"]').val('');
                        }

                    }
                });
            }
    }

    var changeTitle = function(num,t){
            var title = $('option:selected',t).val();
            var id = $('option:selected',t).attr('data-id');
            if(title != '' && id > 0){
                $.ajax({
                    url:'/apanel/index.php?component=banner&section=ajax',
                    type:'POST',
                    dataType:'JSON',
                    data:{action:'get_size',id:id},
                    success:function(data){
                        data = JSON.parse(data);
                        if(data[0].size_x > 0 && data[0].size_y > 0){
                            $('input[name="size_x_'+num+'"]').val(data[0].size_x);
                            $('input[name="size_y_'+num+'"]').val(data[0].size_y);
                        }else{
                            alert('ბანერზე ამ დასახელებით არ არის მითითებული ზომები');
                        }
                    }
                });
            }
    }
<?endif;?>
</script>