<?php
ob_start();
if (session_id() =='') { @session_start(); }
header("Content-type: application/xhtml+xml; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

require_once("../../../includes/config.php");
require_once("../../../includes/class.mysqli.php");
require_once("lang/register.php");
$db = New DB();
$area_id = $_GET['area_id'];
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['area'] = $db->select_query("SELECT * FROM ".TB_AREA." where area_status='1' ");
 ?>
    <option value=""><?php echo _form_select_list;?></option>
    <?php while ($arr['area'] = $db->fetch($res['area'])){?>
    <option value="<?php echo $arr['area']['area_code'];?>">[<?php echo $arr['area']['area_code'];?>] <?php echo $arr['area']['area_name'];?></option>
    <?php } ?>
