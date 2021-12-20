<?php
	//过滤安全字符
	function zc_check($string){
		if(!is_array($string)) return addslashes(trim($string));
		foreach($string as $k => $v) $string[$k] = zc_check($v);
		return $string;
	}
	function zc_check_url($string){
		if(!is_array($string)) return safe_check(trim($string));
		foreach($string as $k => $v) $string[$k] = zc_check_url($v);
		return $string;
	}
	//过滤格式
	function zc_strip($string){
		if(!is_array($string)) return stripslashes(trim($string));
		foreach($string as $k => $v) $string[$k] = zc_strip($v);
		return $string;
	}
	
	//清除textarea格式
	function area_clean($str){
		 if(empty($str)) return;
		 if($str=="") return $str;
		 $str=str_replace(chr(38),"&#38;",$str);
		 $str=str_replace(">","&gt;",$str);
		 $str=str_replace("<","&lt;",$str);
		 $str=str_replace(chr(39),"&#39;",$str);
		 $str=str_replace(chr(32),"&nbsp;",$str);
		 $str=str_replace(chr(34),"&quot;",$str);
		 $str=str_replace(chr(13),"",$str);
		 $str=str_replace(chr(10),"<br>",$str);
		 return $str;
	}
	function filter_xss($string, $allowedtags = '', $disabledattributes = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavaible', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragdrop', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterupdate', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmoveout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload')){
		if(is_array($string)){
			foreach($string as $key => $val) $string[$key] = filter_xss($val, ZZCMS_TAGS);
		}else{
			$string = preg_replace('/\s('.implode('|', $disabledattributes).').*?([\s\>])/', '\\2', preg_replace('/<(.*?)>/ie', "'<'.preg_replace(array('/javascript:[^\"\']*/i', '/(".implode('|', $disabledattributes).")[ \\t\\n]*=[ \\t\\n]*[\"\'][^\"\']*[\"\']/i', '/\s+/'), array('', '', ' '), stripslashes('\\1')) . '>'", strip_tags($string, $allowedtags)));
		}
		return $string;
	}
	//过滤防注射字符
	//如果包含SQL字符则返回真，否则返回假
	function inject_check($str){
 		return eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|and|or|into|load_file|outfile', $str);	
	}
	
	//对提交参数的值进行验证
	//参数：str:需要验证的字符，参数：num，0为数字，其他为字符
	function safe_check($str){
		if(inject_check($str)){
			showmsg('提交的参数非法');//注射判断
		}
		if(is_numeric($str)){
			$str=intval($str);
		}
		return $str;
	}
	
	function set(){
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
			return @extract($_REQUEST);
		}else{
			return false;
		}
	}
	//显示信息
	function showmsg($msg, $zc_url = 'back'){
		if($zc_url && $zc_url!='back'){
			exit("<script>alert('$msg');self.location=\"$zc_url\";</script>");
		}else{
			exit("<script>alert(\"$msg\");history.go(-1);</script>");
		}
	}
	
		//显示信息
	function selectmsg($yesurl,$nourl,$msg='是否要继续添加?'){
		exit("<script type='text/javascript'> if(confirm('$msg')){ window.location.href='$yesurl';}else{ window.location.href='$nourl';	}</script>");
	}
	
	//分页函数
	function page($totles,$size){
		$zzcms_page=new page($totles,$size);
		return $zzcms_page->page();
	}
	//写入缓存函数
	function cache_write($file,$array,$path=''){
		//如果不是数组则返回
		if(!is_array($array)) return false;
		//如果没有路径则用默认路径
		$str_array="<?php\nreturn ".var_export($array,true).";\n?>";
		$cachefile=($path?$path:CACHE_PATH).$file;
		$str_len=file_put_contents($cachefile,$str_array);
		@chmod($cachefile, 0777);
		return $str_len;
	}
	//读取缓存函数
	function cache_read($file, $path = '', $iscachevar = 0){
		if(!$path) $path = CACHE_PATH;
		$cachefile = $path.$file;
		return @include $cachefile;
	}
	//删除缓存
	function cache_delete($file, $path = ''){
		$cachefile = ($path ? $path : CACHE_PATH).$file;
		return @unlink($cachefile);
	}
	
	//生成缩略图名字
	function create_spic($pic){
		$arr=explode("/",$pic);
		$pic_name=$arr[count($arr)-1];//取得去掉路径后的文件名
		$spic=str_replace($pic_name,"s_".$pic_name,$pic);//替换掉文件名
		return $spic;
	}
	//验证是否有管理员权限
	function check_admin($uid,$shell){
		if($uid&&$shell){
			$sql="select * from `".PRE."admin` where `uid`=".intval($uid);
			$rs=mysql_query($sql) or die (showmsg("查询管理员信息出现错误"));
			$ok=is_array($row=mysql_fetch_array($rs));
			$sll=$ok?$shell==md5($row['name'].$row['password'].ZZCMS):false;
			if($sll){
				return $row;
			}else{
				showmsg('你无权进入该页面','AdminLogin.php');
			}
		}else{
			echo("<script>top.location.href = 'AdminLogin.php';</script>");
		}
		
	}
	
	//格式化时间
	function format_date($str,$num){
		//$str=$str+(8*60*60);//我用的国外空间，时间相差8个小时，你们可以自己更改
		switch ($num) {
			case 1:
				return date('Y-m-d',$str);//2009-08-02 
				break;
			case 2:
				return date('Y-m-d H:i:s',$str);//2009-08-02 10:45:03 
				break;
			case 3:
				return date('Y年m月d日',$str);//2009年08月02日 
				break;
			case 4:
				return date('m月d日',$str);//08月02日 
				break;
			default:
				return date('F j,Y,g:i a',$str);//August 2,2009,10:48 am  
		}
	}
	
	
	//判断用户是否超时
	function overtime($in_time,$zc_time=1200){
		$new_time=mktime();
		if($new_time-$in_time>$zc_time){
			echo "由于你长时间未有任何操作，登录超时！";
			session_destroy();
			echo("<script>top.location.href = 'AdminLogin.php';</script>");
		}else{
			$_SESSION['in_time']=mktime();
		}		
	}
	
	//取得当前页面的页码,用于分页
	function get_page_num($sql,$pagesize){
		global $db;
		if(isset($_GET['page'])){
			$page=intval($_GET['page']);
		}else{
			$page=1;
		}
		
		if(!$page||$page<1){
			$page=1;
		}
		$totle=$db->num_rows($db->query($sql));
		$maxpage=ceil($totle/$pagesize);
		if($maxpage<1){
			$maxpage=1;
		}
		$page=$page>=$maxpage?$maxpage:$page;
		$firstpage=($page-1)*$pagesize;
		$arr=array($totle,$firstpage);
		return $arr;
	}
	
	//截取utf8字符串
	function str_len($str, $len) {    
		$strlen=strlen($str);
		if($strlen<=$len) return $str;
		$str = str_replace(array('&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array(' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $str);
		$n = $tn = $noc = 0;
		while($n < $strlen){
			$t = ord($str[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t < 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $len) break;
		}
		if($noc > $len) $n -= $tn;
		return substr($str, 0, $n);
	}  
	//友情连接
	function links($arr){
		if(!is_array($arr)&&empty($arr)){
			return "";
		}
		$show="";
		foreach($arr as $k=>$v){
			$show.="<a href=".$arr[$k]['url']." target='_blank'>".$arr[$k]['title']."</a>\r\n";
		}
		return $show;
	}
	//幻灯片
	function zzcms_fdp($ts=5,$width=300,$height=250,$channle=1){
		global $db,$zzcms_table,$zzcms_surl;
		$table=$zzcms_table[intval($channle)];
		$sql="select * from `".PRE.$table."` where `is_top`=1 and `pic` <>'' order by `id` desc limit $ts";
		$rs=$db->query($sql) or die(showmsg("调用幻灯片出现错误！"));
		$pics=$links=$texts='';
		while($row = $db->fetch_array($rs)){
			$pics.=$row['pic']."|";
			$links.=$zzcms_surl[intval($channle)].".php?id=".$row['id']."|";
			$texts.=$row['title']."|";
		}
		$pics=substr($pics,0,-1);
		$links=substr($links,0,-1);
		$texts=substr($texts,0,-1);
		?>
 		<script type="text/javascript">
			//<![CDATA[
			var interval_time=0;
			var focus_width=<?php echo $width?>;
			var focus_height=<?php echo $height?>;
			var text_height=24;
			var text_align="center";
			var swf_height=focus_height+text_height;
			var pics="<?php echo $pics?>";
			var links="<?php echo $links?>";
			var texts="<?php echo $texts?>";
			document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">');
			document.write('<param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="images/focus.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#F0F0F0">');
			document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
			document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">');
			document.write('<embed src="images/focus.swf" wmode="opaque" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'" menu="false" bgcolor="#F0F0F0" quality="high" width="'+ focus_width +'" height="'+ swf_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');
			document.write('</object>');
			//]]>
			</script>        
        <?php
	}
	
	//蜘蛛的名称
	function get_bot_name($id){
		if(!$id) return false;
		$bot_array=cache_read('botlist.php');
		if(!is_array($bot_array)) return false;
		$bot_name='';
		foreach($bot_array as $k=>$v){
			if(intval($bot_array[$k]['id'])==intval($id)){
				$bot_name=$bot_array[$k]['name'];
			}
		}
		return $bot_name;
	}
	
	//写入蜘蛛内容
	function set_access($bot){
		global $db;
		$db=&$db;
		$ip=$_SERVER['REMOTE_ADDR'];
		$time=time();
		$url=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:$_SERVER['REQUEST_URI'];
		$rs=$db->query("select * from `".PRE."count` where `bot`=$bot");
		if(mysql_num_rows($rs)>0){
			$db->query("update `".PRE."count` set `hit`=`hit`+1,`url`='$url',`time`='$time',`ip`='$ip' where `bot`=$bot");
		}else{
			$db->query("insert into `".PRE."count`(`bot`,`hit`,`url`,`time`,`ip`) values($bot,1,'$url','$time','$ip')");
		}
		$db->query("insert into `".PRE."access`(`bot`,`url`,`time`,`ip`) values($bot,'$url','$time','$ip')");
	}

	//更新日周月年总排行榜
	function set_hits($bot){
		if(!$bot) return false;
		global $db;
		$db=&$db;
		$rs=$db->query("select * from `".PRE."hits` where `bot`=$bot");
		$time=time();
		if($row=$db->fetch_array($rs)){
			$hits=$row['hits']+1;
			$hits_day = (date('Ymd', $row['hits_time']) == date('Ymd', $time)) ? ($row['hits_day'] + 1) : 1;
			$hits_week = (date('YW', $row['hits_time']) == date('YW', $time)) ? ($row['hits_week'] + 1) : 1;
			$hits_month = (date('Ym', $row['hits_time']) == date('Ym', $time)) ? ($row['hits_month'] + 1) : 1;
			$hits_yeah = (date('Y', $row['hits_time']) == date('Y', $time)) ? ($row['hits_yeah'] + 1) : 1;
			$db->query("update `".PRE."hits` set `hits`=$hits,`hits_day`=$hits_day,`hits_week`=$hits_week,`hits_month`=$hits_month,`hits_yeah`=$hits_yeah,`hits_time`=$time where `bot`=$bot");

		}else{
			$db->query("insert into `".PRE."hits`(`bot`,`hits`,`hits_day`,`hits_week`,`hits_month`,`hits_yeah`,`hits_time`) values($bot,1,1,1,1,1,$time)");
		}

	}
	
	//取得测字首字母
	function getfirstchar($s0){ 
		if(ord($s0)>="1" and ord($s0)<=ord("z") )   { return strtoupper($s0); } 
		$s=iconv("UTF-8","gb2312//IGNORE", $s0); 
		$asc=ord($s{0})*256+ord($s{1})-65536; 
		if($asc>=-20319 and $asc<=-20284)return "A"; 
		if($asc>=-20283 and $asc<=-19776)return "B"; 
		if($asc>=-19775 and $asc<=-19219)return "C"; 
		if($asc>=-19218 and $asc<=-18711)return "D"; 
		if($asc>=-18710 and $asc<=-18527)return "E"; 
		if($asc>=-18526 and $asc<=-18240)return "F"; 
		if($asc>=-18239 and $asc<=-17923)return "G"; 
		if($asc>=-17922 and $asc<=-17418)return "H";               
		if($asc>=-17417 and $asc<=-16475)return "J";               
		if($asc>=-16474 and $asc<=-16213)return "K";               
		if($asc>=-16212 and $asc<=-15641)return "L";               
		if($asc>=-15640 and $asc<=-15166)return "M";               
		if($asc>=-15165 and $asc<=-14923)return "N";               
		if($asc>=-14922 and $asc<=-14915)return "O";               
		if($asc>=-14914 and $asc<=-14631)return "P";               
		if($asc>=-14630 and $asc<=-14150)return "Q";               
		if($asc>=-14149 and $asc<=-14091)return "R";               
		if($asc>=-14090 and $asc<=-13319)return "S";               
		if($asc>=-13318 and $asc<=-12839)return "T";               
		if($asc>=-12838 and $asc<=-12557)return "W";               
		if($asc>=-12556 and $asc<=-11848)return "X";               
		if($asc>=-11847 and $asc<=-11056)return "Y";               
		if($asc>=-11055 and $asc<=-10247)return "Z";   
		return 0; 
	}
	
	//生成系统关键词文件
	function set_system_keywords(){
		global $db;
		$str="<?php\r\n";
		$str.="\$keyword_system = array (\r\n";
		$sql="select * from `".PRE."keywords`";	
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			$str.="	'".$row['keyword']."' => '".$row['replace']."',\r\n";
		}
		$str.=");\r\n";
		$str.="?>\r\n";
		
		$filename=ZZCMS_ROOT.'data/system_keyword.php';
		$handle=fopen($filename,"w");
		if(!is_writable($filename)){
			die ("文件：".$filename."不可写，请检查其属性后重试!");
		}
		if(!fwrite($handle,$str)){
			die ("生成文件".$filename."失败!");
		}
		fclose ($handle); //关闭指针		
	}
	
	//栏目菜单
	function meun(){
		global $db,$about;
		$sql="select * from `".PRE."type` where `is_show`=1 order by `is_top` desc,`id` desc";
		$rs=$db->query($sql) or die (showmsg("显示菜单出现错误"));
		$show="<ul><li><a href=\"index.php\">首页</a></li>";
		while($row=$db->fetch_array($rs)){
			switch($row['chaid']){
				case 1:
				$show.="<li><a href=\"Art_List.php?cid=".$row['id']."\">".$row['name']."</a></li>";
				break;
				case 2:
				$show.="<li><a href=\"Pro_List.php?cid=".$row['id']."\">".$row['name']."</a></li>";
				break;
				case 3:
				$show.="<li><a href=\"Down_List.php?cid=".$row['id']."\">".$row['name']."</a></li>";
				break;
				case 4:
				$r=$db->get_one("select * from `".PRE."about` where `cid`=".$row['id']);
				$aboutid=$r['id'];
/*				$aboutid=$about->about_id(intval($row['id']));
*/				$show.="<li><a href=\"About.php?id=$aboutid\">".$row['name']."</a></li>";
				break;
				default:
				$show.="";
			}
		}
		$show.="<li><a href=\"Book.php\">留言本</a></li></ul>";
		return $show;
	}
	
	function zzcms_chaid($id){
		global $zzcms_cha;
		$id=intval($id);
		$str="";
		if($id>0){
			$str.=$zzcms_cha[$id];			
		}else{
			$str.="<select name=\"chaid\" id=\"chaid\"><option value=\"0\" selected=\"parent_id\">请选择模块</option>";
			foreach($zzcms_cha as $k=>$v){
				if($k==$id){
					$str.="<option value=\"$k\">$v</option>\r\n";
				}else{
					$str.="<option value=\"$k\">$v</option>\r\n";
				}
			}
			$str.="</select>\r\n";
		}
		return $str;
	}
?>