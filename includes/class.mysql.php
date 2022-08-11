<?
/*
	ชื่อไฟล์					class.mysql.php
	การใช้งาน				ใช้ในการเชื่อมต่อฐานข้อมูล MySQL
	ผู้เขียน					อัษฎา อินต๊ะ
	ติดต่อ					webmaster@mocyc.com
*/
if (preg_match("/class.mysql.php/i",$_SERVER['PHP_SELF'])) {
    Header("Location: ../index.php");
    die();
}

class DB{
	////////////////////// ฟังก์ชั่นต่างๆ //////////////////////
	//เชื่อมต่อดาต้าเบส
	public function connectdb($db_name="",$user="",$pwd=""){
			$this->username = $user;
			$this->password = $pwd;
			$this->database = $db_name;
			$this->host = 'localhost';
			$mysqli =new mysqli ($this->host, $this->username, $this->password,$this->database);
			$mysqli->set_charset('utf8');
			$this->connect_db=$mysqli;
		return true; 
	}

	//ปิดการเชื่อมต่อดาต้าเบส
	public function closedb( ){
		mysqli_close ( $this->connect_db ) or $this->_error();
	}

	//เพิ่มข้อมูล
	//$db->add_db("table",array("field"=>"value")); 
	public function add_db($table="table", $data="data"){
		$key = array_keys($data); 
        $value = array_values($data); 
		$sumdata = count($key); 
		for ($i=0;$i<$sumdata;$i++) 
        { 
            if (empty($add)){ 
                $add="("; 
            }else{ 
                $add=$add.","; 
            } 
            if (empty($val)){ 
                $val="("; 
            }else{ 
                $val=$val.","; 
            } 
            $add=$add.$key[$i]; 
            $val=$val."'".$value[$i]."'"; 
        } 
        $add=$add.")"; 
        $val=$val.")"; 
        $sql="INSERT IGNORE INTO ".$table." ".$add." VALUES ".$val; 
        if (mysqli_query($this->connect_db,$sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
	}

	//แก้ไขข้อมูลแบบหลายฟิลล์ 
	//$db->update_db("tabel",array("field"=>"value"),"where"); 
    public function update_db($table="table",$data="data",$where="where"){ 
        $key = array_keys($data); 
        $value = array_values($data); 
        $sumdata = count($key); 
        $set=""; 
        for ($i=0;$i<$sumdata;$i++) 
        { 
            if (!empty($set)){ 
                $set=$set.","; 
            } 
            $set=$set.$key[$i]."='".$value[$i]."'"; 
        } 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 
        if (mysqli_query($this->connect_db,$sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	//แก้ไขข้อมูลแบบฟิลล์เดียว
	//$db->update("table","set","where");
	public function update($table="table",$set="set",$where="where"){ 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 
        if (mysqli_query($this->connect_db,$sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	//ลบข้อมูล
	//$db->del("table","where"); 
    public function del($table="table",$where="where"){ 
        $sql="DELETE FROM ".$table." WHERE ".$where; 
        if (mysqli_query($this->connect_db,$sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	//นับจำนวนแถวข้อมูล
	//$db->num_rows("table","field","where"); 
    public function num_rows($table="table",$field="field",$where="where") { 
        if ($where=="") { 
            $where = ""; 
        } else { 
            $where = " WHERE ".$where; 
        } 
        $sql = "SELECT ".$field." FROM ".$table.$where; 
        if($res = mysqli_query($this->connect_db,$sql)){ 
            return mysqli_num_rows($res);
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	//Query ข้อมูล
	//$res = $db->select_query('SELECT field FROM table WHERE where'); 
    public function select_query($sql="sql"){ 
        if ($res = mysqli_query($this->connect_db,$sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	//นับจำนวนแถวข้อมูล
	//$res = $db->select_query('SELECT field FROM table WHERE where'); 
	//$rows = $db->rows($res); 
    public function rows($sql="sql"){ 
//	  $link=mysqli_query($this->connect_db,$sql);
      if ($res = mysqli_num_rows($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	//ดึงค่า array
	//$res = $db->select_query('SELECT field FROM table WHERE where'); 
	//while ($arr = $db->fetch($res)) { 
	//		echo $arr['a']." - ".$arr['c']."<br>\n"; 
	//}
    public function fetch($sql="sql"){ 
      if ($res = mysqli_fetch_assoc($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	public function sql_fetchrow($sql="sql")
	{
		if(!$sql)
		{
			$sql = $db->mysqli_query;
		}
		if($sql)
		{
			$result=mysqli_query($this->connect_db,$sql);
			return mysqli_fetch_array($result,'');
		}
		else
		{
			return false;
		}
	}


	public function sql_fetch_row($sql="sql")
	{
		if(!$sql)
		{
			$sql = $db->mysqli_query;
		}
		if($sql)
		{
			//$result=mysqli_query($this->connect_db,$sql);
			return mysqli_fetch_row($sql);
		}
		else
		{
			return false;
		}
	}


	//แสดงข้อความผิดพลาด
    function _error(){ 
        $this->error[]=mysqli_connect_error(); 
    } 

	function getErrorMsg() {
		return str_replace( array( "\n", "'" ), array( '\n', "\'" ), $this->_errorMsg );
	}

}
?>