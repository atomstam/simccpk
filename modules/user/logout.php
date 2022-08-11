 <?php 
require_once ("modules/index/header.php");
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_ONLINE,array(
			"u_timeout"=>"".time().""
		),"  u_user='".$_SESSION['user_login']."' and u_school='".$_SESSION['user_school']."' " );
//require_once("index.php");
session_unset();
session_destroy();
setcookie("user_login");
setcookie("user_code");
//require_once ("index.php");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
?>

