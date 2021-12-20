<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	//表单提交时修改站点参数
	if(isset($submit)){
		global $db;
		$seo=$book=0;
		$seo=isset($_POST['seo'])?1:0;
		$book=isset($_POST['book'])?1:0;
		$sql="update `".PRE."system` set `name`='$name',`title`='$title',`keywords`='$keywords',`smalltext`='$smalltext',`url`='$url',`seo`=$seo,`book`=$book,`copyright`='$content' limit 1";
		$db->query($sql) or die ("修改系统参数出现错误");
		cache_table('system','*',true);
	}
		
		//显示站点参数
		$name=$title=$keywords=$smalltext=$url=$copyright="";
		$seo=$book=0;		
		$sql2="select * from `".PRE."system`";
		$rs=$db->query($sql2) or die (showmsg("显示系统参数出现错误"));		
		while($row=$db->fetch_array($rs)){
			$name=$row['name'];
			$title=$row['title'];
			$keywords=$row['keywords'];
			$smalltext=$row['smalltext'];
			$url=$row['url'];
			$seo=$row['seo'];
			$book=$row['book'];
			$copyright=$row['copyright'];
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>系统参数修改</title>
		<link href="css/Admin.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo FCK_DIR?>/fckeditor.js"></script>
    <style type="text/css">
<!--
.reds {
	color: #F00;
}
-->
    </style>
	</head>

<body>	
		<form action="" method="post" name="zzcms" id="zzcms">
			<table align=center border=0 cellspacing=0 cellpadding=0 width="95%">
				<tr>
					<th colspan="2" align="center">系统参数修改</th>
				</tr>
                	
				<tr>
					<td class="td">
						网站名称：
					</td>
					<td>
						<input name="name" type="text" id="name" style="width: 350px;" value="<?php echo $name?>" />
						(请填写网站的名字)</td>
				</tr>
                <tr>
				  <td class="td">网站标题：
					</td>
			    <td>
						<input name="title" type="text" id="title" style="width: 350px;" value="<?php echo $title?>" />
					(请填写网站标题) </td>
				</tr>
                <tr>
					<td class="td">关键字：
					</td>
			    <td>
						<input name="keywords" type="text" id="keywords" style="width: 350px;" value="<?php echo $keywords?>" />
					(请填写关键字) </td>
				</tr>
                <tr>
				  <td class="td">网站描述：
					</td>
			    <td>
						<input name="smalltext" type="text" id="smalltext" style="width: 350px;" value="<?php echo $smalltext?>" />
					(请填写网站描述：200字以内) </td>
				</tr>
				<tr>
					<td class="td">网站地址：
					</td>
					<td>
						<input name="url" type="text" id="url"
							style="width: 350px;" value="<?php echo $url?>" />
						(网站域名 后面带<span class="reds">'/</span>' 如：http://www.zzcms.com/)</td>
				</tr>
                <tr>
				  <td class="td">启用伪原创：
					</td>
			    <td>
			      <input name="seo" type="checkbox" id="seo" value="1" onClick="return false;" onMouseUp="this.checked=!this.checked" <?php if($seo==1){ echo "checked='checked'";}?> />
                
			      选中后在显示内容时部分词将被替换</td>
				</tr>
                <tr>
				  <td class="td">留言审核：
					</td>
			    <td>
			      <input name="book" type="checkbox" id="book" value="1" onClick="return false;" onMouseUp="this.checked=!this.checked" <?php if($book==1){ echo "checked='checked'";}?> />
                
			      选中后只有回复过的留言才能显示</td>
				</tr>                
				<tr>
					<td align="left" valign="top" class="td" style="padding-top: 7px;">
						版权信息：
					</td>
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
						<textarea name="content" id="content" style="display: none"><?php echo $copyright?></textarea>
					</td>
				</tr>
                
                
				<tr>
					<td class="td" width="11%">&nbsp;
						
					</td>
					<td width="89%">
						<input name="submit" type="submit" class="button" id="submit" value="提交" />
						<input name="Reset" type="reset" class="button" id="Reset"
							value="重置" />
					</td>
				</tr>
                
			</table>
</form>
     	</body>
</html>
