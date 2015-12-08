/**
 *
 * CMS osRealty 2.1.x
 * Autor: Roman Chernyshov
 * E-mail: support@osRealty.ru
 * URL: www.osRealty.ru
 *
 */

function submitform(id) {
    document.forms[id].submit();
}

function openClose(id) {
    var obj = "";
    // Check browser compatibility
    if(document.getElementById)
        obj = document.getElementById(id).style;
    else if(document.all)
        obj = document.all[id];
    else if(document.layers)
        obj = document.layers[id];
    else
        return 1;
    // Do the magic :)
    if(obj.display == "")
        obj.display = "block";
    else if(obj.display != "none")
        obj.display = "none";
    else
        obj.display = "block";
}

function openClose2(id)	{
    var obj = "";
    // Check browser compatibility
    if(document.getElementById)
        obj = document.getElementById(id).style;
    else if(document.all)
        obj = document.all[id];
    else if(document.layers)
        obj = document.layers[id];
    else
        return 1;

    // Do the magic :)
    if(obj.display == "")
        obj.display = "none";
    else if(obj.display != "none")
        obj.display = "none";
    else
        obj.display = "block";
}

function cc(id)	{
    var obj = "";
    // Check browser compatibility
    if(document.getElementById)
        obj = document.getElementById(id).style;
    else if(document.all)
        obj = document.all[id];
    else if(document.layers)
        obj = document.layers[id];
    else
        return 1;
    // Do the magic :)
    if(obj.display == "")
        obj.display = "none";
    else if(obj.display != "none")
        obj.display = "none";
    else
        obj.display = "none";
}

function oo(id)	{
    var obj = "";
    // Check browser compatibility
    if(document.getElementById)
        obj = document.getElementById(id).style;
    else if(document.all)
        obj = document.all[id];
    else if(document.layers)
        obj = document.layers[id];
    else
        return 1;
    // Do the magic :)
    if(obj.display == "")
        obj.display = "block";
    else if(obj.display != "none")
        obj.display = "block";
    else
        obj.display = "block";
}

function doClear(theText) {
    if (theText.value == theText.defaultValue) {
        theText.value = ""
    }
}

function ClockTimeZone() {
    var TimezoneOffset = 3
    var localTime = new Date();
    var ms = localTime.getTime() + (localTime.getTimezoneOffset() * 60000) + TimezoneOffset * 3600000;
    var time = new Date(ms);
    var hour = time.getHours();
    var minute = time.getMinutes();
    var second = time.getSeconds();
    var temp = "" + ((hour < 10) ? "0" : "") + hour;
    temp += ((minute < 10) ? ":0" : ":") + minute;
    temp += ((second < 10) ? ":0" : ":") + second;
    document.getElementById('clock').innerHTML = temp;
    setTimeout("ClockTimeZone()",1000);
} //onload = ClockTimeZone;


function testcheck() {
    if (!document.getElementById('rules').checked) {
        alert("Вы должны согласится с правилами сервиса!");
        return false;
    }
    return true;
}

function showtab2(id) {
    names = new Array ("tabname_1","tabname_2");
    conts= new Array ("tabcontent_1","tabcontent_2");
    for(i=0;i<names.length;i++) {
        document.getElementById(names[i]).className = 'nonactive';
    }
    for(i=0;i<conts.length;i++) {
        document.getElementById(conts[i]).className = 'hide';
    }
    document.getElementById('tabname_' + id).className = 'active';
    document.getElementById('tabcontent_' + id).className = 'show';
}

function showtabnew(idd,idblock,counttab) {
    for(i=1;i<=counttab;i++) {
        document.getElementById('id' + idblock + '_tabname_' + i).className = 'id'+idblock+'_nonactive';
    }
    for(i=1;i<=counttab;i++) {
        document.getElementById('id' + idblock + '_tabcontent_' + i).className = 'hide';
    }
    document.getElementById('id' + idblock + '_tabname_' + idd).className = 'id' + idblock + '_active';
    document.getElementById('id' + idblock + '_tabcontent_' + idd).className = 'show';
}

function setHome(ob) {
    ob.style.behavior='url(#default#homepage)';
    ob.setHomePage(document.location);
}

function textCounter( field, countfield, maxlimit ) {
    if ( field.value.length > maxlimit ) {
        field.value = field.value.substring( 0, maxlimit );
        alert( 'Каксимальное кол-во символов - 2000' );
        return false;
    }
    else {
        $(countfield).update(maxlimit - field.value.length);
    }
}
function windowPath(extra){
    if(extra == '' || extra == 'undefined'){
        extra = '';
    }
    window.location = window.location.pathname + extra;
}
function testcheck2(id) {
    if (!document.getElementById('rules'+id).checked)
    {alert("Вы должны согласится с правилами сервиса!");return false;}
    return true;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function delCookie(name) {
    document.cookie = name + "=" + "; expires=Thu, 01 Jan 1970 00:00:01 GMT";
}

function regUpen(el) {
    disState = el.options[el.selectedIndex].value;
    setCookie(el.name,disState,1);
}
function clearAll(el){
    var num = el.length;
    for(var i=0;i<num;i++){
        delCookie(el[i]);
    }
}
function getCookie(name) {
    var cookie = " " + document.cookie;
    var search = " " + name + "=";
    var setStr = null;
    var offset = 0;
    var end = 0;
    if (cookie.length > 0) {
        offset = cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = cookie.indexOf(";", offset)
            if (end == -1) {
                end = cookie.length;
            }
            setStr = unescape(cookie.substring(offset, end));
        }
    }
    return(setStr);
}

function set_cookie(name, value, expires) {
    if (!expires)
    {
        expires = new Date();
    }
    document.cookie = name + "=" + escape(value) + "; expires=" + expires.toGMTString() +  "; path=/";
}

var countOfFields = 1; // Текущее число полей
var curFieldNameId = 1; // Уникальное значение для атрибута name
var maxFieldLimit = 24; // Максимальное число возможных полей

function deleteField(a) {
    var contDiv = a.parentNode; // Получаем доступ к ДИВу, содержащему поле
    contDiv.parentNode.removeChild(contDiv); // Удаляем этот ДИВ из DOM-дерева
    var id = $(a).attr('alt');
    $('.img'+id).replaceWith("");
    countOfFields--; // Уменьшаем значение текущего числа полей
    return false;
}

function addField(akey) {
    if (countOfFields >= maxFieldLimit) { // Проверяем, не достигло ли число полей максимума
        maxFieldLimit = maxFieldLimit + 1;
        alert("სლაიდიში ფოტოების მაქსიმალური რაოდენობა = " + maxFieldLimit);
        return false;
    }
    if($("#parentId div").length > 0){
        curFieldNameId = $("#parentId div").length + 1;
    }
    countOfFields++;
    curFieldNameId++; // Увеличиваем ID
    var div = document.createElement("div");

    //div.innerHTML = "<textarea name=\"slide[name][]\" class=\"slide_img  tinymce\" id=\"slidename1\" placeholder=\"ტექსტი\" style=\"align:left;\"></textarea><input type='hidden' name='slide[img][]' id='slide" + curFieldNameId + "'/> <a href='http://funtime.ge/filemanager/dialog.php?type=1&akey=" + akey + "&field_id=slide" + curFieldNameId + "' class='btn-blue iframe-btn' type='button'>ფოტო " + curFieldNameId + "</a> <label class='slide" + curFieldNameId + "'>---</label> <a onclick=\"return deleteField(this)\" href=\"#\" class=\"razdel-bodys-aa\">[X]</a>";

    div.innerHTML = "<input type=\"text\" name=\"slide[name][]\" class=\"slide_img\" value=\"\" placeholder=\"ფოტოს დასახელება\" /><input type='hidden' class=\"slide_img\" name='slide[img][]' id='slide" + curFieldNameId + "'/> <a href='http://funtime.ge/filemanager/dialog.php?type=1&akey=" + akey + "&field_id=slide" + curFieldNameId + "' class='btn-blue iframe-btn' type='button'>ფოტო " + curFieldNameId + "</a> <label class='slide" + curFieldNameId + "'>---</label> <a onclick=\"return deleteField(this)\" href=\"#\" class=\"razdel-bodys-aa\">[X]</a>";
    document.getElementById("parentId").appendChild(div); // Добавляем новый узел в конец списка полей


    $(document).ready(function () {

        $('.iframe-btn').fancybox({
            'width'		: 900,
            'height'	: 600,
            'type'		: 'iframe',
            'autoScale'    	: false
        });
    });
    return false;
}

function open_popup(url)
{
    var w = 880;
    var h = 570;
    var l = Math.floor((screen.width-w)/2);
    var t = Math.floor((screen.height-h)/2);
    var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
}

function Numbers22(e) {
    var keynum;
    var keychar;
    var numcheck;
    var return2;
    if(window.event) { // IE
        keynum = e.keyCode;
    }
    else if(e.which) {// Netscape/Firefox/Opera
        keynum = e.which;
    }
    keychar = String.fromCharCode(keynum);
    if (keynum < 45 || keynum > 57) {
        return2 = false;
        if (keynum == 8) return2 = true;
    }
    else return2 = true;
    return return2;
}

function clear_value(obj_id, event) {
    code = (event.charCode) ? event.charCode : event.keyCode;
    if(code != 9 && code != 16){
        document.getElementById(obj_id).value = '';
    }
}


function format_price(e) {
    var target = e.target || e.srcElement;

    var cursorPos = get_cursor_position(target);
    if (cursorPos == -1) { cursorPos = 0; }
    var deltaPos = 0;

    var lengthBefore = target.value.length;
    target.value = target.value.replace(/\s+/g,'').replace(/\s+$/, '');
    target.value = format_num(target.value);
    if (!deltaPos && (target.value.length - lengthBefore) > 0) { deltaPos = target.value.length - lengthBefore; }
    if (!deltaPos && target.value[ cursorPos + deltaPos ] == ' ' && target.value[ cursorPos + deltaPos - 1 ] == ' ') { deltaPos += 2; }
    set_cursor_position(target, cursorPos + deltaPos);
    return true;
}


function get_cursor_position(inputEl) {
    if (document.selection && document.selection.createRange) {
        var range = document.selection.createRange().duplicate();
        if (range.parentElement() == inputEl) {
            range.moveStart('textedit', -1);
            return range.text.length;
        }
    }
    else if (inputEl.selectionEnd) { return inputEl.selectionEnd; }
    else
        return -1;
}


function set_cursor_position(inputEl, position) {
    if (inputEl.setSelectionRange) {
        inputEl.focus();
        inputEl.setSelectionRange(position, position);
    }
    else if (inputEl.createTextRange) {
        var range = inputEl.createTextRange();
        range.collapse(true);
        range.moveEnd('character', position);
        range.moveStart('character', position);
        range.select();
    }
}


function format_num(str) {
    var retstr = '';
    var now = 0;
    for (i = str.length - 1; i >= 0; i--) {
        if (now < 3) {
            now++;
            retstr = str.charAt(i) + retstr;
        } else {
            now = 1;
            retstr = str.charAt(i) + ' ' + retstr;
        }
    }
    return retstr;
}

function block_article(e,id,post_id){
    if(id > 0){
        var block = confirm('ნამდვილად გსურთ სტატია №'+ post_id +'-ის ბლოკირება?');
        if(block == true){
            $.ajax({
                url:'/lib/ajax-admin.php',
                type:'POST',
                data:{action:'block_article',user:id,post:post_id},
                success:function(data){
                    if(data == 1){
                        $(e).attr('onClick','unblock_article(this,'+id+','+post_id+')').html('<img src="theme/images/locked.png" alt="" title="" width="21" border="0" />');
                    }else{
                        alert(data);
                    }
                }
            });
        }
    }
}

function unblock_article(e,id,post_id){
    if(id > 0){
        var unblock = confirm('ნამდვილად გსურთ ბლოკის მოხსნა სტატია №'+ post_id +'-ზე?');
        if(unblock == true){
            $.ajax({
                url:'/lib/ajax-admin.php',
                type:'POST',
                data:{action:'unblock_article',user:id,post:post_id},
                success:function(data){
                    if(data == 1){
                        $(e).attr('onClick','block_article(this,'+id+','+post_id+')').html('<img src="theme/images/open.png" alt="" title="" width="21" border="0" />');
                    }else{
                        alert(data);
                    }
                }
            });
        }
    }
}

function countSymbols(e,num){
    var text = $(e).val();
    var length = text.length;
    var sum = num - length;
    var result = $(e).next('br').next('i');
    if(sum <= 0){
        str = text.substring(0, length - 1);
        $(e).val(str);
        alert('სიმბოლოების მაქსიმალური რაოდენობაა ' + num);
    }
    result.text(sum);
}

function doOp(val,pr,op){
    document.cookie = 'article_edit=;expires=Thu, 18 May 1980 08:14:48 GMT; path=/';
    $("#operation").val(val);
    if(pr > 0){
        $("#preview_article").val(pr);

        window.open("http://funtime.ge/redirect.php?url=funtime.ge/" + $('input[name="cat_chpu"]').val() + "/" + $('input[name="chpu"]').val() + "/" , '_blank');
    }

    return op.submit();

}


function deletePost(id){
    var conf = confirm("ნამდვილად გსურთ სტატია № " + id + "-ს წაშლა?");
    if(conf == true){
        window.location.href = "/apanel/index.php?news=1&del="+id;
    }
}

function deleteCat(id,cat){
    if(cat == 'post'){
        var conf = confirm("ნამდვილად გსურთ რუბრიკა № " + id + "-ს წაშლა?");
    }else{
        var conf = confirm("ნამდვილად გსურთ გვერდი № " + id + "-ს წაშლა?");
    }
    if(conf == true){
        window.location.href = "/apanel/index.php?component=category&sec=" + cat + "&delete="+id;
    }
}

function deleteUser(id,name,group){
    var conf = confirm("ნამდვილად გსურთ " + group + " " + name + "-ს წაშლა?");
    if(conf == true){
        window.location.href = "/apanel/index.php?component=users&delete="+id;
    }
}

function imgShow(e){
    $('img',e).show();
}
function imgHide(e){
    $('img',e).hide();
}

function checkInput(e){
    $('input',e).click();

}

function show_design_img(size){
    var control = $("#imgInp");
    control.replaceWith( control = control.clone( true ) );
    var sz = size.split('x');
    var iw = $(".imgplace img").width();
    var ih = $(".imgplace img").height();
    var html =  '(' + size + ')';

    if($("#imgInp").val() == ""){
        $('.input-img span').html(html);
        $('input[name="newimgsz"]').val(sz[0] + 'x' + sz[1]);
        $(".imgplace div").css({width:sz[0] + "px",height:sz[1] + "px"});
    }else{

        if(sz[0] <= iw && sz[1] <= ih){
            $(".imgplace div").css({width:sz[0] + "px",height:sz[1] + "px"});
            $('.input-img span').html(html);
            $('input[name="newimgsz"]').val(sz[0] + 'x' + sz[1]);
        }else{
            $('input[name="style"]').attr("checked",false);
            alert("დიზაინის ფოტოს სიგრძე და სიმაღლე არ შეესაბამება არჩეული ფოტოს სიდიდეს, გთხოვთ სცადოთ სხვა დიზაინი ან აირჩიოთ შესაბამისი ზომის ფოტო");
        }
    }
}

var desPhotoAdmin = function(pw,ph){

}

$(function(){
    var _URL = window.URL || window.webkitURL;

    $("#imgInp").change(function(e) {
        var file, img;


        if ((file = this.files[0])) {
            img = new Image();

            img.onload = function() {
                var sz = $('input[name="newimgsz"]').val().split('x');

                //console.log(sz[0] + ' - ' + sz[1]);
                if(this.width >= sz[0] && this.height >= sz[1]){
                    /*$(".imgplace div").css({width:sz[0] + "px",height:sz[1] + "px"});
                     $("#popupbg").show();
                     $("#imgpl").show();
                     $(".imgplace").show();
                     $(".imgplace").width(this.width);
                     $('#blah').attr('src', this.src);*/
                    $('#picture_inside').attr('src',this.src);
                    $('#picinside div').show();
                    //desPhotoAdmin(sz[0],sz[1]);
                }else if(this.width < sz[0] && this.height < sz[1]){
                    alert("არჩეული ფოტოს ზომა არ შეესაბამება მონიშნული დიზაინის ფოტოს ზომას")
                    $("#imgInp").val("");
                }
            };
            img.onerror = function() {
                alert( "not a valid file: " + file.type);
            };
            img.src = _URL.createObjectURL(file);

        }

    });

    $("#prphoto").change(function(e) {
        var file, img;


        if ((file = this.files[0])) {
            img = new Image();
            img.onload = function() {
                if(this.width >= 655 && this.height >= 440){
                    //$(".imgprev div").css({width:"750px",height:"530px"});
                    //$("#popupbg").show();
                    // $("#imgpr").show();
                    //$(".imgprev").show();
                    //$(".imgprev").width(this.width);
                    //$('#prah').attr('src', this.src);
                    $('#sample_picture').attr('src',this.src);
                    $('#primageframe div').show();
                }else{
                    alert("პრევიუ ფოტოს სიგრძე სავალდებულიოა იყოს არანაკლებ 655px და სიმაღლე არანაკლებ 440px.");
                    $("#prphoto").val("");
                }
            };
            img.onerror = function() {
                alert( "not a valid file: " + file.type);
            };
            img.src = _URL.createObjectURL(file);

        }

    });


});


/*
 $(function(){
 document.getElementById('dxy').addEventListener('mousedown', mouseDown, false);
 window.addEventListener('mouseup', mouseUp, false);
 document.getElementById('pxy').addEventListener('mousedown', pmouseDown, false);
 window.addEventListener('mouseup', pmouseUp, false);
 });

 */
function mouseUp()
{
    window.removeEventListener('mousemove', divMove, true);
}

function mouseDown(e){
    window.addEventListener('mousemove', divMove, true);
}

function pmouseUp()
{
    window.removeEventListener('mousemove', pivMove, true);
}

function pmouseDown(e){
    window.addEventListener('mousemove', pivMove, true);
}
function divMove(e){
    var div = document.getElementById('dxy');
    div.style.position = 'absolute';
    div.style.top = e.clientY + 'px';
    div.style.left = e.clientX + 'px';
    $('input[name="left"]').val(e.clientX);
    $('input[name="top"]').val(e.clientY);

}
function pivMove(e){
    var piv = document.getElementById('pxy');
    piv.style.position = 'absolute';
    piv.style.top = e.clientY + 'px';
    piv.style.left = e.clientX + 'px';
    $('input[name="pleft"]').val(e.clientX);
    $('input[name="ptop"]').val(e.clientY);
}
/*
 $(function(){
 document.getElementById('dxy').addEventListener('mousedown', mouseDown, false);
 window.addEventListener('mouseup', mouseUp, false);
 });
 */

function mouseUp()
{
    window.removeEventListener('mousemove', divMove, true);
}

function mouseDown(e){
    window.addEventListener('mousemove', divMove, true);
}

function divMove(e){
    var div = document.getElementById('dxy');
    div.style.position = 'absolute';
    div.style.top = e.clientY + 'px';
    div.style.left = e.clientX + 'px';
    $('input[name="left"]').val(e.clientX);
    $('input[name="top"]').val(e.clientY);
}

function cropImg(){
    $("#popupbg").hide();
    $("#imgpl").hide();
    $(".imgplace").hide();
    $("#imgpr").hide();
    $(".imgprev").hide();
}

function get_image_size(old,e){
    var html = "<img id='get_img_size' src='" + e.value + "' style='display:none;'>";
    $("#image_size").append(html);
    $.ajax({
        url:window.location.pathname,
        type:"post",
        data:$("#image_size").append(html),
        success:function(data){
            var width = $("#get_img_size").width();
            var height = $("#get_img_size").height();
            if(width < 1920 && height != 150){
                alert("Header ფოტოს სავალდებულოა იყოს 1920x150");
                e.value = old;
                $("#image_size").html("");
            }else{
                $("#image_size").html("");
            }
            // $(e).attr("onChange","get_image_size2('"+old+"','"+e.value+"')");
        }
    });

}



var count = 0;
function step(num,step,test){
    var error = "";
    if(num == 1){
        if(error == ""){
            $('.'+test+' .active .error_box').remove();
            $('.'+test+' .active').removeClass('active');
            $('.'+test+' li:nth-child(1)').addClass('active');
            $('.'+step+' .active').removeClass('active');
            $('.'+step+' li:nth-child(1)').addClass('active');
        }
    }
    if(num == 2){
        count = 0;
        if($('.'+test+' li:first-child').find('input').val() == ""){
            error = "გთხოვთ ჩაწეროთ სათაური";
            $('.'+test+' .active').prepend('<div class="error_box">'+error+'</div>');
        }
        if(error == ""){
            $('.'+test+' .active .error_box').remove();
            $('.'+test+' .active').removeClass('active');
            $('.'+test+' li:nth-child(2)').addClass('active');
            $('.'+step+' .active').removeClass('active');
            $('.'+step+' li:nth-child(2)').addClass('active');
        }
    }

    if(num == 3){
        var pnum = [];


        var sum = [0];
        var qnum = $('.' + test + ' .active table tbody tr').length;
        for(var i = 1; i<=qnum; i++){
            pnum[i] = $('.' + test + ' .active table tbody tr:nth-child(' + i + ') td:nth-child(3) span').length;
            var ar = [0];
            for(var a = 1; a<=pnum[i]; a++){
                ar[a] = $('.' + test + ' .active table tbody tr:nth-child(' + i + ') td:nth-child(3) span:nth-child('+a+') > input').val();

            }

            sum[i] = Math.max.apply(Math,ar);



            if($('.' + test + ' .active table tbody tr:nth-child(' + i + ') td:nth-child(1) input').val() == ""){
                $('.' + test + ' .active table tbody tr:nth-child(' + i + ') td:nth-child(1) input').css('border','1px solid red');
                error = "აუცილებელია ჩაწეროთ კითხვა, შესაბამისი პასუხები და ქულები.";
                if($('.error_box').length <= 0){
                    $('.'+test+' .active').prepend('<div class="error_box">'+error+'</div>');
                }else{
                    $('.error_box').html(error);
                }
            }else{
                $('.' + test + ' .active table tbody tr:nth-child(' + i + ') td:nth-child(1) input').css('border','1px solid green');
            }
        }


        for(var i = 0; i<sum.length; i++){
            count = count + sum[i];
        }


        if(error == ""){
            $('.'+test+' .active .error_box').remove();
            $('.'+test+' .active').removeClass('active');
            $('.'+test+' li:nth-child(3)').addClass('active');
            $('.'+step+' .active').removeClass('active');
            $('.'+step+' li:nth-child(3)').addClass('active');
            $('.'+test+' .active h3').html('მაქსიმალური ქულა შეადგენს '+count+', გთხოვთ შეადგინოთ შედეგები 0 დან '+count+' ქულის ჩათვლით.');
        }
    }


    if(num == 4){
        var rnum = $('.' + test + ' .active table tbody tr').length;
        for(var i = 1; i<=rnum; i++){
            if($('.' + test + ' .active table tbody tr:nth-child(' + i + ') td:nth-child(1) textarea').val() == ""){
                $('.' + test + ' .active table tbody tr:nth-child(' + i + ') td:nth-child(1) textarea').css('border','1px solid red');
                error = "აუცილებელია ჩაწეროთ შედეგი შესაბამისი ქულებით.";
                if($('.error_box').length <= 0){
                    $('.'+test+' .active').prepend('<div class="error_box">'+error+'</div>');
                }else{
                    $('.error_box').html(error);
                }
            }else{
                $('.' + test + ' .active table tbody tr:nth-child(' + i + ') td:nth-child(1) textarea').css('border','1px solid green');
                document.test.submit();
            }
        }
    }
}

var que = 0;
function removeQuestion(e){
    $(e).parent('td').parent('tr').remove();
}
function addQuestion(e){
    que++;
    var idl = $(".question-answer tbody tr").length;
    for(var i = 1; i<=idl;i++){
        if($(".question-answer tbody tr:nth-child("+i+")").attr('data-id') == que){
            que = que + 1;
        }

    }



    var place = $(e).parent('td').parent('tr').parent('tfoot').parent('table').find('tbody');
    var html = '<tr data-id="'+que+'"><td><input type="text" name="question[]" value="" class="form-control" style="width:400px;" ></td>'+
        '<td align="right">'+
        '<input type="text" name="answer[' + que + '][]" value="" class="form-control" style="width:300px;" ></br>'+
        '<input type="text" name="answer[' + que + '][]" value="" class="form-control" style="width:300px;" ></br><div></div>'+
        '<a class="btn-blue" style="color:#FFF;" onclick="addAnswer(this)">+ მეტი პასუხი</a>'+
        '</td><td><div><span><input type="text" name="point[' + que + '][]" value="0" class="form-control" style="width:50px;text-align:center;" ></br></span>'+
        '<span><input type="text" name="point[' + que + '][]" value="0" class="form-control" style="width:50px;text-align:center;" ></br></span></div>'+
        '<a style="height:28px;"></a></td><td align="center"><a onclick="removeQuestion(this)" style="cursor:pointer;"><img src="theme/images/error.png"></a></td></tr>';
    place.append(html);

}



function addAnswer(e){
    var qn = $(e).parent('td').parent('tr').attr('data-id');
    if($(e).parent('td').find('input').length < 10){
        if(qn){
            que = qn;
        }
        $(e).parent('td').find('div').append('<input type="text" name="answer[' + que + '][]" value="" class="form-control" style="width:300px;" ></br>');
        $(e).parent('td').next('td').find('div').append('<span><input type="text" name="point[' + que + '][]" value="0" class="form-control" style="width:50px;text-align:center;" ></br></span>');

    }else{
        if($('.error_box').length <= 0){
            $('.test .active').prepend('<div class="error_box"></div>');
        }
        $('.error_box').html('1 კითხვაზე პასუხების მაქსიმალური რაოდენობა = 10');
    }

}


var ans = 0;
function removeResult(e){
    $(e).parent('td').parent('tr').remove();
}


function addResult(e){
    ans++;
    var po = $(".answer-answer tbody tr").length;
    for(var i = 0; i<=po; i++){
        while($(".answer-answer tbody tr:nth-child("+i+")").attr('data-id') == ans){
            ans = ans + 1;
        }
    }
    var place = $(e).parent('td').parent('tr').parent('tfoot').parent('table').find('tbody');
    var html = '<tr><td><textarea name="result[' + ans + '][text]" class="form-control" style="width:550px;height:90px;"></textarea></td>' +
        '<td align="center"><input type="text" name="result[' + ans + '][min]" class="form-control" style="width:50px;text-align: center;"></td>' +
        '<td align="center"><input type="text" name="result[' + ans + '][max]" class="form-control" style="width:50px;text-align: center;"></td>' +
        '<td align="center"><a onclick="removeResult(this)" style="cursor:pointer;"><img src="theme/images/error.png"></a></td></tr>';
    place.append(html);
}

function deleteTest(id){
    var con = confirm('ნამდვილად გსურთ ტესტი №'+id+' წაშლა?');
    if(con == true){
        window.location.href = '/apanel/index.php?component=test&delete='+id;
    }
}


function getBannerCat(e){
    $("#banner_position").val($("option:selected",e).text());
}


function opentiny(e){
    var html = '<script>tinymce.init({selector: "textarea.tinymce",menubar: false,plugins: ["advlist autolink lists","code"],toolbar1: "undo redo | bold italic underline | print preview code "});</script>';

    $("#textarea1").addClass('tinymce');
    $("body").append(html);
    $(e).remove();

}

