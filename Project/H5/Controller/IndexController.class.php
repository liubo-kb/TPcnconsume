<?php
namespace H5\Controller;
use Think\Controller;
class IndexController extends Controller
{
    	public function index()
	{
	     	$this->show("模块H5");
	}

    	public function demo()
    	{
		$this->display("demo");
    	}
}
