<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/affairs.php");
$db = New DB();
$add='';
$edit='';
$del='';
//$Avatar='';
if(!empty($_SESSION['admin_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['Stu_best'] !='' && $_POST['Pu_Dtime'] && $_POST['Btail_name'] !='' ){

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$Mtime=time();
		@$res['tail'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." WHERE aff_area='".$_SESSION['admin_area']."' and aff_code='".$_SESSION['admin_school']."' and aff_id='".$_POST['Stu_best']."' "); 
		@$arr['tail'] =$db->fetch(@$res['tail']);

	list($Y , $m , $d) = explode("-" , $_POST['Pu_Dtime']);
	$y=$Y+543;
	$RANK=$_POST['rank']+1;
	for ($i=0; $i < $RANK; $i++) {
		if(!empty($_POST['StuID'][$i])){
				if($_POST['Ck1'][$i] =='1'){
						$add .=$db->add_db(TB_AFFTAIL,array(
						"afft_area"=>"".$_SESSION['admin_area']."",
						"afft_code"=>"".$_SESSION['admin_school']."",
						"afft_aff"=>"".$_POST['Stu_best']."",
						"afft_stu"=>"".$_POST['StuID'][$i]."",
						"afft_name"=>"".$_POST['Btail_name']."",
						"afft_date"=>"".$_POST['Pu_Dtime']."",
						"afft_per"=>"".$_SESSION['admin_login'].""
						));
				} else {
					$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_name='ไม่ร่วมกิจกรรมโรงเรียน' ");
					@$result=$db->fetch($sql);
					$Bad_tail= _text_box_table_tab4_kad." ".@$arr['tail']['aff_name'];
					$btailid=@$result['badtail_id'];

				$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['admin_area']."",
				"bad_code"=>"".$_SESSION['admin_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>"".$_SESSION['admin_login']."",
				"bad_t"=>"1",
				"b_date"=>"".$_POST['Pu_Dtime']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>"".$_SESSION['admin_login'].""
				));	
//				$add .=$db->update_db(TB_BAD,array(
//					"b_date"=>"".$_POST['DateID'].""
//				)," b_date='0000-00-00" );


				}
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
		$edit .=$db->update_db(TB_AFFTAIL,array(
						"afft_aff"=>"".$_POST['Stu_best']."",
						"afft_name"=>"".$_POST['Btail_name']."",
						"afft_per"=>"".$_POST['Btail_per'].""
		)," afft_stu=".$_POST['Best_stu']." ");

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