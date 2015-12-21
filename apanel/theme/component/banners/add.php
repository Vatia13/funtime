<?php defined('_JEXEC') or die('Restricted access');
if($_GET['message'] == 1):
    $message[0] = "valid";
    $message[1] = "ბანერი წარმატებით დაემატა.";
endif;
?>

<?if(get_access('admin','banners','edit')):?>
    <?if(!empty($message[0])):?>
        <div class="<?=$message[0];?>_box">
            <?=$message[1];?>
        </div>
    <?endif;?>
    <?if($message[0] != "valid"):?>
    <form action="" method="post" name="banner">
        <input type="hidden" name="add" value="1" />
        <input type="hidden" name="id" value="<?=$registry['banner'][0]['id'];?>" />
        <input type="hidden" name="title" id="banner_position" value="<?=$_POST['title'];?>">
        <table class="formadd">
            <tr>
                <th width="28%"></th>
                <th>ბანერის დამატება</th>
                <th width="28%"></th>
            </tr>
            <tr>
                <td></td>
                <td>
                    <select name="filter-cat" onChange="getBannerCat(this)">
                        <option value="">აირჩიეთ რუბრიკა</option>
                        <option value="1" <?if($_POST['filter-cat'] == 1):?>selected<?endif;?>>მთავარი გვერდი</option>
                        <option value="2" <?if($_POST['filter-cat'] == 2):?>selected<?endif;?>>ტესტები</option>
                        <option value="3" <?if($_POST['filter-cat'] == 3):?>selected<?endif;?>>ვიქტორინა</option>
                        <option value="4" <?if($_POST['filter-cat'] == 4):?>selected<?endif;?>>თავსატეხი</option>
                        <?foreach($category as $cat):?>
                            <?foreach($cat as $ca):?>
                                <?if($ca['podcat']==0):?>
                                    <option value="<?=$ca['id']?>" <?if($ca['id']==$_POST['filter-cat']):?>selected<?endif;?>>- <?=$ca['name']?></option>
                                <?else:?>
                                    <option value="<?=$ca['id']?>" <?if($ca['id']==$_POST['filter-cat']):?>selected<?endif;?>>--- <?=$ca['name']?></option>
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
                        <option value="F1|800x100" <?if($_POST['name'] == 'F1|800x100'):?>selected<?endif;?>>F1 – 800x100</option>
                        <option value="F2|800x100" <?if($_POST['name'] == 'F2|800x100'):?>selected<?endif;?>>F2 – 800x100</option>
                        <option value="F3|800x100" <?if($_POST['name'] == 'F3|800x100'):?>selected<?endif;?>>F3 – 800x100</option>
                        <option value="F4|165x480" <?if($_POST['name'] == 'F4|165x480'):?>selected<?endif;?>>F4 – 165x480</option>
                        <option value="F5|165x480" <?if($_POST['name'] == 'F5|165x480'):?>selected<?endif;?>>F5 – 205x355</option>
                        <option value="SL1 L|230x600" <?if($_POST['name'] == 'SL1 L|230x600'):?>selected<?endif;?>>SL1 (L) – 230x600</option>
                        <option value="SL1 R|230x600" <?if($_POST['name'] == 'SL1 R|230x600'):?>selected<?endif;?>>SL1 (R) – 230x600</option>
                        <option value="SL2|340x200" <?if($_POST['name'] == 'SL2|340x200'):?>selected<?endif;?>>SL2 - 340x200</option>
                        <option value="ვიდეო L|150x500" <?=($_POST['name'] == 'ვიდეო L|150x500') ? 'selected' : '';?>>ვიდეო (L) - 150x500</option>
                        <option value="ვიდეო R|150x500" <?=($_POST['name'] == 'ვიდეო R|150x500') ? 'selected' : '';?>>ვიდეო (R) - 150x500</option>
                        <option value="ბრენდირება L|200x700" <?if($_POST['name'] == 'ბრენდირება L|200x700'):?>selected<?endif;?>>ბრენდირება (L) - 200x700</option>
                        <option value="ბრენდირება R|200x700" <?if($_POST['name'] == 'ბრენდირება R|200x700'):?>selected<?endif;?>>ბრენდირება (R) - 200x700</option>
                        <option value="FM|600x700" <?if($_POST['name'] == 'FM|600x700'):?>selected<?endif;?>>FM – 600x700</option>
                        <option value="F6|200x500" <?if($_POST['name'] == 'F6|200x500'):?>selected<?endif;?>>F6 – 200x500</option>
                        <option value="F7|200x500" <?if($_POST['name'] == 'F7|200x500'):?>selected<?endif;?>>F7 – 200x500</option>
                        <option value="F8|200x500" <?if($_POST['name'] == 'F8|200x500'):?>selected<?endif;?>>F8 – 200x500</option>
                        <option value="F9|200x500" <?if($_POST['name'] == 'F9|200x500'):?>selected<?endif;?>>F9 – 200x500</option>
                        <option value="F10|200x500" <?if($_POST['name'] == 'F10|200x500'):?>selected<?endif;?>>F10 – 200x500</option>
                        <option value="F11|200x500" <?if($_POST['name'] == 'F11|200x500'):?>selected<?endif;?>>F11 – 200x500</option>
                        <option value="F12|200x500" <?if($_POST['name'] == 'F12|200x500'):?>selected<?endif;?>>F12 – 200x500</option>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td align="left">
                    <input type="text" name="published_at" value="<?=$_POST['published_at'];?>" class="calendar" placeholder="ჩართვის თარიღი"/>
                    <input type="text" name="date" value="<?=$_POST['date'];?>" class="calendar" placeholder="გამორთვის თარიღი"/>
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
                    <textarea name="script" placeholder="დამატებითი javascript" class="form-control" style="height:70px"></textarea>
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
            <object data="<?=$registry['banner'][0]['banner'];?>" type="application/x-shockwave-flash" width="<?=$registry['banner'][0]['width'];?>" height="<?=$registry['banner'][0]['height'];?>"></object>
        </div>

    </form>
    <?endif;?>
<?endif;?>
