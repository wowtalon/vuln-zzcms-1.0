<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	//添加蜘蛛
	if(isset($action)&&$action== 'add'){
		$sql="insert into `".PRE."botlist`(`name`,`biaoji`) values('".$name."','".$biaoji."')";
		$db->query($sql) or die (showmsg("添加蜘蛛出现错误"));
		$insert_num=$db->insert_id();
		cache_table('botlist',$fields='*',false,'','id');
		selectmsg("ZC_Botlist_Manager.php?action=add","ZC_Botlist_List.php");
	//修改蜘蛛	
	}elseif(isset($action)&&$action== 'modify' && $id){
		$sql = "update ".PRE."botlist set `name`='".$name."',`biaoji`='".$biaoji."' where `id`=$id";
		$db->query($sql) or die (showmsg("修改蜘蛛出现错误"));	
		cache_table('botlist',$fields='*',false,'','id');
		showmsg('修改成功！','ZC_Botlist_List.php?');
	//删除蜘蛛
	}else{
		$sql = "delete from `".PRE."botlist` where `id`=$id";
		$db->query($sql) or die (showmsg("删除蜘蛛出现错误"));	
		cache_table('botlist',$fields='*',false,'','id');
		showmsg('删除成功！','ZC_Botlist_List.php');
	}
?>
