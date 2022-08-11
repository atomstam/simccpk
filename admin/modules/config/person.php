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

		@$res['user'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' and per_id='".$_GET['per_id']."' "); 
		 @$arr['user']= $db->fetch(@$res['user']);

		$del .=$db->del(TB_CLASS_PERSON," clper_area='".$_SESSION['admin_area']."' and clper_code='".$_SESSION['admin_school']."' and clper_tech='".@$arr['user']['per_ids']."' ");
		$del .=$db->del(TB_PERSON," per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' and per_id='".$_GET['per_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 

if($op=='delall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			@$res['user'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' and per_id='".$value."' "); 
			 @$arr['user']= $db->fetch(@$res['user']);

			$del .=$db->del(TB_CLASS_PERSON," clper_area='".$_SESSION['admin_area']."' and clper_code='".$_SESSION['admin_school']."' and clper_tech='".@$arr['user']['per_ids']."' ");

			$del .=$db->del(TB_PERSON," per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' and per_id='".$value."' ");

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
   <div class="col-xs-12 connectedSortable">
<?php
//<form action="index.php?name=config&file=person&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
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
                        url: 'modules/config/CheckuserPerson.php',
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
					/*different: {
						field: 'Password',
						message: 'ข้อมูลต้องไม่ตรงกับ Password'
					}*/
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
			url: "modules/config/processperson.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=config&file=person&route=<?php echo $route;?>';
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
			});
});
</script>

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=config&file=person&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
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

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_user_name; ?></label>
							<div class="col-sm-4"><input type="text" name="Firstname"  class="form-control"  placeholder="Cina" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_group; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" name="CAT" required="required">
							<option value="" selected disabled><?php echo _text_box_table_group_select;?></option>
							<?php
							
							@$res['category'] = $db->select_query("SELECT * FROM ".TB_PERSON_GROUP." ORDER BY group_id ");
							while (@$arr['category'] = $db->fetch(@$res['category'])){
							echo "<option value=\"".@$arr['category']['group_id']."\"";
							echo ">".@$arr['category']['group_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_class_id_group;; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" name="class_person">
							<option value="" >เลือกข้อมูล</option>
							<?php
							@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." ORDER BY class_id ");
							while (@$arr['cl'] = $db->fetch(@$res['cl'])){
							echo "<option value=\"".@$arr['cl']['class_id']."\"";
							echo ">".@$arr['cl']['class_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_class_name; ?></label>
							<div class="col-sm-2">
							<select class="form-control" name="class_name" >
							<option value="" >เลือกข้อมูล</option>
							<?php
							for($i=1;$i<=20;$i++){
							echo "<option value=\"".$i."\"" ;
							echo " >".$i."</option>";
							}
							?>
							</select>
							</div>
							</div>	
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_user_username; ?></label>
							<div class="col-sm-3"><input type="text" name="Username"  class="form-control css-require" placeholder="admin" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
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
							<div class="col-sm-4"><input type="email" name="Email"  class="form-control css-require" id="inputEmail" placeholder="Email" data-error="Bruh, that email address is invalid" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_tel; ?></label>
							<div class="col-sm-4"><input type="text" name="Tel"  class="form-control css-require" placeholder="0899469997" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
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
										uploadUrl: '../plugins/fileinput/upload_personicon.php',
										allowedFileExtensions: ['jpg', 'png', 'gif'],
										browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
										removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
										removeTitle: 'Cancel or reset changes',
										elErrorContainer: '#kv-avatar-errors-1',
										msgErrorClass: 'alert alert-block alert-danger',
										defaultPreviewContent: '<img src="../img/person/default_avatar_male.jpg" alt="Your Avatar" style="width:160px">',
										layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
										allowedFileExtensions: ["jpg", "png", "gif"]
									});
									     $("#avatar-1").on('fileloaded', function(event, file, previewId, index) {
									//     alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
										 $("#showFile").append('<input type=hidden name=Icon value='+file.name+'>');
									     });
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" >สถานะ</label>
							<div class="col-sm-3" >
							<input type="checkbox" name="Status"  id="Checked" class="check" value="1" >
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
//	clper_area	clper_code	clper_class	clper_group	clper_tech

@$res['user'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' and per_id='".$_GET['per_id']."' "); 
 @$arr['user']= $db->fetch(@$res['user']);
$img=@$arr['user']['per_pic'];

@$res['clg'] = $db->select_query("SELECT * FROM ".TB_CLASS_PERSON." where clper_area='".$_SESSION['admin_area']."' and clper_code='".$_SESSION['admin_school']."' and  clper_tech='".@$arr['user']['per_ids']."' ");
@$arr['clg'] = $db->fetch(@$res['clg']);

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
 $("button#submitForm").click(function(){
			$.ajax({
			type: "POST",
			url: "modules/config/processperson.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=config&file=person&route=<?php echo $route;?>';
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
			});

});
</script>

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=config&file=person&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
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

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_user_name; ?></label>
							<div class="col-sm-4"><input type="text" name="Firstname"  class="form-control"  value="<?php echo @$arr['user']['per_name'];?>" placeholder="Cina" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_group; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" name="CAT" required="required">
							<option value="" selected disabled><?php echo _text_box_table_group_select;?></option>
							<?php
							
							@$res['category'] = $db->select_query("SELECT * FROM ".TB_PERSON_GROUP." ORDER BY group_id ");
							while (@$arr['category'] = $db->fetch(@$res['category'])){
							echo "<option value=\"".@$arr['category']['group_id']."\"";
							if(@$arr['user']['per_posi']==@$arr['category']['group_id']){echo " selected ";}
							echo ">".@$arr['category']['group_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_class_id_group;; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" name="class_person" >
							<option value="" >เลือกข้อมูล</option>
							<?php

							@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." ORDER BY class_id ");
							while (@$arr['cl'] = $db->fetch(@$res['cl'])){
							echo "<option value=\"".@$arr['cl']['class_id']."\"";
							if(@$arr['clg']['clper_class']==@$arr['cl']['class_id']){echo " selected ";}
							echo ">".@$arr['cl']['class_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_class_name; ?></label>
							<div class="col-sm-2">
							<select class="form-control" name="class_name" >
							<option value="" >เลือกข้อมูล</option>
							<?php
							for($i=1;$i<=20;$i++){
//					if(@$arr['class']['clg_name']!=$i){
							echo "<option value=\"".$i."\"";
							if(@$arr['clg']['clper_group']==$i){echo " selected ";}
							echo ">".$i."</option>";
//							}
							}
							?>
							</select>
							</div>
							</div>	
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_user_username; ?></label>
							<div class="col-sm-3"><input type="text" name="Username"  value="<?php echo @$arr['user']['per_ids'];?>" class="form-control css-require" placeholder="admin" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_password; ?></label>
							<div class="col-sm-3"><input type="password" name="Password"  value="<?php echo @$arr['user']['per_pin'];?>" maxlength="15" data-minlength="4"  pattern="^[_A-z0-9]{1,}$" class="form-control" id="inputPassword" placeholder="Password" required ><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_password_con; ?></label>
							<div class="col-sm-3"><input type="password" name="Password_con"  class="form-control"  id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_email; ?></label>
							<div class="col-sm-4"><input type="email" name="Email"  value="<?php echo @$arr['user']['per_email'];?>" class="form-control css-require" id="inputEmail" placeholder="Email" data-error="Bruh, that email address is invalid" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_tel; ?></label>
							<div class="col-sm-4"><input type="text" name="Tel"  value="<?php echo @$arr['user']['per_tel'];?>" class="form-control css-require" placeholder="0899469997" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
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
										uploadUrl: '../plugins/fileinput/upload_personicon.php',
										allowedFileExtensions: ['jpg', 'png', 'gif'],
										browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
										removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
										removeTitle: 'Cancel or reset changes',
										elErrorContainer: '#kv-avatar-errors-1',
										msgErrorClass: 'alert alert-block alert-danger',
										defaultPreviewContent: '<img src="../img/person/default_avatar_male.jpg" alt="Your Avatar" style="width:160px">',
										layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
										allowedFileExtensions: ["jpg", "png", "gif"]
									});
									     $("#avatar-1").on('fileloaded', function(event, file, previewId, index) {
									//     alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
										 $("#showFile").append('<input type=hidden name=Icon value='+file.name+'>');
									     });
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" >สถานะ</label>
							<div class="col-sm-3" >
							<input type="checkbox" name="Status"  id="Checked" class="check" value="1" <?php if(@$arr['user']['status']==1) { echo "checked";}?> >
							</div>
							</div>
							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Edit"><input name="SID" type="hidden" value="<?php echo @$arr['user']['per_id'];?>">
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
} else {
?>
<div class="row">
<div class="col-xs-12 connectedSortable">
    <div class="tab-pane fade active in" >
    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=config&file=person&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a></div>
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
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' order by per_id"); 
		@$rows['num'] = $db->rows(@$res['num']);
		if(@$rows['num']) {
		?>
      <form action="index.php?name=config&file=person&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_user; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_name; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_posi; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_email;?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_tel;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['cat'] = $db->select_query("SELECT * FROM ".TB_PERSON_GROUP." WHERE group_id='".@$arr['num']['per_posi']."' "); 
		@$arr['cat'] = $db->fetch(@$res['cat']);
		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['num']['per_id']; ?>" class="selector flat"/></td>
              <td layout="block" style="text-align: right;"><?php echo @$arr['num']['per_ids']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['per_name'];?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['cat']['group_name']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['per_email']; ?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['num']['per_tel']; ?></td>
              <td style="text-align: center;">
			 <a href="#" data-toggle="modal" data-target="#myModal" class="btn bg-green btn-flat btn-sm" id="<?php echo @$arr['num']['per_id']; ?>"><i class="fa fa-search-plus "></i></a>
				<a href="index.php?name=config&file=person&op=edit&per_id=<?php echo @$arr['num']['per_id']; ?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=config&file=person&op=del&per_id=<?php echo @$arr['num']['per_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" data-confirm="<?php echo _text_box_con_delete_text;?>"><i class="fa fa-trash-o "></i></a>
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

	
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
				<div id="myModal" class="modal fade" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">X</button>
								  <h4 class="modal-title"><i class="fa fa-user"></i>&nbsp;<?php echo _heading_title;?></h4>
							</div>
<div class="modal-body">
</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
<script>
//jQuery Library Comes First
//Bootstrap Library
$(document).ready(function() { 
    $('.bg-green').click(function(e){//Modal Event
		e.preventDefault();
        var id = $(this).attr('id');
		$.ajax({
		type : 'get',
		url : 'modules/config/detailperson.php', //Here you should run query to fetch records
		data : 'per_id='+ id, //Here pass id via 
		success : function(data){            
          $('.modal-body').html(data); //Show Data
		//alert(data);
       }
    });
  });

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
                              /* 5 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
								"aoColumns": aoColumns,
								"responsive" : true,
								"dom" : 'lBfrtip',
								"buttons": [
									'copy', {"extend":'csv','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : '<?php echo _heading_title;?>'},,
									{"extend" : 'excel','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : '<?php echo _heading_title;?>'}, 
									{ // กำหนดพิเศษเฉพาะปุ่ม pdf
									"extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
									"exportOptions" : {
										columns: ':visible'
									},
									"text": 'PDF', // ข้อความที่แสดง
									"pageSize": 'A4',   // ขนาดหน้ากระดาษเป็น A4
									"filename" : '<?php echo _heading_title;?>',
									"title" : '<?php echo _heading_title;?>',
									"customize":function(doc){ // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
									// กำหนด style หลัก
										doc.defaultStyle = {
										font:'THSarabun',
										fontSize:16                                 
										};
										// กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ
////										doc.content[1].table.widths = [ 50, 'auto', '*', '*' ];
////										doc.styles.tableHeader.fontSize = 16; // กำหนดขนาด font ของ header
////										var rowCount = doc.content[1].table.body.length; // หาจำนวนแะวทั้งหมดในตาราง
										// วนลูปเพื่อกำหนดค่าแต่ละคอลัมน์ เช่นการจัดตำแหน่ง
////										for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
////											doc.content[1].table.body[i][0].alignment = 'center'; // คอลัมน์แรกเริ่มที่ 0
////											doc.content[1].table.body[i][1].alignment = 'center';
////											doc.content[1].table.body[i][2].alignment = 'left';
////											doc.content[1].table.body[i][3].alignment = 'right';
////										};                                  
////										console.log(doc); // เอาไว้ debug ดู doc object proptery เพื่ออ้างอิงเพิ่มเติม
									} // สิ้นสุดกำหนดพิเศษปุ่ม pdf
									},
									,{"extend" : 'print',"title" : '<?php echo _heading_title;?>'}
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

<?php } else { echo "<meta http-equiv='refresh' content='1; url=index.php'>"; }?>
