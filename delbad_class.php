<?php
//ob_start();
//if (session_id() =='') { @session_start(); }
require_once("includes/config.php");
require_once("includes/class.mysql.php");
//require_once("includes/function.in.php");
//require_once("mainfile.php");
$db = New DB();
//$ONET='101702';
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['cl']= "select * from web_class,web_student where class_id=stu_class and class_id='m1' order by class_id";
$qq=$db->select_query($res['cl']) ;
$i=0;
while ($arr = $db->fetch($qq))
{
echo $arr['stu_id'];
 // add this line
      $sqlx = "delete from web_bad where bad_stu='".$arr['stu_id']."' and bad_tail='22' and b_date between '2018-05-21' and '2018-05-31' ";
     $qqx =$db->select_query($sqlx);

$i++;
}

 if($qqx){
 echo "You database insert ".$xx." records has imported successfully";
 }else{
 echo "Sorry! There is some problem.";
 }

?>