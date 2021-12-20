<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	
	if(isset($action)&&$action== 'add'){
		$cid=isset($cid)?intval($cid):showmsg("缺少参数！");
		if(!$type->is_leaf($cid)){
			showmsg('不能在有子类的栏目下添加文章！');
		}	
		$is_hot=isset($is_hot)?$is_hot:0;
		$is_top=isset($is_top)?$is_top:0;
		$spic=create_spic($pic);
		$time=time();
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql="insert into `".PRE."article` (`cid`,`title`,`keywords`,`pic`,`spic`,`smalltext`,`is_top`,`is_hot`,`content`,`time`,`ip`) values($cid,'$title','$keywords','$pic','$spic','$smalltext',$is_top,$is_hot,'$content',$time,'$ip')";
		$db->query($sql) or die(showmsg("添加文章失败"));
		selectmsg('ZC_Article_Manager.php?action=add&tid=0','ZC_Article_List.php');
	}elseif(isset($action)&&$action== 'modify'){
		if(!isset($id)){
			showmsg('未选择记录');
		}
		$cid=isset($cid)?intval($cid):showmsg("缺少参数！");
		if(!$type->is_leaf($cid)){
			showmsg('不能在有子类的栏目下添加文章！');
		}
		$spic=create_spic($pic);
		$is_hot=isset($is_hot)?$is_hot:0;
		$is_top=isset($is_top)?$is_top:0;
		$sql="update `".PRE."article` set `cid` = $cid,`title` = '$title',`keywords`='$keywords',`pic`='$pic',`spic`='$spic',`smalltext`='$smalltext',`is_top`=$is_top,`is_hot`=$is_hot,`content` = '$content' WHERE `id` =$id";
		$db->query($sql) or die(showmsg("修改文章失败"));
		showmsg('修改成功！','ZC_Article_List.php');
	}else{
		if(!isset($id)){
			showmsg('未选择记录');
		}
		if(is_array($id)){
			$id=implode(',',$id);
		}
		if(!$id){
			showmsg('操作的ID号丢失！');
		}
		$sql = "delete from `".PRE."article` where `id` in ($id)";
		$db->query($sql) or die(showmsg("删除文章失败"));
		showmsg('删除成功！');
	}
?>

