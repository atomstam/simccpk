<link href="../plugins/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="../plugins/fileinput/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
<script src="../plugins/fileinput/js/plugins/sortable.js" type="text/javascript"></script>
<script src="../plugins/fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="../plugins/fileinput/js/locales/th.js" type="text/javascript"></script>
<script src="../plugins/fileinput/themes/explorer/theme.js" type="text/javascript"></script>
<style>
.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar .file-input {
    display: table-cell;
    max-width: 220px;
}
</style>
<?php
if(!empty($_SESSION['person_login'])){
$del='';
if($_SESSION['person_group']==1){ 
if($op=='del'){
		@$res['subj'] = $db->select_query("SELECT * FROM ".TB_GD_SUBJ." where id='".$_GET['st_id']."' ");
		@$arr['subj'] = $db->fetch(@$res['subj']);
		$del .=$db->del(TB_GD_TRAN," tran_area='".$_SESSION['person_area']."' and tran_school='".$_SESSION['person_school']."' and tran_subj='".@$arr['subj']['subj_pin']."' ");

		$del .=$db->del(TB_GD_SUBJ," subj_area='".$_SESSION['person_area']."' and subj_school='".$_SESSION['person_school']."' and id='".$_GET['st_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 

if($op=='delall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			@$res['subj'] = $db->select_query("SELECT * FROM ".TB_GD_SUBJ." where id='".$value."' ");
			@$arr['subj'] = $db->fetch(@$res['subj']);
			$del .=$db->del(TB_GD_TRAN," tran_area='".$_SESSION['person_area']."' and tran_school='".$_SESSION['person_school']."' and tran_subj='".@$arr['subj']['subj_pin']."' ");
			$del .=$db->del(TB_GD_SUBJ," subj_area='".$_SESSION['person_area']."' and subj_school='".$_SESSION['person_school']."' and id='".$value."' ");
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
if($op=='import' and $action=='' ){
?>
<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
</style>
<script>
 $(function() {
//twitter bootstrap script
 $("button#submitForm").click(function(e){
		e.preventDefault(); // <-- important
//			var form_data = new FormData(document.getElementById("formImport"));

			$.ajax({
			type: "POST",
			url: "modules/academic/processsubj.php",
			data: $('#formImport').serialize(),
			success: function(msg){
				var messageText =msg.message;
				//alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=academic&file=subj&route=<?php echo $route;?>';
				}, 1000);
			} else {
//                $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#formImport')[0].reset();
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

<div class="row">
   <div class="col-md-12">


      <div class="alert alert-success" name="thanks" id="thanks" style="display: none">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_ok; ?></span>
      </div>
      <div class="alert alert-danger" name="error" id="error" style="display: none">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_fail; ?></span>
      </div>

		<div align="right" ><div class="form-group"><button class="btn btn-success" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=academic&file=subj&route=<?php echo $route;?>" class="btn btn-danger"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>

				<form method="post" enctype="multipart/form-data" id="formImport" role="formImport" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-warning" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-upload"></i>
                                    <h3 class="box-title"><?php echo _button_importcsv; ?></h3>
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
							<label class="col-sm-2 control-label col-sm-pad" ><?php echo _text_box_form_onet_year; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4">
							<select  class="form-control" id="P_year" name="P_year" required="required" >
							<option value="" selected disabled><?php echo _text_box_form_onet_year;?></option>
							<?php
							@$res['ony'] = $db->select_query("SELECT * FROM ".TB_YEAR." where yy_achiev='1' ORDER BY yy_id");
							while (@$arr['ony'] = $db->fetch(@$res['ony'])){
							$year_select=@$arr['ony']['ony_year'];
							echo "<option  value=\"".@$arr['ony']['yy_name']."\"";
							echo ">ปีการศึกษา ".@$arr['ony']['yy_name']."</option>";
							}
							?>
							</select>	
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-2 control-label col-sm-pad" ><?php echo _button_importcsv_select_sgs_term1; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<!-- the avatar markup -->
								<div id="kv-avatar-errors-1" class="center-block" style="width:300px;display:none"></div>
								<div id="showFile" ></div>
								<input id="input-b7" name="input-b7" type="file" class="file-loading">
								<!-- your server code `avatar_upload.php` will receive `$_FILES['avatar']` on form submission -->
								<script>
									var btnCust = '<button type="button" class="btn btn-default" title="Add file tags" ' + 
									'onclick="alert(\'Call your custom code here.\')">' +
									'<i class="glyphicon glyphicon-tag"></i>' +
									'</button>'; 
								$(document).ready(function () {
									$("#input-b7").fileinput({
										showPreview: true,
										showUpload: true,
										showRemove: true,
										maxFileSize: 2048,
										required: true,
										validateInitialCount: true,
										overwriteInitial: false,
										initialPreviewAsData: false,
										elErrorContainer: '#kv-avatar-errors-1',
										uploadUrl: '../plugins/fileinput/upload_subj.php',
										allowedFileExtensions: ["xls", "xlsx", "csv"]
									});
										$('#input-b7').on('fileuploaded', function(event, data) {
										var formdata = data.form, files = data.files, 
												extradata = data.extra, responsedata = data.response;
	//											alert(responsedata)
												console.log('File batch upload success');
										 $("#showFile").append('<input type=hidden name=Icon value='+responsedata+'>');
										});
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>

							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-2 control-label col-sm-pad" ><?php echo _button_importcsv_select_sgs_term2; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<!-- the avatar markup -->
								<div id="kv-avatar-errors-2" class="center-block" style="width:300px;display:none"></div>
								<div id="showFile2" ></div>
								<input id="input-b2" name="input-b2" type="file" class="file-loading">
								<!-- your server code `avatar_upload.php` will receive `$_FILES['avatar']` on form submission -->
								<script>
									var btnCust = '<button type="button" class="btn btn-default" title="Add file tags" ' + 
									'onclick="alert(\'Call your custom code here.\')">' +
									'<i class="glyphicon glyphicon-tag"></i>' +
									'</button>'; 
								$(document).ready(function () {
									$("#input-b2").fileinput({
										showPreview: true,
										showUpload: true,
										showRemove: true,
										maxFileSize: 2048,
										required: true,
										validateInitialCount: true,
										overwriteInitial: false,
										initialPreviewAsData: false,
										elErrorContainer: '#kv-avatar-errors-2',
										uploadUrl: '../plugins/fileinput/upload_subj.php',
										allowedFileExtensions: ["xls", "xlsx", "csv"]
									});
										$('#input-b2').on('fileuploaded', function(event, data) {
										var formdata2 = data.form, files2 = data.files, 
												extradata2 = data.extra, responsedata2 = data.response;
	//											alert(responsedata)
												console.log('File batch upload success');
										 $("#showFile2").append('<input type=hidden name=Icon2 value='+responsedata2+'>');
										});
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>

							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-2 control-label col-sm-pad" ><?php echo _text_box_form_import_sample_file; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6"><a href="../uploads/View_ClassTeacher.xls" class="btn btn-info"><i class="fa fa-file"></i>&nbsp;<?php echo _button_importcsv_select_sgs;?></a>
							</div>
							</div>
							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Import"><input type="hidden" name="P_gr"  value="1">
							<br>
							</div>
							</div>

							</div>
						</div>

</form>


	</div>
</div>
<?php
} else if($op=='add' and $action=='' ){
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">
<?php
//<form action="index.php?name=academic&file=subj&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
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
			url: "modules/academic/processsubj.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=academic&file=subj&route=<?php echo $route;?>';
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

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=academic&file=subj&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
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
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_form_onet_year; ?></label>
							<div class="col-md-3 col-sm-4 col-xs-4">
							<select  class="form-control" id="P_year" name="P_year" required="required" >
							<option value="" selected disabled><?php echo _text_box_form_onet_year;?></option>
							<?php
							@$res['ony'] = $db->select_query("SELECT * FROM ".TB_YEAR." where yy_achiev='1' ORDER BY yy_id");
							while (@$arr['ony'] = $db->fetch(@$res['ony'])){
							echo "<option  value=\"".@$arr['ony']['yy_name']."\"";
							echo ">ปีการศึกษา ".@$arr['ony']['yy_name']."</option>";
							}
							?>
							</select>	
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_CODE_PIN; ?></label>
							<div class="col-sm-2"><input type="text" name="CodePin"  class="form-control css-require" placeholder="1234" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_NAME; ?></label>
							<div class="col-sm-5"><input type="text" name="Name"  class="form-control css-require" placeholder="1234" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_ORDER; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="Class" required="required">
							<option value="" selected disabled><?php echo _ADMIN_FORM_SUBJ_ORDER;?></option>
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
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_TERM; ?></label>
							<div class="col-sm-2">
							<select  class="form-control css-require" name="Term" required="required">
							<option value="1" selected>1</option>
							<option value="2" >2</option>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_UNIT; ?></label>
							<div class="col-sm-2">
							<select  class="form-control css-require" name="Unit" required="required">
							<option value="0.5" selected>0.5</option>
							<option value="1.0" >1.0</option>
							<option value="1.5" >1.5</option>
							<option value="2.0" >2.0</option>
							<option value="2.5" >2.5</option>
							<option value="3.0" >3.0</option>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_HOURS; ?></label>
							<div class="col-sm-2">
							<select  class="form-control css-require" name="Hours" required="required">
							<option value="20" selected>20</option>
							<option value="40" >40</option>
							<option value="60" >60</option>
							<option value="80" >80</option>
							<option value="100" >100</option>
							<option value="120" >120</option>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_TEACH; ?></label>
							<div class="col-sm-4">
							<select  class="form-control css-require" name="Teach" required="required">
							<option value="" selected disabled><?php echo _ADMIN_FORM_SUBJ_TEACH;?></option>
							<?php
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_GD_TEACH." where teach_area='".$_SESSION['person_area']."' and teach_school='".$_SESSION['person_school']."' ORDER BY id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['teach_pin']."\"";
							echo ">[".@$arr['per']['teach_pin']."] ".@$arr['per']['name']."</option>";
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
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['best'] = $db->select_query("SELECT * FROM ".TB_SPACIALTAIL." WHERE stail_area='".$_SESSION['person_area']."' and stail_code='".$_SESSION['person_school']."' and stail_stu='".$_GET['stu_id']."'"); 
		@$arr['best']= $db->fetch(@$res['best']);
?>
		<div align="right" >
		<div class="form-group"><a href="index.php?name=academic&file=subj&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a href="index.php?name=academic&file=subj&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_spacial; ?></label>
							<div class="col-sm-4">
							<select  class="form-control css-require" name="stu_spacial" readonly>
							<option value="" selected disabled><?php echo _text_box_table_stu_subj_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_SPACIAL." ORDER BY st_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['st_id']."\" ";
							if(@$arr['best']['stail_id']==@$arr['bt']['st_id']){echo " selected ";}
							echo ">".@$arr['bt']['st_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_subj_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Btail_name" readonly><?php echo @$arr['best']['stail_name']; ?></textarea>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_subj_interv; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="Btail_per" readonly>
							<option value="" selected disabled><?php echo _text_box_table_stu_subj_interv_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\" ";
							if(@$arr['best']['stail_per']==@$arr['per']['per_ids']){echo " selected ";}
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
		
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_id='".$_GET['stu_id']."' "); 
		@$arr['stu'] =$db->fetch(@$res['stu']);
		@$res['best'] = $db->select_query("SELECT * FROM ".TB_SPACIALTAIL." WHERE stail_area='".$_SESSION['person_area']."' and stail_code='".$_SESSION['person_school']."' and stail_stu='".$_GET['stu_id']."'"); 
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
			url: "modules/academic/processspa.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=academic&file=subj&route=<?php echo $route;?>';
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
		<div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=academic&file=subj&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_spacial; ?></label>
							<div class="col-sm-4">
							<select  class="form-control css-require" name="stu_spacial" >
							<option value="" selected disabled><?php echo _text_box_table_stu_subj_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_SPACIAL." ORDER BY st_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['st_id']."\" ";
							if(@$arr['best']['stail_id']==@$arr['bt']['st_id']){echo " selected ";}
							echo ">".@$arr['bt']['st_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_subj_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Btail_name" ><?php echo @$arr['best']['stail_name']; ?></textarea>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_subj_interv; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="Btail_per" >
							<option value="" selected disabled><?php echo _text_box_table_stu_subj_interv_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\" ";
							if(@$arr['best']['stail_per']==@$arr['per']['per_ids']){echo " selected ";}
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

@$res['subj'] = $db->select_query("SELECT *  FROM ".TB_GD_SUBJ." WHERE subj_area='".$_SESSION['person_area']."' and subj_school='".$_SESSION['person_school']."' and  id='".$_GET['st_id']."' group by id"); 
@$arr['subj']= $db->fetch(@$res['subj']);
@$res['per'] = $db->select_query("SELECT * FROM ".TB_GD_TEACH." where teach_area='".$_SESSION['person_area']."' and teach_school='".$_SESSION['person_school']."' and teach_pin='".@$arr['subj']['subj_teach']."' ");
@$arr['per'] = $db->fetch(@$res['per']);
@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." where class_id='".@$arr['subj']['subj_order']."' ");
@$arr['cl'] = $db->fetch(@$res['cl']);
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
		<div class="form-group"><a href="index.php?name=academic&file=subj&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>
				<form method="post" enctype="multipart/form-data" id="formEdit" role="formEdit" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _GRADESUBJ; ?>&nbsp;<span class="badge bg-red"><?php echo @$arr['subj']['subj_name']; ?></span></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">


							<div class="form-group " >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_form_onet_year; ?></label>
							<div class="col-md-2 col-sm-4 col-xs-4"><input type="text" name="CodePin"  class="form-control css-require" value="<?php echo @$arr['subj']['subj_year'];?>" placeholder="1234" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_CODE_PIN; ?></label>
							<div class="col-sm-2"><input type="text" name="CodePin"  class="form-control css-require" value="<?php echo @$arr['subj']['subj_pin'];?>" placeholder="1234" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_NAME; ?></label>
							<div class="col-sm-5"><input type="text" name="Name"  class="form-control css-require" value="<?php echo @$arr['subj']['subj_name'];?>" placeholder="1234" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_ORDER; ?></label>
							<div class="col-sm-3"><input type="text" name="Name"  class="form-control css-require" value="<?php echo @$arr['cl']['class_name'];?>" placeholder="1234" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_TERM; ?></label>
							<div class="col-sm-2"><input type="text" name="Name"  class="form-control css-require" value="<?php echo @$arr['subj']['subj_term'];?>" placeholder="1234" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_UNIT; ?></label>
							<div class="col-sm-2"><input type="text" name="Name"  class="form-control css-require" value="<?php echo @$arr['subj']['subj_unit'];?>" placeholder="1234" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_HOURS; ?></label>
							<div class="col-sm-2"><input type="text" name="Name"  class="form-control css-require" value="<?php echo @$arr['subj']['subj_hours'];?>" placeholder="1234" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label" ><?php echo _ADMIN_FORM_SUBJ_TEACH; ?></label>
							<div class="col-sm-4"><input type="text" name="Name"  class="form-control css-require" value="<?php echo @$arr['per']['name'];?>" placeholder="1234" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>


								</div>
						</div>
				</form>


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
} else {
$YY=YEAR-1;
@$res['count'] = $db->select_query("SELECT * FROM ".TB_GD_SUBJ." where subj_area='".$_SESSION['person_area']."' and subj_school='".$_SESSION['person_school']."' and subj_year='".$YY."' ORDER BY id  "); 
@$rows['count'] = $db->rows(@$res['count']);

?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >
    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=academic&file=subj&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;<a href="index.php?name=academic&file=subj&op=import&route=<?php echo $route;?>" class="btn bg-green btn-flat"><i class="fa fa-download"></i>&nbsp;<?php echo _button_import; ?></a><?php if($_SESSION['person_group']==1){ ?>&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a><?php } ?></div>
      <br>
      </div>

		<div align="right" >
							<div class="form-group" style="text-align:right;">
							<select  class="form-control" id="P_year" required="required" onchange="rewage()">
							<option value="" selected disabled><?php echo _text_box_table_stu_year;?></option>
							<?php
							@$res['ony'] = $db->select_query("SELECT * FROM ".TB_YEAR." where yy_achiev='1' ORDER BY yy_id");
							while (@$arr['ony'] = $db->fetch(@$res['ony'])){
							echo "<option  value=\"".@$arr['ony']['yy_name']."\"";
							if(@$arr['ony']['yy_name']==$YY){echo " selected ";}
							echo ">ปีการศึกษา ".@$arr['ony']['yy_name']."</option>";
							}
							?>
							</select>
							</div>
			</div>

  <div id="Tab3Y">


    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title; ?> <?php echo _text_box_table_stu_year;?> <?php echo $YY;?></h3>
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
		
		@$res['subj'] = $db->select_query("SELECT * FROM ".TB_GD_SUBJ." where subj_area='".$_SESSION['person_area']."' and subj_school='".$_SESSION['person_school']."' and subj_year='".$YY."' ORDER BY id  ");
		@$rows['subj'] = $db->rows(@$res['subj']);
		if(@$rows['subj']) {
		?>
      <form action="index.php?name=academic&file=subj&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><?php if($_SESSION['person_group']==1){ ?><input type="checkbox" id="check" class="selector flat all"><?php } else {?>#<?php } ?></th>
              <th layout="block" style="text-align:center;" ><?=_ADMIN_GD_TABLE_TITLE_ID;?></th>
			  <th layout="block" style="text-align:center;"><?=_ADMIN_GD_TABLE_TITLE_NAME;?></th>
			  <th layout="block" style="text-align:center;"><?=_ADMIN_GD_TABLE_TITLE_ORDER;?></th>
			  <th layout="block" style="text-align:center;"><?=_ADMIN_GD_TABLE_TITLE_TERM;?></th>
			  <th layout="block" style="text-align:center;"><?=_ADMIN_GD_TABLE_TITLE_UNIT;?></th>
              <th layout="block" style="text-align:center;" ><?=_ADMIN_GD_TABLE_TITLE_HOURS;?></th>
			  <th layout="block" style="text-align:center;"><?=_ADMIN_GD_TABLE_TITLE_SUBJ_ADD;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['subj'] = $db->fetch(@$res['subj'])){

		@$res['tran'] = $db->select_query("SELECT *,count(tran_subj) as tran FROM ".TB_GD_TRAN." WHERE tran_subj='".@$arr['subj']['subj_pin']."' and tran_year='".$year."' and tran_area='".$_SESSION['person_area']."' and tran_school='".$_SESSION['person_school']."' group by tran_subj");
		@$arr['tran'] = $db->fetch(@$res['tran']);
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS."  where class_id='".@$arr['subj']['subj_order']."' ");
		@$arr['class'] = $db->fetch(@$res['class']);

		?>
            <tr>
              <td style="text-align: center;"><?php if($_SESSION['person_group']==1){ ?><input type="checkbox" name="selected[]" value="<? echo @$arr['subj']['id'];?>" class="selector flat"/><?php } else { echo $i;} ?></td>
              <td layout="block" style="text-align: left;"><? echo @$arr['subj']['subj_pin'];?></td>
              <td layout="block" style="text-align: left;"><?echo @$arr['subj']['subj_name'];?></td>
              <td layout="block" style="text-align: left;"><? echo @$arr['class']['class_name'];?></td>
              <td layout="block" style="text-align: right;"><? echo @$arr['subj']['subj_term'];?></td>
              <td layout="block" style="text-align: right;"><? echo @$arr['subj']['subj_unit'];?></td>
              <td layout="block" style="text-align: right;"><? echo @$arr['subj']['subj_hours'];?></td>
              <td layout="block" style="text-align: right;"><? echo @$arr['tran']['tran'];?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=academic&file=subj&op=cldetail&st_id=<? echo @$arr['subj']['id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			 <?php if($_SESSION['person_group']==1){ ?>
				<a href="index.php?name=academic&file=subj&op=del&st_id=<? echo @$arr['subj']['id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
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
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
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

</div><!--  // Tab3Y -->


<script>
 function rewage(){
	var y=document.getElementById("P_year").value;
	$('#Tab3Y').load('modules/academic/ajax_subj.php?y='+y);
}
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
