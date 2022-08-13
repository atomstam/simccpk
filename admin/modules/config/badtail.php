<?php CheckAdminGroup($_SESSION['admin_login'],$_SESSION['admin_pwd'],$_SESSION['admin_group']); ?>
<?php
if(!empty($_SESSION['admin_login'])){
$del='';
if($op=='del'){
		
		$del .=$db->del(TB_BADTAIL," badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' and badtail_id='".$_GET['bad_id']."' ");
		$del .=$db->del(TB_BAD," bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_tail='".$_GET['bad_id']."' ");

		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 

if($op=='delall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
		
		$del .=$db->del(TB_BADTAIL," badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' and badtail_id='".$value."' ");
		$del .=$db->del(TB_BAD," bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_tail='".$value."' ");
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
//<form action="index.php?name=config&file=badtail&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
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
			url: "modules/config/processbad.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=config&file=badtail&route=<?php echo $route;?>';
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

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=config&file=badtail&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_name; ?></label>
							<div class="col-sm-4"><input type="text" name="Bad_name"  class="form-control  css-require"  placeholder="bad1" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_level; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="Bad_level" >
								<option value=""><?php echo _text_box_table_bad_level_select;?></option>
							<?php
							
							@$res['level'] = $db->select_query("SELECT * FROM ".TB_BADLEVEL." ORDER BY blevel_id ");
							while (@$arr['level'] = $db->fetch(@$res['level'])){
							echo "<option value=\"".@$arr['level']['blevel_id']."\"";
							echo ">".@$arr['level']['blevel_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_score; ?></label>
							<div class="col-sm-2"><input type="text" name="Bad_point"  class="form-control  css-require"  placeholder="10" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
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

@$res['bad'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' and badtail_id='".$_GET['bad_id']."'"); 
 @$arr['bad']= $db->fetch(@$res['bad']);

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
			url: "modules/config/processbad.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=config&file=badtail&route=<?php echo $route;?>';
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

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=config&file=badtail&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>
				<form method="post" enctype="multipart/form-data" id="formEdit" role="formEdit" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-info" id="loading-example">
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_name; ?></label>
							<div class="col-sm-4"><input type="text" name="Bad_name"  value="<?php echo @$arr['bad']['badtail_name'];?>" class="form-control  css-require"  placeholder="bad1" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_level; ?></label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="Bad_level" >
								<option value=""><?php echo _text_box_table_bad_level_select;?></option>
							<?php
							
							@$res['level'] = $db->select_query("SELECT * FROM ".TB_BADLEVEL." ORDER BY blevel_id ");
							while (@$arr['level'] = $db->fetch(@$res['level'])){
							echo "<option value=\"".@$arr['level']['blevel_id']."\"";
							if(@$arr['level']['blevel_id']==@$arr['bad']['badtail_level']){ echo " selected ";}
							echo ">".@$arr['level']['blevel_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_bad_score; ?></label>
							<div class="col-sm-2"><input type="text" name="Bad_point"  value="<?php echo @$arr['bad']['badtail_point'];?>" class="form-control  css-require"  placeholder="10" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Edit"><input name="BAID" type="hidden" value="<?php echo @$arr['bad']['badtail_id'];?>">
							<br>
							</div>
							</div>

							</div>
						</div>

</form>
</div>
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
<?php
} else {
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >
    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=config&file=badtail&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a></div>
      <br>
      </div>
    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title; ?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." where badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' order by badtail_level,badtail_point,badtail_id"); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=config&file=badtail&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_bad_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_bad_level; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_bad_score;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_bad_count;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['level'] = $db->select_query("SELECT * FROM ".TB_BADLEVEL." WHERE blevel_id='".@$arr['num']['badtail_level']."' "); 
		@$arr['level'] =$db->fetch(@$res['level']);
		@$res['B'] = $db->select_query("SELECT * FROM ".TB_BAD." where bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_tail='".@$arr['num']['badtail_id']."' "); 
		@$rows['B'] = $db->rows(@$res['B']);
		?>
            <tr>
              <td style="text-align: center;"><?php if(@$arr['num']['badtail_area']==$_SESSION['admin_area'] && @$arr['num']['badtail_code']==$_SESSION['admin_school'] ){ ?><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['badtail_id']; ?>" class="selector flat"/><?php } else { echo $i; }?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['badtail_name'];?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['level']['blevel_name'];?></td>
              <td layout="block" style="text-align: center;">-<?php echo @$arr['num']['badtail_point'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$rows['B'];?></td>
			  <td style="text-align: center;">
<?php
/*
				
			 <a href="#" data-toggle="modal" data-target="#myModal" class="btn bg-green btn-flat btn-sm" id="<?php echo @$arr['num']['bad_id']; ?>"><i class="fa fa-search-plus "></i></a>
*/
?>
				<?php if(@$arr['num']['badtail_area']==$_SESSION['admin_area'] && @$arr['num']['badtail_code']==$_SESSION['admin_school'] ){ ?>
				<a href="index.php?name=config&file=badtail&op=edit&bad_id=<?php echo @$arr['num']['badtail_id']; ?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=config&file=badtail&op=del&bad_id=<?php echo @$arr['num']['badtail_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
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
				<div id="myModal" class="modal fade" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">X</button>
								  <h4 class="modal-title"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;<?php echo _heading_title;?></h4>
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
		data : 'bad_id='+ id, //Here pass id via 
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
                               /* 5 */ { "bSortable": true , 'aTargets': [ 1 ]},
                               /* 5 */ { "bSortable": true , 'aTargets': [ 1 ]},
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