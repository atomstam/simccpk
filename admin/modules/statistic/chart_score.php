<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("../../../lang/dateThai.php");
require_once("../../../lang/thai.php");
require_once("../../../includes/array.in.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$return_arr = array();
$result = $db->select_query("SELECT *,sum(badtail_point) AS CO FROM ".TB_BAD."  ,".TB_BADTAIL.",".TB_STUDENT."  where  bad_tail=badtail_id and stu_id=bad_stu and stu_suspend='0' and bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' group by bad_mouth"); 
 //$rows = $db->fetch($result);
 //for($i=0;$i<13;$i++){
$i=1;
while($rows = $db->fetch($result)){
	$resultG = $db->select_query("select *,sum(goodtail_point) as GO  from ".TB_GOOD." ,".TB_GOODTAIL.",".TB_STUDENT."  where  good_tail=goodtail_id and good_mouth='".$rows['bad_mouth']."' and stu_id=good_stu and stu_suspend='0' and good_area='".$_SESSION['admin_area']."' and good_code='".$_SESSION['admin_school']."' group by good_mouth"); 
	$rowsG = $db->fetch($resultG);
	$row_array['B_m'] = $rows['bad_mouth'];
	$row_array['Bad_m'] = $rows['b_date'];
	$row_array['Co'] = (int)$rows['CO'];
//    $row_array['Good_m'] = $rowsG['good_mouth'];
	$row_array['Go'] = (int)$rowsG['GO'];
//    array_push($return_arr,$row_array);
	$AY=$row_array['B_m'];
	$BY=explode("-", $row_array['Bad_m']);
	$YY=strtotime($row_array['Bad_m']);
	$XX=$SHORT_MONTH[date('n',$YY)];

	$return_arr[]=array('y'=>$BY[0].'-'.$BY[1],'item1'=>(int)$row_array['Co'],'item2'=>(int)$row_array['Go']);
$i++;
}

//		$successx = "Success";
//		$responseArray = array('y' => $return_arr, 'item1' => $row_array);
		$encoded = json_encode($return_arr);
		header('Content-Type: application/json');
	echo $encoded;
//echo $responseArray;

?>