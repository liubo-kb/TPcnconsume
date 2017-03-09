<?php

/*
*       用户银行卡控制器:
*               initialize()： 初始化操作
*               get()：获取银行卡操作
*               add()：添加银行卡操作
*               bind()：绑定银行卡操作
*		delete()：删除银行卡操作
*               
*/


namespace App\Controller\UserType;
use Think\Controller;
use App\Model\UserBankModel;
class BankController extends Controller 
{
	private $user;
	private $name;
	private $bank;
	private $number;
	private $state;
	function _initialize()
	{
		$this->user = post('uuid');
		$this->name = post('name');
		$this->bank = post('bank');
		$this->number = post('number');
		$this->state = post('state');
	}

	public function get()
	{
		$bankAccount = D('UserBank');
		$where['user'] = $this->user;
		$data = $bankAccount->where($where)->select();
		echo json_encode($data);
	}
	public function bound()
        {
                $bankAccount = D('UserBank');
                $where['user'] = $this->user;
		$where['state'] = 'true';
                $data = $bankAccount->where($where)->select();
                echo json_encode($data);
        }



	public function add()
	{
		$bankAccount = D('UserBank');
		$where['user'] = $this->user;
		$check = $bankAccount->where($where)->count();
		if($check > 0)
		{
			$state = 'false';
		}
		else
		{
			$state = 'true';
		}

		$record = array(
			'user' => $this->user, 'name' => $this->name,
			'bank' => $this->bank, 'number' => $this->number, 'state' => $state
		);

		$result['result_code'] = $bankAccount->addWithCheck($record);
		echo json_encode($result);
	}

	public function bind()
	{
		$bankAccount = D('UserBank');
		$where['user'] = $this->user;
		$set['state'] = 'false';
		$bankAccount->where($where)->save($set);
		$set['state'] = 'true';
		$where['number'] = $this->number;
		$result['result_code'] = $bankAccount->where($where)->save($set);
		echo json_encode($result);
	}
	
	public function delete()
	{
		$bankAccount = D('UserBank');
		$where['user'] = $this->user;
		$where['number'] = $this->number;
		$result['result_code'] = $bankAccount->where($where)->delete();
		echo json_encode($result);
	}
	
}
