<?php
header('Content-Type: application/json');
//require_once("../../lang/user/register.php");
if (isset($_POST)) {
require_once("../../../mainfile.php");
//$username = mysql_real_escape_string($_POST['username']);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM ".TB_SMP_USER." where email='".$_POST['email']."' "); 
$rows['user'] = $db->fetch($res['user']);
if($rows['user']){
echo '0';
} else {
echo '1';
}
}
?>
