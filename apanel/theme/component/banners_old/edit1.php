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
<form action="" method="post" name="banner">
<input type="hidden" name="add" value="1" />
<input type="hidden" name="id" value="<?=$registry['banner'][0]['id'];?>" />
<table class="formadd">
    <tr>
        <th width="38%"></th>
        <th><?=$registry['banner'][0]['position'];?> (<?=$registry['banner'][0]['width'];?>x<?=$registry['banner'][0]['height'];?>)</th>
        <th width="38%"></th>
    </tr>
    <tr>
        <td></td>
        <td align="left">
            <select name="date_dd">
                <?for ($i=1;$i<=31;$i++):?>
                    <?if ($i<10) $dddd='0';else $dddd='';?>
                    <?if ($i==intval(date('d',$registry['banner'][0]['date'])) and empty($_POST['date_dd'])) $sel="selected"; else $sel="";?>
                    <?if ($i==$_POST['date_dd']) $sel="selected";?>
                    <option value="<?=$i?>" <?=$sel?>><?=$dddd.$i?></option>
                <?endfor;?>
            </select>

            <select name="date_mm">
                <?for ($i=1;$i<=12;$i++):?>
                    <?if ($i<10) $dddd='0';else $dddd='';?>
                    <?if ($i==intval(date('m',$registry['banner'][0]['date'])) and empty($_POST['date_mm'])) $sel="selected"; else $sel="";?>
                    <?if ($i==$_POST['date_mm']) $sel="selected";?>
                    <option value="<?=$i?>" <?=$sel?>><?=$dddd.$i?></option>
                <?endfor;?>
            </select>

            <select name="date_yy">
                <?for ($i=2011;$i<=2100;$i++):?>
                    <?if ($i==date('Y',$registry['banner'][0]['date']) and empty($_POST['date_yy'])) $sel="selected"; else $sel="";?>
                    <?if ($i==$_POST['date_yy']) $sel="selected";?>
                    <option value="<?=$i?>" <?=$sel?>><?=$i?></option>
                <?endfor;?>
            </select>
            <select name="time_hh">
                <?for($t=0;$t<=23;$t++):?>
                    <?if ($t<10) $dddd='0';else $dddd='';?>
                    <?if ($t==intval(date('H',$registry['banner'][0]['date'])) and empty($_POST['time_hh'])) $sel="selected"; else $sel="";?>
                    <?if ($t==$_POST['time_hh']) $sel="selected";?>
                    <option value="<?=$t?>" <?=$sel?>><?=$dddd.$t?></option>
                <?endfor;?>
            </select>
            <select name="time_mm">';
                <?for($t=0;$t<=59;$t++):?>
                    <?if ($t<10) $dddd='0';else $dddd='';?>
                    <?if ($t==intval(date('i',$registry['banner'][0]['date'])) and empty($_POST['time_mm'])) $sel="selected"; else $sel="";?>
                    <?if ($t==$_POST['time_mm']) $sel="selected";?>
                    <option value="<?=$t?>" <?=$sel?>><?=$dddd.$t?></option>
                <?endfor;?>
            </select>
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
            <input type="text" name="banner" id="banner" value="<?if($_POST['banner']):?><?=$_POST['banner'];?><?else:?><?=$registry['banner'][0]['banner'];?><?endif;?>"/>
            <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=2&akey=a651481913d2fedc5c880b5f14cb9859&field_id=banner" class="btn-blue iframe-btn" type="button">აირჩიე ბანერი</a>
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