<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("../../../includes/function.in.php");
require_once("../../../includes/excel_reader2.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$add='';
$edit='';
$del='';
$Date=date('Y-m-d');
//$Avatar='';
if(!empty($_SESSION['person_login'])){

if($_POST['OP']=='Import'){


	if( $_SESSION['person_area'] !='' && $_SESSION['person_school'] !='' && $_POST['P_year'] !='' && $_POST["Icon"] !='' && $_POST["Icon2"] !=''){

	if($_POST["Icon"]){

	$CsvFile = WEB_PATH_UPLOAD.$_POST["Icon"];

			if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
				$data = new Spreadsheet_Excel_Reader($CsvFile);
			} else {
				$data = new Spreadsheet_Excel_Reader($CsvFile);
			}
for($i=0;$i<count($data->sheets);$i++) // Loop to get all sheets in a file.
{	
	if(count($data->sheets[$i]['cells'])>0) // checking sheet not empty
	{
		for($j=2;$j<=count($data->sheets[$i]['cells']);$j++) // loop used to get each row of the sheet
		{ 
//			$eid = mysqli_real_escape_string($connection,$data->sheets[$i]['cells'][$j][1]);
//			$name = mysqli_real_escape_string($connection,$data->sheets[$i]['cells'][$j][2]);
//			$email = mysqli_real_escape_string($connection,$data->sheets[$i]['cells'][$j][3]);
//			$dob = mysqli_real_escape_string($connection,$data->sheets[$i]['cells'][$j][4]);
          $Gr = $data->sheets[$i]['cells'][$j][1];//gr
          $Order = $data->sheets[$i]['cells'][$j][2];//sur
          $Subjcode = $data->sheets[$i]['cells'][$j][3];//sur
          $SubjName = $data->sheets[$i]['cells'][$j][4];//sur
          $Credit = $data->sheets[$i]['cells'][$j][5];//sur
          $Year = $data->sheets[$i]['cells'][$j][6];//sur
          $Term = $data->sheets[$i]['cells'][$j][7];//sur
          $Teach_code = $data->sheets[$i]['cells'][$j][8];//sur
          $Teach_num = $data->sheets[$i]['cells'][$j][9];//sur
          $Teach_name = $data->sheets[$i]['cells'][$j][10];//sur
          $Teach_sur = $data->sheets[$i]['cells'][$j][11];//sur
          $Class = $data->sheets[$i]['cells'][$j][12];//class

		  //$Subj=substr($Subjcode, 0, 1);
		  $Subj=mb_substr($Subjcode,0,1, "utf-8");
			if($Subj=='ท'){
				$SBj=1;
			} else if($Subj=='ค'){
				$SBj=2;
			} else if($Subj=='ว'){
				$SBj=3;
			} else if($Subj=='ส'){
				$SBj=4;
			} else if($Subj=='อ' || $Subj=='ญ' || $Subj=='จ'){
				$SBj=5;
			} else if($Subj=='ศ'){
				$SBj=6;
			} else if($Subj=='พ'){
				$SBj=7;
			} else if($Subj=='ง'){
				$SBj=8;
			} else if($Subj=='I'){// IS
				$SBj=9;
			} else if($Subj=='ก'){// IS
				$SBj=0;
			} else {
				$SBj=8;
			}

			if($Class=='ม.1'){
				$Cl='m1';
			} else if($Class=='ม.2'){
				$Cl='m2';
			} else if($Class=='ม.3'){
				$Cl='m3';
			} else if($Class=='ม.4'){
				$Cl='m4';
			} else if($Class=='ม.5'){
				$Cl='m5';
			} else if($Class=='ม.6'){
				$Cl='m6';
			} else if($Class=='ปวช.1'){
				$Cl='pvc1';
			} else if($Class=='ปวช.2'){
				$Cl='pvc2';
			} else if($Class=='ปวช.3'){
				$Cl='pvc3';
			}
			$YY=$_POST['P_year'];
			if($Credit !='20.00'){
			$Hr=((float)($Credit))*40;
			} else {
			$Hr='0.00';
			}
			$import .=$db->add_db(TB_GD_SUBJ,array(
			"subj_area"=>"".$_SESSION['person_area']."",
			"subj_school"=>"".$_SESSION['person_school']."",
//			"subj_code" =>"".$_SESSION['person_school']."",
			"subj_pin" =>"".$Subjcode."",
			"subj_name" =>"".$SubjName."",
			"subj_order" =>"".$Cl."",
			"subj_year" =>"".$YY."",
			"subj_term" =>"".$Term."",
//			"subj_group" =>"".$_SESSION['person_school']."",
			"subj_unit" =>"".$Credit."",
			"subj_hours" =>"".$Hr."",
//			"subj_midterm"=>"".$_SESSION['person_school']."",
//			"subj_final" =>"".$_SESSION['person_school']."",
			"subj_teach" =>"".$Teach_code."",
			));
			@$res['teach'] = $db->select_query("SELECT * FROM ".TB_GD_TEACH." where teach_area='".$_SESSION['person_area']."' and teach_school='".$_SESSION['person_school']."' and teach_pin='".$Teach_code."'  ");
			@$rows['teach'] = $db->rows(@$res['teach']);
			if(!@$rows['teach']){
			$Teach_Full=$Teach_num."".$Teach_name." ".$Teach_sur;
			$import .=$db->add_db(TB_GD_TEACH,array(
			"teach_area"=>"".$_SESSION['person_area']."",
			"teach_school"=>"".$_SESSION['person_school']."",
			"teach_pin" =>"".$Teach_code."",
			"name" =>"".$Teach_Full.""
			));
			}
		}
	}
}

} //icon1

if($_POST["Icon2"]){ 

	$CsvFile2 = WEB_PATH_UPLOAD.$_POST["Icon2"];

			if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
				$data2 = new Spreadsheet_Excel_Reader($CsvFile2);
			} else {
				$data2 =new Spreadsheet_Excel_Reader($CsvFile2);
			}
for($i2=0;$i2<count($data2->sheets);$i2++) // Loop to get all sheets in a file.
{	
	if(count($data2->sheets[$i2]['cells'])>0) // checking sheet not empty
	{
		for($j2=2;$j2<=count($data2->sheets[$i2]['cells']);$j2++) // loop used to get each row of the sheet
		{ 
          $Gr2 = $data2->sheets[$i2]['cells'][$j2][1];//gr
          $Order2 = $data2->sheets[$i2]['cells'][$j2][2];//sur
          $Subjcode2 = $data2->sheets[$i2]['cells'][$j2][3];//sur
          $SubjName2 = $data2->sheets[$i2]['cells'][$j2][4];//sur
          $Credit2 = $data2->sheets[$i2]['cells'][$j2][5];//sur
          $Year2 = $data2->sheets[$i2]['cells'][$j2][6];//sur
          $Term2 = $data2->sheets[$i2]['cells'][$j2][7];//sur
          $Teach_code2 = $data2->sheets[$i2]['cells'][$j2][8];//sur
          $Teach_num2 = $data2->sheets[$i2]['cells'][$j2][9];//sur
          $Teach_name2 = $data2->sheets[$i2]['cells'][$j2][10];//sur
          $Teach_sur2 = $data2->sheets[$i2]['cells'][$j2][11];//sur
          $Class2 = $data2->sheets[$i2]['cells'][$j2][12];//class

		  //$Subj=substr($Subjcode, 0, 1);
		  $Subj2=mb_substr($Subjcode2,0,1, "utf-8");
			if($Subj2=='ท'){
				$SBj2=1;
			} else if($Subj2=='ค'){
				$SBj2=2;
			} else if($Subj2=='ว'){
				$SBj2=3;
			} else if($Subj2=='ส'){
				$SBj2=4;
			} else if($Subj2=='อ' || $Subj2=='ญ' || $Subj2=='จ'){
				$SBj2=5;
			} else if($Subj2=='ศ'){
				$SBj2=6;
			} else if($Subj2=='พ'){
				$SBj2=7;
			} else if($Subj2=='ง'){
				$SBj2=8;
			} else if($Subj2=='I'){// IS
				$SBj2=9;
			} else if($Subj2=='ก'){// IS
				$SBj2=0;
			} else {
				$SBj2=8;
			}

			if($Class2=='ม.1'){
				$Cl2='m1';
			} else if($Class2=='ม.2'){
				$Cl2='m2';
			} else if($Class2=='ม.3'){
				$Cl2='m3';
			} else if($Class2=='ม.4'){
				$Cl2='m4';
			} else if($Class2=='ม.5'){
				$Cl2='m5';
			} else if($Class2=='ม.6'){
				$Cl2='m6';
			} else if($Class2=='ปวช.1'){
				$Cl2='pvc1';
			} else if($Class2=='ปวช.2'){
				$Cl2='pvc2';
			} else if($Class2=='ปวช.3'){
				$Cl2='pvc3';
			}
			$YY2=$_POST['P_year'];
			if($Credit2 !='20.00'){
			$Hr2=((float)($Credit2))*40;
			} else {
			$Hr2='0.00';
			}
			$import .=$db->add_db(TB_GD_SUBJ,array(
			"subj_area"=>"".$_SESSION['person_area']."",
			"subj_school"=>"".$_SESSION['person_school']."",
//			"subj_code" =>"".$_SESSION['person_school']."",
			"subj_pin" =>"".$Subjcode2."",
			"subj_name" =>"".$SubjName2."",
			"subj_order" =>"".$Cl2."",
			"subj_year" =>"".$YY2."",
			"subj_term" =>"".$Term2."",
//			"subj_group" =>"".$_SESSION['person_school']."",
			"subj_unit" =>"".$Credit2."",
			"subj_hours" =>"".$Hr2."",
//			"subj_midterm"=>"".$_SESSION['person_school']."",
//			"subj_final" =>"".$_SESSION['person_school']."",
			"subj_teach" =>"".$Teach_code2."",
			));
			@$res2['teach'] = $db->select_query("SELECT * FROM ".TB_GD_TEACH." where teach_area='".$_SESSION['person_area']."' and teach_school='".$_SESSION['person_school']."' and teach_pin='".$Teach_code2."'  ");
			@$rows2['teach'] = $db->rows(@$res2['teach']);
			if(!@$rows2['teach']){
			$Teach_Full2=$Teach_num2."".$Teach_name2." ".$Teach_sur2;
			$import .=$db->add_db(TB_GD_TEACH,array(
			"teach_area"=>"".$_SESSION['person_area']."",
			"teach_school"=>"".$_SESSION['person_school']."",
			"teach_pin" =>"".$Teach_code2."",
			"name" =>"".$Teach_Full2.""
			));
			}
		}
	}
}

} //icon2


	} else {
		$import .='';
	}


	if($import){
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


if($_POST['OP']=='Add'){
	if( $_SESSION['person_area'] !='' && $_SESSION['person_school'] !='' && $_POST['P_year'] !='' && $_POST['CodePin'] !='' $_POST['Name'] !='' && $_POST['Class'] !='' && $_POST['Term'] !='' && $_POST['Unit'] !='' && $_POST['Hours'] !='' && $_POST['Teach'] !=''){ //		$Avatar=$_FILES['avatar-1']['name'];

			$add .=$db->add_db(TB_GD_SUBJ,array(
			"subj_area"=>"".$_SESSION['person_area']."",
			"subj_school"=>"".$_SESSION['person_school']."",
			"subj_pin" =>"".$_POST['CodePin']."",
			"subj_name" =>"".$_POST['Name']."",
			"subj_order" =>"".$_POST['Class']."",
			"subj_year" =>"".$_POST['P_year']."",
			"subj_term" =>"".$_POST['Term']."",
			"subj_unit" =>"".$_POST['Unit']."",
			"subj_hours" =>"".$_POST['Hours']."",
			"subj_teach" =>"".$_POST['Teach']."",
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
	if( $_SESSION['person_area'] !='' && $_SESSION['person_school'] !='' && $_POST['P_year'] !='' && $_POST['CodePin'] !='' $_POST['Name'] !='' && $_POST['Class'] !='' && $_POST['Term'] !='' && $_POST['Unit'] !='' && $_POST['Hours'] !='' && $_POST['Teach'] !='' && $_POST['ID'] !=''){ //		$Avatar=$_FILES['avatar-1']['name'];

			$edit .=$db->update_db(TB_GD_SUBJ,array(
			"subj_area"=>"".$_SESSION['person_area']."",
			"subj_school"=>"".$_SESSION['person_school']."",
			"subj_pin" =>"".$_POST['CodePin']."",
			"subj_name" =>"".$_POST['Name']."",
			"subj_order" =>"".$_POST['Class']."",
			"subj_year" =>"".$_POST['P_year']."",
			"subj_term" =>"".$_POST['Term']."",
			"subj_unit" =>"".$_POST['Unit']."",
			"subj_hours" =>"".$_POST['Hours']."",
			"subj_teach" =>"".$_POST['Teach']."",
			)," id='".$_POST['ID']."' ");


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