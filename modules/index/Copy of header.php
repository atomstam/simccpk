<!DOCTYPE html>
<html lang="<?php echo ISO; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo _heading_main_title; ?></title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap datePicker -->
        <link href="css/datepicker/datepicker.css" rel="stylesheet"/>
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- Morris charts -->
		<link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script type="text/javascript" src="js/jquery-ui-1.10.3.min.js" ></script>
<!--[if lt IE 8]>
<p closeass="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<SCRIPT language=JavaScript>
var message="Do not right click";// ข้อความที่ให้แสดงเมื่อคบิกขวา
///////////////////////////////////
function clickIE4(){
if (event.button==2){
alert(message);
return false;
}
}

function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("alert(message);return false")
</SCRIPT>
</head>
<body class="skin-blue">
<?php require_once ("mainfile.php"); ?>
<?php if($route=="user/logout"){ require_once ("modules/user/logout.php");} ?>
<?php if ($user_login) {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." WHERE username='".$user_login."' AND password='".$user_pwd."'  "); 
$arr['user'] = $db->fetch($res['user']);
?>

        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php $home; ?>" class="logo" onclick="location = '<?php echo $home; ?>'">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo VERSION;?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
				<div class="navbar-left">
                    <ul class="navbar-btn sidebar-toggle">
                        <!-- Messages: style can be found in dropdown.less-->
                        <span class="messages"><font color="#ffffff"><?php echo $user_school."&nbsp;".$school_name;?></font></span>
					</ul>
				</div>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success"><?php echo $total_user; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have <?php echo $total_user; ?> Messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                    






                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $users['username']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                     <?php if(!empty($arr['user']['img'])){?>
                                            <img src="<?php echo WEB_URL_IMG_USER.$arr['user']['img']; ?>" class="img-circle" alt="User Image" />
                                     <?php } else {?>
                                            <img src="<?php echo WEB_URL_IMG_USER."no_image.jpg";?>" class="img-circle" alt="User Image"/>
                                      <?php } ?>
                                    <p>
                                        <?php echo $arr['user']['username']; ?>
                                        <small><?php echo $arr['user']['firstname']; ?>&nbsp;&nbsp;<?php echo $arr['user']['lastname']; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="index.php?name=user&file=index&route=user/index" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="index.php?name=user&file=logout&route=user/logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                                                <?php if(!empty($arr['user']['img'])){?>
                                                    <img src="<?php echo WEB_URL_IMG_USER.$arr['user']['img']; ?>" class="img-circle" alt="User Image" />
                                                <?php } else {?>
                                                     <img src="<?php echo WEB_URL_IMG_USER."no_image.jpg";?>" class="img-circle" alt="User Image"/>
                                                <?php } ?>
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $arr['user']['username'];?></p>

                            <a href="<?php echo $arr['user']['action'];?>"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo "index.php";?>">
                                <i <?php if(!empty($route)){ echo "class=\"fa fa-home active\"";} else {echo "class=\"fa fa-home\"";}?>></i> <span><?php echo _text_home;?></span>
                            </a>
                        </li>
			<?php
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['menu'] = $db->select_query("SELECT * FROM ".TB_USER_MENU." where type='1' order by menu_id "); 
			//$arr['menu'] = $db->fetch($res['menu']);
			?>
			<?php while ($MainMenu = $db->fetch($res['menu'])) { ?>
                        <li <?php if($MainMenu['mods']==$name){ echo "class=\"treeview active\"";} else { echo "class=\"treeview\"";}?> >
                            <a href="index.php?name=<?php echo $MainMenu['mods'];?>&file=index&route=<?php echo $MainMenu['MFiles']; ?>">
                                <i class="<?php echo $MainMenu['icon']; ?>"></i> <span><?php echo $MainMenu['name']; ?></span>
								<i class="fa fa-angle-left pull-right"></i>
                            <ul class="treeview-menu">
			<?php
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['submenu'] = $db->select_query("SELECT * FROM ".TB_USER_MENU." where main='".$MainMenu['mods']."' order by sort "); 
			//$arr['menu'] = $db->fetch($res['menu']);
			?>
			<?php while ($subMenu = $db->fetch($res['submenu'])) { ?>
                                <li <?php if($subMenu['MFiles']==$route){ echo "class=\"active\"";}?>><a href="index.php?name=<?php echo $subMenu['mods'];?>&file=<?php echo $subMenu['dbs'];?>&route=<?php echo $subMenu['MFiles']; ?>"><i class="fa fa-angle-double-right"></i> <?php echo $subMenu['name']; ?><small class="<?php echo $subMenu['class']; ?>"><?php echo getTotal($subMenu['mods'],$subMenu['dbs'],$user_school);?></small></a></li>
			<?php } ?>
                            </ul>
                            </a>
                        </li>
			<?php } ?>
                        <li >
                            <a href="<?php echo "index.php?name=user&file=logout&route=user/logout";?>">
                                <i class="fa fa-power-off"></i> <span><?php echo _button_logout;?></span>
                            </a>
                        </li>
					</ul>
               </section>
                <!-- /.sidebar -->
            </aside>

<!-- right-side -->

<aside class="right-side">
	<!-- Content Header (Page header) -->
    <section class="content-header">
	<a href="<?php echo $home; ?>" onclick="location = '<?php echo $home; ?>'"><i class="fa fa-home"></i> Home</a>
                         > <?php echo _heading_title; ?>
    </section>
                
<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
    <div class="col-lg-12">
    <!-- small box -->
<?php } ?>


