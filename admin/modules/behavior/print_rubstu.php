<?php
ini_set('display_errors', "0");
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("../../../lang/dateThai.php");
require_once("../../../lang/thai.php");
require_once("../../../includes/array.in.php");
require_once("../../../includes/function.in.php");
require_once('../../../mpdf57php7/mpdf.php');
//require_once('../../../mpdf57php7/config_fonts.php');
$StuID=$_POST['StuId'];
$NutID=$_POST['NutId'];
if(!empty($_POST['UpId'])){
		$path = WEB_PATH."/MyPDF/";
		$File = 'rub-'.$StuID.'-'.$NutID.'.pdf';
		@unlink($path.$File);
}
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id='".$StuID."' "); 
@$arr['stu'] =$db->fetch(@$res['stu']);
@$res['sch'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_area='".$_SESSION['admin_area']."' and sh_code='".$_SESSION['admin_school']."' "); 
@$arr['sch'] =$db->fetch(@$res['sch']);
@$res['schcon'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_CONFIG." WHERE shc_area='".$_SESSION['admin_area']."' and shc_code='".$_SESSION['admin_school']."' "); 
@$arr['schcon'] =$db->fetch(@$res['schcon']);

@$res['tum'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where tumbon_code='".@$arr['stu']['stu_tum']."' ");
@$arr['tum'] = $db->fetch(@$res['tum']);
@$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where amphur_code='".@$arr['stu']['stu_amp']."' ");
@$arr['amp'] = $db->fetch(@$res['amp']);
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

@$res['clp'] = $db->select_query("SELECT * FROM ".TB_CLASS_PERSON." as a ,".TB_PERSON." as b WHERE a.clper_area='".$_SESSION['admin_area']."' and a.clper_code='".$_SESSION['admin_school']."'  and a.clper_class='".@$arr['stu']['stu_class']."' and a.clper_tech=b.per_ids  limit 1"); 
@$arr['clp'] =$db->fetch(@$res['clp']);
$per_name=@$arr['clp']['per_name'];

@$res['nut'] = $db->select_query("SELECT * FROM ".TB_RUBRONGTAIL." WHERE rub_area='".$_SESSION['admin_area']."' and rub_code='".$_SESSION['admin_school']."' and rub_id='".$NutID."' "); 
@$arr['nut']= $db->fetch(@$res['nut']);
$dateLa=CheckDateLa(@$arr['nut']['rub_dateIn'],@$arr['nut']['rub_dateOut']);
$dateIn=ShortDateThai(@$arr['nut']['rub_dateIn']);
$dateOut=ShortDateThai(@$arr['nut']['rub_dateOut']);

@$res['la'] = $db->select_query("SELECT * FROM ".TB_RUBRONG." WHERE rb_area='".$_SESSION['admin_area']."' and rb_code='".$_SESSION['admin_school']."' and rb_id='".@$arr['nut']['rub_tail']."' "); 
@$arr['la']= $db->fetch(@$res['la']);

@$res['tech'] = $db->select_query("SELECT * FROM ".TB_PERSON."  WHERE per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' and per_ids='".@$arr['nut']['rub_con_per']."' "); 
@$arr['tech']= $db->fetch(@$res['tech']);

$rub_per=@$arr['tech']['per_name'];

$stu_name=@$arr['stu']['stu_num']."".@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur'];
$class_name=@$arr['cl']['class_name'];
$class_group=@$arr['clg']['clg_name'];
  $DD=date('Y-m-d H:i:s');
  $Date=FullDateThai($DD);


$add1="<b>".@$arr['stu']['stu_add']."</b> หมู่ที่ <b>".@$arr['stu']['stu_group']."</b> ตำบล<b>".@$arr['tum']['name']."</b>";
$add2="อำเภอ<b>".@$arr['amp']['name']."</b> จังหวัด<b>".@$arr['prov']['name']."</b>";
$add3="รหัสไปรษณีย์ <b>".@$arr['stu']['stu_post']."</b>";

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
  <tr ><td align="left" width="584" height="23"></td><td align="rigth" width="120" class="style4" height="23"><span class="style4">เลขที่ <?php echo $arr['nut']['rub_num'];?> / <?php echo $arr['nut']['rub_year'];?></span></td></tr>
</table>
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr ><td align="center" colspan="2" ><?php if($arr['schcon']['shc_logo'] !=''){?><img src="../../../uploads/<?=$arr['schcon']['shc_logo'];?>" border="0" width="100"><?php } else { ?><img src="../../../uploads/spt_logo.jpg" border="0" width="100"><?php } ?></td></tr>
  <tr ><td align="center" colspan="2" height="45"><span class="style1" style="font-size:14pt;font-weight: bold;">ใบรับรองความประพฤติ</span></td></tr>
  <tr ><td align="left" width="440" height="23"></td><td align="rigth" width="264" class="style4" height="23"><span class="style4">โรงเรียน<?=$arr['sch']['sh_name'];?></span></td></tr>
  <tr ><td align="left" width="440" height="23">&nbsp;</font></td><td align="rigth" width="264" class="style4" ><span class="style4">อำเภอ<?=$arr['schamp']['name'];?> จังหวัด<?=$arr['schprov']['name'];?> <?=$arr['sch']['sh_post'];?></span></td></tr>
  </table>
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="704" height="20">
&nbsp;
</td></tr>
<tr ><td align="left" width="704" height="25">
<span class="style4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ขอรับรองว่า</span>
<span class="style2">&nbsp;<b><?php echo $stu_name;?></b></span>
<span class="style4">เลขประจำตัวนักเรียน</span>
<span class="style2"><b><?php echo $StuID;?></b></span>
<span class="style4">เกิดวันที่ </span>
<span class="style2"><b><?php echo formatDateThaiNew(@$arr['stu']['stu_birth']);?></b></span>
</td></tr>
<tr ><td align="left" width="704" height="25">
<span class="style4">&nbsp;&nbsp;&nbsp;&nbsp;ที่อยู่ <?php echo $add1;?></span>
<span class="style4"><?php echo $add2;?></span>
<span class="style4"><?php echo $add3;?></span>
</td></tr>

<tr ><td align="left" width="704" height="25">
<span class="style4">&nbsp;&nbsp;&nbsp;&nbsp;บิดาชื่อ</span>
<span class="style2"><b><?php echo @$arr['stu']['stu_father'];?></b></span>
<span class="style4">มาดาชื่อ</span>
<span class="style2"><b><?php echo @$arr['stu']['stu_marther'];?></b></span>
<span class="style4">กำลังศึกษาในระดับชั้น</span>
<span class="style2"><b><?php echo $class_name;?></b></span>
<span class="style4">ห้อง</span>
<span class="style2"><b><?php echo $class_group;?></b></span>
</td></tr>
<tr ><td align="left" width="704" height="25"><span class="style4">&nbsp;&nbsp;&nbsp;&nbsp;โรงเรียน<?=$arr['sch']['sh_name'];?> อำเภอ<?=$arr['schamp']['name'];?> จังหวัด<?=$arr['schprov']['name'];?></span>
</td></tr>


<tr ><td align="left" width="704" height="33"><span class="style4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เป็นผู้มีความประพฤติเรียบร้อย มีจิตอาสา อยู่ในระเบียบวินัย ไม่มีประวัติยุ่งเกี่ยวกับยาเสพติทุกชนิด </span>
</td></tr>
<tr ><td align="left" width="704" height="25"><span class="style4">&nbsp;&nbsp;&nbsp;&nbsp;มีคะแนนความประพฤติ <b><?php echo number_format(ScoreRating($StuID,$_SESSION['admin_area'],$_SESSION['admin_school']));?></b> คะแนน คิดเป็นร้อยละ <b><?php echo number_format(PercentRating($StuID,$_SESSION['admin_area'],$_SESSION['admin_school']),2);?></b> อยู่ในระดับ <b><?php echo RateRating(PercentRating($StuID,$_SESSION['admin_area'],$_SESSION['admin_school']));?></b></span>
</td></tr>
<tr ><td align="left" width="704" height="33">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ออกให้ ณ วันที่ <b><?php echo $Date;?></b></td></tr>
</td></tr>
</table>
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="350" height="53"></td><td align="rigth" width="354" ><span class="style4">&nbsp;</span></td></tr>
<?php if($arr['nut']['rub_check'] !=''){?>
<tr ><td align="left" width="342" height="33"></td><td align="rigth" width="362" ><img src="../../../uploads/<?=$arr['schcon']['shc_boss_sig'];?>" border="0" width="150"></td></tr>
<?php } ?>
 </table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="342" height="33"></td><td align="rigth" width="362" ><span class="style4">(<?=$arr['sch']['sh_boss'];?>)</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="305" height="23"></td><td align="rigth" width="399" ><span class="style4">ผู้อำนวยการโรงเรียน<?=$arr['sch']['sh_name'];?></span></td></tr>
 </table>

<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="rigth" width="354" height="55"><span class="style4"></span></td></tr>
<tr ><td align="rigth" width="362" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../../img/border_pic.png" border="0" width="120"></td></tr>
 </table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr ><td align="rigth" width="362" height="35"><span class="style4">&nbsp;&nbsp;&nbsp;&nbsp;...........................................</span></td></tr>
<tr ><td align="rigth" width="362" height="25"><span class="style4">&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $stu_name;?>)</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="rigth" width="399" ><span class="style4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;นักเรียน</span></td></tr>
 </table>


 </table>
</div>
</body>
</html>

<?Php
$footer = "<table width=\"704\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			<tr >
			<td align=\"center\" width=\"704\" height=\"23\">
			<span class=\"style9\">(ใบรับรองนี้มีกำหนดอายุ 60 วัน นับแต่วันที่ออก)</span>
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
$pdf->Output('../../../MyPDF/rub-'.$StuID.'-'.$NutID.'.pdf');
		$exclude = array('.','..','.htaccess');
		$objOpenx = @opendir(WEB_PATH."/MyPDF/");
		$q = 'rub-'.$StuID.'-'.$NutID.'.pdf';
		while(false!== ($filex = readdir($objOpenx))) {
			if(strpos(strtolower($filex),$q)!== false &&!in_array($filex,$exclude)) {
				if($filex=='rub-'.$StuID.'-'.$NutID.'.pdf' ) { $Statusx=1;} else {$Statusx=0;}
			}
		}
		@closedir($objOpenz);

	if($Statusx){
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
