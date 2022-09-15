<?php
if(!empty($_SESSION['stu_login'])){
$del='';

if($op=='del'){
		
		$del .=$db->del(TB_AFFTAIL," afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_aff='".$_GET['afft_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 
if($op=='delcl'){
		
		@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP.",".TB_STUDENT." where clg_area='".$_SESSION['stu_area']."' and clg_school='".$_SESSION['stu_school']."' and clg_group='".$_GET['cl_id']."' and clg_name='".$_GET['clg_gr']."' and stu_class=clg_group and stu_cn=clg_name order by clg_id "); 
		while(@$arr['cl'] = $db->fetch(@$res['cl'])){
		$del .=$db->del(TB_AFFTAIL," afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_stu='".@$arr['cl']['stu_id']."' ");
		}
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 
if($op=='cldel'){
		
		$del .=$db->del(TB_AFFTAIL," afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_id='".$_GET['afft_id']."' and afft_stu='".$_GET['stu_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 
if($op=='delall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			
			$del .=$db->del(TB_AFFTAIL," afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_aff='".$value."' ");
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
			
			$del .=$db->del(TB_AFFTAIL," afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_stu='".$value."' and afft_id='".$_GET['afft_id']."' ");
//			$db->closedb ();
		}
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
}
if($op=='studel'){
		
		$del .=$db->del(TB_AFFTAIL," afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_id='".$_GET['afft_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 
if($op=='studelall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			
			$del .=$db->del(TB_AFFTAIL," afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_id='".$_GET['afft_id']."' ");
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
//<form action="index.php?name=behavior&file=affairs&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
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
			url: "modules/behavior/processaffairs.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=affairs&route=<?php echo $route;?>';
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
		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=affairs&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>

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

		<form method="post" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >

  <!--  <div class="col-xs-12" align="right" >
	<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=affairs&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
      </div>
	 </div>-->


							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_put; ?></label>
							<div class="col-sm-6">
							<select  class="form-control css-require" name="Stu_best" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_put_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." where aff_area='".$_SESSION['stu_area']."' and aff_code='".$_SESSION['stu_school']."' ORDER BY aff_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['aff_id']."\"";
							echo ">".@$arr['bt']['aff_name']." [".DateTimeThai(@$arr['bt']['aff_Stime'])."-".DateTimeThai(@$arr['bt']['aff_Ftime'])."]</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_put_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Btail_name"></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_put_time;?></label>
									<div class="col-sm-4">
							<?php $DateTimeStart=date('Y-m-d');?>
							<div class="input-group date" id="dp1" data-date="<?php echo $DateTimeStart;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control" name="Pu_Dtime" class="form-control css-require" value="<?php echo $DateTimeStart;?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
									</div>
									<!-- /.input group -->
								</div>
							</div>
						    <!--<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_class; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" id="Stu_class4" name="Stu_class4" required="required">
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
							<select class="form-control css-require" id="classlist4" name="Stu_cn" required="required">
							<option value="" selected disabled>เลือกห้องเรียน</option>
							<?php
							for($i=1;$i<=3;$i++){
							echo "<option value=\"".$i."\"";
							echo ">".$i."</option>";
							}
							?>
							</select>
							</div>
							</div>	-->

						  <?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							@$res['num'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."'  and stu_class='".$_SESSION['stu_class']."' and stu_cn='".$_SESSION['stu_cn']."' and stu_suspend='0' order by id,stu_id"); 
							@$rows['num'] = $db->rows(@$res['num']);
							if(@$rows['num']) {
							?>
							<table id="example4" class="table table-bordered table-striped responsive" style="width:100%">
							  <thead>
								<tr >
								  <th width="1" style="text-align: center;"></th>
								  <th layout="block" style="text-align:center;" ><?php echo _text_box_table_tab4_stu_id; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_stu_name; ?></th>
								  <th layout="block" style="text-align:center;">ห้อง</th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_true; ?></th>
								  <th layout="block" style="text-align:center;"><?php echo _text_box_table_false; ?></th>
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
								  <td layout="block" style="text-align: center;"><input type="radio" name="Ck1[<?php echo $i;?>]" class="minimal" value="1" checked></td>
								  <td layout="block" style="text-align: center;"><input type="radio" name="Ck1[<?php echo $i;?>]" class="minimal" value="2" ></td>
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
								  <td class="center" colspan="12"><?php echo _text_no_results; ?></td>
								</tr>
								</table>
								<?php } ?>

							<div class="form-group">
							<div class="col-sm-4" >
							<input type="hidden" name="OP"  value="Add">
							<input type="hidden" name="Stu_class4"  value="<?=$_SESSION['stu_class'];?>">
							<input type="hidden" name="Stu_cn"  value="<?=$_SESSION['stu_class'];?>">
							<br>
							</div>
							</div>

							<div id="Classlist4" ></div>
						</form>

							</div>
						</div>

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
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."' and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['best'] = $db->select_query("SELECT * FROM ".TB_AFFTAIL." where afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_aff='".$_GET['afft_id']."'"); 
		@$arr['best']= $db->fetch(@$res['best']);
?>
		<div align="right" >
		<div class="form-group"><a href="index.php?name=behavior&file=affairs&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a href="index.php?name=behavior&file=affairs&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_put; ?></label>
							<div class="col-sm-4">
							<select  class="form-control css-require" name="Stu_best" readonly>
							<option value="" selected disabled><?php echo _text_box_table_stu_put_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." where aff_area='".$_SESSION['stu_area']."' and aff_code='".$_SESSION['stu_school']."' ORDER BY aff_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['aff_id']."\" ";
							if(@$arr['best']['afft_id']==@$arr['bt']['aff_id']){echo " selected ";}
							echo ">".@$arr['bt']['aff_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_put_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Btail_name" readonly><?php echo @$arr['best']['afft_name']; ?></textarea>
							</div>
							</div>

							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_put_time;?></label>
									<div class="col-sm-4">
							<?php $DateTimeStart=date('Y-m-d');?>
							<div class="input-group date" id="dp1" data-date="<?php echo $DateTimeStart;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control" name="Pu_Dtime" class="form-control css-require" value="<?php echo @$arr['best']['afft_date']; ?>" readonly>
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
									</div>
									<!-- /.input group -->
								</div>
							</div>
							</div>

							<!--<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_put_interv; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="Btail_per" readonly>
							<option value="" selected disabled><?php echo _text_box_table_stu_put_interv_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['stu_area']."' and per_code='".$_SESSION['stu_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\" ";
							if(@$arr['best']['afft_per']==@$arr['per']['per_ids']){echo " selected ";}
							echo ">".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>-->

						</div>
						</div>
				</form>
<?php
}else if($op=='stuedit' ){
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."' and stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['best'] = $db->select_query("SELECT * FROM ".TB_AFFTAIL." where afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_aff='".$_GET['afft_id']."' and afft_stu='".$_GET['stu_id']."'  "); 
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
			url: "modules/behavior/processaffairs.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=affairs&route=<?php echo $route;?>';
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
		<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=affairs&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_put; ?></label>
							<div class="col-sm-4">
							<select  class="form-control css-require" name="Stu_best" readonly>
							<option value="" selected disabled><?php echo _text_box_table_stu_put_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." where aff_area='".$_SESSION['stu_area']."' and aff_code='".$_SESSION['stu_school']."' ORDER BY aff_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['aff_id']."\" ";
							if(@$arr['best']['afft_aff']==@$arr['bt']['aff_id']){echo " selected ";}
							echo ">".@$arr['bt']['aff_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_put_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Btail_name" ><?php echo @$arr['best']['afft_name']; ?></textarea>
							</div>
							</div>
							<!-- time Picker -->
								<div class="form-group has-feedback">
									<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_put_time;?></label>
									<div class="col-sm-4">
							<?php $DateTimeStart=date('Y-m-d');?>
							<div class="input-group date" id="dp1" data-date="<?php echo $DateTimeStart;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control" name="Pu_Dtime" class="form-control css-require" value="<?php echo @$arr['best']['afft_date']; ?>" readonly>
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
									</div>
									<!-- /.input group -->
								</div>
							</div>
							</div>
							<!--<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_put_interv; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="Btail_per" >
							<option value="" selected disabled><?php echo _text_box_table_stu_put_interv_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['stu_area']."' and per_code='".$_SESSION['stu_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\" ";
							if(@$arr['best']['afft_per']==@$arr['per']['per_ids']){echo " selected ";}
							echo ">".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>-->
							<div class="form-group" >
							<label class="col-sm-3 control-label" >สถานะ</label>
							<div class="col-sm-6 ">
							<input type="radio" name="Best_status" class="minimal" value="1" <?php if($arr['best']['afft_status']==1){ echo "checked";}?>>&nbsp;ร่วมกิจกรรม&nbsp;&nbsp;
							<input type="radio" name="Best_status" class="minimal" value="0" <?php if($arr['best']['afft_status']==0){ echo "checked";}?>>&nbsp;ไม่ร่วมกิจกรรม
							</div>
							</div>
							<div class="form-group">
							<div class="col-sm-4" >
							<input type="hidden" name="OP"  value="Edit">
							<input name="Best_stu" type="hidden" value="<?php echo $_GET['stu_id'];?>">
							<input name="Stu_best" type="hidden" value="<?php echo $arr['best']['afft_aff'];?>">
							<br>
							</div>
							</div>
						</div>
						</div>
				</form>
<?php
}else if($op=='scldetail' ){
@$res['count'] = $db->select_query("SELECT * FROM ".TB_AFFTAIL." where afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_aff='".$_GET['afft_id']."' group by afft_stu"); 
@$rows['count'] = $db->rows(@$res['count']);
@$res['tails'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." where aff_area='".$_SESSION['stu_area']."' and aff_code='".$_SESSION['stu_school']."' and aff_id='".$_GET['afft_id']."' "); 
@$arr['tails'] =$db->fetch(@$res['tails']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >
    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=behavior&file=affairs&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a></div>
      <br>
      </div>
    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title; ?>&nbsp;<span class="badge bg-red"><?php echo @$arr['tails']['aff_name']; ?></span>&nbsp;<span class="badge bg-green"><?php echo  DateTimeThai(@$arr['tails']['aff_Stime']); ?></span> - <span class="badge bg-green"><?php echo  DateTimeThai(@$arr['tails']['aff_Ftime']); ?></span></h3>
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
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." where clg_area='".$_SESSION['stu_area']."' and clg_school='".$_SESSION['stu_school']."' order by clg_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=affairs&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_affairsx_name; ?></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_affairsx_name_room; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_affairs_countstu;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_true;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_false;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_affairsx_bar;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;

		//@$res['nums'] = $db->select_query("SELECT *,count(whcl_id) as CO FROM ".TB_WHITECLTAIL." group by whcl_class "); 
		while (@$arr['num'] = $db->fetch(@$res['num'])){

		@$res['stu'] = $db->select_query("SELECT *,count(DISTINCT IF(afft_status=0,afft_stu,NULL)) as CO,count(DISTINCT IF(afft_status=1,afft_stu,NULL)) as AC FROM ".TB_STUDENT." , ".TB_AFFTAIL." where afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and stu_class='".@$arr['num']['clg_group']."' and afft_stu=stu_id and stu_cn='".@$arr['num']['clg_name']."' "); 
		@$rows['stu'] = $db->fetch(@$res['stu']);

		@$res['cc'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_class='".@$arr['num']['clg_group']."' and stu_cn='".@$arr['num']['clg_name']."' "); 
		@$rows['cc'] = $db->rows(@$res['cc']);

		@$res['tail'] = $db->select_query("SELECT *,count(afft_stu) as STU FROM ".TB_AFFTAIL." where afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_stu='".@$arr['stu']['stu_id']."' group by afft_stu"); 
		@$arr['tail'] = $db->fetch(@$res['tail']);

		$TT=@$rows['stu']['CO'];
		$FF=@$rows['stu']['AC'];
//		@$res['level'] = $db->select_query("SELECT * FROM ".TB_WHITECLASSLEVEL." WHERE blevel_id='".@$arr['tail']['badtail_level']."' "); 
//		@$arr['level'] =$db->fetch(@$res['level']);
		@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['num']['clg_group']."' "); 
		@$arr['cl'] =$db->fetch(@$res['cl']);

		//@$res['num'] = $db->select_query("SELECT *,count(whcl_id) as CO FROM ".TB_WHITECLTAIL." group by whcl_id order by CO desc"); 
		//@$rows['num'] = $db->rows(@$res['num']);

//		@$PerC=(100*(@$arr['num']['CO']))/(@$rows['count']);
		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['whcl_id']; ?>" class="selector flat"/></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['cl']['class_name'];?></td>
              <td layout="block" style="text-align: right;"><?php echo @$arr['num']['clg_name'];?></td>
              <td layout="block" style="text-align: right;"><?php echo @$rows['cc'];?></td>
              <td layout="block" style="text-align: right;"><?php echo $TT;?></td>
              <td layout="block" style="text-align: right;"><?php echo $FF;?></td>
              <td layout="block" style="text-align: center;"><?php echo progress_bar_percentage($TT,@$rows['cc']);?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=affairs&op=cldetail&afft_id=<?php echo $_GET['afft_id'];?>&cl_id=<?php echo @$arr['num']['clg_group'];?>&clg_gr=<?php echo @$arr['num']['clg_name'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>

				<a href="index.php?name=behavior&file=affairs&op=delcl&afft_id=<?php echo $_GET['afft_id'];?>&cl_id=<?php echo @$arr['num']['clg_group'];?>&clg_gr=<?php echo @$arr['num']['clg_name'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>

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
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
								"aoColumns": aoColumns,
								"responsive" : true,
								"dom" : 'lBfrtip',
								"pageLength" : 25,
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
}else if($op=='cldetail' ){

@$res['num'] = $db->select_query("SELECT *,count(afft_stu) as CO FROM ".TB_AFFTAIL." as a, ".TB_STUDENT." as b where afft_aff='".$_GET['afft_id']."' and afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_stu=stu_id and  stu_class='".$_GET['cl_id']."' and stu_cn='".$_GET['clg_gr']."' group by afft_stu order by CO desc,stu_class,stu_id "); 
@$rows['num'] = $db->rows(@$res['num']);

@$res['tail'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." where aff_area='".$_SESSION['stu_area']."' and aff_code='".$_SESSION['stu_school']."' and aff_id='".$_GET['afft_id']."' "); 
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
		<div class="form-group"><a href="index.php?name=behavior&file=affairs&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a>&nbsp;<a href="index.php?name=behavior&file=affairs&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen_detail_class; ?>&nbsp;<span class="badge bg-red"><?php echo @$arr['tail']['aff_name']; ?></span>&nbsp;<span class="badge bg-green"><?php echo  DateTimeThai(@$arr['tail']['aff_Stime']); ?></span> - <span class="badge bg-green"><?php echo  DateTimeThai(@$arr['tail']['aff_Ftime']); ?></span></h3>
								<div class="box-tools pull-right">
								<span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['num']; ?></span>
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">
	  <?php
		
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=affairs&op=cldelall&afft_id=<?php echo $_GET['afft_id'];?>&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_affairs_stu_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_affairs_stu_class; ?></th>
              <th layout="block" style="text-align:center;">ห้อง</th>
              <th layout="block" style="text-align:center;">คะแนน</th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['num']['stu_class']."' "); 
		@$arr['class'] =$db->fetch(@$res['class']);
		//@$res['tail'] = $db->select_query("SELECT * FROM ".TB_AFFTAIL." WHERE afft_id='".@$arr['num']['afft_aff']."' "); 
		//@$arr['tail'] =$db->fetch(@$res['tail']);
//		@$res['level'] = $db->select_query("SELECT * FROM ".TB_AFFAIRSLEVEL." WHERE blevel_id='".@$arr['tail']['badtail_level']."' "); 
//		@$arr['level'] =$db->fetch(@$res['level']);
		//@$PerC=(100*(@$arr['num']['CO']))/(@$arr['bad']['STU']);
		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['stu_id']; ?>" class="selector flat"/></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur'];?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="#" data-toggle="modal" data-target="#myModal" data-artid="<?php echo @$arr['num']['stu_id']; ?>" class="btn" id="Mybtn"><i class="glyphicon glyphicon-user"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name'];?></td>
			  <td style="text-align: center;"><?php echo @$arr['num']['stu_cn']; ?></td>
			  <td style="text-align: center;"><?php if($arr['num']['afft_status']==1){echo @$arr['tail']['aff_point'];} else { echo "<font class='text-red'>ไม่ร่วมกิจกรรม</font>";} ?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=affairs&op=studetail&afft_id=<?php echo @$arr['num']['afft_aff'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			 <a href="index.php?name=behavior&file=affairs&op=stuedit&afft_id=<?php echo @$arr['num']['afft_aff']; ?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=behavior&file=affairs&op=cldel&afft_id=<?php echo @$arr['num']['afft_id'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
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
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
								"aoColumns": aoColumns,
								"responsive" : true,
								"dom" : 'lBfrtip',
								"pageLength": 50,
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
} else {

@$res['count'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."' "); 
@$rows['count'] = $db->rows(@$res['count']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >
    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=behavior&file=affairs&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a></div>
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
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." WHERE aff_area='".$_SESSION['stu_area']."' and aff_code='".$_SESSION['stu_school']."' order by aff_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=affairs&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_affairs_name; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_affairs_Stime;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_affairs_Ftime;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_affairs_count_stu;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_affairs_count_stu_not;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		//SELECT *,count(DISTINCT IF(afft_status=0,afft_id,NULL)) as NO,count(DISTINCT IF(afft_status=1,afft_id,NULL)) as AC FROM web_afftail where afft_area='101726' and afft_code='44012028' and afft_aff='2' 
		@$res['tail'] = $db->select_query("select *,count(DISTINCT IF(afft_status=0,afft_stu,NULL)) as CO,count(DISTINCT IF(afft_status=1,afft_stu,NULL)) as AC FROM ".TB_AFFTAIL." where afft_area='".$_SESSION['stu_area']."' and afft_code='".$_SESSION['stu_school']."' and afft_aff='".@$arr['num']['aff_id']."' "); 
		@$arr['tail'] =$db->fetch(@$res['tail']);

//		@$res['level'] = $db->select_query("SELECT * FROM ".TB_AFFAIRSLEVEL." WHERE blevel_id='".@$arr['tail']['badtail_level']."' "); 
//		@$arr['level'] =$db->fetch(@$res['level']);
		@$PerC=(100*(@$arr['tail']['CO']))/(@$rows['count']);
		$MG=@$arr['tail']['AC'];
		$PerG=((@$arr['tail']['AC'])*100)/(@$rows['count']);
		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['aff_id']; ?>" class="selector flat"/></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['aff_name'];?></td>
              <td layout="block" style="text-align: center;"><?php echo DateTimeThai(@$arr['num']['aff_Stime']);?></td>
              <td layout="block" style="text-align: center;"><?php echo DateTimeThai(@$arr['num']['aff_Ftime']);?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['tail']['CO']." (".number_format((@$PerC),2)."%)";?></td>
              <td layout="block" style="text-align: center;"><?php echo $MG." (".number_format(($PerG),2)."%)";?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=affairs&op=scldetail&afft_id=<?php echo @$arr['num']['aff_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
				<a href="index.php?name=behavior&file=affairs&op=del&afft_id=<?php echo @$arr['num']['aff_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
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
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
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
