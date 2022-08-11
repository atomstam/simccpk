<?php
//ob_start();
//if (session_id() =='') { @session_start(); }
require_once("includes/config.php");
require_once("includes/class.mysql.php");
require_once("lang/dateThai.php");
require_once("includes/array.in.php");
require_once("includes/function.in.php");
//require_once("mainfile.php");
$db = New DB();
//$ONET='101702';
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//$res['stu']= "select stu_id,stu_num,stu_name,stu_sur,stu_class from web_student where stu_code='44012023' ";
$res['stu']=$db->select_query("select * from web_student where stu_class between 'm1' and 'm3' and stu_code='44012023' order by stu_class,stu_id" ) ;
$i=0;
$DateThai=ShortDateThai(date('Y-m-d'));
echo "<center><b>คำนวณอายุนักเรียนชั้น ม.1-3 <font color='red'>(นับถึงวันที่ ".$DateThai.")</font></b></center>";
echo "<center><table border='1' bordercolor='#000000' cellspacing='0'><tr><td align='center'>รหัสนักเรียน</td><td align='center'>ชื่อสกุล</td><td align='center'>ระดับชั้น</td><td align='center'>วันเดือนปีเกิด</td><td align='center'>อายุ</td></tr>";
while ($arr['stu'] = $db->fetch($res['stu']))
{
	$res['cl']=$db->select_query("select * from web_class where class_id='".$arr['stu']['stu_class']."' ");
	$arr['cl']= $db->fetch($res['cl']);
	list($aY1,$aM1,$aD1)=CalAge($arr['stu']['stu_birth']);
	echo "<tr><td>".$arr['stu']['stu_id']."</td><td>".$arr['stu']['stu_num'].$arr['stu']['stu_name']." ".$arr['stu']['stu_sur']."</td> <td>".$arr['cl']['class_short']."</td><td>".ShortDateThai($arr['stu']['stu_birth'])."</td><td>$aY1 ปี $aM1 เดือน $aD1 วัน</td></tr>";
$i++;
}
echo "</table></center>";



//list($aY1,$aM1,$aD1)=CalAge($birth_day);

//echo "$aY1,$aM1,$aD1";

?>