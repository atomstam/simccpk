<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("../statistic/lang/goschday.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$ToDayDate=date('Y-m-d');
$route="index/index";
?>

	 <div class="col-xs-12 connectedSortable">
      <!-- Main row -->
      <div class="row">

                <div class="col-md-12 col-sm-12">
<?php
		@$res['num'] = $db->select_query("select *,sum(goodtail_point) as GO  from ".TB_GOOD." as a,".TB_STUDENT." as b,".TB_GOODTAIL." as c where a.good_area='".$_SESSION['admin_area']."' and a.good_code='".$_SESSION['admin_school']."' and b.stu_id=a.good_stu and a.good_tail=c.goodtail_id and a.g_date='".$ToDayDate."' and stu_suspend='0' group by b.stu_id order by GO desc"); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
?>
    <div class="box box-success">
      
	         <div class="box-header with-border">
                 <i class="fa fa-user"></i>
                 <h3 class="box-title"><?php echo _text_box_table_good_name_today; ?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['num'];?></span>
                <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>-->
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
	<div class="box-body ">
      <form action="index.php?name=statistic&file=goschday&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example11" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" >รหัส</th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_fullname; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_class;?></th>
			  <th layout="block" style="text-align:center;">ห้อง</th>
              <th layout="block" style="text-align:center;"><?php echo _heading_title; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_bad_score;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['num']['stu_class']."' "); 
		@$arr['class'] = $db->fetch(@$res['class']);
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td style="text-align: right;"><?php echo @$arr['num']['stu_id']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num']."".@$arr['num']['stu_name']." ".@$arr['num']['stu_sur'] ; ?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="<?php echo WEB_URL_IMG_STU.@$arr['num']['stu_pic']."";?>" data-toggle="lightbox" data-title="<?php echo @$arr['num']['stu_name']." ".@$arr['num']['stu_sur'] ; ?>"><i class="glyphicon glyphicon-user  img-fluid"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name']; ?></td>
			  <td layout="block" style="text-align: center;"><?php echo @$arr['num']['stu_cn']; ?></td>
              <td style="text-align: left;"><?php echo @$arr['num']['good_name']; ?></td>
              <td layout="block" style="text-align: right;">+<?php echo @$arr['num']['GO']; ?></td>
              <td style="text-align: center;">
			 <a href="index.php?name=statistic&file=score&op=gdetail&id=<?php echo @$arr['num']['stu_id'];?>&route=statistic/score" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			  </td>
            </tr>
            <?php $i++;} ?>
          </tbody>
		  </table>
	      </form>
    </div>

	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
<!-- /.row -->
</div>
<script>
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
</script>


		<script type="text/javascript">
        $(document).ready(function() {
        var aoColumns11 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable11 = $("#example11").dataTable({
								"aoColumns": aoColumns11,
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
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
        "footerCallback": function ( row, data, start, end, display ) {
            var api11 = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal11 = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total11 = api11
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal11(a) + intVal11(b);
                }, 0 );
 
            // Total over this page
            pageTotal11 = api11
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal11(a) + intVal11(b);
                }, 0 );
 
            // Update footer
            $( api11.column( 3 ).footer() ).html(
//                '-'+pageTotal9 +' ( -'+ total9 +' <?php echo _text_box_table_pu_score;?>)'
			'-'+ total11 +' <?php echo _text_box_table_pu_score;?>'
            );
        }
								});

            });
        </script>

            <?php } else { ?>
    <div class="box box-success">
      
	         <div class="box-header with-border">
                 <i class="fa fa-user"></i>
                 <h3 class="box-title"><?php echo _text_box_table_good_name_today; ?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['num'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
	<div class="box-body ">
		<?php echo _text_no_results; ?>
	</div>

</div><!-- /.box-danger -->
            <?php } ?>


                </div>
                <!-- /.col -->
       </div>
  </div>

