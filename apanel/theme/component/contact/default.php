<?php defined('_JEXEC') or die(); ?>
<?if(get_access('admin','contact','edit')):?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">

    var markersArray = [];
    // Deletes all markers in the array by removing references to them
    function deleteOverlays() {
        if (markersArray) {
            for (i in markersArray) {
                markersArray[i].setMap(null);
            }
            markersArray.length = 0;
        }
    }
    // Standard google maps function
    function initialize() {
        var myLatlng = new google.maps.LatLng(<?=$registry['contact'][0]['coords'];?>);
        var myOptions = {
            zoom: 10,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.MAP
        }


        map = new google.maps.Map(document.getElementById("map"), myOptions);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });
        markersArray.push(marker);
        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
        });

    }



    function placeMarker(location) {
        deleteOverlays();
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
        markersArray.push(marker);
        splitted=location.toString().replace(/[\(\) ]/g,'').split(",");//
        $('input[name="coords"]').val(splitted);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<h2>საკონტაქტო ინფორმაცია</h2>
<div class="contact">
    <table>
        <tr>
            <td valign="top">
                <form action="" method="post">
                    <p><label>მისამართი</label><br>
                        <input type="text" name="address_ge" value="<?=$registry['contact'][0]['address_ge'];?>" style="width:300px;"/>
                    </p>
                    <p><label>ტელეფონი 1</label><br>
                        <input type="text" name="phone1" value="<?=$registry['contact'][0]['phone1'];?>" style="width:300px;"/>
                    </p>
                    <p><label>ტელეფონი 2</label><br>
                        <input type="text" name="phone2" value="<?=$registry['contact'][0]['phone2'];?>" style="width:300px;"/>
                    </p>
                    <p><label>რეკლამა</label><br>
                        <input type="text" name="reclam" value="<?=$registry['contact'][0]['reclam'];?>" style="width:300px;"/>
                    </p>
                    <p><label>ელ.ფოსტა</label><br>
                        <input type="text" name="email" value="<?=$registry['contact'][0]['email'];?>" style="width:300px;"/>
                    </p>

                        <input type="hidden" name="coords" value="<?=$registry['contact'][0]['coords'];?>" style="width:300px;"/>

                    <p>
                        <input type="submit" name="save" value="შენახვა" class="btn-green" style="border:none;"/>
                    </p>
                </form>
            </td>
            <td>
                <div id="map" style="width:600px;height:400px;"></div>
            </td>
        </tr>
    </table>


</div>
<?endif;?>