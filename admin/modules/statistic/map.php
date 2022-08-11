<div class="col-xs-12">

<script>
$(document).ready(function(){
	$("#Map").load("modules/index/gmap3_index.php");
});
</script>

<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
		<div align="right" >
		<div class="form-group"><a href="index.php?name=gen&file=map&route=<?php echo $route;?>" class="btn bg-orange btn-flat"><i class="fa fa-undo"></i>&nbsp;<?php echo _button_detail; ?></a>
		</div>
		</div>
</div>
</div>


<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
	  <div id="Map" ><center><img src="../img/ajax-loader1.gif" border="0"></center></div>
</div>
</div>


</div>
