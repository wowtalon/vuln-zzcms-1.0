<?php 
//记录蜘蛛爬行日志列表
$botlist=cache_read('botlist.php');
$useragent=strtolower($_SERVER['HTTP_USER_AGENT']);
foreach($botlist as $k=>$v){
	if(strpos($useragent,strtolower($botlist[$k]['biaoji']))!==false){
		set_access(intval($botlist[$k]['id']));
		set_hits(intval($botlist[$k]['id']));
	}
}
unset($botlist);
?>