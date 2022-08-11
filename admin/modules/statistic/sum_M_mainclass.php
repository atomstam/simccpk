<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/goschclass.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

		@$res['kad1'] = $db->select_query("select *,count(c_stu) as KAD1 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k like '%ไม่มา%' "); 
		@$arr['kad1'] =$db->fetch(@$res['kad1']);
		@$res['kad2'] = $db->select_query("select *,count(c_stu) as KAD2 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k2 like '%ไม่มา%'  "); 
		@$arr['kad2'] =$db->fetch(@$res['kad2']);
		@$res['kad3'] = $db->select_query("select *,count(c_stu) as KAD3 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k3 like '%ไม่มา%'  "); 
		@$arr['kad3'] =$db->fetch(@$res['kad3']);
		@$res['kad4'] = $db->select_query("select *,count(c_stu) as KAD4 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k4 like '%ไม่มา%' "); 
		@$arr['kad4'] =$db->fetch(@$res['kad4']);

		$KAD=@$arr['kad1']['KAD1']+@$arr['kad2']['KAD2']+@$arr['kad3']['KAD3']+@$arr['kad4']['KAD4'];


		@$res['la1'] = $db->select_query("select *,count(c_stu) as LA1 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k like '%ลา%'   "); 
		@$arr['la1'] =$db->fetch(@$res['la1']);
		@$res['la2'] = $db->select_query("select *,count(c_stu) as LA2 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k2 like '%ลา%'   "); 
		@$arr['la2'] =$db->fetch(@$res['la2']);
		@$res['la3'] = $db->select_query("select *,count(c_stu) as LA3 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k3 like '%ลา%'    "); 
		@$arr['la3'] =$db->fetch(@$res['la3']);
		@$res['la4'] = $db->select_query("select *,count(c_stu) as LA4 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k4 like '%ลา%'    "); 
		@$arr['la4'] =$db->fetch(@$res['la4']);

		$LA=@$arr['la1']['LA1']+@$arr['la2']['LA2']+@$arr['la3']['LA3']+@$arr['la4']['LA4'];


		@$res['sai1'] = $db->select_query("select *,count(c_stu) as SAI1 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k like '%สาย%'   "); 
		@$arr['sai1'] =$db->fetch(@$res['sai1']);
		@$res['sai2'] = $db->select_query("select *,count(c_stu) as SAI2 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k2 like '%สาย%'  "); 
		@$arr['sai2'] =$db->fetch(@$res['sai2']);
		@$res['sai3'] = $db->select_query("select *,count(c_stu) as SAI3 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k3 like '%สาย%'   "); 
		@$arr['sai3'] =$db->fetch(@$res['sai3']);
		@$res['sai4'] = $db->select_query("select *,count(c_stu) as SAI4 from ".TB_CHCLASS."   where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_k4 like '%สาย%'  "); 
		@$arr['sai4'] =$db->fetch(@$res['sai4']);

		$SAI=@$arr['sai1']['SAI1']+@$arr['sai2']['SAI2']+@$arr['sai3']['SAI3']+@$arr['sai4']['SAI4'];

		@$res['op1'] = $db->select_query("select *,count(c_stu) as OP1 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch1= '1'  group by 1 "); 
		@$arr['op1'] =$db->fetch(@$res['op1']);
		@$res['op2'] = $db->select_query("select *,count(c_stu) as OP2 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch2= '2'  group by 2 "); 
		@$arr['op2'] =$db->fetch(@$res['op2']);
		@$res['op3'] = $db->select_query("select *,count(c_stu) as OP3 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch3= '3'  group by 3 "); 
		@$arr['op3'] =$db->fetch(@$res['op3']);
		@$res['op4'] = $db->select_query("select *,count(c_stu) as OP4 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch4= '4'  group by 4 "); 
		@$arr['op4'] =$db->fetch(@$res['op4']);
		@$res['op5'] = $db->select_query("select *,count(c_stu) as OP5 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch5= '5'  group by 5 "); 
		@$arr['op5'] =$db->fetch(@$res['op5']);
		@$res['op6'] = $db->select_query("select *,count(c_stu) as OP6 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch6= '6'  group by 6 "); 
		@$arr['op6'] =$db->fetch(@$res['op6']);
		@$res['op7'] = $db->select_query("select *,count(c_stu) as OP7 from ".TB_CHCLASS."  where c_area='".$_SESSION['admin_area']."' and c_code='".$_SESSION['admin_school']."' and c_ch7= '7'  group by 7 "); 
		@$arr['op7'] =$db->fetch(@$res['op7']);
//		@$PerC=(100*(@$arr['num']['CO']))/(@$rows['count']);
		$OPSS=@$arr['op1']['OP1']+@$arr['op2']['OP2']+@$arr['op3']['OP3']+@$arr['op4']['OP4']+@$arr['op5']['OP5']+@$arr['op6']['OP6']+@$arr['op7']['OP7'];

		$TT=$KAD+$LA+$SAI+$OPSS;
		$P_KAD=($KAD*100)/$TT;
		$P_LA=($LA*100)/$TT;
		$P_SAI=($SAI*100)/$TT;
		$P_OPSS=($OPSS*100)/$TT;
?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _text_box_panel1;?></span>
              <span class="info-box-number"><?php echo number_format($KAD);?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo $P_KAD;?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo number_format($P_KAD,2);?>% [<?php echo number_format($TT);?>]
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
              <span class="info-box-text"><?php echo _text_box_panel2;?></span>
              <span class="info-box-number"><?php echo number_format($LA);?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo $P_LA;?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo number_format($P_LA,2);?>% [<?php echo number_format($TT);?>]
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
              <span class="info-box-text"><?php echo _text_box_panel3;?></span>
              <span class="info-box-number"><?php echo number_format($SAI);?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo $P_SAI;?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo number_format($P_SAI,2);?>% [<?php echo number_format($TT);?>]
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
              <span class="info-box-text"><?php echo _text_box_panel4;?></span>
              <span class="info-box-number"><?php echo number_format($OPSS);?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo $P_OPSS;?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo number_format($P_OPSS,2);?>% [<?php echo number_format($TT);?>]
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
		 </div>
