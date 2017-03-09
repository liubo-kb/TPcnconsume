<?php
namespace App\Controller\Extra;
use Think\Controller;
class LoginController extends Controller 
{
	public function accountVerTify()
	{
		$type = post('type');
		$name = post('name');
		$id = post('id');
		
		if($type == 'u')
		{
			$table = 'user';
		}
		else
		{
			$table = 'merchant';
		}
		
		//echo $phone.$type.$name.$id;

		$account = D($table);
		$where['id'] = $id;
		$where['name'] = $name;
		$check = $account->where($where)->count();

		
		if($check <=0 )
		{
			$result['result_code'] = 'not_found';
		}
		else
		{
			$result['result_code'] = 'access';
			$data = $account->where($where)->select();			 
			$result['phone'] = $data[0]['phone'];
			$result['passwd'] = $data[0]['passwd'];
		}  
	
		echo json_encode($result); 		
	
	}
	
}
