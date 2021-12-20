<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	if(isset($action)&&$action== 'del'){
		if(!$id){
			$this->error('操作的ID号丢失！');
		}
		$sql = "delete from `".PRE."hits` where `id`=$id";
		$db->query($sql) or die (showmsg("删除统计出现错误"));		
		showmsg('删除成功！','ZC_Hits.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/Admin.css" rel="stylesheet" type="text/css" />
<script language="jscript">
 function selAll(e) {
 		var a = document.getElementsByName('id[]');
    var l = a.length; while(l--) a[l].checked=e.checked;
	}

</script>
</head>
<body>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<form id="form1" name="form1" method="post" action="">
 <tr>
 	<th width="5%" align="center" scope="col">ID</th>
    <th width="15%" align="center" scope="col">蜘蛛名称</th>
    <th width="15%" align="center" scope="col">日访问数</th>
    <th width="15%" align="center" scope="col">周访问数</th>
    <th width="15%" align="center" scope="col">月访问数</th>
    <th width="15%" align="center" scope="col">年访问数</th>
    <th width="15%" align="center" scope="col">总访问数</th>
    <th width="5%" align="center" scope="col">删除</th>
  </tr>
<?php
 	$pagesize=20;//分页大小
	$sql="select * from `".PRE."hits` order by `hits` desc";
	$arr=get_page_num($sql,$pagesize);
	$sql.=" limit $arr[1], $pagesize";
	$rs=$db->query($sql) or die("蜘蛛列表出错！");
	while($row = $db->fetch_array($rs)){
 ?>
 <tr>
   <td align="center"><?php echo $row['id']?></td>
   <td align="center" scope="col"><?php echo get_bot_name($row['bot'])?></td>
   <td align="center" scope="col"><?php echo $row['hits_day']?></td>
   <td align="center" scope="col"><?php echo $row['hits_week']?></td>
   <td align="center" scope="col"><?php echo $row['hits_month']?></td>
   <td align="center" scope="col"><?php echo $row['hits_yeah']?></td>
   <td align="center" scope="col"><?php echo $row['hits']?></td>
   <td align="center" scope="col"><a href="ZC_Hits.php?action=del&id=<?php echo $row['id']?>"><img src="Images/class_del.gif" alt="删除" /></a></td>
 </tr>

 <?php
	}
 ?>
  
  </form>
</table>
 <?php
	$page=new page($arr[0],$pagesize);
	echo $page->page();
 ?>
</body>
</html>

