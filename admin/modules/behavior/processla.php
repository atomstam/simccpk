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
	if( $_POST['lat_stu'] !='' && $_POST['lat_ext'] !='' && $_POST['lat_timeIn'] !='' && $_POST['lat_timeOut'] !='' && $_POST['Etail_name'] !='' ){

//$expArray = explode(" ",$_POST['lat_Dtime']);
//$expArray[0]=$expArray[0];
//$expArray[1]=$expArray[1];
$DateT=date('Y-m-d H:i:s');
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		for($i=0;$i<count($_POST['lat_stu']);$i++){
						$add .=$db->add_db(TB_LATAIL,array(
						"lat_area"=>"".$_SESSION['admin_area']."",
						"lat_code"=>"".$_SESSION['admin_school']."",
						"lat_tail"=>"".$_POST['lat_ext']."",
						"lat_stu"=>"".$_POST['lat_stu'][$i]."",
						"lat_dateIn"=>"".$_POST['lat_timeIn']."",
						"lat_dateOut"=>"".$_POST['lat_timeOut']."",
						"lat_tailname"=>"".$_POST['Etail_name']."",
						"lat_check"=>"".$DateT.""
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
	if( $_POST['lat_stu'] !='' && $_POST['lat_ext'] !='' && $_POST['lat_timeIn'] !='' && $_POST['lat_timeOut'] !='' && $_POST['Etail_name'] !='' ){
//$expArray = explode(" ",$_POST['lat_Dtime']);
//$expArray[0]=$expArray[0];
//$expArray[1]=$expArray[1];
$DateT=date('Y-m-d H:i:s');
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$edit .=$db->update_db(TB_LATAIL,array(
						"lat_area"=>"".$_SESSION['admin_area']."",
						"lat_code"=>"".$_SESSION['admin_school']."",
						"lat_tail"=>"".$_POST['lat_ext']."",
						"lat_dateIn"=>"".$_POST['lat_timeIn']."",
						"lat_dateOut"=>"".$_POST['lat_timeOut']."",
						"lat_tailname"=>"".$_POST['Etail_name']."",
						"lat_check"=>"".$DateT.""
		)," lat_id=".$_POST['lat_id']." ");

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