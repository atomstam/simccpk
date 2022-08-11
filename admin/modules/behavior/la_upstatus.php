<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
$db = New DB();
$up='';
//$Avatar='';
//echo $_POST['Ent_Dtime'];
if($_POST['OP']=='Up'){
	if( $_POST['Ent_stu'] !='' && $_POST['Ent_id'] !='' && $_POST['Stu_fstatus'] !='' ){
		$DateT=date('Y-m-d H:i:s');
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$up .=$db->update_db(TB_LATAIL,array(
						"lat_con"=>"".$_POST['Stu_fstatus']."",
						"lat_contime"=>"".$DateT."",
						"lat_con_per"=>"".$_SESSION['admin_login'].""
		)," lat_id=".$_POST['Ent_id']." ");

	} else {
		$up ='';
	}

	if($up){
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


?>