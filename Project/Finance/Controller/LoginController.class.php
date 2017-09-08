<?php
namespace Finance\Controller;
use Think\Controller;
class LoginController extends Controller 
{
    public function view()
	{
		$this->display('login');
	}
	
	public function login()
	{
		echo "access";
	}
}
