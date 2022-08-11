<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$return_arr = array();
@$result = $db->select_query("SELECT bad_mouth,COUNT(bad_id) AS CO FROM ".TB_BAD.",".TB_STUDENT." where bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_stu=stu_id and stu_suspend='0'  group by bad_year,bad_mouth order by bad_year,bad_mouth"); 
 //@$rows = $db->fetch(@$result);
 //for($i=0;$i<13;$i++){
while(@$rows = $db->fetch(@$result)){
	@$resultG = $db->select_query("SELECT good_mouth,COUNT(good_id) AS GO FROM ".TB_GOOD." where good_area='".$_SESSION['admin_area']."' and good_code='".$_SESSION['admin_school']."' and good_mouth='".@$rows['bad_mouth']."' "); 
	@$rowsG = $db->fetch(@$resultG);

	$row_array['Bad_m'] = @$rows['bad_mouth'];
	$row_array['Co'] = @$rows['CO'];
    $row_array['Good_m'] = @$rowsG['good_mouth'];
	$row_array['Go'] = @$rowsG['GO'];
    array_push($return_arr,$row_array);
}

//		$successx = "Success";
//		@$responseArray = array('type' => 'success', 'message' => $successx);
		$encoded = json_encode($return_arr);
		header('Content-Type: application/json');
		echo $encoded;

?>