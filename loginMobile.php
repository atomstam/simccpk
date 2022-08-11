<!DOCTYPE html>
<html lang="utf-8">
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

<?php
//require_once("mainfile.php");
require_once("mainfile.php");
if(empty($_SESSION['ua']))
{
//$connect=mysql_connect("localhost","stdkut","44012023","stdkut") or die("error1");
?>
		<?
$user_login = stripslashes( $_POST['txtUser'] );
//$user_login = mysql_real_escape_string($_POST['txtUser']);
$pwd_login = stripslashes( $_POST['txtPassword'] );
//$pwd_login = mysql_real_escape_string( $_POST['txtPassword'] );

$Username = preg_replace ( '/"/i', '\"' , $user_login);
//if($pwd_login=='3123'){ $pwd_logins='HnGYi2A7';}
$Password= preg_replace ( "/'/i", "\'" , $pwd_login); 
//echo $Password;
//anti_injection($Username,$Password,$IPADDRESS);
if(isset($Username) and isset($Password)) {
//$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['admin'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_ids='".$Username."' AND per_pin='".$Password."' "); 
$rows['admin'] = @$db->rows($res['admin']); 

if($rows['admin']){
$dbs['admin']=$db->fetch($res['admin']);
}
if ($dbs['admin']['per_ids']){
	ob_start();
	$_SESSION['admin_user'] = $Username ;
//	$_SESSION['admin_pwd'] = md5($Password) ;
//	$_SESSION['CKFinder_UserRole'] ='admin';
	$_SESSION['ua'] = $_SESSION['admin_user'].":".$_SERVER['HTTP_USER_AGENT'].":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];

			$timeoutseconds=20*60;
			$_SESSION['timestamp2']=time();
			$timeout=$_SESSION['timestamp2'] + $timeoutseconds;
			echo "<meta http-equiv='refresh' content='1; url=http://sims.kut.ac.th/show_qrcode.php'>";
		?>
			<center><h6>Welcome ... <?=$dbs['admin']['per_name']?> </h6></center>
			<a href="http://sims.kut.ac.th/show_qrcode.php" data-role="button" data-icon="star">Go to Scan Qrcode</a>
		<?
} else {
		?>
			<center><h6>Invalid user & password</h6></center>
			<a href="http://sims.kut.ac.th/qrcode.php" data-role="button" data-icon="back">Try Again</a>
		<?
}
}

} else {
	echo "<meta http-equiv='refresh' content='1; url=http://sims.kut.ac.th/show_qrcode.php'>";
	exit();
} 

?>

</body>
</html>

<!-- This Code Download from www.ThaiCreate.Com -->