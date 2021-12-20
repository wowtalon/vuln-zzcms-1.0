<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>栏目管理</title>
		<link href="css/Admin.css" rel="stylesheet" type="text/css" />
         <script type="text/javascript" src="js/public.js"></script>
		<script language="JavaScript">
                <!--
                function chk(theForm){
 
                        if (theForm.title.value == ""){
                                alert("标题不能为空");
                                theForm.title.focus();
                                return (false);
                        }   
						if (theForm.url.value == ""){
							alert("地址不能为空");
							theForm.url.focus();
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
	
		<form action="ZC_Link_Edit.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<table align=center border=0 cellspacing=0 cellpadding=0 width="95%" class="AdminTable">
				<tr>
					<th colspan="2" align="center">添加友情连接</th>
				</tr>
				<tr>
					<td class="td">
						标题：
					</td>
					<td>
						<input name="title" type="text" id="title" style="width: 350px;" maxlength="60" />
					</td>
				</tr>
				<tr>
					<td class="td">
						地址：
					</td>
					<td>
						<input name="url" type="text" id="url"
							style="width: 350px;" maxlength="200" /></td>
				</tr>
				<tr>
					<td class="td">
						LOGO：
					</td>
					<td>
						<input name="pic" type="text" id="_TopImage"
							style="width: 350px;" maxlength="600" />
						&nbsp;

						<input type="button" class="button" value="上传" onclick="openScript('upfile/up1.php',460,220);" />
					</td>
				</tr>
				
                <tr>
				  <td class="td">属性：
					</td>
					<td>
						<input name="is_show" type="checkbox" class="NoBorder" id="is_show" value="1" onClick="return false;"
							onMouseUp="this.checked=!this.checked" />
						是否显示
						<input name="is_top" type="checkbox" class="NoBorder" id="is_top" value="1" onClick="return false;"
							onMouseUp="this.checked=!this.checked" />
						<label for="is_top">
							置顶
					</label>
                  </td>
				</tr>
                
				<tr>
					<td class="td" width="11%">&nbsp;
						
					</td>
					<td width="89%">
						<input name="submit" type="submit" class="button" id="submit" style=""
							value="添加" />
						<input name="Reset" type="reset" class="button" id="Reset"
							value="重置" />
					</td>
				</tr>
                
			</table>
</form>
     <?php 
		}else{ 
		$sql="select * from `".PRE."link` where `id`=".intval($id);
		$rs=$db->query($sql) or die (showmsg("修改友情连接出现错误"));
		while($row=$db->fetch_array($rs)){
	?>
  <form action="ZC_Link_Edit.php?action=modify&tid=<?php echo $row['cid']?>&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
        <table align=center border=0 cellspacing=0 cellpadding=0 width="95%" class="AdminTable">
        <tr>
            <th colspan="2" align="center">修改友情连接</th>
        <tr>
            <td class="td">
                标题：
            </td>
            <td>
                <input name="title" type="text" id="title" style="width: 350px;" value="<?php echo $row['title']?>" maxlength="60" />
            </td>
        </tr>
        <tr>
            <td class="td">
                地址：
            </td>
            <td>
                <input name="url" type="text" id="url"
                    style="width: 350px;" value="<?php echo $row['url']?>" maxlength="200" /></td>
        </tr>
        <tr>
            <td class="td">
                LOGO：
            </td>
            <td>
                <input name="pic" type="text" id="_TopImage"
                    style="width: 350px;" value="<?php echo $row['logo']?>" maxlength="60" />
                &nbsp;

                <input type="button" class="button" value="上传" onclick="openScript('upfile/up1.php',460,220);" />
            </td>
        </tr>
        
        <tr>
          <td class="td">属性：
            </td>
            <td>
                <input name="is_show" type="checkbox" class="NoBorder" id="is_show" value="1" onClick="return false;"
                    onMouseUp="this.checked=!this.checked" <?php if($row['is_show']==1){ echo "checked='checked'";}?> />
                是否显示
                <input name="is_top" type="checkbox" class="NoBorder" id="is_top" value="1" onClick="return false;"
                    onMouseUp="this.checked=!this.checked" <?php if($row['is_top']==1){ echo "checked='checked'";}?> />
                <label for="is_top">
                    置顶
            </label>
          </td>
        </tr>
        
        <tr>
            <td class="td" width="11%">&nbsp;
                
            </td>
            <td width="89%">
                <input name="submit" type="submit" class="button" id="submit" style=""
                    value="修改" />
                <input name="Reset" type="reset" class="button" id="Reset"
                    value="重置" />
          </td>
        </tr>
        
    </table>
	</form>		
<?php }}?>
        	

     	</body>
</html>
