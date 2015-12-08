<?php defined('_JEXEC') or die('Restricted access'); ?>
<?if(get_access('admin','banners','edit')):?>
<h3>საბანერო ადგილი</h3>
<?if(!empty($message[0])):?>
    <div class="<?=$message[0]?>_box">
        <?for($i=1;$i<=count($message);$i++):?>
        <?=$message[$i]?>
        <?endfor;?>
    </div>
<?endif;?>
<form method="post" action="" />
<table class="formadd">
    <tr><td class="td1">რუბრიკა</td><td>
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
         <td>
             ბანერების რაოდენობა
         </td>
         <td>
             <select name="num">
                 <option value="">---</option>
                 <?php for($i=1;$i<=10;$i++):?>
                     <option><?php echo $i;?></option>
                 <?php endfor;?>
             </select>
         </td>
     </tr>
     <tr>
         <td colspan="2" id="banner_title">
         </td>
     </tr>
     <tr>
         <td colspan="2"><input type="submit" name="add" value="დამატება" class="btn-green" style="border:none;"/></td>
     </tr>
</table>
</form>
<script>
    jQuery(document).ready(function($){

        $('select[name="num"]').change(function(){
            var html = '<table>';
            for(var i = 1; i<=$(this).val();++i){
               html += '<tr><td width=220>ბანერი #' + i + ' დასახელება</td><td><input style="width:138px;" type="text" name="title[' + i + ']" value=""/></td></tr>' +
               '<tr><td>ზომა</td><td><input type="text" class="input_60" name="sizex[' + i + ']" value="" placeholder="X"/> <input class="input_60" type="text" name="sizey[' + i + ']" value="" placeholder="Y" /></td></tr>';
            }
            html += '</table>';
            $('#banner_title').html(html);
        });
    });
</script>


<?php @include_once('listplace.php'); ?>
<?endif;?>