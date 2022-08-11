<?php
ini_set('display_errors', "0");
ob_start();
if (session_id() =='') { @session_start(); }
header('Content-Type: application/json');
require_once("../../../includes/config.php");
//require_once("../../../includes/function.in.php");
require_once("../../../includes/class.mysql.php");
//require_once("lang/school.php");
$db = New DB();
$return_arr = array();
$LAT='';
$LNG ='';
$AREA='';
$LAT = $_GET['lat'];
$LNG = $_GET['lng'];
$AMP= $_GET['amp'];

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where amphur_code='".$AMP."' ");
$arr['amp'] = $db->fetch($res['amp']);


$json=file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$LAT.",".$LNG."&destinations=".$arr['amp']['A_LAT'].",".$arr['amp']['A_LONG']."&key=AIzaSyAr6ZgHWvwwGvFEM2hAtmYr9rc-Ug2QFwU");
$elements=json_decode($json, true);
//print_r($elements);
$Rows = $elements['rows'][0]['elements'];
foreach ($Rows as $vid) {
     $DiText= $vid['distance']['text'];
     $DiValue= $vid['distance']['value'];
     $DuText= $vid['duration']['text'];
     $DuValue= $vid['duration']['value'];
 }

$return_arr=array('Length'=>$DiValue,'Time'=>$DuValue);
//echo $arr['tam']['zipcode'];


$encoded = json_encode($return_arr);
header('Content-Type: application/json');
echo $encoded;
?>
