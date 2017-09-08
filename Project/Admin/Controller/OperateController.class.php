<?php
namespace Admin\Controller;
use Think\Controller;
class OperateController extends Controller 
{
	public function show()
	{
		$muid = get('muid');
		$this->assign('muid',$muid);
		$this->assign('account',session('account'));
		$this->assign('name',session('name'));
		$this->display('index');
	}
}
