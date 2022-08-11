 <?php 
require_once("mainfile.php");
//require_once("includes/config.php");
//require_once("includes/class.mysql.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$db->update_db(TB_ADMIN_ONLINE,array(
	"u_timeout"=>"".time().""
),"  u_user='".$_SESSION['admin_login']."' " );
$db->update_db(TB_PERSON_ONLINE,array(
	"u_timeout"=>"".time().""
),"  u_user='".$_SESSION['person_login']."' " );
$db->update_db(TB_STUDENT_ONLINE,array(
	"u_timeout"=>"".time().""
),"  u_user='".$_SESSION['stu_login']."' " );

//require_once("index.php");
session_unset();
session_destroy();

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

