<?php
namespace App\Controller\UserType;
use Think\Controller;
class BindController extends Controller 
{
	public function get()
	{
		$type = post('type');
		$uid = post('uid');
		$table = $this->getTable($type);

		$where['uid'] = $uid;
		$count = D($table)->where($where)->count();
		if( $count <=  0 )
		{
			$result['result_code'] = 'no_bind';
			echo json_encode($result);
			return;
		}
		else
		{
			$result['result_code'] = 'binded';
		}
		$data = D($table)
		->where($where)
		->join("cn_user ON cn_user.uuid = cn_".$table.".user")
		->select();
		$result['phone'] = $data[0]['phone'];
		$result['passwd'] = $data[0]['passwd'];
		echo json_encode($result);
	}
	
	public function bind()
	{
		$type = post('type');
		$uid = post('uid');
		$user = post('user');
		$passwd = post('passwd');

		$table = D('user');
		$where['phone'] = $user;
		$count = $table->where($where)->count();
		if( $count <= 0 )
		{
			$result['result_code'] = 'not_found';
                        echo json_encode($result);
                        return;
		}

		$data = $table->where($where)->select()[0];
		if( $passwd !=  $data['passwd'])
		{
			$result['result_code'] = 'passwd_wrong';
                        echo json_encode($result);
                        return;
		}

		$user = $data['uuid'];
		$table = $this->getTable($type);
		$record = array(
			'uid' => $uid, 'user' => $user
		);
		$result['result_code'] = D($table)->add($record);
		echo json_encode($result);
	}

	public function getTable($type)
	{
		switch( $type )
                {
                        case 'wechat':
                                $table = 'bind_wechat';
                                break;
                        case 'qq':
                                $table = 'bind_qq';
                                break;
                        case 'sina':
                                $table = 'bind_sina';
                                break;
                        default:
                                break;
                }
		
		return $table;
	}
		
}
