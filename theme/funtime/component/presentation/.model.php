<? defined('_JEXEC') or die('Restricted access');
if(isset($_POST['action']) == 'get_stat'){
    if($_POST['stat'] > 0){
		
		$co = 'SELECT COUNT(ID) as counta FROM osr_presentation WHERE stat ='.intval($_POST['stat']).' and rubric_id = '.intval($_POST['rub']);
		$counta = getAllcache($co,3600,'presentation'); 
		$count = $counta[0]['counta'];
		if($count<=7){
			$size = 'height: 100px; font-size: 20px; color: #F60; background-color:<?=$color?>; font-weight:700;';
			}elseif($count<=15){ 
				$size = 'height: 20px; font-size: 20px; color: #F60; background-color:<?=$color?>; font-weight:700;'; 
				}
				
						
     $test ='SELECT a.size,a.price,a.rubric_id,a.stat,a.scroll_position,a.position FROM
               #__presentation as a
               WHERE a.stat='.intval($_POST['stat']).' AND a.rubric_id='.intval($_POST['rub']).'  AND a.scroll_position>0';
     $registry['test'] = $DB->getAll($test);
		if(count($registry['test']) > 0){
			foreach($registry['test'] as $key=>$t):
				$registry['pres_banner'][$t['position']]['size'] = $t['size'];
			    $registry['pres_banner'][$t['position']]['price'] = $t['price'];
				$registry['pres_banner'][$t['position']]['rubric_id'] = $t['rubric_id'];
				$registry['pres_banner'][$t['position']]['stat'] = $t['stat'];
				$registry['pres_banner'][$t['position']]['scroll_position'] = $t['scroll_position'];
				$registry['pres_banner'][$t['position']]['position'] = $t['position'];
				$registry['pres_banner'][$t['position']]['status'] = 0;
				$registry['pres_banner'][$t['position']]['finished_at'] = 0;
			    $registry['pres_positions'][] = $t['position'];
			endforeach;
		}

		$registry['banner_list'] = $DB->getAll('SELECT status,finished_at,cat_id,title FROM #__banner_list WHERE type != 0 and cat_id = "'.intval($_POST['rub']).'" group by title');
        if(count($registry['banner_list']) > 0){
			foreach($registry['banner_list'] as $b):
				$registry['pres_banner'][$b['title']]['status'] = $b['status'];
				$registry['pres_banner'][$b['title']]['finished_at'] = $b['finished_at'];
			endforeach;
		}

		print_r($registry['pres_banner']);

		 $i = 1;
		$arr =array();
		 foreach($registry['pres_banner'] as $item):
		 $array = array("#baeaec","#27bfc4"); 
		 if($i % 2 == 0)
			$color = $array[0];
		else
			$color = $array[1];
		$i++; 
		if($item['status']==2){
		 	$saled ="<img src='../../../../apanel/images/saled.png'/> "; 
		 }else{
			$saled ="Free";
		}
		 ?> 
         
            <tr onclick="scrollWin(<?=$item['scroll_position']?>, '<?=$item['position']?>')" style="background-color:<?=$color?>; <?=$size?> "> 
            <td align="center"><?=$item['position']?></td>
            <td align="center"><?=$item['size']?></td>
            <td align="center"><?=$item['price']?></td>
				<td align="center"><?=$saled?></td>
            </tr>
		   <?endforeach;?> 
	 <?	 
        die();
    }
}  
$test1 = 'SELECT * FROM `osr_presentation` WHERE stat=5 AND scroll_position>0 LIMIT 1';
$registry['test1'] = getAllcache($test1,3600,'presentation'); 

$first = 'SELECT * FROM `osr_googleanalytics` WHERE stat=0';
$registry['first'] = getAllcache($first,3600,'presentation'); 

$second = 'SELECT * FROM `osr_presentation` WHERE stat=0';
$registry['second'] = getAllcache($second,3600,'presentation'); 

$therd = 'SELECT * FROM `osr_googleanalytics` WHERE stat=1';
$registry['therd'] = getAllcache($therd,3600,'presentation'); 

$fourth = 'SELECT * FROM `osr_diagrams` WHERE stat=4';
$registry['fourth'] = getAllcache($fourth,3600,'presentation');  

$fourth_p = 'SELECT * FROM `osr_presentation` WHERE stat=1';
$registry['fourth_p'] = getAllcache($fourth_p,3600,'presentation'); 


$fiveth = 'SELECT *
FROM osr_diagrams
INNER JOIN osr_presentation
ON osr_diagrams.rubric_id=osr_presentation.rubric_id and osr_diagrams.stat = osr_presentation.stat
WHERE osr_diagrams.stat = 5
GROUP by osr_presentation.rubric_id';
$registry['fiveth'] = getAllcache($fiveth,3600,'presentation');
 
$coment5 = 'SELECT comment FROM `osr_presentation` WHERE stat=5 LIMIT 1';
$registry['coment5'] = getAllcache($coment5,3600,'presentation'); 



$sixth = 'SELECT *
FROM osr_diagrams
INNER JOIN osr_presentation
ON osr_diagrams.rubric_id=osr_presentation.rubric_id and osr_diagrams.stat = osr_presentation.stat
WHERE osr_diagrams.stat = 6
GROUP by osr_presentation.rubric_id';
$registry['sixth'] = getAllcache($sixth,3600,'presentation');

$comment6 = 'SELECT comment FROM `osr_presentation` WHERE stat=6 LIMIT 1';
$registry['comment6'] = getAllcache($comment6,3600,'presentation');


$seventh = 'SELECT *
FROM osr_diagrams
INNER JOIN osr_presentation
ON osr_diagrams.rubric_id=osr_presentation.rubric_id and osr_diagrams.stat = osr_presentation.stat
WHERE osr_diagrams.stat = 7
GROUP by osr_presentation.rubric_id';
$registry['seventh'] = getAllcache($seventh,3600,'presentation');

$comment7 = 'SELECT comment FROM `osr_presentation` WHERE stat=7 LIMIT 1';
$registry['comment7'] = getAllcache($comment7,3600,'presentation');


$eightth = 'SELECT *
FROM osr_diagrams
INNER JOIN osr_presentation
ON osr_diagrams.rubric_id=osr_presentation.rubric_id and osr_diagrams.stat = osr_presentation.stat
WHERE osr_diagrams.stat = 8
GROUP by osr_presentation.rubric_id';
$registry['eightth'] = getAllcache($eightth,3600,'presentation');

$comment8 = 'SELECT comment FROM `osr_presentation` WHERE stat=8 LIMIT 1';
$registry['comment8'] = getAllcache($comment8,3600,'presentation');
 


$nine = 'SELECT * FROM `osr_singlearticle`';
$registry['nine'] = getAllcache($nine,3600,'presentation');





