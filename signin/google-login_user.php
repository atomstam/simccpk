<?php
ob_start();
session_start();
//require_once '../includes/Facebook/autoload.php';
require_once("../includes/config.php");
require_once("../includes/class.mysqli.php");
require_once("../includes/function.in.php");
require_once("../lang/thai.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$IPADDRESS=get_real_ip();

//google AIP
require_once "../includes/GoogleAPI/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId(""._GOOGLE_Api_ID."");
$gClient->setClientSecret(""._GOOGLE_Api_Secret."");
$gClient->setApplicationName(_heading_main_title);
$gClient->setRedirectUri(WEB_URLS."/signin/google-login_user.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
$loginURL = $gClient->createAuthUrl();


	if (isset($_SESSION['access_token']))
		$gClient->setAccessToken($_SESSION['access_token']);
	else if (isset($_GET['code'])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['access_token'] = $token;
	} else {
		header('Location: login.php');
		exit();
	}


if (isset($_SESSION['access_token'])) {
	$gClient->setAccessToken($_SESSION['access_token']);

	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();

	//$_SESSION['id'] = $userData['id'];
	//$_SESSION['email'] = $userData['email'];
	//$_SESSION['gender'] = $userData['gender'];
	//$_SESSION['picture'] = $userData['picture'];
	//$_SESSION['familyName'] = $userData['familyName'];
	//$_SESSION['givenName'] = $userData['givenName'];



$ses_timein=date("Y-m-d H:i:s");
$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." WHERE email='".$userData['email']."'  and  status='1' "); 
$rows['user'] = @$db->rows($res['user']); 
if(!empty($rows['user'])){
	$arr['user'] = $db->fetch($res['user']);
	$Pass=$arr['user']['password'];
	$_SESSION['user_login'] = $arr['user']['username'] ;
	$_SESSION['user_pwd'] = $Pass ;
	$_SESSION['user_area'] = $arr['user']['area'] ;
	$_SESSION['user_code'] = $arr['user']['code'] ;
	$_SESSION['user_school'] = $arr['user']['code'] ;
	$_SESSION['user_major'] = $arr['user']['major'] ;
	$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_code='".$arr['user']['code']."' AND sh_area='".$arr['user']['area']."' "); 
	$arr['sh'] = $db->fetch($res['sh']);
	$_SESSION['school_name']=$arr['sh']['sh_name'];

	$_SESSION['ua'] = $_SESSION['user_login'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'].":".$_SESSION['user_school'];
	$timeoutseconds=60*60; // 30 นาที
//	$_SESSION['timestamp2']=time();
	$timeout=time() + $timeoutseconds;
	$_SESSION['timeout']=$timeout;

	$ct_ip = $_SERVER["REMOTE_ADDR"];
	$ct_yyyy = date("Y") ;
	$ct_mm = date("m") ;
	$ct_dd = date("d") ;
	$ct_time = time();
//echo $_SESSION['user_login'];
		$db->add_db(TB_ACTIVEUSER,array(
			"ct_area"=>"".$_SESSION['user_area']."",
			"ct_user"=>"".$_SESSION['user_login']."",
			"ct_yyyy"=>"".$ct_yyyy."",
			"ct_mm"=>"".$ct_mm."",
			"ct_dd"=>"".$ct_dd."",
			"ct_ip"=>"".$ct_ip."",
			"ct_count"=>"1",
			"ct_time"=>"".$ct_time."",
			"ct_timeout"=>"".$timeout.""
		));

		$res['online'] = $db->select_query("SELECT * FROM ".TB_USER_ONLINE." WHERE u_user='".$_SESSION['user_login']."' "); 
		$rows['online'] = @$db->rows($res['online']); 
		if($rows['online']){
		$db->update_db(TB_USER_ONLINE,array(
//			"area_code"=>"".$_SESSION['user_code']."",
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		),"  u_user='".$_SESSION['user_login']."' " );
		} else {
		$db->add_db(TB_USER_ONLINE,array(
			"area_code"=>"".$_SESSION['user_area']."",
			"u_user"=>"".$_SESSION['user_login']."",
			"u_school"=>"".$_SESSION['user_school']."",
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		));
		}
	//	$db->closedb ();

//		$res['fb'] = $db->select_query("SELECT * FROM ".TB_FACEBOOK." WHERE  FACEBOOK_ID = '".$user['id']."'  "); 
//		$arr['fb'] = $db->fetch($res['fb']); 
//		if($arr['fb'])
//		{
//		$_SESSION["strFacebookID"] = $user['id'];
//		} else {
//		$strPicture = "https://graph.facebook.com/".$user['id']."/picture?type=large";
//		$db->add_db(TB_FACEBOOK,array(
//			"USER_TYPE"=>"user",
//			"FACEBOOK_ID"=>"".$user['id']."",
//			"NAME"=>"".$user['name']."",
//			"EMAIL"=>"".$user['email']."",
//			"PICTURE"=>"".$strPicture."",
//			"LINK"=>"".$user['link']."",
//			"CREATE_DATE"=>"".$ses_timein.""
//		));
//		$_SESSION["strFacebookID"] = $user['id'];
//		}
		echo "<meta http-equiv='refresh' content='0; url=".WEB_URL."/user/index.php'>";
		//echo $_SESSION['uaAd'];
		//echo $Pass;
} else {
session_unset();
setcookie("strFacebookID");
setcookie("facebook_access_token");
//require_once ("index.php");
//echo $accessToken;
unset($_SESSION['access_token']);
$gClient->revokeToken();
		echo "<meta http-equiv='refresh' content='0; url=".WEB_URL."/user/index.php?FB=N'>";

}



}

?>