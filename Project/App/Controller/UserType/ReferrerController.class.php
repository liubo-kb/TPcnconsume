<?php

/*
*       用户推荐人控制器:
*               initialize()： 初始化操作
*               get()：获取推荐人操作
*               add()：设置商户推荐人图像上传状态操作
*               
*/


namespace App\Controller\UserType;
use Think\Controller;
use App\Model\ReferrerModel;
class ReferrerController extends Controller 
{
	private $uuid;
	private $percent;
	function _initialize()
	{
		$this->uuid = post('uuid');
		$this->percent = getPercent($this->uuid);
		
	}

	function test()
	{
		echo json_encode( $this->percent );
		
	}

	public function get()
	{
		$referrer = D('referrer');
		$where['referrer'] = $this->uuid;
		$data = $referrer
		->where($where)
		->field('recommend,type,sum')
		->select();
		
		
		for( $i = 0; $i < count($data); $i++ )
		{
			if($data[$i]['type'] == 'm')
			{
				$merchant = D('merchant');
				$where_m['muid'] = $data[$i]['recommend'];
				$data_m = $merchant->where($where_m)->select();
				$data[$i]['name'] = $data_m[0]['store'];
				$data[$i]['income'] = doubleval($data[$i]['sum']) * doubleval($this->percent['merchant']) * 0.01;
			}
			
			else
			{
				$user = D('user');
				$where_u['uuid'] = $data[$i]['recommend'];
				$data_u = $user->where($where_u)->select();
				$data[$i]['name'] = $data_u[0]['nickname'];
				$data[$i]['income'] = doubleval($data[$i]['sum']) * doubleval($this->percent['user']) * 0.01;

			}
		} 
		
		echo json_encode($data);
	}
}
