<?defined('_JEXEC') or die('Restricted access');?>
<?if(get_access('admin','alert','edit')):?>

<?if(!empty($message[0])):?>
     <div class="<?=$message[0]?>_box">
	<?=$message[1]?>
     </div>
<p><a href="?component=alertclient">Вернуться к клиентам</a></p>
<?endif;?>

<?if(empty($message[0])):?>
<h2>Добавть/редактировать данные о клиенте</h2>

<form method="post" action="" />
<input type="hidden" name="event" value="alertclient"/>
<input type="hidden" name="<?=$_GET['section']?>" value="1"/>
<table class="formadd">
<!-- START BLOCK -->
    <tr><td class="td1">
     <div id="regi1">Статус</div>
    </td><td>
        <select name="status" id="status" class="inputbox">
	<option value="1">Клиент в поиске кв.</option>
	<option value="2">Клиент снял кв.</option>
        </select>
    </td></tr>
<!-- END BLOCK -->

<!-- START BLOCK -->
    <tr><td class="td1">
     <div id="regi1">Регион</div>
    </td><td>
      <div id="regi2">
        <select name="region" id="region" class="inputbox">
        	
        </select>
      </div>
    </td></tr>
<!-- END BLOCK -->
<!-- START BLOCK -->
    <tr><td class="td1">
      <div>Город</div>
    </td><td>
      <div>
        <select name="city" id="city" class="inputbox">
        <option value="">Выберите город</option>
        </select>
      </div>
    </td></tr>
<!-- END BLOCK -->

<tr><td class="td1">Ф.И.О</td><td>
	<input class="inputbox" type="text" name="fio" value="<?=$registry['clients'][0]['fio']?>"/></td>
</tr>
<tr><td class="td1">Телефон</td><td>
	<input class="inputbox" type="text" name="phone" value="<?=$registry['clients'][0]['phone']?>"/></td>
</tr>
<tr><td class="td1">Дата с </td><td>
	<select name="date_dd1">
	<option value="">--</option>
	  <?for ($i=1;$i<=31;$i++):?>
		<option value="<?=$i?>" <?if ($i==date('d',$registry['clients'][0]['date1']) and !empty($registry['clients'][0]['date1'])):?>selected<?endif?>><?=$i?></option>
	  <?endfor;?>
	</select>

	<select name="date_mm1">
	<option value="">--</option>
	  <?for ($i=1;$i<=12;$i++):?>
		<option value="<?=$i?>" <?if ($i==date('m',$registry['clients'][0]['date1']) and !empty($registry['clients'][0]['date1'])):?>selected<?endif?>><?=$i?></option>
	   <?endfor;?>
	</select>

	<select name="date_yy1">
	<option value="">----</option>
	  <?for ($i=2011;$i<=2100;$i++):?>
		<option value="<?=$i?>" <?if ($i==date('Y',$registry['clients'][0]['date1']) and !empty($registry['clients'][0]['date1'])):?>selected<?endif?>><?=$i?></option>
	  <?endfor;?>
	</select>
</tr>
<tr><td class="td1">Дата по</td><td>
	<select name="date_dd2">
	<option value="">--</option>
	  <?for ($i=1;$i<=31;$i++):?>
		<option value="<?=$i?>" <?if ($i==date('d',$registry['clients'][0]['date2']) and !empty($registry['clients'][0]['date2'])):?>selected<?endif?>><?=$i?></option>
	   <?endfor;?>
	</select>

	<select name="date_mm2">
	<option value="">--</option>
	  <?for ($i=1;$i<=12;$i++):?>
		<option value="<?=$i?>" <?if ($i==date('m',$registry['clients'][0]['date2']) and !empty($registry['clients'][0]['date2'])):?>selected<?endif?>><?=$i?></option>
	   <?endfor;?>
	</select>

	<select name="date_yy2">
	<option value="">----</option>
	  <?for ($i=2011;$i<=2100;$i++):?>
		<option value="<?=$i?>" <?if ($i==date('Y',$registry['clients'][0]['date2']) and !empty($registry['clients'][0]['date2'])):?>selected<?endif?>><?=$i?></option>
	  <?endfor;?>
	</select>
</td></tr>
</table>
<input type="submit" value="Сохранить" />
<input type="hidden" name="id" value="<?=$registry['clients'][0]['id']?>" />

</form>
<?endif?>

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
				<?if($registry['clients'][0]['region']>0):?>if(id==<?=$registry['clients'][0]['region']?>) sel='selected'; else sel='';<?else:?>sel='';<?endif?>
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
				<?if($registry['clients'][0]['city']>0):?>if(id==<?=$registry['clients'][0]['city']?>) sel='selected'; else sel='';<?else:?>sel='';<?endif?>
                                $("#city").append("<option value='" + id + "' " + sel + ">" + $(this).find('city_name_ru').text() + "</option>");
                            });
                        });
                    }
                    $(".city_add").show();
                });
<?if($registry['clients'][0]['region']>0):?>
                        $("#city").html('');
                        $("#city").html('<option value="">Выберите город</option>');
                        $.post("/cities.php", {id_region: <?=$registry['clients'][0]['region']?>, show: 1},
                            function (xml) {
                                $(xml).find('city').each(function() {
                                id = $(this).find('id_city').text();
				<?if($registry['clients'][0]['city']>0):?>if(id==<?=$registry['clients'][0]['city']?>) sel='selected'; else sel='';<?else:?>sel='';<?endif?>
                                $("#city").append("<option value='" + id + "' " + sel + ">" + $(this).find('city_name_ru').text() + "</option>");
                            });
                        });
<?endif?>
});
</script>

<?endif?>