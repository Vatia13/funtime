<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','article','edit')):
    $photo_concurs = false;
    $err = array();
    $id=intval($_GET['edit']);
    $all = $DB->getAll('SELECT #__news.*, #__category.name,#__category.cat_chpu, #__category.design, #__category.type FROM #__news
		LEFT JOIN #__category ON #__category.id=#__news.cat WHERE #__news.id='.$id);
    if (count($all)>0):
        foreach($all as $num):
            $info = unserialize($num['info']);
            $copy = unserialize($num['copy']);
            if (!empty($num['thumbs']))://http://rche.ru/cms/images/1/100/100/1/83341552_ava.png
                $split=explode('/',$num['thumbs']);
                //$img_path='../images/news/prev/0/0/0/'.$split[5];
                $img_path = $num['thumbs'];
                $size = @GetImageSize($num['thumbs']);
                if($size[0]>200 or intval($size[0])==0)$w=200;else $w='';
            endif;
            if($num['user_block'] > 0){
                if($num['user_block'] !== $user->get_property('userID')){
                    $err[0] = 'error';
                    $err[1] = 'შერჩეული სტატია დაბლოკილია სხვა მომხმარებლის მიერ.';
                }
            }
            if($user->get_property('gid') !== 24 && $user->get_property('gid') !== 25 && $user->get_property('gid') !== 21 && $user->get_property('gid') !== 22){
                if($num['moderate'] == 1){
                    $err[0] = 'error';
                    $err[1] = 'შეუძლებელია გამოქვეყნებული სტატიის რედაქტირება.';
                }
            }
            ?>
            <h2>ჩანაწერის რედაქტირება, ID <?=$num['id']?>: </h2>
            <!-- Load TinyMCE -->

            <? //if($user->get_property('userID') == 696):?>

            <script src="<?=$theme_admin?>js/tinymce/tinymce.test.min3.js"></script>
            <?//else:?>
            <!--<script src="<?//=$theme_admin?>js/tinymce/tinymce.min.js"></script>-->
            <?//endif;?>
            <script src="<?=$theme_admin?>js/convert.js?ver=1.1"></script>
            <script src="<?=$theme_admin?>js/LastNews3.js"></script>
            <?if($user->get_property('gid')==18 or $user->get_property('gid')==21 or $user->get_property('gid')==22 or $user->get_property('gid')==23):?>
            <script>
                tinymce.init({
                    selector: "textarea.tinymce",
                    setup: function(editor) {
                        editor.on('keydown', function(e) {
                            keyDownTextField(e);
                        });
                        editor.on('keyup', function(e) {
                            keyUpTextField(e);
                        });
                    },
                    menubar: false,
                    <? if($user->get_property('gid')==18 or $user->get_property('gid')==21 or $user->get_property('gid')==22 or $user->get_property('gid')==23):?>
                    content_css : "<?=$theme_admin?>css/tiny_lid_o.css",
                    <?else:?>
                    content_css : "<?=$theme_admin?>css/custom.css",
                    <?endif;?>
                    plugins: ["advlist autolink lists","code","Convert"],
                    toolbar1: "Convert LastNews | undo redo | bold italic underline | print preview code "
                });
            </script>
            <script>
                tinymce.init({
                    selector: "textarea.tinymce_short",
                    setup: function(editor) {
                        editor.on('keydown', function(e) {
                            keyDownTextField(e);
                        });
                        editor.on('keyup', function(e) {
                            keyUpTextField(e);
                        });
                    },
                    menubar: false,
                    plugins: [
                        "autolink lists link image charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                        "nonbreaking save contextmenu directionality",
                        "Convert paste textcolor colorpicker textpattern"
                    ],
                    //entity_encoding : "numeric",
                    //toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                    toolbar1: "Convert | undo redo | bold italic underline | link unlink anchor | boldcolor forecolor backcolor  |  fontselect",
                    content_css : "<?=$theme_admin?>css/tiny_lid_o.css",
                    font_formats: "Nino Mtavruli = BPGNinoMtavruliRegular;"+
                    "Ingiri = BPGIngiri2008Regular;" +
                    "Open Sans = Open Sans;"+
                    "Bebas = bebasregular;"
                });
            </script>
        <?else:?>
            <script>
                tinymce.init({
                    selector: "textarea.tinymce",theme: "modern",
                    setup: function(editor) {
                        editor.on('keydown', function(e) {
                            keyDownTextField(e);
                        });
                        editor.on('keyup', function(e) {
                            keyUpTextField(e);
                        });
                    },
                    plugins: [
                        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                        "insertdatetime media nonbreaking save table contextmenu directionality",
                        "Convert LastNews emoticons template paste textcolor colorpicker textpattern responsivefilemanager newmedia"
                    ],
                    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                    toolbar2: "Convert LastNews | responsivefilemanager | link unlink anchor | image media imgal | boldcolor forecolor backcolor  | print preview code | fontselect fontsizeselect | newmedia",
                    image_advtab: true ,
                    plugin_preview_width : "920",
                    //entity_encoding : "numeric",

                    content_css : "<?=$theme_admin?>css/custom.css",
                    font_formats: "Nino Mtavruli = BPGNinoMtavruliRegular;"+
                    "Ingiri = BPGIngiri2008Regular;"+
                    "Open Sans = Open Sans;"+
                    "Bebas = bebasregular;",
                    filemanager_access_key:"a651481913d2fedc5c880b5f14cb9859" ,
                    external_filemanager_path:"http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/",
                    filemanager_title:"Responsive Filemanager" ,
                    external_plugins: { "filemanager" : "http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/plugin.js?ver=0.2"}
                });


            </script>
            <script>
                tinymce.init({
                    selector: "textarea.tinymce_short",
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
                        "paste textcolor colorpicker textpattern"
                    ],
                    //entity_encoding : "numeric",
                    //toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                    toolbar1: "undo redo | bold italic underline | link unlink anchor | forecolor backcolor  | print code | fontselect",
                    content_css : "<?=$theme_admin?>css/tiny_lid.css",
                    font_formats: "Nino Mtavruli = BPGNinoMtavruliRegular;"+
                    "Ingiri = BPGIngiri2008Regular;"+
                    "Open Sans = Open Sans;"+
                    "Bebas = bebasregular;"
                });
            </script>
            <!-- /TinyMCE -->

        <?endif;?>
            <script src="<?=$theme_admin?>js/news.ajax.js?ver=0.7"></script>
            <?if(!empty($message[0])):?>
            <div class="<?=$message[0]?>_box">
                <?=$message[1]?>
            </div>
        <?endif;?>
            <?if(!empty($err[0])):?>
            <div class="<?=$err[0];?>_box">
                <?=$err[1];?>
            </div>
        <?endif;?>
            <form method="post" id="update_data_form" name="formedit" action="" enctype="multipart/form-data">
                <input type="hidden" name="event" value="article"/>
                <input type="hidden" name="update" value="1"/>
                <input type="hidden" name="send_time" value="<?=$num['send_time']?>"/>
                <input type="hidden" name="preview" id="preview_article" value="0" />
                <input type="hidden" name="id" value="<?=$num['id']?>"/>
                <input type="hidden" name="op" id="operation" value="<?=$num['op']?>"/>
                <input type="hidden" name="cat_type" value="<?=$num['type']?>"/>
                <?if(empty($err[0])):?>
                <table class="formadd">
                    <tr>
                        <td class="td1">ქართული კლავიატურა</td>
                        <td><input type="checkbox" name="kbd" id="geoKeys" value="0" checked /></td>
                    </tr>
                    <? if($user->get_property('gid') != 18){?>
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
                    <tr><td class="td1">რუბრიკა</td><td><select name="cat">
                                <option value="">---</option>
                                <?foreach($category as $cat):?>
                                    <?foreach($cat as $ca):?>
                                        <?if($ca['id']==$num['cat']): $rubname = $ca['name']; endif;?>
                                        <? if($user->get_property('gid') == 18 or $user->get_property('gid') == 21){?>
                                            <? $authors = unserialize($ca['users']);?>
                                            <?if(in_array($user->get_property('userID'),$authors)):?>
                                                <?if($ca['podcat']==0):?>
                                                    <option value="<?=$ca['id']?>" <?if($ca['id']==$num['cat']): if($ca['type'] == '1'): $photo_concurs = true; endif;?>selected<?endif;?> data-type="<?=$ca['type']?>">- <?=$ca['name']?></option>
                                                <?else:?>
                                                    <option value="<?=$ca['id']?>" <?if($ca['id']==$num['cat']): if($ca['type'] == '1'): $photo_concurs = true; endif;?>selected<?endif;?> data-type="<?=$ca['type']?>">--- <?=$ca['name']?></option>
                                                <?endif;?>
                                            <?endif;?>
                                        <?}else{?>
                                            <?if($ca['podcat']==0):?>
                                                <option value="<?=$ca['id']?>" <?if($ca['id']==$num['cat']):  if($ca['type'] == '1'): $photo_concurs = true; endif;?>selected<?endif;?> data-type="<?=$ca['type']?>">- <?=$ca['name']?></option>
                                            <?else:?>
                                                <option value="<?=$ca['id']?>" <?if($ca['id']==$num['cat']):  if($ca['type'] == '1'): $photo_concurs = true; endif;?>selected<?endif;?> data-type="<?=$ca['type']?>">--- <?=$ca['name']?></option>
                                            <?endif;?>
                                        <?}?>
                                        <?if($ca['id'] == $num['cat']):?>
                                            <? $is_saknatuna = $ca['test'];?>
                                        <?endif;?>
                                    <?endforeach;?>
                                <?endforeach;?>
                                <?if ($num['show_date']==1) $shy=' selected'; else $shn=' selected';?>
                                <?if ($num['comments']==1) $shy2=' selected'; else $shn2=' selected';?>
                            </select> </td></tr>
                    <?if($user->get_property('gid')==22 or $user->get_property('gid')==23):?>
                        <tr>
                            <td class="td1">სიმბოლოები</td>
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
                    <tr><td class="td1">სათაური </td><td><a class="convert" onClick='convertText("#title")'>Convert AcadNusx to Sylfaen</a><input class="inputbox" style="margin-top:5px; <?if($user->get_property('gid')!=24 && $user->get_property('gid')!=25):?>color:#000 !important;font-size:22px !important;<?endif;?>" onkeypress="return makeGeo(this,event);" onkeyup="countSymbols('#title',200)" onpaste="setTimeout(function(){return countSymbols('#title',200);},100)" id="title"  type="text" name="title" value="<?=(PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])))) ? stripslashes(PHP_slashes(htmlspecialchars(strip_tags($_POST['title'])))) : $num['title'];?>" maxlength="200" />

                            <br><i class="right">200</i></td></tr>
                    <tr><td class="td1">ქვესათაური </td><td><a class="convert" onClick='convertText("#title_short")'>Convert AcadNusx to Sylfaen</a><input class="inputbox" style="margin-top:5px; <?if($user->get_property('gid')!=24 && $user->get_property('gid')!=25):?>color:#000 !important;font-size:22px !important;<?endif;?>" onkeypress="return makeGeo(this,event);" onkeyup="countSymbols('#title_short',200)" onpaste="setTimeout(function(){return countSymbols('#title_short',200);},100)" type="text" id="title_short"  name="title_short" value="<?=(PHP_slashes(htmlspecialchars(strip_tags($_POST['title_short'])))) ? stripslashes(PHP_slashes(htmlspecialchars(strip_tags($_POST['title_short'])))) : $num['title_short'];?>" maxlength="200" /><br><i class="right">200</i></td></tr>
                    <?if($user->get_property('gid') == 24 or $user->get_property('gid') == 25):?>
                        <tr>
                            <td class="td1">ვიქტორინის მიმაგრება</td>
                            <td>
                                <select name="victo">
                                    <option value="0">--</option>
                                    <?foreach($registry['victo'] as $vic):?>
                                        <option value="<?=$vic['id'];?>" <?if($vic['id'] == $num['test']):?>selected<?else:?><?endif;?>><?=$vic['title'];?></option>
                                    <?endforeach;?>
                                </select>
                            </td>
                        </tr>
                    <?endif;?>
                    <tr>
                        <td height="20px"></td><td></td>
                    </tr>
                    <tr><td class="td1">გამოქვეყნების თარიღი</td><td class="td2">
                            <select name="date_dd">
                                <?for ($i=1;$i<=31;$i++):?>
                                    <?if ($i<10) $dddd='0';else $dddd='';?>
                                    <?if ($i==intval(date('d',$num['date'])) and empty($_POST['date_dd'])) $sel="selected"; else $sel="";?>
                                    <?if ($i==$_POST['date_dd']) $sel="selected";?>
                                    <option value="<?=$i?>" <?=$sel?>><?=$dddd.$i?></option>
                                <?endfor;?>
                            </select>

                            <select name="date_mm">
                                <?for ($i=1;$i<=12;$i++):?>
                                    <?if ($i<10) $dddd='0';else $dddd='';?>
                                    <?if ($i==intval(date('m',$num['date'])) and empty($_POST['date_mm'])) $sel="selected"; else $sel="";?>
                                    <?if ($i==$_POST['date_mm']) $sel="selected";?>
                                    <option value="<?=$i?>" <?=$sel?>><?=$dddd.$i?></option>
                                <?endfor;?>
                            </select>

                            <select name="date_yy">
                                <?for ($i=2011;$i<=2100;$i++):?>
                                    <?if ($i==date('Y',$num['date']) and empty($_POST['date_yy'])) $sel="selected"; else $sel="";?>
                                    <?if ($i==$_POST['date_yy']) $sel="selected";?>
                                    <option value="<?=$i?>" <?=$sel?>><?=$i?></option>
                                <?endfor;?>
                            </select>
                            <select name="time_hh">
                                <?for($t=0;$t<=23;$t++):?>
                                    <?if ($t<10) $dddd='0';else $dddd='';?>
                                    <?if ($t==intval(date('H',$num['date'])) and empty($_POST['time_hh'])) $sel="selected"; else $sel="";?>
                                    <?if ($t==$_POST['time_hh']) $sel="selected";?>
                                    <option value="<?=$t?>" <?=$sel?>><?=$dddd.$t?></option>
                                <?endfor;?>
                            </select>
                            <select name="time_mm">';
                                <?for($t=0;$t<=59;$t++):?>
                                    <?if ($t<10) $dddd='0';else $dddd='';?>
                                    <?if ($t==intval(date('i',$num['date'])) and empty($_POST['time_mm'])) $sel="selected"; else $sel="";?>
                                    <?if ($t==$_POST['time_mm']) $sel="selected";?>
                                    <option value="<?=$t?>" <?=$sel?>><?=$dddd.$t?></option>
                                <?endfor;?>
                            </select>
                            <?if($user->get_property('gid')!==18 && $user->get_property('gid')!==21 && $user->get_property('gid')!==22 && $user->get_property('gid')!==23):?>
                    <tr>
                        <td height="20px"></td><td></td>
                    </tr>
                    <tr>
                        <td>Facebook ფოტო (470x247) <?if(!empty($num['fb'])):?><br><br><img src="/img/uploads/news/fb/<?=$num['fb'];?>" width="150"><?endif;?></td><td><input type="hidden" name="fbf" value="<?=$num['fb'];?>"><input type="file" id="facebook_image" name="fb"/></td>
                    </tr>
                    <tr>
                        <td height="10px"></td><td></td>
                    </tr>
                    <tr><td class="td1">ფოტო პრევიუ <i>(655x440)</i>

                        </td><td valign="top"><input type="hidden" name="photop" value="<?=$num['thumbs'];?>"><input id="prphoto" type="file" name="photo"/></td></tr>
                <!--<tr><td class="td1">კომენტარები</td><td><select name="comments" class="inputbox">
			<option value="0" <?=$shn2?>>გამორთული</option>
			<option value="1" <?=$shy2?>>ჩართული</option>
		</select></td></tr>
		<tr><td class="td1">აჩვენე თარიღი</td><td><select name="show_date" class="inputbox">
			<option value="0" <?=$shn?>>არა</option>
			<option value="1" <?=$shy?>>კი</option>
		</select></td></tr>-->

                    <tr>
                        <td height="10px"></td><td></td>
                    </tr>
                <? if(!empty($num['color']) or $num['color'] != "N;"): $col = unserialize($num['color']); endif;?>
                    <tr>
                        <td>
                            აირჩიეთ ჩარჩოს ფერი <div id="colorSelector"><div style="background-color: <?if($_POST['framecolor']){?><?=$_POST['framecolor'];?><?}else if(!empty($col['frame'])){?><?=$col['frame'];?><?}else{?>#ed4321<?}?>;"></div></div> <input type="hidden" name="framecolor" value="<?if($_POST['framecolor']){?><?=$_POST['framecolor'];?><?}else if(!empty($col['frame'])){?><?=$col['frame'];?><?}else{?>#ed4321<?}?>"/><br>
                            აირჩიეთ რუბრიკის ფერი <div id="colorSelector1"><div style="background-color: <?if($_POST['rubcolor']){?><?=$_POST['rubcolor'];?><?}else if(!empty($col['rubric'])){?><?=$col['rubric'];?><?}else{?>#ed4321<?}?>;"></div></div> <input type="hidden" name="rubcolor" value="<?if($_POST['rubcolor']){?><?=$_POST['rubcolor'];?><?}else if(!empty($col['rubric'])){?><?=$col['rubric'];?><?}else{?>#ed4321<?}?>"/>
                        </td>

                        <td>
                            <div id="primageframe">
                                <div style="position:relative;<?if(empty($img_path)):?>display:none;<?endif;?>max-width:655px;max-height:440px;height:440px;width:655px;overflow:hidden;border-style:solid;border-width: 20px;border-color:<?if($_POST['framecolor']){?><?=$_POST['framecolor'];?><?}else if(!empty($col['frame'])){?><?=$col['frame'];?><?}else{?>#ed4321<?}?>;">
                                    <img id="sample_picture" src="<?=$img_path;?>" />
                                    <h3 style="padding:18px 10px 15px;color:#FFF;font-weight:500;font-size:18px;opacity:0.8;font-family:BPGNinoMtavruliRegular;position:absolute;right:0;bottom:30px;background-color:<?if($_POST['rubcolor']){?><?=$_POST['rubcolor'];?><?}else if(!empty($col['rubric'])){?><?=$col['rubric'];?><?}else{?>#ed4321<?}?>;"><?=$rubname;?></h3>
                                </div>
                            </div>


                        </td>

                    </tr>

                <?endif;?>

                    <tr>
                        <td height="20px"></td><td></td>
                    </tr>
                    <tr>
                        <td class="td1">Youtube URL</td>
                        <td><input type="text" class="inputbox" name="youtube" value="<?if(!empty($_POST['youtube'])){echo $_POST['youtube'];}elseif(!empty($num['youtube'])){ echo "https://www.youtube.com/watch?v=".$num['youtube'];}else{echo "";}?>"</td>
                    </tr>
                    <tr>
                        <td height="20px"></td><td></td>
                    </tr>

                    <?if($user->get_property('gid')!==18 && $user->get_property('gid')!==21 && $user->get_property('gid')!==22 && $user->get_property('gid')!==23):?>
                        <?if($is_saknatuna == false):?>
                            <tr class="hide_design">
                                <td class="td1">დიზაინი</td>
                                <td>
                                    <ul class="design">
                                        <?foreach($registry['design'] as $item):?>
                                            <?php if($item['id'] == $num['design'] && $_POST['style'] <= 0 && $num['style'] <= 0):?>
                                            <script>
                                                $(document).ready(function(){
                                                    show_design_img('<?=$item["size"];?>');
                                                });
                                            </script>
                                        <?php endif; ?>
                                            <li onmouseover="imgShow(this)" onmouseout="imgHide(this)" onclick="checkInput(this)"><input type="radio" onclick="show_design_img('<?=$item["size"];?>')" name="style" value="<?=$item['id'];?>" <?if($_POST['style'] > 0){ if($_POST['style'] == $item['id']){$vsz = $item['size'];?>checked<?}}else if($num['style'] == $item['id']){ $sz = $item['size'];?>checked<?}elseif($item['id'] == $num['design'] && $num['style'] <= 0) {?> checked <?}?> /> <?=$item['id'];?><img src="<?=$item['img'];?>"></li>
                                        <?endforeach;?>
                                    </ul>

                                </td>
                            </tr>
                        <?else:?>
                            <input type="hidden" name="style" value="100" />
                        <?endif;?>
                        <input type="hidden" name="imgsz" value="<?if(!empty($_POST['style'])){?><?=$vsz;?><?}elseif(!empty($num['img']) or !empty($num['style'])){?><?if(empty($sz)){echo '695x445';}else{echo $sz;}?><?}?>"/>
                        <input type="hidden" name="newimgsz" value="<?if(!empty($_POST['style'])){?><?=$vsz;?><?}elseif(!empty($num['img']) or !empty($num['style'])){?><?if(empty($sz)){echo '695x445';}else{echo $sz;}?><?}?>"/>
                        <tr class="hide_design">
                            <td height="20px"></td><td></td>
                        </tr>
                        <tr class="<?if(empty($num['img'])):?>hide_design design-img<?endif;?>">
                            <td class="td1">დიზაინის ფოტო

                            </td>
                            <input type="hidden" name="desimg" value="<?=$num['img'];?>"/>

                            <td class="input-img">
                                <span><?if($is_saknatuna == false):?><?if(!empty($_POST['style'])){?>(<?=$vsz;?>)<?}elseif(!empty($num['img']) or !empty($num['style'])){?>(<?=$sz;?>)<?}?><?else:?>(695x445)<?endif;?></span>
                                <input type="file" name="img" id="imgInp"/>
                                <br> <br>

                                <div id="picinside">
                                    <?if($is_saknatuna == true):?>
                                        <script>
                                            $(document).ready(function(){
                                                show_design_img('695x445');
                                            });
                                        </script>
                                    <?endif;?>
                                    <? $ins = explode('x',($is_saknatuna) ? '695x445' : $sz); ?>
                                    <div style="position:relative;<?if(empty($num['img'])):?>display:none;<?endif;?>height:<?=$ins[1];?>px;width:<?=$ins[0];?>px;overflow:hidden;border-style:solid;border-width: 20px;border-color:<?if($_POST['framecolor']){?><?=$_POST['framecolor'];?><?}else if(!empty($col['frame'])){?><?=$col['frame'];?><?}else{?>#ed4321<?}?>;">
                                        <img id="picture_inside" src="../img/uploads/news/read/<?=$num['img']?>" />
                                        <h3 style="padding:18px 10px 15px;color:#FFF;font-weight:500;font-size:18px;opacity:0.8;font-family:BPGNinoMtavruliRegular;position:absolute;right:0;bottom:30px;background-color:<?if($_POST['rubcolor']){?><?=$_POST['rubcolor'];?><?}else if(!empty($col['rubric'])){?><?=$col['rubric'];?><?}else{?>#ed4321<?}?>;"><?=$rubname;?></h3>
                                    </div>
                                </div>

                            </td>
                        </tr>


                        <tr>
                            <td height="10px"></td><td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div id="data">
                                    <input type="hidden" id="inleft" name="left" value="0">
                                    <input type="hidden" id="intop" name="top" value="0">

                                    <input type="hidden" id="pleft" name="pleft" value="0">
                                    <input type="hidden" id="ptop" name="ptop" value="0">
                                </div>
                            </td>
                        </tr>
                           <?endif;?>
                        <tr id="photoSlide1">
                            <td>ფოტოსლაიდი</td>
                            <td>
                                <?include('.slide_html.php');?>
                            </td>
                        </tr>
                    <?if($user->get_property('gid')!==18 && $user->get_property('gid')!==21 && $user->get_property('gid')!==22 && $user->get_property('gid')!==23):?>
                        <tr id="photoSlide2" style="display:none;">
                            <td class="td1" valign="top"><b>ფოტოკონკურსი</b><input type="hidden" name="phconc" value="<?=$photo_concurs;?>"/></td>
                            <td valign="top">
                                კონკურსანტების რაოდენობა <input type="text" value="" name="concursant_number" class="inputbox" style="width:60px;padding:5px 5px 7px 5px;"/>
                                ფოტოების რაოდენობა
                                <select name="concursant_image_number" style="width:60px;padding:5px 5px 7px 5px;">
                                    <option value="">---</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select> <a class="btn-green" onClick="photoConcurs()">+ დამატება</a> <a class="btn" style="margin-left:100px;" onClick="clearConcurs()">გაწმენდა</a>

                                <div id="concursant_place" class="photo-slide">

                                    <table>
                                        <?php
                                        if($photo_concurs == true){
                                            $registry['concursants'] = $DB->getAll("SELECT * FROM #__news_gallery_com WHERE news_id='".$num['id']."'");

                                            if(!empty($registry['concursants'][0]['gallery'])){
                                                $concursants_array = (count($_POST['concurs']) > 0) ? $_POST['concurs'] : unserialize($registry['concursants'][0]['gallery']);?>

                                                <?php if(is_array($concursants_array) && count($concursants_array) > 0):?>
                                                    <?php $i=0; foreach($concursants_array as $concursant): $i++;?>
                                                        <tr>
                                                            <td valign="top"> <?=$i;?>. <input type="text" name="concurs[<?=$i;?>][name]" class="concurs_names" id="concursant_name<?=$i;?>"  value="<?=$concursant['name'];?>" placeholder="კონკურსანტის ვინაობა" ></td>
                                                            <td>
                                                                <?php for($a=0; $a<count($concursant['img']); $a++):?>
                                                                    <p>
                                                                        <input type="text" name="concurs[<?=$i;?>][img_name][]" class="concurs_image_names_<?=$i;?>" value="<?=$concursant['img_name'][$a];?>" placeholder="ფოტოს დასახელება" style="align:left;"/>
                                                                        <input type="text" name="concurs[<?=$i;?>][img][]" class="concurs_images_<?=$i;?>" id="con_img_<?=$i;?>_<?=$a;?>" value="<?=$concursant['img'][$a];?>" >
                                                                        <a href="http://funtime.ge/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=con_img_<?=$i;?>_<?=$a;?>" class="btn-blue iframe-btn" type="button">ფოტო <?=$i;?>-<?=$a+1;?></a>
                                                                    </p>
                                                                <?php endfor;?>
                                                            </td>
                                                            <td>
                                                                <a class="remove_concursant" onclick="removeConcursant(this);" style="cursor:pointer;" data-id="<?=$i;?>">[x]</a>
                                                            </td>
                                                        </tr>

                                                    <?php endforeach;?>
                                                <?php endif;?>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </table>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td height="10px"></td><td></td>
                        </tr>

                    <?endif;?>
                    <tr style="display:none;"><td class="td1">წვდომა</td><td>
                            <?$group_mass=(array)unserialize($num['group']);?>
                            <input type="checkbox" value="0" name="group[]" <?if(@in_array(0,$group_mass)):?>checked<?endif?>> ყველა<br/>
                            <?foreach($groups as $gr):?>
                                <input type="checkbox" value="<?=$gr['id']?>" name="group[]"  <?if(@is_array($group_mass)):?><?if(@in_array($gr['id'],$group_mass)):?>checked<?endif?><?endif?>> <?=$gr['name']?><br/>
                            <?endforeach;?>
                        </td></tr>
                    <tr>
                        <td class="td1">ლიდი</td>
                        <td>
                            <?//if($user->get_property('gid') !== 24 and $user->get_property('gid') !== 25):?>
                            <!-- <a class="convert" onClick='convertText("#lidi")'>Convert AcadNusx to Sylfaen</a>-->
                            <?//endif;?>
                            <textarea class="tinymce_short" name="lidi" id="lidi" maxlength="300" onkeyup="countSymbols('#lidi',300)" onpaste="setTimeout(function(){return countSymbols('#lidi',300);},100)" onkeypress="return makeGeo(this,event);" style="width: 99%;height:70px; margin-top:5px; <?if($user->get_property('gid')!=24 && $user->get_property('gid')!=25):?>color:#000 !important;font-size:22px !important;<?endif;?>" ><?=($_POST['text_short']) ? $_POST['text_short'] : $num['text_short'];?></textarea>
                            <br><i class="right">300</i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="title-table">ტექსტი</span>
                        </td>
                        <td>
                            <textarea name="textarea1" <? if($user->get_property('gid') !== 24 && $user->get_property('gid') !== 25):?>maxlength="50000"<?endif;?> onkeypress="return makeGeo(this,event);" onkeyup="countSymbols('#textarea1',50000)" onpaste="setTimeout(function(){return countSymbols('#textarea1',50000);},100)" id="textarea1" class="tinymce" style="width: 100%;height:300px; margin-top:5px;<?if($user->get_property('gid')!=24 && $user->get_property('gid')!=25):?>color:#000 !important;font-size:22px !important;<?endif;?>" ><?=($_POST['text']) ? $_POST['text'] : $num['text'];?></textarea>
                            <br><i class="right">50000</i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            საკნატუნა ფოტოები
                        </td>
                        <td>
                            <input type="hidden" name="sakimg" id="sakimg" value="" >
                            <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=sakimg" class="btn-blue iframe-btn" type="button">ფოტო 1</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td>ფოტოგრაფი</td><td><input type="text" name="phg" value="<?=($_POST['phg']) ? $_POST['phg'] : $num['phg'];?>" placeholder="სახელი, გვარი">
                            <? $photographer = ['ალექსანდრე სხულუხია','ნათია სიჭინავა','ნინი მანდარია','სალვატორე კოსტა'];//$DB->getAll('SELECT name FROM #__phgrapher order by name ASC'); ?>
                            <?if(count($photographer) > 0):?>
                                <select name="photographer">
                                    <option>---</option>
                                    <?foreach($photographer as $name):?>
                                        <option <?=($name == $num['phg']) ? 'selected' : '';?>><?=$name;?></option>
                                    <?endforeach;?>
                                </select>
                            <?endif;?>
                        </td>
                    </tr>
                    <?if($user->get_property('gid') == 24 or $user->get_property('gid') == 25):?>

                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <td>დასპონსორებული</td><td><input type="checkbox" name="sponsored" value="1" <?if($num['sponsored'] == '1'):?> checked <?endif;?>></td>
                        </tr>
                    <?endif;?>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td>წყარო</td><td><input type="text" name="copy[title]" value="<?=$copy['title'];?>" placeholder="დასახელება"> <input type="text" name="copy[url]" value="<?=$copy['url'];?>"  placeholder="ბმული" style="width:80%;"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td>მისამართი</td><td><input class="inputbox" type="text" name="info[address]" value="<?=$info['address']?>" style="width:300px"/></td>
                    </tr>
                    <tr>
                        <td>Facebook</td><td><input class="inputbox" type="text" name="info[facebook]" value="<?=$info['facebook']?>" style="width:300px"/></td>
                    </tr>
                    <tr>
                        <td>Skype</td><td><input class="inputbox" type="text" name="info[skype]" value="<?=$info['skype']?>" style="width:300px"/></td>
                    </tr>
                    <tr>
                        <td>მობილური</td><td><input class="inputbox" type="text" name="info[mobile]" value="<?=$info['mobile']?>" style="width:300px"/></td>
                    </tr>
                    <tr>
                        <td>ტელეფონი</td><td><input class="inputbox" type="text" name="info[phone]" value="<?=$info['phone']?>" style="width:300px"/></td>
                    </tr>
                    <tr>
                        <td>ელ.ფოსტა</td><td><input class="inputbox" type="text" name="info[email]" value="<?=$info['email']?>" style="width:300px"/></td>
                    </tr>
                    <tr>
                        <td>ვებ.გვერდი</td><td><input class="inputbox" type="text" name="info[website]" value="<?=$info['website']?>" style="width:300px"/></td>
                    </tr>
                </table>
                <?if($user->get_property('gid')!==18 && $user->get_property('gid')!==21 && $user->get_property('gid')!==22 && $user->get_property('gid')!==23):?>
                    <a onClick="doOp(2,1,document.formedit);" class="btn-blue do-not-leave">გადახედვა</a>
                    <div id="other">
                        <br/>

                        <table class="formadd">
                            <tr><th>SEO</th><th></th></tr>
                            <tr><td class="td1">ბმული ლათინურად<br/> <i>(ავტოგენერაცია)</i></td><td>
                                    <input type="hidden" name="cat_chpu" value="<?=$num['cat_chpu']?>" />
                                    <input class="inputbox" type="text" name="chpu" value="<?=$num['chpu']?>"/>
                                </td></tr>
                            <!--
                        <tr><td class="td1">თეგები<br/> <i>(მძიმის გამოყენებით)</i></td><td><input class="inputbox" type="text" name="tags" value="<?//=$num['tags_ru']?>"/></td></tr>

                        <tr><td class="td1">წყარო</td><td><input class="inputbox" type="text" name="original_url" value="<?//=$num['original_url']?>"/></td></tr>-->
                            <tr><td class="td1">Meta Keywords</td><td><textarea name="meta_key" class="input_300"><?=$num['meta_key']?></textarea></td></tr>
                            <tr><td class="td1">Meta Description</td><td><textarea name="meta_desc" class="input_300"><?=$num['meta_desc']?></textarea></td></tr>
                        </table>
                    </div>
                <?endif;?>
                <a onClick="doOp(2,0,document.formedit);" class="btn-yellow do-not-leave">შენახვა</a>
                <a onClick="doOp(1,0,document.formedit);" class="btn-green right do-not-leave">
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
                    <a onClick="doOp(4,0,document.formedit);" class="btn-green right" style="margin-right:10px;">რედაქტორთან გაგზავნა</a>
                <?endif;?>
                <?if($user->get_property('gid')==22 or $user->get_property('gid')==21){?>
                    <a onClick="doOp(3,0,document.formedit);" class=" right" style="border-radius:4px;background-color:#005fb3;cursor:pointer;padding:5px 15px;margin-right:10px;color:#FFF;text-decoration:none;font-family: 'BPGMrgvlovani';font-size: 13px">ადმინისტრატორთან გაგზავნა</a>
                <?}?>
            </form>
        <?endif;?>
        <?endforeach;?>
    <?else:?>ჩანაწერის რედაქტირებისათვის საჭიროა გადასვლა რედაქტირების გვერდზე.<?endif;?>
<?endif?>
<p><a href="index.php?component=article" class="back">&larr; უკან</a></p>
<div id="popupbg"></div>
<div id="imgpl"><div class="imgplace"><div id="dxy"></div><img id="blah" src="#" alt="your image" /><a onclick="cropImg()">მოჭრა</a></div></div>
<div id="imgpr"><div class="imgprev"><div id="pxy"></div><img id="prah" src="#" alt="your image" /><a onclick="cropImg()">მოჭრა</a></div></div>
<script>
    window.onbeforeunload = function(){
        if(getCookie('article_edit') > 0){
            return 'ნამდვილად გსურთ სტატიიდან გამოსვლა ან გვერდის განახლება?';
        }else{
            return;
        }
    }
</script>
<script>
    $(document).ready(function(){
        $('select[name="photographer"]').change(function(){
            $('input[name="phg"]').val($(this).val());
        });

        var news_id = '<?=$num['id'];?>';

        if(jQuery('.banner_adds tr').length <= 0){
            jQuery.ajax({
                url:'/apanel/index.php?component=banner&section=ajax',
                type:'POST',
                data:{action:'no_banners',news:news_id}

            });
        }

    });
</script>
<?php
if($user->get_property('gid') == 24 or $user->get_property('gid') == 25):
    @include_once('.banner_info.php');

    if(count($registry['banners']) > 0):
        ?>
        <style>
            .post_banner_list{
                position:fixed;
                right:0;
                top:20%;
                width:540px;
                max-height:900px;
            }
        </style>
        <div class="post_banner_list">
            <div style="position:relative">
                <a class="close_banners" style="position:absolute;left:0;top:30px;-ms-transform: rotate(270deg); /* IE 9 */
    -webkit-transform: rotate(270deg); /* Chrome, Safari, Opera */
    transform: rotate(270deg);padding:7px 15px;cursor:pointer;font-family:BPGMrgvlovani;background-color:red;max-width:140px;color:#FFF;text-align:center;">დახურვა</a>
                <a class="open_banners" style="position:absolute;left:0;top:28px;-ms-transform: rotate(270deg); /* IE 9 */
    -webkit-transform: rotate(270deg); /* Chrome, Safari, Opera */
    transform: rotate(270deg);padding:7px 15px;cursor:pointer;font-family:BPGMrgvlovani;background-color:green;max-width:140px;color:#FFF;text-align:center;display:none;">გახსნა</a>
                <table id="rounded-corner" style="position:relative;width:480px;max-width:480px;right:-62px !important;">
                    <thead>
                    <tr>
                        <th scope="col" class="rounded">კომპანიის დასახელება</th>
                        <th scope="col" class="rounded">პოზიცია</th>
                        <th scope="col" class="rounded">ზომა</th>
                        <th scope="col" class="rounded">დასახელება</th>
                        <th scope="col" class="rounded"></th>
                    </tr>
                    </thead>
                    <tbody class="banner_adds">
                    <?foreach($registry['banners'] as $item): $info = unserialize($item['info']); ?>
                        <tr class="banner_<?=$item['id'];?> <?if($item['added']=='1'):?>table_green<?endif;?>" style="position:relative;">
                            <td><?=$item['company'];?></td><td><?=$item['title'];?></td><td><?=$item['size'];?></td><td><?=$info['banner'];?></td><td><a onClick="haveAdd(<?=$item['id'];?>)" style="padding:7px 15px;cursor:pointer;font-family:BPGMrgvlovani;background-color:purple;max-width:140px;border-radius:5px;color:#FFF;text-align:center;">დავამატე</a></td>
                        </tr>
                    <?endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="<?=$theme_admin?>/js/jquery-ui.min.js"></script>
        <script>
            var haveAdd = function(id){
                var news_id = '<?=$num['id'];?>';
                if(id > 0){

                    jQuery.ajax({
                        url:'/apanel/index.php?component=banner&section=ajax',
                        type:'POST',
                        data:{action:'banner_added',id:id,news:news_id,length:jQuery('.banner_adds tr').length},
                        success:function(data){
                            if(data == 1){
                                jQuery('.banner_'+id).fadeOut(400,function(){
                                    $(this).remove();
                                });

                                if(jQuery('.banner_adds tr').length <= 1){
                                    jQuery('.post_banner_list').remove();
                                }
                            }
                        }
                    });
                }
            };

            jQuery(document).ready(function($){
                <?php if($num['banner'] == '1'):?>
                var news_id = '<?=$num['id'];?>';
                if($('.banner_adds tr').length > 0){
                    $.ajax({
                        url:'/apanel/index.php?component=banner&section=ajax',
                        type:'POST',
                        data:{action:'yes_banners',news:news_id}

                    });
                }
                <?php endif;?>
                $('.close_banners').click(function(){
                    $('.post_banner_list').animate({right:'-480px'},500);
                    $(this).hide();
                    $('.open_banners').show();
                });

                $('.open_banners').click(function(){
                    $('.post_banner_list').animate({right:'+=480px'},500);
                    $(this).hide();
                    $('.close_banners').show();
                });

            });
        </script>
    <?endif;?>
<?endif;?>
<input type="text" name="image_dirs" id="image_dirs" value="" />
<script src="<?=$theme_admin;?>js/test.js?ver=1.2"></script>