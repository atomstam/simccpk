<?php
ob_start();
if (session_id() =='') { @session_start(); }
require_once("../../includes/config.php");
require_once("../../includes/class.resizepic.php");
// Define a destination
if(!empty($_SESSION['admin_login']) || !empty($_SESSION['user_login']) || !empty($_SESSION['area_login']) || !empty($_SESSION['smp_login']) || !empty($_SESSION['clus_login']) ){
// Define a destination
$targetFolder = WEB_PATH_IMG_AWARD; // Relative to the root
$TIMESTAMP = time();
$allowed =  array('gif','png' ,'jpg','jpeg');
$filename = $_FILES['avatar-1']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if(!in_array($ext,$allowed) ) {
//	echo json_encode(['error'=>'No files found for upload.']);
		echo json_encode('No files found for upload. Or File not format .jpg .gif .png');
// or you can throw an exception
//return; // terminate
} else {
// get the files posted
//$images = $_FILES['avatar-1'];
//$nombre_img2=$images['name'];
//echo json_encode(['success'=>'SI LLEGA y es el fileinput con nombre de archivo:'. $nombre_img2]);
$tempFile = $_FILES['avatar-1']['tmp_name'];
$targetPath = $targetFolder;
$targetFile = $targetFolder . $_FILES['avatar-1']['name'];
$date_array = explode(".",$_FILES['avatar-1']['name']);
$File1=$date_array[0];
$File2=$date_array[1];
$size = getimagesize($_FILES['avatar-1']['tmp_name']);
$widths = $size[0];
$heights = $size[1];

if ($widths > _I_AWARD_W || $heights > _I_AWARD_H) {
if ((strchr($_FILES['avatar-1']['name'],".")==".JPG") ||(strchr($_FILES['avatar-1']['name'],".")==".jpg")){
				move_uploaded_file($tempFile,$targetFile);
//				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _I_AWARD_W ;
				$height = _I_AWARD_H ;
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
				$image->output_resized(str_replace('//','/',$targetPath).$TIMESTAMP.'.jpg'."", "JPG");
				echo json_encode($TIMESTAMP.'.jpg');
				} else if ((strchr($_FILES['avatar-1']['name'],".")==".GIF") || (strchr($_FILES['avatar-1']['name'],".")==".gift")){
				move_uploaded_file($tempFile,$targetFile);
//				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _I_AWARD_W ;
				$height = _I_AWARD_H ;
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
				$image->output_resized(str_replace('//','/',$targetPath).$_FILES['avatar-1']['name']."", "GIF");
	//			echo $TIMESTAMP."_".$_FILES['avatar-1']['name'];
				} else if ((strchr($_FILES['avatar-1']['name'],".")==".PNG") || (strchr($_FILES['avatar-1']['name'],".")==".png")){
				move_uploaded_file($tempFile,$targetFile);
	//			echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _I_AWARD_W ;
				$height = _I_AWARD_H ;
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
				$image->output_resized(str_replace('//','/',$targetPath).$TIMESTAMP.'.png'."", "PNG");
	//			echo $TIMESTAMP."_".$_FILES['avatar-1']['name'];
				echo json_encode($TIMESTAMP.'.png');
				}
	//	echo '1';
	//echo json_encode($TIMESTAMP.'.jpg');
//	echo json_encode(['success'=>'Success resize']);
} else {
	//$targetFolder . $_FILES['avatar-1']['name'];
		move_uploaded_file($tempFile,$targetFolder . $TIMESTAMP.'.'.$File2);
//		echo json_encode(['success'=>'Success']);
		echo json_encode($TIMESTAMP.'.'.$File2);
}

}


}
?>