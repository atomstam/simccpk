<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/function.in.php");
require_once("../../../includes/class.mysql.php");
$db = New DB();
$add='';
$edit='';
$del='';
//$Avatar='';
CheckAdminGroup($_SESSION['admin_login'],$_SESSION['admin_pwd'],$_SESSION['admin_group']); 
if(!empty($_SESSION['admin_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['aff_point'] !='' && $_POST['aff_name'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$add .=$db->add_db(TB_AFFAIRS,array(
			"aff_area"=>"".$_SESSION['admin_area']."",
			"aff_code"=>"".$_SESSION['admin_school']."",
			"aff_Stime"=>"".$_POST['aff_Stime']."",
			"aff_Ftime"=>"".$_POST['aff_Ftime']."",
			"aff_name"=>"".$_POST['aff_name']."",
			"aff_point"=>"".$_POST['aff_point'].""
		));
	} else {
		$add .='';
	}

	if($add){
		$successx = "Success";
		@$responseArray = array('type' => 'success', 'message' => $successx);
		$encoded = json_encode(@$responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	} else {
		$error_warningx = "Error";
		//echo $error_warning;
		@$responseArray = array('type' => 'danger', 'message' => $error_warningx);
		$encoded = json_encode(@$responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	}

} 

if($_POST['OP']=='Edit'){
	if( $_POST['aff_point'] !='' && $_POST['aff_name'] !='' ){//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$edit .=$db->update_db(TB_AFFAIRS,array(
			"aff_area"=>"".$_SESSION['admin_area']."",
			"aff_code"=>"".$_SESSION['admin_school']."",
			"aff_Stime"=>"".$_POST['aff_Stime']."",
			"aff_Ftime"=>"".$_POST['aff_Ftime']."",
			"aff_name"=>"".$_POST['aff_name']."",
			"aff_point"=>"".$_POST['aff_point'].""
		)," aff_id=".$_POST['CLID']." ");
	} else {
		$edit ='';
	}

	if($edit){
		$successx = "Success";
		@$responseArray = array('type' => 'success', 'message' => $successx);
		$encoded = json_encode(@$responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	} else {
		$error_warningx = "Error";
		//echo $error_warning;
		@$responseArray = array('type' => 'danger', 'message' => $error_warningx);
		$encoded = json_encode(@$responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	}

}


} else { echo "<meta http-equiv='refresh' content='1; url=../../index.php'>"; 

}?>