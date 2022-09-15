<?php
header("Content-type: application/xhtml+xml; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

require_once("../../../includes/config.php");
//require_once("../../../includes/function.in.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/area.php");
$db = New DB();
$amphur_id = $_GET['amphur_id'];
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['tam'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where amphurID='".$amphur_id."' ");

if(isset($_GET['amphur_id']) && $_GET['amphur_id']!=""){
 ?>
    <option value=""><?php echo _text_box_table_area_tambon_select;?></option>
    <?php while ($arr['tam'] = $db->fetch($res['tam'])){?>
    <option value="<?php echo $arr['tam']['tumbon_code'];?>"><?php echo $arr['tam']['name'];?></option>
    <?php } ?>
<?php }else{ ?>
    <option value=""><?php echo _text_box_table_area_tambon_select;?></option>
<?php } ?>