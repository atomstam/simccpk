<?php
require_once("../../../includes/config.php");
// Define a destination
$targetFolders = WEB_URL_IMG_ICON; // Relative to the root
?>
<style>
    .pictures   {
        width: 960px;
        margin: 0 auto;
        padding: 5px;
    }
    .pictures_box   {
        width: 150px;
        float: left;
        margin: 0 10px 10px 0;
    }
    .pictures_box   img{
        border: 1px #000 solid;
    }
    .pictures_box   p   {
        margin: 5px 0 0 0;
        font-size: 11px;
        overflow: hidden;
    }
</style>
<div class="pictures">
    <?php
  //      $weeds = array('.', '..');
  //      $objScan = array_diff(scandir("uploads"), $weeds); 
  //      foreach ($objScan as $value) {
  if($_GET['Obj']){
    ?>
        <div class="pictures_box">
            <img width="150" src="<?php echo $targetFolders.$_GET['Obj'];?>">
            <p><?php echo $_GET['Obj'];?></p>
        </div>
    <?php
     } else {
?>
        <div class="pictures_box">
            <img width="150" src="<?php echo $targetFolders."no_image.jpg";?>">
            <p><?php echo "no_image.jpg";?></p>
        </div>
<?php
	}
    ?>
</div>