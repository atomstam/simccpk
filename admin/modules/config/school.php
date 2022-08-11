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
@$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_code='".$_SESSION['admin_school']."'"); 
 @$arr['sh']= $db->fetch(@$res['sh']);
//$img=@$arr['sh']['stu_pic'];

		if(empty(@$arr['sh']['sh_img'])){
		$Pic='../img/admin/default_avatar_male.jpg';
		} else {
		$Pic=WEB_URL_IMG_SCHOOL.@$arr['sh']['sh_img'];
		}
?>

      <div class="row">
        <div class="col-md-12">

<?php
//<form action="index.php?name=config&file=school&op=add&action=add&route=" method="post" //enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
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
			url: "modules/config/processschool.php",
			data: $('#formAdd').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=config&file=school&route=<?php echo $route;?>';
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
<script type="text/javascript">
$(function(){
 $("select#province").change(function(){
  var datalist2 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist2
     url: "modules/config/amphur.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
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
     url: "modules/config/tambol.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data:"amphur_id="+$(this).val(), // ส่งตัวแปร GET ชื่อ amphur ให้มีค่าเท่ากับ ค่าของ amphur
     async: false
  }).responseText;  
  $("select#tambol").html(datalist3); // นำค่า datalist2 มาแสดงใน listbox ที่ 3 ที่ชื่อ tambol
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });
});
</script>
		<div align="right" ><div class="form-group"><button class="btn btn-success" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=config&file=school&route=<?php echo $route;?>" class="btn btn-danger"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>
				<form method="post" enctype="multipart/form-data" id="formAdd" role="formAdd" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-success" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-download-alt"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_add; ?></h3>
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
							<br>
							</div>
							</div>
							<div class="form-group">
							<div class="col-sm-12" >
							<br>
							</div>
							</div>

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_name; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6"><input type="text" name="Sh_name"  class="form-control css-require"  placeholder="Name" value="<?php echo @$arr['sh']['sh_name']; ?>" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_eng; ?></label>
							<div class="col-md-6 col-sm-6 col-xs-6"><input type="text" name="Sh_eng"  class="form-control css-require"  placeholder="Eng" value="<?php echo @$arr['sh']['sh_eng']; ?>" ></div>						
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_start; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4" >
							<?php //$DateTimeStart=date('Y-m-d');?>
							<div class="input-group date" id="dp1" data-date="<?php //echo $DateTimeStart;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control css-require" name="Sh_start" class="form-control css-require" value="<?php echo @$arr['sh']['sh_start']; ?>">
							<span class="input-group-addon"><span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></span>
							</div>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_add; ?></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_num"  class="form-control css-require" placeholder="111/20" value="<?php echo @$arr['sh']['sh_num']; ?>" ></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_gr; ?></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_gr"  value="<?php echo @$arr['sh']['sh_gr']; ?>" class="form-control css-require" placeholder="10" ></div>
							</div>   
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_ban; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input type="text" name="Sh_ban"  value="<?php echo @$arr['sh']['sh_ban']; ?>" class="form-control css-require"  placeholder="nongmonpla" ></div>
							</div>   
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_prov; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4">
							<select name="Sh_prov" id="province" class="form-control css-require" required="required">
								<option value="0"><?php echo _text_box_table_school_prov_select;?></option>
								<?php 
							
							@$res['prov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." order by id"); 
							while (@$arr['prov'] = $db->fetch(@$res['prov'])){?>
								<option value="<?php echo @$arr['prov']['code'];?>" <?php if(@$arr['prov']['code']==@$arr['sh']['sh_prov']){ echo "selected ";}?>><?php echo @$arr['prov']['name'];?></option>
								<?php } ?>
								</select>
							</div>
							</div> 							
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_amp; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4">
							<select name="Sh_amp" id="amphur" class="form-control css-require" required="required">
							<option value=""><?php echo _text_box_table_school_amp_select;?></option>
								<?php 
								
								@$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where provinceID='".@$arr['sh']['sh_prov']."' order by id"); 
								while (@$arr['amp'] = $db->fetch(@$res['amp'])){?>
								<option value="<?php echo @$arr['amp']['amphur_code'];?>" <?php if(@$arr['amp']['amphur_code']==@$arr['sh']['sh_amp']){ echo "selected ";}?>><?php echo @$arr['amp']['name'];?></option>
								<?php } ?>
							</select>
							</div>
							</div> 
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_tambon; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4">
							<select name="Sh_tambon" id="tambol" class="form-control css-require" required="required">
								<option value=""><?php echo _text_box_table_school_tambon_select;?></option>
								<?php 
								
								@$res['tam'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where amphurID='".@$arr['sh']['sh_amp']."' order by id"); 
								while (@$arr['tam'] = $db->fetch(@$res['tam'])){?>
								<option value="<?php echo @$arr['tam']['tumbon_code'];?>" <?php if(@$arr['tam']['tumbon_code']==@$arr['sh']['sh_tambon']){ echo "selected ";}?>><?php echo @$arr['tam']['name'];?></option>
								<?php } ?>
							</select>
							</div>
							</div> 
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_post; ?></label>
							<div class="col-md-3 col-sm-3 col-xs-3"><input type="text" name="Sh_post"  value="<?php echo @$arr['sh']['sh_post']; ?>" class="form-control css-require"  placeholder="44000" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_phone; ?></label>
							<div class="col-md-3 col-sm-3 col-xs-3"><input type="text" name="Sh_phone"  id="inputPhone" class="form-control css-require"  placeholder="08923167" value="<?php echo @$arr['sh']['sh_phone']; ?>" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_email; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input type="email" name="Sh_email"  id="inputEmail" class="form-control css-require"  placeholder="atom@gmail.com" value="<?php echo @$arr['sh']['sh_email']; ?>" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_web; ?></label>
							<div class="col-md-3 col-sm-3 col-xs-3"><input type="text" name="Sh_web"  class="form-control css-require"  value="<?php echo @$arr['sh']['sh_web']; ?>" placeholder="www.school.ac.th"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_fb; ?></label>
							<div class="col-md-3 col-sm-3 col-xs-3"><input type="text" name="Sh_fb"  class="form-control css-require"  value="<?php echo @$arr['sh']['sh_fb']; ?>" placeholder="http://www.facebook.com/"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
<!--							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_stu; ?></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_stu"  class="form-control css-require"  value="<?php echo @$arr['sh']['sh_stu']; ?>" placeholder="2500"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_room; ?></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_room"  class="form-control css-require" value="<?php echo @$arr['sh']['sh_room']; ?>" placeholder="25"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_length_area; ?></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_length_area"  class="form-control css-require" value="<?php echo @$arr['sh']['sh_length_area']; ?>" placeholder="20  <?php echo _text_box_table_school_length_kilo; ?>"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_length_amp; ?></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_length_amp"  class="form-control css-require" value="<?php echo @$arr['sh']['sh_length_amphur']; ?>" placeholder="10 <?php echo _text_box_table_school_length_kilo; ?>"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
-->

						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_group; ?></label>
							<div class="col-md-3 col-sm-3 col-xs-3" >
							<select  class="form-control css-require" name="Sh_group" required="required">
							<option value="" selected disabled><?php echo _text_box_table_school_group_select;?></option>
							<?php
							
							@$res['final'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_FINAL." ORDER BY id ");
							while (@$arr['final'] = $db->fetch(@$res['final'])){
							echo "<option value=\"".@$arr['final']['id']."\"";
							if(@$arr['sh']['sh_group']==@$arr['final']['id']){echo " selected ";}
							echo ">".@$arr['final']['shfinal_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
						     <div class="form-group">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_cat; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4" >
							<select  class="form-control" name="Sh_cat">
							<option value="" selected disabled><?php echo _text_box_table_school_cat_select;?></option>
							<?php
							
							@$res['cat'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_GR." where ar_code='".$_SESSION['admin_area']."' ORDER BY id ");
							while (@$arr['cat'] = $db->fetch(@$res['cat'])){
							echo "<option value=\"".@$arr['cat']['id']."\"";
							if(@$arr['sh']['sh_cat']==@$arr['cat']['id']){echo " selected ";}
							echo ">".@$arr['cat']['grsch_name']." [".@$arr['cat']['grsch_detail']."]</option>";
							}
							?>
							</select>
							</div>
							</div>
<!--						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_level; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4" >
							<select  class="form-control css-require" name="Sh_level" required="required">
							<option value="" selected disabled><?php echo _text_box_table_school_level_select;?></option>
							<?php
							
							@$res['level'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_LEVEL." ORDER BY id ");
							while (@$arr['level'] = $db->fetch(@$res['level'])){
							echo "<option value=\"".@$arr['level']['id']."\"";
							if(@$arr['sh']['sh_level']==@$arr['level']['id']){echo " selected ";}
							echo ">".@$arr['level']['shlevel_name']." [".@$arr['level']['shlevel_level']."]</option>";
							}
							?>
							</select>
							</div>
							</div>
	--->
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_pic; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4" >
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
										maxFileSize: 2048,
										showClose: false,
										showCaption: false,
										browseLabel: '',
										removeLabel: '',
										uploadUrl: '../plugins/fileinput/upload_schoolicon.php',
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
							<font color="#FF0000">(<?php echo _text_box_table_school_pic_size1." "._I_SCHOOL_W." px "._text_box_table_school_pic_size2." "._I_SCHOOL_H." px"; ?>)</font>
							</div>
							</div>

							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_map_google; ?></label>
							<div class="col-md-3 col-sm-3 col-xs-3">
							Latitude  
							<input name="lat_value" type="text" id="lat_value" value="<?php echo @$arr['sh']['latitude']; ?>" class="form-control css-require"/>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
							Longitude  
							<input name="lon_value" type="text" id="lon_value" value="<?php echo @$arr['sh']['longitude']; ?>" class="form-control css-require"/>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
							Zoom  
							<input name="zoom_value" type="text" id="zoom_value" value="15" size="5" class="form-control css-require"/>  
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" >Google Map</label>
							<div class="col-md-6 col-sm-6 col-xs-6">
							<div id="map_canvas"></div>
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
<style type="text/css">
/* css กำหนดความกว้าง ความสูงของแผนที่ */
div#map_canvas{
    margin:auto;
    width:600px;
    height:550px;
    overflow:hidden;
}
</style>
<script src="https://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyBVi05i9Z5VUXffnl-VNIUUbgUrOqsNkiE" type="text/javascript"></script>
<script type="text/javascript"> 
function initialize() { 
  if (GBrowserIsCompatible()) { 
    var map = new GMap2(document.getElementById("map_canvas")); 
    var center = new GLatLng(16.185105530922964,103.3026332679749); // การกำหนดจุดเริ่มต้น
//    var center = new GLatLng(16.427453128302673,103.00498033340455); // การกำหนดจุดเริ่มต้น
    map.setCenter(center, 15);  // เลข 13 คือค่า zoom  สามารถปรับตามต้องการ 
    map.setUIToDefault(); 
     
    var marker = new GMarker(center, {draggable: true});  
    map.addOverlay(marker);
      
    GEvent.addListener(marker, "dragend", function() {
        var point = marker.getPoint();
        map.panTo(point);
 
        $("#lat_value").val(point.lat());
        $("#lon_value").val(point.lng());
        $("#zoom_value").val(map.getZoom());
 
    });  
      
  } 
} 
</script> 
<script type="text/javascript">
$(function(){
    initialize();
    $(document.body).unload(function(){
            GUnload();
    });
});
</script>
<?php
}else if($op=='edit' and $action==''){

		@$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_code='".$_SESSION['admin_school']."'"); 
		 @$arr['sh']= $db->fetch(@$res['sh']);
		//$img=@$arr['sh']['stu_pic'];
		$area=@$arr['sh']['sh_area'];
		$amp=@$arr['sh']['sh_amp'];
		if(empty(@$arr['sh']['sh_img'])){
		$Pic='../img/admin/default_avatar_male.jpg';
		} else {
		$Pic=WEB_URL_IMG_SCHOOL.@$arr['sh']['sh_img'];
		}

		@$res['schcon'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_CONFIG." WHERE shc_area='".$_SESSION['admin_area']."' and shc_code='".$_SESSION['admin_school']."' "); 
		@$arr['schcon'] =$db->fetch(@$res['schcon']);
		if(empty(@$arr['schcon']['shc_logo'])){
		$Logo='../img/admin/default_avatar_male.jpg';
		} else {
		$Logo=WEB_URL_IMG_UPLOAD.@$arr['schcon']['shc_logo'];
		}
		if(empty(@$arr['schcon']['shc_sig'])){
		$Sig='../img/admin/default_avatar_male.jpg';
		} else {
		$Sig=WEB_URL_IMG_UPLOAD.@$arr['schcon']['shc_sig'];
		}
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
 $("button#submitForm").click(function(){
			$('#formEdit').bootstrapValidator('validate');
			$.ajax({
			type: "POST",
			url: "modules/config/processschool.php",
			data: $('#formEdit').serialize(),
			success: function(msg){
				var messageText =msg.message;
		//		alert(messageText);
			if(messageText=='Success'){
//                 $("#thanks").html(msg.message),
				 $("#thanks").show();
				 $("#error").hide();
				 setTimeout(function() {
  				 window.location='index.php?name=config&file=school&route=<?php echo $route;?>';
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
     url: "modules/config/amphur.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data:"province_id="+$(this).val(), // ส่งตัวแปร GET ชื่อ province ให้มีค่าเท่ากับ ค่าของ province
     async: false
  }).responseText;  
  $("select#amphur").html(datalist2); // นำค่า datalist2 มาแสดงใน listbox ที่ 2 ที่ชื่อ amphur
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });


 $("select#amphur").change(function(){
  var datalist3 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist3
     url: "modules/config/tambol.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data:"amphur_id="+$(this).val(), // ส่งตัวแปร GET ชื่อ amphur ให้มีค่าเท่ากับ ค่าของ amphur
     async: false
  }).responseText;  
  $("select#tambol").html(datalist3); // นำค่า datalist2 มาแสดงใน listbox ที่ 3 ที่ชื่อ tambol
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });


 $("select#tambol").change(function(){
	 //var VV=$(this).val();
	 //alert(VV);
	$.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist3
		url: "modules/config/post.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
		data:"tambon_id="+$(this).val(), // ส่งตัวแปร GET ชื่อ amphur ให้มีค่าเท่ากับ ค่าของ amphur
		method: "GET",
		dataType: 'json',
        //async: false,
        contentType: "application/json; charset=utf-8",
		success: function(datax) {
			console.log(datax);
			//var DD=JSON.stringify(datax.respon);
			var DD=$.parseJSON(datax.respon);
			$("#Sh_post").val(DD);
			//alert(DD);
  		},
		error: function(datax) {
			console.log(datax);
		}
  });  
   // นำค่า datalist2 มาแสดงใน listbox ที่ 3 ที่ชื่อ tambol
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });

});
</script>
		<div align="right" ><div class="form-group"><button class="btn btn-success" type="submit" id="submitForm" name="submitForm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=config&file=school&route=<?php echo $route;?>" class="btn btn-danger"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div></div>
				<form method="post" enctype="multipart/form-data" id="formEdit" role="formEdit" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
					    <div class="box box-warning" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-edit"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_edit; ?></h3>
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
							<br>
							</div>
							</div>

							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_name; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-6 col-sm-6 col-xs-6"><input type="text" name="Sh_name"  class="form-control css-require"  placeholder="Name" value="<?php echo @$arr['sh']['sh_name']; ?>" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_eng; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-6 col-sm-6 col-xs-6"><input type="text" name="Sh_eng"  class="form-control css-require"  placeholder="Eng" value="<?php echo @$arr['sh']['sh_eng']; ?>" ></div>						
							</div>
							<div class="form-group  has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" >ชื่อผู้บริหาร&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-4 col-sm-6 col-xs-6"><input type="text" name="Sh_boss"  class="form-control css-require"  placeholder="Eng" value="<?php echo @$arr['sh']['sh_boss']; ?>" ></div>						
							</div>
							<!--<div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_start; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-2 col-sm-2 col-xs-2" >
							<?php //$DateTimeStart=date('Y-m-d');?>
							<input type='text' id="dp1" class="form-control css-require " name="Sh_start" class="form-control css-require" value="<?php echo @$arr['sh']['sh_start']; ?>" data-date-language="th">
							</div>
							</div>-->
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_add; ?></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_num"  class="form-control css-require" placeholder="111/20" value="<?php echo @$arr['sh']['sh_num']; ?>" ></div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_gr; ?></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_gr"  value="<?php echo @$arr['sh']['sh_gr']; ?>" class="form-control css-require" placeholder="10" ></div>
							</div>   
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_ban; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input type="text" name="Sh_ban"  value="<?php echo @$arr['sh']['sh_ban']; ?>" class="form-control css-require"  placeholder="nongmonpla" ></div>
							</div>   
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_prov; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-4 col-sm-4 col-xs-4">
							<select name="Sh_prov" id="province" class="form-control css-require" required="required">
								<option value="0"><?php echo _text_box_table_school_prov_select;?></option>
								<?php 
							
							@$res['prov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." order by id"); 
							while (@$arr['prov'] = $db->fetch(@$res['prov'])){?>
								<option value="<?php echo @$arr['prov']['code'];?>" <?php if(@$arr['prov']['code']==@$arr['sh']['sh_prov']){ echo "selected ";}?>><?php echo @$arr['prov']['name'];?></option>
								<?php } ?>
								</select>
							</div>
							</div> 							
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_amp; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-4 col-sm-4 col-xs-4">
							<select name="Sh_amp" id="amphur" class="form-control css-require" required="required">
							<option value=""><?php echo _text_box_table_school_amp_select;?></option>
								<?php 
								
								@$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where provinceID='".@$arr['sh']['sh_prov']."' order by id"); 
								while (@$arr['amp'] = $db->fetch(@$res['amp'])){?>
								<option value="<?php echo @$arr['amp']['amphur_code'];?>" <?php if(@$arr['amp']['amphur_code']==@$arr['sh']['sh_amp']){ echo "selected ";}?>><?php echo @$arr['amp']['name'];?></option>
								<?php } ?>
							</select>
							</div>
							</div> 
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_tambon; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-4 col-sm-4 col-xs-4">
							<select name="Sh_tambon" id="tambol" class="form-control css-require" required="required">
								<option value=""><?php echo _text_box_table_school_tambon_select;?></option>
								<?php 
								
								@$res['tam'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where amphurID='".@$arr['sh']['sh_amp']."' order by id"); 
								while (@$arr['tam'] = $db->fetch(@$res['tam'])){?>
								<option value="<?php echo @$arr['tam']['tumbon_code'];?>" <?php if(@$arr['tam']['tumbon_code']==@$arr['sh']['sh_tambon']){ echo "selected ";}?>><?php echo @$arr['tam']['name'];?></option>
								<?php } ?>
							</select>
							</div>
							</div> 
							<div class="form-group has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_post; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-3 col-sm-3 col-xs-3"><input type="text" name="Sh_post"  value="<?php echo @$arr['sh']['sh_post']; ?>" id="Sh_post" class="form-control css-require"  placeholder="44000" required ><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_phone; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-3 col-sm-3 col-xs-3"><input type="text" name="Sh_phone"  id="inputPhone" class="form-control css-require"  placeholder="08923167" value="<?php echo @$arr['sh']['sh_phone']; ?>" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_email; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input type="email" name="Sh_email"  id="inputEmail" class="form-control css-require"  placeholder="atom@gmail.com" value="<?php echo @$arr['sh']['sh_email']; ?>" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_web; ?></label>
							<div class="col-md-3 col-sm-3 col-xs-3"><input type="text" name="Sh_web"  class="form-control css-require"  value="<?php echo @$arr['sh']['sh_web']; ?>" placeholder="www.school.ac.th"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group " >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_fb; ?></label>
							<div class="col-md-3 col-sm-3 col-xs-3"><input type="text" name="Sh_fb"  class="form-control css-require"  value="<?php echo @$arr['sh']['sh_fb']; ?>" placeholder="http://www.facebook.com/"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
<!--							<div class="form-group  has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_stu; ?></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_stu"  class="form-control css-require"  value="<?php echo @$arr['sh']['sh_stu']; ?>" placeholder="2500"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>						
							</div>
							<div class="form-group  has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_room; ?></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_room"  class="form-control css-require" value="<?php echo @$arr['sh']['sh_room']; ?>" placeholder="25"><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div>
							</div>
			-->
							<div class="form-group  has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_length_area; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_length_area"  id="Sh_length_area" class="form-control css-require" value="<?php echo @$arr['sh']['sh_length_area']; ?>" >&nbsp;<font color="#FF0000"><?php echo _text_box_table_school_length_area_detail; ?></font></div>
							</div>
							<div class="form-group  has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_length_area_time; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_length_area_time"  id="Sh_length_area_time" class="form-control css-require" value="<?php if($arr['sh']['sh_length_area_time'] !=''){echo (@$arr['sh']['sh_length_area_time'])/60;} ?>" >&nbsp;<font color="#FF0000"><?php echo _text_box_table_school_length_area_time_detail; ?></font></div>
							</div>
							<div class="form-group  has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_length_amp; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_length_amp"  id="Sh_length_amp" class="form-control css-require" value="<?php echo @$arr['sh']['sh_length_amphur']; ?>" >&nbsp;<font color="#FF0000"><?php echo _text_box_table_school_length_amp_detail; ?></font></div>
							</div>
							<div class="form-group  has-feedback" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_length_amp_time; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-2 col-sm-2 col-xs-2"><input type="text" name="Sh_length_amp_time"  id="Sh_length_amp_time" class="form-control css-require" value="<?php if($arr['sh']['sh_length_amphur_time'] !=''){echo (@$arr['sh']['sh_length_amphur_time'])/60;} ?>">&nbsp;<font color="#FF0000"><?php echo _text_box_table_school_length_amp_time_detail; ?></font></div>
							</div>

						     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_group; ?>&nbsp;<font color="#FF0000">*</font></label>
							<div class="col-md-3 col-sm-3 col-xs-3" >
							<select  class="form-control css-require" name="Sh_group" required="required">
							<option value="" selected disabled><?php echo _text_box_table_school_group_select;?></option>
							<?php
							
							@$res['final'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_FINAL." ORDER BY id ");
							while (@$arr['final'] = $db->fetch(@$res['final'])){
							echo "<option value=\"".@$arr['final']['id']."\"";
							if(@$arr['sh']['sh_group']==@$arr['final']['id']){echo " selected ";}
							echo ">".@$arr['final']['shfinal_name']."</option>";
							}
							?>
							</select>
							</div>
							</div>
						     <div class="form-group">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_cat; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4" >
							<select  class="form-control" name="Sh_cat">
							<option value="" selected disabled><?php echo _text_box_table_school_cat_select;?></option>
							<?php
							
							@$res['cat'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_GR." where ar_code='".$_SESSION['admin_area']."' ORDER BY id ");
							while (@$arr['cat'] = $db->fetch(@$res['cat'])){
							echo "<option value=\"".@$arr['cat']['id']."\"";
							if(@$arr['sh']['sh_cat']==@$arr['cat']['id']){echo " selected ";}
							echo ">".@$arr['cat']['grsch_name']." [".@$arr['cat']['grsch_detail']."]</option>";
							}
							?>
							</select>
							</div>
							</div>
	<!--					     <div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_level; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4" >
							<select  class="form-control css-require" name="Sh_level" required="required">
							<option value="" selected disabled><?php echo _text_box_table_school_level_select;?></option>
							<?php
							
							@$res['level'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_LEVEL." ORDER BY id ");
							while (@$arr['level'] = $db->fetch(@$res['level'])){
							echo "<option value=\"".@$arr['level']['id']."\"";
							if(@$arr['sh']['sh_level']==@$arr['level']['id']){echo " selected ";}
							echo ">".@$arr['level']['shlevel_name']." [".@$arr['level']['shlevel_level']."]</option>";
							}
							?>
							</select>
							</div>
							</div>
				-->
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_pic; ?></label>
							<div class="col-md-4 col-sm-4 col-xs-4" >
								<!-- the avatar markup -->
								<div id="kv-avatar-errors-1" class="center-block" style="width:300px;display:none"></div>
								<div id="showFile" ></div>
								<input id="avatar-1" name="avatar-1" type="file" class="file-loading">
								<!-- your server code `avatar_upload.php` will receive `$_FILES['avatar']` on form submission -->
								<script>
									var btnCust1 = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
									'onclick="alert(\'Call your custom code here.\')">' +
									'<i class="glyphicon glyphicon-tag"></i>' +
									'</button>'; 
								$(document).ready(function () {
									$("#avatar-1").fileinput({
										overwriteInitial: true,
										maxFileSize: 2048,
										showClose: false,
										showCaption: false,
										browseLabel: '',
										removeLabel: '',
										uploadUrl: '../plugins/fileinput/upload_schoolicon.php',
										allowedFileExtensions: ['jpg', 'png', 'gif'],
										browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
										removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
										removeTitle: 'Cancel or reset changes',
										elErrorContainer: '#kv-avatar-errors-1',
										msgErrorClass: 'alert alert-block alert-danger',
										defaultPreviewContent: '<img src="<?php echo $Pic;?>" alt="Your Avatar" style="width:160px">',
										layoutTemplates: {main1: '{preview} ' +  btnCust1 + ' {remove} {browse}'},
										allowedFileExtensions: ["jpg", "png", "gif"]
									});
										$('#avatar-1').on('fileuploaded', function(event, data) {
										var formdata = data.form, files = data.files, 
												extradata = data.extra, responsedata = data.response;
	//											alert(responsedata)
												console.log('File batch upload success');
										 $("#showFile").append('<input type=hidden name=Icon1 value='+responsedata+'>');
										});
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>
							<font color="#FF0000">(<?php echo _text_box_table_school_pic_size1." "._I_SCHOOL_W." px "._text_box_table_school_pic_size2." "._I_SCHOOL_H." px"; ?>)</font>
							</div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" >Logo หน่วยงาน</label>
							<div class="col-md-4 col-sm-4 col-xs-4" >
								<!-- the avatar markup -->
								<div id="kv-avatar-errors-2" class="center-block" style="width:300px;display:none"></div>
								<div id="showFile2" ></div>
								<input id="avatar-2" name="avatar-2" type="file" class="file-loading">
								<!-- your server code `avatar_upload.php` will receive `$_FILES['avatar']` on form submission -->
								<script>
									var btnCust2 = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
									'onclick="alert(\'Call your custom code here.\')">' +
									'<i class="glyphicon glyphicon-tag"></i>' +
									'</button>'; 
								$(document).ready(function () {
									$("#avatar-2").fileinput({
										overwriteInitial: true,
										maxFileSize: 2048,
										showClose: false,
										showCaption: false,
										browseLabel: '',
										removeLabel: '',
										uploadUrl: '../plugins/fileinput/upload_logoicon.php',
										allowedFileExtensions: ['jpg', 'png', 'gif'],
										browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
										removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
										removeTitle: 'Cancel or reset changes',
										elErrorContainer: '#kv-avatar-errors-2',
										msgErrorClass: 'alert alert-block alert-danger',
										defaultPreviewContent: '<img src="<?php echo $Logo;?>" alt="Your Avatar" style="width:160px">',
										layoutTemplates: {main2: '{preview} ' +  btnCust2 + ' {remove} {browse}'},
										allowedFileExtensions: ["jpg", "png", "gif"]
									});
										$('#avatar-2').on('fileuploaded', function(event, data) {
										var formdata = data.form, files = data.files, 
												extradata = data.extra, responsedata = data.response;
	//											alert(responsedata)
												console.log('File batch upload success');
										 $("#showFile2").append('<input type=hidden name=Icon2 value='+responsedata+'>');
										});
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>
							<font color="#FF0000">(<?php echo " ขนาดกว้าง"._I_LOGO_SIG_W." px และสูง "._I_LOGO_SIG_H." px"; ?>)</font>
							</div>
							</div>
							<div class="form-group has-feedback">
							<label class="col-sm-3 control-label col-sm-pad" >ลายเซ็นต์ผู้บริหาร</label>
							<div class="col-md-4 col-sm-4 col-xs-4" >
								<!-- the avatar markup -->
								<div id="kv-avatar-errors-3" class="center-block" style="width:300px;display:none"></div>
								<div id="showFile3" ></div>
								<input id="avatar-3" name="avatar-3" type="file" class="file-loading">
								<!-- your server code `avatar_upload.php` will receive `$_FILES['avatar']` on form submission -->
								<script>
									var btnCust3 = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
									'onclick="alert(\'Call your custom code here.\')">' +
									'<i class="glyphicon glyphicon-tag"></i>' +
									'</button>'; 
								$(document).ready(function () {
									$("#avatar-3").fileinput({
										overwriteInitial: true,
										maxFileSize: 2048,
										showClose: false,
										showCaption: false,
										browseLabel: '',
										removeLabel: '',
										uploadUrl: '../plugins/fileinput/upload_sigicon.php',
										allowedFileExtensions: ['jpg', 'png', 'gif'],
										browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
										removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
										removeTitle: 'Cancel or reset changes',
										elErrorContainer: '#kv-avatar-errors-2',
										msgErrorClass: 'alert alert-block alert-danger',
										defaultPreviewContent: '<img src="<?php echo $Sig;?>" alt="Your Avatar" style="width:160px">',
										layoutTemplates: {main3: '{preview} ' +  btnCust3 + ' {remove} {browse}'},
										allowedFileExtensions: ["jpg", "png", "gif"]
									});
										$('#avatar-3').on('fileuploaded', function(event, data) {
										var formdata = data.form, files = data.files, 
												extradata = data.extra, responsedata = data.response;
	//											alert(responsedata)
												console.log('File batch upload success');
										 $("#showFile3").append('<input type=hidden name=Icon3 value='+responsedata+'>');
										});
								//	$("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
								});
							</script>
							<font color="#FF0000">(<?php echo " ขนาดกว้าง"._I_LOGO_SIG_W." px และสูง "._I_LOGO_SIG_H." px"; ?>)</font>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" ><?php echo _text_box_table_school_map_google; ?></label>
							<div class="col-md-3 col-sm-3 col-xs-3">
							Latitude  
							<input name="lat_value" type="text" id="lat_value" value="<?php echo @$arr['sh']['latitude']; ?>" class="form-control css-require"/>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
							Longitude  
							<input name="lon_value" type="text" id="lon_value" value="<?php echo @$arr['sh']['longitude']; ?>" class="form-control css-require"/>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
							Zoom  
							<input name="zoom_value" type="text" id="zoom_value" value="15" size="5" class="form-control css-require"/>  
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-3 control-label col-sm-pad" >Google Map</label>
							<div class="col-md-6 col-sm-6 col-xs-6">
							<div id="map_canvas"></div>
							</div>
							</div>


							<div class="form-group">
							<div class="col-sm-4" ><input type="hidden" name="OP"  value="Edit"><input name="SID" type="hidden" value="<?php echo @$arr['sh']['sh_code'];?>">
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
<script type="text/javascript">
$(function(){
    //initialize();
    $(document.body).unload(function(){
            GUnload();
    });
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAr6ZgHWvwwGvFEM2hAtmYr9rc-Ug2QFwU&callback=initialize" type="text/javascript"></script>
<script type="text/javascript">
var Lat = '<?php if(@$arr["sh"]["latitude"] !=""){echo @$arr["sh"]["latitude"]; } else { echo "0";}?>';
var Long = '<?php if(@$arr["sh"]["longitude"] !=""){ echo @$arr["sh"]["longitude"]; } else { echo "0";}?>';
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

		var AREA='<?php echo $area;?>';
		var AMP='<?php echo $amp;?>';
		var LAT=latPosition;
		var LNG=longPosition;

		$.ajax({
		url: "modules/config/school_length.php",
		method: "GET",
		data:"area="+AREA+"&lat="+LAT+"&lng="+LNG,
		dataType: 'json',
		success: function(datax) {
			console.log(datax);
			var Len=$.parseJSON(datax.Lengthx);
			var Tme=$.parseJSON(datax.Timex);
			//alert(Len);
			if(Len){
			$("#Sh_length_area").val(Len);
			}
			if(Tme){
			$("#Sh_length_area_time").val(Tme);
			}
  		},
		error: function(datax) {
			console.log(datax);
		}
		});

		$.ajax({
		url: "modules/config/amp_length.php",
		method: "GET",
		data:"amp="+AMP+"&lat="+LAT+"&lng="+LNG,
		dataType: 'json',
		success: function(data) {
			console.log(data);
			var Lenx=$.parseJSON(data.Length);
			var Tmex=$.parseJSON(data.Time);
			//alert(Len);
			if(Lenx){
			$("#Sh_length_amp").val(Lenx);
			}
			if(Tmex){
			$("#Sh_length_amp_time").val(Tmex);
			}
  		},
		error: function(data) {
			console.log(data);
		}
		});

		contentString = '<div id="iwContent">Lat: <span id="latbox">' + latPosition + '</span><br />Lng: <span id="lngbox">' + longPosition + '</span></div>';

		infowindowPhoto.setContent(contentString);
		infowindowPhoto.open(map, marker);
}

initialize();
</script> 

<?php
} else {

@$res['sh'] = $db->select_query("SELECT * FROM ".TB_SCHOOL." WHERE sh_area='".$_SESSION['admin_area']."' and sh_code='".$_SESSION['admin_school']."' "); 
 @$arr['sh']= $db->fetch(@$res['sh']);
		if(empty(@$arr['sh']['sh_img'])){
		$Img='../img/admin/default_avatar_male.jpg';
		} else {
		$Img=WEB_URL_IMG_SCHOOL.@$arr['sh']['sh_img'];
		}
		//echo $Pic;
@$res['area'] = $db->select_query("SELECT * FROM ".TB_AREA." WHERE area_code='".@$arr['sh']['sh_area']."' "); 
@$arr['area'] = $db->fetch(@$res['area']);
@$res['cat'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_GR." WHERE id='".@$arr['sh']['sh_cat']."' "); 
@$arr['cat'] = $db->fetch(@$res['cat']);
@$res['final'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_FINAL." where id='".@$arr['sh']['sh_group']."' ");
@$arr['final'] = $db->fetch(@$res['final']);
@$res['level'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_LEVEL." where id='".@$arr['sh']['sh_level']."' ");
@$arr['level'] = $db->fetch(@$res['level']);
@$res['prov'] = $db->select_query("SELECT * FROM ".TB_PROVINCE." where code='".@$arr['sh']['sh_prov']."' ");
@$arr['prov'] = $db->fetch(@$res['prov']);
@$res['amp'] = $db->select_query("SELECT * FROM ".TB_AMPHUR." where amphur_code='".@$arr['sh']['sh_amp']."' ");
@$arr['amp'] = $db->fetch(@$res['amp']);
@$res['tambon'] = $db->select_query("SELECT * FROM ".TB_TUMBON." where tumbon_code='".@$arr['sh']['sh_tambon']."' ");
@$arr['tambon'] = $db->fetch(@$res['tambon']);

@$res['schcon'] = $db->select_query("SELECT * FROM ".TB_SCHOOL_CONFIG." where shc_area='".$_SESSION['admin_area']."' and shc_code='".$_SESSION['admin_school']."' ");
@$arr['schcon'] = $db->fetch(@$res['schcon']);
		if(empty(@$arr['schcon']['shc_logo'])){
		$Pic='../img/admin/default_avatar_male.jpg';
		} else {
		$Pic=WEB_URL_IMG_UPLOAD.@$arr['schcon']['shc_logo'];
		}
		//echo $Pic;
?>

		<div align="right" >
		<div class="form-group">
		<a href="index.php?name=config&file=school&op=edit&sh_id=<?php echo $_SESSION['admin_school']; ?>&route=<?php echo $route;?>" class="btn btn-info"><i class="fa fa-edit "></i>&nbsp;<?php echo _button_edit; ?></a>
		</div>
		</div>

				<form method="post" enctype="multipart/form-data" id="form" class="form-horizontal" >
					    <div class="box box-info" id="loading-example">
                                <div class="box-header with-border">
                                <i class="glyphicon glyphicon-th"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?></h3>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								</div>
								<!-- /.box-header -->
                                <div class="box-body  ">
								<?php if(@$arr['schcon']['shc_logo']){?>
								<div class="card hovercard">
								<center><div class="col-md-12 col-sm-12 col-xs12" align="center">
									<img alt="" src="<?php echo $Pic;?>" width="150">
								</div></center>
								</div>
								<?php } ?>
								<?php if(@$arr['sh']['sh_img']){?>
								<div class="card hovercard">
								<center><div class="col-md-12 col-sm-12 col-xs12" align="center">
									<img alt="" src="<?php echo $Img;?>" width="100%">
								</div></center>
								</div>
								<?php } ?>
                <div class="col-md-12 col-sm-12 col-xs-12"> 
                  <table class="table table-striped">
                    <tbody>
                      <tr >
                        <td align="right" class="col-md-4 col-sm-4 col-xs-4"><?php echo _text_box_table_school_area; ?></td>
                        <td ><?php echo @$arr['area']['area_name']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_code; ?></td>
                        <td><?php echo @$arr['sh']['sh_code']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_name; ?></td>
                        <td><?php echo @$arr['sh']['sh_name']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_eng; ?></td>
                        <td><?php echo @$arr['sh']['sh_eng']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_start; ?></td>
                        <td><?php echo @FullDateThai($arr['sh']['sh_start']); ?></td>
                      </tr>
                      <tr>
                        <td align="right">ผู้บริหาร</td>
                        <td><?php echo @$arr['sh']['sh_boss']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_add; ?></td>
                        <td><?php echo @$arr['sh']['sh_num']; ?> หมู่ <?php echo @$arr['sh']['sh_gr']; ?> <?php echo @$arr['sh']['sh_ban']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_tambon; ?></td>
                        <td><?php echo @$arr['tambon']['name']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_amp; ?></td>
                        <td><?php echo @$arr['amp']['name']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_prov; ?></td>
                        <td><?php echo @$arr['prov']['name']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_post; ?></td>
                        <td><?php echo @$arr['sh']['sh_post']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_phone; ?></td>
                        <td><?php echo @$arr['sh']['sh_phone']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_email; ?></td>
                        <td><?php echo @$arr['sh']['sh_email']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_web; ?></td>
                        <td><?php echo @$arr['sh']['sh_web']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_fb; ?></td>
                        <td><?php echo @$arr['sh']['sh_fb']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_length_area; ?></td>
                        <td><?php echo @KILO(@$arr['sh']['sh_length_area']); ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_length_area_time; ?></td>
                        <td><?php echo @SECONDSTOHMS(@$arr['sh']['sh_length_area_time']); ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_length_amp; ?></td>
                        <td><?php echo @KILO(@$arr['sh']['sh_length_amphur']); ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_length_amp_time; ?></td>
                        <td><?php echo @SECONDSTOHMS(@$arr['sh']['sh_length_amphur_time']); ?></td>
                      </tr>
                      <!--<tr>
                        <td align="right"><?php echo _text_box_table_school_group; ?></td>
                        <td><?php echo @$arr['final']['shfinal_name']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_cat; ?></td>
                        <td><?php echo @$arr['cat']['grsch_name']; ?> [<?php echo @$arr['cat']['grsch_detail'];?>]</td>
                      </tr>
                      <tr>-->
                        <td align="right"><?php echo _text_box_table_school_level; ?></td>
                        <td><?php echo @$arr['level']['shlevel_name']; ?></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo _text_box_table_school_map_google; ?></td>
                        <td> Latitude : <?php echo @$arr['sh']['latitude']; ?><br>
								Longitude : <?php echo @$arr['sh']['longitude']; ?>
						</td>
                      </tr>
                       <tr>
                        <td align="right">Google Map</td>
                        <td><div id="map_canvas"></div></td>
					  </tr>

                    </tbody>
                  </table>
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
var Lat = '<?php echo @$arr["sh"]["latitude"];?>';
var Long = '<?php echo @$arr["sh"]["longitude"];?>';
var LatWest = (Lat + parseInt(0.8163255));
var LongWest = (Long + parseInt(0.2813898));
var LatEast = (Lat + parseInt(0.8160577));
var LongEast = (Long + parseInt(0.2817085));

var map;
var marker;
var infowindowPhoto = new google.maps.InfoWindow();
var latPosition;
var longPosition;

//alert(LongWest);
function initialize() {
  var mapOptions = {
    zoom: 15,
    center: new google.maps.LatLng(Lat,Long)
  };
 
  var map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
 
  // Add 5 markers to the map at random locations
  var southWest = new google.maps.LatLng(LatWest,LongWest);
  var northEast = new google.maps.LatLng(LatEast,LongEast);
 
  var bounds = new google.maps.LatLngBounds(southWest, northEast);
  //var bounds = new google.maps.LatLngBounds(Lat,Long);
  map.fitBounds(bounds);
 
  var lngSpan = northEast.lng() - southWest.lng();
  var latSpan = northEast.lat() - southWest.lat();
 
  for (var i = 0; i < 1; i++) {
	  var position = new google.maps.LatLng(Lat,Long);
    //var position = new google.maps.LatLng(
    //    southWest.lat() + latSpan * Math.random(),
    //    southWest.lng() + lngSpan * Math.random());
    var marker = new google.maps.Marker({
      position: position,
      map: map
    });
 
    marker.setTitle((i + 1).toString());
    attachSecretMessage(marker, i);
  }
}
 
 
function attachSecretMessage(marker, num) {
  var message = ["<?php echo @$arr['sh']['sh_name']; ?>"];
  var infowindow = new google.maps.InfoWindow({
    content: message[num]
  });
 
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(marker.get('map'), marker);
  });
}
 
google.maps.event.addDomListener(window, 'load', initialize);

</script> 
<script type="text/javascript">
$(function(){
    initialize();
    $(document.body).unload(function(){
            GUnload();
    });
});
</script>
	

	</form>

<?php
}
?>
</div>

<script type="text/javascript">
		$(function(){
			$('#dp1').datepicker({
				format: 'yyyy',
				language:'th-th',
				thaiyear: true,
				keyboardNavigation: false,
				viewMode: "years",
				minViewMode: "years"
			});
			$('#dp2').datepicker();
			$('#dp3').datepicker();
         });
</script>

		<script type="text/javascript">
        $(document).ready(function() {
        var aoColumns10 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
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
											className: 'btn btn-warning'
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
    -webkit-border-radius:0 !configant;
}
</style>
<?php } else { echo "<meta http-equiv='refresh' content='0; url=index.php'>"; }?>
