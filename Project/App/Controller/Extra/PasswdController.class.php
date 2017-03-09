<?php
namespace App\Controller\Extra;
use Think\Controller;
class PasswdController extends Controller 
{
	public function accountVerify()
	{
		$phone = post('phone');
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
		$where['phone'] = $phone;
		$data = $account->where($where)->field('name,id')->select();

		//dump ($data);
		if($data[0]['id'] == null && $data[0]['name'] == null)
		{
			$result['result_code'] = 'not_found';
		}
		else if($name != $data[0]['name'])
		{
			$result['result_code'] = 'name_wrong';
		}
		else if($id != $data[0]['id'])      
                {
                        $result['result_code'] = 'id_wrong';
                }
		else
		{
			$result['result_code'] = 'access';
		}  
	
		echo json_encode($result); 		
	
	}

	public function reset()
	{
		$phone = post('phone');
                $type = post('type');
                $passwd = post('name');
                

                if($type == 'u')
                {
                        $table = 'user';
                }
                else
                {
                        $table = 'merchant';
                }

                $account = D($table);
                $where['phone'] = $phone;
		$set['passwd'] = $passwd;
		$data['result_code'] = $account->where($where)->save($set);
		echo json_encode($data);
	}	
}
