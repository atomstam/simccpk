<?php require_once ("../../../mainfile.php"); ?>
<?php require_once("lang/register.php"); ?>
<?php $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); ?>

							<select  class="form-control  css-require" name="admingr" id="admingr" required="required">
							<option value="" selected disabled><?php echo _text_box_table_group_select;?></option>
							<?php

							$res['cate'] = $db->select_query("SELECT * FROM ".TB_CLUS_USER_GROUP." ORDER BY group_id ");
							while ($arr['cate'] = $db->fetch($res['cate'])){
							echo "<option value=\"".$arr['cate']['group_id']."\"";
							echo ">".$arr['cate']['group_name']."</option>";
							}
							?>
							</select>
							<select  class="form-control" name="clus_code" id="clus_code" required>
							<option value="" selected disabled><?php echo _text_box_table_area_select;?></option>
							<?php

							$res['clus'] = $db->select_query("SELECT * FROM ".TB_CLUSTER." ORDER BY clus_id ");
							while ($arr['clus'] = $db->fetch($res['clus'])){
							echo "<option value=\"".$arr['clus']['clus_code']."\"";
							echo ">".$arr['clus']['clus_name']."</option>";
							}
							?>
							</select>
