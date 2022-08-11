<!DOCTYPE html>
<html lang="<?php echo ISO; ?>">
<head>
<meta charset="UTF-8" />
<link rel="shortcut icon" href="../img/ico/favicon.ico">
<link rel="apple-touch-icon" sizes="57x57" href="../img/ico/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../img/ico/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../img/ico/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../img/ico/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../img/ico/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../img/ico/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../img/ico/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../img/ico/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../img/ico/apple-icon-180x180.png">

<link rel="icon" type="image/png" sizes="192x192"  href="../img/ico/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="96x96" href="../img/ico/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="32x32" href="../img/ico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../img/ico/favicon-16x16.png">

<title><?php echo _heading_main_title; ?></title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<meta name="google-site-verification" content="rNeG97r4cjn6sTuo956j0EuR6f6SHAqQB2kgZaKf5OU" />

        <!-- bootstrap 3.0.2 -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- validator -->
		<link rel="stylesheet" href="../plugins/validator/bootstrapValidator.css"/>
		<!-- animation CSS -->
		<link href="modules/login/css/animate.css" rel="stylesheet">
		<!-- Wizard CSS -->
		<link href="../plugins/register-steps/steps.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="modules/login/css/style.css" rel="stylesheet" type="text/css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
		<!--[if lt IE 8]>
		<p closeass="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<!-- jQuery 2.2.3 -->
		<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap -->
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js" ></script>

<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
		<style>
      body {
        font-family: 'Prompt', sans-serif;     
      }

	  h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
        font-family: 'Prompt', sans-serif;     
      }
	

    </style>
<script>
var isNS = (navigator.appName == "Netscape") ? 1 : 0;

if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);

function mischandler(){
return false;
}

function mousehandler(e){
var myevent = (isNS) ? e : event;
var eventbutton = (isNS) ? myevent.which : myevent.button;
if((eventbutton==2)||(eventbutton==3)) return false;
}
document.oncontextmenu = mischandler;
document.onmousedown = mousehandler;
document.onmouseup = mousehandler;

</script>
</head>
  <body >
<?php 
//require_once ("mainfile.php"); 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
?>
<style type='text/css'>
.is_available{
	color:green;
}
.is_not_available{
	color:red;
}
</style>
<script type="text/javascript">
$(document).ready(function() {

 //$("button#submitForm").click(function(e){
 //         e.preventDefault();
$("#msform").submit(function(e) {
		  	$("#Wait").append('<div class="alert alert-warning"><strong>Wait..............</strong><div>');
			$("#Wait").show();
          e.preventDefault();
//            var $form = $(e.target);
            // Get the BootstrapValidator instance
 //           var bv = $form.data('bootstrapValidator');
          $.ajax({
            type: "POST",
            url: "modules/login/add_admin.php",
			cache: false,
            data: $('#msform').serialize(),
//            data: valuesToSubmit,
		    dataType: 'json',
			beforeSend: function() { 
					$("#validation-errors").hide().empty(); 
			},
		success: function(data) {
        console.log(data);
         if(data.type == "success"){
			 		$("#Wait").hide();
					$("#success").append('<div class="alert alert-success">'+ data.data +'<div>');
					$("#success").show();
					$("#FormRegis").hide();	
					setTimeout(function(){
						window.location = "../admin/index.php";
//						window.location.reload(true);
					}, 3000);
         }
         if(data.type == "errors"){
          //  alert(data.data);
			 		$("#Wait").hide();
		  		$("#validation-errors").append('<div class="alert alert-danger"><strong>'+ data.data+'</strong><div>');
				$("#validation-errors").show();
				$("#FormRegis").hide();
				setTimeout(function(){
//					$('#Form').modal('hide')
					window.location = "index.php";
//					window.location.reload(true);
				}, 3000);
         }

		}


         });
      });


});	
</script>
<script>
$(document).ready(function(){

$("#Email").change(function(){
	//var flag;
		$.ajax({
			url: "modules/login/check_email.php",
			data: "email=" + $("#Email").val(),
			type: "POST",
			dataType: 'json',
			async:false,
			success: function(data) { 
			if(data==0){
				$("#msg2").html("<span style='color:red'>Email นี้มีผู้ใช้งานแล้วครับ</span>");
				$("#Email").val('');
			} else {
				$("#msg2").html("<span style='color:green'>Email นี้ใช้ได้ครับ</span>");
			}
			},
		});
		//return flag;
	});


$("#username").change(function(){
	//var flag;
		$.ajax({
			url: "modules/login/check_username.php",
			data: "username=" + $("#username").val(),
			type: "POST",
			async:false,
			success: function(datax) { 
			if(datax==0){
				$("#msg1").html("<span style='color:red'>ชื่อผู้ใช้งานนี้ไม่ว่างครับ</span>");
				$("#username").val('');
			} else {
				$("#msg1").html("<span style='color:green'>ชื่อผู้ใช้งานใช้ได้ครับ</span>");
			}
			},
		});
		//return flag;
	});


//	$("select#area").html(Val); 
});
</script>

<style>
/* Full Background Image */
img.full-bg {
    min-height: 100%;
    min-width: 1024px;
    width: 100%;
    height: auto;
    position: fixed;
    top: 0;
    left: 0;
/*	opacity: .60;  */
}

img.full-bg.full-bg-bottom {
    top: auto;
    bottom: 0;
}

@media screen and (max-width: 1024px) {
    img.full-bg {
        left: 50%;
        margin-left: -640px;
    }
}
</style>
<img src="../img/bg.jpg" alt="Full Background" class="full-bg animation-pulseSlow">
<section id="wrapper" class="step-register">
  <div class="register-box">
    <div class="">
       <a href="javascript:void(0)" class="text-center db m-b-40"><img src="../img/logo-white.png"  alt="Home" width="40%" class="logo"/></a>
      <!-- multistep form -->
        <form id="msform" method="post" enctype="multipart/form-data" name="msform" role="Form" class="form-horizontal" >
        <!-- progressbar -->
        <ul id="eliteregister">
        <li class="active">เงื่อนไข</li>
        <li><?php echo _text_box_body_step2_header;?></li>
        <li>กำหนดผู้ใช้งาน</li>
        </ul>
		<div id="Wait" ></div>
		<div id="validation-errors" ></div>
		<div id="success"></div>
		<div id="FormRegis"><div>
        <!-- fieldsets -->
        <fieldset>
		<div class="alert alert-warning">เงื่อนไขการขอเปิดบริการใช้งานระบบ</div>
			<div>
			<p class="text-term">1. การสมัครสมาชิกเพื่อใช้บริการ SIMS นั้น มีค่าใช้จ่าย</p>
			<p class="text-term">2. ผู้ใช้บริการ จะต้องกรอกข้อมูลรายละเอียดต่าง ๆ ตามจริงให้ครบถ้วน ทั้งนี้เพื่อประโยชน์ของผู้ใช้บริการ กรณีตรวจพบว่าข้อมูลดังกล่าวไม่เป็นความจริง ผู้ให้บริการจะระงับการใช้งานของผู้ใช้บริการโดยไม่ต้องแจ้งให้ทราบล่วงหน้า</p> 
			<p class="text-term">3.ผู้ใช้บริการยินยอมให้ผู้ให้บริการแก้ไข เปลี่ยนแปลง หรือยกเลิกข้อตกลงและเงื่อนไขการสมัครขอรับชื่อผู้ใช้และรหัสผ่าน (Username &Password) ได้ ตามที่ผู้ให้บริการได้พิจารณาแล้วเห็นสมควร </p>
			</div>
          <div >
            <label>
              <input type="checkbox" name="Checked"  id="Checked" class="check" value="1" > 												 ข้าพเจ้ายอมรับ
            </label>
          </div>

        <input type="button" name="Next1" class="next action-button" value="Next" id="Next1"/>
        </fieldset>
        <fieldset>
        <h2 class="fs-title"><?php echo _text_box_body_step2_header;?></h2>
							<select  class="form-control css-require " name="school_code" id="school_codes" required>
							<?php
							$res['school'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." order by sh_id");
							?>
							<option value=""><?php echo _form_select_school;?></option>
							<?php while ($arr['school'] = $db->fetch($res['school'])){?>
							<option value="<?php echo $arr['school']['sh_code'];?>">[<?php echo $arr['school']['sh_code'];?>] <?php echo $arr['school']['sh_name'];?></option>
							<?php } ?>
							</select>
        <input type="text" required placeholder="เลขประชาชน" name="num" id="num">
        <input type="text" required placeholder="ชื่อ" name="firstname" id="firstname">
        <input type="text" required placeholder="นามสกุล" name="lastname" id="lastname">
		<input type="text" required placeholder="เบอร์โทรศัพท์" name="phone" id="phone">
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
		</fieldset>
        <fieldset>
        <h2 class="fs-title">กำหนด user&pass</h2>
		<input type="text" required placeholder="example@gmail.com" name="email" id="Email">
		<span id="msg2"></span>
		<input type="text" required  placeholder="Username(ภาษาอังกฤษหรือตัวเลขอย่างน้อย 6 ตัว)" name="username" id="username">
		<span id="msg1"></span>
        <input type="password" required placeholder="Password(ภาษาอังกฤษหรือตัวเลขอย่างน้อย 6 ตัว)" name="password">
		<input type="hidden" name="area_code" id="area_code" value="101726">
        <input type="button" name="previous" class="previous action-button" value="Previous" />
		<button class="submit action-button" type="submit" id="submitForm" name="submitForm" value="Submit">Submit</button>
        </fieldset>
        </form>

        <div class="clear"></div>
    </div>
  </div>
</section>



        <!-- jQuery UI 1.10.3 -->
        <script src="../plugins/jQueryUI/jquery-ui-1.10.3.min.js" type="text/javascript" ></script>
        <!-- InputMask -->
        <script src="../plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
		<script src="../plugins/register-steps/jquery.easing.min.js"></script>
		<script src="../plugins/register-steps/register-init.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
		<!-- validator -->
		<script src="../plugins/validator/validator.js" type="text/javascript" ></script>
		<!--slimscroll JavaScript -->
		<script src="../js/jquery.slimscroll.js"></script>
		<!--Wave Effects -->
		<script src="../js/waves.js"></script>
		<!-- Custom Theme JavaScript -->
		<script src="../js/custom.js"></script>
		<!--Style Switcher -->
		<script src="../plugins/styleswitcher/jQuery.style.switcher.js"></script>
        <script type="text/javascript">
			$(document).ready(function ($) {
				$('#Next1').prop("disabled", true);
				$('input').iCheck({
					checkboxClass: 'icheckbox_minimal-red',
					radioClass: 'iradio_minimal-red'
				}).on('ifChecked', function(event) {
						$('#Next1').prop("disabled", false);
				}).on('ifUnchecked', function (event) {
						$('#Next1').prop("disabled", true);
				});
//			$(".alert").delay(5000).slideUp(200, function() {
//			$(this).alert('close');
//			});
			});

        </script>
</body>
</html>


