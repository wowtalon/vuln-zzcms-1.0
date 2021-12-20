<?php
	session_start();
	header("content-type:text/html; charset=utf-8"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZZCMS安装程序</title>
<script type="text/javascript">
function chk(zform){
	if(zform.local.value == ''){
		alert('请输入数据库地址！');
		zform.local.focus();
		return false;
	}
	if(zform.user.value == ''){
		alert('请输入数据库用户名！');
		zform.user.focus();
		return false;
	}
	if(zform.date.value == ''){
		alert('请输入数据库名字！');
		zform.date.focus();
		return false;
	}
	if(zform.pass.value == ''){
		alert('请输入加密字符！');
		zform.pass.focus();
		return false;
	}
	if(zform.adminname.value == ''){
		alert('请输入管理员用户名！');
		zform.adminname.focus();
		return false;
	}
	if(zform.adminpass.value == ''){
		alert('请输入管理员密码！');
		zform.adminpass.focus();
		return false;
	}
	return true;
}
</script>
<link href="install.css" rel="stylesheet" type="text/css" />

</head>

<body>
<?php
	$files="../include/config.php";	
	if(!is_writable($files)){
		echo "<table width='500' align=center border=0 cellspacing=0 cellpadding=0>";
		echo "<th align='center'>ZZCMS V1.0 SP3 安装程序</th><tr><td>";
		echo "<font color='red'>配置文件不可写！</font>";
		exit;
		echo "<tr><td colspan='2'>官方网站：<a href='http://www.zzcms.com/' target='_blank'>www.zzcms.com</a></td></tr>";
		echo "</td></tr></table>";
	}
	if(isset($_GET['action'])&&$_GET['action']=="setp1"){
			write_fig($files);
	}elseif(isset($_GET['action'])&&$_GET['action']=="setp2"){
		echo "<table width='500' align=center border=0 cellspacing=0 cellpadding=0>";
		echo "<th align='center'>ZZCMS V1.0 安装程序</th><tr><td>";
		include("../include/config.php");
		$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("数据库配置信息错误：" . mysql_error());
		mysql_query("SET NAMES utf8");
		if(!@mysql_select_db(DB_DATE, $link)){
				@mysql_query("CREATE DATABASE ".DB_DATE);
				if(@mysql_error()) {
					echo 1;exit;
				} else {
					mysql_select_db(DB_DATE);
				}			
		}
		echo "正在执行导入操作……<br />";
		$mysql_file='zzcms.sql';
		$handle=fopen($mysql_file,"r") or die("不能打开SQL文件 $mysql_file");
		while($insql=get_sql($handle)){
			if(!mysql_query($insql)){
				echo "<br /><font color='red'>初始化数据库出现错误.</font><br />";
				echo "<font color='red'>出现错误语句为:</font>$insql<br />";
				echo "<font color='red'>初始化数据库失败，请删除此数据库后重新安装</font><br />";
				echo "<a href='index.php'>返回</a>";
				exit;
			}
		}	
		echo "数据库导入成功<br />";
		echo "<a href='index.php?action=setp3'><font color='red'>下一步</font></a>";
		echo "<tr><td colspan='2'>官方网站：<a href='http://www.zzcms.com/' target='_blank'>www.zzcms.com</a></td></tr>";
		echo "</td></tr></table>";
		fclose($handle);
	}elseif(isset($_GET['action'])&&$_GET['action']=="setp3"){
		add_admin();
	}elseif(isset($_GET['action'])&&$_GET['action']=="setp4"){
		include("../include/config.php");
		include("../lib/ZC_Function.php");
		$name=trim($_POST['adminname']);
		$pass=md5(trim($_POST['adminpass']).ZZCMS);
		echo "<table width='500' align=center border=0 cellspacing=0 cellpadding=0>";
		echo "<th align='center'>ZZCMS V1.0 SP3  安装程序</th><tr><td>";
		$sql="INSERT INTO `".PRE."admin` (`uid`, `name`, `password`, `grade`) VALUES(1, '".$name."', '".$pass."', 1)";
		$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("数据库配置信息错误：" . mysql_error());
		mysql_query("SET NAMES utf8");
		mysql_select_db(DB_DATE, $link) or die("未能找到数据库：" . DB_DATE);
		mysql_query($sql) or die ("添加管理员失败！");
		echo "添加管理员成功<br />";
		echo "<a href='../admin/AdminLogin.php'>前往后台</a><br />";
		echo "<a href='../index.php'>前往前台</a><br />";
		echo "为了安全，请删除install目录";	
		echo "<tr><td colspan='2'>官方网站：<a href='http://www.zzcms.com/' target='_blank'>www.zzcms.com</a></td></tr>";
		echo "</td></tr></table>";
	}
	if(!isset($_GET['action'])){
			index_fig();
	}
	
?>
</body>
</html>
<?php
//写入配置信息到配置文件
function write_fig($file_fig){
	$str="<?php\r\n";
	$str.="	define('DB_HOST', '".trim($_POST['local'])."'); //数据库服务器地址\r\n";
	$str.="	define('DB_DATE', '".trim($_POST['date'])."'); //数据库名字\r\n";
	$str.="	define('DB_USER', '".trim($_POST['user'])."'); //用户名\r\n";
	$str.="	define('DB_PASS', '".trim($_POST['password'])."'); //密码\r\n";
	$str.="	define('PRE','".trim($_POST['pre'])."');//数据库前缀\r\n";
	$str.="	define('FCK_DIR','fckeditor');//定义编辑器路径\r\n";
	$str.="	define('ZZCMS','".trim($_POST['pass'])."');//加密所用常量\r\n";
	$str.="	define('ZZCMS_TAGS', '<a><p><br><hr><h1><h2><h3><h4><h5><h6><font><u><i><b><strong><div><span><ol><ul><li><img><table><tr><td><map>'); //前台发布信息允许的HTML标签\r\n";
	$str.="?>\r\n";
	$fig=fopen($file_fig,"w+");
	fwrite($fig,$str);
	echo "<table width='500' align=center border=0 cellspacing=0 cellpadding=0 class='AdminTable'>";
	echo "<th align='center'>ZZCMS V1.0 安装程序</th><tr><td>";
	echo "配置文件写入成功<br />";
	echo "点击进入<a href='index.php?action=setp2'><font color='red'>下一步</font></a>";
	echo "<tr><td colspan='2'>官方网站：<a href='http://www.zzcms.com/' target='_blank'>www.zzcms.com</a></td></tr>";
	echo "</td></tr></table>";
}

//得到SQL文件
function get_sql($fp){
	$sql="";
	while($line=@fgets($fp,40960)){
		$line=trim($line);
		if(strlen($line)>0){
			if($line[0]=="-"&&$line[1]=="-"){//如果是注释则退出当前行
				continue;
			}
		}
		if(strlen($line)==0){
			continue;
		}
		$sql.=$line;
		if (strlen($line)>0){
			if ($line[strlen($line)-1]==";"){
				break;
			}
		}
	}
		
	$sql=str_replace("_PRE_",PRE,$sql);
	return $sql;	

}
//填写配置信息函数
function index_fig(){
?>
<form id="form1" name="form1" method="post" action="index.php?action=setp1" onSubmit="return chk(this)">
  <table width="500" align=center border=0 cellspacing=0 cellpadding=0>
    <tr>
		<th colspan="2" align="center">ZZCMS V1.0 SP3 安装程序</th>
	</tr>
    <tr>
      <td>主机地址：</td>
      <td><label>
        <input name="local" type="text" id="local" value="localhost" />
        请填写数据库地址
      </label></td>
    </tr>
    <tr>
      <td>用 户 名：</td>
      <td><input type="text" name="user" id="user" />
      请填写用户名</td>
    </tr>
    <tr>
      <td>密 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</td>
      <td><label>
        <input type="text" name="password" id="password" />
      请填写你的密码</label></td>
    </tr>
    <tr>
      <td>数 据 库：</td>
      <td><label>
        <input type="text" name="date" id="date" />
      请填写你的数据库名字</label></td>
    </tr>
    <tr>
      <td>表名前缀：</td>
      <td><label>
        <input name="pre" type="text" id="pre" value="zzcms_" />
      请填写表名前缀，如：zzcms_</label></td>
    </tr>
     <tr>
      <td>加密字符：</td>
      <td><label>
        <input type="text" name="pass" id="pass" value="zzcms" />
        重要，填写后不可更改
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="install" id="install" value="下一步" />
      </label></td>
    </tr>
     <tr><td colspan="2">官方网站：<a href="http://www.zzcms.com/" target="_blank">www.zzcms.com</a></td></tr>
  </table>
</form>
<?php
}
//写入管理员信息
function add_admin(){
?>
<form id="form1" name="form1" method="post" action="index.php?action=setp4" onSubmit="return chk(this)">
  <table width="500" align=center border=0 cellspacing=0 cellpadding=0>
   <tr>
		<th colspan="2" align="center">ZZCMS V1.0 SP3  安装程序</th>
	</tr>
    <tr>
      <td>用 户 名：</td>
      <td><input type="text" name="adminname" id="adminname" />
      请填写管理员用户名</td>
    </tr>
    <tr>
      <td>密 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</td>
      <td><label>
        <input type="text" name="adminpass" id="adminpass" />
      请填写管理员密码</label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="submit" id="submit" value="下一步" />
      </label></td>
    </tr>
     <tr><td colspan="2">官方网站：<a href="http://www.zzcms.com/" target="_blank">www.zzcms.com</a></td></tr>
  </table>
</form>
<?php
}
?>