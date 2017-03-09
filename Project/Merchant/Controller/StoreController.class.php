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


namespace Merchant\Controller;
use Think\Controller;
use Merchant\Model\StoreManageModel;
class StoreController extends Controller 
{
	private $merchant;
	private $merchant_id;
	private $store;
	private $state;
	function _initialize()
	{
		$this->merchant = session('account');
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
		->field('name,cn_merchant.store,phone,cn_merchant.muid')
		->select();
		
		echo json_encode($data);
	}

	public function app()
	{
		$account_list = post('account');
		
		$this->merchant_id = session("muid");
		
		for( $i=0; $i<count($account_list); $i++ )
		{
			$table = D('merchant');
			$store = $account_list[$i];
			$wherem['phone'] = $store;
                	$check = $table->where($wherem)->count();
			if( $check <= 0)
			{
				 $this->error("店铺:‘".$store."’不是商消乐线上用户，不能申请。","../Business/shopAdd",3);
			}
			
		
			$table = D('store_manage');
                        $wheres['store'] = $store;
			$wheres['merchant'] = $this->merchant_id;
			
                        $check = $table->where($wheres)->count();
                        if( $check > 0)
                        {
                                $this->error("店铺:‘".$store."’已管理，不能重复申请。","../Business/shopAdd",3);
                        }
		}

		for( $i=0; $i<count($account_list); $i++ )
                {
                        $store = $account_list[$i];	
			$state = 'wait';
                        $table = D('StoreManage');
                        $record = array('merchant' => $this->merchant_id, 'store' => $store,'state' => $state);
                        $result['result_code'] = $table->addWithCheck($record);
             
                }

		$this->success("恭喜您，申请成功。对方同意，即可实现管理。","../Business/shopAdd",3);

		
	}

	public function set()
	{
		$store = D('StoreManage');
		//$this->merchant = '18629691107';
		//$this->merchant_id = 'm_6d4e76ca11';              
 
		//$this->store = 'm_6d4e76ca04';
                //$this->state = 'access';

		$where['merchant'] = get('merchant');
		$where['store'] = session("account");

		if( get("state") == "access" )
		{
			$set['state'] = 'access';
			$set['store'] = session("muid");
			$result['result_code'] = $store->where($where)->save($set);
			$this->success("已同意。","../Business/dpgl",3);
		}
		else
		{
			$result['result_code'] = $store->where($where)->delete();
			$this->success("已拒绝。","../Business/dpgl",3);
		}
		
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
