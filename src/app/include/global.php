<?php
	/**
	*www.zzcms.com
	*作者：壮壮
	*/
	session_start();
	header("content-type:text/html; charset=utf-8"); 
	define('ZZCMS_ROOT', str_replace("\\", '/', substr(dirname(__FILE__), 0, -7)));
	define('CACHE_PATH',ZZCMS_ROOT.'data/cache/');//缓存所在目录
	$http_ref=isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	set_include_path(ZZCMS_ROOT.'lib/');
	$zzcms_cha = array (1 => '文章',2 => '产品',3 => '下载',4 => '单页面',);//模块数组
	$zzcms_table= array (1 => 'article',2 => 'pro',3 => 'down',4 => 'about',);//模块对应表名数组
	$zzcms_url= array (1 => 'Art_List',2 => 'Pro_List',3 => 'Down_List',4 => 'about',);
	$zzcms_surl= array (1 => 'Art_Show',2 => 'Pro_Show',3 => 'Down_Show',4 => 'about',);
	require_once(ZZCMS_ROOT."include/config.php");
	require_once("ZC_Mysql.php");
	include_once("ZC_Page.php");	
	include_once("ZC_Function.php");
	include_once("ZC_Class.php");
	include_once("ZC_Article.php");
	include_once("ZC_Pro.php");
	include_once("ZC_Link.php");
	include_once("ZC_About.php");
	include_once("ZC_Book.php");
	include_once("ZC_Down.php");
	include_once("ZC_Upload.php");
	include_once("ZC_Cache.php");
	
	if($_REQUEST){
		if(get_magic_quotes_gpc()){
			$_REQUEST = zc_strip($_REQUEST);
		}else{
			$_POST = zc_check($_POST);
			$_GET = zc_check($_GET);
			@extract($_POST);
			@extract($_GET);
		}
		$_REQUEST=filter_xss($_REQUEST, ZZCMS_TAGS);
		@extract($_REQUEST);
	}

	//实例数据库对象
	
	$db=new mysql();
	$type = new type();
	$art=new article();
	$down= new down();
	$product=new product();
	$link=new links();
	$about= new about();
	$book=new book();
	$system=cache_read('system.php');
	$is_seo=$system['seo'];
	$cid=isset($cid)?intval($cid):0;
	

?>