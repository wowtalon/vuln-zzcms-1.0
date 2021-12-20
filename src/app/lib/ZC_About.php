<?php
	class about{
	
		var $db;	
			
		function __construct(){
			global $db;
			$this->db=&$db;
		}	
		//调用单页内容
		function about_content($id){	
			$row=$this->db->get_one("select * from `".PRE."about` where id=$id");
			return $row['content'];
		}
		
		//调用单页内容
		function about($name){	
			$row=$this->db->get_one("select * from `".PRE."about` where `name`='$name'");
			return $row['content'];
		}
		
		//调用单页图片
		function about_pic($id){
			$row=$this->db->get_one("select * from `".PRE."about` where id=$id");
			return "<img src='".$row['spic']."' width='120' height='260' alt='".$row['smalltext']."' longdesc='about.php?id=".$row['id']."' />";			
		}
		
		
		//调用单页名字
		function about_name($id){
			$row=$this->db->get_one("select * from `".PRE."about` where id=$id");
			return $row['name'];		
		}
		
		//取得单页ID
		function about_id($id){
			$rs=$this->db->get_one("select * from `".PRE."about` where `cid`=$id");
			return $rs['id'];			
		}
		
		//取得各字段的值
		function get_row($id){
			$rs=$this->db->get_one("SELECT a.name,a.title,a.pic,a.content,b.keywords,b.smalltext FROM `".PRE."about` a, `".PRE."type` b WHERE a.cid=b.id and a.id=$id");
			return $rs;								  	
		}
	
	}
?>