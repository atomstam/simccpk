<?php
header('Content-Type: application/json');
require_once("../../../admin/modules/user/lang/login.php");
$res=array();
$res['errors']=array();
$res['success']=array();
if (isset($_POST)) {
$Username = preg_replace ( '/"/i', '\"' , $_POST['username']); 
$Password= preg_replace ( "/'/i", "\'" , $_POST['password']);
	if(empty($Username)) {
		array_push($res['errors'], _LOGIN_ERROR_NULL_USER);
	}
	if(empty($Password)) {
		array_push($res['errors'], _LOGIN_ERROR_NULL_PASS);
	}

if(empty($res['errors'])) {
require_once("../../../mainfile.php");

$resr['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$Username."' AND password='".md5($Password)."' "); 
$arr['user'] = $db->fetch($resr['user']);
if(!empty($arr['user']['admin_id'])){
	array_push($res['success'], _LOGIN_ACCESS);
//	$res['success'] = true;
//if (session_id() =='') { @session_start(); }
	ob_start();
	$_SESSION['admin_login'] = $Username ;
	$_SESSION['admin_pwd'] = md5($Password) ;
	$_SESSION['admin_group'] = $arr['user']['admin_group_id'] ;


	$_SESSION['uaAd'] = $_SESSION['admin_login'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];

	$timeoutseconds=10*60; // 10 นาที
//	$_SESSION['timestamp2']=time();
	$timeout=time() + $timeoutseconds;
	$_SESSION['timeout']=$timeout;

	$ct_ip = $_SERVER["REMOTE_ADDR"];
	$ct_yyyy = date("Y") ;
	$ct_mm = date("m") ;
	$ct_dd = date("d") ;
	$ct_time = time();

		$db->add_db(TB_ACTIVEUSER,array(
			"ct_user"=>"".$_SESSION['admin_login']."",
			"ct_yyyy"=>"".$ct_yyyy."",
			"ct_mm"=>"".$ct_mm."",
			"ct_dd"=>"".$ct_dd."",
			"ct_ip"=>"".$ct_ip."",
			"ct_count"=>"1",
			"ct_time"=>"".$ct_time."",
			"ct_timeout"=>"".$timeout.""
		));
//		echo $_SESSION['user_login'];
		$rest['online'] = $db->select_query("SELECT * FROM ".TB_ADMIN_ONLINE." WHERE u_user='".$_SESSION['admin_login']."'  "); 
		$arr['online'] = $db->fetch($rest['online']); 
		if(!empty($arr['online']['u_id'])){
		$db->update_db(TB_ADMIN_ONLINE,array(
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		),"  u_user='".$_SESSION['admin_login']."' " );
		} else {
		$db->add_db(TB_ADMIN_ONLINE,array(
			"u_user"=>"".$_SESSION['admin_login']."",
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		));
		}
//		$db->closedb ();
}	else {
			array_push($res['errors'], _LOGIN_ERROR_NO_ACCESS);
			$res['success'] = false;
		}
} else {
	//$error_warning =_error_warning;
		$res['success'] = false;		
}
echo json_encode($res);
}
?>
