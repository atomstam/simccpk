<?php
//ob_start();
//if (session_id() =='') { @session_start(); }
require_once("includes/config.php");
require_once("includes/class.mysql.php");
//require_once("mainfile.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$sql_stu = "SELECT * FROM web_student where stu_area='101726' and stu_code='44012028' order by stu_id";
$rs_stu= $db->select_query($sql_stu);
$arr_StuID = array();
$arr_StuClass = array();
$arr_StuCn = array();
$is=1;
while($r_stu = $db->fetch($rs_stu)){
	$arr_StuID[$r_stu['stu_id']] = $r_stu['stu_id'];
	$arr_StuClass[$r_stu['stu_id']] = $r_stu['stu_class'];
	$arr_StuCn[$r_stu['stu_id']] = $r_stu['stu_cn'];
$is++;
}

$i=1;
$sql = $db->select_query("select * from web_chclass where c_area='101726' and c_code='44012028' order by c_id ");
while($arr = $db->fetch($sql)){

			$Cn = $arr_StuCn[$arr['c_stu']];

			$sql_up = "UPDATE web_chclass SET 
							c_cn  = '".$Cn."' 
							WHERE c_id = '".$arr['c_id']."' ";
			$rs_up = $db->select_query($sql_up);
			//echo $Cn;
$i++;
}

if($rs_up){
	echo $i;
} else {
	echo "Error";

}

?>