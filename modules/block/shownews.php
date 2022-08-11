<div class="row">
  <div class="col-xs-12 connectedSortable">
<?php
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." order by news_id DESC limit 4"); 
		$i=1;
		while ($arr['news'] = $db->fetch($res['news'])){
		$res['cat'] = $db->select_query("SELECT * FROM ".TB_NEWS_CATE." WHERE cate_id='".$arr['news']['category']."' "); 
		$arr['cat'] = $db->fetch($res['cat']);
		$Preview=ThaiTimeConvert($arr['news']['post_date']);
	//	echo $arr['news']['pic'];
?>
        <div class="col-md-4 col-sm-6 col-xs-12">
		  <div class="box box-warning">
            <div class="box-body">
			<a href="<?php echo WEB_URL_IMG_NEWS.$arr['news']['pic']."";?>" data-toggle="lightbox" data-title="<?php echo $arr['news']['topic']; ?>">
			<center><img src="<?php echo WEB_URL_IMG_NEWS.$arr['news']['pic']."";?>" class="col-md-12 img-fluid"></center>
			</a>
            </div>
            <!-- /.info-box-content -->
			<!-- info-box-footer -->
	         <div class="box-footer">
                <p class="message">
                  <a href="index.php?name=news&file=readnews&news_id=<?php echo $arr['news']['news_id'];?>" class="name">
                    <?php echo $arr['news']['topic']; ?>
                  </a>
				  <?php echo NewsIcons(TIMESTAMP,$arr['news']['post_date']);?>
					<?php echo $arr['news']['headline']; ?>
                    <small class="text-muted pull-right">
					<i class="fa fa-calendar"></i><?php echo $Preview; ?>
					<i class="fa fa-user"></i><?php echo $arr['news']['posted']; ?>
					<i class="fa fa-eye"></i><?php echo $arr['news']['pageview']; ?>
					</small>
                </p>
            </div>
			<!-- /.info-box-footer -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		<?php
		}
		?>
	</div>
</div>