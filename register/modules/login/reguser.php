<?php require_once ("../../../mainfile.php"); ?>
<?php require_once("lang/register.php"); ?>
		<!-- jQuery 2.2.3 -->
		<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
 $("select#area").change(function(){
	 //alert("xxxxxxx");
  var datalist4 = $.ajax({ // �Ѻ��Ҩҡ ajax ����������� datalist3
     url: "modules/login/schoolregis.php", // �������Ѻ��á�˹����͹�
     data:"area_id="+$(this).val(), // �觵���� GET ���� amphur ����դ����ҡѺ ��Ңͧ amphur
     async: false
  }).responseText;  
  $("select#schools").html(datalist4); // �Ӥ�� datalist2 ���ʴ�� listbox ��� 3 ������ tambol
  // ���͵���� ��� element ��ҧ� ����ö����¹仵����á�˹�
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
