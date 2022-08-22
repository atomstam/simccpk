<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../lang/dateThai.php");
require_once("../../../includes/array.in.php");
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("../../../includes/function.in.php");
require_once("lang/goschselect.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$ToDayDate=$_POST['DateID'];
$CLass=$_POST['ClassID'];
$Cn=$_POST['Stu_cn'];
$route="statistic/goschselect";
//$ToDayDate=date('Y-m-d');
//and stu_class='".$CLass."' and stu_cn='".$Cn."' 

		@$res['num'] = $db->select_query("select *,sum(badtail_point) as CO  from ".TB_BAD." as a ,".TB_STUDENT." as b,".TB_BADTAIL." as c where b.stu_area='".$_SESSION['person_area']."' and b.stu_code='".$_SESSION['person_school']."' and b.stu_id=a.bad_stu and a.bad_tail=c.badtail_id and a.b_date='".$ToDayDate."' and stu_suspend ='0' group by b.stu_id order by CO desc"); 
		@$rows['num'] = $db->rows(@$res['num']);
?>
      <div class="row">
        <div class="col-xs-12 connectedSortable">

    <div class="box box-danger">
      
	         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _text_box_table_bad_name_today; ?> : <?php echo FullDateThai($ToDayDate);?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['num'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->

<?php

		if(@$rows['num']) {
?>

	<div class="box-body ">
        <table id="example9" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;" width='5%'>#</th>
              <th layout="block" style="text-align:center;" width='15%'><?php echo _text_box_table_stu_id; ?></th>
              <th layout="block" style="text-align:center;" width='35%'><?php echo _text_box_table_stu_fullname; ?></th>
			  <th layout="block" style="text-align:center;" width='15%'><?php echo _text_box_table_stu_class;?></th>
              <th layout="block" style="text-align:center;" width='20%'><?php echo _heading_title; ?></th>
              <th layout="block" style="text-align:center;" width='10%'><?php echo _text_box_table_bad_score;?></th>
              <th layout="block" style="text-align:center;" width='5%'>Action</th>
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
              <td style="text-align: right;"><?php echo @$arr['num']['badtail_name']; ?></td>
              <td layout="block" style="text-align: right;">-<?php echo @$arr['num']['CO']; ?></td>
              <td style="text-align: center;">
			 <a href="index.php?name=statistic&file=goschselect&op=bdetail&id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			  </td>
            </tr>
            <?php $i++;} ?>
          </tbody>
		  </table>

    </div>


            <?php } else { ?>
			<div class="box-body ">
				<?php echo _text_no_results; ?>
            </div>
            <?php } ?>

	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
</div>



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
        var aoColumns9 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable9 = $("#example9").dataTable({
								"aoColumns": aoColumns9,
								"responsive" : true,
								"dom" : 'lBfrtip',
								"pageLength" : 50,
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

		@$res['nums'] = $db->select_query("select *,sum(goodtail_point) as GO  from ".TB_GOOD." as a,".TB_STUDENT." as b,".TB_GOODTAIL." as c where b.stu_area='".$_SESSION['person_area']."' and b.stu_code='".$_SESSION['person_school']."' and b.stu_id=a.good_stu and a.good_tail=c.goodtail_id and a.g_date='".$ToDayDate."' and stu_suspend ='0' group by b.stu_id order by GO desc"); 
		@$rows['nums'] = $db->rows(@$res['nums']);
?>

      <div class="row">
        <div class="col-xs-12 connectedSortable">

    <div class="box box-success">
      
	         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _text_box_table_good_name_today; ?> : <?php echo FullDateThai($ToDayDate);?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['nums'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->

<?php
		if(@$rows['nums']) {
?>

	<div class="box-body ">

        <table id="example10" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;" width='5%'>#</th>
              <th layout="block" style="text-align:center;" width='15%'><?php echo _text_box_table_stu_id; ?></th>
              <th layout="block" style="text-align:center;" width='35%'><?php echo _text_box_table_stu_fullname; ?></th>
			  <th layout="block" style="text-align:center;" width='15%'><?php echo _text_box_table_stu_class;?></th>
              <th layout="block" style="text-align:center;" width='20%'><?php echo _heading_title; ?></th>
              <th layout="block" style="text-align:center;" width='10%'><?php echo _text_box_table_good_score;?></th>
              <th layout="block" style="text-align:center;" width='5%'>Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$is=1;
		while (@$arr['nums'] = $db->fetch(@$res['nums'])){
		@$res['class1'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['nums']['stu_class']."' "); 
		@$arr['class1'] = $db->fetch(@$res['class1']);
		?>
            <tr>
              <td style="text-align: center;"><?php echo $is;?></td>
              <td style="text-align: right;"><?php echo @$arr['nums']['stu_id']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['nums']['stu_num']."".@$arr['nums']['stu_name']." ".@$arr['nums']['stu_sur'] ; ?>&nbsp;<?php if(@$arr['nums']['stu_pic']){?><a href="<?php echo WEB_URL_IMG_STU.@$arr['nums']['stu_pic']."";?>" data-toggle="lightbox" data-title="<?php echo @$arr['nums']['stu_name']." ".@$arr['nums']['stu_sur'] ; ?>"><i class="glyphicon glyphicon-user  img-fluid"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class1']['class_name']; ?></td>
              <td style="text-align: right;"><?php echo @$arr['nums']['goodtail_name']; ?></td>
              <td layout="block" style="text-align: right;"><?php echo @$arr['nums']['GO']; ?></td>
              <td style="text-align: center;">
			 <a href="index.php?name=statistic&file=goschselect&op=gdetail&id=<?php echo @$arr['nums']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			  </td>
            </tr>
            <?php $is++;} ?>
          </tbody>
		  </table>

    </div>

            <?php } else { ?>
			<div class="box-body ">
				<?php echo _text_no_results; ?>
            </div>
            <?php } ?>

	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
</div>

<script>
$(document).on('click', '[data-toggle="lightboxs"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
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
        var aoColumns10 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable10 = $("#example10").dataTable({
								"aoColumns": aoColumns10,
								"responsive" : true,
								"dom" : 'lBfrtip',
								"pageLength" : 50,
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