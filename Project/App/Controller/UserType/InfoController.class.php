<?php

namespace App\Controller\UserType;
use Think\Controller;
use App\Model\UserModel;
class InfoController extends Controller 
{
	/*		实名认证接口		*/
	public function realNameAuth()
	{
		$uuid = post('uuid');
		$name = post('name');
		$id = post('id');
		$datetime = currentTime();
		
		$table = D('real_name_auth');
		$record = array(
			'uuid' => $uuid, 'name' => $name, 'id' => $id,
			'datetime' => $datetime, 'state' => 'access' , 'tip' => "审核通过"
		);
		
		$result['result_code'] = addWithCheck($table,$record);
		
		$table = D('user');
		$where['uuid'] = $uuid;
		$set['auth_state'] = 'access';
		$set['name'] = $name;
		$set['id'] = $id;
		$result['result_code'] = setWithCheck($table,$where,$set);
		echo json_encode($result);
	}
	
	/*		获取认证结果		*/
	public function getAuthResult()
	{
		$uuid = post('uuid');
		$table = D('real_name_auth');
		$where['uuid'] = $uuid;
		
		$count = $table->where($where)->count();
		if($count > 0)
		{
			$data = $table->where($where)->select()[0];
		}
		else
		{
			$data['uuid'] = $uuid;
			$data['name'] = $name;
			$data['id'] = $id;
			$data['datetime'] = $datetime;
			$data['state'] = 'not_auth';
			$data['tip'] = '未认证';
		}

		$data['state'] = 'access';
		
		echo json_encode($data);
	}
	
	/*		获取个人信息		*/
	public function get()
	{
		$uuid = post('uuid');
		$table = D('user');
		$where['uuid'] = $uuid;
		$data = $table->where($where)->select()[0];
		$data['state'] = $data['auth_state'];
		echo json_encode($data);
	}
}
