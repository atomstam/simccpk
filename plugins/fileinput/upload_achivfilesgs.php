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


if (!empty($_FILES['input-b7'])) {
$date_array = explode(".",$_FILES['input-b7']['name']);
$File1=$date_array[0];
$File2=$date_array[1];

$tempFile = $_FILES['input-b7']['tmp_name'];
$targetPath = $targetFolder;
$targetFile = $targetFolder . "achiev_sgs_".$_SESSION['user_area']."_".$_SESSION['user_code'].'_term1.'.$File2;
		move_uploaded_file($tempFile,$targetFile);
//		echo json_encode(['success'=>'Success']);
		echo json_encode("achiev_sgs_".$_SESSION['user_area']."_".$_SESSION['user_code'].'_term1.'.$File2);

}

if (!empty($_FILES['input-b2'])) {
$date_array = explode(".",$_FILES['input-b2']['name']);
$File1=$date_array[0];
$File2=$date_array[1];

$tempFile = $_FILES['input-b2']['tmp_name'];
$targetPath = $targetFolder;
$targetFile = $targetFolder . "achiev_sgs_".$_SESSION['user_area']."_".$_SESSION['user_code'].'_term2.'.$File2;
		move_uploaded_file($tempFile,$targetFile);
//		echo json_encode(['success'=>'Success']);
		echo json_encode("achiev_sgs_".$_SESSION['user_area']."_".$_SESSION['user_code'].'_term2.'.$File2);

}


}
?>