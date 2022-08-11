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
	if( $_POST['Mot_stu'] !='' && $_POST['Mot_tail'] !='' && $_POST['Mot_sub'] !='' && $_POST['Mot_color'] !='' && $_POST['Mot_number'] !='' && $_POST['Mot_Dtime'] !=''){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		for($i=0;$i<count($_POST['Mot_stu']);$i++){
						$add .=$db->add_db(TB_MOTORTAIL,array(
						"mot_area"=>"".$_SESSION['admin_area']."",
						"mot_code"=>"".$_SESSION['admin_school']."",
						"mot_tail"=>"".$_POST['Mot_tail']."",
						"mot_stu"=>"".$_POST['Mot_stu'][$i]."",
						"mot_sub"=>"".$_POST['Mot_sub']."",
						"mot_color"=>"".$_POST['Mot_color']."",
						"mot_number"=>"".$_POST['Mot_number']."",
						"mot_tailname"=>"".$_POST['Mtail_name']."",
						"mot_pic"=>"".$_POST['Icon']."",
						"mot_date"=>"".$_POST['Mot_Dtime'].""
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
	if( $_POST['Mot_stu'] !='' && $_POST['Mot_tail'] !='' && $_POST['Mot_sub'] !='' && $_POST['Mot_color'] !='' && $_POST['Mot_number'] !='' && $_POST['Mot_Dtime'] !=''){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		if(!empty($_POST['Icon'])){
		$edit .=$db->update_db(TB_MOTORTAIL,array(
						"mot_area"=>"".$_SESSION['admin_area']."",
						"mot_code"=>"".$_SESSION['admin_school']."",
						"mot_tail"=>"".$_POST['Mot_tail']."",
						"mot_sub"=>"".$_POST['Mot_sub']."",
						"mot_color"=>"".$_POST['Mot_color']."",
						"mot_number"=>"".$_POST['Mot_number']."",
						"mot_tailname"=>"".$_POST['Mtail_name']."",
						"mot_pic"=>"".$_POST['Icon']."",
						"mot_date"=>"".$_POST['Mot_Dtime'].""
		)," mot_id=".$_POST['Mot_id']." ");
		} else {
		$edit .=$db->update_db(TB_MOTORTAIL,array(
						"mot_area"=>"".$_SESSION['admin_area']."",
						"mot_code"=>"".$_SESSION['admin_school']."",
						"mot_tail"=>"".$_POST['Mot_tail']."",
						"mot_sub"=>"".$_POST['Mot_sub']."",
						"mot_color"=>"".$_POST['Mot_color']."",
						"mot_number"=>"".$_POST['Mot_number']."",
						"mot_tailname"=>"".$_POST['Mtail_name']."",
						"mot_date"=>"".$_POST['Mot_Dtime'].""
		)," mot_id=".$_POST['Mot_id']." ");
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