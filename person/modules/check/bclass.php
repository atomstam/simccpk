<?php
if(!empty($_SESSION['person_login'])){
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
if($op=='cldetail' and $action=='' ){
		$DD=explode("-",$_GET['mo_id']);
		$DD1=$DD[0]."-".$DD[1];
		//echo $DD1;
		$get_month = $DD[1];
		$year = $DD[0]+543;
		$month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
		//$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." where c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' and DATE_FORMAT(c_date, '%Y-%m') like '%".$_GET['mo_id']."%' group by c_date order by c_date ");  
		//@$rows['num'] = $db->rows(@$res['num']);
		@$res['numchkclass'] = $db->select_query("SELECT * FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['person_area']."' and chk_code='".$_SESSION['person_school']."' and chk_gr='".$_GET['gr']."' and DATE_FORMAT(chk_date, '%Y-%m') like '%".$_GET['mo_id']."%'  group by chk_class,chk_cn"); 
		@$NumRowChkclass = $db->rows(@$res['numchkclass']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">

		<div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title">กิจกรรมประจำวัน&nbsp;<span class="badge bg-green"><?php echo $month[$get_month]." ".$year; ?></span>,<font class="text-red"><?php if($_GET['gr']==1){echo "กิจกรรมหน้าเสาธง";} else if($_GET['gr']==2){echo "กิจกรรม MindSet";} else  if($_GET['gr']==3){echo "กิจกรรม Rivision";}?></font></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow">จำนวน <?php echo $NumRowChkclass;?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">

      <form  method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;">วันที่</th>
			  <th layout="block" style="text-align:center;">บันทึกแล้ว</th>
			  <th layout="block" style="text-align:center;">ยังไม่บันทึก</th>
			  <th layout="block" style="text-align:center;">progress</th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		$CC=explode("-",@$arr['num']['c_date']);
		//$CC1=$CC[0]."-".$DD[1];
		//echo $DD1;
		$get_month = $CC[1];
		$year = $CC[0]+543;
		$date=$CC[2];
		@$res['chkclass'] = $db->select_query("SELECT * FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['person_area']."' and chk_code='".$_SESSION['person_school']."' and chk_gr='".$_GET['gr']."' and DATE_FORMAT(chk_date, '%Y-%m-%d') like '%".$arr['num']['c_date']."%' group by chk_class,chk_cn"); 
		@$RowChkclass = $db->rows(@$res['chkclass']);
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td layout="block" style="text-align: left;"><?php echo $date." ".$month[$get_month]." ".$year; ?></td>
              <td layout="block" style="text-align: center;"><?=$RowChkclass;?></td>
              <td layout="block" style="text-align: center;"><?=18-$RowChkclass;?></td>
               <td layout="block" style="text-align: center;"><?php echo progress_bar_percentage($RowChkclass,18);?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=check&file=bclass&op=datedetail&moid=<?php echo @$arr['num']['c_date'];?>&gr=<?php echo $_GET['gr'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			  </td>

            </tr>

            <?php $i++;} ?>
          </tbody>
		  </table>
	      </form>


    </div>
    </div>
    </div>

	
	</div>
	<!-- /.col -->
<style>
.modal-dialogs{
    position: relative;
    display: table;
    overflow-y: auto;    
    overflow-x: auto;
    width: auto;
    min-width: 300px;   
}
</style>
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
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 11 */ { "bSortable": false , 'aTargets': [ 0 ]}
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
								}
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
                              });

            });
        </script>

<?php
} else if($op=='datedetail' and $action=='' ){

		@$res['numchkclass'] = $db->select_query("SELECT * FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['person_area']."' and chk_code='".$_SESSION['person_school']."' and chk_gr='".$_GET['gr']."' and DATE_FORMAT(chk_date, '%Y-%m-%d') like '%".$_GET['moid']."%' and gr='".$_GET['gr']."' group by chk_class,chk_cn"); 
		@$NumRowChkclass = $db->rows(@$res['numchkclass']);
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP.",".TB_CLASS." where clg_area='".$_SESSION['person_area']."' and clg_school='".$_SESSION['person_school']."' and class_id=clg_group order by class_id,clg_name "); 
		//@$rows['num'] = $db->rows(@$res['num']);
		$sql_per = "SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['person_area']."' and per_code='".$_SESSION['person_school']."' order by per_id";
		$rs_per= $db->select_query($sql_per);
		$arr_PerIDs = array();
		$arr_PerName = array();
		$is=1;
		while($r_per = $db->fetch($rs_per)){
			$arr_PerIDs[$r_per['per_ids']] = $r_per['per_ids'];
			$arr_PerName[$r_per['per_ids']] = $r_per['per_name'];
		$is++;
		}
?>
<div class="row">
<div class="col-xs-12 connectedSortable">

    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title">ตรวจสอบการบันทึกข้อมูลประจำวัน&nbsp;<span class="badge bg-green"><?php echo DateThai($_GET['moid']); ?></span></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo $NumRowChkclass;?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">

      <form  method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" >ชั้นเรียน</th>
			  <th layout="block"width="10%" style="text-align:center;">ห้อง</th>
			  <th layout="block" width="35%" style="text-align:center;">ครูที่ปรึกษา</th>
			  <th layout="block" width="15%" style="text-align:center;">สถานะ</th>
              <th layout="block" width="10%" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){

		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['class_name']; ?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['clg_name']; ?></td>
              <td layout="block" style="text-align: left;">
				<?php
				@$res['per'] = $db->select_query("SELECT * FROM ".TB_CLASS_PERSON." where clper_area='".$_SESSION['person_area']."' and clper_code='".$_SESSION['person_school']."' and clper_class='".$arr['num']['clg_group']."' and  clper_group='".$arr['num']['clg_name']."'  "); 
				//@$arr['per'] = $db->rows(@$res['per']);
				while (@$arr['per'] = $db->fetch(@$res['per'])){
					echo $arr_PerName[$arr['per']['clper_tech']]."<br>";
				}
				?>
              </td>
              <td layout="block" style="text-align: center;">
				<?php
				//	SELECT * FROM `web_chk_chclass` WHERE chk_area='101726' and chk_code='44012028' and chk_class='m2' and chk_cn='1' and chk_gr='1' and DATE_FORMAT(chk_date, '%Y-%m-%d') like '%2022-06-06%' 
				$res['chk'] = $db->select_query("SELECT * FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['person_area']."' and chk_code='".$_SESSION['person_school']."' and chk_class='".$arr['num']['class_id']."' and chk_cn='".$arr['num']['clg_name']."' and chk_gr='".$_GET['gr']."' and DATE_FORMAT(chk_date, '%Y-%m-%d') like '%".$_GET['moid']."%' "); 
				@$arr['chk'] = $db->fetch(@$res['chk']);
				//echo $arr['chk']['chk_id'];
				if($arr['chk']['chk_id']){
					echo "<font color='gree'>เรียบร้อย</font>";
				} else {
					echo "<font color='red'>ไม่เรียบร้อย</font>";
				}

				?>
              </td>
			  <td style="text-align: center;">
			 <a href="index.php?name=behavior&file=bclass&mo_id=<?php echo $_GET['moid'];?>&route=behavior/bclass" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			  </td>
            </tr>

            <?php $i++;} ?>
          </tbody>
		  </table>
	      </form>

    </div>
    </div>
    </div>

	
	</div>
	<!-- /.col -->
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
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 11 */ { "bSortable": false , 'aTargets': [ 0 ]}
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
        <div class="col-md-12">

<?php
//<form action="index.php?name=config&file=student&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
?>


					    <div class="box box-success" id="loading-example">
                                <div class="box-header with-border">
                                <i class="fa fa-user"></i>
                                    <h3 class="box-title">ตรวจสอบการบันทึกข้อมูลประจำวัน</h3>
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
	</div>
</div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _heading_title_M_tab1;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                <div class="hidden-xs"><?php if($_SESSION['person_school'] =='44012028'){ echo "กิจกรรม MindSet";} else {echo _heading_title_M_tab2;}?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                <div class="hidden-xs"><?php if($_SESSION['person_school'] =='44012028'){ echo "กิจกรรม Rivision";} else {echo _heading_title_M_tab3;}?></div>
            </button>
        </div>
    </div>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="tab1">
				<br>
				  <?php
					//$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					@$res['num'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." where c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."'  group by DATE_FORMAT(c_date, '%Y-%m') order by c_date "); 
					@$rows['num'] = $db->rows(@$res['num']);
					?>
				  <form  method="post" enctype="multipart/form-data" id="form" class="form-inline">
					<table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
					  <thead>
						<tr >
						  <th width="1" style="text-align: center;">#</th>
						  <th layout="block" style="text-align:center;" >เดือน</th>
						  <th layout="block" style="text-align:center;">จำนวนชั้้นที่บันทึกข้อมูล</th>
						  <th layout="block" style="text-align:center;">Action</th>
						</tr>
					  </thead>
					  <tbody>
					<?php
					$i=1;
					$month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
					while (@$arr['num'] = $db->fetch(@$res['num'])){
					$DD=explode("-",@$arr['num']['c_date']);
					$DD1=$DD[0]."-".$DD[1];
					//echo $DD1;
					$get_month = $DD[1];
					$year = $DD[0]+543;
					@$res['chkclass'] = $db->select_query("SELECT *,count(chk_id) as CO  FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['person_area']."' and chk_code='".$_SESSION['person_school']."' and chk_gr='1' and DATE_FORMAT(chk_date, '%Y-%m') like '%".$DD1."%' group by DATE_FORMAT(chk_date, '%Y-%m') like '%".$DD1."%'"); 
					@$arr['chkclass']= $db->fetch(@$res['chkclass']);
					?>
						<tr>
						  <td style="text-align: center;"><?php echo $i;?></td>
						  <td layout="block" style="text-align: left;"><?php echo $month[$get_month]." ".$year;?></td>
						  <td layout="block" style="text-align: center;"><?=$arr['chkclass']['CO'];?></td>
						  <td layout="block" style="text-align: center;">
						 <a href="index.php?name=check&file=bclass&op=cldetail&mo_id=<?php echo $DD1;?>&gr=1&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
						  </td>
						</tr>

						<?php $i++;} ?>
					  </tbody>
					  </table>
					  </form>

		</div>
		<div class="tab-pane fade in" id="tab2">

				<br>
				  <?php
					//$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					@$res['num'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." where c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by DATE_FORMAT(c_date, '%Y-%m') order by c_date "); 
					@$rows['num'] = $db->rows(@$res['num']);
					?>
				  <form  method="post" enctype="multipart/form-data" id="form" class="form-inline">
					<table id="example2" class="table table-bordered table-striped responsive" style="width:100%">
					  <thead>
						<tr >
						  <th width="1" style="text-align: center;">#</th>
						  <th layout="block" style="text-align:center;" >เดือน</th>
						  <th layout="block" style="text-align:center;">จำนวนชั้้นที่บันทึกข้อมูล</th>
						  <th layout="block" style="text-align:center;">Action</th>
						</tr>
					  </thead>
					  <tbody>
					<?php
					$i=1;
					$month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
					while (@$arr['num'] = $db->fetch(@$res['num'])){
					$DD=explode("-",@$arr['num']['c_date']);
					$DD1=$DD[0]."-".$DD[1];
					//echo $DD1;
					$get_month = $DD[1];
					$year = $DD[0]+543;
					@$res['chkclass'] = $db->select_query("SELECT *,count(chk_id) as CO  FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['person_area']."' and chk_code='".$_SESSION['person_school']."' and chk_gr='2' and DATE_FORMAT(chk_date, '%Y-%m') like '%".$DD1."%' group by DATE_FORMAT(chk_date, '%Y-%m') like '%".$DD1."%'"); 
					@$arr['chkclass']= $db->fetch(@$res['chkclass']);
					?>
						<tr>
						  <td style="text-align: center;"><?php echo $i;?></td>
						  <td layout="block" style="text-align: left;"><?php echo $month[$get_month]." ".$year;?></td>
						  <td layout="block" style="text-align: center;"><?=$arr['chkclass']['CO'];?></td>
						  <td layout="block" style="text-align: center;">
						 <a href="index.php?name=check&file=bclass&op=cldetail&mo_id=<?php echo $DD1;?>&gr=2&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
						  </td>
						</tr>

						<?php $i++;} ?>
					  </tbody>
					  </table>
					  </form>

		</div>
        <div class="tab-pane fade in" id="tab3">

				<br>
				  <?php
					//$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					@$res['num'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." where c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by DATE_FORMAT(c_date, '%Y-%m') order by c_date "); 
					@$rows['num'] = $db->rows(@$res['num']);
					?>
				  <form  method="post" enctype="multipart/form-data" id="form" class="form-inline">
					<table id="example3" class="table table-bordered table-striped responsive" style="width:100%">
					  <thead>
						<tr >
						  <th width="1" style="text-align: center;">#</th>
						  <th layout="block" style="text-align:center;" >เดือน</th>
						  <th layout="block" style="text-align:center;">จำนวนชั้้นที่บันทึกข้อมูล</th>
						  <th layout="block" style="text-align:center;">Action</th>
						</tr>
					  </thead>
					  <tbody>
					<?php
					$i=1;
					$month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
					while (@$arr['num'] = $db->fetch(@$res['num'])){
					$DD=explode("-",@$arr['num']['c_date']);
					$DD1=$DD[0]."-".$DD[1];
					//echo $DD1;
					$get_month = $DD[1];
					$year = $DD[0]+543;
					@$res['chkclass'] = $db->select_query("SELECT *,count(chk_id) as CO  FROM ".TB_CHK_CHCLASS." WHERE chk_area='".$_SESSION['person_area']."' and chk_code='".$_SESSION['person_school']."' and chk_gr='3' and DATE_FORMAT(chk_date, '%Y-%m') like '%".$DD1."%' group by DATE_FORMAT(chk_date, '%Y-%m') like '%".$DD1."%'"); 
					@$arr['chkclass']= $db->fetch(@$res['chkclass']);
					?>
						<tr>
						  <td style="text-align: center;"><?php echo $i;?></td>
						  <td layout="block" style="text-align: left;"><?php echo $month[$get_month]." ".$year;?></td>
						  <td layout="block" style="text-align: center;"><?=$arr['chkclass']['CO'];?></td>
						  <td layout="block" style="text-align: center;">
						 <a href="index.php?name=check&file=bclass&op=cldetail&mo_id=<?php echo $DD1;?>&gr=3&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
						  </td>
						</tr>

						<?php $i++;} ?>
					  </tbody>
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
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 11 */ { "bSortable": false , 'aTargets': [ 0 ]}
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
								}
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
                              });


        var aoColumns2 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 11 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable2 = $("#example2").dataTable({
								"aoColumns": aoColumns2,
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
        var aoColumns3 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 11 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable3 = $("#example3").dataTable({
								"aoColumns": aoColumns3,
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
}
?>

<script type="text/javascript">
		$(function(){
			$('#dp1').datepicker();
			$('#dp2').datepicker();
			$('#dp3').datepicker();
			$('#dp4').datepicker();
         });
</script>


<?php } else { echo "<meta http-equiv='refresh' content='0; url=index.php'>"; }?>

