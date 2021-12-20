<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZZCMS</title>
<link href="css/Admin.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table align=center border=0 cellspacing=1 cellpadding=5 width="95%">
  <tr>
    <td height="200" valign="top">
      <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <th colspan="2">系统信息</th>
      </tr>
      <tr>
        <td width="80" class="td">授&nbsp;&nbsp;权&nbsp;&nbsp;给：</td>
        <td width="*"><?php echo $system['name'];?></td>
      </tr>
      <tr>
        <td class="td">当前用户：</td>
        <td><?php echo $row['name'];?></td>
      </tr>
      <tr>
        <td class="td">程序名称：</td>
        <td>ZZCMS</td>
      </tr>
      <tr>
        <td class="td">程序版本：</td>
        <td>V1.0 SP3</td>
      </tr>
      <tr>
        <td class="td">程序作者：</td>
        <td>壮壮</td>
      </tr>
      <tr>
        <td class="td">联系作者：</td>
        <td>QQ5404172</td>
      </tr>
    </table>
    <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr class="td">
        <th align="center">系统介绍</th>
      </tr>
      <tr>
        <td align="left" class="td">
        <P>　　图：此条内容包含缩略图</P>
        <P>　　顶：此条内容优先显示</P>
        <P>　　灯：自动添加到幻灯片，条件是此条内容须包含缩略图以及选中幻灯片</P>
        <P>　　审：审核通过</P>
        <P>　　版权&amp;法律声明:</P>
        <P>　　1,此系统(ZZCMS网站内容管理系统，下同)可免费使用于学习与交流目的。</P>
        <P>　　2,此系统可免费使用于个人或企业建设网站使用。</P>
        <P>　　3,用户可对此系统进行二次开发，但不得用于商业或赢利目的。</P>
        <P>　　4,此系统中所有作者及版权信息均不得删除和修改，否则视为侵权。</P>
        <P>　　5,不可对此系统进行任何形式的销售和分发</P>
        </td>
      </tr>
    </table>
    <br /></td>
  </tr>
  
  <tr>
    <td align="right" class="td">&nbsp; </td>
  </tr>
</table>
</body>
</html>
