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
if(!empty($_SESSION['stu_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['Best_stu'] !='' && $_POST['Stu_best'] !='' && $_POST['Btail_per'] !='' && $_POST['Btail_name'] !='' ){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

		for($i=0;$i<count($_POST['Best_stu']);$i++){
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_BESTTAIL." WHERE btail_area='".$_SESSION['stu_area']."' and btail_code='".$_SESSION['stu_school']."' and btail_stu='".$_POST['Best_stu'][$i]."' "); 
		@$rowsSTU=$db->rows(@$res['stu']);
			if(@$rowsSTU){
						$add .=$db->update_db(TB_BESTTAIL,array(
						"btail_area"=>"".$_SESSION['stu_area']."",
						"btail_code"=>"".$_SESSION['stu_school']."",
						"btail_id"=>"".$_POST['Stu_best']."",
						"btail_name"=>"".$_POST['Btail_name']."",
						"btail_per"=>"".$_POST['Btail_per'].""
						)," btail_stu=".$_POST['Best_stu'][$i]." ");
			} else {
						$add .=$db->add_db(TB_BESTTAIL,array(
						"btail_area"=>"".$_SESSION['stu_area']."",
						"btail_code"=>"".$_SESSION['stu_school']."",
						"btail_id"=>"".$_POST['Stu_best']."",
						"btail_stu"=>"".$_POST['Best_stu'][$i]."",
						"btail_name"=>"".$_POST['Btail_name']."",
						"btail_per"=>"".$_POST['Btail_per'].""
						));
			}
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
		$edit .=$db->update_db(TB_BESTTAIL,array(
						"btail_area"=>"".$_SESSION['stu_area']."",
						"btail_code"=>"".$_SESSION['stu_school']."",
						"btail_id"=>"".$_POST['Stu_best']."",
						"btail_name"=>"".$_POST['Btail_name']."",
						"btail_per"=>"".$_POST['Btail_per'].""
		)," btail_stu=".$_POST['Best_stu']." ");

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