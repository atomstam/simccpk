<?php require_once ("../../../mainfile.php"); ?>
<?php require_once("lang/register.php"); ?>

<script type="text/javascript">
$(document).ready(function(){
	 //alert("xxxxxxx");
  var datalist5 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist3
     url: "modules/login/area.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data:"area_id="+$(this).val(), // ส่งตัวแปร GET ชื่อ amphur ให้มีค่าเท่ากับ ค่าของ amphur
     async: false
  }).responseText;  
  $("select#area_code").html(datalist5); // นำค่า datalist2 มาแสดงใน listbox ที่ 3 ที่ชื่อ tambol
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด

});
</script>
							<select  class="form-control  css-require" name="admingr" id="admingr" required="required">
							<option value="" selected disabled><?php echo _form_select_area;?></option>
							<?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							$res['cate'] = $db->select_query("SELECT * FROM ".TB_AREA_USER_GROUP." ORDER BY group_id ");
							while ($arr['cate'] = $db->fetch($res['cate'])){
							echo "<option value=\"".$arr['cate']['group_id']."\"";
							echo ">".$arr['cate']['group_name']."</option>";
							}
							?>
							</select>
							<select  class="form-control css-require" name="area_code" id="area_code" required>
							<?php
							$res['ar'] = $db->select_query("SELECT * FROM ".TB_AREA."  where area_status='0' ORDER BY area_id ");
							while ($arr['ar'] = $db->fetch($res['ar'])){
							echo "<option value=\"".$arr['ar']['area_code']."\"";
							echo ">[".$arr['ar']['area_code']."] ".$arr['ar']['area_name']."</option>";
							}
							?>
							</select>