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
?>
        <div class="col-xs-12 connectedSortable">
                            <!-- BAR CHART -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="ion ion-pie-graph"></i>&nbsp;<?php echo _index_title_graph;?></h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="bar-chart" style="height: 350px;"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
          <!-- /.info-box -->
		 </div>

		 <script>
            $(function() {
                "use strict";
                //BAR CHART
                var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
					data: [
					<?php
						$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." order by class_id "); 
						while($row = $db->fetch($res['class'])){ 
						$res['Boy'] = $db->select_query("select * from ".TB_STUDENT."  where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_sex='1' and stu_class = '".$row['class_id']."' "); 
						$rowB = $db->rows($res['Boy']);
						$res['Girl'] = $db->select_query("select * from ".TB_STUDENT."  where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_sex='2' and stu_class = '".$row['class_id']."'  "); 
						$rowG = $db->rows($res['Girl']);

						$Y=$row['class_short'];
						$a=(int)$rowB;
						$b=(int)$rowG;
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
                    barColors: ['#0a61a4', '#7b92a4'],
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['<?php echo _text_box_table_stu_boy;?>', '<?php echo _text_box_table_stu_girl;?>'],
                    hideHover: 'auto'
                });
//				alert('<?php echo $Y;?>');
            });
        </script>
		