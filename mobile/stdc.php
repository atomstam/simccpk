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
$cdata=$_POST['cdata'];
$tdata=$_POST['tdata'];
//echo $sdata;
$DateIn=date('Y-m-d H:i:s');
$DD=date('Y-m-d');
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM web_stuc where in_stu='".$cdata."' and b_date like '%".$DD."%' "); 
$rows = @$db->rows($res['user']);
if($rows){
	$add ="";
} else {
	$add =$db->add_db("web_stuc",array(
			"in_stu"=>"".$cdata."",
			"in_posted"=>"".$tdata."",
			"b_date"=>"".$DateIn.""
			));
}
if($add){
	echo "OK";
} else {
	echo "Not OK";
}

?>