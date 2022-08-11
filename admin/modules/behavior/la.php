<?php
if(!empty($_SESSION['admin_login'])){
$del='';
if($op=='del'){
		
		$del .=$db->del(TB_LATAIL," lat_tail='".$_GET['lat_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 
if($op=='cldel'){
		
		$del .=$db->del(TB_LATAIL," lat_id='".$_GET['lat_id']."' and lat_stu='".$_GET['stu_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 
if($op=='delall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			
			$del .=$db->del(TB_LATAIL," lat_id='".$value."' ");
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
			
			$del .=$db->del(TB_LATAIL," lat_stu='".$value."' and lat_tail='".$_GET['lat_id']."' ");
//			$db->closedb ();
		}
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
}
if($op=='studel'){
		
		$del .=$db->del(TB_LATAIL," lat_id='".$_GET['lat_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 
if($op=='studelall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			
			$del .=$db->del(TB_LATAIL," lat_id='".$_GET['lat_id']."' ");
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
//<form action="index.php?name=behavior&file=la&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
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
			url: "modules/behavior/processla.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=la&route=<?php echo $route;?>';
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

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=la&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_la_stu_form_name; ?></label>
							<div class="col-sm-6">
							<select class="form-control select2" multiple="multiple" name="lat_stu[]" >
							<?php
							
							@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." ORDER BY stu_id desc");
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_ent; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="lat_ext" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_exit_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_LA." ORDER BY la_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['la_id']."\"";
							echo ">".@$arr['bt']['la_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_exit_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Etail_name"></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_exit_date_in;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='dp1' >
											<input type='text' class="form-control" name="lat_timeIn" data-date-format="yyyy-mm-dd">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_exit_date_out;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='dp2' >
											<input type='text' class="form-control" name="lat_timeOut" data-date-format="yyyy-mm-dd">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
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
}else if($op=='studetail' ){
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['best'] = $db->select_query("SELECT * FROM ".TB_LATAIL." WHERE lat_id='".$_GET['lat_id']."'"); 
		@$arr['best']= $db->fetch(@$res['best']);
?>
		<div align="right" >
		<div class="form-group"><a href="index.php?name=behavior&file=la&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_ent; ?></label>
							<div class="col-sm-4">
							<select  class="form-control css-require" name="lat_ext" disabled>
							<option value="" selected disabled><?php echo _text_box_table_stu_exit_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_LA." ORDER BY la_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['la_id']."\" ";
							if(@$arr['best']['lat_tail']==@$arr['bt']['la_id']){echo " selected ";}
							echo ">".@$arr['bt']['la_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_exit_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Etail_name" readonly><?php echo @$arr['best']['lat_tailname']; ?></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_exit_date_in;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='dp1' >
											<input type='text' class="form-control" name="lat_timeIn" data-date-format="yyyy-mm-dd" value="<?php echo @$arr['best']['lat_dateIn']; ?>" readonly>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_exit_date_out;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='dp2' >
											<input type='text' class="form-control" name="lat_timeOut" data-date-format="yyyy-mm-dd" value="<?php echo @$arr['best']['lat_dateOut']; ?>" readonly>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>



						</div>
						</div>
				</form>
<?php
}else if($op=='stuedit' ){
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['best'] = $db->select_query("SELECT * FROM ".TB_LATAIL." WHERE lat_id='".$_GET['lat_id']."'"); 
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
			url: "modules/behavior/processla.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=la&route=<?php echo $route;?>';
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
		<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=la&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_ent; ?></label>
							<div class="col-sm-4">
							<select  class="form-control css-require" name="lat_ext" >
							<option value="" selected disabled><?php echo _text_box_table_stu_exit_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_LA." ORDER BY la_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['la_id']."\" ";
							if(@$arr['best']['lat_tail']==@$arr['bt']['la_id']){echo " selected ";}
							echo ">".@$arr['bt']['la_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_exit_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Etail_name" ><?php echo @$arr['best']['lat_tailname']; ?></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_exit_date_in;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='dp1' >
											<input type='text' class="form-control" name="lat_timeIn" data-date-format="yyyy-mm-dd" value="<?php echo @$arr['best']['lat_dateIn']; ?>">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_exit_date_out;?></label>
									<div class="col-sm-4">
										<div class='input-group date' id='dp2' >
											<input type='text' class="form-control" name="lat_timeOut" data-date-format="yyyy-mm-dd" value="<?php echo @$arr['best']['lat_dateOut']; ?>">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<!-- /.input group -->
								</div>

							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Edit"><input name="lat_stu" type="hidden" value="<?php echo $_GET['stu_id'];?>"><input name="lat_id" type="hidden" value="<?php echo $_GET['lat_id'];?>">
							<br>
							</div>
							</div>
						</div>
						</div>
				</form>
<?php
}else if($op=='cldetail' ){

@$res['bad'] = $db->select_query("SELECT *,count(lat_stu) as STU FROM ".TB_LATAIL." WHERE lat_tail='".$_GET['lat_id']."' group by lat_tail"); 
 @$arr['bad']= $db->fetch(@$res['bad']);
@$res['tail'] = $db->select_query("SELECT * FROM ".TB_LA." WHERE la_id='".$_GET['lat_id']."' "); 
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
		<div class="form-group"><a href="index.php?name=behavior&file=la&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a>&nbsp;<a href="index.php?name=behavior&file=la&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen_detail_class; ?>&nbsp;<span class="badge bg-red"><?php echo @$arr['tail']['la_name']; ?></span></h3>
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
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_LATAIL." as a, ".TB_STUDENT." as b where a.lat_tail='".$_GET['lat_id']."'  and a.lat_stu=b.stu_id order by b.stu_class,b.stu_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=la&op=cldelall&lat_id=<?php echo $_GET['lat_id'];?>&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline" >
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_la_stu_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_la_stu_class; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_exit_detail; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_exit_date_out; ?></th>
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
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['stu_id']; ?>" class="selector flat"/></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur'];?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="#" data-toggle="modal" data-target="#myModal<?php echo $i;?>" data-artid="<?php echo @$arr['num']['stu_id']; ?>" class="btn" id="Mybtn"><i class="glyphicon glyphicon-user"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name'];?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['lat_tailname'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['lat_check'];?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=la&op=studetail&lat_id=<?php echo @$arr['num']['lat_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			 <a href="index.php?name=behavior&file=la&op=stuedit&lat_id=<?php echo @$arr['num']['lat_id']; ?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=behavior&file=la&op=cldel&lat_id=<?php echo @$arr['num']['lat_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
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
}else if($op=='stuprint' ){
		//ob_end_clean();
		$exclude = array('.','..','.htaccess');
		$objOpenx = opendir(WEB_PATH."/MyPDF/");
		$q = 'la-'.$_GET['stu_id'].'-'.$_GET['lat_id'].'.pdf';
		while(false!== ($filex = readdir($objOpenx))) {
			if(strpos(strtolower($filex),$q)!== false &&!in_array($filex,$exclude)) {
				if($filex=='la-'.$_GET['stu_id'].'-'.$_GET['lat_id'].'.pdf' ) { $Statusx=1;} else {$Statusx=0;}
			}
		}
		closedir($objOpenz);
		//closedir($objOpeny);
		//echo $Statusy;
		if($Statusx !=1){
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['nut'] = $db->select_query("SELECT * FROM ".TB_LATAIL." WHERE lat_area='".$_SESSION['admin_area']."' and lat_code='".$_SESSION['admin_school']."' and lat_id='".$_GET['lat_id']."'"); 
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
			url: "modules/behavior/print_lastu.php",
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
  	//			 window.location='index.php?name=behavior&file=la&route=<?php echo $route;?>';
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
      <a href="../../../MyPDF/la-<?php echo $_GET['stu_id'];?>-<?php echo $_GET['lat_id'];?>.pdf" class="btn bg-green btn-flat" target="_blank"><i class="fa fa-print" >&nbsp;<?php echo _text_report_pdf_ok; ?></i></a>
</div>
</div>

<form method="post" enctype="multipart/form-data" id="formUp" role="formUp" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
<input type="hidden" name="StuId" value="<?php echo $_GET['stu_id'];?>">
<input type="hidden" name="NutId" value="<?php echo $_GET['lat_id'];?>">
</form>
<?php
	} else {
	?>
<div align="center" >
      <a href="../../../MyPDF/la-<?php echo $_GET['stu_id'];?>-<?php echo $_GET['lat_id'];?>.pdf" class="btn bg-green btn-flat" target="_blank"><i class="fa fa-print" >&nbsp;<?php echo _text_report_pdf_ok; ?></i></a>
</div>
<?php
}
?>
<?php
}else if($op=='update' ){
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['best'] = $db->select_query("SELECT * FROM ".TB_LATAIL." WHERE lat_area='".$_SESSION['admin_area']."' and lat_code='".$_SESSION['admin_school']."' and lat_id='".$_GET['lat_id']."'"); 
		@$arr['best']= $db->fetch(@$res['best']);
		$Tail=@$arr['best']['lat_id'];
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
			url: "modules/behavior/la_upstatus.php",
			data: $('#formUp').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=la&route=<?php echo $route;?>';
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
		<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=la&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>
				<form method="post" enctype="multipart/form-data" id="formUp" role="formUp" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_table_la_stu_form_badtail; ?>&nbsp;<span class="label label-success"><?php echo @$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?></span></h3>
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

						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_exit_status; ?></label>
							<div class="col-sm-4" >
							<input type="radio" name="Stu_fstatus" class="minimal" value="1" >&nbsp;<?php echo _text_box_table_stu_exit_status_ok;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_fstatus" class="minimal" value="2" >&nbsp;<?php echo _text_box_table_stu_exit_status_no;?>&nbsp;&nbsp;
							</div>
							</div>

							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Up"><input name="Ent_stu" type="hidden" value="<?php echo $_GET['stu_id'];?>"><input name="Ent_id" type="hidden" value="<?php echo $_GET['lat_id'];?>">
							<br>
							</div>
							</div>
						</div>
						</div>
				</form>
<?php
} else {
@$res['count'] = $db->select_query("SELECT * FROM ".TB_LATAIL." group by lat_id"); 
@$rows['count'] = $db->rows(@$res['count']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >
    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=behavior&file=la&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a></div>
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
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_LATAIL." , ".TB_STUDENT." where  lat_area='".$_SESSION['admin_area']."' and lat_code='".$_SESSION['admin_school']."' and lat_stu=stu_id order by stu_class,stu_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=la&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline" >
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_la_stu_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_la_stu_class; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_exit_datetime; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_ent; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_exit_status; ?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['num']['stu_class']."' "); 
		@$arr['class'] =$db->fetch(@$res['class']);
		@$res['la'] = $db->select_query("SELECT * FROM ".TB_LA." WHERE la_id='".@$arr['num']['lat_tail']."' "); 
		@$arr['la'] =$db->fetch(@$res['la']);
		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['lat_id']; ?>" class="selector flat"/></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur'];?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="#" data-toggle="modal" data-target="#myModal<?php echo $i;?>" data-artid="<?php echo @$arr['num']['stu_id']; ?>" class="btn" id="Mybtn"><i class="glyphicon glyphicon-user"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name'];?></td>
              <td layout="block" style="text-align: center;"><?php echo ShortDateThai(@$arr['num']['lat_dateIn']);?> - <?php echo ShortDateThai(@$arr['num']['lat_dateOut']);?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['la']['la_name'];?></td>
              <td layout="block" style="text-align: center;"><?php if(@$arr['num']['lat_con'] ==1){ echo "<button class=\"btn bg-green btn-flat btn-sm\" type=\"button\" >"._text_box_table_stu_exit_status_ok."</button>";} else if(@$arr['num']['lat_con'] ==2){ echo "<button class=\"btn bg-red btn-flat btn-sm\" type=\"button\" >"._text_box_table_stu_exit_status_no."</button>";} else {echo "<a href=\"index.php?name=behavior&file=la&op=update&lat_id=".@$arr['num']['lat_id']."&stu_id=".@$arr['num']['stu_id']."&route=".$route."\" class=\"btn bg-orange btn-flat btn-sm\" >"._text_box_table_stu_exit_status_yy."</a>";}?></td>

			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=la&op=stuprint&lat_id=<?php echo @$arr['num']['lat_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-orange btn-flat btn-sm" ><i class="fa fa-print "></i></a>
			 <a href="index.php?name=behavior&file=la&op=studetail&lat_id=<?php echo @$arr['num']['lat_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			 <a href="index.php?name=behavior&file=la&op=stuedit&lat_id=<?php echo @$arr['num']['lat_id']; ?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=behavior&file=la&op=cldel&lat_id=<?php echo @$arr['num']['lat_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
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
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
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
			$('#dp1').datepicker({
				format: 'yyyy-mm-dd',
				startDate: '-3d'
			});
			$('#dp2').datepicker({
				format: 'yyyy-mm-dd',
				startDate: '-3d'
			});
			$('#dp3').datepicker({
				format: 'yyyy-mm-dd',
				startDate: '-3d'
			});
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
