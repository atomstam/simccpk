<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/spacial.php");
$db = New DB();

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".$_GET['class_id']."'  "); 
@$arr['class'] = $db->fetch(@$res['class']);

?>

  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="text-right col-xs-12">

		</div>
	
    </div>
  </div>
</div>
</div>

