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
if(!empty($_SESSION['stu_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['nut_stu'] !='' && $_POST['nut_bad'] !='' && $_POST['nut_name'] !='' && $_POST['nut_dateco'] !='' && $_POST['nut_per'] !='' && $_POST['nut_check'] !=''){

//$expArray = explode(" ",$_POST['Ent_Dtime']);
//$expArray[0]=$expArray[0];
//$expArray[1]=$expArray[1];

		$Bad=implode(",",$_POST['nut_bad']);
		$DateT=date('Y-m-d H:i:s');
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		for($i=0;$i<count($_POST['nut_stu']);$i++){

						@$res['core'] = $db->select_query("select *,sum(badtail_point) as CO  from ".TB_BAD." ,".TB_STUDENT.",".TB_BADTAIL." where stu_id=bad_stu and bad_tail=badtail_id and stu_id='".$_POST['nut_stu'][$i]."' group by stu_id ");
						@$arr['score'] = $db->fetch(@$res['core']);

						$add .=$db->add_db(TB_NUT,array(
						"nut_stu"=>"".$_POST['nut_stu'][$i]."",
						"nut_area"=>"".$_SESSION['stu_area']."",
						"nut_code"=>"".$_SESSION['stu_school']."",
						"nut_score"=>"".@$arr['score']['CO']."",
						"nut_bad"=>"".$Bad."",
						"nut_name"=>"".$_POST['nut_name']."",
						"nut_dateT"=>"".$DateT."",
						"nut_dateco"=>"".$_POST['nut_dateco']."",
						"nut_per"=>"".$_POST['nut_per']."",
						"nut_check"=>"".$_POST['nut_check'].""
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

if($_POST['OP']=='bAdd'){
	if( $_POST['nut_stu'] !='' && $_POST['nut_name'] !='' && $_POST['nut_dateco'] !='' && $_POST['nut_per'] !='' && $_POST['nut_check'] !=''){

//$expArray = explode(" ",$_POST['Ent_Dtime']);
//$expArray[0]=$expArray[0];
//$expArray[1]=$expArray[1];

		//$Bad=implode(",",$_POST['nut_bad']);
		$DateT=date('Y-m-d H:i:s');
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['core'] = $db->select_query("select *,sum(badtail_point) as CO  from ".TB_BAD." ,".TB_STUDENT.",".TB_BADTAIL." where stu_id=bad_stu and bad_tail=badtail_id and stu_id='".$_POST['nut_stu']."' group by stu_id ");
		@$arr['score'] = $db->fetch(@$res['core']);
		@$res['bad'] = $db->select_query("select * from ".TB_BAD." ,".TB_BADTAIL." where bad_tail=badtail_id and bad_stu='".$_POST['nut_stu']."' group by bad_tail ");
		while(@$arr['bad'] = $db->fetch(@$res['bad'])){
			$btail[]=@$arr['bad']['bad_tail'];
		}
		//$add=$btail;
					//for($i=0;$i<count($btail);$i++){
					//	$dd[]=$btail[$i].",";
					//}
					//$div = explode(",",$btail);
					$div = implode(",",$btail);

						$add=$db->add_db(TB_NUT,array(
						"nut_stu"=>"".$_POST['nut_stu']."",
						"nut_area"=>"".$_SESSION['stu_area']."",
						"nut_code"=>"".$_SESSION['stu_school']."",
						"nut_score"=>"".@$arr['score']['CO']."",
						"nut_bad"=>"".$div."",
						"nut_name"=>"".$_POST['nut_name']."",
						"nut_dateT"=>"".$DateT."",
						"nut_dateco"=>"".$_POST['nut_dateco']."",
						"nut_per"=>"".$_POST['nut_per']."",
						"nut_check"=>"".$_POST['nut_check'].""
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
	if( $_POST['nut_stu'] !='' && $_POST['nut_bad'] !='' && $_POST['nut_name'] !='' && $_POST['nut_dateco'] !='' && $_POST['nut_per'] !='' && $_POST['nut_check'] !=''){
//$expArray = explode(" ",$_POST['Ent_Dtime']);
//$expArray[0]=$expArray[0];
//$expArray[1]=$expArray[1];
		$Bad=implode(",",$_POST['nut_bad']);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

		@$res['core'] = $db->select_query("select *,sum(badtail_point) as CO  from ".TB_BAD." ,".TB_STUDENT.",".TB_BADTAIL." where stu_id=bad_stu and bad_tail=badtail_id and stu_id='".$_POST['nut_stu']."' group by stu_id ");
		@$arr['score'] = $db->fetch(@$res['core']);

		$edit .=$db->update_db(TB_NUT,array(
						"nut_area"=>"".$_SESSION['stu_area']."",
						"nut_code"=>"".$_SESSION['stu_school']."",
						"nut_score"=>"".@$arr['score']['CO']."",
						"nut_bad"=>"".$Bad."",
						"nut_name"=>"".$_POST['nut_name']."",
						"nut_dateco"=>"".$_POST['nut_dateco']."",
						"nut_per"=>"".$_POST['nut_per']."",
						"nut_check"=>"".$_POST['nut_check'].""
		)," nut_id=".$_POST['nut_id']." ");

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