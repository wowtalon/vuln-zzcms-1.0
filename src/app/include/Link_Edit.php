<?php
	include("global.php");	
	//申请连接
	if(isset($action)&&$action=='add'){
		if($vercode!=$_SESSION['ver_code']){
			showmsg('验证码错误！');
		}
		$is_show=$is_top=0;
		$is_show=isset($_POST['is_show'])?1:0;
		$is_top=isset($_POST['is_top'])?1:0;
		$sql="insert into `".PRE."link`(`title`,`logo`,`url`,`is_top`,`is_show`) values('$title','$pic','$url',$is_top,$is_show)";
		$db->query($sql) or die (showmsg("申请友情连接出现错误"));	
		showmsg('申请连接成功，我们需要审核后开通，现在跳转到网站首页！','../index.php');
	}
?>
