<?php

class book{
	function _construct(){
	}
	
	//留言列表
	function book_list($pagesize){
		global $db;		
		$arr=array();
		$sql="select * from `".PRE."book` order by `id` desc";
		$system=cache_read('system.php');
		$is_book=$system['book'];
		if($is_book==1){
			$sql="select * from `".PRE."book` where `answer`<>'' order by `id` desc";
		}
		$arr=get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die (showmsg("查询留言列表出现错误"));
		$show="	<div><a href='Book.php?action=add'>添加留言</a></div>\r\n";
		while($row=$db->fetch_array($rs)){
		?>
			<div class="b_book">
				<div class="b_title">ID:<?php echo $row['id']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 标题：<?php echo $row['title']?></div>
				<div class="b_center">		
					<ul>
						<li>呢称：<?php echo $row['name']?></li>
						<li><a href="mailto:<?php echo $row['email']?>">mail</a></li>
						<li><a href="#" title="<?php echo $row['qq']?>">QQ</a></li>
						<li><a href="<?php echo $row['url']?>">主页</a></li>
					</ul>	
				</div>
				<div class="b_content"><?php echo $row['content']?></div>
				
				<?php echo $row['answer']!=null?'<div class="b_answer"><font color="red">管理员回复：<br></font>'.$row['answer'].'</div>':""?>
				
			</div>
		<?php
		}
		$page=new page($arr[0],$pagesize);
		echo $page->page();
	}
	
	
	//添加到数据库
	function add_book(){
		global $db;
		$_POST?@extract(zc_strip($_POST)):NULL;
		if($vercode!=$_SESSION['ver_code']){
			showmsg("验证码错误！");
		}
		unset($_SESSION['ver_code']);
		$time=time();
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql="insert into `".PRE."book` (`title`,`name`,`qq`,`url`,`email`,`content`,`time`,`ip`) values('".$title."','".$name."','".$qq."','".$url."','".$email."','".$content."','".$time."','".$ip."')";
		$db->query($sql) or die(showmsg("添加留言失败"));
		showmsg("添加留言成功！","Book.php");
	}	
}

?>