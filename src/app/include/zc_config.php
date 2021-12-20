<?php
//下载频道所用数组及函数
	$down_run = array (
	  1 => '2003/XP',
	  2 => 'Win2000/NT',
	  3 => 'Win7',
	  4 => 'Vista',
	  5 => 'Linux/UNIX',
	  6 => '其他',
	);
	$down_copyright = array (
	  1 => '免费版',
	  2 => '共享版',
	  3 => '收费版',
	  4 => '授权版',
	  5 => '白金版',
	  6 => '钻石版',
	);
	$down_language = array (
	  1 => '简体中文',
	  2 => '繁体中文',
	  3 => '英文',
	  4 => '日文',
	  5 => '其他',
	);
	$down_type = array (
	  1 => '国产软件',
	  2 => '国外软件',
	  3 => '其他',
	);
	
	function down_copyright($id){
		global $down_copyright;
		$str="";
		foreach($down_copyright as $k=>$v){
			if($k==intval($id)){
				$str.="<option value=\"$k\" selected=\"selected\">$v</option>\r\n";
			}else{
				$str.="<option value=\"$k\">$v</option>\r\n";
			}
		}
		return $str;
	}
	
	function down_run($id){
		global $down_run;
		$str="";
		foreach($down_run as $k=>$v){
			if($k==intval($id)){
				$str.="<option value=\"$k\" selected=\"selected\">$v</option>\r\n";
			}else{
				$str.="<option value=\"$k\">$v</option>\r\n";
			}
		}
		return $str;
	}
	
	function down_type($id){
		global $down_type;
		$str="";
		foreach($down_type as $k=>$v){
			if($k==intval($id)){
				$str.="<option value=\"$k\" selected=\"selected\">$v</option>\r\n";
			}else{
				$str.="<option value=\"$k\">$v</option>\r\n";
			}
		}
		return $str;
	}
	
	function down_language($id){
		global $down_language;
		$str="";
		foreach($down_language as $k=>$v){
			if($k==intval($id)){
				$str.="<option value=\"$k\" selected=\"selected\">$v</option>\r\n";
			}else{
				$str.="<option value=\"$k\">$v</option>\r\n";
			}
		}
		return $str;
	}
?>