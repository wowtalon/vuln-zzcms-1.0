<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	if(isset($action)&& $action== 'add'){
		$sql="update `".PRE."book` set `answer`='".$answer."' where `id`=$id";
		$db->query($sql) or die (showmsg("回复留言出现错误"));
		showmsg('回复留言成功！','ZC_Book_List.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/Admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo FCK_DIR?>/fckeditor.js"></script>
</head>
<body>
<?php
	$sql="select * from `".PRE."book` where `id`=$id";
	$rs=$db->query($sql) or die (showmsg("后台查询留言列表出现错误"));
	while($row=$db->fetch_array($rs)){
?>
<table align=center border=0 cellspacing=1 cellpadding=5 width="95%">
  <tr>
    <td>ID:<?php echo $row['id']?></td>
    <td>标题：<?php echo $row['title']?></td>
    <td>呢称：<?php echo $row['name']?></td>
    <td> <a href="mailto:<?php echo $row['email']?>">mail</a></td>
    <td> QQ:<?php echo $row['qq']?></td>
    <td>IP:<?php echo $row['ip']?></td> 
    <td>时间:<?php echo format_date($row['time'],2)?></td> 
  </tr>
  <tr>
    <td colspan="8"><?php echo $row['content']?></td>
  </tr>
  <tr>
    <td colspan="8">
	<form id="form1" name="form1" method="post" action="ZC_Book_Hui.php?action=add&id=<?php echo $id?>">
        <div class='b_content'>
             <textarea name="answer" id="answer" cols="60" rows="6"><?php echo $row['answer']?></textarea><br />
             <input type="submit" name="button" id="button" value="提交" />
             <input type="reset" name="button2" id="button2" value="重置" />
        </div>
    </form>    
    </td>
  </tr>
</table>
<?php
	}
?>
</body>
</html>

