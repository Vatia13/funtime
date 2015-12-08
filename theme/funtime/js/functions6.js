/**
 * Created by Vati Child on 12/5/14.
 */
function showRubrics(){
    $('.rubrics').toggle('slide',{direction:'left'},500);
    $('.rubrics > div').slideToggle(500);
}

function showFacebook(){
    $('.social-like-box').toggle('slide',{direction:'right'},500);
}

function showMessage(){
    $('.black-background').toggle();
    $('.message-form').toggle();
}
function closeMessage(){
    $('.black-background').hide();
    $('.message-form').hide();
}
function sendMessage(e){
    var author = e.author.value;
    var email = e.mails.value;
    var text = e.textvalue.value;
    if(email == ""){
        e.mails.style.border = "1px solid red";
        return false;
    }else if(author == ""){
        e.author.style.border = "1px solid red";
        return false;
    }else if(text == ""){
        e.textvalue.style.border = "1px solid red";
        return false;
    }else{
        $.ajax({
            url:'/lib/ajax-admin.php',
            type:'POST',
            data:{author:author,text:text,email:email,action:'sendMessage'},
            success:function(data){
                if(data == '1'){
                    $('.message-form span').html('წერილი წარმატებით გაიგზავნა');
                    $('.message-form form').html('');
                }else{
                    return false;
                }

            }
        })
    }
}
function makeClick(submit){
    $('input[name="'+submit+'"]').click();
}

function shareWindow(name,e){
    window.open(e.href, ''+name+'','left=20,top=20,width=500,height=500,toolbar=1,resizable=0');
}







$(function(){
    var rubricsH = $(window).height() - 150;
    $('.rubrics').css('height',rubricsH+'px');
    $('img').bind('contextmenu', function(e) {
        return false;
    });


    var testNum = $('.testpage ol li').length;
    var co = 1;

    $('.testpage ol li input').each(function(){
        $(this).click(function(){
            if(co >= testNum){
                $("#testres").attr('disabled',false).css('opacity','1');
            }
            co++;
        });
    });
});


function checkTest(e){
    var error = "";
    var a = 0;
    var b = 0;
    var check = []
    var num = $('ol li',e).length;
    for(var i = 0; i < num; i++){
        a++;
        //alert($('input[name="num[]"]',e).val());
        for(var c = 0; c < $('ol li:nth-child('+a+') dl dt',e).length; c++){
            b++;
            if($('ol li:nth-child('+a+') dl dt:nth-child('+b+') input',e).attr('checked') == 'checked'){
                check[i] = 1;
            }
        }
        b=0;
        if(check[i] == 1){
            error = "";
        }else{
            error = "შეცდომა: შედეგის სანახავად აუცილებელია უპასუხოთ ყველა კითხვას.";
        }
    }

    if(error == ""){
        $(".error_box").hide();
        document.test.submit();
        return true;
    }else{
        $(".error_box").html(error).show();
    }

}

$(function(){
    if(window.innerWidth < 1900){
        $('.header-bg').hide();
        $("#content").css('margin','0px 0px');
        $("#header").css("top","0px");
        $(".rubrics").css("top","0px");
    }else{
        showRubrics();
    }

    /*
     var postImgLength = $('.post-content img').length;
     console.log(postImgLength);
     var style = [];
     for(var i = 0; i < postImgLength; i++){
     style[i] = $('.post-content img:eq('+ i +')').attr('style');
     if(style[i].indexOf('float: left') > 0){
     // console.log('yes');
     style[i] += 'margin-left:0 !important;';
     $('.post-content img:eq('+ i +')').attr('style',style[i]);
     }

     if(style[i].indexOf('float: right') > 0){
     style[i] += 'margin-right:0 !important;';
     $('.post-content img:eq('+ i +')').attr('style',style[i]);
     }
     }
     */
    $('img').mousedown(function(){return false});
});

