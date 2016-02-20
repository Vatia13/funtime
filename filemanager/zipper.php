<?php
session_start();
if(empty($_SESSION['userSessionValue']))
	die('No direct script allowed');





$archive_name = "../zipped/archive.zip"; // name of zip file
$archive_folder = '../img/uploads/files/'.$_GET['dir'].'/'; // the folder which you archivate

function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}

Zip($archive_folder, $archive_name);



header("Content-type: application/zip"); 
header("Content-Disposition: attachment; filename=".(end(split('/',$_GET['dir']))).'.zip');
header("Content-length: " . filesize($archive_name));
header("Pragma: no-cache"); 
header("Expires: 0"); 
readfile("$archive_name");


unlink($archive_name);

?>