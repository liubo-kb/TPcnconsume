<?php
/*
*	商户控制器:
*		login()： 商户登陆操作
*		register()：商户注册操作
*		complete()：商户完善信息操作
*		accountSet()：账户信息设置操作
*		accountGet()：账户信息获取操作
*		search()：搜索商户操作
*		withdraw()：商户余额提现操作
*		creditApp()：商户授信额度提额申请操作
*		creditGet()：获取商户授信额度和余额操作
*		deposit() ：获取商户的保证金操作
*		vipGet()：获取会员清单操作
*		errorCode()：JSON错误码
*		result()：JSON查询结果
*		pwdVertify()：密码验证
*		queryNum()：查询数目
*		query()：查询结果
*		
*/
namespace App\Controller\UserType;
use Think\Controller;
ini_set('dare.timezone','Asia/Shanghai');
class RegisterController extends Controller 
{	
	public function register_check()
	{
		$phone = post('phone');
		$referrer = post('referrer');
		
		$table = D('user');
		$where['phone'] = $phone;
		$check = $table->where($where)->count();
		if($check > 0)
		{
			$result['result_code'] = "phone_duplicate";
			echo json_encode($result);
			return;
		}
		
		if($referrer == '无人推荐')
		{
			$result['result_code'] = "access";
			echo json_encode($result);
			return;
		}
		
		$table = D('user');
		$where['phone'] = $referrer;
		$check = $table->where($where)->count();
		
		if($check <= 0)
		{
			$result['result_code'] = "referrer_not_found";
			echo json_encode($result);
			return;
		}
		
		$result['result_code'] = "access";
		echo json_encode($result);
		
	}
	
	
}
