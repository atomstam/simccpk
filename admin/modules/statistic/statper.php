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

<?php if( $op=='shdetail'){

@$res['num'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." where ct_area='".$_SESSION['admin_area']."' and ct_school='".$_SESSION['admin_school']."' and ct_user='".$_GET['id']."' order by ct_no desc "); 
@$rows['num'] = $db->rows(@$res['num']);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE area_code ='".$_SESSION['admin_area']."' and school_code='".$_SESSION['admin_school']."'  and username='".$_GET['id']."' "); 
@$arr['user']=$db->fetch(@$res['user']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >

		<div align="right" >
		<div class="form-group"><a href="index.php?name=statistic&file=statper&route=<?php echo $route;?>" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>

					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="fa fa-user"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?>&nbsp;<span class="badge bg-green"><?php echo @$arr['user']['firstname']." ".@$arr['user']['lastname']; ?></span></h3>
								<div class="box-tools pull-right">
								<span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['num'];?></span>
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
      <form action="index.php?name=statistic&file=statper&op=shdelall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example2" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_userlogin_datein; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_userlogin_dateout;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_userlogin_timediff;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_userlogin_ipadd;?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		$Diff=(int)(@$arr['num']['ct_timeout'])-(int)(@$arr['num']['ct_time']);
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
			  <td layout="block" style="text-align: left;"><?php echo ThaiTimeConvert(@$arr['num']['ct_time'],"","2");?></td>
			  <td layout="block" style="text-align: left;"><?php echo ThaiTimeConvert(@$arr['num']['ct_timeout'],"","2");?></td>
			  <td layout="block" style="text-align: left;"><?php echo sECONDS_TO_HMS($Diff);?></td>
			  <td layout="block" style="text-align: left;"><?php echo @$arr['num']['ct_ip'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
		  </table>
	      </form>

            <?php } else { ?>
			<table>
            <tr>
              <td class="center" colspan="4"><?php echo _text_no_results; ?></td>
            </tr>
			</table>
            <?php } ?>




							</div>
						</div>

	</div>
</div>
</div>

<script>
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
</script>
        <script type="text/javascript">
        $(document).ready(function() {
        var aoColumns = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                               /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                               /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
								/* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example2").dataTable({
								"aoColumns": aoColumns,
								"responsive" : true,
								"pageLength" : 25,
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
    <br>
      <div class="buttons"><a href="index.php?name=statistic&file=statper&route=<?php echo $route;?>" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a></div>
      <br>
      </div>
    <div class="box box-warning">
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
		
		//@$res['num'] = $db->select_query("SELECT *,count(ct_no) as NO FROM ".TB_ACTIVEUSER." where ct_area='".$_SESSION['admin_area']."' and ct_school='".$_SESSION['admin_school']."' group by ct_user order by ct_no desc"); 
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE area_code ='".$_SESSION['admin_area']."' and school_code='".$_SESSION['admin_school']."'  order by admin_id"); 
		//@$arr['user']=$db->fetch(@$res['user']);

		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=statistic&file=statper&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_userlogin_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_userlogin_username; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_count_good; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_count_bad; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_count_sum;?></th>
              <!--<th layout="block" style="text-align:center;">Action</th>-->
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){

		@$res['bad'] = $db->select_query("SELECT * FROM ".TB_BAD." where bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and bad_sess='".@$arr['num']['username']."' "); 
		@$rows['bad'] = $db->rows(@$res['bad']);
		@$res['good'] = $db->select_query("SELECT * FROM ".TB_GOOD." where good_area='".$_SESSION['admin_area']."' and good_code='".$_SESSION['admin_school']."' and good_sess='".@$arr['num']['username']."' "); 
		@$rows['good'] = $db->rows(@$res['good']);
		$Sum=@$rows['good']+@$rows['bad'];
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i; ?></td>
			  <td layout="block" style="text-align: left;"><?php echo @$arr['num']['firstname'];?> <?php echo @$arr['num']['lastname'];?></td>
			  <td layout="block" style="text-align: left;"><?php echo @$arr['num']['username'];?></td>
			  <td layout="block" style="text-align: right;"><?php echo @$rows['good'];?></td>
			  <td layout="block" style="text-align: right;"><?php echo @$rows['bad'];?></td>
		       <td layout="block" style="text-align: center;"><?php echo $Sum;?></td>
			  <!--<td style="text-align: center;">-->
<?php
/*
				
			 <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success" id="<?php echo @$arr['num']['id']; ?>"><i class="fa fa-search-plus "></i></a>
			 			 <a href="index.php?name=statistic&file=statper&op=edit&sh_id=<?php echo @$arr['num']['sh_id'];?>&route=<?php echo $route;?>" class="btn btn-info " ><i class="fa fa-edit "></i></a>
*/
?>
			 <!--<a href="index.php?name=statistic&file=statper&op=shdetail&id=<?php echo @$arr['num']['username'];?>&route=<?php echo $route;?>" class="btn btn-success" ><i class="fa fa-search-plus "></i></a>
			  </td>-->
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
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
								/* 6  { "bSortable": false , 'aTargets': [ 0 ]}*/
                                  ]
                oTable = $("#example1").dataTable({
								"aoColumns": aoColumns,
								"responsive" : true,
								"pageLength" : 25,
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
					checkboxClass: 'icheckbox_flat-red',
					radioClass: 'iradio_flat-red'
				});

				$('input.all').on('ifToggled', function (event) {
					var chkToggle;
					$(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
					$('input.selector:not(.all)').iCheck(chkToggle);
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
    color: #000000;
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
