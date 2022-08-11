<?php
ini_set('session.cookie_lifetime',3600);
ini_set('session.gc_maxlifetime',3600);
ini_set('session.cache_expire',3600);
ob_start();
if (session_id() =='') { @session_start(); }
//session_start();
error_reporting(E_ALL & ~E_NOTICE); 
$globals_test = @ini_get('register_globals');
if ( isset($globals_test) && empty($globals_test) ) {
$types_to_register = array('GET', 'POST', 'COOKIE', 'SESSION', 'SERVER');
foreach ($types_to_register as $type) {
$arr = @${'_' . $type};
if (@count($arr) > 0)
extract($arr, EXTR_SKIP);
}
}
//ini_set('display_errors', "0");
if (preg_match("/mainfile.php/i",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}
$PHP_SELF = "index.php";
//if(empty($_SERVER['HTTPS'])){
 //echo "go to https";
// header('Location: https://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']);
//}
require_once("../includes/config.php");
require_once("../lang/thai.php");
require_once("../lang/dateThai.php");
require_once("../includes/array.in.php");
require_once("../includes/function.in.php");
require_once("../includes/class.mysql.php");
$db = New DB();
//if(time() > $_SESSION['timeout']){
//session_unset();
//setcookie("admin_login");
//require_once ("modules/admin/login.php");
//}
empty($_GET['name'])?$name="":$name=$_GET['name'];
empty($_GET['file'])?$file="":$file=$_GET['file'];
//empty($_GET['index'])?$index="modules/index/index.php":$index=$_GET['index'];
//empty($_GET['header'])?$header="modules/index/header.php":$header=$_GET['header'];
empty($_SESSION['admin_login'])?$admin_login="":$admin_login=$_SESSION['admin_login'];
empty($_SESSION['admin_pwd'])?$admin_pwd="":$admin_pwd=$_SESSION['admin_pwd'];
empty($_GET['success'])?$success="":$success=$_GET['success'];
empty($_GET['error_warning'])?$error_warning="":$error_warning=$_GET['error_warning'];
//empty($_GET['home'])?$home="index.php":$home=$_GET['home'];
empty($_GET['op'])?$op="":$op=$_GET['op'];
empty($_GET['action'])?$action="":$action=$_GET['action'];
$IPADDRESS=get_real_ip();
GETMODULELOGIN($name,$file);
//echo $file;
//echo $_GET['name'];
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
if($name){
require_once("modules/".$name."/lang/".$file.".php");
} else {
require_once("../lang/index.php");
}
$db->closedb ();
?>