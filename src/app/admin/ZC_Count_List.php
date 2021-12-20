<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	if(isset($action)&&$action== 'del'){
		$sql = "delete from `".PRE."access` where `id`=$id";
		$db->query($sql) or die (showmsg("删除蜘蛛统计出现错误"));		
		showmsg('删除成功！','ZC_Access_List.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/Admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="AdminTable">
 <tr>
    <th scope="col" width="9%">蜘蛛名称</th>
    <th scope="col" width="7%">来访次数</th>
    <th scope="col" width="15%">最后来访时间</th>
    <th scope="col" width="10%">IP地址</th>
    <th scope="col" width="54%">被访地址</th>
    <th scope="col" width="5%">删除</th>
  </tr>
<?php
 	$pagesize=20;//分页大小
	$sql="select * from `".PRE."count` order by `hit` desc";
	$arr=get_page_num($sql,$pagesize);
	$sql.=" limit $arr[1], $pagesize";
	$rs=$db->query($sql) or die("统计蜘蛛出错！");
	while($row = $db->fetch_array($rs)){
 ?>
 <tr>
   <td align="center" scope="col"><?php echo get_bot_name($row['bot'])?></td>
   <td align="center" scope="col"><?php echo $row['hit']?></td>
   <td align="center" scope="col"><?php echo format_date($row['time'],2)?></td>
   <td align="center" scope="col"><?php echo $row['ip']?></td>
   <td scope="col"><?php echo $row['url']?></td>
   <td align="center" scope="col"><a href="ZC_Count_list.php?action=del&id=<?php echo $row['id']?>"><img src="Images/class_del.gif" alt="删除" /></a></td>
 </tr>
 <?php
	}
 ?>
</table>
 <?php
 	new page($arr[0],$pagesize);
 ?>
</body>
</html>

