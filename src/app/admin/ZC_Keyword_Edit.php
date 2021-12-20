<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	
	//添加关键词
	if(isset($action)&&$action=='add'){	
		$rs=$db->query("select * from `".PRE."keyword` where `keyword`='$keyword'");
		if(is_array($row=$db->fetch_array($rs))){
			showmsg('词已存在!');	
		}
		$addtime=time();
		$klen=mb_strlen($keyword,'utf8');
		$zimu=getfirstchar($keyword);
		$sql="insert into `".PRE."keywords`(`keyword`,`replace`,`zimu`,`klen`,`addtime`) values('".$keyword."','".$replace."','".$zimu."',".$klen.",'".$addtime."')";	
		$db->query($sql) or die (showmsg("添加替换词出现错误"));
		selectmsg('ZC_Keyword_Manager.php?action=add','ZC_Keyword_List.php');
		set_system_keywords();
	//修改关键词
	}elseif(isset($action)&&$action=='modify'){
		if(!$id){
			showmsg('未选择记录!','ZC_Keyword_List.php?');	
		}
		$id=intval($id);	
		$rs=$db->query("select * from `".PRE."keywords` where `keyword`=$keyword and `id` <>$id");	
		if(is_array($row=$db->fetch_array($rs))){
			showmsg('词已存在!');	
		}
		$sql="update `".PRE."keywords` set `keyword`='".$keyword."',`replace`='".$replace."',`zimu`='".$zimu."',`klen`=".$klen." where `id`=".$id;
		$db->query($sql) or die (showmsg("修改替换词出现错误"));
		set_system_keywords();
		showmsg('修改成功!','ZC_Keyword_List.php');	
		
	//删除单页
	}else{
		if(!$id){
			showmsg('未选择记录!','ZC_Keyword_List.php');	
		}
		//如果ID的值为数组则ID为字符中，否则为数字
		$id=is_array($id)?implode(',',$id):$id;

		if(!$id){
			showmsg('操作的ID号丢失!');	
		}
		if(isset($action)&&$action='delete'){
			$sql="delete from `".PRE."keywords` where `id` in ($id)";
			$db->query($sql) or die (showmsg("删除词组出现错误"));
			set_system_keywords();
			showmsg('删除成功!','ZC_Keyword_List.php');	
		}
	}
?>
