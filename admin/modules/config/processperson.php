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
	if( $_POST['Firstname'] !='' && $_POST['Username'] !='' && $_POST['Password'] !='' && $_POST['CAT'] !=''){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$add .=$db->add_db(TB_PERSON,array(
			"per_area"=>"".$_SESSION['admin_area']."",
			"per_code"=>"".$_SESSION['admin_school']."",
			"per_posi"=>"".$_POST['CAT']."",
			"per_ids"=>"".$_POST['Username']."",
			"per_pin"=>"".$_POST['Password']."",
			"per_name"=>"".$_POST['Firstname']."",
			"per_email"=>"".$_POST['Email']."",
			"per_pic"=>"".$_POST['Icon']."",
			"per_tel"=>"".$_POST['Tel']."",
			"status"=>"".$_POST['Status'].""
		));
		$add .=$db->add_db(TB_CLASS_PERSON,array(
			"clper_area"=>"".$_SESSION['admin_area']."",
			"clper_code"=>"".$_SESSION['admin_school']."",
			"clper_class"=>"".$_POST['class_person']."",
			"clper_group"=>"".$_POST['class_name']."",
			"clper_tech"=>"".$_POST['Username']."",
		));

	} else {
		$add ='';
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
	if( $_POST['Firstname'] !='' && $_POST['Username'] !='' && $_POST['Password'] !='' && $_POST['CAT'] !='' && $_POST['SID'] !=''){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		if(isset($_POST['Icon'])){
		$edit=$db->update_db(TB_PERSON,array(
			"per_area"=>"".$_SESSION['admin_area']."",
			"per_code"=>"".$_SESSION['admin_school']."",
			"per_posi"=>"".$_POST['CAT']."",
			"per_ids"=>"".$_POST['Username']."",
			"per_pin"=>"".$_POST['Password']."",
			"per_name"=>"".$_POST['Firstname']."",
			"per_email"=>"".$_POST['Email']."",
			"per_pic"=>"".$_POST['Icon']."",
			"per_tel"=>"".$_POST['Tel']."",
			"status"=>"".$_POST['Status'].""
		)," per_id=".$_POST['SID']." ");
		} else {
		$edit=$db->update_db(TB_PERSON,array(
			"per_area"=>"".$_SESSION['admin_area']."",
			"per_code"=>"".$_SESSION['admin_school']."",
			"per_posi"=>"".$_POST['CAT']."",
//			"per_ids"=>"".$_POST['Username']."",
			"per_pin"=>"".$_POST['Password']."",
			"per_name"=>"".$_POST['Firstname']."",
			"per_email"=>"".$_POST['Email']."",
			"per_tel"=>"".$_POST['Tel']."",
			"status"=>"".$_POST['Status'].""
		)," per_id=".$_POST['SID']." ");
		}

		$edit .=$db->del(TB_CLASS_PERSON," clper_area='".$_SESSION['admin_area']."' and clper_code='".$_SESSION['admin_school']."' and clper_tech='".$_POST['Username']."' ");

		$edit .=$db->add_db(TB_CLASS_PERSON,array(
			"clper_area"=>"".$_SESSION['admin_area']."",
			"clper_code"=>"".$_SESSION['admin_school']."",
			"clper_class"=>"".$_POST['class_person']."",
			"clper_group"=>"".$_POST['class_name']."",
			"clper_tech"=>"".$_POST['Username']."",
		));

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