<?php
require_once("mainfile.php");
$_SERVER['PHP_SELF'] = "index.php";
//GETMODULE($name,$file);
//require_once ("template/".WEB_TEMPLATES."/function.php");
//require_once ("template/".WEB_TEMPLATES."/index.php");
//require_once ("admin/index.php");

//define('WEB_URL', 'https://'.$_SERVER['SERVER_NAME'].'');
//define('WEB_URLS', 'https://'.$_SERVER['SERVER_NAME'].'');
//define('WEB_URL_IMG', 'https://'.$_SERVER['SERVER_NAME'].'/img/');
//define('WEB_URL_IMG_ADMIN', 'https://'.$_SERVER['SERVER_NAME'].'/img/admin/');
//define('WEB_URL_IMG_PERSON', 'https://'.$_SERVER['SERVER_NAME'].'/img/person/');
//define('WEB_URL_IMG_STU', 'https://'.$_SERVER['SERVER_NAME'].'/img/stu/');
//define('WEB_URL_IMG_USER', 'https://'.$_SERVER['SERVER_NAME'].'/img/user/');
//define('WEB_URL_IMG_MAG', 'https://'.$_SERVER['SERVER_NAME'].'/img/mag/');
//define('WEB_URL_IMG_ICON', 'https://'.$_SERVER['SERVER_NAME'].'/img/icon/');
//define('WEB_URL_IMG_MOTOR', 'https://'.$_SERVER['SERVER_NAME'].'/img/motor/');
//define('WEB_URL_IMG_NEWS', 'https://'.$_SERVER['SERVER_NAME'].'/img/news/');
//define('WEB_URL_IMG_NEWS_RAN', 'https://'.$_SERVER['SERVER_NAME'].'/img/news/');
//define('WEB_URL_IMG_SCHOOL','https://'.$_SERVER['SERVER_NAME'].'/img/school/');

//echo $_SERVER['SERVER_NAME'];
if(!empty($_SESSION['auth']) && $_SESSION['auth']=="admin"){
	echo "<meta http-equiv='refresh' content='0; url=admin/index.php'>";
} else if(!empty($_SESSION['auth']) && $_SESSION['auth']=="person"){
	echo "<meta http-equiv='refresh' content='0; url=person/index.php'>";
} else if(!empty($_SESSION['auth']) && $_SESSION['auth']=="stu"){
	echo "<meta http-equiv='refresh' content='0; url=stu/index.php'>";
} else if(!empty($_SESSION['auth']) && $_SESSION['auth']=="staff"){
	echo "<meta http-equiv='refresh' content='0; url=staff/index.php'>";
} else {
	echo "<meta http-equiv='refresh' content='0; url=auth/index.php'>";
}

?>
