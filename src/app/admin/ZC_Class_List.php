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
<script type="text/javascript"> 
	function DelOK(id){
		if(confirm("删除此栏目会删除此栏目下所有子栏目及所有文章，你确认要删除吗？")){ 
			window.location.href="ZC_Class_Edit.php?action=del&tid="+id;
		}else{ 
			history.go(0);	
		}
	}
</script>
</head>
<body>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="AdminTable">
 <tr>
    <th scope="col" width="10%">编号</th>
    <th scope="col" width="10%">模块</th>
    <th scope="col" width="*">类别名字</th>
    <th scope="col" width="9%">添加子类</th>
    <th scope="col" width="7%">修改</th>
    <th scope="col" width="7%">删除</th>
    <th scope="col" width="9%">查看内容</th>
  </tr>
<?php $type->class_list();?>
</table>
</body>
</html>

