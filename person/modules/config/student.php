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
if(!empty($_SESSION['person_login'])){
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
<?php if($op=='edit' and $action==''){

		@$res['user'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_class='".$_SESSION['person_class']."' and  stu_cn='".$_SESSION['person_cn']."' and stu_id='".$_GET['stu_id']."'"); 
		 @$arr['user']= $db->fetch(@$res['user']);
		$img=@$arr['user']['stu_pic'];

		if(empty(@$arr['user']['stu_pic'])){
		$Pic='../img/admin/default_avatar_male.jpg';
		} else {
		$Pic=WEB_URL_IMG_STU.@$arr['user']['stu_pic'];
		}
		@$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_area='".$_SESSION['person_area']."' and sh_code='".$_SESSION['person_school']."' "); 
		 @$arr['sh']= $db->fetch(@$res['sh']);
?>

      <div class="row">
        <div class="col-md-12">

      <div class="alert alert-success" name="tsuccess" id="success" style="display: none">
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
			url: "../admin/modules/config/processstudent.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#success").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=config&file=student&route=<?php echo $route;?>';
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
<script type="text/javascript">
$(function(){
 $("select#province").change(function(){
  var datalist2 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist2
     url: "../admin/modules/config/amphur.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
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
     url: "../admin/modules/config/tambol.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data:"amphur_id="+$(this).val(), // ส่งตัวแปร GET ชื่อ amphur ให้มีค่าเท่ากับ ค่าของ amphur
     async: false
  }).responseText;  
  $("select#tambol").html(datalist3); // นำค่า datalist2 มาแสดงใน listbox ที่ 3 ที่ชื่อ tambol
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });
});
</script>
		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=config&file=student&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
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

<div class="form-group">
	<div class="col-sm-12" >
	</div>
</div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab1;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab2;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab3;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab4" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab4;?></div>
            </button>
        </div>
    </div>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="tab1">
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_id; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_id"  class="form-control css-require" placeholder="12345" maxlength="5" data-minlength="4"  pattern="^[0-9]{1,}$" value="<?php echo @$arr['user']['stu_id']; ?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_pid; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_pid"  class="form-control css-require" placeholder="1234567891234" maxlength="13" data-minlength="13"  pattern="^[0-9]{1,}$" value="<?php echo @$arr['user']['stu_pid']; ?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_num; ?></label>
							<div class="col-sm-4" >
							<input type="radio" name="Stu_num" class="minimal" value="<?php echo _text_box_table_stu_num_chai; ?>" <?  if (@$arr['user']['stu_num'] == _text_box_table_stu_num_chai) { echo " checked "; }  ?>  >&nbsp;<?php echo _text_box_table_stu_num_chai;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_num" class="minimal" value="<?php echo _text_box_table_stu_num_ying; ?>" <?  if (@$arr['user']['stu_num'] == _text_box_table_stu_num_ying) { echo " checked "; }  ?>  >&nbsp;<?php echo _text_box_table_stu_num_ying;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_num" class="minimal" value="<?php echo _text_box_table_stu_num_nai; ?>" <?  if (@$arr['user']['stu_num'] == _text_box_table_stu_num_nai) { echo " checked "; }  ?>  >&nbsp;<?php echo _text_box_table_stu_num_nai;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_num" class="minimal" value="<?php  echo _text_box_table_stu_num_nangsaw; ?>" <?  if (@$arr['user']['stu_num'] == _text_box_table_stu_num_nangsaw) { echo " checked "; }  ?>  >&nbsp;<?php echo _text_box_table_stu_num_nangsaw;?>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_name; ?></label>
							<div class="col-sm-4"><input type="text" name="Stu_name"  class="form-control"  placeholder="Name" value="<?php echo @$arr['user']['stu_name']; ?>" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_sur; ?></label>
							<div class="col-sm-4"><input type="text" name="Stu_sur"  class="form-control"  placeholder="Surname" value="<?php echo @$arr['user']['stu_sur']; ?>" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_nick; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_nick"  class="form-control"  placeholder="Nickname" value="<?php echo @$arr['user']['stu_nick']; ?>" ><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_blood; ?></label>
							<div class="col-sm-2" >
							<select  class="form-control css-require" name="Stu_blood" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_blood;?></option>
							<option value="A" <?php if(@$arr['user']['stu_blood']=='A'){echo " selected ";} ?>>A</option>
							<option value="B" <?php if(@$arr['user']['stu_blood']=='B'){echo " selected ";} ?>>B</option>
							<option value="AB" <?php if(@$arr['user']['stu_blood']=='AB'){echo " selected ";} ?>>AB</option>
							<option value="O" <?php if(@$arr['user']['stu_blood']=='O'){echo " selected ";} ?>>O</option>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_sphone; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_sphone"  class="form-control"  maxlength="9" data-minlength="9"  pattern="^[0-9]{1,}$" placeholder="0899345556" value="<?php echo @$arr['user']['stu_sphone']; ?>"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_email; ?></label>
							<div class="col-sm-3"><input type="email" name="Stu_email"  id="inputEmail" class="form-control"  placeholder="atom@gmail.com" value="<?php echo @$arr['user']['stu_email']; ?>"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_LineId; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_LineId"  class="form-control"  value="<?php echo @$arr['user']['stu_LineId']; ?>" placeholder="atom123"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_hight; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_hight"  class="form-control"  placeholder="hight" value="<?php echo @$arr['user']['stu_hight']; ?>" ><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_weight; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_weight"  class="form-control"  placeholder="weight" value="<?php echo @$arr['user']['stu_weight']; ?>" ><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_class; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" name="Stu_class" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_class_select;?></option>
							<?php
							
							@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." ORDER BY class_id ");
							while (@$arr['class'] = $db->fetch(@$res['class'])){
							echo "<option value=\"".@$arr['class']['class_id']."\"";
							if(@$arr['user']['stu_class']==@$arr['class']['class_id']){echo " selected ";}
							echo ">".@$arr['class']['class_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_class_room; ?></label>
							<div class="col-sm-2" >
							<select  class="form-control css-require" name="Stu_cn" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_class_select_room;?></option>
							<?php
							for($i=1;$i<21;$i++){
							echo "<option value=\"".$i."\"";
							if(@$arr['user']['stu_cn']==$i){echo " selected ";}
							echo ">".$i."</option>";
							}
							?>
							</select>
							</div>
							</div>
						    <!-- <div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_gcolor; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control" name="Stu_gcolor" >
							<option value="" selected disabled><?php echo _text_box_table_stu_gcolor_select;?></option>
							<?php
							
							@$res['color'] = $db->select_query("SELECT * FROM ".TB_GCOLOR." ORDER BY gcolor_id ");
							while (@$arr['color'] = $db->fetch(@$res['color'])){
							echo "<option value=\"".@$arr['color']['gcolor_id']."\"";
							if(@$arr['user']['stu_gcolor']==@$arr['color']['gcolor_id']){echo " selected ";}
							echo ">".@$arr['color']['gcolor_name']."</option>";
							}
							?>
							</select>
							</div>
							</div> -->
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_birth; ?></label>
							<div class="col-sm-3" >
							<?php $DateTimeStart=$arr['user']['stu_birth'];?>
							<div class="input-group date" id="dp1" data-date="<?php echo $DateTimeStart;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control" name="Stu_birth" class="form-control css-require" value="<?php echo @$arr['user']['stu_birth']; ?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>

							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_pic; ?></label>
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
										uploadUrl: '../plugins/fileinput/upload_stuicon.php',
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
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_suspend; ?></label>
							<div class="col-sm-3" >
							<input type="checkbox" name="Stu_suspend"  id="Checked" class="check" value="1" <?php if(@$arr['user']['stu_suspend']==1) { echo "checked";}?>>
							</div>
							</div>
		</div>
		<div class="tab-pane fade in" id="tab2">
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_add; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_add"  class="form-control css-require" placeholder="111/20" value="<?php echo @$arr['user']['stu_add']; ?>" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_group; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_group"  value="<?php echo @$arr['user']['stu_group']; ?>" class="form-control css-require" placeholder="10" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>   
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_ban; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_ban"  value="<?php echo @$arr['user']['stu_ban']; ?>" class="form-control css-require"  placeholder="nongmonpla" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>   
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_prov; ?></label>
							<div class="col-sm-3">
							<select name="Stu_prov" id="province" class="form-control css-require" required="required">
								<option value="0"><?php echo _text_box_table_stu_prov_select;?></option>
								<?php 
							
							@$res['prov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." order by id"); 
							while (@$arr['prov'] = $db->fetch(@$res['prov'])){?>
								<option value="<?php echo @$arr['prov']['code'];?>" <?php if(@$arr['prov']['code']==@$arr['user']['stu_prov']){ echo "selected ";}?>><?php echo @$arr['prov']['name'];?></option>
								<?php } ?>
								</select>
							</div>
							</div> 							
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_amp; ?></label>
							<div class="col-sm-3">
							<select name="Stu_amp" id="amphur" class="form-control css-require" required="required">
							<option value=""><?php echo _text_box_table_stu_amp_select;?></option>
								<?php 
								
								@$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where provinceID='".@$arr['user']['stu_prov']."' order by id"); 
								while (@$arr['amp'] = $db->fetch(@$res['amp'])){?>
								<option value="<?php echo @$arr['amp']['id'];?>" <?php if(@$arr['amp']['id']==@$arr['user']['stu_amp']){ echo "selected ";}?>><?php echo @$arr['amp']['name'];?></option>
								<?php } ?>
							</select>
							</div>
							</div> 
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tum; ?></label>
							<div class="col-sm-3">
							<select name="Stu_tum" id="tambol" class="form-control css-require" required="required">
								<option value=""><?php echo _text_box_table_stu_tum_select;?></option>
								<?php 
								
								@$res['tam'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where amphurID='".@$arr['user']['stu_amp']."' order by id"); 
								while (@$arr['tam'] = $db->fetch(@$res['tam'])){?>
								<option value="<?php echo @$arr['tam']['id'];?>" <?php if(@$arr['tam']['id']==@$arr['user']['stu_tum']){ echo "selected ";}?>><?php echo @$arr['tam']['name'];?></option>
								<?php } ?>
							</select>
							</div>
							</div> 
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_post; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_post"  value="<?php echo @$arr['user']['stu_post']; ?>" class="form-control css-require"  placeholder="44000" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_distance; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_distance" id="Stu_distance"   class="form-control"  placeholder="distance" value="<?php echo @$arr['user']['stu_distance']; ?>" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_time; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_time"  id="Stu_time"  class="form-control"  placeholder="time" value="<?php echo @$arr['user']['stu_time']; ?>" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_travel; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" name="Stu_travel" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_travel;?></option>
							<option value="เดินเท้า" <?php if(@$arr['user']['stu_travel']=='เดินเท้า'){echo " selected ";} ?>>เดินเท้า</option>
							<option value="พาหนะเสียค่าโดยสาร" <?php if(@$arr['user']['stu_travel']=='พาหนะเสียค่าโดยสาร'){echo " selected ";} ?>>พาหนะเสียค่าโดยสาร</option>
							<option value="พาหนะไม่เสียค่าโดยสาร" <?php if(@$arr['user']['stu_travel']=='พาหนะไม่เสียค่าโดยสาร'){echo " selected ";} ?>>พาหนะไม่เสียค่าโดยสาร</option>
							</select>
							</div>
							</div>

							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_map_google; ?></label>
							<div class="col-sm-3">
							Latitude  
							<input name="lat_value" type="text" id="lat_value" value="<?php echo @$arr['user']['stu_lat']; ?>" class="form-control"/>
							</div>
							<div class="col-sm-3">
							Longitude  
							<input name="lon_value" type="text" id="lon_value" value="<?php echo @$arr['user']['stu_long']; ?>" class="form-control"/>
							</div>
							<div class="col-sm-2">
							Zoom  
							<input name="zoom_value" type="text" id="zoom_value" value="15" size="5" class="form-control"/>  
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" >Google Map</label>
							<div class="col-sm-3">
							<div id="map_canvas"></div>
							</div>
							</div>



		</div>
        <div class="tab-pane fade in" id="tab3">
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_fpid; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_fpid"  value="<?php echo @$arr['user']['stu_fpid']; ?>" class="form-control css-require" placeholder="1111111111111" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_father; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_father"  value="<?php echo @$arr['user']['stu_father']; ?>" class="form-control css-require" placeholder="Mr.somsong tongtip" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_fphone; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_fphone"  value="<?php echo @$arr['user']['stu_fphone']; ?>" class="form-control css-require" placeholder="0899346667" maxlength="9" data-minlength="9"  pattern="^[0-9]{1,}$"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_femail; ?></label>
							<div class="col-sm-3"><input type="email" name="Stu_femail"  id="inputEmail" value="<?php echo @$arr['user']['stu_femail']; ?>" class="form-control"  placeholder="atom@gmail.com"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_fstatus; ?></label>
							<div class="col-sm-4" >
							<input type="radio" name="Stu_fstatus" class="minimal" value="<?php echo _text_box_table_stu_fmo_status_ok; ?>" <?  if (@$arr['user']['stu_fstatus'] == _text_box_table_stu_fmo_status_ok) { echo " checked "; }  ?>>&nbsp;<?php echo _text_box_table_stu_fmo_status_ok;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_fstatus" class="minimal" value="<?php echo _text_box_table_stu_fmo_status_no; ?>" <?  if (@$arr['user']['stu_fstatus'] == _text_box_table_stu_fmo_status_no) { echo " checked "; }  ?>>&nbsp;<?php echo _text_box_table_stu_fmo_status_no;?>&nbsp;&nbsp;
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_mpid; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_mpid"  value="<?php echo @$arr['user']['stu_mpid']; ?>" class="form-control css-require" placeholder="2222222222222" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_marther; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_marther"  value="<?php echo @$arr['user']['stu_marther']; ?>" class="form-control css-require" placeholder="Miss.somjit tongtip" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_mphone; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_mphone"  value="<?php echo @$arr['user']['stu_mphone']; ?>" class="form-control css-require" placeholder="0899346667" maxlength="9" data-minlength="9"  pattern="^[0-9]{1,}$" ><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_memail; ?></label>
							<div class="col-sm-3"><input type="email" name="Stu_memail"  id="inputEmail" value="<?php echo @$arr['user']['stu_memail']; ?>" class="form-control"  placeholder="atom@gmail.com"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
						    <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_mstatus; ?></label>
							<div class="col-sm-4" >
							<input type="radio" name="Stu_mstatus" class="minimal" value="<?php echo _text_box_table_stu_fmo_status_ok; ?>" <?  if (@$arr['user']['stu_mstatus'] == _text_box_table_stu_fmo_status_ok) { echo " checked "; }  ?>>&nbsp;<?php echo _text_box_table_stu_fmo_status_ok;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_mstatus" class="minimal" value="<?php echo _text_box_table_stu_fmo_status_no; ?>" <?  if (@$arr['user']['stu_mstatus'] == _text_box_table_stu_fmo_status_no) { echo " checked "; }  ?>>&nbsp;<?php echo _text_box_table_stu_fmo_status_no;?>&nbsp;&nbsp;
							</div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_status; ?></label>
							<div class="col-sm-9" >
							<input type="radio" name="Stu_status" class="minimal" value="<?php echo _text_box_table_stu_status_1; ?>" <?  if (@$arr['user']['stu_status'] == _text_box_table_stu_status_1) { echo " checked "; }  ?>>&nbsp;<?php echo _text_box_table_stu_status_1;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_status" class="minimal" value="<?php echo _text_box_table_stu_status_2; ?>" <?  if (@$arr['user']['stu_status'] == _text_box_table_stu_status_2) { echo " checked "; }  ?>>&nbsp;<?php echo _text_box_table_stu_status_2;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_status" class="minimal" value="<?php echo _text_box_table_stu_status_3; ?>" <?  if (@$arr['user']['stu_status'] == _text_box_table_stu_status_3) { echo " checked "; }  ?>>&nbsp;<?php echo _text_box_table_stu_status_3;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_status" class="minimal" value="<?php echo _text_box_table_stu_status_4; ?>" <?  if (@$arr['user']['stu_status'] == _text_box_table_stu_status_4) { echo " checked "; }  ?>>&nbsp;<?php echo _text_box_table_stu_status_4;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_status" class="minimal" value="<?php echo _text_box_table_stu_status_5; ?>" <?  if (@$arr['user']['stu_status'] == _text_box_table_stu_status_5) { echo " checked "; }  ?>>&nbsp;<?php echo _text_box_table_stu_status_5;?>&nbsp;&nbsp;
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_opid; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_opid"  value="<?php echo @$arr['user']['stu_opid']; ?>" class="form-control css-require" placeholder="3333333333333"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_orther; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_orther"  value="<?php echo @$arr['user']['stu_orther']; ?>" class="form-control css-require" placeholder="Miss.sompong somboon"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_ophone; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_ophone"  value="<?php echo @$arr['user']['stu_ophone']; ?>" class="form-control css-require" placeholder="0899346667" maxlength="9" data-minlength="9"  pattern="^[0-9]{1,}$"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_oemail; ?></label>
							<div class="col-sm-3"><input type="email" name="Stu_oemail"  id="inputEmail" value="<?php echo @$arr['user']['stu_oemail']; ?>" class="form-control"  placeholder="atom@gmail.com"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
						    <div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_ostatus; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control css-require" name="Stu_ostatus" >
							<option value="" selected disabled><?php echo _text_box_table_stu_ostatus_select;?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_1; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_1) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_1; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_2; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_2) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_2; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_3; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_3) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_3; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_4; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_4) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_4; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_5; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_5) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_5; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_6; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_6) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_6; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_7; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_7) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_7; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_8; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_8) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_8; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_9; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_9) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_9; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_10; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_10) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_10; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_11; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_11) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_11; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_12; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_12) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_12; ?></option>
							</select>
							</div>
							</div>


        </div>
        <div class="tab-pane fade in" id="tab4">
		<?php
		@$res['best'] = $db->select_query("SELECT * FROM ".TB_BESTTAIL." WHERE btail_stu='".@$arr['user']['stu_id']."'"); 
		@$arr['best']= $db->fetch(@$res['best']);
		?>
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="Stu_best" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_best_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_BEST." ORDER BY bt_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['bt_id']."\" ";
							if(@$arr['user']['stu_best']==@$arr['bt']['bt_id']){echo " selected ";}
							echo ">".@$arr['bt']['bt_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best_detail; ?></label>
							<div class="col-sm-6">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="Btail_name"><?php echo @$arr['best']['btail_name']; ?></textarea>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best_interv; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="Btail_per" required="required">
							<option value="" selected disabled><?php echo _text_box_table_stu_best_interv_select;?></option>
							<?php
							
							@$res['per'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['person_area']."' and per_code='".$_SESSION['person_school']."' ORDER BY per_id ");
							while (@$arr['per'] = $db->fetch(@$res['per'])){
							echo "<option value=\"".@$arr['per']['per_ids']."\" ";
							if(@$arr['best']['btail_per']==@$arr['per']['per_ids']){echo " selected ";}
							echo ">".@$arr['per']['per_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>


        </div>
							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Edit"><input name="SID" type="hidden" value="<?php echo @$arr['user']['stu_id'];?>">
							<br>
							</div>
							</div>

							</div>
						</div>

</form>
</div>
</div>
<style type="text/css">
/* css กำหนดความกว้าง ความสูงของแผนที่ */
div#map_canvas{
    margin:auto;
    width:600px;
    height:550px;
    overflow:hidden;
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAr6ZgHWvwwGvFEM2hAtmYr9rc-Ug2QFwU&callback=initialize" type="text/javascript"></script>
<script type="text/javascript">
var Lat = '<?php if(@$arr["user"]["stu_lat"] !=""){echo @$arr["user"]["stu_lat"]; } else { echo @$arr["sh"]["latitude"];}?>';
var Long = '<?php if(@$arr["user"]["stu_long"] !=""){ echo @$arr["user"]["stu_long"]; } else { echo @$arr["sh"]["longitude"];}?>';
//var LatWest = (Lat + parseInt(0.8163255));
//var LongWest = (Long + parseInt(0.2813898));
//var LatEast = (Lat + parseInt(0.8160577));
//var LongEast = (Long + parseInt(0.2817085));

var map;
var marker;
var infowindowPhoto = new google.maps.InfoWindow();
var latPosition;
var longPosition;

function initialize() {

    var mapOptions = {
        zoom: 8,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(Lat,Long)
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    initializeMarker();
}

function initializeMarker() {

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(function (position) {

            var pos = new google.maps.LatLng(Lat,Long);

            latPosition = position.coords.latitude;
            longPosition = position.coords.longitude;

            marker = new google.maps.Marker({
                position: pos,
                draggable: true,
                animation: google.maps.Animation.DROP,
                map: map
            });

            map.setCenter(pos);
            updatePosition();

            google.maps.event.addListener(marker, 'click', function (event) {
                updatePosition();
            });

            google.maps.event.addListener(marker, 'dragend', function (event) {
                updatePosition();
            });
        });
    }
}

function updatePosition() {

		latPosition = marker.getPosition().lat();
		longPosition = marker.getPosition().lng();
		$("#lat_value").val(latPosition);
		$("#lon_value").val(longPosition);
		//$("#zoom_value").val(map.getZoom());

		var SCHOOL='<?php echo $arr["sh"]["sh_code"];?>';
		var LAT=latPosition;
		var LNG=longPosition;

		$.ajax({
		url: "modules/config/stu_length.php",
		method: "GET",
		data:"school="+SCHOOL+"&lat="+LAT+"&lng="+LNG,
		dataType: 'json',
		success: function(datax) {
			console.log(datax);
			var Len=$.parseJSON(datax.Lengthx);
			var Tme=$.parseJSON(datax.Timex);
			//alert(Len);
			if(Len){
			$("#Stu_distn").val(Len);
			}
			if(Tme){
			$("#Stu_time").val(Tme);
			}
  		},
		error: function(datax) {
			console.log(datax);
		}
		});

		contentString = '<div id="iwContent">Lat: <span id="latbox">' + latPosition + '</span><br />Lng: <span id="lngbox">' + longPosition + '</span></div>';

		infowindowPhoto.setContent(contentString);
		infowindowPhoto.open(map, marker);
}

initialize();
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
} else if($op =='detail' ){

@$res['user'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_id='".$_GET['id']."' and stu_class='".$_SESSION['person_class']."' and  stu_cn='".$_SESSION['person_cn']."' order by stu_class,stu_id"); 
@$arr['user'] = $db->fetch(@$res['user']);
@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['user']['stu_class']."' "); 
@$arr['class'] = $db->fetch(@$res['class']);
@$res['gcolor'] = $db->select_query("SELECT * FROM ".TB_GCOLOR." WHERE gcolor_id='".@$arr['user']['stu_gcolor']."' "); 
@$arr['gcolor'] = $db->fetch(@$res['gcolor']);
@$res['tum'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where tumbon_code='".@$arr['user']['stu_tum']."' ");
@$arr['tum'] = $db->fetch(@$res['tum']);
@$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where amphur_code='".@$arr['user']['stu_amp']."' ");
@$arr['amp'] = $db->fetch(@$res['amp']);
@$res['prov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." where code='".@$arr['user']['stu_prov']."' ");
@$arr['prov'] = $db->fetch(@$res['prov']);
@$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_area='".$_SESSION['person_area']."' and sh_code='".$_SESSION['person_school']."' "); 
 @$arr['sh']= $db->fetch(@$res['sh']);
?>

		<div align="right" >
		<div class="form-group"><a href="index.php?name=config&file=student&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>

				<form method="post" enctype="multipart/form-data" id="form" class="form-horizontal" >
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
    <div class="card hovercard">
        <div class="card-background">
            <img class="card-bkimg" alt="" src="<?php echo WEB_URL_IMG_SCHOOL.@$arr['sh']['sh_img'];?>">
            <!-- http://lorempixel.com/850/280/people/9/ -->
        </div>
        <div class="useravatar">
			<?php if(!empty($arr['user']['stu_pic'])){?>
            <img alt="" src="<?php echo WEB_URL_IMG_STU.@$arr['user']['stu_pic'];?>">
			<?php } else {?>
            <img alt="" src="<?php echo WEB_URL_IMG_STU."no_image.jpg";?>">
			<?php } ?>
        </div>
        <div class="card-info"> <span class="card-title"><?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></span>
        </div>
    </div>
<div class="form-group">
	<div class="col-sm-12" >
	</div>
</div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab1;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab2;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab3;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab4" data-toggle="tab"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab4;?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab5" data-toggle="tab"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
                <div class="hidden-xs"><?php echo _text_box_tab_head_tab5;?></div>
            </button>
        </div>


    </div>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="tab1">
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_id; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_id"  class="form-control css-require" placeholder="12345" maxlength="5" data-minlength="4"  pattern="^[0-9]{1,}$" value="<?php echo @$arr['user']['stu_id']; ?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_pid; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_pid"  class="form-control css-require" placeholder="1234567891234" maxlength="13" data-minlength="13"  pattern="^[0-9]{1,}$" value="<?php echo @$arr['user']['stu_pid']; ?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_fullname; ?></label>
							<div class="col-sm-4"><input type="text" name="Stu_name"  class="form-control"  value="<?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_nick; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_nick"  class="form-control"   value="<?php echo @$arr['user']['stu_nick']; ?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
						     <div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_blood; ?></label>
							<div class="col-sm-2" >
							<input type="text" name="Stu_blood"  class="form-control"   value="<?php echo @$arr['user']['stu_blood']; ?>" readonly>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_sphone; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_sphone"  class="form-control"  value="<?php echo @$arr['user']['stu_sphone']; ?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_email; ?></label>
							<div class="col-sm-3"><input type="email" name="Stu_email"  id="inputEmail" class="form-control"  value="<?php echo @$arr['user']['stu_email']; ?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_LineId; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_LineId"  class="form-control"  value="<?php echo @$arr['user']['stu_LineId']; ?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_class; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_class"  class="form-control"  value="<?php echo @$arr['class']['class_name']; ?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>		
							</div>
						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_class_room; ?></label>
							<div class="col-sm-2" >
							<input type="text" name="Stu_cn"  class="form-control"  value="<?php echo @$arr['user']['stu_cn']; ?>" readonly>
							</div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_birth; ?></label>
							<div class="col-sm-3" >
							<input type='text' class="form-control" name="Stu_birth" class="form-control css-require" value="<?php echo formatDateThaiNew(@$arr['user']['stu_birth']); ?>" readonly>
							</div>
							</div>
							<!--<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_best; ?></label>
							<div class="col-sm-3">
							<select  class="form-control css-require" name="Stu_best" required="required" selected disabled>
							<option value="" selected disabled><?php echo _text_box_table_stu_best_select;?></option>
							<?php
							
							@$res['bt'] = $db->select_query("SELECT * FROM ".TB_BEST." ORDER BY bt_id ");
							while (@$arr['bt'] = $db->fetch(@$res['bt'])){
							echo "<option value=\"".@$arr['bt']['bt_id']."\" ";
							if(@$arr['user']['stu_best']==@$arr['bt']['bt_id']){echo " selected ";}
							echo ">".@$arr['bt']['bt_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>-->
		</div>
		<div class="tab-pane fade in" id="tab2">
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_add; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_add"  class="form-control" value="<?php echo @$arr['user']['stu_add']; ?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_group; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_group"  value="<?php echo @$arr['user']['stu_group']; ?>" class="form-control" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>   
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_ban; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_ban"  value="<?php echo @$arr['user']['stu_ban']; ?>" class="form-control"  readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div> 
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_tum; ?></label>
								<?php 
								
								@$res['tam'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where tumbon_code='".@$arr['user']['stu_tum']."' "); 
								@$arr['tam'] = $db->fetch(@$res['tam']);
								?>
							<div class="col-sm-3"><input type="text" name="Stu_tum"  value="<?php echo @$arr['tam']['name']; ?>" class="form-control"  readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div> 
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_amp; ?></label>
								<?php 
								@$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where amphur_code='".@$arr['user']['stu_amp']."' "); 
								@$arr['amp'] = $db->fetch(@$res['amp']);
								?>
							<div class="col-sm-3"><input type="text" name="Stu_amp"  value="<?php echo @$arr['amp']['name']; ?>" class="form-control"  readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div> 
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_prov; ?></label>
							<?php 
							@$res['prov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." where code='".@$arr['user']['stu_prov']."' "); 
							@$arr['prov'] = $db->fetch(@$res['prov']);
							?>
							<div class="col-sm-3"><input type="text" name="Stu_prov"  value="<?php echo @$arr['prov']['name']; ?>" class="form-control"  readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div> 							
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_post; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_post"  value="<?php echo @$arr['user']['stu_post']; ?>" class="form-control"  readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" >ระยะทางจากบ้านถึงโรงเรียน(ก.ม.)</label>
							<div class="col-sm-2"><input type="text" name="Stu_distance" id="Stu_distance"   class="form-control"  placeholder="distance" value="<?php echo number_format($arr['user']['stu_distance']/1000,2); ?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_time; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_time"  id="Stu_time"  class="form-control"  placeholder="time" value="<?php echo number_format($arr['user']['stu_time']/60,2); ?>" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
						     <div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_travel; ?></label>
							<div class="col-sm-4" >
							<input type="text" name="Stu_travel"  id="Stu_travel"  class="form-control"  value="<?php echo @$arr['user']['stu_travel']; ?>" readonly>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_map_google; ?></label>
							<div class="col-sm-3">
							Latitude  
							<input name="lat_value" type="text" id="lat_value" value="<?php echo @$arr['user']['stu_lat']; ?>" class="form-control" readonly/>
							</div>
							<div class="col-sm-3">
							Longitude  
							<input name="lon_value" type="text" id="lon_value" value="<?php echo @$arr['user']['stu_long']; ?>" class="form-control" readonly/>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" >Google Map</label>
							<div class="col-sm-3">
							<div id="map_canvas"></div>
							</div>
							</div>



		</div>
        <div class="tab-pane fade in" id="tab3">
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_father; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_father"  value="<?php echo @$arr['user']['stu_father']; ?>" class="form-control" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_fphone; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_fphone"  value="<?php echo @$arr['user']['stu_fphone']; ?>" class="form-control" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_femail; ?></label>
							<div class="col-sm-3"><input type="email" name="Stu_femail"  id="inputEmail" value="<?php echo @$arr['user']['stu_femail']; ?>" class="form-control"  readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
						    <div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_fstatus; ?></label>
							<div class="col-sm-4" >
							<input type="radio" name="Stu_fstatus" class="minimal" value="<?php echo _text_box_table_stu_fmo_status_ok; ?>" <?  if (@$arr['user']['stu_fstatus'] == _text_box_table_stu_fmo_status_ok) { echo " checked "; }  ?> disabled="true">&nbsp;<?php echo _text_box_table_stu_fmo_status_ok;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_fstatus" class="minimal" value="<?php echo _text_box_table_stu_fmo_status_no; ?>" <?  if (@$arr['user']['stu_fstatus'] == _text_box_table_stu_fmo_status_no) { echo " checked "; }  ?> disabled="true">&nbsp;<?php echo _text_box_table_stu_fmo_status_no;?>&nbsp;&nbsp;
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_marther; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_marther"  value="<?php echo @$arr['user']['stu_marther']; ?>" class="form-control" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_mphone; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_mphone"  value="<?php echo @$arr['user']['stu_mphone']; ?>" class="form-control" readonly ><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_memail; ?></label>
							<div class="col-sm-3"><input type="email" name="Stu_memail"  id="inputEmail" value="<?php echo @$arr['user']['stu_memail']; ?>" class="form-control"  readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
						    <div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_mstatus; ?></label>
							<div class="col-sm-4" >
							<input type="radio" name="Stu_mstatus" class="minimal" value="<?php echo _text_box_table_stu_fmo_status_ok; ?>" <?  if (@$arr['user']['stu_mstatus'] == _text_box_table_stu_fmo_status_ok) { echo " checked "; }  ?> disabled="true">&nbsp;<?php echo _text_box_table_stu_fmo_status_ok;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_mstatus" class="minimal" value="<?php echo _text_box_table_stu_fmo_status_no; ?>" <?  if (@$arr['user']['stu_mstatus'] == _text_box_table_stu_fmo_status_no) { echo " checked "; }  ?> disabled="true">&nbsp;<?php echo _text_box_table_stu_fmo_status_no;?>&nbsp;&nbsp;
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_status; ?></label>
							<div class="col-sm-9" >
							<input type="radio" name="Stu_status" class="minimal" value="<?php echo _text_box_table_stu_status_1; ?>" <?  if (@$arr['user']['stu_status'] == _text_box_table_stu_status_1) { echo " checked "; }  ?> disabled="true">&nbsp;<?php echo _text_box_table_stu_status_1;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_status" class="minimal" value="<?php echo _text_box_table_stu_status_2; ?>" <?  if (@$arr['user']['stu_status'] == _text_box_table_stu_status_2) { echo " checked "; }  ?> disabled="true">&nbsp;<?php echo _text_box_table_stu_status_2;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_status" class="minimal" value="<?php echo _text_box_table_stu_status_3; ?>" <?  if (@$arr['user']['stu_status'] == _text_box_table_stu_status_3) { echo " checked "; }  ?> disabled="true">&nbsp;<?php echo _text_box_table_stu_status_3;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_status" class="minimal" value="<?php echo _text_box_table_stu_status_4; ?>" <?  if (@$arr['user']['stu_status'] == _text_box_table_stu_status_4) { echo " checked "; }  ?> disabled="true">&nbsp;<?php echo _text_box_table_stu_status_4;?>&nbsp;&nbsp;
							<input type="radio" name="Stu_status" class="minimal" value="<?php echo _text_box_table_stu_status_5; ?>" <?  if (@$arr['user']['stu_status'] == _text_box_table_stu_status_5) { echo " checked "; }  ?> disabled="true">&nbsp;<?php echo _text_box_table_stu_status_5;?>&nbsp;&nbsp;
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_orther; ?></label>
							<div class="col-sm-3"><input type="text" name="Stu_orther"  value="<?php echo @$arr['user']['stu_orther']; ?>" class="form-control" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_ophone; ?></label>
							<div class="col-sm-2"><input type="text" name="Stu_ophone"  value="<?php echo @$arr['user']['stu_ophone']; ?>" class="form-control" readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_oemail; ?></label>
							<div class="col-sm-3"><input type="email" name="Stu_oemail"  id="inputEmail" value="<?php echo @$arr['user']['stu_oemail']; ?>" class="form-control"  readonly><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
						    <div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_table_stu_ostatus; ?></label>
							<div class="col-sm-4" >
							<select  class="form-control" name="Stu_ostatus" required="required" selected disabled>
							<option value="" selected disabled><?php echo _text_box_table_stu_ostatus_select;?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_1; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_1) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_1; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_2; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_2) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_2; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_3; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_3) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_3; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_4; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_4) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_4; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_5; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_5) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_5; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_6; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_6) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_6; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_7; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_7) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_7; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_8; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_8) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_8; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_9; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_9) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_9; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_10; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_10) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_10; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_11; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_11) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_11; ?></option>
								<option value="<?php echo _text_box_table_stu_ostatus_12; ?>" <?  if (@$arr['user']['stu_ostatus'] == _text_box_table_stu_ostatus_12) { echo " selected "; }  ?>><?php echo _text_box_table_stu_ostatus_12; ?></option>
							</select>
							</div>
							</div>


        </div>
        <div class="tab-pane fade in" id="tab4">

		<!-- ความดี -->

		<?php
		@$res['count'] = $db->select_query("SELECT * FROM ".TB_GOOD." WHERE good_stu='".@$arr['user']['stu_id']."' "); 
		@$rows['count'] = $db->rows(@$res['count']);
		if(@$rows['count']){
		@$res['score'] = $db->select_query("SELECT *,sum(b.goodtail_point) as SCO FROM ".TB_GOOD." as a, ".TB_GOODTAIL." as b WHERE a.good_stu='".@$arr['user']['stu_id']."' and a.good_tail=b.goodtail_id "); 
		@$arr['score'] = $db->fetch(@$res['score']);
		?>
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>

<div class="row">
<div class="col-xs-12 connectedSortable">
              <div class="color-palette-set">
                <div class="bg-green disabled color-palette">
						<center><h1><i class="icon fa fa-warning"></i><?php echo _text_box_table_good_score_sum." +".@$arr['score']['SCO'];?></h1></center>
              </div>
			  </div>

    <div class="box box-success">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title_good; ?>&nbsp;<?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['count'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_GOOD." WHERE good_stu='".@$arr['user']['stu_id']."' order by good_id desc"); 
		@$rows['num'] = $db->rows(@$res['num']);
		?>


      <form method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example2" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5%" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;" width="50%"><?php echo _text_box_table_good_name;?></th>
			  <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_good_level;?></th>
			  <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bg_date;?></th>
              <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_good_score; ?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
//		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_GOOD." WHERE good_stu='".$_GET['id']."' order by cot_id"); 
		while (@$arr['num'] = $db->fetch(@$res['num'])){
			@$res['tail'] = $db->select_query("SELECT * FROM ".TB_GOODTAIL." WHERE goodtail_id='".@$arr['num']['good_tail']."' "); 
			@$arr['tail'] =$db->fetch(@$res['tail']);
			@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_id='".@$arr['user']['stu_id']."' "); 
			@$arr['stu'] =$db->fetch(@$res['stu']);
//		@$PerC=(100*(@$arr['num']['CO']))/(@$rows['count']);
			@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['stu']['stu_class']."' "); 
			@$arr['class'] =$db->fetch(@$res['class']);
			@$res['level'] = $db->select_query("SELECT * FROM ".TB_GOODLEVEL." WHERE glevel_id='".@$arr['tail']['goodtail_level']."' "); 
			@$arr['level'] =$db->fetch(@$res['level']);
		if(@$arr['level']['glevel_id']==1) { //ส่วนของการ สลับสี 
			$ColorFill = '#330000';
		} else if(@$arr['level']['glevel_id']==2) { //ส่วนของการ สลับสี 
			$ColorFill = '#33CC99';
		} else {
			$ColorFill = '#FF0000';
		}
		@$Score +=@$arr['tail']['goodtail_point'];
		?>
            <tr>
              <td style="text-align: center;"><font color="<?php echo $ColorFill;?>"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['num']['good_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['level']['glevel_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo ShortDateThai(@$arr['num']['g_date']);?></font></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['tail']['goodtail_point'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align:right"><?php echo _text_box_table_good_score_sum;?> :</th>
                <th></th>
            </tr>
        </tfoot>
		  </table>

		  
	      </form>

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
        var aoColumns2 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable2 = $("#example2").dataTable({
								"aoColumns": aoColumns2,
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
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' <?php echo _text_box_table_pu_score;?>)'
            );
        }
								});

            });
        </script>

    </div>
    </div>
    </div>

	
	</div>
	<?php } ?>


		<!-- คณะกรรมการนักเรียน -->
		<?php
		@$res['count2'] = $db->select_query("SELECT * FROM ".TB_COUNTAIL." WHERE cot_stu='".@$arr['user']['stu_id']."' "); 
		@$rows['count2'] = $db->rows(@$res['count2']);		
		if(@$rows['count2']){
		?>
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>

<div class="row">
<div class="col-xs-12 connectedSortable">

    <div class="box box-info">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-user"></i>
                 <h3 class="box-title"><?php echo _heading_title_council; ?>&nbsp;<?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['count2'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		
		@$res['num2'] = $db->select_query("SELECT * FROM ".TB_COUNTAIL." WHERE cot_stu='".@$arr['user']['stu_id']."' order by cot_id desc"); 
//		@$rows['num1'] = $db->rows(@$res['num1']);
		?>


      <form method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example4" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5%" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;" width="50%"><?php echo _text_box_table_council_name;?></th>
			  <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bg_date;?></th>
              <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_pu_score; ?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
//		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_COUNCIL." WHERE co_stu='".$_GET['id']."' order by cot_id"); 
		while (@$arr['num2'] = $db->fetch(@$res['num2'])){
			@$res['tail2'] = $db->select_query("SELECT * FROM ".TB_COUNCIL." WHERE co_id='".@$arr['num2']['cot_co']."' "); 
			@$arr['tail2'] =$db->fetch(@$res['tail2']);
			?>
            <tr>
              <td style="text-align: center;"><font color="<?php echo $ColorFill;?>"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['tail2']['co_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo ShortDateThai(@$arr['num2']['cot_date']);?></font></td>
              <td layout="block" style="text-align: center;"><?php echo (int)@$arr['tail2']['co_point'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right"><?php echo _text_box_table_good_score_sum;?> :</th>
                <th></th>
            </tr>
        </tfoot>
		  </table>

		  
	      </form>

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
        var aoColumns4 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable4 = $("#example4").dataTable({
								"aoColumns": aoColumns4,
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
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' <?php echo _text_box_table_pu_score;?> )'
            );
        }
								});

            });
        </script>

    </div>
    </div>
    </div>

	
	</div>
            <?php } ?>


		<!-- คณะกรรมการห้องเรียนสีขาว -->
		<?php
		@$res['count3'] = $db->select_query("SELECT * FROM ".TB_WHITECLTAIL." WHERE whcl_stu='".@$arr['user']['stu_id']."' "); 
		@$rows['count3'] = $db->rows(@$res['count3']);		
		if(@$rows['count3']){
		?>
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>

<div class="row">
<div class="col-xs-12 connectedSortable">

    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-signal"></i>
                 <h3 class="box-title"><?php echo _heading_title_whiteclass; ?>&nbsp;<?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['count3'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		
		@$res['num3'] = $db->select_query("SELECT * FROM ".TB_WHITECLTAIL." WHERE whcl_stu='".@$arr['user']['stu_id']."' order by whcl_id desc"); 
//		@$rows['num1'] = $db->rows(@$res['num1']);
		?>


      <form method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example5" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5%" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;" width="50%"><?php echo _text_box_table_whiteclass_name;?></th>
			  <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bg_date;?></th>
              <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_pu_score; ?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
//		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_WHITECLASS." WHERE wh_stu='".$_GET['id']."' order by whcl_id"); 
		while (@$arr['num3'] = $db->fetch(@$res['num3'])){
			@$res['tail3'] = $db->select_query("SELECT * FROM ".TB_WHITECLASS." WHERE wh_id='".@$arr['num3']['whcl_wh']."' "); 
			@$arr['tail3'] =$db->fetch(@$res['tail3']);
			?>
            <tr>
              <td style="text-align: center;"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['tail3']['wh_name'];?></td>
              <td layout="block" style="text-align: left;"><?php echo ShortDateThai(@$arr['num3']['whcl_date']);?></td>
              <td layout="block" style="text-align: center;"><?php echo (int)@$arr['tail3']['wh_point'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right"><?php echo _text_box_table_good_score_sum;?> :</th>
                <th></th>
            </tr>
        </tfoot>
		  </table>

		  
	      </form>

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
        var aoColumns5 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable5 = $("#example5").dataTable({
								"aoColumns": aoColumns5,
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
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' <?php echo _text_box_table_pu_score;?> )'
            );
        }
								});

            });
        </script>

    </div>
    </div>
    </div>

	
	</div>
            <?php } ?>


		<!-- หน้าที่พิเศษ -->
		<?php
		@$res['count1'] = $db->select_query("SELECT * FROM ".TB_PUTTAIL." WHERE pt_stu='".@$arr['user']['stu_id']."' "); 
		@$rows['count1'] = $db->rows(@$res['count1']);		
		if(@$rows['count1']){
		?>
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>

<div class="row">
<div class="col-xs-12 connectedSortable">

    <div class="box box-warning">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-th-list"></i>
                 <h3 class="box-title"><?php echo _heading_title_put; ?>&nbsp;<?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['count'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_PUTTAIL." WHERE pt_stu='".@$arr['user']['stu_id']."' order by pt_id desc"); 
//		@$rows['num1'] = $db->rows(@$res['num1']);
		?>


      <form method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example3" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5%" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;" width="50%"><?php echo _text_box_table_pu_name;?></th>
			  <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bg_date;?></th>
              <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_pu_score; ?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
//		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_PUT." WHERE pu_stu='".$_GET['id']."' order by cot_id"); 
		while (@$arr['num'] = $db->fetch(@$res['num'])){
			@$res['tail'] = $db->select_query("SELECT * FROM ".TB_PUT." WHERE pu_id='".@$arr['num']['pt_pu']."' "); 
			@$arr['tail'] =$db->fetch(@$res['tail']);
			?>
            <tr>
              <td style="text-align: center;"><font color="<?php echo $ColorFill;?>"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['tail']['pu_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo ShortDateThai(@$arr['num']['pt_date']);?></font></td>
              <td layout="block" style="text-align: center;"><?php echo @$arr['tail']['pu_point'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right"><?php echo _text_box_table_good_score_sum;?> :</th>
                <th></th>
            </tr>
        </tfoot>
		  </table>

		  
	      </form>

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
        var aoColumns3 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable3 = $("#example3").dataTable({
								"aoColumns": aoColumns3,
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
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' <?php echo _text_box_table_pu_score;?> )'
            );
        }
								});

            });
        </script>

    </div>
    </div>
    </div>

	
	</div>
            <?php } ?>
	<!-- /.col -->

		<!-- กิจกรรมนักเรียน -->
		<?php
		@$res['count4'] = $db->select_query("SELECT * FROM ".TB_AFFTAIL." WHERE afft_stu='".@$arr['user']['stu_id']."' "); 
		@$rows['count4'] = $db->rows(@$res['count4']);		
		if(@$rows['count4']){
		?>
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>

<div class="row">
<div class="col-xs-12 connectedSortable">

    <div class="box box-warning">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-book"></i>
                 <h3 class="box-title"><?php echo _heading_title_affairs; ?>&nbsp;<?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['count4'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		
		@$res['num4'] = $db->select_query("SELECT * FROM ".TB_AFFTAIL." WHERE afft_stu='".@$arr['user']['stu_id']."' order by afft_id desc"); 
//		@$rows['num1'] = $db->rows(@$res['num1']);
		?>


      <form method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example6" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5%" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;" width="50%"><?php echo _text_box_table_afft_name;?></th>
			  <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bg_date;?></th>
              <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_pu_score; ?></th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
//		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." WHERE aff_stu='".$_GET['id']."' order by afft_id"); 
		while (@$arr['num4'] = $db->fetch(@$res['num4'])){
			@$res['tail4'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." WHERE aff_id='".@$arr['num4']['afft_aff']."' "); 
			@$arr['tail4'] =$db->fetch(@$res['tail4']);
			?>
            <tr>
              <td style="text-align: center;"><font color="<?php echo $ColorFill;?>"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['tail4']['aff_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo ShortDateThai(@$arr['num4']['afft_date']);?></font></td>
              <td layout="block" style="text-align: center;"><?php echo (int)@$arr['tail4']['aff_point'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right"><?php echo _text_box_table_good_score_sum;?> :</th>
                <th></th>
            </tr>
        </tfoot>
		  </table>

		  
	      </form>

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
        var aoColumns6 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable6 = $("#example6").dataTable({
								"aoColumns": aoColumns6,
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
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' <?php echo _text_box_table_pu_score;?> )'
            );
        }
								});

            });
        </script>

    </div>
    </div>
    </div>

	
	</div>
            <?php } ?>




        </div>

        <div class="tab-pane fade in" id="tab5">
		<?php
		@$res['countB'] = $db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_stu='".@$arr['user']['stu_id']."' "); 
		@$rows['countB'] = $db->rows(@$res['countB']);
		if(@$rows['countB']){
		@$res['scoreB'] = $db->select_query("SELECT *,sum(b.badtail_point) as BCO FROM ".TB_BAD." as a, ".TB_BADTAIL." as b WHERE a.bad_stu='".@$arr['user']['stu_id']."' and a.bad_tail=b.badtail_id "); 
		@$arr['scoreB'] = $db->fetch(@$res['scoreB']);
		?>
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>

<div class="row">
<div class="col-xs-12 connectedSortable">
              <div class="color-palette-set">
                <div class="bg-red disabled color-palette">
						<center><h1><i class="icon fa fa-warning"></i><?php echo _text_box_table_bad_score_sum." -".@$arr['scoreB']['BCO'];?></h1></center>
              </div>
			  </div>

    <div class="box box-danger">
		         <div class="box-header with-border">
                 <i class="glyphicon glyphicon-folder-open"></i>
                 <h3 class="box-title"><?php echo _heading_title_bad; ?>&nbsp;<?php echo @$arr['user']['stu_num'].@$arr['user']['stu_name']." ".@$arr['user']['stu_sur'];?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['countB'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_stu='".@$arr['user']['stu_id']."' order by bad_id desc"); 
		@$rows['num'] = $db->rows(@$res['num']);
		?>


      <form method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="5%" style="text-align: center;">#</th>
			  <th layout="block" style="text-align:center;" width="50%"><?php echo _text_box_table_bad_name;?></th>
			  <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bad_level;?></th>
			  <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bg_date;?></th>
              <th layout="block" style="text-align:center;" width="10%"><?php echo _text_box_table_bad_score; ?></th>

            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
//		@$res['nums'] = $db->select_query("SELECT * FROM ".TB_BAD." WHERE bad_stu='".$_GET['id']."' order by cot_id"); 
		while (@$arr['num'] = $db->fetch(@$res['num'])){
			@$res['tail'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." WHERE badtail_id='".@$arr['num']['bad_tail']."' "); 
			@$arr['tail'] =$db->fetch(@$res['tail']);
			@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." WHERE stu_id='".@$arr['user']['stu_id']."' "); 
			@$arr['stu'] =$db->fetch(@$res['stu']);
//		@$PerC=(100*(@$arr['num']['CO']))/(@$rows['count']);
			@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['stu']['stu_class']."' "); 
			@$arr['class'] =$db->fetch(@$res['class']);
			@$res['level'] = $db->select_query("SELECT * FROM ".TB_BADLEVEL." WHERE blevel_id='".@$arr['tail']['badtail_level']."' "); 
			@$arr['level'] =$db->fetch(@$res['level']);
		if(@$arr['level']['blevel_id']==1) { //ส่วนของการ สลับสี 
			$ColorFill = '#330000';
		} else if(@$arr['level']['blevel_id']==2) { //ส่วนของการ สลับสี 
			$ColorFill = '#33CC99';
		} else {
			$ColorFill = '#FF0000';
		}
		@$BScore +=@$arr['tail']['badtail_point'];
		?>
            <tr>
              <td style="text-align: center;"><font color="<?php echo $ColorFill;?>"><?php echo $i; ?></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['num']['bad_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo @$arr['level']['blevel_name'];?></font></td>
              <td layout="block" style="text-align: left;"><font color="<?php echo $ColorFill;?>"><?php echo ShortDateThai(@$arr['num']['b_date']);?></font></td>
              <td layout="block" style="text-align: center;"><?php echo (int)@$arr['tail']['badtail_point'];?></td>
            </tr>

            <?php $i++;} ?>
          </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align:right"><?php echo _text_box_table_good_score_sum;?> :</th>
                <th></th>
            </tr>
        </tfoot>
		  </table>

		  
	      </form>

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
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
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
								},
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '-'+pageTotal +' ( -'+ total +' <?php echo _text_box_table_pu_score;?>)'
            );
        }

								});



            });
        </script>

    </div>
    </div>
    </div>

	
	</div>
	<?php } ?>
	<!-- /.col -->




        </div>

							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Edit"><input name="SID" type="hidden" value="<?php echo @$arr['user']['stu_id'];?>">
							<br>
							</div>
							</div>

							</div>
						</div>
<style type="text/css">
/* css กำหนดความกว้าง ความสูงของแผนที่ */
div#map_canvas{
    margin:auto;
    width:600px;
    height:550px;
    overflow:hidden;
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAr6ZgHWvwwGvFEM2hAtmYr9rc-Ug2QFwU&callback=initialize" type="text/javascript"></script>
<script type="text/javascript">
var Lat = '<?php if(@$arr["user"]["stu_lat"] !=""){echo @$arr["user"]["stu_lat"]; } else { echo @$arr["sh"]["latitude"];}?>';
var Long = '<?php if(@$arr["user"]["stu_long"] !=""){ echo @$arr["user"]["stu_long"]; } else { echo @$arr["sh"]["longitude"];}?>';
//var LatWest = (Lat + parseInt(0.8163255));
//var LongWest = (Long + parseInt(0.2813898));
//var LatEast = (Lat + parseInt(0.8160577));
//var LongEast = (Long + parseInt(0.2817085));

var map;
var marker;
var infowindowPhoto = new google.maps.InfoWindow();
var latPosition;
var longPosition;

function initialize() {

    var mapOptions = {
        zoom: 8,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(Lat,Long)
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    initializeMarker();
}

function initializeMarker() {

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(function (position) {

            var pos = new google.maps.LatLng(Lat,Long);

            latPosition = position.coords.latitude;
            longPosition = position.coords.longitude;

            marker = new google.maps.Marker({
                position: pos,
                draggable: true,
                animation: google.maps.Animation.DROP,
                map: map
            });

            map.setCenter(pos);
            updatePosition();

            google.maps.event.addListener(marker, 'click', function (event) {
                updatePosition();
            });

            //google.maps.event.addListener(marker, 'dragend', function (event) {
            //    updatePosition();
            //});
        });
    }
}

function updatePosition() {

		latPosition = marker.getPosition().lat();
		longPosition = marker.getPosition().lng();
		//$("#lat_value").val(latPosition);
		//$("#lon_value").val(longPosition);
		//$("#zoom_value").val(map.getZoom());

		contentString = '<div id="iwContent">Lat: <span id="latbox">' + latPosition + '</span><br />Lng: <span id="lngbox">' + longPosition + '</span></div>';

		infowindowPhoto.setContent(contentString);
		infowindowPhoto.open(map, marker);
}

initialize();
</script> 
	

	</form>
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
		//echo $_SESSION['person_class'];
		if(isset($_POST['stu_name'])){
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_class='".$_SESSION['person_class']."' and  stu_cn='".$_SESSION['person_cn']."' and stu_name like '%".$_POST['stu_name']."%'  order by stu_class,stu_id"); 
		} else {
		@$res['num'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' and stu_class='".$_SESSION['person_class']."' and  stu_cn='".$_SESSION['person_cn']."' order by stu_class,id,stu_id"); 
		}
		@$rows['num'] = $db->rows(@$res['num']);

		@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".$_SESSION['person_class']."' "); 
		@$arr['cl'] = $db->fetch(@$res['cl']);

?>
      <div class="row">
        <div class="col-xs-12 connectedSortable">

    <div class="box box-danger">
      
	         <div class="box-header with-border">
                 <i class="fa fa-user"></i>
                 <h3 class="box-title"><?php echo _heading_title; ?> : <?=$arr['cl']['class_name'];?>/<?=$_SESSION['person_cn'];?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".number_format(@$rows['num']);?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
	<div class="box-body ">
	<?php
		if(@$rows['num']) {
	?>
      <form action="index.php?name=config&file=student&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example10" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">#</th>
              <th layout="block" style="text-align:center;" ><?php echo _text_box_table_stu_id; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_pid; ?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_fullname; ?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_class;?></th>
			  <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_class_room;?></th>
              <th layout="block" style="text-align:center;"><?php echo _text_box_table_stu_sphone;?></th>
              <th layout="block" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['num'] = $db->fetch(@$res['num'])){
		@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS." WHERE class_id='".@$arr['num']['stu_class']."' "); 
		@$arr['class'] = $db->fetch(@$res['class']);
		?>
            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td style="text-align: right;"><?php echo @$arr['num']['stu_id']; ?></td>
              <td style="text-align: right;"><?php echo @$arr['num']['stu_pid']; ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['num']['stu_num']."".@$arr['num']['stu_name']." ".@$arr['num']['stu_sur'] ; ?>&nbsp;<?php if(@$arr['num']['stu_pic']){?><a href="<?php echo WEB_URL_IMG_STU.@$arr['num']['stu_pic']."";?>" data-toggle="lightbox" data-title="<?php echo @$arr['num']['stu_name']." ".@$arr['num']['stu_sur'] ; ?>"><i class="glyphicon glyphicon-user  img-fluid"></i></a><?php } ?></td>
              <td layout="block" style="text-align: left;"><?php echo @$arr['class']['class_name']; ?></td>
              <td layout="block" style="text-align: right;"><?php echo @$arr['num']['stu_cn']; ?></td>
              <td layout="block" style="text-align: right;"><?php echo @$arr['num']['stu_sphone']; ?></td>
              <td style="text-align: center;">
				<a href="index.php?name=config&file=student&op=detail&id=<?php echo @$arr['num']['stu_id'];?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-search-plus "></i></a>
				<a href="index.php?name=config&file=student&op=edit&stu_id=<?php echo @$arr['num']['stu_id']; ?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
			  </td>
            </tr>
            <?php $i++;} ?>
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
	<!-- /.col -->
</div>
<!-- /.row -->
<!-- /.row -->
<script>
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
</script>

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
        var aoColumns10 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable10 = $("#example10").dataTable({
								"aoColumns": aoColumns10,
								"responsive" : true,
								"dom" : 'lBfrtip',
								"pageLength" : 15,
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




<style>
/* USER PROFILE PAGE */
 .card {
    margin-top: 20px;
    padding: 30px;
    background-color: rgba(214, 224, 226, 0.2);
    -webkit-border-top-left-radius:5px;
    -moz-border-top-left-radius:5px;
    border-top-left-radius:5px;
    -webkit-border-top-right-radius:5px;
    -moz-border-top-right-radius:5px;
    border-top-right-radius:5px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: #fff;
    background-color: rgba(255, 255, 255, 1);
}
.card.hovercard .card-background {
    height: 130px;
}
.card-background img {
    -webkit-filter: blur(25px);
    -moz-filter: blur(25px);
    -o-filter: blur(25px);
    -ms-filter: blur(25px);
    filter: blur(25px);
    margin-left: -100px;
    margin-top: -200px;
    min-width: 130%;
}
.card.hovercard .useravatar {
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
}
.card.hovercard .useravatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255, 255, 255, 0.5);
}
.card.hovercard .card-info {
    position: absolute;
    bottom: 14px;
    left: 0;
    right: 0;
}
.card.hovercard .card-info .card-title {
    padding:0 5px;
    font-size: 20px;
    line-height: 1;
    color: #ffffff;
    background-color: rgba(255, 255, 255, 0.1);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.card.hovercard .card-info {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}
.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}
.btn-pref .btn {
    -webkit-border-radius:0 !important;
}
</style>
<?php } else { echo "<meta http-equiv='refresh' content='0; url=index.php'>"; }?>
