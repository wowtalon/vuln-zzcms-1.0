<?php
class mysql {
	
	public $fetch_mode=MYSQL_ASSOC;//取记录集时所用的模式
	public $record=array();//一条记录数组

	function __construct() {
		$this->connect();
	}

	//建立数据库连接
	function connect() {
		$link = @mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("数据库配置信息错误：数据库地址，用户名或者密码不正确");
		mysql_query("SET NAMES utf8");
		mysql_select_db(DB_DATE, $link) or die("未能找到数据库：" . DB_DATE);
	}

	//执行SQL语句
	function query($sql) {
		return mysql_query($sql);
	}

	//取得结果集中行的数目
	function num_rows($result) {
		return mysql_num_rows($result);
	}

	//取得上一次数据库操作影响的条数
	function affected_rows() {
		return mysql_affected_rows();
	}

	//取得结果集中字段的数目
	function num_fields($result) {
		return mysql_num_fields($result);
	}

	//释放结果内存
	function free_result($result) {
		return mysql_free_result($result);
	}

	//取得上一步 INSERT 操作产生的 ID
	function insert_id() {
		return mysql_insert_id();
	}

	//关闭结果集
	function close() {
		return mysql_close();
	}

	//从结果集中取得一行作为数组
	function fetch_array($result) {
		if($result){
			return mysql_fetch_array($result, $this->fetch_mode);
		}else{
			return null;
		}		
	}


	//取出一条记录
	function fetch_row($rs){
		$this->record=mysql_fetch_array($rs,$this->fetch_mode);
		return $this->record;
	}

	//取出所有记录
	function fetch_all($rs){
		$arr=array();
		while($this->record=mysql_fetch_array($rs,$this->fetch_mode)){
			$arr[]=$this->record;
		}
		return $arr;
	}
	
	//得到主键
	function get_primary($table){
		$result = $this->query("SHOW COLUMNS FROM ".PRE."$table");
		while($row = $this->fetch_array($result)){
			if($row['Key'] == 'PRI') break;
		}
		return $row['Field'];
	}
	
	function get_one($sql){
		$query = $this->query($sql);
		$rs = $this->fetch_array($query);
		$this->free_result($query);
		return $rs ;
	}}
?>
