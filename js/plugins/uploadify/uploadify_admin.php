<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
require_once("../../../includes/config.php");
require_once("../../../includes/class.resizepic.php");
// Define a destination
$targetFolder = WEB_PATH_IMG_ADMIN; // Relative to the root

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
//	$NewFile = TIMESTAMP."_".$_FILES['Filedata']['name'];
	$targetPath = $targetFolder;
	$targetFile = $targetFolder . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
if (in_array($fileParts['extension'],$fileTypes)) {

$size = getimagesize($_FILES['Filedata']['tmp_name']);
$widths = $size[0];
$heights = $size[1];

if ($widths > _I_USER_W || $heights > _I_USER_H) {
if ((strchr($_FILES['Filedata']['name'],".")==".JPG") ||(strchr($_FILES['Filedata']['name'],".")==".jpg")){
				move_uploaded_file($tempFile,$targetFile);
//				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _I_USER_W ;
				$height = _I_USER_H ;
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
				$image->output_resized(str_replace('//','/',$targetPath).$_FILES['Filedata']['name']."", "JPG");
echo '1';
				} else if ((strchr($_FILES['Filedata']['name'],".")==".GIF") || (strchr($_FILES['Filedata']['name'],".")==".gift")){
				move_uploaded_file($tempFile,$targetFile);
//				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _I_USER_W ;
				$height = _I_USER_H ;
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
				$image->output_resized(str_replace('//','/',$targetPath).$_FILES['Filedata']['name']."", "GIF");
echo '1';
				} else if ((strchr($_FILES['Filedata']['name'],".")==".PNG") || (strchr($_FILES['Filedata']['name'],".")==".png")){
				move_uploaded_file($tempFile,$targetFile);
	//			echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _I_USER_W ;
				$height = _I_USER_H ;
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
				$image->output_resized(str_replace('//','/',$targetPath).$_FILES['Filedata']['name']."", "PNG");
echo '1';
				}
	
} else {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
}
	} else {
		echo 'Invalid file type.';
	}
}
?>