<?php
if(!empty($_SESSION['stu_login'])){

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
@$res['schcon'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_CONFIG." WHERE shc_area='".$_SESSION['stu_area']."' and shc_code='".$_SESSION['stu_school']."' "); 
@$arr['schcon'] =$db->fetch(@$res['schcon']);
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">
<?php
//<form action="index.php?name=behavior&file=nut&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
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
			url: "modules/behavior/processnut.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=nut&route=<?php echo $route;?>';
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

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=nut&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_nut_stu_form_name; ?></label>
							<div class="col-sm-6">
							<select class="form-control select2" multiple="multiple" name="nut_stu[]" >
							<?php
							
							@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."' ORDER BY stu_class,stu_cn,stu_id desc");
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_form_badtail; ?></label>
							<div class="col-sm-6">
							<select class="form-control select3" multiple="multiple" name="nut_bad[]" >
							<?php
							
							@$res['bad'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." where badtail_code='".$_SESSION['stu_school']."' or badtail_area='' and badtail_code='' ORDER BY badtail_id ");
							while (@$arr['bad'] = $db->fetch(@$res['bad'])){
							echo "<option value=\"".@$arr['bad']['badtail_id']."\"";
							echo ">".@$arr['bad']['badtail_name']."</option>";
							}
							?>
							</select>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_nut_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="nut_name"></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_nut_date_out;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='datetimepicker1' >
											<input type='text' class="form-control" name="nut_dateco">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>


						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_detail_dam; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="nut_per" >
								<option value=""><?php echo _text_box_table_bad_stu_detail_dam_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['stu_area']."' and per_code='".$_SESSION['stu_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\"";
							echo ">".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<?php if($arr['schcon']['shc_boss_sig'] !='' or isset($arr['schcon']['shc_boss_sig'])){?>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" >ใช้ลายเซ็นต์ scan</label>
							<div class="col-sm-4" >
							<input type="radio" name="nut_check" class="minimal" value="1" >&nbsp;ใช้&nbsp;&nbsp;
							<input type="radio" name="nut_check" class="minimal" value="0" checked>&nbsp;ไม่ใช้&nbsp;&nbsp;
							</div>
							</div>
							<?php } ?>
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
		@$res['schcon'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_CONFIG." WHERE shc_area='".$_SESSION['stu_area']."' and shc_code='".$_SESSION['stu_school']."' "); 
		@$arr['schcon'] =$db->fetch(@$res['schcon']);
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."' and stu_id='".$_GET['id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">
<?php
//<form action="index.php?name=behavior&file=nut&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
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
			url: "modules/behavior/processnut.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=nut&route=<?php echo $route;?>';
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

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=nut&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
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

							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_nut_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="nut_name"></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_nut_date_out;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='datetimepicker1' >
											<input type='text' class="form-control" name="nut_dateco">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>

							<?php if($arr['schcon']['shc_boss_sig'] !='' or isset($arr['schcon']['shc_boss_sig'])){?>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" >ใช้ลายเซ็นต์ scan</label>
							<div class="col-sm-4" >
							<input type="radio" name="nut_check" class="minimal" value="1" >&nbsp;ใช้&nbsp;&nbsp;
							<input type="radio" name="nut_check" class="minimal" value="0" checked>&nbsp;ไม่ใช้&nbsp;&nbsp;
							</div>
							</div>
							<?php } ?>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_detail_dam; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="nut_per" >
								<option value=""><?php echo _text_box_table_bad_stu_detail_dam_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['stu_area']."' and per_code='".$_SESSION['stu_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\"";
							echo ">".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>

							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="bAdd"><input name="nut_stu" type="hidden" value="<?php echo @$arr['stu']['stu_id'];?>">
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
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."' and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['nut'] = $db->select_query("SELECT * FROM ".TB_NUT." WHERE nut_area='".$_SESSION['stu_area']."' and nut_code='".$_SESSION['stu_school']."' and nut_stu='".$_GET['stu_id']."'"); 
		@$arr['nut']= $db->fetch(@$res['nut']);
?>
		<div align="right" >
		<div class="form-group"><a href="index.php?name=behavior&file=nut&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_nut_stu_form_name; ?></label>
							<div class="col-sm-6"><input class="form-control" name="" value="<?php echo @$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?>" readonly>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_form_badtail; ?></label>
							<div class="col-sm-6">
							<?php
							
							//$Barray=array(@$arr['nut']['nut_bad']);
							$e = explode(",", @$arr['nut']['nut_bad']);
							for($i=0;$i<count($e);$i++){
							@$res['bad'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." where badtail_area='".$_SESSION['stu_area']."' and badtail_code='".$_SESSION['stu_school']."' or badtail_area='' and badtail_code='' and badtail_id='".$e[$i]."' ORDER BY badtail_id ");
							@$arr['bad'] = $db->fetch(@$res['bad']);
							$BB[$i]=@$arr['bad']['badtail_name'];
							}
							$Bad=implode(",",$BB);
							?>
							<input class="form-control" name="" value="<?php echo $Bad; ?>" readonly>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_nut_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="nut_name" readonly><?php echo @$arr['nut']['nut_name'];?></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_nut_date_out;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='datetimepicker1' >
											<input type='text' class="form-control" name="nut_dateco" value="<?php echo @$arr['nut']['nut_dateco'];?>" readonly>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>


						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_detail_dam; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="nut_per" readonly>
								<option value=""><?php echo _text_box_table_bad_stu_detail_dam_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['stu_area']."' and per_code='".$_SESSION['stu_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\" ";
							if(@$arr['nut']['nut_per']==@$arr['per']['per_ids']){echo " selected ";}
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
		@$res['schcon'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_CONFIG." WHERE shc_area='".$_SESSION['stu_area']."' and shc_code='".$_SESSION['stu_school']."' "); 
		@$arr['schcon'] =$db->fetch(@$res['schcon']);
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."' and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['nut'] = $db->select_query("SELECT * FROM ".TB_NUT." WHERE nut_area='".$_SESSION['stu_area']."' and nut_code='".$_SESSION['stu_school']."' and nut_id='".$_GET['nut_id']."'"); 
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
			url: "modules/behavior/processnut.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=nut&route=<?php echo $route;?>';
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
		<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=nut&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_nut_stu_form_name; ?></label>
							<div class="col-sm-6"><input class="form-control" name="" value="<?php echo @$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?>" readonly>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_form_badtail; ?></label>
							<div class="col-sm-6">
							<?php

							?>
							<select class="form-control select3" multiple="multiple" name="nut_bad[]" id="select3">
							<?php
							$a=@$arr['nut']['nut_bad'];
//							$e = explode(",", @$arr['nut']['nut_bad']);
//							$Bad=implode(",",$e);
							
							@$res['bad'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." where badtail_area='".$_SESSION['stu_area']."' and badtail_code='".$_SESSION['stu_school']."' or badtail_area='' and badtail_code='' ORDER BY badtail_id ");
							$i=0;
							while (@$arr['bad'] = $db->fetch(@$res['bad'])){
							echo "<option value=\"".@$arr['bad']['badtail_id']."\" ";
							echo " >".@$arr['bad']['badtail_name']."</option>";
							$i++;
							}
							?>
							<script>
							$(document).ready(function() { 
								var values = "<?php echo $a;?>",
								options = document.querySelectorAll('#select3 option');
								values.split(',').forEach(function(v) {
									Array.from(options).find(c => c.value == v).selected = true;
								});
							});
							</script>
							</select>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_nut_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="nut_name"><?php echo @$arr['nut']['nut_name'];?></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_nut_date_out;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='datetimepicker1' >
											<input type='text' class="form-control" name="nut_dateco" value="<?php echo @$arr['nut']['nut_dateco'];?>">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>


						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_stu_detail_dam; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="nut_per" >
								<option value=""><?php echo _text_box_table_bad_stu_detail_dam_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['stu_area']."' and per_code='".$_SESSION['stu_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\" ";
							if(@$arr['nut']['nut_per']==@$arr['per']['per_ids']){echo " selected ";}
							echo " >".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<?php if($arr['schcon']['shc_boss_sig'] !='' or isset($arr['schcon']['shc_boss_sig'])){?>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" >ใช้ลายเซ็นต์ scan</label>
							<div class="col-sm-4" >
							<input type="radio" name="nut_check" class="minimal" value="1" >&nbsp;ใช้&nbsp;&nbsp;
							<input type="radio" name="nut_check" class="minimal" value="0" checked>&nbsp;ไม่ใช้&nbsp;&nbsp;
							</div>
							</div>
							<?php } ?>
							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Edit"><input name="nut_stu" type="hidden" value="<?php echo $_GET['stu_id'];?>"><input name="nut_id" type="hidden" value="<?php echo $_GET['nut_id'];?>">
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
		$objOpeny = opendir(WEB_PATH."/MyPDF/");
		$q = 'nut-'.$_GET['stu_id'].'-'.$_GET['nut_id'].'.pdf';
		while(false!== ($filey = readdir($objOpeny))) {
			if(strpos(strtolower($filey),$q)!== false &&!in_array($filey,$exclude)) {
				if($filey=='nut-'.$_GET['stu_id'].'-'.$_GET['nut_id'].'.pdf' ) { @$Statusy=1;} else {@$Statusy=0;}
			}
		}
		closedir($objOpeny);
		//closedir($objOpeny);
		//echo $Statusy;
		if(@$Statusy !=1){
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."' and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['nut'] = $db->select_query("SELECT * FROM ".TB_NUT." WHERE nut_area='".$_SESSION['stu_area']."' and nut_code='".$_SESSION['stu_school']."' and nut_id='".$_GET['nut_id']."'"); 
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
			url: "modules/behavior/print_nutstu.php",
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
  	//			 window.location='index.php?name=behavior&file=nut&route=<?php echo $route;?>';
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
      <a href="../MyPDF/nut-<?php echo $_GET['stu_id'];?>-<?php echo $_GET['nut_id'];?>.pdf" class="btn bg-green btn-flat "  target="_blank"><i class="fa fa-print">&nbsp;<?php echo _text_report_pdf_ok; ?></i></a>
</div>
</div>

<form method="post" enctype="multipart/form-data" id="formUp" role="formUp" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
<input type="hidden" name="StuId" value="<?php echo $_GET['stu_id'];?>">
<input type="hidden" name="NutId" value="<?php echo $_GET['nut_id'];?>">
</form>
<?php
	} else {
	?>
<div align="center" >
      <a href="../MyPDF/nut-<?php echo $_GET['stu_id'];?>-<?php echo $_GET['nut_id'];?>.pdf" class="btn bg-green btn-flat"  target="_blank"><i class="fa fa-print">&nbsp;<?php echo _text_report_pdf_ok; ?></i></a>
</div>
<?php
}
?>
<?php
}else if($op=='update' ){
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."'  and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['best'] = $db->select_query("SELECT * FROM ".TB_NUT." WHERE nut_area='".$_SESSION['stu_area']."' and nut_code='".$_SESSION['stu_school']."' and nut_id='".$_GET['nut_id']."'"); 
		@$arr['best']= $db->fetch(@$res['best']);
		$Tail=@$arr['best']['nut_id'];
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
			url: "modules/behavior/nut_upstatus.php",
			data: $('#formUp').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=nut&op=cldetail&nut_id=<?php echo $_GET["nut_id"];?>&route=<?php echo $route;?>';
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
		<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=nut&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>
				<form method="post" enctype="multipart/form-data" id="formUp" role="formUp" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_table_stu_nut_status_title; ?>&nbsp;<span class="label label-success"><?php echo @$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?></span></h3>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_nut_stu_form_badname; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Ent_note" ></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_nut_date_update;?></label>
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
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Up"><input name="Ent_stu" type="hidden" value="<?php echo $_GET['stu_id'];?>"><input name="Ent_id" type="hidden" value="<?php echo $_GET['nut_id'];?>">
							<br>
							</div>
							</div>
						</div>
						</div>
				</form>
<?php
}else if($op=='nutdetail' ){
@$res['nut'] = $db->select_query("SELECT *,count(nut_id) as STU FROM ".TB_NUT." where nut_area='".$_SESSION['stu_area']."' and nut_code='".$_SESSION['stu_school']."' group by nut_stu"); 
 @$arr['nut']= $db->fetch(@$res['nut']);
@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where  stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."' and stu_id='".$_GET['stu_id']."' "); 
@$arr['stu'] = $db->fetch(@$res['stu']);

?>
		<div align="right" >
		<div class="form-group"><a href="index.php?name=behavior&file=nut&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a>&nbsp;<a href="index.php?name=behavior&file=nut&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_NUT." ,".TB_STUDENT." where  nut_area='".$_SESSION['stu_area']."' and nut_code='".$_SESSION['stu_school']."' and nut_stu=stu_id and nut_stu='".$_GET['stu_id']."' order by nut_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=nut&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline" >
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_nut_stu_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_nut_stu_class; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_nut_date_out; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_nut_date_int; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_nut_status; ?></th>
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
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['nut_id']; ?>" class="selector flat"/></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur'];?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="#" data-toggle="modal" data-target="#myModal<?php echo $i;?>" data-artid="<?php echo @$arr['num']['stu_id']; ?>" class="btn" id="Mybtn"><i class="glyphicon glyphicon-user"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['nut_dateco'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['nut_dateext'];?></td>
              <td layout="block" style="text-align: center;"><?php if(@$arr['num']['nut_dateext'] !='0000-00-00 00:00:00'){ echo "<button class=\"btn bg-green btn-flat btn-sm\" type=\"button\" >"._text_box_table_stu_nut_status_no."</button>";} else {echo "<a href=\"index.php?name=behavior&file=nut&op=update&nut_id=".@$arr['num']['nut_id']."&stu_id=".@$arr['num']['stu_id']."&route=".$route."\" class=\"btn bg-red btn-flat btn-sm\" >"._text_box_table_stu_nut_status_ok."</a>";}?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=nut&op=stuprint&nut_id=<?php echo @$arr['num']['nut_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-orange btn-flat btn-sm" ><i class="fa fa-print "></i></a>
			 <a href="index.php?name=behavior&file=nut&op=studetail&nut_id=<?php echo @$arr['num']['nut_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			 <a href="index.php?name=behavior&file=nut&op=stuedit&nut_id=<?php echo @$arr['num']['nut_id']; ?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=behavior&file=nut&op=cldel&nut_id=<?php echo @$arr['num']['nut_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
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

@$res['nut'] = $db->select_query("SELECT *,count(nut_id) as STU FROM ".TB_NUT." where nut_area='".$_SESSION['stu_area']."' and nut_code='".$_SESSION['stu_school']."' and nut_stu='".$_SESSION['stu_pwd']."' group by nut_id"); 
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
		<div class="form-group"><a href="index.php?name=behavior&file=nut&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_NUT." , ".TB_STUDENT." where  nut_area='".$_SESSION['stu_area']."' and nut_code='".$_SESSION['stu_school']."' and stu_id='".$_SESSION['stu_pwd']."' and nut_stu=stu_id order by stu_class,stu_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=nut&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline" >
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_nut_stu_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_nut_stu_class; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_nut_date_out; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_nut_date_int; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_nut_status; ?></th>
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
              <td style="text-align: center;"><?=$i;?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur'];?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="#" data-toggle="modal" data-target="#myModal<?php echo $i;?>" data-artid="<?php echo @$arr['num']['stu_id']; ?>" class="btn" id="Mybtn"><i class="glyphicon glyphicon-user"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['nut_dateco'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['nut_dateext'];?></td>
              <td layout="block" style="text-align: center;"><?php if(@$arr['num']['nut_dateext'] !=''){ echo "<button class=\"btn bg-green btn-flat btn-sm\" type=\"button\" >"._text_box_table_stu_nut_status_no."</button>";} else {echo "<a href=\"index.php?name=behavior&file=nut&op=update&nut_id=".@$arr['num']['nut_id']."&stu_id=".@$arr['num']['stu_id']."&route=".$route."\" class=\"btn bg-red btn-flat btn-sm\" >"._text_box_table_stu_nut_status_ok."</a>";}?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=nut&op=stuprint&nut_id=<?php echo @$arr['num']['nut_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-orange btn-flat btn-sm" ><i class="fa fa-print "></i></a>
			 <a href="index.php?name=behavior&file=nut&op=studetail&nut_id=<?php echo @$arr['num']['nut_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
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


<script>
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
</script>


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

<style>
/* USER PROFILE PAGE */
 .card {
    margin-top: 20px;
    padding: 30px;
    background-color: rgba(214, 224, 226, 0.2);
    -webkit-border-top-left-radius:5px;
    -moz-border-top-left-radius:5px;
    border-top-left-radius:5px;
    -webkit-border-top-right-radius:5px;
    -moz-border-top-right-radius:5px;
    border-top-right-radius:5px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: #fff;
    background-color: rgba(255, 255, 255, 1);
}
.card.hovercard .card-background {
    height: 130px;
}
.card-background img {
    -webkit-filter: blur(25px);
    -moz-filter: blur(25px);
    -o-filter: blur(25px);
    -ms-filter: blur(25px);
    filter: blur(25px);
    margin-left: -100px;
    margin-top: -200px;
    min-width: 130%;
}
.card.hovercard .useravatar {
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
}
.card.hovercard .useravatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255, 255, 255, 0.5);
}
.card.hovercard .card-info {
    position: absolute;
    bottom: 14px;
    left: 0;
    right: 0;
}
.card.hovercard .card-info .card-title {
    padding:0 5px;
    font-size: 20px;
    line-height: 1;
    color: #ffffff;
    background-color: rgba(255, 255, 255, 0.1);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.card.hovercard .card-info {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}
.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}
.btn-pref .btn {
    -webkit-border-radius:0 !important;
}
</style>
<?php } else { echo "<meta http-equiv='refresh' content='1; url=index.php'>"; }?>
