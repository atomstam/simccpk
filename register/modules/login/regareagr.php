<?php
ob_start();
if (session_id() =='') { @session_start(); }
header("Content-type: application/xhtml+xml; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
?>
<?php require_once ("../../../mainfile.php"); ?>
<?php require_once("lang/register.php"); ?>



