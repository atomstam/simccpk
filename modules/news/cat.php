<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
if(time() > $_SESSION['timeout']){
session_unset();
setcookie("user_login");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
$home ="index.php?name=article&file=cat&route=".$route."";
?>
<link href="../js/plugins/uploadify/css/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../js/plugins/uploadify/js/swfobject.js"></script>
<script type="text/javascript" src="../js/plugins/uploadify/js/jquery.uploadify-3.1.js"></script>
<style>
.upload {
    margin: 0 auto;
    width: 950px;
}
</style>

<div class="row">
<div class="col-xs-12 connectedSortable">
<!-- top row -->
	<div class="row">
		<div class="col-xs-12 connectedSortable">

<?php
if(!empty($_SESSION['user_login'])){

if($op=='add' and $action=='add'){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['article1'] = $db->select_query("SELECT *,MAX(id) as MAXS FROM ".TB_MAG_NAME." ");
	$arr['article1'] = $db->fetch($res['article1']);
	if( !empty($_POST['icon']) || !empty($_POST['category_name']) ){
		$add =$db->add_db(TB_MAG_NAME,array(
			"eng"=>"".$_POST['eng']."",
			"category_name"=>"".$_POST['category_name']."",
			"sort"=>"".$arr['article1']['MAXS']."",
			"icon"=>"".$_POST['icon']."",
			"post_date"=>"".TIMESTAMP.""
		));

	} else {
	$add='';
	}
	if($add){
	$success=_text_report_add_ok;
	} else {
	$error_warning=_text_report_add_fail;
	}

}

if($op=='edit' and $action=='edit'){

	if( !empty($_POST['SID'])){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$edit =$db->update_db(TB_MAG_NAME,array(
			"eng"=>"".$_POST['eng']."",
			"category_name"=>"".$_POST['category_name']."",
			"icon"=>"".$_POST['icon']."",
		)," id=".$_POST['SID']."");
	}


	if($edit){
	$success=_text_report_edit_ok;
	} else {
	$error_warning=_text_report_edit_fail;
	}
}
if($op=='del'){
		if(!empty($_GET['id'])){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['article'] = $db->select_query("SELECT * FROM ".TB_MAG_NAME." WHERE id='".$_GET['id']."' ");
		$arr['article'] = $db->fetch($res['article']);
		$del .=$db->del(TB_MAG_NAME," id='".$_GET['id']."' ");
		$del .=$db->del(TB_MAG_NUMBERS," mag_id='".$arr['article']['id']."' ");
		$del .=$db->del(TB_MAG_PAGE," mag_no_id='".$_GET['id']."' ");
		$db->closedb ();
		} else {
		$error_warning=_text_report_del_null_fail;
		}
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 

if($op=='delall'){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		while(list($key, $value) = each ($_POST['selected'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['article'] = $db->select_query("SELECT * FROM ".TB_MAG_NUMBERS." WHERE id='".$value."' ");
			$arr['article'] = $db->fetch($res['article']);
			$del .=$db->del(TB_MAG_NAME," id='".$value."' ");
			$del .=$db->del(TB_MAG_NUMBERS," mag_id='".$arr['article']['id']."' ");
			$del .=$db->del(TB_MAG_PAGE," mag_no_id='".$arr['article']['id']."' ");
			$db->closedb ();
		}
		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
}
?>
      <?php if ($success) { ?>
      <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo $success; ?></span>
      </div>
      <?php } ?>
      <?php if ($error_warning) { ?>
      <div class="alert alert-danger">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo $error_warning; ?></span>
      </div>
      <?php } ?>
<?php
if($op=='add' and $action=='' ){
?>

	       <script type="text/javascript">
            $(document).ready(function() {	
             load('');
                function load(FileObj){ //function load()
                var fileData = FileObj;
                    $.get(
                        '../js/plugins/uploadify/show_magcat.php?Obj='+fileData, //แสดงผลรูปที่เพิ่งอัพโหลดไปโดยผ่านไฟล์ show.php
                        {},
                        function(data){
                            $("#show").html(data); //ให้ไปแสดงผลที่ div id show
                            $("#showFile").append('<input type=hidden name=icon value='+fileData+'>');
                        }
                    );		
                }

                $('#file_upload').uploadify({
                        'auto'     : true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
                        'swf'      : '../js/plugins/uploadify/images/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
                        'uploader' : '../js/plugins/uploadify/uploadify_magcat.php', //เมื่อ submit แล้วให้ action ไปที่ไฟล์ไหน
                        'fileSizeLimit' : '1024KB',//อัพโหลดได้ครั้งละไม่เกิน 1024kb
                        'fileTypeExts' : '*.gif; *.jpg; *.png', //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
                        'multi'    : false,//เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
 //                       'queueSizeLimit' : 5, //อัพโหลดได้ครั้งละ 5 ไฟล์
                        'displayData': 'speed',
                        'simUploadLimit': 1,
                        'onUploadComplete' : function(file) { //เมื่ออัพโหลดเสร็จแล้วให้เรียกใช้งาน function load()
 //                       $("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
                        load(file.name);
                        }
                });

            });
        </script>

<div class="row">
   <div class="col-xs-12 connectedSortable">

<form action="index.php?name=article&file=cat&op=add&action=add&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submit" name="submit"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=article&file=cat&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>&nbsp;&nbsp;
		</div></div>

					    <div class="box box-danger" id="loading-example">
                                <div class="box-header">
                                <i class="fa fa-user"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body  ">

						     <div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_table_name; ?></label>
							<div class="col-sm-4" ><p class="form-control-static"><input type="text" name="category_name"  class="form-control" ></p>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-4 control-label" ><?php echo _text_box_form_eng; ?></label>
							<div class="col-sm-4"><p class="form-control-static"><input type="text" name="eng"  class="form-control" ></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_table_icon; ?></label>
							<div class="col-sm-3" >
							<div id="queue" class="col-sm-3"></div>
							<input id="file_upload" name="file_upload" type="file" >
							<div id="showFile" ></div>
							<div id="show" ></div>
							</div>
							</div>
							<div class="form-group">
							<br>
							</div>


							</div>
						</div>

</form>
</div>
</div>

<?php
}else if($op=='edit' and $action==''){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['num'] = $db->select_query("SELECT * FROM ".TB_MAG_NAME." WHERE id='".$_GET['id']."'"); 
 $arr['num']= $db->fetch($res['num']);
 $img=$arr['num']['icon'];
?>

	       <script type="text/javascript">
            $(document).ready(function() {	
             load('<?php echo $img;?>');
//             load('');
                function load(FileObj){ //function load()
                var fileData = FileObj;
                    $.get(
                        '../js/plugins/uploadify/show_magcat.php?Obj='+fileData, //แสดงผลรูปที่เพิ่งอัพโหลดไปโดยผ่านไฟล์ show.php
                        {},
                        function(data){
                            $("#show").html(data); //ให้ไปแสดงผลที่ div id show
                            $("#showFile").append('<input type=hidden name=icon value='+fileData+'>');
                        }
                    );		
                }

                $('#file_upload').uploadify({
                        'auto'     : true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
                        'swf'      : '../js/plugins/uploadify/images/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
                        'uploader' : '../js/plugins/uploadify/uploadify_magcat.php', //เมื่อ submit แล้วให้ action ไปที่ไฟล์ไหน
                        'fileSizeLimit' : '1024KB',//อัพโหลดได้ครั้งละไม่เกิน 1024kb
                        'fileTypeExts' : '*.gif; *.jpg; *.png', //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
                        'multi'    : false,//เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
 //                       'queueSizeLimit' : 5, //อัพโหลดได้ครั้งละ 5 ไฟล์
                        'displayData': 'speed',
                        'simUploadLimit': 1,
                        'onUploadComplete' : function(file) { //เมื่ออัพโหลดเสร็จแล้วให้เรียกใช้งาน function load()
 //                       $("#showFile").append('<input type=hidden name=icon value='+file.name+'>');
                        load(file.name);
                        }
                });

            });
        </script>
<div class="row">
   <div class="col-xs-12 connectedSortable">

<form action="index.php?name=article&file=cat&op=edit&action=edit&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" role="form" data-toggle="validator" class="form-horizontal bootstrap-validator-form" >
		<div align="right" ><div class="form-group"><button class="btn bg-green btn-flat" type="submit" id="submit" name="submit"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></button>&nbsp;&nbsp;<a href="index.php?name=article&file=cat&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>&nbsp;&nbsp;
		</div></div>

							    <div class="box box-danger" id="loading-example">
                                <div class="box-header">
                                <i class="fa fa-user"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_gen; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body  ">

						     <div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_table_name; ?></label>
							<div class="col-sm-4" ><p class="form-control-static"><input type="text" name="category_name"  class="form-control" value="<?php echo $arr['num']['category_name'];?>"></p>
							</div>
							</div>
							<div class="form-group" >
							<label class="col-sm-4 control-label" ><?php echo _text_box_form_eng; ?></label>
							<div class="col-sm-4"><p class="form-control-static"><input type="text" name="eng"  class="form-control" value="<?php echo $arr['num']['eng'];?>"></p></div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" ><?php echo _text_box_table_icon; ?></label>
							<div class="col-sm-3" >
							<div id="queue" class="col-sm-3"></div>
							<input id="file_upload" name="file_upload" type="file" >
							<div id="showFile" ></div>
							<div id="show" ></div>
							</div>
							</div>
							<div class="form-group">
							<br>
							</div>


							<input name="SID" type="hidden" value="<?php echo $_GET['id'];?>">

							</div>
						</div>
</FORM>
</div>
</div>
<?php
}else if($op=='detail'){
?>
<!-- top row -->
<div class="row">
	<!-- /col -->
	<div class="col-xs-12 connectedSortable">

    <div class="tab-pane fade active in" >
    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=article&file=index&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-edit"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a>&nbsp;&nbsp;</div>
      <br>
      </div>
    <div class="box box-info">
      <div class="box-body ">
	  <?php
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['num'] = $db->select_query("SELECT * FROM ".TB_ARTICLE." WHERE posted='".$user_login."' and category='".$_GET['id']."' order by id desc"); 
		$rows['num'] = @$db->rows($res['num']);
		if($rows['num']) {
		?>
      <form action="index.php?name=article&file=index&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example2" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check-all"></th>
              <th layout="block" style="text-align:center" ><?php echo _text_box_table_name; ?></th>
              <th layout="block" style="text-align:center"><?php echo _text_box_table_date; ?></th>
              <th layout="block" style="text-align:center"><?php echo _text_box_table_cat; ?></th>
			  <th layout="block" style="text-align:center"><?php echo _text_box_table_view;?></th>
              <th layout="block" style="text-align:center"><?php echo _text_box_table_rating;?></th>
              <th layout="block" style="text-align:center">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		while ($arr['num'] = $db->fetch($res['num'])){
		$res['cat'] = $db->select_query("SELECT * FROM ".TB_MAG_NAME." WHERE id='".$arr['num']['category']."' "); 
		$arr['cat'] = $db->fetch($res['cat']);
		?>

            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $arr['num']['id']; ?>" id="Checked" class="check"/></td>
              <td style="text-align: left;"><?php echo $arr['num']['topic']; ?>&nbsp;<?=NewsIcon(TIMESTAMP, $arr['num']['post_date'], "images/icon_new.gif");?></td>
              <td class="left"><?php echo ThaiTimeConvert($arr['num']['post_date'],'',''); ?></td>
              <td class="left"><?php echo $arr['cat']['category_name']; ?></td>
              </td>
              <td class="center"><?php echo $arr['num']['pageview']; ?></td>
              <td class="center"><?php echo $arr['num']['rating']; ?></td>
              <td style="text-align: center;">
			  <a href="index.php?name=article&file=index&op=detail&id=<?php echo $arr['num']['id'];?>&route=<?php echo $route;?>" class="label label-success"><i class="fa fa-search-plus "></i></a>
				<a href="index.php?name=article&file=index&op=edit&id=<?php echo $arr['num']['id']; ?>&route=<?php echo $route;?>" class="label label-info"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=article&file=index&op=del&id=<?php echo $arr['num']['id']; ?>&route=<?php echo $route;?>" class="label label-danger"><i class="fa fa-trash-o "></i></a>
			  </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>

            <?php } else { ?>
            <tr>
              <td class="center" colspan="5"><?php echo _text_no_results; ?></td>
            </tr>
            <?php } ?>
    </div>
    </div>
    </div>

	
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->

</div>
</div>
<?php
} else {
?>

	<script type="text/javascript" src="../js/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="../includes/fancybox/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="../includes/fancybox/jquery.fancybox.css" article="screen" />

	<script type="text/javascript">
		$(document).ready(function() {
			$(".mag").fancybox({
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe',
				'scrolling'   : 'no',
				'height': "<?php echo _MAG_PAGE_HEIGHT;?>",
				'width': "<?php echo _MAG_PAGE_WIDTH;?>"
			});
		});
	</script>
<!-- top row -->
<div class="row">
	<!-- /col -->
	<div class="col-xs-12 connectedSortable">

    <div class="box box-danger">
      <div class="box-body ">
	  <?php
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['cat'] = $db->select_query("SELECT * FROM ".TB_MAG_NAME." "); 
//		$arr['cat'] = $db->fetch($res['cat']);		
		$rows['cat'] = @$db->rows($res['cat']);
		if($rows['cat']) {
		?>
      <form action="index.php?name=article&file=cat&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;">ID</th>
              <th layout="block" style="text-align:center" ><?php echo _text_box_table_name; ?></th>
              <th layout="block" style="text-align:center"><?php echo _text_box_table_count; ?></th>
              <th layout="block" style="text-align:center"><?php echo _text_box_table_date; ?></th>
              <th layout="block" style="text-align:center"><?php echo _text_box_table_icon; ?></th>
              <th layout="block" style="text-align:center">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while ($arr['cat'] = $db->fetch($res['cat'])){
		$res['article'] = $db->select_query("SELECT * FROM ".TB_ARTICLE." where category='".$arr['cat']['id']."' and posted='".$user_login."' ");
		$rows['article'] = @$db->rows($res['article']);
		?>

            <tr>
              <td style="text-align: center;"><?php echo $i;?></td>
              <td style="text-align: left;"><?php echo $arr['cat']['category_name']; ?>&nbsp;<?=NewsIcon(TIMESTAMP, $arr['cat']['post_date'], "images/icon_new.gif");?></td>
              <td style="text-align: center;"><?php echo $rows['article']; ?></td>
              <td class="left"><?php echo ThaiTimeConvert($arr['cat']['post_date'],'',''); ?></td>
              <td style="text-align: center;"><img src="<?php echo WEB_URL_IMG_CAT.$arr['cat']['icon']; ?>" width="50"></td>
              <td style="text-align: center;">
			  <a href="index.php?name=article&file=cat&op=detail&id=<?php echo $arr['cat']['id'];?>&route=<?php echo $route;?>" class="label label-success"><i class="fa fa-search-plus "></i></a>
			  </td>
            </tr>
            <?php $i++;} ?>
          </tbody>
        </table>
      </form>

            <?php } else { ?>
            <tr>
              <td class="center" colspan="5"><?php echo _text_no_results; ?></td>
            </tr>
            <?php } ?>
    </div>
    </div>
    </div>

	
	</div>
<?php
}
?>

        <script type="text/javascript">
        $(function() {
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });
            });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
        var aoColumns = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": false , 'aTargets': [ 0 ]},
                              /* 4 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
                               "aoColumns": aoColumns
                              });
        var aoColumns2 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 3 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 5 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 6 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example2").dataTable({
                               "aoColumns": aoColumns2
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


