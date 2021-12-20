<?
include("include/global.php");
if(!isset($id)){
	showmsg('下载地址错误！');
}
$sql="select url from `".PRE."down` where `id`=$id";
$rs=$db->query($sql);
while($row=$db->fetch_array($rs)){
	$fileurl=ZZCMS_ROOT.$row['url'];
	$filename=end(explode("/",$fileurl));
	if(!file_exists($fileurl)) showmsg("文件不存在！");
	$file = fopen($fileurl,"r");
	Header("Content-type: application/octet-stream");
	Header("Accept-Ranges: bytes");
	Header("Accept-Length: ".filesize($fileurl));
	Header("Content-Disposition: attachment; filename=".$filename);
	echo fread($file,filesize($fileurl));
	fclose($file);
	$db->query("update `".PRE."down` set `hits`=`hits`+1 where id=$id");
	exit();
}
?>