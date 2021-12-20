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
<script type="text/javascript" src="js/public.js"></script>
</head>
<body>
<form id="form1" name="form1" method="post" action="ZC_Article_Edit.php?action=del">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
	<th width="8%" align="left" scope="col">&nbsp;&nbsp;<input name="checkbox" type="checkbox" class="checkbox"  onClick="selAll(this)" value="选择全部">&nbsp;&nbsp;全部选择</th>
    <th scope="col" width="*">标题</th>
    <th scope="col" width="8%">类别</th>
    <th scope="col" width="5%">点击次数</th>
    <th scope="col" width="4%">修改</th>
    <th scope="col" width="4%">删除</th>
    <th scope="col" width="4%">查看</th>
 </tr>
 <?php
 	$pagesize=5;//分页大小
	$sql="select * from `".PRE."article` order by `id` desc";
	$arr=get_page_num($sql,$pagesize);
	$sql.=" limit $arr[1], $pagesize";
	$rs=$db->query($sql) or die(showmsg("文章列表出错！"));
	while($row = $db->fetch_array($rs)){
 ?>
 <tr>
   <td scope="col"><input name="id[]" type="checkbox" id="id[]" value="<?php echo $row['id']?>"><?php echo $row['id']?></td>
   <td scope="col">
   <?php 
   	   echo $row['title']; 
	   echo $row['pic']<>''?'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000">图</font>':'';
	   echo $row['is_hot']==1&&$row['pic']<>''?'&nbsp;&nbsp;<font color="#FF0000">灯</font>':'';
	   echo $row['is_top']==1?'&nbsp;&nbsp;<font color="#FF0000">顶</font>':'';
   ?></td>
   <td scope="col"><?php echo $type->class_name(intval($row['cid']))?></td>
   <td scope="col"><?php echo $row['hits']?></td>   
   <td scope="col"><a href="ZC_Article_Manager.php?action=modify&tid=<?php echo $row['cid']?>&id=<?php echo $row['id']?>"><img src="Images/class_update.gif" alt="修改" /></a></td>
   <td scope="col"><a href="ZC_Article_Edit.php?action=del&id=<?php echo $row['id']?>"><img src="Images/class_del.gif" alt="删除" /></a></td>
   <td scope="col"><a href="../Art_Show.php?id=<?php echo $row['id']?>" target="_blank"><img src="Images/class_select.gif" alt="查看" /></a></td>
 </tr>
 <?php
	}
 ?>
   <tr>
   <td colspan="7">
   <input name="checkbox" type="checkbox" class="checkbox"  onClick="selAll(this)" value="选择全部">&nbsp;&nbsp;全部选择&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input name="submit" type="submit" class="inputButton" onclick="return confirm('确定提交吗');" value="批量删除"/></td>
  </tr>
</table>
 </form>
 <?php
	$page=new page($arr[0],$pagesize);
	echo $page->page();
 ?>

</body>
</html>

