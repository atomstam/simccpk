<?php
ob_start();
if (session_id() =='') { @session_start(); }
header("Content-type: application/xhtml+xml; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/tunbon.php");
$db = New DB();
$nut_id = $_GET['nut_id'];
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['nut'] = $db->select_query("SELECT * FROM ".TB_NUT." as a,".TB_STUDENT."  as b where b.stu_id='".$nut_id."' and a.nut_stu=b.stu_id and a.nut_area='".$_SESSION['admin_area']."' and a.nut_code='".$_SESSION['admin_school']."' order by a.nut_id");
?>
    <?php 
	$i=1;
	while (@$arr['nut'] = $db->fetch(@$res['nut'])){?>
    <option value="<?php echo @$arr['nut']['nut_id'];?>">[<?php echo @$arr['nut']['stu_id'];?>] <?php echo @$arr['nut']['stu_num']."".@$arr['nut']['stu_name']." ".@$arr['nut']['stu_sur'];?>(<?php echo _text_box_table_count_nut_tunbon;?><?php echo $i;?>  <?php echo @$arr['nut']['nut_dateT'];?>) </option>
    <?php $i++;} ?>
