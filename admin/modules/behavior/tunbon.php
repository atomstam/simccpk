<?php
if(!empty($_SESSION['admin_login'])){
$del='';
if($op=='cldel'){
		
		$del .=$db->del(TB_TUNBON," tab_area='".$_SESSION['admin_area']."' and tab_code='".$_SESSION['admin_school']."' and tab_id='".$_GET['tab_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 

if($op=='delall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			
			$del .=$db->del(TB_TUNBON," tab_area='".$_SESSION['admin_area']."' and tab_code='".$_SESSION['admin_school']."' and tab_id='".$value."' ");
//			$db->closedb ();
		}
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
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
<?php
if($op=='add' and $action=='' ){
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">
<?php
//<form action="index.php?name=behavior&file=tunbon&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
?>

      <div class="alert alert-success" name="thanks" id="thanks" style="display: none">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_ok; ?></span>
      </div>
      <div class="alert alert-danger" name="error" id="error" style="display: none">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_fail; ?></span>
      </div>

<script>
 $(function() {
//twitter bootstrap script
 $("button#submitForm").click(function(){
			$.ajax({
			type: "POST",
			url: "modules/behavior/processtunbon.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=tunbon&route=<?php echo $route;?>';
				}, 1000);
			} else {
         //       $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#formAdd')[0].reset();
			}
	//		$("#form-content").modal('hide'); 
			},
			error: function(){
				alert("failure");
			}
			});
			});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
 $("select#tab_stu").change(function(){
	 //alert("xxxxxxx");
  var datalist4 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist3
     url: "modules/behavior/list_nut.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data:"nut_id="+$(this).val(), // ส่งตัวแปร GET ชื่อ amphur ให้มีค่าเท่ากับ ค่าของ amphur
     async: false
  }).responseText;  
  $("select#tab_nut").html(datalist4); // นำค่า datalist2 มาแสดงใน listbox ที่ 3 ที่ชื่อ tambol
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });
});
</script>

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=tunbon&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>
				<form method="post" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-success" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-folder-open"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_tunbon_stu_form_name; ?></label>
							<div class="col-sm-4">
							<select class="form-control select2" name="tab_stu" id="tab_stu" >
							<option value=""><?php echo _text_box_table_stu_tab_select;?></option>
							<?php
							
							@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' ORDER BY stu_class,stu_cn,stu_id desc");
							while (@$arr['stu'] = $db->fetch(@$res['stu'])){
							echo "<option value=\"".@$arr['stu']['stu_id']."\"";
							echo ">".@$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']."</option>";
							}
							?>
							</select>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_form_nut; ?></label>
							<div class="col-sm-6">
							<select class="form-control select3" name="tab_nut" id="tab_nut" >
							<option value=""><?php echo _text_box_table_stu_tab_select;?></option>
							<?php
							@$res['nut'] = $db->select_query("SELECT * FROM ".TB_NUT." as a,".TB_STUDENT."  as b where  a.nut_stu=b.stu_id and a.nut_area='".$_SESSION['admin_area']."' and a.nut_code='".$_SESSION['admin_school']."' order by a.nut_id "); 
							while (@$arr['nut']= $db->fetch(@$res['nut'])){
							echo "<option value=\"".@$arr['nut']['nut_id']."\"";
							echo ">".@$arr['nut']['stu_num']."".@$arr['nut']['stu_name']." ".@$arr['nut']['stu_sur']."</option>";
							}
							?>
							</select>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="tab_name"></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_date_out;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='datetimepicker1' >
											<input type='text' class="form-control" name="tab_dateco">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_council; ?></label>
							<div class="col-sm-4"><input type="text" name="tab_council"  class="form-control"  placeholder="Name" required>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_council_relation; ?></label>
							<div class="col-sm-4"><input type="text" name="tab_relation"  class="form-control"  placeholder="Name" required>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_detail_dam; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="tab_per" >
								<option value=""><?php echo _text_box_table_bad_stu_detail_dam_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\"";
							echo ">".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>

							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Add">
							<br>
							</div>
							</div>

							</div>
						</div>

</form>
</div>
</div>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $(".select3").select2();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
	  showSeconds: true
    });

  });
</script>
<?php
} else if($op=='badd' and $action=='' ){
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id='".$_GET['id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">
<?php
//<form action="index.php?name=behavior&file=tunbon&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
?>

      <div class="alert alert-success" name="thanks" id="thanks" style="display: none">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_ok; ?></span>
      </div>
      <div class="alert alert-danger" name="error" id="error" style="display: none">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_fail; ?></span>
      </div>

<script>
 $(function() {
//twitter bootstrap script
 $("button#submitForm").click(function(){
			$.ajax({
			type: "POST",
			url: "modules/behavior/processtunbon.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=tunbon&route=<?php echo $route;?>';
				}, 1000);
			} else {
         //       $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#formAdd')[0].reset();
			}
	//		$("#form-content").modal('hide'); 
			},
			error: function(){
				alert("failure");
			}
			});
			});
});
</script>

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=tunbon&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>
				<form method="post" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-success" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-folder-open"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?>&nbsp;<span class="label label-success"><?php echo @$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?></span></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_form_nut; ?></label>
							<div class="col-sm-6">
							<select class="form-control select3" name="tab_nut" id="tab_nut" >
							<option value=""><?php echo _text_box_table_stu_tab_select;?></option>
							<?php
							@$res['nut'] = $db->select_query("SELECT * FROM ".TB_NUT." as a,".TB_STUDENT."  as b where  a.nut_stu=b.stu_id and a.nut_area='".$_SESSION['admin_area']."' and a.nut_code='".$_SESSION['admin_school']."' and b.stu_id='".$_GET['id']."' order by a.nut_id "); 
							while (@$arr['nut']= $db->fetch(@$res['nut'])){
							echo "<option value=\"".@$arr['nut']['nut_id']."\"";
							echo ">".@$arr['nut']['stu_num']."".@$arr['nut']['stu_name']." ".@$arr['nut']['stu_sur']."</option>";
							}
							?>
							</select>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="tab_name"></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_date_out;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='datetimepicker1' >
											<input type='text' class="form-control" name="tab_dateco">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_council; ?></label>
							<div class="col-sm-4"><input type="text" name="tab_council"  class="form-control"  placeholder="Name" required>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_council_relation; ?></label>
							<div class="col-sm-4"><input type="text" name="tab_relation"  class="form-control"  placeholder="Name" required>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_detail_dam; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="tab_per" >
								<option value=""><?php echo _text_box_table_bad_stu_detail_dam_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\"";
							echo ">".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>

							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="bAdd"><input name="tab_stu" type="hidden" value="<?php echo @$arr['stu']['stu_id'];?>">
							<br>
							</div>
							</div>

							</div>
						</div>

</form>
</div>
</div>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $(".select3").select2();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
	  showSeconds: true
    });

  });
</script>
<?php
}else if($op=='studetail' ){
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['nut'] = $db->select_query("SELECT * FROM ".TB_TUNBON." WHERE tab_area='".$_SESSION['admin_area']."' and tab_code='".$_SESSION['admin_school']."' and tab_stu='".$_GET['stu_id']."'"); 
		@$arr['nut']= $db->fetch(@$res['nut']);
?>
		<div align="right" >
		<div class="form-group"><a href="index.php?name=behavior&file=tunbon&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>
				<form method="post" enctype="multipart/form-data" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen_detail_stu; ?>&nbsp;<span class="label label-success"><?php echo @$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?></span></h3>
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
							<br>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_tunbon_stu_form_name; ?></label>
							<div class="col-sm-6"><input class="form-control" name="" value="<?php echo @$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?>" readonly>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_form_nut; ?></label>
							<div class="col-sm-6"><input class="form-control" name="tab_nutx" value="<?php echo "[".@$arr['stu']['stu_id']."] ".@$arr['stu']['stu_num']."".@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']."(".@$arr['nut']['nut_t'].")";?>" readonly>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="tab_name" readonly><?php echo @$arr['nut']['tab_name'];?></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_date_out;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='datetimepicker1' >
											<input type='text' class="form-control" name="tab_dateco" value="<?php echo @$arr['nut']['tab_t'];?>" readonly>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_council; ?></label>
							<div class="col-sm-4"><input type="text" name="tab_council"  class="form-control"  value="<?php echo @$arr['nut']['tab_council'];?>" placeholder="Name" required readonly>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_council_relation; ?></label>
							<div class="col-sm-4"><input type="text" name="tab_relation"  class="form-control"  value="<?php echo @$arr['nut']['tab_relation'];?>" placeholder="Name" required readonly>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_detail_dam; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="tab_per" disabled>
								<option value=""><?php echo _text_box_table_bad_stu_detail_dam_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\" ";
							if(@$arr['nut']['tab_per']==@$arr['per']['per_ids']){echo " selected ";}
							echo " >".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>

						</div>
						</div>
				</form>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $(".select3").select2();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
	  showSeconds: true
    });

  });
</script>
<?php
}else if($op=='stuedit' ){
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['nut'] = $db->select_query("SELECT * FROM ".TB_TUNBON." WHERE tab_area='".$_SESSION['admin_area']."' and tab_code='".$_SESSION['admin_school']."' and tab_id='".$_GET['tab_id']."'"); 
		@$arr['nut']= $db->fetch(@$res['nut']);

?>
      <div class="alert alert-success" name="thanks" id="thanks" style="display: none">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_ok; ?></span>
      </div>
      <div class="alert alert-danger" name="error" id="error" style="display: none">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_fail; ?></span>
      </div>

<script>
 $(function() {
//twitter bootstrap script
 $("button#submitForm").click(function(){
			$.ajax({
			type: "POST",
			url: "modules/behavior/processtunbon.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=tunbon&route=<?php echo $route;?>';
				}, 1000);
			} else {
//                $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#formEdit')[0].reset();
			}
	//		$("#form-content").modal('hide'); 
			},
			error: function(){
				alert("failure");
			}
			});
			});

});
</script>
		<div align="right" >
		<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=tunbon&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>
				<form method="post" enctype="multipart/form-data" id="formEdit" role="formEdit" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen_detail_stu; ?>&nbsp;<span class="label label-success"><?php echo @$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?></span></h3>
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
							<br>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_tunbon_stu_form_name; ?></label>
							<div class="col-sm-6"><input class="form-control" name="" value="<?php echo @$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?>" readonly>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_form_nut; ?></label>
							<div class="col-sm-6"><input class="form-control" name="tab_nutx" value="<?php echo "[".@$arr['stu']['stu_id']."] ".@$arr['stu']['stu_num']."".@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']."(".@$arr['nut']['nut_t'].")";?>" readonly>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="tab_name"><?php echo @$arr['nut']['tab_name'];?></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_date_out;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='datetimepicker1' >
											<input type='text' class="form-control" name="tab_dateco" value="<?php echo @$arr['nut']['tab_t'];?>">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_council; ?></label>
							<div class="col-sm-4"><input type="text" name="tab_council"  class="form-control"  value="<?php echo @$arr['nut']['tab_council'];?>" placeholder="Name" required>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_council_relation; ?></label>
							<div class="col-sm-4"><input type="text" name="tab_relation"  class="form-control"  value="<?php echo @$arr['nut']['tab_relation'];?>" placeholder="Name" required>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_detail_dam; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="tab_per" >
								<option value=""><?php echo _text_box_table_bad_stu_detail_dam_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\" ";
							if(@$arr['nut']['tab_per']==@$arr['per']['per_ids']){echo " selected ";}
							echo " >".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>

							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Edit"><input name="tab_stu" type="hidden" value="<?php echo $_GET['stu_id'];?>"><input name="tab_id" type="hidden" value="<?php echo $_GET['tab_id'];?>"><input name="tab_nut" type="hidden" value="<?php echo @$arr['nut']['tab_nut'];?>">
							<br>
							</div>
							</div>
						</div>
						</div>
				</form>

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $(".select3").select2();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
	  showSeconds: true
    });

  });
</script>
<?php
}else if($op=='stuprint' ){
		//ob_end_clean();
		$exclude = array('.','..','.htaccess');
		$objOpenz = opendir(WEB_PATH."/MyPDF/");
		$q = 'tab-'.$_GET['stu_id'].'-'.$_GET['tab_id'].'.pdf';
		while(false!== ($filez = readdir($objOpenz))) {
			if(strpos(strtolower($filez),$q)!== false &&!in_array($filez,$exclude)) {
				if($filez=='tab-'.$_GET['stu_id'].'-'.$_GET['tab_id'].'.pdf' ) { $Statusz=1;} else {$Statusz=0;}
			}
		}
		closedir($objOpenz);
		//closedir($objOpeny);
		//echo $Statusy;
		if($Statusz !=1){
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['nut'] = $db->select_query("SELECT * FROM ".TB_TUNBON." WHERE tab_area='".$_SESSION['admin_area']."' and tab_code='".$_SESSION['admin_school']."' and tab_id='".$_GET['tab_id']."'"); 
		@$arr['nut']= $db->fetch(@$res['nut']);

?>
      <div class="alert alert-success" name="thanks" id="thanks" style="display: none">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_pdf_ok; ?></span>
      </div>
      <div class="alert alert-danger" name="error" id="error" style="display: none">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_pdf_fail; ?></span>
      </div>
<script>
 $(function() {
	$("#PrintPDF").hide();
//twitter bootstrap script
 $("button#submitForm").click(function(){
			$.ajax({
			type: "POST",
			url: "modules/behavior/print_tabstu.php",
			data: $('#formUp').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 $("#Print").hide();
				 $("#PrintPDF").show();
	//			 setTimeout(function() {
  	//			 window.location='index.php?name=behavior&file=tunbon&route=<?php echo $route;?>';
	//			}, 1000);
			} else {
//                $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#formEdit')[0].reset();
				 $("#PrintPDF").hide();
			}
	//		$("#form-content").modal('hide'); 
			},
			error: function(){
				alert("failure");
			}
			});
			});

});
</script>
<div align="center" >
<div class="form-group" id="Print">
<button class="btn bg-orange btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-file-pdf-o"></i>&nbsp;<?php echo _text_report_create_pdf_pint; ?></button>
</div>
<div class="form-group" id="PrintPDF">
      <a href="../../../MyPDF/tab-<?php echo $_GET['stu_id'];?>-<?php echo $_GET['tab_id'];?>.pdf" class="btn bg-green btn-flat" target="_blank"><i class="fa fa-print">&nbsp;<?php echo _text_report_pdf_ok; ?></i></a>
</div>
</div>

<form method="post" enctype="multipart/form-data" id="formUp" role="formUp" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
<input type="hidden" name="StuId" value="<?php echo $_GET['stu_id'];?>">
<input type="hidden" name="NutId" value="<?php echo $_GET['tab_id'];?>">
</form>
<?php
	} else {
	?>
<div align="center" >
      <a href="../../../MyPDF/tab-<?php echo $_GET['stu_id'];?>-<?php echo $_GET['tab_id'];?>.pdf" class="btn bg-green btn-flat"  target="_blank"><i class="fa fa-print">&nbsp;<?php echo _text_report_pdf_ok; ?></i></a>
</div>
<?php
}
?>
<?php
}else if($op=='update' ){
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['best'] = $db->select_query("SELECT * FROM ".TB_TUNBON." WHERE tab_area='".$_SESSION['admin_area']."' and tab_code='".$_SESSION['admin_school']."' and tab_id='".$_GET['tab_id']."'"); 
		@$arr['best']= $db->fetch(@$res['best']);
		$Tail=@$arr['best']['tab_id'];
?>
      <div class="alert alert-success" name="thanks" id="thanks" style="display: none">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_ok; ?></span>
      </div>
      <div class="alert alert-danger" name="error" id="error" style="display: none">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_fail; ?></span>
      </div>

<script>
 $(function() {
//twitter bootstrap script
 $("button#submitForm").click(function(){
			$.ajax({
			type: "POST",
			url: "modules/behavior/ent_upstatus.php",
			data: $('#formUp').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=tunbon&op=cldetail&tab_id=<?php echo $Tail;?>&route=<?php echo $route;?>';
				}, 1000);
			} else {
//                $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#formEdit')[0].reset();
			}
	//		$("#form-content").modal('hide'); 
			},
			error: function(){
				alert("failure");
			}
			});
			});

});
</script>
		<div align="right" >
		<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=tunbon&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>
				<form method="post" enctype="multipart/form-data" id="formUp" role="formUp" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_table_stu_tab_status_title; ?>&nbsp;<span class="label label-success"><?php echo @$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?></span></h3>
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
							<br>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_tunbon_stu_form_badname; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Ent_note" ></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tab_date_update;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='datetimepicker1' >
											<input type='text' class="form-control" name="Ent_check" value="<?php echo @$arr['best']['got_check']; ?>">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>
								<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Up"><input name="Ent_stu" type="hidden" value="<?php echo $_GET['stu_id'];?>"><input name="Ent_id" type="hidden" value="<?php echo $_GET['tab_id'];?>">
							<br>
							</div>
							</div>
						</div>
						</div>
				</form>
<?php
}else if($op=='nutdetail' ){
@$res['nut'] = $db->select_query("SELECT *,count(tab_id) as STU FROM ".TB_TUNBON." where tab_area='".$_SESSION['admin_area']."' and tab_code='".$_SESSION['admin_school']."' group by tab_stu"); 
 @$arr['nut']= $db->fetch(@$res['nut']);
@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where  stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id='".$_GET['stu_id']."' "); 
@$arr['stu'] = $db->fetch(@$res['stu']);

?>
		<div align="right" >
		<div class="form-group"><a href="index.php?name=behavior&file=tunbon&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a>&nbsp;<a href="index.php?name=behavior&file=tunbon&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen_detail_class; ?>&nbsp;<span class="label label-success"><?php echo @$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?></span></h3>
								<div class="box-tools pull-right">
								<span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$arr['nut']['STU']; ?></span>
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">

	  <?php
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_TUNBON." ,".TB_STUDENT." where  tab_area='".$_SESSION['admin_area']."' and tab_code='".$_SESSION['admin_school']."' and tab_stu=stu_id and tab_stu='".$_GET['stu_id']."' order by tab_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=tunbon&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline" >
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_tunbon_stu_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tunbon_stu_class; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_tab_date_out; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_tab_council; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_tab_council_relation; ?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['num']['stu_class']."' "); 
		@$arr['class'] =$db->fetch(@$res['class']);
		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['tab_id']; ?>" class="selector flat"/></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur'];?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="#" data-toggle="modal" data-target="#myModal<?php echo $i;?>" data-artid="<?php echo @$arr['num']['stu_id']; ?>" class="btn" id="Mybtn"><i class="glyphicon glyphicon-user"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['tab_datetime'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['tab_council'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['tab_relation'];?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=tunbon&op=stuprint&tab_id=<?php echo @$arr['num']['tab_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-orange btn-flat btn-sm" ><i class="fa fa-print "></i></a>
			 <a href="index.php?name=behavior&file=tunbon&op=studetail&tab_id=<?php echo @$arr['num']['tab_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			 <a href="index.php?name=behavior&file=tunbon&op=stuedit&tab_id=<?php echo @$arr['num']['tab_id']; ?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=behavior&file=tunbon&op=cldel&tab_id=<?php echo @$arr['num']['tab_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
			  </td>

				<div id="myModal<?php echo $i;?>" class="modal fade" >
					<div class="modal-dialog modal-dialogs">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">X</button>
								  <h4 class="modal-title"><i class="fa fa-user"></i>&nbsp;<?php echo _heading_title;?></h4>
							</div>
							<div class="modal-body" align="center">
								<img src="<?php if(@$arr['num']['stu_pic']){echo WEB_URL_IMG_STU.@$arr['num']['stu_pic'];}else{echo WEB_URL_IMG_STU."no_image.jpg";}?>"  width="150" class="img-circle" alt="User Image"/>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

            </tr>

            <?php $i++;} ?>
          </tbody>
		  </table>
	      </form>

            <?php } else { ?>
			<table>
            <tr>
              <td class="center" colspan="7"><?php echo _text_no_results; ?></td>
            </tr>
			</table>
            <?php } ?>

    </div>
    </div>

        <script type="text/javascript">
        $(document).ready(function() {
		pdfMake.fonts = {
			THSarabun: {
			normal: 'THSarabun.ttf',
			bold: 'THSarabun-Bold.ttf',
			italics: 'THSarabun-Italic.ttf',
			bolditalics: 'THSarabun-BoldItalic.ttf'
		}
		}
        var aoColumns = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 5 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
								"aoColumns": aoColumns,
								"responsive" : true,
								"dom" : 'lBfrtip',
								"buttons": [
									'copy', {"extend":'csv','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : '<?php echo _heading_title;?>'},,
									{"extend" : 'excel','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : '<?php echo _heading_title;?>'}, 
									{ // กำหนดพิเศษเฉพาะปุ่ม pdf
									"extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
									"exportOptions" : {
										columns: ':visible'
									},
									"text": 'PDF', // ข้อความที่แสดง
									"pageSize": 'A4',   // ขนาดหน้ากระดาษเป็น A4
									"filename" : '<?php echo _heading_title;?>',
									"title" : '<?php echo _heading_title;?>',
									"customize":function(doc){ // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
									// กำหนด style หลัก
										doc.defaultStyle = {
										font:'THSarabun',
										fontSize:16                                 
										};
										// กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ
////										doc.content[1].table.widths = [ 50, 'auto', '*', '*' ];
////										doc.styles.tableHeader.fontSize = 16; // กำหนดขนาด font ของ header
////										var rowCount = doc.content[1].table.body.length; // หาจำนวนแะวทั้งหมดในตาราง
										// วนลูปเพื่อกำหนดค่าแต่ละคอลัมน์ เช่นการจัดตำแหน่ง
////										for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
////											doc.content[1].table.body[i][0].alignment = 'center'; // คอลัมน์แรกเริ่มที่ 0
////											doc.content[1].table.body[i][1].alignment = 'center';
////											doc.content[1].table.body[i][2].alignment = 'left';
////											doc.content[1].table.body[i][3].alignment = 'right';
////										};                                  
////										console.log(doc); // เอาไว้ debug ดู doc object proptery เพื่ออ้างอิงเพิ่มเติม
									} // สิ้นสุดกำหนดพิเศษปุ่ม pdf
									},
									,{"extend" : 'print',"title" : '<?php echo _heading_title;?>'}
								],
								'drawCallback': function(){
									$('input.flat[type="checkbox"]').iCheck({
										checkboxClass: 'icheckbox_minimal-red',
										radioClass: 'iradio_minimal-red'
									});
									$('input[name=toggle]').bootstrapToggle();
									$('input.all[type="checkbox"]').on('ifToggled', function (event) {
										var chkToggle;
										$(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
										$('input.selector:not(.all)').iCheck(chkToggle);
									});
								}
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
                              });

            });
        </script>



<?php
}else {

@$res['nut'] = $db->select_query("SELECT *,count(tab_id) as STU FROM ".TB_TUNBON." where tab_area='".$_SESSION['admin_area']."' and tab_code='".$_SESSION['admin_school']."' group by tab_id"); 
 @$arr['nut']= $db->fetch(@$res['nut']);

?>

      <div class="alert alert-success" name="thanks" id="thanks" style="display: none">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_ok; ?></span>
      </div>
      <div class="alert alert-danger" name="error" id="error" style="display: none">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_fail; ?></span>
      </div>

		<div align="right" >
		<div class="form-group"><a href="index.php?name=behavior&file=tunbon&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a>&nbsp;<a href="index.php?name=behavior&file=tunbon&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen_detail_class; ?></h3>
								<div class="box-tools pull-right">
								<span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$arr['nut']['STU']; ?></span>
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">

	  <?php
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_TUNBON." , ".TB_STUDENT." where  tab_area='".$_SESSION['admin_area']."' and tab_code='".$_SESSION['admin_school']."' and tab_stu=stu_id order by stu_class,stu_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=tunbon&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline" >
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_tunbon_stu_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tunbon_stu_class; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_tab_date_out; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_tab_council; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_tab_council_relation; ?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['num']['stu_class']."' "); 
		@$arr['class'] =$db->fetch(@$res['class']);
		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['tab_id']; ?>" class="selector flat"/></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur'];?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="#" data-toggle="modal" data-target="#myModal<?php echo $i;?>" data-artid="<?php echo @$arr['num']['stu_id']; ?>" class="btn" id="Mybtn"><i class="glyphicon glyphicon-user"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['tab_datetime'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['tab_council'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['tab_relation'];?></td>

			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=tunbon&op=stuprint&tab_id=<?php echo @$arr['num']['tab_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-orange btn-flat btn-sm" ><i class="fa fa-print "></i></a>
			 <a href="index.php?name=behavior&file=tunbon&op=studetail&tab_id=<?php echo @$arr['num']['tab_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			 <a href="index.php?name=behavior&file=tunbon&op=stuedit&tab_id=<?php echo @$arr['num']['tab_id']; ?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=behavior&file=tunbon&op=cldel&tab_id=<?php echo @$arr['num']['tab_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
			  </td>

				<div id="myModal<?php echo $i;?>" class="modal fade" >
					<div class="modal-dialog modal-dialogs">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">X</button>
								  <h4 class="modal-title"><i class="fa fa-user"></i>&nbsp;<?php echo _heading_title;?></h4>
							</div>
							<div class="modal-body" align="center">
								<img src="<?php if(@$arr['num']['stu_pic']){echo WEB_URL_IMG_STU.@$arr['num']['stu_pic'];}else{echo WEB_URL_IMG_STU."no_image.jpg";}?>"  width="150" class="img-circle" alt="User Image"/>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

            </tr>

            <?php $i++;} ?>
          </tbody>
		  </table>
	      </form>

            <?php } else { ?>
			<table>
            <tr>
              <td class="center" colspan="7"><?php echo _text_no_results; ?></td>
            </tr>
			</table>
            <?php } ?>

    </div>
    </div>


<?php
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['nums'] = $db->select_query("select stu_id,stu_pic,stu_pid,stu_num,stu_name,stu_sur,class_name,stu_class,sum(badtail_point) as CO  from ".TB_BAD." ,".TB_STUDENT.",".TB_BADTAIL.",".TB_CLASS." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id=bad_stu and bad_tail=badtail_id and class_id=stu_class group by stu_id HAVING CO > 100 order by stu_class,stu_cn,CO desc"); 
		@$rows['nums'] = $db->rows(@$res['nums']);
		if(@$rows['nums']) {

?>
      <div class="row">
        <div class="col-xs-12 connectedSortable">

    <div class="box box-danger">
      
	         <div class="box-header with-border">
                 <i class="fa fa-user"></i>
                 <h3 class="box-title"><?php echo _text_box_table_bad_name_count; ?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['nums'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
	<div class="box-body ">

        <table id="example9" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th style="text-align: center;" width='5%'>#</th>
              <th layout="block" style="text-align:center;" width='15%'><?php echo _text_box_table_stu_id; ?></th>
              <th layout="block" style="text-align:center;" width='10%'><?php echo _text_box_table_stu_pid; ?></th>
              <th layout="block" style="text-align:center;" width='25%'><?php echo _text_box_table_stu_fullname; ?></th>
			  <th layout="block" style="text-align:center;" width='15%'><?php echo _text_box_table_stu_class;?></th>
              <th layout="block" style="text-align:center;" width='5%'><?php echo _text_box_table_bad_score;?></th>
              <th layout="block" style="text-align:center;" width='10%'><?php echo _text_box_table_count_tunbon;?></th>
              <th layout="block" style="text-align:center;" width='15%'>Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['nums'] = $db->fetch(@$res['nums'])){
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['nums']['stu_class']."' "); 
		@$arr['class'] = $db->fetch(@$res['class']);
		@$res['nuts'] = $db->select_query("SELECT * FROM ".TB_TUNBON." where  tab_area='".$_SESSION['admin_area']."' and tab_code='".$_SESSION['admin_school']."' and tab_stu='".@$arr['nums']['stu_id']."' group by tab_stu"); 
		@$rows['nuts'] = $db->rows(@$res['nuts']);
		@$arr['nuts'] = $db->fetch(@$res['nuts']);
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td style="text-align: right;"><?php echo @$arr['nums']['stu_id']; ?></td>
              <td style="text-align: right;"><?php echo @$arr['nums']['stu_pid']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['nums']['stu_num']."".@$arr['nums']['stu_name']." ".@$arr['nums']['stu_sur'] ; ?>&nbsp;<?php if(@$arr['nums']['stu_pic']){?><a href="#" data-toggle="modal" data-target="#myModal" data-artid="<?php echo @$arr['nums']['stu_id']; ?>" class="btn" id="Mybtn"><i class="glyphicon glyphicon-user"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name']; ?></td>
              <td layout="block" style="text-align: right;">-<?php echo @$arr['nums']['CO']; ?></td>
              <td layout="block" style="text-align: right;"><?php echo @$rows['nuts'];?></td>
              <td style="text-align: center;">
			<?php if(@$rows['nuts'] !=''){?>
			 <a href="index.php?name=behavior&file=tunbon&op=nutdetail&stu_id=<?php echo @$arr['nums']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus"></i></a>
			<?php } ?>
			 <a href="index.php?name=behavior&file=tunbon&op=badd&id=<?php echo @$arr['nums']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-plus "></i></a>
			  </td>
            </tr>
            <?php $i++;} ?>
          </tbody>
		  </table>

    </div>

	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
<!-- /.row -->
</div>


		<script type="text/javascript">
        $(document).ready(function() {
		pdfMake.fonts = {
			THSarabun: {
			normal: 'THSarabun.ttf',
			bold: 'THSarabun-Bold.ttf',
			italics: 'THSarabun-Italic.ttf',
			bolditalics: 'THSarabun-BoldItalic.ttf'
		}
		}
        var aoColumns9 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable9 = $("#example9").dataTable({
								"aoColumns": aoColumns9,
								"responsive" : true,
								"dom" : 'lBfrtip',
								"buttons": [
									'copy', {"extend":'csv','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : '<?php echo _heading_title;?>'},,
									{"extend" : 'excel','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : '<?php echo _heading_title;?>'}, 
									{ // กำหนดพิเศษเฉพาะปุ่ม pdf
									"extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
									"exportOptions" : {
										columns: ':visible'
									},
									"text": 'PDF', // ข้อความที่แสดง
									"pageSize": 'A4',   // ขนาดหน้ากระดาษเป็น A4
									"filename" : '<?php echo _heading_title;?>',
									"title" : '<?php echo _heading_title;?>',
									"customize":function(doc){ // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
									// กำหนด style หลัก
										doc.defaultStyle = {
										font:'THSarabun',
										fontSize:16                                 
										};
										// กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ
////										doc.content[1].table.widths = [ 50, 'auto', '*', '*' ];
////										doc.styles.tableHeader.fontSize = 16; // กำหนดขนาด font ของ header
////										var rowCount = doc.content[1].table.body.length; // หาจำนวนแะวทั้งหมดในตาราง
										// วนลูปเพื่อกำหนดค่าแต่ละคอลัมน์ เช่นการจัดตำแหน่ง
////										for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
////											doc.content[1].table.body[i][0].alignment = 'center'; // คอลัมน์แรกเริ่มที่ 0
////											doc.content[1].table.body[i][1].alignment = 'center';
////											doc.content[1].table.body[i][2].alignment = 'left';
////											doc.content[1].table.body[i][3].alignment = 'right';
////										};                                  
////										console.log(doc); // เอาไว้ debug ดู doc object proptery เพื่ออ้างอิงเพิ่มเติม
									} // สิ้นสุดกำหนดพิเศษปุ่ม pdf
									},
									,{"extend" : 'print',"title" : '<?php echo _heading_title;?>'}
								],
								'drawCallback': function(){
									$('input.flat[type="checkbox"]').iCheck({
										checkboxClass: 'icheckbox_minimal-red',
										radioClass: 'iradio_minimal-red'
									});
									$('input[name=toggle]').bootstrapToggle();
									$('input.all[type="checkbox"]').on('ifToggled', function (event) {
										var chkToggle;
										$(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
										$('input.selector:not(.all)').iCheck(chkToggle);
									});
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
        "footerCallback": function ( row, data, start, end, display ) {
            var api9 = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal9 = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total9 = api9
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal9(a) + intVal9(b);
                }, 0 );
 
            // Total over this page
            pageTotal9 = api9
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal9(a) + intVal9(b);
                }, 0 );
 
            // Update footer
            $( api9.column( 3 ).footer() ).html(
//                '-'+pageTotal9 +' ( -'+ total9 +' <?php echo _text_box_table_bad_score;?>)'
			'-'+ total9 +' <?php echo _text_box_table_bad_score;?>'
            );
        }
								});

            });
        </script>

            <?php } else { ?>
			<table>
            <tr>
              <td class="center" colspan="7"><?php echo _text_no_results; ?></td>
            </tr>
			</table>
            <?php } ?>




<style>
.modal-dialogs{
    position: relative;
    display: table;
    overflow-y: auto;    
    overflow-x: auto;
    width: auto;
    min-width: 300px;   
}
</style>


<script>
//jQuery Library Comes First
//Bootstrap Library
$(document).ready(function() { 
	$('a[data-confirm]').click(function(ev) {
		var href = $(this).attr('href');
		if (!$('#dataConfirmModal').length) {
			$('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h4 id="dataConfirmLabel"><?=_text_box_con_delete_head;?></h4></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn bg-aqua btn-flat" id="dataConfirmOK">OK</a></div></div></div></div>');
		} 
		$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
		$('#dataConfirmOK').attr('href', href);
		$('#dataConfirmModal').modal({show:true});
		return false;
	});

});
</script>

        <script type="text/javascript">
        $(document).ready(function() {
		pdfMake.fonts = {
			THSarabun: {
			normal: 'THSarabun.ttf',
			bold: 'THSarabun-Bold.ttf',
			italics: 'THSarabun-Italic.ttf',
			bolditalics: 'THSarabun-BoldItalic.ttf'
		}
		}
        var aoColumns = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 5 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
								"aoColumns": aoColumns,
								"responsive" : true,
								"dom" : 'lBfrtip',
								"buttons": [
									'copy', {"extend":'csv','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : '<?php echo _heading_title;?>'},,
									{"extend" : 'excel','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : '<?php echo _heading_title;?>'}, 
									{ // กำหนดพิเศษเฉพาะปุ่ม pdf
									"extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
									"exportOptions" : {
										columns: ':visible'
									},
									"text": 'PDF', // ข้อความที่แสดง
									"pageSize": 'A4',   // ขนาดหน้ากระดาษเป็น A4
									"filename" : '<?php echo _heading_title;?>',
									"title" : '<?php echo _heading_title;?>',
									"customize":function(doc){ // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
									// กำหนด style หลัก
										doc.defaultStyle = {
										font:'THSarabun',
										fontSize:16                                 
										};
										// กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ
////										doc.content[1].table.widths = [ 50, 'auto', '*', '*' ];
////										doc.styles.tableHeader.fontSize = 16; // กำหนดขนาด font ของ header
////										var rowCount = doc.content[1].table.body.length; // หาจำนวนแะวทั้งหมดในตาราง
										// วนลูปเพื่อกำหนดค่าแต่ละคอลัมน์ เช่นการจัดตำแหน่ง
////										for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
////											doc.content[1].table.body[i][0].alignment = 'center'; // คอลัมน์แรกเริ่มที่ 0
////											doc.content[1].table.body[i][1].alignment = 'center';
////											doc.content[1].table.body[i][2].alignment = 'left';
////											doc.content[1].table.body[i][3].alignment = 'right';
////										};                                  
////										console.log(doc); // เอาไว้ debug ดู doc object proptery เพื่ออ้างอิงเพิ่มเติม
									} // สิ้นสุดกำหนดพิเศษปุ่ม pdf
									},
									,{"extend" : 'print',"title" : '<?php echo _heading_title;?>'}
								],
								'drawCallback': function(){
									$('input.flat[type="checkbox"]').iCheck({
										checkboxClass: 'icheckbox_minimal-red',
										radioClass: 'iradio_minimal-red'
									});
									$('input[name=toggle]').bootstrapToggle();
									$('input.all[type="checkbox"]').on('ifToggled', function (event) {
										var chkToggle;
										$(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
										$('input.selector:not(.all)').iCheck(chkToggle);
									});
								}
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
                              });

            });
        </script>

<?php
}
?>
</div>

<script type="text/javascript">
		$(function(){
			$('#dp1').datepicker();
			$('#dp2').datepicker();
			$('#dp3').datepicker();
         });
</script>


        <script type="text/javascript">
			$(document).ready(function ($) {
				$('input').iCheck({
					checkboxClass: 'icheckbox_minimal-red',
					radioClass: 'iradio_minimal-red'
				});
//				$('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 10, format: 'YYYY-MM-DD h:i:s A'});
                $('#datetimepicker1').datetimepicker({
						format: 'YYYY-MM-DD HH:mm:ss',
                      locale: 'th'
                });
                $('#datetimepicker2').datetimepicker({
					  format: 'YYYY-MM-DD HH:mm:ss'				
 //                   locale: 'th'
                });
				$('input.all').on('ifToggled', function (event) {
					var chkToggle;
					$(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
					$('input.selector:not(.all)').iCheck(chkToggle);
				});
			});
        </script>

<?php } else { echo "<meta http-equiv='refresh' content='1; url=index.php'>"; }?>
