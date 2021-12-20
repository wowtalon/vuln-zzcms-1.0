<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>栏目管理</title>
		<link href="css/Admin.css" rel="stylesheet" type="text/css" />
		<script language="JavaScript">
                <!--
                function chk(theForm){
                        if (theForm.name.value == ""){
                                alert("爬虫名称不能为空");
                                theForm.name.focus();
                                return (false);
                        }    
     					if (theForm.biaoji.value == ""){
                                alert("爬虫标记不能为空");
                                theForm.biaoji.focus();
                                return (false);
                        }  						
                }
                //-->
            </script>
	</head>

	<body>
<?php
if(isset($action)&& $action=='add'){
?>
   <form action="ZC_Botlist_Edit.php?action=add&type=<?php echo intval($type)?>"
			method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<table align=center border=0 cellspacing=0 cellpadding=0 width="95%"
				class="AdminTable">
				<tr>
					<th colspan="2" align="center">添加爬虫					</th>
				</tr>
				<tr>
					<td class="td">
						爬虫名称：
					</td>
					<td>
						<input name="name" type="text" id="name" style="width: 200px;"/></td>
				</tr>
				<tr>
					<td class="td">爬虫标记：
					</td>
					<td>
						<input name="biaoji" type="text" id="biaoji" style="width: 200px;"/>
					</td>
				</tr>

				<tr>
					<td class="td" width="11%">&nbsp;

					</td>
					<td width="89%">
						<input type="submit" name="Submit" value="添加"
							class="button" />
						<input type="reset" name="Reset" value="重置" class="button" />
					</td>
				</tr>
			</table>
		</form>     
<?php
} else {
	$sql = "select * from `".PRE."botlist` where `id`=".intval($id);
	$rs = $db->query($sql) or die (showmsg("修改爬虫出现错误"));
	while ($row = $db->fetch_array($rs)) {
?>
	  <form action="ZC_Botlist_Edit.php?action=modify&id=<?php echo $row['id']?>"
			method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<table align=center border=0 cellspacing=1 cellpadding=5 width="95%">
				<tr>
					<th colspan="2" align="center">修改爬虫					</th>
				</tr>

				<tr>
					<td class="td">爬虫名称：
					</td>
					<td>
						<input name="name" type="text" id="name" style="width: 200px;" value="<?php echo $row['name']?>" /></td>
				</tr>
				<tr>
					<td class="td">爬虫标记：
					</td>
					<td>
						<input name="biaoji" type="text" id="biaoji"
							style="width: 200px;" value="<?php echo $row['biaoji']?>" />
					</td>
				</tr>

				<tr>
					<td class="td" width="11%">&nbsp;

					</td>
					<td width="89%">
						<input type="submit" name="Submit" value="修改"
							class="button" />
						<input type="reset" name="Reset" value="重置" class="button" />
					</td>
				</tr>
			</table>
		</form>
        <table align=center border=0 cellspacing=0 cellpadding=0 width="95%">
            <tr>
                <td class="td"><p>请不要随意修改爬虫信息，以免统计信息出现错误！</p></td>
            </tr>
        </table>
<?php
	}
}
?>
	</body>
</html>
