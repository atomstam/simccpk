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
	if( $_POST['mo_id'] !='' && $_POST['Class_name'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$add .=$db->add_db(TB_MOTOR,array(
			"mo_id"=>"".$_POST['mo_id']."",
			"mo_name"=>"".$_POST['Class_name'].""
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
	if( $_POST['CLID'] !='' && $_POST['Class_name'] !='' ){//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$edit .=$db->update_db(TB_MOTOR,array(
			"mo_name"=>"".$_POST['Class_name'].""
		)," mo_id=".$_POST['CLID']." ");
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