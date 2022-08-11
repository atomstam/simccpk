<?php 
//require_once ("mainfile.php"); 
require_once ("header.php"); 

if($route !="index/index"){
require_once ("".$MODPATHFILE.""); 
} else {
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$TotalflashLink='index.php?name=flashpage&file=index&route='.$route;
	$TotalmediaLink='index.php?name=media&file=index&route='.$route;
	$TotalarticleLink='index.php?name=article&file=index&route='.$route;
	$TotalknLink='index.php?name=knowledge&file=index&route='.$route;
}
?>
<script>
            $(function() {

            });
        </script>
 <?php require_once ("footer.php"); ?>

<!-- div header -->
</div>
</div>


