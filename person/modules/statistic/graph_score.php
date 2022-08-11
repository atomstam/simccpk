<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/score.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
?>

	 <div class="col-xs-12 connectedSortable">
      <!-- Main row -->
      <div class="row">

                <div class="col-md-8 col-sm-8">
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab"><?php echo _index_title_graph_line_mounth;?></a></li>
              <li><a href="#sales-chart" data-toggle="tab"><?php echo _index_title_graph_donut_mounth;?></a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> <?php echo _index_title_graph;?></li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
          </div>
                </div>
                <!-- /.col -->

            <div class="col-md-4">
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
		@$res['nums'] = $db->select_query("select stu_id,stu_pic,stu_pid,stu_num,stu_name,stu_sur,class_name,stu_class,sum(badtail_point) as CO  from ".TB_BAD." ,".TB_STUDENT.",".TB_BADTAIL.",".TB_CLASS." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_id=bad_stu and bad_tail=badtail_id and class_id=stu_class and stu_suspend ='0' group by stu_id order by CO desc limit 8 "); 
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
          </div>
          <!-- /.row -->



       </div>
  </div>


<script>
	$(function() {
    "use strict";
  //BAR CHART
  /* Morris.js Charts */
  // Sales chart
		$.ajax({
		url: "modules/statistic/chart_score.php",
		method: "GET",
		dataType: 'json',
        async: false,
        contentType: "application/json; charset=utf-8",
		success: function(data) {
			console.log(data);
			var Data= JSON.stringify(data);
//			var bad_mouths = [];
//			var BB = [];
//			var Gos = [];
//			var YY =Cos.push(Data[0]);
//			for(var i in Data) {
//				YY.push(Data[i].m);
//				bad_mouths.push(data[i].Bad_m);
//				Cos.push(data[i].Co);
//				Gos.push(data[i].Go);
//				alert(YY);
//			}
//		alert([bad_mouths,Gos,Cos]);
//alert(YY);
//alert(Data);
//	for (var i in Data) {
//		console.log(Data[i].B + ' is a ' + Data[i].item1 + '.');
//		BB.push(Data[i].B);
//		'{y:'+Data[i].B+'}',
//		alert(Data[i].B);
//	}
//var YY_data=[Data];
//alert(BB);
//var CC='{'+BB+'}';
//alert('y');
  var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
//	data: [
//			{y:''+bad_mouths+'', item1: ''+Cos+'', item2: ''+Gos+''},
//	],
	data: $.parseJSON(Data),
    xkey: 'y',
    ykeys: ['item1', 'item2'],
    labels: ['<?php echo _index_title_graph_lebel_bad;?>', '<?php echo _index_title_graph_lebel_good;?>'],
    lineColors: ['#3c8dbc','#a0d0e0'],
    hideHover: 'auto'
  });

  		},
		error: function(data) {
			console.log(data);
		}
	});
//  var line = new Morris.Line({
//    element: 'line-chart',
//    resize: true,
//    data: [
//      {y: '2011 Q1', item1: 2666},
//      {y: '2011 Q2', item1: 2778},
//      {y: '2011 Q3', item1: 4912},
//      {y: '2011 Q4', item1: 3767},
//      {y: '2012 Q1', item1: 6810},
//      {y: '2012 Q2', item1: 5670},
//      {y: '2012 Q3', item1: 4820},
//      {y: '2012 Q4', item1: 15073},
//      {y: '2013 Q1', item1: 10687},
//      {y: '2013 Q2', item1: 8432}
//    ],
//    xkey: 'y',
//    ykeys: ['item1'],
//    labels: ['Item 1'],
//    lineColors: ['#efefef'],
//    lineWidth: 2,
//    hideHover: 'auto',
//    gridTextColor: "#fff",
//    gridStrokeWidth: 0.4,
//    pointSize: 4,
//    pointStrokeColors: ["#efefef"],
//    gridLineColor: "#efefef",
//    gridTextFamily: "Open Sans",
//    gridTextSize: 10
//  });

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
    colors: [ "#00a65a","#f56954","#3c8dbc"],
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

  //Fix for charts under tabs
  $('.box ul.nav a').on('shown.bs.tab', function () {
    area.redraw();
    donut.redraw();
//    line.redraw();
  });

  });
</script>