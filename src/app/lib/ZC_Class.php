<?php


 		######################################################################################################
		##  栏目管理类 																						##
		##  URL： www.zzcms.com 																				##
		##	参数：type:栏目类别 1：文章，2：产品，3：下载，4：单页，5：友情连接										##
		##																									##
		######################################################################################################
class type {
	private $level = 1;//栏目深度值
	public $cls_order=0;//栏目顺序值
	public $num_level;
	public $cls_depth=0;
	private $class_name="";//显示类别路径时用到
	private $arr_cid=array();//类别ID数组	
	private $tables= array ();//模块对应表名数组
	private $zurl= array ();
	
	function __construct() {
		global $zzcms_url,$zzcms_table;
		$this->zurl=$zzcms_url;
		$this->tables=$zzcms_table;
	}

	
	//显示当前栏目的下级目录
	function child_class($id,$type){
		global $db;
		$sql="select * from `".PRE."type` where `type`=".intval($type)." and `fid`=".$id;
		$rs=$db->query($sql) or die (showmsg("查询下级目录出现错误"));
		?>
		<div class="title_bg">
			<div class="title_t">下级栏目</div>
			</div>
			<div class="main1_l_new_list">
			<?php while($row=$db->fetch_array($rs)){?>
				<div><a href="<?php echo $this->zurl[$row['chaid']]?>.php?cid=<?php echo $row['id']?>"><?php echo $row['name']?></a></div>
			<?php }?>
		</div>
        <?php
	}
	
	//显示路径
	function class_path($id){
		global $db;
		if(!empty($id)){
			$sql="select * from `".PRE."type` where id=$id";
			$rs=$db->query($sql) or die (showmsg("查询栏目路径信息出现错误"));
			while($row=$db->fetch_array($rs)){				
				$this->class_name=" > <a href='".$this->zurl[$row['chaid']].".php?cid=".$row['id']."'>".$row['name']."</a>".$this->class_name;
				if($row['fid']!=0){
					$this->class_path($row['fid']);
				}
			}
		}
		return "您的位置 > <a href='index.php'>首页</a>".$this->class_name;
	}

	
	//取得各字段的值
	function get_class_infor($type){
		global $db;
		if(!empty($cid)){
			$sql="select `name`,`keywords`,`smalltext` from `".PRE."type` where `type`=".$type." and `id`=$cid";
			$rs=$db->query($sql) or die (showmsg("查询栏目字段内容时出现错误"));
			if(is_array($row=$db->fetch_array($rs))){
				return $row;								  	
			}
		}				
	}

	
	#################################################################前后台函数分割线#####################################################################

	//用递归修改栏目的深度和排列顺序，当栏目变动时调用
	function class_add_update($tid){
		global $db;
		$sql="select * from `".PRE."type` where `fid`=$tid";
		$rs=$db->query($sql);
		while($row = $db->fetch_array($rs)){
			$temp_order=$this->cls_order++;
			$temp_depth=$this->get_level($row['id']);
			//栏目排列时所用的修饰			
			if ($this->get_level($row['id']) == 1) {
				$pic_num = 1;//顶级分类编号
			}
			elseif ($this->is_leaf($row['id'])) {
				$pic_num = 2;//底级分类编号
			} else {
				$pic_num = 3;//其他分类编号
			}			
			$in_sql = "update `".PRE."type` set `order`=".$temp_order.",`depth`=".$temp_depth.",`pic_num`=".$pic_num." where `id`=".$row['id'];
			$db->query($in_sql)or die(showmsg("执行栏目更新出现错误"));
			$this->level = 1;
			$this->class_add_update($row['id']);
		}
	}
	
	
	
	//添加和修改栏目时
	function class_select($chaid,$tid,$action="add"){		
		global $db,$zzcms_cha;
		$chaid=intval($chaid);
		$str="";
		if($chaid==4){
			return $str.=$zzcms_cha[$chaid]."<input name=\"fid\" type=\"hidden\" id=\"fid\" value=\"0\" />";
		}
		$tid=intval($tid);
		$sql="select * from `".PRE."type` where `chaid`=$chaid order by `order`";
		$rs=$db->query($sql)or die(showmsg("栏目下拉选项出现错误"));	
		$str.="<select name=\"fid\" id=\"fid\"><option value=\"0\" selected=\"farent_id\">请选择栏目</option>";
		while($row = $db->fetch_array($rs)){
			$zs="";
			for($i=1;$i<$row['depth'];$i++){
				$zs.="┆";
			}
			switch($row['pic_num']){
				case 1:
					$list_img = "";
					break;
				case 2:
					$list_img = "└";
					break;
				default:
					$list_img = "├";
			}
			if ($tid== $row['id'] && $action=="add") {
                $str.="<option value=\"".$row['id']."\" selected=\"selected\">".$zs.$list_img.$row['name']."</option>";
			}elseif ($this->get_farent_id($tid) == $row['id'] && $action == 'modify'){
                $str.="<option value=\"".$row['id']."\" selected=\"selected\">".$zs.$list_img.$row['name']."</option>";
			}else {
                $str.="<option value=\"".$row['id']."\">".$zs.$list_img.$row['name']."</option>";
			}
		}
		$str.="</select>";
		return $str;
	}
	
	//添加和修改各模块内容时用到
	function art_select($chaid){
		global $db;
		$tid=isset($_GET['tid'])?intval($_GET['tid']):0;
		$action=isset($_GET['action'])?$_GET['action']:showmsg("缺少参数！");
		$sql="select * from `".PRE."type` where `chaid`=$chaid order by `order`";
		$rs=$db->query($sql);
		while($row = $db->fetch_array($rs)){
			$zs="";
			for($i=1;$i<$row['depth'];$i++){
				$zs.="┆";
			}
			switch($row['pic_num']){
				case 1:
					$list_img = "";
					break;
				case 2:
					$list_img = "└";
					break;
				default:
					$list_img = "├";
			}
			if ($tid==intval($row['id']) && $action=='modify') {
				?>
                <option value="<?php echo $row['id']?>" selected="selected"><?php echo $zs.$list_img.$row['name']?></option>
                <?php
			}else {
				?>
                <option value="<?php echo $row['id']?>"><?php echo $zs.$list_img.$row['name']?></option>
                <?php
			}
		}
	}
	
	//取得栏目名字
	function class_name($id){
		global $db;
		$sql="select * from `".PRE."type` where id=$id";
		$rs=$db->query($sql) or die (showmsg("取得栏目名字出现错误"));
		while($row=$db->fetch_array($rs)){
			return $row['name'];
		}
	}
	
	//得到类别及其子类别ID
	function classid($id){
		global $db;
		$this->arr_cid[]=$id;
		if(!$this->is_leaf($id)){
			$sql="select * from `".PRE."type` where `fid`=$id";
			$rs=$db->query($sql) or die (showmsg("查询类别ID数组时出现错误"));
			while($row=$db->fetch_array($rs)){
				$this->array_classid($row['id']);
			}
		}
		return $this->arr_cid;
	}
	
	//得到类别及其子类别ID
	function array_classid($id){
		global $db;
		$this->arr_cid[]=$id;
		if(!$this->is_leaf($id)){
			$sql="select * from `".PRE."type` where `fid`=".$id;
			$rs=$db->query($sql) or die ("查询类别ID数组时出现错误");
			while($row=$db->fetch_array($rs)){
				$this->array_classid($row['id']);
			}
		}
		return implode(",",$this->arr_cid);
	}
	
	//判断栏目是否为空
	function is_class_null($id,$chaid){
		global $db;
		$sql="select * from ".PRE.$this->tables[$chaid]." where `cid`=$id";
		$rs=$db->query($sql) or die (showmsg("查询栏目是否为空出现错误"));
		if($db->num_rows($rs)>0){
			return false;
		}else{
			return true;
		}
	}
	//得到父ID号
	function get_farent_id($id) {
		global $db;
		$sql = "select * from `".PRE."type` where `id`=$id";
		$rs = $db->query($sql);
		while ($row = $db->fetch_array($rs)) {
			return $row['fid'];
		}
	}

	//判断类别是不是叶子节点
	function is_leaf($id) {
		global $db;
		$sql = "select * from `".PRE."type` where `fid`=$id";
		$rs = $db->query($sql);
		if ($db->num_rows($rs) > 0) {
			return false; //如果有子类，则不是叶子节点
		} else {
			return true; //如果没有子类，则有叶子节点
		}
	}

	//得到类别的深度
	function get_level($id) {
		global $db;
		$sql = "select * from `".PRE."type` where `id`=$id";
		$rs = $db->query($sql);
		while ($row = $db->fetch_array($rs)) {
			if ($row['fid'] != 0) {
				$this->level++;
				$this->get_level($row['fid']);
			}
		}
		return $this->level;
	}
	
	//栏目列表显示	
	function class_list(){
		global $db,$zzcms_cha;
		$sql="select * from `".PRE."type` order by `order`";
		$rs=$db->query($sql);
		while($row = $db->fetch_array($rs)){
			$zs="";
			for($i=1;$i<$row['depth'];$i++){
				$zs.="<img src='Images/vertline.gif'/>";
			}
			switch($row['pic_num']){
				case 1:
					$list_img = "<img src='Images/open.gif'/>";
					break;
				case 2:
					$list_img = "<img src='Images/lastnodeline.gif'/>";
					break;
				default:
					$list_img = "<img src='Images/midopenedfolder.gif'/>";
			}
			  ?>
            <tr> 
                <td><?php echo $row['id']?></td> 
                <td><?php echo $zzcms_cha[$row['chaid']]?></td> 
                <td><?php echo $zs.$list_img.$row['name']?></td> 
                <td>
				<?php if($row['chaid']==4){
					echo "<img src=\"Images/class_no.gif\" alt=\"不能添加子类\" />";
				}else{
					echo "<a href=\"ZC_Class_Manager.php?action=add&chaid=".$row['chaid']."&tid=".$row['id']."\" ><img src=\"Images/class_add.gif\" alt=\"添加子类\" /></a>";
				}
				?>
				</td> 
                <td><a href="ZC_Class_Manager.php?action=modify&chaid=<?php echo $row['chaid']?>&tid=<?php echo $row['id']?>"><img src="Images/class_update.gif" alt="修改类别" /></a></td> 
                <td><a onClick="DelOK(<?php echo $row['id']?>)" href="#"><img src="Images/class_del.gif" alt="删除类别" /></a></td> 
                <td>
               <?php if($row['chaid']==4){
					echo "<img src=\"Images/class_no.gif\" />";
				}else{
					echo "<a href=\"../".$this->zurl[$row['chaid']].".php?cid=".$row['id']."\" target=\"_blank\"><img src=\"Images/class_select.gif\" alt=\"查看内容\" /></a>";
				}
				?>  
                </td> 
            </tr>
            <?php
		}
	}
}	
?>
