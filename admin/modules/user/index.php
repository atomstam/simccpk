<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
if(time() > $_SESSION['timeout']){
session_unset();
setcookie("admin_login");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
$home ="index.php?name=user&file=index&route=".$route."";
?>

<style>
.upload {
    margin: 0 auto;
    width: 950px;
}
</style>



<?php
if(!empty($_SESSION['admin_login'])){

if($op=='edit' and $action=='edit'){

$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." where user_id !='".$_GET['userId']."' order by user_id "); 
$arr['user'] = $db->fetch($res['user']);
if($arr['user']['username']!=$_POST['username'] && $arr['user']['email']!=$_POST['email'] ){
$added=date("Y-m-d H:i:s");
		
		if($_POST['password']){
		$edit=$db->update_db(TB_USER,array(
			"username"=>"".$_POST['username']."",
			"firstname"=>"".$_POST['firstname']."",
			"lastname"=>"".$_POST['lastname']."",
			"password"=>"".md5($_POST['password'])."",
			"email"=>"".$_POST['email']."",
			"status"=>"1",
			"date_added"=>"".$added."",
			"img"=>"".$_POST['user_img'].""
		)," user_id='".$_GET['userId']."' ");

		$edit .=$db->update_db(TB_MASSAGES,array(
			"ms_posted"=>"".$_POST['username']."",
		)," ms_posted='".$_POST['OldName']."' ");

		$edit .=$db->update_db(TB_MASSAGES_COM,array(
			"mc_posted"=>"".$_POST['username']."",
		)," mc_posted='".$_POST['OldName']."' ");

		$edit .=$db->update_db(TB_MASSAGES_CHECK,array(
			"msc_user"=>"".$_POST['username']."",
		)," msc_user='".$_POST['OldName']."' ");

		$edit .=$db->update_db(TB_ASS,array(
			"as_posted"=>"".$_POST['username']."",
		)," as_posted='".$_POST['OldName']."' ");

		$edit .=$db->update_db(TB_ACTIVEUSER,array(
			"ct_user"=>"".$_POST['username']."",
		)," ct_user='".$_POST['OldName']."' and ct_school='' ");

		$edit .=$db->update_db(TB_ADMIN_ONLINE,array(
			"u_user"=>"".$_POST['username']."",
		)," u_user='".$_POST['OldName']."' ");

		} else {
		$edit=$db->update_db(TB_USER,array(
			"username"=>"".$_POST['username']."",
			"firstname"=>"".$_POST['firstname']."",
			"lastname"=>"".$_POST['lastname']."",
			"email"=>"".$_POST['email']."",
			"status"=>"1",
			"date_added"=>"".$added."",
			"img"=>"".$_POST['user_img'].""
		)," user_id='".$_GET['userId']."' ");

		$edit .=$db->update_db(TB_MASSAGES,array(
			"ms_posted"=>"".$_POST['username']."",
		)," ms_posted='".$_POST['OldName']."' ");

		$edit .=$db->update_db(TB_MASSAGES_COM,array(
			"mc_posted"=>"".$_POST['username']."",
		)," mc_posted='".$_POST['OldName']."' ");

		$edit .=$db->update_db(TB_MASSAGES_CHECK,array(
			"msc_user"=>"".$_POST['username']."",
		)," msc_user='".$_POST['OldName']."' ");

		$edit .=$db->update_db(TB_ASS,array(
			"as_posted"=>"".$_POST['username']."",
		)," as_posted='".$_POST['OldName']."' ");

		$edit .=$db->update_db(TB_ACTIVEUSER,array(
			"ct_user"=>"".$_POST['username']."",
		)," ct_user='".$_POST['OldName']."' and ct_school='' ");

		$edit .=$db->update_db(TB_ADMIN_ONLINE,array(
			"u_user"=>"".$_POST['username']."",
		)," u_user='".$_POST['OldName']."' ");

		}
		} else {
		$error_warning ="Username or Email used  ";
		}

	if($edit){
	$success .=_text_report_edit_ok;
	$success .="<meta http-equiv='refresh' content='1; url=index.php?name=user&file=logout&route=".$route."'>";
	} else {
	$error_warning .=_text_report_edit_fail;
	}
}
?>
      <?php if ($success) { ?>
      <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo $success; 	?></span>
      </div>
      <?php } ?>
      <?php if ($error_warning) { ?>
      <div class="alert alert-danger">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo $error_warning; ?></span>
      </div>
      <?php } ?>
<?php
 if($op=='edit' and $action==''){

$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." WHERE user_id='".$_GET['userId']."' "); 
$arr['user'] = $db->fetch($res['user']);
$usercode=$arr['user']['user_id'];
$userimg=$arr['user']['img'];
?>
	       <script type="text/javascript">
            $(document).ready(function() {	
            '<?php if($usercode){ ?>';
             load('<?php echo $userimg;?>');
             '<? } ?>';
                function load(FileObj){ //function load()
                var fileData = FileObj;
                    $.get(
                        'js/plugins/uploadify/show_user.php?Obj='+fileData, //????????????????????????????????????? show.php
                        {},
                        function(data){
                            $("#show").html(data); //?????????????? div id show
                            $("#showFile").append('<input type=hidden name=user_img value='+fileData+'>');
                        }
                    );		
                }

                $('#file_upload').uploadify({
                        'auto'     : true, //??????????????????????????????
                        'swf'      : 'js/plugins/uploadify/images/uploadify.swf', //?????????????????????????????
                        'uploader' : 'js/plugins/uploadify/uploadify_user.php', //????? submit ??????? action ????????????
                        'fileSizeLimit' : '1024KB',//???????????????????????? 1024kb
                        'fileTypeExts' : '*.gif; *.jpg; *.png', //???????????????????????????????????
                        'multi'    : false,//???????????????????????????????????????????
 //                       'queueSizeLimit' : 5, //????????????????? 5 ????
                        'displayData': 'speed',
                        'simUploadLimit': 1,
                        'onUploadComplete' : function(file) { //??????????????????????????????????? function load()
 //                       $("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
                        load(file.name);
                        }
                });
            });
        </script>


		<div class="buttons" align="right" ><a onclick="$('#form').submit();" class="btn bg-green btn-flat btn-sm" ><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></a>&nbsp;&nbsp;<a href="index.php?name=user&file=index&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>&nbsp;&nbsp;
		</div>
		<br>
<div class="row">
   <div class="col-xs-12 connectedSortable">

	  <?php
		
		$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." WHERE user_id='".$_GET['userId']."' "); 
		$arr['user'] = $db->fetch($res['user']);
		?>
		<form action="index.php?name=user&file=index&op=edit&action=edit&userId=<?php echo $arr['user']['user_id'];?>&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal" >
		<input type="hidden" name="OldName" value="<?php echo $arr['user']['username'];?>">
					    <div class="box box-info" id="loading-example">
                                <div class="box-header">
                                <i class="fa fa-user"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body  ">

							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_name; ?></label>
							<div class="col-sm-4" ><p class="form-control-static"><input type="text" name="firstname" class="form-control" value="<?php echo $arr['user']['firstname'];?>"></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_surname; ?></label>
							<div class="col-sm-4" ><p class="form-control-static"><input type="text" name="lastname" class="form-control" value="<?php echo $arr['user']['lastname'];?>"></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_username; ?></label>
							<div class="col-sm-2" ><p class="form-control-static"><input type="text" name="username" class="form-control" value="<?php echo $arr['user']['username'];?>"></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" >password</label>
							<div class="col-sm-2" ><p class="form-control-static"><input type="text" name="password" class="form-control" ></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_email; ?></label>
							<div class="col-sm-3" ><p class="form-control-static"><input type="text" name="email" class="form-control" value="<?php echo $arr['user']['email'];?>"></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_img; ?></label>
							<div class="col-sm-3" >
							<div id="queue" class="col-sm-3"></div>
							<input id="file_upload" name="file_upload" type="file" >
							<div id="showFile" ></div>
							<div id="show" ></div>
							</div>

							<div class="form-group">
							<br>
							</div>
		</form>
</div>
</div>
<?php
} else {

$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$admin_login."' "); 
$arr['user'] = $db->fetch($res['user']);
$usercode=$arr['user']['admin_id'];
$userimg=$arr['user']['img'];
?>
	       <script type="text/javascript">
            $(document).ready(function() {	
            '<?php if($usercode){ ?>';
             load('<?php echo $userimg;?>');
             '<? } ?>';
                function load(FileObj){ //function load()
                var fileData = FileObj;
                    $.get(
                        'js/plugins/uploadify/show_user.php?Obj='+fileData, //????????????????????????????????????? show.php
                        {},
                        function(data){
                            $("#show").html(data); //?????????????? div id show
                            $("#showFile").append('<input type=hidden name=user_img value='+fileData+'>');
                        }
                    );		
                }

                $('#file_upload').uploadify({
                        'auto'     : true, //??????????????????????????????
                        'swf'      : 'js/plugins/uploadify/images/uploadify.swf', //?????????????????????????????
                        'uploader' : 'js/plugins/uploadify/uploadify_user.php', //????? submit ??????? action ????????????
                        'fileSizeLimit' : '1024KB',//???????????????????????? 1024kb
                        'fileTypeExts' : '*.gif; *.jpg; *.png', //???????????????????????????????????
                        'multi'    : false,//???????????????????????????????????????????
 //                       'queueSizeLimit' : 5, //????????????????? 5 ????
                        'displayData': 'speed',
                        'simUploadLimit': 1,
                        'onUploadComplete' : function(file) { //??????????????????????????????????? function load()
 //                       $("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
                        load(file.name);
                        }
                });
            });
        </script>
    <div align="right" >
    <br>
      <div class="buttons"><a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_edit; ?></a>&nbsp;&nbsp;</div>
      <br>
      </div>

	  <?php
		
		$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$admin_login."' "); 
		$arr['user'] = $db->fetch($res['user']);
		?>
		<form action="index.php?name=user&file=index&op=edit&userId=<?php echo $arr['user']['admin_id'];?>&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal" >

					    <div class="box box-info" id="loading-example">
                                <div class="box-header">
                                <i class="fa fa-user"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?></h3>
                                </div><!-- /.box-header -->
                            <div class="box-body  ">

							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_name; ?></label>
							<div class="col-sm-4" ><p class="form-control-static"><?php echo $arr['user']['firstname'];?></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_surname; ?></label>
							<div class="col-sm-4" ><p class="form-control-static"><?php echo $arr['user']['lastname'];?></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_username; ?></label>
							<div class="col-sm-2" ><p class="form-control-static"><?php echo $arr['user']['username'];?></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_email; ?></label>
							<div class="col-sm-3" ><p class="form-control-static"><?php echo $arr['user']['email'];?></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_body_user_img; ?></label>
							<div class="col-sm-3" >
							<div id="show" ></div>
							</div>

							<div class="form-group">
							<br>
							</div>

						</div>
						</div>
		</form>


<?php
}
?>

<script type="text/javascript">
		$(function(){
			$('#dp3').datepicker();
         });
</script>


        <script type="text/javascript">
        $(function() {
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
            });
        </script>
<script>
$(function () {
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  var target = $(e.target).attr("href") // activated tab
  if ($(target).is(':empty')) {
    $.ajax({
      type: "GET",
      url: "/article/",
      error: function(data){
        alert("There was a problem");
      },
      success: function(data){
        $(target).html(data);
      }
  })
}
})
})
</script>

        <script type="text/javascript">
        $(document).ready(function() {
        var aoColumns = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
                               "aoColumns": aoColumns
                              });

            });
        </script>
        <script type="text/javascript">
         $(function() {
                //When unchecking the checkbox
                $("#check-all").on('ifUnchecked', function(event) {
                    //Uncheck all checkboxes
                    $("input[type='checkbox']", ".table-bordered").iCheck("uncheck");
                });
                //When checking the checkbox
                $("#check-all").on('ifChecked', function(event) {
                    //Check all checkboxes
                    $("input[type='checkbox']", ".table-bordered").iCheck("check");
                });
          });
        </script>


<?php require_once ("modules/index/footer.php"); ?>
<?php } else { echo "<meta http-equiv='refresh' content='1; url=index.php'>"; }?>


