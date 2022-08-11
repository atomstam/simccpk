<?php
ini_set('display_errors', "0");
ob_start();
if (session_id() =='') { @session_start(); }
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
$STU = array('7717','8218','7974');
$TAIL= array('15','18','21');
//m6/1,
$_GET['Good_stu']=$STU;
$_GET['Good_tail']=$TAIL;
//$Avatar='';
if(!empty($_SESSION['admin_login'])){
if($_GET['OP']=='Add'){
	if( $_GET['Good_name'] !='' && $_GET['Good_stu'] !='' && $_GET['Good_tail'] !='' && $_GET['Good_YMD'] !='' && $_GET['Good_dam'] !='' && $_GET['Good_data'] !=''){

	$date_array = explode("-",$_GET['Good_YMD']); // split the array
	$var_year = $date_array[0]; //day seqment
	$var_month = $date_array[1]; //month segment
	$var_day = $date_array[2]; //year segment
	$YY=$var_year+543;
	$Mtime=date('H:i:s');
	
	for($y=0;$y<count($_GET['Good_tail']);$y++){
		@$res['G'] = $db->select_query("SELECT * FROM ".TB_GOODTAIL." WHERE goodtail_area='".$_SESSION['admin_area']."' and goodtail_code='".$_SESSION['admin_school']."' and goodtail_id='".$_GET['Good_tail'][$y]."' "); 
		@$arr['G'] = $db->fetch(@$res['G']);
		//$Good_name[]=($y+1).".".@$arr['G']['goodtail_name']."(+".@$arr['G']['goodtail_point'].")";
		$Good_name[]=($y+1).".".$_GET['Good_name']."(+".@$arr['G']['goodtail_point'].")";
		//$Good_point[]=@$arr['G']['goodtail_point'];
	}
	//$G_tail=implode("\r\n",$Good_name);
	$G_tail=$Good_name;
	//$G_point=implode(",+",$Good_point);

	//$message= $G_stuname." ".$G_tail."(+".$G_point.")";
	@$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$_SESSION['admin_login']."' "); 
	@$arr['user'] = $db->fetch(@$res['user']);
	$Tech=@$arr['user']['firstname']." ".@$arr['user']['lastname']." "._text_report_line_message9."".@$arr['user']['phone'];
	//$message1 = $G_stuname."\r\n";
	$message2 = $G_tail."\r\n";
	$message3 = $Tech."\r\n";

	for($x=0;$x<count($_GET['Good_stu']);$x++){
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." left join ".TB_CLASS_GROUP." on clg_group=stu_class and clg_name=stu_cn left join ".TB_CLASS." on class_id=stu_class WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_GET['Good_stu'][$x]."' group by stu_id"); 
		@$arr['stu'] = $db->fetch(@$res['stu']);
		$Stu_name[]=($x+1).".".@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur'];

		$Stu_class[]=@$arr['stu']['stu_class'];
		$Stu_classgr[]=@$arr['stu']['stu_cn'];
		$Clname[]=@$arr['stu']['class_short'];
		$Stu_Token[]=@$arr['stu']['clg_LineId'];
		//echo $arr['stu']['stu_class']."/".$arr['stu']['stu_cn'];

//		$Stu_names[]=($x+1).".".@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur'];

	}

		//$G_stunames=implode("\r\n",$Stu_name);
		//$message1 = $G_stunames."\r\n";
		$message1 = $Stu_name;
		for($i=0;$i<count($Stu_class);$i++){
			//echo count($G_tail);
			for($ii=0;$ii<count($G_tail);$ii++){
					$Mess[$i][] =$G_tail[$ii];
			}
			$vMess[$i] = implode(",", $Mess[$i]);
			//echo $vMess[$i];
			//$successx="value : $Stu_class[$i],$Clname[$i],$Stu_classgr[$i],$message1[$i],$vMess[$i],$message3,$Stu_Token[$i] <br>";
			//print_r($successx);
			@$resx = Line_To_Class_BG($Stu_class[$i],$Clname[$i],$Stu_classgr[$i],$message1[$i],$vMess[$i],$message3,$Stu_Token[$i]);
			print_r(@$resx);
		}
		for($i=0;$i<count($_GET['Good_stu']);$i++){
				for($a=0;$a<count($_GET['Good_tail']);$a++){
						$add .=$db->add_db(TB_GOOD,array(
						"good_area"=>"".$_SESSION['admin_area']."",
						"good_code"=>"".$_SESSION['admin_school']."",
						"good_stu"=>"".$_GET['Good_stu'][$i]."",
						"good_tail"=>"".$_GET['Good_tail'][$a]."",
						"good_name"=>"".$_GET['Good_name']."",
						"good_date"=>"".$var_day."",
						"good_mouth"=>"".$var_month."",
						"good_year"=>"".$YY."",
						"good_dam"=>"".$_GET['Good_dam']."",
						"good_t"=>"".$_GET['Good_data']."",
						"g_date"=>"".$_GET['Good_YMD']."",
						"g_Mtime"=>"".$Mtime."",
						"good_sess"=>"".$_SESSION['admin_login']."",
						"role"=>"1"
						));
				}
		}

	} else {
		$add .='';
	}

} 

if($_GET['OP']=='Edit'){
	if( $_GET['Good_name'] !='' && $_GET['Good_stu'] !='' && $_GET['Good_tail'] !='' && $_GET['Good_YMD'] !='' && $_GET['Good_dam'] !='' && $_GET['Good_data'] !=''){
	$Mtime=time();
	$date_array = explode("-",$_GET['Good_YMD']); // split the array
	$var_year = $date_array[0]; //day seqment
	$var_month = $date_array[1]; //month segment
	$var_day = $date_array[2]; //year segment
	$YY=$var_year+543;

		$edit .=$db->update_db(TB_GOOD,array(
						"good_tail"=>"".$_GET['Good_tail']."",
						"good_name"=>"".$_GET['Good_name']."",
						"good_date"=>"".$var_day."",
						"good_mouth"=>"".$var_month."",
						"good_year"=>"".$YY."",
						"good_dam"=>"".$_GET['Good_dam']."",
						"good_t"=>"".$_GET['Good_data']."",
						"g_date"=>"".$_GET['Good_YMD'].""
		)," good_id=".$_GET['GOID']." ");

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