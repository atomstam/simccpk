<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
require_once("lang/readnews.php");
$home ="index.php?name=news&file=readnews&route=".$route."";

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['upview'] = $db->select_query("update ".TB_NEWS." set  pageview=pageview+1 where news_id='".$_GET['news_id']."' ");
$arr['upview'] = $db->fetch($res['upview']);	
$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." WHERE news_id='".$_GET['news_id']."' "); 
$arr['news'] = $db->fetch($res['news']);
$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$arr['news']['posted']."' "); 
$arr['user'] = $db->fetch($res['user']);
$res['cat'] = $db->select_query("SELECT * FROM ".TB_NEWS_CATE." WHERE cate_id='".$arr['news']['category']."' "); 
$arr['cat'] = $db->fetch($res['cat']);
$Preview=ThaiTimeConvert($arr['news']['post_date']);
?>
<div class="row">
  <div class="col-xs-12">
		<div class="col-md-12">
						<div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
									<i class="fa fa-edit"></i>
                                    <h3 class="box-title"><?php echo $arr['news']['topic']; ?></h3>
									<?php echo NewsIcons(TIMESTAMP,$arr['news']['post_date']);?>
									<small class="text-muted pull-right">
										<i class="fa fa-calendar"></i><?php echo $Preview; ?>
										<i class="fa fa-user"></i><?php echo $arr['news']['posted']; ?>
										<i class="fa fa-eye"></i><?php echo $arr['news']['pageview']; ?>
									</small>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                    <div class="col-md-12">
                                     <?php echo $arr['news']['detail'];?>
                                    </div>

							</div>
						</div>

</div>
</div>
</div>







