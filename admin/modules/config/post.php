<?php
header('Content-Type: application/json');
require_once("../../../includes/config.php");
//require_once("../../../includes/function.in.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/school.php");
$db = New DB();
$return_arr = array();
$tambon_id = $_GET['tambon_id'];
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['tam'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where tumbon_code='".$tambon_id."' ");
@$arr['tam'] = $db->fetch(@$res['tam']);
$Tam=@$arr['tam']['zipcode'];
$return_arr=array('respon'=>$Tam);
//echo @$arr['tam']['zipcode'];
$encoded = json_encode($return_arr);
header('Content-Type: application/json');
echo $encoded;
?>
