 <?php 
require_once ("modules/index/header.php");
//require_once("mainfile.php");
//$_SERVER['PHP_SELF'] = "index.php";
?>
<?php
if($_POST){
$Username = preg_replace ( '/"/i', '\"' , $_POST['username']); 
$Password= preg_replace ( "/'/i", "\'" , $_POST['password']);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." WHERE username='".$Username."' AND password='".md5($Password)."' and status='1' "); 
$rows['user'] = @$db->rows($res['user']); 
if(!empty($rows['user'])){
	$arr['user'] = $db->fetch($res['user']);
}
if(!empty($arr['user']['user_id'])){
	ob_start();
	$_SESSION['user_login'] = $Username ;
	$_SESSION['user_pwd'] = md5($Password) ;
	$_SESSION['user_school'] = $arr['user']['code'] ;

	$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_code='".$_SESSION['user_school']."' "); 
	$arr['sh'] = $db->fetch($res['sh']); 

	$_SESSION['school_name'] = $arr['sh']['sh_name'] ;

	$_SESSION['ua'] = $_SESSION['user_login'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'].":".$_SESSION['user_school'];
	$timeoutseconds=30*60; // 30 นาที
//	$_SESSION['timestamp2']=time();
	$timeout=time() + $timeoutseconds;
	$_SESSION['timeout']=$timeout;

	$ct_ip = $_SERVER["REMOTE_ADDR"];
	$ct_yyyy = date("Y") ;
	$ct_mm = date("m") ;
	$ct_dd = date("d") ;
	$ct_time = time();

		$db->add_db(TB_ACTIVEUSER,array(
			"ct_user"=>"".$_SESSION['user_login']."",
			"ct_school"=>"".$_SESSION['user_school']."",
			"ct_yyyy"=>"".$ct_yyyy."",
			"ct_mm"=>"".$ct_mm."",
			"ct_dd"=>"".$ct_dd."",
			"ct_ip"=>"".$ct_ip."",
			"ct_count"=>"1",
			"ct_time"=>"".$ct_time."",
			"ct_timeout"=>"".$timeout.""
		));

		$res['online'] = $db->select_query("SELECT * FROM ".TB_ONLINE." WHERE u_user='".$_SESSION['user_login']."' and u_school='".$_SESSION['user_school']."' "); 
		$rows['online'] = @$db->rows($res['online']); 
		if($rows['online']){
		$db->update_db(TB_ONLINE,array(
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		),"  u_user='".$_SESSION['user_login']."' and u_school='".$_SESSION['user_school']."' " );
		} else {
		$db->add_db(TB_ONLINE,array(
			"u_user"=>"".$_SESSION['user_login']."",
			"u_school"=>"".$_SESSION['user_school']."",
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		));
		}
		$db->closedb ();

	$success = _success;
	$success .="<meta http-equiv='refresh' content='1; url=index.php'>";
//return $success;
} else {
$error_warning =_error_warning;
//return $error_warning;

}
} 

?>
      <div class="modal-body" >
      <?php if ($success) { ?>
      <p class='alert alert-success'><?php echo $success; //echo "<meta http-equiv='refresh' content='1; url=home.php?mon=".$_POST['mon']."'>";?></p>
      <?php } ?>
      <?php if ($error_warning) { ?>
      <p class='alert alert-danger'><?php echo $error_warning; ?></p>
      <?php } ?>

 <?php require_once ("modules/index/footer.php");?>