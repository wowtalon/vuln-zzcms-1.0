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
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
    <th scope="col" width="5%">编号</th>
    <th scope="col" width="25%">蜘蛛名称</th>
    <th scope="col" width="60%">蜘蛛标记</th>
    <th scope="col" width="5%">修改</th>
    <th scope="col" width="5%">删除</th>
  </tr>
<?php
 	$pagesize=20;//分页大小
	$sql="select * from `".PRE."botlist` order by `id` desc";
	$arr=get_page_num($sql,$pagesize);
	$sql.=" limit $arr[1], $pagesize";
	$rs=$db->query($sql) or die("蜘蛛列表出错！");
	while($row = $db->fetch_array($rs)){
 ?>
 <tr>
   <td scope="col"><?php echo $row['id']?></td>
   <td scope="col"><?php echo $row['name']?></td>
   <td scope="col"><?php echo $row['biaoji']?></td>
   <td align="center" scope="col"><a href="ZC_Botlist_Manager.php?action=modify&id=<?php echo $row['id']?>"><img src="Images/class_update.gif" alt="修改" /></a></td>
   <td align="center" scope="col"><a href="ZC_Botlist_Edit.php?action=del&id=<?php echo $row['id']?>"><img src="Images/class_del.gif" alt="删除" /></a></td>
 </tr>
 <?php
	}
 ?>
</table>
 <?php
 	$page=new page($arr[0],$pagesize);
	echo $page->page();
 ?>
</body>
</html>

