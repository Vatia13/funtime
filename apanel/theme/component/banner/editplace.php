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
<?if($registry['banner'][0]['id'] > 0): ?>
<form method="post" action="" />
<table class="formadd">
    <tr><td class="td1">რუბრიკა</td><td>
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
        <td>
            საბანერო პოზიცია
        </td>
        <td>
            <input type="text" name="title" style="width:138px;" value="<?=(!empty($_POST['title'])) ? $_POST['title'] : $registry['banner'][0]['title'];?>"/>
        </td>

    </tr>
    <tr>
      <td>ზომა X</td><td><input type="text" class="input_60" name="size_x" value="<?=(!empty($_POST['size_x'])) ? $_POST['size_x'] : $registry['banner'][0]['size_x'];?>"/></td>
    </tr>
        <tr>
      <td>ზომა Y</td><td><input type="text" class="input_60" name="size_y" value="<?=(!empty($_POST['size_y'])) ? $_POST['size_y'] : $registry['banner'][0]['size_y'];?>"/></td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="save" value="რედაქტირება" class="btn-green" style="border:none;"/></td>
    </tr>
</table>
</form>
<?endif;?>
<?endif;?>