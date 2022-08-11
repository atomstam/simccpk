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
    max-width: 320px;
}
</style>

<?php
if(!empty($_SESSION['admin_login'])){
$del='';
if($op=='newsdel'){
		
		$del .=$db->del(TB_NEWS," news_id='".$_GET['news_id']."' ");
		$del .=$db->del(TB_NEWS_COM," news_id='".$_GET['news_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 

if($op=='newsdelall'){
		
		while(list($key, $value) = each ($_POST['selected'])){
			
			$del .=$db->del(TB_NEWS," news_id='".$value."' ");
			$del .=$db->del(TB_NEWS_COM," news_id='".$value."' ");

//			$db->closedb ();
		}
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
}
if($op=='catedel'){
		
		@$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." where category='".$_GET['cate_id']."' "); 
		while(@$arr['news'] = $db->fetch(@$res['news'])){
		$del .=$db->del(TB_NEWS_COM," news_id='".@$arr['news']['news_id']."' ");
		}
		$del .=$db->del(TB_NEWS," category='".$_GET['cate_id']."' ");
		$del .=$db->del(TB_NEWS_CATE," cate_id='".$_GET['cate_id']."' ");
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 

if($op=='catedelall'){
		
		while(list($key, $value) = each ($_POST['selecteds'])){
		@$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." where category='".$value."' "); 
		while(@$arr['news'] = $db->fetch(@$res['news'])){
		$del .=$db->del(TB_NEWS_COM," news_id='".@$arr['news']['news_id']."' ");
		}
		$del .=$db->del(TB_NEWS," category='".$value."' ");
		$del .=$db->del(TB_NEWS_CATE," cate_id='".$value."' ");
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
	if($op=='cateadd' ){
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
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
			$.ajax({
			type: "POST",
			url: "modules/content/processnews.php",
			data: $('#formCateAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=content&file=news&route=<?php echo $route;?>';
				}, 1000);
			} else {
//                $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#formCateAdd')[0].reset();
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

    <div class="row">
      <div class="col-xs-12 connectedSortable">

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=content&file=news&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>

				<form method="post" enctype="multipart/form-data" id="formCateAdd" role="formCateAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-success" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-th"></i>
                                    <h3 class="box-title"><?php echo _heading_title_news_cate; ?></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_category_name; ?></label>
							<div class="col-sm-6"><input type="text" name="Topic"  class="form-control"  placeholder="m1" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>

							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_category_pic; ?></label>
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
										uploadUrl: '../plugins/fileinput/upload_newsicon.php',
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
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="CateAdd">
							<br>
							</div>
							</div>

							</div>
						</div>

</form>

		</div>
	</div>
<script>
  $(function () {
    CKEDITOR.replace('editor1',{
    //bootstrap WYSIHTML5 - text editor
	allowedContent: true,
	//config.extraPlugins = 'imageuploader';
	//editor.config.filebrowserBrowseUrl = '../plugins/ckeditor/plugins/imageuploader/imgbrowser.php';
	});
	$(".textarea").wysihtml5();
  });
</script>
<?php
} else if($op=='cateedit' ){
		
		@$res['cate'] = $db->select_query("SELECT * FROM ".TB_NEWS_CATE." where cate_id='".$_GET['cate_id']."' "); 
		@$arr['cate'] = $db->fetch(@$res['cate']);
		$Pic=WEB_URL."/img/news/".@$arr['cate']['icon'];
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
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
			$.ajax({
			type: "POST",
			url: "modules/content/processnews.php",
			data: $('#formCateEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=content&file=news&route=<?php echo $route;?>';
				}, 1000);
			} else {
//                $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#formCateEdit')[0].reset();
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

    <div class="row">
      <div class="col-xs-12 connectedSortable">

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=content&file=news&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>

				<form method="post" enctype="multipart/form-data" id="formCateEdit" role="formCateEdit" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-success" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-th"></i>
                                    <h3 class="box-title"><?php echo _heading_title_news_cate; ?></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_category_name; ?></label>
							<div class="col-sm-6"><input type="text" name="Topic"  class="form-control"  placeholder="m1" required value="<?php echo @$arr['cate']['category_name'];?>"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>

							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_category_pic; ?></label>
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
										uploadUrl: '../plugins/fileinput/upload_newsicon.php',
										allowedFileExtensions: ['jpg', 'png', 'gif'],
										browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
										removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
										removeTitle: 'Cancel or reset changes',
										elErrorContainer: '#kv-avatar-errors-1',
										msgErrorClass: 'alert alert-block alert-danger',
										defaultPreviewContent: '<img src="<?php echo $Pic;?>" alt="Your Avatar" style="width:160px">',
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
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="CateEdit"><input type="hidden" name="CATEID"  value="<?php echo $_GET['cate_id'];?>">
							<br>
							</div>
							</div>

							</div>
						</div>

</form>

		</div>
	</div>
<script>
  $(function () {
    CKEDITOR.replace('editor1',{
    //bootstrap WYSIHTML5 - text editor
	allowedContent: true,
	//config.extraPlugins = 'imageuploader';
	//editor.config.filebrowserBrowseUrl = '../plugins/ckeditor/plugins/imageuploader/imgbrowser.php';
	});
	$(".textarea").wysihtml5();
  });
</script>
<?php
} else if($op=='newsadd' ){
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
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
			$.ajax({
			type: "POST",
			url: "modules/content/processnews.php",
			data: $('#formNewsAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=content&file=news&route=<?php echo $route;?>';
				}, 1000);
			} else {
//                $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#formNewsAdd')[0].reset();
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

    <div class="row">
      <div class="col-xs-12 connectedSortable">

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=content&file=news&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>

				<form method="post" enctype="multipart/form-data" id="formNewsAdd" role="formNewsAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-success" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-th"></i>
                                    <h3 class="box-title"><?php echo _heading_title_news; ?></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_topic; ?></label>
							<div class="col-sm-6"><input type="text" name="Topic"  class="form-control"  placeholder="m1" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>

						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_category; ?></label>
							<div class="col-sm-4" >
							<select class="form-control" name="CAT" >
							<?php
							
							@$res['cate'] = $db->select_query("SELECT * FROM ".TB_NEWS_CATE." ORDER BY cate_id ");
							while (@$arr['cate'] = $db->fetch(@$res['cate'])){
							echo "<option value=\"".@$arr['cate']['cate_id']."\"";
							echo ">".@$arr['cate']['category_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>

							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_img; ?></label>
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
										uploadUrl: '../plugins/fileinput/upload_newsicon.php',
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
									     $("#avatar-1").on('fileloaded', function(event, file, previewId, index) {
									//     alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
										 $("#showFile").append('<input type=hidden name=Icon value='+file.name+'>');
									     });
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>
							</div>
							</div>

							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_haedline; ?></label>
							<div class="col-sm-9">
							<textarea class="textarea" id="editor" rows="5" cols="100" name="Headline"></textarea>
							</div>
							</div>

							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_detail; ?></label>
							<div class="col-sm-9">
							<textarea id="editor1" rows="10" cols="100" name="Detail" TextMode="MultiLine"></textarea>
							</div>
							</div>

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_img_random; ?></label>
							<div class="col-sm-3">
							<div id="showFile2" ></div>
							<input id="avatar-2" name="avatar-2" type="file" class="file-loading">
								<script>
									var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
									'onclick="alert(\'Call your custom code here.\')">' +
									'<i class="glyphicon glyphicon-tag"></i>' +
									'</button>'; 
								$(document).ready(function () {
									$("#avatar-2").fileinput({
										overwriteInitial: true,
										maxFileSize: 1024,
										showClose: false,
										showCaption: false,
										browseLabel: '',
										removeLabel: '',
										uploadUrl: '../plugins/fileinput/upload_newsran.php',
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
									     $("#avatar-2").on('fileloaded', function(event, file, previewId, index) {
									//     alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
										 $("#showFile2").append('<input type=hidden name=Icon2 value='+file.name+'>');
									     });
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>
							</div>
							</div>

							
							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="NewsAdd">
							<br>
							</div>
							</div>

							</div>
						</div>

</form>

		</div>
	</div>
<script>
  $(function () {
    CKEDITOR.replace('editor1',{
    //bootstrap WYSIHTML5 - text editor
	allowedContent: true,
	//config.extraPlugins = 'imageuploader';
	//editor.config.filebrowserBrowseUrl = '../plugins/ckeditor/plugins/imageuploader/imgbrowser.php';
	});
	$(".textarea").wysihtml5();
  });
</script>
<?php
} else if($op=='newsedit' ){
		
		@$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." where news_id='".$_GET['news_id']."' "); 
		@$arr['news'] = $db->fetch(@$res['news']);
		$Pic=WEB_URL."/img/news/".@$arr['news']['pic'];
		$Ran=WEB_URL."/img/news/".@$arr['news']['ran'];
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
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
			$.ajax({
			type: "POST",
			url: "modules/content/processnews.php",
			data: $('#formNewsEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=content&file=news&route=<?php echo $route;?>';
				}, 1000);
			} else {
//                $("#error").html(msg.message),
				 $("#error").show();
				 $("#success").hide();
				 $('#formNewsEdit')[0].reset();
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

    <div class="row">
      <div class="col-xs-12 connectedSortable">

		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=content&file=news&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>

				<form method="post" enctype="multipart/form-data" id="formNewsEdit" role="formNewsEdit" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-success" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-th"></i>
                                    <h3 class="box-title"><?php echo _heading_title_news; ?></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_topic; ?></label>
							<div class="col-sm-6"><input type="text" name="Topic"  class="form-control"  placeholder="m1" required value="<?php echo @$arr['news']['topic'];?>"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>

						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_category; ?></label>
							<div class="col-sm-4" >
							<select class="form-control" name="CAT" >
							<?php
							
							@$res['cate'] = $db->select_query("SELECT * FROM ".TB_NEWS_CATE." ORDER BY cate_id ");
							while (@$arr['cate'] = $db->fetch(@$res['cate'])){
							echo "<option value=\"".@$arr['cate']['cate_id']."\" ";
							if(@$arr['news']['category']==@$arr['cate']['cate_id']){ echo " selected";}
							echo " >".@$arr['cate']['category_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>

							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_img; ?></label>
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
										uploadUrl: '../plugins/fileinput/upload_newsicon.php',
										allowedFileExtensions: ['jpg', 'png', 'gif'],
										browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
										removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
										removeTitle: 'Cancel or reset changes',
										elErrorContainer: '#kv-avatar-errors-1',
										msgErrorClass: 'alert alert-block alert-danger',
										defaultPreviewContent: '<img src="<?php echo $Pic;?>" alt="Your Avatar" style="width:160px">',
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

							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_haedline; ?></label>
							<div class="col-sm-9">
							<textarea class="textarea" id="editor" rows="5" cols="100" name="Headline"><?php echo @$arr['news']['headline'];?></textarea>
							</div>
							</div>

							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_detail; ?></label>
							<div class="col-sm-9">
							<textarea id="editor1" rows="10" cols="100" name="Detail" TextMode="MultiLine"><?php echo @$arr['news']['detail'];?></textarea>
							</div>
							</div>

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_img_random; ?></label>
							<div class="col-sm-3">
							<div id="showFile2" ></div>
							<input id="avatar-2" name="avatar-2" type="file" class="file-loading">
								<script>
									var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
									'onclick="alert(\'Call your custom code here.\')">' +
									'<i class="glyphicon glyphicon-tag"></i>' +
									'</button>'; 
								$(document).ready(function () {
									$("#avatar-2").fileinput({
										overwriteInitial: true,
										maxFileSize: 1024,
										showClose: false,
										showCaption: false,
										browseLabel: '',
										removeLabel: '',
										uploadUrl: '../plugins/fileinput/upload_newsran.php',
										allowedFileExtensions: ['jpg', 'png', 'gif'],
										browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
										removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
										removeTitle: 'Cancel or reset changes',
										elErrorContainer: '#kv-avatar-errors-1',
										msgErrorClass: 'alert alert-block alert-danger',
										defaultPreviewContent: '<img src="<?php echo $Ran;?>" alt="Your Avatar" style="width:160px">',
										layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
										allowedFileExtensions: ["jpg", "png", "gif"]
									});
									     $("#avatar-2").on('fileloaded', function(event, file, previewId, index) {
									//     alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
										 $("#showFile2").append('<input type=hidden name=Icon2 value='+file.name+'>');
									     });
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>
							</div>
							</div>

							
							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="NewsEdit"><input type="hidden" name="NEWSID"  value="<?php echo @$arr['news']['news_id'];?>">
							<br>
							</div>
							</div>

							</div>
						</div>

</form>

		</div>
	</div>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1',{
    //bootstrap WYSIHTML5 - text editor
	allowedContent: true,
	//config.extraPlugins = 'imageuploader';
	//editor.config.filebrowserBrowseUrl = '../plugins/ckeditor/plugins/imageuploader/imgbrowser.php';
	});
	$(".textarea").wysihtml5();
  });
</script>
<?php
} else {
		
		@$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." order by news_id DESC"); 
		@$rows['news'] = $db->rows(@$res['news']);
		@$res['cate'] = $db->select_query("SELECT * FROM ".TB_NEWS_CATE." order by cate_id"); 
		@$rows['cate'] = $db->rows(@$res['cate']);
?>
      <div class="row">
        <div class="col-xs-12 connectedSortable">

    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _heading_title_news;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _heading_title_news_cate;?></div>
            </button>
        </div>

    </div>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="tab1">

    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=content&file=news&op=newsadd&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a onclick="document.getElementById('form').submit();" class="btn bg-red btn-flat btn-sm"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a></div>
      <br>
      </div>
    <div class="box box-info">
      
	         <div class="box-header with-border">
                 <i class="fa fa-pencil-square-o"></i>
                 <h3 class="box-title"><?php echo _heading_title_news; ?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['news'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
	<div class="box-body ">
		<?php
		if(@$rows['news']) {
		?>
      <form action="index.php?name=content&file=news&op=newsdelall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" name="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_body_topic; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_body_category; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_body_date; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_body_preview;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['news'] = $db->fetch(@$res['news'])){
		@$res['cat'] = $db->select_query("SELECT * FROM ".TB_NEWS_CATE." WHERE cate_id='".@$arr['news']['category']."' "); 
		@$arr['cat'] = $db->fetch(@$res['cat']);
		$Preview=ThaiTimeConvert(@$arr['news']['post_date']);
		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['news']['news_id']; ?>" class="selector flat"/></td>
              <td style="text-align: left;"><?php echo @$arr['news']['topic']; ?>&nbsp;<a href="<?php echo WEB_URL_IMG_NEWS.@$arr['news']['pic']."";?>" data-toggle="lightbox" data-title="<?php echo @$arr['news']['topic']; ?>"><i class="glyphicon glyphicon-picture img-fluid" ></i></a>&nbsp;<?php echo NewsIcons(TIMESTAMP,@$arr['news']['post_date']);?></td>
              <td style="text-align: left;"><?php echo @$arr['cat']['category_name']; ?></td>
              <td layout="block" style="text-align: center;"><?php echo $Preview; ?></td>
              <td layout="block" style="text-align: right;"><?php echo @$arr['news']['pageview']; ?></td>
              <td style="text-align: center;">
			 <a href="index.php?name=content&file=news&op=newsdetail&id=<?php echo @$arr['news']['news_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
				<a href="index.php?name=content&file=news&op=newsedit&news_id=<?php echo @$arr['news']['news_id']; ?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=content&file=news&op=newsdel&news_id=<?php echo @$arr['news']['news_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" ><i class="fa fa-trash-o "></i></a>
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

		</div><!-- /.body -->

	</div><!-- /.box -->
<script>
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
</script>

		</div><!-- //tab1-->
		<div class="tab-pane fade in" id="tab2">

    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=content&file=news&op=cateadd&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a onclick="document.getElementById('form1').submit();" class="btn bg-red btn-flat btn-sm"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a></div>
      <br>
      </div>
    <div class="box box-warning">
      
	         <div class="box-header with-border">
                 <i class="fa fa-bars"></i>
                 <h3 class="box-title"><?php echo _heading_title_news_cate; ?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['cate'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
	<div class="box-body ">
		<?php
		if(@$rows['cate']) {
		?>
      <form action="index.php?name=content&file=news&op=catedelall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form1" name="form1" class="form-inline">
        <table id="example2" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_body_category; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_count_news; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_cate_order; ?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['cate'] = $db->fetch(@$res['cate'])){
		@$res['Cnews'] = $db->select_query("SELECT * FROM ".TB_NEWS." WHERE category='".@$arr['cate']['cate_id']."' "); 
		@$arr['Cnews'] = $db->rows(@$res['Cnews']);
		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selecteds[]" value="<?php echo @$arr['cate']['cate_id']; ?>" class="selector flat"/></td>
              <td style="text-align: left;"><?php echo @$arr['cate']['category_name']; ?></td>
              <td style="text-align: center;"><?php echo @$arr['Cnews']; ?></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['cate']['sort'];?></td>
              <td style="text-align: center;">
			 <a href="index.php?name=content&file=news&op=catedetail&cate_id=<?php echo @$arr['cate']['cate_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
				<a href="index.php?name=content&file=news&op=cateedit&cate_id=<?php echo @$arr['cate']['cate_id']; ?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=content&file=news&op=catedel&cate_id=<?php echo @$arr['cate']['cate_id'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm" ><i class="fa fa-trash-o "></i></a>
			  </td>
            </tr>
            <?php } ?>
          </tbody>
		  </table>
	      </form>

            <?php } else { ?>
			<table>
            <tr>
              <td class="center" colspan="5"><?php echo _text_no_results; ?></td>
            </tr>
			</table>
            <?php } ?>

		</div><!-- /.body -->

	</div><!-- /.box -->


		</div><!-- //tab2-->
	</div><!-- //content-->

</div>
</div>


        <script type="text/javascript">
        $(document).ready(function() {
        var aoColumns1 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable1 = $("#example1").dataTable({
								"aoColumns": aoColumns1,
								"responsive" : true,
								"dom" : 'lBfrtip',
//								"aaSorting": [[ 0, "desc" ]],
//								"dom": 'T<"clear">lfrtip',
								buttons: {
								"buttons" : [
										{
										extend: 'copy',
										text: '<i class="fa fa-copy"></i> Copy',
										title: $('h3').text(),
										exportOptions: {
											columns: ':not(.no-print)'
										},
										footer: true,
//										autoPrint: false		
										},
										{
										extend: 'excel',
										text: '<i class="fa fa-file-excel-o"></i> Excel',
										title: $('h3').text(),
										exportOptions: {
											columns: ':not(.no-print)'
										},
										footer: true,
//										autoPrint: false		
										},
//										{
//										extend: 'pdf',
//										text: '<i class="fa fa-file-pdf-o"></i> PDF',
//										title: $('h3').text(),
//										exportOptions: {
//											columns: ':not(.no-print)'
//										},
//										footer: true,
//										autoPrint: false
//										},
										{
										extend: 'print',
										text: '<i class="fa fa-print"></i> Print',
										title: $('h3').text(),
										exportOptions: {
											columns: ':not(.no-print)'
										},
										footer: true,
										autoPrint: false
										},
	
								],
								dom: {
								//      container: {
								//        className: 'dt-buttons'
								//      },
										button: {
											className: 'btn bg-orange btn-flat'
										}
								}
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
								});

        var aoColumns2 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable2 = $("#example2").dataTable({
								"aoColumns": aoColumns2,
								"responsive" : true,
								"dom" : 'lBfrtip',
//								"aaSorting": [[ 0, "desc" ]],
//								"dom": 'T<"clear">lfrtip',
								buttons: {
								"buttons" : [
										{
										extend: 'copy',
										text: '<i class="fa fa-copy"></i> Copy',
										title: $('h3').text(),
										exportOptions: {
											columns: ':not(.no-print)'
										},
										footer: true,
//										autoPrint: false		
										},
										{
										extend: 'excel',
										text: '<i class="fa fa-file-excel-o"></i> Excel',
										title: $('h3').text(),
										exportOptions: {
											columns: ':not(.no-print)'
										},
										footer: true,
//										autoPrint: false		
										},
//										{
//										extend: 'pdf',
//										text: '<i class="fa fa-file-pdf-o"></i> PDF',
//										title: $('h3').text(),
//										exportOptions: {
//											columns: ':not(.no-print)'
//										},
//										footer: true,
//										autoPrint: false
//										},
										{
										extend: 'print',
										text: '<i class="fa fa-print"></i> Print',
										title: $('h3').text(),
										exportOptions: {
											columns: ':not(.no-print)'
										},
										footer: true,
										autoPrint: false
										},
	
								],
								dom: {
								//      container: {
								//        className: 'dt-buttons'
								//      },
										button: {
											className: 'btn bg-orange btn-flat'
										}
								}
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
								});

            });
        </script>

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
}
?>




<?php } else { echo "<meta http-equiv='refresh' content='0; url=index.php'>"; }?>
