<!DOCTYPE html>
<html lang="<?php echo ISO; ?>">
<head>
<meta charset="UTF-8" />
<title>404 : Error</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="../plugins/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="../plugins/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
	<!-- Material Design -->
	<link rel="stylesheet" href="../dist/css/bootstrap-material-design.min.css">
	<link rel="stylesheet" href="../dist/css/ripples.min.css">
	<link rel="stylesheet" href="../dist/css/MaterialAdminLTE.min.css">
		<!--[if lt IE 8]>
		<p closeass="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<!-- jQuery 3 -->
		<script src="../plugins/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="../plugins/bootstrap/dist/js/bootstrap.min.js"></script>
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
<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
		<style>
      body {
        font-family: 'Prompt', sans-serif;     
      }

	  h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
        font-family: 'Prompt', sans-serif;     
      }
	

    </style>
</head>

<body >
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>
        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> ขออภัยไม่มีหน้าที่ท่านต้องการรับชม.</h3>

          <p>
            เราไม่สามารถนำเสนอ page ที่ท่านต้องการชมได้.
            ต้องขออภัยเป็นอย่างสูง <a href="index.php">กรุณากลับไปหน้าแรก</a> หรือ ต้องการค้นหา page อื่น ได้จาก.
          </p>

          <form class="search-form" >
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>


        <!-- jQuery UI 1.10.3 -->
        <script src="../plugins/jQueryUI/jquery-ui-1.10.3.min.js" type="text/javascript" ></script>
		<!-- Material Design -->
		<script src="../dist/js/material.min.js"></script>
		<script src="../dist/js/ripples.min.js"></script>
		<script>
			$.material.init();
		</script>
		<!-- AdminLTE App -->
		<script src="../dist/js/adminlte.min.js"></script>


</body>
</html>