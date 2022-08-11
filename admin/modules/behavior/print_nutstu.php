<?php
ini_set('display_errors', "0");
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

@$res['sch'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_area='".$_SESSION['admin_area']."' and sh_code='".$_SESSION['admin_school']."' "); 
@$arr['sch'] =$db->fetch(@$res['sch']);

@$res['schcon'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_CONFIG." WHERE shc_area='".$_SESSION['admin_area']."' and shc_code='".$_SESSION['admin_school']."' "); 
@$arr['schcon'] =$db->fetch(@$res['schcon']);

@$res['prov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." where code='".@$arr['stu']['stu_prov']."' ");
@$arr['prov'] = $db->fetch(@$res['prov']);

@$res['schprov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." where code='".@$arr['sch']['sh_prov']."' ");
@$arr['schprov'] = $db->fetch(@$res['schprov']);
@$res['schamp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where amphur_code='".@$arr['sch']['sh_amp']."' ");
@$arr['schamp'] = $db->fetch(@$res['schamp']);

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
  <tr ><td align="left" width="440" height="25"><span class="style4">ที่ ศธ 04256.0724/พิเศษ..........</span></td><td align="rigth" width="264" class="style4" height="25"><span class="style4">โรงเรียน<?=$arr['sch']['sh_name'];?></span></td></tr>
  <tr ><td align="rigth" width="264" height="25">&nbsp;</font></td><td align="rigth" width="264" class="style4" ><span class="style4">อำเภอ<?=$arr['schamp']['name'];?> จังหวัด<?=$arr['schprov']['name'];?> <?=$arr['sch']['sh_post'];?></span></td></tr>
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
<tr ><td align="left" width="704" height="25">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="style4">ด้วย </span>
<span class="style2"><b><?php echo $stu_name;?></b></span>
<span class="style4">นักเรียนชั้น </span>
<span class="style2"><b><?php echo $class_name;?></b></span>
<span class="style4">ห้อง </span>
<span class="style2"><b><?php echo $class_group;?></b></span>
<span class="style4">ซึ่งเป็นนักเรียนในความปกครอง</span>
</td></tr>
<tr ><td align="left" width="704" height="25">
<span class="style4">ของท่าน ได้ประพฤติตนไม่เหมาะสมในเรื่อง</span>
</td></tr>
 </table>
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
@$res['b'] = $db->select_query("SELECT *,count(bad_tail) as BO FROM ".TB_BAD." WHERE bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_stu='".$StuID."' group by bad_tail"); 
$i=1;
while(@$arr['b'] =$db->fetch(@$res['b'])){
@$res['bt'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_id='".@$arr['b']['bad_tail']."' "); 
@$arr['bt'] =$db->fetch(@$res['bt']);
@$Score=@$arr['bt']['badtail_point'];
@$ScoreI=$Score*@$arr['b']['BO'];
@$ScoreSum +=$ScoreI;
?>
<tr ><td align="left" width="704" height="25">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $i.". ".@$arr['bt']['badtail_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;จำนวน <?php echo @$arr['b']['BO'];?> ครั้ง (คะแนน -<?php echo $ScoreI;?>)
  </td></tr>
<?php $i++;} ?>
<tr ><td align="left" width="704" height="33">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; รวมคะแนนความประพฤติ -<?php echo $ScoreSum;?></td></tr>

<tr ><td align="left" width="704" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	ดังนั้น เพื่อปรึกษาหารือและพิจารณาแนวทางในการปรับปรุงแก้ไขพฤติกรรมนักเรียนให้ดีขึ้น งานกิจการนักเรียน 
</td></tr>
<tr ><td align="left" width="704" height="25">
โรงเรียน<?=$arr['sch']['sh_name'];?> จึงขอเชิญท่านไปพบงานกิจการนักเรียน ในวันที่  
<span class="style2"><b><?php echo FullDateTimeThaiShort(@$arr['nut']['nut_dateco']);?></b></span>
</td></tr>
<tr ><td align="left" width="704" height="25">ณ ห้องสำนักงาน กลุ่มบริหารงานทั่วไป โรงเรียน<?=$arr['sch']['sh_name'];?>
</td></tr>
<tr ><td align="left" width="704" height="33">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
จึงเรียนมาเพื่อโปรดทราบและขอบพระคุณมา ณ  โอกาสนี้ 
</td></tr>
<tr ><td align="left" width="704" height="25">&nbsp;</td></tr>
<tr ><td align="left" width="704" height="25">&nbsp;</td></tr>
</table>
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="350" height="33"></td><td align="rigth" width="354" ><span class="style4">ขอแสดงความนับถือ</span></td></tr>
<?php if($arr['nut']['nut_check'] ==1){?>
<tr ><td align="left" width="342" height="33"></td><td align="rigth" width="362" ><img src="../../../uploads/<?=$arr['schcon']['shc_boss_sig'];?>" border="0" width="150"></td></tr>
<?php } else {?>
<tr ><td align="left" width="342" height="33"></td><td align="rigth" width="362" height="70"></td></tr>
<?php } ?>
 </table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="342" height="33"></td><td align="rigth" width="362" ><span class="style4">(<?=$arr['sch']['sh_boss'];?>)</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="305" height="25"></td><td align="rigth" width="399" ><span class="style4">ผู้อำนวยการโรงเรียน<?=$arr['sch']['sh_name'];?></span></td></tr>
 </table>
</div>
</body>
</html>

<?Php
$Sch_Name=$arr['sch']['sh_name'];
$Sch_Phone=$arr['sch']['sh_phone'];
$footer = "<table width=\"704\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			<tr >
			<td align=\"left\" width=\"704\" height=\"24\">
			<span class=\"style9\">งานกิจการนักเรียน</span><br>
			<span class=\"style9\">โรงเรียน".$Sch_Name."</span><br>
			<span class=\"style9\">โทร. ".$Sch_Phone."</span>
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
		$exclude = array('.','..','.htaccess');
		$objOpeny = opendir(WEB_PATH."/MyPDF/");
		$q = 'nut-'.$StuID.'-'.$NutID.'.pdf';
		while(false!== ($filey = readdir($objOpeny))) {
			if(strpos(strtolower($filey),$q)!== false &&!in_array($filey,$exclude)) {
				if($filey=='nut-'.$StuID.'-'.$NutID.'.pdf') { $Statusy=1;} else {$Statusy=0;}
			}
		}
		closedir($objOpeny);
		//closedir($objOpeny);
		//echo $Statusy;

	if($Statusy){
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
