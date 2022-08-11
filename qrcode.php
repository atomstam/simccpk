<?
session_start();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo "โปรแกรมตรวจสอบการมาโรงเรียนประจำวัน"; ?></title>
        <!-- bootstrap 3.0.2 -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
		<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
        <link href="dist/css/social-buttons.css" rel="stylesheet" type="text/css" />
		<link href="dist/css/base.css" rel="stylesheet" media="screen"/>
		<!--[if lt IE 8]>
		<p closeass="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
        <!-- Bootstrap -->
        <script type="text/javascript" src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>
    <link rel="shortcut icon" href="template/xeon/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="template/xeon/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="template/xeon/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="template/xeon/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="template/xeon/images/ico/apple-touch-icon-57-precomposed.png">
<style>
.panel-heading {
    padding: 5px 15px;
}

.panel-footer {
	padding: 1px 15px;
	color: #A0A0A0;
}

.profile-img {
	width: 96px;
	height: 96px;
	margin: 0 auto 10px;
	display: block;
	-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	border-radius: 50%;
}
</style>
</head><!--/head-->
<body >
    <style type="text/css">
    body{padding-top:30px;}    </style>
	<div class="container">
    <div class="row">
		<div class="col-md-6 col-md-offset-3">
    		<div class="box box-warning box-solid">
			  	<div class="box-header">
			    	<h3 class="panel-title">การเข้าระบบบันทึกการมาเรียนของนักเรียน</h3>
			 	</div>
			  	<div class="box-body">
			    	<form action="loginMobile.php" accept-charset="UTF-8" role="form" method="post" name="loginForm" id="loginForm">
                    <fieldset>
			    	<!-- Div ของ login   	<div class="form-group">-->
					 <?php if ($success) { ?>
						<div class='alert alert-success alert-dismissible' role="alert">
						<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
							<?php echo $success; ?>
						</div>
					<?php } ?>
					<?php if ($error_warning) { ?>
						<div class='alert alert-danger alert-dismissible' role="alert">
						<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
							<?php echo $error_warning; ?>
						</div>
					<?php } ?>
                    <table width="100%" border="0">
  <tr>
    <td width="40%">
    <div align="center"><img src="img/logoktp2.png"><br /></div>
    <div align="center">ระบบบริหารข้อมูลนักเรียน<br />
โรงเรียนกู่ทองพิทยาคม สพม.26
</div>
    </td>
    <td>
                            <div style="margin-bottom: 20px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			    		    <input class="form-control" placeholder="username" name="txtUser" type="text" id="txtUser">
			    		</div>
<div style="margin-bottom: 20px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			    			<input class="form-control" placeholder="password" name="txtPassword" type="password" value="" id="txtPassword">
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Remember Me
			    	    	</label>
			    	    </div>
                      <div class="row">
						<div class="col-xs-6"><input class="btn btn-success btn-block" name="login_submit" type="submit" value="Login"></div>
						<div class="col-xs-6"><input class="btn btn-warning btn-block" name="login_reset" type="reset" value="Reset" id="login_reset"></div>
					  </div>
                        <div class="col-md-5">
			    		
			    		
                        </div>
                        <input name="user_os" type="hidden" value="desktop">
    </td>
  </tr>
</table>

			    	</fieldset>
			      	</form>

			    </div>
			</div>
		</div>
	</div>
</div>
<div align="center">หากเป็นบุคลากรในหน่วยงาน ถ้ายังไม่มี Username และ Password<br />
สามารถ Login ด้วยเลขประจำตัวประชาชนและหมายเลขโทรศัพท์</div>


  </body>
</html>
