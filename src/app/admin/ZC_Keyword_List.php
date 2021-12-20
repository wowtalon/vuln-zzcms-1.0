<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统词组列表</title>
<link href="css/Admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/common.js"></script>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0" class="AdminTable">
  <tr>
    <td>
    搜索关键字：
    <input name="keyword" type="text" id="keyword" value="" size="20" />
    <input type="submit" name="button" id="button" value="提交" />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../seo.php" target="_blank">伪原创页面</a></td>
  </tr>
</table>
</form>

<form id="form1" name="form1" method="post" action="System_Keyword_Edit.php?action=del">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="AdminTable">
 <tr>
	<th scope="col" width="10%">编号</th>
    <th scope="col" width="20%">关键词</th>
    <th scope="col" width="20%">替换词</th>
    <th scope="col" width="5%">首字母</th>
    <th scope="col" width="5%">长度</th>
    <th scope="col" width="10%">添加时间</th>
    <th scope="col" width="5%">修改</th>
    <th scope="col" width="5%">删除</th>
  </tr>
 <?php
 	$pagesize=30;//分页大小
	$sql="";
	if(isset($keyword)&&$keyword){
		$sql="select * from `".PRE."keywords` where `keyword` like '%$keyword%' order by `id` desc";
	}else{
		$sql="select * from `".PRE."keywords` order by `id` desc";
	}
	$arr=get_page_num($sql,$pagesize);
	$sql.=" limit $arr[1], $pagesize";
	$rs=$db->query($sql) or die("文章列表出错！");
	while($row = $db->fetch_array($rs)){
 ?>
 <tr>
   <td scope="col"><input name="id[]" type="checkbox" id="id[]" value="<?php echo $row['id']?>" class="checkbox"><?php echo $row['id']?></td>
   <td align="center" scope="col"><?php echo $row['keyword']?></td>
   <td align="center" scope="col"><?php echo $row['replace']?></td>
   <td align="center" scope="col"><?php echo $row['zimu']?></td>
   <td align="center" scope="col"><?php echo $row['klen']?></td> 
   <td align="center" scope="col"><?php echo format_date($row['addtime'],1)?></td>
   <td align="center" scope="col"><a href="ZC_Keyword_Manager.php?action=modify&id=<?php echo $row['id']?>"><img src="Images/class_update.gif" alt="修改" /></a></td>
   <td align="center" scope="col"><a href="ZC_Keyword_Edit.php?action=del&id=<?php echo $row['id']?>"><img src="Images/class_del.gif" alt="删除" /></a></td>
  </tr>
 <?php
	}
 ?>
  <tr>
   <td  colspan="1"><input name="checkbox" type="checkbox" class="checkbox"  onClick="selAll(this)" value="选择全部">
   全部选择</td>
	<td  colspan="9"><input name="submit" type="submit" class="inputButton" value="批量删除"/>
    </td>
  </tr>
    <tr>
   <td colspan="10" scope="col" class='page_h'>
 <?php
 	$page=new page($arr[0],$pagesize);
	echo $page->page();
 ?>
   </td>
  </tr>
</table>
</form>

</body>
</html>

