<?php
ob_start();
session_start();
require_once '../includes/Facebook/autoload.php';
require_once("../includes/config.php");
require_once("../includes/class.mysql.php");
require_once("../includes/function.in.php");
require_once("../lang/thai.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$IPADDRESS=get_real_ip();
//echo _Facebook_Api_Key;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRedirectLoginHelper;

$fb = new Facebook\Facebook([
  'app_id' => _Facebook_Api_Key,
  'app_secret' => _Facebook_Api_Secret,
  'default_graph_version' => 'v3.0',
]);

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;

  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']

  $response = $fb->get('/me?fields=id,name,gender,email,link', $accessToken);

  $user = $response->getGraphUser();
 // echo'<pre>';
 // print_r($user);
 // echo'</pre>';




$ses_timein=date("Y-m-d H:i:s");
$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE email='".$user['email']."'  and  status='1' "); 
$rows['user'] = @$db->rows($res['user']); 
if(!empty($rows['user'])){
	$arr['user'] = $db->fetch($res['user']);
	$Pass=$arr['user']['password'];
	$_SESSION['admin_login'] = $arr['user']['username'] ;
	$_SESSION['admin_pwd'] = $Pass ;
	$_SESSION['admin_group'] = $arr['user']['admin_group_id'] ;
	$_SESSION['admin_school'] = $arr['user']['school_code'] ;
	$_SESSION['admin_area'] = $arr['user']['area_code'] ;
	$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_code='".$arr['user']['school_code']."' AND sh_area='".$arr['user']['area_code']."' "); 
	$arr['sh'] = $db->fetch($res['sh']);
	$_SESSION['school_name']=$arr['sh']['sh_name'];

	$_SESSION['uaAd'] = $_SESSION['admin_login'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$timeoutseconds=60*60; // 30 นาที
//	$_SESSION['timestamp2']=time();
	$timeout=time() + $timeoutseconds;
	$_SESSION['timeout']=$timeout;

	$ct_ip = $_SERVER["REMOTE_ADDR"];
	$ct_yyyy = date("Y") ;
	$ct_mm = date("m") ;
	$ct_dd = date("d") ;
	$ct_time = time();
//echo $_SESSION['admin_login'];
		$db->add_db(TB_ACTIVEUSER,array(
			"ct_area"=>"".$_SESSION['admin_area']."",
			"ct_school"=>"".$_SESSION['admin_school']."",
			"ct_user"=>"".$_SESSION['admin_login']."",
			"ct_yyyy"=>"".$ct_yyyy."",
			"ct_mm"=>"".$ct_mm."",
			"ct_dd"=>"".$ct_dd."",
			"ct_ip"=>"".$ct_ip."",
			"ct_count"=>"1",
			"ct_time"=>"".$ct_time."",
			"ct_timeout"=>"".$timeout.""
		));

		$res['online'] = $db->select_query("SELECT * FROM ".TB_ADMIN_ONLINE." WHERE u_user='".$_SESSION['admin_login']."' "); 
		$rows['online'] = @$db->rows($res['online']); 
		if($rows['online']){
		$db->update_db(TB_ADMIN_ONLINE,array(
//			"area_code"=>"".$_SESSION['adminarea']."",
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		),"  u_user='".$_SESSION['admin_login']."' " );
		} else {
		$db->add_db(TB_ADMIN_ONLINE,array(
			"area_code"=>"".$_SESSION['admin_area']."",
			"school_code"=>"".$_SESSION['admin_school']."",
			"u_user"=>"".$_SESSION['admin_login']."",
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		));
		}
	//	$db->closedb ();

		$res['fb'] = $db->select_query("SELECT * FROM ".TB_FACEBOOK." WHERE  FACEBOOK_ID = '".$user['id']."'  "); 
		$arr['fb'] = $db->fetch($res['fb']); 
		if($arr['fb'])
		{
		$_SESSION["strFacebookID"] = $user['id'];
		} else {
		$strPicture = "https://graph.facebook.com/".$user['id']."/picture?type=large";
		$db->add_db(TB_FACEBOOK,array(
			"USER_TYPE"=>"admin",
			"FACEBOOK_ID"=>"".$user['id']."",
			"NAME"=>"".$user['name']."",
			"EMAIL"=>"".$user['email']."",
			"PICTURE"=>"".$strPicture."",
			"LINK"=>"".$user['link']."",
			"CREATE_DATE"=>"".$ses_timein.""
		));
		$_SESSION["strFacebookID"] = $user['id'];
		}
		echo "<meta http-equiv='refresh' content='0; url=".WEB_URL."/admin/index.php'>";
		//echo $_SESSION['uaAd'];
		//echo $Pass;
} else {
session_unset();
setcookie("strFacebookID");
setcookie("facebook_access_token");
//require_once ("index.php");
//echo $accessToken;
		echo "<meta http-equiv='refresh' content='0; url=".WEB_URL."/admin/index.php?FB=N'>";

}



}

?>