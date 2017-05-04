<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller 
{
	public function login()
	{
		$this->display('login');
	}

	public function enter()
	{
		$account = post('account');
		$passwd = post('passwd');
		$where['account'] = $account;
		$table = D('auditor');
		$count = $table->where($where)->count();
		if($count <= 0)
		{
			echo "not_found";
			return;
		}
		else
		{
			$info = $table->where($where)->select()[0];
			if($info['passwd'] != $passwd)
			{
				echo "passwd_wrong";
			}
			else
			{
				session('account',$account);
				echo "access";
			}
		}
		
	}
}
