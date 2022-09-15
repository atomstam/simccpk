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
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">
<?php
//<form action="index.php?name=behavior&file=good&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
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
			url: "modules/behavior/processgood.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=good&route=<?php echo $route;?>';
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

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=good&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_good_stu_form_name; ?></label>
							<div class="col-sm-6">
							<select class="form-control select2" multiple="multiple" name="Good_stu[]" >
							<?php
							
							@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."' and stu_suspend='0'  ORDER BY stu_class,stu_cn,stu_id");
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_good_stu_form_goodtail; ?></label>
							<div class="col-sm-6">
							<select class="form-control select3" multiple="multiple" name="Good_tail[]" >
							<?php
							
							@$res['good'] = $db->select_query("SELECT * FROM ".TB_GOODTAIL." where goodtail_area='".$_SESSION['stu_area']."' and goodtail_code='".$_SESSION['stu_school']."' ORDER BY goodtail_id ");
							while (@$arr['good'] = $db->fetch(@$res['good'])){
							echo "<option value=\"".@$arr['good']['goodtail_id']."\"";
							echo ">".@$arr['good']['goodtail_name']." (+".$arr['good']['goodtail_point'].")</option>";
							}
							?>
							</select>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_good_stu_form_goodname; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control css-require" id="editor1" rows="5" cols="80" name="Good_name"></textarea>
							</div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_good_stu_detail_date; ?></label>
							<div class="col-sm-3" >
							<?php $DateTimeStart=date('Y-m-d');?>
							<div class="input-group date" id="dp1" data-date="<?php echo $DateTimeStart;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control" name="Good_YMD" class="form-control css-require" value="<?php echo $DateTimeStart;?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_good_stu_detail_dam; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="Good_dam" >
								<option value=""><?php echo _text_box_table_good_stu_detail_dam_select;?></option>
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
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_good_stu_detail_data; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="Good_data" >
								<option value=""><?php echo _text_box_table_good_stu_detail_data_select;?></option>
							<?php
							
							@$res['data'] = $db->select_query("SELECT * FROM ".TB_GOODDATA." ORDER BY gdata_id ");
							while (@$arr['data'] = $db->fetch(@$res['data'])){
							echo "<option value=\"".@$arr['data']['gdata_id']."\"";
							echo ">".@$arr['data']['gdata_name']."</option>";
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
<?php
} else if($op=='edit' and $action=='' ){
@$res['goods'] = $db->select_query("SELECT * FROM ".TB_GOOD." WHERE good_area='".$_SESSION['stu_area']."' and good_code='".$_SESSION['stu_school']."' and good_id='".$_GET['good_id']."' "); 
@$arr['goods']= $db->fetch(@$res['goods']);
@$res['tail'] = $db->select_query("SELECT * FROM ".TB_GOODTAIL." WHERE goodtail_id='".@$arr['goods']['good_tail']."' "); 
@$arr['tail'] =$db->fetch(@$res['tail']);
@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_id='".@$arr['goods']['good_stu']."' "); 
@$arr['stu'] =$db->fetch(@$res['stu']);
$Name=@$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur'];
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">
<?php
//<form action="index.php?name=behavior&file=good&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
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
			url: "modules/behavior/processgood.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=behavior&file=good&route=<?php echo $route;?>';
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

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=behavior&file=good&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>
				<form method="post" enctype="multipart/form-data" id="formEdit" role="formEdit" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-success" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-folder-open"></i>
                                    <h3 class="box-title"><?php echo _button_edit; ?></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_good_stu_form_name; ?></label>
							<div class="col-sm-6">
							<input type='text' class="form-control" name="Good_stu" value="<?php echo $Name;?>" readonly>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_good_stu_form_goodtail; ?></label>
							<div class="col-sm-6">
							<select class="form-control select3" name="Good_tail" >
							<?php
							
							@$res['good'] = $db->select_query("SELECT * FROM ".TB_GOODTAIL." where goodtail_area='".$_SESSION['stu_area']."' and goodtail_code='".$_SESSION['stu_school']."' ORDER BY goodtail_id ");
							while (@$arr['good'] = $db->fetch(@$res['good'])){
							echo "<option value=\"".@$arr['good']['goodtail_id']."\" ";
							if(@$arr['tail']['goodtail_id']==@$arr['good']['goodtail_id']){ echo "selected";}
							echo " >".@$arr['good']['goodtail_name']." (+".$arr['good']['goodtail_point'].")</option>";
							}
							?>
							</select>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_good_stu_form_goodname; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control css-require" id="editor1" rows="5" cols="80" name="Good_name"><?php echo @$arr['goods']['good_name'];?></textarea>
							</div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_good_stu_detail_date; ?></label>
							<div class="col-sm-3" >
							<?php $DateTimeStart=date('Y-m-d');?>
							<div class="input-group date" id="dp1" data-date="<?php echo $DateTimeStart;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control" name="Good_YMD" class="form-control css-require" value="<?php echo @$arr['goods']['g_date'];?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_good_stu_detail_dam; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="Good_dam" >
								<option value=""><?php echo _text_box_table_good_stu_detail_dam_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_area='".$_SESSION['stu_area']."' and per_code='".$_SESSION['stu_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\" ";
							if(@$arr['goods']['good_dam']==@$arr['per']['per_ids']){ echo "selected";}
							echo " >".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_good_stu_detail_data; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="Good_data" >
								<option value=""><?php echo _text_box_table_good_stu_detail_data_select;?></option>
							<?php
							
							@$res['data'] = $db->select_query("SELECT * FROM ".TB_GOODDATA." ORDER BY gdata_id ");
							while (@$arr['data'] = $db->fetch(@$res['data'])){
							echo "<option value=\"".@$arr['data']['gdata_id']."\" ";
							if(@$arr['goods']['good_t']==@$arr['data']['gdata_id']){ echo "selected";}
							echo ">".@$arr['data']['gdata_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>


							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Edit"><input type="hidden" name="GOID"  value="<?php echo @$arr['goods']['good_id'];?>">
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
<?php
}else {

@$res['good'] = $db->select_query("SELECT *,count(good_stu) as STU FROM ".TB_GOOD." WHERE good_area='".$_SESSION['stu_area']."' and good_code='".$_SESSION['stu_school']."' and good_stu='".$_SESSION['stu_pwd']."' "); 
 @$arr['good']= $db->fetch(@$res['good']);
@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_id='".$_SESSION['stu_pwd']."' "); 
@$arr['stu'] =$db->fetch(@$res['stu']);
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
		<div class="form-group"><!--<a href="index.php?name=behavior&file=good&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;--><a href="index.php?name=behavior&file=good&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>

					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen_detail_stu; ?>&nbsp;<span class="label label-success"><?php echo @$arr['stu']['stu_num'].@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?></span></h3>
								<div class="box-tools pull-right">
								<span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$arr['good']['STU']; ?></span>
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">
	  <?php
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_GOOD." as a, ".TB_STUDENT." as b,".TB_GOODTAIL." as c where a.good_area='".$_SESSION['stu_area']."' and a.good_code='".$_SESSION['stu_school']."' and a.good_stu=b.stu_id and a.good_stu='".$_SESSION['stu_pwd']."' and a.good_tail=c.goodtail_id order by a.good_id desc "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=good&op=studelall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_good_stu_detail_name; ?></th>
              <th layout="block" style="text-align:center;">กระทำเมื่อ</th>
			  <th layout="block" style="text-align:center;">คะแนน</th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_good_stu_detail_data; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_good_stu_detail_dam;?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
			@$res['data'] = $db->select_query("SELECT * FROM ".TB_GOODDATA." WHERE gdata_id='".@$arr['num']['good_t']."' "); 
			@$arr['data'] =$db->fetch(@$res['data']);
			@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_ids='".@$arr['num']['good_dam']."' "); 
			@$arr['per'] =$db->fetch(@$res['per']);
			$DaTT=@$arr['num']['good_date']."/".@$arr['num']['good_mouth']."/".@$arr['num']['good_year'];
			$DATT=formatDateThai($DaTT);
		?>
            <tr>
              <td style="text-align: center;"><?=$i;?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['good_name'];?></td>
              <td layout="block" style="text-align: center;"><?php echo $DATT;?></td>
			  <td layout="block" style="text-align: center;">+<?php echo @$arr['num']['goodtail_point'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['data']['gdata_name'];?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['per']['per_name'];?></td>
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
<script type="text/javascript">
		$(function(){
			$('#dp1').datepicker();
			$('#dp2').datepicker();
			$('#dp3').datepicker();
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
