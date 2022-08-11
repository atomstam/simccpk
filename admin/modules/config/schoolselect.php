<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysqli.php");
require_once("../../../includes/function.in.php");
require_once("lang/school.php");
$db = New DB();
$area_id = $_GET['area_id'];
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['area'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." where sh_area='".$area_id."' and sh_code='".$_SESSION['user_code']."' ");

if(isset($_GET['area_id']) && $_GET['area_id']!=""){
 ?>
    <option value=""><?php echo _text_box_table_school_code_select;?></option>
    <?php while (@$arr['area'] = $db->fetch(@$res['area'])){?>
    <option value="<?php echo @$arr['area']['sh_code'];?>">[<?php echo @$arr['area']['sh_code'];?>] <?php echo @$arr['area']['sh_name'];?></option>
    <?php } ?>
<?php }else{ ?>
    <option value=""><?php echo _text_box_table_school_code_select;?></option>
<?php } ?>