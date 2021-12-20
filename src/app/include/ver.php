<?php
	session_start();
	header("Content-type: image/png");
	include("../lib/ZC_Verify.php");
	$image=new verify();
	$_SESSION['ver_code']=$image->show();
?>
