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
    <th scope="col" width="10%">编号</th>
    <th scope="col" width="*">单页名字</th>
    <th scope="col" width="7%">修改</th>
    <th scope="col" width="7%">查看</th>
  </tr>
<?php
 	$pagesize=20;//分页大小
	$sql="select * from `".PRE."about` order by `id` desc";
	$arr=get_page_num($sql,$pagesize);
	$sql.=" limit $arr[1], $pagesize";
	$rs=$db->query($sql) or die("文章列表出错！");
	while($row = $db->fetch_array($rs)){
 ?>
 <tr>
   <td scope="col"><?php echo $row['cid']?></td>
   <td scope="col"><?php echo $row['name']?></td>
   <td scope="col"><a href="ZC_About_Manager.php?action=modify&tid=<?php echo $row['cid']?>&id=<?php echo $row['id']?>"><img src="Images/class_update.gif" alt="修改" /></a></td>
   <td scope="col"><a href="../About.php?id=<?php echo $row['id']?>" target="_blank"><img src="Images/class_select.gif" alt="查看" /></a></td>
 </tr>
 <?php
	}
 ?>
</table>
 <?php
 	$page=new page($arr[0],$pagesize);
	echo $page->page();
 ?>
         	
<table align=center border=0 cellspacing=0 cellpadding=0 width="95%">
  <tr>
    <th colspan="2" align="center"><span>说明</span></th>
  </tr>

  <tr>
    <td colspan="2" class="td"><P>　　删除单页面请到栏目管理内操作</P></td>
  </tr>
  </table>
</body>
</html>

