<?php 
//require_once ("mainfile.php"); 
require_once ("header.php"); 
if(time() > $_SESSION['timeout']){
session_unset();
setcookie("user_login");
echo "<meta http-equiv='refresh' content='1; url=main.php'>";
}
?>

<?php
if(!empty($_SESSION['user_login'])){
if($route !="index/main"){
require_once ("".$MODPATHFILE.""); 
} else {
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$TotalstuLink='index.php?name=e-magazine&file=index&route='.$route;
	$TotaliepLink='index.php?name=media&file=index&route='.$route;
	$TotaliipLink='index.php?name=article&file=index&route='.$route;
	$TotalonlineLink='index.php?name=online&file=index&route='.$route;
?>
                         <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
									<?php echo getTotal('e-magazine' ,'index',$user_school);?>
                                    </h3>
                                    <p>
                                        <?php echo _index_total_user;?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo $TotalstuLink;?>" class="small-box-footer">
                                    <?php echo _Total_stu_link;?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
									<?php echo getTotal('media','media',$user_school);?>
                                    </h3>
                                    <p>
                                        <?php echo _index_total_iep;?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="<?php echo $TotaliepLink;?>" class="small-box-footer">
                                    <?php echo _Total_iep_link;?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
									<?php echo getTotal('article','index',$user_school);?>
                                    </h3>
                                    <p>
                                        <?php echo _index_total_iip;?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="<?php echo $TotaliipLink;?>" class="small-box-footer">
                                    <?php echo _Total_iip_link;?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
									<?php echo getTotal('onlineuser','',$user_login);?>
                                    </h3>
                                    <p>
                                        <?php echo _index_total_login;?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo $TotalonlineLink;?>" class="small-box-footer">
                                    <?php echo _Total_login_link;?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                    </div><!-- /.row -->


                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            <!-- BAR CHART -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="ion ion-pie-graph"></i>&nbsp;<?php echo _index_title_graph;?></h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="bar-chart" style="height: 300px;"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            <!-- BAR CHART -->
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="ion ion-pie-graph"></i>&nbsp;<?php echo _index_title_table;?></h3>
                                </div>
                                <div class="box-body chart-responsive">
								<table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
								<thead>
								<tr >
								<th layout="block" style="text-align:center" >ID</th>
								<th layout="block" style="text-align:center"><?php echo _index_title_table_header_list; ?></th>
								<th layout="block" style="text-align:center">IEP</th>
								<th layout="block" style="text-align:center">IIP</th>
								<th layout="block" style="text-align:center">Action</th>
								</tr>
								</thead>
								<tbody>

								<?php
								$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
								$res['dib'] = $db->select_query("SELECT * FROM ".TB_DISABLE." order by dib_id ");
								while($row = $db->fetch($res['dib'])){ 
								$res['iepe'] = $db->select_query("SELECT *,count(iep_id) Iep FROM ".TB_IEP." where iep_dib = '".$row['dib_id']."' and iep_school='".$user_school."' group by iep_school "); 
								$rowiep = $db->fetch($res['iepe']);
								$res['iipe'] = $db->select_query("SELECT *,count(iip_id) Iip FROM ".TB_IIP." where iip_dib = '".$row['dib_id']."' and iip_school='".$user_school."' group by iip_school "); 
								$rowiip = $db->fetch($res['iipe']);
								$Y=(int)$row['dib_id'];
								$a=(int)$rowiep['Iep'];
								$b=(int)$rowiip['Iip'];
								?>
								<tr>
								<td style="text-align: center;"><?php echo $row['dib_id']; ?></td>
								<td style="text-align: left;"><?php echo $row['dib_name']; ?></td>
								<td style="text-align: center;"><?php if($a){echo "<span class=\"label label-info\">".$a."</span>"; } else {echo "<span class=\"label label-danger\">"._index_total_iep_null."</span>";}?></td>
								<td style="text-align: center;"><?php if($b){echo "<span class=\"label label-success\">".$b."</span>"; } else {echo "<span class=\"label label-danger\">"._index_total_iip_null."</span>";}?></td>
								<td style="text-align: center;"><a href="index.php?name=iep&file=index&route=<?php echo $route; ?>" class="label label-success"><i class="fa fa-search-plus "></i></td>
								</tr>
								<?php
								}
								?>
								</tbody>
								</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->
<?php
}
?>
<script>
            $(function() {
                "use strict";
                //BAR CHART
                var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
					data: [
					<?php
						$res['dib'] = $db->select_query("SELECT * FROM ".TB_DISABLE." order by dib_id "); 
						while($row = $db->fetch($res['dib'])){ 
						$res['iepe'] = $db->select_query("SELECT *,count(iep_school) Iep FROM ".TB_IEP." where iep_dib = '".$row['dib_id']."' and iep_school='".$user_school."' group by iep_school "); 
						$rowiep = $db->fetch($res['iepe']);
						$res['iipe'] = $db->select_query("SELECT *,count(iip_school) Iip FROM ".TB_IIP." where iip_dib = '".$row['dib_id']."' and iip_school='".$user_school."' group by iip_school"); 
						$rowiip = $db->fetch($res['iipe']);
						$Y=(int)$row['dib_id'];
						$a=(int)$rowiep['Iep'];
						$b=(int)$rowiip['Iip'];
					?>
						{y: '<?php echo $Y;?>', a: '<?php echo $a;?>', b: '<?php echo $b;?>'},
	//					alert('<?php echo "y=".$Y.",a=".$a.",b=".$b."";?>'),
					<?php } ?>
					],
						
 //                   data: [
//                        {y: '2006', a: 100, b: 90},
//                        {y: '2007', a: 75, b: 65},
//                        {y: '2008', a: 50, b: 40},
//                        {y: '2009', a: 75, b: 65},
//                        {y: '2010', a: 50, b: 40},
//                        {y: '2011', a: 75, b: 65},
//                        {y: '2012', a: 100, b: 90}
//                    ],
                    barColors: ['#00a65a', '#f56954'],
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['IEP', 'IIP'],
                    hideHover: 'auto'
                });
//				alert('<?php echo $Y;?>');
            });
        </script>
 <?php require_once ("footer.php"); ?>
<?php } else { echo "<meta http-equiv='refresh' content='1; url=main.php'>"; }?>
<!-- div header -->
</div>
</div>


