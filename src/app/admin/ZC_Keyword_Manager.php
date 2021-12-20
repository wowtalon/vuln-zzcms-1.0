<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>系统词组管理</title>
		<link href="css/Admin.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/public.js"></script>
		<script language="JavaScript">
        <!--
        function chk(theForm){
                if (theForm.keyword.value == ""){
                        alert("需要替换的词不能为空！");
                        theForm.keyword.focus();
                        return (false);
                }
                if (theForm.replace.value == ""){
                        alert("用来替换的词不能为空！");
                        theForm.replace.focus();
                        return (false);
                }			
        }
        //-->
        </script>
	</head>

	<body>
    <?php
		if(isset($action)&&$action=='add'){
	?>

<form action="ZC_Keyword_Edit.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
<table align=center border=0 cellspacing=0 cellpadding=0 width="95%" class="AdminTable">
  <tr>
    <th colspan="2" align="center"><span>添加系统词</span></th>
  </tr>
  <tr>
    <td class="td">需要替换的词：</td>
    <td><input name="keyword" type="text" id="keyword" style="width:200px;" maxlength="60" />
      *</td>
  </tr>
  <tr>
    <td class="td">用来替换的词：</td>
    <td><input name="replace" type="text" id="replace" style="width:200px;" maxlength="60" /></td>
  </tr> 
  <tr>
    <td class="td" width="11%">&nbsp;</td>
    <td width="89%">
      <input name="Submit" type="submit" class="button" value="添 加" />
      <input name="Reset" type="reset" class="button" id="Reset" value="重 置" /></td>
  </tr>

</table>
</form>
     <?php 
		}else{ 
		$sql="select * from `".PRE."keywords` where `id`=".intval($id);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
	?>
    
 <form action="ZC_Keyword_Edit.php?action=modify&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
<table align=center border=0 cellspacing=0 cellpadding=0 width="95%" class="AdminTable">
  <tr>
    <th colspan="2" align="center"><span>修改系统词</span></th>
  </tr>
  <tr>
    <td class="td">需要替换的词：</td>
    <td><input name="keyword" type="text" id="keyword" style="width:200px;" value="<?php echo $row['keyword'] ?>" maxlength="60" />
      *</td>
  </tr>
  <tr>
    <td class="td">用来替换的词：</td>
    <td><input name="replace" type="text" id="replace" style="width:200px;" value="<?php echo $row['replace'] ?>" maxlength="60" /></td>
  </tr>
   <tr>
    <td class="td">词组首字母：</td>
    <td><input name="zimu" type="text" id="zimu" style="width:200px;" value="<?php echo $row['zimu'] ?>" maxlength="60" />
      *（请用大写，如：A）</td>
  </tr>
  <tr>
    <td class="td">词组长度：</td>
    <td><input name="klen" type="text" id="klen" style="width:200px;" value="<?php echo $row['klen'] ?>" maxlength="60" />
    （请填写数字，如：3）</td>
  </tr>   
  <tr>
    <td class="td" width="11%">&nbsp;</td>
    <td width="89%">
      <input name="Submit" type="submit" class="button" value="修 改" />
      <input name="Reset" type="reset" class="button" id="Reset" value="重 置" /></td>
  </tr>

</table>
</form>   
    
<?php }}?>
        	

</body>
</html>
