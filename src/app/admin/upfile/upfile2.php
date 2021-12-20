<?php
include("../../include/global.php");
include("../ZC_Check_admin.php");
	$file=new upfile("file");
	//可以上传RAR ZIP DOC XLS PPT CHM PDF等文件
	$file->allow_type=array('application/octet-stream','application/zip','application/msword','application/vnd.ms-excel','application/vnd.ms-powerpoint','application/pdf');
	$file->is_upload_file();
	$file->check_file_name();
	$file->is_big();
	$file->check_type();
	$f_name=$file->upload_file();
	$f_name=str_replace('../../','',$f_name);
?>
<script language="JavaScript"> 
Addpic('<?php echo $f_name;?>');
function Addpic(imagePath){
	window.opener.document.zzcms.url.focus();								
	window.opener.document.zzcms.url.value=imagePath;
    window.opener=null;
    window.close();
}
</script>