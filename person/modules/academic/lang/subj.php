<?php
// header
define('_heading_title', 'ข้อมูลรายวิชา');

// Button
define('_button_add', 'เพิ่มข้อมูลใหม่');
define('_button_reset', 'ยกเลิก');
define('_button_save', 'บันทึกข้อมูล');
define('_button_del', 'ลบข้อมูล');
define('_button_edit', 'แก้ไขข้อมูล');
define('_button_detail', 'กลับหน้าแรก');
define('_button_import', 'นำเข้าข้อมูล');

// detail gen
define('_text_box_header_gen', 'ข้อมูลรายวิชา');

define('_text_report_add_ok', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
define('_text_report_add_fail', 'ไม่สามารถเพิ่มข้อมูลเข้าระบบได้');

define('_text_report_del_ok', 'ลบข้อมูลเรียบร้อยแล้ว');
define('_text_report_del_fail', 'ไม่สามารถลบข้อมูลได้');
define('_text_report_del_null_fail', 'ไม่มีข้อมูลที่จะลบ');

define('_text_report_edit_ok', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
define('_text_report_edit_fail', 'ไม่สามารถแก้ไขข้อมูลได้');
define('_text_no_results', 'ไม่มีข้อมูล');

// list

define('_text_box_table_subj_id', 'รหัสรายวิชา');
define('_text_box_table_subj_name', 'รายการรายวิชา');
define('_text_box_table_subj_stu_name', 'ชื่อนักเรียน');
define('_text_box_table_subj_stu_class', 'ระดับชั้น');

define('_text_box_table_subj_level', 'ระดับรายวิชา');
define('_text_box_table_subj_level_select', 'เลือกระดับรายวิชา');
define('_text_box_table_subj_count_stu', 'จำนวนรายวิชา');
define('_text_box_table_subj_countstu', 'จำนวนรายวิชา');
define('_text_box_table_count', 'จำนวน ');


define('_text_box_table_subj_score', 'คะแนนพฤติกรรม');


//confierm delete
define('_text_box_con_delete_head', 'ยืนยันการลบข้อมูล');
define('_text_box_con_delete_text', 'ถ้าลบข้อมูลนี้ ข้อมูลทั้งหมดจะถูกลบอย่างถาวร คุณต้องการดำเนินการต่อหรือไม่');

define('_text_box_header_gen_detail_class', 'ข้อมูลรายวิชาประเภท');
define('_text_box_header_gen_detail_stu', 'ข้อมูลรายวิชารายคน');


//detail
define('_text_box_table_subj_stu_detail_name', 'รายละเอียด');
define('_text_box_table_subj_stu_detail_date', 'กระทำรายวิชาเมื่อ');
define('_text_box_table_subj_stu_detail_dam', 'ผู้แจ้งข้อมูล');
define('_text_box_table_subj_stu_detail_dam_select', 'เลือกผู้แจ้งข้อมูล');
define('_text_box_table_subj_stu_detail_session', 'ผู้บันทึกข้อมูล');
define('_text_box_table_subj_stu_detail_data', 'การลงโทษ');
define('_text_box_table_subj_stu_detail_data_select', 'เลือกการลงโทษ');

//add
define('_text_box_table_subj_stu_form_name', 'ชื่อนักเรียน');
define('_text_box_table_subj_stu_form_badtail', 'รายการรายวิชา');
define('_text_box_table_subj_stu_form_badname', 'รายละเอียด');

define('_text_box_table_stu_spacial', 'สถานภาพนักเรียน');
define('_text_box_table_stu_subj_select', 'เลือกรายการ');
define('_text_box_table_stu_subj_detail', 'รายละเอียดเพิ่มเติม');
define('_text_box_table_stu_subj_interv', 'ผู้ให้ข้อมูล');
define('_text_box_table_stu_subj_interv_select', 'เลือกผู้ให้ข้อมูล');


//grade
define("_GRADESTU","ข้อมูลนักเรียน");
define("_GRADETRAN","ข้อมูลผลการเรียน");
define("_GRADETECH","ข้อมูลครูผู้สอน");
define("_GRADESUBJ","ข้อมูลรายวิชา");
define("_GRADECLASS","ข้อมูลห้องเรียน");
define("_GRADEGROUP","กลุ่มวิชา");
define("_ADMIN_MENU_MAIN","GradeOnline");
define("_ADMIN_GD_MENU_INDEX","GradeOnline");
define("_ADMIN_GD_TABLE_TITLE_ID","รหัส");
define("_ADMIN_GD_TABLE_TITLE_NAME","รายการ");
define("_ADMIN_GD_TABLE_TITLE_CLASS_TEACH","ครูประจำชั้น");
define("_ADMIN_GD_TABLE_TITLE_STU","จำนวนนักเรียน");
define("_ADMIN_GRADE_CLASS_MESSAGE_ADD","ได้ทำการเพิ่มข้อมูลห้องเรียนเรียบร้อยแล้ว");
define("_ADMIN_GRADE_CLASS_MESSAGE_EDIT","ได้ทำการแก้ไขข้อมูลห้องเรียนเรียบร้อยแล้ว");
define("_ADMIN_GRADE_CLASS_MESSAGE_DEL","ได้ทำการลบข้อมูลห้องเรียนเรียบร้อยแล้ว");
define("_ADMIN_GRADE_MESSAGE_GOBACK","กลับหน้าจัดการห้องเรียน");
define("_ADMIN_GRADE_MESSAGE_ADD","เพิ่มข้อมูลใหม่");
define("_ADMIN_GRADE_MESSAGE_CON_DEL","** ถ้าลบข้อมูลรายการภายในจะถูกลบไปด้วย");
define("_ADMIN_GRADE_BUTTON_ADD","เพิ่มข้อมูล");
define("_ADMIN_GRADE_BUTTON_EDIT","แก้ไขข้อมูล");
define("_ADMIN_GRADE_BUTTON_DEL","ลบข้อมูล");
define("_ADMIN_GD_TABLE_TITLE_CLASS_NUM","จำนวนรายวิชาที่สอน");
define("_ADMIN_TEACHER_MESSAGE_ADD","เพิ่มข้อมูลใหม่");
define("_ADMIN_TEACHER_MESSAGE_ADD_FILE","เพิ่มข้อมูลใหม่จากไฟล์");
define("_ADMIN_FORM_CODE_CAT","รหัส");
define("_ADMIN_GRADE_TEACHER_MESSAGE_ADD","ได้ทำการเพิ่มข้อมูลครูผู้สอนเรียบร้อยแล้ว");
define("_ADMIN_GRADE_TEACHER_MESSAGE_EDIT","ได้ทำการแก้ไขข้อมูลครูผู้สอนเรียบร้อยแล้ว");
define("_ADMIN_GRADE_TEACHER_MESSAGE_DEL","ได้ทำการลบข้อมูลครูผู้สอนเรียบร้อยแล้ว");
define("_ADMIN_GRADE_TEACHER_MESSAGE_GOBACK","กลับหน้าจัดการครูผู้สอน");
define("_ADMIN_FORM_TECH_PIN","เลขประจำตัวประชาชน");
define("_ADMIN_FORM_TECH_NAME","ชื่อ-นามสกุล");
define("_ADMIN_FORM_TECH_NICKNAME","ชื่อเล่น");
define("_ADMIN_FORM_TECH_SEX","เพศ");
define("_ADMIN_FORM_TECH_BIRTHDAY","วัน/เดือน/ปีเกิด");
define("_ADMIN_FORM_TECH_POSITION","ตำแหน่งปัจจุบัน");
define("_ADMIN_FORM_TECH_EDU","วุฒิการศึกษา");
define("_ADMIN_FORM_TECH_MAJOR","วิชาเอก");
define("_ADMIN_FORM_TECH_MINOR","วิชาโท");
define("_ADMIN_FORM_TECH_UNIVERT","สถาบันการศึกษา");
define("_ADMIN_FORM_TECH_ADD_NO","ที่อยู่ เลขที่");
define("_ADMIN_FORM_TECH_ADD_GR","หมู่");
define("_ADMIN_FORM_TECH_ADD_SOI","ซอย");
define("_ADMIN_FORM_TECH_ADD_STREET","ถนน");
define("_ADMIN_FORM_TECH_ADD_TAMBOL","ตำบล");
define("_ADMIN_FORM_TECH_ADD_AMPHUR","อำเภอ");
define("_ADMIN_FORM_TECH_ADD_PROVINCE","จังหวัด");
define("_ADMIN_FORM_TECH_ADD_ZIP","รหัสไปรษณีย์");
define("_ADMIN_FORM_TECH_PHONE","เบอร์โทรศัพท์");
define("_ADMIN_FORM_TECH_PIC","รูปภาพ");
define("_ADMIN_GD_TABLE_TITLE_GROUP_NUM","จำนวนรายวิชา");
define("_ADMIN_GRADE_GROUP_MESSAGE_ADD","ได้ทำการเพิ่มข้อมูลกลุ่มวิชาเรียบร้อยแล้ว");
define("_ADMIN_GRADE_GROUP_MESSAGE_EDIT","ได้ทำการแก้ไขข้อมูลกลุ่มวิชาเรียบร้อยแล้ว");
define("_ADMIN_GRADE_GROUP_MESSAGE_DEL","ได้ทำการลบข้อมูลกลุ่มวิชาเรียบร้อยแล้ว");
define("_ADMIN_GRADE_GROUP_MESSAGE_GOBACK","กลับหน้าจัดการกลุ่มวิชา");
define("_ADMIN_GD_TABLE_TITLE_ORDER","ระดับชั้น");
define("_ADMIN_GD_TABLE_TITLE_TERM","ภาคเรียน");
define("_ADMIN_GD_TABLE_TITLE_UNIT","หน่วยกิจ");
define("_ADMIN_GD_TABLE_TITLE_HOURS","ชั่วโมง/ภาค");
define("_ADMIN_GD_TABLE_TITLE_SUBJ_GROUP","กลุ่มวิชา");
define("_ADMIN_GD_TABLE_TITLE_SUBJ_NUM","จำนวนนักเรียน");
define("_ADMIN_GD_TABLE_TITLE_SUBJ_ADD","ลงทะเบียน");
define("_ADMIN_FORM_SUBJ_CODE_CAT","รหัสอ้างอิง");
define("_ADMIN_FORM_SUBJ_CODE_PIN","รหัสวิชา");
define("_ADMIN_FORM_SUBJ_NAME","ชื่อวิชา");
define("_ADMIN_FORM_SUBJ_ORDER","ระดับชั้น");
define("_ADMIN_FORM_SUBJ_TERM","ภาคเรียนที่");
define("_ADMIN_FORM_SUBJ_GROUP","กลุ่มวิชา");
define("_ADMIN_FORM_SUBJ_UNIT","หน่วยกิจ");
define("_ADMIN_FORM_SUBJ_HOURS","จำนวนชั่วโมง");
define("_ADMIN_FORM_SUBJ_MIDTERM","คะแนนรวมระหว่างเรียน");
define("_ADMIN_FORM_SUBJ_FINAL","คะแนนสอบปลายภาคเรียน");
define("_ADMIN_FORM_SUBJ_TEACH","ครูผู้สอน");
define("_ADMIN_FORM_SUBJ_TERM3","ตลอดปีการศึกษา");
define("_ADMIN_FORM_SUBJ_TERM1","ภาคเรียนที่ี 1");
define("_ADMIN_FORM_SUBJ_TERM2","ภาคเรียนที่ี 2");
define("_ADMIN_GRADE_SUBJECT_MESSAGE_ADD","ได้ทำการเพิ่มข้อมูลรายวิชาเรียบร้อยแล้ว");
define("_ADMIN_GRADE_SUBJECT_MESSAGE_EDIT","ได้ทำการแก้ไขข้อมูลรายวิชาเรียบร้อยแล้ว");
define("_ADMIN_GRADE_SUBJECT_MESSAGE_DEL","ได้ทำการลบข้อมูลรายวิชาเรียบร้อยแล้ว");
define("_ADMIN_GRADE_SUBJECT_MESSAGE_GOBACK","กลับหน้าจัดการรายวิชา");
define("_ADMIN_FORM_TRAN_YEAR","ปีการศึกษา");
define("_ADMIN_FORM_TRAN_SUM","ผลการเรียนเฉลี่ย");
define("_ADMIN_FORM_TRAN_SUM_AVG","คะแนนเฉลี่ย");
define("_ADMIN_FORM_TRAN_SUM_AVGSUM","เกรดเฉลี่ย");
define("_ADMIN_FORM_TRAN_STU","ชื่อนักเรียน");
define("_ADMIN_FORM_TRAN_MID","คะแนนระหว่างเรียน");
define("_ADMIN_FORM_TRAN_FINAL","คะแนนสอบปลายภาคเรียน");
define("_ADMIN_FORM_TRAN_TOTAL","คะแนนรวม");
define("_ADMIN_FORM_TRAN_GRADE","ผลการเรียน");
define("_ADMIN_FORM_STU_ID","รหัสนักเรียน");
define("_ADMIN_JAVA_ALERT_LIMIT","คะแนนรวมเกิน 100 ");
define("_ADMIN_JAVA_ALERT_NULL","ตัวเลขไม่ถูกต้อง");
define("_ADMIN_JAVA_ALERT_MID_LIMIT","ค่าของตัวเลขเกินค่าคะแนน midterm ที่ตั้งไว้ของรายวิชา");
define("_ADMIN_JAVA_ALERT_FINAL_LIMIT","ค่าของตัวเลขเกินค่าคะแนน final ที่ตั้งไว้ของรายวิชา");
define("_ADMIN_GRADE_TRAN_MESSAGE_ADD","ได้ทำการเพิ่มข้อมูลผลการเรียนเรียบร้อยแล้ว");
define("_ADMIN_GRADE_TRAN_MESSAGE_EDIT","ได้ทำการแก้ไขข้อมูลผลการเรียนเรียบร้อยแล้ว");
define("_ADMIN_GRADE_TRAN_MESSAGE_DEL","ได้ทำการลบข้อมูลผลการเรียนเรียบร้อยแล้ว");
define("_ADMIN_GRADE_TRAN_MESSAGE_GOBACK","กลับหน้าจัดการผลการเรียน");
define("_ADMIN_TABLE_CLASS_MAN","ชาย");
define("_ADMIN_TABLE_CLASS_WOMEN","หญิง");
define("_ADMIN_TABLE_CLASS_SUM","รวม");
define("_ADMIN_FORM_STU_NUM_NAME","คำนำหน้าชื่อ");
define("_ADMIN_FORM_STU_NUM_NAN","นาย");
define("_ADMIN_FORM_STU_NUM_NANG","นาง");
define("_ADMIN_FORM_STU_NUM_NANGSOW","นางสาว");
define("_ADMIN_FORM_STU_NUM_BOY","เด็กชาย");
define("_ADMIN_FORM_STU_NUM_GIRL","เด็กหญิง");
define("_ADMIN_FORM_STU_NAME","ชื่อ");
define("_ADMIN_FORM_STU_SUR","นามสกุล");
define("_ADMIN_FORM_STU_CODE","เลขประจำตัวนักเรียน");
define("_ADMIN_GRADE_STU_MESSAGE_ADD","ได้ทำการเพิ่มข้อมูลนักเรียนเรียบร้อยแล้ว");
define("_ADMIN_GRADE_STU_MESSAGE_EDIT","ได้ทำการแก้ไขข้อมูลนักเรียนเรียบร้อยแล้ว");
define("_ADMIN_GRADE_STU_MESSAGE_DEL","ได้ทำการลบข้อมูลนักเรียนเรียบร้อยแล้ว");
define("_ADMIN_GRADE_STU_MESSAGE_GOBACK","กลับหน้าจัดการข้อมูลนักเรียน");
define("_ADMIN_FORM_STU_ADD_BAN","บ้าน");
define("_ADMIN_FORM_GRADE_MAIN_TD_SELECT","เลือกรายการ");
define("_ADMIN_GRADE_SUM_GRAPH_VALUE","เกรดเฉลี่ย");
define("_ADMIN_GRADE_SUM_GRAPH_CLASS","ระดับชั้น");
define("_ADMIN_GRADE_SUM_GRAPH_TITLECLASS","กราฟแสดงผลการเรียนเฉลี่ย");
define("_ADMIN_SELECT_FILE","เลือกไฟล์");
define("_ADMIN_GRADE_TYPE_FILE_UPLOAD","ไฟล์ที่อัพโหลดต้องเป็นไฟล์ที่มีนามสกุลไฟล์");
define("_ADMIN_GRADE_TYPE_FILE_UPLOAD1","เท่านั้น");
define("_ADMIN_GRADE_SAMPLE_FILE_UPLOAD","โหลดไฟล์ตัวอย่าง");
define("_MOD_FORM_GD_STAFF","ข้อมูลเจ้าหน้าที่");

define("_MOD_FORM_SELECT_TERM","เลือกรายการที่ต้องการ");

define('_text_box_table_stu_year', 'ปีการศึกษา');
define('_button_importcsv', 'นำเข้าข้อมูลจากไฟล์');
define('_text_box_form_import_sample_file', 'ดาวน์โหลดไฟล์ตัวอย่าง');
define('_button_importcsv_send', 'upload ไฟล์');
define('_button_importcsv_select_student', "ไฟล์จากระบบ Secondary'56");
define('_button_importcsv_select_sgs', 'ไฟลจากระบบ SGS');
define('_button_importcsv_select', "เลือกการนำเข้าข้อมูล");
define('_button_importcsv_select_stu_bb', "จากระบบ Secondary'56");
define('_button_importcsv_select_sgs_bb', 'จากระบบ SGS');
define('_button_importcsv_select_sgs_term1', 'ไฟล์ภาคเรียนที่ 1');
define('_button_importcsv_select_sgs_term2', 'ไฟล์ภาคเรียนที่ 2');
define('_button_importcsv_select_term', "เลือกภาคเรียน");
define('_text_box_form_onet_year', 'ปีการศึกษา');

?>