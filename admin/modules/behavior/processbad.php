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

	
	for($x=0;$x<count($_POST['Bad_stu']);$x++){
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['Bad_stu'][$x]."' "); 
		@$arr['stu'] = $db->fetch(@$res['stu']);
		$Stu_name[]=($x+1).".".@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur'];

		@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
		@$arr['cl'] = $db->fetch(@$res['cl']);
		$Stu_class[]=@$arr['cl']['clg_group'];
		$Stu_classgr[]=@$arr['cl']['clg_name'];
		$Stu_Token[]=@$arr['cl']['clg_LineId'];
	}
	$B_stuname=implode("\r\n",$Stu_name);

	for($y=0;$y<count($_POST['Bad_tail']);$y++){
		@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'   and badtail_id='".$_POST['Bad_tail'][$y]."' "); 
		@$arr['B'] = $db->fetch(@$res['B']);
		$Bad_name[]=($y+1).".".@$arr['B']['badtail_name']."(+".@$arr['B']['badtail_point'].")";
	}
	$B_tail=implode("\r\n",$Bad_name);

	@$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$_SESSION['admin_login']."' "); 
	@$arr['user'] = $db->fetch(@$res['user']);
	$Tech=@$arr['user']['firstname']." ".@$arr['user']['lastname']." "._text_report_line_message9."".@$arr['user']['phone'];
	//$message1 = $B_stuname."\r\n";
	$message2 = $B_tail."\r\n";
	$message3 = $Tech."\r\n";
	//$our_array=explode("",$Stu_class);


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
	for($xi=0;$xi<count($_POST['Bad_stu']);$xi++){
		@$res['stus'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['Bad_stu'][$xi]."' and stu_class='".$value."' "); 
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

		//for($zi=0;$zi<count($Class);$zi++){
		//@$resx = Line_To_Class_BG($Class[$zi],$Clname[$zi],$Gr[$zi],$message1[$zi],$message2,$message3,$Token[$zi]);
		//print_r(@$resx);
		//}

		for($i=0;$i<count($_POST['Bad_stu']);$i++){
				for($a=0;$a<count($_POST['Bad_tail']);$a++){
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