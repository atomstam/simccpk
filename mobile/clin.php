<!DOCTYPE html>
<html>
<head>
		<!-- bootstrap 3.0.2 -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
		<link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		<link href="../dist/css/base.css" rel="stylesheet" media="screen"/>
<style>
body{background-color:transparent;}
table {border-spacing: 8px 2px;}
td    {padding: 6px;}
</style>
</head>
<body>

<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../includes/config.php");
require_once("../includes/class.mysql.php");
$db = New DB();
$add='';
$edit='';
$del='';
//$Avatar='';
//$tdata=$_POST['tuser'];
//$tpass=md5($_POST['tpass']);
//echo $sdata;
$DateIn=date('Y-m-d');
$tdata=$_GET['tuser'];
if($tdata){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM web_stuc where b_date like '%".$DateIn."%' order by in_id desc limit 10 "); 
$row= @$db->rows($res['user']);
if($row){
echo "<table id='example1' class='table table-bordered table-striped' cellspacing='1' cellpadding='1' width='100%'>";
while($arr['user'] = $db->fetch($res['user'])){
$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_id='".$arr['user']['in_stu']."' "); 
$arr['stu'] = $db->fetch($res['stu']);
$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." where class_id='".$arr['stu']['stu_class']."' "); 
$arr['cl'] = $db->fetch($res['cl']);
echo "<tr >";
echo "<td style='text-align: center; width:30%' width='30%'>";
echo "<div class='useravatar' ><img src='".WEB_URL_IMG_STU.$arr['stu']['stu_pic']."' style='width:80px;'></div>";
echo "</td><td width='70%' valign='top'>";
echo "ชื่อ - สกุล : <span class='badge bg-green'>".$arr['stu']['stu_num']."".$arr['stu']['stu_name']." ".$arr['stu']['stu_sur']."</span><br>";
echo "ชั้น : <span class='badge bg-yellow'>".$arr['cl']['class_name']."</span><br>";
echo "เวลามาโรงเรียน : <span class='badge bg-red'>".$arr['user']['b_date']."</span><br>";
echo "</td></tr>";
}
echo "</table>";
} else {
echo "วันที่ ".$DateIn." ไม่มีข้อมูล";
}

} else {
echo "คุณไม่มีสิทธิ์ใช้งานส่วนนี้";
}

?>
</body>
</html>