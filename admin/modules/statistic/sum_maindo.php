<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/maindo.php");
$db = New DB();
$add='';
$edit='';
$del='';
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['Boy'] = $db->select_query("select *,count(stu_num) as Boys from ".TB_STUDENT."  where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and  stu_sex='1' "); 
$arr['Boy'] =$db->fetch($res['Boy']);
$res['Girl'] = $db->select_query("select *,count(stu_num) as Girls from ".TB_STUDENT."  where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and  stu_sex='2'  "); 
$arr['Girl'] =$db->fetch($res['Girl']);
$Girl=$arr['Girl']['Girls'];
$Boy=$arr['Boy']['Boys'];
$PerCB=(100*($Boy))/($Boy+$Girl);
$PerCG=(100*($Girl))/($Boy+$Girl);

$res['Ton'] = $db->select_query("select *,count(stu_id) as Tons from ".TB_STUDENT."  where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and  (stu_class between 'm1' and 'm3' ) "); 
$arr['Ton'] =$db->fetch($res['Ton']);
$res['Plai'] = $db->select_query("select *,count(stu_id) as Plais from ".TB_STUDENT."  where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and  (stu_class between 'm4' and 'm6' )  "); 
$arr['Plai'] =$db->fetch($res['Plai']);
$Plai=$arr['Plai']['Plais'];
$Ton=$arr['Ton']['Tons'];
$PerCT=(100*($Ton))/($Ton+$Plai);
$PerCP=(100*($Plai))/($Ton+$Plai);

?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >

    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title; ?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".$rows['count'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['prov'] = $db->select_query("SELECT *,count(stu_id) as CO FROM ".TB_STUDENT." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' group by stu_prov order by stu_prov "); 
		$rows['prov'] = $db->rows($res['prov']);
		if($rows['prov']) {
		?>
      <form  method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_stu_prov; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_sum;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_percen;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while ($arr['prov'] = $db->fetch($res['prov'])){
		$res['provs'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." WHERE id='".$arr['prov']['stu_prov']."' "); 
		$arr['provs'] =$db->fetch($res['provs']);
		$PerC=(100*($arr['prov']['CO']))/($rows['count']);
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td layout="block" style="text-align: left;"><?php if($arr['provs']['name']==''){ echo _text_box_table_stu_prov_null;} else {echo $arr['provs']['name'];}?></td>
              <td layout="block" style="text-align: center;"><?php echo $arr['prov']['CO'];?></td>
              <td layout="block" style="text-align: center;"><?php echo number_format(($PerC),2);?></td>
			  <td style="text-align: center;">
			 <a href="index.php?name=statistic&file=maindo&op=provdetail&prov_id=<?php echo $arr['prov']['stu_prov'];?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
			  </td>
            </tr>

            <?php $i++;} ?>
          </tbody>
		  </table>
	      </form>

            <?php } else { ?>
			<table>
            <tr>
              <td class="center" colspan="7"><?php echo _text_no_results; ?></td>
            </tr>
			</table>
            <?php } ?>

		</div> <!-- /.boxbody-->
    </div><!-- /.boxdanger-->
</div><!-- /.boxtab-->
</div><!-- /.boxconnect 12-->
	
</div><!-- /.row -->