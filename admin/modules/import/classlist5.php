<?php 
ob_start();
if (session_id() =='') { @session_start(); }
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
if(time() > $_SESSION['timeout'] && $_SESSION['admin_group'] !=1){
session_unset();
setcookie("admin_login");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/affairs.php");
$db = New DB();
$route='';
?>
<?php
if(!empty($_SESSION['admin_login'])){
?>
<div class="row">
<div class="col-xs-12 connectedSortable">


    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-th"></i>
                 <h3 class="box-title"><?php echo _text_box_header_gen; ?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">

	  <?php
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_class='".$_GET['class_id']."' and stu_suspend='0' order by id,stu_id"); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
        <table id="example4" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_tab4_stu_id; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_stu_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_true; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_false; ?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['stu_id'];?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num'].@$arr['num']['stu_name']." ".@$arr['num']['stu_sur']; ?></td>
              <td layout="block" style="text-align: center;"><input type="radio" name="Ck1[<?php echo $i;?>]" class="minimal" value="1" ></td>
              <td layout="block" style="text-align: center;"><input type="radio" name="Ck1[<?php echo $i;?>]" class="minimal" value="2" ></td>
			  <input type="hidden" name="StuID[<?php echo $i;?>]"  value="<?php echo @$arr['num']['stu_id'];?>">
			  <input type="hidden" name="rank"  value="<?php echo $i;?>">
            </tr>

            <?php $i++;} ?>
          </tbody>
		  </table>
		  					<div class="form-group">
							<div class="col-sm-4" >
							<br>
							</div>
							</div>


            <?php } else { ?>
			<table>
            <tr>
              <td class="center" colspan="12"><?php echo _text_no_results; ?></td>
            </tr>
			</table>
            <?php } ?>

    </div>
    </div>
    </div>
    </div>
	


        <script type="text/javascript">
        $(document).ready(function() {
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
                              /* 9 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 10 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 11 */ { "bSortable": true , 'aTargets': [ 1 ]}
                                  ]
                oTable = $("#example4").dataTable({
								"aoColumns": aoColumns,
								 "paging":   false,
								"ordering": false,
								"info":     true,
								"searching" : false,
								"aaSorting": [[ 0, "desc" ]]
//								"aaSorting": [[ 0, "desc" ]],
//								 "aProcessing": true,
//								 "aServerSide": true,
//								"ajax": "server-response.php",
								});

            });
        </script>
        <script type="text/javascript">
			$(document).ready(function ($) {
				$('input').iCheck({
					checkboxClass: 'icheckbox_minimal-red',
					radioClass: 'iradio_minimal-red'
				});

				$('input.all').on('ifToggled', function (event) {
					var chkToggle;
					$(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
					$('input.selector:not(.all)').iCheck(chkToggle);
				});
			});
        </script>

<?php } else { echo "<meta http-equiv='refresh' content='1; url=index.php'>"; }?>



