<?php
//header('Content-Type: application/json');
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysqli.php");
require_once("lang/add_admin.php");
require_once("../../../includes/function.in.php");
$db = New DB();
$res=array();
$res['errors']=array();
$res['success']=array();
$add='';
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//echo $_GET['group'];
if (!empty($_POST['group'])) {

$res2['user'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." where sch_id='".$_POST['group']."' and sctype='0' "); 
$rows['user'] = $db->fetch($res2['user']);

if($rows['user']){

$added=date("Y-m-d H:i:s");
$Url=$_POST['host'].".".$rows['user']['domain'];
		$add .=$db->update_db(TB_SCHOOL,array(
			"host"=>"".$_POST['host']."",
			"url"=>"".$Url."",
			"webmaster"=>"".$_POST['webmaster']."",
			"sch_add"=>"".$_POST['add']."",
			"sch_tam"=>"".$_POST['Sh_tambon']."",
			"sch_ampur"=>"".$_POST['Sh_amp']."",
			"sch_prov"=>"".$_POST['Sh_prov']."",			
			"sch_post"=>"".$_POST['post']."",
			"sch_tel"=>"".$_POST['phone']."",
			"sch_email"=>"".$_POST['email']."",
			"sctype"=>"1"
		)," sch_id='".$_POST['group']."' ");

		$add .=$db->update_db(TB_PRO_USER,array(
			"url"=>"".$Url."",
			"passwd"=>"".$rows['user']['pass']."",
			"webmaster"=>"".$_POST['group']."",
			"email"=>"".$_POST['email']."",
			"webdate"=>"".$added.""
		)," userName='".$_POST['group']."' ");

$res['reg'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sch_id='".$_POST['group']."' and sctype='1' "); 
$arr['reg'] = $db->fetch($res['reg']);
$school=$_POST['group'];
$url=$arr['reg']['sch_id'];
$usernamex=$arr['reg']['webmaster'];
$schoolx=$arr['reg']['scname'];
$urlx=$arr['reg']['url'];

$resx = Line_To_Reg($usernamex,$schoolx,$urlx);
print_r($resx);

$user=$arr['reg']['user'];
$pass=$arr['reg']['pass'];
$Uname=$arr['reg']['webmaster'];
$url=$arr['reg']['url'];

$subject_mail = ""._ADD_MAIL_SUB."" ; // หัวข้ออีเมล์ 

//----------------------------------------------------------------------- เนื้อหาของอีเมล์ //
$message_mail = ""._ADD_MAIL_BODY."<br>" ;
$message_mail .= ""._ADD_MAIL_BODY1." $Uname <br>" ;
$message_mail .= ""._ADD_MAIL_BODY21."$url <br>" ;
$message_mail .= ""._ADD_MAIL_BODY22."<br>" ;
$message_mail .= ""._ADD_MAIL_BODY23."<br>" ;
$message_mail .= ""._ADD_MAIL_BODY24."$user <br>" ;
$message_mail .= ""._ADD_MAIL_BODY25."$pass <br>" ;
//$message_mail .= "<tr><td><br><a href=".WEB_URL."/admin/index.php?name=admin&file=reset&op=confirm&id=".$user."&session=".$session.">"._ADD_MAIL_SEND_SESSION_RESET."";
$message_mail .= ""._ADD_MAIL_BODY5."<br>" ;
$message_mail .= ""._ADD_MAIL_BODY4."<br>" ;

//date_default_timezone_set('Asia/Bangkok');
require_once("../../../includes/phpmailler/class.phpmailer.php");
 $mail = new PHPMailer();
 //$mail->CharSet = "utf-8";
 $mail->IsSMTP();
 $mail->IsHTML(true);
 $mail->Host = "ssl://smtp.gmail.com"; // sets GMAIL as the SMTP server
 $mail->Port = 465; // set the SMTP port for the GMAIL server
// $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
 $mail->SMTPAuth = true;
 $mail->Username = WEB_EMAIL; // GMAIL username
 $mail->Password = WEB_EMAIL_PASS; // GMAIL password
 $mail->From = 'atom3123@gmail.com'; // "name@yourdomain.com";
 $mail->FromName = "Admin:ses26";  // set from Name
 $mail->CharSet = "UTF-8";
 $mail->Subject  = $subject_mail;
 $mail->Body     =  $message_mail;
 $mail->AltBody =  $message_mail;
  $mail->AddAddress($_POST['email'], "".$user.""); // to Address
  $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low
//	$mail->SMTPDebug = 1; 
  $mail->Send();

if($add){
		$responseArray = array('type' => 'success', 'data' => _text_report_register_ok);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
} else {
		$responseArray = array('type' => 'errors', 'data' => _text_report_add_fail);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
}

} else {
		$res1['user1'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." where sch_id='".$_POST['group']."' and sctype='1' "); 
		$arr['user1'] = $db->fetch($res1['user1']);
		$responseArray = array('type' => 'errors', 'data' => _text_report_add_fail." ".$arr['user1']['email']);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
}

//echo json_encode($res);
}

?>
