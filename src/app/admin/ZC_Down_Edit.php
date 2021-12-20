<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");

	//添加下载信息
	if(isset($action)&&$action=='add'){
		$cid=isset($cid)?intval($cid):showmsg("缺少参数！");
		if(!$type->is_leaf($cid)){
			showmsg('不能在有子类的栏目下添加软件！');
		}	
		$is_hot=isset($is_hot)?$is_hot:0;
		$is_top=isset($is_top)?$is_top:0;
		$spic=create_spic($pic);
		$time=time();
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql = "insert into `".PRE."down` (`cid`,`title`,`writer`,`befrom`,`type`,`copyright`,`grade`,`lang`,`run`,`keywords`,`size`,`is_top`,`is_hot`,`pic`,`spic`,`smalltext`,`url`,`content`,`time`,`ip`) values(".intval($cid).",'$title','$writer','$befrom',".intval($ztype).",".intval($copyright).",".intval($grade).",".intval($lang).",".intval($run).",'$keywords',".intval($size).",".intval($is_top).",".intval($is_hot).",'$pic','$spic','$smalltext','$url','$content',$time,'$ip')";
		$db->query($sql) or die (showmsg("添加下载信息出现错误"));
		selectmsg('ZC_Down_Manager.php?action=add','ZC_Down_List.php');
	//修改下载信息
	}elseif(isset($action)&&$action=='modify'){
		if(!isset($id)){
			showmsg('未选择记录');
		}
		$cid=isset($cid)?intval($cid):showmsg("缺少参数！");
		if(!$type->is_leaf($cid)){
			showmsg('不能在有子类的栏目下添加软件！');
		}	
		$is_hot=isset($is_hot)?$is_hot:0;
		$is_top=isset($is_top)?$is_top:0;
		$spic=create_spic($pic);		
		$time=time();
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql="update `".PRE."down` set `cid` = ".intval($cid).",`title` ='$title',`writer`='$writer',`befrom`='$befrom',`type`=".intval($ztype).",`copyright`=".intval($copyright).",`grade`=".intval($grade).",`lang`=".intval($lang).",`run`=".intval($run).",`keywords`='$keywords',`size`=".intval($size).",`is_top`=".intval($is_top).",`is_hot`=".intval($is_hot).",`pic`='$pic',`spic`='$spic',`smalltext`='$smalltext',`url`='$url',`content` = '$content',`time`=".intval($time).",`ip`='$ip' where `id` =".intval($id);
		$db->query($sql) or die (showmsg("修改下载出现错误"));
		showmsg('修改成功！','ZC_Down_List.php');
	
	//删除下载信息
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
		$sql = "delete from `".PRE."down` where `id` in ($id)";
		$db->query($sql) or die (showmsg("删除失败!"));;
		showmsg('删除成功！');
	}
?>

