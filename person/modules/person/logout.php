 <?php 
//require_once ("modules/index/header.php");
require_once("../includes/config.php");
require_once("../includes/class.mysql.php");

		$db->update_db(TB_PERSON_ONLINE,array(
			"u_timeout"=>"".time().""
		),"  u_user='".$_SESSION['person_login']."' " );
//require_once("index.php");
session_unset();
//session_destroy();
setcookie("person_login");
setcookie("person_group");
setcookie("person_pwd");
setcookie("person_school");
setcookie("person_area");
setcookie("school_name");
setcookie("strFacebookID");
setcookie("facebook_access_token");


//google AIP
if(!empty($_SESSION['access_token'])){
require_once "../includes/GoogleAPI/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId(""._GOOGLE_Api_ID."");
$gClient->setClientSecret(""._GOOGLE_Api_Secret."");
unset($_SESSION['access_token']);
$gClient->revokeToken();
}
//require_once ("index.php");
echo "<meta http-equiv='refresh' content='0; url=".WEB_URL."/index.php'>";
?>

