<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class IndexController extends Controller 
{
	public function index()
    	{
        	//$this->show('欢迎使用 MyThinkPHP!');
		
		//视图输出
		//$this->assign('name','刘波')->assign('sex','男');
		//$this->display('Index/test');

		//系统方法
		//$arr = array(1,2,3,4,5);
		//dump($arr);
		
		$arr = array(
				1 => array('name'=>'lb','age'=>'24'),
				2 => array('name'=>'kb','age'=>'38'),
				3 => array('name'=>'zzb','age'=>'50'),
				4 => array('name'=>'zx','age'=>'45')
				);
		//$this->assign('person',$arr);
		
		$this->assign('num',9);	
		//$this->display();
	
		$im = new \Org\IM\ImConnect();
		dump($im->createUser('liubo','000000'));

		
		//调试
		//trace('arr',$arr[1]['name']);
		//公共函数
		//showData();

		//$user = new Model('merchant');
		//$user = D('Index');
		//$user = new \Home\Model\UserModel();
		//$data = $user->select();
		//dump($data);
		//echo $user->getInfo();

 	}
	
	public function user()
	{
		//$user = D('User');
		//echo $user->getInfo();
		echo "user";
	}
}
