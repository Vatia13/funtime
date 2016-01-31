function loadTinyMCEEditor(num) {
    // var html = '<div id="editor_'+num+'"><script> tinymce.init({selector: "textarea.tinymce2",menubar: false,plugins: ["autolink lists link image charmap print preview hr anchor pagebreak","searchreplace wordcount visualblocks visualchars code fullscreen","nonbreaking save contextmenu directionality","Convert paste textcolor colorpicker textpattern"],toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",toolbar1: "Convert | undo redo | bold italic underline | link unlink anchor | boldcolor forecolor backcolor  |  fontselect",content_css : "theme/css/tiny_lid_o.css",font_formats: "Nino Mtavruli = BPGNinoMtavruliRegular;"+"Ingiri = BPGIngiri2008Regular;" +"Open Sans = Open Sans;"+"Bebas = bebasregular;"}); </script></div>';
    //  $('body').append(html);
    tinymce.init({
        selector: '#editor_'+num,
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
        toolbar1: "Convert | undo redo | bold italic underline | link unlink anchor | boldcolor forecolor backcolor  |  fontselect",
        content_css : "theme/css/custom.css",
        font_formats: "Nino Mtavruli = BPGNinoMtavruliRegular;"+"Ingiri = BPGIngiri2008Regular;" +"Open Sans = Open Sans;"+"Bebas = bebasregular;"
    });
    tinymce.execCommand('mceAddEditor', false, 'editor_'+num);

}




var curFieldNameId = ($("#parentId > tbody > tr").length <= 0) ? 0 : $("#parentId > tbody > tr").length;

function addFielda(akey) {
    curFieldNameId = ($("#parentId > tbody > tr").length > 0) ? parseInt($("#parentId > tbody > tr:last-child").attr('data-num')) + 1 : 0;
    var curFieldNumber = curFieldNameId + 1;
    // var div = document.createElement("div");
    $('#parentId tbody').append("<tr class='str"+curFieldNumber+"' data-num='"+curFieldNumber+"'><td><textarea name=\"slide[name][]\" id=\"editor_"+curFieldNameId+"\" class=\"slide_name tinymce2\" placeholder=\"ტექსტი\" style=\"align:left;\"></textarea><input type='hidden' name='slide[img][]' class=\"slide_img\" id='slide" + curFieldNumber + "'/> <div class='sitems'><a href='http://funtime.ge/filemanager/dialog.php?type=1&akey=" + akey + "&field_id=slide" + curFieldNumber + "' class='btn-blue iframe-btn' type='button'>ფოტო " + curFieldNumber + "</a> <label class='slide" + curFieldNumber + "'>---</label> <a onclick=\"return deleteFielda(this)\" href=\"#\" data-id=\""+curFieldNameId+"\" class=\"razdel-bodys-aa\">[X]</a></div></td><td valign='top'></td></tr>");
    //div.innerHTML = "<input type=\"text\" name=\"slide[name][]\" class=\"slide_img\" value=\"\" placeholder=\"ფოტოს დასახელება\" /><input type='hidden' class=\"slide_img\" name='slide[img][]' id='slide" + curFieldNameId + "'/> <a href='http://funtime.ge/filemanager/dialog.php?type=1&akey=" + akey + "&field_id=slide" + curFieldNameId + "' class='btn-blue iframe-btn' type='button'>ფოტო " + curFieldNameId + "</a> <label class='slide" + curFieldNameId + "'>---</label> <a onclick=\"return deleteField(this)\" href=\"#\" class=\"razdel-bodys-aa\">[X]</a>";
    //document.getElementById("parentId").appendChild(div); // Добавляем новый узел в конец списка полей


    jQuery(document).ready(function () {
        loadTinyMCEEditor(curFieldNameId);
        jQuery('.iframe-btn').fancybox({
            'width'		: 900,
            'height'	: 600,
            'type'		: 'iframe',
            'autoScale'    	: false
        });
    });

    return false;
}

function deleteFielda(a) {
    var dataID = $(a).attr('data-id');
    $('#parentId .str'+dataID).remove();

    var contDiv = a.parentNode; // Получаем доступ к ДИВу, содержащему поле
    contDiv.parentNode.removeChild(contDiv); // Удаляем этот ДИВ из DOM-дерева

    var id = $(a).attr('alt');
    $('.img'+id).replaceWith("");

    tinymce.execCommand('mceRemoveEditor', false, 'editor_'+dataID);
    return false;
}

function addSlideFields(e){
    var selected = $('option:selected',e).val();
    var akey = "a651481913d2fedc5c880b5f14cb9859";
    var curFieldNumber = 0;
    var fields = ($("#parentId > tbody > tr").length > 0) ? $("#parentId > tbody > tr").length : 0;
    if(selected > 0){
        if(selected < fields){
            var remFields = fields - selected;
            for(var i = 0;i < remFields; i++){
                tinymce.execCommand('mceRemoveEditor', false, 'editor_'+$("#parentId > tbody > tr:last-child").attr('data-num'));
                $("#parentId > tbody > tr:last-child").remove();
            }
        }else{
            for(var i = fields; i < selected; i++){
                curFieldNumber = i + 1;
                //var div = document.createElement("div");
                $("#parentId > tbody").append("<tr class='str"+i+"' data-num='"+i+"'><td><textarea name=\"slide[name][]\" id=\"editor_"+i+"\" class=\"slide_name tinymce2\" placeholder=\"ტექსტი\" style=\"align:left;\"></textarea><b>" + curFieldNumber + "</b><input type='hidden' name='slide[img][]' class=\"slide_img\" id='slide" + curFieldNumber + "'/> <div class='sitems'><a href='http://funtime.ge/filemanager/dialog.php?type=1&akey=" + akey + "&field_id=slide" + curFieldNumber + "' class='btn-blue iframe-btn' type='button'>ფოტო " + curFieldNumber + "</a> <label class='slide" + curFieldNumber + "'>---</label> <a onclick=\"return deleteFielda(this)\" href=\"#\" data-id=\""+i+"\" class=\"razdel-bodys-aa\">[X]</a></div></td><td valign='top'></td></tr>");
                //document.getElementById("parentId").appendChild(div); // Добавляем новый узел в конец списка полей

                jQuery(document).ready(function () {
                    loadTinyMCEEditor(i);
                    jQuery('.iframe-btn').fancybox({
                        'width'		: 900,
                        'height'	: 600,
                        'type'		: 'iframe',
                        'autoScale'    	: false
                    });
                });
            }
        }
    }
}


var timer = setInterval(function(){
    if($("#image_dirs").val() != "" && $("#parentId > tbody > tr").length <= 1 && $("#parentId > tbody > tr:first-child").attr('data-num') <= 0){
        var akey = "a651481913d2fedc5c880b5f14cb9859";
        var curFieldNumber = 0;
        $.ajax({
            url:'/apanel/index.php?component=articlet&section=ajax',
            type:'POST',
            data:{action:'get_images_from_dir',url:$("#image_dirs").val()},
            success:function(response){
                var json = JSON.parse(response);
                if(json.img.length > 0){
                    for(var i = 1; i < json.img.length; i++){
                        curFieldNumber = i + 1;
                        var lab = json.img[i].split('/');
                        var num = lab.length - 1;
                        //var div = document.createElement("div");
                        $("#parentId > tbody").append("<tr class='str"+i+"' data-num='"+i+"'><td><textarea name=\"slide[name][]\" id=\"editor_"+i+"\" class=\"slide_name tinymce2\" placeholder=\"ტექსტი\" style=\"align:left;\"></textarea><b>" + curFieldNumber + "</b><input type='hidden' name='slide[img][]' class=\"slide_img\" id='slide" + curFieldNumber + "'/> <div class='sitems'><a href='http://funtime.ge/filemanager/dialog.php?type=1&akey=" + akey + "&field_id=slide" + curFieldNumber + "' class='btn-blue iframe-btn' type='button'>ფოტო " + curFieldNumber + "</a> <label class='slide" + curFieldNumber + "'>---</label> <a onclick=\"return deleteFielda(this)\" href=\"#\" data-id=\""+i+"\" class=\"razdel-bodys-aa\">[X]</a></div></td><td valign='top'></td></tr>");

                        jQuery(document).ready(function () {
                            loadTinyMCEEditor(i);
                            jQuery('.iframe-btn').fancybox({
                                'width'		: 900,
                                'height'	: 600,
                                'type'		: 'iframe',
                                'autoScale'    	: false
                            });
                        });
                    }
                }
                clearInterval(timer);
            }
        });
    }else{
        $("#image_dirs").val("");
    }
},1000);