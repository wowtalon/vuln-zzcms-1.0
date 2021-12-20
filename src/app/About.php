<?php
	include("include/global.php");
	$row=$about->get_row($id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row['name']."-".$row['title']."-".$system['name']?></title>
<meta name="keywords" content="<?php echo $row['keywords']?>">
<meta name="description" content="<?php echo $row['smalltext']?>">
<link href="css/index.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include("include/head.php");?>
<div class="main">
	<div class="main_L">
		
		<div class="main_new">
		  <div class="titles">
				<span>最新文章</span>
				<p></p>
		  </div>
		  <ul>
		  <?php echo $art->art_list($cid,10,32,0,0,2,0,0)?>
		  </ul>
	  </div>
      
		<div class="main_hit">
		  <div class="titles">
				<span>点击排行</span>
				<p></p>
		  </div>
		  <ul>
		  <?php echo $art->art_list($cid,10,32,0,0,0,0,0)?>
		  </ul>
	  </div>      		
		
	</div>
	
  <div class="main_R">   
   <div class="path"><?php echo $row['name'];?></div>     
    <div class="zzcms_about">
       <?php 
			if($is_seo){
				include(ZZCMS_ROOT."data/system_keyword.php");
				echo $row['content']=strtr($row['content'],$keyword_system);
			}else{
				echo $row['content'];
			}
		?>
    </div>   
  </div>
</div>
<?php include("include/footer.php");?>
