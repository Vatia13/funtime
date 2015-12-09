/**
 * Created by Vati Child on 9/24/2015.
 */



var addFormFields = function() {
    //var id,update,author,cat,title,title_short,victorina,published_at,facebook_img,framecolor,rubcolor,youtube,design,lidi,body,sakimg,photographer,sponsored,copy,info;
    var options = {

        id: $('input[name="id"]').val(), //
        update: $('input[name="update"]').val(),//
        add: $('input[name="add"]').val(),//
        author: $('select[name="author"]').val(),//
        cat: $('select[name="cat"]').val(),//
        title: $('input[name="title"]').val(),//
        title_short: $('input[name="title_short"]').val(),//
        victorina: $('select[name="victo"]').val(),
        published_at: $('select[name="date_yy"]').val() + '-' + $('select[name="date_mm"]').val() + '-' + $('select[name="date_dd"]').val() + ' ' + $('select[name="time_hh"]').val() + ':' + $('select[name="time_mm"]').val() + ':00',
        framecolor: $('input[name="framecolor"]').val(),
        rubcolor: $('input[name="rubcolor"]').val(),
        youtube: $('input[name="youtube"]').val(),
        design: $('input[name="style"]:checked').val(),
        lidi: tinymce.get('lidi').getContent(),
        sakimg: $('input[name="sakimg"]').val(),
        photographer: $('input[name="phg"]').val(),
        sponsored: $('input[name="sponsored"]').val(),
        photop:$('input[name="photop"]').val(),
        pleft:$('input[name="pleft"]').val(),
        ptop:$('input[name="ptop"]').val(),
        desimg:$('input[name="desimg"]').val(),
        imgsz:$('input[name="imgsz"]').val(),
        top:$('input[name="top"]').val(),
        left:$('input[name="left"]').val(),
        slide_type:($('input[name="slide_type"]:checked').val() > 0) ? 1 : 0,
        copy: {ctitle:$('input[name="copy[title]"]').val(),curl:$('input[name="copy[url]"]').val()},
        info: {
            address: $('input[name="info[address]"]').val(),
            facebook:$('input[name="info[facebook]"]').val(),
            skype:$('input[name="info[skype]"]').val(),
            mobile:$('input[name="info[mobile]"]').val(),
            phone:$('input[name="info[phone]"]').val(),
            email:$('input[name="info[email]"]').val(),
            website:$('input[name="info[website]"]').val()
        },

        chpu:$('input[name="chpu"]').val(),
        meta_key:$('textarea[name="meta_key"]').val(),//
        meta_desc:$('textarea[name="meta_desc"]').val(),//
        body: tinymce.get('textarea1').getContent()
    };



    var files = document.getElementsByTagName("input");
    var fd = new FormData();
    for (var i = 0; i < files.length; i++) {
        if (files[i].getAttribute("type") == "file") {
            fd.append(files[i].getAttribute("name"), files[i].files[0]);
        }
    }

    for(var k in options){
        if(k=='info'){
            for(var inf in options[k]){
                fd.append(inf, options[k][inf]);
            }
        }else if(k=="copy"){
            for(var cop in options[k]){
                fd.append(cop, options[k][cop]);
            }
        }else{
            fd.append(k, options[k]);
        }

    }
    var slider = document.getElementsByClassName('slide_img');
    var sliderName = document.getElementsByClassName('slide_name');
    var slider_name = [];
    var slider_img = [];
    for(var i=0;i<sliderName.length;i++){
        //console.log("editor_"+i);
        slider_name[i] = (tinymce.get("editor_"+i).getContent()) ? tinymce.get("editor_"+i).getContent() : '';
    }
    if(slider.length > 0){
        for(var i=0;i<slider.length;i++){
            slider_img[i] = (slider[i].value) ? slider[i].value : '';
        }
    }

    fd.append('slider_img',JSON.stringify(slider_img));
    fd.append('slider_name',JSON.stringify(slider_name));



    var concurs_names = document.getElementsByClassName('concurs_names');
    var concurs_name = [];
    var concurs_img_name = [];
    var concurs_image_names = [[],[]];
    //images
    var concurs_img = [];
    var concurs_images = [[],[]];
    for(var i=0;i<concurs_names.length;i++){
        concurs_img[i] = [];
        concurs_img_name[i] = [];
        if(concurs_names[i].getAttribute('name') == "concurs["+(i+1)+"][name]"){
            concurs_name[i] = (concurs_names[i].value) ? concurs_names[i].value : '';
            //img
            concurs_images[i] = document.getElementsByClassName('concurs_images_'+(i+1));
            //img_name
            concurs_image_names[i] = document.getElementsByClassName('concurs_image_names_'+(i+1));


            for(var a=0;a<concurs_images[i].length;a++){
                if(concurs_images[i][a].getAttribute('name') + '['+a+']' == "concurs["+(i+1)+"][img][]["+a+"]"){
                    if(concurs_images[i][a].value != ""){
                        concurs_img[i][a] = (concurs_images[i][a].value) ? concurs_images[i][a].value : '';
                    }
                }
                if(concurs_image_names[i][a].value != ""){
                    concurs_img_name[i][a] = (concurs_image_names[i][a].value) ? concurs_image_names[i][a].value : '';
                }
            }


        }
    }


    fd.append('concurs_img',JSON.stringify(concurs_img));
    fd.append('concurs_img_name',JSON.stringify(concurs_img_name));
    fd.append('concurs_name',JSON.stringify(concurs_name));
    var ajax = new XMLHttpRequest();
    ajax.addEventListener("progress", updateProgress,false);
    ajax.addEventListener("load",request,false);
    ajax.open("POST","/apanel/index.php?component=article&section=ajax");
    ajax.send(fd);
};

function request(event){
    var html = "";
    //console.log(event.target.responseText);

    var response = JSON.parse(event.target.responseText);

    var imagePlace = document.getElementById('ajax_slide_images');
    var sakimg = document.getElementById('sakimg');
    if(event.target.responseText != 0 && event.target.responseText != 1){
        if(response.photop){
            if(response.photop != "" && response.photop != 'undefined'){
                document.getElementsByName('photop')[0].value = response.photop;
            }
        }
        if(response.desimg){
            if(response.desimg != ""){
                document.getElementsByName('desimg')[0].value = response.desimg;
            }
        }
        if(response.facebook){
            if(response.facebook != ""){
                document.getElementsByName('fbf')[0].value = response.facebook;
            }
        }



        if(response.slide){
            if(response.slide.length > 2){
                var slide = JSON.parse(response.slide);
                if(slide['img']){
                    for(var i=0;i<slide['img'].length;i++){
                        $('#parentId > tbody > tr:eq('+i+') > td:eq(1)').html('<img src="'+slide['img'][i]+'" width="300" class="img'+i+'"/>');
                    }
                    // imagePlace.innerHTML = html;
                }
            }
        }

        if(response.body != ""){
            if(sakimg){
                sakimg.value = "";
            }
            tinymce.get('textarea1').setContent(response.body);
        }
        $("#modal-window").fadeOut(600);
        if(response.id != "" && response.id != 'undefined' && response.id > 0){
            window.location.href = "/apanel/index.php?component=article&section=edit&edit="+response.id;
        }
    }else if(event.target.responseText == 0){
        alert('Facebook ფოტოს ზომა: 470x247');
    }else if(event.target.responseText == 1){
        alert('ახალი სიახლის შესანახად საჭიროა აირჩიოთ რუბრიკა და ჩაწეროთ სათაური');
    }else{
        alert('ვერ ხერხდება ბაზასთან დაკავშირება!');
    }

}

function updateProgress(){
    $("#modal-window").fadeIn(400);
}
/*
 //var form = $('form'); // You need to use standart javascript object here
 // var formData = new FormData();
 //var data = new FormData($('form[name="formedit"]'));
 //formData.append('fb',$("#facebook_image")[0].files[0]);
 //console.log(formData);

 $.ajax({
 url:'/apanel/index.php?component=article&section=ajax',
 type:'POST',
 data: $("#facebook_image")[0].files[0],
 cache: false,
 contentType: false,
 processData: false,
 success:function(response){
 console.log(response);
 }
 });

 };


 */
//setInterval(addFormFields,5000);



document.addEventListener("keydown", keyDownTextField, false);
document.addEventListener("keyup", keyUpTextField, false);
var map = [];
function keyDownTextField(e) {
    var keyCode = e.keyCode;
    map[keyCode] = keyCode;

    if(map[18] && map[83] && !map[16] && !map[9]){
        addFormFields();
        map = [];
    }
}

function keyUpTextField(e){
    if (e.keyCode in map) {
        map[e.keyCode] = false;
    }
}

