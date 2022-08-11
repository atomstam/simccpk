<!DOCTYPE html>
<html lang="<?php echo ISO; ?>">
<head>
<meta charset="UTF-8" />
<link rel="shortcut icon" href="../img/ico/favicon.ico">
<link rel="apple-touch-icon" sizes="57x57" href="../img/ico/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../img/ico/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../img/ico/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../img/ico/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../img/ico/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../img/ico/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../img/ico/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../img/ico/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../img/ico/apple-icon-180x180.png">

<link rel="icon" type="image/png" sizes="192x192"  href="../img/ico/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="96x96" href="../img/ico/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="32x32" href="../img/ico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../img/ico/favicon-16x16.png">

<title><?php echo _heading_main_title; ?></title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<meta name="google-site-verification" content="baoumoxnG3_i8uRPLErpjxCWGe333fDB2QiRLvUH1Sw" />
        <!-- bootstrap 3.0.2 -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />

		<!-- daterange picker -->
		<link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
		<!-- Bootstrap time Picker -->
		<link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
		<!-- datetimepicker -->
		<link rel="stylesheet" href="../plugins/datetimepicker/css/bootstrap-datetimepicker.css">
        <!-- Bootstrap datePicker -->
        <link rel="stylesheet" href="../plugins/datepicker/css/bootstrap-datepicker3.css" />
        <!-- DATA TABLES -->
        <link href="../plugins/datatables/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet" type="text/css" />
        <!--<link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />-->
        <link href="../plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/jquery.dataTables.css" rel="stylesheet" type="text/css" />
		<!-- DataTables -->
		<link rel="stylesheet" href="../plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<!-- moris-->
		<link rel="stylesheet" href="../plugins/morris/morris.css">
        <!-- fullCalendar -->
        <link href="../plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
		<!-- Select2 -->
		<link rel="stylesheet" href="../plugins/select2/select2.min.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="../plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
		<!-- iCheck for checkboxes and radio inputs -->
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
		<!-- lightbox -->
		<link href="../plugins/lightbox/ekko-lightbox.min.css" rel="stylesheet">
		<!-- validate -->
		<link rel="stylesheet" href="../plugins/bootstrapvalidator/css/bootstrapValidator.css"/>

		<!-- bootstrap-toggle  -->
		<link rel="stylesheet" href="../plugins/bootstrap-toggle/css/bootstrap-toggle.min.css"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
        <!-- timeline1 -->
        <link href="../dist/css/timeline.css" rel="stylesheet" type="text/css" />
        <link href="../dist/css/social-buttons.css" rel="stylesheet" type="text/css" />
		<link href="../dist/css/base.css" rel="stylesheet" media="screen"/>
		<!--[if lt IE 8]>
		<p closeass="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
	<!-- Theme style 2.2.4 -->
	<link rel="stylesheet" href="../dist/css/AdminLTE.css">
	<!-- Material Design 
	<link rel="stylesheet" href="../dist/css/bootstrap-material-design.min.css">
	<link rel="stylesheet" href="../dist/css/ripples.min.css">
	<link rel="stylesheet" href="../dist/css/MaterialAdminLTE.min.css">-->
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. 
	<link rel="stylesheet" href="../dist/css/skins/all-md-skins.min.css">-->
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="../dist/css/skins/_all-skins.css">

		<?php if(!isset($_GET['name']) or $_GET['name'] !='' ){?>
		<!-- jQuery 3 -->
		<script src="../plugins/jquery/jquery.min.js"></script>
		<?php } else { ?>
		<!-- jQuery 3 -->
		<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
		<?php } ?>

		<!-- Bootstrap 3.3.7 -->
		<script src="../plugins/bootstrap/dist/js/bootstrap.min.js"></script>

		<!-- Google Font -->
			<link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
			<style>
		  body {
			font-family: 'Prompt', sans-serif;     
		  }

		  h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
			font-family: 'Prompt', sans-serif;     
		  }
		
		</style>
</head>
<body class="hold-transition skin-green sidebar-mini">
<?php require_once ("mainfile.php");
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
CheckPerson($_SESSION['person_login'],$_SESSION['person_pwd']);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_area ='".$_SESSION['person_area']."' and per_code='".$_SESSION['person_school']."'  and per_ids='".$_SESSION['person_login']."' "); 
@$arr['user'] = $db->fetch(@$res['user']);
if(!isset($home)){ $home="index.php";}
?>
<div class="wrapper">

        <!-- header logo: style can be found in header.less -->
		<header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo" onclick="location = 'index.php'">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo WEB_URL; ?>/img/logo-mini.png" width="30"></span>
      <!-- logo for regular state and mobile devices -->
	  <span class="logo-lg"><img src="<?php echo WEB_URL; ?>/img/logo-mini.png" width="30">&nbsp;<?php echo _SCRIPT;?><?php echo VERSION;?></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <!-- Navbar Right Menu -->
<?php
@$res['comx'] = $db->select_query("SELECT * FROM ".TB_MESSAGE.",".TB_MESSAGE_CHECK." where ms_to in ('all' ,'".$_SESSION['person_login']."')  and msc_mss !=ms_id  and msc_user='".$_SESSION['person_login']."' and ms_area='".$_SESSION['person_area']."' and ms_school='".$_SESSION['person_school']."' group by ms_id order by ms_id desc limit 5"); 
@$rows['comx'] = $db->rows(@$res['comx']);
?>
				<div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-warning"><?php if(@$rows['comx']) { echo @$rows['comx'];} else { echo "0";}?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"><?php echo _TEXT_HEAD_MASSAGES_1;?> <span class="label label-warning"><?php echo @$rows['comx'];?></span> <?php echo _TEXT_HEAD_MASSAGES_2;?></li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
									<?php
									
									@$res['ms'] = $db->select_query("SELECT * FROM ".TB_MESSAGE." as a,".TB_MESSAGE_CHECK." as b where a.ms_to in ('all' ,'".$_SESSION['person_login']."') and ms_area='".$_SESSION['person_area']."' and ms_school='".$_SESSION['person_school']."' and b.msc_mss !=a.ms_id  group by a.ms_id order by a.ms_id desc limit 5"); 
									while (@$arr['ms'] = $db->fetch(@$res['ms'])){
									@$res['userx'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_ids='".@$arr['ms']['ms_posted']."' "); 
									@$arr['userx'] = $db->fetch(@$res['userx']);
									?>
                                        <li><!-- start message -->
                                            <a href="index.php?name=access&file=message&op=detail&route=<?php echo $route;?>&MsID=<?php echo @$arr['ms']['ms_id'];?>">
                                                <div class="pull-left">
                                                    <img src="<?php if(@$arr['userx']['img']){echo WEB_URL_IMG_PERSON.@$arr['userx']['img'];}else{echo WEB_URL_IMG_PERSON."no_image.jpg";}?>" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    <?php echo CutTextTopic(@$arr['ms']['ms_topic']);?><small><i class="fa fa-clock-o"></i> <?php echo fb_date(@$arr['ms']['ms_date']);?></small>
                                                </h4>
                                                <p><?php echo CutTextDetail(@$arr['ms']['ms_message']);?></p>
                                            </a>
                                        </li><!-- end message -->
									<?php
									}
									?>
                                    </ul>
                                </li>
                                <li class="footer"><a href="index.php?name=access&file=message&route=<?php echo $route;?>"><?php echo _TEXT_HEAD_MASSAGES_ALL;?></a></li>
                            </ul>
                        </li>

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo @$arr['user']['per_ids']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                     <?php if(!empty(@$arr['user']['img'])){?>
                                            <img src="<?php echo WEB_URL_IMG_PERSON.@$arr['user']['img']; ?>" class="img-circle" alt="User Image" />
                                     <?php } else {?>
                                            <img src="<?php echo WEB_URL_IMG_PERSON."no_image.jpg";?>" class="img-circle" alt="User Image"/>
                                      <?php } ?>
                                    <p>
                                        <?php echo @$arr['user']['per_ids']; ?>
                                        <small><?php echo @$arr['user']['firstname']; ?>&nbsp;&nbsp;<?php echo @$arr['user']['lastname']; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="index.php?name=config&file=admin&op=detail&admin_id=<?php echo  @$arr['user']['admin_id'];?>&route=config/admin" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>


			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
				<!-- Sidebar user panel -->
					<div class="user-panel">
						<div class="pull-left image">
                                                <?php if(!empty(@$arr['user']['img'])){?>
                                                    <img src="<?php echo WEB_URL_IMG_PERSON.@$arr['user']['img']; ?>" class="img-circle" alt="User Image" />
                                                <?php } else {?>
                                                     <img src="<?php echo WEB_URL_IMG_PERSON."no_image.jpg";?>" class="img-circle" alt="User Image" />
                                                <?php } ?>
                        </div>
						<?php
						
						@$res['online'] = $db->select_query("SELECT * FROM ".TB_PERSON_ONLINE." as a , ".TB_PERSON." as b WHERE b.per_area ='".$_SESSION['person_area']."' and b.per_code='".$_SESSION['person_school']."'  and b.per_ids=a.u_user and u_timeout > '".time()."' "); 
						@$rows['online'] = $db->rows(@$res['online']); 
						?>
                        <div class="pull-left info">
                            <p>Hello, <?php echo @$arr['user']['per_ids'];?></p>
                            <a href="index.php?name=user&file=index&route=<?php echo $route;?>"><i class="fa fa-circle text-success"></i> Online</a> <?php echo @$rows['online'];?><br>
							<?php 
							//while(@$arr['online'] = $db->fetch(@$res['online'])){
							//	echo @$arr['online']['per_ids']."&nbsp;";
							//}
						    ?>
                        </div>
                    </div>
                    <!-- search form -->
					<form action="index.php?name=config&file=student&route=config/student" method="POST" class="sidebar-form" enctype="multipart/form-data">
					<div class="input-group">
						<input class="form-control" type="text" autocomplete="off" id="typeahead" class="form-control" data-provide="typeahead" name="stu_name" placeholder="Search...">
							<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
							</span>
					</div>
					</form>
					    <script type="text/javascript">
							$(document).ready(function() {
								$('input.stu_name').typeahead({
									source: function (typeahead,query) {
									$.ajax({
									url: 'modules/index/searchstu.php',
									type: 'POST',
									dataType: 'JSON',
									data: 'query=' + query,
										success: function(data) {
											console.log(data);
											typeahead.process(data);
										}
									});
								  }
								  });
							});
						</script>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li <?php if(empty($name)){ echo "class=\"active treeview menu-open\"";}?>>
                            <a href="<?php echo "index.php";?>">
                                <i <?php if(!empty($route)){ echo "class=\"fa fa-home active\"";} else {echo "class=\"fa fa-home\"";}?>></i> <span><?php echo _text_home;?></span>
                            </a>
                        </li>
			<?php
			
			@$res['menu'] = $db->select_query("SELECT * FROM ".TB_PERSON_MENU." where type='1' and status='1' order by menu_id "); 
			//@$arr['menu'] = $db->fetch(@$res['menu']);
			?>
			<?php while ($MainMenu = $db->fetch(@$res['menu'])) { ?>
                        <li <?php if($MainMenu['mods']==$name){ echo "class=\"active treeview\"";} else { echo "class=\"treeview\"";}?> >
                            <a href="index.php?name=<?php echo $MainMenu['mods'];?>&file=index&route=<?php echo $MainMenu['MFiles']; ?>">
                                <i class="<?php echo $MainMenu['icon']; ?>"></i> <span><?php echo $MainMenu['name']; ?></span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i></a>
								</span>
                            <ul class="treeview-menu">
			<?php
			
			@$res['submenu'] = $db->select_query("SELECT * FROM ".TB_PERSON_MENU." where main='".$MainMenu['mods']."' and status='1' order by sort "); 
			//@$arr['menu'] = $db->fetch(@$res['menu']);
			?>
			<?php while ($subMenu = $db->fetch(@$res['submenu'])) { ?>
                                <li <?php if($subMenu['MFiles']==$route){ echo "class=\"active\"";}?>><a href="index.php?name=<?php echo $subMenu['mods'];?>&file=<?php echo $subMenu['dbs'];?>&route=<?php echo $subMenu['MFiles']; ?>"><i class="fa fa-angle-double-right"></i> <?php if($file==$subMenu['dbs'] && $subMenu['MFiles']==$route){echo "<font color='#FFFF00'>".$subMenu['name']."</font>"; } else {echo $subMenu['name'];}?>
								<?php if(getTotalAdmin($subMenu['mods'],$subMenu['dbs'],$_SESSION['person_login']) !=0){?>
								<span class="pull-right-container">
								<small class="<?php echo $subMenu['class']; ?>"><?php if($subMenu['mods']=='message'){echo getTotalAdmin($subMenu['mods'],$subMenu['dbs'],$_SESSION['person_login']);} else {echo getTotalAdmin($subMenu['mods'],$subMenu['dbs'],$_SESSION['person_login']);}?>
								</small>
								</span>
								<?php } ?>
								</a>
								</li>
			<?php } ?>
                            </ul>
                        </li>
			<?php } ?>

                        <li >
                            <a href="<?php echo "../logout.php";?>">
                                <i class="fa fa-power-off"></i> <span><?php echo _button_logout;?></span>
                            </a>
                        </li>

					</ul>
               </section>
                <!-- /.sidebar -->
            </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	      <h4>
		<i class="fa fa-graduation-cap"></i> <?php echo $_SESSION['school_name']." [".$_SESSION['person_school']."]"; ?>
         </h4>
	<ol class="breadcrumb">
	<a href="<?php echo $home; ?>" onclick="location = '<?php echo $home; ?>'"><i class="fa fa-home"></i> Home</a> > <?php echo _heading_title; ?>
	</ol>
    </section>
   
<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">



