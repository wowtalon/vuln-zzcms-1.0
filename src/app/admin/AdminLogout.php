<?php
	include("../include/global.php");
	session_destroy();
	echo("<script>top.location.href = 'AdminLogin.php';</script>");
?>

