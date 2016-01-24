<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','article','edit')):?>
    <?if(!empty($message[0])):?>
        <div class="<?=$message[0]?>_box">
            <?=$message[1]?>
        </div>
    <?endif;?>
    <script src="<?=$theme_admin?>js/tinymce/tinymce.min.js"></script>
<script src="<?=$theme_admin?>js/news.ajax.js?ver=0.7"></script>
    <div id="addnews" style="display:block;">
<h2>სტატიის დამატება</h2>
<form method="post" action="" name="formadd" enctype="multipart/form-data"/>
<input type="hidden" name="event" value="article"/>
<input type="hidden" name="add" value="1"/>
<input type="hidden" name="op" id="operation" value="1"/>
<table class="formadd">
    <tr>
        <td class="td1">ქართული კლავიატურა</td>
        <td><input type="checkbox" name="kbd" id="geoKeys" value="0" checked /></td>
    </tr>
    <? if($user->get_property('gid') != 18 && $user->get_property('gid') != 23 && $user->get_property('gid') != 21){?>
    <tr>
        <td class="td1">ავტორი</td>
        <td>
            <select name="author">
                <option value="">---</option>
                <?php foreach($registry['authors'] as $author): ?>
                    <option value="<?=$author['id'];?>" <?if(($author['id']==$num['user'] and empty($_POST['author'])) or $author['id']==$_POST['author']):?>selected<?endif;?>><?=$author['realname'];?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
     <?}?>

    <tr><td class="td1">რუბრიკა</td><td>
            <select name="cat" class="input_100">
                <option value="">---</option>
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
                                        <option value="<?=$ca['id']?>" <?=($ca['id']==$_POST['cat']) ? 'selected' : (($_GET['cat'] == $ca['id']) ? 'selected' :'');?>>- <?=$ca['name']?></option>
                                    <?else:?>
                                        <option value="<?=$ca['id']?>" <?=($ca['id']==$_POST['cat']) ? 'selected' : (($_GET['cat'] == $ca['id']) ? 'selected' :'');?>>--- <?=$ca['name']?></option>
                                    <?endif;?>
                                <?endif;?>
                            <?endif;?>
                        <?}else{?>
                            <?if($ca['podcat']==0):?>
                                <option value="<?=$ca['id']?>" <?=($ca['id']==$_POST['cat']) ? 'selected' : (($_GET['cat'] == $ca['id']) ? 'selected' :'');?>>- <?=$ca['name']?></option>
                            <?else:?>
                                <option value="<?=$ca['id']?>" <?=($ca['id']==$_POST['cat']) ? 'selected' : (($_GET['cat'] == $ca['id']) ? 'selected' :'');?>>--- <?=$ca['name']?></option>
                            <?endif;?>
                        <?}?>
                    <?endforeach;?>
                <?endforeach;?>
            </select>
        </td></tr>
    <?if($user->get_property('gid')==22 or $user->get_property('gid')==23):?>
        <tr>
            <td class="td1">სიმბოლოები </td>
            <td>
                <ul style="list-style:none;margin:0;padding:0;border:1px solid #e7e7e7;">
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">&bdquo;</li>
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">&ldquo;</li>
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">&amp;</li>
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">&rsquo;</li>
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">&lsquo;</li>
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">&laquo;</li>
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">&raquo;</li>
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">&copy;</li>
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">&pound;</li>
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">&cent;</li>
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">&euro;</li>
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">&#8224;</li>
                    <li style="padding:10px 30px;font-size:26px;display:inline-block;">№</li>
                </ul>
            </td>
        </tr>
    <?endif;?>
<tr><td class="td1">სათაური </td><td><a class="convert" onClick='convertText("#title")'>Convert AcadNusx to Sylfaen</a><input class="inputbox" style="margin-top:5px; <?if($user->get_property('gid')==18):?>color:#000 !important;font-size:20px !important;<?endif;?>" onkeypress="return makeGeo(this,event);" onkeyup="countSymbols('#title',200)" onpaste="setTimeout(function(){return countSymbols('#title',200);},100)" id="title"  type="text" name="title" value="<?=$_POST['title'];?>" maxlength="200" /><br><i class="right">200</i></td></tr>
<tr><td class="td1">ქვესათაური </td><td><a class="convert" onClick='convertText("#title_short")'>Convert AcadNusx to Sylfaen</a><input class="inputbox" style="margin-top:5px; <?if($user->get_property('gid')==18):?>color:#000 !important;font-size:20px !important;<?endif;?>" onkeypress="return makeGeo(this,event);" onkeyup="countSymbols('#title_short',200)" onpaste="setTimeout(function(){return countSymbols('#title_short',200);},100)" type="text" id="title_short"  name="title_short" value="<?=$_POST['title_short'];?>" maxlength="200" /><br><i class="right">200</i></td></tr>

    <tr><td class="td1">გამოქვეყნების თარიღი </td><td class="td2">
	<select name="date_dd">
	  <?for ($i=1;$i<=31;$i++):?>
		<?if ($i<10) $dddd='0';else $dddd='';?>
		<?if ($i==(($_GET['D']) ? $_GET['D']:intval(date('d'))) and empty($_POST['date_dd'])) $sel="selected"; else $sel="";?>
		<?if ($i==$_POST['date_dd']) $sel="selected";?>
		<option value="<?=$i?>" <?=$sel?>><?=$dddd.$i?></option>
	   <?endfor;?>
	</select>

	<select name="date_mm">
	  <?for ($i=1;$i<=12;$i++):?>
		<?if ($i<10) $dddd='0';else $dddd='';?>
		<?if ($i==(($_GET['M']) ? $_GET['M']:intval(date('m'))) and empty($_POST['date_mm'])) $sel="selected"; else $sel="";?>
		<?if ($i==$_POST['date_mm']) $sel="selected";?>
		<option value="<?=$i?>" <?=$sel?>><?=$dddd.$i?></option>
	   <?endfor;?>
	</select>

	<select name="date_yy">
	  <?for ($i=2011;$i<=2100;$i++):?>
		<?if ($i==(($_GET['Y']) ? $_GET['Y']:intval(date('Y'))) and empty($_POST['date_yy'])) $sel="selected"; else $sel="";?>
		<?if ($i==$_POST['date_yy']) $sel="selected";?>
		<option value="<?=$i?>" <?=$sel?>><?=$i?></option>
	  <?endfor;?>
	</select>
	<select name="time_hh">
	  <?for($t=0;$t<=23;$t++):?>
		<?if ($t<10) $dddd='0';else $dddd='';?>
		<?if ($t==(($_GET['H']) ? $_GET['H']:intval(date('H'))) and empty($_POST['time_hh'])) $sel="selected"; else $sel="";?>
		<?if ($t==$_POST['time_hh']) $sel="selected";?>
		<option value="<?=$t?>" <?=$sel?>><?=$dddd.$t?></option>
	  <?endfor;?>
	</select>
	<select name="time_mm">
	  <?for($t=0;$t<=59;$t++):?>
		<?if ($t<10) $dddd='0';else $dddd='';?>
		<?if ($t==(($_GET['I']) ? $_GET['I']:intval(date('i'))-1) and empty($_POST['time_mm'])) $sel="selected"; else $sel="";?>
		<?if ($t==$_POST['time_mm']) $sel="selected";?>
		<option value="<?=$t?>" <?=$sel?>><?=$dddd.$t?></option>
	  <?endfor;?>
	</select>
</td></tr>

<tr style="display:none;"><td class="td1">წვდომა</td><td>
		<input type="checkbox" value="0" name="group[]"> ყველა<br/>
		<?foreach($groups as $gr):?>
		<input type="checkbox" value="<?=$gr['id']?>" name="group[]" <?if($gr['id'] == $user->get_property('gid')):?>checked<?endif;?>> <?=$gr['name']?><br/>
		<?endforeach;?>
</td></tr>

    <tr>
        <td height="20px"></td><td></td>
    </tr>
    <tr>
        <td class="td1">Youtube URL</td>
        <td><input type="text" class="inputbox" name="youtube" value="<?if(!empty($_POST['youtube'])){echo $_POST['youtube'];}?>"/></td>
    </tr>

    <tr>
        <td height="20px"></td><td></td>
    </tr>
                     <tr id="photoSlide1">
                            <td>ფოტოსლაიდი</td>
                            <td>
                                <?include('.slide_html.php');?> 
                            </td> 
                        </tr>
    <tr>
        <td class="td1">ლიდი</td>
        <td>
            <script src="<?=$theme_admin?>js/convert.js"></script>
            <script>
                tinymce.init({
                    selector: "textarea.tinymce",
                    menubar: false,
                    setup: function(editor) {
                        editor.on('keydown', function(e) {
                            keyDownTextField(e);
                        });
                        editor.on('keyup', function(e) {
                            keyUpTextField(e);
                        });
                    },
                    plugins: [
                        "autolink lists link image charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                        "nonbreaking save contextmenu directionality",
                        "Convert paste textcolor colorpicker textpattern"
                    ],
                    //entity_encoding : "numeric",
                    //toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                    toolbar1: "Convert | undo redo | bold italic underline | link unlink anchor | boldcolor forecolor backcolor  |  fontselect",
                    <? if($user->get_property('gid')==18 or $user->get_property('gid')==22):?>
                    content_css : "<?=$theme_admin?>css/tiny_lid_o.css",
                    <?else:?>
                    content_css : "<?=$theme_admin?>css/tiny_lid.css",
                    <?endif;?>
                    font_formats: "Nino Mtavruli = BPGNinoMtavruliRegular;"+
                        "Ingiri = BPGIngiri2008Regular;" +
                        "Open Sans = Open Sans;"+
                        "Bebas = bebasregular;"
                });
            </script>

            <textarea name="lidi" id="lidi" maxlength="300" onkeyup="countSymbols('#lidi',300)" onpaste="setTimeout(function(){return countSymbols('#lidi',300);},100)" onkeypress="return makeGeo(this,event);" style="width: 100%;height:70px; margin-top:5px; <?if($user->get_property('gid')==18):?>color:#000 !important;font-size:20px !important;<?endif;?>" class="tinymce"><?=$_POST['lidi'];?></textarea>
            <br><i class="right">300</i>
        </td>
    </tr>
    <tr>
        <td>
            <span class="title-table">ტექსტი</span>
        </td>
        <td>
            <textarea name="textarea1" maxlength="50000" class="tinymce" onkeypress="return makeGeo(this,event);" onkeyup="countSymbols('#textarea1',50000)" onpaste="setTimeout(function(){return countSymbols('#textarea1',50000);},100)" id="textarea1" style="width: 100%;height:300px; margin-top:5px;<?if($user->get_property('gid')==18):?>color:#000 !important;font-size:20px !important;<?endif;?>"><?=$_POST['textarea1'];?></textarea>
            <br><i class="right">50000</i>
        </td>
    </tr>

    <tr>
                        <td>ფოტოგრაფი</td><td><input type="text" name="phg" value="<?=($_POST['phg']) ? $_POST['phg'] : $num['phg'];?>" placeholder="სახელი, გვარი">
                            <? $photographer = ['ალექსანდრე სხულუხია','ნათია სიჭინავა','ნინი მანდარია','სალვატორე კოსტა'];//$DB->getAll('SELECT name FROM #__phgrapher order by name ASC'); ?>
                            <?if(count($photographer) > 0):?>
                                <select name="photographer">
                                    <option>---</option>
                                    <?foreach($photographer as $name):?>
                                        <option <?=($name == $_POST['phg']) ? 'selected' : '';?>><?=$name;?></option>
                                    <?endforeach;?>
                                </select>
                            <?endif;?>
                        </td>
    </tr>
    <tr>
        <td colspan="2"><hr></td>
    </tr>
    <tr>
        <td>წყარო</td><td><input type="text" name="copy[title]" value="<?=$_POST['copy']['title'];?>" placeholder="დასახელება"> <input type="text" name="copy[url]" value="<?=$_POST['copy']['url'];?>"  placeholder="ბმული" style="width:80%;"></td>
    </tr>
    <tr>
        <td colspan="2"><hr></td>
    </tr>

    <tr>
        <td>მისამართი</td><td><input class="inputbox" type="text" name="info[address]" value="<?=$_POST['info']['address']?>" style="width:300px"/></td>
    </tr>
    <tr>
        <td>Facebook</td><td><input class="inputbox" type="text" name="info[facebook]" value="<?=$_POST['info']['facebook']?>" style="width:300px"/></td>
    </tr>
    <tr>
        <td>Skype</td><td><input class="inputbox" type="text" name="info[skype]" value="<?=$_POST['info']['skype']?>" style="width:300px"/></td>
    </tr>
    <tr>
        <td>მობილური</td><td><input class="inputbox" type="text" name="info[mobile]" value="<?=$_POST['info']['mobile']?>" style="width:300px"/></td>
    </tr>
    <tr>
        <td>ტელეფონი</td><td><input class="inputbox" type="text" name="info[phone]" value="<?=$_POST['info']['phone']?>" style="width:300px"/></td>
    </tr>
    <tr>
        <td>ელ.ფოსტა</td><td><input class="inputbox" type="text" name="info[email]" value="<?=$_POST['info']['email']?>" style="width:300px"/></td>
    </tr>
    <tr>
        <td>ვებ.გვერდი</td><td><input class="inputbox" type="text" name="info[website]" value="<?=$_POST['info']['website']?>" style="width:300px"/></td>
    </tr>
</table>

</div>


<a onClick="doOp(2,null,document.formadd);" class="btn-yellow">შენახვა</a>

    <a onClick="doOp(1,null,document.formadd);" class="btn-green right">
       <?if($user->get_property('gid')==18){?>
         რედაქტორთან გაგზავნა
       <?}else if($user->get_property('gid')==22 or $user->get_property('gid')==21){?>
         სტილისტ-კორექტორთან გაგზავნა
       <?}else if($user->get_property('gid')==23){?>
         ადმინისტრატორთან გაგზავნა
       <?}else{?>
         გამოქვეყნება
       <?}?>
    </a>
    <?if($user->get_property('gid')==21):?>
        <a onClick="doOp(4,null,document.formadd);" class="btn-green right" style="margin-right:10px;">რედაქტორთან გაგზავნა</a>
    <?endif;?>
    <?if($user->get_property('gid')==22 or $user->get_property('gid')==21){?>
        <a onClick="doOp(3,null,document.formadd);" class=" right" style="border-radius:4px;background-color:#005fb3;cursor:pointer;padding:5px 15px;margin-right:10px;color:#FFF;text-decoration:none;font-family: 'BPGMrgvlovani';font-size: 13px">ადმინისტრატორთან გაგზავნა</a>
    <?}?>
</form></div>

<?endif;?>

<script>
    $(document).ready(function(){
        $('select[name="photographer"]').change(function(){
            $('input[name="phg"]').val($(this).val());
        });
    });
</script>
<input type="hidden" name="image_dirs" id="image_dirs" value="" />
<script src="<?=$theme_admin;?>js/test.js?ver=1.3"></script>