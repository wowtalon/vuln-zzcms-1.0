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
                                alert("栏目名称不能为空");
                                theForm.name.focus();
                                return (false);
                        }                        
                }
                //-->
            </script>
	</head>

	<body>
<?php
$chaid=isset($chaid)?$chaid:0;
$tid=isset($tid)?$tid:0;
if(isset($action)&& $action=='add'){
?>
   <form action="ZC_Class_Edit.php?action=add&chaid=<?php echo $chaid;?>"
			method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<table align=center border=0 cellspacing=0 cellpadding=0 width="95%" class="AdminTable">
				<tr>
					<th colspan="2" align="center">添加栏目					</th>
				</tr>
                <tr>
				  <td valign="top" class="td" style="padding-top: 7px;">
						所属模块：
					</td>
					<td>					
						<?php echo zzcms_chaid($chaid);?>					
					</td>
				</tr>
				<tr>
					<td valign="top" class="td" style="padding-top: 7px;">
						上级栏目：
					</td>
					<td>
						<?php echo $type->class_select($chaid,$tid);?>
					</td>
				</tr>
				<tr>
					<td class="td">
						栏目名称：
					</td>
					<td>
						<input name="name" type="text" id="name" style="width: 200px;" maxlength="10"/></td>
				</tr>
				<tr>
					<td class="td">
						关 键 词：
					</td>
					<td>
						<input name="keywords" type="text" id="keywords" style="width: 500px;" maxlength="60"/>
					</td>
				</tr>
                <tr>
				  <td class="td">是否显示：
				  </td>
			    <td>
			      <input name="is_show" type="checkbox" id="is_show" value="1" onClick="return false;" onMouseUp="this.checked=!this.checked" />&nbsp;&nbsp;&nbsp;&nbsp;栏目是否在菜单显示</td>
				</tr>   
                <tr>
				  <td class="td">栏目排序：
				  </td>
			    <td>
			      <input name="is_top" type="text" id="is_top" style="width: 50px;" maxlength="10"/>&nbsp;&nbsp;&nbsp;&nbsp;填写整数，数字越大排序越靠前
                </td>
				</tr>                              
				<tr>
					<td valign="top" class="td" style="padding-top: 7px;">
						栏目简介：
					</td>
					<td>
				    <label>
				      <textarea name="smalltext" id="smalltext" cols="45" rows="5"></textarea>
				    </label></td>
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
	$sql = "select * from `".PRE."type` where `id`=$tid";
	$rs = $db->query($sql) or die (showmsg("修改栏目页面出现错误"));
	while ($row = $db->fetch_array($rs)) {
?>
	  <form action="ZC_Class_Edit.php?action=modify&chaid=<?php echo $row['chaid']?>&tid=<?php echo $row['id']?>"
			method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
            5555
			<table align=center border=0 cellspacing=0 cellpadding=0 width="95%">
				<tr>
					<th colspan="2" align="center">修改栏目					</th>
				</tr>
                 <tr>
				  <td valign="top" class="td" style="padding-top: 7px;">
						所属模块：
					</td>
					<td>
						<?php echo $zzcms_cha[$chaid];?>
					</td>
				</tr>
				<tr>
					<td valign="top" class="td" style="padding-top: 7px;">
						上级栏目：
					</td>
					<td>
						<?php echo $type->class_select($chaid,$tid,"modify");?>
					</td>
				</tr>
				<tr>
					<td class="td">
						栏目名称：
					</td>
					<td>
						<input name="name" type="text" id="name" style="width: 200px;" value="<?php echo $row['name']?>" maxlength="10" /></td>
				</tr>
				<tr>
					<td class="td">
						关 键 词：
					</td>
					<td>
						<input name="keywords" type="text" id="keywords" style="width: 500px;" value="<?php echo $row['keywords']?>" maxlength="60" />
					</td>
				</tr>
                <tr>
				  <td class="td">是否显示：
				  </td>
			    <td>
			      <input name="is_show" type="checkbox" id="is_show" value="1" onClick="return false;" onMouseUp="this.checked=!this.checked" <?php if($row['is_show']==1){ echo "checked='checked'";}?> />&nbsp;&nbsp;&nbsp;&nbsp;栏目是否在菜单显示</td>
				</tr> 
                 <tr>
				  <td class="td">栏目排序：
				  </td>
			    <td>
			       <input name="is_top" type="text" id="is_top" style="width: 50px;" value="<?php echo $row['is_top']?>" maxlength="10"/>&nbsp;&nbsp;&nbsp;&nbsp;填写整数，数字越大排序越靠前
                 </td>
				</tr>                              
				<tr>
					<td valign="top" class="td" style="padding-top: 7px;">
						栏目简介：
					</td>
					<td>
						<label>
				      <textarea name="smalltext" id="smalltext" cols="45" rows="5"><?php echo $row['smalltext']?></textarea>
				    </label>
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
<?php
	}
}
?>
	</body>
</html>
