<?php defined('_JEXEC') or die('Restricted access');
if(get_access('admin','presentation','view')):
//$sql = "SELECT count(id) FROM #__news WHERE cat = 116";
//$registry['rubrics'] = $DB->getOne($sql); // 1 chanaweris gamotana
//$sql = "SELECT id,title FROM #__news WHERE cat = 116 LIMIT 10";
//$registry['news'] = $DB->getAll($sql); // array chanawerebis gamotana
//$registry['news'] = getAllcache($sql,600,'presentation/all','../'); // array chanawerebis gamotana cshireba
if (isset($_GET['test'])){
	$rubric_id = $_GET['rubric_id'];
	$stat = $_GET['rubstat'];
	foreach($_GET['points'] as $key => $value){ 
		$position = $value['position'];
		$size = $value['size'];
		$price = $value['price'];
		$point = $value['point'];
		$view = $_GET['img_url']; 
		$insert = "INSERT INTO #__presentation(id,position,size,price,view,rubric_id,scroll_position,stat) VALUES('','$position','$size','$price','$view','$rubric_id','$point','$stat')";
		$DB->execute($insert);
		
		$update = "UPDATE #__diagrams SET view_img='$view' WHERE rubric_id=0";
		$DB->execute($update);
		$update = "UPDATE #__diagrams SET rubric_id='$rubric_id' WHERE rubric_id=0";
		$DB->execute($update);
header('location:/apanel/index.php?component=presentation&sec=10');
	}
}
if(isset($_GET['sec']) && ($_GET['sec']!=1 || $_GET['sec']!=2 || $_GET['sec']!=3 || $_GET['sec']!=10) ){
	$showpie = 'SELECT * FROM `osr_diagrams`  WHERE stat='.$_GET["sec"].'';
	//print_r($showpie);
	 $registry['showpie'] =  $DB->getAll($showpie); 
}

if (isset($_GET['comm'])){
	$comment = $_GET['comment'];
	$update ="UPDATE #__presentation SET comment='$comment' WHERE stat=".$_GET['comm']."";
	$DB->execute($update);
	header("location:/apanel/index.php?component=presentation&sec=".$_GET['comm']."");
}
if (isset($_GET['sec'])){
$show_comment = "SELECT * FROM `osr_presentation`  WHERE stat=".$_GET['sec']." LIMIT 1";
$registry['show_comment'] =  $DB->getAll($show_comment);
}
/*N1-N3 სტატისტიკა*/
 if (isset($_GET['googleanalytics']) && $_GET['googleanalytics']==0){ 
 	$url = $_GET['image'];
	$insert =  "INSERT INTO #__googleanalytics(id,url,stat) VALUES ('','$url','0')"; 
	$DB->execute($insert);
    header('location:/apanel/index.php?component=presentation&sec=1');
 }
  if (isset($_GET['googleanalytics']) && $_GET['googleanalytics']==1){ 
 	$url = $_GET['image'];
	$insert =  "INSERT INTO #__googleanalytics(id,url,stat) VALUES ('','$url','1')"; 
	$DB->execute($insert);
    header('location:/apanel/index.php?component=presentation&sec=3');
 }
 if (isset($_GET['del_statistic']) && $_GET['del_statistic']==0){
 	 $statdel = 'DELETE FROM `osr_googleanalytics` WHERE stat=0';
	 $DB->execute($statdel);
	 header('location:/apanel/index.php?component=presentation&sec=1');
 }
  if (isset($_GET['del_statistic']) && $_GET['del_statistic']==1){
 	 $statdel = 'DELETE FROM `osr_googleanalytics` WHERE stat=1';
	 $DB->execute($statdel);
	 header('location:/apanel/index.php?component=presentation&sec=3');
 }
$statsel = 'SELECT * FROM `osr_googleanalytics` WHERE stat=0';
$registry['statsel'] =  $DB->getAll($statsel);
$statsel1 = 'SELECT * FROM `osr_googleanalytics` WHERE stat=1';
$registry['statsel1'] =  $DB->getAll($statsel1); 
/*N1-N3 სტატისტიკა დასასრული*/
/*N2 ბანერები*/
if (isset($_GET['add'])&&$_GET['add']==1)
		{ 
		  $position = $_GET['position'];
		  $size = $_GET['size'];
		  $price = $_GET['price']; 
		  $view = $_GET['image']; 
		 $sql = "INSERT INTO #__presentation(id,position,size,price,view,stat)  
				VALUES ('','$position','$size','$price','$view','0')"; 
		$DB->execute($sql);
		  header('location:/apanel/index.php?component=presentation&sec=2');
		}
if(isset($_GET['edit'])){ 
	$edit=$_GET["edit"];
	$edit = "SELECT * FROM #__presentation WHERE ID=$edit ";
	$registry['edit'] =  $DB->getAll($edit); 
	}
if (isset($_GET['makeEdit']) && $_GET['makeEdit']==1 )
		{ 
		  $edit=$_GET['editID'];
		  $position = $_GET['position'];
		  $size = $_GET['size'];
		  $price = $_GET['price'];
		  $view = $_GET['image']; 
		 $sql = "UPDATE #__presentation SET position='$position',size='$size',price='$price',view='$view' WHERE  ID=$edit "; 
		$DB->execute($sql);
		  header('location:/apanel/index.php?component=presentation&sec=2');
		}		
if(isset($_GET['del']) && isset($_GET['sec']) && $_GET['sec']==2){
	 $ID = $_GET['del'];
	 $sql = "DELETE FROM #__presentation where ID=$ID"; 
	 $DB->execute($sql);
	 header('location:/apanel/index.php?component=presentation&sec=2');
	}
if(isset($_GET['del']) && isset($_GET['sec']) && $_GET['sec']==4){
	 $ID = $_GET['del'];
	 $expl = explode("_",$ID);
	 $ID = $expl[0];
	 if($ID=="diagrams"){
	 $sql = "DELETE FROM #__diagrams where ID=".$expl[1].""; 
	 $DB->execute($sql);
	 header('location:/apanel/index.php?component=presentation&sec=4');
		 }else{
	 $sql = "DELETE FROM #__presentation where ID=$ID"; 
	 $DB->execute($sql);
	 header('location:/apanel/index.php?component=presentation&sec=4');
		 }
	}
if(isset($_GET['del']) && isset($_GET['sec']) && $_GET['sec']==5){
	 $ID = $_GET['del'];
	 $expl = explode("_",$ID);
	 $ID = $expl[0];
	 if($ID=="diagrams"){
	 $sql = "DELETE FROM #__diagrams where ID=".$expl[1].""; 
	 $DB->execute($sql);
	 header('location:/apanel/index.php?component=presentation&sec=5');
		 }else{
	 $sql = "DELETE FROM #__presentation where ID=$ID"; 
	 $DB->execute($sql);
	 header('location:/apanel/index.php?component=presentation&sec=5');
		 } 
	}
if(isset($_GET['del']) && isset($_GET['sec']) && $_GET['sec']==6){
	 $ID = $_GET['del'];
	 $expl = explode("_",$ID);
	 $ID = $expl[0];
	 if($ID=="diagrams"){
	 $sql = "DELETE FROM #__diagrams where ID=".$expl[1].""; 
	 $DB->execute($sql);
	 header('location:/apanel/index.php?component=presentation&sec=6');
		 }else{
	 $sql = "DELETE FROM #__presentation where ID=$ID"; 
	 $DB->execute($sql);
	 header('location:/apanel/index.php?component=presentation&sec=6');
		 } 
	}
if(isset($_GET['del']) && isset($_GET['sec']) && $_GET['sec']==7){
	 $ID = $_GET['del'];
	 $expl = explode("_",$ID);
	 $ID = $expl[0];
	 if($ID=="diagrams"){
	 $sql = "DELETE FROM #__diagrams where ID=".$expl[1].""; 
	 $DB->execute($sql);
	 header('location:/apanel/index.php?component=presentation&sec=7');
		 }else{
	 $sql = "DELETE FROM #__presentation where ID=$ID"; 
	 $DB->execute($sql);
	 header('location:/apanel/index.php?component=presentation&sec=7');
		 } 
	}
if(isset($_GET['del']) && isset($_GET['sec']) && $_GET['sec']==8){
	 $ID = $_GET['del'];
	 $expl = explode("_",$ID);
	 $ID = $expl[0];
	 if($ID=="diagrams"){
	 $sql = "DELETE FROM #__diagrams where ID=".$expl[1].""; 
	 $DB->execute($sql);
	 header('location:/apanel/index.php?component=presentation&sec=8');
		 }else{
	 $sql = "DELETE FROM #__presentation where ID=$ID"; 
	 $DB->execute($sql);
	 header('location:/apanel/index.php?component=presentation&sec=8');
		 } 
	}
$show = 'SELECT * FROM `osr_presentation`  WHERE stat=0';
$registry['show'] =  $DB->getAll($show);
/*N2 ბანერები დასასრული*/
/*N4 რუბრიკა  „საკნატუნო ამბები“*/
if (isset($_GET['add_pie']) && $_GET['add_pie']==1){
		$rubrica=$_GET['rubrica'];
		$male=$_GET['male'];
		$to25=$_GET['to25'];
		$bet2544 = $_GET['bet2544'];
		$logo_url = $_GET['image'];   
		$insert = "INSERT INTO #__diagrams(id,male,to25,bet2544,stat,rubric,logo_url)  
				VALUES ('','$male','$to25','$bet2544','4','$rubrica','$logo_url')";
		$DB->execute($insert);
		 header('location:/apanel/index.php?component=presentation&sec=4');

}

/*N4 რუბრიკა  „საკნატუნო ამბები“ დასასრული*/
/*N5 რუბრიკები 150 000-დან 200 000-მდე  ჩვენებით*/
$rubric =   'SELECT * FROM `osr_category` WHERE stat = \'0\' ORDER BY name';
$registry['rubric'] =  $DB->getAll($rubric);
if (isset($_GET['add_pie_15']) && $_GET['add_pie_15']==1){
	 	$rubrica=$_GET['rubrica'];
		$male=$_GET['male'];
		$to25=$_GET['to25'];
		$bet2544 = $_GET['bet2544'];
		$logo_url = $_GET['image'];   
		$insert = "INSERT INTO #__diagrams(id,male,to25,bet2544,stat,rubric,logo_url)  
				VALUES ('','$male','$to25','$bet2544','5','$rubrica','$logo_url')";
		$DB->execute($insert);
		 header('location:/apanel/index.php?component=presentation&sec=5');

} 
/*N5 რუბრიკები 150 000-დან 200 000-მდე  ჩვენებით დასასრული*/
/*N6 რუბრიკები 100 000-დან 150 000-მდე  ჩვენებით*/
if (isset($_GET['add_pie_10']) && $_GET['add_pie_10']==1){
	 	$rubrica=$_GET['rubrica'];
		$male=$_GET['male'];
		$to25=$_GET['to25'];
		$bet2544 = $_GET['bet2544'];  
		$logo_url = $_GET['image']; 
		$insert = "INSERT INTO #__diagrams(id,male,to25,bet2544,stat,rubric,logo_url)  
				VALUES ('','$male','$to25','$bet2544','6','$rubrica','$logo_url')";
		$DB->execute($insert);
		 header('location:/apanel/index.php?component=presentation&sec=6');

}
/*N6 რუბრიკები 100 000-დან 150 000-მდე  ჩვენებით დასასრული*/
/*N7 რუბრიკები 50 000-დან 100 000-მდე  ჩვენებით*/
if (isset($_GET['add_pie_50']) && $_GET['add_pie_50']==1){
	 	$rubrica=$_GET['rubrica'];
		$male=$_GET['male'];
		$to25=$_GET['to25'];
		$bet2544 = $_GET['bet2544']; 
		$logo_url = $_GET['image'];  
		$insert = "INSERT INTO #__diagrams(id,male,to25,bet2544,stat,rubric,logo_url)  
				VALUES ('','$male','$to25','$bet2544','7','$rubrica','$logo_url')";
		$DB->execute($insert);
		 header('location:/apanel/index.php?component=presentation&sec=7');

}
/*N7 რუბრიკები 50 000-დან 100 000-მდე  ჩვენებით დასასრული*/
/*N8 რუბრიკები 50 000-დან 100 000-მდე  ჩვენებით*/
if (isset($_GET['add_pie_30']) && $_GET['add_pie_30']==1){
	 	$rubrica=$_GET['rubrica'];
		$male=$_GET['male'];
		$to25=$_GET['to25'];
		$bet2544 = $_GET['bet2544'];  
		$logo_url = $_GET['image']; 
		$insert = "INSERT INTO #__diagrams(id,male,to25,bet2544,stat,rubric,logo_url)  
				VALUES ('','$male','$to25','$bet2544','8','$rubrica','$logo_url')";
		$DB->execute($insert);
		 header('location:/apanel/index.php?component=presentation&sec=8');

}
/*N8 რუბრიკები 50 000-დან 100 000-მდე  ჩვენებით დასასრული*/
/*N9 singlearticle*/
if (isset($_GET['single_article']) && $_GET['single_article']==1){
		  $price = $_GET['price']; 
		  $rubrica = $_GET['rubrica']; 
		  $sql = "INSERT INTO #__singlearticle(id,price,rubric)  
				VALUES ('','$price','$rubrica')"; 
		  $DB->execute($sql);
		  header('location:/apanel/index.php?component=presentation&sec=9');
}
if (isset($_GET['delete'])){	 
	 $sql = "DELETE FROM #__singlearticle where ID=".$_GET['delete'].""; 
	 $DB->execute($sql);
	 header('location:/apanel/index.php?component=presentation&sec=9');
	
	}
if (isset($_GET['edit_article'])){	
$article_foredit = 'SELECT * FROM `osr_singlearticle` WHERE id='.$_GET['edit_article'].'';
$registry['article_foredit'] =  $DB->getAll($article_foredit);

}
if (isset($_GET['update_article'])){	
		$price = $_GET['price']; 
		$rubric = $_GET['rubrica']; 
		$update = "UPDATE #__singlearticle SET price='$price',rubric='$rubric' WHERE id=".$_GET['update_article'].""; 
		$DB->execute($update);
		  header('location:/apanel/index.php?component=presentation&sec=9');
}

$article = 'SELECT * FROM `osr_singlearticle`';
$registry['article'] =  $DB->getAll($article);
/*N9 singlearticle end*/ 
endif;

/*edit and update*/

if (isset($_GET['edit_pie'])){
	$select = 'SELECT * FROM `osr_diagrams`  WHERE id='.$_GET['edit_pie'].' ';
	$registry['select'] =  $DB->getAll($select);

}
if (isset($_GET['update_pie'])){
	$rubrica=$_GET['rubrica'];
	$male=$_GET['male'];
	$to25=$_GET['to25'];
	$bet2544 = $_GET['bet2544']; 
	$logo_url = $_GET['image']; 
	$update ="UPDATE #__diagrams SET male='$male',to25='$to25',bet2544='$bet2544',rubric='$rubrica',logo_url='$logo_url' WHERE id=".$_GET['update_pie']."";
	$DB->execute($update);
		header('location:/apanel/index.php?component=presentation&sec='.$_GET['sec'].'');

}
if (isset($_GET['edit_ban'])){
	$select = 'SELECT * FROM `#__presentation`  WHERE id='.$_GET['edit_ban'].' ';
	$registry['select_rub'] =  $DB->getAll($select);

}
if (isset($_GET['update_ban'])){
	    $position = $_GET['position'];
		$size = $_GET['size'];
		$price = $_GET['price']; 
		$view = $_GET['image']; 
		$update = "UPDATE #__presentation SET position='$position',size='$size',price='$price',view='$view' WHERE id=".$_GET['update_ban'].""; 
		$DB->execute($update);
		  header('location:/apanel/index.php?component=presentation&sec='.$_GET['sec'].'');
}
$shows = 'SELECT * FROM osr_diagrams INNER JOIN osr_presentation ON osr_diagrams.rubric_id=osr_presentation.rubric_id and osr_diagrams.stat = osr_presentation.stat WHERE osr_diagrams.stat = '.$_GET['sec'].'';
$registry['shows'] =  $DB->getAll($shows);