<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("../../../includes/function.in.php");
require_once("lang/subj.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$route='academic/subj';
$year = $_REQUEST['y'];
@$res['count'] = $db->select_query("SELECT * FROM ".TB_GD_SUBJ." where subj_area='".$_SESSION['admin_area']."' and subj_school='".$_SESSION['admin_school']."' and subj_year='".$year."' ORDER BY id  "); 
@$rows['count'] = $db->rows(@$res['count']);
?>
    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title; ?> <?php echo _text_box_table_stu_year;?> <?php echo $year;?></h3>
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
		
		@$res['subj'] = $db->select_query("SELECT * FROM ".TB_GD_SUBJ." where subj_area='".$_SESSION['admin_area']."' and subj_school='".$_SESSION['admin_school']."' and subj_year='".$year."' ORDER BY id  ");
		@$rows['subj'] = $db->rows(@$res['subj']);
		if(@$rows['subj']) {
		?>
      <form action="index.php?name=academic&file=subj&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><?php if($_SESSION['admin_group']==1){ ?><input type="checkbox" id="check" class="selector flat all"><?php } else {?>#<?php } ?></th>
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

		@$res['tran'] = $db->select_query("SELECT *,count(tran_subj) as tran FROM ".TB_GD_TRAN." WHERE tran_subj='".@$arr['subj']['subj_pin']."' and tran_year='".$year."' and tran_area='".$_SESSION['admin_area']."' and tran_school='".$_SESSION['admin_school']."' group by tran_subj");
		@$arr['tran'] = $db->fetch(@$res['tran']);
		@$res['gr'] = $db->select_query("SELECT * FROM ".TB_GD_GROUP." where gr_id='".@$arr['subj']['subj_group']."' ");
		@$arr['gr'] = $db->fetch(@$res['gr']);
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS."  where class_id='".@$arr['subj']['subj_order']."' ");
		@$arr['class'] = $db->fetch(@$res['class']);

		?>
            <tr>
              <td style="text-align: center;"><?php if($_SESSION['admin_group']==1){ ?><input type="checkbox" name="selected[]" value="<? echo @$arr['subj']['id'];?>" class="selector flat"/><?php } else { echo $i;} ?></td>
              <td layout="block" style="text-align: left;"><? echo @$arr['subj']['subj_pin'];?></td>
              <td layout="block" style="text-align: left;"><?echo @$arr['subj']['subj_name'];?></td>
              <td layout="block" style="text-align: left;"><? echo @$arr['class']['class_name'];?></td>
              <td layout="block" style="text-align: right;"><? echo @$arr['subj']['subj_term'];?></td>
              <td layout="block" style="text-align: right;"><? echo @$arr['subj']['subj_unit'];?></td>
              <td layout="block" style="text-align: right;"><? echo @$arr['subj']['subj_hours'];?></td>
              <td layout="block" style="text-align: right;"><? echo @$arr['tran']['tran'];?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=academic&file=subj&op=cldetail&st_id=<? echo @$arr['subj']['id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			 <?php if($_SESSION['admin_group']==1){ ?>
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
