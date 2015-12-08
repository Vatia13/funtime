<? defined('_JEXEC') or die('Restricted access');?>
<script type="text/javascript" src="/<?=$theme?>js/highcharts.js"></script> 
<script>
function scrollWin(point, text) {
	$("#picture").animate(
    { scrollTop: point},
    { complete : function(){ }});
	$('#capt').css('top',point+6+'px').html(text);
	$('#capt').css('display','block'); 
	}
</script>
<style>
	body{ background-color:#036; z-index:99999; font-family: 'BPGNinoMtavruliRegular';}
	#tab{ border-left:1px solid #35b2d5; border-right:1px solid #35b2d5; width:100%;}
	.tab{
		background-color:#35b2d5; width:70% !important; margin:0px auto; color:#FFF;
		} 
	table tr td{ border-bottom:1px solid #35b2d5; width:30%;  } 
	.pie{ width:200px; height:200px;}
	.column{ width:300px !important; height:180px;} 
	.diagramss {border-left:1px solid #35b2d5; border-right:1px solid #35b2d5; border-bottom:1px solid #35b2d5;  width:99.8%; overflow:hidden;}
	.diagramss div{ display:inline-block; width:30%;}
	#rub{ position:relative; bottom:90px;}
	#rub1{ position:relative; bottom:86px;  margin-left:-19%;  font-size: 14px;} 
	#show_img{
		background-color:#35b2d5; 
		position:fixed; 
		left:32%; 
		top:30%; 
		margin:0px auto;
		z-index:1;
		}
	.showr{cursor:pointer;}
	@media screen and (max-width: 600px) {
		.pie{ width:320px; height:320px;} 
		.column{ width:320px; height:320px;} 
		.diagramss div{ width:100%;}
		#rub{position:relative; bottom:-10px;} 
		#show_img{left:20% !important; }
		#show_img img{width:250px !important;}
		#rub1{bottom:10px; margin-left:0px !important;}
		#rub1 img{ width:10px;}
		.tab{ width:100% !important;}
	} 
    tr{ cursor:pointer;}
    #sh{ z-index:9999999; display:none; background-color:#FFFFFF; position:fixed; border:10px solid #27bfc4; height:700px; font-family: 'BPGNinoMtavruliRegular';}
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
	#capt {
		color:#FFF;
		font-weight:800;
		position:absolute; 
		padding:10px;
		height:14px !important;
		background-color:#ed4321;
		
	}
	#esc{
		position:absolute;
		cursor:pointer;
		top:-9px;
		right:-9px;
		border-radius:25px;	
	} 
</style>
<div class="content">
<div id="content"> 
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
    <div id="esc"><img src="/<?=$theme?>images/esc.png"/></div>
    <table width="589" style="background-color:#35b2d5; color:white">
      <tr align="center">
        <td>პოზიცია</td>
        <td>ზომა</td>
        <td>ფასი</td>
      </tr>
      <tr><td colspan="3" style="background-color:#FFF;"></td></tr>
     <? 
 $i = 1;
 foreach($registry['test'] as $item): 
 $array = array("#35b2d5","#5ec0da"); 
 if($i % 2 == 0)
 	$color = $array[0];
else
	$color = $array[1];
  $i++;
 ?> 
      <tr onclick="scrollWin(<?=$item['scroll_position']?>, '<?=$item['position']?>')" style="background-color:<?=$color?>; color:#FFF; font-weight:700;">
        <td align="center"><?=$item['position']?></td>
        <td align="center"><?=$item['size']?></td>
        <td align="center"><?=$item['price']?></td> 
      </tr>
   <?endforeach;?>   
    </table>
</div>
</div> 
<script>
function view(){
  $( "#sh" ).slideToggle( "slow" );
  $( "#sh" ).css('position','absolute');
  $( "#sh" ).css('position','absolute'); 
  $('#esc').click(function(e) {
    $( "#sh" ).hide(1000);
	});
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
        <td align="center" id="zoom" onclick="view()">
         
        <img class="showr" src="<?=$ite['view']?>" width="50" />
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
		</script>
    <script>
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
       <td align="center"><img class="showr" src="<?=$ite['view']?>" width="50"/></td>
      </tr>
   <?endforeach;?> 
</table>
<table id="tab"> 
        <tr>
 <td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px;  padding: 10px;"><strong>რუბრიკები 150 000-დან 200 000-მდე ჩვენებით</strong></td>
        </tr>
        <tr> 
            <th align="center" style="color:#F60;">ლოგო/რუბრიკა</th>
            <th align="center" style="color:#F60;">მომხმარებელთა სქესი</th>
            <th align="center" style="color:#F60;">ასაკობრივი ზღვარი</th> 
        </tr> 
</table>
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
		</script> 
    <script>
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
<div id="rub"><font style="font-weight:600;"><? if(!empty($item['logo_url'])){?><img src="<?=$item['logo_url']?>" width="50"/><? } ?>&nbsp;&nbsp;<?=$item['rubric']?></font></div> 
        <div id="pie_<?=$counter?>" class="pie"></div>
         <div id="rub1"><img src="/<?=$theme?>images/blue.png" width="10" />&nbsp;&nbsp;მამრობითი<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/<?=$theme?>images/orange.png" width="10" />&nbsp;&nbsp;მდედრობითი</div>
        <div id="containerr_<?=$counter?>" class="column"></div>
     </div>
	<? $counter++;?>
    <?endforeach?>
<table id="tab">
      <tr>
       <?foreach($registry['fiveth_s'] as $item):?> 
          <td colspan="4" align="center"><?=$item['comment']?></td>
          <?endforeach?>
      </tr> 
</table>
<table id="tab" class="tab">
        <tr> 
            <th style=" padding:5px" align="center">პოზიცია</th>
            <th align="center">ზომა</th>
            <th align="center">ფასი</th>
            <th align="center">ვიზუალი</th> 
        </tr> 
        <tr>
            <th style="background-color: white; line-height: 1px;" colspan="4"> </th>
    </tr>
  
 <? 
 $i = 1;
 foreach($registry['fiveth_r'] as $ite):
 $array = array("#35b2d5","#5ec0da"); 
 if($i % 2 == 0)
 	$color = $array[0];
else
	$color = $array[1];
  $i++;
 ?> 
      <tr style="background-color:<?=$color?>; color:#FFF; font-weight:700;">
        <td align="center"><?=$ite['position']?></td>
        <td align="center"><?=$ite['size']?></td>
        <td align="center"><?=$ite['price']?></td>
        <td align="center" id="zoom"><img class="showr" src="<?=$ite['view']?>" width="50" /></td> 
      </tr>
   <?endforeach;?>  
</table> 
<table id="tab"> 
        <tr>
            <td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px;  padding: 10px;"><strong>რუბრიკები 100 000-დან 150 000-მდე  ჩვენებით</strong></td>
        </tr>
        <tr> 
           <th align="center" style="color:#F60;">ლოგო/რუბრიკა</th>
            <th align="center" style="color:#F60;">მომხმარებელთა სქესი</th>
            <th align="center" style="color:#F60;">ასაკობრივი ზღვარი</th> 
        </tr> 
</table>
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
		</script> 
                
              <script>
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
        <div id="rub"><font style="font-weight:600;"><? if(!empty($item['logo_url'])){?><img src="<?=$item['logo_url']?>" width="50"/><? } ?>&nbsp;&nbsp;<?=$item['rubric']?></font></div> 
        <div id="pie_<?=$counter?>" class="pie"></div>
         <div id="rub1"><img src="/<?=$theme?>images/blue.png" width="10" />&nbsp;&nbsp;მამრობითი<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/<?=$theme?>images/orange.png" width="10" />&nbsp;&nbsp;მდედრობითი</div>
        <div id="containerr_<?=$counter?>" class="column"></div>
     </div>
	<? $counter++;?>
    <?endforeach?>
<table id="tab">
      <tr>
       <?foreach($registry['sixth_s'] as $item):?> 
          <td colspan="4" align="center"><?=$item['comment']?></td>
          <?endforeach?>
      </tr> 
</table>
<table id="tab" class="tab">
        <tr> 
            <th style=" padding:5px" align="center">პოზიცია</th>
            <th align="center">ზომა</th>
            <th align="center">ფასი</th>
            <th align="center">ვიზუალი</th> 
        </tr> 
        <tr>
            <th style="background-color: white; line-height: 1px;" colspan="4"> </th>
    </tr>
  
 <? 
 $i = 1;
 foreach($registry['sixth_r'] as $ite):
 $array = array("#35b2d5","#5ec0da"); 
 if($i % 2 == 0)
 	$color = $array[0];
else
	$color = $array[1];
  $i++;
 ?> 
      <tr style="background-color:<?=$color?>; color:#FFF; font-weight:700;">
        <td align="center"><?=$ite['position']?></td>
        <td align="center"><?=$ite['size']?></td>
        <td align="center"><?=$ite['price']?></td>
        <td align="center" id="zoom"><img class="showr" src="<?=$ite['view']?>" width="50" /></td> 
      </tr>
   <?endforeach;?>  
</table> 
<table id="tab"> 
        <tr>
            <td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px;  padding: 10px;"><strong>რუბრიკები 50 000-დან 100 000-მდე  ჩვენებით</strong></td>
        </tr>
        <tr> 
             <th align="center" style="color:#F60;">ლოგო/რუბრიკა</th>
            <th align="center" style="color:#F60;">მომხმარებელთა სქესი</th>
            <th align="center" style="color:#F60;">ასაკობრივი ზღვარი</th>  
        </tr> 
</table>
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
		</script> 
                
              <script>
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
        <div id="rub"><font style="font-weight:600;"><? if(!empty($item['logo_url'])){?><img src="<?=$item['logo_url']?>" width="50"/><? } ?>&nbsp;&nbsp;<?=$item['rubric']?></font></div> 
        <div id="pie_<?=$counter?>" class="pie"></div>
         <div id="rub1"><img src="/<?=$theme?>images/blue.png" width="10" />&nbsp;&nbsp;მამრობითი<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/<?=$theme?>images/orange.png" width="10" />&nbsp;&nbsp;მდედრობითი</div>
        <div id="containerr_<?=$counter?>" class="column"></div>
     </div>
	<? $counter++;?>
    <?endforeach?>
<table id="tab">
      <tr>
       <?foreach($registry['seventh_s'] as $item):?> 
          <td colspan="4" align="center"><?=$item['comment']?></td>
          <?endforeach?>
      </tr> 
</table>
<table id="tab" class="tab">
        <tr> 
            <th style=" padding:5px" align="center">პოზიცია</th>
            <th align="center">ზომა</th>
            <th align="center">ფასი</th>
            <th align="center">ვიზუალი</th> 
        </tr> 
        <tr>
            <th style="background-color: white; line-height: 1px;" colspan="4"> </th>
    </tr>
  
 <? 
 $i = 1;
 foreach($registry['seventh_r'] as $ite):
 $array = array("#35b2d5","#5ec0da"); 
 if($i % 2 == 0)
 	$color = $array[0];
else
	$color = $array[1];
  $i++;
 ?> 
      <tr style="background-color:<?=$color?>; color:#FFF; font-weight:700;">
        <td align="center"><?=$ite['position']?></td>
        <td align="center"><?=$ite['size']?></td>
        <td align="center"><?=$ite['price']?></td>
        <td align="center" id="zoom"><img class="showr" src="<?=$ite['view']?>" width="50" /></td> 
      </tr>
   <?endforeach;?>  
</table> 
<table id="tab"> 
        <tr> 
            <td colspan="5" align="center" style="background-color:#27bfc4; color:#FFF; font-size:20px;  padding: 10px;"><strong>რუბრიკები 30 000-დან 50 000-მდე  ჩვენებით</strong></td>
        </tr>
        <tr> 
             <th align="center" style="color:#F60;">ლოგო/რუბრიკა</th>
            <th align="center" style="color:#F60;">მომხმარებელთა სქესი</th>
            <th align="center" style="color:#F60;">ასაკობრივი ზღვარი</th>  
        </tr> 
 </table>
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
		</script> 
             <script>
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
        <div id="rub"><font style="font-weight:600;"><? if(!empty($item['logo_url'])){?><img src="<?=$item['logo_url']?>" width="50"/><? } ?>&nbsp;&nbsp;<?=$item['rubric']?></font></div> 
        <div id="pie_<?=$counter?>" class="pie"></div>
         <div id="rub1"><img src="/<?=$theme?>images/blue.png" width="10" />&nbsp;&nbsp;მამრობითი<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/<?=$theme?>images/orange.png" width="10" />&nbsp;&nbsp;მდედრობითი</div>
        <div id="containerr_<?=$counter?>" class="column"></div>
     </div>
	<? $counter++;?>
    <?endforeach?>
<table id="tab">
      <tr>
       <?foreach($registry['eightth_s'] as $item):?> 
          <td colspan="4" align="center"><?=$item['comment']?></td>
          <?endforeach?>
      </tr> 
</table>
<table id="tab" class="tab">
        <tr> 
            <th style=" padding:5px" align="center">პოზიცია</th>
            <th align="center">ზომა</th>
            <th align="center">ფასი</th>
            <th align="center">ვიზუალი</th> 
        </tr> 
        <tr>
            <th style="background-color: white; line-height: 1px;" colspan="4"> </th>
    </tr>
  
 <? 
 $i = 1;
 foreach($registry['eightth_r'] as $ite):
 $array = array("#35b2d5","#5ec0da"); 
 if($i % 2 == 0)
 	$color = $array[0];
else
	$color = $array[1];
  $i++;
 ?> 
      <tr style="background-color:<?=$color?>; color:#FFF; font-weight:700;">
        <td align="center"><?=$ite['position']?></td>
        <td align="center"><?=$ite['size']?></td>
        <td align="center"><?=$ite['price']?></td>
        <td align="center" id="zoom"><img class="showr" src="<?=$ite['view']?>" width="50" /></td> 
      </tr>
   <?endforeach;?>  
</table> 
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
</div>
</div>
