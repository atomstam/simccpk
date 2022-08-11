<?php
		require_once("config.php");
		$home ="index.php?name=news&file=index&route=news/page";
		$route = "news/index";
		$limit = 8 ;
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
		$SUMPAGE = $db->num_rows(TB_NEWS,"id", $SQLwhere );
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
			} 
			?>
