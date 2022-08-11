<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../includes/config.php");
require_once("../../includes/class.resizepic.php");
// Define a destination
if(!empty($_SESSION['admin_login'])){
if(!empty($_SESSION['admin_login'])){
	$Sh_code=$_SESSION['admin_school'];
}
// Define a destination
$targetFolder = WEB_PATH_UPLOAD; // Relative to the root
$TIMESTAMP = time();
$allowed =  array('gif','png' ,'jpg','jpeg');
$filename = $_FILES['avatar-2']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if(!in_array($ext,$allowed) ) {
//if (empty($_FILES['avatar-2']) || (strchr($_FILES['avatar-2']['name'],".")!=".JPG") ||(strchr($_FILES['avatar-2']['name'],".")!=".jpg") || (strchr($_FILES['avatar-2']['name'],".")!=".GIF") || (strchr($_FILES['avatar-2']['name'],".")!=".gift") || (strchr($_FILES['avatar-2']['name'],".")!=".PNG") || (strchr($_FILES['avatar-2']['name'],".")!=".png") ) {
//	echo json_encode(['error'=>'No files found for upload.']);
		echo json_encode('No files found for upload. Or File not format .jpg .gif .png');
// or you can throw an exception
//return; // terminate
} else {
// get the files posted
//$images = $_FILES['avatar-2'];
//$nombre_img2=$images['name'];
//echo json_encode(['success'=>'SI LLEGA y es el fileinput con nombre de archivo:'. $nombre_img2]);
$tempFile = $_FILES['avatar-2']['tmp_name'];
$targetPath = $targetFolder;
$targetFile = $targetFolder . $_FILES['avatar-2']['name'];

$date_array = explode(".",$_FILES['avatar-2']['name']);
$File1=$date_array[0];
$File2=$date_array[1];

$size = getimagesize($_FILES['avatar-2']['tmp_name']);
$widths = $size[0];
$heights = $size[1];

if ($widths > _I_LOGO_SIG_W || $heights > _I_LOGO_SIG_H) {
if ((strchr($_FILES['avatar-2']['name'],".")==".JPG") ||(strchr($_FILES['avatar-2']['name'],".")==".jpg")){
				move_uploaded_file($tempFile,$targetFile);
//				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _I_LOGO_SIG_W ;
				$height = _I_LOGO_SIG_H ;
				$desired_width = $size[0] ;
				$desired_height = $size[1] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size[1]/$height;
					$imwidth=$size[0]/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized(str_replace('//','/',$targetPath).$Sh_code."_".$TIMESTAMP.'.jpg'."", "JPG");
				echo json_encode($Sh_code."_".$TIMESTAMP.'.jpg');
				} else if ((strchr($_FILES['avatar-2']['name'],".")==".GIF") || (strchr($_FILES['avatar-2']['name'],".")==".gift")){
				move_uploaded_file($tempFile,$targetFile);
//				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _I_LOGO_SIG_W ;
				$height = _I_LOGO_SIG_H ;
				$desired_width = $size[0] ;
				$desired_height = $size[1] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size[1]/$height;
					$imwidth=$size[0]/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized(str_replace('//','/',$targetPath).$Sh_code."_".$TIMESTAMP.'.gif'."", "GIF");
				echo json_encode($Sh_code."_".$TIMESTAMP.'.gif');
				} else if ((strchr($_FILES['avatar-2']['name'],".")==".PNG") || (strchr($_FILES['avatar-2']['name'],".")==".png")){
				move_uploaded_file($tempFile,$targetFile);
	//			echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _I_LOGO_SIG_W ;
				$height = _I_LOGO_SIG_H ;
				$desired_width = $size[0] ;
				$desired_height = $size[1] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size[1]/$height;
					$imwidth=$size[0]/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized(str_replace('//','/',$targetPath).$Sh_code."_".$TIMESTAMP.'.png'."", "PNG");
	//			echo $TIMESTAMP."_".$_FILES['avatar-2']['name'];
				echo json_encode($Sh_code."_".$TIMESTAMP.'.png');
				}
	//	echo '1';
	//echo json_encode($TIMESTAMP.'.jpg');
//	echo json_encode(['success'=>'Success resize']);
} else {
	//$targetFolder . $_FILES['avatar-2']['name'];
		move_uploaded_file($tempFile,$targetFolder . $Sh_code."_".$TIMESTAMP.'.'.$File2);
//		echo json_encode(['success'=>'Success']);
		echo json_encode($Sh_code."_".$TIMESTAMP.'.'.$File2);
}

}


}
?>