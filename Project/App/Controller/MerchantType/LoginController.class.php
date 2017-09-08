<?php
/*
*	商户控制器:
*		login()： 商户登陆操作
*		errorCode()：JSON错误码
*		result()：JSON查询结果
*		pwdVertify()：密码验证
*		queryNum()：查询数目
*		query()：查询结果
*		
*/
namespace App\Controller\MerchantType;
use Think\Controller;
ini_set('dare.timezone','Asia/Shanghai');
class LoginController extends Controller 
{
		
	/*		登录接口		*/
	public function login()
	{
		$account = post('phone');
		$passwd = post('passwd');
		$login_type = post('login_type');
		$result_a = 'null';
		
		if($login_type != 'register')
		{
			$admin = D('admin');
			$where_a['account'] = $account;
			$field = array(
				'merchant' => 'admin_account',
				'privi',
				'passwd' => 'admin_passwd'
			);
			$num_a = $this->queryNum($admin,$where_a);
			if( $num_a > 0)
			{
				$result_a = $this->query($admin,$where_a,$field);	
				$user = $result_a[0]['admin_account'];
			}
			else
			{
				echo $this->errorCode('账号不存在');
				return;
			}
			$result_a[0]['admin_account'] = $account;
		}
		else
		{
			$where_muid['phone'] = $account;
			$muid = D('merchant')->where($where_muid)->select();
			$user = $muid[0]['muid'];
		}

		$where_m['muid'] = $user;
		$merchant = D('merchant');
		$num = $this->queryNum($merchant,$where_m);

		if($num <= 0 )
		{
				echo $this->errorCode('账号不存在');
		}

		else
		{
				$result_m = $this->query($merchant,$where_m);
				echo $this->pwdVertify($result_m,$result_a,$passwd);
		}
	}

	
	/*		验证密码		*/
	public function pwdVertify($result_m,$result_a,$passwd)
	{
		if($result_a == 'null' )
		{
			$real_passwd = $result_m[0]['passwd'];
			$result_a = array(
				0 => array(
					'admin_account' => $result_m[0]['phone'],
					'privi' => 'register',
					'admin_passwd' => $result_m[0]['passwd']),
			);
		}
		else
		{
			$real_passwd = $result_a[0]['admin_passwd'];
		}
		if( $real_passwd == $passwd )
		{
			$result = $this->result("access",$result_m,$result_a);
			return $result;
		}
		else
		{
			return $this->errorCode('密码错误');
		}
	}

	/*		拼接并返回结果		*/
	public function result($result_code,$result_m,$result_a)
	{
		$data['result_code'] = $result_code;
		$data['info'] = array_merge($result_m[0],$result_a[0]);
		if( $data['info']['state'] == 'false')
		{
			$table = D('audit_result');
			$where['muid'] = $data['info']['muid'];
			$data['fail_reason'] = $table->where($where)->select()[0]['tip'];
		}
		return json_encode($data);
	}
	
	/*		查询结果数量		*/
	public function queryNum($who,$where)
	{
		$num = $who->where($where)->count();
		return $num;
	}

	/*		查询商户信息		*/
	public function query($who,$where,$field = '*')
	{
		$result = $who
		->where($where)
		->field($field)
		->select();
		return $result;
	}
	
	/*		返回错误码		*/
	public function errorCode($tip)
	{
		$data['result_code'] = 'fail';
		$data['tip'] = $tip;
        return json_encode($data);
	}
}
