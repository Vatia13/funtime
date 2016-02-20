<? defined('_JEXEC') or die('Restricted access');?> 
<style>
  
body { 
    overflow-x: hidden;
} 
.rubrics::-webkit-scrollbar-thumb {
    background: #ff5704;
    border-radius: 9px;    
}
 ::-webkit-scrollbar {
    width: 9px;
    background: rgba(39,191,196,0.9);
}
::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: #ff5704;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    -webkit-border-radius: 10px;
    border-radius: 10px;
}  
#competition_designe{ 
	position: relative; 
    top: -37px; 
	width:100%;  
	} 
#registration {
	font-family: 'BPGNinoMtavruliRegular';
	background-color:#FFFFFF;
	z-index:1;
	padding:15px;
	position:absolute; 
	top:10%;
	right:2%; 
	height:auto;
	width:20%;
	} 
#registration_info{
	background-color: rgba(0, 0, 0, 0.5); 
	color: rgba(0, 0, 0);
	position:absolute; 
	top:30%;
	left:5%; 
	height:auto;
	width:50%;
	}
#registration_info div p{ 
	font-family: 'BPGNinoMtavruliRegular';
	color:white;
	font-size:48px;
	position:absolute;
	top:-10%;  
	}
#registration_info .more{ 
	font-family: 'BPGNinoMtavruliRegular';
	color:white;
	font-size:25px;
	position: relative;
    top: 60px;
    padding: 50px;  
	}
#registration_conditions{
	background-color: rgba(68, 197, 203, 0.8); 
	color: rgba(68, 197, 203);
	position:absolute; 
	top:55%;  
	height:auto;
	padding:20px;
	width:100%;
	} 
#registration_conditions div{ 
    font-family: 'BPGNinoMtavruliRegular';
    color: white;
    font-size: 18px;
    position: relative !important;
    top: 3%;
    left: 4%;
    height: 15%;
    width: 100%;
	}
#img {
    width: 100%;
    height: auto;
}
#footer{margin-top:-40px !important;} 
.inpp{
font-family: 'BPGNinoMtavruliRegular';
    background: #27bec5;
    color: #FFFFFF;
    border: 0px solid #DCDCDC;
    border-radius: 5px;
    font-size: 20px;
    height: 20px;
    line-height: 5px;
  	 width: 90% ;
    padding: 20px;  
	}
input[type=text]:focus, textarea:focus {
	box-shadow: 0 0 5px rgba(39, 191, 196, 1);
	border: 0px solid rgba(39, 191, 196, 1);
}
input[type=text]{
	-webkit-transition: all 0.30s ease-in-out;
	-moz-transition: all 0.30s ease-in-out;
	-ms-transition: all 0.30s ease-in-out;
	-o-transition: all 0.30s ease-in-out;
	outline: none;
}
.inp1{
background-image: url(/<?=$theme?>images/com_user.png);
background-position:95%;
background-repeat: no-repeat;
font-family: 'BPGNinoMtavruliRegular';
background-color:#F8F8F8;
color:#606060;
border:0px solid #DCDCDC;
border-radius:5px ;
font-size:13px ;
height: 20px ;
line-height:20px ;
width: 90% ;
padding: 10px ;   
	}
.inp4{
background-image: url(/<?=$theme?>images/com_user.png);
background-position:95%;
background-repeat: no-repeat;
font-family: 'BPGNinoMtavruliRegular';
background-color:#F8F8F8;
color:#606060;
border:0px solid #DCDCDC;
border-radius:5px ;
font-size:13px ;
height: 20px ;
line-height:20px ;
width: 90% ;
padding: 10px ;   
	}
.inp2{ 
background-image: url(/<?=$theme?>images/com_age.png);
background-position:95%;
background-repeat: no-repeat;
font-family: 'BPGNinoMtavruliRegular';
background-color:#F8F8F8;
color:#606060;
border:0px solid #DCDCDC;
border-radius:5px ;
font-size:13px ;
height: 20px ;
line-height:20px ;
width: 90% ;
padding: 10px ;    
	}
.inp3{ 
background-image: url(/<?=$theme?>images/com_phone.png);
background-position:95%;
background-repeat: no-repeat;
font-family: 'BPGNinoMtavruliRegular';
background-color:#F8F8F8;
color:#606060;
border:0px solid #DCDCDC;
border-radius:5px ;
font-size:13px ;
height: 20px ;
line-height:20px ;
width: 90% ;
padding: 10px ;    
	}
 #file {
background-image: url(/<?=$theme?>images/up_button.png);
background-position:50%;
height:100px;
background-repeat: no-repeat;
}
#file input {
   filter: alpha(opacity=0);
   opacity: 0;
   height: 100px;
} 
.not_active {
	Xopacity:0.2;	
} 
 #u_0_6{
	 display:none !important;
	 }
@media (max-width: 414px) {
.inpp{padding:30px;}
#img{ display:none;}
#competition_designe {
    position: relative; 
    width: 100%;
}
#registration_info {
    background-color: rgba(0, 0, 0, 0.5);
    color: rgba(0, 0, 0);
    position: relative;
    top: 65px;
	left: 0px; 
    height: auto;
    width: 100%;
}
#registration_info div p {
    font-family: 'BPGNinoMtavruliRegular';
    color: white;
    font-size: 30px;
    position: relative;
    top: 35px;
}
#registration_info .more {
    font-family: 'BPGNinoMtavruliRegular';
    color: white;
    font-size: 25px;
    position: relative; 
    top: -10px;
    padding: 24px;
}
#registration_conditions div {
    font-family: 'BPGNinoMtavruliRegular';
    color: white;
    font-size: 18px;
    position: relative !important;
    top: 3%; 
	left:0px;
	width: 94%;
    height: 15%; 
}
#registration_conditions {
    background-color: rgba(68, 197, 203, 0.8);
    color: rgba(68, 197, 203);
    position: relative;
    top: 39px;
    height: auto;
    padding: 10px;
    width: 100%; 
}
#registration {
    font-family: 'BPGNinoMtavruliRegular';
    background-color: #FFFFFF;
    z-index: 1; 
    padding: 15px;
    position: absolute;
    top: 750px;
    right:-15px;
    height: auto;
    width: 100%; 
}
 }
</style> 

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ka_GE/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
 
<script type="text/javascript" src="/<?=$theme?>js/geo_keyborad.js"></script>
 <script type="text/javascript">
 	$(document).ready(function(e) {
 		GeoKBD.map('comp_form','fname'); 
		GeoKBD.map('comp_form','lname'); 
    }); 
 </script>
<script>  
$( document ).ready(function() {
   $('.rubrics').css('display','none');
});


function comp_click(){ 
file_counts = $( "#file_counts" ).children().length;
	
	if($('.inp1').val() == "" || $('.inp4').val() == "" || $('.inp3').val() == "" || $('.inp2').val() == "" || file_counts < 5){
		$('.inp1').css("border","1px solid red");
		$('.inp4').css("border","1px solid red");
		$('.inp3').css("border","1px solid red");
		$('.inp2').css("border","1px solid red");
		$('#validation').css("display","block");
	}
	else 
	 $.post( "competition",$( "#comp_form" ).serialize(),function( data ) {$('#comp_form').html(data);});
	 $('.inpp').hide();
		
};
function check_upload_form(){
	if($('.inp1').val() != "" && $('.inp4').val() != "" && $('.inp2').val() != "" && $('.inp3').val() != ""){
		$('#upload').removeClass('not_active');
		$('#check_file').prop("disabled", false);
		$('#full_name').val($('.inp1').val()+" " + $('.inp4').val());
	}
	else{
		$('#upload').addClass('not_active');
		$('#check_file').prop("disabled", true);	
	}
	if($( "#file_counts" ).children().length > 4){
		$('#upload').addClass('not_active');
		$('#check_file').prop("disabled", true);	
	} 
	 
  // $( this ).find( "#file" ).slideDown(1500);
  

}; 
function tete(){
	 $( '#file' ).slideDown(1500); 
	 $('#check_file').prop("disabled", false);
  }
</script>
<div id="fb-root"></div>
<div id="competition_designe" >   
<img id="img" src="/<?=$theme?>images/compitition_back.jpg">
<div id="registration"> 
    <div style="width:100%; height:100%"> <br><br>
        <form id="comp_form" name="comp_form" action="/<?=$theme?>component/competition/.model.php" method="post" enctype="multipart/form-data">
            <div align="center" style="font-weight:900; font-size:25px; color:#606060;">რეგისტრაცია</div><br>
            <div align="center" style="font-weight:400; font-size:15px; color:#606060;">კონკურსში მონაწილეობის მისაღებად შეავსეთ შემდეგი ველები</div><br>
            <div align="center"><input onChange="check_upload_form()" class="inp1" type="text" placeholder="სახელი" name="fname" id="fname"></div><br>
            <div align="center"><input onChange="check_upload_form()" class="inp4" type="text" placeholder="გვარი" name="lname"></div><br>
            <div align="center"><input onChange="check_upload_form()" class="inp2" type="text" maxlength="2" placeholder="ასაკი" name="age"></div><br>
            <div align="center"><input id="num"  onKeyUp="tete()" class="inp3" type="text" maxlength="9"  placeholder="ტელეფონი" name="phone"></div><br>
            <div align="center" style="font-weight:900; font-size:18px; color:#606060;">ატვირთეთ თქვენ მიერ გადაღებული<br><font color="#ff5704"> 5 ფოტო</font></div>  
            <div id="validation" align="center" style="color:red; display:none;">სავალდებულოა ყველა ველის შევსება<br> და 5 ფოტოს ატვირთვა </div>
        </form> 
		<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' /> 
        <form id="upload" method="post" action="/<?=$theme?>component/competition/upload.php" enctype="multipart/form-data" class="not_active"> 
            <div align="center" id="file"  style="display:none;"> <input disabled id="check_file" type="file" name="upl" onClick="check_upload_form()" max="5" multiple /> </div>
          	  <input type="hidden" name="full_name" id="full_name"> 
            	<ul id="file_counts" style="list-style:none;"> </ul> 
        </form>
		<div align="center"> <input class="inpp" type="button" value="გაგზავნა" onClick="comp_click()" ></div>   
		<script src="/<?=$theme?>assets/js/jquery.knob.js"></script> 
		<script src="/<?=$theme?>assets/js/jquery.ui.widget.js"></script>
		<script src="/<?=$theme?>assets/js/jquery.iframe-transport.js"></script>
		<script src="/<?=$theme?>assets/js/jquery.fileupload.js"></script> 
		<script src="/<?=$theme?>assets/js/script.js"></script>   
    </div>  
</div>
        <div id="registration_info"> 	
            <div> 
            <p align="center">კონკურსი მოყვარული ფოტოგრაფებისთვის</p><br>
            <p class="more" align="center">მიიღე მონაწილეობა, გაიმარჯვე და მოიგე<br> ნახევრად პროფესიონალური ფოტოაპარატი!</p>
            <div style="position:relative; left:40%; bottom:10px; margin-right:0px;">
            <div class="fb-send" data-href="http://funtime.ge/com/competition"></div>
           <div  class="fb-like" data-href="http://funtime.ge/com/competition" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
           </div>
            </div>
        
        </div>
        <div id="registration_conditions">
            <div><p align="left"><strong>კონკურსანტებიდან 15 მონაწილეს შეარჩევს ჟიური, რომლის წევრები არიან: <font color="#000000"> ფოტორეპორტიორი გიორგი აბდალაძე, ფოტოხელოვანი იური მეჩითოვი და მსახიობი ეკა ჩხეიძე.</font><br> ფოტოკონკურსი გაგრძელდება 13 კვირა. ჩატარდება 13 ტური სხვადასხვა თემაზე, რომლებსაც რედაქცია და ჟიური შეარჩევს.<br> გამოვლინდება ორი გამარჯვებული: ერთი - Funtime-ის მკითხველთა ხმებით; მეორე - ფოტოკონკურსის ჟიურის არჩევანით. </strong></p>
        </div>
</div>
</div>
