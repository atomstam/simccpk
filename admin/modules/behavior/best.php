<?php
if(!empty($_SESSION['admin_login'])){
$del='';
if($_SESSION['admin_group']==1){ 
if($op=='del'){
		
		$del .=$db->del(TB_BESTTAIL," btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."'  and btail_id='".$_GET['bt_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 
if($op=='cldel'){
		
		$del .=$db->del(TB_BESTTAIL," btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."'  and btail_id='".$_GET['bt_id']."' and btail_stu='".$_GET['stu_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 
if($op=='delall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			
			$del .=$db->del(TB_BESTTAIL," btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."'  and btail_id='".$value."' ");
//			$db->closedb ();
		}
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
}
if($op=='cldelall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			
			$del .=$db->del(TB_BESTTAIL," btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."'  and btail_stu='".$value."' and btail_id='".$_GET['bt_id']."' ");
//			$db->closedb ();
		}
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
}
if($op=='studel'){
		
		$del .=$db->del(TB_BESTTAIL," btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."'  and btail_id='".$_GET['bt_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 
if($op=='studelall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			
			$del .=$db->del(TB_BESTTAIL," btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."'  and btail_id='".$_GET['bt_id']."' ");
//			$db->closedb ();
		}
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
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
//<form action="index.php?name=behavior&file=best&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
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
			url: "modules/behavior/processbest.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=best&route=<?php echo $route;?>';
				}, 1000);
			} else {
//                $("#error").html(msg.message),
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

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=best&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_best_stu_form_name; ?></label>
							<div class="col-sm-6">
							<select class="form-control select2" multiple="multiple" name="Best_stu[]" >
							<?php
							
							@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' ORDER BY stu_class,stu_cn,stu_id");
							while (@$arr['stu'] = $db->fetch(@$res['stu'])){
								@$res['b'] = $db->select_query("SELECT * FROM ".TB_BESTTAIL." where btail_stu='".@$arr['stu']['stu_id']."' ");
								@$arr['b'] = @$db->fetch(@$res['b']);
								if(empty(@$arr['b']['btail_stu'])){
									echo "<option value=\"".@$arr['stu']['stu_id']."\"";
									echo ">".@$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']."</option>";
								}
							}
							?>
							</select>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="Stu_best" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_best_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_BEST." ORDER BY bt_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['bt_id']."\"";
							echo ">".@$arr['bt']['bt_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Btail_name"></textarea>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best_interv; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="Btail_per" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_best_interv_select;?></option>
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
  });
</script>
<?php
}else if($op=='studetail' ){
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['best'] = $db->select_query("SELECT * FROM ".TB_BESTTAIL." WHERE btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."' and btail_stu='".$_GET['stu_id']."'"); 
		@$arr['best']= $db->fetch(@$res['best']);
?>
		<div align="right" >
		<div class="form-group"><a href="index.php?name=behavior&file=best&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a href="index.php?name=behavior&file=best&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best; ?></label>
							<div class="col-sm-4">
							<select  class="form-control css-require" name="Stu_best" readonly>
							<option value="" selected disabled><?php echo _text_box_table_stu_best_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_BEST." ORDER BY bt_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['bt_id']."\" ";
							if(@$arr['best']['btail_id']==@$arr['bt']['bt_id']){echo " selected ";}
							echo ">".@$arr['bt']['bt_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Btail_name" readonly><?php echo @$arr['best']['btail_name']; ?></textarea>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best_interv; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="Btail_per" readonly>
							<option value="" selected disabled><?php echo _text_box_table_stu_best_interv_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\" ";
							if(@$arr['best']['btail_per']==@$arr['per']['per_ids']){echo " selected ";}
							echo ">".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>

						</div>
						</div>
				</form>
<?php
}else if($op=='stuedit' ){
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['best'] = $db->select_query("SELECT * FROM ".TB_BESTTAIL." WHERE btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."'  and btail_stu='".$_GET['stu_id']."'"); 
		@$arr['best']= $db->fetch(@$res['best']);
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
			url: "modules/behavior/processbest.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=best&route=<?php echo $route;?>';
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
		<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=best&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best; ?></label>
							<div class="col-sm-4">
							<select  class="form-control css-require" name="Stu_best" >
							<option value="" selected disabled><?php echo _text_box_table_stu_best_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_BEST." ORDER BY bt_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['bt_id']."\" ";
							if(@$arr['best']['btail_id']==@$arr['bt']['bt_id']){echo " selected ";}
							echo ">".@$arr['bt']['bt_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Btail_name" ><?php echo @$arr['best']['btail_name']; ?></textarea>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best_interv; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="Btail_per" >
							<option value="" selected disabled><?php echo _text_box_table_stu_best_interv_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\" ";
							if(@$arr['best']['btail_per']==@$arr['per']['per_ids']){echo " selected ";}
							echo ">".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Edit"><input name="Best_stu" type="hidden" value="<?php echo $_GET['stu_id'];?>">
							<br>
							</div>
							</div>
						</div>
						</div>
				</form>
<?php
}else if($op=='cldetail' ){

@$res['bad'] = $db->select_query("SELECT *,count(btail_stu) as STU FROM ".TB_BESTTAIL." WHERE btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."' and btail_id='".$_GET['bt_id']."' group by btail_id"); 
 @$arr['bad']= $db->fetch(@$res['bad']);
@$res['tail'] = $db->select_query("SELECT * FROM ".TB_BEST." WHERE bt_id='".$_GET['bt_id']."' "); 
@$arr['tail'] =$db->fetch(@$res['tail']);
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
		<div class="form-group"><a href="index.php?name=behavior&file=best&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a><?php if($_SESSION['admin_group']==1){ ?>&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a><?php } ?>&nbsp;<a href="index.php?name=behavior&file=best&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen_detail_class; ?>&nbsp;<span class="badge bg-red"><?php echo @$arr['tail']['bt_name']; ?></span></h3>
								<div class="box-tools pull-right">
								<span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$arr['bad']['STU']; ?></span>
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">
	  <?php
		
		@$res['num'] = $db->select_query("SELECT *,count(btail_stu) as CO FROM ".TB_BESTTAIL." as a, ".TB_STUDENT." as b where btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."'  and btail_id='".$_GET['bt_id']."'  and btail_stu=stu_id group by btail_stu order by CO desc,stu_class,stu_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=best&op=cldelall&bt_id=<?php echo $_GET['bt_id'];?>&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><?php if($_SESSION['admin_group']==1){ ?><input type="checkbox" id="check" class="selector flat all"><?php } else {?>#<?php } ?></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_best_stu_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_best_stu_class; ?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['num']['stu_class']."' "); 
		@$arr['class'] =$db->fetch(@$res['class']);
		@$res['tail'] = $db->select_query("SELECT * FROM ".TB_BESTTAIL." where btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."' and btail_id='".@$arr['num']['btail_id']."' "); 
		@$arr['tail'] =$db->fetch(@$res['tail']);
//		@$res['level'] = $db->select_query("SELECT * FROM ".TB_BESTLEVEL." WHERE blevel_id='".@$arr['tail']['badtail_level']."' "); 
//		@$arr['level'] =$db->fetch(@$res['level']);
		@$PerC=(100*(@$arr['num']['CO']))/(@$arr['bad']['STU']);
		?>
            <tr>
              <td style="text-align: center;"><?php if($_SESSION['admin_group']==1){ ?><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['stu_id']; ?>" class="selector flat"/><?php } else { echo $i;} ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur'];?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="#" data-toggle="modal" data-target="#myModal" data-artid="<?php echo @$arr['num']['stu_id']; ?>" class="btn" id="Mybtn"><i class="glyphicon glyphicon-user"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name'];?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=best&op=studetail&bt_id=<?php echo @$arr['num']['btail_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			 <a href="index.php?name=behavior&file=best&op=stuedit&bt_id=<?php echo @$arr['num']['btail_id']; ?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
			 <?php if($_SESSION['admin_group']==1){ ?>
				<a href="index.php?name=behavior&file=best&op=cldel&bt_id=<?php echo @$arr['num']['btail_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
				<?php } ?>
			  </td>
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

				<div id="myModal" class="modal fade" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">X</button>
								  <h4 class="modal-title"><i class="fa fa-user"></i>&nbsp;<?php echo _heading_title;?></h4>
							</div>
							<div class="modal-body">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
<style>
.modal-dialog{
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

   $('a[id="Mybtn"]').click(function(e){//Modal Event
		e.preventDefault();
		var elem = $(this);
		var id=elem.attr('data-artid');
//		alert(id);
		$.ajax({
		type : 'get',
//		url: $(this).attr('href'),
		url : 'modules/config/detailstudent.php', //Here you should run query to fetch records
		data : 'stu_id='+id, //Here pass id via 
		success : function(data){            
          $('.modal-body').html(data); //Show Data
       }
    });
  });

	$('a[data-confirm]').click(function(ev) {
		var href = $(this).attr('href');
		if (!$('#dataConfirmModal').length) {
			$('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button><h4 id="dataConfirmLabel"><?=_text_box_con_delete_head;?></h4></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn bg-aqua btn-flat" id="dataConfirmOK">OK</a></div></div></div></div>');
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
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
								"aoColumns": aoColumns,
								"responsive" : true,
								"dom" : 'lBfrtip',
								"buttons": [
									'copy', {"extend":'csv','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : '<?php echo _heading_title;?>'},,
									{"extend" : 'excel','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : '<?php echo _heading_title;?>'}, 
									{ // ????????????????????????????????????????????????????????? pdf
									"extend": 'pdf', // ??????????????????????????? pdf ????????????
									"exportOptions" : {
										columns: ':visible'
									},
									"text": 'PDF', // ??????????????????????????????????????????
									"pageSize": 'A4',   // ?????????????????????????????????????????????????????? A4
									"filename" : '<?php echo _heading_title;?>',
									"title" : '<?php echo _heading_title;?>',
									"customize":function(doc){ // ?????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????? pdfmake
									// ??????????????? style ????????????
										doc.defaultStyle = {
										font:'THSarabun',
										fontSize:16                                 
										};
										// ??????????????????????????????????????????????????? header ??????????????????????????????????????????????????????
////										doc.content[1].table.widths = [ 50, 'auto', '*', '*' ];
////										doc.styles.tableHeader.fontSize = 16; // ??????????????????????????? font ????????? header
////										var rowCount = doc.content[1].table.body.length; // ????????????????????????????????????????????????????????????????????????
										// ?????????????????????????????????????????????????????????????????????????????????????????? ???????????????????????????????????????????????????
////										for (i = 1; i < rowCount; i++) { // i ???????????????????????? 1 ??????????????? i ?????????????????????????????????????????????????????????
////											doc.content[1].table.body[i][0].alignment = 'center'; // ?????????????????????????????????????????????????????? 0
////											doc.content[1].table.body[i][1].alignment = 'center';
////											doc.content[1].table.body[i][2].alignment = 'left';
////											doc.content[1].table.body[i][3].alignment = 'right';
////										};                                  
////										console.log(doc); // ?????????????????? debug ?????? doc object proptery ???????????????????????????????????????????????????????????????
									} // ??????????????????????????????????????????????????????????????? pdf
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
} else {
@$res['count'] = $db->select_query("SELECT * FROM ".TB_BESTTAIL." where btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."' group by btail_stu"); 
@$rows['count'] = $db->rows(@$res['count']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >
    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=behavior&file=best&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a><?php if($_SESSION['admin_group']==1){ ?>&nbsp;&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a><?php } ?></div>
      <br>
      </div>
    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title; ?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['count'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_BEST." order by bt_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=best&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><?php if($_SESSION['admin_group']==1){ ?><input type="checkbox" id="check" class="selector flat all"><?php } else {?>#<?php } ?></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_best_name; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_best_count_stu;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['tail'] = $db->select_query("SELECT *,count(btail_id) as CO FROM ".TB_BESTTAIL." where btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."' and btail_id='".@$arr['num']['bt_id']."' "); 
		@$arr['tail'] =$db->fetch(@$res['tail']);

//		@$res['level'] = $db->select_query("SELECT * FROM ".TB_BESTLEVEL." WHERE blevel_id='".@$arr['tail']['badtail_level']."' "); 
//		@$arr['level'] =$db->fetch(@$res['level']);
		@$PerC=(100*(@$arr['tail']['CO']))/(@$rows['count']);
		?>
            <tr>
              <td style="text-align: center;"><?php if($_SESSION['admin_group']==1){ ?><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['bt_id']; ?>" class="selector flat"/><?php } else { echo $i;} ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['bt_name'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['tail']['CO']." (".number_format((@$PerC),2)."%)";?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=best&op=cldetail&bt_id=<?php echo @$arr['num']['bt_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
				<?php if($_SESSION['admin_group']==1){ ?>
				<a href="index.php?name=behavior&file=best&op=del&bt_id=<?php echo @$arr['num']['bt_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
				<?php } ?>
			  </td>
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
    </div>

	
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->

<script>
//jQuery Library Comes First
//Bootstrap Library
$(document).ready(function() { 
	$('a[data-confirm]').click(function(ev) {
		var href = $(this).attr('href');
		if (!$('#dataConfirmModal').length) {
			$('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button><h4 id="dataConfirmLabel"><?=_text_box_con_delete_head;?></h4></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn bg-aqua btn-flat" id="dataConfirmOK">OK</a></div></div></div></div>');
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
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
								"aoColumns": aoColumns,
								"responsive" : true,
								"dom" : 'lBfrtip',
								"buttons": [
									'copy', {"extend":'csv','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : '<?php echo _heading_title;?>'},,
									{"extend" : 'excel','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : '<?php echo _heading_title;?>'}, 
									{ // ????????????????????????????????????????????????????????? pdf
									"extend": 'pdf', // ??????????????????????????? pdf ????????????
									"exportOptions" : {
										columns: ':visible'
									},
									"text": 'PDF', // ??????????????????????????????????????????
									"pageSize": 'A4',   // ?????????????????????????????????????????????????????? A4
									"filename" : '<?php echo _heading_title;?>',
									"title" : '<?php echo _heading_title;?>',
									"customize":function(doc){ // ?????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????? pdfmake
									// ??????????????? style ????????????
										doc.defaultStyle = {
										font:'THSarabun',
										fontSize:16                                 
										};
										// ??????????????????????????????????????????????????? header ??????????????????????????????????????????????????????
////										doc.content[1].table.widths = [ 50, 'auto', '*', '*' ];
////										doc.styles.tableHeader.fontSize = 16; // ??????????????????????????? font ????????? header
////										var rowCount = doc.content[1].table.body.length; // ????????????????????????????????????????????????????????????????????????
										// ?????????????????????????????????????????????????????????????????????????????????????????? ???????????????????????????????????????????????????
////										for (i = 1; i < rowCount; i++) { // i ???????????????????????? 1 ??????????????? i ?????????????????????????????????????????????????????????
////											doc.content[1].table.body[i][0].alignment = 'center'; // ?????????????????????????????????????????????????????? 0
////											doc.content[1].table.body[i][1].alignment = 'center';
////											doc.content[1].table.body[i][2].alignment = 'left';
////											doc.content[1].table.body[i][3].alignment = 'right';
////										};                                  
////										console.log(doc); // ?????????????????? debug ?????? doc object proptery ???????????????????????????????????????????????????????????????
									} // ??????????????????????????????????????????????????????????????? pdf
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

				$('input.all').on('ifToggled', function (event) {
					var chkToggle;
					$(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
					$('input.selector:not(.all)').iCheck(chkToggle);
				});
			});
        </script>

<?php } else { echo "<meta http-equiv='refresh' content='1; url=index.php'>"; }?>
