<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/person.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_id='".$_GET['per_id']."'  "); 
@$arr['user'] = $db->fetch(@$res['user']);
@$res['cat'] = $db->select_query("SELECT * FROM ".TB_PERSON_GROUP." WHERE group_id='".@$arr['user']['per_posi']."' "); 
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
			<img src="<?php if(@$arr['user']['per_pic']){echo WEB_URL_IMG_PERSON.@$arr['user']['per_pic'];}else{echo WEB_URL_IMG_PERSON."no_image.jpg";}?>" width="80" alt="User Image"/>
			</div>
		</div>
		</td>
		<td width="65%">
			<table width="100%">
				<tr><td align="right"><?php echo _text_box_table_name;?></td><td align="left">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo @$arr['user']['per_name']; ?></td></tr>
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
