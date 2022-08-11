<!DOCTYPE html>
<html lang="<?php echo ISO; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo _heading_main_title; ?></title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

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
	<!-- sweet -->
	<link rel="stylesheet" href="../dist/sweetalert2.min.css">   
		        <!-- iCheck for checkboxes and radio inputs -->
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
		<!--[if lt IE 8]>
		<p closeass="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<!-- jQuery 2.2.3 -->
		<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap -->
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js" ></script>
<link rel="shortcut icon" href="<?php echo WEB_URL;?>/img/ico/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo WEB_URL;?>/img/ico/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo WEB_URL;?>/img/ico/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo WEB_URL;?>/img/ico/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo WEB_URL;?>/img/ico/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo WEB_URL;?>/img/ico/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo WEB_URL;?>/img/ico/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo WEB_URL;?>/img/ico/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo WEB_URL;?>/img/ico/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo WEB_URL;?>/img/ico/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo WEB_URL;?>/img/ico/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo WEB_URL;?>/img/ico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo WEB_URL;?>/img/ico/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo WEB_URL;?>/img/ico/favicon-16x16.png">
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
<style>		
body {				
background: no-repeat center center fixed url("../img/photo_bg.jpg") ;			
background-size: cover;	
margin: 0;				
color: #666;
}
</style>
</head>
<body>
<script>
 $(function() {
//twitter bootstrap script
$("#recoverform").submit(function() {
          ///e.preventDefault();
 //$("button#submitForm").click(function(){
			$.ajax({
			type: "POST",
			url: "modules/admin/forget_pwd.php",
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
  				 window.location='area/index.php?name=admin&file=login&route=<?php echo $route;?>';
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
</script>
?>
	<div class="container">
    <div class="row">

<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
        <a href="javascript:void(0)" class="text-center db"><img src="../img/logo-black.png" alt="Home" width="50%"/></a>  
  </div>

      <form class="form-horizontal" accept-charset="UTF-8" role="form" method="post"  id="recoverform" >
        <div class="form-group ">
          <div class="col-xs-12">
            <h3><?php echo _login_form_reset_password_title;?></h3>
            <p class="text-muted"><?php echo _login_form_reset_password_email;?></p>
          </div>
        </div>
      <div class="alert alert-success" name="thanks" id="thanks" style="display: none">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _RESET_MAIL_REPORT; ?></span>
      </div>
      <div class="alert alert-danger" name="error" id="error" style="display: none">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _RESET_MAIL_SEND_NO; ?></span>
      </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" placeholder="Email" name="email">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
		  <input class="form-control" name="OP" type="hidden" value="Reg">
		   <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
          <div class="col-xs-6">
             <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" id="submitForm" name="submitForm">Submit</button>
          </div>
          <div class="col-xs-6">
            <a href="../index.php" type="button" class="btn btn-warning btn-lg btn-block text-uppercase waves-effect waves-light" >Back</a>
          </div>
		  </div>
        </div>

      </form>

  	<div align="center" class="login-footer">Big-DATA : Big-Data System</div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->

        <!-- jQuery UI 1.10.3 -->
        <script src="../plugins/jQueryUI/jquery-ui-1.10.3.min.js" type="text/javascript" ></script>
		<!-- validator -->
		<script src="../plugins/validator/validator.js" type="text/javascript" ></script>
        <!-- iCheck -->
        <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
		<!-- sweet -->
		<script src="../dist/sweetalert2.min.js"></script>
		<script src="../dist/swal.js"></script>
		<!-- Custom Theme JavaScript -->
		<script src="../js/custom.js"></script>
		<!--Style Switcher -->
		<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
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