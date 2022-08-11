<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
$home ="index.php?name=news&file=index&route=".$route."";
?>
<link href="js/plugins/uploadify/css/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/plugins/uploadify/js/swfobject.js"></script>
<script type="text/javascript" src="js/plugins/uploadify/js/jquery.uploadify-3.1.js"></script>
<style>
.upload {
    margin: 0 auto;
    width: 950px;
}
</style>

<div class="row">
<div class="col-xs-12 connectedSortable">
<!-- top row -->
	<div class="row">
		<div class="col-xs-12 connectedSortable">
<?php
if($op=='detail'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['upview'] = $db->select_query("update ".TB_NEWS." set  pageview=pageview+1 where id='".$_GET['id']."' ");
$arr['upview'] = $db->fetch($res['upview']);	
$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." WHERE id='".$_GET['id']."' "); 
$arr['news'] = $db->fetch($res['news']);
$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." WHERE username='".$arr['news']['posted']."' "); 
$arr['user'] = $db->fetch($res['user']);
$res['cat'] = $db->select_query("SELECT * FROM ".TB_MAG_NAME." WHERE id='".$arr['news']['category']."' ");
$arr['cat'] = $db->fetch($res['cat']);
$res['level'] = $db->select_query("SELECT *,count(id) as LEV FROM ".TB_NEWS." WHERE posted='".$arr['news']['posted']."' group by posted");
$arr['level'] = $db->fetch($res['level']);	
$res['school'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_code='".$arr['user']['code']."' ");
$arr['school'] = $db->fetch($res['school']);
$res['area'] = $db->select_query("SELECT * FROM ".TB_AREA." WHERE area_code='".$arr['school']['sh_area']."' ");
$arr['area'] = $db->fetch($res['area']);
?>

<div class="row">
   <div class="col-xs-12 connectedSortable">
 <div align="right" >
  <div class="share42init" data-title="<?php echo $arr['news']['topic'];?>" data-description="<?php echo $arr['news']['headline'];?>" data-image="<?php echo WEB_URL_IMG_ICON.$arr['news']['icon']; ?>" ></div>
<script type="text/javascript" src="share42/share42.js?title=<?php echo $arr['news']['topic'];?>&description=<?php echo $arr['news']['headline'];?>&images=<?php echo WEB_URL_IMG_ICON.$arr['news']['icon']; ?>"></script> 
</div>
						<div class="box box-info" id="loading-example">
                                <div class="box-header">
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-warning btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-warning btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
									<i class="fa fa-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_news_detail; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                    <div class="alert alert-info alert-dismissable">
									<table width="100%">
									<tr>
                                     <td width="15%"><img src="<?php echo WEB_URL_IMG_ICON.$arr['news']['icon']; ?>" width="200" alt="icon" /></td>
									 <td valign="top" width="85%">
									<table width="100%">
									<tr>
                                     <td width="18%" align="right" style="font-size:15px;"><b><?php echo _text_box_body_gen_cat;?> :</b></td>
									 <td style="font-size:15px;"><?php echo $arr['cat']['category_name'];?></td>
									 </tr>
									<tr>
                                     <td width="18%" align="right" style="font-size:15px;"><b><?php echo _text_box_body_gen_topic;?> :</b></td>
									 <td style="font-size:15px;"><?php echo $arr['news']['topic'];?></td>
									 </tr>
									<tr>
                                     <td width="18%" align="right" style="font-size:15px;"><b><?php echo _text_box_table_date;?> :</b></td>
									 <td style="font-size:15px;"><?php echo ThaiTimeConvert($arr['news']['post_date'],'','');?></td>
									 </tr>
									<tr>
                                     <td width="18%" align="right" style="font-size:15px;"><b><?php echo _text_box_table_view;?> :</b></td>
									 <td style="font-size:15px;"><?php echo $arr['news']['pageview'];?></td>
									 </tr>
									<tr>
                                     <td width="18%" align="right" style="font-size:15px;"><b><?php echo _text_box_table_rating;?> :</b></td>
									 <td style="font-size:15px;"><?php echo $arr['news']['rating'];?></td>
									 </tr>
									<tr>
                                     <td width="18%" align="right" valign="top"><b>Vote :</b></td>
									 <td>
									 <?
										$rater_ids=$_GET['id'];
										$rater_item_name='news';
										$mod="news";
										include("modules/rater/rater.php");
									?>
									</td>
									 </tr>
									 </table>
									 </td>
									</tr>
									</table>
                                    </div>
                                    <div class="alert alert-warning alert-dismissable">
                                        <b><?php echo _text_box_body_gen_detail;?></b><br><?php echo $arr['news']['detail'];?>
                                    </div>
                                    <div class="alert alert-success alert-dismissable">
                                    <table width="100%">
									<tr>
                                     <td width="15%"><?php if(!empty($arr['user']['img'])){?>
                                                    <img src="<?php echo WEB_URL_IMG_USER.$arr['user']['img']; ?>" width="100" alt="User Image" />
                                                <?php } else {?>
                                                     <img src="<?php echo WEB_URL_IMG_USER."no_image.jpg";?>" width="100" alt="User Image"/>
                                                <?php } ?>
									</td>
									 <td valign="top" width="85%">
									<table width="100%">
									<tr>
                                     <td width="18%" align="right" style="font-size:15px;"><b><?php echo _text_box_body_gen_posted;?> :</b></td>
									 <td style="font-size:15px;"><?php echo $arr['user']['firstname']." ".$arr['user']['lastname']."(".$arr['user']['username'].")";?></td>
									 </tr>
									<tr>
                                     <td width="18%" align="right" style="font-size:15px;"><b><?php echo _text_box_body_gen_school;?> :</b></td>
									 <td><?php echo $arr['school']['sh_name'];?></td>
									 </tr>
									<tr>
                                     <td width="18%" align="right" style="font-size:15px;"><b><?php echo _text_box_body_gen_area;?> :</b></td>
									 <td style="font-size:15px;"><?php echo $arr['area']['area_name'];?></td>
									 </tr>
									<tr>
                                     <td width="18%" align="right" style="font-size:15px;"><b><?php echo _text_box_body_gen_level;?> :</b></td>
									 <td style="font-size:15px;"><?=UserLevel($arr['level']['LEV']);?></td>
									 </tr>
									 </table>
									 </td>
									</tr>
									</table>
                                    </div>



							</div>
						</div>

</div>
</div>
<?php
if($arr['news']['enable_comment']==1){
require_once("function.php");
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
if(!empty($_POST['mc_message'])){
if($user_login){
$UserPosted=$user_login;
} else {
$UserPosted='Guest';
}
		$db->add_db(TB_NEWS_MESSAGE_COM,array(
			"mc_ms"=>"".$_POST['MsID']."",
			"mc_message"=>"".$_POST['mc_message']."",
			"mc_posted"=>"".$UserPosted."",
			"mc_date"=>"".TIMESTAMP."",
			"mc_year"=>"".date('Y')."",
			"mc_ip"=>"".$IPADDRESS.""
		));
}
?>
<?php
$res['mss'] = $db->select_query("SELECT * FROM ".TB_NEWS_MESSAGE_COM." where mc_ms='".$_GET['id']."' ");
$row['mss'] = @$db->rows($res['mss']);
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">

<form action="" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal">
<div id="myTabContent" class="tab-content">

					    <div class="box box-success" id="loading-example">
                                <div class="box-header">
                                <i class="fa fa-folder-open"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_news; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body  ">
							<?php
							if($row['mss']){
							?>
							<div class="col-md-12">
                            <!-- The time line -->
							 <ul class="timeline">
							<?php
							$i=1;
							while($arr['mss'] = $db->fetch($res['mss'])){
							$res['usere'] = $db->select_query("SELECT * FROM ".TB_USER." where username='".$arr['mss']['mc_posted']."' "); 
							$arr['usere'] = $db->fetch($res['usere']);
							?>

                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="<?php echo $timeLabel[$i];?>">
                                        <?php echo ThaiTimeConvert($arr['mss']['mc_date'],"","");?>
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
								<li>
									<i class="<?php echo $timeIcon[$i];?> <?php echo $timeBg[$i];?>"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo fb_date($arr['mss']['mc_date']);?></span>
                                        <h3 class="timeline-header"><a href=""><?php echo $arr['mss']['mc_posted'];?> </a></h3>
                                        <div class="timeline-body">
										 <img src="<?php if($arr['usere']['img']){echo WEB_URL_IMG_USER.$arr['usere']['img'];}else{echo WEB_URL_IMG_USER."no_image.jpg";}?>" width="50" height="50"  class="img-circle" alt="User Image"/>&nbsp;
										<?php echo $arr['mss']['mc_message'];?>
                                        </div>
                                        <div class='timeline-footer'>
										 ip : <?php echo $arr['mss']['mc_ip'];?>
                                        </div>
                                    </div>
								</li>
							<?php
							$i++;
							}
							?>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-clock-o"></i>
                                </li>
							</ul>
							</div>
							<?php
								}
							?>
							<form action="#" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal">
							<input type="hidden" name="MsID" value="<?php echo $_GET['id'];?>">
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_comment_add; ?></label>
							<div class="col-sm-8" ><p class="form-control-static">
							<textarea name="mc_message" class="form-control" id="editor1" rows="5" cols="80"></textarea>
							</p>
							</div>
							<div align="right" class="col-sm-11">
							<br>
							<button type="submit" name="submit" class="btn bg-aqua btn-flat"><?php echo _button_save;?></button>
							<br>
							</div>
							</form>
							<div class="form-group">
							<br>
							</div>

							</div>
						</div>

</div>
</div>

<?php
}
?>
<?php
} else {
?>
<!-- top row -->
<div class="row">
	<!-- /col -->
	<div class="col-xs-12 connectedSortable">

    <div class="tab-pane fade active in" >

    <div class="box box-danger">
	                           <div class="box-header">
                                <i class="fa fa-medkit"></i>
                                    <h3 class="box-title"><?php echo _heading_title; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body  ">
	<div class="row">
	  <div class="col-xs-12 connectedSortable">
	  <div class="col-sm-3 pull-left">
	  <form name="form" method="post" enctype="multipart/form-data" class="form-inline" role="form">
	  <select name="category" class="form-control" onchange="if(options[selectedIndex].value){location = options[selectedIndex].value};  MM_jumpMenu('parent',this,0)">
	  <option value="index.php?name=news&file=index<?php if($_GET['order']){ echo "&order=".$_GET['order'];}?>&route=<?php echo $route;?>">All Category</option>
	<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['cate'] = $db->select_query("SELECT * FROM ".TB_MAG_NAME." ORDER BY id  ");
while($arr['cate'] = $db->fetch($res['cate'])){
	echo "<option value=\"index.php?name=news&file=index";
	if($_GET['order']){ echo "&order=".$_GET['order'];}
	echo "&category=".$arr['cate']['id']."&route=".$route."\" ";
	if($category == $arr['cate']['id']){
		echo " Selected";
	}
	echo " >".$arr['cate']['category_name']."</option>";
}
?>
                          </select>
            </form>
		</div>
	  <div class="col-sm-3 pull-left">
	  <form name="form" method="post" enctype="multipart/form-data" class="form-inline" role="form">
	  <select name="order" class="form-control" onchange="if(options[selectedIndex].value){location = options[selectedIndex].value};  MM_jumpMenu('parent',this,0)">
	  <option value="index.php?name=news&file=index&order=1<?php if($_GET['category']){ echo "&category=".$_GET['category'];}?>&route=<?php echo $route;?>" <?php if($_GET['order']==1){ echo " Selected" ;}?>><?php echo _text_box_select_order_id_desc;?></option>
	  <option value="index.php?name=news&file=index&order=2<?php if($_GET['category']){ echo "&category=".$_GET['category'];}?>&route=<?php echo $route;?>" <?php if($_GET['order']==2){ echo " Selected" ;}?>><?php echo _text_box_select_order_id;?></option>
	  <option value="index.php?name=news&file=index&order=3<?php if($_GET['category']){ echo "&category=".$_GET['category'];}?>&route=<?php echo $route;?>" <?php if($_GET['order']==3){ echo " Selected" ;}?>><?php echo _text_box_select_order_view;?></option>
            </select>
            </form>
		</div>
		<div class="col-sm-6">
		<ul id="pagination-demo" class="pull-right" style="margin-top: 0;"></ul>&nbsp;
		</div>
		</div>
		</div>
	  <div class="row-fluid">
<?php
$category=$_GET['category'];
$order=$_GET['order'];
if(!empty($category) && !empty($order) ){
	$SQLwhere = " category='".$category."' ";
	$SQLwhere2 = " WHERE category='".$category."' ";
	if($order==1){
	$Order = " order by id desc ";
	} else if($order==2){
	$Order = " order by id ";
	} else {
	$Order = " order by pageview desc";
	}
} else if(empty($category) && !empty($order) ){
	$SQLwhere = "";
	$SQLwhere2 = "";
	if($order==1){
	$Order = " order by id desc ";
	} else if($order==2){
	$Order = " order by id ";
	} else {
	$Order = " order by pageview desc";
	}
}else if(!empty($category) && empty($order) ){
	$SQLwhere = " category='".$category."' ";
	$SQLwhere2 = " WHERE category='".$category."' ";
	$Order = " order by id desc ";
}else {
	$SQLwhere = "";
	$SQLwhere2 = "";
	$Order = " order by id desc ";
}
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['nums'] = $db->select_query("SELECT * FROM ".TB_NEWS." ".$SQLwhere2." limit 1"); 
		$rows['nums'] = @$db->rows($res['nums']);
		if($rows['nums']) {
		$limit = 8 ;
		?>
		<div id="page-content">
		<?php
		$SUMPAGE = $db->num_rows(TB_NEWS,"id", $SQLwhere);
		if (empty($page)){
		$page=1;
		}
		$rt = $SUMPAGE%$limit ;
		$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
		$goto = ($page-1)*$limit ;

		$res['num'] = $db->select_query("SELECT * FROM ".TB_NEWS." ".$SQLwhere2." ".$Order." LIMIT $goto, $limit "); 
		$i=0;
		while ($arr['num'] = $db->fetch($res['num'])){
		$res['cat'] = $db->select_query("SELECT * FROM ".TB_MAG_NAME." WHERE id='".$arr['num']['category']."' "); 
		$arr['cat'] = $db->fetch($res['cat']);
		$s=1;
		if($i==0){ echo "<ul class=\"thumbnails\">"; }
		?>
		<li class="span3">
		<div class="thumbnail">
		<?=ShowIcon(TIMESTAMP,$arr['num']['post_date'], "news",$arr['num']['id']);?>
		<img src="<?php echo WEB_URL_IMG_ICON.$arr['num']['icon'];?>" width="200" border="0">
		<div class="caption">
		<h5><b>Topic</b> : <?php echo $arr['num']['topic']; ?></h5>
		<p>
		<b>Date</b> : <?php echo ThaiTimeConvert($arr['num']['post_date'],'',''); ?><br>
		<b>Category</b> : <?php echo $arr['cat']['category_name']; ?><br>
		<b>Author</b> : <?php echo $arr['num']['posted']; ?>
		</p>
		<h4 style="text-align:center">
			  <a href="index.php?name=news&file=index&op=detail&id=<?php echo $arr['num']['id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm">&nbsp;<i class="glyphicon glyphicon-zoom-in"></i>&nbsp;</a>&nbsp;<a class="btn bg-aqua btn-flat btn-sm" href="#">View : <?php echo $arr['num']['pageview']; ?></a>&nbsp;<a class="btn btn-warning" href="#">Rating : <?php echo $arr['num']['rating']; ?></a>
		</h4>
		</div>
		</div>
		</li>
            <?php $i++;
			if (($i%4) == 0) { echo "</ul>"; $i=0; $s++; }
			} ?>

</div>
<script src="js/jquery.twbsPagination.js" type="text/javascript"></script>


 <script >
$(document).ready(function() {
	$('#pagination-demo').twbsPagination({
        totalPages: '<?php echo $totalpage;?>',
        visiblePages: '<?php echo $limit;?>',
		onPageClick: function (event, page) {
//		href: 'index.php?name=news&file=page&route=<?php echo $route;?>&page='+page
		$('#page-content').load('modules/news/page.php?route=<?php echo $route;?>&page='+page);
		}
    });
 });
 </script>

            <?php } else { ?>
			<?php echo _text_no_results; ?>
            <?php } ?>

		</div>
</div>
</div>

    </div>
    </div>
    </div>

	
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
<?php
}
?>




