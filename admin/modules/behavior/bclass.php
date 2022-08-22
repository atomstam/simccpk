<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
$add='';
$success='';
$error_warning='';
?>

<?php
if(!empty($_SESSION['admin_login'])){
$Mtime=date("H:i:s");
if($op=='AddTab1'){

@$res['chkclass'] = $db->select_query("SELECT * FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['admin_area']."' and chk_code='".$_SESSION['admin_school']."'  and chk_class='".$_POST['ClassID']."' and chk_cn='".$_POST['Stu_cn']."' and chk_gr='1' and chk_date='".$_POST['Date_id']."' "); 
@$arr['chkclass'] = $db->rows(@$res['chkclass']);
if($arr['chkclass']==0){

	list($Y , $m , $d) = explode("-" , $_POST['Date_id']);
	$y=$Y+543;
	
	@$RANK=count($_POST['rank'])+1;					

	for ($i=1; $i < $_POST['rank']; $i++) {

		if(isset($_POST['StuID'][$i])){
			
		$sq4=$db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_stu='".$_POST['StuID'][$i]."' and b_date='".$_POST['Date_id']."' ");
		@$result4=$db->fetch($sq4);

		if(@$result4['bad_name'] !='ไม่มาโรงเรียน' && @$result4['bad_name'] !='ลาโรงเรียน' ){
		if($_POST['Bad_Status'][$i]=='1'){

			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'  and badtail_name like '%ไม่มาเคารพธงชาติ%' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_add_tab1_badtail_name_kad;
			$btailid=@$result['badtail_id'];
			$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['admin_area']."",
				"bad_code"=>"".$_SESSION['admin_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>$_SESSION['admin_login'],
				"bad_t"=>"1",
				"b_date"=>"".$_POST['Date_id']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>$_SESSION['admin_login'],
				"role"=>"1"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['Date_id'].""
			)," b_date='0000-00-00" );

				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'  and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				//@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				//print_r(@$resx);

		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['Date_id']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id']."",
				"c_note"=>$_SESSION['admin_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id']."",
				"c_note"=>$_SESSION['admin_login']
			));
		}


		} else if($_POST['Bad_Status'][$i]=='3'){
			$Bad_tail=_text_add_tab1_badtail_name_sai;
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'   and badtail_name like '%มาสาย%' ");
			@$result=$db->fetch($sql);
			$btailid=@$result['badtail_id'];
			$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['admin_area']."",
				"bad_code"=>"".$_SESSION['admin_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>$_SESSION['admin_login'],
				"bad_t"=>"1",
				"b_date"=>"".$_POST['Date_id']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>$_SESSION['admin_login'],
				"role"=>"1"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['Date_id'].""
			)," b_date='0000-00-00" );

				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'  and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				//@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				//print_r(@$resx);

		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['Date_id']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id']."",
				"c_note"=>$_SESSION['admin_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id']."",
				"c_note"=>$_SESSION['admin_login']
			));
		}


		} else if($_POST['Bad_Status'][$i]=='2'){
			$Bad_tail=_text_add_tab1_badtail_name_la;
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['Date_id']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id']."",
				"c_note"=>$_SESSION['admin_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id']."",
				"c_note"=>$_SESSION['admin_login']
			));
		}
		}// $_POST['Bad_Status'][$i]
		} //@$result4['bad_name'] ไม่มา
		} // stu id
   } // Rank

		@$res['chkclass'] = $db->select_query("SELECT * FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['admin_area']."' and chk_code='".$_SESSION['admin_school']."'  and chk_class='".$_POST['ClassID']."' and chk_cn='".$_POST['Stu_cn']."' and chk_gr='1' and chk_date='".$_POST['Date_id']."' "); 
		@$arr['chkclass'] = $db->fetch(@$res['chkclass']);
		if(!$arr['chkclass']['chk_id']){
			$add .=$db->add_db(TB_CHK_CHCLASS,array(
				"chk_area"=>"".$_SESSION['admin_area']."",
				"chk_code"=>"".$_SESSION['admin_school']."",
				"chk_gr"=>"1",
				"chk_class"=>"".$_POST['ClassID']."",
				"chk_cn"=>"".$_POST['Stu_cn']."",
				"chk_date"=>"".$_POST['Date_id']."",
				"chk_datetime"=>"".date("Y-m-d H:i:s")."",
				"chk_note"=>$_SESSION['admin_login']
			));
		} else {
			$add="x";
		}

//		$add.=$db->del(TB_CLASS," class_id='".$_GET['class_id']."' ");
//		$add .=$_POST['ClassID']."<br>";
//		$add .=$_POST['Date_id']."<br>";
//		$add .=$_POST['StuID']."<br>";
//echo $add;
    	if($add){
		$success =_text_report_add_ok;
		} else {
		$error_warning=_text_report_add_fail;
		}

} else {

		$error_warning= "คุณได้ทำการบันทึกรายการนี้แล้ว";
}


} 


if($op=='AddTab2'){

@$res['chkclass'] = $db->select_query("SELECT * FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['admin_area']."' and chk_code='".$_SESSION['admin_school']."'  and chk_class='".$_POST['ClassID']."' and chk_cn='".$_POST['Stu_cn']."' and chk_gr='2' and chk_date='".$_POST['Date_id2']."' "); 
@$arr['chkclass'] = $db->rows(@$res['chkclass']);
if($arr['chkclass']==0){

	list($Y , $m , $d) = explode("-" , $_POST['Date_id2']);
	$y=$Y+543;
	
	@$RANK=count($_POST['rank'])+1;					

	for ($i=1; $i < $_POST['rank']; $i++) {
		if(isset($_POST['StuID'][$i])){
		$sq4=$db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_stu='".$_POST['StuID'][$i]."' and b_date='".$_POST['Date_id2']."' ");
		@$result4=$db->fetch($sq4);
		if(@$result4['bad_name'] !='ไม่มาโรงเรียน' && @$result4['bad_name'] !='ลาโรงเรียน' ){
		if($_POST['Bad_Status'][$i]=='1'){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'  and badtail_name like '%ไม่ร่วมกิจกรรมโรงเรียน%' ");
			@$result=$db->fetch($sql);
			if($_SESSION['person_school'] =='44012028'){ 
				$Bad_tail="ไม่ร่วมกิจกรรม MindSet";
				//เพิ่มกิจกรรม Rivision
			} else {
				$Bad_tail=_text_add_tab2_badtail_name_kad;
			}
			//$Bad_tail=_text_add_tab2_badtail_name_kad;
			$btailid=@$result['badtail_id'];
			$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['admin_area']."",
				"bad_code"=>"".$_SESSION['admin_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>$_SESSION['admin_login'],
				"bad_t"=>"1",
				"b_date"=>"".$_POST['Date_id2']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>$_SESSION['admin_login']
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['Date_id2'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'  and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				//@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				//print_r(@$resx);

		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['Date_id2']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k2"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id2']."",
				"c_note"=>$_SESSION['admin_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k2"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id2']."",
				"c_note"=>$_SESSION['admin_login']
			));
		}
		} else if($_POST['Bad_Status'][$i]=='3'){
			//$Bad_tail=_text_add_tab2_badtail_name_sai;
			if($_SESSION['person_school'] =='44012028'){ 
				$Bad_tail="มาร่วมกิจกรรม MindSet สาย";
				//เพิ่มกิจกรรม Rivision
			} else {
				$Bad_tail=_text_add_tab2_badtail_name_sai;
			}
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'  and badtail_name like '%มาสาย%' ");
			@$result=$db->fetch($sql);
			$btailid=@$result['badtail_id'];
			$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['admin_area']."",
				"bad_code"=>"".$_SESSION['admin_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>"".$_SESSION['admin_login']."",
				"bad_t"=>"1",
				"b_date"=>"".$_POST['Date_id2']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>$_SESSION['admin_login']
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['Date_id2'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'  and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				//@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				//print_r(@$resx);
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['Date_id2']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k2"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id2']."",
				"c_note"=>$_SESSION['admin_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k2"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id2']."",
				"c_note"=>$_SESSION['admin_login']
			));
		}
		} else if($_POST['Bad_Status'][$i]=='2'){

			if($_SESSION['person_school'] =='44012028'){ 
				$Bad_tail="ลากิจกรรม Midset";
				//เพิ่มกิจกรรม Midset
			} else {
				$Bad_tail=_text_add_tab2_badtail_name_la;
			}

		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['Date_id2']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k2"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id2']."",
				"c_note"=>$_SESSION['admin_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k2"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id2']."",
				"c_note"=>$_SESSION['admin_login']
			));
		}
		}
		}
		}
   }

		@$res['chkclass'] = $db->select_query("SELECT * FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['admin_area']."' and chk_code='".$_SESSION['admin_school']."'  and chk_class='".$_POST['ClassID']."' and chk_cn='".$_POST['Stu_cn']."' and chk_gr='2' and chk_date='".$_POST['Date_id2']."' "); 
		@$arr['chkclass'] = $db->fetch(@$res['chkclass']);
		if(!$arr['chkclass']['chk_id']){
			$add .=$db->add_db(TB_CHK_CHCLASS,array(
				"chk_area"=>"".$_SESSION['admin_area']."",
				"chk_code"=>"".$_SESSION['admin_school']."",
				"chk_gr"=>"2",
				"chk_class"=>"".$_POST['ClassID']."",
				"chk_cn"=>"".$_POST['Stu_cn']."",
				"chk_date"=>"".$_POST['Date_id2']."",
				"chk_datetime"=>"".date("Y-m-d H:i:s")."",
				"chk_note"=>$_SESSION['admin_login']
			));
		} else {
			$add="x";
		}

//		$add.=$db->del(TB_CLASS," class_id='".$_GET['class_id']."' ");
//		$add .=$_POST['ClassID']."<br>";
//		$add .=$_POST['Date_id']."<br>";
//		$add .=$_POST['StuID']."<br>";
//echo $add;
    	if($add){
		$success =_text_report_add_ok;
		} else {
		$error_warning=_text_report_add_fail;
		}

} else {

		$error_warning= "คุณได้ทำการบันทึกรายการนี้แล้ว";
}

} 



if($op=='AddTab3'){

@$res['chkclass'] = $db->select_query("SELECT * FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['admin_area']."' and chk_code='".$_SESSION['admin_school']."'  and chk_class='".$_POST['ClassID']."' and chk_cn='".$_POST['Stu_cn']."' and chk_gr='3' and chk_date='".$_POST['Date_id3']."' "); 
@$arr['chkclass'] = $db->rows(@$res['chkclass']);
if($arr['chkclass']==0){

	list($Y , $m , $d) = explode("-" , $_POST['Date_id3']);
	$y=$Y+543;
	
	@$RANK=count($rank2)+1;					

	for ($i=1; $i < $_POST['rank']; $i++) {
		if(isset($_POST['StuID'][$i])){
		$sq4=$db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_stu='".$_POST['StuID'][$i]."' and b_date='".$_POST['Date_id3']."' ");
		@$result4=$db->fetch($sq4);
		if(@$result4['bad_name'] !='ไม่มาโรงเรียน' && @$result4['bad_name'] !='ลาโรงเรียน' ){
		if($_POST['Bad_Status'][$i]=='1'){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'  and badtail_name like '%ไม่ร่วมกิจกรรมโรงเรียน%' ");
			@$result=$db->fetch($sql);
			if($_SESSION['person_school'] =='44012028'){ 
				$Bad_tail="ไม่ร่วมกิจกรรม Rivision";
				//เพิ่มกิจกรรม Rivision
			} else {
				$Bad_tail=_text_add_tab3_badtail_name_kad;
			}
			//$Bad_tail=_text_add_tab3_badtail_name_kad;
			$btailid=@$result['badtail_id'];
			$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['admin_area']."",
				"bad_code"=>"".$_SESSION['admin_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>$_SESSION['admin_login'],
				"bad_t"=>"1",
				"b_date"=>"".$_POST['Date_id3']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>$_SESSION['admin_login']
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['Date_id3'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'  and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				//@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				//print_r(@$resx);
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['Date_id3']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k3"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id3']."",
				"c_note"=>$_SESSION['admin_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k3"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id3']."",
				"c_note"=>$_SESSION['admin_login']
			));
		}
		} else if($_POST['Bad_Status'][$i]=='3'){
			//$Bad_tail=_text_add_tab3_badtail_name_sai;
			if($_SESSION['person_school'] =='44012028'){ 
				$Bad_tail="มาร่วมกิจกรรม Rivision สาย";
				//เพิ่มกิจกรรม Rivision
			} else {
				$Bad_tail=_text_add_tab3_badtail_name_sai;
			}
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'  and badtail_name like '%มาสาย%' ");
			@$result=$db->fetch($sql);
			$btailid=@$result['badtail_id'];
			$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['admin_area']."",
				"bad_code"=>"".$_SESSION['admin_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>"".$Bad_tail."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>$_SESSION['admin_login'],
				"bad_t"=>"1",
				"b_date"=>"".$_POST['Date_id3']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>$_SESSION['admin_login']
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['Date_id3'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."'  and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);

				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				//@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				//print_r(@$resx);
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['Date_id3']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k3"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id3']."",
				"c_note"=>$_SESSION['admin_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k3"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id3']."",
				"c_note"=>$_SESSION['admin_login']
			));
		}
		} else if($_POST['Bad_Status'][$i]=='2'){

			if($_SESSION['person_school'] =='44012028'){ 
				$Bad_tail="ลากิจกรรม Rivision";
				//เพิ่มกิจกรรม Rivision
			} else {
				$Bad_tail=_text_add_tab3_badtail_name_la;
			}

		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['Date_id3']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			if(@$arr['chclass']['c_k4'] ==''){
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k3"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id3']."",
				"c_note"=>$_SESSION['admin_login']
			)," c_id=".$CID." ");
			}
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_cn"=>"".$_POST['Stu_cn']."",
				"c_k3"=>"".$Bad_tail."",
				"c_date"=>"".$_POST['Date_id3']."",
				"c_note"=>$_SESSION['admin_login']
			));
		}
		}
		}
		}
   }

		@$res['chkclass'] = $db->select_query("SELECT * FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['admin_area']."' and chk_code='".$_SESSION['admin_school']."'  and chk_class='".$_POST['ClassID']."' and chk_cn='".$_POST['Stu_cn']."' and chk_gr='3' and chk_date='".$_POST['Date_id3']."' "); 
		@$arr['chkclass'] = $db->fetch(@$res['chkclass']);
		if(!$arr['chkclass']['chk_id']){
			$add .=$db->add_db(TB_CHK_CHCLASS,array(
				"chk_area"=>"".$_SESSION['admin_area']."",
				"chk_code"=>"".$_SESSION['admin_school']."",
				"chk_gr"=>"3",
				"chk_class"=>"".$_POST['ClassID']."",
				"chk_cn"=>"".$_POST['Stu_cn']."",
				"chk_date"=>"".$_POST['Date_id3']."",
				"chk_datetime"=>"".date("Y-m-d H:i:s")."",
				"chk_note"=>$_SESSION['admin_login']
			));
		} else {
			$add="x";
		}

//		$add.=$db->del(TB_CLASS," class_id='".$_GET['class_id']."' ");
//		$add .=$_POST['ClassID']."<br>";
//		$add .=$_POST['Date_id']."<br>";
//		$add .=$_POST['StuID']."<br>";
//echo $add;
    	if($add){
		$success =_text_report_add_ok;
		} else {
		$error_warning=_text_report_add_fail;
		}

} else {

		$error_warning= "คุณได้ทำการบันทึกรายการนี้แล้ว";
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
                <div class="hidden-xs"><?php if($_SESSION['admin_school'] =='44012028'){ echo "กิจกรรม MindSet";} else {echo _heading_title_M_tab2;}?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                <div class="hidden-xs"><?php if($_SESSION['admin_school'] =='44012028'){ echo "กิจกรรม Rivision";} else {echo _heading_title_M_tab3;}?></div>
            </button>
        </div>
    </div>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="tab1">


<script type="text/javascript">
$(function(){
 $("select#classlist").change(function(){
  var datalist1 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist2
     url: "modules/behavior/classlist.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data :{
         "class_cn" : $(this).val(),
         "class_id" : $('#Stu_class').val(),
         "date_id" : $('#Date_id').val(),
     },
	// data:"class_id="+$(this).val()+"&date_id="+Date_id, // ส่งตัวแปร GET ชื่อ province ให้มีค่าเท่ากับ ค่าของ province
     async: false
  }).responseText;  
  $("div#Classlist").html(datalist1); // นำค่า datalist2 มาแสดงใน listbox ที่ 2 ที่ชื่อ amphur
//window.alert( $('#Date_id').val() );
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });
});

</script>



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
							<input type='text' class="form-control" id="Date_id" name="Date_id" class="form-control css-require" value="<?php echo $DateTimeStart;?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>
						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_class; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" id="Stu_class" name="Stu_class" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_class_select;?></option>
							<?php
							
							@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." ORDER BY class_id ");
							while (@$arr['class'] = $db->fetch(@$res['class'])){
							echo "<option value=\"".@$arr['class']['class_id']."\"";
							echo ">".@$arr['class']['class_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" >ห้อง</label>
							<div class="col-sm-2">
							<select class="form-control css-require" id="classlist" name="Stu_cn" required="required">
							<option value="" selected disabled>เลือกห้องเรียน</option>
							<?php
							for($i=1;$i<=3;$i++){
							echo "<option value=\"".$i."\"";
							echo ">".$i."</option>";
							}
							?>
							</select>
							</div>
							</div>	

							<div id="Classlist" ></div>
						</form>

		</div>
		<div class="tab-pane fade in" id="tab2">




<script type="text/javascript">
$(function(){
 $("select#classlist2").change(function(){
  var datalist2 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist2
     url: "modules/behavior/classlist2.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data :{
         "class_cn" : $(this).val(),
         "class_id" : $('#Stu_class2').val(),
         "date_id" : $('#Date_id2').val(),
     },
	// data:"class_id="+$(this).val()+"&date_id="+Date_id, // ส่งตัวแปร GET ชื่อ province ให้มีค่าเท่ากับ ค่าของ province
     async: false
  }).responseText;  
  $("div#Classlist2").html(datalist2); // นำค่า datalist2 มาแสดงใน listbox ที่ 2 ที่ชื่อ amphur
//window.alert( $('#Date_id').val() );
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });
});

</script>



				<form method="post" action="index.php?name=behavior&file=bclass&op=AddTab2&route=<?php echo $route;?>" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
		<div class="col-xs-12" align="center" >
		<h4 class="box-title"><?php if($_SESSION['admin_school'] =='44012028'){ echo "เพิ่มกิจกรรม MindSet";} else {echo _heading_title_M_tab2;}?></h4>
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
							<input type='text' class="form-control" id="Date_id2" name="Date_id2" class="form-control css-require" value="<?php echo $DateTimeStart;?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>
						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_class; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" id="Stu_class2" name="Stu_class2" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_class_select;?></option>
							<?php
							
							@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." ORDER BY class_id ");
							while (@$arr['class'] = $db->fetch(@$res['class'])){
							echo "<option value=\"".@$arr['class']['class_id']."\"";
							echo ">".@$arr['class']['class_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" >ห้อง</label>
							<div class="col-sm-2">
							<select class="form-control css-require" id="classlist2" name="Stu_cn2" required="required">
							<option value="" selected disabled>เลือกห้องเรียน</option>
							<?php
							for($i=1;$i<=3;$i++){
							echo "<option value=\"".$i."\"";
							echo ">".$i."</option>";
							}
							?>
							</select>
							</div>
							</div>	
							<div id="Classlist2" ></div>
						</form>

		</div>
        <div class="tab-pane fade in" id="tab3">


<script type="text/javascript">
$(function(){
 $("select#classlist3").change(function(){
  var datalist3 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist2
     url: "modules/behavior/classlist3.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data :{
         "class_cn" : $(this).val(),
         "class_id" : $('#Stu_class3').val(),
         "date_id" : $('#Date_id3').val(),
     },
	// data:"class_id="+$(this).val()+"&date_id="+Date_id, // ส่งตัวแปร GET ชื่อ province ให้มีค่าเท่ากับ ค่าของ province
     async: false
  }).responseText;  
  $("div#Classlist3").html(datalist3); // นำค่า datalist2 มาแสดงใน listbox ที่ 2 ที่ชื่อ amphur
//window.alert( $('#Date_id').val() );
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });
});

</script>



				<form method="post" action="index.php?name=behavior&file=bclass&op=AddTab3&route=<?php echo $route;?>" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
		<div class="col-xs-12" align="center" >
		<h4 class="box-title"><?php if($_SESSION['admin_school'] =='44012028'){ echo "เพิ่มกิจกรรม Rivision";} else {echo _heading_title_M_tab3;}?></h4>
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
							<input type='text' class="form-control" id="Date_id3" name="Date_id3" class="form-control css-require" value="<?php echo $DateTimeStart;?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>
						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_class; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" id="classlist3" name="Stu_class3" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_class_select;?></option>
							<?php
							
							@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." ORDER BY class_id ");
							while (@$arr['class'] = $db->fetch(@$res['class'])){
							echo "<option value=\"".@$arr['class']['class_id']."\"";
							echo ">".@$arr['class']['class_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" >ห้อง</label>
							<div class="col-sm-2">
							<select class="form-control css-require" id="classlist3" name="Stu_cn3" required="required">
							<option value="" selected disabled>เลือกห้องเรียน</option>
							<?php
							for($i=1;$i<=3;$i++){
							echo "<option value=\"".$i."\"";
							echo ">".$i."</option>";
							}
							?>
							</select>
							</div>
							</div>	
							<div id="Classlist3" ></div>
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


<?php } else { echo "<meta http-equiv='refresh' content='0; url=index.php'>"; }?>

