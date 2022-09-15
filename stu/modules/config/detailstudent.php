<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/student.php");
$db = New DB();
//echo $_GET['stu_id'];
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_id='".$_GET['stu_id']."'  "); 
@$arr['user'] = $db->fetch(@$res['user']);
@$res['cat'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['user']['stu_class']."' ");
@$arr['cat'] = $db->fetch(@$res['cat']);
?>
 
  <div class="user">
    <div class="user-header" align="center">
			<img src="<?php if(@$arr['user']['stu_pic']){echo WEB_URL_IMG_STU.@$arr['user']['stu_pic'];}else{echo WEB_URL_IMG_STU."no_image.jpg";}?>"  width="150" class="img-circle" alt="User Image"/>
	</div>
</div>

