<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysqli.php");
$db = New DB();
$add='';
$edit='';
$del='';
$Date=date('Y-m-d');
//$Avatar='';
if(!empty($_SESSION['admin_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['Sh_area'] !='' && $_POST['Sh_code'] !='' && $_POST['P_name'] !='' ){ //		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

			if(!empty($_POST['Icon'])){
			$add .=$db->add_db(TB_PERSONNEL,array(
			"p_area"=>"".$_SESSION['admin_area']."",
			"p_code"=>"".$_POST['Sh_code']."",
			"p_name"=>"".$_POST['P_name']."",
			"p_position"=>"".$_POST['P_position']."",
			"p_data"=>"".$_POST['P_data']."",
			"p_vit"=>"".$_POST['P_vit']."",
			"p_ake"=>"".$_POST['P_ake']."",
			"p_wut"=>"".$_POST['P_wut']."",
			"p_add"=>"".$_POST['P_add']."",
			"p_tel"=>"".$_POST['P_tel']."",
			"p_mail"=>"".$_POST['P_mail']."",
			"p_fb"=>"".$_POST['P_fb']."",
			"p_line"=>"".$_POST['P_line']."",
			"p_pic"=>"".$_POST['Icon']."",
			"sort"=>"".$_POST['P_sort']."",
			"boss"=>"".$_POST['P_boss']."",
			"p_posted"=>"".$_SESSION['admin_login']."",
			"p_post_date"=>"".$Date.""
			));
			} else {
			$add .=$db->add_db(TB_PERSONNEL,array(
			"p_area"=>"".$_SESSION['admin_area']."",
			"p_code"=>"".$_POST['Sh_code']."",
			"p_name"=>"".$_POST['P_name']."",
			"p_position"=>"".$_POST['P_position']."",
			"p_data"=>"".$_POST['P_data']."",
			"p_vit"=>"".$_POST['P_vit']."",
			"p_ake"=>"".$_POST['P_ake']."",
			"p_wut"=>"".$_POST['P_wut']."",
			"p_add"=>"".$_POST['P_add']."",
			"p_tel"=>"".$_POST['P_tel']."",
			"p_mail"=>"".$_POST['P_mail']."",
			"p_fb"=>"".$_POST['P_fb']."",
			"p_line"=>"".$_POST['P_line']."",
			"sort"=>"".$_POST['P_sort']."",
			"boss"=>"".$_POST['P_boss']."",
			"p_posted"=>"".$_SESSION['admin_login']."",
			"p_post_date"=>"".$Date.""
			));
			}

			$Per['per']=$db->select_query("SELECT p_id FROM ".TB_PERSONNEL." where p_code='".$_POST['Sh_code']."' order by p_id desc limit 1 ");
			$arr['per']= $db->fetch($Per['per']);

  		for($i=1;$i<=(int)($_POST['LSIDs'.$i]);$i++)
		{
			if($_POST['Ls_detail'.$i] != "")
			{
			$add .=$db->add_db(TB_PERSONNEL_LS,array(
			"ls_area"=>"".$_SESSION['admin_area']."",
			"ls_code"=>"".$_POST['Sh_code']."",
			"g_id"=>"".$_POST['LSIDs'.$i]."",
			"u_id"=>"".$arr['per']['p_id']."",
			"p_detail"=>"".$_POST['Ls_detail'.$i]."",
			"p_order"=>"".$_POST['Ls_sort'.$i]."",
			"ls_posted"=>"".$_SESSION['admin_login']."",
			"ls_post_date"=>"".$Date.""
			));
			} else {
			$add .=$db->del(TB_PERSONNEL_LS," u_id='".$arr['per']['p_id']."' and g_id='".$_POST['LSIDs'.$i]."' and ls_code='".$_POST['Sh_code']."' ");
			}

		}

  		for($iw=1;$iw<=(int)($_POST['WID'.$iw]);$iw++)
		{
			if($_POST['Wut_ake'.$iw] != "")
			{
			$add .=$db->add_db(TB_PERSONNEL_EDU,array(
			"edu_area"=>"".$_SESSION['admin_area']."",
			"edu_code"=>"".$_POST['Sh_code']."",
			"edu_uid"=>"".$arr['per']['p_id']."",
			"edu_yearfin"=>"".$_POST['Wut_yearfin'.$iw]."",
			"edu_ake"=>"".$_POST['Wut_ake'.$iw]."",
			"edu_wut"=>"".$_POST['WUT'.$iw]."",
			"edu_wut_short_thai"=>"".$_POST['Wut_thai'.$iw]."",
			"edu_wut_short_eng"=>"".$_POST['Wut_eng'.$iw]."",
			"edu_uni"=>"".$_POST['Wut_uni'.$iw]."",
			"edu_posted"=>"".$_SESSION['admin_login']."",
			"edu_post_date"=>"".$Date.""
			));
			} else {
			$add .=$db->del(TB_PERSONNEL_EDU," edu_code='".$_POST['Sh_code']."' and edu_uid='".$arr['per']['p_id']."' and edu_wut='".$_POST['WUT'.$iw]."' ");
			}

		}


  		for($ih=1;$ih<=(int)($_POST['HIS'.$ih]);$ih++)
		{
			if($_POST['His_year'.$ih] != "")
			{
			$add .=$db->add_db(TB_PERSONNEL_HIS,array(
			"his_area"=>"".$_SESSION['admin_area']."",
			"his_code"=>"".$_POST['Sh_code']."",
			"his_cate"=>"".$_POST['HIS'.$ih]."",
			"his_uid"=>"".$arr['per']['p_id']."",
			"his_year"=>"".$_POST['His_year'.$ih]."",
			"his_position"=>"".$_POST['His_position'.$ih]."",
			"his_school"=>"".$_POST['His_school'.$ih]."",
			"his_posted"=>"".$_SESSION['admin_login']."",
			"his_post_date"=>"".$Date.""
			));
			} else {
			$add .=$db->del(TB_PERSONNEL_HIS," his_cate='".$_POST['HIS'.$ih]."' and his_uid='".$arr['per']['p_id']."' and his_code='".$_POST['Sh_code']."' ");
			}

		}


 		for($ips=1;$ips<=(int)($_POST['PO'.$ips]);$ips++)
		{
			if($_POST['Po_year'.$ips] != "")
			{
			$add .=$db->add_db(TB_PERSONNEL_PORT,array(
			"port_area"=>"".$_SESSION['admin_area']."",
			"port_code"=>"".$_POST['Sh_code']."",
			"port_cate"=>"".$_POST['PO'.$ips]."",
			"port_uid"=>"".$arr['per']['p_id']."",
			"port_year"=>"".$_POST['Po_year'.$ips]."",
			"port_name"=>"".$_POST['Po_name'.$ips]."",
			"port_organ"=>"".$_POST['Po_organ'.$ips]."",
			"port_posted"=>"".$_SESSION['admin_login']."",
			"port_post_date"=>"".$Date.""
			));
			} else {
			$add .=$db->del(TB_PERSONNEL_PORT," port_cate='".$_POST['PO'.$ips]."' and port_uid='".$arr['per']['p_id']."' and port_code='".$_POST['Sh_code']."' ");
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

if($_POST['OP']=='Edit'){
	if( $_POST['SID'] !='' && $_POST['PERID'] !='' && $_POST['P_name'] !='' ){ //		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

			$Per['per']=$db->select_query("SELECT * FROM ".TB_PERSONNEL." where p_code='".$_POST['SID']."' and p_id='".$_POST['PERID']."' ");
			$arr['per']= $db->fetch($Per['per']);
			if(!empty($arr['per']['p_id'])){
			if(!empty($_POST['Icon'])){
			$edit .=$db->update_db(TB_PERSONNEL,array(
			"p_area"=>"".$_SESSION['admin_area']."",
			"p_code"=>"".$_POST['SID']."",
			"p_name"=>"".$_POST['P_name']."",
			"p_position"=>"".$_POST['P_position']."",
			"p_data"=>"".$_POST['P_data']."",
			"p_vit"=>"".$_POST['P_vit']."",
			"p_ake"=>"".$_POST['P_ake']."",
			"p_wut"=>"".$_POST['P_wut']."",
			"p_add"=>"".$_POST['P_add']."",
			"p_tel"=>"".$_POST['P_tel']."",
			"p_mail"=>"".$_POST['P_mail']."",
			"p_fb"=>"".$_POST['P_fb']."",
			"p_line"=>"".$_POST['P_line']."",
			"p_pic"=>"".$_POST['Icon']."",
			"sort"=>"".$_POST['P_sort']."",
			"boss"=>"".$_POST['P_boss']."",
			"p_posted"=>"".$_SESSION['admin_login']."",
			"p_post_date"=>"".$Date.""
			)," p_code=".$_POST['SID']." and p_id='".$_POST['PERID']."' ");
			} else {
			$edit .=$db->update_db(TB_PERSONNEL,array(
			"p_area"=>"".$_SESSION['admin_area']."",
			"p_code"=>"".$_POST['SID']."",
			"p_name"=>"".$_POST['P_name']."",
			"p_position"=>"".$_POST['P_position']."",
			"p_data"=>"".$_POST['P_data']."",
			"p_vit"=>"".$_POST['P_vit']."",
			"p_ake"=>"".$_POST['P_ake']."",
			"p_wut"=>"".$_POST['P_wut']."",
			"p_add"=>"".$_POST['P_add']."",
			"p_tel"=>"".$_POST['P_tel']."",
			"p_mail"=>"".$_POST['P_mail']."",
			"p_fb"=>"".$_POST['P_fb']."",
			"p_line"=>"".$_POST['P_line']."",
			"sort"=>"".$_POST['P_sort']."",
			"boss"=>"".$_POST['P_boss']."",
			"p_posted"=>"".$_SESSION['admin_login']."",
			"p_post_date"=>"".$Date.""
			)," p_code=".$_POST['SID']." and p_id='".$_POST['PERID']."' ");
			}
			} else {
			if(!empty($_POST['Icon'])){
			$edit .=$db->add_db(TB_PERSONNEL,array(
			"p_name"=>"".$_POST['P_name']."",
			"p_position"=>"".$_POST['P_position']."",
			"p_data"=>"".$_POST['P_data']."",
			"p_vit"=>"".$_POST['P_vit']."",
			"p_ake"=>"".$_POST['P_ake']."",
			"p_wut"=>"".$_POST['P_wut']."",
			"p_add"=>"".$_POST['P_add']."",
			"p_tel"=>"".$_POST['P_tel']."",
			"p_mail"=>"".$_POST['P_mail']."",
			"p_fb"=>"".$_POST['P_fb']."",
			"p_line"=>"".$_POST['P_line']."",
			"p_pic"=>"".$_POST['Icon']."",
			"sort"=>"".$_POST['P_sort']."",
			"boss"=>"".$_POST['P_boss']."",
			"p_posted"=>"".$_SESSION['admin_login']."",
			"p_post_date"=>"".$Date.""
			));
			} else {
			$edit .=$db->add_db(TB_PERSONNEL,array(
			"p_name"=>"".$_POST['P_name']."",
			"p_position"=>"".$_POST['P_position']."",
			"p_data"=>"".$_POST['P_data']."",
			"p_vit"=>"".$_POST['P_vit']."",
			"p_ake"=>"".$_POST['P_ake']."",
			"p_wut"=>"".$_POST['P_wut']."",
			"p_add"=>"".$_POST['P_add']."",
			"p_tel"=>"".$_POST['P_tel']."",
			"p_mail"=>"".$_POST['P_mail']."",
			"p_fb"=>"".$_POST['P_fb']."",
			"p_line"=>"".$_POST['P_line']."",
			"sort"=>"".$_POST['P_sort']."",
			"boss"=>"".$_POST['P_boss']."",
			"p_posted"=>"".$_SESSION['admin_login']."",
			"p_post_date"=>"".$Date.""
			));
			}
			}

  		for($i=1;$i<=(int)($_POST['LSIDs'.$i]);$i++)
		{
			$res['Ls']=$db->select_query("SELECT * FROM ".TB_PERSONNEL_LS." where u_id='".$_POST['PERID']."' and g_id='".$_POST['LSIDs'.$i]."' and ls_code='".$_POST['SID']."' ");
			$arr['Ls']= $db->fetch($res['Ls']);
			if($_POST['Ls_detail'.$i] != "")
			{
			if(!empty($arr['Ls']['ls_id'])){
			$edit .=$db->update_db(TB_PERSONNEL_LS,array(
			"g_id"=>"".$_POST['LSIDs'.$i]."",
			"u_id"=>"".$_POST['PERID']."",
			"p_detail"=>"".$_POST['Ls_detail'.$i]."",
			"p_order"=>"".$_POST['Ls_sort'.$i]."",
			"ls_posted"=>"".$_SESSION['admin_login']."",
			"ls_post_date"=>"".$Date.""
			)," ls_id=".$arr['Ls']['ls_id']." ");
			} else {
			$edit .=$db->add_db(TB_PERSONNEL_LS,array(
			"ls_area"=>"".$_SESSION['admin_area']."",
			"ls_code"=>"".$_POST['SID']."",
			"g_id"=>"".$_POST['LSIDs'.$i]."",
			"u_id"=>"".$_POST['PERID']."",
			"p_detail"=>"".$_POST['Ls_detail'.$i]."",
			"p_order"=>"".$_POST['Ls_sort'.$i]."",
			"ls_posted"=>"".$_SESSION['admin_login']."",
			"ls_post_date"=>"".$Date.""
			));
			}
			} else {
			$edit .=$db->del(TB_PERSONNEL_LS," u_id='".$_POST['PERID']."' and g_id='".$_POST['LSIDs'.$i]."' and ls_code='".$_POST['SID']."' ");
			}

		}

  		for($iw=1;$iw<=(int)($_POST['WID'.$iw]);$iw++)
		{
			$res['Wt']=$db->select_query("SELECT * FROM ".TB_PERSONNEL_EDU." where edu_code='".$_POST['SID']."' and edu_uid='".$_POST['PERID']."' and edu_wut='".$_POST['WUT'.$iw]."'  ");
			$arr['Wt']= $db->fetch($res['Wt']);
			if($_POST['Wut_ake'.$iw] != "")
			{
			if(!empty($arr['Wt']['edu_id'])){
			$edit .=$db->update_db(TB_PERSONNEL_EDU,array(
			"edu_uid"=>"".$_POST['PERID']."",
			"edu_yearfin"=>"".$_POST['Wut_yearfin'.$iw]."",
			"edu_ake"=>"".$_POST['Wut_ake'.$iw]."",
			"edu_wut"=>"".$_POST['WUT'.$iw]."",
			"edu_wut_short_thai"=>"".$_POST['Wut_thai'.$iw]."",
			"edu_wut_short_eng"=>"".$_POST['Wut_eng'.$iw]."",
			"edu_uni"=>"".$_POST['Wut_uni'.$iw]."",
			"edu_posted"=>"".$_SESSION['admin_login']."",
			"edu_post_date"=>"".$Date.""
			)," edu_id=".$arr['Wt']['edu_id']." ");
			} else {
			$edit .=$db->add_db(TB_PERSONNEL_EDU,array(
			"edu_area"=>"".$_SESSION['admin_area']."",
			"edu_code"=>"".$_POST['SID']."",
			"edu_uid"=>"".$_POST['PERID']."",
			"edu_yearfin"=>"".$_POST['Wut_yearfin'.$iw]."",
			"edu_ake"=>"".$_POST['Wut_ake'.$iw]."",
			"edu_wut"=>"".$_POST['WUT'.$iw]."",
			"edu_wut_short_thai"=>"".$_POST['Wut_thai'.$iw]."",
			"edu_wut_short_eng"=>"".$_POST['Wut_eng'.$iw]."",
			"edu_uni"=>"".$_POST['Wut_uni'.$iw]."",
			"edu_posted"=>"".$_SESSION['admin_login']."",
			"edu_post_date"=>"".$Date.""
			));
			}
			} else {
			$edit .=$db->del(TB_PERSONNEL_EDU," edu_code='".$_POST['SID']."' and edu_uid='".$_POST['PERID']."' and edu_wut='".$_POST['WUT'.$iw]."' ");
			}

		}


  		for($ih=1;$ih<=(int)($_POST['HIS'.$ih]);$ih++)
		{
			$res['his']=$db->select_query("SELECT * FROM ".TB_PERSONNEL_HIS." where his_cate='".$_POST['HIS'.$ih]."' and his_uid='".$_POST['PERID']."' and his_code='".$_POST['SID']."' ");
			$arr['his']= $db->fetch($res['his']);
			if($_POST['His_year'.$ih] != "")
			{
			if(!empty($arr['his']['his_id'])){
			$edit .=$db->update_db(TB_PERSONNEL_HIS,array(
			"his_cate"=>"".$_POST['HIS'.$ih]."",
			"his_uid"=>"".$_POST['PERID']."",
			"his_year"=>"".$_POST['His_year'.$ih]."",
			"his_position"=>"".$_POST['His_position'.$ih]."",
			"his_school"=>"".$_POST['His_school'.$ih]."",
			"his_posted"=>"".$_SESSION['admin_login']."",
			"his_post_date"=>"".$Date.""
			)," his_id=".$arr['his']['his_id']." ");
			} else {
			$edit .=$db->add_db(TB_PERSONNEL_HIS,array(
			"his_area"=>"".$_SESSION['admin_area']."",
			"his_code"=>"".$_POST['SID']."",
			"his_cate"=>"".$_POST['HIS'.$ih]."",
			"his_uid"=>"".$_POST['PERID']."",
			"his_year"=>"".$_POST['His_year'.$ih]."",
			"his_position"=>"".$_POST['His_position'.$ih]."",
			"his_school"=>"".$_POST['His_school'.$ih]."",
			"his_posted"=>"".$_SESSION['admin_login']."",
			"his_post_date"=>"".$Date.""
			));
			}
			} else {
			$edit .=$db->del(TB_PERSONNEL_HIS," his_cate='".$_POST['HIS'.$ih]."' and his_uid='".$_POST['PERID']."' and his_code='".$_POST['SID']."' ");
			}

		}


 		for($ips=1;$ips<=(int)($_POST['PO'.$ips]);$ips++)
		{
			$res['port']=$db->select_query("SELECT * FROM ".TB_PERSONNEL_PORT." where port_cate='".$_POST['PO'.$ips]."' and port_uid='".$_POST['PERID']."' and port_code='".$_POST['SID']."' ");
			$arr['port']= $db->fetch($res['port']);
			if($_POST['Po_year'.$ips] != "")
			{
			if(!empty($arr['port']['port_id'])){
			$edit .=$db->update_db(TB_PERSONNEL_PORT,array(
			"port_cate"=>"".$_POST['PO'.$ips]."",
			"port_uid"=>"".$_POST['PERID']."",
			"port_year"=>"".$_POST['Po_year'.$ips]."",
			"port_name"=>"".$_POST['Po_name'.$ips]."",
			"port_organ"=>"".$_POST['Po_organ'.$ips]."",
			"port_posted"=>"".$_SESSION['admin_login']."",
			"port_post_date"=>"".$Date.""
			)," port_id=".$arr['port']['port_id']." ");
			} else {
			$edit .=$db->add_db(TB_PERSONNEL_PORT,array(
			"port_area"=>"".$_SESSION['admin_area']."",
			"port_code"=>"".$_POST['SID']."",
			"port_cate"=>"".$_POST['PO'.$ips]."",
			"port_uid"=>"".$_POST['PERID']."",
			"port_year"=>"".$_POST['Po_year'.$ips]."",
			"port_name"=>"".$_POST['Po_name'.$ips]."",
			"port_organ"=>"".$_POST['Po_organ'.$ips]."",
			"port_posted"=>"".$_SESSION['admin_login']."",
			"port_post_date"=>"".$Date.""
			));
			}
			} else {
			$edit .=$db->del(TB_PERSONNEL_PORT," port_cate='".$_POST['PO'.$ips]."' and port_uid='".$_POST['PERID']."' and port_code='".$_POST['SID']."' ");
			}

		}


	} else {
		$edit ='';
	}

	if($edit){
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

if($_POST['OP']=='Del'){
	if( $_POST['CLIDS'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$del .=$db->del(TB_PERSONNEL," p_code='".$_POST['CLIDS']."' ");
		$del .=$db->del(TB_PERSONNEL_LS," ls_code='".$_POST['CLIDS']."' ");
		$del .=$db->del(TB_PERSONNEL_EDU," edu_code='".$_POST['CLIDS']."' ");
		$del .=$db->del(TB_PERSONNEL_HIS," his_code='".$_POST['CLIDS']."' ");
		$del .=$db->del(TB_PERSONNEL_PORT," port_code='".$_POST['CLIDS']."' ");

	} else {
		$del .='';
	}

	if($del){
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



if($_POST['OP']=='DelAll'){
	if( $_POST['CLIDSX'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$ids = explode(",",$_POST['CLIDSX']);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		while(list($key, $value) = each ($ids)){
//			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$del .=$db->del(TB_PERSONNEL," p_code='".$value."' ");
			$del .=$db->del(TB_PERSONNEL_LS," ls_code='".$value."' ");
			$del .=$db->del(TB_PERSONNEL_EDU," edu_code='".$value."' ");
			$del .=$db->del(TB_PERSONNEL_HIS," his_code='".$value."' ");
			$del .=$db->del(TB_PERSONNEL_PORT," port_code='".$value."' ");
//			$db->closedb ();
		}
//		$del .=$db->del(TB_BOARD," pm_id='".$_POST['CLIDS']."' ");
	} else {
		$del .='';
	}

	if($del){
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


if($_POST['OP']=='ShDel'){
	if( $_POST['CLIDS'] !='' && $_POST['CODEID'] !=''){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$del .=$db->del(TB_PERSONNEL," p_id='".$_POST['CLIDS']."' and p_code='".$_POST['CODEID']."' ");
		$del .=$db->del(TB_PERSONNEL_LS," u_id='".$_POST['CLIDS']."' and ls_code='".$_POST['CODEID']."' ");
		$del .=$db->del(TB_PERSONNEL_EDU," edu_uid='".$_POST['CLIDS']."' and edu_code='".$_POST['CODEID']."' ");
		$del .=$db->del(TB_PERSONNEL_HIS," his_uid='".$_POST['CLIDS']."' and his_code='".$_POST['CODEID']."' ");
		$del .=$db->del(TB_PERSONNEL_PORT," port_uid='".$_POST['CLIDS']."' and port_code='".$_POST['CODEID']."' ");

	} else {
		$del .='';
	}

	if($del){
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


if($_POST['OP']=='ShDelAll'){
	if( $_POST['CLIDSX'] !='' && $_POST['CODEIDX'] !=''){
//		$Avatar=$_FILES['avatar-1']['name'];
		$ids = explode(",",$_POST['CLIDSX']);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		while(list($key, $value) = each ($ids)){
//			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$del .=$db->del(TB_PERSONNEL," p_id='".$value."' and p_code='".$_POST['CODEIDX']."' ");
			$del .=$db->del(TB_PERSONNEL_LS," u_id='".$value."' and ls_code='".$_POST['CODEIDX']."'  ");
			$del .=$db->del(TB_PERSONNEL_EDU," edu_uid='".$value."' and edu_code='".$_POST['CODEIDX']."' ");
			$del .=$db->del(TB_PERSONNEL_HIS," his_uid='".$value."'  and his_code='".$_POST['CODEIDX']."' ");
			$del .=$db->del(TB_PERSONNEL_PORT," port_uid='".$value."' and port_code='".$_POST['CODEIDX']."' ");
//			$db->closedb ();
		}
//		$del .=$db->del(TB_BOARD," pm_id='".$_POST['CLIDS']."' ");
	} else {
		$del .='';
	}

	if($del){
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

} else { echo "<meta http-equiv='refresh' content='1; url=../../index.php'>"; 

}?>