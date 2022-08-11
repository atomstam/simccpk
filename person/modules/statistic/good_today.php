<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("../statistic/lang/goschday.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$ToDayDate=date('Y-m-d');
?>

	 <div class="col-xs-12 connectedSortable">
      <!-- Main row -->
      <div class="row">

                <div class="col-md-12 col-sm-12">
<?php
		@$res['num'] = $db->select_query("select *,sum(goodtail_point) as GO  from ".TB_GOOD." as a,".TB_STUDENT." as b,".TB_GOODTAIL." as c where b.stu_id=a.good_stu and a.good_tail=c.goodtail_id and a.g_date='".$ToDayDate."' group by b.stu_id order by GO desc"); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
?>
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
      <form action="index.php?name=statistic&file=goschday&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example11" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_stu_id; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_fullname; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_class;?></th>
              <th layout="block" style="text-align:center;"><?php echo _heading_title; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_good_score;?></th>
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
              <td style="text-align: right;"><?php echo @$arr['num']['goodtail_name']; ?></td>
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
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable11 = $("#example11").dataTable({
								"aoColumns": aoColumns11,
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
											className: 'btn bg-orange btn-flat'
										}
								}
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

