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

@$res['num'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." where ct_user='".$_GET['id']."' order by ct_no desc "); 
@$rows['num'] = $db->rows(@$res['num']);
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >

		<div align="right" >
		<div class="form-group"><a href="index.php?name=access&file=userlogin&route=<?php echo $route;?>" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>

					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="fa fa-user"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?> : <?php echo $_GET['id']; ?></h3>
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
      <form action="index.php?name=access&file=userlogin&op=shdelall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
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
		if($_GET['sh']){
		@$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_code='".@$arr['num']['ct_school']."' "); 
		@$arr['sh']=$db->fetch(@$res['sh']);
		}
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
								"dom" : 'lBfrtip',
//								"aaSorting": [[ 0, "desc" ]],
//								"dom": 'T<"clear">lfrtip',
								buttons: {
								"buttons" : [
										{
										extend: 'copy',
										text: '<i class="fa fa-copy"></i> Copy',
										title: $('h3').text(),
										exportOptions: {
											columns: ':not(.no-print)'
										},
										footer: true,
//										autoPrint: false		
										},
										{
										extend: 'excel',
										text: '<i class="fa fa-file-excel-o"></i> Excel',
										title: $('h3').text(),
										exportOptions: {
											columns: ':not(.no-print)'
										},
										footer: true,
//										autoPrint: false		
										},
//										{
//										extend: 'pdf',
//										text: '<i class="fa fa-file-pdf-o"></i> PDF',
//										title: $('h3').text(),
//										exportOptions: {
//											columns: ':not(.no-print)'
//										},
//										footer: true,
//										autoPrint: false
//										},
										{
										extend: 'print',
										text: '<i class="fa fa-print"></i> Print',
										title: $('h3').text(),
										exportOptions: {
											columns: ':not(.no-print)'
										},
										footer: true,
										autoPrint: false
										},
	
								],
								dom: {
								//      container: {
								//        className: 'dt-buttons'
								//      },
										button: {
											className: 'btn btn-warning'
										}
								}
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
								});

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
<?php
} else {
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >
    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=access&file=userlogin&route=<?php echo $route;?>" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a></div>
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
		
		@$res['num'] = $db->select_query("SELECT *,count(ct_no) as NO FROM ".TB_ACTIVEUSER." group by ct_user order by ct_no desc"); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=access&file=userlogin&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_userlogin_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_userlogin_username; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_school_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_userlogin_count; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_userlogin_datenew;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		if(@$arr['num']['ct_school']){
		@$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." WHERE username='".@$arr['num']['ct_user']."' "); 
		@$arr['user']=$db->fetch(@$res['user']);
		@$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_code='".@$arr['num']['ct_school']."' "); 
		@$arr['sh']=$db->fetch(@$res['sh']);
		} else {
		@$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".@$arr['num']['ct_user']."' "); 
		@$arr['user']=$db->fetch(@$res['user']);
		}
		@$res['count'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." where ct_user='".@$arr['num']['ct_user']."' "); 
		@$rows['count'] = $db->rows(@$res['count']);
		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." where ct_user='".@$arr['num']['ct_user']."'  order by ct_no desc limit 1"); 
		@$arr['nums'] = $db->fetch(@$res['nums']);
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i; ?></td>
			  <td layout="block" style="text-align: left;"><?php echo @$arr['user']['firstname'];?> <?php echo @$arr['user']['lastname'];?></td>
			  <td layout="block" style="text-align: left;"><?php echo @$arr['num']['ct_user'];?></td>
			  <td layout="block" style="text-align: left;"><?php if(@$arr['sh']['sh_id']){echo @$arr['sh']['sh_name'];} else {echo "Admin";}?></td>
			  <td layout="block" style="text-align: left;"><?php echo @$rows['count'];?></td>
		       <td layout="block" style="text-align: center;"><?php echo ThaiTimeConvert(@$arr['nums']['ct_time'],"","2");?></td>
			  <td style="text-align: center;">
<?php
/*
				
			 <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success" id="<?php echo @$arr['num']['id']; ?>"><i class="fa fa-search-plus "></i></a>
			 			 <a href="index.php?name=access&file=userlogin&op=edit&sh_id=<?php echo @$arr['num']['sh_id'];?>&route=<?php echo $route;?>" class="btn btn-info " ><i class="fa fa-edit "></i></a>
*/
?>
			 <a href="index.php?name=access&file=userlogin&op=shdetail&id=<?php echo @$arr['num']['ct_user'];?>&sh=<?php echo @$arr['num']['ct_school'];?>&route=<?php echo $route;?>" class="btn btn-success" ><i class="fa fa-search-plus "></i></a>
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


        <script type="text/javascript">
        $(document).ready(function() {
        var aoColumns = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
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
//								"aaSorting": [[ 0, "desc" ]],
//								"dom": 'T<"clear">lfrtip',
								buttons: {
								"buttons" : [
										{
										extend: 'copy',
										text: '<i class="fa fa-copy"></i> Copy',
										title: $('h3').text(),
										exportOptions: {
											columns: ':not(.no-print)'
										},
										footer: true,
//										autoPrint: false		
										},
										{
										extend: 'excel',
										text: '<i class="fa fa-file-excel-o"></i> Excel',
										title: $('h3').text(),
										exportOptions: {
											columns: ':not(.no-print)'
										},
										footer: true,
//										autoPrint: false		
										},
//										{
//										extend: 'pdf',
//										text: '<i class="fa fa-file-pdf-o"></i> PDF',
//										title: $('h3').text(),
//										exportOptions: {
//											columns: ':not(.no-print)'
//										},
//										footer: true,
//										autoPrint: false
//										},
										{
										extend: 'print',
										text: '<i class="fa fa-print"></i> Print',
										title: $('h3').text(),
										exportOptions: {
											columns: ':not(.no-print)'
										},
										footer: true,
										autoPrint: false
										},
	
								],
								dom: {
								//      container: {
								//        className: 'dt-buttons'
								//      },
										button: {
											className: 'btn btn-warning'
										}
								}
								},
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
