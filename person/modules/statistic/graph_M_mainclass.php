<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/goschclass.php");
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
                                    <div class="chart" id="bar-chart" style="height: 300px;"></div>
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
						@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." order by class_id "); 
						while(@$row = $db->fetch(@$res['class'])){ 

						@$res['kad1'] = $db->select_query("select *,count(c_stu) as KAD1 from ".TB_CHCLASS."   where c_k like '%ไม่มา%'  and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class"); 
						@$arr['kad1'] =$db->fetch(@$res['kad1']);
						@$res['kad2'] = $db->select_query("select *,count(c_stu) as KAD2 from ".TB_CHCLASS."   where c_k2 like '%ไม่มา%'  and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['kad2'] =$db->fetch(@$res['kad2']);
						@$res['kad3'] = $db->select_query("select *,count(c_stu) as KAD3 from ".TB_CHCLASS."   where c_k3 like '%ไม่มา%'  and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['kad3'] =$db->fetch(@$res['kad3']);
						@$res['kad4'] = $db->select_query("select *,count(c_stu) as KAD4 from ".TB_CHCLASS."   where c_k4 like '%ไม่มา%'  and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['kad4'] =$db->fetch(@$res['kad4']);

						@$KAD=@$arr['kad1']['KAD1']+@$arr['kad2']['KAD2']+@$arr['kad3']['KAD3']+@$arr['kad4']['KAD4'];


						@$res['la1'] = $db->select_query("select *,count(c_stu) as LA1 from ".TB_CHCLASS."   where c_k like '%ลา%'   and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['la1'] =$db->fetch(@$res['la1']);
						@$res['la2'] = $db->select_query("select *,count(c_stu) as LA2 from ".TB_CHCLASS."   where c_k2 like '%ลา%'   and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['la2'] =$db->fetch(@$res['la2']);
						@$res['la3'] = $db->select_query("select *,count(c_stu) as LA3 from ".TB_CHCLASS."   where c_k3 like '%ลา%'   and c_class='".$row['class_id']."'  and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['la3'] =$db->fetch(@$res['la3']);
						@$res['la4'] = $db->select_query("select *,count(c_stu) as LA4 from ".TB_CHCLASS."   where c_k4 like '%ลา%'   and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."'  group by c_class  "); 
						@$arr['la4'] =$db->fetch(@$res['la4']);

						@$LA=@$arr['la1']['LA1']+@$arr['la2']['LA2']+@$arr['la3']['LA3']+@$arr['la4']['LA4'];


						@$res['sai1'] = $db->select_query("select *,count(c_stu) as SAI1 from ".TB_CHCLASS."   where c_k like '%สาย%'  and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['sai1'] =$db->fetch(@$res['sai1']);
						@$res['sai2'] = $db->select_query("select *,count(c_stu) as SAI2 from ".TB_CHCLASS."   where c_k2 like '%สาย%'  and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['sai2'] =$db->fetch(@$res['sai2']);
						@$res['sai3'] = $db->select_query("select *,count(c_stu) as SAI3 from ".TB_CHCLASS."   where c_k3 like '%สาย%'  and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class  "); 
						@$arr['sai3'] =$db->fetch(@$res['sai3']);
						@$res['sai4'] = $db->select_query("select *,count(c_stu) as SAI4 from ".TB_CHCLASS."   where c_k4 like '%สาย%'  and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['sai4'] =$db->fetch(@$res['sai4']);

						@$SAI=@$arr['sai1']['SAI1']+@$arr['sai2']['SAI2']+@$arr['sai3']['SAI3']+@$arr['sai4']['SAI4'];

						@$res['op1'] = $db->select_query("select *,count(c_stu) as OP1 from ".TB_CHCLASS."  where c_ch1= '1'   and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['op1'] =$db->fetch(@$res['op1']);
						@$res['op2'] = $db->select_query("select *,count(c_stu) as OP2 from ".TB_CHCLASS."  where c_ch2= '2'   and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['op2'] =$db->fetch(@$res['op2']);
						@$res['op3'] = $db->select_query("select *,count(c_stu) as OP3 from ".TB_CHCLASS."  where c_ch3= '3'   and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['op3'] =$db->fetch(@$res['op3']);
						@$res['op4'] = $db->select_query("select *,count(c_stu) as OP4 from ".TB_CHCLASS."  where c_ch4= '4'   and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['op4'] =$db->fetch(@$res['op4']);
						@$res['op5'] = $db->select_query("select *,count(c_stu) as OP5 from ".TB_CHCLASS."  where c_ch5= '5'   and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['op5'] =$db->fetch(@$res['op5']);
						@$res['op6'] = $db->select_query("select *,count(c_stu) as OP6 from ".TB_CHCLASS."  where c_ch6= '6'   and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['op6'] =$db->fetch(@$res['op6']);
						@$res['op7'] = $db->select_query("select *,count(c_stu) as OP7 from ".TB_CHCLASS."  where c_ch7= '7'   and c_class='".$row['class_id']."' and c_area='".$_SESSION['person_area']."' and c_code='".$_SESSION['person_school']."' group by c_class "); 
						@$arr['op7'] =$db->fetch(@$res['op7']);
				//		@$PerC=(100*(@$arr['num']['CO']))/(@$rows['count']);
						@$OPSS=@$arr['op1']['OP1']+@$arr['op2']['OP2']+@$arr['op3']['OP3']+@$arr['op4']['OP4']+@$arr['op5']['OP5']+@$arr['op6']['OP6']+@$arr['op7']['OP7'];


						$Y=$row['class_short'];
						$a=(int)$KAD;
						$b=(int)$LA;
						$c=(int)$SAI;
						$d=(int)$OPSS;
					?>
						{y: '<?php echo $Y;?>', a: '<?php echo $a;?>', b: '<?php echo $b;?>', c: '<?php echo $c;?>', d: '<?php echo $d;?>'},
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
//                    ],#00CC00
                    barColors: ['#0a61a4', '#7b919e','#5cbc06','#f1880d'],
                    xkey: 'y',
                    ykeys: ['a', 'b','c','d'],
                    labels: ['<?php echo _text_box_panel1;?>', '<?php echo _text_box_panel2;?>', '<?php echo _text_box_panel3;?>', '<?php echo _text_box_panel4;?>'],
                    hideHover: 'auto'
                });
//				alert('<?php echo $Y;?>');
            });
        </script>
		