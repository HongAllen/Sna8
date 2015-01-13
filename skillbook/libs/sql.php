<?PHP #資料庫連線
class sql {

	var $sqllink;
	var $result;
	var $resultset;
	var $string;
	var $datetime;


	var $db_host;
	var $db_name;
	var $db_user;
	var $db_password;

	function sql($db_host='',$db_name='',$db_user='',$db_password='') {
		$this->db_host=$db_host;
		$this->db_name=$db_name;
		$this->db_user=$db_user;
		$this->db_password=$db_password;
		$this->sqllink = mysql_connect($this->db_host,$this->db_user,$this->db_password) or die ("Can't Connect");
		mysql_select_db($this->db_name) or die("Could not select database ". $this->dbname);
		mysql_unbuffered_query("SET NAMES 'utf8'");
	}

	function query($sqlstr='',$display=false) {
		if ($display) { echo $sqlstr; }
		$this->resultset = array();
		if (strpos(strtoupper(" ".$sqlstr),'SELECT') === false) {
			$result = mysql_unbuffered_query("select * from $sqlstr",$this->sqllink);
		} else {
			$result = mysql_unbuffered_query($sqlstr,$this->sqllink);
		}
		if (!empty($result)) {
			$i = 0;
			while($record=mysql_fetch_assoc($result)){ $this->resultset[$i] = $record; $i++; }
			mysql_free_result($result);
		}
		return $this->resultset;
	}

	function execute($sqlstr='',$display=false) {
		if (!empty($sqlstr)) { mysql_unbuffered_query($sqlstr); }
		if ($display) { pr($sqlstr); }
		if (strpos($sqlstr,"insert") !== false) { return mysql_insert_id();	}
	}

	function binddata($table_name='',$data=null,$condition='',$display=false) {
		if (!empty($table_name) && !empty($data)) {
			if (empty($condition)) {
				$keys = implode(',',array_keys($data)); $values = "'".implode("','",array_values($data))."'";
				$str = "insert into $table_name($keys) values($values)";
				if ($display) {pr($str);}
				return $this->execute($str);
			} else {
				$keys = array_keys($data); $update = array();
				for ($i=0;$i<count($keys);$i++) { $update[] = $keys[$i]." = '".$data[$keys[$i]]."' "; }
				$update_str = implode(',',$update);
				$str = "update $table_name set $update_str where $condition";
				$this->execute($str);
				
				if ($display) {pr($str);}
				
				$str = "select * from $table_name where 1=1 ";
				for ($i=0;$i<count($keys);$i++) { $str .= " and ".$keys[$i]." = '".$data[$keys[$i]]."' "; }
				$arr = $this->query($str);

				return (!empty($arr))? true : false  ;
			}
		}
	}
	
	function close() {
		@mysql_close($this->sqllink);
	}

	function __destruct(){
		@mysql_close($this->sqllink);
	}
}
?>