<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../includes/config.php");
require_once("../../includes/class.resizepic.php");
// Define a destination
if(!empty($_SESSION['admin_login']) || !empty($_SESSION['user_login']) || !empty($_SESSION['area_login']) || !empty($_SESSION['smp_login']) || !empty($_SESSION['clus_login']) ){
// Define a destination
$targetFolder = WEB_PATH_UPLOAD; // Relative to the root
$TIMESTAMP = time();
if (empty($_FILES['input-b7'])) {
//	echo json_encode(['error'=>'No files found for upload.']);
		echo json_encode('No files found for upload. Or File not format .xlsx .xls .csv');
// or you can throw an exception
//return; // terminate
} else {
$date_array = explode(".",$_FILES['input-b7']['name']);
$File1=$date_array[0];
$File2=$date_array[1];

$tempFile = $_FILES['input-b7']['tmp_name'];
$targetPath = $targetFolder;
$targetFile = $targetFolder . "per_".$_SESSION['area_code'].".".$File2;
		move_uploaded_file($tempFile,$targetFile);
//		echo json_encode(['success'=>'Success']);
		echo json_encode("per_".$_SESSION['area_code'].".".$File2);

}

}
?>