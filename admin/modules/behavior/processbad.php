<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("../../../includes/function.in.php");
require_once("../../../lang/thai.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$add='';
$edit='';
$del='';
//$Avatar='';
if(!empty($_SESSION['admin_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['Bad_name'] !='' && $_POST['Bad_stu'] !='' && $_POST['Bad_tail'] !='' && $_POST['Bad_YMD'] !='' && $_POST['Bad_dam'] !='' && $_POST['Bad_data'] !=''){

	$date_array = explode("-",$_POST['Bad_YMD']); // split the array
	$var_year = $date_array[0]; //day seqment
	$var_month = $date_array[1]; //month segment
	$var_day = $date_array[2]; //year segment
	$YY=$var_year+543;
	$Mtime=date('H:i:s');

	$Arr_Bad_tail=is_array($_POST['Bad_tail']);
	if($Arr_Bad_tail){
	@$Bad_tail=count($_POST['Bad_tail']);
	for($y=0;$y<$Bad_tail;$y++){
		@$res['G'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'   and badtail_id='".$_POST['Bad_tail'][$y]."' "); 
		@$arr['G'] = $db->fetch(@$res['G']);
		//$Bad_name[]=($y+1).".".@$arr['G']['badtail_name']."(+".@$arr['G']['badtail_point'].")";
		$Bad_name[]=($y+1).".".$_POST['Bad_name']."(+".@$arr['G']['badtail_point'].")";
		//$Bad_point[]=@$arr['G']['badtail_point'];
	}
	@$G_tail=implode("\r\n",$Bad_name);
	//$G_point=implode(",+",$Bad_point);
	} 
	//$message= $G_stuname." ".$G_tail."(+".$G_point.")";
	@$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$_SESSION['admin_login']."' "); 
	@$arr['user'] = $db->fetch(@$res['user']);
	$Tech=@$arr['user']['firstname']." ".@$arr['user']['lastname']." "._text_report_line_message9."".@$arr['user']['phone'];
	//$message1 = $G_stuname."\r\n";
	$message2 = $G_tail."\r\n";
	$message3 = $Tech."\r\n";

//	$a= array_unique ($Stu_classgr);
//	$b= array_unique ($Stu_class);
//	$c= array_unique ($Stu_Token);
	$Arr_Bad_stu=is_array($_POST['Bad_stu']);
	if($Arr_Bad_stu){
	$Bad_stu=count($_POST['Bad_stu']);
	for($x=0;$x<$Bad_stu;$x++){
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." left join ".TB_CLASS_GROUP." on clg_group=stu_class and clg_name=stu_cn left join ".TB_CLASS." on class_id=stu_class  WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['Bad_stu'][$x]."' group by stu_id"); 
		@$arr['stu'] = $db->fetch(@$res['stu']);

		$Stu_name[]=($x+1).".".@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur'];
		$Stu_class[]=@$arr['stu']['stu_class'];
		$Stu_classgr[]=@$arr['stu']['stu_cn'];
		$Clname[]=@$arr['stu']['class_short'];
		$Stu_Token[]=@$arr['stu']['clg_LineId'];
		//echo $arr['stu']['stu_class']."/".$arr['stu']['stu_cn'];

//		$Stu_names[]=($x+1).".".@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur'];
		//echo ($x+1).".".@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']."|";
	}
		@$Stu_classx=count($Stu_class);
		//$G_stunames=implode("\r\n",$Stu_name);
		//$message1 = $G_stunames."\r\n";
		$message1 = $Stu_name;
		for($i=0;$i<$Stu_classx;$i++){
			$Mess[$i][] =$G_tail;
			$vMess[$i] = implode(",", $Mess[$i]);
			for($ix=0;$ix<count($message1[$i]);$ix++){
					$STU_Name[$i] .=$message1[$i]."\r\n";
			}
			//echo $vMess[$i];
			//$successx="value : $Stu_class[$i],$Clname[$i],$Stu_classgr[$i],$STU_Name[$i],$vMess[$i],$message3,$Stu_Token[$i]";
			//print_r($successx);
			//@$resx = Line_To_Class_BG($Stu_class[$i],$Clname[$i],$Stu_classgr[$i],$STU_Name[$i],$vMess[$i],$message3,$Stu_Token[$i]);
			//print_r(@$resx);
		}

		for($i=0;$i<$Bad_stu;$i++){
				for($a=0;$a<$Bad_tail;$a++){
						$add .=$db->add_db(TB_BAD,array(
						"bad_area"=>"".$_SESSION['admin_area']."",
						"bad_code"=>"".$_SESSION['admin_school']."",
						"bad_stu"=>"".$_POST['Bad_stu'][$i]."",
						"bad_tail"=>"".$_POST['Bad_tail'][$a]."",
						"bad_name"=>"".$_POST['Bad_name']."",
						"bad_date"=>"".$var_day."",
						"bad_mouth"=>"".$var_month."",
						"bad_year"=>"".$YY."",
						"bad_dam"=>"".$_POST['Bad_dam']."",
						"bad_t"=>"".$_POST['Bad_data']."",
						"b_date"=>"".$_POST['Bad_YMD']."",
						"b_Mtime"=>"".$Mtime."",
						"bad_sess"=>"".$_SESSION['admin_login']."",
						"role"=>"1"
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
	if( $_POST['Bad_name'] !='' && $_POST['Bad_stu'] !='' && $_POST['Bad_tail'] !='' && $_POST['Bad_YMD'] !='' && $_POST['Bad_dam'] !='' && $_POST['Bad_data'] !=''){

	$date_array = explode("-",$_POST['Bad_YMD']); // split the array
	$var_year = $date_array[0]; //day seqment
	$var_month = $date_array[1]; //month segment
	$var_day = $date_array[2]; //year segment
	$YY=$var_year+543;

		$edit .=$db->update_db(TB_BAD,array(
						"bad_tail"=>"".$_POST['Bad_tail']."",
						"bad_name"=>"".$_POST['Bad_name']."",
						"bad_date"=>"".$var_day."",
						"bad_mouth"=>"".$var_month."",
						"bad_year"=>"".$YY."",
						"bad_dam"=>"".$_POST['Bad_dam']."",
						"bad_t"=>"".$_POST['Bad_data']."",
						"b_date"=>"".$_POST['Bad_YMD'].""
		)," bad_id=".$_POST['BAID']." ");

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