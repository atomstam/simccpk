<?php require_once ("../../../mainfile.php"); ?>
<?php require_once("lang/register.php"); ?>

<script type="text/javascript">
$(document).ready(function(){
	 //alert("xxxxxxx");
  var datalist5 = $.ajax({ // �Ѻ��Ҩҡ ajax ����������� datalist3
     url: "modules/login/area.php", // �������Ѻ��á�˹����͹�
     data:"area_id="+$(this).val(), // �觵���� GET ���� amphur ����դ����ҡѺ ��Ңͧ amphur
     async: false
  }).responseText;  
  $("select#area_code").html(datalist5); // �Ӥ�� datalist2 ���ʴ�� listbox ��� 3 ������ tambol
  // ���͵���� ��� element ��ҧ� ����ö����¹仵����á�˹�

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