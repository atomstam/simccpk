<?php
//require_once("../../../includes/config.php");
//require_once("../../../includes/class.mysql.php");

//$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM web_student "); 
while(@$arr['user'] = $db->fetch(@$res['user'])){
if(@$arr['user']['stu_birth'] !=''){
$date_array = explode("/",@$arr['user']['stu_birth']); // split the array
$var_year = $date_array[2]; //day seqment
$var_month = $date_array[1]; //month segment
$var_day = $date_array[0]; //year segment
$YY=$var_year;
if($var_month<10){
$var_monthx="0".$var_month;
} else {
$var_monthx=$var_month;
}
if($var_day<10){
$var_dayx="0".$var_day;
} else {
$var_dayx=$var_day;
}
$new_date_format = "$YY-$var_monthx-$var_dayx";

//$Date=convert_dates(@$arr['user']['stu_birth']);
//@$array = preg_split('/(\d{4}-\d{2}-\d{2})/', $Date);
//list($y,$m,$d) =preg_split("/\-/",$Date);
//echo $new_date_format;
$db->update_db(TB_STUDENT,array(
			"stu_birth"=>"".$new_date_format.""
		)," stu_id=".@$arr['user']['stu_id']." ");
}
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

