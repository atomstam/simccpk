<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/school.php");
$db = New DB();
$add='';
$edit='';
$del='';
//$Avatar='';
if(!empty($_SESSION['admin_login'])){
if(!empty($_POST['Sh_cat'])){ $CAT=$_POST['Sh_cat'];} else { $CAT=''; }
if($_POST['OP']=='Add'){
	if( $_SESSION['admin_area'] !='' && $_SESSION['admin_school'] !='' && $_POST['Sh_name'] !='' && $_POST['Sh_prov'] !='' && $_POST['Sh_amp'] !='' && $_POST['Sh_tambon'] !='' && $_POST['Sh_post'] !='' && $_POST['Sh_phone'] !='' && $_POST['Sh_email'] !='' && $_POST['lat_value'] !='' && $_POST['lon_value'] !=''){
//		$Avatar=$_FILES['avatar-1']['name'];
		$Date=date('Y-m-d');
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$Time_area=($_POST['Sh_length_area_time'])*60;
		$Time_amp=($_POST['Sh_length_amp_time'])*60;
		@$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_code='".$_SESSION['admin_school']."'"); 
		@$arr['sh']= $db->rows(@$res['sh']);
		if(empty(@$arr['sh'])){
		if(isset($_POST['Icon'])){
		$add .=$db->add_db(TB_SCHOOL,array(
			"sh_area"=>"".$_SESSION['admin_area']."",
			"sh_code"=>"".$_SESSION['admin_school']."",
			"sh_name"=>"".$_POST['Sh_name']."",
			"sh_eng"=>"".$_POST['Sh_eng']."",
			"sh_start"=>"".$_POST['Sh_start']."",
			"sh_num"=>"".$_POST['Sh_num']."",
			"sh_gr"=>"".$_POST['Sh_gr']."",
			"sh_ban"=>"".$_POST['Sh_ban']."",
			"sh_tambon"=>"".$_POST['Sh_tambon']."",
			"sh_amp"=>"".$_POST['Sh_amp']."",
			"sh_prov"=>"".$_POST['Sh_prov']."",
			"sh_post"=>"".$_POST['Sh_post']."",
			"sh_phone"=>"".$_POST['Sh_phone']."",
			"sh_email"=>"".$_POST['Sh_email']."",
			"sh_web"=>"".$_POST['Sh_web']."",
			"sh_fb"=>"".$_POST['Sh_fb']."",
			"sh_group"=>"".$_POST['Sh_group']."",
//			"sh_stu"=>"".$_POST['Sh_stu']."",
//			"sh_room"=>"".$_POST['Sh_room']."",
			"sh_length_area"=>"".$_POST['Sh_length_area']."",
			"sh_length_amphur"=>"".$_POST['Sh_length_amp']."",
			"sh_length_area_time"=>"".$Time_area."",
			"sh_length_amphur_time"=>"".$Time_amp."",
			"sh_cat"=>"".$CAT."",
//			"sh_level"=>"".$_POST['Sh_level']."",
			"latitude"=>"".$_POST['lat_value']."",
			"longitude"=>"".$_POST['lon_value']."",
			"zoom"=>"".$_POST['zoom_value']."",
			"sh_img"=>"".$_POST['Icon']."",
			"sh_posted"=>"".$_SESSION['admin_login']."",
			"sh_posted_date"=>"".$Date.""
		));
		} else {
		$add .=$db->add_db(TB_SCHOOL,array(
			"sh_area"=>"".$_SESSION['admin_area']."",
			"sh_code"=>"".$_SESSION['admin_school']."",
			"sh_name"=>"".$_POST['Sh_name']."",
			"sh_eng"=>"".$_POST['Sh_eng']."",
			"sh_start"=>"".$_POST['Sh_start']."",
			"sh_num"=>"".$_POST['Sh_num']."",
			"sh_gr"=>"".$_POST['Sh_gr']."",
			"sh_ban"=>"".$_POST['Sh_ban']."",
			"sh_tambon"=>"".$_POST['Sh_tambon']."",
			"sh_amp"=>"".$_POST['Sh_amp']."",
			"sh_prov"=>"".$_POST['Sh_prov']."",
			"sh_post"=>"".$_POST['Sh_post']."",
			"sh_phone"=>"".$_POST['Sh_phone']."",
			"sh_email"=>"".$_POST['Sh_email']."",
			"sh_web"=>"".$_POST['Sh_web']."",
			"sh_fb"=>"".$_POST['Sh_fb']."",
			"sh_group"=>"".$_POST['Sh_group']."",
//			"sh_stu"=>"".$_POST['Sh_stu']."",
//			"sh_room"=>"".$_POST['Sh_room']."",
			"sh_length_area"=>"".$_POST['Sh_length_area']."",
			"sh_length_amphur"=>"".$_POST['Sh_length_amp']."",
			"sh_length_area_time"=>"".$Time_area."",
			"sh_length_amphur_time"=>"".$Time_amp."",
			"sh_cat"=>"".$CAT."",
//			"sh_level"=>"".$_POST['Sh_level']."",
			"latitude"=>"".$_POST['lat_value']."",
			"longitude"=>"".$_POST['lon_value']."",
			"zoom"=>"".$_POST['zoom_value']."",
			"sh_img"=>"".$_POST['Icon']."",
			"sh_posted"=>"".$_SESSION['admin_login']."",
			"sh_posted_date"=>"".$Date.""
		));
		}

		} else {
		if(isset($_POST['Icon'])){
		$add .=$db->update_db(TB_SCHOOL,array(
			"sh_name"=>"".$_POST['Sh_name']."",
			"sh_eng"=>"".$_POST['Sh_eng']."",
			"sh_start"=>"".$_POST['Sh_start']."",
			"sh_num"=>"".$_POST['Sh_num']."",
			"sh_gr"=>"".$_POST['Sh_gr']."",
			"sh_ban"=>"".$_POST['Sh_ban']."",
			"sh_tambon"=>"".$_POST['Sh_tambon']."",
			"sh_amp"=>"".$_POST['Sh_amp']."",
			"sh_prov"=>"".$_POST['Sh_prov']."",
			"sh_post"=>"".$_POST['Sh_post']."",
			"sh_phone"=>"".$_POST['Sh_phone']."",
			"sh_email"=>"".$_POST['Sh_email']."",
			"sh_web"=>"".$_POST['Sh_web']."",
			"sh_fb"=>"".$_POST['Sh_fb']."",
			"sh_group"=>"".$_POST['Sh_group']."",
//			"sh_stu"=>"".$_POST['Sh_stu']."",
//			"sh_room"=>"".$_POST['Sh_room']."",
			"sh_length_area"=>"".$_POST['Sh_length_area']."",
			"sh_length_amphur"=>"".$_POST['Sh_length_amp']."",
			"sh_length_area_time"=>"".$Time_area."",
			"sh_length_amphur_time"=>"".$Time_amp."",
			"sh_cat"=>"".$CAT."",
//			"sh_level"=>"".$_POST['Sh_level']."",
			"latitude"=>"".$_POST['lat_value']."",
			"longitude"=>"".$_POST['lon_value']."",
			"zoom"=>"".$_POST['zoom_value']."",
			"sh_img"=>"".$_POST['Icon']."",
			"sh_posted"=>"".$_SESSION['admin_login']."",
			"sh_posted_date"=>"".$Date.""
		)," sh_code=".$_SESSION['admin_school']." ");
		} else {
		$add .=$db->update_db(TB_SCHOOL,array(
			"sh_name"=>"".$_POST['Sh_name']."",
			"sh_eng"=>"".$_POST['Sh_eng']."",
			"sh_start"=>"".$_POST['Sh_start']."",
			"sh_num"=>"".$_POST['Sh_num']."",
			"sh_gr"=>"".$_POST['Sh_gr']."",
			"sh_ban"=>"".$_POST['Sh_ban']."",
			"sh_tambon"=>"".$_POST['Sh_tambon']."",
			"sh_amp"=>"".$_POST['Sh_amp']."",
			"sh_prov"=>"".$_POST['Sh_prov']."",
			"sh_post"=>"".$_POST['Sh_post']."",
			"sh_phone"=>"".$_POST['Sh_phone']."",
			"sh_email"=>"".$_POST['Sh_email']."",
			"sh_web"=>"".$_POST['Sh_web']."",
			"sh_fb"=>"".$_POST['Sh_fb']."",
			"sh_group"=>"".$_POST['Sh_group']."",
//			"sh_stu"=>"".$_POST['Sh_stu']."",
//			"sh_room"=>"".$_POST['Sh_room']."",
			"sh_length_area"=>"".$_POST['Sh_length_area']."",
			"sh_length_amphur"=>"".$_POST['Sh_length_amp']."",
			"sh_length_area_time"=>"".$Time_area."",
			"sh_length_amphur_time"=>"".$Time_amp."",
			"sh_cat"=>"".$CAT."",
//			"sh_level"=>"".$_POST['Sh_level']."",
			"latitude"=>"".$_POST['lat_value']."",
			"longitude"=>"".$_POST['lon_value']."",
			"zoom"=>"".$_POST['zoom_value']."",
			"sh_posted"=>"".$_SESSION['admin_login']."",
			"sh_posted_date"=>"".$Date.""
		)," sh_code=".$_SESSION['admin_school']." ");
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
	if( $_POST['Sh_name'] !='' && $_POST['Sh_prov'] !='' && $_POST['Sh_amp'] !='' && $_POST['Sh_tambon'] !='' && $_POST['Sh_post'] !='' && $_POST['Sh_phone'] !='' && $_POST['Sh_email'] !='' && $_POST['lat_value'] !='' && $_POST['lon_value'] !='' && $_POST['SID'] !=''){
//		$Avatar=$_FILES['avatar-1']['name'];
		$Time_area=($_POST['Sh_length_area_time']);
		$Time_amp=($_POST['Sh_length_amp_time']);
		$Date=date('Y-m-d');
		$DateTime=date('Y-m-d H:i:s');
		if(isset($_POST['Icon1'])){
			$Icon_1=$_POST['Icon1'];
		} else {
			$Icon_1="";
		}
		if(isset($_POST['Icon2'])){
			$Icon_2=$_POST['Icon2'];
		} else {
			$Icon_2="";
		}
		if(isset($_POST['Icon3'])){
			$Icon_3=$_POST['Icon3'];
		} else {
			$Icon_3="";
		}
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

		$edit .=$db->update_db(TB_SCHOOL,array(
			"sh_name"=>"".$_POST['Sh_name']."",
			"sh_eng"=>"".$_POST['Sh_eng']."",
			"sh_boss"=>"".$_POST['Sh_boss']."",
	//		"sh_start"=>"".$_POST['Sh_start']."",
			"sh_num"=>"".$_POST['Sh_num']."",
			"sh_gr"=>"".$_POST['Sh_gr']."",
			"sh_ban"=>"".$_POST['Sh_ban']."",
			"sh_tambon"=>"".$_POST['Sh_tambon']."",
			"sh_amp"=>"".$_POST['Sh_amp']."",
			"sh_prov"=>"".$_POST['Sh_prov']."",
			"sh_post"=>"".$_POST['Sh_post']."",
			"sh_phone"=>"".$_POST['Sh_phone']."",
			"sh_email"=>"".$_POST['Sh_email']."",
			"sh_web"=>"".$_POST['Sh_web']."",
			"sh_fb"=>"".$_POST['Sh_fb']."",
			"sh_group"=>"".$_POST['Sh_group']."",
//			"sh_stu"=>"".$_POST['Sh_stu']."",
//			"sh_room"=>"".$_POST['Sh_room']."",
			"sh_length_area"=>"".$_POST['Sh_length_area']."",
			"sh_length_amphur"=>"".$_POST['Sh_length_amp']."",
			"sh_length_area_time"=>"".$Time_area."",
			"sh_length_amphur_time"=>"".$Time_amp."",
			"sh_cat"=>"".$CAT."",
//			"sh_level"=>"".$_POST['Sh_level']."",
			"latitude"=>"".$_POST['lat_value']."",
			"longitude"=>"".$_POST['lon_value']."",
			"zoom"=>"".$_POST['zoom_value']."",
			"sh_img"=>"".$Icon_1."",
			"sh_posted"=>"".$_SESSION['admin_login']."",
			"sh_posted_date"=>"".$Date.""
		)," sh_code='".$_SESSION['admin_school']."' ");

		@$res['schcon'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_CONFIG." WHERE shc_area='".$_SESSION['admin_area']."' and shc_code='".$_SESSION['admin_school']."' "); 
		@$RowCon =$db->rows(@$res['schcon']);
		if($RowCon > 0 ) {
		$edit .=$db->update_db(TB_SCHOOL_CONFIG,array(
//			"shc_area"=>"".$_SESSION['admin_area']."",
//			"shc_code"=>"".$_SESSION['admin_school']."",
			"shc_logo"=>"".$Icon_2."",
			"shc_boss_sig"=>"".$Icon_3."",
			"shc_datetime"=>"".$DateTime."",
			"shc_per"=>"".$_SESSION['admin_login']."",
		)," shc_area='".$_SESSION['admin_area']."' and shc_code='".$_SESSION['admin_school']."' ");
		} else {
		$edit .=$db->add_db(TB_SCHOOL_CONFIG,array(
			"shc_area"=>"".$_SESSION['admin_area']."",
			"shc_code"=>"".$_SESSION['admin_school']."",
			"shc_logo"=>"".$Icon_2."",
			"shc_boss_sig"=>"".$Icon_3."",
			"shc_datetime"=>"".$DateTime."",
			"shc_per"=>"".$_SESSION['admin_login']."",
		));
		}
	} else {
		$edit .='';
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

if($_SESSION['admin_group']==1){
if($_POST['OP']=='Del'){
	if( $_POST['CLIDS'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$del .=$db->del(TB_SCHOOL," sh_id='".$_POST['CLIDS']."' and sh_code='".$_SESSION['admin_school']."' ");
	} else {
		$del .='';
	}

	if($del){
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



if($_POST['OP']=='DelAll'){
	if( $_POST['CLIDSX'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$ids = explode(",",$_POST['CLIDSX']);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		while(list($key, $value) = each ($ids)){
//			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$del .=$db->del(TB_SCHOOL," sh_id='".$value."' and sh_code='".$_SESSION['admin_school']."' ");
//			$db->closedb ();
		}
//		$del .=$db->del(TB_BOARD," pm_id='".$_POST['CLIDS']."' ");
	} else {
		$del .='';
	}

	if($del){
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

}
} else { echo "<meta http-equiv='refresh' content='1; url=../../index.php'>"; }?>