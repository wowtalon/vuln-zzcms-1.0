<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	//添加产品
	if(isset($action)&&$action=='add'){
		$cid=isset($cid)?intval($cid):showmsg("缺少参数！");
		if(!$type->is_leaf($cid)){
			showmsg('不能在有子类的栏目下添加产品！');
		}
		$spic=create_spic($pic);	
		$is_hot=isset($is_hot)?$is_hot:0;
		$is_top=isset($is_top)?$is_top:0;
		$time=time();
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql="insert into `".PRE."pro` (`cid`,`title`,`xh`,`keywords`,`pic`,`spic`,`smalltext`,`is_top`,`is_hot`,`content`,`more`,`time`,`ip`) values($cid,'$title','$xh','$keywords','$pic','$spic','$smalltext',$is_top,$is_hot,'$content','$more',$time,'$ip')";
		$db->query($sql) or die(showmsg("添加产品出现错误"));
		selectmsg('ZC_Pro_Manager.php?action=add&tid=0','ZC_Pro_List.php');
	//修改产品	
	}elseif(isset($action)&&$action=='modify'){
		if(!isset($id)){
			showmsg('未选择记录');
		}
		$cid=isset($cid)?intval($cid):showmsg("缺少参数！");
		if(!$type->is_leaf($cid)){
			showmsg('不能在有子类的栏目下添加产品！');
		}
		$spic=create_spic($pic);	
		$is_hot=isset($is_hot)?$is_hot:0;
		$is_top=isset($is_top)?$is_top:0;
		$sql="update `".PRE."pro` set `cid` = $cid,`title` = '$title',`xh`='$xh',`keywords`='$keywords',`pic`='$pic',`spic`='$spic',`smalltext`='$smalltext',`is_top`=$is_top,`is_hot`=$is_hot,`content` = '$content',`more` = '$more' WHERE `id` =$id";
		$db->query($sql) or die(showmsg("产品修改时出现错误"));
		showmsg('修改成功!','ZC_Pro_List.php');
	//删除产品
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
		$sql = "delete from `".PRE."pro` where `id` in ($id)";
		$db->query($sql) or die(showmsg("删除产品时出现错误"));
		showmsg('删除成功！');
	}
?>

