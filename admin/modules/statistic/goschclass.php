<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
if(!empty($_SESSION['admin_login'])){
?>

<div class="col-xs-12">
<?php
if($op=='cldetail' and $action=='' ){
@$res['count'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_class='".$_GET['class_id']."' "); 
@$rows['count'] = $db->rows(@$res['count']);
@$res['Cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".$_GET['class_id']."' "); 
@$arr['Cl'] =$db->fetch(@$res['Cl']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">

		<div align="right" >
		<div class="form-group"><a href="index.php?name=statistic&file=goschclass&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>

    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title;?>&nbsp;<span class="badge bg-green"><?php echo @$arr['Cl']['class_name']; ?></span></h3>
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
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_class='".$_GET['class_id']."'  order by stu_class"); 
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
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_kad;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_la;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_sai;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_op;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['num']['stu_class']."' "); 
		@$arr['class'] =$db->fetch(@$res['class']);

		@$res['kad1'] = $db->select_query("select *,count(c_stu) as KAD1 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k like '%???????????????%' and c_stu='".@$arr['num']['stu_id']."' group by c_stu"); 
		@$arr['kad1'] =$db->fetch(@$res['kad1']);
		@$res['kad2'] = $db->select_query("select *,count(c_stu) as KAD2 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k2 like '%???????????????%' and c_stu='".@$arr['num']['stu_id']."' group by c_stu"); 
		@$arr['kad2'] =$db->fetch(@$res['kad2']);
		@$res['kad3'] = $db->select_query("select *,count(c_stu) as KAD3 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k3 like '%???????????????%' and c_stu='".@$arr['num']['stu_id']."' group by c_stu"); 
		@$arr['kad3'] =$db->fetch(@$res['kad3']);
		@$res['kad4'] = $db->select_query("select *,count(c_stu) as KAD4 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k4 like '%???????????????%' and c_stu='".@$arr['num']['stu_id']."' group by c_stu"); 
		@$arr['kad4'] =$db->fetch(@$res['kad4']);

		$KAD=@$arr['kad1']['KAD1']+@$arr['kad2']['KAD2']+@$arr['kad3']['KAD3']+@$arr['kad4']['KAD4'];


		@$res['la1'] = $db->select_query("select *,count(c_stu) as LA1 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k like '%??????%' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['la1'] =$db->fetch(@$res['la1']);
		@$res['la2'] = $db->select_query("select *,count(c_stu) as LA2 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k2 like '%??????%' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['la2'] =$db->fetch(@$res['la2']);
		@$res['la3'] = $db->select_query("select *,count(c_stu) as LA3 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k3 like '%??????%' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['la3'] =$db->fetch(@$res['la3']);
		@$res['la4'] = $db->select_query("select *,count(c_stu) as LA4 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k4 like '%??????%' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['la4'] =$db->fetch(@$res['la4']);

		$LA=@$arr['la1']['LA1']+@$arr['la2']['LA2']+@$arr['la3']['LA3']+@$arr['la4']['LA4'];


		@$res['sai1'] = $db->select_query("select *,count(c_stu) as SAI1 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k like '%?????????%' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['sai1'] =$db->fetch(@$res['sai1']);
		@$res['sai2'] = $db->select_query("select *,count(c_stu) as SAI2 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k2 like '%?????????%' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['sai2'] =$db->fetch(@$res['sai2']);
		@$res['sai3'] = $db->select_query("select *,count(c_stu) as SAI3 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k3 like '%?????????%' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['sai3'] =$db->fetch(@$res['sai3']);
		@$res['sai4'] = $db->select_query("select *,count(c_stu) as SAI4 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k4 like '%?????????%' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['sai4'] =$db->fetch(@$res['sai4']);

		$SAI=@$arr['sai1']['SAI1']+@$arr['sai2']['SAI2']+@$arr['sai3']['SAI3']+@$arr['sai4']['SAI4'];

		@$res['op1'] = $db->select_query("select *,count(c_stu) as OP1 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch1= '1' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['op1'] =$db->fetch(@$res['op1']);
		@$res['op2'] = $db->select_query("select *,count(c_stu) as OP2 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch2= '2' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['op2'] =$db->fetch(@$res['op2']);
		@$res['op3'] = $db->select_query("select *,count(c_stu) as OP3 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch3= '3' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['op3'] =$db->fetch(@$res['op3']);
		@$res['op4'] = $db->select_query("select *,count(c_stu) as OP4 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch4= '4' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['op4'] =$db->fetch(@$res['op4']);
		@$res['op5'] = $db->select_query("select *,count(c_stu) as OP5 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch5= '5' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['op5'] =$db->fetch(@$res['op5']);
		@$res['op6'] = $db->select_query("select *,count(c_stu) as OP6 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch6= '6' and c_stu='".@$arr['num']['stu_id']."' group by c_stu"); 
		@$arr['op6'] =$db->fetch(@$res['op6']);
		@$res['op7'] = $db->select_query("select *,count(c_stu) as OP7 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch7= '7' and c_stu='".@$arr['num']['stu_id']."' group by c_stu "); 
		@$arr['op7'] =$db->fetch(@$res['op7']);
//		@$PerC=(100*(@$arr['num']['CO']))/(@$rows['count']);
		$OPSS=@$arr['op1']['OP1']+@$arr['op2']['OP2']+@$arr['op3']['OP3']+@$arr['op4']['OP4']+@$arr['op5']['OP5']+@$arr['op6']['OP6']+@$arr['op7']['OP7'];
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_id']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_pid']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." " .@$arr['num']['stu_sur'];?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="#" data-toggle="modal" data-target="#myModal<?php echo $i;?>" data-artid="<?php echo @$arr['num']['stu_id']; ?>" class="btn" id="Mybtn"><i class="glyphicon glyphicon-user"></i></a><?php } ?></td>
              <td layout="block" style="text-align: center;"><?php echo number_format(($KAD),0);?></td>
              <td layout="block" style="text-align: center;"><?php echo number_format(($LA),0);?></td>
               <td layout="block" style="text-align: center;"><?php echo number_format(($SAI),0);?></td>
              <td layout="block" style="text-align: center;"><?php echo number_format(($OPSS),0);?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=statistic&file=goschclass&op=studetail&stuid=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
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
									{ // ????????????????????????????????????????????????????????? pdf
									"extend": 'pdf', // ??????????????????????????? pdf ????????????
									"exportOptions" : {
										columns: ':visible'
									},
									"text": 'PDF', // ??????????????????????????????????????????
									"pageSize": 'A4',   // ?????????????????????????????????????????????????????? A4
									"filename" : '<?php echo _heading_title;?>',
									"title" : '<?php echo _heading_title;?>',
									"customize":function(doc){ // ?????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????? pdfmake
									// ??????????????? style ????????????
										doc.defaultStyle = {
										font:'THSarabun',
										fontSize:16                                 
										};
										// ??????????????????????????????????????????????????? header ??????????????????????????????????????????????????????
////										doc.content[1].table.widths = [ 50, 'auto', '*', '*' ];
////										doc.styles.tableHeader.fontSize = 16; // ??????????????????????????? font ????????? header
////										var rowCount = doc.content[1].table.body.length; // ????????????????????????????????????????????????????????????????????????
										// ?????????????????????????????????????????????????????????????????????????????????????????? ???????????????????????????????????????????????????
////										for (i = 1; i < rowCount; i++) { // i ???????????????????????? 1 ??????????????? i ?????????????????????????????????????????????????????????
////											doc.content[1].table.body[i][0].alignment = 'center'; // ?????????????????????????????????????????????????????? 0
////											doc.content[1].table.body[i][1].alignment = 'center';
////											doc.content[1].table.body[i][2].alignment = 'left';
////											doc.content[1].table.body[i][3].alignment = 'right';
////										};                                  
////										console.log(doc); // ?????????????????? debug ?????? doc object proptery ???????????????????????????????????????????????????????????????
									} // ??????????????????????????????????????????????????????????????? pdf
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
@$res['user'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id='".$_GET['stuid']."' order by stu_class,stu_id"); 
@$arr['user'] = $db->fetch(@$res['user']);
@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['user']['stu_class']."' "); 
@$arr['class'] = $db->fetch(@$res['class']);

?>

		<div align="right" >
		<div class="form-group"><a href="index.php?name=statistic&file=goschclass&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
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
            <img class="card-bkimg" alt="" src="<?php echo WEB_URL_IMG_STU.@$arr['user']['stu_pic'];?>">
            <!-- http://lorempixel.com/850/280/people/9/ -->
        </div>
        <div class="useravatar">
            <img alt="" src="<?php echo WEB_URL_IMG_STU.@$arr['user']['stu_pic'];?>">
        </div>
        <div class="card-info"> <span class="card-title"><?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></span>
        </div>
    </div>
<div class="form-group">
	<div class="col-sm-12" >
	</div>
</div>


<?php
@$res['countB'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." where c_stu='".$_GET['stuid']."' and c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' group by c_id"); 
@$rows['countB'] = $db->rows(@$res['countB']);
if(@$rows['countB']) {
?>
<div class="row">
<div class="col-xs-12 connectedSortable">

    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title_tab_bad; ?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-red"><?php echo _text_box_table_count." : ".@$rows['countB'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['bad'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." where c_stu='".$_GET['stuid']."' and c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' order by c_id desc"); 
//		@$rows['num'] = $db->rows(@$res['num']);
		?>
      <form id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" ><?php echo _heading_table_header_bad_date; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_morning;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_teing;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_lerk;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_kads;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_op;?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['bad'] = $db->fetch(@$res['bad'])){
		@$res['ch'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." where c_date='".@$arr['bad']['c_date']."' and c_stu='".$_GET['stuid']."'  and c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' order by c_id desc"); 
		@$arr['ch'] = $db->fetch(@$res['ch']);
		?>
            <tr >
              <td style="text-align: center;"><?php echo $i;?></td>
              <td layout="block" style="text-align: left;"><?php echo ShortDateThai(@$arr['bad']['c_date']);?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['bad']['c_k'];?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['bad']['c_k2'];?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['bad']['c_k3'];?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['bad']['c_k4'];?></td>
              <td layout="block" style="text-align: center;"><?php if(@$arr['ch']['c_ch1'] !=''){echo "?????????1,";}?><?php if(@$arr['ch']['c_ch2'] !=''){echo "?????????2,";}?><?php if(@$arr['ch']['c_ch3'] !=''){echo "?????????3,";}?><?php if(@$arr['ch']['c_ch4'] !=''){echo "?????????4,";}?><?php if(@$arr['ch']['c_ch5'] !=''){echo "?????????5,";}?><?php if(@$arr['ch']['c_ch6'] !=''){echo "?????????6,";}?><?php if(@$arr['ch']['c_ch7'] !=''){echo "?????????7";}?></td>
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
        var aoColumns = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
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
									{ // ????????????????????????????????????????????????????????? pdf
									"extend": 'pdf', // ??????????????????????????? pdf ????????????
									"exportOptions" : {
										columns: ':visible'
									},
									"text": 'PDF', // ??????????????????????????????????????????
									"pageSize": 'A4',   // ?????????????????????????????????????????????????????? A4
									"filename" : '<?php echo _heading_title;?>',
									"title" : '<?php echo _heading_title;?>',
									"customize":function(doc){ // ?????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????? pdfmake
									// ??????????????? style ????????????
										doc.defaultStyle = {
										font:'THSarabun',
										fontSize:16                                 
										};
										// ??????????????????????????????????????????????????? header ??????????????????????????????????????????????????????
////										doc.content[1].table.widths = [ 50, 'auto', '*', '*' ];
////										doc.styles.tableHeader.fontSize = 16; // ??????????????????????????? font ????????? header
////										var rowCount = doc.content[1].table.body.length; // ????????????????????????????????????????????????????????????????????????
										// ?????????????????????????????????????????????????????????????????????????????????????????? ???????????????????????????????????????????????????
////										for (i = 1; i < rowCount; i++) { // i ???????????????????????? 1 ??????????????? i ?????????????????????????????????????????????????????????
////											doc.content[1].table.body[i][0].alignment = 'center'; // ?????????????????????????????????????????????????????? 0
////											doc.content[1].table.body[i][1].alignment = 'center';
////											doc.content[1].table.body[i][2].alignment = 'left';
////											doc.content[1].table.body[i][3].alignment = 'right';
////										};                                  
////										console.log(doc); // ?????????????????? debug ?????? doc object proptery ???????????????????????????????????????????????????????????????
									} // ??????????????????????????????????????????????????????????????? pdf
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



	</form>

<?php
} else {
?>
<script>
$(document).ready(function(){
//	$("#Sumclass").load("modules/statistic/sum_mainclass.php");
//	$("#Graphclass").load("modules/statistic/graph_mainclass.php");
	$("#SumMclass").load("modules/statistic/sum_M_mainclass.php");
	$("#GraphMclass").load("modules/statistic/graph_M_mainclass.php");

});
</script>

      <div class="row">
	  <div id="SumMclass" ><center><img src="../img/ajax-loader1.gif" border="0"></center></div>
	  </div>
      <div class="row">
	  <div id="GraphMclass" ><center><img src="../img/ajax-loader1.gif" border="0"></center></div>
	  </div>
<?php
@$res['count'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' group by stu_id"); 
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
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_CHCLASS." where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' group by c_class order by c_class "); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form  method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_stu_class; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_kad;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_la;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_sai;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_op;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['num']['c_class']."' "); 
		@$arr['class'] =$db->fetch(@$res['class']);

		@$res['kad1'] = $db->select_query("select *,count(c_stu) as KAD1 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k like '%???????????????%' and c_class='".@$arr['num']['c_class']."'   group by c_class"); 
		@$arr['kad1'] =$db->fetch(@$res['kad1']);
		@$res['kad2'] = $db->select_query("select *,count(c_stu) as KAD2 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k2 like '%???????????????%' and c_class='".@$arr['num']['c_class']."'   group by c_class"); 
		@$arr['kad2'] =$db->fetch(@$res['kad2']);
		@$res['kad3'] = $db->select_query("select *,count(c_stu) as KAD3 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k3 like '%???????????????%' and c_class='".@$arr['num']['c_class']."'   group by c_class"); 
		@$arr['kad3'] =$db->fetch(@$res['kad3']);
		@$res['kad4'] = $db->select_query("select *,count(c_stu) as KAD4 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k4 like '%???????????????%' and c_class='".@$arr['num']['c_class']."'   group by c_class"); 
		@$arr['kad4'] =$db->fetch(@$res['kad4']);

		$KAD=@$arr['kad1']['KAD1']+@$arr['kad2']['KAD2']+@$arr['kad3']['KAD3']+@$arr['kad4']['KAD4'];


		@$res['la1'] = $db->select_query("select *,count(c_stu) as LA1 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k like '%??????%' and c_class='".@$arr['num']['c_class']."'   group by c_class "); 
		@$arr['la1'] =$db->fetch(@$res['la1']);
		@$res['la2'] = $db->select_query("select *,count(c_stu) as LA2 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k2 like '%??????%' and c_class='".@$arr['num']['c_class']."'   group by c_class "); 
		@$arr['la2'] =$db->fetch(@$res['la2']);
		@$res['la3'] = $db->select_query("select *,count(c_stu) as LA3 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k3 like '%??????%' and c_class='".@$arr['num']['c_class']."'   group by c_class "); 
		@$arr['la3'] =$db->fetch(@$res['la3']);
		@$res['la4'] = $db->select_query("select *,count(c_stu) as LA4 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k4 like '%??????%' and c_class='".@$arr['num']['c_class']."'   group by c_class "); 
		@$arr['la4'] =$db->fetch(@$res['la4']);

		$LA=@$arr['la1']['LA1']+@$arr['la2']['LA2']+@$arr['la3']['LA3']+@$arr['la4']['LA4'];


		@$res['sai1'] = $db->select_query("select *,count(c_stu) as SAI1 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k like '%?????????%' and c_class='".@$arr['num']['c_class']."'   group by c_class "); 
		@$arr['sai1'] =$db->fetch(@$res['sai1']);
		@$res['sai2'] = $db->select_query("select *,count(c_stu) as SAI2 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k2 like '%?????????%' and c_class='".@$arr['num']['c_class']."'   group by c_class "); 
		@$arr['sai2'] =$db->fetch(@$res['sai2']);
		@$res['sai3'] = $db->select_query("select *,count(c_stu) as SAI3 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k3 like '%?????????%' and c_class='".@$arr['num']['c_class']."'   group by c_class "); 
		@$arr['sai3'] =$db->fetch(@$res['sai3']);
		@$res['sai4'] = $db->select_query("select *,count(c_stu) as SAI4 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k4 like '%?????????%' and c_class='".@$arr['num']['c_class']."'   group by c_class "); 
		@$arr['sai4'] =$db->fetch(@$res['sai4']);

		$SAI=@$arr['sai1']['SAI1']+@$arr['sai2']['SAI2']+@$arr['sai3']['SAI3']+@$arr['sai4']['SAI4'];

		@$res['op1'] = $db->select_query("select *,count(c_stu) as OP1 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch1= '1' and c_class='".@$arr['num']['c_class']."' group by c_class "); 
		@$arr['op1'] =$db->fetch(@$res['op1']);
		@$res['op2'] = $db->select_query("select *,count(c_stu) as OP2 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch2= '2' and c_class='".@$arr['num']['c_class']."' group by c_class "); 
		@$arr['op2'] =$db->fetch(@$res['op2']);
		@$res['op3'] = $db->select_query("select *,count(c_stu) as OP3 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch3= '3' and c_class='".@$arr['num']['c_class']."' group by c_class "); 
		@$arr['op3'] =$db->fetch(@$res['op3']);
		@$res['op4'] = $db->select_query("select *,count(c_stu) as OP4 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch4= '4' and c_class='".@$arr['num']['c_class']."' group by c_class "); 
		@$arr['op4'] =$db->fetch(@$res['op4']);
		@$res['op5'] = $db->select_query("select *,count(c_stu) as OP5 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch5= '5' and c_class='".@$arr['num']['c_class']."' group by c_class "); 
		@$arr['op5'] =$db->fetch(@$res['op5']);
		@$res['op6'] = $db->select_query("select *,count(c_stu) as OP6 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch6= '6' and c_class='".@$arr['num']['c_class']."' group by c_class "); 
		@$arr['op6'] =$db->fetch(@$res['op6']);
		@$res['op7'] = $db->select_query("select *,count(c_stu) as OP7 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch7= '7' and c_class='".@$arr['num']['c_class']."' group by c_class "); 
		@$arr['op7'] =$db->fetch(@$res['op7']);
//		@$PerC=(100*(@$arr['num']['CO']))/(@$rows['count']);
		$OPSS=@$arr['op1']['OP1']+@$arr['op2']['OP2']+@$arr['op3']['OP3']+@$arr['op4']['OP4']+@$arr['op5']['OP5']+@$arr['op6']['OP6']+@$arr['op7']['OP7'];
		//if($i==1){ echo @$arr['la2']['c_stu'];}
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name'];?></td>
              <td layout="block" style="text-align: center;"><?php echo number_format(($KAD),0);?></td>
              <td layout="block" style="text-align: center;"><?php echo number_format(($LA),0);?></td>
               <td layout="block" style="text-align: center;"><?php echo number_format(($SAI),0);?></td>
              <td layout="block" style="text-align: center;"><?php echo number_format(($OPSS),0);?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=statistic&file=goschclass&op=cldetail&class_id=<?php echo @$arr['num']['c_class'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
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
									{ // ????????????????????????????????????????????????????????? pdf
									"extend": 'pdf', // ??????????????????????????? pdf ????????????
									"exportOptions" : {
										columns: ':visible'
									},
									"text": 'PDF', // ??????????????????????????????????????????
									"pageSize": 'A4',   // ?????????????????????????????????????????????????????? A4
									"filename" : '<?php echo _heading_title;?>',
									"title" : '<?php echo _heading_title;?>',
									"customize":function(doc){ // ?????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????? pdfmake
									// ??????????????? style ????????????
										doc.defaultStyle = {
										font:'THSarabun',
										fontSize:16                                 
										};
										// ??????????????????????????????????????????????????? header ??????????????????????????????????????????????????????
////										doc.content[1].table.widths = [ 50, 'auto', '*', '*' ];
////										doc.styles.tableHeader.fontSize = 16; // ??????????????????????????? font ????????? header
////										var rowCount = doc.content[1].table.body.length; // ????????????????????????????????????????????????????????????????????????
										// ?????????????????????????????????????????????????????????????????????????????????????????? ???????????????????????????????????????????????????
////										for (i = 1; i < rowCount; i++) { // i ???????????????????????? 1 ??????????????? i ?????????????????????????????????????????????????????????
////											doc.content[1].table.body[i][0].alignment = 'center'; // ?????????????????????????????????????????????????????? 0
////											doc.content[1].table.body[i][1].alignment = 'center';
////											doc.content[1].table.body[i][2].alignment = 'left';
////											doc.content[1].table.body[i][3].alignment = 'right';
////										};                                  
////										console.log(doc); // ?????????????????? debug ?????? doc object proptery ???????????????????????????????????????????????????????????????
									} // ??????????????????????????????????????????????????????????????? pdf
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


