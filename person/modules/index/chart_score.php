<?php
ob_start();
header('Content-Type: application/json');
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$return_arr = array();
@$resultG = $db->select_query("select *,count(p_sex) As GR  from ".TB_PERSONNEL." where p_code='".$_SESSION['user_code']."' group by p_sex order by p_sex"); 
//@$rowsG = $db->fetch(@$resultG);
while(@$rowsG =$db->fetch(@$resultG)){
$return_arr[]=array('label'=>''.@$rowsG['p_sex'].'','value'=>@$rowsG['GR']);
}

//		$successx = "Success";
//		@$responseArray = array('y' => $return_arr, 'item1' => $row_array);
		$encoded = json_encode($return_arr);
		header('Content-Type: application/json');
	echo $encoded;
//echo @$responseArray;

?>