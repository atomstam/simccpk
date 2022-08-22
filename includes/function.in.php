<?php
function CalAge($pbday)//คำนวณอายุเป็น ปี เดือน วัน | การนำไปใช้งาน echo CalAge("16/01/1980");
{
$todayY = date("Y");
$todayM = date("m");
$todayD = date("d");
//$todayY = date("2019");
//$todayM = date("11");
//$todayD = date("10");
$bdate=explode("-",$pbday);
$bY=$bdate[0];
$bM=$bdate[1];
$bD=$bdate[2];
$LeapYear=date("L"); // 1 = leap year Feb has 29 day

$d31 = array('01', '03', '05', '07', '08', '10', '12');
$d30 = array('04', '06', '09', '11');
$d28 = array('02');

$todayM2=$bM;

if(array_search($todayM2, $d31)==TRUE){ $subD=31; }
else if(array_search($todayM2, $d30)==TRUE){ $subD=30; }
else if(array_search($todayM2, $d28)==TRUE){ if($LeapYear==1) { $subD=29; } else { $subD=28; } }

if(($todayY==$bY)&&($todayM==$bM)&&($todayD==$bD)) { $aY2=0; $aM2=0; $aD2=0; }
else if(($todayY==$bY)&&($todayM==$bM)&&($todayD>$bD)) { $aY2=0; $aM2=0; $aD2=$todayD-$bD; }
//else if(($todayY==$bY)&&($todayM==$bM)&&($todayD<$bD)) { $aY2=0; $aM2=12-($todayM-$bM); $aD2=$subD-($bD-$todayD); }

else if(($todayY==$bY)&&($todayM>$bM)&&($todayD==$bD)) { $aY2=0; $aM2=$todayM-$bM; $aD2=0; }
else if(($todayY==$bY)&&($todayM>$bM)&&($todayD>$bD)) { $aY2=0; $aM2=$todayM-$bM; $aD2=$todayD-$bD; }
else if(($todayY==$bY)&&($todayM>$bM)&&($todayD<$bD)) { $aY2=0; $aM2=12-($todayM-$bM); $aD2=$subD-($bD-$todayD); }


else if(($todayY>$bY)&&($todayM>$bM)&&($todayD==$bD)) { $aY2=$todayY-$bY; $aM2=$todayM-$bM; $aD2=0; }
else if(($todayY>$bY)&&($todayM>$bM)&&($todayD>$bD)) { $aY2=$todayY-$bY; $aM2=$todayM-$bM; $aD2=$todayD-$bD; }
else if(($todayY>$bY)&&($todayM>$bM)&&($todayD<$bD)) { $aY2=$todayY-$bY; $aM2=$todayM-$bM-1; $aD2=$subD-($bD-$todayD); }

else if(($todayY>$bY)&&($todayM<$bM)&&($todayD==$bD)) { $aY2=$todayY-$bY-1; $aM2=$bM-$todayM; $aD2=0; }
else if(($todayY>$bY)&&($todayM<$bM)&&($todayD<$bD)) { $aY2=$todayY-$bY-1; $aM2=12-($bM-$todayM)-1; $aD2=$bD-$todayD; }
else if(($todayY>$bY)&&($todayM<$bM)&&($todayD>$bD)) { $aY2=$todayY-$bY-1; $aM2=12-($bM-$todayM); $aD2=$todayD-$bD; }

else if(($todayY>$bY)&&($todayM==$bM)&&($todayD==$bD)) { $aY2=$todayY-$bY; $aM2=0; $aD2=0; }
else if(($todayY>$bY)&&($todayM==$bM)&&($todayD>$bD)) { $aY2=$todayY-$bY; $aM2=0; $aD2=$todayD-$bD; }
else if(($todayY>$bY)&&($todayM==$bM)&&($todayD<$bD)) { $aY2=$todayY-$bY-1; $aM2=11; $aD2=$subD-($bD-$todayD); }

return array($aY2,$aM2,$aD2);
}

// ระดับคะแนนความประพฤติ
function RateRating($Percent){
global $db ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
if(@$Percent >80){
return _RateRating_A; //ดีเยี่ยม
} else if(@$Percent >70 && @$Percent <= 80){
return _RateRating_B; //ดีมาก
} else if(@$Percent >60 && @$Percent <= 70){
return _RateRating_C; //ดี
} else if(@$Percent >50 && @$Percent <= 60){
return _RateRating_D; //ปานกลาง
} else if(@$Percent >0 && @$Percent <= 50){
return _RateRating_E; //พอใช้
} else {
return _RateRating_F; //แก้ไข
}
}

// ร้อยละคะแนนความประพฤติ
function PercentRating($stu='',$area='',$code=''){
global $db ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['numg'] = $db->select_query("select *,sum(goodtail_point) as CO  from ".TB_GOOD." ,".TB_STUDENT.",".TB_GOODTAIL.",".TB_CLASS." where stu_area='".$area."' and stu_code='".$code."' and stu_id=good_stu and good_tail=goodtail_id and class_id=stu_class group by stu_id HAVING CO > 0 order by CO desc,stu_class,stu_cn desc  limit 1"); 
@$rows['numg'] = $db->fetch(@$res['numg']);
$G=@$rows['numg']['CO'];

@$res['gtail'] = $db->select_query("SELECT *,sum(goodtail_point) As GP FROM ".TB_GOOD." as a ,".TB_GOODTAIL." as b WHERE a.good_stu='".$stu."' and a.good_area='".$area."' and a.good_code='".$code."' and a.good_tail=b.goodtail_id "); 
@$arr['gtail'] =$db->fetch(@$res['gtail']);
@$res['btail'] = $db->select_query("SELECT *,sum(badtail_point) As BP FROM ".TB_BAD." as a ,".TB_BADTAIL." as b WHERE a.bad_stu='".$stu."' and a.bad_area='".$area."' and a.bad_code='".$code."' and a.bad_tail=b.badtail_id "); 
@$arr['btail'] =$db->fetch(@$res['btail']);
$SCO=(int)(@$arr['gtail']['GP'])-(int)(@$arr['btail']['BP']);
@$Percentage=(100*$SCO)/$G;
return @$Percentage;
}

// คะแนนความประพฤติ
function ScoreRating($stu='',$area='',$code=''){
global $db ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['gtail'] = $db->select_query("SELECT *,sum(goodtail_point) As GP FROM ".TB_GOOD." as a ,".TB_GOODTAIL." as b WHERE a.good_stu='".$stu."' and a.good_area='".$area."' and a.good_code='".$code."' and a.good_tail=b.goodtail_id "); 
@$arr['gtail'] =$db->fetch(@$res['gtail']);
@$res['btail'] = $db->select_query("SELECT *,sum(badtail_point) As BP FROM ".TB_BAD." as a ,".TB_BADTAIL." as b WHERE a.bad_stu='".$stu."' and a.bad_area='".$area."' and a.bad_code='".$code."' and a.bad_tail=b.badtail_id "); 
@$arr['btail'] =$db->fetch(@$res['btail']);
$SCO=(int)(@$arr['gtail']['GP'])-(int)(@$arr['btail']['BP']);
return $SCO;
}

//จำนวนวันลา
function CheckDateLa($dateIn,$dateOut){
global $db ;
$DD1=strtotime($dateIn);
$DD2=strtotime($dateOut);
$RRS=$DD2-$DD1  ;
$RR=($RRS)/(60*60*24);
return $RR+1;
}

function sECONDS_TO_HMS($seconds)
  {

     @$days = floor($seconds/86400);
     @$hrs = floor($seconds/3600);
     @$mins = intval(($seconds / 60) % 60); 
     @$sec = intval($seconds % 60);

        if($days>0){
          //echo $days;exit;
          @$hrs = str_pad($hrs,2,'0',STR_PAD_LEFT);
          @$hours=$hrs-($days*24);
          @$return_days = $days." Days ";
          @$hrs = str_pad($hours,2,'0',STR_PAD_LEFT);
     }else{
      @$return_days="";
      @$hrs = str_pad($hrs,2,'0',STR_PAD_LEFT);
     }

     @$mins = str_pad($mins,2,'0',STR_PAD_LEFT);
     @$sec = str_pad($sec,2,'0',STR_PAD_LEFT);

   //  return $return_days.$hrs.":".$mins.":".$sec;
   return sprintf('%s%02d:%02d:%02d', $return_days, $hrs, $mins, $sec);
  }

function SECONDSTOHMS($secondsx)
  {

     @$daysx = floor($secondsx/86400);
     @$hrsx = intval(($secondsx/3600));
     @$minsx = intval(($secondsx / 60) % 60); 
     @$secx = intval($secondsx % 60);

        if($daysx>0){
          //echo $days;exit;
          //$hrs = str_pad($hrs,2,'0',STR_PAD_LEFT);
          $hoursx=$hrsx-($daysx*24);
          $return_daysx = $daysx." วัน ";
          //$hrs = str_pad($hours,2,'0',STR_PAD_LEFT);
     }else{
      $return_daysx="";
      //$hrs = str_pad($hrs,2,'0',STR_PAD_LEFT);
     }
	if($hrsx>0){
		$return_hrsx=$hrsx;
		return sprintf('%s%2d ชั่วโมง %2d นาที %2d วินาที', $return_daysx, $return_hrsx, $minsx, $secx);
	} else {
		$return_hrsx="";
		return sprintf('%s%2d นาที %2d วินาที', $return_daysx, $minsx, $secx);
	}
     //$mins = str_pad($mins,2,'0',STR_PAD_LEFT);
     //$sec = str_pad($sec,2,'0',STR_PAD_LEFT);

   //  return $return_days.$hrs.":".$mins.":".$sec;
   //return sprintf('%s%02d ชั่วโมง %02d นาที %02d วินาที', $return_days, $return_hrs, $mins, $sec);
  }

function KILO($seconds)
  {
	@$kilo = number_format(($seconds/1000),2);
	return $kilo." กิโลเมตร";
  }

function AgeFin($DD) {
	//$birthday = "1982-06-10";      //รูปแบบการเก็บค่าข้อมูลวันเกิด
	$birthday = $DD;
	$today = date("Y")."-09-30";   //จุดต้องเปลี่ยน
		
	list($byear, $bmonth, $bday)= explode("-",$birthday);       //จุดต้องเปลี่ยน
	//list($tyear, $tmonth, $tday)= explode("-",$today);                //จุดต้องเปลี่ยน
		
	//$mbirthday = mktime(0, 0, 0, $bmonth, $bday, $byear); 
	//$mnow = mktime(0, 0, 0, $tmonth, $tday, $tyear );
	//$mage = ($mnow - $mbirthday);
	
	//echo "วันเกิด $birthday"."<br>\n";
 	//echo "วันที่ปัจจุบัน $today"."<br>\n";
	//echo "รับค่า $mage"."<br>\n";

	//$u_y=date("Y", $mage)-1970;
	//$u_m=date("m",$mage)-1;
	//$u_d=date("d",$mage)-1;
	$Dend =$byear+60;
	//$Dend = 60-($u_y);

	if($bmonth>'09'){
		$YFin=(1+$Dend)+543;
	} else {
		$YFin=($Dend)+543;
	}
	return $YFin;
//echo"<br><br>$u_y   ปี    $u_m เดือน      $u_d  วัน<br><br>";

}


function progress_bar_percentage($counts,$sum) {
global $db ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$Percent=number_format(((((int)$counts)*100)/(int)$sum),2);
//@$Percentx=(((int)$Row)*100)/(int)$num;
//print @$Percent;
//@$Percent=number_format(@$Percentx,2);
if(@$Percent > 70){
print "<div class=\"progress\">
                <div class=\"progress-bar progress-bar-green\" role=\"progressbar\" aria-valuenow=\"".@$Percent."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".@$Percent."%\">".@$Percent."%</div>
                </div>
              </div>";
} else if(@$Percent <= 70 && @$Percent >30) {
print "<div class=\"progress\">
                <div class=\"progress-bar progress-bar-aqua\" role=\"progressbar\" aria-valuenow=\"".@$Percent."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".@$Percent."%\">".@$Percent."%</div>
              </div>";
} else if(@$Percent > 0 && @$Percent <=30) {
print "<div class=\"progress\">
                <div class=\"progress-bar progress-bar-yellow\" role=\"progressbar\" aria-valuenow=\"".@$Percent."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".@$Percent."%\">".@$Percent."%</div>
                </div>
              </div>";
}	else if(@$Percent == 0 ) {
print "<div class=\"progress\">
                <div class=\"progress-bar progress-bar-red\" role=\"progressbar\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 100%\">".@$Percent."%</div>
                </div>
              </div>";
}		
//return $info;
}

function progress_bar_whitecl($class,$room) {
global $db ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['gh'] = $db->select_query("SELECT * FROM ".TB_WHITECLASS." "); 
@$rowsGH=$db->rows(@$res['gh']);

@$res['wcl'] = $db->select_query("SELECT * FROM ".TB_WHITECLTAIL." WHERE whcl_area='".$_SESSION['admin_area']."' and whcl_code='".$_SESSION['admin_school']."' and whcl_class='".$class."' and whcl_gr='".$room."' group by whcl_wh"); 
@$rowsWcl=$db->rows(@$res['wcl']);

@$Percent=number_format(((((int)@$rowsWcl)*100)/(int)@$rowsGH),2);
//@$Percentx=(((int)$Row)*100)/(int)$num;
//print @$Percent;
//@$Percent=number_format(@$Percentx,2);
if(@$Percent > 70){
print "<div class=\"progress\">
                <div class=\"progress-bar progress-bar-green\" role=\"progressbar\" aria-valuenow=\"".@$Percent."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".@$Percent."%\">".@$Percent."%</div>
                </div>
              </div>";
} else if(@$Percent <= 70 && @$Percent >30) {
print "<div class=\"progress\">
                <div class=\"progress-bar progress-bar-aqua\" role=\"progressbar\" aria-valuenow=\"".@$Percent."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".@$Percent."%\">".@$Percent."%</div>
              </div>";
} else if(@$Percent > 0 && @$Percent <=30) {
print "<div class=\"progress\">
                <div class=\"progress-bar progress-bar-yellow\" role=\"progressbar\" aria-valuenow=\"".@$Percent."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".@$Percent."%\">".@$Percent."%</div>
                </div>
              </div>";
}	else if(@$Percent == 0 ) {
print "<div class=\"progress\">
                <div class=\"progress-bar progress-bar-red\" role=\"progressbar\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 100%\">".@$Percent."%</div>
                </div>
              </div>";
}		
//return $info;
}

function GETMODULELOGIN($name,$file){
	global $MODPATH, $MODPATHFILE ;
	$targetPath = WEB_PATH;
	if(empty($name)){$name= "index";}
	if(empty($file)){$file = "index";}
	$files = str_replace('../', '', $file);
	$names = str_replace('../', '', $name);
	$modpathfile=$targetPath."/signin/modules/".$names."/".$files.".php";
	if (file_exists($modpathfile)) {
	$MODPATHFILE = $modpathfile;
	$MODPATH = $targetPath."/signin/modules/".$names."/";
	}else{
	header( 'Content-Type:text/html; charset=utf-8');
	die (""._NO_MOD."");
	}
}


//ส่ง Line ในกลุ่มห้องเรียน
function Line_To_Class_BG($Class,$Clname,$group,$Message1,$Message2,$Message3,$Token){
$Date=date('d-m-Y H:i:s');
//$Revert=$gr."x".$id;
$message = _text_report_line_message1." ".$Clname." "._text_report_line_message5." ".$group."\r\n";
//$message .= _text_report_line_message2."".$Date." \r\n";
$message .= _text_report_line_message2."".DateTimeThai($Date)." \r\n";
$message .= _text_report_line_message7."\r\n";
$message .= "".$Message1."\r\n";
$message .= _text_report_line_message3."\r\n";
$message .= "".$Message2."\r\n";
$message .= _text_report_line_message8."\r\n";
$message .= "".$Message3."";
//$message .= WEB_URL."/index.php";
//$queryData = http_build_query($message);
$queryData = http_build_query(
   array(
        'message' => $message,
        'link' => 'doh'
    )
);
$sUrl = "https://notify-api.line.me/api/notify";
     $headerOptions = array(
         'http'=>array(
             'method'=>'POST',
             'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                 ."Authorization: Bearer ".$Token."\r\n"
                       ."Content-Length: ".strlen($queryData)."\r\n",
             'content' => $queryData
         ),
     );

$context = stream_context_create($headerOptions);
$fp = file_get_contents($sUrl,FALSE,$context);
//$fp = @fopen($sUrl, 'rb', false, $context);
@$result = file_get_contents($fp);
@$res = json_decode(@$result);
return @$res;
}


//ส่ง Line สุขสันต์วันเกิด
function Line_HBD_Class($Class,$group,$Message,$Age,$Token){
$Date=date('d-m-Y H:i:s');
$sticker_package_id = 3; // Package ID sticker
$sticker_id = 257; // ID sticker

//$Revert=$gr."x".$id;
$message = _text_hbd_line_message1." ".$Class." "._text_hbd_line_message9." ".$group."\r\n";
//$message .= _text_report_line_message2."".$Date." \r\n";
$message .= _text_hbd_line_message2."".DateThai($Date)."\r\n";
$message .= _text_hbd_line_message7."".$Age." "._text_hbd_line_message8."\r\n";
$message .= _text_hbd_line_message5."\r\n";
$message .= "".$Message."\r\n";
$message .= _text_hbd_line_message3."\r\n";
//$message .= WEB_URL."/index.php";
//$queryData = http_build_query($message);
$queryData = http_build_query(
   array(
        'message' => $message,
        'link' => 'doh',
		'stickerPackageId' => $sticker_package_id,
		'stickerId' => $sticker_id
    )
);
$sUrl = "https://notify-api.line.me/api/notify";
     $headerOptions = array(
         'http'=>array(
             'method'=>'POST',
             'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                 ."Authorization: Bearer ".$Token."\r\n"
                       ."Content-Length: ".strlen($queryData)."\r\n",
             'content' => $queryData
         ),
     );

$context = stream_context_create($headerOptions);
$fp = file_get_contents($sUrl,FALSE,$context);
//$fp = @fopen($sUrl, 'rb', false, $context);
@$result = file_get_contents($fp);
@$res = json_decode(@$result);
return @$res;
}

//ส่ง Line ในกลุ่มห้องเรียน
function Line_To_Class($Class,$group,$Message,$Token){
$Date=date('d-m-Y H:i:s');
//$Revert=$gr."x".$id;
$message = _text_report_line_message1." ".$Class." "._text_report_line_message5." ".$group."\r\n";
//$message .= _text_report_line_message2."".$Date." \r\n";
$message .= _text_report_line_message2."".DateTimeThai($Date)."\r\n";
$message .= _text_report_line_message7."\r\n";
$message .= "".$Message."\r\n";
$message .= _text_report_line_message4."\r\n";
$message .= WEB_URL."/index.php";
//$queryData = http_build_query($message);
$queryData = http_build_query(
   array(
        'message' => $message,
        'link' => 'doh'
    )
);
$sUrl = "https://notify-api.line.me/api/notify";
     $headerOptions = array(
         'http'=>array(
             'method'=>'POST',
             'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                 ."Authorization: Bearer ".$Token."\r\n"
                       ."Content-Length: ".strlen($queryData)."\r\n",
             'content' => $queryData
         ),
     );

$context = stream_context_create($headerOptions);
$fp = file_get_contents($sUrl,FALSE,$context);
//$fp = @fopen($sUrl, 'rb', false, $context);
@$result = file_get_contents($fp);
@$res = json_decode(@$result);
return @$res;
}

//ตรวจสอบว่าเป็น Admin จริงหรือไม่จริง
function CheckAdmin($user = "", $pwd ="" , $gr =""  ){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	@$res['userx'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='$user' AND password='$pwd' ");
	@$arr['userx'] = @$db->rows(@$res['userx']);
	if(!@$arr['userx']){
//		echo "<script language='javascript'>" ;
//		echo "alert('"._ADMIN_SIT."')" ;
//		echo ""._ADMIN_SIT."" ;
////		echo "</script>" ;
session_unset();
//session_destroy();
setcookie("admin_login");
setcookie("admin_group");
setcookie("admin_pwd");
setcookie("admin_school");
setcookie("admin_area");
setcookie("school_name");
setcookie("strFacebookID");
setcookie("facebook_access_token");
//google AIP
if(!empty($_SESSION['access_token'])){
require_once "../includes/GoogleAPI/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId(""._GOOGLE_Api_ID."");
$gClient->setClientSecret(""._GOOGLE_Api_Secret."");
unset($_SESSION['access_token']);
$gClient->revokeToken();
}
		echo "<meta http-equiv='refresh' content='1; url=../index.php'>";
//		exit();
	}
}

function CheckAdminGroup($user = "", $pwd ="" , $gr ="" ){
	global $db ;
	if($gr==1){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	@$res['users'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='$user' AND password='$pwd' and gr='".$gr."' ");
	@$arr['users'] = @$db->rows(@$res['users']);
	$rowX=1;
	} else {
	$rowX=0;
	}
	if($rowX==0){
//		echo "<script language='javascript'>" ;
//		echo "alert('"._ADMIN_SIT."')" ;
//		echo ""._ADMIN_SIT."" ;
////		echo "</script>" ;
session_unset();
//session_destroy();
setcookie("admin_login");
setcookie("admin_group");
setcookie("admin_pwd");
setcookie("admin_school");
setcookie("admin_area");
setcookie("school_name");
setcookie("strFacebookID");
setcookie("facebook_access_token");
//google AIP
if(!empty($_SESSION['access_token'])){
require_once "../includes/GoogleAPI/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId(""._GOOGLE_Api_ID."");
$gClient->setClientSecret(""._GOOGLE_Api_Secret."");
//$gClient->setApplicationName("SESA Login");
//$gClient->setRedirectUri("https://sesa.obec.go.th/signin/google-login_admin.php");
//$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
//$loginURL = $gClient->createAuthUrl();

unset($_SESSION['access_token']);
$gClient->revokeToken();
}
		echo "<meta http-equiv='refresh' content='1; url=../index.php'>";
//		exit();
	}
}


//ตรวจสอบว่าเป็น Admin จริงหรือไม่จริง
function CheckPerson($user = "", $pwd ="" , $gr =""  ){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	@$res['userx'] = $db->select_query("SELECT * FROM ".TB_PERSON." WHERE per_ids='$user' AND per_pin='$pwd' ");
	@$arr['userx'] = @$db->rows(@$res['userx']);
	if(!@$arr['userx']){
//		echo "<script language='javascript'>" ;
//		echo "alert('"._ADMIN_SIT."')" ;
//		echo ""._ADMIN_SIT."" ;
////		echo "</script>" ;
session_unset();
//session_destroy();
setcookie("person_login");
setcookie("person_group");
setcookie("person_pwd");
setcookie("person_school");
setcookie("person_area");
setcookie("person_name");
setcookie("strFacebookID");
setcookie("facebook_access_token");
//google AIP
if(!empty($_SESSION['access_token'])){
require_once "../includes/GoogleAPI/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId(""._GOOGLE_Api_ID."");
$gClient->setClientSecret(""._GOOGLE_Api_Secret."");
unset($_SESSION['access_token']);
$gClient->revokeToken();
}
		echo "<meta http-equiv='refresh' content='1; url=../index.php'>";
//		exit();
	}
}

function index_bad(){
global $db;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$bar=array("aqua","red","green","yellow");

@$result = $db->select_query("SELECT *,count(bad_id) as COO FROM ".TB_BAD.",".TB_STUDENT." where bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and stu_id=bad_stu and stu_suspend='0' group by bad_tail order by COO desc limit 4"); 
$i=0;

while(@$arr = $db->fetch(@$result)){

@$result3= $db->select_query("SELECT count(bad_id) as CO3 FROM ".TB_BAD.",".TB_STUDENT."  where bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and stu_id=bad_stu and stu_suspend='0' and month(b_date) = DATE_FORMAT(NOW() ,'%m') and bad_tail='".@$arr['bad_tail']."' group by bad_id "); 
@$rows3 = @$db->rows(@$result3);

@$result1 = $db->select_query("SELECT count(bad_id) as CI FROM ".TB_BAD.",".TB_STUDENT."  where bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and stu_id=bad_stu and stu_suspend='0' and month(b_date) = DATE_FORMAT(NOW() - INTERVAL 1 MONTH,'%m') and bad_tail='".@$arr['bad_tail']."' group by bad_id");
@$rows=@$db->rows(@$result1);

	@$result2 = $db->select_query("SELECT * FROM ".TB_BADTAIL." where badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' and badtail_id='".@$arr['bad_tail']."' ");
	@$arr2 = $db->fetch(@$result2);

//$data=(int)(@$arr['COO']);
	if($i !=3){ $bb="border-right";} else {$bb='';}


	if(@$rows>@$rows3){
	$caret="fa-caret-up";
	$color="text-green";
	if((int)@$rows3==0){
	$RowX=(int)@$rows;
	} else {
	$RowX=(int)@$rows3-(int)@$rows;
	}
	$PerC=(100*(int)$RowX)/(int)@$rows;
	$PerCC=number_format(($PerC),2);
	$Num="(".(int)@$rows."/".(int)@$rows3.")";
	} else if(@$rows==@$rows3){
	$caret="fa-caret-left";
	$color="text-warning";
	$PerCC='0.00';
	$Num="ไม่เปลี่ยนแปลง";
	} else if(@$rows<@$rows3){
	$caret="fa-caret-down";
	$color="text-danger";
	if(@$rows==''){ 
	$Row=0;
	@$RowX=(int)@$rows3-(int)@$rows;
	@$PerC=(100*$RowX)/(int)$Row;
	@$PerCC=number_format((@$rows3),2);
	} else { 
	$Row=@$rows;
	@$RowX=(int)@$rows3-(int)@$rows;
	@$PerC=(100*(int)$RowX)/(int)$Row;
	@$PerCC=number_format(($PerC),2);
	}
	$Num="(".(int)$Row."/".(int)@$rows3.")";
	}
@$Percent=number_format($PerCC,2);
	$PPi ="<div class=\"col-sm-3 col-xs-6\">
                  <div class=\"description-block ".$bb."\">
                    <span class=\"description-percentage ".$color."\"><i class=\"fa ".$caret."\"></i> ".$PerCC."%</span>";
	$PPi .="<h5 class=\"description-header\">".$Num."</h5>
                    <span class=\"description-text\">".@$arr2['badtail_name']."</span>
                  </div>
                </div>";
	echo $PPi;
$i++;
}

//return $PPi;

}

function index_good(){
global $db;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$bar=array("aqua","red","green","yellow");

@$result = $db->select_query("SELECT *,count(good_id) as COO FROM ".TB_GOOD.",".TB_STUDENT."  where good_area='".$_SESSION['admin_area']."' and good_code='".$_SESSION['admin_school']."' and stu_id=good_stu and stu_suspend='0' group by good_tail order by COO desc limit 4"); 
$i=0;

while(@$arr = $db->fetch(@$result)){

@$result3= $db->select_query("SELECT count(good_id) as CO3 FROM ".TB_GOOD.",".TB_STUDENT."  where  good_area='".$_SESSION['admin_area']."' and good_code='".$_SESSION['admin_school']."' and stu_id=good_stu and stu_suspend='0' and month(g_date) = DATE_FORMAT(NOW() ,'%m') and good_tail='".@$arr['good_tail']."' group by good_id "); 
@$rows3 = @$db->rows(@$result3);

@$result1 = $db->select_query("SELECT count(good_id) as CI FROM ".TB_GOOD.",".TB_STUDENT."  where  good_area='".$_SESSION['admin_area']."' and good_code='".$_SESSION['admin_school']."' and stu_id=good_stu and stu_suspend='0' and month(g_date) = DATE_FORMAT(NOW() - INTERVAL 1 MONTH,'%m') and good_tail='".@$arr['good_tail']."' group by good_id");
@$rows=@$db->rows(@$result1);

	@$result2 = $db->select_query("SELECT * FROM ".TB_GOODTAIL." where goodtail_area='".$_SESSION['admin_area']."' and goodtail_code='".$_SESSION['admin_school']."' and goodtail_id='".@$arr['good_tail']."' ");
	@$arr2 = $db->fetch(@$result2);
	//$data=(int)(@$arr['COO']);
	if($i !=3){ $bb="border-right";} else {$bb='';}

	if(@$rows>@$rows3){
	$caret="fa-caret-down";
	$color="text-danger";
	if((int)@$rows3==0){
	$RowX=(int)@$rows;
	} else {
	$RowX=(int)@$rows3-(int)@$rows;
	}
	$PerC=(100*(int)$RowX)/(int)@$rows;
	$PerCC=number_format(($PerC),2);
	$Num="(".(int)@$rows."/".(int)@$rows3.")";
	} else if(@$rows==@$rows3){
	$caret="fa-caret-left";
	$color="text-warning";
	$PerCC='0.00';
	$Num="ไม่เปลี่ยนแปลง";
	} else if(@$rows<@$rows3){
	$caret="fa-caret-up";
	$color="text-green";
	if(@$rows==''){ 
	$Row=0;
	$RowX=(int)@$rows3-(int)@$rows;
	//$PerC=(100*$RowX)/$Row;
	$PerCC=number_format((@$rows3),2);
	} else { 
	$Row=@$rows;
	$RowX=(int)@$rows3-(int)@$rows;
	$PerC=(100*(int)$RowX)/(int)$Row;
	$PerCC=number_format(($PerC),2);
	}
	$Num="(".(int)$Row."/".(int)@$rows3.")";
	}
	$PPix="<div class=\"col-sm-3 col-xs-6\">
                  <div class=\"description-block ".$bb."\">
                    <span class=\"description-percentage ".$color."\"><i class=\"fa ".$caret."\"></i> ".$PerCC."%</span>
                    <h5 class=\"description-header\">".$Num."</h5>
                    <span class=\"description-text\">".@$arr2['goodtail_name']."</span>
                  </div>
                </div>";
			echo $PPix;
$i++;
}

//return $PPx;

}


function index_bad_person(){
global $db;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$bar=array("aqua","red","green","yellow");

@$result = $db->select_query("SELECT *,count(bad_id) as COO FROM ".TB_BAD.",".TB_STUDENT." where bad_area='".$_SESSION['person_area']."' and bad_code='".$_SESSION['person_school']."' and stu_id=bad_stu and stu_suspend='0' group by bad_tail order by COO desc limit 4"); 
$i=0;

while(@$arr = $db->fetch(@$result)){

@$result3= $db->select_query("SELECT count(bad_id) as CO3 FROM ".TB_BAD.",".TB_STUDENT."  where bad_area='".$_SESSION['person_area']."' and bad_code='".$_SESSION['person_school']."' and stu_id=bad_stu and stu_suspend='0' and month(b_date) = DATE_FORMAT(NOW() ,'%m') and bad_tail='".@$arr['bad_tail']."' group by bad_id "); 
@$rows3 = @$db->rows(@$result3);

@$result1 = $db->select_query("SELECT count(bad_id) as CI FROM ".TB_BAD.",".TB_STUDENT."  where bad_area='".$_SESSION['person_area']."' and bad_code='".$_SESSION['person_school']."' and stu_id=bad_stu and stu_suspend='0' and month(b_date) = DATE_FORMAT(NOW() - INTERVAL 1 MONTH,'%m') and bad_tail='".@$arr['bad_tail']."' group by bad_id");
@$rows=@$db->rows(@$result1);

	@$result2 = $db->select_query("SELECT * FROM ".TB_BADTAIL." where badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."' and badtail_id='".@$arr['bad_tail']."' ");
	@$arr2 = $db->fetch(@$result2);

//$data=(int)(@$arr['COO']);
	if($i !=3){ $bb="border-right";} else {$bb='';}


	if(@$rows>@$rows3){
	$caret="fa-caret-up";
	$color="text-green";
	if((int)@$rows3==0){
	$RowX=(int)@$rows;
	} else {
	$RowX=(int)@$rows3-(int)@$rows;
	}
	$PerC=(100*(int)$RowX)/(int)@$rows;
	$PerCC=number_format(($PerC),2);
	$Num="(".(int)@$rows."/".(int)@$rows3.")";
	} else if(@$rows==@$rows3){
	$caret="fa-caret-left";
	$color="text-warning";
	$PerCC='0.00';
	$Num="ไม่เปลี่ยนแปลง";
	} else if(@$rows<@$rows3){
	$caret="fa-caret-down";
	$color="text-danger";
	if(@$rows==''){ 
	$Row=0;
	@$RowX=(int)@$rows3-(int)@$rows;
	@$PerC=(100*$RowX)/(int)$Row;
	@$PerCC=number_format((@$rows3),2);
	} else { 
	$Row=@$rows;
	@$RowX=(int)@$rows3-(int)@$rows;
	@$PerC=(100*(int)$RowX)/(int)$Row;
	@$PerCC=number_format(($PerC),2);
	}
	$Num="(".(int)$Row."/".(int)@$rows3.")";
	}
@$Percent=number_format($PerCC,2);
	$PPi ="<div class=\"col-sm-3 col-xs-6\">
                  <div class=\"description-block ".$bb."\">
                    <span class=\"description-percentage ".$color."\"><i class=\"fa ".$caret."\"></i> ".$PerCC."%</span>";
	$PPi .="<h5 class=\"description-header\">".$Num."</h5>
                    <span class=\"description-text\">".@$arr2['badtail_name']."</span>
                  </div>
                </div>";
	echo $PPi;
$i++;
}

//return $PPi;

}

function index_good_person(){
global $db;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$bar=array("aqua","red","green","yellow");

@$result = $db->select_query("SELECT *,count(good_id) as COO FROM ".TB_GOOD.",".TB_STUDENT."  where good_area='".$_SESSION['person_area']."' and good_code='".$_SESSION['person_school']."' and stu_id=good_stu and stu_suspend='0' group by good_tail order by COO desc limit 4"); 
$i=0;

while(@$arr = $db->fetch(@$result)){

@$result3= $db->select_query("SELECT count(good_id) as CO3 FROM ".TB_GOOD.",".TB_STUDENT."  where  good_area='".$_SESSION['person_area']."' and good_code='".$_SESSION['person_school']."' and stu_id=good_stu and stu_suspend='0' and month(g_date) = DATE_FORMAT(NOW() ,'%m') and good_tail='".@$arr['good_tail']."' group by good_id "); 
@$rows3 = @$db->rows(@$result3);

@$result1 = $db->select_query("SELECT count(good_id) as CI FROM ".TB_GOOD.",".TB_STUDENT."  where  good_area='".$_SESSION['person_area']."' and good_code='".$_SESSION['person_school']."' and stu_id=good_stu and stu_suspend='0' and month(g_date) = DATE_FORMAT(NOW() - INTERVAL 1 MONTH,'%m') and good_tail='".@$arr['good_tail']."' group by good_id");
@$rows=@$db->rows(@$result1);

	@$result2 = $db->select_query("SELECT * FROM ".TB_GOODTAIL." where goodtail_area='".$_SESSION['person_area']."' and goodtail_code='".$_SESSION['person_school']."' and goodtail_id='".@$arr['good_tail']."' ");
	@$arr2 = $db->fetch(@$result2);
	//$data=(int)(@$arr['COO']);
	if($i !=3){ $bb="border-right";} else {$bb='';}

	if(@$rows>@$rows3){
	$caret="fa-caret-down";
	$color="text-danger";
	if((int)@$rows3==0){
	$RowX=(int)@$rows;
	} else {
	$RowX=(int)@$rows3-(int)@$rows;
	}
	$PerC=(100*(int)$RowX)/(int)@$rows;
	$PerCC=number_format(($PerC),2);
	$Num="(".(int)@$rows."/".(int)@$rows3.")";
	} else if(@$rows==@$rows3){
	$caret="fa-caret-left";
	$color="text-warning";
	$PerCC='0.00';
	$Num="ไม่เปลี่ยนแปลง";
	} else if(@$rows<@$rows3){
	$caret="fa-caret-up";
	$color="text-green";
	if(@$rows==''){ 
	$Row=0;
	$RowX=(int)@$rows3-(int)@$rows;
	//$PerC=(100*$RowX)/$Row;
	$PerCC=number_format((@$rows3),2);
	} else { 
	$Row=@$rows;
	$RowX=(int)@$rows3-(int)@$rows;
	$PerC=(100*(int)$RowX)/(int)$Row;
	$PerCC=number_format(($PerC),2);
	}
	$Num="(".(int)$Row."/".(int)@$rows3.")";
	}
	$PPix="<div class=\"col-sm-3 col-xs-6\">
                  <div class=\"description-block ".$bb."\">
                    <span class=\"description-percentage ".$color."\"><i class=\"fa ".$caret."\"></i> ".$PerCC."%</span>
                    <h5 class=\"description-header\">".$Num."</h5>
                    <span class=\"description-text\">".@$arr2['goodtail_name']."</span>
                  </div>
                </div>";
			echo $PPix;
$i++;
}

//return $PPx;

}

function getInfo($ips){
//        $url = get_content("http://api.easyjquery.com/ips/?ip=".$ips."&full=true");
//        $url = get_content("http://smart-ip.net/geoip-json/".$ips."");
//		$url = get_content("http://freegeoip.net/json/".$ips."");
//		$url = get_content("http://api.ipinfodb.com/v3/ip-city/?key=9730aa0c8b5c67b560947f664bf9c4f5128a3b81b0ff6f3f0f16dca1bea46fcb&ip=".$ips."&format=json");
		$url = get_content("http://ip-api.com/json/".$ips."");
        $xml = json_decode($url,true);
        $info["ip"] = $xml['query'];
        $info["region"] = $xml['regionName'];
        $info["city"] = $xml['city'];
        $info["lat"] = $xml['lat'];
        $info["long"] = $xml['lon'];
        $info['country'] = $xml['country'];
		$info['localTimeZone'] = $xml['timezone'];
//        $info['localTime'] = $xml->localTime;

//        $info["ip"] = $xml['IP'];
//        $info["region"] = $xml['RegionName'];
//        $info["city"] = $xml['CityName'];
//        $info["lat"] = $xml['CityLatitude'];
//        $info["long"] = $xml['CityLongitude'];
//        $info['country'] = $xml['CountryName'];
//		$info['localTimeZone'] = $xml['LocalTimeZone'];
//        $info['localTime'] = $xml->localTime;

//        $info["ip"] = $xml['host'];
//        $info["region"] = $xml['region'];
//        $info["city"] = $xml['city'];
//        $info["lat"] = $xml['latitude'];
//        $info["long"] = $xml['longitude'];
//        $info['country'] = $xml['countryName'];
//		$info['localTimeZone'] = $xml['timezone'];
//        $info['localTime'] = $xml->localTime;

//		$url = get_content("http://freegeoip.net/json/".$ips."");
//        $info["ip"] = $xml['ip'];
//        $info["region"] = $xml['region_name'];
//        $info["city"] = $xml['city'];
//        $info["lat"] = $xml['latitude'];
//        $info["long"] = $xml['longitude'];
//        $info['country'] = $xml['country_name'];
//		$info['localTimeZone'] = $xml['timezone'];
/*
        $info["ip"] = $xml['ipAddress'];
        $info["region"] = $xml['regionName'];
        $info["city"] = $xml['cityName'];
        $info["lat"] = $xml['latitude'];
        $info["long"] = $xml['longitude'];
        $info['country'] = $xml['countryName'];
		$info['localTimeZone'] = $xml['timeZone'];
*/
        return $info;
    }


function getBrowserType () {
if (!empty($_SERVER['HTTP_USER_AGENT'])) 
{ 
   $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT']; 
} 
else if (!empty($HTTP_SERVER_VARS['HTTP_USER_AGENT'])) 
{ 
   $HTTP_USER_AGENT = $HTTP_SERVER_VARS['HTTP_USER_AGENT']; 
} 
else if (!isset($HTTP_USER_AGENT)) 
{ 
   $HTTP_USER_AGENT = ''; 
} 
  // Create list of browsers with browser name as array key and user agent as value. 
	$browsers = array(
		'Opera' => 'Opera',
		'Mozilla Firefox'=> '(Firebird)|(Firefox)', // Use regular expressions as value to identify browser
		'Galeon' => 'Galeon',
		'Mozilla'=>'Gecko',
		'MyIE'=>'MyIE',
		'Lynx' => 'Lynx',
		'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
		'Konqueror'=>'Konqueror',
		'SearchBot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)',
		'Internet Explorer 8' => '(MSIE 8\.[0-9]+)',
        'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',
		'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
		'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
		'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',
	);

	foreach($browsers as $browser=>$pattern) { // Loop through $browsers array
    // Use regular expressions to check browser type
		if(preg_match("/".$pattern."/", $HTTP_USER_AGENT)) { // Check if a value in $browsers array matches current user agent.
			return $browser; // Browser was matched so return $browsers key
		}
	}
	return 'Unknown'; // Cannot find browser so return Unknown
}

function selfURL() { 
$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 
}
function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); 
}

//countblock
function CountBlock($pblock=""){
	global $db ;
	//Check Level
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	@$res['Countsx'] = $db->select_query("SELECT *,count(pblock) as num FROM ".TB_BLOCK." WHERE status='1' and pblock='$pblock' group by pblock");
	@$arr['Countsx'] = $db->fetch(@$res['Countsx']);
if(@$arr['Countsx']['num']){
return True;
} else {
echo "";
}
}

function get_content($URL) {
         $ch = curl_init();
         $timeout = 0; // set to zero for no timeout
         $useragent="Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
         curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
         curl_setopt ($ch, CURLOPT_URL, $URL);
         curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
          $String = curl_exec($ch);
          curl_close($ch);
           return $String;
 }


function mosMakePassword($length) {
	$salt = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789";
	$len = strlen($salt);
	$makepass="";
	mt_srand(10000000*(double)microtime());
	for ($i = 0; $i < $length; $i++)
	$makepass .= $salt[mt_rand(0,$len - 1)];
	return $makepass;
}

function resetpassword($email,$name,$user,$password) {
global $email,$name,$user,$password;
$admin_mail="".WEB_EMAIL."";
$home="".WEB_URL."";
$Headers = "MIME-Version: 1.0\r\n" ;
$Headers .= "Content-type: text/html; charset=".ISO."\r\n" ;
                          // ส่งข้อความเป็นภาษาไทย ใช้ "windows-874"
$Headers .= "From: ".WEB_EMAIL." <".WEB_EMAIL.">\r\n" ;
$Headers .= "Reply-to: ".WEB_EMAIL." <".WEB_EMAIL.">\r\n" ;
$Headers .= "X-Priority: 3\r\n" ;
$Headers .= "X-Mailer: PHP mailer\r\n" ;

$subject_mail = ""._RESET_MAIL_SUB."" ; // หัวข้ออีเมล์ 

//----------------------------------------------------------------------- เนื้อหาของอีเมล์ //
$message_mail = ""._RESET_MAIL_BODY."" ;
$message_mail .= ""._RESET_MAIL_BODY1." $name" ;
$message_mail .= ""._RESET_MAIL_BODY2." $user" ;
$message_mail .= ""._RESET_MAIL_BODY3." $password" ;
$message_mail .= ""._RESET_MAIL_BODY4." $home" ;
$message_mail .= ""._RESET_MAIL_BODY5."" ;

//------------------------------------------------------------------------ จบเนื้อหาของอีเมล์ //
$from = "".WEB_EMAIL."" ;
if(@mail($email,$subject_mail,$message_mail,$Headers,$from))
{
echo "<br><br><center><font size='3' face='MS Sans Serif'><b>" ;
echo "<center><font size=\"3\" face='MS Sans Serif'><b>"._RESET_MAIL_SEND1." $email "._RESET_MAIL_SEND2."</b></font></center>" ;
echo ""._RESET_MAIL_SEND_WAIT."</b></font></center>" ;
}else{
echo ""._RESET_MAIL_SEND_NO."";
}
}

function getTotalMassagesNew($Mod,$File,$user){
global $db;

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['mss'] = $db->select_query("SELECT * FROM ".WEB_MESSAGE." as a , ".WEB_MESSAGE_CHECK." as b WHERE  a.ms_to in ('all' ,'".$user."') or a.ms_posted='".$user."' and a.ms_area='".$_SESSION['admin_area']."' and a.ms_school='".$_SESSION['admin_school']."' and b.msc_mss =a.ms_id "); 
@$rows['mss'] = @$db->rows(@$res['mss']);
if(@$rows['mss']){
return @$rows['mss'];
} else {
return '0';
}

}

//ตรวจสอบว่ามีโมดูลหรือไม่ (โมดูล User)
function getTotal($Mod,$File,$user=""){
global $db;

if($Mod=='message' and $File=='index'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['mss'] = $db->select_query("SELECT * FROM ".TB_MESSAGE." WHERE ms_to in ('all' ,'".$user."') or ms_posted='".$user."' "); 
@$rows['mss'] = @$db->rows(@$res['mss']);
if(@$rows['mss']){
return @$rows['mss'];
} else {
return '0';
}
}

if($Mod=='user' and $File=='index'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." WHERE username='".$user."' "); 
@$rows['user'] = @$db->rows(@$res['user']);
if(@$rows['user']){
return @$rows['user'];
} else {
return '0';
}
}

if($Mod=='onlineuser'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['online'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." WHERE ct_user='".$user."'  "); 
@$rows['online'] = @$db->rows(@$res['online']); 
if(@$rows['online']){
return @$rows['online'];
} else {
return '0';
}
}

if($Mod=='online'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['online'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." WHERE ct_school='".$School."'  "); 
@$rows['online'] = @$db->rows(@$res['online']); 
if(@$rows['online']){
return @$rows['online'];
} else {
return '0';
}
}



}


//ตรวจสอบว่ามีโมดูลหรือไม่ (noUser)
function getTotalnouser($Mod,$File,$user=""){
global $db;

if($Mod=='message' and $File=='index'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['mss'] = $db->select_query("SELECT * FROM ".TB_MESSAGE." "); 
@$rows['mss'] = @$db->rows(@$res['mss']);
if(@$rows['mss']){
return @$rows['mss'];
} else {
return '0';
}
}

if($Mod=='menu' and $File=='index'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['menu'] = $db->select_query("SELECT * FROM ".TB_ADMIN_MENU." "); 
@$rows['menu'] = @$db->rows(@$res['menu']);
if(@$rows['menu']){
return @$rows['menu'];
} else {
return '0';
}
}

if($Mod=='menu' and $File=='men'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['men'] = $db->select_query("SELECT * FROM ".TB_USER_MENU." "); 
@$rows['men'] = @$db->rows(@$res['men']);
if(@$rows['men']){
return @$rows['men'];
} else {
return '0';
}
}

if($Mod=='admin' and $File=='index'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." "); 
@$rows['admin'] = @$db->rows(@$res['admin']);
if(@$rows['admin']){
return @$rows['admin'];
} else {
return '0';
}
}

if($Mod=='admin' and $File=='group'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['group'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." "); 
@$rows['group'] = @$db->rows(@$res['group']);
if(@$rows['group']){
return @$rows['group'];
} else {
return '0';
}
}

if($Mod=='user' and $File=='index'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." "); 
@$rows['user'] = @$db->rows(@$res['user']);
if(@$rows['user']){
return @$rows['user'];
} else {
return '0';
}
}

if($Mod=='user' and $File=='group'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['ugroup'] = $db->select_query("SELECT * FROM ".TB_USER_GROUP." "); 
@$rows['ugroup'] = @$db->rows(@$res['ugroup']);
if(@$rows['ugroup']){
return @$rows['ugroup'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='index'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['config'] = $db->select_query("SELECT * FROM ".TB_CONFIG." "); 
@$rows['config'] = @$db->rows(@$res['config']);
if(@$rows['config']){
return @$rows['config'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='template'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['tem'] = $db->select_query("SELECT * FROM ".TB_TEMPLATE." "); 
@$rows['tem'] = @$db->rows(@$res['tem']);
if(@$rows['tem']){
return @$rows['tem'];
} else {
return '0';
}
}

if($Mod=='aboutus' and $File=='index'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['aboutus'] = $db->select_query("SELECT * FROM ".TB_ABOUTUS." "); 
@$rows['aboutus'] = @$db->rows(@$res['aboutus']);
if(@$rows['aboutus']){
return @$rows['aboutus'];
} else {
return '0';
}
}

if($Mod=='onlineuser'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['online'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." "); 
@$rows['online'] = @$db->rows(@$res['online']); 
if(@$rows['online']){
return @$rows['online'];
} else {
return '0';
}
}

if($Mod=='online'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['online'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." "); 
@$rows['online'] = @$db->rows(@$res['online']); 
if(@$rows['online']){
return @$rows['online'];
} else {
return '0';
}
}



}



//ตรวจสอบว่ามีโมดูลหรือไม่ (โมดูลADmin)
function getTotalAdmin($Mod,$File,$user){
global $db;

if($Mod=='score' and $File=='good'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$resultG = $db->select_query("select *,sum(goodtail_point) as GO  from ".TB_GOOD." ,".TB_GOODTAIL.",".TB_STUDENT." where  good_tail=goodtail_id and good_area='".$_SESSION['admin_area']."' and good_code='".$_SESSION['admin_school']."' and stu_id=good_stu and stu_suspend='0' group by good_year"); 
@$rowsG = $db->fetch(@$resultG);
if(@$rowsG){
return @$rowsG['GO'];
} else {
return '0';
}
}

if($Mod=='score' and $File=='bad'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$resultB = $db->select_query("SELECT *,sum(badtail_point) AS CO FROM ".TB_BAD."  ,".TB_BADTAIL." ,".TB_STUDENT." where  bad_tail=badtail_id  and bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' and stu_id=bad_stu and stu_suspend='0' group by bad_year"); 
@$rowsB = $db->fetch(@$resultB);
if(@$rowsB){
return @$rowsB['CO'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='person'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['person'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['admin_area']."' and per_code='".$_SESSION['admin_school']."' "); 
@$rows['person'] = @$db->rows(@$res['person']);
if(@$rows['person']){
return @$rows['person'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='admin'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." where area_code ='".$_SESSION['admin_area']."' and school_code='".$_SESSION['admin_school']."' "); 
@$rows['admin'] = @$db->rows(@$res['admin']);
if(@$rows['admin']){
return @$rows['admin'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='user'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." where area='".$_SESSION['admin_area']."' and code='".$_SESSION['admin_school']."'  "); 
@$rows['user'] = @$db->rows(@$res['user']);
if(@$rows['user']){
return @$rows['user'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='student'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' "); 
@$rows['stu'] = @$db->rows(@$res['stu']);
if(@$rows['stu']){
return @$rows['stu'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='class'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." where clg_area='".$_SESSION['admin_area']."' and clg_school='".$_SESSION['admin_school']."' "); 
@$rows['class'] = @$db->rows(@$res['class']);
if(@$rows['class']){
return @$rows['class'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='good'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['good'] = $db->select_query("SELECT * FROM ".TB_GOOD." where good_area='".$_SESSION['admin_area']."' and good_code='".$_SESSION['admin_school']."' "); 
@$rows['good'] = @$db->rows(@$res['good']);
if(@$rows['good']){
return @$rows['good'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='goodtail'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['goodT'] = $db->select_query("SELECT * FROM ".TB_GOODTAIL." where goodtail_area='".$_SESSION['admin_area']."' and goodtail_code='".$_SESSION['admin_school']."' "); 
@$rows['goodT'] = @$db->rows(@$res['goodT']);
if(@$rows['goodT']){
return @$rows['goodT'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='bad'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['bad'] = $db->select_query("SELECT * FROM ".TB_BAD." where bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' "); 
@$rows['bad'] = @$db->rows(@$res['bad']);
if(@$rows['bad']){
return @$rows['bad'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='badtail'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['badT'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." where badtail_area='".$_SESSION['admin_area']."' and badtail_code='".$_SESSION['admin_school']."' "); 
@$rows['badT'] = @$db->rows(@$res['badT']);
if(@$rows['badT']){
return @$rows['badT'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='best'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['best'] = $db->select_query("SELECT * FROM ".TB_BESTTAIL."  where btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."' "); 
@$rows['best'] = @$db->rows(@$res['best']);
if(@$rows['best']){
return @$rows['best'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='spacial'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['spacial'] = $db->select_query("SELECT * FROM ".TB_SPACIALTAIL." where stail_area='".$_SESSION['admin_area']."' and stail_code='".$_SESSION['admin_school']."' "); 
@$rows['spacial'] = @$db->rows(@$res['spacial']);
if(@$rows['spacial']){
return @$rows['spacial'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='motor'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['motor'] = $db->select_query("SELECT * FROM ".TB_MOTORTAIL." where mot_area='".$_SESSION['admin_area']."' and mot_code='".$_SESSION['admin_school']."' "); 
@$rows['motor'] = @$db->rows(@$res['motor']);
if(@$rows['motor']){
return @$rows['motor'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='put'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['put'] = $db->select_query("SELECT * FROM ".TB_PUTTAIL." where pt_area='".$_SESSION['admin_area']."' and pt_code='".$_SESSION['admin_school']."' "); 
@$rows['put'] = @$db->rows(@$res['put']);
if(@$rows['put']){
return @$rows['put'];
} else {
return '0';
}
}


if($Mod=='config' and $File=='council'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['council'] = $db->select_query("SELECT * FROM ".TB_COUNTAIL." where cot_area='".$_SESSION['admin_area']."' and cot_code='".$_SESSION['admin_school']."' "); 
@$rows['council'] = @$db->rows(@$res['council']);
if(@$rows['council']){
return @$rows['council'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='whiteclass'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['whiteclass'] = $db->select_query("SELECT * FROM ".TB_WHITECLTAIL." where whcl_area='".$_SESSION['admin_area']."' and whcl_code='".$_SESSION['admin_school']."' "); 
@$rows['whiteclass'] = @$db->rows(@$res['whiteclass']);
if(@$rows['whiteclass']){
return @$rows['whiteclass'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='affairs'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['affairs'] = $db->select_query("SELECT * FROM ".TB_AFFTAIL." where  afft_area='".$_SESSION['admin_area']."' and afft_code='".$_SESSION['admin_school']."' "); 
@$rows['affairs'] = @$db->rows(@$res['affairs']);
if(@$rows['affairs']){
return @$rows['affairs'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='ent'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['ent'] = $db->select_query("SELECT * FROM ".TB_ENTTAIL." where got_area='".$_SESSION['admin_area']."' and got_code='".$_SESSION['admin_school']."' "); 
@$rows['ent'] = @$db->rows(@$res['ent']);
if(@$rows['ent']){
return @$rows['ent'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='exit'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['ext'] = $db->select_query("SELECT * FROM ".TB_EXITTAIL." where ext_area='".$_SESSION['admin_area']."' and ext_code='".$_SESSION['admin_school']."'  "); 
@$rows['ext'] = @$db->rows(@$res['ext']);
if(@$rows['ext']){
return @$rows['ext'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='rubrong'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['rub'] = $db->select_query("SELECT * FROM ".TB_RUBRONG." where rub_area='".$_SESSION['admin_area']."' and rub_code='".$_SESSION['admin_school']."' "); 
@$rows['rub'] = @$db->rows(@$res['rub']);
if(@$rows['rub']){
return @$rows['rub'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='student'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['admin_area']."' and stu_code='".$_SESSION['admin_school']."' "); 
@$rows['stu'] = @$db->rows(@$res['stu']);
if(@$rows['stu']){
return @$rows['stu'];
} else {
return '0';
}
}


if($Mod=='import' and $File=='bad'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['bad'] = $db->select_query("SELECT * FROM ".TB_BAD." where bad_area='".$_SESSION['admin_area']."' and bad_code='".$_SESSION['admin_school']."' "); 
@$rows['bad'] = @$db->rows(@$res['bad']);
if(@$rows['bad']){
return @$rows['bad'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='good'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['good'] = $db->select_query("SELECT * FROM ".TB_GOOD." where good_area='".$_SESSION['admin_area']."' and good_code='".$_SESSION['admin_school']."' "); 
@$rows['good'] = @$db->rows(@$res['good']);
if(@$rows['good']){
return @$rows['good'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='best'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['btail'] = $db->select_query("SELECT * FROM ".TB_BESTTAIL." where btail_area='".$_SESSION['admin_area']."' and btail_code='".$_SESSION['admin_school']."' "); 
@$rows['btail'] = @$db->rows(@$res['btail']);
if(@$rows['btail']){
return @$rows['btail'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='spacial'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['spacialx'] = $db->select_query("SELECT * FROM ".TB_SPACIALTAIL." where stail_area='".$_SESSION['admin_area']."' and stail_code='".$_SESSION['admin_school']."' "); 
@$rows['spacialx'] = @$db->rows(@$res['spacialx']);
if(@$rows['spacialx']){
return @$rows['spacialx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='motor'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['motorx'] = $db->select_query("SELECT * FROM ".TB_MOTORTAIL." where mot_area='".$_SESSION['admin_area']."' and mot_code='".$_SESSION['admin_school']."' "); 
@$rows['motorx'] = @$db->rows(@$res['motorx']);
if(@$rows['motorx']){
return @$rows['motorx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='put'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['putx'] = $db->select_query("SELECT * FROM ".TB_PUTTAIL." where pt_area='".$_SESSION['admin_area']."' and pt_code='".$_SESSION['admin_school']."' "); 
@$rows['putx'] = @$db->rows(@$res['putx']);
if(@$rows['putx']){
return @$rows['putx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='nut'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['nutx'] = $db->select_query("SELECT * FROM ".TB_NUT." where nut_area='".$_SESSION['admin_area']."' and nut_code='".$_SESSION['admin_school']."' "); 
@$rows['nutx'] = @$db->rows(@$res['nutx']);
if(@$rows['nutx']){
return @$rows['nutx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='tunbon'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['tunx'] = $db->select_query("SELECT * FROM ".TB_TUNBON." "); 
@$rows['tunx'] = @$db->rows(@$res['tunx']);
if(@$rows['tunx']){
return @$rows['tunx'];
} else {
return '0';
}
}


if($Mod=='import' and $File=='council'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['councilx'] = $db->select_query("SELECT * FROM ".TB_COUNTAIL." where cot_area='".$_SESSION['admin_area']."' and cot_code='".$_SESSION['admin_school']."' "); 
@$rows['councilx'] = @$db->rows(@$res['councilx']);
if(@$rows['councilx']){
return @$rows['councilx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='whiteclass'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['whiteclassx'] = $db->select_query("SELECT * FROM ".TB_WHITECLTAIL." where whcl_area='".$_SESSION['admin_area']."' and whcl_code='".$_SESSION['admin_school']."' "); 
@$rows['whiteclassx'] = @$db->rows(@$res['whiteclassx']);
if(@$rows['whiteclassx']){
return @$rows['whiteclassx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='affairs'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['affairsx'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." where aff_area='".$_SESSION['admin_area']."' and aff_code='".$_SESSION['admin_school']."' "); 
@$rows['affairsx'] = @$db->rows(@$res['affairsx']);
if(@$rows['affairsx']){
return @$rows['affairsx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='ent'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['entx'] = $db->select_query("SELECT * FROM ".TB_ENTTAIL." where got_area='".$_SESSION['admin_area']."' and got_code='".$_SESSION['admin_school']."' "); 
@$rows['entx'] = @$db->rows(@$res['entx']);
if(@$rows['entx']){
return @$rows['entx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='exit'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['extx'] = $db->select_query("SELECT * FROM ".TB_EXITTAIL." where ext_area='".$_SESSION['admin_area']."' and ext_code='".$_SESSION['admin_school']."' "); 
@$rows['extx'] = @$db->rows(@$res['extx']);
if(@$rows['extx']){
return @$rows['extx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='rubrong'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['rubx'] = $db->select_query("SELECT * FROM ".TB_RUBRONG." where rb_area='".$_SESSION['admin_area']."' and rb_code='".$_SESSION['admin_school']."' "); 
@$rows['rubx'] = @$db->rows(@$res['rubx']);
if(@$rows['rubx']){
return @$rows['rubx'];
} else {
return '0';
}
}


if($Mod=='access' and $File=='message'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['mss'] = $db->select_query("SELECT * FROM ".TB_MESSAGE." where ms_area='".$_SESSION['admin_area']."' and ms_school='".$_SESSION['admin_school']."'  "); 
@$rows['mss'] = @$db->rows(@$res['mss']);
if(@$rows['mss']){
return @$rows['mss'];
} else {
return '0';
}
}

if($Mod=='menu' and $File=='index'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['menu'] = $db->select_query("SELECT * FROM ".TB_ADMIN_MENU." "); 
@$rows['menu'] = @$db->rows(@$res['menu']);
if(@$rows['menu']){
return @$rows['menu'];
} else {
return '0';
}
}

if($Mod=='menu' and $File=='meu'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['men'] = $db->select_query("SELECT * FROM ".TB_USER_MENU." "); 
@$rows['men'] = @$db->rows(@$res['men']);
if(@$rows['men']){
return @$rows['men'];
} else {
return '0';
}
}

if($Mod=='admin' and $File=='index'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." where area_code ='".$_SESSION['admin_area']."' and school_code='".$_SESSION['admin_school']."' "); 
@$rows['admin'] = @$db->rows(@$res['admin']);
if(@$rows['admin']){
return @$rows['admin'];
} else {
return '0';
}
}

if($Mod=='admin' and $File=='group'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['group'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." "); 
@$rows['group'] = @$db->rows(@$res['group']);
if(@$rows['group']){
return @$rows['group'];
} else {
return '0';
}
}

if($Mod=='user' and $File=='index'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['user'] = $db->select_query("SELECT * FROM ".TB_USER." where area='".$_SESSION['admin_area']."' and code='".$_SESSION['admin_school']."' "); 
@$rows['user'] = @$db->rows(@$res['user']);
if(@$rows['user']){
return @$rows['user'];
} else {
return '0';
}
}

if($Mod=='user' and $File=='group'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['ugroup'] = $db->select_query("SELECT * FROM ".TB_USER_GROUP." "); 
@$rows['ugroup'] = @$db->rows(@$res['ugroup']);
if(@$rows['ugroup']){
return @$rows['ugroup'];
} else {
return '0';
}
}

if($Mod=='onlineuser'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['online'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." where ct_user='".$_SESSION['admin_login']."' "); 
@$rows['online'] = @$db->rows(@$res['online']); 
if(@$rows['online']){
return @$rows['online'];
} else {
return '0';
}
}

if($Mod=='online'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['online'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." "); 
@$rows['online'] = @$db->rows(@$res['online']); 
if(@$rows['online']){
return @$rows['online'];
} else {
return '0';
}
}

if($Mod=='onlineusers' ){
//$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['onlinex'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." where ct_user='".$user."' "); 
@$rows['onlinex'] = $db->rows(@$res['onlinex']); 
if(@$rows['onlinex']){
return @$rows['onlinex'];
} else {
return '0';
}
}


}


//ตรวจสอบว่ามีโมดูลหรือไม่ (โมดูลADmin)
function getTotalPerson($Mod,$File,$user){
global $db;

if($Mod=='score' and $File=='good'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$resultG = $db->select_query("select *,sum(goodtail_point) as GO  from ".TB_GOOD." ,".TB_GOODTAIL.",".TB_STUDENT." where  good_tail=goodtail_id and good_area='".$_SESSION['person_area']."' and good_code='".$_SESSION['person_school']."' and stu_id=good_stu and stu_suspend='0' group by good_year"); 
@$rowsG = $db->fetch(@$resultG);
if(@$rowsG){
return @$rowsG['GO'];
} else {
return '0';
}
}

if($Mod=='score' and $File=='bad'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$resultB = $db->select_query("SELECT *,sum(badtail_point) AS CO FROM ".TB_BAD."  ,".TB_BADTAIL." ,".TB_STUDENT." where  bad_tail=badtail_id  and bad_area='".$_SESSION['person_area']."' and bad_code='".$_SESSION['person_school']."' and stu_id=bad_stu and stu_suspend='0' group by bad_year"); 
@$rowsB = $db->fetch(@$resultB);
if(@$rowsB){
return @$rowsB['CO'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='person'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['person'] = $db->select_query("SELECT * FROM ".TB_PERSON." where per_area='".$_SESSION['person_area']."' and per_code='".$_SESSION['person_school']."' "); 
@$rows['person'] = @$db->rows(@$res['person']);
if(@$rows['person']){
return @$rows['person'];
} else {
return '0';
}
}


if($Mod=='config' and $File=='student'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' "); 
@$rows['stu'] = @$db->rows(@$res['stu']);
if(@$rows['stu']){
return @$rows['stu'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='class'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['class'] = $db->select_query("SELECT * FROM ".TB_CLASS_GROUP." where clg_area='".$_SESSION['person_area']."' and clg_school='".$_SESSION['person_school']."' "); 
@$rows['class'] = @$db->rows(@$res['class']);
if(@$rows['class']){
return @$rows['class'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='good'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['good'] = $db->select_query("SELECT * FROM ".TB_GOOD." where good_area='".$_SESSION['person_area']."' and good_code='".$_SESSION['person_school']."' "); 
@$rows['good'] = @$db->rows(@$res['good']);
if(@$rows['good']){
return @$rows['good'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='goodtail'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['goodT'] = $db->select_query("SELECT * FROM ".TB_GOODTAIL." where goodtail_area='".$_SESSION['person_area']."' and goodtail_code='".$_SESSION['person_school']."' "); 
@$rows['goodT'] = @$db->rows(@$res['goodT']);
if(@$rows['goodT']){
return @$rows['goodT'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='bad'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['bad'] = $db->select_query("SELECT * FROM ".TB_BAD." where bad_area='".$_SESSION['person_area']."' and bad_code='".$_SESSION['person_school']."' "); 
@$rows['bad'] = @$db->rows(@$res['bad']);
if(@$rows['bad']){
return @$rows['bad'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='badtail'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['badT'] = $db->select_query("SELECT * FROM ".TB_BADTAIL." where badtail_area='".$_SESSION['person_area']."' and badtail_code='".$_SESSION['person_school']."' "); 
@$rows['badT'] = @$db->rows(@$res['badT']);
if(@$rows['badT']){
return @$rows['badT'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='best'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['best'] = $db->select_query("SELECT * FROM ".TB_BESTTAIL."  where btail_area='".$_SESSION['person_area']."' and btail_code='".$_SESSION['person_school']."' "); 
@$rows['best'] = @$db->rows(@$res['best']);
if(@$rows['best']){
return @$rows['best'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='spacial'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['spacial'] = $db->select_query("SELECT * FROM ".TB_SPACIALTAIL." where stail_area='".$_SESSION['person_area']."' and stail_code='".$_SESSION['person_school']."' "); 
@$rows['spacial'] = @$db->rows(@$res['spacial']);
if(@$rows['spacial']){
return @$rows['spacial'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='motor'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['motor'] = $db->select_query("SELECT * FROM ".TB_MOTORTAIL." where mot_area='".$_SESSION['person_area']."' and mot_code='".$_SESSION['person_school']."' "); 
@$rows['motor'] = @$db->rows(@$res['motor']);
if(@$rows['motor']){
return @$rows['motor'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='put'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['put'] = $db->select_query("SELECT * FROM ".TB_PUTTAIL." where pt_area='".$_SESSION['person_area']."' and pt_code='".$_SESSION['person_school']."' "); 
@$rows['put'] = @$db->rows(@$res['put']);
if(@$rows['put']){
return @$rows['put'];
} else {
return '0';
}
}


if($Mod=='config' and $File=='council'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['council'] = $db->select_query("SELECT * FROM ".TB_COUNTAIL." where cot_area='".$_SESSION['person_area']."' and cot_code='".$_SESSION['person_school']."' "); 
@$rows['council'] = @$db->rows(@$res['council']);
if(@$rows['council']){
return @$rows['council'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='whiteclass'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['whiteclass'] = $db->select_query("SELECT * FROM ".TB_WHITECLTAIL." where whcl_area='".$_SESSION['person_area']."' and whcl_code='".$_SESSION['person_school']."' "); 
@$rows['whiteclass'] = @$db->rows(@$res['whiteclass']);
if(@$rows['whiteclass']){
return @$rows['whiteclass'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='affairs'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['affairs'] = $db->select_query("SELECT * FROM ".TB_AFFTAIL." where  afft_area='".$_SESSION['person_area']."' and afft_code='".$_SESSION['person_school']."' "); 
@$rows['affairs'] = @$db->rows(@$res['affairs']);
if(@$rows['affairs']){
return @$rows['affairs'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='ent'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['ent'] = $db->select_query("SELECT * FROM ".TB_ENTTAIL." where got_area='".$_SESSION['person_area']."' and got_code='".$_SESSION['person_school']."' "); 
@$rows['ent'] = @$db->rows(@$res['ent']);
if(@$rows['ent']){
return @$rows['ent'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='exit'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['ext'] = $db->select_query("SELECT * FROM ".TB_EXITTAIL." where ext_area='".$_SESSION['person_area']."' and ext_code='".$_SESSION['person_school']."'  "); 
@$rows['ext'] = @$db->rows(@$res['ext']);
if(@$rows['ext']){
return @$rows['ext'];
} else {
return '0';
}
}

if($Mod=='config' and $File=='rubrong'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['rub'] = $db->select_query("SELECT * FROM ".TB_RUBRONG." where rub_area='".$_SESSION['person_area']."' and rub_code='".$_SESSION['person_school']."' "); 
@$rows['rub'] = @$db->rows(@$res['rub']);
if(@$rows['rub']){
return @$rows['rub'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='student'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['stu'] = $db->select_query("SELECT * FROM ".TB_STUDENT." where stu_area='".$_SESSION['person_area']."' and stu_code='".$_SESSION['person_school']."' "); 
@$rows['stu'] = @$db->rows(@$res['stu']);
if(@$rows['stu']){
return @$rows['stu'];
} else {
return '0';
}
}


if($Mod=='import' and $File=='bad'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['bad'] = $db->select_query("SELECT * FROM ".TB_BAD." where bad_area='".$_SESSION['person_area']."' and bad_code='".$_SESSION['person_school']."' "); 
@$rows['bad'] = @$db->rows(@$res['bad']);
if(@$rows['bad']){
return @$rows['bad'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='good'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['good'] = $db->select_query("SELECT * FROM ".TB_GOOD." where good_area='".$_SESSION['person_area']."' and good_code='".$_SESSION['person_school']."' "); 
@$rows['good'] = @$db->rows(@$res['good']);
if(@$rows['good']){
return @$rows['good'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='best'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['btail'] = $db->select_query("SELECT * FROM ".TB_BESTTAIL." where btail_area='".$_SESSION['person_area']."' and btail_code='".$_SESSION['person_school']."' "); 
@$rows['btail'] = @$db->rows(@$res['btail']);
if(@$rows['btail']){
return @$rows['btail'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='spacial'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['spacialx'] = $db->select_query("SELECT * FROM ".TB_SPACIALTAIL." where stail_area='".$_SESSION['person_area']."' and stail_code='".$_SESSION['person_school']."' "); 
@$rows['spacialx'] = @$db->rows(@$res['spacialx']);
if(@$rows['spacialx']){
return @$rows['spacialx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='motor'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['motorx'] = $db->select_query("SELECT * FROM ".TB_MOTORTAIL." where mot_area='".$_SESSION['person_area']."' and mot_code='".$_SESSION['person_school']."' "); 
@$rows['motorx'] = @$db->rows(@$res['motorx']);
if(@$rows['motorx']){
return @$rows['motorx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='put'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['putx'] = $db->select_query("SELECT * FROM ".TB_PUTTAIL." where pt_area='".$_SESSION['person_area']."' and pt_code='".$_SESSION['person_school']."' "); 
@$rows['putx'] = @$db->rows(@$res['putx']);
if(@$rows['putx']){
return @$rows['putx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='nut'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['nutx'] = $db->select_query("SELECT * FROM ".TB_NUT." where nut_area='".$_SESSION['person_area']."' and nut_code='".$_SESSION['person_school']."' "); 
@$rows['nutx'] = @$db->rows(@$res['nutx']);
if(@$rows['nutx']){
return @$rows['nutx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='tunbon'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['tunx'] = $db->select_query("SELECT * FROM ".TB_TUNBON." "); 
@$rows['tunx'] = @$db->rows(@$res['tunx']);
if(@$rows['tunx']){
return @$rows['tunx'];
} else {
return '0';
}
}


if($Mod=='import' and $File=='council'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['councilx'] = $db->select_query("SELECT * FROM ".TB_COUNTAIL." where cot_area='".$_SESSION['person_area']."' and cot_code='".$_SESSION['person_school']."' "); 
@$rows['councilx'] = @$db->rows(@$res['councilx']);
if(@$rows['councilx']){
return @$rows['councilx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='whiteclass'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['whiteclassx'] = $db->select_query("SELECT * FROM ".TB_WHITECLTAIL." where whcl_area='".$_SESSION['person_area']."' and whcl_code='".$_SESSION['person_school']."' "); 
@$rows['whiteclassx'] = @$db->rows(@$res['whiteclassx']);
if(@$rows['whiteclassx']){
return @$rows['whiteclassx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='affairs'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['affairsx'] = $db->select_query("SELECT * FROM ".TB_AFFAIRS." where aff_area='".$_SESSION['person_area']."' and aff_code='".$_SESSION['person_school']."' "); 
@$rows['affairsx'] = @$db->rows(@$res['affairsx']);
if(@$rows['affairsx']){
return @$rows['affairsx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='ent'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['entx'] = $db->select_query("SELECT * FROM ".TB_ENTTAIL." where got_area='".$_SESSION['person_area']."' and got_code='".$_SESSION['person_school']."' "); 
@$rows['entx'] = @$db->rows(@$res['entx']);
if(@$rows['entx']){
return @$rows['entx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='exit'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['extx'] = $db->select_query("SELECT * FROM ".TB_EXITTAIL." where ext_area='".$_SESSION['person_area']."' and ext_code='".$_SESSION['person_school']."' "); 
@$rows['extx'] = @$db->rows(@$res['extx']);
if(@$rows['extx']){
return @$rows['extx'];
} else {
return '0';
}
}

if($Mod=='import' and $File=='rubrong'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['rubx'] = $db->select_query("SELECT * FROM ".TB_RUBRONG." where rb_area='".$_SESSION['person_area']."' and rb_code='".$_SESSION['person_school']."' "); 
@$rows['rubx'] = @$db->rows(@$res['rubx']);
if(@$rows['rubx']){
return @$rows['rubx'];
} else {
return '0';
}
}


if($Mod=='access' and $File=='message'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['mss'] = $db->select_query("SELECT * FROM ".TB_MESSAGE." where ms_area='".$_SESSION['person_area']."' and ms_school='".$_SESSION['person_school']."'  "); 
@$rows['mss'] = @$db->rows(@$res['mss']);
if(@$rows['mss']){
return @$rows['mss'];
} else {
return '0';
}
}

if($Mod=='menu' and $File=='index'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['menu'] = $db->select_query("SELECT * FROM ".TB_PERSON_MENU." "); 
@$rows['menu'] = @$db->rows(@$res['menu']);
if(@$rows['menu']){
return @$rows['menu'];
} else {
return '0';
}
}

if($Mod=='onlineuser'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['online'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." where ct_user='".$_SESSION['person_login']."' "); 
@$rows['online'] = @$db->rows(@$res['online']); 
if(@$rows['online']){
return @$rows['online'];
} else {
return '0';
}
}

if($Mod=='online'){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['online'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." "); 
@$rows['online'] = @$db->rows(@$res['online']); 
if(@$rows['online']){
return @$rows['online'];
} else {
return '0';
}
}

if($Mod=='onlineusers' ){
//$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['onlinex'] = $db->select_query("SELECT * FROM ".TB_ACTIVEUSER." where ct_user='".$user."' "); 
@$rows['onlinex'] = $db->rows(@$res['onlinex']); 
if(@$rows['onlinex']){
return @$rows['onlinex'];
} else {
return '0';
}
}


}


function GETMODULE($name,$file){
	global $MODPATH, $MODPATHFILE ;
	$targetPath = WEB_PATH;
	if(empty($name)){$name= "index";}
	if(empty($file)){$file = "index";}
	$files = str_replace('../', '', $file);
	$names = str_replace('../', '', $name);
	$modpathfile=$targetPath."/modules/".$names."/".$files.".php";
	if (file_exists($modpathfile)) {
	$MODPATHFILE = $modpathfile;
	$MODPATH = $targetPath."/modules/".$names."/";
	}else{
	header( 'Content-Type:text/html; charset=utf-8');
	die (""._NO_MOD."");
	}
}

function GETMODULEADMIN($name,$file){
	global $MODPATH, $MODPATHFILE ;
	$targetPath = WEB_PATH;
	if(empty($name)){$name= "index";}
	if(empty($file)){$file = "index";}
	$files = str_replace('../', '', $file);
	$names = str_replace('../', '', $name);
	$modpathfile=$targetPath."/admin/modules/".$names."/".$files.".php";
	if (file_exists($modpathfile)) {
	$MODPATHFILE = $modpathfile;
	$MODPATH = $targetPath."/admin/modules/".$names."/";
	}else{
	header( 'Content-Type:text/html; charset=utf-8');
	//die (""._NO_MOD."");
	echo "<meta http-equiv='refresh' content='0; url=../../404.php'>";
	}
}


function GETMODULEPERSON($name,$file){
	global $MODPATH, $MODPATHFILE ;
	$targetPath = WEB_PATH;
	if(empty($name)){$name= "index";}
	if(empty($file)){$file = "index";}
	$files = str_replace('../', '', $file);
	$names = str_replace('../', '', $name);
	$modpathfile=$targetPath."/person/modules/".$names."/".$files.".php";
	if (file_exists($modpathfile)) {
	$MODPATHFILE = $modpathfile;
	$MODPATH = $targetPath."/person/modules/".$names."/";
	}else{
	header( 'Content-Type:text/html; charset=utf-8');
	//die (""._NO_MOD."");
	echo "<meta http-equiv='refresh' content='0; url=../../404.php'>";
	}
}

function GETMODULEUSER($name,$file){
	global $MODPATH, $MODPATHFILE ;
	$targetPath = WEB_PATH;
	if(empty($name)){$name= "index";}
	if(empty($file)){$file = "index";}
	$files = str_replace('../', '', $file);
	$names = str_replace('../', '', $name);
	$modpathfile=$targetPath."/user/modules/".$names."/".$files.".php";
	if (file_exists($modpathfile)) {
	$MODPATHFILE = $modpathfile;
	$MODPATH = $targetPath."/user/modules/".$names."/";
	}else{
	header( 'Content-Type:text/html; charset=utf-8 ');
	//die (""._NO_MOD."");
	echo "<meta http-equiv='refresh' content='0; url=../../404.php'>";
	}
}

// เปลี่ยนวันที่ของการเพิ่มกิจกรรมจาก 01 02 2013 23:50 เป็น 2013-02-01 23:50:00
  function CalTimeCon($timeSD)
	{
		$m1 = substr($timeSD, 0, 2);
		$d1 = substr($timeSD, 3, 2);
		$y1 = substr($timeSD, 6, 4) ;
		$h1 = substr($timeSD, 10, 6);
		if ($timeSD == "")
		{
			return "";
		} else
		{
			return $y1 . "-" . $m1 . "-" . $d1. "" . $h1;
		}
	}


	///////////////////////////////////////////////////////////////
function format_number( $val )
{
 $svals = explode( "." , $val ); //แยกทศนิยมออก
 $sval = $svals[0]; //จำนวนเต็ม

 $n = 0;
 @$result = "";
 for( $i = strlen( $sval ) - 1 ; $i >= 0 ; $i-- )
 {
  if ( $sval[$i] == "." )
  {
   $n = -1;
  }
  else if ( $n == 3 )
  {
   @$result = ",@$result"; //ใส่ comma
   $n = 0;
  }
  $n++;
  @$result = $sval[$i].@$result;
 }
 return ( count( $svals ) > 1 ) ? @$result.'.'.$svals[1] : @$result;
};

function generate_sessionID($length) {
      $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $password = '';
      for ( $i = 0; $i < $length; $i++ )
         $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
      return $password;
   } 

function encode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string,$i,1));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
    }
    return $hash;
}

function decode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
}

function validip($ip)
{
if (!empty($ip) && $ip == long2ip(ip2long($ip)))
{
@$reserved_ips = array (
array('0.0.0.0','2.255.255.255'),
array('10.0.0.0','10.255.255.255'),
array('127.0.0.0','127.255.255.255'),
array('169.254.0.0','169.254.255.255'),
array('172.16.0.0','172.31.255.255'),
array('192.0.2.0','192.0.2.255'),
array('192.168.0.0','192.168.255.255'),
array('255.255.255.0','255.255.255.255')
);

foreach (@$reserved_ips as $r)
{
$min = ip2long($r[0]);
$max = ip2long($r[1]);
if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
}
return true;
}
else return false;
}

function getip() {
   if (isset($_SERVER)) {
     if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && validip($_SERVER['HTTP_X_FORWARDED_FOR'])) {
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
     } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && validip($_SERVER['HTTP_CLIENT_IP'])) {
       $ip = $_SERVER['HTTP_CLIENT_IP'];
     } else {
       $ip = $_SERVER['REMOTE_ADDR'];
     }
   } else {
     if (getenv('HTTP_X_FORWARDED_FOR') && validip(getenv('HTTP_X_FORWARDED_FOR'))) {
       $ip = getenv('HTTP_X_FORWARDED_FOR');
     } elseif (getenv('HTTP_CLIENT_IP') && validip(getenv('HTTP_CLIENT_IP'))) {
       $ip = getenv('HTTP_CLIENT_IP');
     } else {
       $ip = getenv('REMOTE_ADDR');
     }
   }

   return $ip;
 }

function getIpRang(  $cidr) {

   list($ip, $mask) = explode('/', $cidr);
 
   $maskBinStr =str_repeat("1", $mask ) . str_repeat("0", 32-$mask );      //net mask binary string
   $inverseMaskBinStr = str_repeat("0", $mask ) . str_repeat("1",  32-$mask ); //inverse mask
  
   $ipLong = ip2long( $ip );
   $ipMaskLong = bindec( $maskBinStr );
   $inverseIpMaskLong = bindec( $inverseMaskBinStr );
   $netWork = $ipLong & $ipMaskLong; 

   $start = $netWork+1;
 
   $end = ($netWork | $inverseIpMaskLong) -1 ; 
   return array( $start, $end );
}

function setSessionTime($_timeSecond){
 if(!isset($_SESSION['admin_user'])){
  $_SESSION['admin_user']=time();
 }
 if(isset($_SESSION['admin_user']) || time()-$_SESSION['admin_user']>$_timeSecond){
  if(count($_SESSION)>0){
   foreach($_SESSION as $key=>$value){
    unset($$key);
    unset($_SESSION[$key]);
   }
  }
 }
 
}


//	$strDate = "2008-08-14 13:42:44";
//	echo "ThaiCreate.Com Time now : ".DateThai($strDate);
	function DateThaiNew($strDate,$full="")
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("",""._Month_1."",""._Month_2."",""._Month_3."",""._Month_4."",""._Month_5."",""._Month_6."",""._Month_7."",""._Month_8."",""._Month_9."",""._Month_10."",""._Month_11."",""._Month_12."");
		$strMonthThai=$strMonthCut[$strMonth];
		if($full){
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
		} else {
		return "$strDay $strMonthThai $strYear";
		}
	}

//	$strDate = "2008-08-14";
//	echo "ThaiCreate.Com Time now : ".DateThai($strDate);
	function ShortDateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("",""._Month_1."",""._Month_2."",""._Month_3."",""._Month_4."",""._Month_5."",""._Month_6."",""._Month_7."",""._Month_8."",""._Month_9."",""._Month_10."",""._Month_11."",""._Month_12."");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}


function check_captcha($cap) {
	if($_SESSION['security_code'] != $cap OR empty($cap)) {
		echo "<script language='javascript'>" ;
		echo "alert('"._JAVA_CAPTCHA_NOACC."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	} else {
	return true;
	}
}


function is_valid($input)
{
$input = strtolower($input);

if (str_word_count($input) > 1)
{
$loop = true;
$input = explode(" ",$input);
}

$bad_strings = array("'", "--", "select", "union", "insert", "update", "like", "delete", "distinct", "having", "truncate", "replace", "handler", " as ", "or ", "procedure", "limit", "order by", "group by", "asc", "desc" , "1=1", "or", "#", "//","' or '1'='1'","'1'='1'" );

if ($loop == true)
{
foreach($input as $value)
{
if (in_array($value, $bad_strings))
{
return false;
}
else
{
return true;
}
}
}
else
{
if (in_array($input, $bad_strings))
{
return false;
}
else
{
return true;
}
}
}

//function แปลง tis620 เป็น utf8
function tis620_to_utf8($tis) {
	$utf8="";
  for( $i=0 ; $i< strlen($tis) ; $i++ ){
    $s = substr($tis, $i, 1);
    $val = ord($s);
    if( $val < 0x80 ){
	 $utf8 .= $s;
    } elseif ((0xA1 <= $val and $val <= 0xDA) 
              or (0xDF <= $val and $val <= 0xFB))  {
	 $unicode = 0x0E00 + $val - 0xA0;
	 $utf8 .= chr( 0xE0 | ($unicode >> 12) );
	 $utf8 .= chr( 0x80 | (($unicode >> 6) & 0x3F) );
	 $utf8 .= chr( 0x80 | ($unicode & 0x3F) );
    }
  }
return $utf8;
} 

//function แปลง utf8 เป็น tis620
function utf8_to_tis620($string) {
  $str = $string;
  @$res = "";
  for ($i = 0; $i < strlen($str); $i++) {
	if (ord($str[$i]) == 224) {
	  $unicode = ord($str[$i+2]) & 0x3F;
	  $unicode |= (ord($str[$i+1]) & 0x3F) << 6;
	  $unicode |= (ord($str[$i]) & 0x0F) << 12;
	  @$res .= chr($unicode-0x0E00+0xA0);
	  $i += 2;
	} else {
	  @$res .= $str[$i];
	}
  }
  return @$res;
} 


function getRealIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function get_real_ip()
{
    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function ThaiTimeDate($timestamp="",$date=""){
	global $SHORT_MONTH, $FULL_MONTH, $DAY_SHORT_TEXT, $DAY_FULL_TEXT;
	$day = date("l",$timestamp);
	$month = date("n",$timestamp);
	$year = date("Y",$timestamp);
	$time = date("H:i:s",$timestamp);
	$times = date("H:i",$timestamp);

	    $ThaiText = "&nbsp;<font size=2 color=#FFFFFF>".$SHORT_MONTH[$month]."</font><br><font  color=#FFFFFF><b>".date("j",$timestamp)."</b></font><br><font size=1 color=#FFFFFF>".($year+543)."</font>";

return $ThaiText;
}

//แปลงเวลาเป็นภาษาไทย
function ThaiTimeConvert($timestamp="",$full="",$showtime=""){
	global $SHORT_MONTH, $FULL_MONTH, $DAY_SHORT_TEXT, $DAY_FULL_TEXT;
	$day = date("l",$timestamp);
	$month = date("n",$timestamp);
	$year = date("Y",$timestamp);
	$time = date("H:i:s",$timestamp);
	$times = date("H:i",$timestamp);
	if($full){
		$ThaiText = $DAY_FULL_TEXT[$day]." "._TIME_AT." ".date("j",$timestamp)." "._MONTH_AT." ".$FULL_MONTH[$month]." "._YEAR_AT."".($year+543) ;
	}else{
		$ThaiText = date("j",$timestamp)."/".$SHORT_MONTH[$month]."/".($year+543);
	}

	if($showtime == "1"){
		return $ThaiText."<br>"._TIMES_AT." ".$time;
	}else if($showtime == "2"){
		$ThaiText = date("j",$timestamp)." ".$SHORT_MONTH[$month]." ".($year+543);
		return $ThaiText." : ".$times;
	}else{
		return $ThaiText;
	}
}
//เปลี่ยนจาก 2017-02-12 00:00:00 เป็น 12 กุมภาพันธ์ 2560 00:00:00
function FullDateTimeThai($strDate){
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("",""._F_Month_1."",""._F_Month_2."",""._F_Month_3."",""._F_Month_4."",""._F_Month_5."",""._F_Month_6."",""._F_Month_7."",""._F_Month_8."",""._F_Month_9."",""._F_Month_10."",""._F_Month_11."",""._F_Month_12."");
    $strMonthThai = $strMonthCut[$strMonth];
//    return "$strDay $strMonthThai $strYear";
    return "$strDay $strMonthThai $strYear $strHour:$strMinute:$strSeconds";
}

//เปลี่ยนจาก 2017-02-12 เป็น 12 กุมภาพันธ์ 2560
function FullDateThai($strDate){
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("",""._F_Month_1."",""._F_Month_2."",""._F_Month_3."",""._F_Month_4."",""._F_Month_5."",""._F_Month_6."",""._F_Month_7."",""._F_Month_8."",""._F_Month_9."",""._F_Month_10."",""._F_Month_11."",""._F_Month_12."");
    $strMonthThai = $strMonthCut[$strMonth];
//    return "$strDay $strMonthThai $strYear";
    return "$strDay $strMonthThai $strYear";
}

//เปลี่ยนจาก 2017-02-12  0000-00-00 เป็น 12 ก.พ. 2560
function DateTimeThai($strDate){
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("",""._Month_1."",""._Month_2."",""._Month_3."",""._Month_4."",""._Month_5."",""._Month_6."",""._Month_7."",""._Month_8."",""._Month_9."",""._Month_10."",""._Month_11."",""._Month_12."");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear $strHour:$strMinute:$strSeconds";
  //  return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}

//เปลี่ยนจาก 2017-02-12 เป็น 12 ก.พ. 2560
function DateThai($strDate){
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("",""._Month_1."",""._Month_2."",""._Month_3."",""._Month_4."",""._Month_5."",""._Month_6."",""._Month_7."",""._Month_8."",""._Month_9."",""._Month_10."",""._Month_11."",""._Month_12."");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
  //  return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}

//เปลี่ยนจาก 11/2/2554  เป็น 11 ก.พ. 2554
function formatDateThai($date){
$list= array("",""._Month_1."",""._Month_2."",""._Month_3."",""._Month_4."",""._Month_5."",""._Month_6."",""._Month_7."",""._Month_8."",""._Month_9."",""._Month_10."",""._Month_11."",""._Month_12."");
list($d,$m,$y) =preg_split("/\//",$date);
//$DD = substr($d, 1, 1); 
//$MM = substr($m, 1, 1); 
return "$d {$list[$m]} $y";
}

//เปลี่ยนจาก 11/2/2022  เป็น 11 ก.พ. 2554
function formatDateThaiNew($date){
$list= array("",""._Month_1."",""._Month_2."",""._Month_3."",""._Month_4."",""._Month_5."",""._Month_6."",""._Month_7."",""._Month_8."",""._Month_9."",""._Month_10."",""._Month_11."",""._Month_12."");
list($d,$m,$y) =preg_split("/\//",$date);
$DD = substr($d, 1, 1); 
$MM = substr($m, 1, 1); 
if($DD==0){
	$Dy=10;
} else {
	$Dy=$DD;
}
if($MM==0){
	$My=10;
} else {
	$My=$MM;
}
$yy=$y+543;
return "$Dy {$list[$My]} $yy";
}

//เปลี่ยนจาก 2017-02-12 00:00:00 เป็น 12 กุมภาพันธ์ 2560 00:00:00
function FullDateTimeThaiShort($strDate){
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("",""._F_Month_1."",""._F_Month_2."",""._F_Month_3."",""._F_Month_4."",""._F_Month_5."",""._F_Month_6."",""._F_Month_7."",""._F_Month_8."",""._F_Month_9."",""._F_Month_10."",""._F_Month_11."",""._F_Month_12."");
    $strMonthThai = $strMonthCut[$strMonth];
//    return "$strDay $strMonthThai $strYear";
    return "$strDay $strMonthThai $strYear "._TIMES_AT." $strHour.$strMinute "._TIMES_AT_N;
}


// กรณีวันเกิดที่เ็ก็บสามารถแยกออกเป็นแต่ละส่วน เช่นปี ค.ศ. เดือน และ วัน  
// ตัวอย่าง ปีเกิด 1990 เดือนเกิด 2 (กุมภาพันธ์)  วันที่ 14  
// ฟังก์ชันคำนวณหาอายุใช้ดังนี้  
function getAge($year,$month,$day) {  
$then = mktime(1,1,1,$month,$day,$year);  
return(floor((time()-$then)/31556926));  
}  
// การใช้งาน  
//echo getAge(1990,2,14);  
// ผลลัพธ์จะได้ 19   


// กรณีวันเกิดที่เ็ก็บอยู่ในรูปแบบของ date แบบมาตรฐาน คือ ปี ค.ศ.- เดือน - วันที่  
// ตัวอย่าง 1990-02-14  
// ฟังก์ชันคำนวณหาอายุใช้ดังนี้  
function getAgeB($birthday) {  
$then = strtotime($birthday);  
return(floor((time()-$then)/31556926));  
}  
// การใช้งาน  
//$dateB="1990-02-14"; // ตัวแปรเก็บวันเกิด  
//echo getAgeB($dateB);  
// ผลลัพธ์จะได้ 19  

// กรณีวันเกิดที่เ็ก็บอยู่ในรูปแบบของ date แบบมาตรฐาน คือ ปี ค.ศ.- เดือน - วันที่
// ตัวอย่าง 1990-02-14
// ฟังก์ชันคำนวณหาอายุใช้ดังนี้
function getAgeClass($birthday) {
$then = strtotime($birthday);
return(floor((time()-$then)/31556926));
}
// การใช้งาน
//$dateB="1990-02-14"; // ตัวแปรเก็บวันเกิด
//echo getAge($dateB);
// ผลลัพธ์จะได้ 19  



function ThaiBahtConversion($amount_number)
{
    $amount_number = number_format($amount_number, 2, ".","");
    //echo "<br/>amount = " . $amount_number . "<br/>";
    $pt = strpos($amount_number , ".");
    $number = $fraction = "";
    if ($pt === false)
        $number = $amount_number;
    else
    {
        $number = substr($amount_number, 0, $pt);
        $fraction = substr($amount_number, $pt + 1);
    }
   
    //list($number, $fraction) = explode(".", $number);
    $ret = "";
    $baht = ReadNumber ($number);
    if ($baht != "")
        $ret .= $baht . "บาท";
   
    $satang = ReadNumber($fraction);
    if ($satang != "")
        $ret .=  $satang . "สตางค์";
    else
        $ret .= "ถ้วน";
    //return iconv("UTF-8", "TIS-620", $ret);
    return $ret;
}

function ReadNumber($number)
{
    $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
    $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $number = $number + 0;
    $ret = "";
    if ($number == 0) return $ret;
    if ($number > 1000000)
    {
        $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
        $number = intval(fmod($number, 1000000));
    }
   
    $divider = 100000;
    $pos = 0;
    while($number > 0)
    {
        $d = intval($number / $divider);
        $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" :
            ((($divider == 10) && ($d == 1)) ? "" :
            ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
        $ret .= ($d ? $position_call[$pos] : "");
        $number = $number % $divider;
        $divider = $divider / 10;
        $pos++;
    }
    return $ret;
} 

//webboard Icon
function WebIcon($Ntime="", $Otime="", $Icon=""){
	if(TIMESTAMP <= ($Otime + 86400)){
		echo "<IMG SRC=\"".$Icon."\" BORDER=\"0\" ALIGN=\"absmiddle\"> ";
	}
}

//icon
function ShowIcons($Ntime="",$Otime="",$MOD="",$ID=""){
global $db;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
if($MOD=='flashpage'){
if(TIMESTAMP <= ($Otime + 86400)){
		echo "<i class=\"tags\"></i>";
} else {
@$res['flashpage'] = $db->select_query("SELECT * FROM ".TB_MAG_NUMBERS." order by view DESC limit 10"); 
$i=1;
while(@$arr['flashpage'] = $db->fetch(@$res['flashpage'])){
if($i==1){
if($ID==@$arr['flashpage']['id']){
echo "<i class=\"bests\"></i>";
}
} else {
if($ID==@$arr['flashpage']['id']){
echo "<i class=\"tops\"></i>";
}
}
$i++;
}

}
}



}


//icon
function ShowIcon($Ntime="",$Otime="",$MOD="",$ID=""){
global $db;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
if($MOD=='flashpage'){
if(TIMESTAMP <= ($Otime + 86400)){
		echo "<i class=\"tag\"></i>";
} else {
@$res['flashpage'] = $db->select_query("SELECT * FROM ".TB_MAG_NUMBERS." order by view DESC limit 10"); 
$i=1;
while(@$arr['flashpage'] = $db->fetch(@$res['flashpage'])){
if($i==1){
if($ID==@$arr['flashpage']['id']){
echo "<i class=\"best\"></i>";
}
} else {
if($ID==@$arr['flashpage']['id']){
echo "<i class=\"top\"></i>";
}
}
$i++;
}

}
}


if($MOD=='article'){
if(TIMESTAMP <= ($Otime + 86400)){
		echo "<i class=\"tag\"></i>";
} else {
@$res['article'] = $db->select_query("SELECT * FROM ".TB_ARTICLE." order by pageview DESC limit 10"); 
$i=1;
while(@$arr['article'] = $db->fetch(@$res['article'])){
if($i==1){
if($ID==@$arr['article']['id']){
echo "<i class=\"best\"></i>";
}
} else {
if($ID==@$arr['article']['id']){
echo "<i class=\"top\"></i>";
}
}
$i++;
}

}
}


if($MOD=='blog'){
if(TIMESTAMP <= ($Otime + 86400)){
		echo "<i class=\"tag\"></i>";
} else {
@$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." order by pageview DESC limit 10"); 
$i=1;
while(@$arr['blog'] = $db->fetch(@$res['blog'])){
if($i==1){
if($ID==@$arr['blog']['id']){
echo "<i class=\"best\"></i>";
}
} else {
if($ID==@$arr['blog']['id']){
echo "<i class=\"top\"></i>";
}
}
$i++;
}

}
}

if($MOD=='knowledge'){
if(TIMESTAMP <= ($Otime + 86400)){
		echo "<i class=\"tag\"></i>";
} else {
@$res['knowledge'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE." order by pageview DESC limit 10"); 
$i=1;
while(@$arr['knowledge'] = $db->fetch(@$res['knowledge'])){
if($i==1){
if($ID==@$arr['knowledge']['id']){
echo "<i class=\"best\"></i>";
}
} else {
if($ID==@$arr['knowledge']['id']){
echo "<i class=\"top\"></i>";
}
}
$i++;
}

}
}


if($MOD=='media'){
if(TIMESTAMP <= ($Otime + 86400)){
		echo "<i class=\"tag\"></i>";
} else {
@$res['media'] = $db->select_query("SELECT * FROM ".TB_MEDIA." order by pageview DESC limit 10"); 
$i=1;
while(@$arr['media'] = $db->fetch(@$res['media'])){
if($i==1){
if($ID==@$arr['media']['id']){
echo "<i class=\"best\"></i>";
}
} else {
if($ID==@$arr['media']['id']){
echo "<i class=\"top\"></i>";
}
}
$i++;
}

}
}


}

//News Icon
function NewsIcon($Ntime="", $Otime=""){
	if(TIMESTAMP <= ($Otime + 86400)){
		echo "<span class=\"badge bg-red\">New</span>";
	}
}
function NewsIcons($Ntime="", $Otime=""){
	if(TIMESTAMP <= ($Otime + 86400)){
		echo "<span class=\"badge bg-red\">New</span>";
	}
}
//update icon
function UpdateIcon($Ntime="", $Otime=""){
	if(TIMESTAMP <= ($Otime + 86400)){
		echo "<span class=\"badge bg-yellow\">Update</span>";
	}
}
//ฟังก์ชั่นในการลบตัว \ ออกเพื่อให้แสดงผลได้ถุกต้อง
function FixQuotes ($what = "") {
        $what = preg_replace("/'/i","''",$what);
        while (preg_match("/\\\\'/i", $what)) {
                $what = preg_replace("/\\\\'/i","'",$what);
        }
        return $what;
}

//ฟังก์ชั่นเปลี่ยนข้อความเว็บและเมล์ให้เป็นลิงก์ 
function CHANGE_LINK($Message = ""){
	$Message = preg_replace("/([[:alnum:]]+)://([^[:space:]]*)([[:alnum:]#?/&=])/i","<a href=\"\\1://\\2\\3\" target=\"_blank\">\\1://\\2\\3</a>",$Message);
	$Message = preg_replace("/([[:alnum:]]+)@([^[:space:]]*)([[:alnum:]])/i","<a href=mailto:\\1@\\2\\3>\\1@\\2\\3</a>",$Message); 
return ($Message);
}

function dateTimeDiff($db_date) {

	if (!function_exists('gregoriantojd')) {
	 	function gregoriantojd() {
	 		$msg = "The PHP calendar function is disabled\n
	 		Please ask your host to do a normal php install";
	 		$fo = @fopen('phpmotion_errors.txt', 'w');
	 		@fwrite($fo, $msg);
	 		@fclose($fo);
	 	}
	 }


	$h_r			= '';
	$m_r 			= '';
	$s_r 			= '';

	// from V3 tables
	// 2008-07-14 20:34:03

	$c_date		= date('Y-m-d H:i:s');
	$c_year 		= substr($c_date,0,4);
	$c_month 		= substr($c_date,5,2);
	$c_day 		= substr($c_date,8,2);
	$r_year 		= substr($db_date,0,4);
	$r_month 		= substr($db_date,5,2);
	$r_day 		= substr($db_date,8,2);
	$tmp_m_dates	= $c_year . $c_month . $c_day;
	$tmp_r_use 		= $r_year . $r_month . $r_day;
	$tmp_dif 		= $tmp_m_dates-$tmp_r_use;
	$use_diff 		= $tmp_dif;
	$c_hour 		= substr($c_date,11,2);
	$c_min 		= substr($c_date,14,2);
	$c_seconds 		= substr($c_date,17,2);
	$r_hour 		= substr($db_date,11,2);
	$r_min 		= substr($db_date,14,2);
	$r_seconds 		= substr($db_date,17,2);
	$h_r 			= $c_hour-$r_hour;
	$m_r 			= $c_min-$r_min;
	$s_r 			= $c_seconds-$r_seconds;

	if( $use_diff < 1 ) {
		if( $h_r > 0 ) {
			if( $m_r < 0 ) {
				$m_r	= 60 + $m_r;
				$h_r 	= $h_r - 1;
				return $m_r . " Mins ago";
			} else {
				return $h_r. " Hrs " . $m_r . " Mins ago";
			}
		} else {
			if( $m_r > 0 ){
				return $m_r . " Mins ago";
			} else {
				return $s_r . " Secs ago";
			}
		}
	} else {
		$c_date		= date('m/d/Y');
		$date_str 		= strtotime($db_date);
		$db_date 		= date('m/d/Y', $date_str);
		$dformat 		= '/';
		$date_part_1	= explode($dformat, $db_date);
		$date_part_2  	= explode($dformat, $c_date);
		$db_date	  	= gregoriantojd($date_part_1[0], $date_part_1[1], $date_part_1[2]);
		$c_date 		= gregoriantojd($date_part_2[0], $date_part_2[1], $date_part_2[2]);
		$days_ago 		= $c_date - $db_date;

		if ( $days_ago == 1 ) {
			$day_word = 'day ago';
		} else {
			$day_word = 'days ago';
		}

		return $days_ago . " " . $day_word;
	}

}


//function แปลงวันที่ให้เหมือน facebook
function fb_date($timestamp){
	$difference = time() - $timestamp;
	$periods = array("second", "minute", "hour");
	$ending=" ago";
	if($difference<60){
		$j=0;
		$periods[$j].=($difference != 1)?"s":"";
		$difference=($difference==3 || $difference==4)?"a few ":$difference;
		$text = "$difference $periods[$j] $ending";
	}elseif($difference<3600){
		$j=1;
		$difference=round($difference/60);
		$periods[$j].=($difference != 1)?"s":"";
		$difference=($difference==3 || $difference==4)?"a few ":$difference;
		$text = "$difference $periods[$j] $ending";		
	}elseif($difference<86400){
		$j=2;
		$difference=round($difference/3600);
		$periods[$j].=($difference != 1)?"s":"";
		$difference=($difference != 1)?$difference:"about an ";
		$text = "$difference $periods[$j] $ending";		
	}elseif($difference<172800){
		$difference=round($difference/86400);
		$periods[$j].=($difference != 1)?"s":"";
		$text = "Yesterday at ".date("g:ia",$timestamp);								
	}else{
		if($timestamp<strtotime(date("Y-01-01 00:00:00"))){
			$text = date("l j, Y",$timestamp)." at ".date("g:ia",$timestamp);		
		}else{
			$text = date("l j",$timestamp)." at ".date("g:ia",$timestamp);			
		}
	}
	return $text;
}

//function ตัดข้อความให้สั้นแล้วแทนด้วย ...
function CutTextTopic($myText){
$NewText=substr_replace($myText,'…',70)  ;
return $NewText;
}
//function ตัดข้อความให้สั้นแล้วแทนด้วย ...
function CutTextDetail($myText){
$NewText=substr_replace($myText,'…',100)  ;
return $NewText;
}


//blog level
function UserLevel($count=""){
global $db ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
@$res['countsy'] = $db->select_query("SELECT * FROM ".TB_USER_LEVEL." ");
while (@$arr['countsy'] = $db->fetch(@$res['countsy'])) {
$levelid=@$arr['countsy']['level_id'];
if ($levelid=='1'){
	$level1=@$arr['countsy']['level_count'];
}
if ($levelid=='2'){
	$level2=@$arr['countsy']['level_count'];
} 
if ($levelid=='3'){
	$level3=@$arr['countsy']['level_count'];
} 
if ($levelid=='4'){
	$level4=@$arr['countsy']['level_count'];
} 
 if ($levelid=='5'){
	$level5=@$arr['countsy']['level_count'];
} 
 if ($levelid=='6'){
	$level6=@$arr['countsy']['level_count'];
}
}
if ($count >=0 && $count <= $level1 ){ echo '<img src=../img/rate/rank1.gif BORDER=\"0\" ALIGN=\"absmiddle\">  <font color=#CC3399>[ '._COUNT_STAR1.' ]</font>';}
if ($count >$level1 && $count <= $level2) { echo '<img src=../img/rate/rank2.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR2.' ]</font>';}
if ($count >$level2 && $count <= $level3) { echo '<img src=../img/rate/rank3.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR3.' ]</font>';}
if ($count >$level3 && $count <= $level4) { echo '<img src=../img/rate/rank4.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR4.' ]</font>';}
if ($count >$level4 && $count <= $level5 ) { echo '<img src=../img/rate/rank5.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR5.' ]</font>';}
if ($count >=$level6) { echo '<img src=../img/rate/rank6.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR6.' ]</font>';}

}

//ทำการแบ่งหน้า
function SplitPage($page="",$totalpage="",$option=""){
	global $ShowSumPages , $ShowPages ;
	// สร้าง link เพื่อไปหน้าก่อน-หน้าถัดไป
	$ShowSumPages .= "<B>"._FUNC_Page1."  </B>";
	if($page>1 && $page<=$totalpage) {
		$prevpage = $page-1;
		$ShowSumPages .= "<li><a href='".$option."&page=$prevpage' title='Back'><B><-</B></a></li>\n";
	}
	$ShowSumPages .= "<li> <b>$page/$totalpage</b></li> ";
	if($page!=$totalpage) {
		$nextpage = $page+1;
		if($nextpage >= $totalpage){
			$nextpage = $totalpage ;
		}
		$ShowSumPages .= "<li><a href='".$option."&page=$nextpage' title='Next'><B>-></B></a></li>\n";
	}

	// วนลูปแสดงเลขหน้าทั้งหมด แบบเป็นช่วงๆ ช่วงละ 10 หน้า
	$b=floor($page/10); 
	$c=(($b*10));

	if($c>1) {
		$prevpage = $c-1;
		$ShowPages .= "<li><a href='".$option."&page=$prevpage' title='10 "._FUNC_Page2."'><<</a></li> \n";
	}
	else{
		$ShowPages .= "<li><B><<</B></li>\n";
	}
	$ShowPages .= " <b>";
	for($i=$c; $i<$page ; $i++) {
		if($i>0)
		$ShowPages .= "<li><a href='".$option."&page=$i'>$i</a></li> \n";
	}
	$ShowPages .= "<li><font color=red>$page</font></li> \n";
	for($i=($page+1); $i<($c+10) ; $i++) {
		if($i<=$totalpage)
		$ShowPages .= "<li><a href='".$option."&page=$i'>$i</a></li> \n";
	}
	$ShowPages .= "</b> ";
	if($c>=0) {
		if(($c+2)<$totalpage){
	$nextpage = $c+10;
	$ShowPages .= "<li><a href='".$option."&page=$nextpage' title='10 "._FUNC_Page3."'>>></a></li> \n";
		}
		else
	$ShowPages .= "<li><B>>></B></li>\n";
	}
	else{
		$ShowPages .= "<li><B>>></B></li>\n";
	}

}


// online
function GuestOnline(){
global $db;
$ct_yyyy = date("Y") ;
$ct_mm = date("m") ;
$ct_dd = date("d") ;
$ct_time = time();
$time_delay = 600;
$timecheck = time()-$time_delay;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sqls = $db->select_query(" select COUNT(ct_no) AS ct_count from ".TB_ACTIVEUSER." where ct_dd = '$ct_dd' AND ct_mm = '$ct_mm' AND ct_yyyy = '$ct_yyyy' AND ct_time >= '$timecheck' ");
@$rows = @$db->rows($sqls);
return @$rows;
}

// user
function UserOnline(){
global $db;
$ct_yyyy = date("Y") ;
$ct_mm = date("m") ;
$ct_dd = date("d") ;
$ct_time = time();
$time_delay = 600;
$timecheck = time()-$time_delay;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sqls = $db->select_query(" select COUNT(ct_no) AS ct_count from ".TB_ACTIVEUSER." where ct_dd = '$ct_dd' AND ct_mm = '$ct_mm' AND ct_yyyy = '$ct_yyyy' AND ct_time >= '$timecheck' ");
@$rows = @$db->rows($sqls);
return @$rows;
}


///////////////// stat
function StatScore_GoodClass($area="",$code="",$class="",$cn=""){
	global $db;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	@$res['num'] = $db->select_query("select stu_id,stu_pic,stu_pid,stu_num,stu_name,stu_sur,class_name,stu_class,sum(goodtail_point) as GO  from ".TB_GOOD." ,".TB_STUDENT.",".TB_GOODTAIL.",".TB_CLASS." where stu_area='".$area."' and stu_code='".$code."' and stu_id=good_stu and good_tail=goodtail_id and class_id=stu_class and stu_class='".$class."' and stu_cn='".$cn."'  and stu_suspend ='0' group by stu_class,stu_cn "); 
	@$arr['num'] = $db->fetch(@$res['num']);

	if(@$arr['num']['GO']){
		return @$arr['num']['GO'];
	} else {
		return '0';
	}

}

function StatScore_BadClass($area="",$code="",$class="",$cn=""){
	global $db;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	@$res['num'] = $db->select_query("select stu_id,stu_pic,stu_pid,stu_num,stu_name,stu_sur,class_name,stu_class,sum(badtail_point) as GO  from ".TB_BAD." ,".TB_STUDENT.",".TB_BADTAIL.",".TB_CLASS." where stu_area='".$area."' and stu_code='".$code."' and stu_id=bad_stu and bad_tail=badtail_id and class_id=stu_class and stu_class='".$class."' and stu_cn='".$cn."'  and stu_suspend ='0' group by stu_class,stu_cn "); 
	@$arr['num'] = $db->fetch(@$res['num']);

	if(@$arr['num']['GO']){
		return @$arr['num']['GO'];
	} else {
		return '0';
	}

}


function StatScore_GoodClass_PerStu($area="",$code="",$class="",$cn="",$stu=""){
	global $db;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	@$res['num'] = $db->select_query("select stu_id,stu_pic,stu_pid,stu_num,stu_name,stu_sur,class_name,stu_class,sum(goodtail_point) as GO  from ".TB_GOOD." ,".TB_STUDENT.",".TB_GOODTAIL.",".TB_CLASS." where stu_area='".$area."' and stu_code='".$code."' and stu_id=good_stu and good_tail=goodtail_id and class_id=stu_class and stu_class='".$class."' and stu_cn='".$cn."' and stu_id='".$stu."'  and stu_suspend ='0' group by stu_class,stu_cn "); 
	@$arr['num'] = $db->fetch(@$res['num']);

	if(@$arr['num']['GO']){
		return @$arr['num']['GO'];
	} else {
		return '0';
	}

}

function StatScore_BadClass_PerStu($area="",$code="",$class="",$cn="",$stu=""){
	global $db;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	@$res['num'] = $db->select_query("select stu_id,stu_pic,stu_pid,stu_num,stu_name,stu_sur,class_name,stu_class,sum(badtail_point) as GO  from ".TB_BAD." ,".TB_STUDENT.",".TB_BADTAIL.",".TB_CLASS." where stu_area='".$area."' and stu_code='".$code."' and stu_id=bad_stu and bad_tail=badtail_id and class_id=stu_class and stu_class='".$class."' and stu_cn='".$cn."' and stu_id='".$stu."' and stu_suspend ='0' group by stu_class,stu_cn "); 
	@$arr['num'] = $db->fetch(@$res['num']);

	if(@$arr['num']['GO']){
		return @$arr['num']['GO'];
	} else {
		return '0';
	}

}
?>