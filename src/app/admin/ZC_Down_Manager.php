<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
	include(ZZCMS_ROOT."include/zc_config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>下载管理</title>
		<link href="css/Admin.css" rel="stylesheet" type="text/css" />
         <script type="text/javascript" src="js/public.js"></script>
		<script type="text/javascript" src="<?php echo FCK_DIR?>/fckeditor.js"></script>
        <script language="JavaScript">
			<!--
			function chk(theForm){
					if (theForm.cid.value == "0"){
							alert("请选择栏目");
							theForm.cid.focus();
							return (false);
					}
					if (theForm.title.value == ""){
							alert("标题不能为空");
							theForm.title.focus();
							return (false);
					}
					var v_hits=/^[1-9]*[1-9][0-9]*$/;
					if(!v_hits.exec(theForm.hits.value)){
						alert("点击量必须为正整数！");
						theForm.hits.focus();
						return (false);
					}
					if(!v_hits.exec(theForm.size.value)){
                            alert("软件大小必须为正整数！");
                            theForm.size.focus();
                            return (false);
                    }
					if (theForm.url.value == ""){
							alert("下载地址不能为空");
							theForm.url.focus();
							return (false);
					}
			}
			//-->
        </script>
	</head>

	<body>
    <?php
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		if($action=='add'){	
	?>
	
		<form action="ZC_Down_Edit.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<table align=center border=0 cellspacing=0 cellpadding=0 width="95%">
				<tr>
					<th colspan="2" align="center"><span style="">软件添加</span></th>
				</tr>
				<tr>
					<td class="td" valign="top" style="padding-top: 7px;">
						所属栏目：					</td>
				  <td>
					 <label>
					    <select name="cid" id="cid">
					      <option value="0">请选择栏目</option>
						 <?php $type->art_select(3);?>
				        </select>
				    </label>
                    *</td>
				</tr>
				<tr>
					<td class="td">
						标题：					</td>
					<td>
						<input name="title" type="text" id="title" style="width: 350px;" maxlength="60" />
						*					</td>
				</tr>
				<tr>
					<td align="left" class="td">联系人：					</td>
					<td><span class="td">
					  <input name="writer" type="text" id="writer" style="width: 120px;" maxlength="10" /> &nbsp;&nbsp;&nbsp;开发商： </span>
					  <input name="befrom" type="text" id="befrom" style="width: 147px;" value="www.zzcms.com" />					  (例：www.zzcms.com)
                     前面不带http://</td>
				</tr>
				<tr>
					<td align="left" class="td">
						软件类别：					</td>
					<td><label>&nbsp;
					  <select name="ztype" id="ztype">
					    <?php echo down_type($id) ?>
				      </select>
					  &nbsp;&nbsp;
				    软件授权：
				    <select name="copyright" id="copyright">
				      <?php echo down_copyright($id) ?>
				    </select>
				    &nbsp;&nbsp;&nbsp; 软件评级：
				      <select name="grade" id="grade">
				        <option value="1">一星</option>
				        <option value="2">二星</option>
				        <option value="3" selected="selected">三星</option>
				        <option value="4">四星</option>
				        <option value="5">五星</option>
                      </select>
					</label></td>
				</tr>
                
                <tr>
					<td align="left" class="td">
						软件语言：					</td>
					<td><label>
					  <select name="lang" id="lang">
					  	<?php echo down_language($id) ?>
                      </select>
					  &nbsp;&nbsp;&nbsp;运行环境：
				      <select name="run" id="run">
				  		<?php echo down_run($id) ?>
                      </select>
					</label></td>
				</tr>
				<tr>
					<td class="td">
						关键字：					</td>
					<td>
						<input name="keywords" type="text" id="keywords" style="width: 350px;" maxlength="60" />(多个用“,”隔开)					</td>
				</tr>
				<tr>
					<td rowspan="2" align="left" valign="top" class="td" style="padding-top: 7px;">
						属 性：					</td>
					<td>
						软件大小：<input name="size" type="text" id="size" style="width: 93px;" maxlength="10" />
					&nbsp;k&nbsp;*&nbsp;只能填写大于1的整数</td>
				</tr>
				<tr>
					<td><input name="is_hot" type="checkbox" class="NoBorder" id="is_hot" value="1" onClick="return false;"
							onMouseUp="this.checked=!this.checked" />
						<label for="is_hot">幻灯片</label>
					  <input name="is_top" type="checkbox" class="NoBorder" id="is_top" value="1" onClick="return false;"
							onMouseUp="this.checked=!this.checked" />
						<label for="is_top">置顶</label></td>
				</tr>
				<tr>
					<td class="td">
						图片：					</td>
					<td>
						<input name="pic" type="text" id="_TopImage" style="width: 350px;" maxlength="60" />&nbsp;
						<input type="button" class="button" value="上传" onclick="openScript('upfile/up1.php',460,220);" />					</td>
				</tr>
                <tr>
<td class="td">
						简介：					</td>
					<td height="60">
					  <textarea name="smalltext" id="smalltext" cols="70" rows="15"></textarea>				    </td>
			  </tr>
              <tr>
			 		<td class="td">下载地址：</td>
					<td>
						<input name="url" type="text" id="url" style="width: 350px;" maxlength="200" />
                        <input type="button" class="button" value="上传" onclick="openScript('upfile/upfile1.php',460,220);" />
						*
					可以上传RAR ZIP DOC XLS PPT CHM PDF等文件</td>
			  </tr>
				<tr>
					<td align="left" valign="top" class="td" style="padding-top: 7px;">
						内容：					</td>
					<td>
					<script type="text/javascript">
						  window.onload = function()
						  {
							var oFCKeditor = new FCKeditor( 'content' ) ;
							oFCKeditor.BasePath	= '<?php echo FCK_DIR?>/' ;
							oFCKeditor.Height = "350";
							oFCKeditor.ReplaceTextarea() ;
						  }
						</script>
						<textarea name="content" id="content" style="display: none"></textarea>					</td>
				</tr>
				<tr>
					<td class="td" width="11%">&nbsp;					</td>
					<td width="89%">
						<input name="Submit" type="submit" class="button" value="添加" />
						<input name="Reset" type="reset" class="button" id="Reset" value="重置" />					</td>
				</tr>
			</table>
</form>
        <?php 
		}else{ 
		$sql="select * from `".PRE."down` where `id`=".intval($id);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
		?>
<form action="ZC_Down_Edit.php?action=modify&tid=<?php echo $row['cid']?>&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">			
<table align=center border=0 cellspacing=0 cellpadding=0 width="95%">
				<tr>
					<th colspan="2" align="center"><span style="">软件添加</span></th>
				</tr>
				<tr>
					<td class="td" valign="top" style="padding-top: 7px;">
						所属栏目：					</td>
				  <td>
					 <label>
					    <select name="cid" id="cid">
					      <option value="0">请选择栏目</option>
						 <?php $type->art_select(3);?>
				        </select>
				    </label>
                    *</td>
				</tr>
				<tr>
					<td class="td">
						标题：					</td>
					<td>
						<input name="title" type="text" id="title" style="width: 350px;" value="<?php echo $row['title']?>" maxlength="60" />
						*					</td>
				</tr>
				<tr>
					<td align="left" class="td">联系人：					</td>
					<td><span class="td">
					  <input name="writer" type="text" id="writer" style="width: 120px;" value="<?php echo $row['writer']?>" maxlength="10" /> &nbsp;&nbsp;&nbsp;开发商： </span>
					  <input name="befrom" type="text" id="befrom" style="width: 147px;" value="<?php echo $row['befrom']?>" />					  (例：www.zzcms.com)
                     前面不带http://</td>
				</tr>
				<tr>
					<td align="left" class="td">
						软件类别：					</td>
					<td><label>
					  <select name="ztype" id="ztype">
					   <?php echo down_type($row['type']) ?>
				      </select>&nbsp;&nbsp;&nbsp;
				    软件授权：
				    <select name="copyright" id="copyright">
				      <?php echo down_copyright($row['copyright']) ?>
				    </select>
				    &nbsp;&nbsp;&nbsp; 软件评级：
				      <select name="grade" id="grade">
				        <option value="1">一星</option>
				        <option value="2">二星</option>
				        <option value="3" selected="selected">三星</option>
				        <option value="4">四星</option>
				        <option value="5">五星</option>
                      </select>
					</label></td>
				</tr>
                
                <tr>
					<td align="left" class="td">
						软件语言：					</td>
					<td><label>
					  <select name="lang" id="lang">
					  	<?php echo down_language($row['lang']) ?>
                      </select>
					  &nbsp;&nbsp;&nbsp;运行环境：
				      <select name="run" id="run">
				  		<?php echo down_run($row['run']) ?>
                      </select>
					</label></td>
				</tr>
				<tr>
					<td class="td">
						关键字：					</td>
					<td>
						<input name="keywords" type="text" id="keywords" style="width: 350px;" value="<?php echo $row['keywords']?>" maxlength="60" />(多个用“,”隔开)					</td>
				</tr>
				<tr>
					<td rowspan="2" align="left" valign="top" class="td" style="padding-top: 7px;">
						属 性：					</td>
					<td>
						软件大小：<input name="size" type="text" id="size" style="width: 93px;" value="<?php echo $row['size']?>" />
					&nbsp;k*&nbsp;&nbsp;只能填写大于1的整数</td>
				</tr>
				<tr>
					<td><input name="is_hot" type="checkbox" class="NoBorder" id="is_hot" value="1" onClick="return false;"
							onMouseUp="this.checked=!this.checked" <?php if($row['is_hot']==1){ echo "checked='checked'";}?> />
						<label for="is_hot">幻灯片</label>
					  <input name="is_top" type="checkbox" class="NoBorder" id="is_top" value="1" onClick="return false;"
							onMouseUp="this.checked=!this.checked" <?php if($row['is_top']==1){ echo "checked='checked'";}?> />
						<label for="is_top">置顶</label></td>
				</tr>
				<tr>
					<td class="td">
						图片：					</td>
					<td>
						<input name="pic" type="text" id="_TopImage" style="width: 350px;" value="<?php echo $row['pic']?>" maxlength="60" />&nbsp;
						<input type="button" class="button" value="上传" onclick="openScript('upfile/up1.php',460,220);" />					</td>
				</tr>
                <tr>
<td class="td">
						简介：					</td>
					<td height="60">
					  <textarea name="smalltext" id="smalltext" cols="70" rows="15"><?php echo $row['smalltext']?></textarea>				    </td>
			  </tr>
              <tr>
			 		<td class="td">下载地址：</td>
					<td>
						<input name="url" type="text" id="url" style="width: 350px;" value="<?php echo $row['url']?>" maxlength="200" />
                        <input type="button" class="button" value="上传" onclick="openScript('upfile/upfile1.php',460,220);" />
						*
					可以上传RAR ZIP DOC XLS PPT CHM PDF等文件</td>
			  </tr>
				<tr>
					<td align="left" valign="top" class="td" style="padding-top: 7px;">
						内容：					</td>
					<td>
					<script type="text/javascript">
						  window.onload = function()
						  {
							var oFCKeditor = new FCKeditor( 'content' ) ;
							oFCKeditor.BasePath	= '<?php echo FCK_DIR?>/' ;
							oFCKeditor.Height = "350";
							oFCKeditor.ReplaceTextarea() ;
						  }
						</script>
						<textarea name="content" id="content" style="display: none"><?php echo $row['content']?></textarea>					</td>
				</tr>
				<tr>
					<td class="td" width="11%">&nbsp;					</td>
					<td width="89%">
						<input name="Submit" type="submit" class="button" value="修改" />
						<input name="Reset" type="reset" class="button" id="Reset" value="重置" />					</td>
				</tr>
			</table>
</form>     
      
      			
        <?php }}?>
        	

     	</body>
</html>
