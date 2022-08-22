<?php
//ob_start();
//if (session_id() =='') { @session_start(); }
require_once("includes/config.php");
require_once("includes/class.mysql.php");
//require_once("mainfile.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

for($i=1;$i<4;$i++){
if($i==1){
	$sql = $db->select_query("SELECT * FROM web_chclass where c_area='101726' and c_code='44012028'  and c_k like '%หน้าเสาธง%'  group by c_class,c_cn,c_date order by c_date,c_class,c_cn");
	while($arr = $db->fetch($sql)){
				$sql_up = "INSERT INTO web_chk_chclass 
								(chk_area,chk_code,chk_gr,chk_class,chk_cn,chk_date,chk_datetime,chk_note) 
								VALUES ( '101726','44012028','1','".$arr['c_class']."','".$arr['c_cn']."' ,'".$arr['c_date']."' ,'".date("Y-m-d H:i:s")."','".$arr['c_note']."')";
				$rs_up .= $db->select_query($sql_up);
				$rs_up .= $i.".".$arr['c_class']."/".$arr['c_cn']."<br>";
	}
}
if($i==2){
	$sql = $db->select_query("SELECT * FROM web_chclass where c_area='101726' and c_code='44012028'  and (c_k2 like '%MindSet%' or c_k2 like '%Mindset%') group by c_class,c_cn,c_date order by c_date,c_class,c_cn");
	while($arr = $db->fetch($sql)){
				$sql_up = "INSERT INTO web_chk_chclass 
								(chk_area,chk_code,chk_gr,chk_class,chk_cn,chk_date,chk_datetime,  chk_note) 
								VALUES ( '101726','44012028','2','".$arr['c_class']."','".$arr['c_cn']."' ,'".$arr['c_date']."' ,'".date("Y-m-d H:i:s")."','".$arr['c_note']."')";
				$rs_up .= $db->select_query($sql_up);
				$rs_up .= $i.".".$arr['c_class']."/".$arr['c_cn']."<br>";
	}
}
if($i==3){
	$sql = $db->select_query("SELECT * FROM web_chclass where c_area='101726' and c_code='44012028'  and c_k3 like '%Rivision%'  group by c_class,c_cn,c_date order by c_date,c_class,c_cn");
	while($arr = $db->fetch($sql)){
				$sql_up = "INSERT INTO web_chk_chclass 
								(chk_area,chk_code,chk_gr,chk_class,chk_cn,chk_date,chk_datetime,  chk_note) 
								VALUES ( '101726','44012028','3','".$arr['c_class']."','".$arr['c_cn']."' ,'".$arr['c_date']."' ,'".date("Y-m-d H:i:s")."','".$arr['c_note']."')";
				$rs_up .= $db->select_query($sql_up);
				$rs_up .= $i.".".$arr['c_class']."/".$arr['c_cn']."<br>";
	}
}

} //for

if($rs_up){
	echo $rs_up;
} else {
	echo "Error";

}

?>