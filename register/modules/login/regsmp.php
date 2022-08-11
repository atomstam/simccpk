<?php require_once ("../../../mainfile.php"); ?>
<?php require_once("lang/register.php"); ?>

							<select  class="form-control  css-require" name="admingr" id="admingr" required="required">
							<option value="" selected disabled><?php echo _text_box_table_smp_select;?></option>
							<?php
							$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
							$res['cate'] = $db->select_query("SELECT * FROM ".TB_SMP_USER_GROUP." ORDER BY group_id ");
							while ($arr['cate'] = $db->fetch($res['cate'])){
							echo "<option value=\"".$arr['cate']['group_id']."\"";
							echo ">".$arr['cate']['group_name']."</option>";
							}
							?>
							</select>
