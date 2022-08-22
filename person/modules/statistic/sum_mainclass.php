<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/mainclass.php");
$db = New DB();
$add='';
$edit='';
$del='';
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['Boy'] = $db->select_query("select *,count(stu_num) as Boys from ".TB_STUDENT."  where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_sex='1' "); 
@$arr['Boy'] =$db->fetch(@$res['Boy']);
@$res['Girl'] = $db->select_query("select *,count(stu_num) as Girls from ".TB_STUDENT."  where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_sex='2'  "); 
@$arr['Girl'] =$db->fetch(@$res['Girl']);
$Girl=@$arr['Girl']['Girls'];
$Boy=@$arr['Boy']['Boys'];
@$PerCB=(100*($Boy))/($Boy+$Girl);
@$PerCG=(100*($Girl))/($Boy+$Girl);

@$res['Ton'] = $db->select_query("select *,count(stu_id) as Tons from ".TB_STUDENT."  where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and (stu_class between 'm1' and 'm3' ) "); 
@$arr['Ton'] =$db->fetch(@$res['Ton']);
@$res['Plai'] = $db->select_query("select *,count(stu_id) as Plais from ".TB_STUDENT."  where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and (stu_class between 'm4' and 'm6' )  "); 
@$arr['Plai'] =$db->fetch(@$res['Plai']);
$Plai=@$arr['Plai']['Plais'];
$Ton=@$arr['Ton']['Tons'];
@$PerCT=(100*($Ton))/($Ton+$Plai);
@$PerCP=(100*($Plai))/($Ton+$Plai);

?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _text_box_table_stu_boy;?></span>
              <span class="info-box-number"><?php echo @$arr['Boy']['Boys'];?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo number_format(@$PerCB);?>% <?php echo _text_box_table_percent;?> <?php echo ($Boy+$Girl);?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
		 </div>
		<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _text_box_table_stu_girl;?></span>
              <span class="info-box-number"><?php echo @$arr['Girl']['Girls'];?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo number_format(@$PerCG);?>% <?php echo _text_box_table_percent;?> <?php echo ($Boy+$Girl);?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
		 </div>
		<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _text_box_table_stu_sumclass_ton;?></span>
              <span class="info-box-number"><?php echo @$arr['Ton']['Tons'];?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo number_format(@$PerCT);?>% <?php echo _text_box_table_percent;?> <?php echo ($Ton+$Plai);?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
		 </div>
		<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _text_box_table_stu_sumclass_plai;?></span>
              <span class="info-box-number"><?php echo @$arr['Plai']['Plais'];?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 40%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo number_format(@$PerCP);?>% <?php echo _text_box_table_percent;?> <?php echo ($Ton+$Plai);?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
		 </div>
