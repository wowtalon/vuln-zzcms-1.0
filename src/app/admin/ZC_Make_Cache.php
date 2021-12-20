<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	//表单提交时修改站点参数
	if(isset($action)&&$action=='make'){
		cache_table('system','*',true);
		cache_about('type','*');
		cache_table('link',$fields='*',false,'is_show=1','id');
		cache_table('botlist',$fields='*',false,'','id');
		set_system_keywords();
		showmsg("生成所有缓存成功!","ZC_Main.php");
	}else{
		showmsg("非法参数!");
	}
		
?>

