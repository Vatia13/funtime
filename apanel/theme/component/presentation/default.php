<?php defined('_JEXEC') or die('Restricted access');
if(get_access('admin','presentation','view')
):
?>	
<style>  
#tab tr td{ border-bottom:1px solid #CCC;}
#chrt{ border-bottom:1px solid #CCC;}
#image_id{display:none;}
#imagee_id{display:none;}
#columne{  float:left;}
#pie{  float:left;}
#sex{ float:left;}
#btn{position:absolute; top:0px; right:0px;} 
</style>

<script type="text/javascript" src="<?=$theme_admin?>js/Chart.js"></script>	
<script>
function delete_row(Row_ID){
	var del = confirm('ნამდვილად გსურთ გაყიდული ადგილი #' + Row_ID + ' წაშლა?');
        if(del == true){
            window.location.href = '/apanel/index.php?component=presentation&sec=<?=$_GET['sec']?>&del='+Row_ID;
        }
	}  
function delete_article(ID) { 
            window.location.href = '/apanel/index.php?component=presentation&delete='+ID;
}	
function set_section(ID) { 
            window.location.href = '/apanel/index.php?component=presentation&sec='+ID;
}
function del_statistic(ID) { 
			confirm("ნამდვილად გსურთ წაშლა");
          window.location.href = '/apanel/index.php?component=presentation&del_statistic='+ID;
}

$(document).ready(function(){
		$("#hide").click(function(){ 
			var comment = document.getElementById("commenta").value;
			comment = encodeURIComponent(comment);
			window.location.href = '/apanel/index.php?component=presentation&comm='+<?=$_GET['sec']?>+'&comment='+comment;
			$("#hide_P").hide();
		});
		$("#show").click(function(){
			$("#hide_P").show();
			$("#show").css('display','none');
			$("#hide").css('display','block');
		});
});
		</script> 
 

<!--ბანერები მთავარ გვერდზე-->
<input type="button" class="btn-green right"  value="ვიზუალი" onclick='set_section(10)'>
<input type="button" class="btn-green right"  value="ერთჯერადი სტატ" onclick='set_section(9)'>
<input type="button" class="btn-green right"  value="რუბ. 30/50" onclick='set_section(8)'>
<input type="button" class="btn-green right"  value="რუბ. 50/100" onclick='set_section(7)'>
<input type="button" class="btn-green right"  value="რუბ. 100/150" onclick='set_section(6)'>
<input type="button" class="btn-green right"  value="რუბ. 150/200" onclick='set_section(5)'>
<input type="button" class="btn-green right"  value="საკ_ამბ" onclick='set_section(4)'>
<input type="button" class="btn-green right"  value="მ/გ სტატ" onclick='set_section(3)'>
<input type="button" class="btn-green right"  value="ბანერები"onclick='set_section(2)'>
<input type="button" class="btn-green right"  value="სტატისტიკა" onclick='set_section(1)'>
<br /><br /><br /><br />

<?php
if(isset($_GET['sec']) && $_GET['sec']==10){
	?>
<script>
	function img_click(){
		var img = document.getElementById("image_id").value;
		 window.location.href = '/apanel/index.php?component=presentation&sec=<?=$_GET['sec']?>&img_val='+img;
	};

	$(document).ready(function(e) {
		i = 0;
        $('#picture img').click(function(e) {
			var offset = $(this).offset();
	$('#results').append('<table class="formadd"><tr><td><select name="points['+i+'][position]"><option>F1</option><option>F2</option><option>F3</option><option>F4</option><option>F5</option><option>F6</option><option>F7</option><option>F8</option><option>F9</option><option>F10</option><option>F11</option><option>F12</option><option>SL1</option><option>SL2</option><option>FM</option><option>ბრენდირება</option></select></td><td><select name="points['+i+'][size]"><option>800X100</option><option>165x480</option><option>205x355</option><option>230x600</option><option>320x200</option><option>200x700</option><option>600x700</option><option>200x500</option></select></td><td width="50px"><input placeholder="ფასი" type="text" name="points['+i+'][price]"></td><td><input style="display:none;" type="text" name="points['+i+'][point]" value="'+(e.pageY - offset.top)+'"></td></tr></table>'); 
			i++;
        });
    }); 
</script>  
   <form action="/apanel/index.php" method="get">
        <input type="hidden" value="presentation" name="component" />
        	<input type="hidden" value="1" name="test" />
            <input type="hidden" name="img_url" value="<?=$_GET['img_val']?>" />
          <table width="100%">
          <tr>
 <td width="16%"><input type="text" name="image" value="" id="image_id" />
                <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=image_id" class="btn-blue iframe-btn" type="button">სურათის მიმაგრება</a></td>
                <td width="15%"><input type="button" class="btn-green right" value="სურათის გამოჩენა" onclick="img_click()" /></td>
                <td>
                <select name="rubstat">
                <option>აირჩიეთ რუბრიკა</option>
                 <option value="4">საკნატუნო ამბები</option>
                <option value="5">150/200</option>
                <option value="6">100/150</option>
                <option value="7">50/100</option>
                <option value="8">30/50</option>
                </select> 
                <select name="rubric_id"><option>აირჩიეთ რუბრიკა</option><?foreach($registry[rubric] as $item):?><option value="<?=$item['id']?>"><?=$item['name']?></option><?endforeach?></select>
                </td>
                <td><input type="submit" class="btn-green right"value="დამატებ"/></td>
                </tr>
          </table>      
<div id="sh">	 
    <div id="picture"><img src="<?=$_GET['img_val']?>" /> </div>
<div id="results"></div>
   
   </form>
</div>
<style> 
	input[type='text']{width: 130px !important; padding: 2px !important;}
    #sh{ margin:0px auto; border:10px solid #27bfc4; width:1179px; height:700px; font-family: 'BPGNinoMtavruliRegular';}
    #sh div{height:700px;  float:left;}
	#picture{ width:50%;}
    #picture{ overflow-y:scroll; }
    #picture img { max-width:100%;}
    #picture::-webkit-scrollbar {
        width: 10px;
    }
    #picture::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    }
    #picture::-webkit-scrollbar-thumb {
        background-color: #f42b35; 
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
    } 
</style>
    
    <?
	}
if(isset($_GET['sec']) && $_GET['sec']==9)
{
	if(isset($_GET['edit_article'])){	
	?>
	 <form action="/apanel/index.php" method="get">
        <input type="hidden" value="presentation" name="component"/> 
            <input type="hidden" name="update_article"  value="<?=$_GET['edit_article']?>" /> 
          <table class="formadd">
                <thead>
                <tr> 
                    <th align="left">რუბრიკა</th> 
                    <th align="left">ფასები</th> 
                </tr>
                </thead>
                <tbody>
                    <tr>   
                         <td><select name="rubrica">
                         <?foreach($registry['article_foredit'] as $item):?> 
                           <option value="<?=$item['rubric']?>">მონიშნულია:<?=$item['rubric']?></option>
                            <?endforeach;?> 
                         <?foreach($registry['rubric'] as $item):?> 
                           <option value="<?=$item['name']?>"><?=$item['name']?></option>
                            <?endforeach;?> 
                         <option></option>
                         </select></td> 
                          <?foreach($registry['article_foredit'] as $item):?> 
                        <td><input type="text" name="price" value="<?=$item['price']?>" />  </td>  
                         <?endforeach;?> 
                        <td><input type="submit" class="btn-green right"  value="დამატება"></td>
                    </tr>
                    
                </tbody>
                </table>
        </form> 
	<? 
	} else{?>
<h3>N9 ერთჯერადი სტატიების ფასები</h3>
<form action="/apanel/index.php" method="get">
<input type="hidden" value="presentation" name="component"/> 
    <input type="hidden" name="single_article"  value="1" /> 
  <table class="formadd">
        <thead>
        <tr> 
            <th align="left">რუბრიკა</th> 
            <th align="left">ფასები</th> 
        </tr>
        </thead>
        <tbody>
            <tr>   
           		 <td><select name="rubrica">
                 <option>აირჩიეთ რუბრიკა</option>
                  <?foreach($registry['rubric'] as $item):?> 
                   <option value="<?=$item['name']?>"><?=$item['name']?></option>
   					<?endforeach;?> 
                 <option></option>
                 </select></td> 
                <td><input type="text" name="price" value="" />  </td>  
                <td><input type="submit" class="btn-green right"  value="დამატება"></td>
            </tr>
            
        </tbody>
        </table>
</form>
<table  class="formadd" id="tab" width="100%">
		<tr>
    	  <td colspan="3" align="center" style="background-color:#4690BB; color:#FFF;  padding: 10px;">რუბრიკები 30 000-დან 50 000-მდე  ჩვენებით</td>
  	    </tr>
        <tr>  
            <th align="center">რუბრიკა</th>
            <th align="center">ფასები</th> 
        </tr>
     </thead>
      <tbody>
 <?foreach($registry['article'] as $item):?> 
      <tr> 
        <td align="center"><?=$item['rubric']?></td>
        <td align="center"><?=$item['price']?>&nbsp;ლარი</td>  
        <td  align="center" width="20px">
       <span onclick="delete_article(<?=$item['id']?>)"> <img src="theme/images/trash_p.png" /></span>
       <a href="/apanel/index.php?component=presentation&sec=9&edit_article=<?=$item['id']?>"> <img src="theme/images/edit.png" /> </a>
        </td>
      </tr>
   <?endforeach;?> 
  	 </thead>
</table>
<? }}
if(isset($_GET['sec']) && $_GET['sec']==8){
?>
<h3>N8 რუბრიკები 30 000-დან 50 000-მდე  ჩვენებით</h3>	
<form action="/apanel/index.php" method="get">
<input type="hidden" value="presentation" name="component"/> 
    <input type="hidden" name="add_pie_30"  value="1" /> 
  <table class="formadd">
        <thead>
        <tr> 
            <th align="left">რუბრიკა</th> 
            <th align="left">მამრობითი</th>  
            <th align="left">25-მდე</th>
            <th align="left">25-44</th> 
            <th align="left">ლოგო</th>
        </tr>
        </thead>
        <tbody>
            <tr>   
           		 <td><select name="rubrica">
                 <option>აირჩიეთ რუბრიკა</option>
                  <?foreach($registry['rubric'] as $item):?> 
                   <option value="<?=$item['name']?>"><?=$item['name']?></option>
   					<?endforeach;?> 
                 <option></option>
                 </select></td> 
                <td><input type="text" name="male" value="" />  </td> 
                <td><input type="text" name="to25" value="" /> </td>
                <td><input type="text" name="bet2544" value="" /> </td> 
                <td>
                <input type="text" name="image" value="" id="imagee_id" />
                <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=imagee_id" class="btn-blue iframe-btn" type="button">ვიზუალი</a>
            </td> 
                <td><input type="submit" class="btn-green right"  value="დამატება"></td>
            </tr>
            
        </tbody>
        </table>
</form>
<table class="formadd" id="tab" width="100%">
    <thead>
    <tr>
    <td colspan="5" align="center" style="background-color:#4690BB; color:#FFF;  padding: 10px;">რუბრიკები 30 000-დან 50 000-მდე  ჩვენებით</td>
    </tr>
        <tr>  
           <th align="center" style="color:#F60;">ლოგო</th>
            <th align="center" style="color:#F60;">რუბრიკა</th>
            <th align="center" style="color:#F60;">მომხმარებელთა სქესი</th>
            <th align="center" style="color:#F60;">ასაკობრივი ზღვარი</th> 
        </tr>
     </thead>
      <tbody>
      <?  $counter = 0; ?>
      <?foreach($registry['showpie'] as $item):?>
    <?
      $male=$item['male'];
      $to25 = $item['to25'];
      $bet2544 = $item['bet2544']
    ?>
     <script>
                var pieData_<?=$counter?> = [
                        {
                            value:100-<?=$male?>,
                            color:"#ed4321",
                            highlight: "#FF5A5E",
                            label: "ქალი"
                        },
                        {
                            value: <?=$male?>,
                            color: "#27bfc4",
                            highlight: "#5AD3D1",
                            label: "კაცი"
                        } 
        
                    ];
        
                    $(document).ready(function() {
                        var ctx = document.getElementById("chart-area_<?=$counter?>").getContext("2d");
                        window.myPie = new Chart(ctx).Pie(pieData_<?=$counter?>);
                    });
            </script>  
                
          <script>
			var barChartData_<?=$counter?> = {
				labels : ["25-მდე","25-44","44-დან"],
				datasets : [
					{
						fillColor : "#ed4321",
						strokeColor : "rgba(220,220,220,0.8)",
						highlightFill: "rgba(220,220,220,0.75)",
						highlightStroke: "rgba(220,220,220,1)",
						data : [<?=$to25?>,<?=$bet2544?>,100-<?=$to25?>-<?=$bet2544?>]
					} 
				]
		
			} 
			$(document ).ready(function() {
			var ctx = document.getElementById("canvas_<?=$counter?>").getContext("2d");
				window.myBar = new Chart(ctx).Bar(barChartData_<?=$counter?>, {
					responsive : true
				});
			});
			 
		</script>
      <tr>
      	<td align="center" width="20"><img src="<?=$item['logo_url']?>" width="50" /></td>
        <td align="center" width="200"><?=$item['rubric']?></td>
        <td align="center">
          <div id="canvas-holder"><canvas id="chart-area_<?=$counter?>" width="150" height="150"/></div>
        
                <table width="200">
                  <tr>
                    <td align="center" style="font-size:18px;"><img src="<?=$theme_admin?>images/blue.png" /></td><td>მამრობითი</td>
                  </tr>
                  <tr>
                    <td align="center" style="font-size:18px;"><img src="<?=$theme_admin?>images/orange.png" /></td><td>მდედრობითი</td>
                  </tr>
                </table> 
            </td> 
         <td align="center">
          <div style="width: 20%"><canvas id="canvas_<?=$counter?>" height="850" width="1000"></canvas></div>
          </td>
          <td  align="center" width="20px">
       <span onclick="delete_row('diagrams_<?=$item['id']?>')"> <img src="theme/images/trash_p.png" /></span>
       <a href="/apanel/index.php?component=presentation&sec=<?=$_GET['sec']?>&edit_pie=<?=$item['id']?>"> <img src="theme/images/edit.png" /> </a>
        </td>
      </tr> 
      <? $counter++; ?>
      <?endforeach?>
      <tr>
      <td colspan="4" align="center">
      <?foreach($registry['show_comment'] as $item):?> 
      <div id="hide_P" style="display:none;">
      <form action="/apanel/index.php" method="get">
	<input type="hidden" value="presentation" name="component"/> 
      <textarea class="commenta" id="commenta" name="comment" style="width:80%; height:70px;"><?=$item['comment']?></textarea>
       </form>
      </div>
      <div id="hide_P"><?=$item['comment']?></p>
         <?endforeach;?> 
      </td>
      </div>
      <td> 
      <button class="btn-green right" id="show">რედაქტირება</button>
      <button class="btn-green right" id="hide" style="display:none;">რედაქტირება</button>
        </td>
      </tr>
  	 </thead>
   </table>
<table  class="formadd" id="tab" width="100%">
        <tr>  
        	 <th align="center">რუბრიკა</th>
            <th align="center">პოზიცია</th>
            <th align="center">ზომა</th>
            <th align="center">ფასი</th>
            <th align="center">ვიზუალი</th>
            <th align="center">რედაქტირება/წაშლა</th> 
        </tr>
     </thead>
      <tbody>
 <?foreach($registry['shows'] as $ite):?> 
      <tr>
      <td align="center"><?=$ite['rubric']?></td>
        <td align="center"><?=$ite['position']?></td>
        <td align="center"><?=$ite['size']?></td>
        <td align="center"><?=$ite['price']?></td>
        <td align="center"><img src="<?=$ite['view']?>" width="50" /></td> 
        <td  align="center" width="20px">
       <span onclick="delete_row(<?=$ite['ID']?>)"> <img src="theme/images/trash_p.png" /></span>
       <a href="/apanel/index.php?component=presentation&sec=<?=$_GET['sec']?>&edit_ban=<?=$ite['ID']?>"> <img src="theme/images/edit.png" /> </a>
        </td>
      </tr>
   <?endforeach;?> 
  	 </thead>
</table>
<? }

if(isset($_GET['sec']) && $_GET['sec']==7){
	?>

<h3>N7 რუბრიკები 50 000-დან 100 000-მდე  ჩვენებით</h3>	
<form action="/apanel/index.php" method="get">
<input type="hidden" value="presentation" name="component"/> 
    <input type="hidden" name="add_pie_50"  value="1" /> 
  <table class="formadd">
        <thead>
        <tr> 
            <th align="left">რუბრიკა</th> 
            <th align="left">მამრობითი</th>  
            <th align="left">25-მდე</th>
            <th align="left">25-44</th> 
             <th align="left">ლოგო</th>
        </tr>
        </thead>
        <tbody>
            <tr>   
           		 <td><select name="rubrica">
                 <option>აირჩიეთ რუბრიკა</option>
                  <?foreach($registry['rubric'] as $item):?> 
                   <option value="<?=$item['name']?>"><?=$item['name']?></option>
   					<?endforeach;?> 
                 <option></option>
                 </select></td> 
                <td><input type="text" name="male" value="" />  </td> 
                <td><input type="text" name="to25" value="" /> </td>
                <td><input type="text" name="bet2544" value="" /> </td> 
                <td>
                <input type="text" name="image" value="" id="imagee_id" />
                <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=imagee_id" class="btn-blue iframe-btn" type="button">ვიზუალი</a>
            </td> 
                <td><input type="submit" class="btn-green right"  value="დამატება"></td>
            </tr>
            
        </tbody>
        </table>
</form>
<table class="formadd" id="tab" width="100%">
    <thead>
    <tr>
    	<td colspan="5" align="center" style="background-color:#4690BB; color:#FFF;  padding: 10px;">რუბრიკები 50 000-დან 100 000-მდე  ჩვენებით</td>
    </tr>
        <tr> 
           <th align="center" style="color:#F60;">ლოგო</th>
            <th align="center" style="color:#F60;">რუბრიკა</th>
            <th align="center" style="color:#F60;">მომხმარებელთა სქესი</th>
            <th align="center" style="color:#F60;">ასაკობრივი ზღვარი</th> 
        </tr>
     </thead>
      <tbody>
      <?  $counter = 0; ?>
      <?foreach($registry['showpie'] as $item):?>
    <?
      $male=$item['male'];
      $to25 = $item['to25'];
      $bet2544 = $item['bet2544']
    ?>
     <script>
                var pieData_<?=$counter?> = [
                        {
                            value:100-<?=$male?>,
                            color:"#ed4321",
                            highlight: "#FF5A5E",
                            label: "ქალი"
                        },
                        {
                            value: <?=$male?>,
                            color: "#27bfc4",
                            highlight: "#5AD3D1",
                            label: "კაცი"
                        } 
        
                    ];
        
                    $(document).ready(function() {
                        var ctx = document.getElementById("chart-area_<?=$counter?>").getContext("2d");
                        window.myPie = new Chart(ctx).Pie(pieData_<?=$counter?>);
                    });
            </script>  
                
          <script>
			var barChartData_<?=$counter?> = {
				labels : ["25-მდე","25-44","44-დან"],
				datasets : [
					{
						fillColor : "#ed4321",
						strokeColor : "rgba(220,220,220,0.8)",
						highlightFill: "rgba(220,220,220,0.75)",
						highlightStroke: "rgba(220,220,220,1)",
						data : [<?=$to25?>,<?=$bet2544?>,100-<?=$to25?>-<?=$bet2544?>]
					} 
				]
		
			} 
			$(document ).ready(function() {
			var ctx = document.getElementById("canvas_<?=$counter?>").getContext("2d");
				window.myBar = new Chart(ctx).Bar(barChartData_<?=$counter?>, {
					responsive : true
				});
			});
			 
		</script>
      <tr>
       <td align="center" width="20"><img src="<?=$item['logo_url']?>" width="50" /></td>
        <td align="center" width="200"><?=$item['rubric']?></td>
        <td align="center">
          <div id="canvas-holder"><canvas id="chart-area_<?=$counter?>" width="150" height="150"/></div>
        
                <table width="200">
                  <tr>
                    <td align="center" style="font-size:18px;"><img src="<?=$theme_admin?>images/blue.png" /></td><td>მამრობითი</td>
                  </tr>
                  <tr>
                    <td align="center" style="font-size:18px;"><img src="<?=$theme_admin?>images/orange.png" /></td><td>მდედრობითი</td>
                  </tr>
                </table> 
            </td> 
         <td align="center">
          <div style="width: 20%"><canvas id="canvas_<?=$counter?>" height="850" width="1000"></canvas></div>
          </td>
          <td  align="center" width="20px">
       <span onclick="delete_row('diagrams_<?=$item['id']?>')"> <img src="theme/images/trash_p.png" /></span>
       <a href="/apanel/index.php?component=presentation&sec=<?=$_GET['sec']?>&edit_pie=<?=$item['id']?>"> <img src="theme/images/edit.png" /> </a>
        </td>
      </tr> 
      
      <? $counter++; ?>
      <?endforeach?>
     <tr>
      <td colspan="4" align="center">
      <?foreach($registry['show_comment'] as $item):?> 
      <div id="hide_P" style="display:none;">
      <form action="/apanel/index.php" method="get">
	<input type="hidden" value="presentation" name="component"/> 
      <textarea class="commenta" id="commenta" name="comment" style="width:80%; height:70px;"><?=$item['comment']?></textarea>
       </form>
      </div>
      <div id="hide_P"><?=$item['comment']?></p>
         <?endforeach;?> 
      </td>
      </div>
      <td> 
      <button class="btn-green right" id="show">რედაქტირება</button>
      <button class="btn-green right" id="hide" style="display:none;">რედაქტირება</button>
        </td>
      </tr>
  	 </thead>
   </table>
 <table  class="formadd" id="tab" width="100%">
        <tr>  
        	<th align="center">რუბრიკა</th>
            <th align="center">პოზიცია</th>
            <th align="center">ზომა</th>
            <th align="center">ფასი</th>
            <th align="center">ვიზუალი</th>
            <th align="center">რედაქტირება/წაშლა</th> 
        </tr>
     </thead>
      <tbody>
 <?foreach($registry['shows'] as $ite):?> 
      <tr>
     	 <td align="center"><?=$ite['rubric']?></td>
        <td align="center"><?=$ite['position']?></td>
        <td align="center"><?=$ite['size']?></td>
        <td align="center"><?=$ite['price']?></td>
        <td align="center"><img src="<?=$ite['view']?>" width="50" /></td> 
        <td  align="center" width="20px">
       <span onclick="delete_row(<?=$ite['ID']?>)"> <img src="theme/images/trash_p.png" /></span>
       <a href="/apanel/index.php?component=presentation&sec=<?=$_GET['sec']?>&edit_ban=<?=$ite['ID']?>"> <img src="theme/images/edit.png" /> </a>
        </td>
      </tr>
   <?endforeach;?> 
  	 </thead>
</table>

<? }
if(isset($_GET['sec']) && $_GET['sec']==6){?>

<h3>N6 რუბრიკები 100 000-დან 150 000-მდე  ჩვენებით</h3>	
<form action="/apanel/index.php" method="get">
<input type="hidden" value="presentation" name="component"/> 
    <input type="hidden" name="add_pie_10"  value="1" /> 
  <table class="formadd">
        <thead>
        <tr> 
            <th align="left">რუბრიკა</th> 
            <th align="left">მამრობითი</th>  
            <th align="left">25-მდე</th>
            <th align="left">25-44</th> 
             <th align="left">ლოგო</th>
        </tr>
        </thead>
        <tbody>
            <tr>   
           		 <td><select name="rubrica">
                 <option>აირჩიეთ რუბრიკა</option>
                  <?foreach($registry['rubric'] as $item):?> 
                   <option value="<?=$item['name']?>"><?=$item['name']?></option>
   					<?endforeach;?> 
                 <option></option>
                 </select></td> 
                <td><input type="text" name="male" value="" />  </td> 
                <td><input type="text" name="to25" value="" /> </td>
                <td><input type="text" name="bet2544" value="" /> </td> 
                 <td>
                <input type="text" name="image" value="" id="imagee_id" />
                <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=imagee_id" class="btn-blue iframe-btn" type="button">ვიზუალი</a>
            </td> 
                <td><input type="submit" class="btn-green right"  value="დამატება"></td>
            </tr>
            
        </tbody>
        </table>
</form>
<table class="formadd" id="tab" width="100%">
    <thead>
    <tr>
    	<td colspan="5" align="center" style="background-color:#4690BB; color:#FFF;  padding: 10px;">რუბრიკები 100 000-დან 150 000-მდე  ჩვენებით</td>
    </tr>
        <tr> 
           <th align="center" style="color:#F60;">ლოგო</th>
            <th align="center" style="color:#F60;">რუბრიკა</th>
            <th align="center" style="color:#F60;">მომხმარებელთა სქესი</th>
            <th align="center" style="color:#F60;">ასაკობრივი ზღვარი</th> 
        </tr>
     </thead>
      <tbody>
      <?  $counter = 0; ?>
      <?foreach($registry['showpie'] as $item):?>
    <?
      $male=$item['male'];
      $to25 = $item['to25'];
      $bet2544 = $item['bet2544']
    ?>
     <script>
                var pieData_<?=$counter?> = [
                        {
                            value:100-<?=$male?>,
                            color:"#ed4321",
                            highlight: "#FF5A5E",
                            label: "ქალი"
                        },
                        {
                            value: <?=$male?>,
                            color: "#27bfc4",
                            highlight: "#5AD3D1",
                            label: "კაცი"
                        } 
        
                    ];
        
                    $(document).ready(function() {
                        var ctx = document.getElementById("chart-area_<?=$counter?>").getContext("2d");
                        window.myPie = new Chart(ctx).Pie(pieData_<?=$counter?>);
                    });
            </script>  
                
          <script>
			var barChartData_<?=$counter?> = {
				labels : ["25-მდე","25-44","44-დან"],
				datasets : [
					{
						fillColor : "#ed4321",
						strokeColor : "rgba(220,220,220,0.8)",
						highlightFill: "rgba(220,220,220,0.75)",
						highlightStroke: "rgba(220,220,220,1)",
						data : [<?=$to25?>,<?=$bet2544?>,100-<?=$to25?>-<?=$bet2544?>]
					} 
				]
		
			} 
			$(document ).ready(function() {
			var ctx = document.getElementById("canvas_<?=$counter?>").getContext("2d");
				window.myBar = new Chart(ctx).Bar(barChartData_<?=$counter?>, {
					responsive : true
				});
			});
			 
		</script>
      <tr>
       <td align="center" width="20"><img src="<?=$item['logo_url']?>" width="50" /></td>
        <td align="center" width="200"><?=$item['rubric']?></td>
        <td align="center">
          <div id="canvas-holder"><canvas id="chart-area_<?=$counter?>" width="150" height="150"/></div>
        
                <table width="200">
                  <tr>
                    <td align="center" style="font-size:18px;"><img src="<?=$theme_admin?>images/blue.png" /></td><td>მამრობითი</td>
                  </tr>
                  <tr>
                    <td align="center" style="font-size:18px;"><img src="<?=$theme_admin?>images/orange.png" /></td><td>მდედრობითი</td>
                  </tr>
                </table> 
            </td> 
         <td align="center">
          <div style="width: 20%"><canvas id="canvas_<?=$counter?>" height="850" width="1000"></canvas></div>
          </td>
          <td  align="center" width="20px">
       <span onclick="delete_row('diagrams_<?=$item['id']?>')"> <img src="theme/images/trash_p.png" /></span>
       <a href="/apanel/index.php?component=presentation&sec=<?=$_GET['sec']?>&edit_pie=<?=$item['id']?>"> <img src="theme/images/edit.png" /> </a>
        </td>
      </tr> 
      <? $counter++; ?>
      <?endforeach?>
      <tr>
      <td colspan="4" align="center">
      <?foreach($registry['show_comment'] as $item):?> 
      <div id="hide_P" style="display:none;">
      <form action="/apanel/index.php" method="get">
	<input type="hidden" value="presentation" name="component"/> 
      <textarea class="commenta" id="commenta" name="comment" style="width:80%; height:70px;"><?=$item['comment']?></textarea>
       </form>
      </div>
      <div id="hide_P"><?=$item['comment']?></p>
         <?endforeach;?> 
      </td>
      </div>
      <td> 
      <button class="btn-green right" id="show">რედაქტირება</button>
      <button class="btn-green right" id="hide" style="display:none;">რედაქტირება</button>
        </td>
      </tr>
  	 </thead>
   </table>
<table  class="formadd" id="tab" width="100%">
        <tr> 
        	<th align="center">რუბრიკა</th> 
            <th align="center">პოზიცია</th>
            <th align="center">ზომა</th>
            <th align="center">ფასი</th>
            <th align="center">ვიზუალი</th>
            <th align="center">რედაქტირება/წაშლა</th> 
        </tr>
     </thead>
      <tbody>
 <?foreach($registry['shows'] as $ite):?> 
      <tr>
      	<td align="center"><?=$ite['rubric']?></td>
        <td align="center"><?=$ite['position']?></td>
        <td align="center"><?=$ite['size']?></td>
        <td align="center"><?=$ite['price']?></td>
        <td align="center"><img src="<?=$ite['view']?>" width="50" /></td> 
        <td  align="center" width="20px">
       <span onclick="delete_row(<?=$ite['ID']?>)"> <img src="theme/images/trash_p.png" /></span>
       <a href="/apanel/index.php?component=presentation&sec=<?=$_GET['sec']?>&edit_ban=<?=$ite['ID']?>"> <img src="theme/images/edit.png" /> </a>
        </td>
      </tr>
   <?endforeach;?> 
  	 </thead>
</table>
<? }
if(isset($_GET['sec']) && $_GET['sec']==5)
{?>
<h3>N5 რუბრიკები 150 000-დან 200 000-მდე  ჩვენებით</h3>
<form action="/apanel/index.php" method="get">
<input type="hidden" value="presentation" name="component"/> 
    <input type="hidden" name="add_pie_15"  value="1" /> 
  <table class="formadd">
        <thead>
        <tr> 
            <th align="left">რუბრიკა</th> 
            <th align="left">მამრობითი</th>  
            <th align="left">25-მდე</th>
            <th align="left">25-44</th> 
             <th align="left">ლოგო</th>
        </tr>
        </thead>
        <tbody>
            <tr>   
           		 <td><select name="rubrica">
                 <option>აირჩიეთ რუბრიკა</option>
                  <?foreach($registry['rubric'] as $item):?> 
                   <option value="<?=$item['name']?>"><?=$item['name']?></option>
   					<?endforeach;?> 
                 <option></option>
                 </select></td> 
                <td><input type="text" name="male" value="" />  </td> 
                <td><input type="text" name="to25" value="" /> </td>
                <td><input type="text" name="bet2544" value="" /> </td>
                <td>
                <input type="text" name="image" value="" id="imagee_id" />
                <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=imagee_id" class="btn-blue iframe-btn" type="button">ვიზუალი</a>
            	</td>  
                <td><input type="submit" class="btn-green right"  value="დამატება"></td>
            </tr> 
        </tbody>
        </table>
</form>
<table class="formadd" id="tab" width="100%">
    <thead>
    <tr>
    	<td colspan="5" align="center" style="background-color:#4690BB; color:#FFF;  padding: 10px;">რუბრიკები 150 000-დან 200 000-მდე ჩვენებით</td>
    </tr>
        <tr> 
           <th align="center" style="color:#F60;">ლოგო</th>
            <th align="center" style="color:#F60;">რუბრიკა</th>
            <th align="center" style="color:#F60;">მომხმარებელთა სქესი</th>
            <th align="center" style="color:#F60;">ასაკობრივი ზღვარი</th> 
        </tr>
     </thead> 
      <tbody>
      <?  $counter = 0; ?>
      <?foreach($registry['showpie'] as $item):?>
    <?
      $male=$item['male'];
      $to25 = $item['to25'];
      $bet2544 = $item['bet2544']
    ?>
     <script>
                var pieData_<?=$counter?> = [
                        {
                            value:100-<?=$male?>,
                            color:"#ed4321",
                            highlight: "#FF5A5E",
                            label: "ქალი"
                        },
                        {
                            value: <?=$male?>,
                            color: "#27bfc4",
                            highlight: "#5AD3D1",
                            label: "კაცი"
                        } 
        
                    ];
        
                    $(document).ready(function() {
                        var ctx = document.getElementById("chart-area_<?=$counter?>").getContext("2d");
                        window.myPie = new Chart(ctx).Pie(pieData_<?=$counter?>);
                    });
            </script>  
                
          <script>
			var barChartData_<?=$counter?> = {
				labels : ["25-მდე","25-44","44-დან"],
				datasets : [
					{
						fillColor : "#ed4321",
						strokeColor : "rgba(220,220,220,0.8)",
						highlightFill: "rgba(220,220,220,0.75)",
						highlightStroke: "rgba(220,220,220,1)",
						data : [<?=$to25?>,<?=$bet2544?>,100-<?=$to25?>-<?=$bet2544?>]
					} 
				]
		
			} 
			$(document ).ready(function() {
			var ctx = document.getElementById("canvas_<?=$counter?>").getContext("2d");
				window.myBar = new Chart(ctx).Bar(barChartData_<?=$counter?>, {
					responsive : true
				});
			});
			 
		</script>
      <tr>
       <td align="center" width="20"><img src="<?=$item['logo_url']?>" width="50" /></td>
        <td align="center" width="200"><?=$item['rubric']?></td>
        <td align="center">
          <div id="canvas-holder"><canvas id="chart-area_<?=$counter?>" width="150" height="150"/></div>
        
                <table width="200">
                  <tr>
                    <td align="center" style="font-size:18px;"><img src="<?=$theme_admin?>images/blue.png" /></td><td>მამრობითი</td>
                  </tr>
                  <tr>
                    <td align="center" style="font-size:18px;"><img src="<?=$theme_admin?>images/orange.png" /></td><td>მდედრობითი</td>
                  </tr>
                </table> 
            </td> 
         <td align="center">
          <div style="width: 20%"><canvas id="canvas_<?=$counter?>" height="850" width="1000"></canvas></div>
          </td>
          <td  align="center" width="20px">
       <span onclick="delete_row('diagrams_<?=$item['id']?>')"> <img src="theme/images/trash_p.png" /></span>
       <a href="/apanel/index.php?component=presentation&sec=<?=$_GET['sec']?>&edit_pie=<?=$item['id']?>"> <img src="theme/images/edit.png" /> </a>
        </td>
      </tr> 
      
      <? $counter++; ?>
      <?endforeach?>
      <tr>
      <td colspan="4" align="center">
      <?foreach($registry['show_comment'] as $item):?> 
      <div id="hide_P" style="display:none;">
      <form action="/apanel/index.php" method="get">
	<input type="hidden" value="presentation" name="component"/> 
      <textarea class="commenta" id="commenta" name="comment" style="width:80%; height:70px;"><?=$item['comment']?></textarea>
       </form>
      </div>
      <div id="hide_P"><?=$item['comment']?></p>
         <?endforeach;?> 
      </td>
      </div>
      <td> 
      <button class="btn-green right" id="show">რედაქტირება</button>
      <button class="btn-green right" id="hide" style="display:none;">რედაქტირება</button>
        </td>
      </tr>
  	 </thead>
   </table>
<table  class="formadd" id="tab" width="100%">
        <tr> 
        	 <th align="center">რუბრიკა</th>
            <th align="center">პოზიცია</th>
            <th align="center">ზომა</th>
            <th align="center">ფასი</th>
            <th align="center">ვიზუალი</th>
            <th align="center">რედაქტირება/წაშლა</th> 
        </tr>
     </thead>
      <tbody>
 <?foreach($registry['shows'] as $ite):?> 
      <tr>
        <td align="center"><?=$ite['rubric']?></td>
        <td align="center"><?=$ite['position']?></td>
        <td align="center"><?=$ite['size']?></td>
        <td align="center"><?=$ite['price']?></td>
        <td align="center"><img src="<?=$ite['view']?>" width="50" /></td> 
        <td  align="center" width="20px">
       <span onclick="delete_row(<?=$ite['ID']?>)"> <img src="theme/images/trash_p.png" /></span>
       <a href="/apanel/index.php?component=presentation&sec=<?=$_GET['sec']?>&edit_ban=<?=$ite['ID']?>"> <img src="theme/images/edit.png" /> </a>
        </td>
      </tr>
   <?endforeach;?> 
  	 </thead>
</table>
<? }
if(isset($_GET['sec']) && $_GET['sec']==4)
{?>
            
<h3>N4 რუბრიკა "საკნატუნო ამბები"</h3>

<form action="/apanel/index.php" method="get">
<input type="hidden" value="presentation" name="component"/> 
    <input type="hidden" name="add_pie"  value="1" /> 
  <table class="formadd">
        <thead>
        <tr> 
            <th align="left">რუბრიკა</th> 
            <th align="left">მამრობითი</th>  
            <th align="left">25-მდე</th>
            <th align="left">25-44</th> 
             <th align="left">ლოგო</th>
        </tr>
        </thead>
        <tbody>
            <tr>   
           		 <td><select name="rubrica">
                 <option>აირჩიეთ რუბრიკა</option>
                  <?foreach($registry['rubric'] as $item):?> 
                   <option value="<?=$item['name']?>"><?=$item['name']?></option>
   					<?endforeach;?> 
                 <option></option>
                 </select></td> 
                <td><input type="text" name="male" value="" />  </td> 
                <td><input type="text" name="to25" value="" /> </td>
                <td><input type="text" name="bet2544" value="" /> </td>
                <td>
                <input type="text" name="image" value="" id="imagee_id" />
                <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=imagee_id" class="btn-blue iframe-btn" type="button">ვიზუალი</a>
            	</td>  
                <td><input type="submit" class="btn-green right"  value="დამატება"></td>
            </tr> 
        </tbody>
        </table>
 </form>
<table class="formadd" id="tab" width="100%">
    <thead>
    <tr>
    	<td colspan="5" align="center" style="background-color:#4690BB; color:#FFF;  padding: 10px;">რუბრიკები 150 000-დან 200 000-მდე ჩვენებით</td>
    </tr>
        <tr> 
           <th align="center" style="color:#F60;">ლოგო</th>
            <th align="center" style="color:#F60;">რუბრიკა</th>
            <th align="center" style="color:#F60;">მომხმარებელთა სქესი</th>
            <th align="center" style="color:#F60;">ასაკობრივი ზღვარი</th> 
        </tr>
     </thead> 
      <tbody>
      <?  $counter = 0; ?>
      <?foreach($registry['showpie'] as $item):?>
    <?
      $male=$item['male'];
      $to25 = $item['to25'];
      $bet2544 = $item['bet2544']
    ?>
     <script>
                var pieData_<?=$counter?> = [
                        {
                            value:100-<?=$male?>,
                            color:"#ed4321",
                            highlight: "#FF5A5E",
                            label: "ქალი"
                        },
                        {
                            value: <?=$male?>,
                            color: "#27bfc4",
                            highlight: "#5AD3D1",
                            label: "კაცი"
                        } 
        
                    ];
        
                    $(document).ready(function() {
                        var ctx = document.getElementById("chart-area_<?=$counter?>").getContext("2d");
                        window.myPie = new Chart(ctx).Pie(pieData_<?=$counter?>);
                    });
            </script>  
                
          <script>
			var barChartData_<?=$counter?> = {
				labels : ["25-მდე","25-44","44-დან"],
				datasets : [
					{
						fillColor : "#ed4321",
						strokeColor : "rgba(220,220,220,0.8)",
						highlightFill: "rgba(220,220,220,0.75)",
						highlightStroke: "rgba(220,220,220,1)",
						data : [<?=$to25?>,<?=$bet2544?>,100-<?=$to25?>-<?=$bet2544?>]
					} 
				]
		
			} 
			$(document ).ready(function() {
			var ctx = document.getElementById("canvas_<?=$counter?>").getContext("2d");
				window.myBar = new Chart(ctx).Bar(barChartData_<?=$counter?>, {
					responsive : true
				});
			});
			 
		</script>
      <tr>
       <td align="center" width="20"><img src="<?=$item['logo_url']?>" width="50" /></td>
        <td align="center" width="200"><?=$item['rubric']?></td>
        <td align="center">
          <div id="canvas-holder"><canvas id="chart-area_<?=$counter?>" width="150" height="150"/></div>
        
                <table width="200">
                  <tr>
                    <td align="center" style="font-size:18px;"><img src="<?=$theme_admin?>images/blue.png" /></td><td>მამრობითი</td>
                  </tr>
                  <tr>
                    <td align="center" style="font-size:18px;"><img src="<?=$theme_admin?>images/orange.png" /></td><td>მდედრობითი</td>
                  </tr>
                </table> 
            </td> 
         <td align="center">
          <div style="width: 20%"><canvas id="canvas_<?=$counter?>" height="850" width="1000"></canvas></div>
          </td>
          <td  align="center" width="20px">
       <span onclick="delete_row('diagrams_<?=$item['id']?>')"> <img src="theme/images/trash_p.png" /></span>
       <a href="/apanel/index.php?component=presentation&sec=<?=$_GET['sec']?>&edit_pie=<?=$item['id']?>"> <img src="theme/images/edit.png" /> </a>
        </td>
      </tr> 
      
      <? $counter++; ?>
      <?endforeach?>
      <tr>
      <td colspan="4" align="center">
      <?foreach($registry['show_comment'] as $item):?> 
      <div id="hide_P" style="display:none;">
      <form action="/apanel/index.php" method="get">
	<input type="hidden" value="presentation" name="component"/> 
      <textarea class="commenta" id="commenta" name="comment" style="width:80%; height:70px;"><?=$item['comment']?></textarea>
       </form>
      </div>
      <div id="hide_P"><?=$item['comment']?></p>
         <?endforeach;?> 
      </td>
      </div>
      <td> 
      <button class="btn-green right" id="show">რედაქტირება</button>
      <button class="btn-green right" id="hide" style="display:none;">რედაქტირება</button>
        </td>
      </tr>
  	 </thead>
   </table>
<table  class="formadd" id="tab" width="100%">
        <tr> 
        	 <th align="center">რუბრიკა</th>
            <th align="center">პოზიცია</th>
            <th align="center">ზომა</th>
            <th align="center">ფასი</th>
            <th align="center">ვიზუალი</th>
            <th align="center">რედაქტირება/წაშლა</th> 
        </tr>
     </thead>
      <tbody>
 <?foreach($registry['shows'] as $ite):?> 
      <tr>
        <td align="center"><?=$ite['rubric']?></td>
        <td align="center"><?=$ite['position']?></td>
        <td align="center"><?=$ite['size']?></td>
        <td align="center"><?=$ite['price']?></td>
        <td align="center"><img src="<?=$ite['view']?>" width="50" /></td> 
        <td  align="center" width="20px">
       <span onclick="delete_row(<?=$ite['ID']?>)"> <img src="theme/images/trash_p.png" /></span>
       <a href="/apanel/index.php?component=presentation&sec=<?=$_GET['sec']?>&edit_ban=<?=$ite['ID']?>"> <img src="theme/images/edit.png" /> </a>
        </td>
      </tr>
   <?endforeach;?> 
  	 </thead>
</table><?	}
if(isset($_GET['sec']) && $_GET['sec']==2)
{
if(isset($_GET['edit'])) {
?> 
    <h3>N2 ბანერები მთავარ გვერდზე-რედაქტირება</h3>   
 <form action="/apanel/index.php" method="get">
    <input type="hidden" value="presentation" name="component"/>  
    <input type="hidden" name="makeEdit" value="1" />
    <input type="hidden" name="editID" value="<?=$_GET['edit']?>"  />
    <table class="formadd" width="50%">
        <thead>
        <tr> 
        
            <th align="left">პოზიცია</th> 
            <th align="left">ზომა</th>
            <th align="left">ფასი</th>
            <th align="left">ვიზუალი</th>
        </tr>
        </thead>
        <tbody>
        <tr>           
         <td>
            <select name="position">
             <?foreach($registry['edit'] as $ite):?> 
             <option value="<?=$ite['position']?>">მონიშნულია <?=$ite['position']?></option>
               <?endforeach;?>
               <option value="F1">F1</option> 
                <option value="F2">F2</option> 
                 <option value="F3">F3</option> 
                  <option value="F4">F4</option> 
                   <option value="F5">F5</option> 
                    <option value="F6">F6</option> 
                     <option value="F7">F7</option> 
                      <option value="F8">F8</option> 
                       <option value="F9">F9</option> 
                        <option value="F10">F10</option> 
                         <option value="F11">F11</option> 
                          <option value="F12">F12</option> 
                           <option value="F13">F13</option>
                           	 <option value="F14">F14</option>
                              <option value="SL">SL</option>
                          		<option value="ბრენდირება">ბრენდირება</option> 
                           		 <option value="FM">FM</option> 
            </select>
            </td>
            <td>
             <select name="size">
               <?foreach($registry['edit'] as $ite):?> 
             <option value="<?=$ite['size']?>">მონიშნულია <?=$ite['size']?></option>
               <?endforeach;?>
             <option value="800x100">800x100</option>
             <option value="230x600">230x600</option>
             <option value="200x700">200x700</option>
             <option value="600x700">600x700</option>
             <option value="200x500">200x500</option>
             <option value="320x200">320x200</option>
             <option value="205x355">205x355</option>
             <option value="165x480">165x480</option>
              <option value="*">*</option>
             </select>
            </td>
            <td>
             <?foreach($registry['edit'] as $ite):?> 
             <input type="text" name="price" value="<?=$ite['price']?>">
               <?endforeach;?>
               
            </td> 
            <td>
            <?foreach($registry['edit'] as $ite):?> 
            <input type="text" name="image" value="<?=$ite['view']?>" id="image_id" />
               <?endforeach;?>
                <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=image_id" class="btn-blue iframe-btn" type="button">ვიზუალი</a>
            </td> 
            <td width="40%">
               <input type="submit" class="btn-green right"  value="რედაქტირება"> 
            </td>
        </tr>
        </tbody>
    </table>
   </form> 
<?php
}else {
?> 
 <h3>N2 ბანერები მთავარ გვერდზე</h3>
 <form action="/apanel/index.php" method="get">
    <input type="hidden" value="presentation" name="component"/> 
    <input type="hidden" name="add"  value="1" /> 
    <table class="formadd" width="50%">
        <thead>
        <tr> 
        
            <th align="left">პოზიცია</th> 
            <th align="left">ზომა</th>
            <th align="left">ფასი</th>
            <th align="left">ვიზუალი</th>
        </tr>
        </thead>
        <tbody>
        <tr>           
         <td>
            <select name="position">
                <option value="">აირჩიეთ პოზიცია</option> 
               <option value="F1">F1</option> 
                <option value="F2">F2</option> 
                 <option value="F3">F3</option> 
                  <option value="F4">F4</option> 
                   <option value="F5">F5</option> 
                    <option value="F6">F6</option> 
                     <option value="F7">F7</option> 
                      <option value="F8">F8</option> 
                       <option value="F9">F9</option> 
                        <option value="F10">F10</option> 
                         <option value="F11">F11</option> 
                          <option value="F12">F12</option>
                          	<option value="F13">F13</option>
                           	 <option value="F14">F14</option>
                              <option value="SL">SL</option>
                          		<option value="ბრენდირება">ბრენდირება</option> 
                           		 <option value="FM">FM</option> 
            </select>
            </td>
            <td>
             <select name="size">
             <option value="">აირჩიეთ ზომა</option>
             <option value="800x100">800x100</option>
             <option value="230x600">230x600</option>
             <option value="200x700">200x700</option>
             <option value="600x700">600x700</option>
             <option value="200x500">200x500</option>
             <option value="320x200">320x200</option>
             <option value="205x355">205x355</option>
             <option value="165x480">165x480</option>
              <option value="*">*</option>
             </select>
            </td>
            <td>
                <input type="text" name="price" value="">
            </td> 
            <td>
                <input type="text" name="image" value="" id="image_id" />
                <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=image_id" class="btn-blue iframe-btn" type="button">ვიზუალი</a>
            </td> 
            <td width="40%">
               <input type="submit" class="btn-green right"  value="დამატება">
            </td>
        </tr>
        </tbody>
    </table>
   </form> 
<?php
}
?>
<table class="formadd" id="tab" width="100%">
    <thead>
    <tr>
    	<td colspan="5" align="center" style="background-color:#4690BB; color:#FFF; padding: 10px;">ბანერები მთავარ გვერდზე</td>
    </tr>
        <tr> 
            <th align="center">პოზიცია</th>
            <th align="center">ზომა</th>
            <th align="center">ფასი</th>
            <th align="center">ვიზუალი</th>
            <th align="center">რედაქტირება/წაშლა</th> 
        </tr>
     </thead>
      <tbody>
 <?foreach($registry['show'] as $ite):?> 
      <tr>
        <td align="center"><?=$ite['position']?></td>
        <td align="center"><?=$ite['size']?></td>
        <td align="center"><?=$ite['price']?></td>
        <td align="center"><img src="<?=$ite['view']?>" width="50" /></td> 
        <td  align="center" width="20px">
       <span onclick="delete_row(<?=$ite['ID']?>)"> <img src="theme/images/trash_p.png" /></span>
       <a href="/apanel/index.php?component=presentation&sec=2&edit=<?=$ite['ID']?>"> <img src="theme/images/edit.png" /> </a>
        </td>
      </tr>
   <?endforeach;?> 
  	 </thead>
   </table>
<!--end-->

  <? 		
}
if(isset($_GET['sec']) && $_GET['sec']==1)
{
?>

<h3>N1 სტატისტიკა</h3>    
 <form action="/apanel/index.php" method="get">
    <input type="hidden" value="presentation" name="component"/>
    <input type="hidden" name="googleanalytics" value="0"  />  
 <input type="text" name="image" value="" id="image_id" />
                <a align="center" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=image_id" class="btn-blue iframe-btn" type="button">ვიზუალი</a>
    <input type="button" onclick="del_statistic(0);" class="btn-green right"  value="წაშლა" style="background:linear-gradient(to bottom, #F9013A 5%, #F9013A 100%) !important;"> 
     <input type="submit" class="btn-green right"  value="დამატება" >          
   </form>             
  <table class="formadd" id="tab" width="100%">
    <thead>
    <tr>
    	<td colspan="5" align="center" style="background-color:#4690BB; color:#FFF;  padding: 10px;">სტატისტიკა</td>
    </tr
     ></thead>
      <tbody> 
      <tr>
        <td align="center" width="90%">
        <?foreach($registry['statsel'] as $item):?> 
        <img src="<?=$item['url']?>" width="1259" />
        <?endforeach?> 
        </td>
      </tr> 
  	 </thead>
   </table>
<? }
if(isset($_GET['sec']) && $_GET['sec']==3)
{
?>

<h3>N3 მთავარი გვერდის სტატისტიკ</h3>
     
 <form action="/apanel/index.php" method="get">
    <input type="hidden" value="presentation" name="component"/>
    <input type="hidden" name="googleanalytics" value="1"  />  
 <input type="text" name="image" value="" id="image_id" />
                <a align="center" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=image_id" class="btn-blue iframe-btn" type="button">ვიზუალი</a>
    <input type="button" onclick="del_statistic(1);" class="btn-green right"  value="წაშლა" style="background:linear-gradient(to bottom, #F9013A 5%, #F9013A 100%) !important;"> 
     <input type="submit" class="btn-green right"  value="დამატება" >          
   </form>             
  <table class="formadd" id="tab" width="100%">
    <thead>
    <tr>
    	<td colspan="5" align="center" style="background-color:#4690BB; color:#FFF;  padding: 10px;">სტატისტიკა</td>
    </tr
     ></thead>
      <tbody> 
      <tr>
        <td align="center" width="90%">
        <?foreach($registry['statsel1'] as $item):?> 
        <img src="<?=$item['url']?>"  width="1259" />
        <?endforeach?> 
        </td>
      </tr> 
  	 </thead>
   </table>
<? }

endif;






if(isset($_GET['edit_pie'])){
?>
<h3>რედაქტირება</h3>
<form action="/apanel/index.php" method="get">
<input type="hidden" value="presentation" name="component"/> 
    <input type="hidden" name="update_pie"  value="<?=$_GET['edit_pie']?>" /> 
    <input type="hidden"  name="sec" value="<?=$_GET['sec']?>"/>
  <table class="formadd">
        <thead>
        <tr> 
            <th align="left">რუბრიკა</th> 
            <th align="left">მამრობითი</th>  
            <th align="left">25-მდე</th>
            <th align="left">25-44</th> 
             <th align="left">ლოგო</th>
        </tr>
        </thead>
        <tbody>
            <tr>   
           		 <td><select name="rubrica">
                  <?foreach($registry['select'] as $item):?> 
                 <option value="<?=$item['rubric']?>">მონიშნულია:<?=$item['rubric']?></option>
                 <?endforeach;?> 
                  <?foreach($registry['rubric'] as $item):?> 
                   <option value="<?=$item['name']?>"><?=$item['name']?></option>
   					<?endforeach;?> 
                 <option></option>
                 </select></td> 
                    <?foreach($registry['select'] as $item):?> 
                <td><input type="text" name="male" value="<?=$item['male']?>" />  </td> 
                <td><input type="text" name="to25" value="<?=$item['to25']?>" /> </td>
                <td><input type="text" name="bet2544" value="<?=$item['bet2544']?>" /> </td>
                <td>
                <input type="text" name="image" value="<?=$item['logo_url']?>" id="image_id" />
                <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=image_id" class="btn-blue iframe-btn" type="button">ვიზუალი</a>
            	</td> 
                  <?endforeach;?>
                <td><input type="submit" class="btn-green right"  value="დარედაქტირება"></td>
            </tr>
            
        </tbody>
        </table>
</form>
<? }elseif(isset($_GET['edit_ban'])){?>
<form action="/apanel/index.php" method="get">
   <input type="hidden" value="presentation" name="component"/> 
    <input type="hidden" name="edit_rub"  value="1" />  
    <input type="hidden"  name="update_ban" value="<?=$_GET['edit_ban']?>"/>
    <input type="hidden"  name="sec" value="<?=$_GET['sec']?>"/>
  <table class="formadd" width="50%">
        <thead>
        <tr> 
            <th align="left">პოზიცია</th> 
            <th align="left">ზომა</th>
            <th align="left">ფასი</th>
            <th align="left">ვიზუალი</th>
        </tr>
        </thead>
       <?foreach($registry['select_rub'] as $item):?>
        <tbody>
        <tr>           
         <td>
            <select name="position">
              <option value="<?=$item['position']?>">მონიშნულია:<?=$item['position']?></option> 
               <option value="F1">F1</option> 
                <option value="F2">F2</option> 
                 <option value="F3">F3</option> 
                  <option value="F4">F4</option> 
                   <option value="F5">F5</option> 
                    <option value="F6">F6</option> 
                     <option value="F7">F7</option> 
                      <option value="F8">F8</option> 
                       <option value="F9">F9</option> 
                        <option value="F10">F10</option> 
                         <option value="F11">F11</option> 
                          <option value="F12">F12</option> 
                           <option value="F13">F13</option>
                           	 <option value="F14">F14</option>
                              <option value="SL">SL</option>
                          		<option value="ბრენდირება">ბრენდირება</option> 
                           		 <option value="FM">FM</option> 
            </select>
            </td>
            <td>
             <select name="size">
             <option value="<?=$item['size']?>">მონიშნულია:<?=$item['size']?></option> 
             <option value="800x100">800x100</option>
             <option value="230x600">230x600</option>
             <option value="200x700">200x700</option>
             <option value="600x700">600x700</option>
             <option value="200x500">200x500</option>
             <option value="320x200">320x200</option>
             <option value="205x355">205x355</option>
             <option value="165x480">165x480</option>
             <option value="*">*</option>
             </select>
            </td>
            <td>
                <input type="text" name="price" value="<?=$item['price']?>">
            </td> 
            <td>
                <input type="text" name="image" value="<?=$item['view']?>" id="image_id" />
                <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/filemanager/dialog.php?type=1&akey=a651481913d2fedc5c880b5f14cb9859&field_id=image_id" class="btn-blue iframe-btn" type="button">ვიზუალი</a>
            </td> 
            <td width="40%">
               <input type="submit" class="btn-green right"  value="რედაქტირება">
            </td>
        </tr>
        </tbody>
         <?endforeach?>
    </table> 
 </form>
<? }