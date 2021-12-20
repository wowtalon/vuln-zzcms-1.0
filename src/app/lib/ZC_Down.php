<?php
class down{
	function __construct(){
	}
	
	//显示下载列表
	//参数 lm:栏目名 0:调用全部下载
	//ts:条数 0：全部调用
	//zs:标题字数 
	//is_top:是否置顶 1：为置顶，0为不置顶
	//is_hot:是否热闹 1：为热门，0为不热门
	//sort:排序方式 0：按点击数从高到低 1：ID从低到高，2：ID从高到低，3：按时间从低到高，4按时间从高到低
	//pagesize:分页大小 0为不分页
	//datetype:日期类型 0：不显示 值：1-5
	//注意：当ts设置不为0时，分页不显示
	function list_down($lm,$ts,$zs,$is_top,$is_hot,$sort,$pagesize,$datetype){
		$db=new mysql();
		$type=new type();
		$arr=array();
		if($lm==0){
			$sql="select * from `".PRE."down`";		
		}else{
			$sql="select * from `".PRE."down` where `cid` in (".$type->array_classid($lm).")";
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
				$sql.=" where `is_hot`=".$is_top;
			}else{
				$sql.=" and `is_hot`=".$is_top;
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
		$show="";
		$rs=$db->query($sql) or die (showmsg("前台显示下载列表错误"));
		while($row = $db->fetch_array($rs)){
			$show.="<li><span><a href=\"Down_Show.php?id=".$row['id']."\">".str_len($row['title'],$zs)."</a></span>";
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
	
	//显示下载列表
	//参数 lm:栏目名 0:调用全部下载
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
	function getpic($lm,$ts,$zs,$ls,$is_top,$is_hot,$sort,$pic_w,$pic_h,$pagesize){
		$db=new mysql();
		$type=new type();
		$arr=array();
		if($lm==0){
			$sql="select * from `".PRE."down`";		
		}else{
			$sql="select * from `".PRE."down` where `cid` in (".$type->array_classid($lm).")";
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
				$sql.=" where `is_hot`=".$is_top;
			}else{
				$sql.=" and `is_hot`=".$is_top;
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
		$rs=$db->query($sql) or die (showmsg("前台显示下载列表错误"));
		$i=1;
		while($row = $db->fetch_array($rs)){			
			$show.="<span><a href=\"Down_Show.php?id=".$row[id]."><img src=".ZZCMS.$row[spic]." width=".$pic_w." height=".$pic_h." alt=".$row[title]."\" /></a><br />";	
			$show.="<h5><a href=Pic_Show.php?id=".$row['id'].">".$row['title']."</a></h5></span>";	
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
	
	//下载内容显示
	function down_content($id){
		global $db,$is_seo,$down_run,$down_copyright,$down_language,$down_type;
		$sql="select * from `".PRE."down` where id=$id";
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
		?>
            <div>
                <div class="d_title"><?php echo $row['title']?></div>
                <div  class="d_title">
                    <div class="d_left">软件大小:<?php echo $row['size']?>K</div>
                    <div class="d_left">软件类别：<?php echo $down_type[$row['type']]?></div>
                </div>
                <div  class="d_title">
                    <div class="d_left">下载次数：<?php echo $row['hits']?>次</div>
                    <div class="d_left">软件授权：<?php echo $down_copyright[$row['copyright']]?></div>
                </div>
                <div  class="d_title">
                    <div class="d_left">软件语言：<?php echo $down_language[$row['lang']]?></div>
                    <div class="d_left">运行环境：<?php echo $down_run[$row['run']]?></div>
                </div>
                <div  class="d_title">
                    <div class="d_left">软件评级：<img src="images/level<?php echo $row['grade']?>.gif" /></div>
                    <div class="d_left">更新时间：<?php echo format_date($row['time'],3)?></div>
                </div>
                <div  class="d_title">
                    <div class="d_left">开发商：<a href="http://<?php echo $row['befrom']?>" target="_blank">查看</a></div>
                    <div class="d_left">联系人：<?php echo $row['writer']?></div>
                </div>
                <div  class="d_url">下载地址：<a href=downfile.php?id=<?php echo $row['id']?>>点击下载</a></div>
                <div class="d_content">
				<?php 
				if($is_seo){
					include(ZZCMS_ROOT."data/system_keyword.php");
					echo $row['content']=strtr($row['content'],$keyword_system);
				}else{
					echo $row['content'];
				}
				?>
                </div>
             <div>
                <div class="p_right"><?php echo $this->next_down($row['id'])?></div>
                 <div class="p_right"><?php echo $this->pre_down($row['id'])?></div>
             </div>
            </div>
        <?php
		}
	}
	
	//上一篇
	function pre_down($id){
		global $db;
		$sql="select * from `".PRE."down` where id<".$id." order by id desc limit 1";
		$rs=$db->query($sql) or die (showmsg("调用上一张出现错误"));
		if(is_array($row=$db->fetch_array($rs))){
			return "上一篇:<a href=\"Down_Show.php?id=".$row['id']."\">".$row['title']."</a>";
		}else{
			return "上一篇:没有了";
		}
	}
	
	//下一篇
	function next_down($id){
		global $db;
		$sql="select * from `".PRE."down` where id>".$id." limit 1";
		$rs=$db->query($sql) or die (showmsg("调用下一张出现错误"));
		if(is_array($row=$db->fetch_array($rs))){
			return "下一篇:<a href=\"Down_Show.php?id=".$row['id']."\">".$row['title']."</a>";
		}else{
			return "下一篇:没有了";
		}
	}
	
	//当前栏目为叶子目录时，显示置顶下载，否则显示下级目录名
	function class_or_article($id){
		global $type;
		if(!$type->is_leaf($id)){
			echo $type->child_class($id,3);			
		}else{
			echo $this->show_top($id);
		}
	}
	
	//显示当前目录下的置顶下载
	function show_top($id){
		global $db;
		if(empty($id)){
			$sql="select * from `".PRE."down` where is_top =1";
		}else{
			$sql="select * from `".PRE."down` where is_top =1 and cid=$id";
		}	
		$rs=$db->query($sql) or die (showmsg("显示当前栏目下置顶下载出现错误"));	
		while($row=$db->fetch_array($rs)){
		?>
			<li><a href="Down_Show.php?id="<?php echo $row['id']?>"><?php echo $row['title']?></a></li>
		<?php }
	}
	
	//取得各字段的值
	function get_row($id){
		global $db;
		$sql="select * from `".PRE."down` where id=$id";
		$rs=$db->query($sql);
		if(is_array($row=$db->fetch_array($rs))){
			return $row;								  	
		}		
	}
	
	//显示路径
	function dwon_path($id){
		global $db,$type;
		$sql="select * from `".PRE."down` where id=$id";
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			echo $type->class_path($row['cid']);
		}
	}	
}
?>