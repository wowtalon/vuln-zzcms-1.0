// JavaScript Document

String.prototype.trim = function(){return this.replace(/^\s+|\s+$/g, '');}
String.prototype.ltrim = function(){return this.replace(/^\s+/, '');}
String.prototype.rtrim = function(){return this.replace(/\s+$/, '');}

/*
 * OnUploadCompleted 快速上传结束后的操作
 */
function OnUploadCompleted( errorNumber, fileUrl, fileName, customMsg )
{
//	if(window.frames['FrameUpload'])window.frames['FrameUpload'].location.href = gsSiteRootUrl + gsSiteAdminRoot + 'AdminUpload.asp';
	AdminFileUpload('Hide');

	switch ( errorNumber )
	{
		case 0 :	// No errors
			alert( '文件上传成功！' ) ;
			break ;
		case 1 :	// Custom error
			alert( customMsg ) ;
			return ;
		case 101 :	// Custom warning
			alert( customMsg ) ;
			break ;
		case 201 :
			alert( '上传成功！您刚才上传的文件已经被重命名为"' + fileName + '"。' ) ;
			break ;
		case 202 :
			alert( '无效的/不可上传的文件类型' ) ;
			return ;
		case 203 :
			alert( "安全故障。你可能没有权限上传文件，请检查你的服务器。" ) ;
			return ;
		case 204 :
			alert('文件太大，被限制上传，请修改到相应大小范围后重试！');
			return;
		case 500 :
			alert( '文件管理器被禁用。' ) ;
			break ;
		default :
			alert( '文件上传出错。错误代码：' + errorNumber ) ;
			return ;
	}

	$_('_TopImage').value = fileUrl;
}

function bIsDateTime(sStr)
{
	var r = sStr.match(/^(\d{4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/);
	if(r == null) return false;

	var d = new Date(r[1], r[3]-1, r[4], r[5], r[6], r[7]);

	return (d.getFullYear() == r[1] && (d.getMonth() + 1) == r[3] && d.getDate() == r[4] && d.getHours() == r[5] && d.getMinutes() == r[6] && d.getSeconds() == r[7]);
}

function IsDateTime(OBJ)
{
	var sStr = OBJ.value;
	sStr = sStr.replace(/：/gi, ':').replace(/－/gi, '-').replace(/　/gi, ' ').replace(/  /gi, ' ').trim();
	if(sStr.indexOf(' ') == -1) sStr += ' 00:00:00';
	var bResult = bIsDateTime(sStr);

	if(bResult == false)
	{
		alert('时间填写错误！请确保时间格式的正确性！');
		OBJ.focus();
	}

	OBJ.value = sStr;
}
//2008－8－5 0：01：20

function AdminFileUpload(sShow, Event)
{
	var oDiv = document.getElementById('DivAdminUpload');
	if(!oDiv)
	{
		var oDiv = document.createElement('div');
		oDiv.setAttribute("id", 'DivAdminUpload');
		oDiv.setAttribute("name", 'DivAdminUpload');
		oDiv.className = 'DivAdminUpload';
		document.body.appendChild(oDiv);
	}

	if('show' == sShow.toLowerCase())
	{
		var x = Event.clientX;
		var y = Event.clientY;

		oDiv.style.display = 'block';
		oDiv.style.top = (y - 120 - 20) + 'px';
		oDiv.style.left = (x - 468) + 'px';
		oDiv.innerHTML = '<iframe src="AdminUpload.asp" name="FrameUpload" frameborder="0" style="width:468px;height:120px;" scrolling="no"></iframe>';
	}else{
		oDiv.style.display = 'none';
	}
}

/*
 * 图片预览
 */
function ImgPreView(oLayer, sSrc)
{
	if(sSrc == '') return false;

	var o = document.getElementsByTagName("SELECT");

	oLayer['title'] = "鼠标单击关闭图片预览";
	oLayer['onclick'] = function(){ImgPreViewClose(this);}
	oLayer.innerHTML = '<img src="' + sSrc + '" onclick="ImgPreViewClose($(\'' + oLayer.id + '\'));" />';
	oLayer.style.display = 'block';

	if(parent && parent != window)parent.$('LayerFrameSwitch').style.display = 'none';

	for(var i = 0; i < o.length; i++)
	{
		o[i].style.display = 'none';
	}
}

/*
 * 关闭图片预览
 */
function ImgPreViewClose(oLayer)
{
	var o = document.getElementsByTagName("SELECT");

	oLayer.style.display = 'none';

	if(parent && parent != window)parent.$('LayerFrameSwitch').style.display = 'block';

	for(var i = 0; i < o.length; i++)
	{
		o[i].style.display = '';
	}
}

/*
 * 获取代表图片和标题下载的列表
 */
function GetTopObjectList(Doc, OBJ, sTag)
{
	if(!Doc) return false;

	var s = '';
	var option = new Option('请选择', '');
	var a = Doc.getElementsByTagName(sTag);

	OBJ.innerHTML = '';
	if(document.all)OBJ.add(option); else OBJ.appendChild(option);

	if(sTag != 'object')
	{
		for(var i = 0; i < a.length; i++)
		{
			s = a[i].getAttribute('_fcksavedurl');
			if(s != null)
			{
				option = new Option(s, s);
				if(document.all)OBJ.add(option); else OBJ.appendChild(option);
			}
		}
	}else{
		for(var i = 0; i < a.length; i++)
		{
			var s2 = a[i].classid.toLowerCase();

			if(s2 == "clsid:22d6f312-b0f6-11d0-94ab-0080c74c7e95")
			{
				s = a[i].getAttribute("FileName");
			}
			if(s2 == "clsid:cfcdaa03-8be4-11cf-b84b-0020afbbccfa")
			{
				s = a[i].getAttribute("Source");
			}
			if(a[i].codeBase.indexOf("macromedia.com")>=0 || s2 == 'clsid:d27cdb6e-ae6d-11cf-96b8-444553540000')
			{
				s = a[i].getAttribute("Movie");
			}
			if(s2 == 'clsid:6bf52a52-394a-11d3-b153-00c04f79faa6')
			{
				s = a[i].getAttribute("URL");
			}

			if(s)
			{
				option = new Option(s, s);
				if(document.all)OBJ.add(option); else OBJ.appendChild(option);
			}
		}

		var e = window.frames['Content___Frame'].FCKTempBin;
		for (var i = 0; i < e.Elements.length; i++)
		{
			var s = e.Elements[i].getAttribute('src');

			if(s)
			{
				option = new Option(s, s);
				if(document.all)OBJ.add(option); else OBJ.appendChild(option);
			}
		}

		var a = Doc.getElementsByTagName('embed');
		for (var i = 0; i < a.length; i++)
		{
			var s = a[i].src.toLowerCase();

			if(s.indexOf(".wmv")>0 || s.indexOf(".asf")>0 || s.indexOf(".wma")>0 || s.indexOf(".mpg")>0 || s.indexOf(".avi")>0 || s.indexOf(".mp3")>0 || s.indexOf(".rm")>0 || s.indexOf(".ram")>0 || s.indexOf(".rmvb")>0 || s.indexOf(".wav")>0 || s.indexOf(".mid")>0 || s.indexOf(".asx")>0 || s.indexOf(".smi")>0 || s.indexOf(".flv")>0 || s.indexOf(".swf")>0)
			{
				option = new Option(s, s);
				if(document.all)OBJ.add(option); else OBJ.appendChild(option);
			}
		}

		a = Doc.getElementsByTagName('a');
		for (var i = 0; i < a.length; i++)
		{
			var s = a[i].href;
			if(s.indexOf(".wmv")>0 || s.indexOf(".asf")>0 || s.indexOf(".wma")>0 || s.indexOf(".mpg")>0 || s.indexOf(".avi")>0 || s.indexOf(".mp3")>0 || s.indexOf(".rm")>0 || s.indexOf(".ram")>0 || s.indexOf(".rmvb")>0 || s.indexOf(".wav")>0 || s.indexOf(".mid")>0 || s.indexOf(".asx")>0 || s.indexOf(".smi")>0 || s.indexOf(".flv")>0 || s.indexOf(".swf")>0)
			{
				option = new Option(s, s);
				if(document.all)OBJ.add(option); else OBJ.appendChild(option);
			}
		}

		a = Doc.getElementsByTagName('bgsound');
		for (var i = 0; i < a.length; i++)
		{
			option = new Option(s, s);
			if(document.all)OBJ.add(option); else OBJ.appendChild(option);
		}
	}
	
//	if(OBJ.options.length > 1){OBJ.options[1].selected = true;OBJ.onchange();}
}

/*
	select标签双击时触发的事件, 用来取得选中的文字
*/
function ShowSelectedText(o)
{
	var option = o.options[o.selectedIndex];
	var sStr = option.text.replace(/┊/gi, '').replace(/├/gi, '').replace(/ /gi, '').replace(/└/gi, '') + ' ┊ ' + option.value;
	prompt('分类名称┊分类标识', sStr);
	
	return true;
}

/*
	列表了
*/
function GetPageList(iPage, iSize, iPages, iCount, sParam, iList)
{
	if(iCount <= 0) return false;
	if(typeof(iList) == 'undefined') iList = 10;
	
	var iStart, iEnd;
	iStart = 1;
	if(iPage * 2 > 10) iStart = iPage - (iList / 2);
	iEnd = iStart + iList - 1;
	if(iEnd > iPages) iEnd = iPages;
	
	document.write("<a>&nbsp;" + iCount + "&nbsp;</a><span>&nbsp;&raquo;&nbsp;</span>");
	if(1 != iStart) document.writeln('<a href="?Page=1&' + sParam + '">&nbsp;1..&nbsp;</a>');

	for(var i = iStart; i <= iEnd; i++)
	{
		if(i == iPage)
			document.writeln('<a href="?Page=' + i + '&' + sParam + '">&nbsp;<strong>' + i + '&nbsp;</strong></a>');
		else
			document.writeln('<a href="?Page=' + i + '&' + sParam + '">&nbsp;' + i + '&nbsp;</a>');
	}

	if(iPages > iEnd) document.writeln('<a href="?Page=' + iPages + '&' + sParam + '">&nbsp;..' + iPages + '&nbsp;</a>');
	
	if(iPages > 10)
		document.write("<span><input type=\"text\" size=\"3\" onkeydown=\"if(13==event.keyCode){location.href='?Page='+this.value+'&" + sParam + "';}\" /></span>");
}

/*
 * 把数字星期N转换成相应的语言版本
 */
function GetWeekDayName(iWeekDay)
{
	var aWeekDayName = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");

	if(iWeekDay <= aWeekDayName.length)
		return aWeekDayName[iWeekDay - 1];
	else
		return "";
}

/*
 * 页面载入完毕后要做的工作
 */
window.onload = function()
{
	SetEventByTag("select", "ondblclick", function(){ShowSelectedText(this);});

	setTimeout("LoadTopObjectList();", 2000);
}
