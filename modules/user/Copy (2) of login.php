 <?php require_once ("modules/index/header.php");?>
 <!--login modal-->

<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content" >
      <div class="modal-header">
          <h3><i class="glyphicon glyphicon-user"></i> <?php echo _text_login; ?></h3>
      </div>
<?php
if($_POST){
$Username = preg_replace ( '/"/i', '\"' , $_POST['username']); 
$Password= preg_replace ( "/'/i", "\'" , $_POST['password']);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." WHERE username='".$Username."' AND password='".md5($Password)."' and status='1' "); 
$rows['user'] = @$db->rows($res['user']); 
if(!empty($rows['user'])){
	$arr['user'] = $db->fetch($res['user']);
}
if(!empty($arr['user']['user_id'])){
	ob_start();
	$_SESSION['user_login'] = $Username ;
	$_SESSION['user_pwd'] = md5($Password) ;
	$_SESSION['user_school'] = $arr['user']['code'] ;

	$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_code='".$_SESSION['user_school']."' "); 
	$arr['sh'] = $db->fetch($res['sh']); 

	$_SESSION['school_name'] = $arr['sh']['sh_name'] ;

	$_SESSION['ua'] = $_SESSION['user_login'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'].":".$_SESSION['user_school'];
	$timeoutseconds=30*60; // 30 นาที
//	$_SESSION['timestamp2']=time();
	$timeout=time() + $timeoutseconds;
	$_SESSION['timeout']=$timeout;

	$ct_ip = $_SERVER["REMOTE_ADDR"];
	$ct_yyyy = date("Y") ;
	$ct_mm = date("m") ;
	$ct_dd = date("d") ;
	$ct_time = time();

		$db->add_db(TB_ACTIVEUSER,array(
			"ct_user"=>"".$_SESSION['user_login']."",
			"ct_school"=>"".$_SESSION['user_school']."",
			"ct_yyyy"=>"".$ct_yyyy."",
			"ct_mm"=>"".$ct_mm."",
			"ct_dd"=>"".$ct_dd."",
			"ct_ip"=>"".$ct_ip."",
			"ct_count"=>"1",
			"ct_time"=>"".$ct_time."",
			"ct_timeout"=>"".$timeout.""
		));

		$res['online'] = $db->select_query("SELECT * FROM ".TB_ONLINE." WHERE u_user='".$_SESSION['user_login']."' and u_school='".$_SESSION['user_school']."' "); 
		$rows['online'] = @$db->rows($res['online']); 
		if($rows['online']){
		$db->update_db(TB_ONLINE,array(
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		),"  u_user='".$_SESSION['user_login']."' and u_school='".$_SESSION['user_school']."' " );
		} else {
		$db->add_db(TB_ONLINE,array(
			"u_user"=>"".$_SESSION['user_login']."",
			"u_school"=>"".$_SESSION['user_school']."",
			"u_ip"=>"".$ct_ip."",
			"u_timein"=>"".$ct_time."",
			"u_timeout"=>"".$timeout.""
		));
		}
		$db->closedb ();

	$success = _success;
	$success .="<meta http-equiv='refresh' content='1; url=index.php'>";
//return $success;
} else {
$error_warning =_error_warning;
//return $error_warning;

}
} 

?>
      <div class="modal-body" >
      <?php if ($success) { ?>
      <p class='alert alert-success'><?php echo $success; //echo "<meta http-equiv='refresh' content='1; url=home.php?mon=".$_POST['mon']."'>";?></p>
      <?php } ?>
      <?php if ($error_warning) { ?>
      <p class='alert alert-danger'><?php echo $error_warning; ?></p>
      <?php } ?>
          <form action="" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
            <div class="form-group">
            <label class="col-sm-4 control-label"><?php echo _entry_username; ?></label>
             <div class="col-sm-6"><input type="text" name="username" value="<?php echo $POST['username']; ?>" class="form-control input-lg" placeholder="Username">
            </div>
           </div>
            <div class="form-group">
	     <label class="col-sm-4 control-label"><?php echo _entry_password; ?></label>
              <div class="col-sm-6"><input type="password"  name="password" value="<?php echo $_POST['password']; ?>" class="form-control input-lg" placeholder="Password">
            </div>
            </div>
            <div class="form-group" >
              <div class="col-sm-10" align="right"><button onclick="$('#form').submit();"  class="btn bg-aqua btn-flat" ><?php echo _button_login; ?></button></div>
            </div>
            <div class="form-group" >
              <div class="col-sm-10" align="right"><a href="index.php?name=user&file=register&route=user/register"  >[<?php echo _create_account; ?>]</a>&nbsp;<a href="index.php?name=user&file=reset&route=user/reset"  >[<?php echo _reset_password; ?>]</a></div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
	      <span class="pull-center">
			<?php echo _footer_main_title;?>
	      </span>
          </div>	
      </div>
  </div>
  </div>
</div>

<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#form').submit();
	}
});
//--></script> 
