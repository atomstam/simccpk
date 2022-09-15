<?php
require_once("mainfile.php");
$_SERVER['PHP_SELF'] = "index.php";
//if(time() > $_SESSION['timeout']){
//session_unset();
//setcookie("person_login");
//require_once ("modules/user/login.php");
//}

/*
$visitor_ip = $IPADDRESS;
$visitor_browser = getBrowserType();
$visitor_hour = date("h");
$visitor_minute = date("i");
$visitor_date = date("Y-m-d H:i:s");
$visitor_day = date("d");
$visitor_month = date("m");
$visitor_year = date("Y");
$visitor_refferer = $_SERVER['HTTP_REFERER'];
$visited_page = str_replace(WEB_URL,"",selfURL());
//$info = getInfo($IPADDRESS);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->add_db(TB_VISITOR,array(
"visitor_ip"=> $visitor_ip,
"visitor_browser"=> $visitor_browser,
"visitor_date"=> $visitor_date,
"city"=>  $info["city"],
"location"=>  $info['country'],
"longitude"=>  $info["long"],
"latitude"=> $info["lat"],
"visitor_refferer"=> $visitor_refferer,
"visitor_page"=> $visited_page,
"localTimeZone"=> $info["localTimeZone"]
));
*/
//echo $_SESSION['timeout'];

//define('WEB_URL', 'https://'.$_SERVER['SERVER_NAME'].'');
//define('WEB_URLS', 'https://'.$_SERVER['SERVER_NAME'].'');
//define('WEB_URL_IMG', 'https://'.$_SERVER['SERVER_NAME'].'/img/');
//define('WEB_URL_IMG_person', 'https://'.$_SERVER['SERVER_NAME'].'/img/person/');
//define('WEB_URL_IMG_PERSON', 'https://'.$_SERVER['SERVER_NAME'].'/img/person/');
//define('WEB_URL_IMG_STU', 'https://'.$_SERVER['SERVER_NAME'].'/img/stu/');
//define('WEB_URL_IMG_USER', 'https://'.$_SERVER['SERVER_NAME'].'/img/user/');
//define('WEB_URL_IMG_MAG', 'https://'.$_SERVER['SERVER_NAME'].'/img/mag/');
//define('WEB_URL_IMG_ICON', 'https://'.$_SERVER['SERVER_NAME'].'/img/icon/');
//define('WEB_URL_IMG_MOTOR', 'https://'.$_SERVER['SERVER_NAME'].'/img/motor/');
//define('WEB_URL_IMG_NEWS', 'https://'.$_SERVER['SERVER_NAME'].'/img/news/');
//define('WEB_URL_IMG_NEWS_RAN', 'https://'.$_SERVER['SERVER_NAME'].'/img/news/');
//define('WEB_URL_IMG_SCHOOL','https://'.$_SERVER['SERVER_NAME'].'/img/school/');

$res['sch'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_web='".$_SERVER['SERVER_NAME']."' and sh_status='1' ");
$arr['sch'] = $db->fetch($res['sch']);

$_SESSION['sh_code']=$arr['sch']['sh_code'];
$_SESSION['sh_name']=$arr['sch']['sh_name'];

//echo WEB_URLS;

if(!empty($_SESSION['stu_login']) ){
if(empty($_SESSION['uaAd']) || $_SESSION['uaAd'] != $_SESSION['stu_login'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'])
{
session_unset();
//session_destroy();
//session_destroy();
setcookie("personlogin");
setcookie("persongroup");
setcookie("personpwd");
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
session_regenerate_id(); // เริ่ม session อื่นใหม
//die('Session Hijacking Attempt');
echo "<meta http-equiv='refresh' content='0; url=".WEB_URL."/person/index.php'>";
} else  {
require_once("modules/index/lang/index.php");
require_once("modules/index/index.php");
}
} else {
if(isset($_GET['name']) and isset($_GET['file'])){
//GETMODULE($_GET['name'],$_GET['file']);
require_once("modules/".$_GET['name']."/".$_GET['file'].".php");
$home ="index.php?name=".$_GET['name']."&file=".$_GET['file']."&route=".$route."";
} else {
require_once("modules/stu/lang/login.php");
require_once ("modules/stu/login.php");
}
}

?>
