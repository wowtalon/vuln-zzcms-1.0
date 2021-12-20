<?php
	include("include/global.php");
	include("data/system_keyword.php");

	$seocontent='';
	if(isset($submit)){
		$seocontent=strtr($content,$keyword_system);
	}
	if(isset($reset)){
		$content=$seocontent;
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>免费的在线seo工具之伪原创</title>
<meta name="keywords" content="seo 伪原创">
<meta name="description" content="由www.zzzxw.com开发的免费的在线seo工具之伪原创，欢迎大家使用。seo伪原创工具，为你的网站添砖加瓦。">
<link href="css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="admin/fckeditor/fckeditor.js"></script>
</head>

<body>
<?php include("include/head.php");?>
<form action="" method="post" name="zzcms" id="zzcms">
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>   
         <script type="text/javascript">
		  window.onload = function()
		  {
			var oFCKeditor = new FCKeditor( 'content' ) ;
			oFCKeditor.BasePath	= 'admin/fckeditor/' ;
			oFCKeditor.Height = "350";
			oFCKeditor.ReplaceTextarea() ;
		  }
		</script>
		<textarea name="content" id="content" style="display: none"><?php echo $seocontent?></textarea>
      </td>
    </tr>
    <tr>
      <td>
        <input name="submit" type="submit" id="button" value="点击生成伪原创" />
        <input name="reset" type="reset" id="button2" value="重置" />
     </td>
    </tr>
  </table>
</form>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" class="fangfa">
  <tr>
    <th valign="middle">使用方法</th>
  </tr>
  <tr>
    <td valign="middle" class="content">
   	<p>用法：把文章粘贴到编辑器中，点击转换，则文章中的部分词组会被替换掉，以实现伪原创的目的。</p>
	<p>注意：转换以后请再检查您的文章是否通顺，确认文章的可读性</p>  
	</td>
  </tr>
</table>
<?php include("include/footer.php");?>
</body>
</html>
