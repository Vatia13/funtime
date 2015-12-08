<?defined('_JEXEC') or die('Restricted access');?>
<div class="cat-sort"><form method="post" id="sort-form">
<table class="formadd" id="sort-table"><tr>
<!-- START BLOCK -->
    <tr><td>
     <div id="regi1">Регион</div>
    </td><td>
      <div id="regi2">
        <select name="sort[region]" id="region" class="inputbox">
        	
        </select>
      </div>
    </td></tr>
<!-- END BLOCK -->
<!-- START BLOCK -->
    <tr><td>
      <div>Город</div>
    </td><td>
      <div>
        <select name="sort[city]" id="city" class="inputbox">
        <option value="">Выберите город</option>
        </select>
      </div>
    </td></tr>
<!-- END BLOCK -->

<!-- START BLOCK -->
    <tr><td>
     <div id="regi1">Статус</div>
    </td><td>
      <div id="regi2">
        <select name="sort[status]" id="status" class="inputbox">
	<option value="" >---</option>
	<option value="1" <?if($registry['sort']['status']==1):?>selected<?endif?>>Клиент в поиске кв.</option>
	<option value="2" <?if($registry['sort']['status']==2):?>selected<?endif?>>Клиент снял кв.</option>
        </select>
      </div>
    </td></tr>
<!-- END BLOCK -->
    <tr><td>
    </td><td align="right">
	<input type="submit" value="Применить"/>
    </td></tr>
</table>
<input type="hidden" name="sort[rubric]" value="1" id="resetform"/>
</form>
</div>
<br/>

<script type="text/javascript">
 $(document).ready(function() { 

                    id_country = 1;
                    if (id_country == "") {
                        $(".region, .city, #submit").hide();
                    }else {
                        $("#region").html('');
                        $("#region").html('<option value="">Выберите регион</option>');
                        $.post("/cities.php", {id_country: id_country, show: 1},
                            function (xml) {
                                $(xml).find('region').each(function() {
                                id = $(this).find('id_region').text();
				<?if($registry['sort']['region']>0):?>if(id==<?=$registry['sort']['region']?>) sel='selected'; else sel='';<?else:?>sel='';<?endif?>
                                $("#region").append("<option value='" + id + "' " + sel + ">" + $(this).find('region_name_ru').text() + "</option>");
                            });
                        });
                        $(".region").show();
                    }

                $("#region").change(function() {
                    id_region = $("#region option:selected").val();
                    if (id_region == "") {
                        $("#city").html('');
                        $(".city_add").hide();
                    }else {
                        $("#city").html('');
                        $("#city").html('<option value="">Выберите город</option>');
                        $.post("/cities.php", {id_region: id_region, show: 1},
                            function (xml) {
                                $(xml).find('city').each(function() {
                                id = $(this).find('id_city').text();
				<?if($registry['sort']['city']>0):?>if(id==<?=$registry['sort']['city']?>) sel='selected'; else sel='';<?else:?>sel='';<?endif?>
                                $("#city").append("<option value='" + id + "' " + sel + ">" + $(this).find('city_name_ru').text() + "</option>");
                            });
                        });
                    }
                    $(".city_add").show();
                });
<?if($registry['sort']['region']>0):?>
                        $("#city").html('');
                        $("#city").html('<option value="">Выберите город</option>');
                        $.post("/cities.php", {id_region: <?=$registry['sort']['region']?>, show: 1},
                            function (xml) {
                                $(xml).find('city').each(function() {
                                id = $(this).find('id_city').text();
				<?if($registry['sort']['city']>0):?>if(id==<?=$registry['sort']['city']?>) sel='selected'; else sel='';<?else:?>sel='';<?endif?>
                                $("#city").append("<option value='" + id + "' " + sel + ">" + $(this).find('city_name_ru').text() + "</option>");
                            });
                        });
<?endif?>
});
</script>