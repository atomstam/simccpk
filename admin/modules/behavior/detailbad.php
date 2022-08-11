<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/bad.php");
//echo $_GET['bad_id'];
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['bad'] = $db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_id='".$_GET['bad_id']."'  "); 
@$arr['bad'] = $db->fetch(@$res['bad']);
@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_id='".@$arr['bad']['bad_stu']."' "); 
@$arr['stu'] = $db->fetch(@$res['stu']);
?>

  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="text-right col-xs-12">
		<table>
		<tr>
		<td width="35%">
			<div class="pull-left image">
			<img src="<?php if(@$arr['stu']['stu_pic']){echo WEB_URL_IMG_STU.@$arr['stu']['stu_pic'];}else{echo WEB_URL_IMG_STU."no_image.jpg";}?>" width="80" alt="User Image"/>
			</div>
		</div>
		</td>
		<td width="65%">
			<table width="100%">
				<tr><td align="right"><?php echo _text_box_table_name;?></td><td align="left">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo @$arr['stu']['stu_name']; ?></td></tr>
				<tr><td align="right"><?php echo _text_box_table_posi;?></td><td align="left">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo @$arr['cat']['group_name']; ?></td></tr>
				<tr><td align="right"><?php echo _text_box_table_user;?></td><td align="left">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo @$arr['user']['per_ids']; ?></td></tr>
				<tr><td align="right"><?php echo _text_box_table_password;?></td><td align="left">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo @$arr['user']['per_pin']; ?></td></tr>
				<tr><td align="right"><?php echo _text_box_table_email;?></td><td align="left">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo @$arr['user']['per_email']; ?></td></tr>
				<tr><td align="right"><?php echo _text_box_table_tel;?></td><td align="left">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo @$arr['user']['per_tel']; ?></td></tr>
			</table>
		</td>
		</tr>
		</table>
    </div>
  </div>
</div>
</div>
