<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/function.in.php");
require_once("../../../includes/class.mysql.php");
require_once("../../../includes/excel_reader2.php");
require_once("lang/student.php");
$db = New DB();
$add='';
$edit='';
$del='';
//$Avatar='';
if(!empty($_SESSION['admin_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['Stu_id'] !='' && $_POST['Stu_pid'] !='' && $_POST['Stu_class'] !='' && $_POST['Stu_name'] !='' && $_POST['Stu_sur'] !=''){
//		$Avatar=$_FILES['avatar-1']['name'];
if($_POST['Stu_num'] = ''._text_box_table_stu_num_chai.''){
	$Sex=1;
} else if($_POST['Stu_num'] = ''._text_box_table_stu_num_nai.''){
	$Sex=1;
} else if($_POST['Stu_num'] = ''._text_box_table_stu_num_ying.''){
	$Sex=2;
} else {
	$Sex=2;
}
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		if(isset($_POST['Icon'])){
		$add .=$db->add_db(TB_STUDENT,array(
			"stu_id"=>"".$_POST['Stu_id']."",
			"stu_area"=>"".$_SESSION['admin_area']."",
			"stu_code"=>"".$_SESSION['admin_school']."",
			"stu_pid"=>"".$_POST['Stu_pid']."",
			"stu_num"=>"".$_POST['Stu_num']."",
			"stu_name"=>"".$_POST['Stu_name']."",
			"stu_sur"=>"".$_POST['Stu_sur']."",
			"stu_nick"=>"".$_POST['Stu_nick']."",
			"stu_sex"=>"".$Sex."",
			"stu_sphone"=>"".$_POST['Stu_sphone']."",
			"stu_email"=>"".$_POST['Stu_email']."",
			"stu_LineId"=>"".$_POST['Stu_LineId']."",
			"stu_class"=>"".$_POST['Stu_class']."",
			"stu_cn"=>"".$_POST['Stu_cn']."",
			"stu_birth"=>"".$_POST['Stu_birth']."",
			"stu_father"=>"".$_POST['Stu_father']."",
			"stu_fphone"=>"".$_POST['Stu_fphone']."",
			"stu_femail"=>"".$_POST['Stu_femail']."",
			"stu_fstatus"=>"".$_POST['Stu_fstatus']."",
			"stu_marther"=>"".$_POST['Stu_marther']."",
			"stu_mphone"=>"".$_POST['Stu_mphone']."",
			"stu_memail"=>"".$_POST['Stu_memail']."",
			"stu_mstatus"=>"".$_POST['Stu_mstatus']."",
			"stu_status"=>"".$_POST['Stu_status']."",
			"stu_orther"=>"".$_POST['Stu_orther']."",
			"stu_ophone"=>"".$_POST['Stu_ophone']."",
			"stu_oemail"=>"".$_POST['Stu_oemail']."",
			"stu_ostatus"=>"".$_POST['Stu_ostatus']."",
			"stu_add"=>"".$_POST['Stu_add']."",
			"stu_group"=>"".$_POST['Stu_group']."",
			"stu_ban"=>"".$_POST['Stu_ban']."",
			"stu_tum"=>"".$_POST['Stu_tum']."",
			"stu_amp"=>"".$_POST['Stu_amp']."",
			"stu_prov"=>"".$_POST['Stu_prov']."",
			"stu_post"=>"".$_POST['Stu_post']."",
			"stu_best"=>"".$_POST['Stu_best']."",
			"stu_blood"=>"".$_POST['Stu_blood']."",
			"stu_fpid"=>"".$_POST['Stu_fpid']."",
			"stu_mpid"=>"".$_POST['Stu_mpid']."",
			"stu_opid"=>"".$_POST['Stu_opid']."",
			"stu_weight"=>"".$_POST['Stu_wth']."",
			"stu_hight"=>"".$_POST['Stu_hht']."",
			"stu_distance"=>"".$_POST['Stu_distn']."",
			"stu_time"=>"".$_POST['Stu_time']."",
			"stu_travel"=>"".$_POST['Stu_travel']."",
			"stu_pic"=>"".$_POST['Icon']."",
			"stu_lat"=>"".$_POST['lat_value']."",
			"stu_long"=>"".$_POST['lon_value']."",
			"stu_suspend"=>"".$_POST['Stu_suspend'].""
		));
		} else {
		$add .=$db->add_db(TB_STUDENT,array(
			"stu_id"=>"".$_POST['Stu_id']."",
			"stu_area"=>"".$_SESSION['admin_area']."",
			"stu_code"=>"".$_SESSION['admin_school']."",
			"stu_pid"=>"".$_POST['Stu_pid']."",
			"stu_num"=>"".$_POST['Stu_num']."",
			"stu_name"=>"".$_POST['Stu_name']."",
			"stu_sur"=>"".$_POST['Stu_sur']."",
			"stu_nick"=>"".$_POST['Stu_nick']."",
			"stu_sex"=>"".$Sex."",
			"stu_sphone"=>"".$_POST['Stu_sphone']."",
			"stu_email"=>"".$_POST['Stu_email']."",
			"stu_LineId"=>"".$_POST['Stu_LineId']."",
			"stu_class"=>"".$_POST['Stu_class']."",
			"stu_cn"=>"".$_POST['Stu_cn']."",
			"stu_birth"=>"".$_POST['Stu_birth']."",
			"stu_father"=>"".$_POST['Stu_father']."",
			"stu_fphone"=>"".$_POST['Stu_fphone']."",
			"stu_femail"=>"".$_POST['Stu_femail']."",
			"stu_fstatus"=>"".$_POST['Stu_fstatus']."",
			"stu_marther"=>"".$_POST['Stu_marther']."",
			"stu_mphone"=>"".$_POST['Stu_mphone']."",
			"stu_memail"=>"".$_POST['Stu_memail']."",
			"stu_mstatus"=>"".$_POST['Stu_mstatus']."",
			"stu_status"=>"".$_POST['Stu_status']."",
			"stu_orther"=>"".$_POST['Stu_orther']."",
			"stu_ophone"=>"".$_POST['Stu_ophone']."",
			"stu_oemail"=>"".$_POST['Stu_oemail']."",
			"stu_ostatus"=>"".$_POST['Stu_ostatus']."",
			"stu_add"=>"".$_POST['Stu_add']."",
			"stu_group"=>"".$_POST['Stu_group']."",
			"stu_ban"=>"".$_POST['Stu_ban']."",
			"stu_tum"=>"".$_POST['Stu_tum']."",
			"stu_amp"=>"".$_POST['Stu_amp']."",
			"stu_prov"=>"".$_POST['Stu_prov']."",
			"stu_post"=>"".$_POST['Stu_post']."",
			"stu_best"=>"".$_POST['Stu_best']."",
			"stu_blood"=>"".$_POST['Stu_blood']."",
			"stu_fpid"=>"".$_POST['Stu_fpid']."",
			"stu_mpid"=>"".$_POST['Stu_mpid']."",
			"stu_opid"=>"".$_POST['Stu_opid']."",
			"stu_weight"=>"".$_POST['Stu_wth']."",
			"stu_hight"=>"".$_POST['Stu_hht']."",
			"stu_distance"=>"".$_POST['Stu_distn']."",
			"stu_time"=>"".$_POST['Stu_time']."",
			"stu_travel"=>"".$_POST['Stu_travel']."",
			"stu_lat"=>"".$_POST['lat_value']."",
			"stu_long"=>"".$_POST['lon_value']."",
			"stu_suspend"=>"".$_POST['Stu_suspend'].""
		));
		}
		$add .=$db->add_db(TB_BESTTAIL,array(
			"btail_id"=>"".$_POST['Stu_best']."",
			"btail_area"=>"".$_SESSION['admin_area']."",
			"btail_code"=>"".$_SESSION['admin_school']."",
			"btail_stu"=>"".$_POST['Stu_id']."",
			"btail_name"=>"".$_POST['Btail_name']."",
			"btail_per"=>"".$_POST['Btail_per'].""
			));
	} else {
		$add ='';
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
	if( $_POST['Stu_class'] !='' && $_POST['Stu_name'] !='' && $_POST['Stu_sur'] !='' && $_POST['SID'] !=''){
//		$Avatar=$_FILES['avatar-1']['name'];
if($_POST['Stu_num'] = ''._text_box_table_stu_num_chai.''){
	$Sex=1;
} else if($_POST['Stu_num'] = ''._text_box_table_stu_num_nai.''){
	$Sex=1;
} else if($_POST['Stu_num'] = ''._text_box_table_stu_num_ying.''){
	$Sex=2;
} else {
	$Sex=2;
}
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		if(isset($_POST['Icon'])){
		$edit .=$db->update_db(TB_STUDENT,array(
			"stu_num"=>"".$_POST['Stu_num']."",
			"stu_name"=>"".$_POST['Stu_name']."",
			"stu_sur"=>"".$_POST['Stu_sur']."",
			"stu_nick"=>"".$_POST['Stu_nick']."",
			"stu_sex"=>"".$Sex."",
			"stu_sphone"=>"".$_POST['Stu_sphone']."",
			"stu_email"=>"".$_POST['Stu_email']."",
			"stu_LineId"=>"".$_POST['Stu_LineId']."",
			"stu_class"=>"".$_POST['Stu_class']."",
			"stu_cn"=>"".$_POST['Stu_cn']."",
			"stu_birth"=>"".$_POST['Stu_birth']."",
			"stu_father"=>"".$_POST['Stu_father']."",
			"stu_fphone"=>"".$_POST['Stu_fphone']."",
			"stu_femail"=>"".$_POST['Stu_femail']."",
			"stu_fstatus"=>"".$_POST['Stu_fstatus']."",
			"stu_marther"=>"".$_POST['Stu_marther']."",
			"stu_mphone"=>"".$_POST['Stu_mphone']."",
			"stu_memail"=>"".$_POST['Stu_memail']."",
			"stu_mstatus"=>"".$_POST['Stu_mstatus']."",
			"stu_status"=>"".$_POST['Stu_status']."",
			"stu_orther"=>"".$_POST['Stu_orther']."",
			"stu_ophone"=>"".$_POST['Stu_ophone']."",
			"stu_oemail"=>"".$_POST['Stu_oemail']."",
			"stu_ostatus"=>"".$_POST['Stu_ostatus']."",
			"stu_add"=>"".$_POST['Stu_add']."",
			"stu_group"=>"".$_POST['Stu_group']."",
			"stu_ban"=>"".$_POST['Stu_ban']."",
			"stu_tum"=>"".$_POST['Stu_tum']."",
			"stu_amp"=>"".$_POST['Stu_amp']."",
			"stu_prov"=>"".$_POST['Stu_prov']."",
			"stu_post"=>"".$_POST['Stu_post']."",
			"stu_best"=>"".$_POST['Stu_best']."",
			"stu_blood"=>"".$_POST['Stu_blood']."",
			"stu_fpid"=>"".$_POST['Stu_fpid']."",
			"stu_mpid"=>"".$_POST['Stu_mpid']."",
			"stu_opid"=>"".$_POST['Stu_opid']."",
			"stu_weight"=>"".$_POST['Stu_wth']."",
			"stu_hight"=>"".$_POST['Stu_hht']."",
			"stu_distance"=>"".$_POST['Stu_distn']."",
			"stu_time"=>"".$_POST['Stu_time']."",
			"stu_travel"=>"".$_POST['Stu_travel']."",
			"stu_pic"=>"".$_POST['Icon']."",
			"stu_lat"=>"".$_POST['lat_value']."",
			"stu_long"=>"".$_POST['lon_value']."",
			"stu_suspend"=>"".$_POST['Stu_suspend'].""
		)," stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id=".$_POST['SID']." ");
		} else {
		$edit .=$db->update_db(TB_STUDENT,array(
			"stu_num"=>"".$_POST['Stu_num']."",
			"stu_name"=>"".$_POST['Stu_name']."",
			"stu_sur"=>"".$_POST['Stu_sur']."",
			"stu_nick"=>"".$_POST['Stu_nick']."",
			"stu_sex"=>"".$Sex."",
			"stu_sphone"=>"".$_POST['Stu_sphone']."",
			"stu_email"=>"".$_POST['Stu_email']."",
			"stu_LineId"=>"".$_POST['Stu_LineId']."",
			"stu_class"=>"".$_POST['Stu_class']."",
			"stu_cn"=>"".$_POST['Stu_cn']."",
			"stu_birth"=>"".$_POST['Stu_birth']."",
			"stu_father"=>"".$_POST['Stu_father']."",
			"stu_fphone"=>"".$_POST['Stu_fphone']."",
			"stu_femail"=>"".$_POST['Stu_femail']."",
			"stu_fstatus"=>"".$_POST['Stu_fstatus']."",
			"stu_marther"=>"".$_POST['Stu_marther']."",
			"stu_mphone"=>"".$_POST['Stu_mphone']."",
			"stu_memail"=>"".$_POST['Stu_memail']."",
			"stu_mstatus"=>"".$_POST['Stu_mstatus']."",
			"stu_status"=>"".$_POST['Stu_status']."",
			"stu_orther"=>"".$_POST['Stu_orther']."",
			"stu_ophone"=>"".$_POST['Stu_ophone']."",
			"stu_oemail"=>"".$_POST['Stu_oemail']."",
			"stu_ostatus"=>"".$_POST['Stu_ostatus']."",
			"stu_add"=>"".$_POST['Stu_add']."",
			"stu_group"=>"".$_POST['Stu_group']."",
			"stu_ban"=>"".$_POST['Stu_ban']."",
			"stu_tum"=>"".$_POST['Stu_tum']."",
			"stu_amp"=>"".$_POST['Stu_amp']."",
			"stu_prov"=>"".$_POST['Stu_prov']."",
			"stu_post"=>"".$_POST['Stu_post']."",
			"stu_best"=>"".$_POST['Stu_best']."",
			"stu_blood"=>"".$_POST['Stu_blood']."",
			"stu_fpid"=>"".$_POST['Stu_fpid']."",
			"stu_mpid"=>"".$_POST['Stu_mpid']."",
			"stu_opid"=>"".$_POST['Stu_opid']."",
			"stu_weight"=>"".$_POST['Stu_wth']."",
			"stu_hight"=>"".$_POST['Stu_hht']."",
			"stu_distance"=>"".$_POST['Stu_distn']."",
			"stu_time"=>"".$_POST['Stu_time']."",
			"stu_travel"=>"".$_POST['Stu_travel']."",
			"stu_lat"=>"".$_POST['lat_value']."",
			"stu_long"=>"".$_POST['lon_value']."",
			"stu_suspend"=>"".$_POST['Stu_suspend'].""
		)," stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id=".$_POST['SID']." ");
		}
	@$res['bestt'] = $db->select_query("SELECT * FROM ".TB_BESTTAIL." WHERE btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."'  and btail_stu='".$_POST['SID']."'  "); 
	@$arr['bestt'] = $db->rows(@$res['bestt']);
	if(@$arr['bestt']){
		$edit .=$db->update_db(TB_BESTTAIL,array(
			"btail_id"=>"".$_POST['Stu_best']."",
			"btail_name"=>"".$_POST['Btail_name']."",
			"btail_per"=>"".$_POST['Btail_per'].""
			)," btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."'  and btail_stu=".$_POST['SID']." ");
	} else {
		$edit .=$db->add_db(TB_BESTTAIL,array(
			"btail_id"=>"".$_POST['Stu_best']."",
			"btail_area"=>"".$_SESSION['admin_area']."",
			"btail_code"=>"".$_SESSION['admin_school']."",
			"btail_stu"=>"".$_POST['SID']."",
			"btail_name"=>"".$_POST['Btail_name']."",
			"btail_per"=>"".$_POST['Btail_per'].""
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


if($_POST['OP']=='Import'){
	if( $_SESSION['admin_area'] !='' && $_SESSION['admin_school'] !='' && $_POST["Icon"] !='' ){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$CsvFile = WEB_PATH_UPLOAD.$_POST["Icon"];
	$type= strrchr($_POST["Icon"],".");

	//$data = &new Spreadsheet_Excel_Reader($CsvFile);
			if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
				$data = new Spreadsheet_Excel_Reader($CsvFile);
			} else {
				$data = new Spreadsheet_Excel_Reader($CsvFile);
			}

for($i=0;$i<count($data->sheets);$i++) // Loop to get all sheets in a file.
{	
	if(count($data->sheets[$i][cells])>0) // checking sheet not empty
	{

		for($j=2;$j<=count($data->sheets[$i][cells]);$j++) // loop used to get each row of the sheet
		{ 

			$YD=explode("/",$data->sheets[$i][cells][$j][13]);
			$DD=$YD[0];
			$MM=$YD[1];
			$YY=$YD[2]-543;
//			$Birthday=$YY."-".$MM."-".$DD;
			if($MM<10){
				$MMx="0".$MM;
			} else {
				$MMx=$MM;
			}
			if($DD<10){
				$DDx="0".$DD;
			} else {
				$DDx=$DD;
			}
			$Birthday = "$YY-$MMx-$DDx";

			if($data->sheets[$i][cells][$j][7]=='???'){
				$Sex=1;
			} else {
				$Sex=2;
			}

			if($data->sheets[$i][cells][$j][4]=='???.1'){
				$M='m1';
			} else if($data->sheets[$i][cells][$j][4]=='???.2'){
				$M='m2';
			} else if($data->sheets[$i][cells][$j][4]=='???.3'){
				$M='m3';
			} else if($data->sheets[$i][cells][$j][4]=='???.4'){
				$M='m4';
			} else if($data->sheets[$i][cells][$j][4]=='???.5'){
				$M='m5';
			} else if($data->sheets[$i][cells][$j][4]=='???.6'){
				$M='m6';
			} 
			$Father=$data->sheets[$i][cells][$j][27].$data->sheets[$i][cells][$j][28]." ".$data->sheets[$i][cells][$j][29];
			$Marther=$data->sheets[$i][cells][$j][33].$data->sheets[$i][cells][$j][34]." ".$data->sheets[$i][cells][$j][35];
			$Other=$data->sheets[$i][cells][$j][40].$data->sheets[$i][cells][$j][41]." ".$data->sheets[$i][cells][$j][42];

			@$res['prov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." where name like '%".$data->sheets[$i][cells][$j][51]."%' "); 
			@$arr['prov'] = $db->fetch(@$res['prov']);
			$Prov=@$arr['prov']['id'];
			if(!empty($Prov)){
				@$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where provinceID='".$Prov."' and name like '%".$data->sheets[$i][cells][$j][50]."%' "); 
				@$arr['amp'] = $db->fetch(@$res['amp']);
				$Amp=@$arr['amp']['id'];
				if(!empty($Amp)){
					@$res['tam'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where amphurID='".$Amp."' and name like '%".$data->sheets[$i][cells][$j][49]."%' "); 
					@$arr['tam'] = $db->fetch(@$res['tam']);
					$Tam=@$arr['tam']['id'];
				}
			}
			if($data->sheets[$i][cells][$j][77]=='???????????????????????????'){
				$Best=1;
			} else {
				$Best=0;
			}

			@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_code='".$_SESSION['admin_school']."' and stu_id='".$data->sheets[$i][cells][$j][6]."' "); 
			@$arr['stu'] = $db->fetch(@$res['stu']);
			if(empty(@$arr['stu']['stu_id'])){
			$import .=$db->add_db(TB_STUDENT,array(
				"stu_id"=>"".$data->sheets[$i][cells][$j][6]."",
				"stu_area"=>"".$_SESSION['admin_area']."",
				"stu_code"=>"".$_SESSION['admin_school']."",
				"stu_pid"=>"".$data->sheets[$i][cells][$j][3]."",
				"stu_num"=>"".$data->sheets[$i][cells][$j][8]."",
				"stu_name"=>"".$data->sheets[$i][cells][$j][9]."",
				"stu_sur"=>"".$data->sheets[$i][cells][$j][10]."",
				//"stu_nick"=>"".$_POST['Stu_nick']."",
				"stu_sex"=>"".$Sex."",
				"stu_sphone"=>"".$data->sheets[$i][cells][$j][62]."",
				//"stu_email"=>"".$_POST['Stu_email']."",
				//"stu_LineId"=>"".$_POST['Stu_LineId']."",
				"stu_class"=>"".$M."",
				"stu_cn"=>"".$data->sheets[$i][cells][$j][5]."",
				"stu_birth"=>"".$Birthday."",
				"stu_father"=>"".$Father."",
				"stu_fphone"=>"".$data->sheets[$i][cells][$j][31]."",
//				"stu_femail"=>"".$_POST['Stu_femail']."",
//				"stu_fstatus"=>"".$_POST['Stu_fstatus']."",
				"stu_marther"=>"".$Marther."",
				"stu_mphone"=>"".$data->sheets[$i][cells][$j][37]."",
//				"stu_memail"=>"".$_POST['Stu_memail']."",
//				"stu_mstatus"=>"".$_POST['Stu_mstatus']."",
				"stu_status"=>"".$data->sheets[$i][cells][$j][25]."",
				"stu_orther"=>"".$Other."",
				"stu_ophone"=>"".$data->sheets[$i][cells][$j][44]."",
//				"stu_oemail"=>"".$_POST['Stu_oemail']."",
				"stu_ostatus"=>"".$data->sheets[$i][cells][$j][38]."",
				"stu_add"=>"".$data->sheets[$i][cells][$j][55]."",
				"stu_group"=>"".$data->sheets[$i][cells][$j][56]."",
//				"stu_ban"=>"".$_POST['Stu_ban']."",
				"stu_tum"=>"".$Tam."",
				"stu_amp"=>"".$Amp."",
				"stu_prov"=>"".$Prov."",
				"stu_post"=>"".$data->sheets[$i][cells][$j][52]."",
				"stu_best"=>"".$Best."",
				"stu_blood"=>"".$data->sheets[$i][cells][$j][16]."",
				"stu_fpid"=>"".$data->sheets[$i][cells][$j][26]."",
				"stu_mpid"=>"".$data->sheets[$i][cells][$j][32]."",
				"stu_opid"=>"".$data->sheets[$i][cells][$j][37]."",
				"stu_weight"=>"".$data->sheets[$i][cells][$j][63]."",
				"stu_hight"=>"".$data->sheets[$i][cells][$j][64]."",
				"stu_distance"=>"".$data->sheets[$i][cells][$j][73]."",
				"stu_time"=>"".$data->sheets[$i][cells][$j][75]."",
				"stu_travel"=>"".$data->sheets[$i][cells][$j][76]."",
//				"stu_pic"=>"".$_POST['Icon']."",
//				"stu_lat"=>"".$_POST['lat_value']."",
//				"stu_long"=>"".$_POST['lon_value']."" 
			));
			} else {
			$import .=$db->update_db(TB_STUDENT,array(
				"stu_pid"=>"".$data->sheets[$i][cells][$j][3]."",
				"stu_num"=>"".$data->sheets[$i][cells][$j][8]."",
				"stu_name"=>"".$data->sheets[$i][cells][$j][9]."",
				"stu_sur"=>"".$data->sheets[$i][cells][$j][10]."",
				//"stu_nick"=>"".$_POST['Stu_nick']."",
				"stu_sex"=>"".$Sex."",
				"stu_sphone"=>"".$data->sheets[$i][cells][$j][62]."",
				//"stu_email"=>"".$_POST['Stu_email']."",
				//"stu_LineId"=>"".$_POST['Stu_LineId']."",
				"stu_class"=>"".$M."",
				"stu_cn"=>"".$data->sheets[$i][cells][$j][5]."",
				"stu_birth"=>"".$Birthday."",
				"stu_father"=>"".$Father."",
				"stu_fphone"=>"".$data->sheets[$i][cells][$j][31]."",
//				"stu_femail"=>"".$_POST['Stu_femail']."",
//				"stu_fstatus"=>"".$_POST['Stu_fstatus']."",
				"stu_marther"=>"".$Marther."",
				"stu_mphone"=>"".$data->sheets[$i][cells][$j][37]."",
//				"stu_memail"=>"".$_POST['Stu_memail']."",
//				"stu_mstatus"=>"".$_POST['Stu_mstatus']."",
				"stu_status"=>"".$data->sheets[$i][cells][$j][25]."",
				"stu_orther"=>"".$Other."",
				"stu_ophone"=>"".$data->sheets[$i][cells][$j][44]."",
//				"stu_oemail"=>"".$_POST['Stu_oemail']."",
				"stu_ostatus"=>"".$data->sheets[$i][cells][$j][38]."",
				"stu_add"=>"".$data->sheets[$i][cells][$j][55]."",
				"stu_group"=>"".$data->sheets[$i][cells][$j][56]."",
//				"stu_ban"=>"".$_POST['Stu_ban']."",
				"stu_tum"=>"".$Tam."",
				"stu_amp"=>"".$Amp."",
				"stu_prov"=>"".$Prov."",
				"stu_post"=>"".$data->sheets[$i][cells][$j][52]."",
				"stu_best"=>"".$Best."",
				"stu_blood"=>"".$data->sheets[$i][cells][$j][16]."",
				"stu_fpid"=>"".$data->sheets[$i][cells][$j][26]."",
				"stu_mpid"=>"".$data->sheets[$i][cells][$j][32]."",
				"stu_opid"=>"".$data->sheets[$i][cells][$j][37]."",
				"stu_weight"=>"".$data->sheets[$i][cells][$j][63]."",
				"stu_hight"=>"".$data->sheets[$i][cells][$j][64]."",
				"stu_distance"=>"".$data->sheets[$i][cells][$j][73]."",
				"stu_time"=>"".$data->sheets[$i][cells][$j][75]."",
				"stu_travel"=>"".$data->sheets[$i][cells][$j][76]."",
//				"stu_pic"=>"".$_POST['Icon']."",
//				"stu_lat"=>"".$_POST['lat_value']."",
//				"stu_long"=>"".$_POST['lon_value']."" 
			)," stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id=".$data->sheets[$i][cells][$j][6]." ");
			}

		}
	}
}


	} else {
		$import .='';
	}

	if($import){
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