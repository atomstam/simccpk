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
	if( $_POST['Ext_stu'] !='' && $_POST['Ext_ext'] !='' && $_POST['Ext_Dtime'] !='' && $_POST['Etail_name'] !='' ){

		$expArray = explode(" ",$_POST['Ext_Dtime']);
		$expArray[0]=$expArray[0];
		$expArray[1]=$expArray[1];
		@$Ext=count($_POST['Ext_stu']);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		for($i=0;$i<$Ext;$i++){
						$add .=$db->add_db(TB_EXITTAIL,array(
						"ext_area"=>"".$_SESSION['admin_area']."",
						"ext_code"=>"".$_SESSION['admin_school']."",
						"ext_tail"=>"".$_POST['Ext_ext']."",
						"ext_stu"=>"".$_POST['Ext_stu'][$i]."",
						"ext_date"=>"".$expArray[0]."",
						"ext_tailname"=>"".$_POST['Etail_name']."",
						"ext_check"=>"".$_POST['Ext_Dtime'].""
						));
						@$res['sh'] = $db->select_query("Insert into ".TB_STUDENT_BAK." as b SELECT * FROM ".TB_STUDENT." as b where  b.stu_id='".$_POST['Ext_stu'][$i]."' "); 
						@$arr['sh'] = $db->fetch(@$res['sh']);

						$db->del(TB_STUDENT," stu_id='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_AFFTAIL," afft_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_ENTTAIL," got_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_EXITTAIL," ext_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_GOHOME," go_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_NUT," nut_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_RUBRONG," rub_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_BAD," bad_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_GOOD," good_stu='".$_POST['Ext_stu'][$i]."' ");						
						//$db->del(TB_BESTTAIL," btail_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_COUNTAIL," cot_stu='".$_POST['Ext_stu'][$i]."' ");		
						//$db->del(TB_MOTORTAIL," mot_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_PUTTAIL," pt_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_SPACIALTAIL," stail_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_WHITECLTAIL," whcl_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_CHCLASS," c_stu='".$_POST['Ext_stu'][$i]."' ");
						//$db->del(TB_TUNBON," tab_stu='".$_POST['Ext_stu'][$i]."' ");
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
	if( $_POST['Ext_stu'] !='' && $_POST['Ext_ext'] !='' && $_POST['Ext_Dtime'] !='' && $_POST['Etail_name'] !='' ){
$expArray = explode(" ",$_POST['Ext_Dtime']);
$expArray[0]=$expArray[0];
$expArray[1]=$expArray[1];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$edit .=$db->update_db(TB_EXITTAIL,array(
						"ext_area"=>"".$_SESSION['admin_area']."",
						"ext_code"=>"".$_SESSION['admin_school']."",
						"ext_tail"=>"".$_POST['Ext_ext']."",
						"ext_date"=>"".$expArray[0]."",
						"ext_tailname"=>"".$_POST['Etail_name']."",
						"ext_check"=>"".$_POST['Ext_Dtime'].""
		)," ext_id=".$_POST['Ext_id']." ");

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