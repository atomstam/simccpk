<?php 
ob_start();
if (session_id() =='') { @session_start(); }
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/classlist.php");
$db = New DB();

if(!empty($_SESSION['admin_login'])){
$add='';
$success='';
$error_warning='';
$data=array();

//		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//		$add.=$db->del(TB_CLASS," class_id='".$_GET['class_id']."' ");
//		$add .=$_POST['StuID']."";
//		$add .=$_POST['ClassID']."<br>";
//		$add .=$_POST['StuID']."<br>";
//		if($add){
		$success= "Success";
		echo $success;
//		} else {
//		$error_warning="NO";
//		echo $error_warning;
//		}

//if ( ! empty($errors)) {
//        $data['success'] = false;
//        $data['errors']  = $errors;
//} else {
//        $data['success'] = true;
//        $data['message'] = 'Success';
//}
//echo json_encode($data);
} else { echo "<meta http-equiv='refresh' content='1; url=index.php'>"; }

?>



