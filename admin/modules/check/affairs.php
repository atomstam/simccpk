<?php
if(!empty($_SESSION['admin_login'])){
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
if($op=='scldetail' ){
@$res['count'] = $db->select_query("SELECT * FROM ".TB_AFFTAIL." where afft_area='".$_SESSION['admin_area']."' and afft_code='".$_SESSION['admin_school']."' and afft_aff='".$_GET['afft_id']."' group by afft_stu"); 
@$rows['count'] = $db->rows(@$res['count']);
@$res['tails'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." where aff_area='".$_SESSION['admin_area']."' and aff_code='".$_SESSION['admin_school']."' and aff_id='".$_GET['afft_id']."' "); 
@$arr['tails'] =$db->fetch(@$res['tails']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >
    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=behavior&file=affairs&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a></div>
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
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." where clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' order by clg_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=behavior&file=affairs&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
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

		@$res['stu'] = $db->select_query("SELECT *,count(DISTINCT IF(afft_status=0,afft_stu,NULL)) as CO,count(DISTINCT IF(afft_status=1,afft_stu,NULL)) as AC FROM ".TB_STUDENT." , ".TB_AFFTAIL." where afft_area='".$_SESSION['admin_area']."' and afft_code='".$_SESSION['admin_school']."' and stu_class='".@$arr['num']['clg_group']."' and afft_stu=stu_id and stu_cn='".@$arr['num']['clg_name']."' "); 
		@$rows['stu'] = $db->fetch(@$res['stu']);

		@$res['cc'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_class='".@$arr['num']['clg_group']."' and stu_cn='".@$arr['num']['clg_name']."' "); 
		@$rows['cc'] = $db->rows(@$res['cc']);

		@$res['tail'] = $db->select_query("SELECT *,count(afft_stu) as STU FROM ".TB_AFFTAIL." where afft_area='".$_SESSION['admin_area']."' and afft_code='".$_SESSION['admin_school']."' and afft_stu='".@$arr['stu']['stu_id']."' group by afft_stu"); 
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
              <td style="text-align: center;"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['cl']['class_name'];?></td>
              <td layout="block" style="text-align: right;"><?php echo @$arr['num']['clg_name'];?></td>
              <td layout="block" style="text-align: right;"><?php echo @$rows['cc'];?></td>
              <td layout="block" style="text-align: right;"><?php echo $TT;?></td>
              <td layout="block" style="text-align: right;"><?php echo $FF;?></td>
              <td layout="block" style="text-align: center;"><?php echo progress_bar_percentage($TT,@$rows['cc']);?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=check&file=affairs&op=cldetail&afft_id=<?php echo $_GET['afft_id'];?>&cl_id=<?php echo @$arr['num']['clg_group'];?>&clg_gr=<?php echo @$arr['num']['clg_name'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
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

@$res['num'] = $db->select_query("SELECT *,count(afft_stu) as CO FROM ".TB_AFFTAIL." as a, ".TB_STUDENT." as b where afft_aff='".$_GET['afft_id']."' and afft_area='".$_SESSION['admin_area']."' and afft_code='".$_SESSION['admin_school']."' and afft_stu=stu_id and  stu_class='".$_GET['cl_id']."' and stu_cn='".$_GET['clg_gr']."' group by afft_stu order by CO desc,stu_class,stu_id "); 
@$rows['num'] = $db->rows(@$res['num']);

@$res['tail'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." where aff_area='".$_SESSION['admin_area']."' and aff_code='".$_SESSION['admin_school']."' and aff_id='".$_GET['afft_id']."' "); 
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
		<div class="form-group"><a href="index.php?name=behavior&file=affairs&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>
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
              <th width="1" style="text-align: center;">#</th>
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
              <td style="text-align: center;"><?=$i;?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur'];?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="#" data-toggle="modal" data-target="#myModal" data-artid="<?php echo @$arr['num']['stu_id']; ?>" class="btn" id="Mybtn"><i class="glyphicon glyphicon-user"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name'];?></td>
			  <td style="text-align: center;"><?php echo @$arr['num']['stu_cn']; ?></td>
			  <td style="text-align: center;"><?php if($arr['num']['afft_status']==1){echo @$arr['tail']['aff_point'];} else { echo "<font class='text-red'>ไม่ร่วมกิจกรรม</font>";} ?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=affairs&op=studetail&afft_id=<?php echo @$arr['num']['afft_aff'];?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			 <a href="index.php?name=behavior&file=affairs&op=stuedit&afft_id=<?php echo @$arr['num']['afft_aff']; ?>&stu_id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
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
@$res['count'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' "); 
@$rows['count'] = $db->rows(@$res['count']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">

    <div align="right" >
      <div class="buttons"><a href="index.php?name=check&file=affairs&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a></div>
      <br>
      </div>
    <div class="box box-danger">
		    <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title">ตรวจสอบกิจกรรมนักเรียน</h3>
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
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." WHERE aff_area='".$_SESSION['admin_area']."' and aff_code='".$_SESSION['admin_school']."' order by aff_id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		?>
      <form action="index.php?name=check&file=affairs&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_affairs_name; ?></th>
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
		@$res['tail'] = $db->select_query("select *,count(DISTINCT IF(afft_status=0,afft_stu,NULL)) as CO,count(DISTINCT IF(afft_status=1,afft_stu,NULL)) as AC FROM ".TB_AFFTAIL." where afft_area='".$_SESSION['admin_area']."' and afft_code='".$_SESSION['admin_school']."' and afft_aff='".@$arr['num']['aff_id']."' "); 
		@$arr['tail'] =$db->fetch(@$res['tail']);

//		@$res['level'] = $db->select_query("SELECT * FROM ".TB_AFFAIRSLEVEL." WHERE blevel_id='".@$arr['tail']['badtail_level']."' "); 
//		@$arr['level'] =$db->fetch(@$res['level']);
		@$PerC=(100*(@$arr['tail']['CO']))/(@$rows['count']);
		$MG=@$arr['tail']['AC'];
		$PerG=((@$arr['tail']['AC'])*100)/(@$rows['count']);
		?>
            <tr>
              <td style="text-align: center;"><?=$i;?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['aff_name'];?></td>
              <td layout="block" style="text-align: center;"><?php echo DateTimeThai(@$arr['num']['aff_Stime']);?></td>
              <td layout="block" style="text-align: center;"><?php echo DateTimeThai(@$arr['num']['aff_Ftime']);?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['tail']['CO']." (".number_format((@$PerC),2)."%)";?></td>
              <td layout="block" style="text-align: center;"><?php echo $MG." (".number_format(($PerG),2)."%)";?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=check&file=affairs&op=scldetail&afft_id=<?php echo @$arr['num']['aff_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			  </td>
            </tr>

            <?php $i++;} ?>
          </tbody>
		  </table>
	      </form>

    </div>
    </div>
	
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->


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

<?php } ?>
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
