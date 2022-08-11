<?php CheckAdminGroup($_SESSION['admin_login'],$_SESSION['admin_pwd'],$_SESSION['admin_group']); ?>
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
<?php
if(!empty($_SESSION['admin_login'])){
$del='';
if($op=='del'){
		if($_GET['admin_id'] !=1){
		$del .=$db->del(TB_ADMIN," area_code ='".$_SESSION['admin_area']."' and school_code='".$_SESSION['admin_school']."'   and admin_id='".$_GET['admin_id']."' ");
		}

		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 

if($op=='delall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			
			if($value !=1){
			$del .=$db->del(TB_ADMIN," area_code ='".$_SESSION['admin_area']."' and school_code='".$_SESSION['admin_school']."'   and admin_id='".$value."' ");
			}
//			$db->closedb ();
		}
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
}
?>
<div class="col-xs-12">
      <?php if ($success) { ?>
      <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo $success; ?></span>
      </div>
      <?php } ?>
      <?php if ($error_warning) { ?>
      <div class="alert alert-danger" >
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo $error_warning; ?></span>
      </div>
      <?php } ?>
<?php
if($op=='add' and $action=='' ){
?>

      <div class="row">
        <div class="col-md-12">

<?php
//<form action="index.php?name=config&file=admin&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
?>

      <div class="alert alert-success" name="thanks" id="thanks" style="display: none">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_ok; ?></span>
      </div>
      <div class="alert alert-danger" name="error" id="error" style="display: none">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_fail; ?></span>
      </div>


<script>
 $(function() {
//twitter bootstrap script
$("#formAdd").bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
        live: 'enabled',
        message: 'This value is not valid',
        submitButtons: 'button[type="submitForm"]',
        trigger: null,
        fields: {
			CAT: {
				validators: {
					notEmpty: {
						message: 'กรุณาเลือกรายการ'
					}
				}
			},
			Firstname: {
				validators: {
					notEmpty: {
						message: 'กรุณากรอกข้อมูลด้วย'
					}
				}
			},
			Lastname: {
				validators: {
					notEmpty: {
						message: 'กรุณากรอกข้อมูลด้วย'
					}
				}
			},
           Username: {
				message: 'Username นี้มีผู้ใช้งานแล้ว',
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกข้อมูลด้วย'
                    },
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'ข้อมูลต้องมีจำนวน 4-20 ตัวอักษร'
                    },
                   remote: {
						message: 'Username นี้มีผู้ใช้งานแล้ว',
                        url: 'modules/config/CheckuserAdmin.php',
                        data: function(validator) {
                            return {
                                username : validator.getFieldElements('Username').val()
                            };
                        },
						type: 'POST',
						delay: 1000
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'ข้อมูลต้องเป็นตัวอักษร หรือตัวเลขเท่านั้น'
                    },
					different: {
						field: 'Password',
						message: 'ข้อมูลต้องไม่ตรงกับ Password'
					}
                }
            }, 
                'Password': {
                    validators: {
                        notEmpty: {
                            message: 'กรุณากรอกข้อมูล'
                        },
                        identical: {
                            field: 'Password_con',
                            message: 'ข้อมูลต้องตรงกับยืนยันรหัสผ่าน'
                        },
                        different: {
                            field: 'Username',
                            message: 'ข้อมูลต้องไม่ซ้ำกับ Username'
                        }
                    }
                },
                Password_con: {
                    validators: {
                        notEmpty: {
                            message: 'กรุณากรอกข้อมูล'
                        },
                        identical: {
                            field: 'Password',
                            message: 'ข้อมูลไม่ตรงกับ Password'
                        },
                        different: {
                            field: 'Username',
                            message: 'ข้อมูลต้องไม่ซ้ำกับ Username'
                        }
                    }
                },
                Email: {
					message: 'email นี้มีผู้ใช้งานแล้ว',
                    validators: {
                        notEmpty: {
                            message: 'กรุณากรอกข้อมูล'
                        },
						remote: {
							message: 'email นี้มีผู้ใช้งานแล้ว',
							url: 'modules/config/CheckemailAdmin.php',
							data: function(validator) {
								return {
									email: validator.getFieldElements('Email').val()
								};
							},
							type: 'POST',
							delay: 1000
						},
                        emailAddress: {
                            message: 'รูปแบบอีเมล์ไม่ถูกต้อง'
                        }
                    }
                },
                phone: {
                /*   phone: {
                            country: function() {
                                return form.querySelector('[name="Thailand"]').value;
                            },
                            message: 'รูปแบบเบอร์โทรไม่ถูกต้อง'
                        }
                    */
					validators: {
						notEmpty: {
							message: 'กรุณากรอกข้อมูลด้วย'
						},
                    /*stringLength: {
                        min: 8,
                        max: 10,
                        message: 'ข้อมูลต้องมีจำนวน 8-10 ตัวอักษร'
                    },*/
						regexp: {
							regexp: /^[0-9\.]+$/,
							message: 'ข้อมูลต้องเป็นตัวอักษร หรือตัวเลขเท่านั้น'
						}
					}
                },
        }
        }).on('error.form.bv', function(e) {
            console.log('error.form.bv');
            // You can get the form instance and then access API
            var $form = $(e.target);
            console.log($form.data('bootstrapValidator').getInvalidFields());
            // If you want to prevent the default handler (bootstrapValidator._onError(e))
            // e.preventDefault();
        })
        .on('success.form.bv', function(e) {
            console.log('success.form.bv');
            // If you want to prevent the default handler (bootstrapValidator._onSuccess(e))
            // e.preventDefault();
			e.preventDefault();
			$.ajax({
			type: "POST",
			url: "modules/config/processadmin.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=config&file=admin&route=<?php echo $route;?>';
				}, 1000);
			} else {
//                $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#formAdd')[0].reset();
			}
	//		$("#form-content").modal('hide'); 
			},
			error: function(){
				alert("failure");
			}
			});
        })
        .on('error.field.bv', function(e, data) {
            console.log('error.field.bv -->', data);
        })
        .on('success.field.bv', function(e, data) {
            console.log('success.field.bv -->', data);
        })
        .on('status.field.bv', function(e, data) {
            // I don't want to add has-success class to valid field container
            data.element.parents('.form-group').removeClass('has-success');
            // I want to enable the submit button all the time
            data.bv.disableSubmitButtons(false);
        });


 $("button#submitForm").click(function(){
            // Prevent submit form from page loading or refreshing
            //e.preventDefault();
			$('#formAdd').bootstrapValidator('validate');
			//$('#formAdd').bootstrapValidator('validate').on('success.form.bv', function() {
			//});
});

});
</script>


		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=config&file=admin&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>
				<form method="post" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-success" id="loading-example">
                                <div class="box-header with-border">
                                <i class="fa fa-user"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">

						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_group; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" name="CAT" required="required">
							<option value="" selected disabled><?php echo _text_box_table_group_select;?></option>
							<?php
							
							@$res['category'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." order by group_id ");
							while (@$arr['category'] = $db->fetch(@$res['category'])){
							echo "<option value=\"".@$arr['category']['group_id']."\"" ;
							echo ">".@$arr['category']['group_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_user_name; ?></label>
							<div class="col-sm-4"><input type="text" name="Firstname"  class="form-control"   placeholder="Cina" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_user_surname; ?></label>
							<div class="col-sm-4"><input type="text" name="Lastname"  class="form-control css-require" placeholder="Saffary" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_user_username; ?></label>
							<div class="col-sm-3"><input type="text" name="Username" id="Username"  class="form-control css-require " maxlength="20" data-minlength="4" data-bv-remote-name="Username" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_password; ?></label>
							<div class="col-sm-3"><input type="password" name="Password"  maxlength="15" data-minlength="4"  pattern="^[_A-z0-9]{1,}$" class="form-control" id="inputPassword" placeholder="Password" required ><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_password_con; ?></label>
							<div class="col-sm-3"><input type="password" name="Password_con"  class="form-control"  id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_email; ?></label>
							<div class="col-sm-4"><input type="email" name="Email"  class="form-control css-require" id="Email" data-bv-remote-name="Email" placeholder="Email" data-error="Bruh, that email address is invalid" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_user_img; ?></label>
							<div class="col-sm-3" >
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
										uploadUrl: '../plugins/fileinput/upload_adminicon.php',
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
										 $("#showFile").append('<input type=hidden name=Icon value='+responsedata+'>');
										});
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_status; ?></label>
							<div class="col-sm-3" >
							<input type="checkbox" name="Status"  id="Checked" class="check" value="1" data-error="Before you wreck yourself" >
							</div>
							</div>
							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Add">
							<br>
							</div>
							</div>

							</div>
						</div>

</form>
</div>
</div>
        <script type="text/javascript">
			$(document).ready(function ($) {
				$('input').iCheck({
					checkboxClass: 'icheckbox_minimal-red',
					radioClass: 'iradio_minimal-red'
				});

				$('input.all').on('ifToggled', function (event) {
					var chkToggle;
					$(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
					$('input.selector:not(.all)').iCheck(chkToggle);
				});

			});
        </script>
<?php
}else if($op=='edit' and $action==''){

@$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE area_code ='".$_SESSION['admin_area']."' and school_code='".$_SESSION['admin_school']."'  and admin_id='".$_GET['admin_id']."'"); 
 @$arr['user']= $db->fetch(@$res['user']);
$img=@$arr['user']['img'];
?>

      <div class="row">
        <div class="col-md-12">

      <div class="alert alert-success" name="thanks" id="thanks" style="display: none">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_ok; ?></span>
      </div>
      <div class="alert alert-danger" name="error" id="error" style="display: none">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo _text_report_add_fail; ?></span>
      </div>

<script>
 $(function() {
//twitter bootstrap script
$("#formEdit").bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
        live: 'enabled',
        message: 'This value is not valid',
        submitButtons: 'button[type="submitForm"]',
        trigger: null,
        fields: {
			CAT: {
				validators: {
					notEmpty: {
						message: 'กรุณาเลือกรายการ'
					}
				}
			},
			Firstname: {
				validators: {
					notEmpty: {
						message: 'กรุณากรอกข้อมูลด้วย'
					}
				}
			},
			Lastname: {
				validators: {
					notEmpty: {
						message: 'กรุณากรอกข้อมูลด้วย'
					}
				}
			},
       /*     Username: {
				message: 'Username นี้มีผู้ใช้งานแล้ว',
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกข้อมูลด้วย'
                    },
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'ข้อมูลต้องมีจำนวน 4-20 ตัวอักษร'
                    },
                   remote: {
						message: 'Username นี้มีผู้ใช้งานแล้ว',
                        url: 'modules/config/CheckuserAdmin.php',
                        data: function(validator) {
                            return {
                                username : validator.getFieldElements('Username').val()
                            };
                        },
						type: 'POST',
						delay: 1000
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'ข้อมูลต้องเป็นตัวอักษร หรือตัวเลขเท่านั้น'
                    },
					different: {
						field: 'Password',
						message: 'ข้อมูลต้องไม่ตรงกับ Password'
					}
                }
            }, 
                'Password': {
                    validators: {
                        notEmpty: {
                            message: 'กรุณากรอกข้อมูล'
                        },
                        identical: {
                            field: 'Password_con',
                            message: 'ข้อมูลต้องตรงกับยืนยันรหัสผ่าน'
                        },
                        different: {
                            field: 'Username',
                            message: 'ข้อมูลต้องไม่ซ้ำกับ Username'
                        }
                    }
                },
                Password_con: {
                    validators: {
                        notEmpty: {
                            message: 'กรุณากรอกข้อมูล'
                        },
                        identical: {
                            field: 'Password',
                            message: 'ข้อมูลไม่ตรงกับ Password'
                        },
                        different: {
                            field: 'Username',
                            message: 'ข้อมูลต้องไม่ซ้ำกับ Username'
                        }
                    }
                },*/
  /*              Email: {
					message: 'email นี้มีผู้ใช้งานแล้ว',
                    validators: {
                        notEmpty: {
                            message: 'กรุณากรอกข้อมูล'
                        },
						remote: {
							message: 'email นี้มีผู้ใช้งานแล้ว',
							url: 'modules/config/CheckemailAdmin.php',
							data: function(validator) {
								return {
									email: validator.getFieldElements('Email').val()
								};
							},
							type: 'POST',
							delay: 1000
						},
                        emailAddress: {
                            message: 'รูปแบบอีเมล์ไม่ถูกต้อง'
                        }
                    }
                }, */
                phone: {
                /*   phone: {
                            country: function() {
                                return form.querySelector('[name="Thailand"]').value;
                            },
                            message: 'รูปแบบเบอร์โทรไม่ถูกต้อง'
                        }
                    */
					validators: {
						notEmpty: {
							message: 'กรุณากรอกข้อมูลด้วย'
						},
                    /*stringLength: {
                        min: 8,
                        max: 10,
                        message: 'ข้อมูลต้องมีจำนวน 8-10 ตัวอักษร'
                    },*/
						regexp: {
							regexp: /^[0-9\.]+$/,
							message: 'ข้อมูลต้องเป็นตัวอักษร หรือตัวเลขเท่านั้น'
						}
					}
                },
        }
        }).on('error.form.bv', function(e) {
            console.log('error.form.bv');
            // You can get the form instance and then access API
            var $form = $(e.target);
            console.log($form.data('bootstrapValidator').getInvalidFields());
            // If you want to prevent the default handler (bootstrapValidator._onError(e))
            // e.preventDefault();
        })
        .on('success.form.bv', function(e) {
            console.log('success.form.bv');
            // If you want to prevent the default handler (bootstrapValidator._onSuccess(e))
            // e.preventDefault();
			e.preventDefault();
			$.ajax({
			type: "POST",
			url: "modules/config/processadmin.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=config&file=admin&route=<?php echo $route;?>';
				}, 1000);
			} else {
//                $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#formEdit')[0].reset();
			}
	//		$("#form-content").modal('hide'); 
			},
			error: function(){
				alert("failure");
			}
			});
        })
        .on('error.field.bv', function(e, data) {
            console.log('error.field.bv -->', data);
        })
        .on('success.field.bv', function(e, data) {
            console.log('success.field.bv -->', data);
        })
        .on('status.field.bv', function(e, data) {
            // I don't want to add has-success class to valid field container
            data.element.parents('.form-group').removeClass('has-success');
            // I want to enable the submit button all the time
            data.bv.disableSubmitButtons(false);
        });


 $("button#submitForm").click(function(){
            // Prevent submit form from page loading or refreshing
            //e.preventDefault();
			$('#formEdit').bootstrapValidator('validate');
			//$('#formAdd').bootstrapValidator('validate').on('success.form.bv', function() {
			//});
});

});
</script>

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=config&file=admin&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>
				<form method="post" enctype="multipart/form-data" id="formEdit" role="formEdit" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="fa fa-user"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">

						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_group; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" name="CAT" required="required">
							<option value="" selected disabled><?php echo _text_box_table_group_select;?></option>
							<?php
							
							@$res['category'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." order by group_id");
							while (@$arr['category'] = $db->fetch(@$res['category'])){
							echo "<option value=\"".@$arr['category']['group_id']."\"" ;
							if(@$arr['user']['admin_group_id']==@$arr['category']['group_id']){echo " selected ";}
							echo ">".@$arr['category']['group_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_user_name; ?></label>
							<div class="col-sm-4"><input type="text" name="Firstname"  class="form-control"  value="<?php echo  @$arr['user']['firstname'];?>" placeholder="Cina" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_user_surname; ?></label>
							<div class="col-sm-4"><input type="text" name="Lastname" value="<?php echo  @$arr['user']['lastname'];?>" class="form-control css-require" placeholder="Saffary" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_user_username; ?></label>
							<div class="col-sm-3"><input type="text" name="Username" id="Username"  value="<?php echo  @$arr['user']['username'];?>" class="form-control" maxlength="20" data-minlength="4" data-bv-remote-name="Username" readonly></div>
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_password; ?></label>
							<div class="col-sm-3"><input type="password" name="Password"  maxlength="15" data-minlength="4"  pattern="^[_A-z0-9]{1,}$" class="form-control" id="inputPassword" placeholder="Password" ><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_password_con; ?></label>
							<div class="col-sm-3"><input type="password" name="Password_con"  class="form-control"  id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_email; ?></label>
							<div class="col-sm-4"><input type="email" name="Email"  value="<?php echo  @$arr['user']['email'];?>" class="form-control " id="Email" data-bv-remote-name="Email" placeholder="Email" data-error="Bruh, that email address is invalid" readonly></div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_user_img; ?></label>
							<div class="col-sm-3" >
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
										uploadUrl: '../plugins/fileinput/upload_adminicon.php',
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
										 $("#showFile").append('<input type=hidden name=Icon value='+responsedata+'>');
										});
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_status; ?></label>
							<div class="col-sm-3" >
							<input type="checkbox" name="Status"  id="Checked" class="check" value="1" <?php if(@$arr['user']['status']==1) { echo "checked";}?> >
							</div>
							</div>
							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Edit"><input name="SID" type="hidden" value="<?php echo @$arr['user']['admin_id'];?>">
							<br>
							</div>
							</div>

							</div>
						</div>

</form>
</div>
</div>
        <script type="text/javascript">
			$(document).ready(function ($) {
				$('input').iCheck({
					checkboxClass: 'icheckbox_minimal-red',
					radioClass: 'iradio_minimal-red'
				});

				$('input.all').on('ifToggled', function (event) {
					var chkToggle;
					$(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
					$('input.selector:not(.all)').iCheck(chkToggle);
				});

			});
        </script>
<?php
} else if($op=='detail' and $action==''){

@$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE area_code ='".$_SESSION['admin_area']."' and school_code='".$_SESSION['admin_school']."' and admin_id='".$_GET['admin_id']."'"); 
 $row= $db->fetch(@$res['user']);
$img=WEB_URL_IMG_USER.@$arr['user']['img'];
$sqls = $db->select_query("select * from ".TB_ADMIN_ONLINE." where u_user='".$row['username']."' order by u_id desc limit 1"); 
@$results = $db->fetch($sqls);

?>
      <div class="row">
        <div class="col-xs-12 connectedSortable">
		<form method="post" enctype="multipart/form-data" class="form-horizontal bootstrap-validator-form" >
           <div class="col-md-5">
          <div class="box box-info" id="loading-example">
		  <div class="box-body  user user-menu">
          <div class="user-header bg-light-blue" style="text-align:center;">
		  	<div class="form-group">
			<div class="col-sm-12" >
			</div>
			</div>
									<?php if(!empty($row['img'])){?>
                                            <img src="<?php echo WEB_URL_IMG_ADMIN.$row['img']; ?>" class="img-circle" alt="User Image" />
                                     <?php } else {?>
                                            <img src="<?php echo WEB_URL_IMG_ADMIN."no_image.jpg";?>" class="img-circle" alt="User Image"/>
                                      <?php } ?>
                  <h4 style="text-align:center;"><?php echo $row['firstname']." ".$row['lastname']; ?></h4>
                  <h5 style="text-align:center;"><?php echo $row['email'];?></h5>
			<div class="form-group">
			<div class="col-sm-12" >
			</div>
			</div>
            </div><hr>
            <center><h3 class="box-title"><?php echo _text_box_header_gen;?></h3></center>
			<div class="form-group">
			<label class="col-sm-4" ><?php echo _text_box_table_name;?></label>
			<div class="col-md-8 col-sm-8 col-xs-8" >
			<span class="pull-right label-danger label"><?php echo $row['firstname']." ".$row['lastname']; ?></span>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-4" >Username</label>
			<div class="col-md-8 col-sm-8 col-xs-8" >
			<span class="pull-right label-info label"><?php echo  $row['username'];?></span>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-4" >Email</label>
			<div class="col-md-8 col-sm-8 col-xs-8" >
			<span class="pull-right label-success label"><?php echo $row['email'];?></span>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-4" ><?php echo _text_box_table_datetime_en;?></label>
			<div class="col-md-8 col-sm-8 col-xs-8" >
			<span class="pull-right label-primary label"><?php echo FullDateTimeThai($row['date_added'],"",1);?></span>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-4" ><?php echo _text_box_table_datetime_last;?></label>
			<div class="col-md-8 col-sm-8 col-xs-8" >
			<span class="pull-right label-info label"><?php if(@$results['u_timein']==''){ echo _text_box_table_user_neverlogin;} else { echo ThaiTimeConvert(@$results['u_timein'],"",2);}?></span>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-4" ><?php echo _text_box_table_count_login;?></label>
			<div class="col-md-8 col-sm-8 col-xs-8" >
			<span class="pull-right label-danger label"><?php echo getTotalAdmin('onlineusers','',$row['username']);?></span>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-4" ><?php echo _text_box_table_status; ?></label>
			<div class="col-md-8 col-sm-8 col-xs-8" >
			<span class="pull-right label-warning label"><?php if($row['status']==1) { echo _text_box_table_status_ok;} else {echo _text_box_table_status_no;}?></span>
			</div>
			</div>

          </div>
		  </div>
        </div>

              <div class="col-md-7">
   
            <div class="box box-warning" id="loading-example">
					<div class="box-body  ">
						     <div class="form-group has-feedback">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_table_group; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6" >
							<select  class="form-control css-require" name="CAT" required="required" disabled>
							<option value="" selected disabled><?php echo _text_box_table_group_select;?></option>
							<?php						
							@$res['category'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ");
							while (@$arr['category'] = $db->fetch(@$res['category'])){
							echo "<option value=\"".@$arr['category']['group_id']."\"" ;
							if($row['admin_group_id']==@$arr['category']['group_id']){echo " selected ";}
							echo ">".@$arr['category']['group_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_name; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6"><input type="text" name="Firstname"  class="form-control"  value="<?php echo  $row['firstname'];?>" placeholder="Cina" required  readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_surname; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6"><input type="text" name="Lastname" value="<?php echo  $row['lastname'];?>" class="form-control css-require" placeholder="Saffary" required  readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_username; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6"><input type="text" name="Username"  value="<?php echo  $row['username'];?>" class="form-control css-require" placeholder="admin" required readonly><span class="glyphicon form-control-feedback" aria-hidden="true" readonly></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_table_email; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6"><input type="email" name="Email"  value="<?php echo  $row['email'];?>" class="form-control css-require" id="inputEmail" placeholder="Email" data-error="Bruh, that email address is invalid" required readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_phone; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4" ><p class="form-control-static"><input type="text" name="phone" class="form-control"  value="<?php echo  $row['phone'];?>" readonly></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_fb; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6" ><p class="form-control-static"><input type="text" name="fb" class="form-control" value="<?php echo  $row['fb'];?>" readonly></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label col-sm-pad" ><?php echo _text_box_body_user_line; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6" ><p class="form-control-static"><input type="text" name="LineID" class="form-control" value="<?php echo  $row['LineID'];?>" readonly></p></div>
							</div>

					</div>
                

            </div>

        </div>
  
</form>

		</div>
		</div>
        <script type="text/javascript">
			$(document).ready(function ($) {
				$('input').iCheck({
					checkboxClass: 'icheckbox_minimal-red',
					radioClass: 'iradio_minimal-red'
				});

				$('input.all').on('ifToggled', function (event) {
					var chkToggle;
					$(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
					$('input.selector:not(.all)').iCheck(chkToggle);
				});

			});
        </script>
<?php
} else {
?>
      <div class="row">
        <div class="col-xs-12 connectedSortable">

    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=config&file=admin&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a></div>
      <br>
      </div>
    <div class="box box-danger">
      
	         <div class="box-header with-border">
                 <i class="fa fa-user"></i>
                 <h3 class="box-title"><?php echo _heading_title; ?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
	<div class="box-body ">
	  <?php
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_ADMIN." where area_code ='".$_SESSION['admin_area']."' and school_code='".$_SESSION['admin_school']."' order by admin_id desc"); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=config&file=admin&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector sub_chk flat all"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_user; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_group; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_email;?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_status;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['cat'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." WHERE group_id='".@$arr['num']['admin_group_id']."' "); 
		@$arr['cat'] = $db->fetch(@$res['cat']);
		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['admin_id']; ?>" class="selector flat"/></td>
              <td style="text-align: left;"><?php echo @$arr['num']['firstname']." ".@$arr['num']['lastname'] ; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['username'];?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['cat']['group_name']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['email']; ?></td>
              <td layout="block" style="text-align: center;">
			  <?php if(@$arr['num']['status']==1){echo _text_box_table_status_ok;} else {echo _text_box_table_status_no;} ?>
			  </td>
              <td style="text-align: center;">
				<a href="index.php?name=config&file=admin&op=detail&admin_id=<?php echo @$arr['num']['admin_id']; ?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm"><i class="fa fa-search-plus "></i></a>
				<?php //if($arr['num']['username']==$_SESSION['admin_login'] or $_SESSION['admin_role'] ==1){?>
				<a href="index.php?name=config&file=admin&op=edit&admin_id=<?php echo @$arr['num']['admin_id']; ?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=config&file=admin&op=del&admin_id=<?php echo @$arr['num']['admin_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>" ><i class="fa fa-trash-o "></i></a>
				<?php //} ?>
			  </td>
            </tr>
            <?php } ?>
          </tbody>
		  </table>
	      </form>

            <?php } else { ?>
			<table>
            <tr>
              <td class="center" colspan="7"><?php echo _text_no_results; ?></td>
            </tr>
			</table>
            <?php } ?>

    </div>
    </div>

	</div>
	<!-- /.col -->
</div>
<!-- /.row -->

<script>
//jQuery Library Comes First
//Bootstrap Library
$(document).ready(function() { 

	$('a[data-confirm]').click(function(ev) {
		var href = $(this).attr('href');
		if (!$('#dataConfirmModal').length) {
			$('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h4 id="dataConfirmLabel"><?=_text_box_con_delete_head;?></h4></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn bg-aqua btn-flat" id="dataConfirmOK">OK</a></div></div></div></div>');
		} 
		$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
		$('#dataConfirmOK').attr('href', href);
		$('#dataConfirmModal').modal({show:true});
		return false;
	});

});
</script>


        <script type="text/javascript">
        $(document).ready(function() {		
		pdfMake.fonts = {
			THSarabun: {
			normal: 'THSarabun.ttf',
			bold: 'THSarabun-Bold.ttf',
			italics: 'THSarabun-Italic.ttf',
			bolditalics: 'THSarabun-BoldItalic.ttf'
		}
		}
        var aoColumns = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 5 */ { "bSortable": false, 'aTargets': [ 0 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
								"aoColumns": aoColumns,
								"responsive" : true,
								"dom" : 'lBfrtip',
							  "pagingType": "full_numbers",
							  "language": {
								"sProcessing": "กำลังดำเนินการ...",
								"sLengthMenu": "แสดง_MENU_ แถว",
								"sZeroRecords": "ไม่พบข้อมูล",
								"sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
								"sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
								"sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
								"sInfoPostFix": "",
								"sSearch": "ค้นหา:",
								"sUrl": "",
								"oPaginate": {
								  "sFirst": "เริ่มต้น",
								  "sPrevious": "ก่อนหน้า",
								  "sNext": "ถัดไป",
								  "sLast": "สุดท้าย"
								  }
							  },
							  "buttons": [
								{"extend" : 'copy', text: 'คัดลอก'}, 
								{"extend":'csv','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : 'รายชื่อผู้เข้ารับการพัฒนา' , text: 'ไฟล์ CSV'},
								{"extend" : 'excel','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : 'รายชื่อผู้เข้ารับการพัฒนา', text: 'ไฟล์ Excel'}, 
								{ // กำหนดพิเศษเฉพาะปุ่ม pdf
								"extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
								"filename" : 'ข้อมูล', 
								"text" : 'ไฟล์ PDF',
								"pageSize": 'A4',   // ขนาดหน้ากระดาษเป็น A4            
								"customize":function(doc){ // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
								// กำหนด style หลัก
								  doc.defaultStyle = {
								  font:'THSarabun',
								  fontSize:16                                 
								  };
								} // สิ้นสุดกำหนดพิเศษปุ่ม pdf
								},
								,{"extend" : 'print',"title" : 'ข้อมูล' ,text: 'พิมพ์'},
							  ],
								'drawCallback': function(){
									$('input.flat[type="checkbox"]').iCheck({
										checkboxClass: 'icheckbox_minimal-red',
										radioClass: 'iradio_minimal-red'
									});
									$('input[name=toggle]').bootstrapToggle();
									$('input.all[type="checkbox"]').on('ifToggled', function (event) {
										var chkToggle;
										$(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
										$('input.selector:not(.all)').iCheck(chkToggle);
									});
								}
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
                              });

            });
        </script>

<?php
}
?>
</div>

<script type="text/javascript">
		$(function(){
			$('#dp1').datepicker();
			$('#dp2').datepicker();
			$('#dp3').datepicker();
         });
</script>


<?php } else { echo "<meta http-equiv='refresh' content='0; url=index.php'>"; }?>



