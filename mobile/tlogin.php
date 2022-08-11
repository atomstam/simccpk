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
$tdata=$_POST['tuser'];
$tpass=md5($_POST['tpass']);
//echo $sdata;
$DateIn=date('Y-m-d H:i:s');
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." where username='".$tdata."' and password='".$tpass."' "); 
$rows = @$db->rows($res['user']);
if($rows){
echo "OK";
} else {
echo "Not OK";
}

?>