<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../includes/config.php");
require_once("../../includes/class.resizepic.php");
// Define a destination
if(!empty($_SESSION['admin_login']) || !empty($_SESSION['user_login']) || !empty($_SESSION['area_login']) || !empty($_SESSION['smp_login']) || !empty($_SESSION['clus_login']) ){
// Define a destination
$targetFolder = WEB_PATH_FILE_PRO; // Relative to the root
$TIMESTAMP = time();
if (empty($_FILES['input-b7']) ) {
//	echo json_encode(['error'=>'No files found for upload.']);
		echo json_encode('');
// or you can throw an exception
//return; // terminate
} else {
// get the files posted
//$images = $_FILES['avatar-1'];
//$nombre_img2=$images['name'];
//echo json_encode(['success'=>'SI LLEGA y es el fileinput con nombre de archivo:'. $nombre_img2]);
$date_array = explode(".",$_FILES['input-b7']['name']);
$File1=$date_array[0];
$File2=$date_array[1];

$tempFile = $_FILES['input-b7']['tmp_name'];
$targetPath = $targetFolder;
$targetFile = $targetFolder . $TIMESTAMP.'.'.$File2;
		move_uploaded_file($tempFile,$targetFile);
//		echo json_encode(['success'=>'Success']);
		echo json_encode($TIMESTAMP.'.'.$File2);

}

}
?>