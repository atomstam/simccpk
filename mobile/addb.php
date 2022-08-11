<!DOCTYPE html>
<html>
<head>
		<!-- bootstrap 3.0.2 -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- datetimepicker -->
		<link rel="stylesheet" href="../plugins/datetimepicker/css/bootstrap-datetimepicker.css">
		<!-- daterange picker -->
		<link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
        <!-- Bootstrap datePicker -->
        <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css" />
		<!-- Bootstrap time Picker -->
		<link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="../plugins/select2/select2.min.css">
        <!-- Theme style -->
        <link href="../dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
		<link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		<link href="../dist/css/base.css" rel="stylesheet" media="screen"/>
		<!-- jQuery 2.2.3 -->
		<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap -->
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js" ></script>
<style>
body{background-color:transparent;}
table {border-spacing: 8px 2px;}
td    {padding: 6px;}
</style>
</head>
<body>

<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../includes/config.php");
require_once("../includes/class.mysql.php");
$db = New DB();
$add='';
$edit='';
$del='';
//$Avatar='';
//$tdata=$_POST['tuser'];
//$tpass=md5($_POST['tpass']);
//echo $sdata;
$DateIn=date('Y-m-d');
$tdata=$_GET['tuser'];
empty($_GET['OP'])?$op="":$op=$_GET['OP'];
if($tdata){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
if($op=='detail'){
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">

<div class="row">
   <div class="col-xs-12 connectedSortable">
   <div class="box-body  ">

		<div align="right" ><div class="form-group"><a href="addb.php?tuser=<?php echo $tdata;?>" class="btn btn-warning" ><i class="fa fa-edit"></i>&nbsp;เพิ่มข้อมูลพฤติกรรมลบใหม่</a>
		</div></div>
<?php
$res['gd'] = $db->select_query("SELECT * FROM ".TB_BAD." where b_date like '%".$DateIn."%' order by bad_id desc limit 10 "); 
$row= @$db->rows($res['gd']);
if($row){
echo "<table id='example1' class='table table-bordered table-striped' cellspacing='1' cellpadding='1' width='100%'>";
while($arr['gd'] = $db->fetch($res['gd'])){
$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_id='".$arr['gd']['bad_stu']."' "); 
$arr['stu'] = $db->fetch($res['stu']);
$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." where class_id='".$arr['stu']['stu_class']."' "); 
$arr['cl'] = $db->fetch($res['cl']);
$res['bad'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." where badtail_id='".$arr['gd']['bad_tail']."' ");
$arr['bad'] = $db->fetch($res['bad']);
$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where  per_ids='".$arr['gd']['bad_dam']."' ");
$arr['per'] = $db->fetch($res['per']);


echo "<tr >";
echo "<td style='text-align: center; width:30%' width='30%'>";
echo "<div class='useravatar' ><img src='".WEB_URL_IMG_STU.$arr['stu']['stu_pic']."' style='width:80px;'></div>";
echo "</td><td width='70%' valign='top'>";
echo "ชื่อ - สกุล : <span class='badge bg-green'>".$arr['stu']['stu_num']."".$arr['stu']['stu_name']." ".$arr['stu']['stu_sur']."</span><br>";
echo "ชั้น : <span class='badge bg-yellow'>".$arr['cl']['class_name']."</span><br>";
echo "ประเภท : <span class='badge bg-purple'>".$arr['bad']['badtail_name']."</span><br>";
echo "รายละเอียด : <span class='badge bg-green'>".$arr['gd']['bad_name']."</span><br>";
echo "คะแนน : <span class='badge bg-yellow'>".$arr['bad']['badtail_point']."</span><br>";
echo "ผู้บันทึก : <span class='badge bg-red'>".$arr['per']['per_name']."</span><br>";
echo "วันที่ : <span class='badge bg-green'>".$arr['gd']['b_date']."</span><br>";
echo "</td></tr>";
}
echo "</table>";
} else {
echo "วันที่ ".$DateIn." ไม่มีข้อมูล";
}
?>
</div>
</div>
</div>

</div>
</div>
<?php
} else {
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">
<?php
//<form action="index.php?name=import&file=bad&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">
   <div class="box-body  ">

	  <div class="alert alert-success" name="thanks" id="thanks" style="display: none">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span>เพิ่มข้อมูลเรียบร้อย</span>
      </div>
      <div class="alert alert-danger" name="error" id="error" style="display: none">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span>ไม่สามารถเพิ่มข้อมูลได้</span>
      </div>

<script>
 $(function() {
//twitter bootstrap script
 $("button#submitForm").click(function(){
			$.ajax({
			type: "POST",
			url: "processbad.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#Respon").hide();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='addb.php?OP=detail&tuser=<?php echo $tdata;?>';
				}, 1000);
			} else {
//                $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $("#Respon").show();
				 $('#formAdd')[0].reset();
			}
	//		$("#form-content").modal('hide'); 
			},
			error: function(){
				alert("failure");
			}
			});
			});
});
</script>

<div id="Respon">

				<form method="post" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" >ชื่อนักเรียน : </label>
							<div class="col-sm-6">
							<select class="form-control select2" multiple="multiple" name="Bad_stu[]" >
							<?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." ORDER BY stu_id desc");
							while ($arr['stu'] = $db->fetch($res['stu'])){
							echo "<option value=\"".$arr['stu']['stu_id']."\"";
							echo ">".$arr['stu']['stu_num'].$arr['stu']['stu_name']." ".$arr['stu']['stu_sur']."</option>";
							}
							?>
							</select>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" >รายการพฤติกรรมลบ : </label>
							<div class="col-sm-6">
							<select class="form-control select3" multiple="multiple" name="Bad_tail[]" >
							<?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							$res['bad'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." ORDER BY badtail_id ");
							while ($arr['bad'] = $db->fetch($res['bad'])){
							echo "<option value=\"".$arr['bad']['badtail_id']."\"";
							echo ">".$arr['bad']['badtail_name']."</option>";
							}
							?>
							</select>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" >รายละเอียด :</label>
							<div class="col-sm-6">
							<input type='text' class="form-control" name="Bad_name" class="form-control css-require">
							</div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" >วัน เวลาที่กระทำ : </label>
							<div class="col-sm-3" >
							<?php $DateTimeStart=date('Y-m-d');?>
							<div class="input-group date" id="dp1" data-date="<?php echo $DateTimeStart;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control" name="Bad_YMD" class="form-control css-require">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" >ผู้ให้ข้อมูล : </label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="Bad_dam" >
								<option value="">เลือกรายการ</option>
							<?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." ORDER BY per_id ");
							while ($arr['per'] = $db->fetch($res['per'])){
							echo "<option value=\"".$arr['per']['per_ids']."\"";
							echo ">".$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" >การเสริมแรงทางลบ : </label>
							<div class="col-sm-3" >
							<select class="form-control  css-require" name="Bad_data" >
								<option value="">เลือกรายการ</option>
							<?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							$res['data'] = $db->select_query("SELECT * FROM ".TB_BADDATA." ORDER BY gdata_id ");
							while ($arr['data'] = $db->fetch($res['data'])){
							echo "<option value=\"".$arr['data']['gdata_id']."\"";
							echo ">".$arr['data']['gdata_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>


							<input type="hidden" name="OP"  value="Add"><input type="hidden" name="tuser"  value="<?php echo $tdata;?>">

</form>
		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>
		</div></div>
<br>
</div>
</div>
</div>
</div>


</div>
</div>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $(".select3").select2();
  });
</script>
<script type="text/javascript">
		$(function(){
			$('#dp1').datepicker();
			$('#dp2').datepicker();
			$('#dp3').datepicker();
         });
</script>
<?php
}


} else {
echo "คุณไม่มีสิทธิ์ใช้งานส่วนนี้";
}

?>
        <!-- jQuery UI 1.10.3 -->
        <script src="../plugins/jQueryUI/jquery-ui-1.10.3.min.js" type="text/javascript" ></script>
		<!-- Select2 -->
		<script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
		<!-- datetimepicker -->
		<script src="../plugins/moment.js/moment-with-locales.js"></script>
		<script src="../plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
		<!-- date-range-picker -->
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>-->
		<script src="../plugins/daterangepicker/daterangepicker.js"></script>
		<!-- date-picker -->
		<script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript" ></script>
		<!-- bootstrap time picker -->
		<script src="../plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript" ></script>
</body>
</html>