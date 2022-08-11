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

if($_GET['op']!='confirm' && empty($_GET['op'])){
if($_POST['email']){

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user']=$db->select_query("SELECT * FROM ".TB_USER." where email='".$_POST['email']."' and status !='0' ");
$rows['user'] = @$db->rows($res['user']);

if($rows['user']){

$arr['user'] = $db->fetch($res['user']);
$user=$arr['user']['username'];
$Uname=$arr['user']['firstname']." ".$arr['user']['lastname'];
$Pass=mosMakePassword(4);
$session=session_id();
$ses_timein=date("Y-m-d H:i:s");
$subject_mail = ""._RESET_MAIL_SUB."" ; // หัวข้ออีเมล์ 

//----------------------------------------------------------------------- เนื้อหาของอีเมล์ //
$message_mail = ""._RESET_MAIL_BODY."" ;
$message_mail .= ""._RESET_MAIL_BODY1." $Uname" ;
$message_mail .= ""._RESET_MAIL_BODY2." $user" ;
$message_mail .= ""._RESET_MAIL_BODY3." $Pass" ;
$message_mail .= "<tr><td><br><a href=".WEB_URL."/index.php?name=user&file=reset&op=confirm&id=".$user."&session=".$session.">"._RESET_MAIL_SEND_SESSION_RESET."";
$message_mail .= ""._RESET_MAIL_BODY5."" ;


require_once("includes/phpmailler/class.phpmailer.php");
 $mail = new PHPMailer();
 $mail->CharSet = "utf-8";
 $mail->IsSMTP();
 $mail->IsHTML(true);
 $mail->Host = 'ssl://smtp.gmail.com';
 $mail->Port = 465;
 $mail->SMTPAuth = true;
 $mail->Username = 'atom3123@gmail.com'; //อีเมล์ของคุณ (Google App)
 $mail->Password = 'tomtam3123'; //รหัสผ่านอีเมล์ของคุณ (Google App)
 $mail->From = "".WEB_EMAIL.""; // ใครเป็นผู้ส่ง
 $mail->FromName = "ieponline"; // ชื่อผู้ส่งสักนิดครับ
 $mail->Subject  = $subject_mail;
 $mail->Body     =  $message_mail;
 $mail->AltBody =  $message_mail;
 $mail->AddAddress($_POST['email']); // ส่งไปที่ใครดีครับ
// $mail->Send(); 

if( $mail->send("".$_POST['email'].""))
{
		$db->add_db(TB_USER_RESET,array(
			"user"=>"".$user."",
			"password"=>"".$Pass."",
			"addtime"=>"".TIMESTAMP."",
			"email"=>"".$_POST['email']."",
			"ses_timein"=>"".$ses_timein."",
			"session"=>"".$session."",
			"confirm"=>"0"
		));
	    echo ""._RESET_MAIL_REPORT."";
		$success .="<meta http-equiv='refresh' content='1; url=index.php'>";
		echo $success;
} else {
		echo "Mailer Error: " . $_POST['email']->ErrorInfo;
}
} else {
	    echo ""._text_reset_user_fail."";
		$fail .="<meta http-equiv='refresh' content='3; url=index.php'>";
		echo $fail;
}
} else {
?>
   <form action="" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal">
					    <div class="box box-info" id="loading-example">
                                <div class="box-header">
                                <i class="fa fa-key"></i>
                                    <h4 class="box-title"><?php echo _heading_title; ?></h4>
                                </div><!-- /.box-header -->
                                <div class="box-body  ">
							<div class="form-group">
							<label class="col-sm-5 control-label" ><?php echo _text_input_email; ?></label>
							<div class="col-sm-3" >
							<p class="form-control-static"><input type="text" name="email"  class="form-control">
							</p>
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
<?php } else { 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user']=$db->select_query("SELECT * FROM ".TB_USER_RESET." where session='".$_GET['session']."' and user='".$_GET['id']."' ");
$rows['user'] = @$db->rows($res['user']);
if($rows['user']){
$arr['user'] = $db->fetch($res['user']);
$ok= $db->update_db(TB_USER,array(
		"password"=>"".md5($arr['user']['password']).""
		)," email='".$arr['user']['email']."' ");
$ok .= $db->update_db(TB_USER_RESET,array(
		"confirm"=>"1"
		)," email='".$arr['user']['email']."' ");
$Success =_RESET_MAIL_REPORT_OK;
}

if($ok){
$Success =_RESET_MAIL_REPORT_OK;
$Success .="<meta http-equiv='refresh' content='1; url=index.php'>";
echo $Success;
} else {
$error =_RESET_MAIL_REPORT_NOTOK;
$error .="<meta http-equiv='refresh' content='1; url=index.php'>";
echo $error;
}


}
?>
	</div>
	</div>
</section>
</body>
</html>

<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#form').submit();
	}
});
//--></script> 
