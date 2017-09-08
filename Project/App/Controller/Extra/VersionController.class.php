<?php
namespace App\Controller\Extra;
use Think\Controller;
class VersionController extends Controller 
{
	function check()
	{
		$pro = post('pro');
		$dev = post('dev');
		
		$table = D('version_controll');
		$where['pro'] = $pro;
		$where['dev'] = $dev;
		$data = $table
		->field('pro,dev',true)
		->where($where)
		->select()[0];
		
		echo json_encode($data);
	}
}
