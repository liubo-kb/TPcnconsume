<?php

/*
*       用户银行卡控制器:
*               initialize()： 初始化操作
*               get()：获取店铺操作
*               add()：添加店铺操作
*               bind()：绑定店铺操作
*		delete()：删除店铺操作
*               
*/


namespace App\Controller\MerchantType;
use Think\Controller;
use App\Model\StoreManageModel;
class StoreController extends Controller 
{
	private $merchant;
	private $merchant_id;
	private $store;
	private $state;
	function _initialize()
	{
		$this->merchant = post('phone');
		$this->merchant_id = post('muid');
		$this->store = post('store');
		$this->state = post('state');
	}

	public function appGet()
	{
		$store = D('StoreManage');
		//$this->state = 'wait';
		//$this->merchant = '18629691107';		

		$where['cn_store_manage.state'] = 'wait';
		$where['cn_store_manage.store'] = $this->merchant;
	
		$data = $store
		->join('cn_merchant ON cn_merchant.muid = cn_store_manage.merchant')
		->where($where)
		->field('name,cn_merchant.store,cn_merchant.muid,address,image_url')
		->select();
		
		echo json_encode($data);
	}

	public function manageGet()
	{
		$store = D('StoreManage');
		//$this->merchant_id = 'm_12dd6779e1';
		//$this->store = 'm_6d4e76ca11';
		//$this->state = 'access';

		$where['cn_store_manage.state'] = "access";
                $where['cn_store_manage.merchant'] = $this->merchant_id;
		
		$data = $store
		->join('cn_merchant ON cn_merchant.muid = cn_store_manage.store')
		->join('cn_merchant_turnover ON cn_merchant_turnover.merchant = cn_store_manage.store')
		->field('name,cn_merchant.store,phone,image_url,address,passwd,remain,cn_merchant_turnover.sum')
		->where($where)
		->select();
                
		for($i = 0; $i < count($data); $i++)
		{
			$merchant = $data[$i]['muid'];
			$card = D('UserCard');
			$where_c['muid'] = $merchant;
			$vip_num['vip_num'] = $card->where($where_c)->distinct(true)->field('user')->count();
			$data[$i] = array_merge($data[$i],$vip_num);
		}
		
		echo json_encode($data);

	}
	public function app()
	{
		$merchant = D('merchant');

		//$this->merchant_id = 'm_6d4e76ca04';
		//$this->store = '18629691107';

		$where['phone'] = $this->store;
		$check = $merchant->where($where)->count();
		if($check > 0)
		{
			$state = 'wait';
			$store = D('StoreManage');
			$record = array('merchant' => $this->merchant_id, 'store' => $this->store,'state' => $state);
                	$result['result_code'] = $store->addWithCheck($record);
                	echo json_encode($result);
	
		}
		else
		{
			$result['result_code'] = 'merchant_not_found';
                        echo json_encode($result);
		}

		
	}

	public function set()
	{
		$store = D('StoreManage');
		//$this->merchant = '18629691107';
		//$this->merchant_id = 'm_6d4e76ca11';              
 
		//$this->store = 'm_6d4e76ca04';
                //$this->state = 'access';

		$where['merchant'] = $this->store;
		$where['store'] = $this->merchant;

		logInfo('muid'.$this->merchant_id);
		logInfo('phone'.$this->merchant);
		logInfo('store'.$this->store);

		if($this->state == 'access')
		{
			$set['state'] = 'access';
			$set['store'] = $this->merchant_id;
			$result['result_code'] = $store->where($where)->save($set);
		}
		else
		{
			$result['result_code'] = $store->where($where)->delete();
		}
		echo json_encode($result);
	}
	
	public function delete()
	{
		$store = D('StoreManage');
                $where['merchant'] = $this->store;
                $where['store'] = $this->merchant;
		
		$result['result_code'] = $store->where($where)->delete();
		echo json_encode($result);
	}	
}
