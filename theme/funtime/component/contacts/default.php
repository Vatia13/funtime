<?defined('_JEXEC') or die('Restricted access');?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
    function initialize() {
        var myLatlng = new google.maps.LatLng(<?=$registry['contact'][0]['coords'];?>);
        var myOptions = {
            zoom: 17,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.MAP
        }


        map = new google.maps.Map(document.getElementById("map"), myOptions);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });

    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<style>
    .contact-table tr td{
        color:#00529B;
        font-family:'BPGIngiri2008Regular';
        font-size:14px;
    }
    .contact-table tr th{
        color:#00529B;
        font-family:'BPGIngiri2008Regular';
        font-size:14px;
    }

</style>
<div id="content">
<!-- BANNER PLACE-->
<div class="index-banner-place">
    <div class="index-banner">
        <?if(function_exists('get_banner')):?>
            <?if(get_banner(1) == true):?>
                <?=get_banner(1);?>
            <?else:?>
                <img src="/<?=$theme?>images/banner.jpg"/>
            <?endif;?>
        <?endif;?>
    </div>
</div>
<!-- END BANNER PLACE-->
<div class="content">
<script>
    function checkForm() {
	if (document.forms.comments.elements['name'].value.length == 0) {
            document.forms.comments.elements['name'].style.border = "1px solid red";
        	return false;
    	}
	if (document.forms.comments.elements['email'].value.length == 0) {
        document.forms.comments.elements['email'].style.border = "1px solid red";
        	return false;
    	}
	if (document.forms.comments.elements['msg'].value.length == 0) {
        document.forms.comments.elements['msg'].style.border = "1px solid red";
        	return false;
    	}
	if (document.forms.comments.elements['capcha'].value.length == 0) {
        document.forms.comments.elements['capcha'].style.border = "1px solid red";
        	return false;
    	}
        return true;
   }
</script>

    <div class="contact-page">
        <h3>
            კონტაქტი
        </h3>

            <!-- START BODY -->
            <div class="info_box">შეტყობინების გაგზავნისას, თქვენი მოთხოვნა ან კითხვა დეტალურად აღწერეთ. გმადლობთ.</div>
            <br><br>
        <table>
            <tr>
                <td width="40%">
            <form action="" method="post" id="comments" name="comments" onSubmit="return checkForm()">
                <?if($_GET['success'] == true):?>
                    <div class="valid_box">
                        შეტყობინება წარმატებით გაიგზავნა.
                    </div>
                <?endif;?>
                სახელი  (<font color="red">*</font>):<br/>
                <input name="name" value="" type="text" class="form-control"/><br/>
                ელ.ფოსტა (<font color="red">*</font>):<br/>
                <input name="email" value="" type="text" class="form-control"/> <br/>
                თემა:<br/>
                <input name="subject" value="" type="text" class="form-control"/><br/>
                შეტყობინება (<font color="red">*</font>):<br/>
                <textarea name="msg" style="width:300px;height:100px" class="form-control"></textarea><br/>

                <img src="<?=$_SESSION['captcha']['image_src'];?>" alt="ფოტო" width="120" height="50"/><br/>
                კოდი (<font color="red">*</font>): <br/>
                <input type="text" name="capcha" style="width:100px" value="" class="form-control"/><br/>

                <input name="stage" value="process" type="hidden">
                <input type="submit" name="sendmsg" style="display:none;">
                <a onclick="makeClick('sendmsg');" class="button-success">გაგზავნა</a>
            </form>
            <!-- END BODY -->
                </td>
                <td width="15%"></td>
                <td valign="top">
                    <table class="contact-table" cellpadding="5">
                        <tr>
                            <th width="29%" align="left">მისამართი:</th> <td><?=$registry['contact'][0]['address_ge'];?></td>
                        </tr>

                        <tr>
                            <th width="29%"valign="top" align="left">ტელეფონი:</th> <td><?=$registry['contact'][0]['phone1'];?><br><?=$registry['contact'][0]['phone2'];?></td>
                        </tr>
                        <tr>
                            <th  width="29%" align="left">მეილი:</th> <td>info@ft.ge</td>
                        </tr>
                        <tr>
                            <th  width="29%" style="color:#ff5704;" align="left">რეკლამა ფანთაიმზე:</th> <td><?=$registry['contact'][0]['reclam'];?></td>
                        </tr>
                    </table>
                    <br>
                    <div id="map" style="width:550px;height:350px;"></div>
                </td>
            </tr>
        </table>
    </div>
</div>
</div>
