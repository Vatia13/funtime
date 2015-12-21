<? defined('_JEXEC') or die('Restricted access');?>

<script type="text/javascript" src="/<?=$theme?>js/highcharts.js"></script> 
<script>
function scrollWin(point, text) {
	$("#picture").animate(
    { scrollTop: point }, 1200
	);
	$('#capt').css('top',point+6+'px').html(text);
	$('#capt').css('display','block'); 
	}
</script>
<style>
body{font-family: 'BPGNinoMtavruliRegular';}
#tab{ border-left:1px solid #35b2d5; border-right:1px solid #35b2d5; width:100%;}
.tab{background-color:#35b2d5; width:70% !important; margin:0px auto; color:#FFF;} 
table tr td{ border-bottom:1px solid #35b2d5; width:30%;  } 
.pie{ width:200px; height:200px;}
.column{ width:300px !important; height:180px;} 
.diagramss {border-left:1px solid #35b2d5; border-right:1px solid #35b2d5; border-bottom:1px solid #35b2d5;  width:99.8%; overflow:hidden;}
.diagramss div{ display:inline-block; width:30%;}
#rub1{ position:relative; bottom:86px;  margin-left:-7%;  font-size: 14px;} 
#sh{ display:none; z-index:10000000; width:1178px; background-color:#FFFFFF; border:10px solid #27bfc4; height:700px; font-family: 'BPGNinoMtavruliRegular';}
#sh div{height:700px;  float:left;}
#picture{ width:50%;}
#picture{ overflow-y:scroll; }
#picture img { max-width:100%;}
#picture::-webkit-scrollbar {width: 10px;}
#picture::-webkit-scrollbar-track {-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);}
#picture::-webkit-scrollbar-thumb {background-color: #f42b35; -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);} 
#capt {color:#FFF; font-weight:800; position:absolute; padding:10px; height:14px !important; background-color:#ed4321;}  
#main{ cursor: pointer; height: 1715px; background-color: rgba(47, 42, 42, 0.8);position: fixed;top: -3.52%; left: 0; width: 100%;height:110%;
    z-index: 10; display:none; margin: 0; padding: 0; border: 0;} 
.full{ padding: 5px; border:1px solid #27bfc4; color:#F60; font-size:16px; font-weight:600;}
.full div{display:inline-block;}
.logoo{ width:10%; text-align:center;}
.rubrica{width:20%; text-align:center; } 
.sex{width:28%; text-align:center; }
.age{width:30%; text-align:center; }
.vizuali{width:10%; text-align:center; cursor:pointer; }

#sh {
	margin-top:150px;	
}


@media screen and (max-width: 600px) {
		.pie{ width:320px; height:320px;} 
		.column{ width:320px; height:320px;} 
		.diagramss div{ width:100%;}
		#rub{position:relative; bottom:-10px;}
		#rub1{bottom:10px; margin-left:0px !important;}
		#rub1 img{ width:10px;}
		.tab{ width:100% !important;}
		.full div{width:100%; }
}
#results table tr td{ border:1px solid #FFF !important;}
</style>
<script>
	$(document).ready(function(e) {
        if($('.header-bg').css('display') == 'block')
		{
			$('#sh').css('margin-top',300);
		}
			
		$(window).bind('mousewheel', function(event) {
			if($('#main').css('display') == 'block'){
            	$('body').css('overflow-y','hidden');
			
			if (event.originalEvent.wheelDelta >= 0) {
				$('#picture').stop().animate({ scrollTop: ($('#picture').scrollTop()-70)+"px" },300);
			}
			else {
				$('#picture').stop().animate({ scrollTop: ($('#picture').scrollTop()+70)+"px" },300);
			}
		
			}
		});
		
    });
</script>
<div id="main" ondblclick="out()">
<div align="center">
<div id="sh">	 
    <div id="picture">   
        <div style="position:relative">
            <?foreach($registry['test1'] as $item):?> 
            <img src="<?=$item['view']?>" />
            <?endforeach?>
            <div id="capt" style="display:none;"> </div>
        </div>
    </div>
	<div id="results">
        <table  width="589" style="background-color:#27bfc4; color:white;">
          <tr align="center">
            <td>პოზიცია</td>
            <td>ზომა</td>
            <td>ფასი</td>
          </tr>
          <tr>
            <td colspan="3" style="background-color:#FFF;"></td>
          </tr>
          <tr>
            <td colspan="3"><table width="580" style="background-color:#27bfc4; color:white" id="resulttr"></table></td>
          </tr>
        </table> 
        <p style="position:absolute; bottom:0px; padding:5px;" ><strong>ფასები მოცემულია ეროვნულ ვალუტაში...</strong></p>
	</div>
</div>
</div>
</div> 
<div class="content">
<div id="content"> 
<script>
function view(stat,rub){ 
  $.post( "presentation",{action:'get_stat',stat:stat,rub:rub}, function( data ) {
		$('#resulttr').html(data);
	});
  $( "#sh" ).fadeIn( "slow" ); 
  $( "#main" ).fadeIn( "slow" ); 
};
function out(){ 
	$( "#sh" ).fadeOut( "slow" );
  	$( "#main" ).fadeOut( "slow" );
	};
</script>
<table id="tab">  
  <tr>
    <td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px;  padding: 10px;"><strong>რეკლამა</strong></td>
  </tr>
  <tr> 
  <?foreach($registry['first'] as $item):?>
    <td align="center"><img src="<?=$item['url']?>"  width="1189px" /></td>
    <?endforeach?>
  </tr>
</table>
<table id="tab" width="100%"> 
        <tr>
            <td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px; padding: 10px;"><strong>ბანერები მთავარ გვერდზე</strong></td>
        </tr>
        <tr> 
            <th align="center">პოზიცია</th>
            <th align="center">ზომა</th>
            <th align="center">ფასი</th>
            <th align="center">ვიზუალი</th> 
        </tr> 
 <?foreach($registry['second'] as $ite):?> 
      <tr>
        <td align="center"><?=$ite['position']?></td>
        <td align="center"><?=$ite['size']?></td>
        <td align="center"><?=$ite['price']?></td>  
        <td align="center">
        <img src="<?=$ite['view']?>" width="50" />
        </td> 
      </tr>
   <?endforeach;?>  
   </table>
<table id="tab">
      <tr>
        <td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px;  padding: 10px;"><strong>მთავარი გვერდის სტატისტიკა</strong></td>
      </tr>
      <tr> 
      <?foreach($registry['therd'] as $item):?>
        <td align="center"><img src="<?=$item['url']?>"  width="1189px" /></td>
        <?endforeach?>
      </tr>
</table>
<table id="tab">  
    <tr>
    	<td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px; padding: 10px;"><strong>რუბრიკა  „საკნატუნო ამბები“</strong></td>
    </tr>
    <tr>
    	<td colspan="5" align="center" style="color:#F60;" ><strong>ვიზიტორი: 1 500 000-დან   2 000 000-მდე</strong></td>
    </tr>
    <tr>
    	<td colspan="5" align="center" style="color:#F60;" ><strong>სტატისტიკა</strong></td>
    </tr>
</table>
       <?  $counter = 0; ?>
      <?foreach($registry['fourth'] as $item):?>
    <?
      $male = $item['male'];
      $to25 = $item['to25'];
      $bet2544 = $item['bet2544']
    ?>
    <script>
	$(function () {
		$('#pie_<?=$counter?>').highcharts({
			chart: { 
				type: 'pie',
				backgroundColor:'transparent'
			},
			title: {
				text: ''
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: { 
					dataLabels: {
						distance: -40,
						enabled: true,
						format: ' {point.percentage:.1f} %', 
						style: { 
						fontSize:'14px',
                        fontWeight: 'bold', 
                        color: 'black',
                        textShadow: '0px 1px 2px white' 
                   			 }
					}
				}
			},
			colors: [
					'#ed4321',
					'#27bfc4'
			],
			series: [{
				name: "სქესი",
				colorByPoint: true,
				data: [{
					name: "მდედრობითი",
					y: 100-<?=$male?>
				},  {
					name: "მამრობითი",
					y: <?=$male?>
				}]
			}]
		});
	});
		$(function () {
			$('#containerr_<?=$counter?>').highcharts({
				chart: {
					type: 'column',
					backgroundColor:'transparent'
				},
				title: {
					text: ''
				}, 
				legend: {
					enabled: false
				},
				colors: [
					'#ed4321',
				],
				 xAxis: {
					type: 'category',
				},
				yAxis: {
					min: 0,
					title: {
						text: ' '
					}
				},
				 credits: {
					  enabled: false
				  },
				series: [{
					name: 'რაოდენობა',
					data: [
						['25-მდე', <?=$to25?>],
						['25-44', <?=$bet2544?>],
						['44-დან', 100-<?=$to25?>-<?=$bet2544?>],
					],
					dataLabels: {
						enabled: true, 
						color: '#000000',
						align: 'center',
						format: '{point.y:.1f}%', // one decimal 
						style: {
							fontSize: '13px',
							fontFamily: 'Verdana, sans-serif'
						}
					}
				}]
			});
		});
		</script> 
     <div class="diagramss" align="center">
        <div id="pie_<?=$counter?>" class="pie"></div>
        <div id="rub1"  style="margin-left:-20%;  font-size: 13px;"><img src="/<?=$theme?>images/blue.png" width="10" />&nbsp;&nbsp;მამრობითი<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/<?=$theme?>images/orange.png" width="10" />&nbsp;&nbsp;მდედრობითი</div>
        <div id="containerr_<?=$counter?>" class="column"></div>
     </div>
	<? $counter++;?>
    <?endforeach?> 
<table id="tab">
        <tr> 
            <th align="center">პოზიცია</th>
            <th align="center">ზომა</th>
            <th align="center">ფასი</th>
            <th align="center">ვიზუალი</th> 
        </tr>
 <?foreach($registry['fourth_p'] as $ite):?> 
      <tr>
        <td align="center"><?=$ite['position']?></td>
        <td align="center"><?=$ite['size']?></td>
        <td align="center"><?=$ite['price']?></td>
       <td align="center"><img src="<?=$ite['view']?>" width="50"/></td>
      </tr>
   <?endforeach;?> 
</table>
<!-- მეხუთე სექცია-->
<table id="tab"> 
        <tr>
 <td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px;  padding: 10px;"><strong>რუბრიკები 150 000-დან 200 000-მდე ჩვენებით</strong></td>
        </tr>
</table>
<div class="full">
    <div class="logoo">ლოგო</div>
    <div class="rubrica">რუბრიკა</div>
    <div class="sex">მომხმარებელთა სქესი</div>
    <div class="age">ასაკობრივი ზღვარი</div>
    <div class="vizuali">ვიზუალი</div>
</div>
<?foreach($registry['fiveth'] as $item):?>
    <?
      $male=$item['male'];
      $to25 = $item['to25'];
      $bet2544 = $item['bet2544']
    ?>
         <script>
	$(function () {
		$('#pie_<?=$counter?>').highcharts({
			chart: { 
				type: 'pie',
				backgroundColor:'transparent'
			},
			title: {
				text: ''
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: { 
					dataLabels: {
						distance: -40,
						enabled: true,
						format: '{point.percentage:.1f} %', 
						style: {
						fontSize:'14px',
                        fontWeight: 'bold',
                        color: 'black',
                        textShadow: '0px 1px 2px white'
                   			 }
					}
				}
			},
			colors: [
					'#ed4321',
					'#27bfc4'
			],
			series: [{
				name: "სქესი",
				colorByPoint: true,
				data: [{
					name: "მდედრობითი",
					y: 100-<?=$male?>
				},  {
					name: "მამრობითი",
					y: <?=$male?>
				}]
			}]
		});
	});
		$(function () {
			$('#containerr_<?=$counter?>').highcharts({
				chart: {
					type: 'column',
					backgroundColor:'transparent'
				},
				title: {
					text: ''
				}, 
				legend: {
					enabled: false
				},
				colors: [
					'#ed4321',
				],
				 xAxis: {
					type: 'category',
				},
				yAxis: {
					min: 0,
					title: {
						text: ' '
					}
				},
				 credits: {
					  enabled: false
				  },
				series: [{
					name: 'რაოდენობა',
					data: [
						['25-მდე', <?=$to25?>],
						['25-44', <?=$bet2544?>],
						['44-დან', 100-<?=$to25?>-<?=$bet2544?>],
					],
					dataLabels: {
						enabled: true, 
						color: '#000000',
						align: 'center',
						format: '{point.y:.1f}%', // one decimal 
						style: {
							fontSize: '13px',
							fontFamily: 'Verdana, sans-serif'
						}
					}
				}]
			});
		});
		</script> 
<div class="full" > 
    <div class="logoo" style="position: relative;bottom: 80px;"><? if(!empty($item['logo_url'])){?><img src="<?=$item['logo_url']?>" width="50"/><? } ?></div>
    <div class="rubrica"><font style="position: relative;bottom: 90px; font-weight:600; color:black;"><?=$item['rubric']?></font></div> 
    <div class="sex">
        <div id="pie_<?=$counter?>" class="pie"></div>
        <div id="rub1"><img src="/<?=$theme?>images/blue.png" width="10" />&nbsp;&nbsp;მამრობითი<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/<?=$theme?>images/orange.png" width="10" />&nbsp;&nbsp;მდედრობითი</div>
    </div>
    <div class="age">
   	 <div id="containerr_<?=$counter?>" class="column"></div> 
    </div> 
    <div class="vizuali" onclick="view('<?=$item['stat']?>','<?=$item['rubric_id']?>')" style="position: relative;bottom: 45px;"><? if(!empty($item['view'])){?><img src="<?=$item['view']?>" width="50"/><? } ?></div> 
</div>
	<? $counter++;?>
<?endforeach?>
<table id="tab">
      <tr>
       <?foreach($registry['coment5'] as $item):?> 
          <td colspan="4" align="center"><?=$item['comment']?></td>
          <?endforeach?>
      </tr> 
</table>
<!-- მეხუთე სექცია დასასრული-->
<!-- მეექვსე სექცია-->
<table id="tab"> 
        <tr>
            <td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px;  padding: 10px;"><strong>რუბრიკები 100 000-დან 150 000-მდე  ჩვენებით</strong></td>
        </tr>
</table>
<div class="full">
    <div class="logoo">ლოგო</div>
    <div class="rubrica">რუბრიკა</div>
    <div class="sex">მომხმარებელთა სქესი</div>
    <div class="age">ასაკობრივი ზღვარი</div>
    <div class="vizuali">ვიზუალი</div>
</div>
<?foreach($registry['sixth'] as $item):?>
    <?
      $male=$item['male'];
      $to25 = $item['to25'];
      $bet2544 = $item['bet2544']
    ?>
         <script>
	$(function () {
		$('#pie_<?=$counter?>').highcharts({
			chart: { 
				type: 'pie',
				backgroundColor:'transparent'
			},
			title: {
				text: ''
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: { 
					dataLabels: {
						distance: -40,
						enabled: true,
						format: '{point.percentage:.1f} %', 
						style: {
						fontSize:'14px',
                        fontWeight: 'bold',
                        color: 'black',
                        textShadow: '0px 1px 2px white'
                   			 }
					}
				}
			},
			colors: [
					'#ed4321',
					'#27bfc4'
			],
			series: [{
				name: "სქესი",
				colorByPoint: true,
				data: [{
					name: "მდედრობითი",
					y: 100-<?=$male?>
				},  {
					name: "მამრობითი",
					y: <?=$male?>
				}]
			}]
		});
	});
		$(function () {
			$('#containerr_<?=$counter?>').highcharts({
				chart: {
					type: 'column',
					backgroundColor:'transparent'
				},
				title: {
					text: ''
				}, 
				legend: {
					enabled: false
				},
				colors: [
					'#ed4321',
				],
				 xAxis: {
					type: 'category',
				},
				yAxis: {
					min: 0,
					title: {
						text: ' '
					}
				},
				 credits: {
					  enabled: false
				  },
				series: [{
					name: 'რაოდენობა',
					data: [
						['25-მდე', <?=$to25?>],
						['25-44', <?=$bet2544?>],
						['44-დან', 100-<?=$to25?>-<?=$bet2544?>],
					],
					dataLabels: {
						enabled: true, 
						color: '#000000',
						align: 'center',
						format: '{point.y:.1f}%', // one decimal 
						style: {
							fontSize: '13px',
							fontFamily: 'Verdana, sans-serif'
						}
					}
				}]
			});
		});
		</script> 
<div class="full" > 
    <div class="logoo" style="position: relative;bottom: 80px;"><? if(!empty($item['logo_url'])){?><img src="<?=$item['logo_url']?>" width="50"/><? } ?></div>
    <div class="rubrica"><font style="position: relative;bottom: 90px; font-weight:600; color:black;"><?=$item['rubric']?></font></div> 
    <div class="sex">
        <div id="pie_<?=$counter?>" class="pie"></div>
        <div id="rub1"><img src="/<?=$theme?>images/blue.png" width="10" />&nbsp;&nbsp;მამრობითი<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/<?=$theme?>images/orange.png" width="10" />&nbsp;&nbsp;მდედრობითი</div>
    </div>
    <div class="age">
   	 <div id="containerr_<?=$counter?>" class="column"></div> 
    </div> 
    <div class="vizuali" onclick="view('<?=$item['stat']?>','<?=$item['rubric_id']?>')" style="position: relative;bottom: 45px;"><? if(!empty($item['view'])){?><img src="<?=$item['view']?>" width="50"/><? } ?></div> 
</div>
	<? $counter++;?>
<?endforeach?>
<table id="tab">
      <tr>
       <?foreach($registry['comment6'] as $item):?> 
          <td colspan="4" align="center"><?=$item['comment']?></td>
          <?endforeach?>
      </tr> 
</table>

<!-- მეექვსე სექცია დასასრული-->
<!-- მეშვიდე სექცია-->
<table id="tab"> 
        <tr>
            <td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px;  padding: 10px;"><strong>რუბრიკები 50 000-დან 100 000-მდე  ჩვენებით</strong></td>
        </tr> 
</table>
<div class="full">
    <div class="logoo">ლოგო</div>
    <div class="rubrica">რუბრიკა</div>
    <div class="sex">მომხმარებელთა სქესი</div>
    <div class="age">ასაკობრივი ზღვარი</div>
    <div class="vizuali">ვიზუალი</div>
</div>
<?foreach($registry['seventh'] as $item):?>
    <?
      $male=$item['male'];
      $to25 = $item['to25'];
      $bet2544 = $item['bet2544']
    ?>
         <script>
	$(function () {
		$('#pie_<?=$counter?>').highcharts({
			chart: { 
				type: 'pie',
				backgroundColor:'transparent'
			},
			title: {
				text: ''
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: { 
					dataLabels: {
						distance: -40,
						enabled: true,
						format: '{point.percentage:.1f} %', 
						style: {
						fontSize:'14px',
                        fontWeight: 'bold',
                        color: 'black',
                        textShadow: '0px 1px 2px white'
                   			 }
					}
				}
			},
			colors: [
					'#ed4321',
					'#27bfc4'
			],
			series: [{
				name: "სქესი",
				colorByPoint: true,
				data: [{
					name: "მდედრობითი",
					y: 100-<?=$male?>
				},  {
					name: "მამრობითი",
					y: <?=$male?>
				}]
			}]
		});
	});
		$(function () {
			$('#containerr_<?=$counter?>').highcharts({
				chart: {
					type: 'column',
					backgroundColor:'transparent'
				},
				title: {
					text: ''
				}, 
				legend: {
					enabled: false
				},
				colors: [
					'#ed4321',
				],
				 xAxis: {
					type: 'category',
				},
				yAxis: {
					min: 0,
					title: {
						text: ' '
					}
				},
				 credits: {
					  enabled: false
				  },
				series: [{
					name: 'რაოდენობა',
					data: [
						['25-მდე', <?=$to25?>],
						['25-44', <?=$bet2544?>],
						['44-დან', 100-<?=$to25?>-<?=$bet2544?>],
					],
					dataLabels: {
						enabled: true, 
						color: '#000000',
						align: 'center',
						format: '{point.y:.1f}%', // one decimal 
						style: {
							fontSize: '13px',
							fontFamily: 'Verdana, sans-serif'
						}
					}
				}]
			});
		});
		</script> 
<div class="full" > 
    <div class="logoo" style="position: relative;bottom: 80px;"><? if(!empty($item['logo_url'])){?><img src="<?=$item['logo_url']?>" width="50"/><? } ?></div>
    <div class="rubrica"><font style="position: relative;bottom: 90px; font-weight:600; color:black;"><?=$item['rubric']?></font></div> 
    <div class="sex">
        <div id="pie_<?=$counter?>" class="pie"></div>
        <div id="rub1"><img src="/<?=$theme?>images/blue.png" width="10" />&nbsp;&nbsp;მამრობითი<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/<?=$theme?>images/orange.png" width="10" />&nbsp;&nbsp;მდედრობითი</div>
    </div>
    <div class="age">
   	 <div id="containerr_<?=$counter?>" class="column"></div> 
    </div> 
    <div class="vizuali" onclick="view('<?=$item['stat']?>','<?=$item['rubric_id']?>')" style="position: relative;bottom: 45px;"><? if(!empty($item['view'])){?><img src="<?=$item['view']?>" width="50"/><? } ?></div> 
</div>
	<? $counter++;?>
<?endforeach?>
<table id="tab">
      <tr>
       <?foreach($registry['comment7'] as $item):?> 
          <td colspan="4" align="center"><?=$item['comment']?></td>
          <?endforeach?>
      </tr> 
</table>
     
<!-- მეშვიდე სექცია დასასრული--> 
<!-- მერვე სექცია -->      
<table id="tab"> 
        <tr> 
            <td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px;  padding: 10px;"><strong>რუბრიკები 30 000-დან 50 000-მდე  ჩვენებით</strong></td>
        </tr>
 </table>
 <div class="full">
    <div class="logoo">ლოგო</div>
    <div class="rubrica">რუბრიკა</div>
    <div class="sex">მომხმარებელთა სქესი</div>
    <div class="age">ასაკობრივი ზღვარი</div>
    <div class="vizuali">ვიზუალი</div>
</div>
<?foreach($registry['eightth'] as $item):?>
    <?
      $male=$item['male'];
      $to25 = $item['to25'];
      $bet2544 = $item['bet2544']
    ?>
         <script>
	$(function () {
		$('#pie_<?=$counter?>').highcharts({
			chart: { 
				type: 'pie',
				backgroundColor:'transparent'
			},
			title: {
				text: ''
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: { 
					dataLabels: {
						distance: -40,
						enabled: true,
						format: '{point.percentage:.1f} %', 
						style: {
						fontSize:'14px',
                        fontWeight: 'bold',
                        color: 'black',
                        textShadow: '0px 1px 2px white'
                   			 }
					}
				}
			},
			colors: [
					'#ed4321',
					'#27bfc4'
			],
			series: [{
				name: "სქესი",
				colorByPoint: true,
				data: [{
					name: "მდედრობითი",
					y: 100-<?=$male?>
				},  {
					name: "მამრობითი",
					y: <?=$male?>
				}]
			}]
		});
	});
		$(function () {
			$('#containerr_<?=$counter?>').highcharts({
				chart: {
					type: 'column',
					backgroundColor:'transparent'
				},
				title: {
					text: ''
				}, 
				legend: {
					enabled: false
				},
				colors: [
					'#ed4321',
				],
				 xAxis: {
					type: 'category',
				},
				yAxis: {
					min: 0,
					title: {
						text: ' '
					}
				},
				 credits: {
					  enabled: false
				  },
				series: [{
					name: 'რაოდენობა',
					data: [
						['25-მდე', <?=$to25?>],
						['25-44', <?=$bet2544?>],
						['44-დან', 100-<?=$to25?>-<?=$bet2544?>],
					],
					dataLabels: {
						enabled: true, 
						color: '#000000',
						align: 'center',
						format: '{point.y:.1f}%', // one decimal 
						style: {
							fontSize: '13px',
							fontFamily: 'Verdana, sans-serif'
						}
					}
				}]
			});
		});
		</script> 
<div class="full" > 
    <div class="logoo" style="position: relative;bottom: 80px;"><? if(!empty($item['logo_url'])){?><img src="<?=$item['logo_url']?>" width="50"/><? } ?></div>
    <div class="rubrica"><font style="position: relative;bottom: 90px; font-weight:600; color:black;"><?=$item['rubric']?></font></div> 
    <div class="sex">
        <div id="pie_<?=$counter?>" class="pie"></div>
        <div id="rub1"><img src="/<?=$theme?>images/blue.png" width="10" />&nbsp;&nbsp;მამრობითი<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/<?=$theme?>images/orange.png" width="10" />&nbsp;&nbsp;მდედრობითი</div>
    </div>
    <div class="age">
   	 <div id="containerr_<?=$counter?>" class="column"></div> 
    </div> 
    <div class="vizuali" onclick="view('<?=$item['stat']?>','<?=$item['rubric_id']?>')" style="position: relative;bottom: 45px;"><? if(!empty($item['view'])){?><img src="<?=$item['view']?>" width="50"/><? } ?></div> 
</div>
	<? $counter++;?>
<?endforeach?>
<table id="tab">
      <tr>
       <?foreach($registry['comment8'] as $item):?> 
          <td colspan="4" align="center"><?=$item['comment']?></td>
          <?endforeach?>
      </tr> 
</table>
      
<!-- მერვე სექცია დასასრული-->    
<table id="tab">
	<tr>
    	<td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px;  padding: 10px;"><strong>ერთჯერადი სტატიების ფასები</strong></td>
    </tr>
        <tr> 
            <th align="center">პოზიცია</th> 
            <th align="center">ფასი</th> 
        </tr> 
      <tbody>
 <?foreach($registry['nine'] as $ite):?> 
      <tr>
        <td align="center"><font style="font-weight:600;"><?=$ite['rubric']?></font></td> 
        <td align="center"><?=$ite['price']?>&nbsp;ლარი</td> 
      </tr>
   <?endforeach;?>  
</table>
</div>
</div>
