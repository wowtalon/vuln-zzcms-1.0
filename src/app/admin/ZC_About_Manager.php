<?php 
	include("../include/global.php");
	include("ZC_Check_admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>栏目管理</title>
		<link href="css/Admin.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/public.js"></script>
		<script type="text/javascript" src="<?php echo FCK_DIR?>/fckeditor.js"></script>
		<script language="JavaScript">
        <!--
        function chk(theForm){
                if (theForm.name.value == ""){
                        alert("名字不能为空");
                        theForm.name.focus();
                        return (false);
                }
                if (theForm.title.value == ""){
                        alert("标题不能为空");
                        theForm.title.focus();
                        return (false);
                }
        }
        //-->
        </script>
	</head>

	<body>
    <?php
		if(isset($action)&&$action=='add'){
	?>

<form action="ZC_About_Edit.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
<table align=center border=0 cellspacing=0 cellpadding=0 width="95%">
  <tr>
    <th colspan="2" align="center"><span>添加单页内容</span></th>
  </tr>
  <tr>
    <td class="td">名称：</td>
    <td><input name="name" type="text" id="name" style="width:230px;" maxlength="12" />
    *</td>
  </tr>
  <tr>
    <td class="td">标题：</td>
    <td><input name="title" type="text" id="title" style="width:500px;" maxlength="60" />
    *</td>
  </tr>
  <tr>
    <td class="td">标题图片：</td>
    <td>
      <input name="pic" type="text" id="_TopImage" style="width:500px;" maxlength="60" />
      <input type="button" class="button" value="上传" onclick="openScript('upfile/up1.php',460,220);" />
      </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="td" style="padding-top:7px;">具体内容：</td>
    <td>
			<script type="text/javascript">
						  window.onload = function()
						  {
							var oFCKeditor = new FCKeditor( 'content' ) ;
							oFCKeditor.BasePath	= '<?php echo FCK_DIR?>/' ;
							oFCKeditor.Height = "350";
							oFCKeditor.ReplaceTextarea() ;
						  }
						</script>
						<textarea name="content" id="content" style="display: none"></textarea>    
    
    </td>
  </tr>
  
  <tr>
    <td class="td" width="11%">&nbsp;</td>
    <td width="89%">
	  <input name="Submit" type="submit" class="button" value="添 加" />
	  <input name="Reset" type="reset" class="button" id="Reset" value="重 置" /></td>
  </tr>

</table>
</form>
     <?php 
		}else{ 
		$sql="select * from `".PRE."about` where `id`=$id";
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
	?>
    
 <form action="ZC_About_Edit.php?action=modify&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
<table align=center border=0 cellspacing=0 cellpadding=0 width="95%">
  <tr>
    <th colspan="2" align="center"><span>修改单页内容</span></th>
  </tr>

  <tr>
    <td class="td">名称：</td>
    <td><?php echo $row['name']?>
    </td>
  </tr>
  <tr>
    <td class="td">标题：</td>
    <td><input name="title" type="text" id="title" style="width:500px;" value="<?php echo $row['title']?>" size="60" />
    *</td>
  </tr>
  <tr>
    <td class="td">标题图片：</td>
    <td><input name="pic" type="text" id="_TopImage2" style="width:500px;" value="<?php echo $row['pic']?>" maxlength="60" />      <input type="button" class="button" value="上传" onclick="openScript('upfile/up1.php',460,220);" />
      </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="td" style="padding-top:7px;">具体内容：</td>
    <td>
			<script type="text/javascript">
			  window.onload = function()
			  {
				var oFCKeditor = new FCKeditor( 'content' ) ;
				oFCKeditor.BasePath	= '<?php echo FCK_DIR?>/' ;
				oFCKeditor.Height = "350";
				oFCKeditor.ReplaceTextarea() ;
			  }
			</script>
			<textarea name="content" id="content" style="display: none"><?php echo $row['content']?></textarea>    

    </td>
  </tr>
  
  <tr>
    <td class="td" width="11%">&nbsp;</td>
    <td width="89%">
	  <input name="Submit" type="submit" class="button" value="修 改" />
	  <input name="Reset" type="reset" class="button" id="Reset" value="重 置" /></td>
  </tr>

</table>
</form>   
    
<?php }}?>
<table align=center border=0 cellspacing=0 cellpadding=0 width="95%">
  <tr>
    <th colspan="2" align="center"><span>说明</span></th>
  </tr>

  <tr>
    <td colspan="2" class="td"><P>　　单页名字、关键字、描述的添加或者修改请到栏目管理内操作</P></td>
  </tr>
</table>
     	</body>
</html>
