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
//echo $_POST['Ent_Dtime'];
if(!empty($_SESSION['admin_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['Ent_stu'] !='' && $_POST['Ent_ent'] !='' && $_POST['Ent_Dtime'] !='' && $_POST['Ent_Dtime2'] !='' && $_POST['Etail_name'] !='' ){

$expArray = explode(" ",$_POST['Ent_Dtime']);
$expArray[0]=$expArray[0];
$expArray[1]=$expArray[1];

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		for($i=0;$i<count($_POST['Ent_stu']);$i++){
						$add .=$db->add_db(TB_ENTTAIL,array(
						"got_area"=>"".$_SESSION['admin_area']."",
						"got_code"=>"".$_SESSION['admin_school']."",
						"got_tail"=>"".$_POST['Ent_ent']."",
						"got_stu"=>"".$_POST['Ent_stu'][$i]."",
						"got_date"=>"".$expArray[0]."",
						"got_tailname"=>"".$_POST['Etail_name']."",
						"got_timego"=>"".$_POST['Ent_Dtime']."",
						"got_timeback"=>"".$_POST['Ent_Dtime2'].""
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
	if( $_POST['Ent_stu'] !='' && $_POST['Ent_ent'] !='' && $_POST['Ent_Dtime'] !='' && $_POST['Ent_Dtime2'] !='' && $_POST['Etail_name'] !='' ){
$expArray = explode(" ",$_POST['Ent_Dtime']);
$expArray[0]=$expArray[0];
$expArray[1]=$expArray[1];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$edit .=$db->update_db(TB_ENTTAIL,array(
						"got_area"=>"".$_SESSION['admin_area']."",
						"got_code"=>"".$_SESSION['admin_school']."",
						"got_tail"=>"".$_POST['Ent_ent']."",
						"got_date"=>"".$expArray[0]."",
						"got_tailname"=>"".$_POST['Etail_name']."",
						"got_timego"=>"".$_POST['Ent_Dtime']."",
						"got_timeback"=>"".$_POST['Ent_Dtime2'].""
		)," got_id=".$_POST['Ent_id']." ");

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