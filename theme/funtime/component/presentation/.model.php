<? defined('_JEXEC') or die('Restricted access');

$test1 = 'SELECT * FROM `osr_presentation` LIMIT 1';
$registry['test1'] = getAllcache($test1,3600,'presentation'); 

$test = 'SELECT * FROM `osr_presentation`';
$registry['test'] = getAllcache($test,3600,'presentation'); 


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

$fiveth = 'SELECT * FROM `osr_diagrams` WHERE stat=5';
$registry['fiveth'] = getAllcache($fiveth,3600,'presentation');

$fiveth_r = 'SELECT * FROM `osr_presentation` WHERE stat=5';
$registry['fiveth_r'] = getAllcache($fiveth_r,3600,'presentation'); 

$fiveth_s = 'SELECT comment FROM `osr_presentation` WHERE stat=5 LIMIT 1' ;
$registry['fiveth_s'] = getAllcache($fiveth_s,3600,'presentation');

$sixth = 'SELECT * FROM `osr_diagrams` WHERE stat=6';
$registry['sixth'] = getAllcache($sixth,3600,'presentation');

$sixth_r = 'SELECT * FROM `osr_presentation` WHERE stat=6';
$registry['sixth_r'] = getAllcache($sixth_r,3600,'presentation');

$sixth_s = 'SELECT comment FROM `osr_presentation` WHERE stat=6 LIMIT 1' ;
$registry['sixth_s'] = getAllcache($sixth_s,3600,'presentation'); 

$seventh = 'SELECT * FROM `osr_diagrams` WHERE stat=7';
$registry['seventh'] = getAllcache($seventh,3600,'presentation');

$seventh_r = 'SELECT * FROM `osr_presentation` WHERE stat=7';
$registry['seventh_r'] = getAllcache($seventh_r,3600,'presentation');

$seventh_s = 'SELECT comment FROM `osr_presentation` WHERE stat=7 LIMIT 1' ;
$registry['seventh_s'] = getAllcache($seventh_s,3600,'presentation'); 

$eightth = 'SELECT * FROM `osr_diagrams` WHERE stat=8';
$registry['eightth'] = getAllcache($eightth,3600,'presentation');

$eightth_r = 'SELECT * FROM `osr_presentation` WHERE stat=8';
$registry['eightth_r'] = getAllcache($eightth_r,3600,'presentation');

$eightth_s = 'SELECT comment FROM `osr_presentation` WHERE stat=8 LIMIT 1' ;
$registry['eightth_s'] = getAllcache($eightth_s,3600,'presentation'); 

$nine = 'SELECT * FROM `osr_singlearticle`';
$registry['nine'] = getAllcache($nine,3600,'presentation');