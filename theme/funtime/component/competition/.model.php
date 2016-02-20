<? defined('_JEXEC') or die('Restricted access');
if(isset($_POST['fname'])){
	$user_ip = getIP();
	$today = date("Y-m-d H:i:s"); 
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$age = $_POST['age'];
	$phone = $_POST['phone'];
	$insert = "INSERT INTO #__competition(id,fname,lname,age,phone,user_ip,insert_date) 				    VALUES('','$fname','$lname','$age','$phone','$user_ip','$today')";
	echo '<p align="center" style="font-weight:800; color: rgb(255, 96, 0);">თქვენ წარმატებით გაიარეთ რეგისტრაცია. მადლობას გიხდით კონკურსში მონაწილეობისთვის. შერჩეულ კონკურსანტებს დაგიკავშირდებით მითითებულ ნომრებზე.</p><br><br>';
	$DB->execute($insert); 
	$query_ID = "SELECT * FROM `osr_competition` ORDER by ID desc LIMIT 1";
	$registry['query_ID'] =  $DB->getOne($query_ID); 
	 
	?>
    	<script>
			$('.inpp').hide();
			$('#upload').hide();
		</script>
    <?
	
$_POST['full_name'] = $fname.' '.$lname;

$folder_temp = '/var/www/virtual/funtime.ge/htdocs/comp_temp/';
$folder = '/var/www/virtual/funtime.ge/htdocs/img/uploads/images/competition/';
$folderThumb = '/var/www/virtual/funtime.ge/htdocs/img/uploads/files/competition/';

if(!is_dir($folder.$registry['query_ID'].'_'.$_POST['full_name']))
	mkdir($folder.$registry['query_ID'].'_'.$_POST['full_name']);
	
if(!is_dir($folderThumb.$registry['query_ID'].'_'.$_POST['full_name']))
	mkdir($folderThumb.$registry['query_ID'].'_'.$_POST['full_name']);   


$folder .= $registry['query_ID'].'_'.$_POST['full_name'].'/';
$folderThumb .= $registry['query_ID'].'_'.$_POST['full_name'].'/';
$folder_temp .= $_POST['full_name'].'/';

chmod($folder, 0777);
chmod($folderThumb, 0777);

// Returns array of files
$files1 = scandir($folder);

// Count number of files and store them to variable..
$num_files = count($files1)-1;

if($num_files > 5){
	echo '{"status":"error"}';
	die();
}

function copy_directory($src,$dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

copy_directory($folder_temp, $folder);
copy_directory($folder_temp, $folderThumb);		 

die();
}
?>