<?php
	/*
	*说明：友情连接管理类
	*作者：壮壮
	*官方网站：www.zzcms.com
	*/
	class links{
		function __construct(){
		}
		
		//前台显示友情连接列表
		//参数 lm:栏目名 0:调用全部
		//ts:条数 0：全部调用
		//ls：按几列排列
		//is_pic:是否显示图片 1：显示图片连接，0：显示文字连接
		//pic_w:图片宽度
		//pic_h:图片高度
		function show_link($lm,$ts,$ls,$is_pic,$pic_w,$pic_h){
			$db=new mysql();
			$type=new type();
			$arr=array();
			if($lm==0){
				$sql="select * from `".PRE."link`";		
			}else{
				$sql="select * from `".PRE."link` where `cid` in (".$type->array_classid($lm).")";
			}
			if($is_pic==1){
				$sql.=" where `logo` <>'' and `is_show`=1";
			}else{
				$sql.=" where `logo` is null or `logo`='' and `is_show`=1";
			}
			if($ts==0){
				if($pagesize!=0){
					$arr=get_page_num($sql,$pagesize);
					$sql.=" limit $arr[1], $pagesize";
				}
			}else{
				$sql.=" limit ".$ts;
			}
			$rs=$db->query($sql) or die ("前台显示友情连接列表错误");
			$show="<li>\r\n";
			$i=0;
			while($row = $db->fetch_array($rs)){
				if($is_pic==1){
					$show.="<a href=".$row['url']." target='_blank'><img src=".$row['logo']." width=".$pic_w." height=".$pic_h." alt=".$row['title']." /></a>\r\n";
				}else{
					$show.="<a href=".$row['url']." target='_blank'>".$row['title']."</a>\r\n";
				}
				$i++;
				if($i%$ls==0){
					$show.="</li><li>\r\n";
				}
			}
			$show.="</li>\r\n";
			return $show;
		}		
}
?>