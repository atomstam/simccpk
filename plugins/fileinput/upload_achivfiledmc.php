<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../includes/config.php");
require_once("../../includes/class.resizepic.php");
// Define a destination
if(!empty($_SESSION['admin_login']) ){
// Define a destination
$targetFolder = WEB_PATH_UPLOAD; // Relative to the root
$TIMESTAMP = time();


if (!empty($_FILES['input-b7'])) {
$date_array = explode(".",$_FILES['input-b7']['name']);
$File1=$date_array[0];
$File2=$date_array[1];

$tempFile = $_FILES['input-b7']['tmp_name'];
$targetPath = $targetFolder;
$targetFile = $targetFolder . "achiev_dmc_".$_SESSION['admin_area']."_".$_SESSION['admin_school'].".".$File2;
		move_uploaded_file($tempFile,$targetFile);
//		echo json_encode(['success'=>'Success']);
		echo json_encode("achiev_dmc_".$_SESSION['admin_area']."_".$_SESSION['admin_school'].".".$File2);

}

}
?>