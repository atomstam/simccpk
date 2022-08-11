<?
session_start();
require_once("mainfile.php");
 //include ("header.php");
$Date=date("Y-m-d");
$Time=date("H:s:i");
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$sql3 = $db->select_query("SELECT *  FROM ".TB_STUDENT."  WHERE stu_id='".$_GET["MemberID"]."'  ");
//$result3=mysqli_query($connect,$sql3);
$db3=$db->fetch($sql3);

if($db3['stu_id']){

$sql4 =$db->select_query("SELECT *  FROM ".TB_GOTOSCH."  WHERE gsch_sid='".$db3['stu_id']."' and gsch_date='".$Date."' ");
//$result4=mysqli_query($connect,$sql4);
$db4=$db->fetch($sql4);

if(empty($db4['gsch_sid'])){
 $sql1=$db->select_query("insert  into  ".TB_GOTOSCH."
(gsch_sid,gsch_date,gsch_time,gsch_user) values ('".$db3['stu_id']."','".$Date."','".$Time."','".$_SESSION['admin_user']."')");
$objQuery1 = $db->fetch($sql1) or die('No1');
} else {
// $sql2=$db->select_query("update  ".TB_GOTOSCH." set  gsch_time='".$Time."' where gsch_sid='".$db3['stu_id']."' and gsch_date='".$Date."' and gsch_user='".$_SESSION['admin_user']."' ");
//$objQuery2 = $db->fetch($sql2) or die('No2');
		$update=$db->update_db(TB_GOTOSCH,array(
						"gsch_time"=>"".$Time.""
		)," gsch_sid='".$db3['stu_id']."' and gsch_date='".$Date."' and gsch_user='".$_SESSION['admin_user']."' ");
}
$DATEENC=date("H:i:s");
echo "<center><font color=#CC0000 size=6><b>[ เวลามา ".$DATEENC." ]</b></font></center>";
$sql5 = $db->select_query("SELECT *  FROM ".TB_CLASS."  WHERE class_id='".$db3['stu_class']."' ");
//$result5=mysqli_query($connect,$sql5);
$db5=$db->fetch($sql5);
$ThaiDate=FullDateThai($db3['stu_birth']);
echo "<table width=100% border=0 bordercolor=#336699 cellpadding=\"0\" cellspacing=\"0\" ><tr><td valign=top width=30% align=center>";
if (empty($db3['stu_pic'])){
                 echo  "<center><table width=100% border=0 cellspacing=0 cellpadding=0 align=center><tr><td align=center><img src=\"img/no_image.jpg\" align=center width=100></td></tr></table></center>";
} else {
                 echo  "<center>";
				 echo "<table width=100% border=0 cellspacing=0 cellpadding=0 align=center><tr><td background=img/border/h1.jpg border=0 width=22 height=18></td><td background=img/border/h2.jpg border=0 height=18></td><td background=img/border/h3.jpg border=0 width=19 height=18></td></tr>";
				 echo "<tr><td background=img/border/left.jpg border=0 width=22></td><td><img src=\"img/stu/".$db3['stu_pic']."\" align=center></td><td background=img/border/right.jpg border=0 width=19></td></tr>";
				echo "<tr><td background=img/border/f1.jpg border=0 width=22 height=40></td><td background=img/border/f2.jpg border=0 height=40 align=center><b>( ".$db3['stu_nick']." )</td><td background=img/border/f3.jpg border=0 width=19 height=40></td></tr></table></center>";
}
echo "</td><td valign=top width=70% align=center><table width=100% border=0 align=center>";
echo "<tr><td valign=top bgcolor=#FFFFCC><font color=blue>เลขนักเรียน</td><td>$db3[stu_id]</font></td></tr>";
echo "<tr><td valign=top bgcolor=#FFFFCC><font color=blue>เลขประชาชน</td><td>$db3[stu_pid]</font></td></tr>";
echo "<tr><td bgcolor=#FFFFCC><font color=blue>ชื่อ-สกุล</td><td bgcolor=#0033FF><font color=#ffffff>$db3[stu_num] $db3[stu_name]   $db3[stu_sur] ( $db3[stu_nick] )</font></td></tr>";
echo "<tr><td bgcolor=#FFFFCC><font color=blue>ชั้นเรียน</td><td>$db5[class_name]</td></tr>";
echo "<tr><td bgcolor=#FFFFCC><font color=blue>วัน/เดือน/ปีเกิด</td><td>".$ThaiDate."</font></td></tr>";
echo "</table></td></tr></table>";
} else {
echo "<font color=#FF0000 size=6><b><< ไม่มีข้อมูล >></b></font>";
}
?>