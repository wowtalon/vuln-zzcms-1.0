<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	global $row;
	if(isset($submit)){
		if(md5($oldpass.ZZCMS)==$row['password']){
			$newpass=md5($newpass.ZZCMS);
			$sql="update `".PRE."admin` set `password`='".$newpass."'";
			$db->query($sql) or die (showmsg("修改管理密码出现错误"));
			showmsg('修改成功！','AdminLogout.php');

		}else{
			showmsg('旧密码不正确！');
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>密码修改</title>
		<link href="css/Admin.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/public.js"></script>
        	<script language="JavaScript">
			<!--
			function chk(theForm){
					if (theForm.newpass.value == ""){
							alert("新密码不能为空");
							theForm.newpass.focus();
							return (false);
					}
					if (theForm.newpass1.value == ""){
							alert("新密码不能为空");
							theForm.newpass1.focus();
							return (false);
					}
					if (theForm.newpass.value != theForm.newpass1.value){
							alert("两次密码不一致！");
							theForm.newpass1.focus();
							return (false);
					}
			}
			//-->
			</script>
	</head>

<body>
   <form action="" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
        <table align=center border=0 cellspacing=1 cellpadding=5 width="95%">
          <tr>
            <th colspan="2" align="center"><span>修改管理员密码</span></th>
          </tr>
          <tr>
            <td class="td">用户名：</td>
            <td><?php echo $row['name'] ?> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <font color="#FF0000">注意：修改密码后将自动退出，您需要重新登录后台</font>
            </td>
          </tr>
          <tr>
            <td class="td">旧密码：</td>
            <td><input name="oldpass" type="password" id="oldpass" style="width:230px;" />
              请输入旧密码</td>
          </tr>
          <tr>
            <td class="td">新密码：</td>
            <td><input name="newpass" type="password" id="newpass" style="width:230px;" maxlength="16" />
              请输入新密码</td>
          </tr>
           <tr>
            <td class="td">确认密码：</td>
            <td><input name="newpass1" type="password" id="newpass1" style="width:230px;" maxlength="16" />
              请再次输入新密码</td>
          </tr>
          <tr>
            <td class="td" width="11%">&nbsp;</td>
            <td width="89%">
              <input name="submit" type="submit" class="button" value="修 改" />
            <input name="Reset" type="reset" class="button" id="Reset" value="重 置" /></td>
          </tr>
        
        </table>
   </form>
</body>
</html>
