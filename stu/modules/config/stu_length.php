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
$SCHOOL='';
$LAT = $_GET['lat'];
$LNG = $_GET['lng'];
$SCHOOL= $_GET['school'];

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['area'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." where sh_code='".$SCHOOL."' ");
@$arr['area'] = $db->fetch(@$res['area']);


$json=file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$LAT.",".$LNG."&destinations=".@$arr['area']['latitude'].",".@$arr['area']['longitude']."&key=AIzaSyAr6ZgHWvwwGvFEM2hAtmYr9rc-Ug2QFwU ");
$elements=json_decode($json, true);
//print_r($elements);
@$rows = $elements['rows'][0]['elements'];
foreach (@$rows as $vid) {
     $DiText= $vid['distance']['text'];
     $DiValue= $vid['distance']['value'];
     $DuText= $vid['duration']['text'];
     $DuValue= $vid['duration']['value'];
 }

$return_arr=array('Lengthx'=>$DiValue,'Timex'=>$DuValue);
//echo @$arr['tam']['zipcode'];


$encoded = json_encode($return_arr);
header('Content-Type: application/json');
echo $encoded;
?>
