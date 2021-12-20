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
<script type="text/javascript" src="<?php echo FCK_DIR?>/fckeditor.js"></script>
<script type="text/javascript" src="js/public.js"></script>
<script type="text/javascript"> 
	function DelOK(id){
		if(confirm("你确认要删除些留言吗？")){ 
			window.location.href="ZC_Book_List.php?action=del&id="+id;
		}else{ 
			history.go(0);	
		}
	}
</script>
</head>
<body>

<?php
	if(isset($action)){
		if(!isset($id)){
			showmsg('未选择记录');
		}
		if(is_array($id)){
			$id=implode(',',$id);
		}
		if(!$id){
			showmsg('操作的ID号丢失！');
		}
		$sql="delete from `".PRE."book` where `id` in ($id)";
		$db->query($sql) or die (showmsg("删除留言出现错误"));
		showmsg('删除留言成功！','ZC_Book_List.php');
	}else{
		$pagesize=10;//分页大小
		$sql="select * from `".PRE."book` order by `id` desc";
		$arr=get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die (showmsg("后台查询留言列表出现错误"));
		?> 
        <form id="form1" name="form1" method="post" action="ZC_Book_List.php?action=del">
        <?php while($row=$db->fetch_array($rs)){?>

    <table align=center border=0 cellspacing=1 cellpadding=5 width="95%">
      <tr>
        <td width="5%" ><input name="id[]" type="checkbox" id="id[]" value="<?php echo $row['id']?>"><?php echo $row['id']?></td>
        <td>标题：<?php echo $row['title']?></td>
        <td width="15%" >呢称：<?php echo $row['name']?></td>
        <td width="5%" > <a href="mailto:<?php echo $row['email']?>">mail</a></td>
        <td width="8%" > QQ:<?php echo $row['qq']?></td>
        <td width="12%" >IP:<?php echo $row['ip']?></td>
        <td width="5%" ><a href='ZC_Book_Hui.php?id=<?php echo $row['id']?>'>回复</a></td>
        <td width="5%" ><a onClick='DelOK(<?php echo $row['id']?>)' href='#'>删除</a></td>
      </tr>
      <tr>
        <td colspan="8"><?php echo $row['content']?></td>
      </tr>
      <tr>
        <td colspan="8"><?php echo $row['answer']!=null?'<div class="b_answer"><font color="red">您的回复：<br></font>'.$row['answer'].'</div>':"暂无回复"?></td>
      </tr>   
	  </table>    
   <?php }?>
    <table align=center border=0 cellspacing=1 cellpadding=5 width="95%">
	   <tr>
       <td colspan="8">
       <input name="checkbox" type="checkbox" class="checkbox"  onClick="selAll(this)" value="选择全部">&nbsp;&nbsp;全部选择&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input name="submit" type="submit" class="inputButton" onclick="return confirm('确定提交吗');" value="批量删除"/></td>
      </tr>
     </table>
</form>
		 <?php 
		$page=new page($arr[0],$pagesize);
		echo $page->page();
}
?>
</body>
</html>

