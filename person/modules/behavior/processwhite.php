<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
$db = New DB();
$add='';
$edit='';
$del='';
//$Avatar='';
if(!empty($_SESSION['person_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['Best_stu'] !='' && $_POST['Stu_best'] !='' && $_POST['whcl_class'] !='' && $_POST['Btail_per'] !='' && $_POST['Pu_Dtime'] && $_POST['Btail_name'] !='' ){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		for($i=0;$i<count($_POST['Best_stu']);$i++){
						$add .=$db->add_db(TB_WHITECLTAIL,array(
						"whcl_area"=>"".$_SESSION['person_area']."",
						"whcl_code"=>"".$_SESSION['person_school']."",
						"whcl_wh"=>"".$_POST['Stu_best']."",
						"whcl_stu"=>"".$_POST['Best_stu'][$i]."",
						"whcl_class"=>"".$_POST['whcl_class']."",
						"whcl_gr"=>"".$_POST['whcl_gr']."",
						"whcl_name"=>"".$_POST['Btail_name']."",
						"whcl_date"=>"".$_POST['Pu_Dtime']."",
						"whcl_per"=>"".$_POST['Btail_per'].""
						));
		}

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
	if( $_POST['Best_stu'] !='' && $_POST['Stu_best'] !='' && $_POST['whcl_class'] !='' && $_POST['Btail_per'] !='' && $_POST['Btail_name'] !='' ){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$edit .=$db->update_db(TB_WHITECLTAIL,array(
						"whcl_area"=>"".$_SESSION['person_area']."",
						"whcl_code"=>"".$_SESSION['person_school']."",
						"whcl_wh"=>"".$_POST['Stu_best']."",
//						"whcl_class"=>"".$_POST['whcl_class']."",
						"whcl_name"=>"".$_POST['Btail_name']."",
						"whcl_date"=>"".$_POST['Pu_Dtime']."",
						"whcl_per"=>"".$_POST['Btail_per'].""
		)," whcl_stu=".$_POST['Best_stu']." ");

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