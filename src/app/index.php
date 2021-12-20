<?php
	include("include/global.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $system['name'];?>-<?php echo $system['title'];?></title>
<meta name="keywords" content="<?php echo $system['keywords']?>">
<meta name="description" content="<?php echo $system['smalltext']?>">
<link href="css/index.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include("include/head.php");?>
<!--主体-->
<div class="zzcms">
	<div class="zzcms_L">
		<!--第一横栏-->
	  <div class="zzcms_hdp">
			<?php echo zzcms_fdp()?>
	  </div>
		<div class="zzcms_news">
		  <div class="titles"><span>关于系统</span><p></p></div>
          <ul>
		  <?php echo $about->about('关于我们')?>
          </ul>
	  </div>
		
		<!--第一横栏-->
		
		<div class="zzcms_down">
			<div class="titles"><span>最新下载</span><p></p></div>
            <ul>
			<?php echo $down->list_down($cid,10,32,0,0,2,0,0)?>
            </ul>
		</div>		
		<div class="zzcms_pic">
				<div class="titles"><span>最新产品</span><p></p></div>
                <ul>
				<?php echo $product->getpic($cid,0,80,3,0,0,2,120,90,6)?>
                </ul>
		</div>			
	</div>
	
  <div class="zzcms_R">
		<div class="news_top">
		  <div class="titles"><span>最新文章</span><p></p></div>
          <ul>
		  <?php echo $art->art_list(0,12,38,0,0,2,0,0)?>
          </ul>
	  </div>
      
		<div class="hit_top">
		  <div class="titles"><span>点击排行</span><p></p></div>
          <ul>
		  <?php echo $art->art_list(0,8,38,0,0,0,0,0)?>
          </ul>
	  </div>           
  </div>
</div>

<!--友情连接-->
<div class="link">
<div class="titles">
	<span>友情连接</span>
	<p><a href="Link_Apply.php">申请链接</a></p>
</div>
<div class="link_c">
<?php echo links(cache_read('link.php'));?>
</div>
</div>
<?php include("include/footer.php");?>