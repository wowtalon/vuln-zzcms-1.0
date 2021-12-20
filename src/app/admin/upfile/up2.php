<?php
include("../../include/global.php");
include("../ZC_Check_admin.php");
	$file=new upfile("file");
	$file->is_upload_file();
	$file->check_file_name();
	$file->is_big();
	$file->check_type();
	$f_name=$file->upload_file();
	$f_name=str_replace('../../','',$f_name);
	$file->create_simg(120,120);
?>
<script language="JavaScript"> 
Addpic('<?php echo $f_name;?>');
function Addpic(imagePath){
	window.opener.document.zzcms.pic.focus();								
	window.opener.document.zzcms.pic.value=imagePath;
    window.opener=null;
    window.close();
}
</script>