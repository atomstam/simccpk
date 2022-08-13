<?php
ob_start();
header('Content-Type: application/json');
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/maindo.php");
$db = New DB();
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$strSQL = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' "); 
	$resultArray = array();
	while($obResult =  $db->fetch($strSQL))
	{
		array_push($resultArray,$obResult);
	}
	
//	mysql_close($objConnect);
	
	echo json_encode($resultArray);
?>

