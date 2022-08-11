<?php
//require_once("../../../includes/config.php");
//require_once("../../../includes/class.mysql.php");

//$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM web_student "); 
while(@$arr['user'] = $db->fetch(@$res['user'])){

		$db->add_db(TB_BESTTAIL,array(
			"btail_id"=>"1",
			"btail_area"=>"101726",	
			"btail_code"=>"44012023",	
			"btail_stu"=>"".@$arr['user']['stu_id']."",	
			"btail_name"=>"นักเรียนยากจนมากเป็นพิเศษ",	
			"btail_per"=>"admin"
		));
}
?>

  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
			OK
    </div>
  </div>
</div>
</div>

