<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
if(time() > $_SESSION['timeout'] && $_SESSION['admin_group'] !=1){
session_unset();
setcookie("admin_login");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
require_once("modules/access/function.php");
$home ="index.php?name=access&file=birthd&route=".$route."";
?>


<?php
if(!empty($_SESSION['admin_login'])){
$del='';
$add='';
$edit='';
if($op=='delcom'){
		
		@$res['res'] = $db->select_query("SELECT * FROM ".TB_BIRTH_COM." WHERE mc_id='".$_GET['McID']."'  "); 
		@$rows['res'] = $db->rows(@$res['res']);
		if(@$rows['res']){
		@$arr['res'] = $db->fetch(@$res['res']);
		$q['up'] = "UPDATE ".TB_BIRTH." SET hbd_comm = hbd_comm-1 WHERE hbd_id = '".@$arr['res']['mc_ms']."' ";
		$sql['up'] = mysql_query ( $q['up'] ) or sql_error ( "db-query",mysql_error() );
		$del =$db->del(TB_BIRTH_COM," mc_id='".$_GET['McID']."'  ");

		} else {
		$error_warning=_text_report_del_null_fail;
		}

		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 

if($op=='del'){
		
		@$res['res'] = $db->select_query("SELECT * FROM ".TB_BIRTH." WHERE hbd_id='".$_GET['MsID']."'  "); 
		@$rows['res'] = $db->rows(@$res['res']);
		if(@$rows['res']){
		$del =$db->del(TB_BIRTH," hbd_id='".$_GET['MsID']."' ");
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
		
		while(list($key, $value) = each ($_POST['selected'])){
		@$res['res'] = $db->select_query("SELECT * FROM ".TB_BIRTH." WHERE hbd_id='".$value."'  "); 
		@$rows['res'] = $db->rows(@$res['res']);
		if(@$rows['res']){
		$del =$db->del(TB_BIRTH," hbd_id='".$value."' ");
		} else {
		$error_warning=_text_report_del_null_fail;
		}
		}

		if($del){
		$success=_text_report_del_ok;
		} else {
		$error_warning=_text_report_del_fail;
		}
} 

if($op=='add' and $action=='add'){
		if($_POST['hbd_topic']){
		
		$add=$db->add_db(TB_BIRTH,array(
			"hbd_topic"=>"".$_POST['hbd_topic']."",
			"hbd_message"=>"".$_POST['hbd_message']."",
			"hbd_posted"=>"".$admin_login."",
			"hbd_to"=>"".$_POST['hbd_to']."",
			"hbd_date"=>"".TIMESTAMP."",
			"hbd_year"=>"".date('Y').""
		));
		}

	if($add){
	$success=_text_report_add_ok;
	} else {
	$error_warning=_text_report_add_fail;
	}

}
if($op=='edit' and $action=='edit'){
		if($_POST['hbd_topic'] ){
		
		$edit=$db->update_db(TB_BIRTH,array(
			"hbd_topic"=>"".$_POST['hbd_topic']."",
			"hbd_message"=>"".$_POST['hbd_message']."",
			"hbd_posted"=>"".$admin_login."",
			"hbd_to"=>"".$_POST['hbd_to']."",
			"hbd_up"=>"".TIMESTAMP.""
		),"  hbd_id='".$_POST['MsID']."' " );
		}

	if($edit){
	$success=_text_report_edit_ok;
	} else {
	$error_warning=_text_report_edit_fail;
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
      <div class="alert alert-danger">
     <button type="button" class="close" data-dismiss="alert">X</button>
      <span><?php echo $error_warning; ?></span>
      </div>
	  <?php } ?>
<?php
if($op=='add' and $action==''){
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">
		<div class="buttons" align="right"><a onclick="$('#form').submit();" class="btn bg-green btn-flat"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></a>
		</div><br>

<div class="row">
   <div class="col-xs-12 connectedSortable">

<form action="index.php?name=access&file=birthd&op=add&action=add&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal">

					    <div class="box box-success" id="loading-example">
                                <div class="box-header">
                                <i class="fa fa-folder-open"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_message; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body  ">

							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_message_topic; ?></label>
							<div class="col-sm-4" ><p class="form-control-static">
							<input type="text" name="hbd_topic" class="form-control">
							</p>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_message_detail; ?></label>
							<div class="col-sm-6" ><p class="form-control-static">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="hbd_message"></textarea>
							</p>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_message_to; ?></label>
							<div class="col-sm-4" ><p class="form-control-static">
							<select  class="form-control" name="hbd_to" >
							<option value="all"><?php echo _text_body_select_list_all;?></option>
							<?php
							
							@$res['res'] = $db->select_query("SELECT * FROM ".TB_ADMIN." where username !='".$admin_login."' order by admin_id"); 
							while (@$arr['res'] = $db->fetch(@$res['res'])){
							echo 	"<option value=".@$arr['res']['username'].">".@$arr['res']['firstname']." ".@$arr['res']['lastname']."</option>";
							}
							?>
							</select>
							</p>
							</div>
							</div>

							<div class="form-group">
							<br>
							</div>

							</div>
						</div>

</div>
</div>

</div>
</div>
<?php
} else if($op=='edit' and $action==''){

@$res['ms'] = $db->select_query("SELECT * FROM ".TB_BIRTH." where hbd_id='".$_GET['MsID']."'  ");
@$arr['ms'] = $db->fetch(@$res['ms']);
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">
		<div class="buttons" align="right"><a onclick="$('#form').submit();" class="btn bg-green btn-flat"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></a>&nbsp;&nbsp;<a href="index.php?name=access&file=birthd&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>
		</div><br>

<div class="row">
   <div class="col-xs-12 connectedSortable">

<form action="index.php?name=access&file=birthd&op=edit&action=edit&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal">
<div id="myTabContent" class="tab-content">
<input type="hidden" name="MsID" value="<?php echo @$arr['ms']['hbd_id'];?>">
					    <div class="box box-success" id="loading-example">
                                <div class="box-header">
                                <i class="fa fa-folder-open"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_message; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body  ">

							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_message_topic; ?></label>
							<div class="col-sm-4" ><p class="form-control-static">
							<input type="text" name="hbd_topic" class="form-control" value="<?php echo @$arr['ms']['hbd_topic'];?>">
							</p>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_message_detail; ?></label>
							<div class="col-sm-6" ><p class="form-control-static">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="hbd_message"><?php echo @$arr['ms']['hbd_message'];?></textarea>
							</p>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_message_to; ?></label>
							<div class="col-sm-4" ><p class="form-control-static">
							<select  class="form-control" name="hbd_to" disabled>
							<option value="all"><?php echo _text_body_select_list_all;?></option>
							<?php
							
							@$res['res'] = $db->select_query("SELECT * FROM ".TB_ADMIN." where username !='".$admin_login."' order by admin_id"); 
							while (@$arr['res'] = $db->fetch(@$res['res'])){
							echo 	"<option value=".@$arr['res']['username']."";
							if(@$arr['ms']['hbd_posted']==@$arr['res']['username']){ echo " selected";}
							echo " >".@$arr['res']['firstname']." ".@$arr['res']['lastname']."</option>";
							}
							?>
							</select>
							</p>
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
</div>
</div>
<?php
}else if($op=='detail' and $action==''){
//$_POST['MsID']='';
//$_POST['mc_message']='';

if(empty($_POST['mc_message'])){
$q['up'] = "UPDATE ".TB_BIRTH." SET hbd_views = hbd_views+1 WHERE hbd_id = '".$_GET['MsID']."' ";
$sql['up'] = mysql_query ( $q['up'] ) or sql_error ( "db-query",mysql_error() );

@$res['ck']=$db->select_query("SELECT * FROM ".TB_BIRTH_CHECK." where msc_user='".$admin_login."' and msc_mss='".$_GET['MsID']."' ");
@$arr['ck'] = $db->rows(@$res['ck']);
if(!@$arr['ck']){
		$db->add_db(TB_BIRTH_CHECK,array(
//			"msc_school"=>"".$user_school."",
			"msc_user"=>"".$admin_login."",
			"msc_mss"=>"".$_GET['MsID']."",
			"msc_date"=>"".TIMESTAMP."",
			"msc_year"=>"".date('Y').""
		));
} else {
		$db->update_db(TB_BIRTH_CHECK,array(
			"msc_date"=>"".TIMESTAMP.""
		),"  msc_mss='".$_GET['MsID']."' ");
}

} else {
		$db->add_db(TB_BIRTH_COM,array(
			"mc_ms"=>"".$_POST['MsID']."",
			"mc_message"=>"".$_POST['mc_message']."",
			"mc_posted"=>"".$admin_login."",
			"mc_date"=>"".TIMESTAMP."",
			"mc_year"=>"".date('Y').""
		));
$q['up'] = "UPDATE ".TB_BIRTH." SET hbd_comm = hbd_comm+1 WHERE hbd_id = '".$_POST['MsID']."' ";
$sql['up'] = mysql_query ( $q['up'] ) or sql_error ( "db-query",mysql_error() );

}


@$res['ms'] = $db->select_query("SELECT * FROM ".TB_BIRTH." where hbd_id='".$_GET['MsID']."' ");
@$arr['ms'] = $db->fetch(@$res['ms']);
?>
<div class="row">
   <div class="col-xs-12 connectedSortable">
		<div class="buttons" align="right"><a href="index.php?name=access&file=birthd&op=edit&MsID=<?php echo $_GET['MsID'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_edit; ?></a>
		</div><br>

<div class="row">
   <div class="col-xs-12 connectedSortable">

<form action="" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal">
<div id="myTabContent" class="tab-content">

					    <div class="box box-success" id="loading-example">
                                <div class="box-header">
                                <i class="fa fa-folder-open"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_message_detail; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body  ">

                        <div class="col-md-12">
                            <!-- The time line -->
                            <ul class="timeline">
                                <!-- timeline time label -->
							<?php
							@$res['mss'] = $db->select_query("SELECT * FROM ".TB_BIRTH." where hbd_id='".$_GET['MsID']."' ");
							@$arr['mss'] = $db->fetch(@$res['mss']);
							@$res['usere'] = $db->select_query("SELECT * FROM ".TB_ADMIN." where username='".@$arr['mss']['hbd_posted']."' "); 
							@$arr['usere'] = $db->fetch(@$res['usere']);
							?>
                                <li class="time-label">
                                    <span class="bg-red">
                                        <?php echo ThaiTimeConvert(@$arr['mss']['hbd_date'],"","");?>
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
								<li>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo fb_date(@$arr['mss']['hbd_date']);?></span>
                                        <h3 class="timeline-header"><a href=""><?php echo @$arr['mss']['hbd_posted'];?></a> : <?php echo @$arr['mss']['hbd_topic'];?></h3>
                                        <div class="timeline-body">
										 <img src="<?php if(@$arr['usere']['img']){echo WEB_URL_IMG_ADMIN.@$arr['usere']['img'];}else{echo WEB_URL_IMG_ADMIN."no_image.jpg";}?>" width="50" height="50"  class="img-circle" alt="User Image"/>&nbsp;
										<?php echo @$arr['mss']['hbd_message'];?>
                                        </div>
                                        <div class='timeline-footer'>
										<?php if($admin_login==@$arr['usere']['username']){?>
                                            <a class="btn btn-danger btn-xs" href="index.php?name=access&file=birthd&op=del&route=<?php echo $route;?>&MsID=<?php echo @$arr['mss']['hbd_id'];?>">Delete</a>
										<?php } ?>
                                            <a class="btn bg-orange btn-flat btn-xs">Views : <?php echo @$arr['mss']['hbd_views'];?></a>
                                            <a class="btn btn-info btn-xs">Commment : <?php echo @$arr['mss']['hbd_comm'];?></a>
                                        </div>
                                    </div>
								</li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
								<?php
								@$res['mc'] = $db->select_query("SELECT * FROM ".TB_BIRTH_COM." where mc_ms='".@$arr['mss']['hbd_id']."' order by mc_id");
								$i=1;
								$k=0;
								@$resultArray = array();
								while (@$arr['mc'] = $db->fetch(@$res['mc'])){
								$dateback=(@$arr['mc']['mc_id'])-1;
								@$res['mcc'] = $db->select_query("SELECT * FROM ".TB_BIRTH_COM." where mc_id='".$dateback."' ");
								@$arr['mcc'] = $db->fetch(@$res['mcc']);
								@$res['usert'] = $db->select_query("SELECT * FROM ".TB_ADMIN." where username='".@$arr['mc']['mc_posted']."' "); 
								@$arr['usert'] = $db->fetch(@$res['usert']);
								$TimeLaBelbefor=date('Y-m-d', @$arr['mcc']['mc_date']);
								$TimeLaBelback=date('Y-m-d', @$arr['mc']['mc_date']);
								$strdate = explode("-",$TimeLaBelback);
								$strdateto = explode("-",$TimeLaBelbefor);
								$d1= mktime(0, 0, 0, $strdateto['1'], $strdateto['2'], $strdateto['0']);
								$d2= mktime(0, 0, 0, $strdate['1'], $strdate['2'], $strdate['0']);
								//$TimeLaBelNew[$i]=date("Y-m-d", strtotime("+1 day", strtotime($TimeLaBel[$i])));
								?>
								<?php if($i==1){
								?>
								 <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="<?php echo $timeLabel[$i];?>">
                                        <?php echo ThaiTimeConvert(@$arr['mc']['mc_date'],"","");?>
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
								<?php
								} else {?>
								<?php if($d1 < $d2){?>
								 <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="<?php echo $timeLabel[$i];?>">
                                        <?php echo ThaiTimeConvert(@$arr['mc']['mc_date'],"","");?>
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
								<?php } ?>
								<?php } ?>
                                <li>
                                    <i class="<?php echo $timeIcon[$i];?> <?php echo $timeBg[$i];?>"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo fb_date(@$arr['mc']['mc_date']);?></span>
                                        <h3 class="timeline-header">Comment : <?php echo $i;?> , Posted by : <a href="#"><?php echo @$arr['mc']['mc_posted'];?></a></h3>
                                        <div class="timeline-body">
   										 <img src="<?php if(@$arr['usert']['img']){echo WEB_URL_IMG_ADMIN.@$arr['usert']['img'];}else{echo WEB_URL_IMG_ADMIN."no_image.jpg";}?>" width="50" height="50"  class="img-circle" alt="User Image"/>&nbsp;
										<?php echo @$arr['mc']['mc_message'];?>
                                        </div>
										<?php if($admin_login==@$arr['usert']['username']){?>
                                        <div class='timeline-footer'>
                                            <a class="btn btn-danger btn-xs" href="index.php?name=access&file=birthd&op=delcom&route=<?php echo $route;?>&McID=<?php echo @$arr['mc']['mc_id'];?>">Delete</a>
                                        </div>
										<?php } ?>
                                    </div>
                                </li>
                                <!-- END timeline item -->
								<?php
								$k++;
								$i++;
								}
								?>
                                <li>
                                    <i class="fa fa-clock-o"></i>
                                </li>

							</ul>
							</div>
							<form action="index.php?name=access&file=birthd&op=detail&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal">
							<input type="hidden" name="MsID" value="<?php echo $_GET['MsID'];?>">
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_comment_add; ?></label>
							<div class="col-sm-8" ><p class="form-control-static">
							<textarea name="mc_message" class="form-control" id="editor1" rows="5" cols="80"></textarea>
							</p>
							</div>
							<div align="right" class="col-sm-11">
							<br>
							<button type="submit" name="submit" class="btn bg-aqua btn-flat"><?php echo _button_save;?></button>
							<br>
							</div>
							</form>
							<div class="form-group">
							<br>
							</div>

							</div>
						</div>
	</form>
</div>
</div>

</div>
</div>

<?php } else { 
	
		$HBD_Y=date("Y");
		$HBD_m=date("m");
		$HBD_d=date("d");
		@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT."  where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' and stu_birth like '%-$HBD_m-%' order by stu_class,stu_id desc"); 
		@$rows['stu'] = $db->rows(@$res['stu']);	
?>
<div class="row">
<div class="col-xs-12 connectedSortable">

    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=access&file=birthd&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-save"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a></div>
      <br>
      </div>
    <div class="box box-danger">
	         <div class="box-header with-border">
                 <i class="fa fa-user"></i>
                 <h3 class="box-title"><?php echo _heading_title; ?></h3>
              <div class="box-tools pull-right">
			  <span class="badge bg-yellow"><?php echo _text_box_table_count." ".@$rows['stu'];?></span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
      <div class="box-body ">
	  <?php
		if(@$rows['stu']) {
		?>
      <form action="index.php?name=access&file=birthd&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check" class="selector flat all"></th>
              <th  style="text-align: center;"><?php echo _table_heading_table_birth_stu; ?></th>
              <th  style="text-align: center;"><?php echo _table_heading_table_birth_class; ?></th>
              <th  style="text-align: center;"><?php echo _table_heading_table_birth_room; ?></th>
              <th  style="text-align: center;"><?php echo _table_heading_table_birth_birth; ?></th>
              <th  style="text-align: center;"><?php echo _text_box_table_count_bb; ?></th>
              <th  style="text-align: center;"><?php echo _table_heading_table_birth_comment; ?></th>
              <th  style="text-align: center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['stu'] = $db->fetch(@$res['stu'])){

		@$res['com'] = $db->select_query("SELECT * FROM ".TB_BIRTH."  where hbd_area='".$_SESSION['admin_area']."' and hbd_code='".$_SESSION['admin_code']."' and hbd_stu='".@$arr['stu']['stu_id']."' order by hbd_id desc"); 
		@$rows['com'] = $db->rows(@$res['com']);
		@$arr['com'] = $db->fetch(@$res['com']);
		@$res['cl'] = $db->select_query("SELECT * FROM ".TB_CLASS.",".TB_CLASS_GROUP."  where class_id='".@$arr['stu']['stu_class']."' and class_id=clg_group"); 
		@$arr['cl'] = $db->fetch(@$res['cl']);

		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['stu']['stu_id']; ?>" class="selector flat"/></td>
              <td style="text-align: left;"><?php echo @$arr['stu']['stu_num']."".@$arr['stu']['stu_name']." ".@$arr['stu']['stu_sur']; ?></td>
              <td style="text-align: center;"><?php echo @$arr['cl']['class_name']; ?></td>
              <td class="left"><?php echo @$arr['cl']['clg_name']; ?></td>
              <td style="text-align: center;"><?=ShortDateThai(@$arr['stu']['stu_birth']);?></td>
              <td style="text-align: center;"><?php echo @$rows['com'];?></td>
              <td  style="text-align: center;"><ul class="massages"><li><?php if(@$rows['com']){ echo "<i class=\"fa fa-comment bg-green\"></i>";} else { echo "<i class=\"fa fa-comment-o bg-yellow\"></i>";}?></ul>
			  </td>
              <td style="text-align: center;">
				<a href="index.php?name=access&file=birthd&op=detail&MsID=<?php echo @$arr['com']['hbd_id']; ?>&route=<?php echo $route;?>" class="btn bg-green btn-flat btn-sm"><i class="fa fa-search-plus "></i></a>
				<a href="index.php?name=access&file=birthd&op=edit&MsID=<?php echo @$arr['com']['hbd_id']; ?>&route=<?php echo $route;?>" class="btn bg-aqua btn-flat btn-sm"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=access&file=birthd&op=del&MsID=<?php echo @$arr['com']['hbd_id']; ?>&route=<?php echo $route;?>" class="btn bg-red btn-flat btn-sm"><i class="fa fa-trash-o "></i></a>
			  </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
		</form>

		<table>
		<tr>
              <td class="left"><ul class="massages"><li><i class="fa fa-comment bg-green"></i>&nbsp;&nbsp;<?php echo _text_box_icon_read;?></li></ul></td>
		</tr>
		<tr>
              <td class="left"><ul class="massages"><li><i class="fa fa-comment-o bg-yellow"></i>&nbsp;&nbsp;<?php echo _text_box_icon_unread;?></li></ul></td>
		</tr>
		</table>

            <?php } else { ?>
			<table>
            <tr>
              <td class="center" colspan="5"><?php echo _text_no_results; ?></td>
            </tr>
			</table>
            <?php } ?>
    </div>
    </div>


	
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->

    </div>
    </div>

<?php } ?>
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
                              /* 0 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": false , 'aTargets': [ 0 ]},
                              /* 3 */ { "bSortable": false , 'aTargets': [ 0 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 5 */ { "bSortable": false , 'aTargets': [ 0 ]}
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
//				oTable = $("#example1").dataTable();
        var aoColumns2 = [
                              /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1]},
                              /* 1 */ { "bSortable": false , 'aTargets': [ 0 ]},
                              /* 2 */ { "bSortable": false , 'aTargets': [ 0 ]},
                              /* 3 */ { "bSortable": false , 'aTargets': [ 0 ]},
                              /* 4 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $('#example2').dataTable({
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
								}
//								"tableTools": {
//									"sSwfPath": "../plugins/datatables/swf/copy_csv_xls_pdf.swf"
//								}
                              });
        var aoColumns3 = [
                              /* 0 */ { "bSortable": false , "sWidth": "25%" , 'aTargets': [ 0 ]},
                              /* 1 */ { "bSortable": false , "sWidth": "5%" , 'aTargets': [ 0 ]},
                              /* 2 */ { "bSortable": false , "sWidth": "10%" , 'aTargets': [ 0 ]},
                              /* 3 */ { "bSortable": false , "sWidth": "10%" , 'aTargets': [ 0 ]},
                              /* 4 */ { "bSortable": false , "sWidth": "10%" , 'aTargets': [ 0 ]},
                              /* 5 */ { "bSortable": false , "sWidth": "10%" , 'aTargets': [ 0 ]},
                              /* 6 */ { "bSortable": false , "sWidth": "5%" , 'aTargets': [ 0 ]},
                              /* 7 */ { "bSortable": false , "sWidth": "15%" , 'aTargets': [ 0 ]},
                              /* 8 */ { "bSortable": false , "sWidth": "10%" , 'aTargets': [ 0 ]}
                                  ]
               oTable = $('#example3').dataTable({
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
								}
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

<?php require_once ("modules/index/footer.php"); ?>
<?php } else { echo "<meta http-equiv='refresh' content='1; url=index.php'>"; }?>


