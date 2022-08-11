 <?php 
//require_once ("modules/index/header.php");
require_once("../includes/config.php");
require_once("../includes/class.mysqli.php");
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_ADMIN_ONLINE,array(
			"u_timeout"=>"".time().""
		),"  u_user='".$_SESSION['admin_login']."' " );
//require_once("index.php");
session_unset();
//session_destroy();
setcookie("admin_login");
setcookie("admin_group");
setcookie("admin_pwd");
//require_once ("index.php");
echo "<meta http-equiv='refresh' content='0; url=".WEB_URL."/index.php'>";
?>

