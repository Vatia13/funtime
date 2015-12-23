<? defined('_JEXEC') or die('Restricted access');
if(isset($_POST['action']) == 'get_stat'){
    if($_POST['stat'] > 0){
		
		$co = 'SELECT COUNT(ID) as counta FROM osr_presentation WHERE stat ='.intval($_POST['stat']).' and rubric_id = '.intval($_POST['rub']).'';
		$counta = getAllcache($co,3600,'presentation'); 
		$count = $counta[0]['counta'];
		if($count<=7){
			$size = 'height: 100px; font-size: 20px; color: #F60; background-color:<?=$color?>; font-weight:700;';
			}elseif($count<=15){ 
				$size = 'height: 20px; font-size: 20px; color: #F60; background-color:<?=$color?>; font-weight:700;'; 
				}
				
						
 $test ='SELECT DISTINCT osr_presentation.position,osr_presentation.size,osr_presentation.price,cat_id,osr_presentation.stat, finished_at,status,osr_presentation.scroll_position FROM osr_banner_list INNER JOIN osr_category ON osr_banner_list.cat_id=osr_category.id INNER JOIN osr_presentation on osr_presentation.rubric_id = osr_category.id  WHERE osr_presentation.stat='.intval($_POST['stat']).' AND cat_id='.intval($_POST['rub']).'  AND scroll_position>0';
     $registry['test'] = getAllcache($test,3600,'presentation');
		 $i = 1;
		$arr =array();
		 foreach($registry['test'] as $item): 
		 $array = array("#baeaec","#27bfc4"); 
		 if($i % 2 == 0)
			$color = $array[0];
		else
			$color = $array[1];
		$i++; 
		if($item['status']==2){
		 	$saled ="<img src='../../../../apanel/images/saled.png'/> "; 
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





