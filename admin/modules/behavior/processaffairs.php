<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/affairs.php");
require_once("../../../lang/thai.php");
$db = New DB();
$add='';
$edit='';
$del='';
//$Avatar='';
if(!empty($_SESSION['admin_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['Stu_best'] !='' && $_POST['Pu_Dtime'] && $_POST['Btail_name'] !='' && $_POST['Stu_class4'] !='' && $_POST['Stu_cn'] !=''  ){

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

		//@$res['aff'] = $db->select_query("SELECT * FROM ".TB_AFFTAIL." WHERE afft_area='".$_SESSION['admin_area']."' and afft_code='".$_SESSION['admin_school']."' and afft_aff='".$_POST['Stu_best']."' "); 
		//@$arr['aff'] =$db->rows(@$res['aff']);
		//if($arr['aff']==0){

		$Mtime=time();
		@$res['tail'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." WHERE aff_area='".$_SESSION['admin_area']."' and aff_code='".$_SESSION['admin_school']."' and aff_id='".$_POST['Stu_best']."' "); 
		@$arr['tail'] =$db->fetch(@$res['tail']);

	list($Y , $m , $d) = explode("-" , $_POST['Pu_Dtime']);
	$y=$Y+543;
	$RANK=$_POST['rank']+1;
	for ($i=0; $i < $RANK; $i++) {
		if(!empty($_POST['StuID'][$i])){

				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." left join ".TB_CLASS_GROUP." on clg_group=stu_class and clg_name=stu_cn left join ".TB_CLASS." on class_id=stu_class WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' group by stu_id"); 
				@$arr['stu'] = $db->fetch(@$res['stu']);

				$Stu_name=@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur'];
				$Stu_class=@$arr['stu']['stu_class'];
				$Stu_cn=@$arr['stu']['stu_cn'];
				$Stu_short=@$arr['stu']['class_short'];
				$Stu_Token=@$arr['stu']['clg_LineId'];

				@$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$_SESSION['admin_login']."' "); 
				@$arr['user'] = $db->fetch(@$res['user']);
				$Tech=@$arr['user']['firstname']." ".@$arr['user']['lastname']." "._text_report_line_message9."".@$arr['user']['phone'];
				$message3 = $Tech."\r\n";

				if($_POST['Ck1'][$i] ==1){
						$add .=$db->add_db(TB_AFFTAIL,array(
						"afft_area"=>"".$_SESSION['admin_area']."",
						"afft_code"=>"".$_SESSION['admin_school']."",
						"afft_aff"=>"".$_POST['Stu_best']."",
						"afft_stu"=>"".$_POST['StuID'][$i]."",
						"afft_name"=>"".$_POST['Btail_name']."",
						"afft_date"=>"".$_POST['Pu_Dtime']."",
						"afft_per"=>"".$_SESSION['admin_login']."",
						"afft_status"=>"1"
						));

					$sql=$db->select_query("SELECT * FROM ".TB_GOODTAIL." WHERE goodtail_area='".$_SESSION['admin_area']."' and goodtail_code='".$_SESSION['admin_school']."' and goodtail_name like '%ช่วยเหลืองานโรงเรียน%' ");
					@$result=$db->fetch($sql);
					$Good_tail= _text_box_table_tab4_true." ".@$arr['tail']['aff_name'];
					$gtailid=@$result['goodtail_id'];

					$add .=$db->add_db(TB_GOOD,array(
					"good_area"=>"".$_SESSION['admin_area']."",
					"good_code"=>"".$_SESSION['admin_school']."",
					"good_stu"=>"".$_POST['StuID'][$i]."",
					"good_tail"=>"".$gtailid."",
					"good_name"=>"".$Good_tail."",
					"good_date"=>"".$d."",
					"good_mouth"=>"".$m."",
					"good_year"=>"".$y."",
					"good_dam"=>"".$_SESSION['admin_login']."",
					"good_t"=>"1",
					"g_date"=>"".$_POST['Pu_Dtime']."",
					"g_Mtime"=>"".$Mtime."",
					"good_sess"=>"".$_SESSION['admin_login'].""
					));	

					//$successx="value : $Stu_class,$Stu_short,$Stu_cn,$Stu_name,$Good_tail,$message3,$Stu_Token<br>";
					//print_r($successx);
					@$resx = Line_To_Class_BG($Stu_class,$Stu_short,$Stu_cn,$Stu_name,$Good_tail,$message3,$Stu_Token);
					print_r(@$resx);

				} else {

					$add .=$db->add_db(TB_AFFTAIL,array(
						"afft_area"=>"".$_SESSION['admin_area']."",
						"afft_code"=>"".$_SESSION['admin_school']."",
						"afft_aff"=>"".$_POST['Stu_best']."",
						"afft_stu"=>"".$_POST['StuID'][$i]."",
						"afft_name"=>"".$_POST['Btail_name']."",
						"afft_date"=>"".$_POST['Pu_Dtime']."",
						"afft_per"=>"".$_SESSION['admin_login']."",
						"afft_status"=>"0"
					));

					$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' and badtail_name like '%ไม่ร่วมกิจกรรมโรงเรียน%' ");
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

	//	} else {
	//		$add .='';
	//	}

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
	if( $_POST['Best_stu'] !='' && $_POST['Stu_best'] !='' && $_POST['Btail_name'] !='' && $_POST['Best_status'] !=''){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$edit .=$db->update_db(TB_AFFTAIL,array(
						"afft_aff"=>"".$_POST['Stu_best']."",
						"afft_name"=>"".$_POST['Btail_name']."",
						"afft_status"=>"".$_POST['Best_status'].""
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