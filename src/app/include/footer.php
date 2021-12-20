

<!--页面底部-->
<div class="footer">
<div class="footer_meun">
关于我们 | 设为首页 | 加入收藏 | <a href="admin/AdminLogin.php">管理登陆</a> | <a href="Link_Apply.php">申请连接</a> 

</div>

<div class="footer_c">
<?php echo $system['copyright']?>

</div>
</div>
</body>
</html>
<?php 
include(ZZCMS_ROOT."bot.php");
$db->close();
?>
