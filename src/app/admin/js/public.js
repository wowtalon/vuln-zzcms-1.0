// JavaScript Document
//文件上传所用函数：打开指定页面并指定大小
function openScript(url, width, height){
	var Win = window.open(url,"openScript",'width=' + width + ',height=' + height + ',resizable=1,scrollbars=yes,menubar=no,status=yes' );
}
//执行openScript函数
function open_url()
{ 
	openScript('Admin/upfile/up1.php',460,220); 
}

//返回文本框字符个数是否符号要求的boolean值
//限制文本框输入字符限制
function less_str(str){	
	return str.value.length < str.getAttribute("maxlength");
}

//全选或者全不选
function selAll(e) {
 	var a = document.getElementsByName('id[]');
    var l = a.length; while(l--) a[l].checked=e.checked;
}
