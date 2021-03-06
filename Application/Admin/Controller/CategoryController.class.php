<?php
namespace Admin\Controller;
use Think\Controller;	
class CategoryController extends Controller{
	
	private $categoryD;
	private $xmlPath;
	
	private _befor_index(){
		$this->categoryD = D("category");
		$this->xmlPath = PUBLIC_ROOT."category.inc";
	}
	
	public function index(){
		
	}
	
	public function add(){
		if(!IS_POST){
			$this->display("CategoryAdd.html");
		}else{
			/*需要的数据
			 * 1.上级主键id
			 * 2.分类名
			 * */
			$pid = I("post.pid",0,"int");
			$name = I("post.name");
			$class = $pid - 1;
			$ifShow = I("post.ifShow");
			$sortOrder = I("post.sortOrder");			
			
			$id = $this->categoryD->addData($class,$pid,$name,$ifShow,$sortOrder);
			
			//XML路径
			if(!file_exists($xmlPath)){	return;}
			
			$xml = simplexml_load_file($xmlPath);
			$xml->addChild($id,$name);
			$xml->$id->addAttribute("pid",$pid);
		}
	}
}
