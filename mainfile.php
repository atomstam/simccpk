<?php
ob_start();
if (session_id() =='') { @session_start(); }
//session_start();
$globals_test = @ini_get('register_globals');
if ( isset($globals_test) && empty($globals_test) ) {
$types_to_register = array('GET', 'POST', 'COOKIE', 'SESSION', 'SERVER');
foreach ($types_to_register as $type) {
$arr = @${'_' . $type};
if (@count($arr) > 0)
extract($arr, EXTR_SKIP);
}
}
ini_set('display_errors', "0");
if (preg_match("/mainfile.php/i",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}
$PHP_SELF = "mainfile.php";
require_once("includes/config.php");
require_once("lang/thai.php");
require_once("lang/dateThai.php");
require_once("includes/array.in.php");
require_once("includes/function.in.php");
require_once("includes/class.mysql.php");
//header( 'Content-Type:text/html; charset='.ISO.'');
//if(empty($_SERVER['HTTPS'])){
 //echo "go to https";
// header('Location: https://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']);
//}
$db = New DB();
empty($_GET['name'])?$name="":$name=$_GET['name'];
empty($_GET['file'])?$file="":$file=$_GET['file'];
empty($_SESSION['auth'])?$auth="":$auth=$_SESSION['auth'];
empty($_SESSION['user_login'])?$user_login="":$user_login=$_SESSION['user_login'];
empty($_SESSION['user_pwd'])?$user_pwd="":$user_pwd=$_SESSION['user_pwd'];
empty($_SESSION['admin_login'])?$admin_login="":$user_login=$_SESSION['admin_login'];
empty($_SESSION['admin_pwd'])?$admin_pwd="":$user_pwd=$_SESSION['admin_pwd'];
empty($_SESSION['person_login'])?$person_login="":$person_login=$_SESSION['person_login'];
empty($_SESSION['person_pwd'])?$person_pwd="":$person_pwd=$_SESSION['person_pwd'];
empty($_SESSION['stu_login'])?$stu_login="":$stu_login=$_SESSION['stu_login'];
empty($_SESSION['stu_pwd'])?$stu_pwd="":$stu_pwd=$_SESSION['stu_pwd'];
empty($_SESSION['staff_login'])?$staff_login="":$staff_login=$_SESSION['staff_login'];
empty($_SESSION['staff_pwd'])?$staff_pwd="":$staff_pwd=$_SESSION['staff_pwd'];
empty($_GET['success'])?$success="":$success=$_GET['success'];
empty($_GET['error_warning'])?$error_warning="":$error_warning=$_GET['error_warning'];
//empty($_GET['home'])?$home="index.php":$home=$_GET['home'];
empty($_GET['op'])?$op="":$op=$_GET['op'];
empty($_GET['action'])?$action="":$action=$_GET['action'];

$IPADDRESS=get_real_ip();
GETMODULE($name,$file);
if(empty($_GET['route'])){
$route="index/index";
} else {
$route=$name."/".$file;
}
	require_once("lang/index.php");
if($name){
	require_once("modules/".$name."/lang/".$file.".php");
}
?>