<?php
	include("../include/global.php");
	include("ZC_Check_admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>产品管理</title>
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
                        
                }
                //-->
            </script>
	</head>

	<body>
    <?php
		if(isset($action)&&$action=='add'){
	?>
	
		<form action="ZC_Pro_Edit.php?action=add" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<table align=center border=0 cellspacing=0 cellpadding=0 width="95%">
				<tr>
					<th colspan="2" align="center"><span style="">产品添加</span></th>
				</tr>
				<tr>
					<td class="td" valign="top" style="padding-top: 7px;">
						所属栏目：					</td>
				  <td>
					    <label>
					    <select name="cid" id="cid">
					      <option value="0">请选择栏目</option>
						 <?php $type->art_select(2);?>
				        </select>
				    </label></td>
				</tr>
				<tr>
					<td class="td">产品名称：				  </td>
					<td>
						<input name="title" type="text" id="title" style="width: 200px;" />					</td>
				</tr>
                <tr>
			  <td class="td">
						产品型号：					</td>
					<td>
						<input name="xh" type="text" id="xh" style="width: 200px;" />					</td>
			  </tr>
				<tr>
					<td class="td">
						关键字：					</td>
					<td>
						<input name="keywords" type="text" id="keywords"
							style="width: 350px;" />
						(多个用“,”隔开)					</td>
				</tr>
				<tr>
					<td align="left" valign="top" class="td"
						style="padding-top: 7px;">
						属 性：					</td>
					<td><input name="is_hot" type="checkbox" class="NoBorder" id="is_hot" value="1" onClick="return false;"
							onMouseUp="this.checked=!this.checked" />
						<label for="is_hot">
							幻灯片						</label>
				      <input name="is_top" type="checkbox" class="NoBorder" id="is_top" value="1" onClick="return false;"
							onMouseUp="this.checked=!this.checked" />
						<label for="is_top">
						置顶				      </label></td>
				</tr>
				
				<tr>
					<td class="td">
						产品图片：				  </td>
					<td>
						<input name="pic" type="text" id="_TopImage"
							style="width: 350px;" />
						&nbsp;

						<input type="button" class="button" value="上传"
							onclick="openScript('upfile/up1.php',460,220);" />					</td>
				</tr>
                <tr>
<td class="td">
						产品简介：					</td>
					<td>
					  <textarea name="smalltext" id="smalltext" cols="50" rows="5"></textarea>				    </td>
			  </tr>
				<tr>
					<td align="left" valign="top" class="td" style="padding-top: 7px;">
						产品说明：				  </td>
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
						<td class="td">
						选填内容：					</td>
					    <td valign="top">
					  <textarea name="more" id="more" cols="50" rows="5"></textarea>
每行一条。如： 重量：50KG </td>
			  </tr>
				<tr>
					<td class="td" width="11%">&nbsp;					</td>
					<td width="89%">
						<input name="Submit" type="submit" class="button" style=""
							value="添加" />
						<input name="Reset" type="reset" class="button" id="Reset"
							value="重置" />					</td>
				</tr>
			</table>
		</form>		
        <?php 
		}else{ 
		$sql="select * from `".PRE."pro` where `id`=".intval($id);
		$rs=$db->query($sql) or die(showmsg("修改产品信息出现错误"));
		while($row=$db->fetch_array($rs)){
		?>
		<form action="ZC_Pro_Edit.php?action=modify&tid=<?php echo $row['cid']?>&id=<?php echo $row['id']?>" method="post" name="zzcms" id="zzcms" onSubmit="return chk(this)">
			<table align=center border=0 cellspacing=0 cellpadding=0 width="95%">
				<tr>
					<th colspan="2" align="center"><span style="">产品修改</span></th>
				</tr>
				<tr>
					<td class="td" valign="top" style="padding-top: 7px;">
						所属栏目：					</td>
				  <td>
					    <label>
					    <select name="cid" id="cid">
					      <option value="0">请选择栏目</option>
						 <?php $type->art_select(2);?>
				        </select>
				    </label></td>
				</tr>
				<tr>
					<td class="td">产品名称：				  </td>
					<td>
						<input name="title" type="text" id="title" style="width: 350px;" value="<?php echo $row['title']?>" />					</td>
				</tr>
                <tr>
			  <td class="td">产品型号：				  </td>
					<td>
						<input name="xh" type="text" id="xh" style="width: 350px;" value="<?php echo $row['xh']?>" />					</td>
			  </tr>
				<tr>
					<td class="td">
						关键字：					</td>
					<td>
						<input name="keywords" type="text" id="keywords"
							style="width: 350px;" value="<?php echo $row['keywords']?>" />
						(多个用“,”隔开)					</td>
				</tr>
				<tr>
					<td align="left" valign="top" class="td"
						style="padding-top: 7px;">
						属 性：					</td>
					<td><input name="is_hot" type="checkbox" class="NoBorder" id="is_hot" value="1" onClick="return false;"
							onMouseUp="this.checked=!this.checked" <?php if($row['is_hot']==1){ echo "checked='checked'";}?> />
						<label for="is_hot">
							幻灯片						</label>
				      <input name="is_top" type="checkbox" class="NoBorder" id="is_top" value="1" onClick="return false;"
							onMouseUp="this.checked=!this.checked" <?php if($row['is_top']==1){ echo "checked='checked'";}?> />
						<label for="is_top">
					置顶					</label></td>
				</tr>
				
				<tr>
					<td class="td">
						产品图片：				  </td>
					<td>
						<input name="pic" type="text" id="_TopImage"
							style="width: 350px;" value="<?php echo $row['pic']?>" />
						&nbsp;

						<input type="button" class="button" value="上传"
							onclick="openScript('upfile/up1.php',460,220);" />					</td>
				</tr>
                <tr>
<td class="td">产品简介：					</td>
					<td height="60">
					  <textarea name="smalltext" id="smalltext" cols="70" rows="15"><?php echo $row['smalltext']?></textarea>				    </td>
			  </tr>
				<tr>
					<td align="left" valign="top" class="td" style="padding-top: 7px;"><span class="td" style="padding-top: 7px;">产品说明</span>：				  </td>
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
						<td class="td">
						选填内容：					</td>
					    <td valign="top">
					  <textarea name="more" id="more" cols="50" rows="5"><?php echo $row['more']?></textarea>
每行一条。如： 重量：50KG </td>
			  </tr>
				<tr>
					<td class="td" width="11%">&nbsp;					</td>
					<td width="89%">
						<input name="Submit" type="submit" class="button" style=""
							value="修改" />
						<input name="Reset" type="reset" class="button" id="Reset"
							value="重置" />					</td>
				</tr>
			</table>
		</form>
        
        <?php }}?>
        	

     	</body>
</html>
