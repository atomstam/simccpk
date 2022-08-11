<?
session_start();
?>
<!DOCTYPE html>
<html>

  <head>
    <meta charset='utf-8' />
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <meta name="description" content="โปรแกรมตรวจสอบการมาโรงเรียนประจำวัน." />
<!--
    <link rel="stylesheet" type="text/css" media="screen" href="html5-qrcode/css/style.css">
-->
	<script src="theme/jquery-1.7.1.min.js"></script>
	<script src="theme/jquery.mobile-1.1.0.min.js"></script>
    <script src="html5-qrcode/js/jquery-1.9.1.min.js"></script>
    <script src="html5-qrcode/lib/html5-qrcode.min.js"></script>
	<script src="html5-qrcode/lib/jsqrcode-combined.min.js"></script>
    <script src="html5-qrcode/js/main.js"></script>
    <link rel="stylesheet" href="theme/jquery.mobile-1.1.0.min.css" />
    <title>:: โปรแกรมตรวจสอบการมาโรงเรียนประจำวัน ::</title>
  </head>

  <body>
<div data-role="page">

	<div data-role="header">
		<h1>โปรแกรมตรวจสอบการมาโรงเรียนประจำวัน</h1>
	</div><!-- /header -->

			<ul data-role="listview" data-inset="true" data-theme="d" data-divider-theme="e">
			<li data-role="list-divider">STD</li>
<?php
if(empty($_SESSION['ua']))
{
	echo "<meta http-equiv='refresh' content='1; url=qrcode.php'>";
	?>
	<p><a href="#popup" data-role="button" data-theme="e" data-rel="dialog" data-transition="pop">Login user and password</a></p>
<?php
} else {

?>
			<li><table width="100%" border="0"><tr><td width="30%"><div  class="center" id="reader" style="width:300px;height:250px;"></div></td><td width="70%" valign="top"><div id="showdata"></div></td></tr></table></li>
			<li><a href="logoutMobile.php" data-role="button" data-icon="star" >Logout</a></li>
<?php
	}
?>

		</ul>
</div>
  </body>
</html>
