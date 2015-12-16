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
if(!empty($registry['banner'][0]['info'])){
    $info = unserialize($registry['banner'][0]['info']);
}else{
    $info = array('person','banner','phone','email');
}
?>

<form method="post" action="" />

<table class="formadd">

    <tr>
        <td>კომპანიის დასახელება</td>
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
    <tr><td class="td1">რუბრის დასახელება</td><td>
            <select name="cat" class="input_150">
                <option value="">---</option>
                <option value="1" <?=(1==$_POST['cat']) ? 'selected' : ((1 == $registry['banner'][0]['cat_id']) ? 'selected' : ''); ?>>მთავარი გვერდი</option>
                <option value="2" <?=(2==$_POST['cat']) ? 'selected' : ((2 == $registry['banner'][0]['cat_id']) ? 'selected' : ''); ?>>ტესტები</option>
                <option value="3" <?=(3==$_POST['cat']) ? 'selected' : ((3 == $registry['banner'][0]['cat_id']) ? 'selected' : ''); ?>>ვიქტორინა</option>
                <option value="4" <?=(4==$_POST['cat']) ? 'selected' : ((4 == $registry['banner'][0]['cat_id']) ? 'selected' : ''); ?>>თავსატეხი</option>
                <?foreach($category as $cat):?>
                    <?foreach($cat as $ca):?>
                        <?if($ca['podcat']==0):?>
                            <option value="<?=$ca['id']?>" <?=($ca['id']==$_POST['cat']) ? 'selected' : (($ca['id'] == $registry['banner'][0]['cat_id']) ? 'selected' : ''); ?>>- <?=$ca['name']?></option>
                        <?else:?>
                            <option value="<?=$ca['id']?>" <?=($ca['id']==$_POST['cat'])? 'selected' : (($ca['id'] == $registry['banner'][0]['cat_id']) ? 'selected' : ''); ?>>--- <?=$ca['name']?></option>
                        <?endif;?>
                    <?endforeach;?>
                <?endforeach;?>
            </select>
        </td></tr>
    <tr>
    <tr>
        <td>ბმული (URL)</td>
        <td><input type="text" name="info[url]" value="<?input_value('info|url',$info['url']);?>"></td>
    </tr>
    <tr>
        <td>ბანერის დასახელება</td><td><input type="text" name="info[banner]" value="<?input_value('info|banner',$info['banner']);?>"/></td>
    </tr>
    <tr>
        <td>საბანერო ადგილის დასახელება</td>
        <td>
            <select name="title">
                <option>---</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>ბამერის ზომა (x-y)</td>
        <td>
            <input type="text" class="input_60" name="size_x" value="<?input_value('size_x',$registry['banner'][0]['size_x']);?>" placeholder="X"/>
            <input type="text" class="input_60" name="size_y" value="<?input_value('size_y',$registry['banner'][0]['size_y']);?>" placeholder="Y"/>
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
    <tr>
        <td>უფასო / ფასიანი</td>
        <td>
            <select name="status">
                <option value="">---</option>
                <option value="2" <?select_value('status',$registry['banner'][0]['status'],2);?>>ფასიანი</option>
                <option value="1" <?select_value('status',$registry['banner'][0]['status'],1);?>>უფასო</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>ბანერის განთავსების ვადა</td>
        <td>
            <input type="text" class="calendar input_80" name="published_at" value="<?input_value('published_at',($registry['banner'][0]['published_at'] > 0) ? date('d/m/Y',strtotime($registry['banner'][0]['published_at'])) : $_GET['from']);?>" placeholder="დან"> <input type="text" class="calendar input_80" value="<?input_value('finished_at',($registry['banner'][0]['finished_at'] > 0) ? date('d/m/Y',strtotime($registry['banner'][0]['finished_at'])) : $_GET['to']);?>" name="finished_at" placeholder="მდე">
        </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="<?=$_GET['section'];?>" value="<?=($_GET['section']=='add') ? 'დამატება' : 'რედაქტირება';?>" class="btn-green" style="border:none;"></td>
    </tr>
</table>
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
</script>