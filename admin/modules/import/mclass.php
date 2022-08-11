<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
$add='';
$success='';
$error_warning='';
?>

<?php
if(!empty($_SESSION['admin_login'])){
$Mtime=time();
if($op=='AddTab4'){
	list($Y , $m , $d) = explode("-" , $_POST['DateID']);
	$y=$Y+543;
	
	$RANK=$rank+1;					

	for ($i=0; $i < $RANK; $i++) {
		if(isset($_POST['StuID'][$i])){
		if(empty($_POST['Ck1'][$i])){
		if(isset($_POST['Ch1'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec1;
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
				"bad_dam"=>"admin",
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>"admin"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				print_r(@$resx);

		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch1"=>"".$_POST['Ch1'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch1"=>"".$_POST['Ch1'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			));
		}
		}

		if(isset($_POST['Ch2'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec2;
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
				"bad_dam"=>"admin",
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>"admin"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				print_r(@$resx);
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch2"=>"".$_POST['Ch2'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch2"=>"".$_POST['Ch2'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			));
		}
		}

		if(isset($_POST['Ch3'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec3;
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
				"bad_dam"=>"admin",
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>"admin"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				print_r(@$resx);
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch3"=>"".$_POST['Ch3'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch3"=>"".$_POST['Ch3'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			));
		}
		}

		if(isset($_POST['Ch4'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec4;
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
				"bad_dam"=>"admin",
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>"admin"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				print_r(@$resx);
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch4"=>"".$_POST['Ch4'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch4"=>"".$_POST['Ch4'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			));
		}
		}

		if(isset($_POST['Ch5'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec5;
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
				"bad_dam"=>"admin",
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>"admin"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				print_r(@$resx);
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch5"=>"".$_POST['Ch5'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch5"=>"".$_POST['Ch5'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			));
		}
		}

		if(isset($_POST['Ch6'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec6;
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
				"bad_dam"=>"admin",
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>"admin"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				print_r(@$resx);
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch6"=>"".$_POST['Ch6'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch6"=>"".$_POST['Ch6'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			));
		}
		}

		if(isset($_POST['Ch7'][$i])){
			$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_name='หนีเรียน' ");
			@$result=$db->fetch($sql);
			$Bad_tail=_text_box_table_tab4_value_sec7;
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
				"bad_dam"=>"admin",
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>"admin"
			));
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );
				@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_POST['StuID'][$i]."' "); 
				@$arr['stu'] = $db->fetch(@$res['stu']);
				@$res['B'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_id='".$btailid."' "); 
				@$arr['B'] = $db->fetch(@$res['B']);
				@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_group='".@$arr['stu']['stu_class']."' and clg_name='".@$arr['stu']['stu_cn']."' "); 
				@$arr['cl'] = $db->fetch(@$res['cl']);
				$message= @$arr['stu']['stu_name']." ".@$arr['B']['badtail_name']."(-".@$arr['B']['badtail_point'].")";
				$Token=@$arr['cl']['clg_LineId'];
				@$resx = Line_To_Class(@$arr['cl']['clg_group'],@$arr['cl']['clg_name'],$message,$Token);
				print_r(@$resx);
		@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
		@$arr['chclass'] = $db->fetch(@$res['chclass']);
		if(@$arr['chclass']['c_id']){
			$CID=@$arr['chclass']['c_id'];
			$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch7"=>"".$_POST['Ch7'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			)," c_id=".$CID." ");
		} else {
			$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_ch7"=>"".$_POST['Ch7'][$i]."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
			));
		}
		}
		} else {
				if($_POST['Ck1'][$i] =='1'){
					$sql=$db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' or badtail_area='' and badtail_code='' and badtail_name='ขาดเรียน' ");
					@$result=$db->fetch($sql);
					$Bad_tail=_text_box_table_tab4_value_kad;
					$btailid=@$result['badtail_id'];

					
				$add .=$db->del(TB_BAD," bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_stu='".$_POST['StuID'][$i]."' and b_date='".$_POST['DateID']."' ");
				$add .=$db->del(TB_CHCLASS," c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' ");
				$add .=$db->add_db(TB_BAD,array(
				"bad_area"=>"".$_SESSION['admin_area']."",
				"bad_code"=>"".$_SESSION['admin_school']."",
				"bad_stu"=>"".$_POST['StuID'][$i]."",
				"bad_tail"=>"".$btailid."",
				"bad_name"=>""._text_box_table_tab4_value_kad."",
				"bad_date"=>"".$d."",
				"bad_mouth"=>"".$m."",
				"bad_year"=>"".$y."",
				"bad_dam"=>"admin",
				"bad_t"=>"1",
				"b_date"=>"".$_POST['DateID']."",
				"b_Mtime"=>"".$Mtime."",
				"bad_sess"=>"admin"
				));	
			$add .=$db->update_db(TB_BAD,array(
				"b_date"=>"".$_POST['DateID'].""
			)," b_date='0000-00-00" );

				@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
				@$arr['chclass'] = $db->fetch(@$res['chclass']);
				if(@$arr['chclass']['c_id']){
				$CID=@$arr['chclass']['c_id'];
				$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
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
				"c_note"=>"admin"
				)," c_id=".$CID." ");
				} else {
				$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k4"=>""._text_box_table_tab4_value_kad."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
				));
				}			
				}
				if($_POST['Ck1'][$i] =='2'){
				$add .=$db->del(TB_BAD," bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_stu='".$_POST['StuID'][$i]."' and b_date='".$_POST['DateID']."' ");
				$add .=$db->del(TB_CHCLASS," c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' ");
				@$res['chclass'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." WHERE c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_stu='".$_POST['StuID'][$i]."' and c_date='".$_POST['DateID']."' "); 
				@$arr['chclass'] = $db->fetch(@$res['chclass']);
				if(@$arr['chclass']['c_id']){
				$CID=@$arr['chclass']['c_id'];
				$add .=$db->update_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
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
				"c_note"=>"admin"
				)," c_id=".$CID." ");
				} else {
				$add .=$db->add_db(TB_CHCLASS,array(
				"c_area"=>"".$_SESSION['admin_area']."",
				"c_code"=>"".$_SESSION['admin_school']."",
				"c_stu"=>"".$_POST['StuID'][$i]."",
				"c_class"=>"".$_POST['ClassID']."",
				"c_k4"=>""._text_box_table_tab4_value_la."",
				"c_date"=>"".$_POST['DateID']."",
				"c_note"=>"admin"
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

<script type="text/javascript">
$(function(){
 $("select#classlist4").change(function(){
  var datalist4 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist2
     url: "modules/import/classlist4.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data :{
         "class_id" : $(this).val(),
         "date_id" : $('#Date_id4').val(),
     },
	// data:"class_id="+$(this).val()+"&date_id="+DATEID, // ส่งตัวแปร GET ชื่อ province ให้มีค่าเท่ากับ ค่าของ province
     async: false
  }).responseText;  
  $("div#Classlist4").html(datalist4); // นำค่า datalist2 มาแสดงใน listbox ที่ 2 ที่ชื่อ amphur
//window.alert( $('#Date_id').val() );
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });
});

</script>



		<form method="post" action="index.php?name=import&file=mclass&op=AddTab4&route=<?php echo $route;?>" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
		<div class="col-xs-12" align="center" >
		<h4 class="box-title"><?php echo _heading_title_M_tab4; ?></h4>
		</div>

    <div class="col-xs-12" align="right" >
	<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=import&file=mclass&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
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
							<input type='text' class="form-control" id="Date_id4" name="Date_id4" class="form-control css-require" value="<?php echo $DateTimeStart;?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>
						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_class; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" id="classlist4" name="Stu_class4" required="required">
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
							<div id="Classlist4" ></div>
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


<?php } else { echo "<meta http-equiv='refresh' content='0; url=index.php'>"; }?>
