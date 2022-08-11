<?php
ob_start();
if (session_id() =='') { @session_start(); }
header('Content-type: application/json');
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("../../../lang/thai.php");
//require_once("lang/admin.php");
$db = New DB();
//$mode=$_POST['mode'];
//$pid=$_POST['id'];
//$pid = isset($_REQUEST['id'])?$_REQUEST['id'] : "";
//$mode = isset($_REQUEST['mode'])?$_REQUEST['mode'] : "";
if(!empty($_SESSION['admin_login'])){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$isAvailable = true;

        $username = $_POST['Username'];
		@$res['user'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_ids='".$username."' "); 
		@$rows['user'] = @$db->rows(@$res['user']);
		if(@$rows['user'] > 0){
			$isAvailable = false; // or false
		}

// Finally, return a JSON
echo json_encode(array(
    'valid' => $isAvailable,
));


} else { echo "<meta http-equiv='refresh' content='1; url=../../index.php'>"; }

?>