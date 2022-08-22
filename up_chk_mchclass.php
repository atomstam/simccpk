<?php
//ob_start();
//if (session_id() =='') { @session_start(); }
require_once("includes/config.php");
require_once("includes/class.mysql.php");
//require_once("mainfile.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$sql = $db->select_query("SELECT * FROM `web_chclass` where c_area='101726' and c_code='44012028' group by c_class,c_cn");
while($arr = $db->fetch($sql)){
	$sql_up = "INSERT INTO web_chk_mclass 
								(chkm_area,chkm_code,chkm_class,chkm_cn,chkm_date,chkm_datetime,chkm_note) 
								VALUES ( '101726','44012028','".$arr['c_class']."','".$arr['c_cn']."' ,'".date("Y-m-d")."' ,'".date("Y-m-d H:i:s")."','".$arr['c_note']."')";
	$rs_up .= $db->select_query($sql_up);
//	$rs_up .= $i.".".$arr['c_class']."/".$arr['c_cn']."<br>";

	$sql_up = "update web_chclass set c_cn='".$arr['stu_cn']."' where c_area='101726' and c_code='44012028' and c_stu='".$arr['stu_id']."' ";
	$rs_up .= $db->select_query($sql_up);
//	$rs_up .= $i.".".$arr['c_class']."/".$arr['c_cn']."<br>";

}

if($rs_up){
	echo $rs_up;
} else {
	echo "Error";

}

?>