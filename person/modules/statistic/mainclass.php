<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
if(!empty($_SESSION['person_login'])){
?>

<div class="col-xs-12">
<?php
if($op=='cldetail' and $action=='' ){
@$res['count'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_class='".$_GET['class_id']."' and stu_cn='".$_GET['class_cn']."' "); 
@$rows['count'] = $db->rows(@$res['count']);
@$res['Cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".$_GET['class_id']."' "); 
@$arr['Cl'] =$db->fetch(@$res['Cl']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >

		<div align="right" >
		<div class="form-group"><a href="index.php?name=statistic&file=mainclass&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>

    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title;?>&nbsp;<span class="badge bg-green"><?php echo @$arr['Cl']['class_name']; ?>/<?=$_GET['class_cn'];?></span></h3>
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
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_class='".$_GET['class_id']."' and stu_cn='".$_GET['class_cn']."'  order by id "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form  method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_id; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_num;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_names;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_add;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_group;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_ban;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tambon;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_amp;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_prov;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tel;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_phone;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['num']['stu_class']."' "); 
		@$arr['class'] =$db->fetch(@$res['class']);
		@$res['prov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." WHERE id='".@$arr['num']['stu_prov']."' "); 
		@$arr['prov'] =$db->fetch(@$res['prov']);
		@$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." WHERE id='".@$arr['num']['stu_amp']."' "); 
		@$arr['amp'] =$db->fetch(@$res['amp']);
		@$res['tam'] = $db->select_query("SELECT * FROM ".TB_TUMBON." WHERE id='".@$arr['num']['stu_tum']."' "); 
		@$arr['tam'] =$db->fetch(@$res['tam']);
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_id']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_pid']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." " .@$arr['num']['stu_sur'];?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="#" data-toggle="modal" data-target="#myModal<?php echo $i;?>" data-artid="<?php echo @$arr['num']['stu_id']; ?>" class="btn" id="Mybtn"><i class="glyphicon glyphicon-user"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_add']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_group']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_ban']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['tam']['name']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['amp']['name']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['prov']['name']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_post']; ?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['stu_sphone']; ?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=statistic&file=mainclass&op=studetail&stuid=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			  </td>

				<div id="myModal<?php echo $i;?>" class="modal fade" >
					<div class="modal-dialog modal-dialogs">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">X</button>
								  <h4 class="modal-title"><i class="fa fa-user"></i>&nbsp;<?php echo _heading_title;?></h4>
							</div>
							<div class="modal-body" align="center">
								<img src="<?php if(@$arr['num']['stu_pic']){echo WEB_URL_IMG_STU.@$arr['num']['stu_pic'];}else{echo WEB_URL_IMG_STU."no_image.jpg";}?>"  width="150" class="img-circle" alt="User Image"/>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

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
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 5 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 7 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 8 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 8 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 9 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 10 */ { "bSortable": true , 'aTargets': [ 1 ]},
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
} else if($op =='studetail' ){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_id='".$_GET['stuid']."' order by stu_class,stu_id"); 
@$arr['user'] = $db->fetch(@$res['user']);
@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['user']['stu_class']."' "); 
@$arr['class'] = $db->fetch(@$res['class']);
@$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_area='".$_SESSION['person_area']."' and sh_code='".$_SESSION['person_school']."' "); 
@$arr['sh']= $db->fetch(@$res['sh']);
?>

		<div align="right" >
		<div class="form-group"><a href="index.php?name=statistic&file=mainclass&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>

				<form method="post" enctype="multipart/form-data" id="form" class="form-horizontal" >
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="fa fa-user"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen_detail; ?></h3>
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
<div class="form-group">
	<div class="col-sm-12" >
	</div>
</div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab1;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab2;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab3;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab4" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab4;?></div>
            </button>
        </div>
    </div>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="tab1">
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>
<?php
@$res['countB'] = $db->select_query("SELECT * FROM ".TB_BAD." where bad_stu='".$_GET['stuid']."' group by bad_id"); 
@$rows['countB'] = $db->rows(@$res['countB']);
if(@$rows['countB']) {
@$res['sumB'] = $db->select_query("SELECT *,sum(b.badtail_point) As SUMB FROM ".TB_BAD."  as a, ".TB_BADTAIL." as b where a.bad_stu='".$_GET['stuid']."' and a.bad_tail=b.badtail_id group by a.bad_stu"); 
@$rows['sumB'] = $db->fetch(@$res['sumB']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >

    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title_tab_bad; ?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-red"><?php echo _text_box_table_count." : ".@$rows['countB'];?>&nbsp;(-<?php echo "".@$rows['sumB']['SUMB'];?>)</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['bad'] = $db->select_query("SELECT * FROM ".TB_BAD." where bad_stu='".$_GET['stuid']."' order by bad_id "); 
//		@$rows['num'] = $db->rows(@$res['num']);
		?>
      <form id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" ><?php echo _heading_table_header_bad_date; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _heading_table_header_bad_tail;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _heading_table_header_bad_level;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _heading_table_header_bad_name;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _heading_table_header_bad_data;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _heading_table_header_bad_score;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['bad'] = $db->fetch(@$res['bad'])){
		@$res['tail'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_id='".@$arr['bad']['bad_tail']."' "); 
		@$arr['tail'] =$db->fetch(@$res['tail']);
		@$res['data'] = $db->select_query("SELECT * FROM ".TB_BADDATA." WHERE bdata_id='".@$arr['bad']['bad_t']."' "); 
		@$arr['data'] =$db->fetch(@$res['data']);
		@$res['level'] = $db->select_query("SELECT * FROM ".TB_BADLEVEL." WHERE blevel_id='".@$arr['tail']['badtail_level']."' "); 
		if(@$arr['level']['blevel_id']==1) { //ส่วนของการ สลับสี 
			$ColorFill = '#330000';
		} else if(@$arr['level']['blevel_id']==2) { //ส่วนของการ สลับสี 
			$ColorFill = '#33CC99';
		} else {
			$ColorFill = '#FF0000';
		}
		?>
            <tr >
              <td style="text-align: center;"><font color="<?php echo $ColorFill;?>"><?php echo $i;?></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo ShortDateThai(@$arr['bad']['b_date']);?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['tail']['badtail_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['level']['blevel_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['bad']['bad_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['data']['bdata_name'];?></font></td>
              <td layout="block" style="text-align: center;"><font color="<?php echo $ColorFill;?>">-<?php echo @$arr['tail']['badtail_point'];?></font></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=statistic&file=mainclass&op=cldetail&class_id=<?php echo @$arr['num']['stu_class'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
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
        var aoColumns1 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 5 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable1 = $("#example1").dataTable({
								"aoColumns": aoColumns1,
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
	         <?php } else { ?>
    <div class="box box-danger">
		    <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title_tab_bad; ?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
		<div class="box-body ">
              <?php echo _text_no_results; ?>
		</div>
	</div>
            <?php } ?>
		</div>

		<div class="tab-pane fade in" id="tab2">
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>
<?php
@$res['countG'] = $db->select_query("SELECT * FROM ".TB_GOOD." where good_stu='".$_GET['stuid']."' group by good_id"); 
@$rows['countG'] = $db->rows(@$res['countG']);
if(@$rows['countG']) {
@$res['sumG'] = $db->select_query("SELECT *,sum(b.goodtail_point) As SUMG FROM ".TB_GOOD."  as a, ".TB_GOODTAIL." as b where a.good_stu='".$_GET['stuid']."' and a.good_tail=b.goodtail_id group by a.good_stu"); 
@$rows['sumg'] = $db->fetch(@$res['sumG']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >

    <div class="box box-info">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title_tab_good; ?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." : ".@$rows['countG'];?>&nbsp;(<?php echo "".@$rows['sumg']['SUMG'];?>)</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['good'] = $db->select_query("SELECT * FROM ".TB_GOOD." where good_stu='".$_GET['stuid']."' order by good_id "); 
//		@$rows['num'] = $db->rows(@$res['num']);
		?>
      <form id="form" class="form-inline">
        <table id="example2" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" ><?php echo _heading_table_header_good_date; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _heading_table_header_good_tail;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _heading_table_header_good_level;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _heading_table_header_good_name;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _heading_table_header_good_data;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _heading_table_header_good_score;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['good'] = $db->fetch(@$res['good'])){
		@$res['tail'] = $db->select_query("SELECT * FROM ".TB_GOODTAIL." WHERE goodtail_id='".@$arr['good']['good_tail']."' "); 
		@$arr['tail'] =$db->fetch(@$res['tail']);
		@$res['data'] = $db->select_query("SELECT * FROM ".TB_GOODDATA." WHERE gdata_id='".@$arr['good']['good_t']."' "); 
		@$arr['data'] =$db->fetch(@$res['data']);
		@$res['level'] = $db->select_query("SELECT * FROM ".TB_GOODLEVEL." WHERE blevel_id='".@$arr['tail']['goodtail_level']."' "); 
		@$arr['level'] =$db->fetch(@$res['level']);
		if(@$arr['level']['blevel_id']==1) { //ส่วนของการ สลับสี 
			$ColorFill = '#009933';
		} else if(@$arr['level']['blevel_id']==2) { //ส่วนของการ สลับสี 
			$ColorFill = '#FF9900';
		} else {
			$ColorFill = '#25c002';
		}
		?>
            <tr >
              <td style="text-align: center;"><?php echo $i;?></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo ShortDateThai(@$arr['good']['b_date']);?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['tail']['goodtail_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['level']['blevel_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['good']['good_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['data']['gdata_name'];?></font></td>
              <td layout="block" style="text-align: center;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['tail']['goodtail_point'];?></font></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=statistic&file=mainclass&op=cldetail&class_id=<?php echo @$arr['num']['stu_class'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
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
        var aoColumns2 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 5 */ { "bSortable": false , 'aTargets': [ 0 ]}
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

            });
        </script>
	         <?php } else { ?>
    <div class="box box-info">
		    <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title_tab_good; ?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
		<div class="box-body ">
              <?php echo _text_no_results; ?>
		</div>
	</div>
            <?php } ?>



		</div>



        <div class="tab-pane fade in" id="tab3">


		<!-- คณะกรรมการนักเรียน -->
		<?php
		@$res['count2'] = $db->select_query("SELECT * FROM ".TB_COUNTAIL." WHERE cot_area='".$_SESSION['person_area']."' and cot_code='".$_SESSION['person_school']."' and cot_stu='".@$arr['user']['stu_id']."' "); 
		@$rows['count2'] = $db->rows(@$res['count2']);		
		if(@$rows['count2']){
		?>
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>

<div class="row">
<div class="col-xs-12 connectedSortable">

    <div class="box box-info">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-user"></i>
                 <h3 class="box-title"><?php echo _heading_title_council; ?>&nbsp;<?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['count2'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		
		@$res['num2'] = $db->select_query("SELECT * FROM ".TB_COUNTAIL." WHERE cot_area='".$_SESSION['person_area']."' and cot_code='".$_SESSION['person_school']."' and cot_stu='".@$arr['user']['stu_id']."' order by cot_id desc"); 
//		@$rows['num1'] = $db->rows(@$res['num1']);
		?>


      <form method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example4" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5%" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;" width="50%"><?php echo _text_box_table_council_name;?></th>
			  <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bg_date;?></th>
              <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_pu_score; ?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
//		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_COUNCIL." WHERE co_stu='".$_GET['id']."' order by cot_id"); 
		while (@$arr['num2'] = $db->fetch(@$res['num2'])){
			@$res['tail2'] = $db->select_query("SELECT * FROM ".TB_COUNCIL." WHERE co_id='".@$arr['num2']['cot_co']."' "); 
			@$arr['tail2'] =$db->fetch(@$res['tail2']);
			?>
            <tr>
              <td style="text-align: center;"><font color="<?php echo $ColorFill;?>"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['tail2']['co_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo ShortDateThai(@$arr['num2']['cot_date']);?></font></td>
              <td layout="block" style="text-align: center;"><?php echo (int)@$arr['tail2']['co_point'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right"><?php echo _text_box_table_good_score_sum;?> :</th>
                <th></th>
            </tr>
        </tfoot>
		  </table>

		  
	      </form>

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
        var aoColumns4 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable4 = $("#example4").dataTable({
								"aoColumns": aoColumns4,
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
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' <?php echo _text_box_table_pu_score;?> )'
            );
        }
								});

            });
        </script>

    </div>
    </div>
    </div>

	
	</div>
            <?php } ?>


		<!-- คณะกรรมการห้องเรียนสีขาว -->
		<?php
		@$res['count3'] = $db->select_query("SELECT * FROM ".TB_WHITECLTAIL." WHERE whcl_area='".$_SESSION['person_area']."' and whcl_code='".$_SESSION['person_school']."' and whcl_stu='".@$arr['user']['stu_id']."' "); 
		@$rows['count3'] = $db->rows(@$res['count3']);		
		if(@$rows['count3']){
		?>
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>

<div class="row">
<div class="col-xs-12 connectedSortable">

    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-signal"></i>
                 <h3 class="box-title"><?php echo _heading_title_whiteclass; ?>&nbsp;<?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['count3'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		
		@$res['num3'] = $db->select_query("SELECT * FROM ".TB_WHITECLTAIL." WHERE whcl_area='".$_SESSION['person_area']."' and whcl_code='".$_SESSION['person_school']."' and whcl_stu='".@$arr['user']['stu_id']."' order by whcl_id desc"); 
//		@$rows['num1'] = $db->rows(@$res['num1']);
		?>


      <form method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example5" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5%" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;" width="50%"><?php echo _text_box_table_whiteclass_name;?></th>
			  <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bg_date;?></th>
              <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_pu_score; ?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
//		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_WHITECLASS." WHERE wh_stu='".$_GET['id']."' order by whcl_id"); 
		while (@$arr['num3'] = $db->fetch(@$res['num3'])){
			@$res['tail3'] = $db->select_query("SELECT * FROM ".TB_WHITECLASS." WHERE wh_id='".@$arr['num3']['whcl_wh']."' "); 
			@$arr['tail3'] =$db->fetch(@$res['tail3']);
			?>
            <tr>
              <td style="text-align: center;"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['tail3']['wh_name'];?></td>
              <td layout="block" style="text-align: left;"><?php echo ShortDateThai(@$arr['num3']['whcl_date']);?></td>
              <td layout="block" style="text-align: center;"><?php echo (int)@$arr['tail3']['wh_point'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right"><?php echo _text_box_table_good_score_sum;?> :</th>
                <th></th>
            </tr>
        </tfoot>
		  </table>

		  
	      </form>

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
        var aoColumns5 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable5 = $("#example5").dataTable({
								"aoColumns": aoColumns5,
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
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' <?php echo _text_box_table_pu_score;?> )'
            );
        }
								});

            });
        </script>

    </div>
    </div>
    </div>

	
	</div>
            <?php } ?>


		<!-- หน้าที่พิเศษ -->
		<?php
		@$res['count1'] = $db->select_query("SELECT * FROM ".TB_PUTTAIL." WHERE pt_area='".$_SESSION['person_area']."' and pt_code='".$_SESSION['person_school']."'  and pt_stu='".@$arr['user']['stu_id']."' "); 
		@$rows['count1'] = $db->rows(@$res['count1']);		
		if(@$rows['count1']){
		?>
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>

<div class="row">
<div class="col-xs-12 connectedSortable">

    <div class="box box-warning">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-th-list"></i>
                 <h3 class="box-title"><?php echo _heading_title_put; ?>&nbsp;<?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></h3>
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
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_PUTTAIL." WHERE pt_area='".$_SESSION['person_area']."' and pt_code='".$_SESSION['person_school']."' and pt_stu='".@$arr['user']['stu_id']."' order by pt_id desc"); 
//		@$rows['num1'] = $db->rows(@$res['num1']);
		?>


      <form method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example3" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5%" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;" width="50%"><?php echo _text_box_table_pu_name;?></th>
			  <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bg_date;?></th>
              <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_pu_score; ?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
//		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_PUT." WHERE pu_stu='".$_GET['id']."' order by cot_id"); 
		while (@$arr['num'] = $db->fetch(@$res['num'])){
			@$res['tail'] = $db->select_query("SELECT * FROM ".TB_PUT." WHERE pu_id='".@$arr['num']['pt_pu']."' "); 
			@$arr['tail'] =$db->fetch(@$res['tail']);
			?>
            <tr>
              <td style="text-align: center;"><font color="<?php echo $ColorFill;?>"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['tail']['pu_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo ShortDateThai(@$arr['num']['pt_date']);?></font></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['tail']['pu_point'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right"><?php echo _text_box_table_good_score_sum;?> :</th>
                <th></th>
            </tr>
        </tfoot>
		  </table>

		  
	      </form>

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
        var aoColumns3 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
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
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' <?php echo _text_box_table_pu_score;?> )'
            );
        }
								});

            });
        </script>

    </div>
    </div>
    </div>

	
	</div>
            <?php } ?>
	<!-- /.col -->

		<!-- กิจกรรมนักเรียน -->
		<?php
		@$res['count4'] = $db->select_query("SELECT * FROM ".TB_AFFTAIL." WHERE afft_area='".$_SESSION['person_area']."' and afft_code='".$_SESSION['person_school']."' and afft_stu='".@$arr['user']['stu_id']."' "); 
		@$rows['count4'] = $db->rows(@$res['count4']);		
		if(@$rows['count4']){
		?>
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>

<div class="row">
<div class="col-xs-12 connectedSortable">

    <div class="box box-warning">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-book"></i>
                 <h3 class="box-title"><?php echo _heading_title_affairs; ?>&nbsp;<?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['count4'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		
		@$res['num4'] = $db->select_query("SELECT * FROM ".TB_AFFTAIL." WHERE afft_area='".$_SESSION['person_area']."' and afft_code='".$_SESSION['person_school']."' and afft_stu='".@$arr['user']['stu_id']."' order by afft_id desc"); 
//		@$rows['num1'] = $db->rows(@$res['num1']);
		?>


      <form method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example6" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5%" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;" width="50%"><?php echo _text_box_table_afft_name;?></th>
			  <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bg_date;?></th>
              <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_pu_score; ?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
//		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." WHERE aff_stu='".$_GET['id']."' order by afft_id"); 
		while (@$arr['num4'] = $db->fetch(@$res['num4'])){
			@$res['tail4'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." WHERE aff_id='".@$arr['num4']['afft_aff']."' "); 
			@$arr['tail4'] =$db->fetch(@$res['tail4']);
			?>
            <tr>
              <td style="text-align: center;"><font color="<?php echo $ColorFill;?>"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['tail4']['aff_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo ShortDateThai(@$arr['num4']['afft_date']);?></font></td>
              <td layout="block" style="text-align: center;"><?php echo (int)@$arr['tail4']['aff_point'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right"><?php echo _text_box_table_good_score_sum;?> :</th>
                <th></th>
            </tr>
        </tfoot>
		  </table>

		  
	      </form>

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
        var aoColumns6 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable6 = $("#example6").dataTable({
								"aoColumns": aoColumns6,
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
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' <?php echo _text_box_table_pu_score;?> )'
            );
        }
								});

            });
        </script>

    </div>
    </div>
    </div>
	
	</div>
           <?php } ?>


        </div>
        <div class="tab-pane fade in" id="tab4">
<br>
<div class="col-xs-12">
      <!-- Info boxes -->
      <div class="row">
 
        <div class="col-lg-6 col-xs-12" >
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo number_format(StatScore_GoodClass_PerStu($_SESSION['person_area'],$_SESSION['person_school'],$arr['user']['stu_class'],$arr['user']['stu_cn'],$arr['user']['stu_id']));?></h3>

              <p>คะแนนพฤติกรรมบวก</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo number_format(StatScore_BadClass_PerStu($_SESSION['person_area'],$_SESSION['person_school'],$arr['user']['stu_class'],$arr['user']['stu_cn'],$arr['user']['stu_id']));?></h3>

              <p>คะแนนพฤติกรรมลบ</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

	</div><!-- /.row -->
</div><!-- /.col -->

        </div><!-- /.tab -->


		</div>
	</div>

	</form>

<?php
} else {
?>
<script>
$(document).ready(function(){
	$("#Sumclass").load("modules/statistic/sum_mainclass.php");
	$("#Graphclass").load("modules/statistic/graph_mainclass.php");
});
</script>

      <div class="row">
	  <div id="Sumclass" ><center><img src="../img/ajax-loader1.gif" border="0"></center></div>
	  </div>
      <div class="row">
	  <div id="Graphclass" ><center><img src="../img/ajax-loader1.gif" border="0"></center></div>
	  </div>
<?php
@$res['count'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' group by stu_id"); 
@$rows['count'] = $db->rows(@$res['count']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >

    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title; ?></h3>
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
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['num'] = $db->select_query("SELECT *,count(stu_id) as CO FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' group by stu_class,stu_cn order by stu_class,stu_cn "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form  method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_stu_class; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_boy;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_girl;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_sum;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_percen;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['num']['stu_class']."' "); 
		@$arr['class'] =$db->fetch(@$res['class']);
		@$res['boy'] = $db->select_query("select *,count(stu_num) as Boy from ".TB_STUDENT."  where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_sex='1' and stu_class='".@$arr['num']['stu_class']."' and stu_cn='".@$arr['num']['stu_cn']."' group by stu_class,stu_cn "); 
		@$arr['boy'] =$db->fetch(@$res['boy']);
		@$res['girl'] = $db->select_query("select *,count(stu_num) as Girl from ".TB_STUDENT."  where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_sex='2' and stu_class='".@$arr['num']['stu_class']."' and stu_cn='".@$arr['num']['stu_cn']."' group by stu_class,stu_cn "); 
		@$arr['girl'] =$db->fetch(@$res['girl']);
		@$PerC=(100*(@$arr['num']['CO']))/(@$rows['count']);
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name'];?>/<?php echo @$arr['num']['stu_cn'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['boy']['Boy'];?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['girl']['Girl'];?></td>
               <td layout="block" style="text-align: center;"><?php echo @$arr['num']['CO'];?></td>
              <td layout="block" style="text-align: center;"><?php echo number_format((@$PerC),2);?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=statistic&file=mainclass&op=cldetail&class_id=<?php echo @$arr['num']['stu_class'];?>&class_cn=<?php echo @$arr['num']['stu_cn'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
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
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 5 */ { "bSortable": false , 'aTargets': [ 0 ]}
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
}
?>
</div>
<!-- /.row -->

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
<?php require_once ("modules/index/footer.php"); ?>


