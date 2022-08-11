<?php 
//require_once ("mainfile.php"); 
//require_once ("header.php"); 
if(time() > $_SESSION['timeout']){
session_unset();
setcookie("admin_login");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
require_once("function.php");
$home ="index.php?name=message&file=index&route=".$route."";
?>


<?php
if(!empty($_SESSION['admin_login'])){

if($op=='delcom'){
		
		@$res['res'] = $db->select_query("SELECT * FROM ".TB_MESSAGE_COM." WHERE mc_id='".$_GET['McID']."'  "); 
		@$rows['res'] = $db->rows(@$res['res']);
		if(@$rows['res']){
		@$arr['res'] = $db->fetch(@$res['res']);
		$q['up'] = "UPDATE ".TB_MESSAGE." SET ms_comm = ms_comm-1 WHERE ms_id = '".@$arr['res']['mc_ms']."' ";
		$sql['up'] = mysql_query ( $q['up'] ) or sql_error ( "db-query",mysql_error() );
		$del =$db->del(TB_MESSAGE_COM," mc_id='".$_GET['McID']."'  ");

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
		
		@$res['res'] = $db->select_query("SELECT * FROM ".TB_MESSAGE." WHERE ms_id='".$_GET['MsID']."'  "); 
		@$rows['res'] = $db->rows(@$res['res']);
		if(@$rows['res']){
		$del =$db->del(TB_MESSAGE," ms_id='".$_GET['MsID']."' ");
		$del .=$db->del(TB_MESSAGE_CHECK," msc_mss='".$_GET['MsID']."' ");
		$del .=$db->del(TB_MESSAGE_COM," mc_ms='".$_GET['MsID']."'  ");
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
		@$res['res'] = $db->select_query("SELECT * FROM ".TB_MESSAGE." WHERE ms_id='".$value."'  "); 
		@$rows['res'] = $db->rows(@$res['res']);
		if(@$rows['res']){
		$del =$db->del(TB_MESSAGE," ms_id='".$value."' ");
		$del .=$db->del(TB_MESSAGE_CHECK," msc_mss='".$value."' ");
		$del .=$db->del(TB_MESSAGE_COM," mc_ms='".$value."'  ");
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
		if($_POST['ms_topic']){
		
		$add=$db->add_db(TB_MESSAGE,array(
			"ms_topic"=>"".$_POST['ms_topic']."",
			"ms_message"=>"".$_POST['ms_message']."",
			"ms_posted"=>"".$admin_login."",
			"ms_to"=>"".$_POST['ms_to']."",
			"ms_date"=>"".TIMESTAMP."",
			"ms_year"=>"".date('Y').""
		));
		}

	if($add){
	$success=_text_report_add_ok;
	} else {
	$error_warning=_text_report_add_fail;
	}

}
if($op=='edit' and $action=='edit'){
		if($_POST['ms_topic'] ){
		
		$edit=$db->update_db(TB_MESSAGE,array(
			"ms_topic"=>"".$_POST['ms_topic']."",
			"ms_message"=>"".$_POST['ms_message']."",
			"ms_posted"=>"".$admin_login."",
			"ms_to"=>"".$_POST['ms_to']."",
			"ms_up"=>"".TIMESTAMP.""
		),"  ms_id='".$_POST['MsID']."' " );
		}

	if($edit){
	$success=_text_report_edit_ok;
	} else {
	$error_warning=_text_report_edit_fail;
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
if($op=='add' and $action==''){
?>

		<div class="buttons" align="right"><a onclick="$('#form').submit();" class="btn bg-green btn-flat btn-sm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></a>&nbsp;&nbsp
		</div><br>

<div class="row">
   <div class="col-xs-12 connectedSortable">

<form action="index.php?name=message&file=index&op=add&action=add&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal">

					    <div class="box box-success" id="loading-example">
                                <div class="box-header">
                                <i class="fa fa-folder-open"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_message; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body  ">

							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_message_topic; ?></label>
							<div class="col-sm-4" ><p class="form-control-static">
							<input type="text" name="ms_topic" class="form-control">
							</p>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_message_detail; ?></label>
							<div class="col-sm-6" ><p class="form-control-static">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="ms_message"></textarea>
							</p>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_message_to; ?></label>
							<div class="col-sm-4" ><p class="form-control-static">
							<select  class="form-control" name="ms_to" >
							<option value="all"><?php echo _text_body_select_list_all;?></option>
							<?php
							
							@$res['res'] = $db->select_query("SELECT * FROM ".TB_ADMIN." where username !='".$admin_login."' order by admin_id"); 
							while (@$arr['res'] = $db->fetch(@$res['res'])){
							echo 	"<option value=".@$arr['res']['username'].">".@$arr['res']['username']." ".@$arr['res']['firstname']." ".@$arr['res']['lastname']."</option>";
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

<?php
} else if($op=='edit' and $action==''){

@$res['ms'] = $db->select_query("SELECT * FROM ".TB_MESSAGE." where ms_id='".$_GET['MsID']."'  ");
@$arr['ms'] = $db->fetch(@$res['ms']);
?>

		<div class="buttons" align="right"><a onclick="$('#form').submit();" class="btn bg-green btn-flat btn-sm"><i class="fa fa-save"></i>&nbsp;<?php echo _button_save; ?></a>&nbsp;&nbsp;<a href="index.php?name=message&file=index&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_reset; ?></a>&nbsp;&nbsp;
		</div><br>

<div class="row">
   <div class="col-xs-12 connectedSortable">

<form action="index.php?name=message&file=index&op=edit&action=edit&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal">
<div id="myTabContent" class="tab-content">
<input type="hidden" name="MsID" value="<?php echo @$arr['ms']['ms_id'];?>">
					    <div class="box box-success" id="loading-example">
                                <div class="box-header">
                                <i class="fa fa-folder-open"></i>
                                    <h3 class="box-title"><?php echo _text_box_header_message; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body  ">

							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_message_topic; ?></label>
							<div class="col-sm-4" ><p class="form-control-static">
							<input type="text" name="ms_topic" class="form-control" value="<?php echo @$arr['ms']['ms_topic'];?>">
							</p>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_message_detail; ?></label>
							<div class="col-sm-6" ><p class="form-control-static">
							<textarea class="form-control" id="editor1" rows="5" cols="80" name="ms_message"><?php echo @$arr['ms']['ms_message'];?></textarea>
							</p>
							</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label" ><?php echo _text_box_body_message_to; ?></label>
							<div class="col-sm-4" ><p class="form-control-static">
							<select  class="form-control" name="ms_to" disabled>
							<option value="all"><?php echo _text_body_select_list_all;?></option>
							<?php
							
							@$res['res'] = $db->select_query("SELECT * FROM ".TB_USER." where username !='".$admin_login."' order by user_id"); 
							while (@$arr['res'] = $db->fetch(@$res['res'])){
							echo 	"<option value=".@$arr['res']['username']."";
							if(@$arr['ms']['ms_posted']==@$arr['res']['username']){ echo " selected";}
							echo " >".@$arr['res']['username']." ".@$arr['res']['firstname']." ".@$arr['res']['lastname']."</option>";
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
<?php
}else if($op=='detail' and $action==''){

if(!$_POST['mc_message']){
$q['up'] = "UPDATE ".TB_MESSAGE." SET ms_views = ms_views+1 WHERE ms_id = '".$_GET['MsID']."' ";
$sql['up'] = mysql_query ( $q['up'] ) or sql_error ( "db-query",mysql_error() );

@$res['ck']=$db->select_query("SELECT * FROM ".TB_MESSAGE_CHECK." where msc_mss='".$_GET['MsID']."' ");
@$arr['ck'] = $db->rows(@$res['ck']);
if(!@$arr['ck']){
		$db->add_db(TB_MESSAGE_CHECK,array(
			"msc_school"=>"".$user_school."",
			"msc_user"=>"".$admin_login."",
			"msc_mss"=>"".$_GET['MsID']."",
			"msc_date"=>"".TIMESTAMP."",
			"msc_year"=>"".date('Y').""
		));
} else {
		$db->update_db(TB_MESSAGE_CHECK,array(
			"msc_date"=>"".TIMESTAMP.""
		),"  msc_mss='".$_GET['MsID']."' ");
}

} else {
		$db->add_db(TB_MESSAGE_COM,array(
			"mc_ms"=>"".$_POST['MsID']."",
			"mc_message"=>"".$_POST['mc_message']."",
			"mc_posted"=>"".$admin_login."",
			"mc_date"=>"".TIMESTAMP."",
			"mc_year"=>"".date('Y').""
		));
$q['up'] = "UPDATE ".TB_MESSAGE." SET ms_comm = ms_comm+1 WHERE ms_id = '".$_POST['MsID']."' ";
$sql['up'] = mysql_query ( $q['up'] ) or sql_error ( "db-query",mysql_error() );

}
@$res['ms'] = $db->select_query("SELECT * FROM ".TB_MESSAGE." where ms_id='".$_GET['MsID']."' ");
@$arr['ms'] = $db->fetch(@$res['ms']);
?>

		<div class="buttons" align="right"><a href="index.php?name=message&file=index&op=edit&MsID=<?php echo $_GET['MsID'];?>&route=<?php echo $route;?>" class="btn bg-red btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_edit; ?></a>&nbsp;&nbsp;
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
							@$res['mss'] = $db->select_query("SELECT * FROM ".TB_MESSAGE." where ms_id='".$_GET['MsID']."' ");
							@$arr['mss'] = $db->fetch(@$res['mss']);
							@$res['usere'] = $db->select_query("SELECT * FROM ".TB_USER." where username='".@$arr['mss']['ms_posted']."' "); 
							@$arr['usere'] = $db->fetch(@$res['usere']);
							?>
                                <li class="time-label">
                                    <span class="bg-red">
                                        <?php echo ThaiTimeConvert(@$arr['mss']['ms_date'],"","");?>
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
								<li>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo fb_date(@$arr['mss']['ms_date']);?></span>
                                        <h3 class="timeline-header"><a href=""><?php echo @$arr['mss']['ms_posted'];?></a> : <?php echo @$arr['mss']['ms_topic'];?></h3>
                                        <div class="timeline-body">
										 <img src="<?php if(@$arr['usere']['img']){echo WEB_URL_IMG_USER.@$arr['usere']['img'];}else{echo WEB_URL_IMG_USER."no_image.jpg";}?>" width="50" height="50"  class="img-circle" alt="User Image"/>&nbsp;
										<?php echo @$arr['mss']['ms_message'];?>
                                        </div>
                                        <div class='timeline-footer'>
										<?php if($admin_login==@$arr['usere']['username']){?>
                                            <a class="btn btn-danger btn-xs" href="index.php?name=message&file=index&op=del&route=<?php echo $route;?>&MsID=<?php echo @$arr['mss']['ms_id'];?>">Delete</a>
										<?php } ?>
                                            <a class="btn bg-orange btn-flat btn-xs">Views : <?php echo @$arr['mss']['ms_views'];?></a>
                                            <a class="btn btn-info btn-xs">Commment : <?php echo @$arr['mss']['ms_comm'];?></a>
                                        </div>
                                    </div>
								</li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
								<?php
								@$res['mc'] = $db->select_query("SELECT * FROM ".TB_MESSAGE_COM." where mc_ms='".@$arr['mss']['ms_id']."' order by mc_id");
								$i=1;
								$k=0;
								@$resultArray = array();
								while (@$arr['mc'] = $db->fetch(@$res['mc'])){
								$dateback=(@$arr['mc']['mc_id'])-1;
								@$res['mcc'] = $db->select_query("SELECT * FROM ".TB_MESSAGE_COM." where mc_id='".$dateback."' ");
								@$arr['mcc'] = $db->fetch(@$res['mcc']);
								@$res['usert'] = $db->select_query("SELECT * FROM ".TB_USER." where username='".@$arr['mc']['mc_posted']."' "); 
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
   										 <img src="<?php if(@$arr['usert']['img']){echo WEB_URL_IMG_USER.@$arr['usert']['img'];}else{echo WEB_URL_IMG_USER."no_image.jpg";}?>" width="50" height="50"  class="img-circle" alt="User Image"/>&nbsp;
										<?php echo @$arr['mc']['mc_message'];?>
                                        </div>
										<?php if($admin_login==@$arr['usert']['username']){?>
                                        <div class='timeline-footer'>
                                            <a class="btn btn-danger btn-xs" href="index.php?name=message&file=index&op=delcom&route=<?php echo $route;?>&McID=<?php echo @$arr['mc']['mc_id'];?>">Delete</a>
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
							<form action="#" method="post" enctype="multipart/form-data" id="form" role="form" class="form-horizontal">
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

<?php } else { ?>
<div class="row">
<div class="col-xs-12 connectedSortable">

    <div align="right" >
    <br>
      <div class="buttons"><a href="index.php?name=message&file=index&op=add&route=<?php echo $route;?>" class="btn bg-aqua btn-flat"><i class="fa fa-save"></i>&nbsp;<?php echo _button_add; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="$('form').submit();" class="btn bg-red btn-flat"><i class="fa fa-trash-o"></i>&nbsp;<?php echo _button_del; ?></a>&nbsp;&nbsp;</div>
      <br>
      </div>
    <div class="box box-danger">
      <div class="box-body ">
	  <?php
		
		@$res['ms'] = $db->select_query("SELECT * FROM ".TB_MESSAGE."  order by ms_id desc"); 
		@$rows['ms'] = $db->rows(@$res['ms']);
		if(@$rows['ms']) {
		?>
      <form action="index.php?name=message&file=index&op=delall&route=<?php echo $route;?>" method="post" enctype="multipart/form-data" id="form" class="form-inline">
        <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
          <thead>
            <tr >
              <th width="1" style="text-align: center;"><input type="checkbox" id="check-all"></th>
              <th  style="text-align: center;"><?php echo _table_heading_table_message_topic; ?></th>
              <th  style="text-align: center;"><?php echo _table_heading_table_message_views; ?></th>
              <th  style="text-align: center;"><?php echo _table_heading_table_message_comm; ?></th>
              <th  style="text-align: center;"><?php echo _table_heading_table_message_posted; ?></th>
              <th  style="text-align: center;"><?php echo _table_heading_table_message_date; ?></th>
              <th  style="text-align: center;">Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
		$i=1;
		while (@$arr['ms'] = $db->fetch(@$res['ms'])){
		@$res['com'] = $db->select_query("SELECT * FROM ".TB_MESSAGE_CHECK." WHERE msc_user='".$admin_login."' and msc_mss='".@$arr['ms']['ms_id']."' "); 
		@$rows['com'] = $db->rows(@$res['com']);
		?>
            <tr>
              <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo @$arr['ms']['ms_id']; ?>" id="Checked" class="check"/></td>
              <td class="left"><ul class="message"><li><?php if(@$rows['com']){ echo "<i class=\"fa fa-comment bg-green\"></i>";} else { echo "<i class=\"fa fa-comment-o bg-yellow\"></i>";}?>&nbsp;<?php echo @$arr['ms']['ms_topic']; ?>&nbsp;<?=NewsIcon(TIMESTAMP, @$arr['ms']['ms_date']);?></li></ul></td>
              <td style="text-align: center;"><?php echo @$arr['ms']['ms_views']; ?></td>
              <td style="text-align: center;"><?php echo @$arr['ms']['ms_comm']; ?></td>
              <td style="text-align: center;"><?php echo @$arr['ms']['ms_posted']; ?></td>
              <td  style="text-align: center;"><?php echo ThaiTimeConvert(@$arr['ms']['ms_date'],'',1);?></td>
              <td style="text-align: center;">
				<a href="index.php?name=message&file=index&op=detail&MsID=<?php echo @$arr['ms']['ms_id']; ?>&route=<?php echo $route;?>" class="label label-success"><i class="fa fa-search-plus "></i></a>
				<a href="index.php?name=message&file=index&op=edit&MsID=<?php echo @$arr['ms']['ms_id']; ?>&route=<?php echo $route;?>" class="label label-info"><i class="fa fa-edit "></i></a>
				<a href="index.php?name=message&file=index&op=del&MsID=<?php echo @$arr['ms']['ms_id']; ?>&route=<?php echo $route;?>" class="label label-danger"><i class="fa fa-trash-o "></i></a>
			  </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
		</form>

		<table>
		<tr>
              <td class="left"><ul class="message"><li><i class="fa fa-comment bg-green"></i>&nbsp;&nbsp;<?php echo _text_box_icon_read;?></li></ul></td>
		</tr>
		<tr>
              <td class="left"><ul class="message"><li><i class="fa fa-comment-o bg-yellow"></i>&nbsp;&nbsp;<?php echo _text_box_icon_unread;?></li></ul></td>
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


<?php } ?>
<script type="text/javascript">
		$(function(){
			$('#dp1').datepicker();
			$('#dp2').datepicker();
			$('#dp3').datepicker();
         });
</script>
        <script type="text/javascript">
        $(document).ready(function() {
        var aoColumns = [
                              /* 0 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 1 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 2 */ { "bSortable": false , 'aTargets': [ 0 ]},
                              /* 3 */ { "bSortable": false , 'aTargets': [ 0 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 4 */ { "bSortable": true , 'aTargets': [ 1 ]},
                              /* 5 */ { "bSortable": false , 'aTargets': [ 0 ]}
                                  ]
                oTable = $("#example1").dataTable({
								"aoColumns": aoColumns,
								"aaSorting": [[ 0, "desc" ]]
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
                               "aoColumns": aoColumns2

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
                               "aoColumns": aoColumns3

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


