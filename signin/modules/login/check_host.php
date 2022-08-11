<?php
header('Content-Type: application/json');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysqli.php");
//require_once("lang/reg.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//require_once("../../lang/user/register.php");
if (isset($_POST)) {
//$username = mysql_real_escape_string($_POST['username']);
$res['user'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." where host='".$_POST['host']."' "); 
$rows['user'] = $db->rows($res['user']);
if($rows['user']){
echo '0';
} else {
echo '1';
}
}
$db->closedb ();
?>
