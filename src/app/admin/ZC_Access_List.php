<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	if(isset($submit)||(isset($action)&&$action=='del')){
		if(!isset($id)){
			showmsg('未选择记录');
		}
		if(is_array($id)){
			$id=implode(',',$id);
		}
		if(!$id){
			showmsg('操作的ID号丢失！');
		}
		$sql = "delete from `".PRE."access` where `id` in ($id)";
		$db->query($sql) or die (showmsg("删除记录出现错误"));		
		showmsg('删除成功！','ZC_Access_List.php');
	}
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
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<form id="form1" name="form1" method="post" action="">
 <tr>
 	<th width="8%" align="left" scope="col">&nbsp;&nbsp;<input name="checkbox" type="checkbox" class="checkbox"  onClick="selAll(this)" value="选择全部">&nbsp;&nbsp;全部选择</th>
    <th scope="col" width="9%">蜘蛛名称</th>
    <th scope="col" width="13%">最后来访时间</th>
    <th scope="col" width="11%">IP地址</th>
    <th scope="col" width="50%">被访地址</th>
    <th scope="col" width="9%">删除</th>
  </tr>
<?php
 	$pagesize=20;//分页大小
	$sql="select * from `".PRE."access` order by `id` desc";
	$arr=get_page_num($sql,$pagesize);
	$sql.=" limit $arr[1], $pagesize";
	$rs=$db->query($sql) or die("打开蜘蛛详细记录列表出错！");
	while($row = $db->fetch_array($rs)){
 ?>
 <tr>
   <td><input name="id[]" type="checkbox" id="id[]" value="<?php echo $row['id']?>"><?php echo $row['id']?></td>
   <td align="center" scope="col"><?php echo get_bot_name($row['bot'])?></td>
   <td align="center" scope="col"><?php echo format_date($row['time'],2)?></td>
   <td align="center" scope="col"><?php echo $row['ip']?></td>
   <td scope="col"><?php echo $row['url']?></td>
   <td align="center" scope="col"><a href="ZC_Access_List.php?action=del&id=<?php echo $row['id']?>"><img src="Images/class_del.gif" alt="删除" /></a></td>
 </tr>

 <?php
	}
 ?>
  <tr>
   <td colspan="6">
   <input name="checkbox" type="checkbox" class="checkbox"  onClick="selAll(this)" value="选择全部">&nbsp;&nbsp;全部选择&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input name="submit" type="submit" class="inputButton" onclick="return confirm('确定提交吗');" value="批量删除"/></td>
  </tr>
  </form>
</table>
 <?php
	$page=new page($arr[0],$pagesize);
	echo $page->page();
 ?>
</body>
</html>

