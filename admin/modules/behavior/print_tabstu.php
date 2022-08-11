<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("../../../lang/dateThai.php");
require_once("../../../includes/array.in.php");
require_once("../../../includes/function.in.php");
require_once('../../../mpdf57php7/mpdf.php');
//require_once('../../../mpdf57php7/config_fonts.php');
$StuID=$_POST['StuId'];
$NutID=$_POST['NutId'];
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id='".$StuID."' "); 
@$arr['stu'] =$db->fetch(@$res['stu']);
@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['stu']['stu_class']."' "); 
@$arr['cl'] =$db->fetch(@$res['cl']);
@$res['clg'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."'  "); 
@$arr['clg'] =$db->fetch(@$res['clg']);

@$res['clp'] = $db->select_query("SELECT * FROM ".TB_CLASS_PERSON." as a ,".TB_PERSON." as b WHERE a.clper_area='".$_SESSION['admin_area']."' and a.clper_code='".$_SESSION['admin_school']."'  and a.clper_class='".@$arr['stu']['stu_class']."' and a.clper_tech=b.per_ids  limit 1"); 
@$arr['clp'] =$db->fetch(@$res['clp']);
$per_name=@$arr['clp']['per_name'];

@$res['nut'] = $db->select_query("SELECT * FROM ".TB_TUNBON." WHERE tab_area='".$_SESSION['admin_area']."' and tab_code='".$_SESSION['admin_school']."' and tab_id='".$NutID."' "); 
@$arr['nut']= $db->fetch(@$res['nut']);

@$res['tech'] = $db->select_query("SELECT * FROM ".TB_PERSON."  WHERE per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' and per_ids='".@$arr['nut']['tab_per']."' "); 
@$arr['tech']= $db->fetch(@$res['tech']);

$tab_per=@$arr['tech']['per_name'];

$stu_name=@$arr['stu']['stu_num']."".@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur'];
$class_name=@$arr['cl']['class_name'];
$class_group=@$arr['clg']['clg_name'];
?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">

<style type="text/css">
<!--
@page rotated { size: landscape; }
.style1 {
	font-family: "THSaraban";
	font-size: 18pt;
	font-weight: bold;
}
.style2 {
	font-family: "THSaraban";
	font-size: 16pt;
	font-weight: bold;
}
.style3 {
	font-family: "THSaraban";
	font-size: 16pt;
	
}
.style4 {
	font-family: "THSaraban";
	font-size: 16pt;
	
}
.style5 {cursor: hand; font-weight: normal; color: #000000;}
.style9 {font-family: Tahoma; font-size: 12px; }
.style11 {font-size: 12px}
.style13 {font-size: 9}
.style16 {font-size: 9; font-weight: bold; }
.style17 {font-size: 12px; font-weight: bold; }
-->
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</head>
<body>
<div class="container">
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr ><td align="center" colspan="2" ><img src="../../../img/krut.png" border="0" width="100"></td></tr>
  <tr ><td align="center" colspan="2" height="45"><span class="style1" style="font-size:14pt;font-weight: bold;">แบบบันทึกทำทัณฑ์บนนักเรียน</span></td></tr>
  <tr ><td align="left" width="440" height="23"><span class="style4">ที่ ศธ 04256.0724/พิเศษ..........</span></td><td align="rigth" width="264" class="style4" height="23"><span class="style4">โรงเรียนกู่ทองพิทยาคม ต.กู่ทอง อ.เชียงยืน</span></td></tr>
  <tr ><td align="left" width="440" height="23">&nbsp;</font></td><td align="rigth" width="264" class="style4" ><span class="style4">จังหวัดมหาสารคาม 44160</span></td></tr>
  </table>

<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
  <?php
  $DD=date('Y-m-d H:i:s');
  $Date=FullDateThai($DD);
  ?>
  <tr ><td align="left" width="350" height="33"></td><td align="rigth" width="354" ><span class="style4"><?php echo $Date;?></span></td></tr>
 </table>
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="704" height="33"><span class="style4">เรียน ผู้อำนวยการโรงเรียนกู่ทองพิทยาคม</span></td></tr>
<tr ><td align="left" width="704" height="23">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="style4">ข้าพเจ้า</span>
<span class="style2"><b><?php echo @$arr['nut']['tab_council'];?> (<?php echo @$arr['nut']['tab_relation'];?>)</b></span>
<span class="style4">ผู้ปกครองของ</span>
<span class="style2"><b><?php echo $stu_name;?></b></span>
<span class="style4">นักเรียนชั้น</span>
<span class="style2"><b><?php echo $class_name;?></b></span>
<span class="style4">ห้อง</span>
<span class="style2"><b><?php echo $class_group;?></b></span>
</td></tr>
<tr ><td align="left" width="704" height="23"><span class="style4">ได้มาพบฝ่ายปกครองของโรงเรียน  โดยนักเรียนในความปกครองของข้าพเจ้าฝ่าฝืนระเบียบข้อบังคับของโรงเรียนในเรื่อง</span></td></tr>
 </table>
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
@$res['b'] = $db->select_query("SELECT *,count(bad_tail) as BO FROM ".TB_BAD." WHERE bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_stu='".$StuID."' group by bad_tail"); 
$i=1;
while(@$arr['b'] =$db->fetch(@$res['b'])){
@$res['bt'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_id='".@$arr['b']['bad_tail']."' "); 
@$arr['bt'] =$db->fetch(@$res['bt']);
$Score=@$arr['bt']['badtail_point'];
$ScoreI=(int)($Score)*(int)(@$arr['b']['BO']);
$ScoreSum +=$ScoreI;
?>
<tr ><td align="left" width="704" height="23">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $i.". ".@$arr['bt']['badtail_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;จำนวน <?php echo @$arr['b']['BO'];?> ครั้ง (คะแนน -<?php echo $ScoreI;?>)
  </td></tr>
<?php $i++;} ?>
<tr ><td align="left" width="704" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; รวมคะแนนความประพฤติ -<?php echo $ScoreSum;?></td></tr>

<tr ><td align="left" width="704" height="23">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	สมควรได้รับโทษ   จึงขอทำทัณฑ์บนไว้กับฝ่ายปกครอง 
</td></tr>
<tr ><td align="left" width="704" height="23">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	ข้าพเจ้าขอรับรองว่า  จะว่ากล่าวตักเตือน <b><?php echo $stu_name;?></b>  ไม่ให้ฝ่าฝืนระเบียบข้อบังคับของโรงเรียน 
</td></tr>
<tr ><td align="left" width="704" height="23">ถ้าหากยังฝ่าฝืนระเบียบข้อบังคับของโรงเรียนอีก  ข้าพเจ้ายินยอมให้โรงเรียนพิจารณาโทษตามระเบียบของโรงเรียน 
</td></tr>
<tr ><td align="left" width="704" height="23">ว่าด้วยความประพฤติ   และการปฏิบัติตนของนักเรียนโรงเรียนตามสมควรแก่ความผิด 
</td></tr>
<tr ><td align="left" width="704" height="33">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
ข้าพเจ้าให้สัญญาไว้   ณ <b><?php echo FullDateTimeThaiShort(@$arr['nut']['tab_datetime']);?></b></td></tr>
<tr ><td align="left" width="704" height="23">&nbsp;</td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="305" height="25"></td><td align="rigth" width="399" ><span class="style4">ลงชื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ปกครอง</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="342" height="23"></td><td align="rigth" width="362" ><span class="style4">(<?php echo @$arr['nut']['tab_council'];?>)</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="305" height="25"></td><td align="rigth" width="399" ><span class="style4">ลงชื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;นักเรียน</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="342" height="23"></td><td align="rigth" width="362" ><span class="style4">(<?php echo $stu_name;?>)</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="305" height="25"></td><td align="rigth" width="399" ><span class="style4">ลงชื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ครูที่ปรึกษา</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="342" height="23"></td><td align="rigth" width="362" ><span class="style4">(<?php echo $per_name;?>)</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="305" height="25"></td><td align="rigth" width="399" ><span class="style4">ลงชื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ฝ่ายปกครอง</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="342" height="23"></td><td align="rigth" width="362" ><span class="style4">(<?php echo $tab_per;?>)</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="305" height="25"></td><td align="rigth" width="399" ><span class="style4">ลงชื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="348" height="33"></td><td align="rigth" width="364" ><img src="../../../img/sig-chud1.jpg" border="0" width="100"></td></tr>
 </table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="342" height="23"></td><td align="rigth" width="362" ><span class="style4">(นายชัดสกร พิกุลทอง)</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="305" height="23"></td><td align="rigth" width="399" ><span class="style4">ผู้อำนวยการโรงเรียนกู่ทองพิทยาคม</span></td></tr>
 </table>
</div>
</body>
</html>

<?Php
$footer = "<table width=\"704\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			<tr >
			<td align=\"left\" width=\"704\" height=\"23\">
			<span class=\"style9\">ฝ่ายปกครอง</span>
			</td></tr>
			<tr >
			<td align=\"left\" width=\"704\" height=\"23\">
			<span class=\"style9\">โรงเรียนกู่ทองพิทยาคม</span>
			</td></tr>
			<tr >
			<td align=\"left\" width=\"704\" height=\"23\">
			<span class=\"style9\">โทร 0899469997</span>
			</td></tr>
         </table>";
$html = ob_get_contents();
ob_end_clean();
//$pdf = new mPDF('th', 'A4-L', '0', 'THSaraban');
$pdf = new mPDF('th', 'A4', '0', '');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->setHTMLFooter($footer);
$pdf->WriteHTML($html, 2);
$pdf->Output('../../../MyPDF/tab-'.$StuID.'-'.$NutID.'.pdf');
		$exclude = array('.','..','.htaccess');
		$objOpenz = opendir(WEB_PATH."/MyPDF/");
		$q = 'tab-'.$StuID.'-'.$NutID.'.pdf';
		while(false!== ($filez = readdir($objOpenz))) {
			if(strpos(strtolower($filez),$q)!== false &&!in_array($filez,$exclude)) {
				if($filez=='tab-'.$StuID.'-'.$NutID.'.pdf' ) { $Statusz=1;} else {$Statusz=0;}
			}
		}
		closedir($objOpenz);
		//closedir($objOpeny);
		//echo $Statusy;

	if($Statusz){
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
?>     
