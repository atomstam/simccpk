<!DOCTYPE html>
<html lang="<?php echo ISO; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo _heading_main_title; ?></title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap datePicker -->
        <link href="css/datepicker/datepicker.css" rel="stylesheet"/>
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- Morris charts -->
		<link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <link href="css/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script type="text/javascript" src="js/jquery-ui-1.10.3.min.js" ></script>
<!--[if lt IE 8]>
<p closeass="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<SCRIPT language=JavaScript>
var message="Do not right click";// ข้อความที่ให้แสดงเมื่อคบิกขวา
///////////////////////////////////
function clickIE4(){
if (event.button==2){
alert(message);
return false;
}
}

function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("alert(message);return false")
</SCRIPT>
</head>
<body class="skin-blue">
<?php require_once ("mainfile.php"); ?>

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
    <div class="col-lg-12">
    <!-- small box -->
<?php


if($_POST){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." where email='".$_POST['email']."' and status='1' "); 
$arr['user'] = $db->fetch($res['user']);

if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['school']) && $_POST['username']!=$arr['user']['username']  && $_POST['email']!=$arr['user']['email'] ){
$added=date("Y-m-d H:i:s");

		$add =$db->add_db(TB_USER,array(
			"code"=>"".$_POST['school']."",
			"username"=>"".$_POST['username']."",
			"firstname"=>"".$_POST['firstname']."",
			"lastname"=>"".$_POST['lastname']."",
			"password"=>"".md5($_POST['password'])."",
			"email"=>"".$_POST['email']."",
			"status"=>"0",
			"date_added"=>"".$added."",
			"img"=>"".$_POST['user_img'].""
		));
		if($add){
		echo _text_report_register_ok;
		echo "<meta http-equiv='refresh' content='5; url=index.php'>";
		} else {
		echo _text_report_register_fail;
		echo "<meta http-equiv='refresh' content='5; url=index.php'>";
		}


} else {
	echo _text_report_register_null;
	echo "<meta http-equiv='refresh' content='2; url=index.php?name=user&file=register&route=user/register'>";
}

} else {
?>
	       <script type="text/javascript">
            $(document).ready(function() {	
             load('');
                function load(FileObj){ //function load()
                var fileData = FileObj;
                    $.get(
                        'js/plugins/uploadify/show_user.php?Obj='+fileData, //แสดงผลรูปที่เพิ่งอัพโหลดไปโดยผ่านไฟล์ show.php
                        {},
                        function(data){
                            $("#show").html(data); //ให้ไปแสดงผลที่ div id show
                            $("#showFile").append('<input type=hidden name=user_img value='+fileData+'>');
                        }
                    );		
                }

                $('#file_upload').uploadify({
                        'auto'     : true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
                        'swf'      : 'js/plugins/uploadify/images/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
                        'uploader' : 'js/plugins/uploadify/uploadify_user.php', //เมื่อ submit แล้วให้ action ไปที่ไฟล์ไหน
                        'fileSizeLimit' : '1024KB',//อัพโหลดได้ครั้งละไม่เกิน 1024kb
                        'fileTypeExts' : '*.gif; *.jpg; *.png', //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
                        'multi'    : false,//เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
 //                       'queueSizeLimit' : 5, //อัพโหลดได้ครั้งละ 5 ไฟล์
                        'displayData': 'speed',
                        'simUploadLimit': 1,
                        'onUploadComplete' : function(file) { //เมื่ออัพโหลดเสร็จแล้วให้เรียกใช้งาน function load()
 //                       $("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
                        load(file.name);
                        }
                });
            });
        </script>
   <form action="" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal">
					    <div class="box box-info" id="loading-example">
                                <div class="box-header">
                                <i class="fa fa-user"></i>
                                    <h4 class="box-title"><?php echo _heading_title; ?></h4>
                                </div><!-- /.box-header -->
                                <div class="box-body  ">
						     <div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_gen_school; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control" name="school" >
							<?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							$res['school'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." order by id"); 
							while ($arr['school'] = $db->fetch($res['school'])){
							echo 	"<option value=".$arr['school']['sh_code'].">&nbsp;".$arr['school']['sh_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_name; ?></label>
							<div class="col-sm-4" ><p class="form-control-static"><input type="text" name="firstname" class="form-control" value="<?php echo $arr['user']['firstname'];?>"></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_surname; ?></label>
							<div class="col-sm-4" ><p class="form-control-static"><input type="text" name="lastname" class="form-control" value="<?php echo $arr['user']['lastname'];?>"></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_username; ?></label>
							<div class="col-sm-2" ><p class="form-control-static"><input type="text" name="username" class="form-control" value="<?php echo $arr['user']['username'];?>"></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" >password</label>
							<div class="col-sm-2" ><p class="form-control-static"><input type="text" name="password" class="form-control" ></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_email; ?></label>
							<div class="col-sm-3" ><p class="form-control-static"><input type="text" name="email" class="form-control" value="<?php echo $arr['user']['email'];?>"></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_img; ?></label>
							<div class="col-sm-3" >
							<div id="queue" class="col-sm-3"></div>
							<input id="file_upload" name="file_upload" type="file" >
							<div id="showFile" ></div>
							<div id="show" ></div>
							</div>

							<div class="form-group">
							<div align="right" class="col-sm-8">
							<br>
							<button type="submit" name="submit" class="btn bg-aqua btn-flat"><?php echo _button_add;?></button>&nbsp;&nbsp;<a href="index.php" class="btn bg-red btn-flat btn-sm"><?php echo _button_reset; ?></a>
							<br>
							</div>
							</div>

							</div>
							<div class="form-group">
							<br>
							</div>

							</div>
						</div>
<?php } ?>
	</div>
	</div>
</section>
</body>
</html>
		<!-- uploadify -->
		<script src="js/plugins/uploadify/js/swfobject.js" type="text/javascript"></script>
		<script src="js/plugins/uploadify/js/jquery.uploadify-3.1.min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="js/plugins/uploadify/css/uploadify.css">
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#form').submit();
	}
});
//--></script> 
