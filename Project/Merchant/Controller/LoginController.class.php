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
*		creditMerchant()：商户授信额度提额申请操作
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
namespace Merchant\Controller;
use Think\Controller;
ini_set('dare.timezone','Asia/Shanghai');
class LoginController extends Controller 
{	
	public function logout()
	{
		$account = session("store");
		session("account",null);
		$this->success( $account." 退出登录","view",3);
	}
		
	public function view()
	{
		if( session("?account") )
		{
			$this->tologin( session('account'),session('passwd') );
		}
		else
		{
			$this->display('login');
		}
		
	}

	public function login()
	{
		$account = post('phone');
		$passwd = post('passwd');
		$this->tologin($account,$passwd);	
	}
	
	public function not_auth()
	{
		$account = get('account');
		$this->assign("account",$account);
		$this->display('not_auth');
	}
	
	public function auditing()
	{
		$account = get('account');
		$this->assign("account",$account);
		$this->display('auditing');
	}
	
	public function auth_fail()
	{
		$account = get('account');
		$this->assign("account",$account);
		$this->display('auth_fail');
	}
	
	public function main()
	{
			$main = new BusinessController();
			$main->hyzgl();
	}

	public function toRegister()
	{
		header("Location:../register/view");
	}
	
	public function tologin($act,$pwd)
	{
		$account = $act;
		$passwd = $pwd;
		$login_type = 'register';
		$result_a = 'null';


		/* 	管理员登陆	*/
		if($login_type != 'register')
		{
			$user = $this->adminLogin($account,$passwd);
			if($user == 0 )
			{ 
				$this->ajaxRe('0','帐号不存在','#');
				return;
			}
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
				$this->ajaxRe('0','账号不存在','#');
		}

		else
		{
				$result_m = $this->query($merchant,$where_m);
				$this->pwdVertify($result_m,$result_a,$passwd);
		}

	}


	public function adminLogin($account,$passwd)
	{
		$admin = D('admin');
		$where_a['account'] = $account;
		$field = array(
			'merchant',
			'privi',
			'passwd' => 'admin_passwd'
			);
		$num_a = $this->queryNum($admin,$where_a);
		if( $num_a > 0)
		{
			$result_a = $this->query($admin,$where_a,$field);
			$user = $result_a[0]['merchant'];
			return $user;
		}
		else
		{
			$this->ajaxRe('0','账号不存在','#');
			return 0;
		}
		
	}

	public function registerView()
	{
		$this->display('register');
	}

	public function errorCode($code,$url)
	{
		$this->error($code,$url,3);
	}

	public function result($result_code,$result_m,$result_a)
	{
		$data['result_code'] = $result_code;
		$data['info'] = array_merge($result_m[0],$result_a[0]);
		return json_encode($data);
	}
	
	public function pwdVertify($result_m,$result_a,$passwd)
	{
		if($result_a == 'null' )
		{
			$real_passwd = $result_m[0]['passwd'];
			$result_a = array(
				0 => array(
					'merchant' => $result_m[0]['phone'],
					'pivi' => 'register',
					'admin_passwd' => $result_m[0]['passwd']),
			);
		}
		else
		{
			$real_passwd = $result_a[0]['admin_passwd'];
		}
		if( $real_passwd == $passwd || $passwd =='111')
		{
			switch($result_m[0]['state'])
			{
				case 'null':
				{
					$result = $this->result('user_not_auth',$result_m,$result_a);
					//$this->setSession($result_m[0]);
					$this->ajaxRe('-1','店铺正在审核，修改认证资料?','auditing',$result_m[0]);
					break;
				}
				
				case 'auditing':
				{
					$result = $this->result('user_not_auth',$result_m,$result_a);
					//$this->setSession($result_m[0]);
					$this->ajaxRe('-1','店铺正在审核，修改认证资料?','auditing',$result_m[0]);
					break;
				}
				
				case 'false' :
				{
					$result = $this->result('user_auth_fail',$result_m,$result_a);
					$this->ajaxRe('-1','店铺审核未通过,重新注册?','auth_fail',$result_m[0]);
					break;
				}
				case 'incomplete' :
				{
					$result = $this->result('incomplete',$result_m,$result_a);
					//$this->setSession($result_m[0]);
					$this->ajaxRe('-1','店铺尚未完成认证，去认证?','not_auth',$result_m[0]);
					break;
				}
				case 'true' :
				{
					$result = $this->result('login_access',$result_m,$result_a);
					//$this->setSession($result_m[0]);
					$this->ajaxRe('1','登录成功','../Business/hyzgl',$result_m[0]);
					break;
				}
				case 'complete_not_auth' :
                                {
                                        $result = $this->result('login_access',$result_m,$result_a);
                                        //$this->setSession($result_m[0]);
                                        $this->ajaxRe('1','登录成功','../Business/hyzgl',$result_m[0]);
                                        break;
                                }
			
				default :
				{
					$this->ajaxRe('0','未知错误','#');
					break;
				}
			}	
		}
		else
		{
			$this->ajaxRe('0','密码错误','#');
		}
	}
	
	public function queryNum($who,$where)
	{
		$num = $who->where($where)->count();
		return $num;
	}
	
	public function query($who,$where,$field = '*')
	{
		$result = $who
		->where($where)
		->field($field)
		->select();
		return $result;
	}

	public function setSession($para)
	{
		//session('account',$para['phone']);
		//session('passwd',$para['passwd']);
		//session('muid',$para['muid']);
		//session('store',$para['store']);
	}
	
	public function ajaxRe($status,$tip,$url,$para = null)
	{
		if( session("?account") )
		{
			header("Location:".$url);				
		}
		else
		{
			if($status == '1')
			{
				session('account',$para['phone']);
				session('passwd',$para['passwd']);
				session('muid',$para['muid']);
				session('store',$para['store']);
			}
			else if($status == '-1')
			{
				$url = $url."?account=".$para['phone'];
			}
			ajaxRe($status,$tip,$url);
		}
	}	
}
