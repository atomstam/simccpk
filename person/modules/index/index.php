<?php 
//require_once ("mainfile.php"); 
if(time() > $_SESSION['timeout'] || empty($_SESSION['person_login']) || empty($_SESSION['person_area']) || empty($_SESSION['person_school']) ){
session_unset();
setcookie("admin_login");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}

if($route !="index/index"){
require_once ("modules/index/header.php"); 
?>
<div class="col-xs-12">
      <!-- Info boxes -->
      <div class="row">
<?php
require_once ("".$MODPATHFILE.""); 
?>
	</div>
</div>
<?php
require_once ("modules/index/footer.php"); 
} else {
require_once ("modules/index/header.php"); 
	require_once("lang/index.php");
	$route ="index/index";
	
	$TotalstuLink='index.php?name=statistic&file=mainclass&route=statistic/mainclass';
	$TotalbadLink='index.php?name=behavior&file=bad&route=import/bad';
	$TotalgoodLink='index.php?name=behavior&file=good&route=import/good';
	$TotalonlineLink='index.php?name=statistic&file=statlogin&route=statistic/statlogin';
?>
<div class="col-xs-12">
      <!-- Info boxes -->
      <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
			<!-- small box -->
				<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _index_total_stu;?></span>
              <span class="info-box-number"><?php echo getTotalPerson('config' ,'student','');?></span>
			<a href="<?php echo $TotalstuLink;?>" class="small-box-footer"><?php echo _Total_stu_link;?> <i class="fa fa-arrow-circle-right"></i></a>
			</div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
		  <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _text_box_graph_analy_good;?></span>
              <span class="info-box-number"><?php echo number_format(getTotalPerson('score','good',''));?></span>
               <a href="<?php echo $TotalgoodLink;?>" class="small-box-footer"><?php echo _Total_stu_good_link;?> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _text_box_graph_analy_bad;?></span>
              <span class="info-box-number"><?php echo number_format(getTotalPerson('score','bad',''));?></span>
                                <a href="<?php echo $TotalbadLink;?>" class="small-box-footer">
                                    <?php echo _Total_stu_bad_link;?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _index_total_login;?></span>
              <span class="info-box-number"><?php echo getTotalPerson('onlineuser','',$admin_login);?></span>
                                <a href="<?php echo $TotalonlineLink;?>" class="small-box-footer">
                                    <?php echo _Total_login_link;?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>



<div class="col-xs-12">

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo _text_box_header_graph;?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12">
                  <p class="text-center">
                    <strong>1 พ.ค. 2565 - 31 มี.ค. 2566</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 250px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
	


						<div class=" col-md-3 col-sm-12 col-xs-12">
								<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 250px;"></div>			
						</div>

		</div> <!-- /.row-->

              <div class="row">
                <div class="col-md-6">
                  <p class="text-center">
                    <strong><?php echo _text_box_graph_analy_bad;?></strong>
                  </p>
				<?php
					$bar=array("aqua","red","green","yellow");
					@$result1 = $db->select_query("SELECT count(bad_id) as CI FROM ".TB_BAD." ,".TB_STUDENT." where stu_suspend='0' and stu_id=bad_stu and stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' group by bad_id");
					@$result = $db->select_query("SELECT *,count(bad_id) as BOO FROM ".TB_BAD.",".TB_STUDENT." where stu_suspend='0' and stu_id=bad_stu and stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' group by bad_tail order by BOO desc limit 4"); 
					$i=0;
					@$rows=$db->rows(@$result1);
					while(@$arr = $db->fetch(@$result)){
						@$result2 = $db->select_query("SELECT * FROM ".TB_BADTAIL." where badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."' and badtail_id='".@$arr['bad_tail']."' ");
						@$arr2 = $db->fetch(@$result2);
						$data=@$arr['BOO'];
						@$PerC=(100*$data)/@$rows;
						@$PerCC=number_format((@$PerC),2);
					?>
                  <div class="progress-group">
                    <span class="progress-text"><a href="index.php?name=behavior&file=bad&op=cldetail&bad_id=<?php echo @$arr2['badtail_id'];?>&route=behavior/bad"><?php echo @$arr2['badtail_name'];?></a></span>
                    <span class="progress-number"><b><?php echo $data;?></b>/<?php echo @$rows;?> (<?php echo @$PerCC;?>%)</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-<?php echo $bar[$i];?>" style="width: <?php echo @$PerC;?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
				<?php
					$i++;
					}
				?>
                  <p class="text-right">
                    <strong><a href="index.php?name=behavior&file=bad&route=behavior/bad" class="btn btn-info"><?php echo _text_box_graph_analy_detail;?></a></strong>
                  </p>
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                  <p class="text-center">
                    <strong><?php echo _text_box_graph_analy_good;?></strong>
                  </p>
				<?php
					$bar=array("aqua","red","green","yellow");
					@$result2 = $db->select_query("SELECT count(good_id) as GI FROM ".TB_GOOD." ,".TB_STUDENT." where stu_suspend='0' and stu_id=good_stu  and stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' group by good_id");
					@$result0 = $db->select_query("SELECT *,count(good_id) as GOO FROM ".TB_GOOD." ,".TB_STUDENT." where stu_suspend='0' and stu_id=good_stu and stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' group by good_tail order by GOO desc limit 4"); 
					$i=0;
					@$rows0=$db->rows(@$result2);
					while(@$arr0 = $db->fetch(@$result0)){
						@$result22 = $db->select_query("SELECT * FROM ".TB_GOODTAIL." where goodtail_area='".$_SESSION['person_area']."' and goodtail_code='".$_SESSION['person_school']."' and goodtail_id='".@$arr0['good_tail']."' ");
						@$arr22 = $db->fetch(@$result22);
						@$data0=@$arr0['GOO'];
						@$PerC0=(100*$data0)/@$rows0;
						@$PerCC0=number_format((@$PerC0),2);
					?>
                  <div class="progress-group">
                    <span class="progress-text"><a href="index.php?name=behavior&file=good&op=cldetail&good_id=<?php echo @$arr22['goodtail_id'];?>&route=behavior/good"><?php echo @$arr22['goodtail_name'];?></a></span>
                    <span class="progress-number"><b><?php echo $data0;?></b>/<?php echo @$rows0;?> (<?php echo @$PerCC0;?>%)</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-<?php echo $bar[$i];?>" style="width: <?php echo @$PerC0;?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
				<?php
					$i++;
					}
				?>
                  <p class="text-right">
                    <strong><a href="index.php?name=behavior&file=good&route=behavior/good" class="btn btn-info"><?php echo _text_box_graph_analy_detail;?></a></strong>
                  </p>
                </div>
                <!-- /.col -->




              </div>
              <!-- /.row -->



            </div>
            <!-- ./box-body -->
            <div class="box-footer">

              <div class="row">
                <div class="col-sm-12 col-xs-12 bg-success color-palette" style="text-align:center;font-size:15pt;">อัตราต่อเดือนของพฤติกรรมทางบวก</div>
			  </div>
              <div class="row">
				<?php echo index_good();?>
              </div>
              <!-- /.row -->

             <div class="row">
                <div class="col-sm-12 col-xs-12 bg-danger color-palette" style="text-align:center;font-size:15pt;">อัตราต่อเดือนของพฤติกรรมทางลบ</div>
			  </div>
              <div class="row">
				<?php echo index_bad();?>
              </div>
              <!-- /.row -->


			  </div>
			<!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</div>

</div>
</div>


<script>
$(document).ready(function(){
	$("#Bad_today").load("modules/index/bad_today.php");
	$("#Good_today").load("modules/index/good_today.php");
	//$("#StatPerson").load("modules/index/statperson.php");
});
</script>


      <div class="row">
	  <!--<div id="StatPerson" ><center><img src="../img/ajax-loader1.gif" border="0"></center></div>-->
	  <div id="Bad_today" ><center><img src="../img/ajax-loader1.gif" border="0"></center></div>
	  <div id="Good_today" ><center><img src="../img/ajax-loader1.gif" border="0"></center></div>
	  </div>



		<!-- ChartJS 1.0.1 -->
		<script src="../person/modules/index/js/chart1.js"></script>

<script>
        $(document).ready(function() {

  //Donut Chart
		$.ajax({
		url: "modules/statistic/chart_scoreD.php",
		method: "GET",
		dataType: 'json',
        async: false,
        contentType: "application/json; charset=utf-8",
		success: function(data) {
			console.log(data);
			var Datas= JSON.stringify(data);

  var donut = new Morris.Donut({
    element: 'sales-chart',
    resize: true,
    colors: [ "#f56954","#00a65a","#3c8dbc"],
//    data: [
//      {label: "Download Sales", value: 12},
//      {label: "In-Store Sales", value: 30},
//      {label: "Mail-Order Sales", value: 20}
//    ],

	data: $.parseJSON(Datas),
    hideHover: 'auto'
  });

  		},
		error: function(data) {
			console.log(data);
		}
	});

  });

//});
</script>
<?php
require_once ("modules/index/footer.php"); 
}
?>




