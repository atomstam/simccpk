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
if(!empty($_SESSION['admin_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['Best_stu'] !='' && $_POST['Stu_best'] !='' && $_POST['Btail_per'] !='' && $_POST['Pu_Dtime'] && $_POST['Btail_name'] !='' ){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		for($i=0;$i<count($_POST['Best_stu']);$i++){
						$add .=$db->add_db(TB_COUNTAIL,array(
						"cot_area"=>"".$_SESSION['admin_area']."",
						"cot_code"=>"".$_SESSION['admin_school']."",
						"cot_co"=>"".$_POST['Stu_best']."",
						"cot_stu"=>"".$_POST['Best_stu'][$i]."",
						"cot_name"=>"".$_POST['Btail_name']."",
						"cot_date"=>"".$_POST['Pu_Dtime']."",
						"cot_per"=>"".$_POST['Btail_per'].""
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
	if( $_POST['Best_stu'] !='' && $_POST['Stu_best'] !='' && $_POST['Btail_per'] !='' && $_POST['Btail_name'] !='' ){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$edit .=$db->update_db(TB_COUNTAIL,array(
						"cot_area"=>"".$_SESSION['admin_area']."",
						"cot_code"=>"".$_SESSION['admin_school']."",
						"cot_co"=>"".$_POST['Stu_best']."",
						"cot_name"=>"".$_POST['Btail_name']."",
						"cot_per"=>"".$_POST['Btail_per']."",
						"cot_per"=>"".$_POST['Btail_per'].""
		)," cot_stu=".$_POST['Best_stu']." ");

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