<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_STUDENT." order by stu_id"); 
while(@$arr['user'] = $db->fetch(@$res['user'])){
	$update=FullDateThai(@$arr['user']['stu_birth']);
	@$res['update'] = $db->update_db(TB_STUDENT,array(
		"stu_birth"=>"".$update.""
	)," stu_id=".@$arr['user']['stu_id']." ");
}
?>