<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	if(isset($id)) $id=intval($id);
	//添加单页
	if(isset($action)&&$action=='add'){		
		$db->query("insert into `".PRE."type`(`chaid`,`fid`,`name`) values(4,0,'$name')") or die (showmsg("添加单页出现错误"));
		$insert_num=$db->insert_id();
		$sql="insert into `".PRE."about`(`cid`,`name`,`title`,`pic`,`content`) values($insert_num,'$name','$title','$pic','$content')";
		$db->query($sql) or die (showmsg("添加单页出现错误"));
		$type->class_add_update(0);
		selectmsg('ZC_About_Manager.php?action=add','ZC_About_List.php');
		
	
	//修改单页
	}elseif(isset($action)&&$action=='modify'){
		$sql="update `".PRE."about` set `title`='$title',`pic`='$pic',`content`='$content' where `id`=$id";
		$db->query($sql) or die (showmsg("修改单页出现错误"));
		$type->class_add_update(0);
		showmsg('修改成功！','ZC_About_List.php');	
	//删除单页
	}else{
		showmsg('请正确操作！');
	}
?>
