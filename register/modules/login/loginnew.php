<!DOCTYPE html>
<html lang="<?php echo ISO; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo _heading_main_title; ?></title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- bootstrap 3.0.2 -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- animation CSS -->
		<link href="modules/login/css/animate.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="modules/login/css/style.css" rel="stylesheet" type="text/css">
		<!--[if lt IE 8]>
		<p closeass="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<!-- jQuery 2.2.3 -->
		<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap -->
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js" ></script>
    <link rel="shortcut icon" href="../img/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../img/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../img/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="../img/ico/apple-touch-icon-57-precomposed.png">
<script>
var isNS = (navigator.appName == "Netscape") ? 1 : 0;

if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);

function mischandler(){
return false;
}

function mousehandler(e){
var myevent = (isNS) ? e : event;
var eventbutton = (isNS) ? myevent.which : myevent.button;
if((eventbutton==2)||(eventbutton==3)) return false;
}
document.oncontextmenu = mischandler;
document.onmousedown = mousehandler;
document.onmouseup = mousehandler;

</script>
</head>

<body >

<?php

if($_POST){
if($_POST['OP']=='Reg'){
echo $_POST['OP'];

	$error_warning .=_login_status_no;
	$error_warning .="<meta http-equiv='refresh' content='5; url=index.php'>";

} else {
$Username = preg_replace ( '/"/i', '\"' , $_POST['username']); 
$Password= preg_replace ( "/'/i", "\'" , $_POST['password']);
//echo $Username;
//echo md5($Password);

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$Username."' AND password='".md5($Password)."' and status='1' "); 
$rows['user'] = $db->rows($res['user']); 

if(!empty($rows['user'])){
	$arr['user'] = $db->fetch($res['user']);
	if($arr['user']['status']==1){
	ob_start();
	$_SESSION['admin_login'] = $Username ;
	$_SESSION['admin_pwd'] = md5($Password) ;
	$_SESSION['admin_group'] = $arr['user']['admin_group_id'] ;
	$_SESSION['admin_area'] = $arr['user']['area_code'] ;
	$_SESSION['admin_menu'] = $arr['user']['admin_group_id'] ;


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

		$db->add_db(TB_ACTIVEUSER,array(
			"ct_area"=>"".$_SESSION['admin_area']."",
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
		$rows['online'] = $db->rows($res['online']); 
		if($rows['online']){
		$db->update_db(TB_ADMIN_ONLINE,array(
			"area_code"=>"".$_SESSION['admin_area']."",
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		),"  u_user='".$_SESSION['admin_login']."' " );
		} else {
		$db->add_db(TB_ADMIN_ONLINE,array(
			"area_code"=>"".$_SESSION['admin_area']."",
			"u_user"=>"".$_SESSION['admin_login']."",
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		));
		}
		$db->closedb ();

//	$success .= _success;
//	$success .="<meta http-equiv='refresh' content='0; url=index.php'>";
if(!empty($_SESSION['admin_login']) && $_SESSION['admin_group'] =='1'  ){
//require_once ("../admin/index.php");
$success .="<meta http-equiv='refresh' content='0; url=../admin/index.php'>";
} else if(!empty($_SESSION['admin_login']) && $_SESSION['admin_group'] =='2' ) {
//require_once ("../sec/index.php");
$success .="<meta http-equiv='refresh' content='0; url=../sec/index.php'>";
} else if(!empty($_SESSION['admin_login']) && $_SESSION['admin_group'] =='3' ) {
//require_once ("../cluster/index.php");
$success .="<meta http-equiv='refresh' content='0; url=../cluster/index.php'>";
} else if(!empty($_SESSION['admin_login']) && $_SESSION['admin_group'] =='4' ) {
//require_once ("../area/index.php");
$success .="<meta http-equiv='refresh' content='0; url=../area/index.php'>";
} else if(!empty($_SESSION['admin_login']) && $_SESSION['admin_group'] =='5' ) {
//require_once ("../school/index.php");
$success .="<meta http-equiv='refresh' content='0; url=../school/index.php'>";
} else  {
require_once ("modules/login/login.php");
}
	} else {
	$error_warning .=_login_status_no;
	$error_warning .="<meta http-equiv='refresh' content='5; url=index.php'>";
	}

} else {
	$error_warning =_error_warning;
// $error_warning;
}
//echo $success;


} //regis

}

if($success){
echo $success;
} else {
?>
<section id="wrapper" class="login-register">
  <div class="login-box login-sidebar">
    <div class="white-box">
      <form class="form-horizontal form-material" accept-charset="UTF-8" role="form" method="post" name="loginForm" id="loginform">
        <a href="javascript:void(0)" class="text-center db"><img src="../img/logo-black.png" alt="Home" width="50%"/></a>  
			    	<!-- Div ของ login   	<div class="form-group">-->
					<?php if (!empty($error_warning)) { ?>
						<div class='alert alert-danger alert-dismissible' role="alert">
						<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
							<?php echo $error_warning; ?>
						</div>
					<?php } ?>
        <div class="form-group m-t-40">
          <div class="col-xs-12">
            <input class="form-control" placeholder="username" name="username" type="text" id="username">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" placeholder="password" name="password" type="password" value="" id="password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary pull-left p-t-0">
              <input id="checkbox-signup" type="checkbox">
              <label for="checkbox-signup"><?php echo _login_form_remember;?></label>
            </div>
            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i><?php echo _login_form_reset_password;?></a> </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
		    <input class="form-control" name="OP" type="hidden" value="Login">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
            <div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"  title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"  title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>
          </div>
        </div>
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p><?php echo _login_form_register_name;?> <a href="#" class="text-primary m-l-5"><b><?php echo _login_form_register_link;?></b></a></p>
          </div>
        </div>
      </form>
      <form class="form-horizontal" accept-charset="UTF-8" role="form" method="post"  id="recoverform" >
        <div class="form-group ">
          <div class="col-xs-12">
            <h3><?php echo _login_form_reset_password_title;?></h3>
            <p class="text-muted"><?php echo _login_form_reset_password_email;?></p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" placeholder="Email">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
		  <input class="form-control" name="OP" type="hidden" value="Reg">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
          </div>
        </div>
      </form>
	<div align="center" class="login-footer">ADATA : Area Big-Data System</div>
  </div>
</section>

<?php
}
?>


        <!-- jQuery UI 1.10.3 -->
        <script src="../plugins/jQueryUI/jquery-ui-1.10.3.min.js" type="text/javascript" ></script>
		<!-- validator -->
		<script src="../plugins/validator/validator.js" type="text/javascript" ></script>
		<!-- Menu Plugin JavaScript -->
		<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
		<!--slimscroll JavaScript -->
		<script src="../js/jquery.slimscroll.js"></script>
		<!--Wave Effects -->
		<script src="../js/waves.js"></script>
		<!-- Custom Theme JavaScript -->
		<script src="../js/custom.js"></script>
		<!--Style Switcher -->
		<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>


</body>
</html>