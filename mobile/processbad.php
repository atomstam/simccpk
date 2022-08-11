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
	if( $_POST['Bad_name'] !='' && $_POST['Bad_stu'] !='' && $_POST['Bad_tail'] !='' && $_POST['Bad_YMD'] !='' && $_POST['Bad_dam'] !='' && $_POST['Bad_data'] !=''){

	$date_array = explode("-",$_POST['Bad_YMD']); // split the array
	$var_year = $date_array[0]; //day seqment
	$var_month = $date_array[1]; //month segment
	$var_day = $date_array[2]; //year segment
	$YY=$var_year+543;

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		for($i=0;$i<count($_POST['Bad_stu']);$i++){
				for($a=0;$a<count($_POST['Bad_tail']);$a++){
						$add .=$db->add_db(TB_BAD,array(
						"bad_stu"=>"".$_POST['Bad_stu'][$i]."",
						"bad_tail"=>"".$_POST['Bad_tail'][$a]."",
						"bad_name"=>"".$_POST['Bad_name']."",
						"bad_date"=>"".$var_day."",
						"bad_mouth"=>"".$var_month."",
						"bad_year"=>"".$YY."",
						"bad_dam"=>"".$_POST['Bad_dam']."",
						"bad_t"=>"".$_POST['Bad_data']."",
						"g_date"=>"".$_POST['Bad_YMD']."",
						"bad_sess"=>"".$_POST['tuser'].""
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



} else { echo "<meta http-equiv='refresh' content='1; url=addb.php'>"; 

}?>