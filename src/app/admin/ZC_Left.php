<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZZCMS</title>
<link href="css/Admin.css" rel="stylesheet" chaid="text/css" />

</head>

<body>
<table width="160" border=0 align=center cellpadding=0 cellspacing=0> 
  <tr>
    <th align="center"><a href="../index.php" target=_blank>首页</a>┊<a href="ZC_Main.php" target="mainFrame">管理首页</a>┊<a href="javascript:;" onclick="if(confirm('确认要退出登录吗?')){top.location.href='AdminLogout.php';}">退出</a></th>
  </tr>
</table>

<!--系统设置-->
<table width="160" border=0 align=center cellpadding=0 cellspacing=0> 
 <tr>
    <th>系统设置</th>
  </tr>
   <tr>
    <td align="center"><a href="ZC_System.php" target="mainFrame">站点参数</a>┊<a href="ZC_Password.php" target="mainFrame">修改密码</a></td>
  </tr>

   <tr>
    <td align="center"><a href="ZC_Book_List.php" target="mainFrame">留言管理</a>┊<a href="ZC_Make_Cache.php?action=make" target="mainFrame">生成缓存</a></td>
  </tr>
  </table>
    
<!--栏目管理-->
<table width="160" border=0 align=center cellpadding=0 cellspacing=0> 
 <tr>
    <th>栏目管理</th>
  </tr> 
  <tr>
      <td align="center"><a href="ZC_Class_Manager.php?action=add" target="mainFrame">添加栏目</a>┊<a href="ZC_Class_List.php" target="mainFrame">栏目管理</a></td>
  </tr>
</table>

<!--单页管理-->
<table width="160" border=0 align=center cellpadding=0 cellspacing=0> 
 <tr>
    <th>单页管理</th>
  </tr> 
  <tr>
      <td align="center"><a href="ZC_About_Manager.php?action=add" target="mainFrame">添加单页</a>┊<a href="ZC_About_List.php" target="mainFrame">单页管理</a></td>
  </tr>
</table>
  
<!--文章管理-->
<table width="160" border=0 align=center cellpadding=0 cellspacing=0> 
 <tr>
    <th>文章管理</th>
  </tr> 
  <tr>
    <td align="center"><a href="ZC_Article_Manager.php?action=add" target="mainFrame">添加文章</a>┊<a href="ZC_Article_List.php" target="mainFrame">文章管理</a></td>
  </tr> 
</table>

<!--产品管理-->
<table width="160" border=0 align=center cellpadding=0 cellspacing=0> 
 <tr>
    <th>产品管理</th>
  </tr> 
  <tr>
    <td align="center"><a href="ZC_Pro_Manager.php?action=add" target="mainFrame">添加产品</a>┊<a href="ZC_Pro_List.php" target="mainFrame">产品管理</a></td>
  </tr>
</table>
    
<!--下载管理-->
<table width="160" border=0 align=center cellpadding=0 cellspacing=0> 
 <tr>
    <th style="cursor:pointer;">下载管理</th>
  </tr> 
  <tr>
    <td align="center"><a href="ZC_Down_Manager.php?action=add" target="mainFrame">添加下载</a>┊<a href="ZC_Down_List.php" target="mainFrame">下载管理</a></td>
  </tr>

</table>

<!--友情连接管理-->
<table width="160" border=0 align=center cellpadding=0 cellspacing=0> 
 <tr>
    <th style="cursor:pointer;">友情连接管理</th>
  </tr> 

   <tr>
    <td align="center"><a href="ZC_Link_Manager.php?action=add" target="mainFrame">添加连接</a>┊<a href="ZC_Link_List.php" target="mainFrame">连接管理</a></td>
  </tr>
</table>
<!--友情连接管理-->
<table width="160" border=0 align=center cellpadding=0 cellspacing=0> 
 <tr>
    <th style="cursor:pointer;">替换词组管理</th>
  </tr> 

  <tr>
    <td align="center"><a href="ZC_Keyword_Manager.php?action=add" target="mainFrame">添加词组</a>┊<a href="ZC_Keyword_List.php" target="mainFrame">词组管理</a></td>
  </tr>
</table>

<!--蜘蛛管理-->
<table width="160" border=0 align=center cellpadding=0 cellspacing=0> 
 <tr>
    <th style="cursor:pointer;">蜘蛛管理</th>
  </tr> 

   <tr>
    <td align="center"><a href="ZC_Botlist_Manager.php?action=add" target="mainFrame">添加蜘蛛</a>┊<a href="ZC_Botlist_List.php" target="mainFrame">蜘蛛管理</a></td>
  </tr>
   <tr>
    <td align="center"><a href="ZC_Count_List.php" target="mainFrame">访问统计</a>┊<a href="ZC_Access_List.php" target="mainFrame">详细记录</a></td>
  </tr> 
  <tr>
    <td align="center"><a href="ZC_Hits.php" target="mainFrame">排行榜(日、周、月、年)</a></td>
  </tr>
</table>
<!--版权声明-->
<table align="center" border="0" cellspacing="0" cellpadding="0" width="160">
  <tr>
    <th>版权声明</th>
  </tr>
  <tr>
    <td height="60" align="left">
      作者：壮壮<br />
      QQ：5404172<br />
      <a href="http://www.zzcms.com" target="_blank">www.zzcms.com
      </a></td>
  </tr>
</table>
</body>
</html>
