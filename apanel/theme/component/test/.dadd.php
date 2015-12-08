<? defined('_JEXEC') or die('Restricted access'); ?>
<select name="date_dd">
    <?for ($i=1;$i<=31;$i++):?>
        <?if ($i<10) $dddd='0';else $dddd='';?>
        <?if ($i==intval(date('d')) and empty($_POST['date_dd'])) $sel="selected"; else $sel="";?>
        <?if ($i==$_POST['date_dd']) $sel="selected";?>
        <option value="<?=$i?>" <?=$sel?>><?=$dddd.$i?></option>
    <?endfor;?>
</select>

<select name="date_mm">
    <?for ($i=1;$i<=12;$i++):?>
        <?if ($i<10) $dddd='0';else $dddd='';?>
        <?if ($i==intval(date('m')) and empty($_POST['date_mm'])) $sel="selected"; else $sel="";?>
        <?if ($i==$_POST['date_mm']) $sel="selected";?>
        <option value="<?=$i?>" <?=$sel?>><?=$dddd.$i?></option>
    <?endfor;?>
</select>

<select name="date_yy">
    <?for ($i=2011;$i<=2100;$i++):?>
        <?if ($i==date('Y') and empty($_POST['date_yy'])) $sel="selected"; else $sel="";?>
        <?if ($i==$_POST['date_yy']) $sel="selected";?>
        <option value="<?=$i?>" <?=$sel?>><?=$i?></option>
    <?endfor;?>
</select>
<select name="time_hh">
    <?for($t=0;$t<=23;$t++):?>
        <?if ($t<10) $dddd='0';else $dddd='';?>
        <?if ($t==intval(date('H')) and empty($_POST['time_hh'])) $sel="selected"; else $sel="";?>
        <?if ($t==$_POST['time_hh']) $sel="selected";?>
        <option value="<?=$t?>" <?=$sel?>><?=$dddd.$t?></option>
    <?endfor;?>
</select>
<select name="time_mm">
    <?for($t=0;$t<=59;$t++):?>
        <?if ($t<10) $dddd='0';else $dddd='';?>
        <?if ($t==intval(date('i'))-1 and empty($_POST['time_mm'])) $sel="selected"; else $sel="";?>
        <?if ($t==$_POST['time_mm']) $sel="selected";?>
        <option value="<?=$t?>" <?=$sel?>><?=$dddd.$t?></option>
    <?endfor;?>
</select>