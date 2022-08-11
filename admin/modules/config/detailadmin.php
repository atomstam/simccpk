<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/user.php");
$db = New DB();

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE area_code ='".$_SESSION['admin_area']."' and school_code='".$_SESSION['admin_school']."'  and admin_id='".$_GET['admin_id']."'  "); 
@$arr['user'] = $db->fetch(@$res['user']);
@$res['cat'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." WHERE group_id='".@$arr['user']['admin_group_id']."' ");
@$arr['cat'] = $db->fetch(@$res['cat']);
?>

  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="text-right col-xs-12">
		<table>
		<tr>
		<td width="35%">
			<div class="pull-left image">
			<img src="<?php if(@$arr['user']['img']){echo WEB_URL_IMG_ADMIN.@$arr['user']['img'];}else{echo WEB_URL_IMG_ADMIN."no_image.jpg";}?>" width="80" alt="User Image"/>
			</div>
		</div>
		</td>
		<td width="65%">
			<table width="100%">
				<tr><td align="right"><?php echo _text_box_table_name;?></td><td align="left">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo @$arr['user']['firstname']." ".@$arr['user']['lastname']; ?></td></tr>
				<tr><td align="right"><?php echo _text_box_table_user;?></td><td align="left">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo @$arr['user']['username']; ?></td></tr>
				<tr><td align="right"><?php echo _text_box_table_email;?></td><td align="left">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo @$arr['user']['email']; ?></td></tr>
				<tr><td align="right"><?php echo _text_box_table_datetime_en;?></td><td align="left">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo @$arr['user']['date_added']; ?></td></tr>
				<tr><td align="right"><?php echo _text_box_table_group;?></td><td align="left">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo @$arr['cat']['group_name']; ?></td></tr>
			</table>
		</td>
		</tr>
		</table>
    </div>
  </div>
</div>
</div>

