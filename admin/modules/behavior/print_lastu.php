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

@$res['tum'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where id='".@$arr['stu']['stu_tum']."' ");
@$arr['tum'] = $db->fetch(@$res['tum']);
@$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where id='".@$arr['stu']['stu_amp']."' ");
@$arr['amp'] = $db->fetch(@$res['amp']);
@$res['prov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." where id='".@$arr['stu']['stu_prov']."' ");
@$arr['prov'] = $db->fetch(@$res['prov']);

$add1=@$arr['stu']['stu_add']." หมู่ที่ ".@$arr['stu']['stu_group']." ตำบล".@$arr['tum']['name'];
$add2="อำเภอ".@$arr['amp']['name']." จังหวัด".@$arr['prov']['name'];
$add3=" รหัสไปรษณีย์ ".@$arr['stu']['stu_post'];

@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['stu']['stu_class']."' "); 
@$arr['cl'] =$db->fetch(@$res['cl']);
@$res['clg'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."'  "); 
@$arr['clg'] =$db->fetch(@$res['clg']);

@$res['clp'] = $db->select_query("SELECT * FROM ".TB_CLASS_PERSON." as a ,".TB_PERSON." as b WHERE a.clper_area='".$_SESSION['admin_area']."' and a.clper_code='".$_SESSION['admin_school']."'  and a.clper_class='".@$arr['stu']['stu_class']."' and a.clper_tech=b.per_ids  limit 1"); 
@$arr['clp'] =$db->fetch(@$res['clp']);
$per_name=@$arr['clp']['per_name'];

@$res['nut'] = $db->select_query("SELECT * FROM ".TB_LATAIL." WHERE lat_area='".$_SESSION['admin_area']."' and lat_code='".$_SESSION['admin_school']."' and lat_id='".$NutID."' "); 
@$arr['nut']= $db->fetch(@$res['nut']);
$dateLa=CheckDateLa(@$arr['nut']['lat_dateIn'],@$arr['nut']['lat_dateOut']);
$dateIn=ShortDateThai(@$arr['nut']['lat_dateIn']);
$dateOut=ShortDateThai(@$arr['nut']['lat_dateOut']);

@$res['la'] = $db->select_query("SELECT * FROM ".TB_LA." WHERE la_area='".$_SESSION['admin_area']."' and la_code='".$_SESSION['admin_school']."' and la_id='".@$arr['nut']['lat_tail']."' "); 
@$arr['la']= $db->fetch(@$res['la']);

@$res['tech'] = $db->select_query("SELECT * FROM ".TB_PERSON."  WHERE per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' and per_ids='".@$arr['nut']['lat_con_per']."' "); 
@$arr['tech']= $db->fetch(@$res['tech']);

$lat_per=@$arr['tech']['per_name'];

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
  <tr ><td align="center" colspan="2" ><img src="../../../img/logoktp2.png" border="0" width="100"></td></tr>
  <tr ><td align="center" colspan="2" height="45"><span class="style1" style="font-size:14pt;font-weight: bold;">แบบใบลาของนักเรียน</span></td></tr>
  <tr ><td align="left" width="440" height="25"></td><td align="rigth" width="264" class="style4" height="25"><span class="style4">เขียนที่เลขที่ <?php echo $add1;?></span></td></tr>
  <tr ><td align="left" width="440" height="25">&nbsp;</font></td><td align="rigth" width="264" class="style4" ><span class="style4"><?php echo $add2;?></span></td></tr>
   <tr ><td align="left" width="440" height="25">&nbsp;</font></td><td align="rigth" width="264" class="style4" ><span class="style4"><?php echo $add3;?></span></td></tr>
  </table>

<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
  <?php
  $DD=date('Y-m-d H:i:s');
  $Date=FullDateThai($DD);
  ?>
  <tr ><td align="left" width="350" height="33"></td><td align="rigth" width="354" ><span class="style4"><?php echo $Date;?></span></td></tr>
 </table>
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="704" height="33"><span class="style4">เรื่อง ขอ<b><?php echo @$arr['la']['la_name'];?></b></span></td></tr>
<tr ><td align="left" width="704" height="33"><span class="style4">เรียน <b><?php echo $per_name;?></b> ครูที่ปรึกษาชั้น <b><?php echo $class_name;?> </b></span></td></tr>
<tr ><td align="left" width="704" height="25">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="style4">ข้าพเจ้า</span>
<span class="style2"><b><?php echo $stu_name;?></b></span>
<span class="style4">นักเรียนชั้น</span>
<span class="style2"><b><?php echo $class_name;?></b></span>
<span class="style4">ห้อง</span>
<span class="style2"><b><?php echo $class_group;?></b></span>
<span class="style4"> ไม่สามารถมาโรงเรียนได้ตามปกติ</span>
</td></tr>
<tr ><td align="left" width="704" height="25"><span class="style4">เนื่องจาก <b> <?php echo @$arr['nut']['lat_tailname'];?></b></span></td></tr>
 </table>
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="704" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	ข้าพเจ้าจึงขอลาโรงเรียน มีกำหนด <b><?php echo $dateLa;?></b> วัน ตั้งแต่ <b><?php echo $dateIn;?></b> ถึง <b><?php echo $dateOut;?></b>  เมื่อครบกำหนดแล้วข้าพเจ้า
</td></tr>
<tr ><td align="left" width="704" height="25">จะมาเรียนตามปกติ
</td></tr>
<tr ><td align="left" width="704" height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
</td></tr>
</table>
<table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr ><td align="left" width="350" height="33"></td><td align="rigth" width="354" ><span class="style4">ด้วยความเคารพอย่างสูง</span></td></tr>
 </table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="305" height="40"></td><td align="rigth" width="399" ><span class="style4">(ลงชื่อ)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;นักเรียน</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="342" height="25"></td><td align="rigth" width="362" ><span class="style4">(<?php echo $stu_name;?>)</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="704" height="40"><span class="style4">ขอรับรองว่าข้อความข้างต้นเป็นความจริงทุกประการ</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="305" height="25"></td><td align="rigth" width="399" ><span class="style4">(ลงชื่อ)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ปกครอง</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="342" height="25"></td><td align="rigth" width="362" ><span class="style4">(.........................................)</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="300" height="25"></td><td align="rigth" width="404" ><span class="style4">เบอร์โทรศัพท์........................................</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="305" height="50"></td><td align="rigth" width="399" ><span class="style4">(ลงชื่อ)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ครูที่ปรึกษารับทราบ</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="342" height="25"></td><td align="rigth" width="362" ><span class="style4">(<?php echo $per_name;?>)</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="305" height="50"></td><td align="rigth" width="399" ><span class="style4">(ลงชื่อ)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ฝ่ายปกครอง</span></td></tr>
</table>
 <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
<tr ><td align="left" width="342" height="25"></td><td align="rigth" width="362" ><span class="style4">(<?php echo $lat_per;?>)</span></td></tr>
</table>
 </table>
</div>
</body>
</html>

<?Php
$footer = "<table width=\"704\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			<tr >
			<td align=\"left\" width=\"704\" height=\"23\">
			<span class=\"style9\"><b>หมายเหตุ :</b> ใบลาฉบับนี้ ให้คุณครูที่ปรึกษาเก็บรวบรวมไว้เป็นสถิติการลาของนักเรียนเพื่อรายงานกลุ่มบริหารงานปกครองต่อไป</span>
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
$pdf->Output('../../../MyPDF/la-'.$StuID.'-'.$NutID.'.pdf');
		$exclude = array('.','..','.htaccess');
		$objOpenx = opendir(WEB_PATH."/MyPDF/");
		$q = 'la-'.$StuID.'-'.$NutID.'.pdf';
		while(false!== ($filex = readdir($objOpenx))) {
			if(strpos(strtolower($filex),$q)!== false &&!in_array($filex,$exclude)) {
				if($filex=='la-'.$StuID.'-'.$NutID.'.pdf' ) { $Statusx=1;} else {$Statusx=0;}
			}
		}
		closedir($objOpenz);

		// create Imagick object
		//$imagick = new Imagick();
		//$imagick->setResolution(200,200);
		// Reads image from PDF
		//$imagick->readImage('../../../MyPDF/la-'.$StuID.'-'.$NutID.'.pdf');
		$pdfAbsolutePath=('../../../MyPDF/la-'.$StuID.'-'.$NutID.'.pdf');
		$img = new imagick();
		//$img = new imagick($pdfAbsolutePath);
		$img->setResolution(300, 300);
		//$img->resampleImage(500,500,imagick::FILTER_UNDEFINED,1);
		$img->readImage($pdfAbsolutePath);
		//$img->readImageblob($pdfAbsolutePath);
		//$img ->resizeImage(1190, 1684, Imagick::FILTER_UNDEFINED, 1, true);
		$noOfPagesInPDF = $img->getNumberImages();
		if ($noOfPagesInPDF) { 
          for ($i = 0; $i < $noOfPagesInPDF; $i++) { 
              $url = $pdfAbsolutePath.'['.$i.']'; 
              $imagick = new Imagick($url);
			  $imagick->setImageResolution(300, 300);
			  //$imagick->setImageDensity(300);
              $imagick->setImageFormat("jpg"); 
			  $imagick->setImageCompression(imagick::COMPRESSION_JPEG); 
			  $imagick->setImageCompressionQuality(100);
			  //$imagick->resizeImage(1190,  1684,  Imagick::FILTER_UNDEFINED, 1, false);
			  //$imagick->setSize(1190, 1684);
              $imagick->writeImage('../../../MyPDF/la-'.$StuID.'-'.$NutID.'.jpg'); 
          }
          //echo "All pages of PDF is converted to images";
		}
		//header('Content-Type: image/jpeg');
		//echo $imagick;
		//$imagick->clear(); 
		//$imagick->destroy();

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
