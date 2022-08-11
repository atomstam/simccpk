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
@$res['nut'] = $db->select_query("SELECT * FROM ".TB_NUT." WHERE nut_area='".$_SESSION['admin_area']."' and nut_code='".$_SESSION['admin_school']."' and nut_id='".$NutID."'"); 
@$arr['nut']= $db->fetch(@$res['nut']);
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
<tr ><td align="left" width="704" height="33"><span class="style4">เรื่อง ขอเชิญพบเพื่อปรึกษาหารือ</span></td></tr>
<tr ><td align="left" width="704" height="33"><span class="style4">เรียน ผู้ปกครองของ </span><span class="style2"><b><?php echo $stu_name;?></b></span></td></tr>
<tr ><td align="left" width="704" height="23">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="style4">ด้วย </span>
<span class="style2"><b><?php echo $stu_name;?></b></span>
<span class="style4">นักเรียนชั้น </span>
<span class="style2"><b><?php echo $class_name;?></b></span>
<span class="style4">ห้อง </span>
<span class="style2"><b><?php echo $class_group;?></b></span>
<span class="style4">ซึ่งเป็นนักเรียนในความปกครองของท่าน</span>
</td></tr>
<tr ><td align="left" width="704" height="23">
<span class="style4">ได้ประพฤติตนไม่เหมาะสมในเรื่อง</span>
</td></tr>
 </table>
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
@$res['b'] = $db->select_query("SELECT *,count(bad_tail) as BO FROM ".TB_BAD." WHERE bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_stu='".$StuID."' group by bad_tail"); 
$i=1;
while(@$arr['b'] =$db->fetch(@$res['b'])){
@$res['bt'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_id='".@$arr['b']['bad_tail']."' "); 
@$arr['bt'] =$db->fetch(@$res['bt']);
$Score=@$arr['bt']['badtail_point'];
$ScoreI=$Score*@$arr['b']['BO'];
$ScoreSum +=$ScoreI;
?>
<tr ><td align="left" width="704" height="23">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $i.". ".@$arr['bt']['badtail_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;จำนวน <?php echo @$arr['b']['BO'];?> ครั้ง (คะแนน -<?php echo $ScoreI;?>)
  </td></tr>
<?php $i++;} ?>
<tr ><td align="left" width="704" height="33">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; รวมคะแนนความประพฤติ -<?php echo $ScoreSum;?></td></tr>

<tr ><td align="left" width="704" height="23">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	ดังนั้น เพื่อปรึกษาหารือ และพิจารณาแนวทางในการปรับปรุงแก้ไขพฤติกรรมนักเรียนให้ดีขึ้น 
</td></tr>
<tr ><td align="left" width="704" height="23">
ฝ่ายปกครอง โรงเรียนกู่ทองพิทยาคม จึงขอเชิญท่านไปพบฝ่ายปกครอง ในวันที่  
<span class="style2"><b><?php echo FullDateTimeThaiShort(@$arr['nut']['nut_dateco']);?></b></span>
</td></tr>
<tr ><td align="left" width="704" height="23">ณ ห้องสำนักงาน กลุ่มบริหารงานฝ่ายปกครอง โรงเรียนกู่ทองพิทยาคม
</td></tr>
<tr ><td align="left" width="704" height="33">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
จึงเรียนมาเพื่อโปรดทราบและขอบพระคุณมา ณ  โอกาสนี้ 
</td></tr>
<tr ><td align="left" width="704" height="23">&nbsp;</td></tr>
<tr ><td align="left" width="704" height="23">&nbsp;</td></tr>
</table>
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="350" height="33"></td><td align="rigth" width="354" ><span class="style4">ขอแสดงความนับถือ</span></td></tr>
<tr ><td align="left" width="350" height="33"></td><td align="rigth" width="354" >&nbsp;</td></tr>
<tr ><td align="left" width="350" height="33"></td><td align="rigth" width="354" >&nbsp;</td></tr>
 </table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="342" height="33"></td><td align="rigth" width="362" ><span class="style4">(นายชัดสกร พิกุลทอง)</span></td></tr>
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
$pdf->Output('../../../MyPDF/nut-'.$StuID.'-'.$NutID.'.pdf');
$objOpen = opendir("../../../MyPDF/");
while (($file = readdir($objOpen)) ==true)
{
	if (($file != ".") or ($file != "..")) {
		if($file=='nut-'.$StuID.'-'.$NutID.'.pdf' ) { $Status=1;} else {$Status=0;};
	}
}

	if($Status){
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
