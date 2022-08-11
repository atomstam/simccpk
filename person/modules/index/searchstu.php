<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
$db = New DB();
//echo $_GET['query'];
if(isset($_POST['query'])){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."'  and stu_name LIKE '%".$_POST['query']."%'  order by stu_name "); 
$data=array();
while($row = $db->fetch(@$res['user'])){
	$bus = array(
	    'value' => $row['stu_id'],
        'label' => $row['stu_name']
	);
	array_push($data, $bus);
	//	  array_push($data,$row['stu_id'].":".$row['stu_name']." ".$row['stu_sur']." ".$row['stu_class']);
}
echo json_encode($data);
}
?>


