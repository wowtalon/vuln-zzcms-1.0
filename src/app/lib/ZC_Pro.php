<?php
class product{
	function __construct(){
	}
	
	//显示产品列表
	//参数 lm:栏目名 0:调用全部产品
	//ts:条数 0：全部调用
	//zs:标题字数 
	//is_top:是否置顶 1：为置顶，0为不置顶
	//is_hot:是否热闹 1：为热门，0为不热门
	//sort:排序方式 0：按点击数从高到低 1：ID从低到高，2：ID从高到低，3：按时间从低到高，4按时间从高到低
	//pagesize:分页大小 0为不分页
	//datetype:日期类型 0：不显示 值：1-5
	//注意：当ts设置不为0时，分页不显示
	function pro_list($lm,$ts,$zs,$is_top,$is_hot,$sort,$pagesize,$datetype){
		$db=new mysql();
		$type=new type();
		$arr=array();
		if($lm==0){
			$sql="select * from `".PRE."pro`";		
		}else{
			$sql="select * from `".PRE."pro` where `cid` in (".$type->array_classid($lm).")";
		}
		
		if($is_top==1){
			if(substr_count($sql,'where')<1){
				$sql.=" where `is_top`=".$is_top;
			}else{
				$sql.=" and `is_top`=".$is_top;
			}			
		}
		if($is_hot==1){
			if(substr_count($sql,'where')<1){
				$sql.=" where `is_hot`=".$is_hot;
			}else{
				$sql.=" and `is_hot`=".$is_hot;
			}
		}
		switch($sort){
			case 1:
				$sql.=" order by `id`";
				break;
			case 2:
				$sql.=" order by `id` desc";
				break;
			case 3:
				$sql.=" order by `time`";
				break;
			case 4:
				$sql.=" order by `time` desc";
				break;	
			default :
				$sql.=" order by `hits` desc";
		}
		
		if($ts==0){
			if($pagesize!=0){
			$arr=get_page_num($sql,$pagesize);
			$sql.=" limit $arr[1], $pagesize";
		}
		}else{
			$sql.=" limit ".$ts;
		}
		$rs=$db->query($sql) or die (showmsg("前台显示产品列表错误"));
		$show="";
		while($row = $db->fetch_array($rs)){
			$show.="<li><a href=Pro_Show.php?id=".$row['id'].">".str_len($row['title'],$zs)."</a>";
			if($datetype!=0){
				$show.=format_date($row['time'],$datetype);
			}
			$show.="</li>";
		}
		if($pagesize!=0&&$ts==0){
			$page=new page($arr[0],$pagesize);
			$show.=$page->page();
		}
		return $show;
	}
	
	//显示产品列表
	//参数 lm:栏目名 0:调用全部产品
	//ts:条数 0：全部调用
	//zs:标题字数 
	//ls：按几列排列
	//is_top:是否置顶 1：为置顶，0为不置顶
	//is_hot:是否热闹 1：为热门，0为不热门
	//sort:排序方式 0：按点击数从高到低 1：ID从低到高，2：ID从高到低，3：按时间从低到高，4按时间从高到低
	//pro_w:产品宽度
	//pro_h:产品高度
	//pagesize:分页大小 0为不分页
	//datetype:日期类型 0：不显示 值：1-5
	//注意：当ts设置不为0时，分页不显示
	function getpic($lm,$ts,$zs,$ls,$is_top,$is_hot,$sort,$pro_w,$pro_h,$pagesize){
		global $db,$type;
		$arr=array();
		if($lm==0){
			$sql="select * from `".PRE."pro`";		
		}else{
			$sql="select * from `".PRE."pro` where `cid` in (".$type->array_classid($lm).")";
		}
		
		if($is_top==1){
			if(substr_count($sql,'where')<1){
				$sql.=" where `is_top`=".$is_top;
			}else{
				$sql.=" and `is_top`=".$is_top;
			}			
		}
		if($is_hot==1){
			if(substr_count($sql,'where')<1){
				$sql.=" where `is_hot`=".$is_hot;
			}else{
				$sql.=" and `is_hot`=".$is_hot;
			}
		}
		if(substr_count($sql,'where')<1){
			$sql.=" where `pic` <>''";
		}else{
			$sql.=" and `pic` <>''";
		}
		switch($sort){
			case 1:
				$sql.=" order by `id`";
				break;
			case 2:
				$sql.=" order by `id` desc";
				break;
			case 3:
				$sql.=" order by `time`";
				break;
			case 4:
				$sql.=" order by `time` desc";
				break;	
			default :
				$sql.=" order by `hits` desc";
		}
		
		if($ts==0){
			if($pagesize!=0){
			$arr=get_page_num($sql,$pagesize);
			$sql.=" limit $arr[1], $pagesize";
		}
		}else{
			$sql.=" limit ".$ts;
		}
		$show="<li>\r\n";
		$rs=$db->query($sql) or die (showmsg("前台显示产品列表错误"));
		$i=1;
		while($row = $db->fetch_array($rs)){			
			$show.="<span><a href=Pro_Show.php?id=".$row['id']."><img src=".$row['spic']." width=".$pro_w." height=".$pro_h." alt=".$row['title']." /></a><br />";				
			$show.="<h5><a href=Pro_Show.php?id=".$row['id'].">".$row['title']."</a></h5></span>\r\n";	
			if($i%$ls==0){
				$show.="</li><li>\r\n";
			}
			$i++;
		}
		$show.="</li>\r\n";
		if($pagesize!=0&&$ts==0){
			$page=new page($arr[0],$pagesize);
			$show.=$page->page();
		}
		return $show;		
	}
	
	//产品内容显示
	function pro_content($id){
		global $db,$is_seo;
		$db->query("update `".PRE."pro` set `hits`=`hits`+1 where id=$id") or die (showmsg("更新点击数出现错误!"));
		$sql="select * from `".PRE."pro` where id=$id";
		$rs=$db->query($sql) or die (showmsg("显示产品内容出现错误!"));
		$str="";
		while($row=$db->fetch_array($rs)){
			$str.="<div class=\"product\">";
			$img=$content=$pres="";
			if($row['pic']<>""){
				$img="<img src=\"".$row['pic']."\" alt=\"".$row['title']."\" />";
			}else{
				$img="<img src=\"nopic.gif\" />";
			}
			if($is_seo){
				include(ZZCMS_ROOT."data/system_keyword.php");
				$content=strtr($row['content'],$keyword_system);
			}else{
				$content=$row['content'];
			}
			$pres=$this->next_pro($row['id'])."<br/>".$this->pre_pro($row['id']);
			$str.="	<div class=\"product_img\">$img</div>";
			$str.="	<div class=\"product_sx\">产品名称：".$row['title']."<br />产品型号：".$row['xh']."<br />".area_clean($row['more'])."</div>";
			$str.="	<div class=\"product_con\">$content</div>";		
			$str.="	<div class=\"product_pre\">$pres</div>";
			$str.="</div>";		
		}
		return $str;
	}
	
	//上一张
	function pre_pro($id){
		global $db;
		$sql="select * from `".PRE."pro` where id<".$id." order by id desc limit 1";
		$rs=$db->query($sql) or die (showmsg("调用上一张出现错误"));
		if(is_array($row=$db->fetch_array($rs))){
			return "上一张:<a href='Pro_Show.php?id=".$row['id']."'>".$row['title']."</a>";
		}else{
			return "上一张:没有了";
		}
	}
	
	//下一张
	function next_pro($id){
		global $db;
		$sql="select * from `".PRE."pro` where id>".$id." limit 1";
		$rs=$db->query($sql) or die (showmsg("调用下一张出现错误"));
		if(is_array($row=$db->fetch_array($rs))){
			return "下一张:<a href='Pro_Show.php?id=".$row['id']."'>".$row['title']."</a>";
		}else{
			return "下一张:没有了";
		}
	}
	
	//当前栏目为叶子目录时，显示置顶产品，否则显示下级目录名
	function class_or_article($id){
		global $type;
		if(!$type->is_leaf($id)){
			echo $type->child_class($id,2);
		}else{
			echo $this->show_top($id);
		}
	}
	
	//显示当前目录下的置顶产品
	function show_top($id){
		global $db;
		if(empty($id)){
			$sql="select * from `".PRE."pro` where is_top =1";
		}else{
			$sql="select * from `".PRE."pro` where is_top =1 and cid=".$id;
		}	
		$rs=$db->query($sql) or die (showmsg("显示当前栏目下置顶产品出现错误"));	
		$show.="";
		while($row=$db->fetch_array($rs)){
			$show.="<li><a href='Pro_Show.php?id=".$row['id']."'>".$row['title']."</a></li>";
		}
		return $show;
	}
	
	//取得各字段的值
	function get_row($id){
		global $db;
		$sql="select * from `".PRE."pro` where id=".$id;
		$rs=$db->query($sql) or die (showmsg("获取产品内容出现错误!"));	
		if(is_array($row=$db->fetch_array($rs))){
			return $row;								  	
		}		
	}
	
	//显示路径
	function pro_path($id){
		global $db,$type;
		$sql="select * from `".PRE."pro` where id=".intval($id);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			echo $type->class_path($row['cid']);
		}
	}
	
}
?>