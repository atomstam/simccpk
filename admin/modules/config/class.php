<?php CheckAdminGroup($_SESSION['admin_login'],$_SESSION['admin_pwd'],$_SESSION['admin_group']); ?>
<?php
if(!empty($_SESSION['admin_login'])){
$del='';
if($op=='del'){
		
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' and clg_id='".$_GET['class_id']."' "); 
		@$arr['class']= $db->fetch(@$res['class']);

		$del .=$db->del(TB_CLASS_PERSON," clper_area='".$_SESSION['admin_area']."' and clper_code='".$_SESSION['admin_school']."' and clper_gr='".@$arr['class']['clg_name']."' and clper_class='".@$arr['class']['clg_group']."' ");

		$del .=$db->del(TB_CLASS_GROUP," clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."'  and clg_id='".$_GET['class_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 

if($op=='delall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			
			@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' and clg_id='".$value."' "); 
			@$arr['class']= $db->fetch(@$res['class']);

			$del .=$db->del(TB_CLASS_PERSON," clper_area='".$_SESSION['admin_area']."' and clper_code='".$_SESSION['admin_school']."' and clper_gr='".@$arr['class']['clg_name']."' and clper_class='".@$arr['class']['clg_group']."' ");

			$del .=$db->del(TB_CLASS_GROUP," clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' and  clg_id='".$value."' ");
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
//<form action="index.php?name=config&file=class&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
?>

      <div class="alert alert-success" name="success" id="success" style="display:none;">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_ok; ?></span>
      </div>
      <div class="alert alert-danger" name="error" id="error" style="display:none;">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_fail; ?></span>
      </div>

<script>
 $(function() {
 $("button#submitForm").click(function(){
			$.ajax({
			type: "POST",
			url: "modules/config/processclass.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#success").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=config&file=class&route=<?php echo $route;?>';
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


		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=config&file=class&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>
				<form method="post" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-success" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-th"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">


						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_class_id_group; ?></label>
							<div class="col-sm-3" >
							<select class="form-control" name="Class_ID" >
							<?php
							
							@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." ORDER BY class_id ");
							while (@$arr['cl'] = $db->fetch(@$res['cl'])){
							echo "<option value=\"".@$arr['cl']['class_id']."\"";
							echo ">".@$arr['cl']['class_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_class_name; ?></label>
							<div class="col-sm-2">
							<select class="form-control" name="Class_name" >
							<?php
							for($i=1;$i<21;$i++){
							echo "<option value=\"".$i."\"";
							echo ">".$i."</option>";
							}
							?>
							</select>
							</div>
							</div>		
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_LineGr; ?></label>
							<div class="col-sm-5"><input type="text" name="Class_LineId"  class="form-control"  placeholder="LineId" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_tech; ?></label>
							<div class="col-sm-6" >
							<select class="form-control select2" multiple="multiple" name="Class_tech[]" >
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' ORDER BY per_id ");
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
}else if($op=='edit' and $action==''){

@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." WHERE clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' and clg_id='".$_GET['class_id']."' "); 
 @$arr['class']= $db->fetch(@$res['class']);

?>

      <div class="alert alert-success" name="success" id="success" style="display: none">
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
			url: "modules/config/processclass.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#success").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=config&file=class&route=<?php echo $route;?>';
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
<?php
@$res['num'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." where clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' and clg_group='".$_GET['class_id']."' order by clg_id "); 
@$rows['num'] = $db->rows(@$res['num']);
?>
		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=config&file=class&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>
				<form method="post" enctype="multipart/form-data" id="formEdit" role="formEdit" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-th"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">

						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_class_id_group; ?></label>
							<div class="col-sm-3" >
							<select class="form-control" name="Class_ID" disabled>
							<?php
							
							@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." ORDER BY class_id ");
							while (@$arr['cl'] = $db->fetch(@$res['cl'])){
							echo "<option value=\"".@$arr['cl']['class_id']."\"";
							if(@$arr['class']['clg_group']==@$arr['cl']['class_id']){echo " selected ";}
							echo ">".@$arr['cl']['class_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_class_name; ?></label>
							<div class="col-sm-2">
							<select class="form-control" name="Class_name" disabled>
							<?php
							for($i=1;$i<=3;$i++){
//					if(@$arr['class']['clg_name']!=$i){
							echo "<option value=\"".$i."\"";
							if(@$arr['class']['clg_name']==$i){echo " selected ";}
							echo ">".$i."</option>";
//							}
							}
							?>
							</select>
							</div>
							</div>		
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_LineGr; ?></label>
							<div class="col-sm-5"><input type="text" name="Class_LineId"  class="form-control"  value="<?php echo @$arr['class']['clg_LineId'];?>" placeholder="LineId" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_tech; ?></label>
							<div class="col-sm-6" >
							<select class="form-control select2" multiple="multiple" name="Class_tech[]" >
							<?php
							@$res['pers'] = $db->select_query("SELECT * FROM ".TB_CLASS_PERSON." WHERE clper_area='".$_SESSION['admin_area']."' and clper_code='".$_SESSION['admin_school']."' and clper_class='".@$arr['class']['clg_group']."' and clper_group='".@$arr['class']['clg_name']."' "); 
							//$CC=[];
							$i=0;
							while(@$arr['pers']= $db->fetch(@$res['pers'])){
								@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' ORDER BY per_id ");
								while (@$arr['per'] = $db->fetch(@$res['per'])){
									echo "<option value=\"".@$arr['per']['per_ids']."\"";
									if(@$arr['per']['per_ids']==@$arr['pers']['clper_tech']){echo " selected ";}
									echo ">".@$arr['per']['per_name']."</option>";
								//$i++;
								} 
							$i++;
							}
							?>

							</select>
							</div>
							</div>
							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Edit">
							<input name="CLID" type="hidden" value="<?php echo @$arr['class']['clg_group'];?>">
							<input name="CLCN" type="hidden" value="<?php echo @$arr['class']['clg_name'];?>">
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
}else if($op=='cldetail' and $action==''){

@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." where class_id='".$_GET['class_id']."' "); 
@$arr['class'] = $db->fetch(@$res['class']);
//echo TB_CLASS_GROUP;
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >
    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=config&file=class&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a></div>
      <br>
      </div>
    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-th"></i>
                 <h3 class="box-title"><?php echo _heading_title_group; ?> : <?php echo @$arr['class']['class_name'];?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." where clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' and clg_group='".$_GET['class_id']."' order by clg_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=config&file=class&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_class_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tech; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_count_stu;?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_LineGr;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_class='".@$arr['num']['clg_group']."' and stu_cn='".@$arr['num']['clg_name']."' "); 
		@$rowsSTU=$db->rows(@$res['stu']);
		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['clg_id']; ?>" class="selector flat"/></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['clg_name'];?></td>
              <td layout="block" style="text-align: left;">
			  <?php
				@$res['cat'] = $db->select_query("SELECT * FROM ".TB_CLASS_PERSON." WHERE clper_area='".$_SESSION['admin_area']."' and clper_code='".$_SESSION['admin_school']."' and clper_group='".@$arr['num']['clg_name']."' and clper_class='".@$arr['num']['clg_group']."' order by clper_id"); 
				//@$rows=$db->rows(@$res['cat']);
				$Cl_per='';
				$o=1;
				while(@$arr['cat'] = $db->fetch(@$res['cat'])){
					@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_ids='".@$arr['cat']['clper_tech']."' "); 
					@$arr['per'] = $db->fetch(@$res['per']);
					$Cl_per=@$arr['per']['per_name'];
					echo $o.". ".$Cl_per."<br>";
				$o++;
				}
				?>		  
			  </td>
              <td layout="block" style="text-align: right;"><?php echo @$rowsSTU;?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['clg_LineId'];?></td>
			  <td style="text-align: center;">
				<?php
				/*
								
							 <a href="#" data-toggle="modal" data-target="#myModal" class="btn bg-green btn-flat btn-sm" id="<?php echo @$arr['num']['class_id']; ?>"><i class="fa fa-search-plus "></i></a>
				*/
				?>
				<a href="index.php?name=config&file=class&op=edit&class_id=<?php echo @$arr['num']['clg_id']; ?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=config&file=class&op=del&class_id=<?php echo @$arr['num']['clg_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
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
				<div id="myModal" class="modal fade" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">X</button>
								  <h4 class="modal-title"><i class="glyphicon glyphicon-th"></i>&nbsp;<?php echo _heading_title;?></h4>
							</div>
<div class="modal-body">
</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
<script>
//jQuery Library Comes First
//Bootstrap Library
$(document).ready(function() { 
    $('.bg-green').click(function(e){//Modal Event
		e.preventDefault();
        var id = $(this).attr('id');
		$.ajax({
		type : 'get',
		url : 'modules/config/detailclass.php', //Here you should run query to fetch records
		data : 'class_id='+ id, //Here pass id via 
		success : function(data){            
          $('.modal-body').html(data); //Show Data
		//alert(data);
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
        var aoColumns = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
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
} else {
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >
    <div align="right" >
      <div class="buttons"><a href="index.php?name=config&file=class&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a></div>
      <br>
      </div>
    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-th"></i>
                 <h3 class="box-title"><?php echo _heading_title_group; ?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_CLASS." order by class_id"); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=config&file=class&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example2" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_class_id_group; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_class_name_group; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_count_class; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_count_stu;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_class='".@$arr['num']['class_id']."' "); 
		@$rowsSTU=$db->rows(@$res['stu']);
		@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." where clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' and clg_group='".@$arr['num']['class_id']."' "); 
		@$rows['cl'] = $db->rows(@$res['cl']);
		//echo TB_CLASS_GROUP;
		if(empty(@$rows['cl'])){
		@$res['stux'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_class='".@$arr['num']['class_id']."' group by stu_cn"); 
		while(@$arr['stux']=$db->fetch(@$res['stux'])){
			//echo @$arr['num']['class_id'].":::::".@$arr['stux']['stu_cn']."<br>";
			$db->add_db(TB_CLASS_GROUP,array(
			"clg_area"=>"".$_SESSION['admin_area']."",
			"clg_school"=>"".$_SESSION['admin_school']."",
			"clg_group"=>"".@$arr['num']['class_id']."",
			"clg_name"=>"".@$arr['stux']['stu_cn'].""
			));
		}

		}
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['class_id']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['class_name'];?></td>
              <td layout="block" style="text-align: right;"><?php echo @$rows['cl'];?></td>
              <td layout="block" style="text-align: right;"><?php echo @$rowsSTU;?></td>
			  <td style="text-align: center;">
<?php
/*
				
			 <a href="#" data-toggle="modal" data-target="#myModal" class="btn bg-green btn-flat btn-sm" id="<?php echo @$arr['num']['class_id']; ?>"><i class="fa fa-search-plus "></i></a>
*/
?>
				<a href="index.php?name=config&file=class&op=cldetail&class_id=<?php echo @$arr['num']['class_id']; ?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm"><i class="fa fa-search-plus "></i></a>
				<!--<a href="index.php?name=config&file=class&op=edit&class_id=<?php echo @$arr['num']['class_id']; ?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>-->
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


        <script type="text/javascript">
        $(document).ready(function() {
        var aoColumns1 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable2 = $("#example2").dataTable({
								"aoColumns": aoColumns1,
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


<?php } else { echo "<meta http-equiv='refresh' content='1; url=index.php'>"; }?>
