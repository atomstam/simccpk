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

            <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo _text_box_graph_person_bad;?></h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">8 Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
<?php
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['nums'] = $db->select_query("select stu_id,stu_pic,stu_pid,stu_num,stu_name,stu_sur,class_name,stu_class,sum(badtail_point) as CO  from ".TB_BAD." ,".TB_STUDENT.",".TB_BADTAIL.",".TB_CLASS." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."'  and stu_id=bad_stu and bad_tail=badtail_id and class_id=stu_class group by stu_id order by CO desc limit 8 "); 
		while(@$arr['nums'] = $db->fetch(@$res['nums'])){
?>
                    <li>
                      <img src="<?php if(@$arr['nums']['stu_pic']){echo WEB_URL_IMG_STU.@$arr['nums']['stu_pic'];} else {echo WEB_URL_IMG_STU."no_image.jpg";} ?>" alt="User Image">
                      <a class="users-list-name" href="index.php?name=statistic&file=score&op=bdetail&id=<?php echo @$arr['nums']['stu_id'];?>&route=statistic/score"><?php echo @$arr['nums']['stu_name']; ?></a>
                      <span class="users-list-date">-<?php echo @$arr['nums']['CO'];?></span>
                    </li>
<?php
		}
?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="index.php?name=statistic&file=score&route=statistic/score" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo _text_box_graph_person_good;?></h3>

                  <div class="box-tools pull-right">
                    <span class="label label-success">8 Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
<?php
		//$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		@$res['nums'] = $db->select_query("select stu_id,stu_pic,stu_pid,stu_num,stu_name,stu_sur,class_name,stu_class,sum(goodtail_point) as GO  from ".TB_GOOD." ,".TB_STUDENT.",".TB_GOODTAIL.",".TB_CLASS." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_id=good_stu and good_tail=goodtail_id and class_id=stu_class group by stu_id order by GO desc limit 8 "); 
		while(@$arr['nums'] = $db->fetch(@$res['nums'])){
?>
                    <li>
                      <img src="<?php if(@$arr['nums']['stu_pic']){echo WEB_URL_IMG_STU.@$arr['nums']['stu_pic'];} else {echo WEB_URL_IMG_STU."no_image.jpg";} ?>" alt="User Image">
                      <a class="users-list-name" href="index.php?name=statistic&file=score&op=gdetail&id=<?php echo @$arr['nums']['stu_id'];?>&route=statistic/score"><?php echo @$arr['nums']['stu_name']; ?></a>
                      <span class="users-list-date">+<?php echo @$arr['nums']['GO'];?></span>
                    </li>
<?php
		}
?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="index.php?name=statistic&file=score&route=statistic/score" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->


                </div>
                <!-- /.col -->
       </div>
  </div>

