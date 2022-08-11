<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
$add='';
$success='';
$error_warning='';
?>

<?php
if(!empty($_SESSION['person_login'])){
$Mtime=time();
if($op=='AddTab1'){
	list($Y , $m , $d) = explode("-" , $_POST['DateID']);
	$y=$Y+543;
	
	$RANK=$rank+1;					
	

	for ($i=0; $i < $RANK; $i++) {
		if(isset($_POST['StuID'][$i])){
			
		$sq4=$db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_area='".$_SESSION['person_area']."' and bad_code='".$_SESSION['person_school']."' and bad_stu='".$_POST['StuID'][$i]."' and b_date='".$_POST['DateID']."' ");
		@$result4=$db->fetch($sq4);

		if(@$result4['bad_name'] !='ไม่มาโรงเรียน' && @$result4['bad_name'] !='ลาโรงเรียน' ){
		if(@$_POST['Bad_Status'][$i]=='1'){

			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='ไม่มาเคารพธงชาติ' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_add_tab1_badtail_name_kad;
			$btailid=@$result['badtail_id'];
			$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['person_area']."",
				"bad_code"=>"".$_SESSION['person_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>$_SESSION['person_login'],
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>$_SESSION['person_login'],
				"role"=>"2"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );

				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['person_area']."' and clg_school='".$_SESSION['person_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				//@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				//print_r(@$resx);

		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}


		} else if(@$_POST['Bad_Status'][$i]=='3'){
			$Bad_tail=_text_add_tab1_badtail_name_sai;
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'   and badtail_name='มาสาย' ");
			@$result=$db->fetch($sql);
			$btailid=@$result['badtail_id'];
			$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['person_area']."",
				"bad_code"=>"".$_SESSION['person_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>$_SESSION['person_login'],
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>$_SESSION['person_login'],
				"role"=>"2"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );

				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['person_area']."' and clg_school='".$_SESSION['person_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				//@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				//print_r(@$resx);

		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}


		} else {
			$Bad_tail=_text_add_tab1_badtail_name_la;
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		} // $_POST['Bad_Status'][$i]
		} //@$result4['bad_name'] ไม่มา
		} // stu id
   } // Rank

//		$add.=$db->del(TB_CLASS," class_id='".$_GET['class_id']."' ");
//		$add .=$_POST['ClassID']."<br>";
//		$add .=$_POST['DateID']."<br>";
//		$add .=$_POST['StuID']."<br>";
//echo $add;
    	if($add){
		$success =_text_report_add_ok;
		} else {
		$error_warning=_text_report_add_fail;
		}
} 


if($op=='AddTab2'){
	list($Y , $m , $d) = explode("-" , $_POST['DateID']);
	$y=$Y+543;
	
	$RANK=$rank+1;					

	for ($i=0; $i < $RANK; $i++) {
		if(isset($_POST['StuID'][$i])){
		$sq4=$db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_area='".$_SESSION['person_area']."' and bad_code='".$_SESSION['person_school']."' and bad_stu='".$_POST['StuID'][$i]."' and b_date='".$_POST['DateID']."' ");
		@$result4=$db->fetch($sq4);
		if(@$result4['bad_name'] !='ไม่มาโรงเรียน' && @$result4['bad_name'] !='ลาโรงเรียน' ){
		if(@$_POST['Bad_Status'][$i]=='1'){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='ไม่ร่วมกิจกรรมโรงเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_add_tab2_badtail_name_kad;
			$btailid=@$result['badtail_id'];
			$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['person_area']."",
				"bad_code"=>"".$_SESSION['person_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>$_SESSION['person_login'],
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>$_SESSION['person_login'],
				"role"=>"2"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['person_area']."' and clg_school='".$_SESSION['person_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				//@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				//print_r(@$resx);

		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k2"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k2"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		} else if(@$_POST['Bad_Status'][$i]=='3'){
			$Bad_tail=_text_add_tab2_badtail_name_sai;
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='มาสาย' ");
			@$result=$db->fetch($sql);
			$btailid=@$result['badtail_id'];
			$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['person_area']."",
				"bad_code"=>"".$_SESSION['person_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>"".$_SESSION['person_login']."",
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>$_SESSION['person_login'],
				"role"=>"2"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['person_area']."' and clg_school='".$_SESSION['person_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				//@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				//print_r(@$resx);
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k2"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k2"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		} else {
			$Bad_tail=_text_add_tab2_badtail_name_la;
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k2"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k2"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		}
		}
		}
   }
//		$add.=$db->del(TB_CLASS," class_id='".$_GET['class_id']."' ");
//		$add .=$_POST['ClassID']."<br>";
//		$add .=$_POST['DateID']."<br>";
//		$add .=$_POST['StuID']."<br>";
//echo $add;
    	if($add){
		$success =_text_report_add_ok;
		} else {
		$error_warning=_text_report_add_fail;
		}
} 



if($op=='AddTab3'){
	list($Y , $m , $d) = explode("-" , $_POST['DateID']);
	$y=$Y+543;
	
	$RANK=$rank+1;					

	for ($i=0; $i < $RANK; $i++) {
		if(isset($_POST['StuID'][$i])){
		$sq4=$db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_area='".$_SESSION['person_area']."' and bad_code='".$_SESSION['person_school']."' and bad_stu='".$_POST['StuID'][$i]."' and b_date='".$_POST['DateID']."' ");
		@$result4=$db->fetch($sq4);
		if(@$result4['bad_name'] !='ไม่มาโรงเรียน' && @$result4['bad_name'] !='ลาโรงเรียน' ){
		if(@$_POST['Bad_Status'][$i]=='1'){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='ไม่ร่วมกิจกรรมโรงเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_add_tab3_badtail_name_kad;
			$btailid=@$result['badtail_id'];
			$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['person_area']."",
				"bad_code"=>"".$_SESSION['person_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>$_SESSION['person_login'],
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>$_SESSION['person_login'],
				"role"=>"2"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['person_area']."' and clg_school='".$_SESSION['person_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				//@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				//print_r(@$resx);
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k3"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k3"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		} else if(@$_POST['Bad_Status'][$i]=='3'){
			$Bad_tail=_text_add_tab3_badtail_name_sai;
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='มาสาย' ");
			@$result=$db->fetch($sql);
			$btailid=@$result['badtail_id'];
			$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['person_area']."",
				"bad_code"=>"".$_SESSION['person_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>$_SESSION['person_login'],
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>$_SESSION['person_login'],
				"role"=>"2"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);

				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['person_area']."' and clg_school='".$_SESSION['person_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				//@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				//print_r(@$resx);
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k3"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k3"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		} else {
			$Bad_tail=_text_add_tab3_badtail_name_la;
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k3"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k3"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		}
		}
		}
   }
//		$add.=$db->del(TB_CLASS," class_id='".$_GET['class_id']."' ");
//		$add .=$_POST['ClassID']."<br>";
//		$add .=$_POST['DateID']."<br>";
//		$add .=$_POST['StuID']."<br>";
//echo $add;
    	if($add){
		$success =_text_report_add_ok;
		} else {
		$error_warning=_text_report_add_fail;
		}
} 

?>

<div class="col-xs-12">

      <?php if ($success) { ?>
      <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo $success; ?></span>
      </div>
      <?php } ?>
      <?php if ($error_warning) { ?>
      <div class="alert alert-danger" >
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo $error_warning; ?></span>
      </div>
      <?php } ?>


      <div class="row">
        <div class="col-md-12">

<?php
//<form action="index.php?name=config&file=student&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
?>


					    <div class="box box-success" id="loading-example">
                                <div class="box-header with-border">
                                <i class="fa fa-user"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">

<div class="form-group">
	<div class="col-sm-12" >
	</div>
</div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _heading_title_M_tab1;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                <div class="hidden-xs"><?php if($_SESSION['person_school'] =='44012028'){ echo "กิจกรรม MindSet";} else {echo _heading_title_M_tab2;}?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                <div class="hidden-xs"><?php if($_SESSION['person_school'] =='44012028'){ echo "กิจกรรม Rivision";} else {echo _heading_title_M_tab3;}?></div>
            </button>
        </div>
    </div>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="tab1">

				<form method="post" action="index.php?name=behavior&file=bclass&op=AddTab1&route=<?php echo $route;?>" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
							<div class="col-xs-12" align="center" >
							<h4 class="box-title"><?php echo _heading_title_M_tab1; ?></h4>
							</div>
							<div class="col-xs-12" align="right" >
							<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=bclass&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
							  </div>
							 </div>
							<div class="form-group">
							<div class="col-sm-12" >
							</div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_birth; ?></label>
							<div class="col-sm-3" >
							<?php $DateTimeStart=date('Y-m-d');?>
							<div class="input-group date" id="dp1" data-date="<?php echo $DateTimeStart;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control" id="DateID" name="DateID" class="form-control css-require" value="<?php echo $DateTimeStart;?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>

						  <?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							@$res['num'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_class='".$_SESSION['person_class']."' and stu_cn='".$_SESSION['person_cn']."' and stu_suspend='0' order by id"); 
							@$rows['num'] = $db->rows(@$res['num']);
							if(@$rows['num']) {
							?>
							<table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
							  <thead>
								<tr >
								  <th width="1" style="text-align: center;"></th>
								  <th layout="block" style="text-align:center;" ><?php echo _text_box_table_tab1_stu_id; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab1_stu_name; ?></th>
								  <th layout="block" style="text-align:center;">ห้อง</th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab1_status1; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab1_status2;?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab1_status3;?></th>
								</tr>
							  </thead>
							  <tbody>
							<?php
							$i=1;
							while (@$arr['num'] = $db->fetch(@$res['num'])){
							?>
								<tr>
								  <td style="text-align: center;"><?php echo $i;?></td>
								  <td layout="block" style="text-align: center;"><?php echo @$arr['num']['stu_id'];?></td>
								  <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur']; ?></td>
								  <td layout="block" style="text-align: center;"><?php echo @$arr['num']['stu_cn']; ?></td>
								  <td layout="block" style="text-align: center;"><input type="radio" name="Bad_Status[<?php echo $i;?>]" class="minimal" value="1" ></td>
								  <td layout="block" style="text-align: center;"><input type="radio" name="Bad_Status[<?php echo $i;?>]" class="minimal" value="2" ></td>
								  <td layout="block" style="text-align: center;"><input type="radio" name="Bad_Status[<?php echo $i;?>]" class="minimal" value="3" ></td>
								  <input type="hidden" name="StuID[<?php echo $i;?>]"  value="<?php echo @$arr['num']['stu_id'];?>">
								  <input type="hidden" name="rank"  value="<?php echo $i;?>">
								</tr>

								<?php $i++;} ?>
							  </tbody>
							  </table>
												<div class="form-group">
												<div class="col-sm-4" >
												<br>
												</div>
												</div>


								<?php } else { ?>
								<table>
								<tr>
								  <td class="center" colspan="6"><?php echo _text_no_results; ?></td>
								</tr>
								</table>
								<?php } ?>
							<input type="hidden" name="OP"  value="Add">
							<input type="hidden" name="ClassID"  value="<?=$_SESSION['person_class'];?>">
							<input type="hidden" name="Stu_cn"  value="<?=$_SESSION['person_cn'];?>">
						
						</form>

		</div>
		<div class="tab-pane fade in" id="tab2">


				<form method="post" action="index.php?name=behavior&file=bclass&op=AddTab2&route=<?php echo $route;?>" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
							<div class="col-xs-12" align="center" >
							<h4 class="box-title"><?php if($_SESSION['person_school'] =='44012028'){ echo "เพิ่มกิจกรรม MindSet";} else {echo _heading_title_M_tab2;}?></h4>
							</div>
							<div class="col-xs-12" align="right" >
							<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=bclass&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
							  </div>
							 </div>
							<div class="form-group">
							<div class="col-sm-12" >
							</div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_birth; ?></label>
							<div class="col-sm-3" >
							<?php $DateTimeStart=date('Y-m-d');?>
							<div class="input-group date" id="dp2" data-date="<?php echo $DateTimeStart;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control" id="DateID" name="DateID" class="form-control css-require" value="<?php echo $DateTimeStart;?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>

						  <?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							@$res['num'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_class='".$_SESSION['person_class']."' and stu_cn='".$_SESSION['person_cn']."' and stu_suspend='0' order by id"); 
							@$rows['num'] = $db->rows(@$res['num']);
							if(@$rows['num']) {
							?>
							<table id="example2" class="table table-bordered table-striped responsive" style="width:100%">
							  <thead>
								<tr >
								  <th width="1" style="text-align: center;"></th>
								  <th layout="block" style="text-align:center;" ><?php echo _text_box_table_tab1_stu_id; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab1_stu_name; ?></th>
								  <th layout="block" style="text-align:center;">ห้อง</th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab1_status1; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab1_status2;?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab1_status3;?></th>
								</tr>
							  </thead>
							  <tbody>
							<?php
							$i=1;
							while (@$arr['num'] = $db->fetch(@$res['num'])){
							?>
								<tr>
								  <td style="text-align: center;"><?php echo $i;?></td>
								  <td layout="block" style="text-align: center;"><?php echo @$arr['num']['stu_id'];?></td>
								  <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur']; ?></td>
								  <td layout="block" style="text-align: center;"><?php echo @$arr['num']['stu_cn']; ?></td>
								  <td layout="block" style="text-align: center;"><input type="radio" name="Bad_Status[<?php echo $i;?>]" class="minimal" value="1" ></td>
								  <td layout="block" style="text-align: center;"><input type="radio" name="Bad_Status[<?php echo $i;?>]" class="minimal" value="2" ></td>
								  <td layout="block" style="text-align: center;"><input type="radio" name="Bad_Status[<?php echo $i;?>]" class="minimal" value="3" ></td>
								  <input type="hidden" name="StuID[<?php echo $i;?>]"  value="<?php echo @$arr['num']['stu_id'];?>">
								  <input type="hidden" name="rank"  value="<?php echo $i;?>">
								</tr>

								<?php $i++;} ?>
							  </tbody>
							  </table>
												<div class="form-group">
												<div class="col-sm-4" >
												<br>
												</div>
												</div>


								<?php } else { ?>
								<table>
								<tr>
								  <td class="center" colspan="6"><?php echo _text_no_results; ?></td>
								</tr>
								</table>
								<?php } ?>

							<input type="hidden" name="OP"  value="Add">
							<input type="hidden" name="ClassID"  value="<?=$_SESSION['person_class'];?>">
							<input type="hidden" name="Stu_cn"  value="<?=$_SESSION['person_cn'];?>">

						</form>

		</div>
        <div class="tab-pane fade in" id="tab3">


				<form method="post" action="index.php?name=behavior&file=bclass&op=AddTab3&route=<?php echo $route;?>" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
							<div class="col-xs-12" align="center" >
							<h4 class="box-title"><?php if($_SESSION['person_school'] =='44012028'){ echo "เพิ่มกิจกรรม Rivision";} else {echo _heading_title_M_tab3;}?></h4>
							</div>

							<div class="col-xs-12" align="right" >
							<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=bclass&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
							  </div>
							 </div>
							<div class="form-group">
							<div class="col-sm-12" >
							</div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_birth; ?></label>
							<div class="col-sm-3" >
							<?php $DateTimeStart=date('Y-m-d');?>
							<div class="input-group date" id="dp3" data-date="<?php echo $DateTimeStart;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control" id="DateID" name="DateID" class="form-control css-require" value="<?php echo $DateTimeStart;?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>

						  <?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							@$res['num'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_class='".$_SESSION['person_class']."' and stu_cn='".$_SESSION['person_cn']."' and stu_suspend='0' order by id"); 
							@$rows['num'] = $db->rows(@$res['num']);
							if(@$rows['num']) {
							?>
							<table id="example3" class="table table-bordered table-striped responsive" style="width:100%">
							  <thead>
								<tr >
								  <th width="1" style="text-align: center;"></th>
								  <th layout="block" style="text-align:center;" ><?php echo _text_box_table_tab1_stu_id; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab1_stu_name; ?></th>
								  <th layout="block" style="text-align:center;">ห้อง</th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab1_status1; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab1_status2;?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab1_status3;?></th>
								</tr>
							  </thead>
							  <tbody>
							<?php
							$i=1;
							while (@$arr['num'] = $db->fetch(@$res['num'])){
							?>
								<tr>
								  <td style="text-align: center;"><?php echo $i;?></td>
								  <td layout="block" style="text-align: center;"><?php echo @$arr['num']['stu_id'];?></td>
								  <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur']; ?></td>
								  <td layout="block" style="text-align: center;"><?php echo @$arr['num']['stu_cn']; ?></td>
								  <td layout="block" style="text-align: center;"><input type="radio" name="Bad_Status[<?php echo $i;?>]" class="minimal" value="1" ></td>
								  <td layout="block" style="text-align: center;"><input type="radio" name="Bad_Status[<?php echo $i;?>]" class="minimal" value="2" ></td>
								  <td layout="block" style="text-align: center;"><input type="radio" name="Bad_Status[<?php echo $i;?>]" class="minimal" value="3" ></td>
								  <input type="hidden" name="StuID[<?php echo $i;?>]"  value="<?php echo @$arr['num']['stu_id'];?>">
								  <input type="hidden" name="rank"  value="<?php echo $i;?>">
								</tr>

								<?php $i++;} ?>
							  </tbody>
							  </table>
												<div class="form-group">
												<div class="col-sm-4" >
												<br>
												</div>
												</div>


								<?php } else { ?>
								<table>
								<tr>
								  <td class="center" colspan="6"><?php echo _text_no_results; ?></td>
								</tr>
								</table>
								<?php } ?>

							<input type="hidden" name="OP"  value="Add">
							<input type="hidden" name="ClassID"  value="<?=$_SESSION['person_class'];?>">
							<input type="hidden" name="Stu_cn"  value="<?=$_SESSION['person_cn'];?>">


						</form>

        </div>


							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Add">
							<br>
							</div>
							</div>

							</div>
						</div>


</div>
</div>



<script type="text/javascript">
		$(function(){
			$('#dp1').datepicker();
			$('#dp2').datepicker();
			$('#dp3').datepicker();
			$('#dp4').datepicker();
         });
</script>
        <script type="text/javascript">
        $(document).ready(function() {
        var aoColumns = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 5 */ { "bSortable": true , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
								"aoColumns": aoColumns,
								"pageLength" : 50,
								"responsive" : true,
								});
                oTable = $("#example2").dataTable({
								"aoColumns": aoColumns,
								"pageLength" : 50,
								"responsive" : true,
								});
                oTable = $("#example3").dataTable({
								"aoColumns": aoColumns,
								"pageLength" : 50,
								"responsive" : true,
								});
            });
        </script>
        <script type="text/javascript">
			$(document).ready(function ($) {
				$('input').iCheck({
					checkboxClass: 'icheckbox_minimal-red',
					radioClass: 'iradio_minimal-red'
				});

				$('input.all').on('ifToggled', function (event) {
					var chkToggle;
					$(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
					$('input.selector:not(.all)').iCheck(chkToggle);
				});
			});
        </script>

<?php } else { echo "<meta http-equiv='refresh' content='0; url=index.php'>"; }?>

