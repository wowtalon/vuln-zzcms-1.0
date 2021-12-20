<?php
	//表缓存文件
	function cache_table($table,$fields='*',$is_one=false,$where='',$order='',$limit=0){
		global $db;
		$data=array();
		$keyfield = $db->get_primary($table);
		if($where) $where="where ".$where;
		if(!$order) $order=$keyfield;
		$limit = $limit ? "limit 0,$limit":'';
		$sql="select $fields from ".PRE."$table $where order by $order $limit";	
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			if($is_one){
				$data=$row;							
			}else{
				$key=$row[$keyfield];
				$data[$key]=$row;	
			}
		}
		cache_write($table.".php",$data);
	}
	
	function cache_about($table,$fields='*',$is_one=false,$where='',$order='',$limit=0){
		global $db;
		$keyfield = $db->get_primary($table);
		if($where) $where="where ".$where;
		if(!$order) $order=$keyfield;
		$limit = $limit ? "limit 0,$limit":'';
		$sql="select $fields from ".PRE."$table $where order by $order $limit";	
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			cache_write($table.$row['id'].".php",$row);
		}
	}
	
?>