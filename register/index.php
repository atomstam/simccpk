<?php
require_once("mainfile.php");
$_SERVER['PHP_SELF'] = "index.php";
//echo $_SESSION['admin_group'];

if(isset($_GET['name']) and isset($_GET['file'])){
//GETMODULE($_GET['name'],$_GET['file']);
require_once("modules/".$_GET['name']."/".$_GET['file'].".php");
$home ="index.php?name=".$_GET['name']."&file=".$_GET['file']."&route=".$route."";
} else {
require_once ("modules/login/lang/reg.php");
require_once ("modules/login/reg.php");
}
echo $success;
?>