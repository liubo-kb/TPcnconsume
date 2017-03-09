<?php

/*
*       商户管理员控制器
*	  adminAdd() ：增加管理员操作
*	  adminDel() ：删除管理员操作
*	  adminGet() ：查询管理员操作
*	  adminMod() ：修改管理员操作	       
*/


namespace App\Controller\MerchantType;
use Think\Controller;

class AdminController extends Controller 
{

	public function add()
	{
		$merchant = post('muid');
		$account = post('account');
		$privi = post('privi');
		$sex = post('sex');
		$phone = post('phone');
		$passwd = post('passwd');
		$position = post('position');

		$admin = D('Admin');
			
		$person = array(
			'merchant' => $merchant,
			'account' => $account,
			'privi' => $privi,
			'sex' => $sex,
			'phone' => $phone,
			'passwd' => $passwd,
			'position' => $position,
		);
		
		$data['result_code'] = $admin->addWithCheck($person);
		echo json_encode($data);
	}

	
	public function get()
	{
		$merchant = post('muid');
		$admin = D('Admin');

		$where['merchant'] = $merchant;

		$data = $admin
		->where($where)
		->select();

		echo json_encode($data);
	}


	public function del()
        {
                $merchant = post('muid');
		$account = post('account');

                $admin = D('Admin');

                $where['merchant'] = $merchant;
		$where['account'] = $account;

                $data['result_code'] = $admin
		->where($where)
		->delete();

                echo json_encode($data);
        }

	public function mod()
        {
                $where['merchant']= post('muid');
                $where['account'] = post('eaccount');
		
		$update['account'] = post('account');
		$update['passwd'] = post('passwd');
		$update['privi'] = post('privi');
		$update['sex'] = post('sex');
		$update['phone'] = post('phone');
		$update['position'] = post('position');


                $admin = D('Admin');

                $data['result_code'] = $admin
                ->where($where)
                ->save($update);

                echo json_encode($data);
        }


}
