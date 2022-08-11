<?php
header('Content-Type: application/json');
//ob_start();
//if (session_id() =='') { @session_start(); }
require_once("includes/config.php");
require_once("lang/thai.php");
require_once("lang/dateThai.php");
require_once("includes/array.in.php");
require_once("includes/function.in.php");
require_once("includes/class.mysql.php");
$Date=date("Y-m-d H:i:s");
$DD=date("Y-m-d");
//echo "<pre>";
//print_r($_REQUEST);
//echo "</pre>";
$API_KEY = "dfo3830dfsd3h7vi9po6e8w7q5e3d5y7";
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$responseArray=[];
if(isset($_GET['id']) || $API_KEY==$_GET['api_key']){
		$res['stu'] = $db->select_query("SELECT * FROM web_student where  stu_id='".$_GET['id']."' "); 
		$rows['stu'] = $db->rows($res['stu']);
		if($rows['stu']){
		$arr['stu'] = $db->fetch($res['stu']);
		$res['end'] = $db->select_query("select * web_enttoday where ent_stu='".$arr['stu']['stu_id']."' and b_date like '%".$DD."%' ");
		$rows['end'] = $db->rows($res['end']);
		if(!isset($rows['end'])){
		$res['nums'] = $db->select_query("insert into web_enttoday (ent_id,ent_stu,b_date) values (null,'".$arr['stu']['stu_id']."','".$Date."')");
		$arr['nums'] = $db->fetch($res['nums']);
		}
		$stu_id=$arr['stu']['stu_id'];
		$stu_name=$arr['stu']['stu_name'];
		$stu_sur=$arr['stu']['stu_sur'];
		$responseArray[] = array('stu_id'=>$stu_id,'stu_name'=>$stu_name,'stu_sur'=>$stu_sur);
		} else {
		$responseArray[] = array('type' => 'NO', 'message' => 'error');
		}
} else {
		$responseArray[] = array('type' => 'NO', 'message' => 'error');
}
$encoded = json_encode($responseArray);
echo $encoded;

?>