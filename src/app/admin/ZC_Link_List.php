<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/Admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
$pagesize=20;
$sql="select * from `".PRE."link` order by `id`";
$arr=get_page_num($sql,$pagesize);
$sql.=" limit $arr[1], $pagesize";
$rs=$db->query($sql) or die (showmsg("友情连接列表出现错误"));
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="AdminTable">
	 <tr>
		<th scope="col" width="10%">编号</th><th scope="col" width="58%">连接名字</th>
		<th scope="col" width="7%">修改</th><th scope="col" width="7%">删除</th>
	  </tr>
	<?php while($row=$db->fetch_array($rs)){?>
		<tr> 
		<td><?php echo $row['id']?></td> 
		<td><?php 
		echo $row['title'];
		echo $row['is_show']==1?'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000">审</font>':'';
		echo $row['is_top']==1?'&nbsp;&nbsp;<font color="#FF0000">顶</font>':'';
		?></td> 
		<td><a href="ZC_Link_Manager.php?action=modify&tid=<?php echo $row['cid']?>&id=<?php echo $row['id']?>"><img src="Images/class_update.gif" alt="修改" /></a></td> 
		<td><a href="ZC_Link_Edit.php?action=del&id=<?php echo $row['id']?>"><img src="Images/class_del.gif" alt="删除" /></a></td> 
		</tr>
	<?php }?>
</table>
<?php
new page($arr[0],$pagesize);
?>
</body>
</html>

