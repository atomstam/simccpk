<?php
//หากมีการเรียกไฟล์นี้โดยตรง
if (preg_match('/config.php/i',$_SERVER['PHP_SELF'])) {
    Header('Location: ../index.php');
    die();
}

// Version
define("_SCRIPT","SIM"); 
define('VERSION', '2.0');
define('TIMESTAMP', time());

//config
define('_heading_main_title', 'ระบบจัดการข้อมูลนักเรียน');
define('_heading_main_title_eng', 'Student Information Management System');

define('_logo_main_title', 'SIM 2.0');
define('_footer_main_title', 'SIM 2.0');
define('_text_footer1', 'SIM 2.0');
define('_text_footer2', 'พัฒนาโดย นายชัดสกร พิกุลทอง ผู้อำนวยการโรงเรียนกู่ทองพิทยาคม อำเภอเชียงยืน จังหวัดมหาสารคาม');
define('_text_footer3', 'โทร. 089946997 website : https://sim.kut.ac.th  email : atom3123@gmail.com');
define('_google_email','atom3123@gmail.com');
define('_google_email_password','tomtam3123');
define('_facebook_wall','1');
define('_facebook_comm','1');
define('_facebook_api_key','257087804303083');
define('_facebook_api_secret','eaa6344df3e9ab2048e39780ecee02c3');


//MySQL Connect
define('DB_HOST','localhost');
define('DB_NAME','stdkut');
define('DB_USERNAME','stdkut');
define('DB_PASSWORD','44012023');
//define('DB_USERNAME','root');
//define('DB_PASSWORD','');
define('ISO','utf-8');
define('WEB_TEMPLATES','shit');

define('YEAR','2562');
define('YEAR_LAST1','2561');
define('YEAR_LAST2','2560');
define('YEAR_LAST3','2559');
define('YEAR_LAST4','2558');


define('WEB_PATH', '/home/stdkut/public_html');
define('WEB_URL', 'https://sim.kut.ac.th');
define('WEB_URLS', 'https://sim.kut.ac.th');
define('WEB_EMAIL', 'atom3123@gmail.com');
define('WEB_EMAIL_PASS', '3123tomtam');
define('WEB_URL_IMG', 'https://sim.kut.ac.th/img/');
define('WEB_URL_IMG_ADMIN', 'https://sim.kut.ac.th/img/admin/');
define('WEB_URL_IMG_PERSON', 'https://sim.kut.ac.th/img/person/');
define('WEB_URL_IMG_STU', 'https://sim.kut.ac.th/img/stu/');
define('WEB_URL_IMG_USER', 'https://sim.kut.ac.th/img/user/');
define('WEB_URL_IMG_MAG', 'https://sim.kut.ac.th/img/mag/');
define('WEB_URL_IMG_ICON', 'https://sim.kut.ac.th/img/icon/');
define('WEB_URL_IMG_MOTOR', 'https://sim.kut.ac.th/img/motor/');
define('WEB_PATH_IMG_ADMIN', '/home/stdkut/public_html/img/admin/');
define('WEB_PATH_IMG_PERSON', '/home/stdkut/public_html/img/person/');
define('WEB_PATH_IMG_STU', '/home/stdkut/public_html/img/stu/');
define('WEB_PATH_IMG_USER', '/home/stdkut/public_html/img/user/');
define('WEB_PATH_IMG_MAG', '/home/stdkut/public_html/img/mag/');
define('WEB_PATH_IMG_ICON', '/home/stdkut/public_html/img/icon/');
define('WEB_PATH_IMG_MOTOR', '/home/stdkut/public_html/img/motor/');
define('WEB_PATH_UPLOAD', '/home/stdkut/public_html/uploads/');

define('WEB_URL_IMG_NEWS', 'https://sim.kut.ac.th/img/news/');
define('WEB_PATH_IMG_NEWS', '/home/stdkut/public_html/img/news/');
define('WEB_URL_IMG_NEWS_RAN', 'https://sim.kut.ac.th/img/news/');
define('WEB_PATH_IMG_NEWS_RAN', '/home/stdkut/public_html/img/news/');

define('WEB_URL_IMG_SCHOOL','https://sim.kut.ac.th/img/school/');
define('WEB_PATH_IMG_SCHOOL','/home/stdkut/public_html/img/school/');

//define('WEB_PATH', '/usr/local/www/apache22/data/maxtom');
//define('WEB_URL', 'http://thaiesan.sytes.net/maxtom');
//define('WEB_EMAIL', 'atom3123@gmail.com');
//define('WEB_URL_IMG', 'http://thaiesan.sytes.net/maxtom/img/');
//define('WEB_URL_IMG_ADMIN', 'http://thaiesan.sytes.net/maxtom/img/admin/');
//define('WEB_URL_IMG_USER', 'http://thaiesan.sytes.net/maxtom/img/user/');
//define('WEB_URL_IMG_MAG', 'http://thaiesan.sytes.net/maxtom/img/mag/');
//define('WEB_URL_IMG_ICON', 'http://thaiesan.sytes.net/maxtom/img/icon/');
//define('WEB_PATH_IMG_ADMIN', '/usr/local/www/apache22/data/maxtom/img/admin/');
//define('WEB_PATH_IMG_USER', '/usr/local/www/apache22/data/maxtom/img/user/');
//define('WEB_PATH_IMG_MAG', '/usr/local/www/apache22/data/maxtom/img/mag/');
//define('WEB_PATH_IMG_ICON', '/usr/local/www/apache22/data/maxtom/img/icon/');
//define('WEB_PATH_UPLOAD', '/usr/local/www/apache22/data/maxtom/uploads/');


define('_I_USER_W', '150'); // ขนาดความกว้างของรูปภาพสามชิกและผู้ดูแลระบบ
define('_I_USER_H', '200'); // ขนาดความสูงของรูปภาพสามชิกและผู้ดูแลระบบ
define('_I_IPER_W', '150'); // ขนาดความกว้างของรูปภาพสามชิกและผู้ดูแลระบบ
define('_I_IPER_H', '200'); // ขนาดความสูงของรูปภาพสามชิกและผู้ดูแลระบบ
define('_I_ISTU_W', '150'); // ขนาดความกว้างของรูปภาพสามชิกและผู้ดูแลระบบ
define('_I_ISTU_H', '200'); // ขนาดความสูงของรูปภาพสามชิกและผู้ดูแลระบบ
define('_I_MOTOR_W', '200'); 
define('_I_MOTOR_H', '200'); 
define('_I_NEWS_W', '300'); 
define('_I_NEWS_H', '300'); 
define('_I_NEWS_RAN_W', '2048'); 
define('_I_NEWS_RAN_H', '800'); 
//MySQL table
define('TB_BIRTH','web_birth');

define('TB_ACTIVEUSER','web_activeuser');
define('TB_ADMIN','web_admin');
define('TB_ADMIN_MENU','web_admin_menu');
define('TB_ADMIN_RESET','web_admin_reset');
define('TB_ADMIN_ONLINE','web_admin_online');
define('TB_ADMIN_GROUP','web_admin_group');
define('TB_AMPHUR','web_amphur');
define('TB_BAD','web_bad');
define('TB_BADDATA','web_baddata');
define('TB_BADLEVEL','web_badlevel');
define('TB_BADTAIL','web_badtail');
define('TB_BAD_BAK','web_bad_bak');
define('TB_BEST','web_best');
define('TB_BESTTAIL','web_besttail');
define('TB_BEST_BAK','web_best_bak');
define('TB_BHOME','web_bhome');
define('TB_BHOMETAIL','web_bhometail');
define('TB_BLOCK','web_block');
define('TB_CARD_STUDENT','web_card_student');
define('TB_CHCLASS','web_chclass');
define('TB_CLASS','web_class');
define('TB_CLASS_GROUP','web_class_group');
define('TB_CLASS_PERSON','web_class_person');
define('TB_DAM','web_dam');
define('TB_DAMTAIL','web_damtail');
define('TB_DOM','web_dom');
define('TB_EXIT','web_exit');
define('TB_EXITTAIL','web_exittail');
define('TB_LA','web_la');
define('TB_LATAIL','web_latail');
define('TB_GCOLOR','web_gcolor');
define('TB_GOHOME','web_gohome');
define('TB_GOHOMETAIL','web_gohometail');
define('TB_GOOD','web_good');
define('TB_GOODTAIL','web_goodtail');
define('TB_GOODDATA','web_gooddata');
define('TB_GOODLEVEL','web_goodlevel');
define('TB_GOOD_BAK','web_good_bak');
define('TB_GOTOSCH','web_gotosch');
define('TB_GRADE_STUDENT','web_grade_student');
define('TB_MENU','web_menu');
define('TB_MESSAGE','web_message');
define('TB_MESSAGE_CHECK','web_message_check');
define('TB_MESSAGE_COM','web_message_comment');
define('TB_MODULES','web_modules');
define('TB_NEWS','web_news');
define('TB_NEWS_CATE','web_news_category');
define('TB_NEWS_COM','web_news_comment');
define('TB_ORG','web_org');
define('TB_PERSON','web_person');
define('TB_PERSON_GROUP','web_person_group');
define('TB_PROVINCE','web_province');
define('TB_PUT','web_put');
define('TB_PUTPER','web_putper');
define('TB_PUTLEVEL','web_putlevel');
define('TB_PUTTAIL','web_puttail');
define('TB_PUTTAIL_BAK','web_puttail_bak');
define('TB_RUBRONG','web_rubrong');
define('TB_RUBRONGTAIL','web_rubrongtail');
define('TB_SESSION','web_session');

define('TB_SPACIAL','web_spacial');
define('TB_SPACIALTAIL','web_spacialtail');
define('TB_SPACIALTAIL_BAK','web_spacialtail_bak');
define('TB_MOTOR','web_motor');
define('TB_MOTORTAIL','web_motortail');
define('TB_MOTORTAIL_BAK','web_motortail_bak');
define('TB_ENT','web_ent');
define('TB_ENTTAIL','web_enttail');

define('TB_STUDENT','web_student');
define('TB_STUDENT_BAK','web_student_bak');
define('TB_TUMBON','web_tumbon');
define('TB_USER','web_user');
define('TB_USER_MENU','web_user_menu');
define('TB_USER_RESET','web_user_reset');
define('TB_USER_LEVEL','web_user_level');
define('TB_USER_ONLINE','web_user_online');
define('TB_USER_GROUP','web_user_group');
define('TB_VOTE','web_vote');
define('TB_VISITOR','web_visitors');

define('TB_COUNCIL','web_council');
define('TB_COUNTAIL','web_counciltail');
define('TB_WHITECLASS','web_whiteclass');
define('TB_WHITECLTAIL','web_whitecltail');
define('TB_AFFAIRS','web_affairs');
define('TB_AFFTAIL','web_afftail');


define('TB_NUT','web_nut');
define('TB_TUNBON','web_tunbon');

define('_I_SCHOOL_W', '1024'); 
define('_I_SCHOOL_H', '373');

define('_I_AREA_W', '1024'); 
define('_I_AREA_H', '768'); 

define("TB_AREA","web_area");
define('TB_AREA_USER','web_area_user');
define('TB_AREA_USER_GROUP','web_area_user_group');
define('TB_AREA_USER_MENU','web_area_user_menu');
define('TB_AREA_USER_RESET','web_area_user_reset');
define('TB_AREA_USER_ONLINE','web_area_user_online');
define('TB_AREA_USER_PERM','web_area_user_perm');
define("TB_AREA_BOSS","web_area_boss");
define("TB_AREA_BOSS_GR","web_area_boss_gr");
define('TB_AREA_LINE','web_area_line');

define('TB_SCHOOL','web_school');
define('TB_SCHOOL_CODE','web_school_code');
define('TB_SCHOOL_GR','web_school_gr');
define('TB_SCHOOL_LEVEL','web_school_level');
define('TB_SCHOOL_FINAL','web_school_final');
define('TB_SCHOOL_STU','web_school_stu');
define('TB_SCHOOL_STU_YEAR','web_school_stu_year');
define('TB_SCHOOL_STU_TERM','web_school_stu_term');

//grade online
define("TB_GD_TRAN","web_grade_transcript");
define("TB_GD_TEACH","web_grade_teacher");
define("TB_GD_SUBJ","web_grade_subject");
define("TB_GD_GROUP","web_grade_group");
define("TB_GD_ACC","web_grade_activity");
define("TB_GD_ATT","web_grade_attribute");
define("TB_GD_CAP","web_grade_capacity");
define("TB_GD_TRANAC","web_grade_tranAC");
define("TB_GD_TRANATT","web_grade_tranATT");
define("TB_GD_TRANCAP","web_grade_tranCAP");
define("TB_GD_TERM","web_grade_term");

define('TB_YEAR','web_year');

define("TB_REGISTER","web_register");

define('_Facebook_Api_Key','334116950629804');
define('_Facebook_Api_Secret','efab57865b2d52cfb4f10c48b41d6e4a');

define('_GOOGLE_Api_ID','770360926176-jg73mvl07k38ue2rk19lkh2jbpt7jqu5.apps.googleusercontent.com');
define('_GOOGLE_Api_Secret','1HyGV7WGKOlOZN8ODnzMolW3');

define('LINE_API',"http://notify-api.line.me/api/notify");

?>
