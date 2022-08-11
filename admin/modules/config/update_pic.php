<?
//CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);
		$dir=opendir("../img/stu");
		$file="";
		$a=0;
//		$i=0;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$iNumber = 0;
$aImages = array();
		while (($file=readdir($dir))==true) {
//		print $file ."<br>";
		if (($file!=".")&&($file!="..")&&($file!="Thumbs.db")) { 
		$a+=$file;
		$aImages[$iNumber]=$file;
		$sql1=$db->select_query("update  ".TB_STUDENT."  set stu_pic='".$aImages[$iNumber]."' where stu_id='".$aImages[$iNumber]."' ");
		@$result1= $db->fetch($sql1);
//		echo $aImages[$iNumber];
 			$iNumber++;
		}
}

echo "<br><h3>update ข้อมูลเรียนร้อยแล้ว <br></font>" ;
echo "<br><a href='index.php?name=config&file=student&route=config/student'>กลับรายการเดิม</a></font>" ;

?>