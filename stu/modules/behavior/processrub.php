<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$add='';
$edit='';
$del='';
//$Avatar='';
//echo $_POST['Ent_Dtime'];
if(!empty($_SESSION['stu_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['rub_stu'] !='' && $_POST['rub_ext'] !='' && $_POST['rub_timeIn'] !='' && $_POST['Etail_name'] !='' ){

		//$expArray = explode(" ",$_POST['rub_Dtime']);
		//$expArray[0]=$expArray[0];
		//$expArray[1]=$expArray[1];
		$DateT=date('Y-m-d H:i:s');
		@$Rub=count($_POST['rub_stu']);
		for($i=0;$i<$Rub;$i++){
						$add .=$db->add_db(TB_RUBRONGTAIL,array(
							"rub_area"=>"".$_SESSION['stu_area']."",
							"rub_code"=>"".$_SESSION['stu_school']."",
							"rub_rb"=>"".$_POST['rub_ext']."",
							"rub_stu"=>"".$_POST['rub_stu'][$i]."",
							"rub_tdate"=>"".$_POST['rub_timeIn']."",
							"rub_date"=>"".$DateT."",
							"rub_fare"=>"".$_POST['Etail_name']."",
							"rub_per"=>"".$_SESSION['stu_login'].""
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


if($_POST['OP']=='bAdd'){
	if( $_POST['rub_stu'] !='' && $_POST['rub_ext'] !='' && $_POST['rub_timeIn'] !='' && $_POST['Etail_name'] !='' ){
$DateT=date('Y-m-d H:i:s');
						$add .=$db->add_db(TB_RUBRONGTAIL,array(
							"rub_area"=>"".$_SESSION['stu_area']."",
							"rub_code"=>"".$_SESSION['stu_school']."",
							"rub_rb"=>"".$_POST['rub_ext']."",
							"rub_stu"=>"".$_POST['rub_stu']."",
							"rub_tdate"=>"".$_POST['rub_timeIn']."",
							"rub_date"=>"".$DateT."",
							"rub_fare"=>"".$_POST['Etail_name']."",
							"rub_per"=>"".$_SESSION['stu_login'].""
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
	if( $_POST['rub_id'] !='' && $_POST['rub_stu'] !='' && $_POST['rub_ext'] !='' && $_POST['rub_timeIn'] !='' && $_POST['Etail_name'] !='' ){
//$expArray = explode(" ",$_POST['rub_Dtime']);
//$expArray[0]=$expArray[0];
//$expArray[1]=$expArray[1];
$DateT=date('Y-m-d H:i:s');
		$edit .=$db->update_db(TB_RUBRONGTAIL,array(
							//"rub_area"=>"".$_SESSION['stu_area']."",
							//"rub_code"=>"".$_SESSION['stu_school']."",
							"rub_rb"=>"".$_POST['rub_ext']."",
							"rub_stu"=>"".$_POST['rub_stu']."",
							"rub_tdate"=>"".$_POST['rub_timeIn']."",
							//"rub_date"=>"".$DateT."",
							"rub_fare"=>"".$_POST['Etail_name']."",
							"rub_per"=>"".$_SESSION['stu_login'].""
					)," rub_id=".$_POST['rub_id']." ");

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