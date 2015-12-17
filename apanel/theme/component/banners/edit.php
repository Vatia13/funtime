<?php defined('_JEXEC') or die('Restricted access');
if($_GET['message'] == 1):
$message[0] = "valid";
$message[1] = "ბანერის რედაქტირება წარმატებით დასრულდა.";
endif;
?>
<?if(get_access('admin','banners','edit')):?>
<?if(!empty($message[0])):?>
<div class="<?=$message[0];?>_box">
    <?=$message[1];?>
</div>
<?endif;?>
<form action="" method="post" name="banner">
<input type="hidden" name="edit" value="1" />
<input type="hidden" name="id" value="<?=$registry['banner'][0]['id'];?>" />
<input type="hidden" name="title" id="banner_position" value="<?if(!empty($_POST['title'])):?><?=$_POST['title'];?><?else:?><?=$registry['banner'][0]['position'];?><?endif;?>">
<table class="formadd">

    <tr>
        <th width="28%"></th>
        <th><?=$registry['banner'][0]['position'];?> (<?=$registry['banner'][0]['width'];?>x<?=$registry['banner'][0]['height'];?>)</th>
        <th width="28%"></th>
    </tr>
    <tr>
        <td></td>
        <td>
            <select name="filter-cat" onChange="getBannerCat(this)">
                <option value="">აირჩიეთ რუბრიკა</option>
                <option value="1" <?=(1==$_POST['filter-cat']) ? 'selected' : ((1 == $registry['banner'][0]['cat_id']) ? 'selected' : ''); ?>>მთავარი გვერდი</option>
                <option value="2" <?=(2==$_POST['filter-cat']) ? 'selected' : ((2 == $registry['banner'][0]['cat_id']) ? 'selected' : ''); ?>>ტესტები</option>
                <option value="3" <?=(3==$_POST['filter-cat']) ? 'selected' : ((3 == $registry['banner'][0]['cat_id']) ? 'selected' : ''); ?>>ვიქტორინა</option>
                <option value="4" <?=(4==$_POST['filter-cat']) ? 'selected' : ((4 == $registry['banner'][0]['cat_id']) ? 'selected' : ''); ?>>თავსატეხი</option>
                <?foreach($category as $cat):?>
                    <?foreach($cat as $ca):?>
                        <?if($ca['podcat']==0):?>
                            <option value="<?=$ca['id']?>" <?=($ca['id']==$_POST['filter-cat']) ? 'selected' : (($ca['id'] == $registry['banner'][0]['cat_id']) ? 'selected' : ''); ?>>- <?=$ca['name']?></option>
                        <?else:?>
                            <option value="<?=$ca['id']?>" <?=($ca['id']==$_POST['filter-cat'])? 'selected' : (($ca['id'] == $registry['banner'][0]['cat_id']) ? 'selected' : ''); ?>>--- <?=$ca['name']?></option>
                        <?endif;?>
                    <?endforeach;?>
                <?endforeach;?>
            </select>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <select name="name">
                <option value="0">---</option>
                <option value="F1|800x100" <?=($_POST['name'] == 'F1|800x100') ? 'selected' : (($registry['banner'][0]['name'] == 'F1') ? 'selected' : ''); ?>>F1 – 800x100</option>
                <option value="F2|800x100" <?=($_POST['name'] == 'F2|800x100') ? 'selected' : (($registry['banner'][0]['name'] == 'F2') ? 'selected' : ''); ?>>F2 – 800x100</option>
                <option value="F3|800x100" <?=($_POST['name'] == 'F3|800x100') ? 'selected' : (($registry['banner'][0]['name'] == 'F3') ? 'selected' : ''); ?>>F3 – 800x100</option>
                <option value="F4|165x480" <?=($_POST['name'] == 'F1|165x480') ? 'selected' : (($registry['banner'][0]['name'] == 'F4') ? 'selected' : ''); ?>>F4 – 165x480</option>
                <option value="F5|165x480" <?=($_POST['name'] == 'F5|205x355') ? 'selected' : (($registry['banner'][0]['name'] == 'F5') ? 'selected' : ''); ?>>F5 – 205x355</option>
                <option value="SL1 L|230x600" <?=($_POST['name'] == 'SL1 L|230x600') ? 'selected' : (($registry['banner'][0]['name'] == 'SL1 L') ? 'selected' : ''); ?>>SL1 (L) – 230x600</option>
                <option value="SL1 R|230x600" <?=($_POST['name'] == 'SL1 R|230x600') ? 'selected' : (($registry['banner'][0]['name'] == 'SL1 R') ? 'selected' : ''); ?>>SL1 (R) – 230x600</option>
                <option value="SL2|340x200" <?=($_POST['name'] == 'SL2|340x200') ? 'selected' : (($registry['banner'][0]['name'] == 'SL2') ? 'selected' : ''); ?>>SL2 - 340x200</option>
                <option value="ბრენდირება L|150x500" <?=($_POST['name'] == 'ვიდეო L|150x500') ? 'selected' : (($registry['banner'][0]['name'] == 'ვიდეო L') ? 'selected' : '');?>>ვიდეო (L) - 150x500</option>
                <option value="ბრენდირება R|150x500" <?=($_POST['name'] == 'ვიდეო R|150x500') ? 'selected' : (($registry['banner'][0]['name'] == 'ვიდეო R') ? 'selected' : '');?>>ვიდეო (R) - 150x500</option>
                <option value="ბრენდირება L|200x700" <?=($_POST['name'] == 'ბრენდირება L|200x700') ? 'selected' : (($registry['banner'][0]['name'] == 'ბრენდირება L') ? 'selected' : '');?>>ბრენდირება (L) - 200x700</option>
                <option value="ბრენდირება R|200x700" <?=($_POST['name'] == 'ბრენდირება R|200x700') ? 'selected' : (($registry['banner'][0]['name'] == 'ბრენდირება R') ? 'selected' : '');?>>ბრენდირება (R) - 200x700</option>
                <option value="FM|600x700" <?=($_POST['name'] == 'FM|600x700') ? 'selected' : (($registry['banner'][0]['name'] == 'FM') ? 'selected' : ''); ?>>FM – 600x700</option>
                <option value="F6|200x500" <?=($_POST['name'] == 'F6|200x500') ? 'selected' : (($registry['banner'][0]['name'] == 'F6') ? 'selected' : ''); ?>>F6 – 200x500</option>
                <option value="F7|200x500" <?=($_POST['name'] == 'F7|200x500') ? 'selected' : (($registry['banner'][0]['name'] == 'F7') ? 'selected' : ''); ?>>F7 – 200x500</option>
                <option value="F8|200x500" <?=($_POST['name'] == 'F8|200x500') ? 'selected' : (($registry['banner'][0]['name'] == 'F8') ? 'selected' : ''); ?>>F8 – 200x500</option>
                <option value="F9|200x500" <?=($_POST['name'] == 'F9|200x500') ? 'selected' : (($registry['banner'][0]['name'] == 'F9') ? 'selected' : ''); ?>>F9 – 200x500</option>
                <option value="F10|200x500" <?=($_POST['name'] == 'F10|200x500') ? 'selected' : (($registry['banner'][0]['name'] == 'F10') ? 'selected' : ''); ?>>F10 – 200x500</option>
                <option value="F11|200x500" <?=($_POST['name'] == 'F11|200x500') ? 'selected' : (($registry['banner'][0]['name'] == 'F11') ? 'selected' : ''); ?>>F11 – 200x500</option>
                <option value="F12|200x500" <?=($_POST['name'] == 'F12|200x500') ? 'selected' : (($registry['banner'][0]['name'] == 'F12') ? 'selected' : ''); ?>>F12 – 200x500</option>
            </select>
        </td>
        <td></td>
    </tr>


    <tr>
        <td></td>
        <td align="left">
            <input type="text" name="published_at" value="<?if(!empty($_POST['published_at'])):?><?=$_POST['published_at'];?><?else:?><?=date('d/m/Y',$registry['banner'][0]['published_at']);?><?endif;?>" class="calendar" placeholder="ჩართვის თარიღი"/>
            <input type="text" name="date" value="<?if(!empty($_POST['date'])):?><?=$_POST['date'];?><?else:?><?=date('d/m/Y',$registry['banner'][0]['date']);?><?endif;?>" class="calendar" placeholder="გამორთვის თარიღი"/>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td align="left"><input type="text" class="inputbox" name="url" value="<?if($_POST['url']):?><?=$_POST['url'];?><?else:?><?=$registry['banner'][0]['url'];?><?endif;?>" placeholder="ბმული"></td>
        <td></td>
    </tr>

    <tr>
        <td></td>
        <td align="left">
            <textarea name="script" placeholder="დამატებითი javascript" class="form-control" style="height:70px"><?if(!empty($_POST['script'])):?><?=$_POST['script'];?><?else:?><?if(!empty($registry['banner'][0]['script'])):?><?=base64_decode($registry['banner'][0]['script']);?><?endif;?><?endif;?></textarea>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td align="left">
            <input type="text" name="banner" id="banner" value="<?if($_POST['banner']):?><?=$_POST['banner'];?><?else:?><?=$registry['banner'][0]['banner'];?><?endif;?>"/>
            <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=2&akey=f511422113d2vedc5c426b7y14cby679&field_id=banner&fldr=ბანერები&no_cookie=1" class="btn-blue iframe-btn" type="button">აირჩიე ბანერი</a>
            <br><i>HTML5 - ბანერის შემთხვევაში აირჩიეთ ბანერის .js file</i>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td align="left"><a onclick="document.banner.submit();" class="btn-green">შენახვა</a></td>
        <td></td>
    </tr>
</table>
<br><br>
<div align="center" style="text-align:center">
    <script type="text/javascript" src="/<?=$theme?>js/swiffy.js"></script>
    <script type="text/javascript" src="/<?=$theme?>js/Tweenlite.min.js"></script>
    <?=get_banner($registry['banner'][0]['name'],$registry['banner'][0]['cat_id']);?>
</div>

</form>
<?endif;?>