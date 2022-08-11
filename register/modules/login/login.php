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
		<!-- jvectormap -->
		<link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Bootstrap datePicker -->
        <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css" />
		<!-- Bootstrap time Picker -->
		<link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
        <!-- DATA TABLES -->
        <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- Morris charts -->
		<link href="../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="../plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
		<!-- Select2 -->
		<link rel="stylesheet" href="../plugins/select2/select2.min.css">
        <!-- Theme style -->
        <link href="../dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
		<link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="../plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
		        <!-- iCheck for checkboxes and radio inputs -->
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
        <!-- timeline1 -->
        <link href="../dist/css/timeline.css" rel="stylesheet" type="text/css" />
        <link href="../dist/css/social-buttons.css" rel="stylesheet" type="text/css" />
		<link href="../dist/css/base.css" rel="stylesheet" media="screen"/>
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
<style>
/* Full Background Image */
img.full-bg {
    min-height: 100%;
    min-width: 1024px;
    width: 100%;
    height: auto;
    position: fixed;
    top: 0;
    left: 0;
	opacity: .10; 
}

img.full-bg.full-bg-bottom {
    top: auto;
    bottom: 0;
}

@media screen and (max-width: 1024px) {
    img.full-bg {
        left: 50%;
        margin-left: -640px;
    }
}
</style>
</head>

<body class="login-page">
<?php

if($_POST){

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
}

if($success){
echo $success;
} else {
?>
        <!-- Full Background -->
        <!-- For best results use an image with a resolution of 1280x1280 pixels (prefer a blurred image for smaller file size) -->
        <img src="../img/intelligence.jpg" alt="Full Background" class="full-bg animation-pulseSlow">
        <!-- END Full Background -->

 	<div class="container">
    <div class="row">
		<div class="col-md-6 col-md-offset-3">
    		<div class="box box-primary box-solid">
			  	<div class="box-header">
			    	<h3 class="panel-title">Admin Login : SESA 1.0</h3>
			 	</div>
			  	<div class="box-body  login-box-body">
			    <form accept-charset="UTF-8" role="form" method="post" name="loginForm" id="loginForm">
                    <fieldset>
			    	<!-- Div ของ login   	<div class="form-group">-->
					<?php if (!empty($error_warning)) { ?>
						<div class='alert alert-danger alert-dismissible' role="alert">
						<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
							<?php echo $error_warning; ?>
						</div>
					<?php } ?>

<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="row">
    <div align="center"><img src="../img/logo.png" width="120"></div>
	    <div align="center">&nbsp;</div>
					<div class="row">
                            <div style="margin-bottom: 20px" class="input-group col-md-12 col-sm-12 col-xs-12">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			    		    <input class="form-control" placeholder="username" name="username" type="text" id="username">
			    		</div>
							<div style="margin-bottom: 20px" class="input-group col-md-12 col-sm-12 col-xs-12">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			    			<input class="form-control" placeholder="password" name="password" type="password" value="" id="password">
			    		</div>
					</div>
                      <div class="row">
						<div class="col-xs-4"><input class="btn btn-primary btn-block" name="login_submit" type="submit" value="Login"></div>
						<div class="col-xs-4">
						<a href="?name=login&file=reg" class="btn btn-warning btn-block">Register</a>
						</div>
						<div class="col-xs-4">
						<a href="../index.php" class="btn btn-danger btn-block">Back</a>
						</div>
					  </div>
                        <div class="col-md-5">
			    		
			    		
                        </div>
                        <input name="user_os" type="hidden" value="desktop">
</div>
</div>


			    	</fieldset>
			      	</form>

			    </div>
			</div>
		</div>
	</div>
	</div>
</div>
</div>

<div align="center" class="login-footer"><?php echo _heading_main_title;?><br />
( Secondary Education Service Area )<br>
<?php 
	//echo _login_admin_name." "._login_admin_email;
				
?>
</div>

</div>
<?php
}
?>

<style>
html {
    display: table;
    height: 100%;
    width: 100%;
}
body.login-page {
    background-color: #00b5ec;
    /* background: -webkit-linear-gradient(150.76deg,#7b94ff 0,#b288ff 47.43%,#ffb0d0 99.5%);
    background: linear-gradient(-60.76deg,#7b94ff 0,#b288ff 47.43%,#ffb0d0 99.5%); */
    display: table-cell;
    vertical-align: middle;
}
.login-box {
    width: 200px;
    margin: 0 auto;
    padding: 30px 0;
    
}
.login-box-body {
  box-shadow: 0 14px 24px 0 rgba(50,49,58,.25);
  border-radius: 0px; 
  padding: 30px;
}
.form-control-feedback {
  left: 0;
  right: auto;
  height: 40px;
}
.form-control-feedback.fa {
  line-height: 40px;
}
.has-feedback .form-control {
  padding-right: 12px;
  padding-left: 40px;
}
.form-control {
  height: 40px;
  border-radius: 3px;
}
.login-logo img {
  height: 100px;
}
.btn {
  border-radius: 3px;
  font-weight: 500;
  text-transform: uppercase;
  border: none;
  padding: 10px;
  box-shadow: 0 14px 24px 0 rgba(50,48,57,.25);
  -webkit-transition: -webkit-box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  -o-transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}
.btn:hover, .btn:focus {
  border: none !important;
}
.login-logo h3 {
  text-shadow: 0 14px 24px rgba(50,48,57,.25);
  color: #fff;
  font-size: 46px;
}

.login-footer {
  color: #fff;
}

</style>

<script type="text/javascript">
		</script>

<script type="text/javascript"><!--
$('#loginForm input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#loginForm').submit();
	}
});
//--></script> 

      </div>
      <!-- /.row -->
</section>
</div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->

        <!-- jQuery UI 1.10.3 -->
        <script src="../plugins/jQueryUI/jquery-ui-1.10.3.min.js" type="text/javascript" ></script>
		<!-- Select2 -->
		<script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
		<!-- validator -->
		<script src="../plugins/validator/validator.js" type="text/javascript" ></script>
        <!-- INPUT FILE -->
        <script src="../js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="../plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
		<!-- date-picker -->
		<script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript" ></script>
		<!-- bootstrap time picker -->
		<script src="../plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript" ></script>
		<!-- ChartJS 1.0.1 -->
		<script src="../plugins/chartjs/Chart.min.js" type="text/javascript" ></script>
		<!-- Morris.js charts -->
        <script src="../js/raphael-min.js" type="text/javascript" type="text/javascript"></script>
        <script src="../plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- CK Editor -->
        <script src="../plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
		<!-- fullCalendar 2.2.5 -->
		<script src="../plugins/fullcalendar/moment.js" type="text/javascript"></script>
		<script src="../plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
		<!-- autocomplate -->
	    <script src="../plugins/autocomplate/bootstrap3-typeahead.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/app.js" type="text/javascript"></script>

</body>
</html>