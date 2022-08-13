<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../../includes/config.php");
require_once("../../../includes/class.mysql.php");
require_once("lang/news.php");
$db = New DB();
$add='';
$edit='';
$del='';
//$Avatar='';
if(!empty($_SESSION['admin_login'])){
if($_POST['OP']=='NewsAdd'){
	if( $_POST['Topic'] !='' && $_POST['CAT'] !='' && $_POST['Icon'] !='' && $_POST['Headline'] !='' && $_POST['Detail'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$add .=$db->add_db(TB_NEWS,array(
			"category"=>"".$_POST['CAT']."",
			"topic"=>"".$_POST['Topic']."",
			"headline"=>"".$_POST['Headline']."",
			"detail"=>"".$_POST['Detail']."",
			"posted"=>"".$_SESSION['admin_login']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"1",
			"pic"=>"".$_POST['Icon']."",
			"ran"=>"".$_POST['Icon2'].""
		));


	} else {
		$add ='';
	}

	if($add){
		$successx = "Success";
		$responseArray = array('type' => 'success', 'message' => $successx);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	} else {
		$error_warningx = "Error";
		//echo $error_warning;
		$responseArray = array('type' => 'danger', 'message' => $error_warningx);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	}

} 

if($_POST['OP']=='NewsEdit'){
	if( $_POST['Topic'] !='' && $_POST['CAT'] !='' && $_POST['Headline'] !='' && $_POST['Detail'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." WHERE news_id='".$_POST['NEWSID']."'  "); 
		$arr['news'] = $db->fetch($res['news']);
		if(!empty($_POST['Icon'])){
		$Icon=$_POST['Icon'];
		} else {
		$Icon=$arr['news']['pic'];
		}
		if(!empty($_POST['Icon2'])){
		$Icon2=$_POST['Icon2'];
		} else {
		$Icon2=$arr['news']['ran'];
		}

		$edit .=$db->update_db(TB_NEWS,array(
			"category"=>"".$_POST['CAT']."",
			"topic"=>"".$_POST['Topic']."",
			"headline"=>"".$_POST['Headline']."",
			"detail"=>"".$_POST['Detail']."",
			"update_date"=>"".TIMESTAMP."",
			"pic"=>"".$Icon."",
			"ran"=>"".$Icon2.""
		)," news_id=".$_POST['NEWSID']." ");

	} else {
		$edit .='';
	}

	if($edit){
		$successx = "Success";
		$responseArray = array('type' => 'success', 'message' => $successx);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	} else {
		$error_warningx = "Error";
		//echo $error_warning;
		$responseArray = array('type' => 'danger', 'message' => $error_warningx);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	}

}

if($_POST['OP']=='CateAdd'){
	if( $_POST['Topic'] !='' && $_POST['Icon'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['cate'] = $db->select_query("SELECT * FROM ".TB_NEWS_CATE."  "); 
		$rows['cate'] = $db->rows($res['cate']);
		$Sort=$rows['cate']+1;
		$add .=$db->add_db(TB_NEWS_CATE,array(
			"category_name"=>"".$_POST['Topic']."",
			"sort"=>"".$Sort."",
			"icon"=>"".$_POST['Icon'].""
		));


	} else {
		$add ='';
	}

	if($add){
		$successx = "Success";
		$responseArray = array('type' => 'success', 'message' => $successx);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	} else {
		$error_warningx = "Error";
		//echo $error_warning;
		$responseArray = array('type' => 'danger', 'message' => $error_warningx);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	}

} 


if($_POST['OP']=='CateEdit'){
	if( $_POST['Topic'] !='' ){
//		$Avatar=$_FILES['avatar-1']['name'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['cate'] = $db->select_query("SELECT * FROM ".TB_NEWS_CATE." WHERE cate_id='".$_POST['CATEID']."'  "); 
		$arr['cate'] = $db->fetch($res['cate']);
		if(!empty($_POST['Icon'])){
		$Icon=$_POST['Icon'];
		} else {
		$Icon=$arr['cate']['icon'];
		}

		$edit .=$db->update_db(TB_NEWS_CATE,array(
			"category_name"=>"".$_POST['Topic']."",
			"icon"=>"".$Icon.""
		)," cate_id=".$_POST['CATEID']." ");

	} else {
		$edit .='';
	}

	if($edit){
		$successx = "Success";
		$responseArray = array('type' => 'success', 'message' => $successx);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	} else {
		$error_warningx = "Error";
		//echo $error_warning;
		$responseArray = array('type' => 'danger', 'message' => $error_warningx);
		$encoded = json_encode($responseArray);
		header('Content-Type: application/json');
		echo $encoded;
	}

} else { echo "<meta http-equiv='refresh' content='1; url=../../index.php'>"; 

}
?>