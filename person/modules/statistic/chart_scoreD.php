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
@$resultB = $db->select_query("SELECT *,sum(badtail_point) AS CO FROM ".TB_BAD."  ,".TB_BADTAIL." ,".TB_STUDENT." where  bad_tail=badtail_id and bad_area='".$_SESSION['person_area']."' and bad_code='".$_SESSION['person_school']."' and stu_id=bad_stu and stu_suspend='0' group by bad_year"); 
@$rowsB = $db->fetch(@$resultB);
@$resultG = $db->select_query("select *,sum(goodtail_point) as GO  from ".TB_GOOD." ,".TB_GOODTAIL.",".TB_STUDENT."  where  good_tail=goodtail_id and good_area='".$_SESSION['person_area']."' and good_code='".$_SESSION['person_school']."' and stu_id=good_stu and stu_suspend='0' group by good_year"); 
@$rowsG = $db->fetch(@$resultG);
//$SumBG=@$rowsG['GO']-@$rowsB['CO'];
//$Labels=array('คะแนนรวม','คะแนนพฤติกรรมลบ','คะแนนพฤติกรรมบวก');
//$Values=array($SumBG,@$rowsB['CO'],@$rowsG['GO']);
//for($i=0;$i<=2;$i++){
//$return_arr[]=array('label'=>''.$Labels[$i].'','value'=>(int)$Values[$i]);
//}

//$SumBG=@$rowsG['GO']-@$rowsB['CO'];
$Labels=array('คะแนนพฤติกรรมลบ','คะแนนพฤติกรรมบวก');
$Values=array(@$rowsB['CO'],@$rowsG['GO']);
for($i=0;$i<2;$i++){
	$return_arr[]=array('label'=>''.$Labels[$i].'','value'=>(int)$Values[$i]);
}

//		$successx = "Success";
//		@$responseArray = array('y' => $return_arr, 'item1' => $row_array);
		$encoded = json_encode($return_arr);
		header('Content-Type: application/json');
	echo $encoded;
//echo @$responseArray;

?>