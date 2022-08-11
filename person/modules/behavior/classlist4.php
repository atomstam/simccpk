<?php 
ob_start();
if (session_id() =='') { @session_start(); }
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
if(time() > $_SESSION['timeout'] ){
session_unset();
setcookie("admin_login");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/classlist.php");
$db = New DB();
$route='';
?>
<?php
if(!empty($_SESSION['person_login'])){
?>
<div class="row">
<div class="col-xs-12 connectedSortable">


    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-th"></i>
                 <h3 class="box-title"><?php echo _heading_title_tab4; ?></h3>
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
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_class='".$_GET['class_id']."' and stu_suspend='0' order by id,stu_id"); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
        <table id="example4" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_tab4_stu_id; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_stu_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_kad; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_la; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec1; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec2; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec3; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec4; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec5; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec6; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tab4_sec7; ?></th>
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
              <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch1[<?php echo $i;?>]" class="minimal" value="1"  id="checkbox"></td>
              <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch2[<?php echo $i;?>]" class="minimal" value="2"  id="checkbox"></td>
              <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch3[<?php echo $i;?>]" class="minimal" value="3"  id="checkbox"></td>
              <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch4[<?php echo $i;?>]" class="minimal" value="4"  id="checkbox"></td>
              <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch5[<?php echo $i;?>]" class="minimal" value="5"  id="checkbox"></td>
              <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch6[<?php echo $i;?>]" class="minimal" value="6"  id="checkbox"></td>
              <td layout="block" style="text-align: center;"><input type="checkbox" name="Ch7[<?php echo $i;?>]" class="minimal" value="7"  id="checkbox"></td>
			  <input type="hidden" name="StuID[<?php echo $i;?>]"  value="<?php echo @$arr['num']['stu_id'];?>">
			  <input type="hidden" name="rank"  value="<?php echo $i;?>">
            </tr>

            <?php $i++;} ?>
          </tbody>
		  </table>
		  					<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Add"><input type="hidden" name="DateID"  value="<?php echo $_GET['date_id'];?>"><input type="hidden" name="ClassID"  value="<?php echo $_GET['class_id'];?>">
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
                              /* 3 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 5 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 6 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 7 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 8 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 9 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 10 */ { "bSortable": true , 'aTargets': [ 0 ]},
                              /* 11 */ { "bSortable": true , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example4").dataTable({
								"aoColumns": aoColumns,
								"pageLength" : 50,
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



