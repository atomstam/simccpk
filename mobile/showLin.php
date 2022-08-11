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
echo "sssssssssssssss";
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM web_stuin where b_date like '%".$DateIn."%' order by in_id desc limit 10 "); 
echo "<table id='example1' class='table table-bordered table-striped'>";
while($arr['user'] = $db->fetch($res['user'])){
$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_id='".$arr['user']['in_stu']."' "); 
$arr['stu'] = $db->fetch($res['stu']);
$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." where class_id='".$arr['stu']['stu_class']."' "); 
$arr['cl'] = $db->fetch($res['cl']);
echo "<tr >";
echo "<td style='text-align: center;'>";
echo "<div class='useravatar'><img src='".WEB_URL_IMG_STU.$arr['stu']['stu_pic']."' ></div>";
echo "</td><td valign='top'>";
echo "ชื่อ - สกุล : <span class='badge bg-green'>".$arr['stu']['stu_num']."".$arr['stu']['stu_name']." ".$arr['stu']['stu_sur']."</span><br>";
echo "ชั้น : <span class='badge bg-yellow'>".$arr['cl']['class_name']."</span><br>";
echo "เวลามาโรงเรียน : <span class='badge bg-red'>".$arr['user']['b_date']."</span><br>";
echo "</td></tr>";
}
echo "</table>";
?>