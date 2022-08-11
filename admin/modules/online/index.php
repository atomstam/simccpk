<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
if(time() > $_SESSION['timeout']){
session_unset();
setcookie("admin_login");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
$home ="index.php?name=online&file=index&route=".$route."";

if(!empty($_SESSION['admin_login'])){
?>

<div class="row">
   <div class="col-xs-12 connectedSortable">


	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
<?php require_once ("modules/index/footer.php"); ?>
<?php } else { echo "<meta http-equiv='refresh' content='1; url=index.php'>"; }?>


