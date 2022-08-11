<?php
ob_start();
if (session_id() =='') { @session_start(); }
header('Content-Type: application/json');
require_once("../../../includes/config.php");
require_once("../../../includes/function.in.php");
require_once("../../../includes/class.mysql.php");
require_once("../../../lang/thai.php");
require_once("../../../lang/dateThai.php");
require_once("lang/add_admin.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$IPADDRESS=get_real_ip();
$res=array();
$res['errors']=array();
$res['success']=array();
$add='';
if (isset($_POST)) {
$Username = preg_replace ( '/"/i', '\"' , $_POST['username']); 
$Password= preg_replace ( "/'/i", "\'" , $_POST['password']);
$Area='101726';

$res['userx'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$Username."'  "); 
$arr['userx'] = $db->fetch($res['user']);

if(!empty($Username) && !empty($_POST['email']) && $Username!=$arr['userx']['username']  && $_POST['email']!=$arr['userx']['email'] ){

$added=date("Y-m-d H:i:s");
//$Status='0';
$res['sch'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_area='".$Area."' and sh_code='".$_POST['school_code']."' and sh_status='1' "); 
$arr['sch'] = $db->rows($res['sch']);
if(!$arr['sch']){ 
	$Status='0';
		$add .=$db->add_db(TB_REGISTER,array(
			"area_code"=>"".$Area."",
			"sch_code"=>"".$_POST['school_code']."",
			"admin_num"=>"".$_POST['num']."",
			"admin_group_id"=>"1",
			"username"=>"".$Username."",
			"password"=>"".md5($Password)."",
			"firstname"=>"".$_POST['firstname']."",
			"lastname"=>"".$_POST['lastname']."",
			"email"=>"".$_POST['email']."",
			"phone"=>"".$_POST['phone']."",
			"ip"=>"".$IPADDRESS."",
			"status"=>"".$Status."",
			"date_added"=>"".$added.""
		));
		$add .=$db->update_db(TB_SCHOOL,array(
			"sh_status"=>"".$Status.""
		), " sh_area='".$Area."' and sh_code='".$_POST['school_code']."' ");
		$add .=$db->add_db(TB_ADMIN,array(
			"area_code"=>"".$Area."",
			"school_code"=>"".$_POST['school_code']."",
			"admin_num"=>"".$_POST['num']."",
			"admin_group_id"=>"1",
			"username"=>"".$Username."",
			"password"=>"".md5($Password)."",
			"firstname"=>"".$_POST['firstname']."",
			"lastname"=>"".$_POST['lastname']."",
			"email"=>"".$_POST['email']."",
			"phone"=>"".$_POST['phone']."",
			"ip"=>"".$IPADDRESS."",
			"status"=>"".$Status."",
			"date_added"=>"".$added.""
		));
} else { 
	$Status='1';
		$add .=$db->add_db(TB_ADMIN,array(
			"area_code"=>"".$Area."",
			"school_code"=>"".$_POST['school_code']."",
			"admin_num"=>"".$_POST['num']."",
			"admin_group_id"=>"1",
			"username"=>"".$Username."",
			"password"=>"".md5($Password)."",
			"firstname"=>"".$_POST['firstname']."",
			"lastname"=>"".$_POST['lastname']."",
			"email"=>"".$_POST['email']."",
			"phone"=>"".$_POST['phone']."",
			"ip"=>"".$IPADDRESS."",
			"status"=>"".$Status."",
			"date_added"=>"".$added.""
		));
}

	$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$Username."' AND password='".md5($Password)."' "); 
	$arr['user'] = $db->fetch($res['user']);

	$_SESSION['admin_login'] = $Username ;
	$_SESSION['admin_pwd'] = md5($Password) ;
	$_SESSION['admin_group'] = $arr['user']['admin_group_id'] ;
	$_SESSION['admin_school'] = $arr['user']['school_code'] ;
	$_SESSION['admin_area'] = $arr['user']['area_code'] ;

	$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_code='".$arr['user']['school_code']."' AND sh_area='".$arr['user']['area_code']."' "); 
	$arr['sh'] = $db->fetch($res['sh']);
	$_SESSION['school_name']=$arr['sh']['sh_name'];


	$_SESSION['uaAd'] = $_SESSION['admin_login'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$timeoutseconds=30*60*60; // 30 นาที
//	$_SESSION['timestamp2']=time();
	$timeout=time() + $timeoutseconds;
	$_SESSION['timeout']=$timeout;

	$ct_ip = $_SERVER["REMOTE_ADDR"];
	$ct_yyyy = date("Y") ;
	$ct_mm = date("m") ;
	$ct_dd = date("d") ;
	$ct_time = time();

		$db->del(TB_ACTIVEUSER," ct_area ='' and ct_school=''  ");

		$db->add_db(TB_ACTIVEUSER,array(
			"ct_user"=>"".$_SESSION['admin_login']."",
			"ct_area"=>"".$_SESSION['admin_area']."",
			"ct_school"=>"".$_SESSION['admin_school']."",
			"ct_yyyy"=>"".$ct_yyyy."",
			"ct_mm"=>"".$ct_mm."",
			"ct_dd"=>"".$ct_dd."",
			"ct_ip"=>"".$ct_ip."",
			"ct_count"=>"1",
			"ct_time"=>"".$ct_time."",
			"ct_timeout"=>"".$timeout.""
		));

		$res['online'] = $db->select_query("SELECT * FROM ".TB_ADMIN_ONLINE." WHERE u_user='".$_SESSION['admin_login']."' "); 
		$rows['online'] = $db->rows($res['online']); 
		if($rows['online']){
		$db->update_db(TB_ADMIN_ONLINE,array(
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


if($add){
		$res['type'] = "success";
		$res['data'] = _text_report_register_ok;
		$res['GR'] = 1;
} else {
		$res['type'] = "errors";
		$res['data'] = _text_report_add_fail;
		$res['GR'] = 1;
}

}
echo json_encode($res);
}

?>
