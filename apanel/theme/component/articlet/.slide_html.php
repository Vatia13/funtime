<? defined('_JEXEC') or die('Restricted access'); $slider = (unserialize($num['slide']) <> "") ? unserialize($num['slide']) : unserialize(base64_decode($num['slide']));?>
<style>
    .sitems{
        margin-top:5px;
    }
    .sitems a,label{
        display:inline-block;
    }
</style>
<script>
    $(document).ready(function(){
        tinymce.init({
            selector: 'textarea.tinymce2',
            setup: function(editor) {
                editor.on('keydown', function(e) {
                    keyDownTextField(e);
                });
                editor.on('keyup', function(e) {
                    keyUpTextField(e);
                    if(editor.getContent().length > 500){
                        alert('სიმბოლოების მაქსიმალური რაოდენობა = 500');
                        var content = editor.getContent().substring(0,497);
                        editor.setContent(content);
                        return false;
                    }

                });
            },
            menubar: false,
            plugins: ["autolink lists link image charmap print preview hr anchor pagebreak","searchreplace wordcount visualblocks visualchars code fullscreen","nonbreaking save contextmenu directionality","Convert paste textcolor colorpicker textpattern"],
            //toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
            toolbar1: "Convert | undo redo | bold italic underline | link unlink anchor | boldcolor forecolor backcolor  |  fontselect | code",
            content_css : "theme/css/custom.css",
            font_formats: "Nino Mtavruli = BPGNinoMtavruliRegular;"+"Ingiri = BPGIngiri2008Regular;" +"Open Sans = Open Sans;"+"Bebas = bebasregular;"
        });
    });
</script>

<div class="photo-slide">
    <table width="100%">
        <tr>
            <td width="60%" valign="top">
                <table width="100%">
                    <thead>
                    <tr>
                        <td valign="middle" width="30%">
                            ძველი სლაიდი <input type="checkbox" name="slide_type" value="1" <?if($num['slide_type']=='1'):?>checked<?endif;?>/>
                        </td>
                        <td valign="middle" width="30%">
                            ფოტოების რაოდენობა
                            <select onChange="addSlideFields(this)">
                                <option value="0">---</option>
                                 <?php for($i=1;$i<=50;$i++):?>
                                     <option value="<?=$i;?>"><?=$i;?></option>
                                 <?endfor;?>
                            </select>
                        </td>
                        <td width="30%">
                            <a class="btn-green" onclick="addFielda('a651481913d2fedc5c880b5f14cb9859')" > + მეტი</a>
                        </td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="100%" colspan="3">
                            <table  id="parentId">
                                <tbody>
                                <? if(count($slider['img']) > 0 or count($_POST['slide']) > 0 or count($slider['name']) > 0):?>
                                    <?if(count($_POST['slide']) > 0): $slider = $_POST['slide'];  endif;?>
                                    <? $count = (count($slider['img']) > 0) ? count($slider['img']): count($slider['name']); ?>
                                    <?$a=1;for($i=0;$i<$count;$i++): ?>
                                        <tr  class="str<?=$i;?>" data-num="<?=$i;?>">
                                            <td>
                                                    <input type="hidden" name="slide[img][]" class="slide_img" id="slide<?=$i;?>" value="<?=$slider['img'][$i];?>" >
                                                    <textarea name="slide[name][]" class="slide_name tinymce2" id="editor_<?=$i;?>" placeholder="ტექსტი" style="align:left;"><?=$slider['name'][$i];?></textarea>
                                                <div class="sitems">
                                                    <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=slide<?=$i;?>" class="btn-blue iframe-btn" type="button">ფოტო <?=$a;?></a>
                                                    <label class="slide<?=$a;?>"><?if(!empty($slider['img'][$i])): echo last_par_url($slider['img'][$i]); else: echo "---"; endif;?></label>
                                                    <a onclick="return deleteFielda(this)" href="#" data-id="<?=$i;?>" alt="<?=$i;?>" class="razdel-bodys-aa">[X]</a>
                                                </div>
                                            </td>
                                            <td valign="top" width="40%" id="ajax_slide_images">
                                                <img src="<?=$slider['img'][$i];?>" width="300" class="img<?=$i;?>"/><br><br>
                                            </td>
                                        </tr>
                                        <? $a++; endfor;?>
                                <?endif;?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>

        </tr>

    </table>
</div>
