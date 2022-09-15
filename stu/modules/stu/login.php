<!DOCTYPE html>
<html lang="<?php echo ISO; ?>">
<head>
<meta charset="UTF-8" />
<link rel="shortcut icon" href="../img/ico/favicon.ico">
<link rel="apple-touch-icon" sizes="57x57" href="../img/ico/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../img/ico/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../img/ico/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../img/ico/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../img/ico/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../img/ico/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../img/ico/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../img/ico/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../img/ico/apple-icon-180x180.png">

<link rel="icon" type="image/png" sizes="192x192"  href="../img/ico/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="96x96" href="../img/ico/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="32x32" href="../img/ico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../img/ico/favicon-16x16.png">

<title><?php echo _heading_main_title; ?></title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<meta name="google-site-verification" content="baoumoxnG3_i8uRPLErpjxCWGe333fDB2QiRLvUH1Sw" />

	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="../plugins/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="../plugins/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link href="../dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
		<link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<!-- Material Design -->
	<link rel="stylesheet" href="../dist/css/bootstrap-material-design.min.css">
	<link rel="stylesheet" href="../dist/css/ripples.min.css">
	<link rel="stylesheet" href="../dist/css/MaterialAdminLTE.min.css">
		        <!-- iCheck for checkboxes and radio inputs -->
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
		<!--[if lt IE 8]>
		<p closeass="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<!-- jQuery 2.2.3 -->
		<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap -->
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js" ></script>

<style>		
body {				
background: no-repeat center center fixed url("../img/cover4.jpg") ;
background-size: cover;	
margin: 0;				
color: #666;
}
</style>
</head>
<body  >
<script>
 $(function() {
//twitter bootstrap script
$("#recoverform").submit(function(e) {
          e.preventDefault();
 //$("button#submitForm").click(function(){
			$.ajax({
			type: "POST",
			url: "modules/person/forget_pwd.php",
			data: $('#recoverform').serialize(),
		    dataType: 'json',
			cache: 'false',
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=stu&file=login&route=<?php echo $route;?>';
				}, 3000);
			} else {
//                $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#recoverform')[0].reset();
			}
	//		$("#form-content").modal('hide'); 
			},
			error: function(){
				alert("failure");
			}
			});
			});
});
</script>
<?php
if(empty($_GET['FB'])){
$_GET['FB']='';
}
if(empty($_GET['GG'])){
$_GET['GG']='';
}
require_once '../includes/Facebook/autoload.php';
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

$permissions = ['email']; // optional

$loginUrl = $helper->getLoginUrl('https://sim.ccpk.ac.th/signin/fb-login_admin.php', $permissions);

//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

//google AIP
require_once "../includes/GoogleAPI/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId(""._GOOGLE_Api_ID."");
$gClient->setClientSecret(""._GOOGLE_Api_Secret."");
$gClient->setApplicationName("SESA Login");
$gClient->setRedirectUri("https://sim.ccpk.ac.th/signin/google-login_admin.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
$loginURL = $gClient->createAuthUrl();



if($_POST){
if($op=='Reg'){
	$error_warning =_error_warning;
	$status  = 'error';
	$message = _login_status_no;
//	$error_warning .=_login_status_no;
//	$error_warning .="<meta http-equiv='refresh' content='5; url=index.php'>";
	//echo $error_warning;
} else {

if(!empty($_POST['username']) && !empty($_POST['password'])){

$Username = preg_replace ( '/"/i', '\"' , $_POST['username']); 
$Password= preg_replace ( "/'/i", "\'" , $_POST['password']);
//echo $_SERVER['SERVER_NAME'];

@$res['user'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_pid='".$Username."' AND stu_id='".$Password."' and stu_code='".$_SESSION['sh_code']."' and stu_suspend ='0' "); 
@$rows['user'] = $db->rows(@$res['user']); 

if(!empty(@$rows['user'])){
	@$arr['user'] = $db->fetch(@$res['user']);
	ob_start();

	$_SESSION['stu_login'] = $Username ;
	$_SESSION['stu_pwd'] = $Password ;
	$_SESSION['stu_name'] = $arr['user']['stu_num']."".$arr['user']['stu_name']." ".$arr['user']['stu_sur'];
	$_SESSION['stu_class'] = @$arr['user']['stu_class'] ;
	$_SESSION['stu_cn'] = @$arr['user']['stu_cn'] ;
	$_SESSION['stu_school'] = @$arr['user']['stu_code'] ;
	$_SESSION['stu_area'] = @$arr['user']['stu_area'] ;
	$_SESSION['auth'] = "stu";

	@$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_code='".@$arr['user']['stu_code']."' AND sh_area='".@$arr['user']['stu_area']."' "); 
	@$arr['sh'] = $db->fetch(@$res['sh']);
	$_SESSION['school_name']=@$arr['sh']['sh_name'];


	$_SESSION['uaAd'] = $_SESSION['stu_login'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$timeoutseconds=24*30*60*60; // 30 นาที
//	$_SESSION['timestamp2']=time();
	$timeout=time() + $timeoutseconds;
	$_SESSION['timeout']=$timeout;

	$ct_ip = $_SERVER["REMOTE_ADDR"];
	$ct_yyyy = date("Y") ;
	$ct_mm = date("m") ;
	$ct_dd = date("d") ;
	$ct_time = time();

		$db->add_db(TB_ACTIVEUSER,array(
			"ct_user"=>"".$_SESSION['stu_login']."",
			"ct_area"=>"".$_SESSION['stu_area']."",
			"ct_school"=>"".$_SESSION['stu_school']."",
			"ct_yyyy"=>"".$ct_yyyy."",
			"ct_mm"=>"".$ct_mm."",
			"ct_dd"=>"".$ct_dd."",
			"ct_ip"=>"".$ct_ip."",
			"ct_count"=>"1",
			"ct_time"=>"".$ct_time."",
			"ct_timeout"=>"".$timeout.""
		));

		@$res['online'] = $db->select_query("SELECT * FROM ".TB_STUDENT_ONLINE." WHERE u_user='".$_SESSION['stu_login']."' "); 
		@$rows['online'] = $db->rows(@$res['online']); 
		if(@$rows['online']){
		$db->update_db(TB_STUDENT_ONLINE,array(
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		),"  u_user='".$_SESSION['stu_login']."' " );
		} else {
		$db->add_db(TB_STUDENT_ONLINE,array(
			"area_code"=>"".$_SESSION['stu_area']."",
			"school_code"=>"".$_SESSION['stu_school']."",
			"u_user"=>"".$_SESSION['stu_login']."",
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		));
		}

	$success ="<meta http-equiv='refresh' content='0; url=index.php'>";
	$status  = 'success';
	$message = _login_success_message;
	

} else {
	$error_warning =_login_status_no;
	$status  = 'warning';
	$message = _login_error_message;
	//$error .="<meta http-equiv='refresh' content='0; url=index.php'>";
// $error_warning;
} //rows

} else {
	$error_warning =_error_warning;
	$status  = 'error';
	$message = _login_warning_message;
} // empty


} // Reg

} //post


if($_GET['FB']=='N'){
$error_warning = _login_facebook_no;
}
if($_GET['GG']=='N'){
$error_warning = _login_google_no;
}

if($success){
echo $success;
} else {
?>
 	<div class="container">
    <div class="row">

<div class="login-box">
  <div class="login-logo">
    <b><a href="../index.php"><img src="../img/logo_login.png"  alt="Home" width="100" class="logo"/></a></b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body ">
    <p class="login-box-msg"><?php echo _heading_titley;?></p>
			    	<!-- Div ของ login   	<div class="form-group">-->
					<?php if (!empty($error_warning)) { ?>
						<div class='alert alert-danger alert-dismissible' role="alert">
						<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
							<?php echo $error_warning; ?>
						</div>
					<?php } ?>
    <form method="post" name="loginForm" id="loginform">
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="username" name="username" type="text" id="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="password" name="password" type="password" value="" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

        <div class="col-md-7">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="Status"  id="Checked" class="check" value="1"> <?php echo _login_form_remember;?>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-5">
          <button type="submit" class="btn btn-primary btn-raised btn-block btn-flat">เข้าระบบ</button>
        </div>
        <!-- /.col -->

    </form>
<!--
    <div class="social-auth-links text-center">
      <p>- หรือ -</p>
      <a href="<?php echo $loginUrl;?>" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="<?php echo $loginURL;?>" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>-->
    <!-- /.social-auth-links -->
	<div class="text-right">
    <a href="<?=WEB_URLS;?>/index.php?name=stu&file=forget">ลืมรหัสผ่าน</a> | 
    <a href="<?=WEB_URLS;?>/register/" class="text-center">ลงทะเบียนใช้งาน</a>
	</div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


</div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->

<?php
}
?>

        <!-- jQuery UI 1.10.3 -->
        <script src="../plugins/jQueryUI/jquery-ui-1.10.3.min.js" type="text/javascript" ></script>
        <!-- iCheck -->
        <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/app.js" type="text/javascript"></script>
        <script type="text/javascript">
			$(document).ready(function ($) {
				$('input').iCheck({
					checkboxClass: 'icheckbox_minimal-red',
					radioClass: 'iradio_minimal-red'
				});
			$(".alert").delay(5000).slideUp(200, function() {
			$(this).alert('close');
			});
			});
        </script>
</body>
</html>