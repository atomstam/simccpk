<?php
// header
define('_heading_title', 'ข้อมูลการเข้าเรียน');
define('_heading_title_M_tab1', 'เพิ่มข้อมูลการร่วมกิจกรรมหน้าเสาธง');
define('_heading_title_M_tab2', 'เพิ่มข้อมูลการร่วมกิจกรรมนั่งสมาธิ');
define('_heading_title_M_tab3', 'เพิ่มข้อมูลการร่วมกิจกรรมหลังเลิกเรียน');
define('_heading_title_M_tab4', 'เพิ่มข้อมูลการเข้าเรียนแต่ละวิชา');

// Button
define('_button_add', 'เพิ่มข้อมูลใหม่');
define('_button_reset', 'ยกเลิก');
define('_button_save', 'บันทึกข้อมูล');
define('_button_del', 'ลบข้อมูล');
define('_button_edit', 'แก้ไขข้อมูล');
define('_button_detail', 'กลับหน้าแรก');

// detail gen
define('_text_box_header_gen', 'ข้อมูลการเข้าเรียน');
define('_text_box_body_user_name', 'ชื่อ');
define('_text_box_body_user_surname', 'นามสกุล');
define('_text_box_body_user_username', 'ชื่อนักเรียน');
define('_text_box_body_user_email', 'email');
define('_text_box_body_user_img', 'รูปภาพประจำตัว');

define('_text_report_add_ok', 'เพิ่มข้อมูลการเข้าเรียนเรียบร้อยแล้ว');
define('_text_report_add_fail', 'ไม่สามารถเพิ่มข้อมูลการเข้าเรียนเข้าระบบได้');

define('_text_report_del_ok', 'ลบข้อมูลการเข้าเรียนเรียบร้อยแล้ว');
define('_text_report_del_fail', 'ไม่สามารถลบข้อมูลการเข้าเรียนได้');
define('_text_report_del_null_fail', 'ไม่มีข้อมูลที่จะลบ');

define('_text_report_edit_ok', 'แก้ไขข้อมูลการเข้าเรียนเรียบร้อยแล้ว');
define('_text_report_edit_fail', 'ไม่สามารถแก้ไขข้อมูลการเข้าเรียนได้');
define('_text_no_results', 'ไม่มีข้อมูล');

// list

define('_text_box_table_stu_class', 'ระดับชั้น');
define('_text_box_table_stu_class_select', 'เลือกระดับชั้น');
define('_text_box_table_stu_birth', 'วัน เดือน ปี');

//tabs
define('_text_box_tab_head_tab1', 'ข้อมูลส่วนตัว');
define('_text_box_tab_head_tab2', 'ที่อยู่');
define('_text_box_tab_head_tab3', 'ข้อมูลผู้ปกครอง');
define('_text_box_tab_head_tab4', 'ข้อมูลเพิ่มเติม');

//confierm delete
define('_text_box_con_delete_head', 'ยืนยันการลบข้อมูล');
define('_text_box_con_delete_text', 'ถ้าลบข้อมูลนี้ ข้อมูลทั้งหมดจะถูกลบอย่างถาวร คุณต้องการดำเนินการต่อหรือไม่');

// tab1
define('_text_box_table_tab1_stu_id', 'รหัสนักเรียน');
define('_text_box_table_tab1_stu_name', 'ชื่อนักเรียน');
define('_text_box_table_tab1_status1', 'ขาด');
define('_text_box_table_tab1_status2', 'ลา');
define('_text_box_table_tab1_status3', 'มาสาย');
define('_text_box_table_tab1_value_status1', 'ไม่ร่วมกิจกรรมหน้าเสาธง');
define('_text_box_table_tab1_value_status2', 'ลากิจกรรมหน้าเสาธง');
define('_text_box_table_tab1_value_status3', 'มาเข้าร่วมกิจกรรมหน้าเสาธงสาย');

define('_text_add_tab1_badtail_name_kad', 'ไม่มาร่วมกิจกรรมหน้าเสาธง');
define('_text_add_tab1_badtail_name_la', 'ลากิจกรรมหน้าเสาธง');
define('_text_add_tab1_badtail_name_sai', 'มาร่วมกิจกรรรมหน้าเสาธงสาย');

// tab2
define('_text_box_table_tab2_stu_id', 'รหัสนักเรียน');
define('_text_box_table_tab2_stu_name', 'ชื่อนักเรียน');
define('_text_box_table_tab2_status1', 'ขาด');
define('_text_box_table_tab2_status2', 'ลา');
define('_text_box_table_tab2_status3', 'มาสาย');
define('_text_box_table_tab2_value_status1', 'ไม่ร่วมกิจกรรมนั่งสมาธิ');
define('_text_box_table_tab2_value_status2', 'ลากิจกรรมนั่งสมาธิ');
define('_text_box_table_tab2_value_status3', 'มาเข้าร่วมกิจกรรมนั่งสมาธิ');

define('_text_add_tab2_badtail_name_kad', 'ไม่มาร่วมกิจกรรมนั่งสมาธิ');
define('_text_add_tab2_badtail_name_la', 'ลากิจกรรมนั่งสมาธิ');
define('_text_add_tab2_badtail_name_sai', 'มาเข้าร่วมกิจกรรมนั่งสมาธิสาย');

// tab3
define('_text_box_table_tab3_stu_id', 'รหัสนักเรียน');
define('_text_box_table_tab3_stu_name', 'ชื่อนักเรียน');
define('_text_box_table_tab3_status1', 'ขาด');
define('_text_box_table_tab3_status2', 'ลา');
define('_text_box_table_tab3_status3', 'มาสาย');
define('_text_box_table_tab3_value_status1', 'ไม่ร่วมกิจกรรมหลังเลิกเรียน');
define('_text_box_table_tab3_value_status2', 'ลากิจกรรมหลังเลิกเรียน');
define('_text_box_table_tab3_value_status3', 'มาเข้าร่วมกิจกรรมหลังเลิกเรียน');

define('_text_add_tab3_badtail_name_kad', 'ไม่มาร่วมกิจกรรมหลังเลิกเรียน');
define('_text_add_tab3_badtail_name_la', 'ลากิจกรรมหลังเลิกเรียน');
define('_text_add_tab3_badtail_name_sai', 'มาเข้าร่วมกิจกรรมหลังเลิกเรียนสาย');


// tab4
define('_text_box_table_tab4_stu_id', 'รหัสนักเรียน');
define('_text_box_table_tab4_stu_name', 'ชื่อนักเรียน');
define('_text_box_table_tab4_sec1', 'คาบที่ 1');
define('_text_box_table_tab4_sec2', 'คาบที่ 2');
define('_text_box_table_tab4_sec3', 'คาบที่ 3');
define('_text_box_table_tab4_sec4', 'คาบที่ 4');
define('_text_box_table_tab4_sec5', 'คาบที่ 5');
define('_text_box_table_tab4_sec6', 'คาบที่ 6');
define('_text_box_table_tab4_sec7', 'คาบที่ 7');
define('_text_box_table_tab4_value_sec1', 'หนีเรียนคาบที่ 1');
define('_text_box_table_tab4_value_sec2', 'หนีเรียนคาบที่ 2');
define('_text_box_table_tab4_value_sec3', 'หนีเรียนคาบที่ 3');
define('_text_box_table_tab4_value_sec4', 'หนีเรียนคาบที่ 4');
define('_text_box_table_tab4_value_sec5', 'หนีเรียนคาบที่ 5');
define('_text_box_table_tab4_value_sec6', 'หนีเรียนคาบที่ 6');
define('_text_box_table_tab4_value_sec7', 'หนีเรียนคาบที่ 7');

?>