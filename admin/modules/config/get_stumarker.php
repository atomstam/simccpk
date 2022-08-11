<?php
header("Content-type:application/json; charset=UTF-8");        
header("Cache-Control: no-store, no-cache, must-revalidate");       
header("Cache-Control: post-check=0, pre-check=0", false);  
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");

$db = New DB();

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_STUDENT." "); 
while($rs=$db->fetch(@$res['user'])){
@$res['cat'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".$rs['stu_class']."' ");
@$arr['cat'] = $db->fetch(@$res['cat']);
   $json_data[]=array(
        "stu_id"=>$rs['stu_id'],
        "stu_name"=>$rs['stu_name'],
        "latitude"=>$rs['stu_lat'],
        "longitude"=>$rs['stu_long'],
        "zoom"=>'5'
    );  
}
$json= json_encode($json_data);
echo $json;
?>