<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../includes/config.php");
require_once("../includes/class.mysql.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$DateIn=date('Y-m-d');
$tdata=$_GET['tuser'];
if($tdata){
?>

<!DOCTYPE html>
<html>
<head>
		<!-- bootstrap 3.0.2 -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
		<link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		<link href="../dist/css/base.css" rel="stylesheet" media="screen"/>
<style>
body{background-color:transparent;}
table {border-spacing: 8px 2px;}
td    {padding: 6px;}
</style>
</head>
<body>

<div class="col-md-12">
	  <div class="row">
        <div class="col-md-12">

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">สรุปพฤติกรรมเชิงบวก</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
			</div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="col-md-4">
                  <p class="text-center">
                    <strong>จำนวนพฤติกรรม</strong>
                  </p>
				<?php
					$barx=array("aqua","red","green","yellow");
					$result1x = $db->select_query("SELECT count(good_id) as GCI FROM ".TB_GOOD." group by good_id");
					$resultx = $db->select_query("SELECT *,count(good_id) as GCOO FROM ".TB_GOOD." group by good_tail order by GCOO desc limit 4"); 
					$ix=0;
					$rowsx=@$db->rows($result1x);
					while($arrx = $db->fetch($resultx)){
						$result2x = $db->select_query("SELECT * FROM ".TB_GOODTAIL." where goodtail_id='".$arrx['good_tail']."' ");
						$arr2x = $db->fetch($result2x);
						$datax=$arrx['GCOO'];
						$PerCx=(100*$datax)/$rowsx;
						$PerCCx=number_format(($PerCx),2);
					?>
                  <div class="progress-group">
                    <span class="progress-text"><?php echo $arr2x['goodtail_name'];?></span>
                    <span class="progress-number"><b><?php echo $datax;?></b>/<?php echo $rowsx;?> (<?php echo $PerCCx;?>%)</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-<?php echo $barx[$ix];?>" style="width: <?php echo $PerCx;?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
				<?php
					$ix++;
					}
				?>

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->

		</div>
	</div>


	  <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">สรุปพฤติกรรมเชิงลบ</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
			</div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="col-md-4">
                  <p class="text-center">
                    <strong>จำนวนพฤติกรรม</strong>
                  </p>
				<?php
					$bar=array("aqua","red","green","yellow");
					$result1 = $db->select_query("SELECT count(bad_id) as CI FROM ".TB_BAD." group by bad_id");
					$result = $db->select_query("SELECT *,count(bad_id) as COO FROM ".TB_BAD." group by bad_tail order by COO desc limit 4"); 
					$i=0;
					$rows=@$db->rows($result1);
					while($arr = $db->fetch($result)){
						$result2 = $db->select_query("SELECT * FROM ".TB_BADTAIL." where badtail_id='".$arr['bad_tail']."' ");
						$arr2 = $db->fetch($result2);
						$data=$arr['COO'];
						$PerC=(100*$data)/$rows;
						$PerCC=number_format(($PerC),2);
					?>
                  <div class="progress-group">
                    <span class="progress-text"><?php echo $arr2['badtail_name'];?></span>
                    <span class="progress-number"><b><?php echo $data;?></b>/<?php echo $rows;?> (<?php echo $PerCC;?>%)</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-<?php echo $bar[$i];?>" style="width: <?php echo $PerC;?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
				<?php
					$i++;
					}
				?>

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->

		</div>
	</div>


</div>


</body>
</html>
<?php
} else {
echo "";
}

?>