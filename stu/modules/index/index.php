<?php 
//require_once ("mainfile.php"); 
if(time() > $_SESSION['timeout'] || empty($_SESSION['stu_login']) || empty($_SESSION['stu_area']) || empty($_SESSION['stu_school']) ){
session_unset();
setcookie("stu_login");
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

        <div class="col-md-6 col-sm-6 col-xs-12">
		  <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _text_box_graph_analy_good;?></span>
              <span class="info-box-number"><?php echo number_format(getTotalStu('score','good',''));?></span>
               <a href="<?php echo $TotalgoodLink;?>" class="small-box-footer"><?php echo _Total_stu_good_link;?> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _text_box_graph_analy_bad;?></span>
              <span class="info-box-number"><?php echo number_format(getTotalStu('score','bad',''));?></span>
                                <a href="<?php echo $TotalbadLink;?>" class="small-box-footer">
                                    <?php echo _Total_stu_bad_link;?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		</div>
		<!-- /.row -->
</div>


<div class="col-xs-12">
		<div class="row">
			<div class="col-md-12">

			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
</div>

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




