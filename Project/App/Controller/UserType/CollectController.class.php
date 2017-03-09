<?php

/*
*       用户店铺收藏控制器:
*               initialize()： 初始化操作
*               stateGet()：获取店铺收藏状态操作
*               stateSet()：设置店铺收藏状态操作
*               storeGet()：获取店铺信息操作
*/


namespace App\Controller\UserType;
use Think\Controller;
use App\Model\UserCollectModel;
class CollectController extends Controller 
{
	private $user;
	private $merchant;
	private $state;
	function _initialize()
	{
		$this->user = post('user');
		$this->merchant = post('merchant');
		$this->state = post('state');
	}

	public function stateGet()
	{
		$collect = D('UserCollect');
		$where['user'] = $this->user;
		$where['merchant'] = $this->merchant;
		$check = $collect->where($where)->count();
		if($check > 0)
		{
			$result['result_code'] = 'true';
		}
		else
		{
			$result['result_code'] = 'false';
		}
		echo json_encode($result);
	}

	public function stateSet()
	{
		$collect = D('UserCollect');
		$sql['user'] = $this->user;
		$sql['merchant'] = $this->merchant;
	
	
		if($this->state == 'true')
		{
			$result['result_code']= 'true';
			$collect->addWithCheck($sql);
			echo json_encode($result);
		}
		else if($this->state == 'false')
		{
			$result['result_code'] = 'false';
			$collect->where($sql)->delete();
			echo json_encode($result);
		}
	}

	public function storeGet()
	{
		$collect = D('UserCollect');
		$where['user'] = $this->user;
	
		$data = $collect
		->join('cn_merchant ON cn_merchant.muid = cn_user_collect.merchant')
		->field('store,name,address,image_url,phone,muid,longtitude,latitude')
		->where($where)
		->select();

		echo json_encode($data);
	}
	
}
