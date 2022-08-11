<?php require_once ("../../../mainfile.php"); ?>
<?php require_once("lang/register.php"); ?>
		<!-- jQuery 2.2.3 -->
		<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
 $("select#area").change(function(){
	 //alert("xxxxxxx");
  var datalist4 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist3
     url: "modules/login/schoolregis.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data:"area_id="+$(this).val(), // ส่งตัวแปร GET ชื่อ amphur ให้มีค่าเท่ากับ ค่าของ amphur
     async: false
  }).responseText;  
  $("select#schools").html(datalist4); // นำค่า datalist2 มาแสดงใน listbox ที่ 3 ที่ชื่อ tambol
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });
});
</script>
							<select  class="form-control css-require" name="area_code" id="area" required="required">
							<option value=""><?php echo _form_select_area;?></option>
							<?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							$res['ar'] = $db->select_query("SELECT * FROM ".TB_AREA." order by area_id"); 
							while ($arr['ar'] = $db->fetch($res['ar'])){
								echo 	"<option value=".$arr['ar']['area_code'].">".$arr['ar']['area_code']." ".$arr['ar']['area_name']."</option>";
							}
							?>
							</select>
							<select  class="form-control" name="school" id="schools" required>
							<option value=''><?php echo _form_select_school;?></option>
							</select>
