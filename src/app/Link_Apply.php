<?php
	include("include/global.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>申请友情连接</title>
<meta name="keywords" content="<?php echo $row['keywords']?>">
<meta name="description" content="<?php echo $row['smalltext']?>">
<link href="css/index.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
	<!--
	function chk(theForm){
			if (theForm.cid.value == "0"){
					alert("请选择栏目");
					theForm.cid.focus();
					return (false);
			}
			if (theForm.title.value == ""){
					alert("标题不能为空");
					theForm.title.focus();
					return (false);
			}   
			if (theForm.url.value == ""){
				alert("地址不能为空");
				theForm.url.focus();
				return (false);
			}
	}
	//-->
            </script>
</head>

<body>
<?php include("include/head.php");?>

		<form action="include/Link_Edit.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<table align=center border=0 cellspacing=1 cellpadding=5 width="960" class="linkapp">
				<tr>
					<th colspan="2" align="center">申请友情连接</th>
				</tr>
				<tr>
					<td class="td">
						标题：
					</td>
					<td>
						<input name="title" type="text" id="title" style="width: 350px;" maxlength="60" />
					</td>
				</tr>
				<tr>
					<td class="td">
						地址：
					</td>
					<td>
						<input name="url" type="text" id="url"
							style="width: 350px;" maxlength="200" /></td>
				</tr>
				<tr>
					<td class="td">
						LOGO：
					</td>
					<td>
						<input name="pic" type="text" id="_TopImage"
							style="width: 350px;" maxlength="600" />
					&nbsp;请填写你的LOGO地址</td>
				</tr>
                
                <tr>
				  <td class="td">验证码：
					</td>
					<td><input name="vercode" type="vercode" id="vercode" size="10" maxlength="4"/>&nbsp;&nbsp;&nbsp;<img src="include/ver.php" onclick="this.src='include/ver.php?id='+Math.random()*5;" alt="验证码,看不清楚?请点击刷新验证码"/>*</td>
				</tr>
                
				<tr>
					<td class="td" width="11%">&nbsp;
						
					</td>
					<td width="89%">
						<input name="submit" type="submit" class="button" id="submit" style=""
							value="添加" />
						<input name="Reset" type="reset" class="button" id="Reset"
							value="重置" />
					</td>
				</tr>
                
			</table>
</form>
<?php include("include/footer.php");?>