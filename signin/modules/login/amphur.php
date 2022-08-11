<?php
header("Content-type: application/xhtml+xml; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

require_once("../../../includes/config.php");
require_once("../../../includes/class.mysqli.php");
require_once("lang/reg.php");
$db = New DB();
$province_id = $_GET['province_id'];
echo $province_id;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where provinceID='".$province_id."' ");

if(isset($_GET['province_id']) && $_GET['province_id']!=""){
 ?>
    <option value=""><?php echo _text_box_table_school_amp_select;?></option>
    <?php while ($arr['amp'] = $db->fetch($res['amp'])){?>
    <option value="<?php echo $arr['amp']['amphur_code'];?>"><?php echo $arr['amp']['name'];?></option>
    <?php } ?>
<?php }else{ ?>
    <option value=""><?php echo _text_box_table_school_amp_select;?></option>
<?php } ?>