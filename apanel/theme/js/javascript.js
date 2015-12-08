/**
 * Created by Vati Child on 9/28/2015.
 */

jQuery(document).ready(function($){
    $('select[name="cat"]').change(function(){
        if($('option:selected',this).attr('data-type') == 1){
            $("#photoSlide2").show();
            $("#photoSlide1").hide();
            $(".hide_design").hide();
        }else{
            $("#photoSlide2").hide();
            $("#photoSlide1").show();
            $(".hide_design").show();
        }
    });
    if($('select[name="cat"] option:selected').attr('data-type') == 1){
        $("#photoSlide2").show();
        $("#photoSlide1").hide();
        $(".hide_design").hide();
    }


    $('.remove_concursant').click(function(){
        var id = $(this).attr('data-id');
        $("#concursant_place tr:nth-child("+id+")").remove();
    });



});


var photoConcurs = function(){
    var c_num = document.getElementsByName('concursant_number')[0];
    var i_num = document.getElementsByName('concursant_image_number')[0];
    var c_place = document.getElementById('concursant_place');
    var count_tr = jQuery("#concursant_place table tr").length;
    console.log(count_tr);

    if(c_num.value  > 0 && i_num.value > 0){
        var html = '';
        for(var i = count_tr + 1; i <= (parseInt(c_num.value) + parseInt(count_tr)); i++){
            html += '<tr><td valign="top"> '+i+'. <input type="text" name="concurs['+i+'][name]" class="concurs_names" id="concursant_name'+i+'"  value="" placeholder="კონკურსანტის ვინაობა" ></td><td>';
            for(var a = 1; a <= i_num.value; a++){
                html +='<p><input type="text" name="concurs['+i+'][img_name][]" class="concurs_image_names_'+i+'" id="concursant_img_name_'+i+'_'+a+'" value="" placeholder="ფოტოს დასახელება" style="align:left;"/> ';
                html +='<input type="text" name="concurs['+i+'][img][]" class="concurs_images_'+i+'" id="con_img_'+i+'_'+a+'" value="" > ';
                html +='<a href="http://funtime.ge/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=con_img_'+i+'_'+a+'" class="btn-blue iframe-btn" type="button">ფოტო '+i+'-'+a+'</a></p>';
            }
            html += '</td><td><a class="remove_concursant" onclick="removeConcursant(this);" style="cursor:pointer;" data-id="'+i+'">[x]</a></td></tr>';
        }

        jQuery("#concursant_place table").append(html);
        $(document).ready(function () {
            $('.iframe-btn').fancybox({
                'width'		: 900,
                'height'	: 600,
                'type'		: 'iframe',
                'autoScale'    	: false
            });
        });
    }

};

var clearConcurs = function(){
    jQuery("#concursant_place table").html("");
};

var removeConcursant = function(event){
    jQuery(event).parent('td').parent('tr').remove();
};