<?php
//ob_start();
//if (session_id() =='') { @session_start(); }
require_once("includes/config.php");
require_once("lang/thai.php");
require_once("lang/dateThai.php");
require_once("includes/array.in.php");
require_once("includes/function.in.php");
require_once("includes/class.mysql.php");
$db = New DB();
//$ONET='101702';
$ToDay=date("Y-m-d");
$ToYear=date("Y");

	$date_arrayx = explode("-",$ToDay); // split the array
	$var_yearx = $date_arrayx[0]; //day seqment
	$var_monthx = $date_arrayx[1]; //month segment
	$var_dayx = $date_arrayx[2]; //year segment
	//$Age=getAge($var_yearx,$var_monthx,$var_dayx);

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." where clg_LineId !='' order by clg_group"); 
$cc=0;
while ($arr['cl'] = $db->fetch($res['cl'])){

$res['num'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_class='".$arr['cl']['clg_group']."' and stu_cn='".$arr['cl']['clg_name']."' and stu_birth like '%-$var_monthx-$var_dayx%' and stu_code='".$arr['cl']['clg_school']."' group by stu_id order by stu_id"); 
$i=0;
while ($arr['num'] = $db->fetch($res['num'])){
	$ToYearx=date("Y");
	$date_array = explode("-",$arr['num']['stu_birth']); // split the array
	$var_year = $date_array[0]; //day seqment
	$var_month = $date_array[1]; //month segment
	$var_day = $date_array[2]; //year segment
	$YY=$var_year;
	//$new_date_format = "$YY-$var_monthx-$var_dayx";
	$new_date_format = "$ToYearx-$var_month-$var_day";
//	if($new_date_format==$ToDay){
		$Stu_names[$cc][]=($i+1).".".$arr['num']['stu_name']." ".$arr['num']['stu_sur'];
//	}
	$AgeStu[$cc]=$arr['num']['stu_birth'];
$i++;
}

if(!empty($Stu_names[$cc])){
$G_stunames[$cc]=implode("\r\n",$Stu_names[$cc]);
$Message[$cc]=$G_stunames[$cc]."";
$Class[$cc]=$arr['cl']['clg_group'];
$group[$cc]=$arr['cl']['clg_name'];
$Token[$cc]=$arr['cl']['clg_LineId'];
$ex[$cc] = explode("," , $AgeStu[$cc]);
$DD[$cc]=$ex[$cc][0];
$CC[$cc] = explode("-" , $DD[$cc]);
//$Age=getAgeClass($DD[$cc]);
//echo $CC[$cc][0];
$ToYeary[$cc]=date("Y");
$Age[$cc]=(int)($ToYeary[$cc])-(int)($CC[$cc][0]);
//echo $Age[$cc];
$resx = Line_HBD_Class($Class[$cc],$group[$cc],$Message[$cc],$Age[$cc],$Token[$cc]);
print_r($resx);
}
$cc++;
}
?>