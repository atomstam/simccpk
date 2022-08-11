<?php 
//require_once ("mainfile.php"); 
if(time() > $_SESSION['timeout'] || empty($_SESSION['admin_login']) ){
session_unset();
setcookie("admin_login");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}

if($route !="index/index"){
require_once ("modules/index/header.php"); 
?>
<div class="col-xs-12">
      <!-- Info boxes -->
      <div class="row">
<?php
require_once ("".$MODPATHFILE.""); 
?>
	</div>
</div>
<?php
require_once ("modules/index/footer.php"); 
} else {
require_once ("modules/index/header.php"); 
	require_once("lang/index.php");
	$route ="index/index";
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$TotalschoolLink='index.php?name=import&file=school&route=import/school';
	$TotalareaLink='index.php?name=import&file=area&route=content/area';
	$TotaluserLink='index.php?name=config&file=user&route=config/user';
	$TotalonlineLink='index.php?name=access&file=userlogin&op=shdetail&id='.$_SESSION['admin_login'].'&route=access/userlogin';
?>
<div class="col-xs-12">
      <!-- Info boxes -->
      <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
			<!-- small box -->
				<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _index_total_area;?></span>
              <span class="info-box-number"><?php echo getTotalAdmin('config' ,'area','');?></span>
			<a href="<?php echo $TotalareaLink;?>" class="small-box-footer"><?php echo _Total_area_link;?> <i class="fa fa-arrow-circle-right"></i></a>
			</div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
		  <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _index_total_school;?></span>
              <span class="info-box-number"><?php echo getTotalAdmin('config','school','');?></span>
               <a href="<?php echo $TotalschoolLink;?>" class="small-box-footer"><?php echo _Total_school_link;?> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _index_total_user;?></span>
              <span class="info-box-number"><?php echo getTotalAdmin('config','user','');?></span>
                                <a href="<?php echo $TotaluserLink;?>" class="small-box-footer">
                                    <?php echo _Total_user_link;?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo _index_total_login;?></span>
              <span class="info-box-number"><?php echo getTotalAdmin('onlineuser','',$admin_login);?></span>
                                <a href="<?php echo $TotalonlineLink;?>" class="small-box-footer">
                                    <?php echo _Total_login_link;?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

</div>

<script>
$(document).ready(function(){
	$("#Graphdo").load("modules/index/graph_area.php");
//	$("#School").load("modules/index/school.php");
//	$("#Sales-chart").load("modules/index/graph_area.php");
});
</script>
<div class="row">
<div class="col-xs-12">
	  <div id="Graphdo" ><center><img src="../img/ajax-loader1.gif" border="0"></center></div>
</div>
</div>


</div>
<?php
require_once ("modules/index/footer.php"); 
}
?>




