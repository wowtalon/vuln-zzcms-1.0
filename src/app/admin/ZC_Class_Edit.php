<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	//添加栏目
	if(isset($action)&&$action== 'add'){
		$fid=isset($fid)?intval($fid):showmsg("缺少父栏目参数！");
		$chaid=isset($chaid)?intval($chaid):showmsg("缺少频道参数！");
		$tid=isset($tid)?intval($tid):0;
		$is_show=isset($is_show)?$is_show:0;
		$is_top=intval($is_top);
		if(!$type->is_class_null($fid,$chaid)){
			showmsg('不能选择非空栏目为上级栏目！');
		}else{
			$sql="insert into `".PRE."type`(`chaid`,`fid`,`name`,`keywords`,`smalltext`,`order`,`depth`,`pic_num`,`is_show`,`is_top`) values($chaid,$fid,'$name','$keywords','$smalltext',1,1,1,$is_show,$is_top)";
			$db->query($sql) or die (showmsg("添加栏目出现错误"));			
			$type->class_add_update(0);
			$insert_num=$db->insert_id();
			cache_about('type','*',true,'id='.$insert_num,'id desc',1);
			if($chaid==4) $db->query("insert into `".PRE."about`(`cid`,`name`) values($cid,'$name')") or die (showmsg("添加单页出现错误"));
			selectmsg("ZC_Class_Manager.php?action=add","ZC_Class_List.php");
		}	
		
	
	//修改栏目	
	}elseif(isset($action)&&$action== 'modify' && $tid){
		$fid=isset($fid)?intval($fid):showmsg("缺少父栏目参数！");
		$chaid=isset($chaid)?intval($chaid):showmsg("缺少频道参数！");
		$tid=isset($tid)?intval($tid):showmsg("缺少栏目参数！");
		$chid=$type->classid($tid);
		$is_show=isset($is_show)?$is_show:0;
		$is_top=intval($is_top);
		if(in_array($fid,$chid)>0){
			showmsg('不能选择其下级栏目为其上级栏目！');
		}elseif(!$type->is_class_null($fid,$chaid)){
			showmsg('不能选择非空栏目为上级栏目！');
		}else{
			$sql = "update ".PRE."type set `name`='$name',`keywords`='$keywords',`smalltext`='$smalltext',`fid`=$fid,`is_show`=$is_show,`is_top`=$is_top where `id`=$tid";
			$db->query($sql);
			$type->class_add_update(0);
			cache_about('type','*',true,'id='.$tid,'id desc',1);
			if($chaid==4) $db->query("update ".PRE."about set `name`='$name' where `cid`=$tid") or die (showmsg("添加单页出现错误"));
			showmsg('修改成功！','ZC_Class_List.php');
		}	
	
	//删除栏目
	}else{
		if(!isset($tid)){
			showmsg('参数错误');
		}
		$r=$db->get_one("select * from `".PRE."type` where `id`=$tid ");
		$chaid=$r['chaid'];
		$table=$zzcms_table[$chaid];
		$arr_id=$type->array_classid(intval($tid));
		$sql = "delete from `".PRE."type` where `id` in ($arr_id)";
		$db->query($sql) or die (showmsg("删除类别出现错误"));	
		if($chaid==4){
			$db->query("delete from `".PRE."about` where `cid`=$tid") or die (showmsg("添加单页出现错误"));
		}else{
			$db->query("delete from ".PRE.$table." where `cid` in ($arr_id)") or die (showmsg("删除类别下信息出现错误"));
		} 			
		$type->class_add_update(0);
		$type_id=explode("'",$arr_id);
		if(is_array($type_id)){
			foreach($type_id as $k){
				cache_delete("type".$k.".php", $path = '');
			}
		}else{
			cache_delete("type".$arr_id.".php", $path = '');
		}
		
		showmsg("删除成功！","ZC_Class_List.php");
	}
?>
