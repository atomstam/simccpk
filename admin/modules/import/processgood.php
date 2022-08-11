<?php
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
$add='';
$edit='';
$del='';
//$Avatar='';
if(!empty($_SESSION['admin_login'])){
if($_POST['OP']=='Add'){
	if( $_POST['Good_name'] !='' && $_POST['Good_stu'] !='' && $_POST['Good_tail'] !='' && $_POST['Good_YMD'] !='' && $_POST['Good_dam'] !='' && $_POST['Good_data'] !=''){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$date_array = explode("-",$_POST['Good_YMD']); // split the array
	$var_year = $date_array[0]; //day seqment
	$var_month = $date_array[1]; //month segment
	$var_day = $date_array[2]; //year segment
	$YY=$var_year+543;
	$Mtime=date('H:i:s');
	
	for($x=0;$x<count($_POST['Good_stu']);$x++){
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['Good_stu'][$x]."' "); 
		@$arr['stu'] = $db->fetch(@$res['stu']);
		$Stu_name[]=($x+1).".".@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur'];

		@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
		@$arr['cl'] = $db->fetch(@$res['cl']);
		$Stu_class[]=@$arr['cl']['clg_group'];
		$Stu_classgr[]=@$arr['cl']['clg_name'];
		$Stu_Token[]=@$arr['cl']['clg_LineId'];
	}
//	$G_stuname=implode("\r\n",$Stu_name);

	for($y=0;$y<count($_POST['Good_tail']);$y++){
		@$res['G'] = $db->select_query("SELECT * FROM ".TB_GOODTAIL." WHERE goodtail_area='".$_SESSION['admin_area']."' and goodtail_code='".$_SESSION['admin_school']."' or goodtail_area='' and goodtail_code=''  and goodtail_id='".$_POST['Good_tail'][$y]."' "); 
		@$arr['G'] = $db->fetch(@$res['G']);
		//$Good_name[]=($y+1).".".@$arr['G']['goodtail_name']."(+".@$arr['G']['goodtail_point'].")";
		$Good_name[]=($y+1).".".$_POST['Good_name']."(+".@$arr['G']['goodtail_point'].")";
		//$Good_point[]=@$arr['G']['goodtail_point'];
	}
	$G_tail=implode("\r\n",$Good_name);
	//$G_point=implode(",+",$Good_point);

	//$message= $G_stuname." ".$G_tail."(+".$G_point.")";
	@$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$_SESSION['admin_login']."' "); 
	@$arr['user'] = $db->fetch(@$res['user']);
	$Tech=@$arr['user']['firstname']." ".@$arr['user']['lastname']." "._text_report_line_message9."".@$arr['user']['phone'];
	//$message1 = $G_stuname."\r\n";
	$message2 = $G_tail."\r\n";
	$message3 = $Tech."\r\n";

	$a= array_unique ($Stu_classgr);
	$b= array_unique ($Stu_class);
	$c= array_unique ($Stu_Token);
	$cc=0;
	foreach ($b as $index => $value){
	//for($z=0;$z<count($b);$z++){
		@$res['cls'] = $db->select_query("SELECT * FROM ".TB_CLASS.",".TB_CLASS_GROUP." WHERE clg_group=class_id and class_id='".$value."'  "); 
		@$arr['cls'] = $db->fetch(@$res['cls']);

		$Clname[]=@$arr['cls']['class_short'];
		$Stu_classx[]=@$arr['cls']['clg_group'];
		$Token[]=@$arr['cls']['clg_LineId'];
		$Class[]=$value;
		$Gr[]=@$arr['cls']['clg_name'];
	$ii=1;
	for($xi=0;$xi<count($_POST['Good_stu']);$xi++){
		@$res['stus'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['Good_stu'][$xi]."' and stu_class='".$value."' "); 
		@$arr['stus'] = $db->fetch(@$res['stus']);
			$Stu_Id=@$arr['stus']['stu_id'];
			$Stu_CLass=@$arr['stus']['stu_class'];
			//if($Stu_CLass[$xi] != $Stu_CLass[$xi-1]){ $xi=0;}
			if(!empty($Stu_Id)){
				$Stu_names[$cc][]=($xi+1).".".@$arr['stus']['stu_name']." ".@$arr['stus']['stu_sur'];
			}
//			}
		$ii++;
	}

		$G_stunames[$cc]=implode("\r\n",$Stu_names[$cc]);
		$message1[$cc] = $G_stunames[$cc]."\r\n";
		$cc++;
	}

		for($zi=0;$zi<count($Class);$zi++){
		@$resx = Line_To_Class_BG($Class[$zi],$Clname[$zi],$Gr[$zi],$message1[$zi],$message2,$message3,$Token[$zi]);
		print_r(@$resx);
		}

		for($i=0;$i<count($_POST['Good_stu']);$i++){
				for($a=0;$a<count($_POST['Good_tail']);$a++){
						$add .=$db->add_db(TB_GOOD,array(
						"good_area"=>"".$_SESSION['admin_area']."",
						"good_code"=>"".$_SESSION['admin_school']."",
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
						"good_sess"=>"".$_SESSION['admin_login'].""
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
	if( $_POST['Good_name'] !='' && $_POST['Good_stu'] !='' && $_POST['Good_tail'] !='' && $_POST['Good_YMD'] !='' && $_POST['Good_dam'] !='' && $_POST['Good_data'] !=''){
	$Mtime=time();
	$date_array = explode("-",$_POST['Good_YMD']); // split the array
	$var_year = $date_array[0]; //day seqment
	$var_month = $date_array[1]; //month segment
	$var_day = $date_array[2]; //year segment
	$YY=$var_year+543;

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
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