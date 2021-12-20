<?php 
session_start(); 
if(!isset($_SESSION['uid'])) exit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文件上传</title>
</head>

<body>
<form action="up2.php" method="post" enctype="multipart/form-data" name="add_pic1" id="add_pic1">
  <p>
    <label>
      <input type="file" name="file" id="file" />
    </label>
  </p>
  <p>
    <label>
      <input type="submit" name="button" id="button" value="提交" />
    </label>
    <label>
      <input type="reset" name="button2" id="button2" value="重置" />
    </label>
  </p>
</form>
</body>
</html>