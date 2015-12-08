<? defined('_JEXEC') or die('Restricted access'); ?>
<?if(get_access('admin','tests','edit')):?>
<div class="testpage">
    <ul class="steps">
        <li class="active">ნაბიჯი 1</li>
        <li>ნაბიჯი 2</li>
        <li>ნაბიჯი 3</li>
    </ul>
    <form name="test" action="" method="post">
        <ul class="test">
            <li class="active">
                <h3>ტესტის ტიპი</h3>
                <select name="type">
                    <option value="0">ტესტი</option>
                    <option value="1" <?if($_POST['type']==1 or $registry['test'][0]['type']==1):?>selected<?endif;?>>ვიქტორინა</option>
                </select>
                <h3>გამოქვეყნების თარიღი</h3>
                <?if($_GET['section'] == 'add'):?>
                    <? @include('.dadd.php');?>
                <?else:?>
                    <? @include('.dedit.php');?>
                <?endif;?>
                <h3>ტესტის ფოტო (რეკომენდირებულია 490x255)</h3>
                <input type="text" name="img" value="<?=$registry['test'][0]['img'];?>" id="test_img" class="form-control" style="width:500px;float:left;"/>
                <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&field_id=test_img&akey=a651481913d2fedc5c880b5f14cb9859" class="btn-blue iframe-btn" style="margin-left:10px;" type="button">ფოტო</a>
                <div class="fix"></div>
                <h3>ტესტის სათაური</h3>
                <input type="text" name="title" class="form-control" value="<?if(!empty($_POST['title'])):?><?=$_POST['title'];?><?else:?><?=$registry['test'][0]['title'];?><?endif;?>">
                <h3>ტესტის ლიდი</h3>
                <textarea name="lid" class="form-control" style="height:100px;width:500px;"><?=$registry['test'][0]['lid'];?></textarea>
                <br>
                <div align="center"><a onclick="step(2,'steps','test')" class="btn-green">შემდეგი >></a></div>
            </li>
            <li>
                <?@include(".form.php");?>
                <div class="left"><a onclick="step(1,'steps','test')" class="btn-green"><< უკან</a></div>  <div class="right"><a onclick="step(3,'steps','test')" class="btn-green">შემდეგი >></a></div>
                <div class="fix"></div>
            </li>
            <li>
                <?@include(".ans.php");?>
                <div class="left"><a onclick="step(2,'steps','test')" class="btn-green"><< უკან</a></div><div class="right"><a onclick="step(4,'steps','test')" class="btn-green" ><?if($_GET['section']=='edit'):?>რედაქტირება<?else:?>გამოქვეყნება<?endif;?></a></div>
            </li>
        </ul>
    </form>
</div>
<?php endif;?>