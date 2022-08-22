<?php
ob_start();
if (session_id() =='') { @session_start(); }
ini_set('display_errors', "0");
require_once("../../../includes/config.php");
require_once("../../../lang/thai.php");
require_once("../../../lang/dateThai.php");
require_once("../../../includes/array.in.php");
require_once("../../../includes/class.mysql.php");
require_once("../../../includes/function.in.php");
require_once("../../../lang/thai.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$add='';
$edit='';
$del='';
//$Avatar='';
if(!empty($_SESSION['person_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['Good_name'] !='' && $_POST['Good_stu'] !='' && $_POST['Good_tail'] !='' && $_POST['Good_YMD'] !='' && $_POST['Good_dam'] !='' && $_POST['Good_data'] !=''){

	$date_array = explode("-",$_POST['Good_YMD']); // split the array
	$var_year = $date_array[0]; //day seqment
	$var_month = $date_array[1]; //month segment
	$var_day = $date_array[2]; //year segment
	$YY=$var_year+543;
	$Mtime=date('H:i:s');

	$Arr_Good_tail=is_array($_POST['Good_tail']);
	if($Arr_Good_tail){
	@$Good_tail=count($_POST['Good_tail']);
	for($y=0;$y<$Good_tail;$y++){
		@$res['G'] = $db->select_query("SELECT * FROM ".TB_GOODTAIL." WHERE goodtail_area='".$_SESSION['person_area']."' and goodtail_code='".$_SESSION['person_school']."'   and goodtail_id='".$_POST['Good_tail'][$y]."' "); 
		@$arr['G'] = $db->fetch(@$res['G']);
		//$Good_name[]=($y+1).".".@$arr['G']['goodtail_name']."(+".@$arr['G']['goodtail_point'].")";
		$Good_name[]=($y+1).".".$_POST['Good_name']."(+".@$arr['G']['goodtail_point'].")";
		//$Good_point[]=@$arr['G']['goodtail_point'];
	}
	@$G_tail=implode("\r\n",$Good_name);
	//$G_point=implode(",+",$Good_point);
	//$successx .=$G_tail;
	} 
	//$successx .= $G_tail;
	@$res['user'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_ids='".$_SESSION['person_login']."' "); 
	@$arr['user'] = $db->fetch(@$res['user']);
	$Tech=@$arr['user']['per_name']." "._text_report_line_message9."".@$arr['user']['per_tel'];
	//$message1 = $G_stuname."\r\n";
	$message2 = $G_tail."\r\n";
	$message3 = $Tech."\r\n";

//	$a= array_unique ($Stu_classgr);
//	$b= array_unique ($Stu_class);
//	$c= array_unique ($Stu_Token);

	//$successx .=$_POST['Good_stu'];
	$Good_stu=count($_POST['Good_stu']);
	for($x=0;$x<$Good_stu;$x++){
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." left join ".TB_CLASS_GROUP." on clg_group=stu_class and clg_name=stu_cn left join ".TB_CLASS." on class_id=stu_class  WHERE stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."'  and stu_id='".$_POST['Good_stu'][$x]."' group by stu_id"); 
		@$arr['stu'] = $db->fetch(@$res['stu']);

		$Stu_name[]=($x+1).".".$arr['stu']['stu_name']." ".$arr['stu']['stu_sur'];
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
		for($i=0;$i<@$Stu_classx;$i++){
			$Mess[$i][] =$G_tail;
			//$successx .=$message1[$i];
			$vMess[$i] = implode(",", $Mess[$i]);
			//$successx .=$vMess[$i];
			//$div[$i] = explode("|",$message1);
			for($ix=0;$ix<count($message1[$i]);$ix++){
					$STU_Name[$i] .=$message1[$i]."\r\n";
			}
			//echo $vMess[$i];
			//$successx .="value : $Stu_class[$i],$Clname[$i],$Stu_classgr[$i],$STU_Name[$i],$vMess[$i],$message3,$Stu_Token[$i]";
			//$add="1";
			//print_r($successx);
			@$resx = Line_To_Class_BG($Stu_class[$i],$Clname[$i],$Stu_classgr[$i],$STU_Name[$i],$vMess[$i],$message3,$Stu_Token[$i]);
			print_r(@$resx);
		}

		for($i=0;$i<$Good_stu;$i++){
				for($a=0;$a<$Good_tail;$a++){
						$add .=$db->add_db(TB_GOOD,array(
						"good_area"=>"".$_SESSION['person_area']."",
						"good_code"=>"".$_SESSION['person_school']."",
						"good_stu"=>"".$_POST['Good_stu'][$i]."",
						"good_tail"=>"".$_POST['Good_tail'][$a]."",
						"good_name"=>"".$_POST['Good_name']."",
						"good_date"=>"".$var_day."",
						"good_mouth"=>"".$var_month."",
						"good_year"=>"".$YY."",
						"good_dam"=>"".$_POST['Good_dam']."",
						"good_t"=>"".$_POST['Good_data']."",
						"g_date"=>"".$_POST['Good_YMD']."",
						"g_Mtime"=>"".$Mtime."",
						"good_sess"=>"".$_SESSION['person_login']."",
						"role"=>"2"
						));
				}
		}


	} else {
		$add .='';
	}

	if($add){
		//$successx = "Success";
		$successx = $successx;
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
	if( $_POST['Good_name'] !='' && $_POST['Good_stu'] !='' && $_POST['Good_tail'] !='' && $_POST['Good_YMD'] !='' && $_POST['Good_dam'] !='' && $_POST['Good_data'] !=''){
	$Mtime=date("H:i:s");
	$date_array = explode("-",$_POST['Good_YMD']); // split the array
	$var_year = $date_array[0]; //day seqment
	$var_month = $date_array[1]; //month segment
	$var_day = $date_array[2]; //year segment
	$YY=$var_year+543;

		$edit .=$db->update_db(TB_GOOD,array(
						"good_tail"=>"".$_POST['Good_tail']."",
						"good_name"=>"".$_POST['Good_name']."",
						"good_date"=>"".$var_day."",
						"good_mouth"=>"".$var_month."",
						"good_year"=>"".$YY."",
						"good_dam"=>"".$_POST['Good_dam']."",
						"good_t"=>"".$_POST['Good_data']."",
						"g_date"=>"".$_POST['Good_YMD'].""
		)," good_id=".$_POST['GOID']." ");

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