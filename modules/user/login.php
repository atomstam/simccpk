        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
		<link href="../../css/base.css" rel="stylesheet" media="screen"/>
<?php
require_once("../../mainfile.php");
if (isset($_POST['username'])) {
$Username = preg_replace ( '/"/i', '\"' , $_POST['username']); 
$Password= preg_replace ( "/'/i", "\'" , $_POST['password']);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." WHERE username='".$Username."' AND password='".md5($Password)."' and status='1' "); 
$arr['user'] = $db->fetch($res['user']);
if(!empty($arr['user']['user_id'])){
//if (session_id() =='') { @session_start(); }
	$_SESSION['user_login'] = $Username ;
	$_SESSION['user_pwd'] = md5($Password) ;

	$_SESSION['ua'] = $_SESSION['user_login'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$timeoutseconds=10*60; // 30 นาที
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
			"ct_yyyy"=>"".$ct_yyyy."",
			"ct_mm"=>"".$ct_mm."",
			"ct_dd"=>"".$ct_dd."",
			"ct_ip"=>"".$ct_ip."",
			"ct_count"=>"1",
			"ct_time"=>"".$ct_time."",
			"ct_timeout"=>"".$timeout.""
		));
//		echo $_SESSION['user_login'];
		$res['online'] = $db->select_query("SELECT * FROM ".TB_USER_ONLINE." WHERE u_user='".$_SESSION['user_login']."'  "); 
		$arr['online'] = $db->fetch($res['online']); 
		if(!empty($arr['online']['u_id'])){
		$db->update_db(TB_USER_ONLINE,array(
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		),"  u_user='".$_SESSION['user_login']."' " );
		} else {
		$db->add_db(TB_USER_ONLINE,array(
			"u_user"=>"".$_SESSION['user_login']."",
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		));
		}
//		$db->closedb ();

	$success = _success;
//	$success .="<meta http-equiv='refresh' content='1; url=index.php'>";
//return $success;
} else {
$error_warning =_error_warning;
//return $error_warning;

}
}
?>
      <?php if ($success) { ?>
      <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo $success; ?></span>
	  </div>
      <?php } ?>
      <?php if ($error_warning) { ?>
      <div class="alert alert-danger">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo $error_warning; ?></span>
      </div>
      <?php } ?>
