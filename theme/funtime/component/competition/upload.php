<?php //defined('_JEXEC') or die('Restricted access');
// A list of permitted file extensions
$allowed = array('png', 'jpg');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){ 
		echo '<p align="center">არასწორი ფაილია მითითებული გთხოვთ ატვირთოთ თავიდან JPG ან PNG ფორმატის ფაილი</p>';
		exit;
	}
//$folder = '/var/www/virtual/funtime.ge/htdocs/img/uploads/images/competition/';
//$folderThumb = '/var/www/virtual/funtime.ge/htdocs/img/uploads/files/competition/';

$folder = '/var/www/virtual/funtime.ge/htdocs/comp_temp/';

if(!is_dir($folder.$_POST['full_name']))
	mkdir($folder.$_POST['full_name']);
	
//if(!is_dir($folderThumb.$_POST['full_name']))
//	mkdir($folderThumb.$_POST['full_name']);   

$folder .= $_POST['full_name'].'/';
//$folderThumb .= $_POST['full_name'].'/';

chmod($folder, 0777);
//chmod($folderThumb, 0777);

// Returns array of files
$files1 = scandir($folder);

// Count number of files and store them to variable..
$num_files = count($files1)-1;

if($num_files > 5){
	echo '<p align="center">ფაილების რაოდენობა მეტია 5-ზე</p>';
	die();
}

	if(move_uploaded_file($_FILES['upl']['tmp_name'], $folder.$num_files.'.'.$extension)){
		//copy($folder.$num_files.'.'.$extension, 
		//$folderThumb.$num_files.'.'.$extension);
		
		echo '{"status":"success"}';
		exit;
	}
}  
exit;
?>