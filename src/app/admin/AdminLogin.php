<?php
	include("../include/global.php");
	$error="";
	if(isset($submit)){	
		if($vercode!=$_SESSION['ver_code']){
			showmsg('验证码错误！');
		}
		$name=str_replace(" ","",$name);
		$sql="select * from `".PRE."admin` where `name`='$name'";
		$rs=$db->query($sql) or die (showmsg("执行查询管理员信息出现错误"));
		$arr=is_array($row=$db->fetch_array($rs));
		$pass=$arr?md5($password.ZZCMS)==$row['password']:false;
		if($pass){
			$_SESSION['uid']=$row['uid'];
			$_SESSION['admin_shell']=md5($row['name'].$row['password'].ZZCMS);
			$_SESSION['in_time']=mktime();
			unset($_SESSION['ver_code']);
			echo "<script language='javascript' >window.location.href='AdminIndex.php'</script>";
		}else{
			$error="用户名或者密码不正确！";
			session_destroy();
		}
	}
	 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>ZZCMS后台登录页面</title>
		<link href="css/Admin.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
 
		<br />
		<br />
       
		 <form method="post" action="">
			<table align=center border=0 cellspacing=0 cellpadding=0 width="360">
				<tr>
					<th colspan="2" align="center">
						管理登录
					</th>
				</tr>
				<tr>
					<td width="104" align="center" class="td">
						用户名：
					</td>
					<td width="231">
						<input name="name" type="text" id="AdminName"
							style="width: 170px;" />
					</td>
				</tr>
				<tr>
					<td align="center" class="td">
						密 码：
					</td>
					<td>
						<input name="password" type="password" id="AdminPassword"
							style="width: 170px;" />
					</td>
				</tr>
                <tr>
					<td align="center" class="td">验证码：
					</td>
					<td>
						<input name="vercode" type="text" id="AdminPassword"
							style="width: 50px;" size="4" maxlength="4" />&nbsp;&nbsp;&nbsp;
                            <img src="../include/ver.php" onclick="this.src='../include/ver.php?id='+Math.random()*5;" alt="验证码,看不清楚?请点击刷新验证码" />
					</td>
				</tr>
				<tr>
					<td class="td">&nbsp;
						
					</td>
					<td>
						<input type="submit" name="submit" value="登 录" class="button" id="submit" />
						<input type="reset" name="Reset" value="重 置" class="button" />
					</td>
				</tr>
				<tr>
                  	<td colspan="2" align="center" class="td">
                    <?php 
						echo "<font color='red'>".$error."</font>";
						unset($error);
					?>
					</td>
				</tr>
			</table>
          </form>
	</body>
</html>
