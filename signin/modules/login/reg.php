<!DOCTYPE html>
<html lang="<?php echo ISO; ?>">
<head>
<meta charset="UTF-8" />
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
		<link href="../signin/modules/login/css/style.css" rel="stylesheet" type="text/css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="../js/html5shiv.js"></script>
          <script src="../js/respond.min.js"></script>
        <![endif]-->
		<!--[if lt IE 8]>
		<p closeass="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="../http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<!-- jQuery 2.2.3 -->
		<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap -->
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js" ></script>

	<link rel="shortcut icon" href="../img/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../img/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="../img/ico/apple-touch-icon-57-precomposed.png">
<!-- Google Font -->
		<link href="../https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
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
<style type='text/css'>
.is_available{
	color:green;
}
.is_not_available{
	color:red;
}
</style>
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
//e.preventDefault();
$("#msform").submit(function(e) {
//	alert("sssssssssss");
          e.preventDefault();
//            var $form = $(e.target);
            // Get the BootstrapValidator instance
 //           var bv = $form.data('bootstrapValidator');
		  	$("#Wait").append('<div class="alert alert-warning"><strong>Wait..............</strong><div>');
			$("#Wait").show();
          $.ajax({
            type: "POST",
            url: "signin/modules/login/add_admin.php",
			cache: false,
            data: $('#msform').serialize(),
		    dataType: 'json',
			success: function(data) {
				if(data.type == "success"){
					$("#Wait").hide();
					$("#success").append('<div class="alert alert-success">'+ data.data +'<div>');
					$("#success").show();
					setTimeout(function() {
  					window.location='index.php';
					}, 5000);
				}
				if(data.type == "errors"){
          //  alert(data.data);
		  			$("#Wait").hide();
		  			$("#validation-errors").append('<div class="alert alert-danger"><strong>'+ data.data+'</strong><div>');
					$("#validation-errors").show();
					$('#formAdd')[0].reset();
				 }
			}

		 });

	  });
});	
</script>

<script type="text/javascript">
$(function(){
 $("select#province").change(function(){
  var datalist2 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist2
     url: "signin/modules/login/amphur.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data:"province_id="+$(this).val(), // ส่งตัวแปร GET ชื่อ province ให้มีค่าเท่ากับ ค่าของ province
     async: false
  }).responseText;  
  $("select#amphur").html(datalist2); // นำค่า datalist2 มาแสดงใน listbox ที่ 2 ที่ชื่อ amphur
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });
});
$(function(){
 $("select#amphur").change(function(){
  var datalist3 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist3
     url: "signin/modules/login/tambol.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data:"amphur_id="+$(this).val(), // ส่งตัวแปร GET ชื่อ amphur ให้มีค่าเท่ากับ ค่าของ amphur
     async: false
  }).responseText;  
  $("select#tambol").html(datalist3); // นำค่า datalist2 มาแสดงใน listbox ที่ 3 ที่ชื่อ tambol
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });
});
</script>

<script type="text/javascript">
$(document).ready(function() {

        //the min chars for username  
        var min_chars = 3;  
  
        //result texts  
        var characters_error = '<?php echo _text_This_value_length_3;?>';  
        var checking_html = 'Checking...';  

        //when button is clicked  
        $('#check_host_availability').click(function(){  
//		$('#username').keyup(function(){
            //run the character number check  
            if($('#host').val().length < min_chars){  
                //if it's bellow the minimum show characters_error text '  
                $('#host_availability_result').html(characters_error);  
            }else{  
                //else show the cheking_text and run the function to check  
                $('#host_availability_result').html(checking_html);  
                check_availability();  
            }  
        });    
});
//function to check username availability  
function check_availability(){  

        //get the username  
        var host = $('#host').val();  
  
        //use ajax to run the check  
        $.post("signin/modules/login/check_host.php", { host: host},  
            function(result){  
                //if the result is 1  
                if(result == 1){  
					$('#host_availability_result').html('<span class="is_available"><b>' +host + '.ses26.go.th</b> <?php echo _text_check_username_is_available;?></span>');
				}else{
					//show that the username is NOT available
					$('#host_availability_result').html('<span class="is_not_available"><b>' +host + '.ses26.go.th</b> <?php echo _text_check_username_is_not_available;?></span>');
                }  
        });  
}



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
	opacity: .20; 
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
<img src="../img/programmer.jpg" alt="Full Background" class="full-bg animation-pulseSlow">

<section id="wrapper" class="step-register">
  <div class="register-box">
    <div class="">
       <center><h4>ระบบลงทะเบียนใช้งานภายใต้โดเมน ses26.go.th</h4></center>
      <!-- multistep form -->
        <form id="msform" method="post" enctype="multipart/form-data" name="msform" role="Form" class="form-horizontal">
        <!-- progressbar -->
        <ul id="eliteregister">
        <li class="active"><?php echo _text_box_body_step1_header;?></li>
        <li><?php echo _text_box_body_step2_header;?></li>
        <li><?php echo _text_box_body_step3_header;?></li>
        </ul>
		<div id="Wait" ></div>
		<div id="validation-errors" ></div>
		<div id="success"></div>
        <!-- fieldsets -->
        <fieldset>
        <h2 class="fs-title"><?php echo _text_box_body_step1_header;?></h2>
        <h3 class="fs-subtitle">This is step 1</h3>
							<select  class="form-control" name="group" id="group" required>
							<option value="" selected disabled><?php echo _text_box_table_group_select;?></option>
							<?php
//							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." where sctype !='1' ORDER BY i_code ");
							while ($arr['sh'] = $db->fetch($res['sh'])){
							echo "<option value=\"".$arr['sh']['sch_id']."\"";
							echo ">[".$arr['sh']['sch_id']."] ".$arr['sh']['scname']."</option>";
							}
							?>
							</select>
							<input type="text" required placeholder="<?php echo _text_box_table_school_add;?>" name="add" id="add">
							<select name="Sh_prov" id="province" class="form-control css-require" required="required">
								<option value="0"><?php echo _text_box_table_school_prov_select;?></option>
								<?php 
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							$res['prov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." order by id"); 
							while ($arr['prov'] = $db->fetch($res['prov'])){?>
								<option value="<?php echo $arr['prov']['code'];?>" ><?php echo $arr['prov']['name'];?></option>
								<?php } ?>
							</select>
							<select name="Sh_amp" id="amphur" class="form-control css-require" required>
							<option value=""><?php echo _text_box_table_school_amp_select;?></option>
								<?php 
								$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
								$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where provinceID='".$arr['sh']['stu_prov']."' order by id"); 
								while ($arr['amp'] = $db->fetch($res['amp'])){?>
								<option value="<?php echo $arr['amp']['amphur_code'];?>" ><?php echo $arr['amp']['name'];?></option>
								<?php } ?>
							</select>
							<select name="Sh_tambon" id="tambol" class="form-control css-require" required>
								<option value=""><?php echo _text_box_table_school_tambon_select;?></option>
								<?php 
								$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
								$res['tam'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where amphurID='".$arr['sh']['stu_amp']."' order by id"); 
								while ($arr['tam'] = $db->fetch($res['tam'])){?>
								<option value="<?php echo $arr['tam']['tumbon_code'];?>" ><?php echo $arr['tam']['name'];?></option>
								<?php } ?>
							</select>
							<input type="text" required placeholder="<?php echo _text_box_table_school_post;?>" name="post" id="post">
        <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
        <h2 class="fs-title"><?php echo _text_box_body_step2_header;?></h2>
        <h3 class="fs-subtitle">This is step 2</h3>
        <input type="text" required placeholder="<?php echo _text_box_table_school_web;?>" name="webmaster" id="webmaster">
		<input type="text" required placeholder="example@gmail.com" name="email" id="email">
		<input type="text" required placeholder="Phone" name="phone" id="phone">
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
        <h2 class="fs-title"><?php echo _text_box_body_step3_header;?></h2>
        <h3 class="fs-subtitle">This is step 3</h3>
		<div class="form-group">
		<div class="input-group-lg">
        <input type="text" required placeholder="<?php echo _text_box_table_school_host;?>" name="host" id="host">
		<button type="button" class="action-button btn-warning" id='check_host_availability'><?php echo _text_check_username_button;?></button>
		</div>
		<div id='host_availability_result'></div>
		</div>
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
		<!-- validator -->
		<script type="text/javascript" src="../plugins/validator/bootstrapValidator.js"></script>
		<!--slimscroll JavaScript -->
		<script src="../js/jquery.slimscroll.js"></script>
		<!--Wave Effects -->
		<script src="../js/waves.js"></script>
		<!-- Custom Theme JavaScript -->
		<script src="../js/custom.js"></script>
</body>
</html>


