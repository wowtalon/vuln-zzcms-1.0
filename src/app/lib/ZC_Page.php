<?php
//分页函数
class page{
	private $totle;//记录总数
	private $pagesize;//页面大小
	private $page;//显示页码数
	private $url;//需要显示的页面
	private $next_page_num=8;//当前页后台跟的分页号码条数
	
	function __construct($totles,$size){
		$this->totle=$totles;//总记录条数
		$this->pagesize=$size;//分页大小
	}
	
	//分页显示
	function page(){
		if(!$this->url){
			$this->url=$_SERVER['REQUEST_URI'];
		}
		//得到page的数字
		if(isset($page)){
			$this->page=intval($page);
		}else{
			$this->page=1;
		}


		//分析URL
		$p_url=parse_url($this->url); //将URL相关信息保存到变量中
		if(empty($p_url['query'])){
			$this->url.="?page"; //如果URL不带参数信息，则在URL后台加上参数?page
		}else{
			$url_query=$p_url['query']; //取得URL参数字符串
			if(substr_count($url_query,'page=')>0){//检查URL中是否包含page=
				$url_query = ereg_replace("(^|&)page=$this->page", "", $url_query);//把URL中的&page或者page去掉
				$this->url=str_replace($p_url["query"],$url_query,$this->url);//用处理过的参数字符串替换原本的参数字符串
			}
			
			if($url_query){//如果参数字符串不为空
				$this->url.="&page";//在URL后台加上参数page
			}else{//如果URL去掉page后无参数
				$this->url.="page";//在URL后台加上参数page
			}
			
		}
		
		$this->page=intval($this->page);//如果page后参数不为数字
		if(!$this->page||$this->page<1){
			$this->page=1;
		}
		//定义页码
		$lastpage=ceil($this->totle/$this->pagesize);//总记录数除每页显示条数得整为总的页数
		$this->page=min($lastpage,$this->page);//当页数超过总页码时显示最后一页
		$prepage=$this->page<=1?1:$this->page-1;//上一页
		$nextpage=$this->page>=$lastpage?$lastpage:$this->page+1;//下一页
		$show="<dl class='page_h'><dd>当前第".$this->page."页</dd><dd>共".$this->totle."条</dd><dd>共".$lastpage."页</dd><dd>".$this->pagesize."条/页</dd><dd>";

		if($this->page<=1){
			$show.="首页</dd><dd>上一页</dd><dd>";
		}else{
			$show.="<a href='$this->url=1'>首页</a></dd><dd><a href='$this->url=$prepage'>上一页</a></dd><dd>";
		}
		$num=$lastpage-$this->page;
		$pages_num=0;
		$num_next=$this->next_page_num<$num?$this->next_page_num:$num;
		for($i=1;$i<=$num_next;$i++){
			$pages_num=$this->page+$i;
			$show.="<a href='$this->url=$pages_num'>$pages_num</a>";
		}
		if($this->page>=$lastpage){
			$show.="下一页</dd><dd>尾页";
		}else{
			$show.="<a href='$this->url=$nextpage'>下一页</a></dd><dd><a href='$this->url=$lastpage'>尾页</a>";
		}
		$show.="</dd></dl>";
		return $lastpage>1?$show:false;
	}
}


?>