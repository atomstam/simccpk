<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../includes/config.php");
require_once("../includes/class.mysql.php");
$db = New DB();
$add='';
$edit='';
$del='';
//$Avatar='';
if(!empty($_POST['tuser'])){
if($_POST['OP']=='Add'){
	if( $_POST['Good_name'] !='' && $_POST['Good_stu'] !='' && $_POST['Good_tail'] !='' && $_POST['Good_YMD'] !='' && $_POST['Good_dam'] !='' && $_POST['Good_data'] !=''){

	$date_array = explode("-",$_POST['Good_YMD']); // split the array
	$var_year = $date_array[0]; //day seqment
	$var_month = $date_array[1]; //month segment
	$var_day = $date_array[2]; //year segment
	$YY=$var_year+543;

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		for($i=0;$i<count($_POST['Good_stu']);$i++){
				for($a=0;$a<count($_POST['Good_tail']);$a++){
						$add .=$db->add_db(TB_GOOD,array(
						"good_stu"=>"".$_POST['Good_stu'][$i]."",
						"good_tail"=>"".$_POST['Good_tail'][$a]."",
						"good_name"=>"".$_POST['Good_name']."",
						"good_date"=>"".$var_day."",
						"good_mouth"=>"".$var_month."",
						"good_year"=>"".$YY."",
						"good_dam"=>"".$_POST['Good_dam']."",
						"good_t"=>"".$_POST['Good_data']."",
						"g_date"=>"".$_POST['Good_YMD']."",
						"good_sess"=>"".$_POST['tuser'].""
						));
				}
		}

	} else {
		$add .='';
	}

	if($add){
		$successx = "Success";
		$responseArray = array('type' => 'success', 'message' => $successx);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	} else {
		$error_warningx = "Error";
		//echo $error_warning;
		$responseArray = array('type' => 'danger', 'message' => $error_warningx);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	}

} 



} else { echo "<meta http-equiv='refresh' content='1; url=addg.php'>"; 

}?>