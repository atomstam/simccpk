<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
$add='';
$success='';
$error_warning='';
if(!empty($_SESSION['person_login'])){
$Mtime=time();
if($op=='AddTab4'){
	list($Y , $m , $d) = explode("-" , $_POST['DateID']);
	$y=$Y+543;
	
	$RANK=$rank+1;					

	for ($i=0; $i < $RANK; $i++) {
		if(isset($_POST['StuID'][$i])){
		if(empty($_POST['Ck1'][$i])){
		if(isset($_POST['Ch1'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec1;
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
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch1"=>"".$_POST['Ch1'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch1"=>"".$_POST['Ch1'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		}

		if(isset($_POST['Ch2'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec2;
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
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch2"=>"".$_POST['Ch2'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch2"=>"".$_POST['Ch2'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		}

		if(isset($_POST['Ch3'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec3;
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
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch3"=>"".$_POST['Ch3'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch3"=>"".$_POST['Ch3'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		}

		if(isset($_POST['Ch4'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec4;
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
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch4"=>"".$_POST['Ch4'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch4"=>"".$_POST['Ch4'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		}

		if(isset($_POST['Ch5'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec5;
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
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch5"=>"".$_POST['Ch5'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch5"=>"".$_POST['Ch5'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		}

		if(isset($_POST['Ch6'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec6;
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
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch6"=>"".$_POST['Ch6'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch6"=>"".$_POST['Ch6'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		}

		if(isset($_POST['Ch7'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec7;
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
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch7"=>"".$_POST['Ch7'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch7"=>"".$_POST['Ch7'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
			));
		}
		}
		} else {
				if($_POST['Ck1'][$i] =='1'){
					$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."'  and badtail_name='ขาดเรียน' ");
					@$result=$db->fetch($sql);
					$Bad_tail=_text_box_table_tab4_value_kad;
					$btailid=@$result['badtail_id'];

					
				$add .=$db->del(TB_BAD," bad_area='".$_SESSION['person_area']."' and bad_code='".$_SESSION['person_school']."' and bad_stu='".$_POST['StuID'][$i]."' and b_date='".$_POST['DateID']."' ");
				$add .=$db->del(TB_CHCLASS," c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' ");
				$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['person_area']."",
				"bad_code"=>"".$_SESSION['person_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>""._text_box_table_tab4_value_kad."",
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

				@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
				@$arr['chclass'] = $db->fetch(@$res['chclass']);
				if(@$arr['chclass']['c_id']){
				$CID=@$arr['chclass']['c_id'];
				$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k"=>"",
				"c_k2"=>"",
				"c_k3"=>"",
				"c_k4"=>""._text_box_table_tab4_value_kad."",
				"c_ch1"=>"",
				"c_ch2"=>"",
				"c_ch3"=>"",
				"c_ch4"=>"",
				"c_ch5"=>"",
				"c_ch6"=>"",
				"c_ch7"=>"",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
				)," c_id=".$CID." ");
				} else {
				$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k4"=>""._text_box_table_tab4_value_kad."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
				));
				}			
				}
				if($_POST['Ck1'][$i] =='2'){
				$add .=$db->del(TB_BAD," bad_area='".$_SESSION['person_area']."' and bad_code='".$_SESSION['person_school']."' and bad_stu='".$_POST['StuID'][$i]."' and b_date='".$_POST['DateID']."' ");
				$add .=$db->del(TB_CHCLASS," c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' ");
				@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
				@$arr['chclass'] = $db->fetch(@$res['chclass']);
				if(@$arr['chclass']['c_id']){
				$CID=@$arr['chclass']['c_id'];
				$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k"=>"",
				"c_k2"=>"",
				"c_k3"=>"",
				"c_k4"=>""._text_box_table_tab4_value_la."",
				"c_ch1"=>"",
				"c_ch2"=>"",
				"c_ch3"=>"",
				"c_ch4"=>"",
				"c_ch5"=>"",
				"c_ch6"=>"",
				"c_ch7"=>"",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>$_SESSION['person_login']
				)," c_id=".$CID." ");
				} else {
				$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['person_area']."",
				"c_code"=>"".$_SESSION['person_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k4"=>""._text_box_table_tab4_value_la."",
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

								<form method="post" action="index.php?name=academic&file=mclass&op=AddTab4&route=<?php echo $route;?>" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
								<div class="col-xs-12" align="center" >
								<h4 class="box-title"><?php echo _heading_title_M_tab4; ?></h4>
								</div>

							<div class="col-xs-12" align="right" >
							<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=academic&file=mclass&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
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
							<div class="input-group date" id="dp4" data-date="<?php echo $DateTimeStart;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control" id="DateID" name="DateID" class="form-control css-require" value="<?php echo $DateTimeStart;?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>


						  <?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							@$res['num'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_class='".$_SESSION['person_class']."' and stu_cn='".$_SESSION['person_cn']."' and stu_suspend='0' order by id,stu_id"); 
							@$rows['num'] = $db->rows(@$res['num']);
							if(@$rows['num']) {
							?>
							<table id="example4" class="table table-bordered table-striped responsive" style="width:100%">
							  <thead>
								<tr >
								  <th width="1" style="text-align: center;"></th>
								  <th layout="block" style="text-align:center;" >รหัส</th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_stu_name; ?></th>
								  <th layout="block" style="text-align:center;">ห้อง</th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_kad; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_la; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec1; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec2; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec3; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec4; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec5; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec6; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec7; ?></th>
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
								  <td layout="block" style="text-align: center;"><input type="radio" name="Ck1[<?php echo $i;?>]" class="minimal" value="1" ></td>
								  <td layout="block" style="text-align: center;"><input type="radio" name="Ck1[<?php echo $i;?>]" class="minimal" value="2" ></td>
								  <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch1[<?php echo $i;?>]" class="minimal" value="1"  id="checkbox"></td>
								  <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch2[<?php echo $i;?>]" class="minimal" value="2"  id="checkbox"></td>
								  <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch3[<?php echo $i;?>]" class="minimal" value="3"  id="checkbox"></td>
								  <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch4[<?php echo $i;?>]" class="minimal" value="4"  id="checkbox"></td>
								  <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch5[<?php echo $i;?>]" class="minimal" value="5"  id="checkbox"></td>
								  <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch6[<?php echo $i;?>]" class="minimal" value="6"  id="checkbox"></td>
								  <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch7[<?php echo $i;?>]" class="minimal" value="7"  id="checkbox"></td>
								  <input type="hidden" name="StuID[<?php echo $i;?>]"  value="<?php echo @$arr['num']['stu_id'];?>">
								  <input type="hidden" name="rank"  value="<?php echo $i;?>">
								</tr>

								<?php $i++;} ?>
							  </tbody>
							  </table>
												<div class="form-group">
												<div class="col-sm-4" ><input type="hidden" name="OP"  value="Add"><input type="hidden" name="DateID"  value="<?php echo $_GET['date_id'];?>"><input type="hidden" name="ClassID"  value="<?php echo $_GET['class_id'];?>">
												<br>
												</div>
												</div>


								<?php } else { ?>
								<table>
								<tr>
								  <td class="center" colspan="12"><?php echo _text_no_results; ?></td>
								</tr>
								</table>
								<?php } ?>

							<input type="hidden" name="OP"  value="Add">
							<input type="hidden" name="ClassID"  value="<?=$_SESSION['person_class'];?>">
							<input type="hidden" name="Stu_cn"  value="<?=$_SESSION['person_cn'];?>">

						</form>

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
                              /* 3 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 5 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 6 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 7 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 7 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 8 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 9 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 10 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 11 */ { "bSortable": true , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example4").dataTable({
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
