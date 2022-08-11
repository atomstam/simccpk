<?php
ob_start();
//header('Content-Type: application/json');
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//echo $_SESSION['area_code'];
$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." where sh_area='".$_SESSION['person_area']."'  and sh_code='".$_SESSION['person_school']."' "); 
$arr['sh'] = $db->fetch($res['sh']);
//$Lat=number_format((float)($arr['ar']['area_lat']),4);
//$Long=number_format((float)($arr['ar']['area_long']),4);
//$Lat=number_format($arr['sh']['latitude']);
//$Long=number_format($arr['sh']['longitude']);
$Lat=$arr['sh']['latitude'];
$Long=$arr['sh']['longitude'];
//echo $Lat;
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAr6ZgHWvwwGvFEM2hAtmYr9rc-Ug2QFwU&callback=initMap&sensor=true&language=th" type="text/javascript"></script>

<script type="text/javascript" src="../../../js/gmap3.js"></script>
    <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="box box-danger">
                <div class="box-header with-border">
							<h3 class="box-title">พิกัดบ้านนักเรียน : <?php echo $arr['sh']['sh_name'];?></h3>
                </div>
                <!-- /.box-header -->
                            <div class="panel-body">
							<div class='title'>
							<?php
							$res['marker'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."'  and stu_code='".$_SESSION['person_school']."' group by stu_class order by stu_class"); 
							while($arr['marker'] = $db->fetch($res['marker'])){
								$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." where class_id='".$arr['marker']['stu_class']."' "); 
								$arr['cl'] = $db->fetch($res['cl']);
								if($arr['marker']['stu_class']=='m1'){ $img="marker_01.png";}
								if($arr['marker']['stu_class']=='m2'){ $img="marker_02.png";}
								if($arr['marker']['stu_class']=='m3'){ $img="marker_03.png";}
								if($arr['marker']['stu_class']=='m4'){ $img="marker_04.png";}
								if($arr['marker']['stu_class']=='m5'){ $img="marker_05.png";}
								if($arr['marker']['stu_class']=='m6'){ $img="marker_06.png";}
							?>
							<img src='../img/icon/<?php echo $img;?>' width='25' height='25'> <?php echo $arr['cl']['class_short'];?>
							<?php
							}
							?>
							</div>
									<div id="map_canvas"></div>  
                            </div> <!-- /.body -->
                        </div><!-- /.box -->

                    </div>
                    <!-- /.col -->
      </div>
      <!-- /.row-->
<style>
    div#map_canvas { width:100%; height:70%; }
</style>

<script type="text/javascript">
    var maps, marker, latlng;
	var LAT = parseFloat('<?php echo $Lat;?>');
	var LONG = parseFloat('<?php echo $Long;?>');
	//alert(LAT);
    $(function () {
//	function initMap(markers) {
        $('#map_canvas').gmap3({
				map: {
				options: {
					center: [LAT, LONG],
					zoom: 15,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					mapTypeControl: true,
					mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
					},
				}
				},
                marker: {
                values: [
					<?php
					//$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$strSQL = $db->select_query("SELECT * FROM ".TB_STUDENT." as a ,".TB_CLASS." as b  where a.stu_area='".$_SESSION['person_area']."' and a.stu_code='".$_SESSION['person_school']."' and b.class_id=a.stu_class order by a.stu_id"); 
					//$resultArray = array();
					while($obResult =  $db->fetch($strSQL))
					{
						if($obResult['class_id']=='m1'){ $icon='../img/icon/marker_01.png';}
						if($obResult['class_id']=='m2'){ $icon='../img/icon/marker_02.png';}
						if($obResult['class_id']=='m3'){ $icon='../img/icon/marker_03.png';}
						if($obResult['class_id']=='m4'){ $icon='../img/icon/marker_04.png';}
						if($obResult['class_id']=='m5'){ $icon='../img/icon/marker_05.png';}
						if($obResult['class_id']=='m6'){ $icon='../img/icon/marker_06.png';}

						if($obResult['stu_lat']==''){ $LatStu=$Lat;}
						if($obResult['stu_long']==''){ $LongStu=$Long;}
					?>
						{
						latLng:[<?php echo $LatStu;?> , <?php echo $LongStu;?>],
						data:"ddd",
						options:{
									icon: "<?php echo $icon;?>"
									}
						}, 


		<?php
			}
		?>
	              ],
                events: {
                mouseover: function (marker, event, context) {
                var map = $(this).gmap3("get"),
                        infowindow = $(this).gmap3({
                get: {
                name: "infowindow"
                }
                });
                if (infowindow) {
                infowindow.open(map, marker);
                        infowindow.setContent(context.data);
                } else {
                $(this).gmap3({
                infowindow: {
                anchor: marker,
                        options: {
                        content: context.data
                        }
                }
                });
                }
                },

                click: function (marker, event, context) {
                var map = $(this).gmap3("get"),
                        infowindow = $(this).gmap3({
                get: {
                name: "infowindow"
                }
                });
                if (infowindow) {
                infowindow.open(map, marker);
                        infowindow.setContent(context.data);
                } else {
                $(this).gmap3({
                infowindow: {
                anchor: marker,
                        options: {
                        content: context.data
                        }
                }
                });
                }
                },

						closeclick: function () {
                        infowindow.close();
                        }
                ,
                        mouseout: function () {
                        var infowindow = $(this).gmap3({
                        get: {
                        name: "infowindow"
                        }
                        });
                        }
                }
                }
        }
        );

//	}

    $.ajax({
        url: 'marker.json'
    }).done(function(data) {
        // Re-initialise the map with loaded marker data
        initMap(data);
    });

    });
</script>
