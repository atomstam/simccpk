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
		<!-- Select2 -->
		<link rel="stylesheet" href="../plugins/select2/select2.min.css">
        <!-- Theme style -->
        <link href="../dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
		<link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="../plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
		        <!-- iCheck for checkboxes and radio inputs -->
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../js/plugins/FileUpload/css/jquery.fileupload.css" type="text/css">
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

<link href="../plugins/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="../plugins/fileinput/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
<script src="../plugins/fileinput/js/plugins/sortable.js" type="text/javascript"></script>
<script src="../plugins/fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="../plugins/fileinput/js/locales/th.js" type="text/javascript"></script>
<script src="../plugins/fileinput/themes/explorer/theme.js" type="text/javascript"></script>
<style>
.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar .file-input {
    display: table-cell;
    max-width: 220px;
}
</style>

    <link rel="shortcut icon" href="<?php echo WEB_URL;?>/img/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo WEB_URL;?>/img/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo WEB_URL;?>/img/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo WEB_URL;?>/img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo WEB_URL;?>/img/ico/apple-touch-icon-57-precomposed.png">


</head>
  <body class="register-page">
<?php //require_once ("mainfile.php"); ?>

<style type='text/css'>
.is_available{
	color:green;
}
.is_not_available{
	color:red;
}
</style>
 	<div class="container ">
    <div class="row">

						     <div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-6" >
							</div>
							</div>

<div class="box box-info col-md-9 col-sm-9 col-xs-9">
<div class="register-box-body">

<script type="text/javascript">
$(document).ready(function() {
	$('#Form').bootstrapValidator({
        fields: {
            area_code: {
                validators: {
                    notEmpty: {
                        message: '<?php echo _text_This_value_is_null;?>'
                    }
                }
            },
            school: {
                validators: {
                    notEmpty: {
                        message: '<?php echo _text_This_value_is_null;?>'
                    }
                }
            },
            firstname: {
                validators: {
                    notEmpty: {
                        message: '<?php echo _text_This_value_is_null;?>'
                    }
                }
            },
            lastname: {
                validators: {
                    notEmpty: {
                        message: '<?php echo _text_This_value_is_null;?>'
                    }
                }
            },
            username: {
                validators: {
                    notEmpty: {
                        message: '<?php echo _text_This_value_is_null;?>'
                    },
					stringLength: {
                        min: 3,
                        max: 8,
                        message: '<?php echo _text_This_value_length_3_to_8;?>'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: '<?php echo _text_This_value_is_null;?>'
                    },
					stringLength: {
                        min: 3,
                        max: 8,
                        message: '<?php echo _text_This_value_length_3_to_8;?>'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: '<?php echo _text_This_value_is_null;?>'
                    },
                 regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: '<?php echo _text_This_value_is_not_value_email;?>'
                   }
                }
            }
		}
})
 

        .on('success.form.bv', function(e) {
 //         e.preventDefault();
          var valuesToSubmit = $(this).serialize();
          $.ajax({
            type: "POST",
            url: "modules/login/add_admin.php",
			cache: false,
            data: $('#Form').serialize(),
//            data: valuesToSubmit,
		    dataType: 'json',
			beforeSend: function() { 
					$("#validation-errors").hide().empty(); 
			},
		success: function(data) {
        console.log(data);
         if(data.type == "success"){
					$("#success").append('<div class="alert alert-success">'+ data.data +'<div>');
					$("#success").show();
					$("#FormRegis").hide();	
					setTimeout(function(){
//						$('#Form').modal('hide')
						window.location = "index.php";
//						window.location.reload(true);
					}, 1000);
         }
         if(data.type == "errors"){
          //  alert(data.data);
		  		$("#validation-errors").append('<div class="alert alert-danger"><strong>'+ data.data+'</strong><div>');
				$("#validation-errors").show();	
				setTimeout(function(){
//					$('#Form').modal('hide')
					window.location = "index.php";
//					window.location.reload(true);
				}, 5000);
         }

		}


         });
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
        $('#check_username_availability').click(function(){  
//		$('#username').keyup(function(){
            //run the character number check  
            if($('#username').val().length < min_chars){  
                //if it's bellow the minimum show characters_error text '  
                $('#username_availability_result').html(characters_error);  
            }else{  
                //else show the cheking_text and run the function to check  
                $('#username_availability_result').html(checking_html);  
                check_availability();  
            }  
        });  
  
  });  
//function to check username availability  
function check_availability(){  
  
        //get the username  
        var username = $('#username').val();  
  
        //use ajax to run the check  
        $.post("modules/login/check_username.php", { username: username },  
            function(result){  
                //if the result is 1  
                if(result == 1){  
					$('#username_availability_result').html('<span class="is_available"><b>' +username + '</b> <?php echo _text_check_username_is_available;?></span>');
				}else{
					//show that the username is NOT available
					$('#username_availability_result').html('<span class="is_not_available"><b>' +username + '</b> <?php echo _text_check_username_is_not_available;?></span>');
                }  
        });  
}

</script>
<script type="text/javascript">
$(document).ready(function() {
  
        //the min chars for username  
        var min_charss = 3;  
  
        //result texts  
        var characters_errors = '<?php echo _text_This_value_length_3;?>';  
        var checking_htmls = 'Checking...';  

        //when button is clicked  
        $('#check_email_availabilitys').click(function(){  
//		$('#username').keyup(function(){
            //run the character number check  
            if($('#email').val().length < min_charss){  
                //if it's bellow the minimum show characters_error text '  
                $('#email_availability_results').html(characters_errors);  
            }else{  
                //else show the cheking_text and run the function to check  
                $('#email_availability_results').html(checking_htmls);  
                check_availabilitys();  
            }  
        });  
  
  });  
//function to check username availability  
function check_availabilitys(){  
  
        //get the username  
        var email = $('#email').val();  
  
        //use ajax to run the check  
        $.post("modules/login/check_email.php", { email: email },  
            function(result){  
                //if the result is 1  
                if(result == 1){  
					$('#email_availability_results').html('<span class="is_available"><b>' +email + '</b> <?php echo _text_check_email_is_available;?></span>');
				}else{
					//show that the username is NOT available
					$('#email_availability_results').html('<span class="is_not_available"><b>' +email + '</b> <?php echo _text_check_email_is_not_available;?></span>');
                }  
        });  
}

</script>
<div id="validation-errors" ></div>
<div id="success"></div>
	<div id="FormRegis">
   <form method="post" enctype="multipart/form-data" id="Form" name="Form" role="Form" class="form-horizontal">

                                <div class="box-header ">
                                <i class="fa fa-user"></i>
                                    <h4 class="box-title"><?php echo _heading_title; ?> : <?php echo _heading_main_title;?></h4>
                                </div><!-- /.box-header -->
							<div class="box-body">
							      <div class="register-logo">
									<a href="index.php"><img src="../img/logo1.png" width="100"></a>
									</div>
						     <div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_gen_admingr; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6" >
							<select  class="form-control" name="admingr" id="admingr" required>
							<option value="" selected disabled><?php echo _form_select_list;?></option>
							<?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							$res['cate'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ORDER BY group_id ");
							while ($arr['cate'] = $db->fetch($res['cate'])){
							echo "<option value=\"".$arr['cate']['group_id']."\"";
							echo ">".$arr['cate']['group_name']."</option>";
							}
							?>
							</select>


							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_name; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6" ><p class="form-control-static"><input type="text" name="firstname" class="form-control"  required></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_surname; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6" ><p class="form-control-static"><input type="text" name="lastname" class="form-control"  required></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_username; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6" >
							<p class="form-control-static">
							<div class="input-group">
							<input type="text" name="username" id="username" class="form-control" >
							<span class="input-group-addon" id='check_username_availability'><?php echo _text_check_username_button;?></span>
							</div>
							<div id='username_availability_result'></div>
							</p>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" >password</label>
							<div class="col-md-4 col-sm-4 col-xs-4" ><p class="form-control-static"><input type="text" name="password" class="form-control" ></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_email; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6" >
							<p class="form-control-static">
							<div class="input-group">
							<input type="text" name="email" class="form-control" id='email'  placeholder="example@gmail.com">
							<span class="input-group-addon" id='check_email_availabilitys'><?php echo _text_check_email_button;?></span>
							</div>
							<div id='email_availability_results'></div>
							</p>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_phone; ?></label>
							<div class="col-md-2 col-sm-2 col-xs-2" ><p class="form-control-static"><input type="text" name="phone" class="form-control"  required></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_fb; ?></label>
							<div class="col-md-3 col-sm-3 col-xs-3" ><p class="form-control-static"><input type="text" name="fb" class="form-control" ></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_line; ?></label>
							<div class="col-md-3 col-sm-3 col-xs-3" ><p class="form-control-static"><input type="text" name="LineID" class="form-control" ></p></div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_img; ?></label>
							<div class="col-md-3 col-sm-3 col-xs-3" >
								<!-- the avatar markup -->
								<div id="kv-avatar-errors-1" class="center-block" style="width:300px;display:none"></div>
								<div id="showFile" ></div>
								<input id="avatar-1" name="avatar-1" type="file" class="file-loading">
								<!-- your server code `avatar_upload.php` will receive `$_FILES['avatar']` on form submission -->
								<script>
									var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
									'onclick="alert(\'Call your custom code here.\')">' +
									'<i class="glyphicon glyphicon-tag"></i>' +
									'</button>'; 
								$(document).ready(function () {
									$("#avatar-1").fileinput({
										overwriteInitial: true,
										maxFileSize: 1024,
										showClose: false,
										showCaption: false,
										browseLabel: '',
										removeLabel: '',
										uploadUrl: '../plugins/fileinput/upload_adminreg.php',
										allowedFileExtensions: ['jpg', 'png', 'gif'],
										browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
										removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
										removeTitle: 'Cancel or reset changes',
										elErrorContainer: '#kv-avatar-errors-1',
										msgErrorClass: 'alert alert-block alert-danger',
										defaultPreviewContent: '<img src="../img/admin/default_avatar_male.jpg" alt="Your Avatar" style="width:160px">',
										layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
										allowedFileExtensions: ["jpg", "png", "gif"]
									});
										$('#avatar-1').on('fileuploaded', function(event, data) {
										var formdata = data.form, files = data.files, 
												extradata = data.extra, responsedata = data.response;
	//											alert(responsedata)
												console.log('File batch upload success');
										 $("#showFile").append('<input type=hidden name=user_img value='+responsedata+'>');
										});
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>
							</div>
							</div>


							<div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" >&nbsp;</label>
							<div align="center" class="col-md-12 col-sm-12 col-xs-12">
							<p class="form-control-static">
							<br>
							<button type="submit" id="submit" name="submit" class="btn btn-primary"><?php echo _button_add;?></button>&nbsp;&nbsp;<a href="../index.php" class="btn bg-red btn-flat btn-sm"><?php echo _button_reset; ?></a>
							<br>
							</p>
							</div>
							</div>

							</div>
							<div class="form-group">
							<br>
							</div>
						</div><!-- box-body-->

		</form>

		</div>

</div>
</div>
</div>
	</div>


        <!-- jQuery UI 1.10.3 -->
        <script src="../plugins/jQueryUI/jquery-ui-1.10.3.min.js" type="text/javascript" ></script>
        <!-- InputMask -->
        <script src="../plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
		<!-- validator -->
		<script type="text/javascript" src="../plugins/validator/bootstrapValidator.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="../js/plugins/FileUpload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="../js/plugins/FileUpload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="../js/plugins/FileUpload/js/jquery.fileupload.js"></script>
</body>
</html>


