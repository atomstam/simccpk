<?php
if(!empty($_SESSION['stu_login'])){
?>
<div class="col-xs-12">

<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['stu_area']."' and stu_code='".$_SESSION['stu_school']."' and stu_id='".$_SESSION['stu_pwd']."' order by stu_class,stu_id"); 
@$arr['user'] = $db->fetch(@$res['user']);
@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['user']['stu_class']."' "); 
@$arr['class'] = $db->fetch(@$res['class']);
@$res['gcolor'] = $db->select_query("SELECT * FROM ".TB_GCOLOR." WHERE gcolor_id='".@$arr['user']['stu_gcolor']."' "); 
@$arr['gcolor'] = $db->fetch(@$res['gcolor']);
@$res['tum'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where id='".@$arr['user']['stu_tum']."' ");
@$arr['tum'] = $db->fetch(@$res['tum']);
@$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where id='".@$arr['user']['stu_amp']."' ");
@$arr['amp'] = $db->fetch(@$res['amp']);
@$res['prov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." where id='".@$arr['user']['stu_prov']."' ");
@$arr['prov'] = $db->fetch(@$res['prov']);
@$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_area='".$_SESSION['stu_area']."' and sh_code='".$_SESSION['stu_school']."' "); 
 @$arr['sh']= $db->fetch(@$res['sh']);
?>

		<div align="right" >
		<div class="form-group"><a href="index.php?name=stat&file=score&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>

				<form method="post" enctype="multipart/form-data" id="form" class="form-horizontal" >
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="fa fa-user"></i>
                                    <h3 class="box-title">สรุปคะแนนพฤติกรรมนักเรียน</h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">
			<div class="card hovercard">
				<div class="card-background">
					<img class="card-bkimg" alt="" src="<?php echo WEB_URL_IMG_SCHOOL.@$arr['sh']['sh_img'];?>">

					<!-- http://lorempixel.com/850/280/people/9/ -->
				</div>
				<div class="useravatar">
					<?php if(!empty($arr['user']['stu_pic'])){?>
					<img alt="" src="<?php echo WEB_URL_IMG_STU.@$arr['user']['stu_pic'];?>">
					<?php } else {?>
					<img alt="" src="<?php echo WEB_URL_IMG_STU."no_image.jpg";?>">
					<?php } ?>
				</div>
				<div class="card-info"> <span class="card-title"><?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></span>
				</div>
			</div>

		<?php
		@$res['countb'] = $db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_stu='".@$arr['user']['stu_id']."' "); 
		@$rows['countb'] = $db->rows(@$res['countb']);
		@$res['scoreb'] = $db->select_query("SELECT *,sum(b.badtail_point) as SCO FROM ".TB_BAD." as a, ".TB_BADTAIL." as b WHERE a.bad_stu='".@$arr['user']['stu_id']."' and a.bad_tail=b.badtail_id "); 
		@$arr['scoreb'] = $db->fetch(@$res['scoreb']);
		@$res['countg'] = $db->select_query("SELECT * FROM ".TB_GOOD." WHERE good_stu='".@$arr['user']['stu_id']."' "); 
		@$rows['countg'] = $db->rows(@$res['countg']);
		@$res['scoreg'] = $db->select_query("SELECT *,sum(b.badtail_point) as SCO FROM ".TB_GOOD." as a, ".TB_GOODTAIL." as b WHERE a.good_stu='".@$arr['user']['stu_id']."' and a.good_tail=b.badtail_id "); 
		@$arr['scoreg'] = $db->fetch(@$res['scoreg']);
		@$Sum=@$arr['scoreg']['SCO']-@$arr['scoreb']['SCO'];
		?>
<div class="form-group">
	<div class="col-sm-12" >
              <div class="color-palette-set">
                <div class="bg-yellow disabled color-palette">
						<center><h1><i class="icon fa fa-warning"></i>&nbsp;สรุปคะแนน<?php echo @$Sum;?></h1></center>
              </div>
			  </div>
	</div>
</div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                <div class="hidden-xs">พฤติกรรมบวก</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                <div class="hidden-xs">พฤติกรรมลบ</div>
            </button>
        </div>

    </div>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="tab1">

		<div class="row">
		<div class="col-xs-12 connectedSortable">
              <div class="color-palette-set">
                <div class="bg-green disabled color-palette">
						<center><h1>คะแนนพฤติกรรมบวก<?php echo " +".@$arr['scoreg']['SCO'];?></h1></center>
              </div>
			  </div>

	  <?php
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_GOOD." WHERE good_stu='".@$arr['user']['stu_id']."' order by good_id desc"); 
		@$rows['num'] = $db->rows(@$res['num']);
		?>


      <form method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example2" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5%" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;" width="50%"><?php echo _text_box_table_good_name;?></th>
			  <th layout="block" style="text-align:center;" width="20%"><?php echo _text_box_table_good_level;?></th>
			  <th layout="block" style="text-align:center;" width="15%"><?php echo _text_box_table_bg_date;?></th>
              <th layout="block" style="text-align:center;" width="10%">คะแนน</th>

            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
//		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_GOOD." WHERE good_stu='".$_GET['id']."' order by cot_id"); 
		while (@$arr['num'] = $db->fetch(@$res['num'])){
			@$res['tail'] = $db->select_query("SELECT * FROM ".TB_GOODTAIL." WHERE goodtail_id='".@$arr['num']['good_tail']."' "); 
			@$arr['tail'] =$db->fetch(@$res['tail']);
			@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_id='".@$arr['user']['stu_id']."' "); 
			@$arr['stu'] =$db->fetch(@$res['stu']);
//		@$PerC=(100*(@$arr['num']['CO']))/(@$rows['count']);
			@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['stu']['stu_class']."' "); 
			@$arr['class'] =$db->fetch(@$res['class']);
			@$res['level'] = $db->select_query("SELECT * FROM ".TB_GOODLEVEL." WHERE blevel_id='".@$arr['tail']['goodtail_level']."' "); 
			@$arr['level'] =$db->fetch(@$res['level']);
		if(@$arr['level']['blevel_id']==1) { //ส่วนของการ สลับสี 
			$ColorFill = '#330000';
		} else if(@$arr['level']['blevel_id']==2) { //ส่วนของการ สลับสี 
			$ColorFill = '#33CC99';
		} else {
			$ColorFill = '#FF0000';
		}
		?>
            <tr>
              <td style="text-align: center;"><font color="<?php echo $ColorFill;?>"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['num']['good_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['level']['blevel_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo ShortDateThai(@$arr['num']['b_date']);?></font></td>
              <td layout="block" style="text-align: center;"><?php echo (int)@$arr['tail']['goodtail_point'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align:right"><?php echo _text_box_table_good_score_sum;?> :</th>
                <th></th>
            </tr>
        </tfoot>
		  </table>
	      </form>
		</div>
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
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
								"footerCallback": function ( row, data, start, end, display ) {
									var api = this.api(), data;
						 
									// Remove the formatting to get integer data for summation
									var intVal = function ( i ) {
										return typeof i === 'string' ?
											i.replace(/[\$,]/g, '')*1 :
											typeof i === 'number' ?
												i : 0;
									};
						 
									// Total over all pages
									total = api
										.column( 4 )
										.data()
										.reduce( function (a, b) {
											return intVal(a) + intVal(b);
										}, 0 );
						 
									// Total over this page
									pageTotal = api
										.column( 4, { page: 'current'} )
										.data()
										.reduce( function (a, b) {
											return intVal(a) + intVal(b);
										}, 0 );
						 
									// Update footer
									$( api.column( 4 ).footer() ).html(
						//                '-'+pageTotal +' ( -'+ total +' <?php echo _text_box_table_pu_score;?>)'
									'+'+ total +' <?php echo _text_box_table_pu_score;?>'
									);
								}

								});
            });
        </script>

		</div>
		<div class="tab-pane fade in" id="tab2">


		<div class="row">
		<div class="col-xs-12 connectedSortable">
              <div class="color-palette-set">
                <div class="bg-red disabled color-palette">
						<center><h1>คะแนนพฤติกรรมลบ<?php echo " -".@$arr['scoreb']['SCO'];?></h1></center>
              </div>
			  </div>

	  <?php
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_stu='".@$arr['user']['stu_id']."' order by bad_id desc"); 
		@$rows['num'] = $db->rows(@$res['num']);
		?>


      <form method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5%" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;" width="50%"><?php echo _text_box_table_bad_name;?></th>
			  <th layout="block" style="text-align:center;" width="20%"><?php echo _text_box_table_bad_level;?></th>
			  <th layout="block" style="text-align:center;" width="15%"><?php echo _text_box_table_bg_date;?></th>
              <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bad_score; ?></th>

            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
//		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_stu='".$_GET['id']."' order by cot_id"); 
		while (@$arr['num'] = $db->fetch(@$res['num'])){
			@$res['tail'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_id='".@$arr['num']['bad_tail']."' "); 
			@$arr['tail'] =$db->fetch(@$res['tail']);
			@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_id='".@$arr['user']['stu_id']."' "); 
			@$arr['stu'] =$db->fetch(@$res['stu']);
//		@$PerC=(100*(@$arr['num']['CO']))/(@$rows['count']);
			@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['stu']['stu_class']."' "); 
			@$arr['class'] =$db->fetch(@$res['class']);
			@$res['level'] = $db->select_query("SELECT * FROM ".TB_BADLEVEL." WHERE blevel_id='".@$arr['tail']['badtail_level']."' "); 
			@$arr['level'] =$db->fetch(@$res['level']);
		if(@$arr['level']['blevel_id']==1) { //ส่วนของการ สลับสี 
			$ColorFill = '#330000';
		} else if(@$arr['level']['blevel_id']==2) { //ส่วนของการ สลับสี 
			$ColorFill = '#33CC99';
		} else {
			$ColorFill = '#FF0000';
		}
		?>
            <tr>
              <td style="text-align: center;"><font color="<?php echo $ColorFill;?>"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['num']['bad_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['level']['blevel_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo ShortDateThai(@$arr['num']['b_date']);?></font></td>
              <td layout="block" style="text-align: center;"><?php echo (int)@$arr['tail']['badtail_point'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align:right"><?php echo _text_box_table_good_score_sum;?> :</th>
                <th></th>
            </tr>
        </tfoot>
		  </table>
	      </form>
		</div>
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
        var aoColumns = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
								"aoColumns": aoColumns,
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
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
								"footerCallback": function ( row, data, start, end, display ) {
									var api = this.api(), data;
						 
									// Remove the formatting to get integer data for summation
									var intVal = function ( i ) {
										return typeof i === 'string' ?
											i.replace(/[\$,]/g, '')*1 :
											typeof i === 'number' ?
												i : 0;
									};
						 
									// Total over all pages
									total = api
										.column( 4 )
										.data()
										.reduce( function (a, b) {
											return intVal(a) + intVal(b);
										}, 0 );
						 
									// Total over this page
									pageTotal = api
										.column( 4, { page: 'current'} )
										.data()
										.reduce( function (a, b) {
											return intVal(a) + intVal(b);
										}, 0 );
						 
									// Update footer
									$( api.column( 4 ).footer() ).html(
						//                '-'+pageTotal +' ( -'+ total +' <?php echo _text_box_table_pu_score;?>)'
									'-'+ total +' <?php echo _text_box_table_pu_score;?>'
									);
								}

								});
            });
        </script>


		</div>
	</div>

	</div>
</div>


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

</div>

<?php } else { echo "<meta http-equiv='refresh' content='0; url=index.php'>"; }?>
