<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/function.in.php");
require_once("../../../includes/class.mysql.php");
$db = New DB();
$add='';
$edit='';
$del='';
//$Avatar='';
CheckAdminGroup($_SESSION['admin_login'],$_SESSION['admin_pwd'],$_SESSION['admin_group']); 
if(!empty($_SESSION['admin_login'])){
/*
if($_POST['OP']=='Add'){
	if( $_POST['Class_id'] !='' && $_POST['Class_Sh'] !='' && $_POST['Class_name'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$add .=$db->add_db(TB_CLASS,array(
			"class_id"=>"".$_POST['Class_id']."",
			"class_area"=>"".$_SESSION['admin_area']."",
			"class_code"=>"".$_SESSION['admin_school']."",
			"class_short"=>"".$_POST['Class_Sh']."",
			"class_name"=>"".$_POST['Class_name'].""
		));
		while(list($key, $value) = each ($_POST['Class_tech'])){
		$add .=$db->add_db(TB_CLASS_PERSON,array(
			"clper_class"=>"".$_POST['Class_id']."",
			"clper_tech"=>"".$value.""
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
	if( $_POST['Class_id'] !='' && $_POST['Class_Sh'] !='' && $_POST['Class_name'] !='' ){//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$edit .=$db->update_db(TB_CLASS,array(
			"class_name"=>"".$_POST['Class_name']."",
			"class_short"=>"".$_POST['Class_Sh'].""
		)," class_area='".$_SESSION['admin_area']."' and class_school='".$_SESSION['admin_school']."' and class_id=".$_POST['CLID']." ");
		$edit .=$db->del(TB_CLASS_PERSON," clper_area='".$_SESSION['admin_area']."' and clper_code='".$_SESSION['admin_school']."' and clper_class='".$_POST['CLID']."' ");
		while(list($key, $value) = each ($_POST['Class_tech'])){
		$edit .=$db->add_db(TB_CLASS_PERSON,array(
			"clper_area"=>"".$_SESSION['admin_area']."",
			"clper_code"=>"".$_SESSION['admin_school']."",
			"clper_class"=>"".$_POST['Class_id']."",
			"clper_tech"=>"".$value.""
		));
		}
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
 */

if($_POST['OP']=='Add'){
	if( $_POST['Class_ID'] !='' && $_POST['Class_name'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' and clg_name='".$_POST['Class_name']."' and clg_group='".$_POST['Class_ID']."' "); 
		@$arr['class']= $db->fetch(@$res['class']);
		if(empty(@$arr['class']['clgid'])){
		$add .=$db->add_db(TB_CLASS_GROUP,array(
			"clg_group"=>"".$_POST['Class_ID']."",
			"clg_area"=>"".$_SESSION['admin_area']."",
			"clg_school"=>"".$_SESSION['admin_school']."",
			"clg_name"=>"".$_POST['Class_name']."",
			"clg_LineId"=>"".$_POST['Class_LineId'].""
		));
		$add .=$db->del(TB_CLASS_PERSON," clper_area='".$_SESSION['admin_area']."' and clper_code='".$_SESSION['admin_school']."' and clper_gr='".$_POST['Class_name']."' and clper_class='".$_POST['Class_ID']."' ");
		while(list($key, $value) = each ($_POST['Class_tech'])){
		$add .=$db->add_db(TB_CLASS_PERSON,array(
			"clper_class"=>"".$_POST['Class_ID']."",
			"clper_area"=>"".$_SESSION['admin_area']."",
			"clper_code"=>"".$_SESSION['admin_school']."",
			"clper_gr"=>"".$_POST['Class_name']."",
			"clper_tech"=>"".$value.""
		));
		}
		} else {
		$add .=$db->update_db(TB_CLASS_GROUP,array(
//			"clg_group"=>"".$_POST['Class_group']."",
			"clg_name"=>"".$_POST['Class_name']."",
			"clg_LineId"=>"".$_POST['Class_LineId'].""
		)," clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' and clg_group=".$_POST['Class_ID']." ");

		$add .=$db->del(TB_CLASS_PERSON," clper_area='".$_SESSION['admin_area']."' and clper_code='".$_SESSION['admin_school']."' and clper_gr='".$_POST['Class_name']."' and clper_class='".$_POST['Class_ID']."' ");

		while(list($key, $value) = each ($_POST['Class_tech'])){
		$add .=$db->add_db(TB_CLASS_PERSON,array(
			"clper_area"=>"".$_SESSION['admin_area']."",
			"clper_code"=>"".$_SESSION['admin_school']."",
			"clper_gr"=>"".$_POST['Class_name']."",
			"clper_class"=>"".$_POST['Class_ID']."",
			"clper_tech"=>"".$value.""
		));
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
	if( $_POST['CLID'] !='' && $_POST['CLCN'] !='' ){//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' and clg_group='".$_POST['CLID']."' and clg_name='".$_POST['CLCN']."' "); 
		@$row['class']= $db->rows(@$res['class']);
		if($row['class']>0){
		$edit .=$db->update_db(TB_CLASS_GROUP,array(
//			"clg_group"=>"".$_POST['Class_group']."",
//			"clg_name"=>"".$_POST['Class_name']."",
			"clg_LineId"=>"".$_POST['Class_LineId'].""
		)," clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' and clg_group='".$_POST['CLID']."' and clg_name='".$_POST['CLCN']."' ");
		}
		$edit .=$db->del(TB_CLASS_PERSON," clper_area='".$_SESSION['admin_area']."' and clper_code='".$_SESSION['admin_school']."' and clper_gr='".$_POST['CLCN']."' and clper_class='".$_POST['CLID']."' ");

		while(list($key, $value) = each ($_POST['Class_tech'])){
		$edit .=$db->add_db(TB_CLASS_PERSON,array(
			"clper_area"=>"".$_SESSION['admin_area']."",
			"clper_code"=>"".$_SESSION['admin_school']."",
			"clper_gr"=>"".$_POST['CLCN']."",
			"clper_class"=>"".$_POST['CLID']."",
			"clper_tech"=>"".$value.""
		));
		}
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