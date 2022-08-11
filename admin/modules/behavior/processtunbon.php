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

	if( $_POST['tab_stu'] !='' && $_POST['tab_nut'] !='' && $_POST['tab_name'] !='' && $_POST['tab_dateco'] !='' && $_POST['tab_per'] !='' ){

//$expArray = explode(" ",$_POST['Ent_Dtime']);
//$expArray[0]=$expArray[0];
//$expArray[1]=$expArray[1];

		$DateT=date('Y-m-d H:i:s');
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

						$add .=$db->add_db(TB_TUNBON,array(
						"tab_stu"=>"".$_POST['tab_stu']."",
						"tab_area"=>"".$_SESSION['admin_area']."",
						"tab_code"=>"".$_SESSION['admin_school']."",
//						"tab_score"=>"".@$arr['score']['CO']."",
						"tab_nut"=>"".$_POST['tab_nut']."",
						"tab_name"=>"".$_POST['tab_name']."",
						"tab_council"=>"".$_POST['tab_council']."",
						"tab_relation"=>"".$_POST['tab_relation']."",
						"tab_t"=>"".$DateT."",
						"tab_datetime"=>"".$_POST['tab_dateco']."",
						"tab_per"=>"".$_POST['tab_per'].""
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

if($_POST['OP']=='bAdd'){
	if( $_POST['tab_stu'] !='' && $_POST['tab_name'] !='' && $_POST['tab_dateco'] !='' && $_POST['tab_per'] !='' ){

//$expArray = explode(" ",$_POST['Ent_Dtime']);
//$expArray[0]=$expArray[0];
//$expArray[1]=$expArray[1];

		//$Bad=implode(",",$_POST['tab_bad']);
		$DateT=date('Y-m-d H:i:s');
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
						$add=$db->add_db(TB_TUNBON,array(
						"tab_stu"=>"".$_POST['tab_stu']."",
						"tab_area"=>"".$_SESSION['admin_area']."",
						"tab_code"=>"".$_SESSION['admin_school']."",
//						"tab_score"=>"".@$arr['score']['CO']."",
						"tab_nut"=>"".$_POST['tab_nut']."",
						"tab_name"=>"".$_POST['tab_name']."",
						"tab_council"=>"".$_POST['tab_council']."",
						"tab_relation"=>"".$_POST['tab_relation']."",
						"tab_t"=>"".$DateT."",
						"tab_datetime"=>"".$_POST['tab_dateco']."",
						"tab_per"=>"".$_POST['tab_per'].""
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
	if( $_POST['tab_stu'] !='' && $_POST['tab_nut'] !='' && $_POST['tab_name'] !='' && $_POST['tab_dateco'] !='' && $_POST['tab_per'] !='' ){
//$expArray = explode(" ",$_POST['Ent_Dtime']);
//$expArray[0]=$expArray[0];
//$expArray[1]=$expArray[1];
		$DateT=date('Y-m-d H:i:s');
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

		$edit .=$db->update_db(TB_TUNBON,array(
						"tab_area"=>"".$_SESSION['admin_area']."",
						"tab_code"=>"".$_SESSION['admin_school']."",
	//					"tab_score"=>"".@$arr['score']['CO']."",
						"tab_nut"=>"".$_POST['tab_nut']."",
						"tab_name"=>"".$_POST['tab_name']."",
						"tab_council"=>"".$_POST['tab_council']."",
						"tab_relation"=>"".$_POST['tab_relation']."",
						"tab_t"=>"".$DateT."",
						"tab_datetime"=>"".$_POST['tab_dateco']."",
						"tab_per"=>"".$_POST['tab_per'].""
		)," tab_id=".$_POST['tab_id']." ");

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