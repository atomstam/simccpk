<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/put.php");
$db = New DB();
$add='';
$edit='';
$del='';
//$Avatar='';
if(!empty($_SESSION['admin_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['Best_stu'] !='' && $_POST['Stu_best'] !='' && $_POST['Btail_per'] !='' && $_POST['Pu_Dtime'] && $_POST['Btail_name'] !='' ){
		$Mtime=date("H:i:s");
		list($Y , $m , $d) = explode("-" , $_POST['Pu_Dtime']);
		$y=$Y+543;
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$Arr_Best_stu=is_array($_POST['Best_stu']);
		if($Arr_Best_stu){
		@$Put=count($_POST['Best_stu']);
		for($i=0;$i<$Put;$i++){

					$sql_put=$db->select_query("SELECT * FROM ".TB_PUT." WHERE pu_area='".$_SESSION['person_area']."' and pu_code='".$_SESSION['person_school']."' and pu_id like '".$_POST['Stu_best']."' ");
					@$result_put=$db->fetch($sql_put);

						$add .=$db->add_db(TB_PUTTAIL,array(
						"pt_area"=>"".$_SESSION['admin_area']."",
						"pt_code"=>"".$_SESSION['admin_school']."",
						"pt_pu"=>"".$_POST['Stu_best']."",
						"pt_stu"=>"".$_POST['Best_stu'][$i]."",
						"pt_name"=>"".$_POST['Btail_name']."",
						"pt_date"=>"".$_POST['Pu_Dtime']."",
						"pt_per"=>"".$_POST['Btail_per'].""
						));

					$sql=$db->select_query("SELECT * FROM ".TB_GOODTAIL." WHERE goodtail_area='".$_SESSION['admin_area']."' and goodtail_code='".$_SESSION['admin_school']."' and goodtail_name like '%".$result_put['pu_name']."%' ");
					@$result=$db->fetch($sql);
					$Good_tail= $_POST['Btail_name'];
					$gtailid=@$result['goodtail_id'];

					$add .=$db->add_db(TB_GOOD,array(
					"good_area"=>"".$_SESSION['admin_area']."",
					"good_code"=>"".$_SESSION['admin_school']."",
					"good_stu"=>"".$_POST['Best_stu'][$i]."",
					"good_tail"=>"".$gtailid."",
					"good_name"=>"".$Good_tail."",
					"good_date"=>"".$d."",
					"good_mouth"=>"".$m."",
					"good_year"=>"".$y."",
					"good_dam"=>"".$_SESSION['admin_login']."",
					"good_t"=>"1",
					"g_date"=>"".$_POST['Pu_Dtime']."",
					"g_Mtime"=>"".$Mtime."",
					"good_sess"=>"".$_SESSION['admin_login']."",
					"role"=>"1"
					));	

		}

		} else {
					$sql_put=$db->select_query("SELECT * FROM ".TB_PUT." WHERE pu_area='".$_SESSION['person_area']."' and pu_code='".$_SESSION['person_school']."' and pu_id like '".$_POST['Stu_best']."' ");
					@$result_put=$db->fetch($sql_put);

						$add .=$db->add_db(TB_PUTTAIL,array(
						"pt_area"=>"".$_SESSION['admin_area']."",
						"pt_code"=>"".$_SESSION['admin_school']."",
						"pt_pu"=>"".$_POST['Stu_best']."",
						"pt_stu"=>"".$_POST['Best_stu']."",
						"pt_name"=>"".$_POST['Btail_name']."",
						"pt_date"=>"".$_POST['Pu_Dtime']."",
						"pt_per"=>"".$_POST['Btail_per'].""
						));

					$sql=$db->select_query("SELECT * FROM ".TB_GOODTAIL." WHERE goodtail_area='".$_SESSION['admin_area']."' and goodtail_code='".$_SESSION['admin_school']."' and goodtail_name like '%".$result_put['pu_name']."%' ");
					@$result=$db->fetch($sql);
					$Good_tail= $_POST['Btail_name'];
					$gtailid=@$result['goodtail_id'];

					$add .=$db->add_db(TB_GOOD,array(
					"good_area"=>"".$_SESSION['admin_area']."",
					"good_code"=>"".$_SESSION['admin_school']."",
					"good_stu"=>"".$_POST['Best_stu']."",
					"good_tail"=>"".$gtailid."",
					"good_name"=>"".$Good_tail."",
					"good_date"=>"".$d."",
					"good_mouth"=>"".$m."",
					"good_year"=>"".$y."",
					"good_dam"=>"".$_SESSION['admin_login']."",
					"good_t"=>"1",
					"g_date"=>"".$_POST['Pu_Dtime']."",
					"g_Mtime"=>"".$Mtime."",
					"good_sess"=>"".$_SESSION['admin_login']."",
					"role"=>"1"
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
		$edit .=$db->update_db(TB_PUTTAIL,array(
						"pt_pu"=>"".$_POST['Stu_best']."",
						"pt_area"=>"".$_SESSION['admin_area']."",
						"pt_code"=>"".$_SESSION['admin_school']."",
						"pt_name"=>"".$_POST['Btail_name']."",
						"pt_per"=>"".$_POST['Btail_per'].""
		)," pt_stu=".$_POST['Best_stu']." ");

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