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
	if( $_POST['Firstname'] !='' && $_POST['Lastname'] !='' && $_POST['Username'] !='' && $_POST['Password'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$add=$db->add_db(TB_ADMIN,array(
			"area"=>"".$_SESSION['admin_area']."",
			"code"=>"".$_SESSION['admin_school']."",
//			"admin_group_id"=>"".$_POST['CAT']."",
			"username"=>"".$_POST['Username']."",
			"password"=>"".md5($_POST['Password'])."",
			"firstname"=>"".$_POST['Firstname']."",
			"lastname"=>"".$_POST['Lastname']."",
//			"date_added"=>"".$_POST['DTIME']."",
			"email"=>"".$_POST['Email']."",
			"img"=>"".$_POST['Icon']."",
			"status"=>"".$_POST['Status'].""
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
	if( $_POST['Firstname'] !='' && $_POST['Lastname'] !='' && $_POST['Username'] !='' && $_POST['SID'] !=''){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		if(isset($_POST['Icon'])){
		if(isset($_POST['Password'])){
		$edit=$db->update_db(TB_ADMIN,array(
			"area"=>"".$_SESSION['admin_area']."",
			"code"=>"".$_SESSION['admin_school']."",
//			"admin_group_id"=>"".$_POST['CAT']."",
			"password"=>"".md5($_POST['Password'])."",
			"firstname"=>"".$_POST['Firstname']."",
			"lastname"=>"".$_POST['Lastname']."",
//			"date_added"=>"".$_POST['DTIME']."",
			"email"=>"".$_POST['Email']."",
			"img"=>"".$_POST['Icon']."",
			"status"=>"".$_POST['Status'].""
		)," user_id=".$_POST['SID']." ");
		} else {
		$edit=$db->update_db(TB_ADMIN,array(
			"area"=>"".$_SESSION['admin_area']."",
			"code"=>"".$_SESSION['admin_school']."",
//			"admin_group_id"=>"".$_POST['CAT']."",
			"firstname"=>"".$_POST['Firstname']."",
			"lastname"=>"".$_POST['Lastname']."",
//			"date_added"=>"".$_POST['DTIME']."",
			"email"=>"".$_POST['Email']."",
			"img"=>"".$_POST['Icon']."",
			"status"=>"".$_POST['Status'].""
		)," user_id=".$_POST['SID']." ");
		}
		} else {
		if(isset($_POST['Password'])){
		$edit=$db->update_db(TB_ADMIN,array(
			"area"=>"".$_SESSION['admin_area']."",
			"code"=>"".$_SESSION['admin_school']."",
//			"admin_group_id"=>"".$_POST['CAT']."",
			"password"=>"".md5($_POST['Password'])."",
			"firstname"=>"".$_POST['Firstname']."",
			"lastname"=>"".$_POST['Lastname']."",
//			"date_added"=>"".$_POST['DTIME']."",
			"email"=>"".$_POST['Email']."",
			"status"=>"".$_POST['Status'].""
		)," user_id=".$_POST['SID']." ");
		} else {
		$edit=$db->update_db(TB_ADMIN,array(
			"area"=>"".$_SESSION['admin_area']."",
			"code"=>"".$_SESSION['admin_school']."",
//			"admin_group_id"=>"".$_POST['CAT']."",
			"firstname"=>"".$_POST['Firstname']."",
			"lastname"=>"".$_POST['Lastname']."",
//			"date_added"=>"".$_POST['DTIME']."",
			"email"=>"".$_POST['Email']."",
			"status"=>"".$_POST['Status'].""
		)," user_id=".$_POST['SID']." ");
		}
		}
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