<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
require_once("../../../includes/config.php");
require_once("../../../includes/class.resizepic.php");
// Define a destination
$targetFolder = WEB_PATH_IMG_ICON; // Relative to the root
$TIMESTAMP = $_GET['TimeStamp'];
if (!empty($_FILES)) {
	$tempFile = $_FILES['files']['tmp_name'];
//	$NewFile = $TIMESTAMP."_".$_FILES['files']['name'];
	$targetPath = $targetFolder;
	$targetFile = $targetFolder . $TIMESTAMP."_".$_FILES['files']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['files']['name']);
	
if (in_array($fileParts['extension'],$fileTypes)) {

$size = getimagesize($_FILES['files']['tmp_name']);
$widths = $size[0];
$heights = $size[1];

if ($widths > _I_ICON_W || $heights > _I_ICOM_H) {
if ((strchr($_FILES['files']['name'],".")==".JPG") ||(strchr($_FILES['files']['name'],".")==".jpg")){
				move_uploaded_file($tempFile,$targetFile);
//				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _I_ICON_W ;
				$height = _I_ICON_H ;
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
				$image->output_resized(str_replace('//','/',$targetPath).$TIMESTAMP."_".$_FILES['files']['name']."", "JPG");
				echo $TIMESTAMP."_".$_FILES['files']['name'];
				} else if ((strchr($_FILES['files']['name'],".")==".GIF") || (strchr($_FILES['files']['name'],".")==".gift")){
				move_uploaded_file($tempFile,$targetFile);
//				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _I_ICON_W ;
				$height = _I_ICON_H ;
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
				$image->output_resized(str_replace('//','/',$targetPath).$TIMESTAMP."_".$_FILES['files']['name']."", "GIF");
				echo $TIMESTAMP."_".$_FILES['files']['name'];
				} else if ((strchr($_FILES['files']['name'],".")==".PNG") || (strchr($_FILES['files']['name'],".")==".png")){
				move_uploaded_file($tempFile,$targetFile);
	//			echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _I_ICON_W ;
				$height = _I_ICON_H ;
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
				$image->output_resized(str_replace('//','/',$targetPath).$TIMESTAMP."_".$_FILES['files']['name']."", "PNG");
				echo $TIMESTAMP."_".$_FILES['files']['name'];
				}
		echo '1';
} else {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
}
	} else {
		echo 'Invalid file type.';
	}
}
?>