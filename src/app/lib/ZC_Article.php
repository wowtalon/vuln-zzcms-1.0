<?php
class article {

	//构造方法
	function __construct() {
	}
	
	//显示文章列表
	//参数 lm:栏目名 0:调用全部文章
	//ts:条数 0：全部调用
	//zs:标题字数 
	//is_top:是否置顶 1：为置顶，0为不置顶
	//is_hot:是否热闹 1：为热门，0为不热门
	//sort:排序方式 0：按点击数从高到低 1：ID从低到高，2：ID从高到低，3：按时间从低到高，4按时间从高到低
	//pagesize:分页大小 0为不分页
	//datetype:日期类型 0：不显示 值：1-5
	//注意：当ts设置不为0时，分页不显示
	function art_list($lm,$ts,$zs,$is_top,$is_hot,$sort,$pagesize,$datetype){
		
		$db=new mysql();
		$type=new type();
		$arr=array();
		if($lm==0){
			$sql="select * from `".PRE."article`";		
		}else{
			$sql="select * from `".PRE."article` where `cid` in (".$type->array_classid($lm).")";
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
		$rs=$db->query($sql) or die (showmsg("前台显示文章列表错误"));
		$show="";
		while($row = $db->fetch_array($rs)){
			$show.="<li>";
            $show.="<span><a href=\"Art_Show.php?id=".$row['id']."\" title=\"".$row['title']."\">".str_len($row['title'],$zs)."</a></span>";
			 if($datetype!=0){
			 	$show.="<p>".format_date($row['time'],$datetype)."</p>";
			 }
			$show.="</li>\r\n";
		} 
		if($pagesize!=0&&$ts==0){
			$page=new page($arr[0],$pagesize);
			$show.=$page->page();
		}
		return $show;
	}
	
	
	//显示文章列表
	//参数 lm:栏目名 0:调用全部文章
	//ts:条数 0：全部调用
	//zs:标题字数 
	//ls：按几列排列
	//is_top:是否置顶 1：为置顶，0为不置顶
	//is_hot:是否热闹 1：为热门，0为不热门
	//sort:排序方式 0：按点击数从高到低 1：ID从低到高，2：ID从高到低，3：按时间从低到高，4按时间从高到低
	//pic_w:图片宽度
	//pic_h:图片高度
	//pagesize:分页大小 0为不分页
	//datetype:日期类型 0：不显示 值：1-5
	//注意：当ts设置不为0时，分页不显示
	function art_pic($lm,$ts,$zs,$ls,$is_top,$is_hot,$sort,$pic_w,$pic_h,$pagesize){
		$db=new mysql();
		$type=new type();
		$arr=array();
		if($lm==0){
			$sql="select * from `".PRE."article`";		
		}else{
			$sql="select * from `".PRE."article` where `cid` in (".$type->array_classid($lm).")";
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
		$rs=$db->query($sql) or die (showmsg("前台显示文章列表错误"));
		$i=1;
		while($row = $db->fetch_array($rs)){			
			$show.="<span><img src=\"".$row['spic']." width=".$pic_w." height=".$pic_h." alt=".$row['title']."\" /><br />";	
			$show.="<a href=\"Art_Show.php?id=".$row['id']."\">".str_len($row['title'],$zs)."</a></span>\r\n";
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
	
	//文章内容显示
	  function art_content($id){
			global $db,$is_seo;
			$db->query("update `".PRE."article` set `hits`=`hits`+1 where id=".$id) or die (showmsg("更新点击数出现错误!"));
			$sql="select * from `".PRE."article` where id=".$id;
			$rs=$db->query($sql) or die (showmsg("显示文章内容出现错误!"));
			while($row=$db->fetch_array($rs)){
			?>
                <div class="s_title"><?php echo $row['title']?></div>
                <hr />
                <div class="s_title">
                    <div class="s_right">点击：<?php echo $row['hits']?>次</div>
                    <div class="s_right">时间：<?php echo format_date($row['time'],3)?></div>
                </div>
                <div class="s_content">
				<?php 
				if($is_seo){
					include(ZZCMS_ROOT."data/system_keyword.php");
					echo $row['content']=strtr($row['content'],$keyword_system);
				}else{
					echo $row['content'];
				}
				?></div>
                <div>
                    <div class="p_right"><?php echo $this->next_art($row['id'])?></div>
                    <div class="p_right"><?php echo $this->pre_art($row['id'])?></div>
                </div>
            <?php
			}
		}
	
	//当前栏目为叶子目录时，显示置顶文章，否则显示下级目录名
	function class_or_article($id){
		global $type;
		if(!$type->is_leaf($id)){			
			echo $type->child_class($id,1);
		}else{
			echo $this->show_top($id);
		}
	}
	
	//上一篇
	function pre_art($id){
		global $db;
		$sql="select * from `".PRE."article` where id<".$id." order by id desc limit 1";
		$rs=$db->query($sql) or die (showmsg("调用上一张出现错误"));
		if(is_array($row=$db->fetch_array($rs))){
			return "上一篇:<a href='Art_Show.php?id=".$row['id']."'>".$row['title']."</a>";
		}else{
			return "上一篇:没有了";
		}
	}
	
	//下一篇
	function next_art($id){
		global $db;
		$sql="select * from `".PRE."article` where id>".$id." limit 1";
		$rs=$db->query($sql) or die (showmsg("调用下一张出现错误"));
		if(is_array($row=$db->fetch_array($rs))){
			return "下一篇:<a href=\"Art_Show.php?id=".$row['id']."\">".$row['title']."</a>";
		}else{
			return "下一篇:没有了";
		}
	}
	
	//显示当前目录下的置顶文章
	function show_top($id){
		global $db;
		if(empty($id)){
			$sql="select * from `".PRE."article` where `is_top` =1";
		}else{
			$sql="select * from `".PRE."article` where `is_top` =1 and cid=".$id;
		}		
		$rs=$db->query($sql) or die (showmsg("显示当前栏目下置顶文章出现错误"));	
		while($row=$db->fetch_array($rs)){
		?>
			<li><a href="Art_Show.php?id=<?php echo $row['id']?>"><?php echo $row['title']?></a></li>
		<?php } 
	}
	
	//取得各字段的值
	function get_row($id){
		global $db;
		$sql="select * from `".PRE."article` where id=$id";
		$rs=$db->query($sql);
		if(is_array($row=$db->fetch_array($rs))){
			return $row;								  	
		}		
	}
	
	//显示路径
	function art_path($id){
		global $db,$type;
		$sql="select * from `".PRE."article` where id=".$id;
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			echo $type->class_path($row['cid']);
		}
	}
		
		
}
?>