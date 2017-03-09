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
namespace App\Controller\MerchantType;
use Think\Controller;
use App\Model\MerchantModel;
ini_set('dare.timezone','Asia/Shanghai');
class MerchantController extends Controller 
{
		
	public function login()
	{
		$account = post('phone');
		$passwd = post('passwd');
		$login_type = post('login_type');
		
		//LogInfo('user:'.$user);
		//LogInfo('passwd:'.$passwd);
		//LogInfo('login_type:'.$login_type);

		//$account = '15191582181';
		//$passwd = '111111';
		//$login_type = 'register';
		
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
				echo $this->errorCode('user_not_found');
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
                    	echo $this->errorCode('user_not_found');
                }

                else
                {
                    	$result_m = $this->query($merchant,$where_m);
                        echo $this->pwdVertify($result_m,$result_a,$passwd);
                }
		
		//echo $merchant->getInfo();
	}

	
	public function register()
	{
		$muid = get_uuid('m_');
		$phone = post('phone');
		$passwd = post('passwd');
		$referrer = post('referrer');
		
		//$phone = '00001';
		//$passwd = '00001';
		//$referrer = '13488199837';	
	
		$datetime = currentTime();
		
		$merchant = D('merchant');
		$where_ex['phone'] = $phone;
                $check_ex = $merchant->where($where_ex)->count();
		if($check_ex > 0)
		{
			$result['result_code']= 'phone_duplicate';
                        echo json_encode($result);
			return;
		}
		if($referrer != '无人推荐')
                {
			$user = D('user');
                        $where_ex['phone'] = $referrer;
                        $check_ex = $user->where($where_ex)->count();

                        if($check_ex <= 0)
                        {
                                $result['result_code']= 'referrer_not_exist';
                                echo json_encode($result);
                                return;
                        }
                        $data = $user->where($where_ex)->select();
                        $referrer_uuid = $data[0]['uuid'];
                        $record_r = array(
                                'referrer' => $referrer_uuid,
                                'recommend'=>$muid,
                                'type'=>'m',
                                'sum'=>'0.00元',
                                'state'=>'ONLINE'
                        );

	
                        $ref = M('referrer');
                        $ref->add($record_r);
			
			//检测用户当前级别
			checkUserLevel($referrer_uuid);

			//处理推荐红包
                        $sum = getSystemPara($datetime,'reward_referrer')['merchant']; //获取系统推荐政策
                        setRedPacket($referrer_uuid,$sum);

                        //更新推荐收入
                        setReferrerSum($referrer_uuid,'u',$sum);

                        //设置推荐收入记录
                        $record = array('datetime'=>$datetime,'tip' => '推荐商户奖励', 'sum' => $sum,'type' => 'm', 'id' => $referrer_uuid);
                        setIncomeRecord($record);
			
                }
		else
		{
			$referrer_uuid = 'null';
		}
		
		//写入注册信息
		$record_m = array(
                        'muid'=>$muid, 'phone'=>$phone,  'store' => $phone, 'passwd'=>$passwd,  'referrer'=>$referrer_uuid,'datetime'=>$datetime,
                        'state'=>'incomplete'
                );
		$data = $merchant->addWithCheck($record_m);
		while($data == '1062')
		{
			$muid = get_uuid('m_');
			$record_m = array(
                        	'muid'=>$muid, 'phone'=>$phone,  'store' => $phone, 'passwd'=>$passwd,  'referrer'=>$referrer_uuid,'datetime'=>$datetime);
			$data = $merchant->addWithCheck($record_m);
		}
	
		//添加环信账号	
		$im = new \Org\IM\ImConnect();
                $im->createUser($muid,'000000');

		

		$result['result_code']= '1';
                echo json_encode($result);
		
		
	}

	public function complete_01()
	{
		$phone = post('phone');	
                $set = array(
                       	'name'=>post('name'), 'id'=>post('id'),  'bname'=>post('bname'),  
			'bank'=>post('bank'),  'phone_search_pwd'=>post('psp'),'account'=>post('account'),
			'house_add'=>post('house_add'),'state'=>'incomplete'
                );

                $merchant = D('merchant');
		$where['phone'] = $phone;
		$result['result_code'] = $merchant
		->where($where)
		->save($set);

		echo json_encode($result);

	}

	public function complete_02()
        {
                $phone = post('phone');
		$muid = post('muid');
                $store = post('store');
                $image = post('image_url');

                $set = array(
                        'store'=>post('store'), 'address'=>post('address'),  'state'=>'incomplete',
                        'image_url'=>post('image_url'),  'trade'=>post('trade'),'explain_lic'=>post('explain_lic'),
                        'house_contact'=>post('house_contact'),'longtitude'=>post('longtitude'),'latitude'=>post('latitude'),
			'store_number' => post('store_number')
                );

                $merchant = D('merchant');
                $where['phone'] = $phone;
                $result['result_code'] = $merchant
                ->where($where)
                ->save($set);

                $imAccount = D('im_account');
                $record = array(
                        'account' => $muid, 'passwd' => '000000', 'phone' => $phone,
                        'nickname' => $store, 'headImage' => $image
                );
                $imAccount->addWithCheck($record);
                echo json_encode($result);

        }

	public function complete_03()
        {
                $phone = post('phone');
                
                $set = array(
                        'frel_name'=>post('frel_name'),'frel_phone'=>post('frel_phone'),'srel_name'=>post('srel_name'),
                        'srel_phone'=>post('srel_phone'),'trel_name'=>post('trel_name'),'trel_phone'=>post('trel_phone'),
			'state'=>'null','remain'=>'0.00元','auth_sum'=>'10000元','protocol'=>'agree'
                );

                $merchant = D('merchant');
                $where['phone'] = $phone;
                $result['result_code'] = $merchant
                ->where($where)
                ->save($set);

             
                echo json_encode($result);

        }




	
	public function accountSet()
	{
		$muid = post('muid');
		$type = post('type');
		$merchant = D('merchant');
	        $where['muid'] = $muid;

		switch($type)
		{
			case 'address':
			{
				$para = post('para');		
				$set['address'] = $para;
				$result['result_code'] = $merchant
				->where($where)
				->save($set);
				echo json_encode($result);
				break;
			}
			case 'passwd':
			{
				$passwd_old = post('pwd_old');
				$passwd_new = post('pwd_new');
				$check = $merchant->where($where)->select();
				if($passwd_old == $check[0]['passwd'])
				{
					$set['passwd'] = $passwd_new;
					$result['result_code'] = $merchant
					->where($where)
					->save($set);
					echo json_encode($result);
					break;
				}
				else
				{
					echo $this->errorCode('old_passwd_wrong');
					break;
				}
				
			}
			default:
				break;
			
			
		}
	}
	
	public function accountGet()
	{
		$muid = post('muid');
                $type = post('type');
		
                $merchant = D('merchant');
                $where['muid'] = $muid;
		$data = $merchant->where($where)->select();

		$result[$type] = $data[0][$type];
		echo json_encode($result);
	}
	
	public function search()
	{
		$store = post('store');
		//$store = '';
                $index = post('index');
                $page_num = '10';

                $where['store'] = array("like","%$store%");
                $page = $index.",".$page_num;

                $data = showDataGet($where,$page);
                //dump($data);
                echo json_encode($data);

	}

	public function withdrawApp()
	{
		$muid = post("muid");
                $sum = post('sum');

                $datetime = currentTime();
                        $tradenu = "TX".strtotime($datetime);

                $where['muid'] = $muid;
                $merchant = D('merchant');
                $data = $merchant->where($where)->select();

                $remain = $data[0]['remain'];
                $remain = redAsDouble($remain,$sum);
                $set['remain'] = $remain;
                $merchant->where($where)->save($set);

                $record_w = array(
                        'merchant'=>$muid, 'store'=>$data[0]['store'], 'sum'=>$sum,
                        'name'=>$data[0]['bname'], 'bank'=>$data[0]['bank'],
                        'account'=>$data[0]['account'],'datetime'=>$datetime,'tradenu' => $tradenu,'state' => 'wait'
                );

                $withdraw = M('merchant_withdraw');
                $result['result_code'] = $withdraw->add($record_w);		

		echo json_encode($result);

	}

	public function withdrawGet()
	{
		$muid = post('muid');
		$withdraw = M('merchant_withdraw');
		$where['merchant'] = $muid;
		$result['num'] = $withdraw->where($where)->count();
		$result['sum'] = $withdraw->where($where)->sum('sum');
		$result['remain'] = '0.00';
		$result['record'] = $withdraw->where($where)->field('sum,datetime,tradenu')->select();

		//$result = $withdraw->where($where)->select();
		echo json_encode($result);
	}

	public function sumGet()
	{
		$muid = post('muid');
		//$muid = 'm_12dd6779e1';
		$where['muid'] = $muid;
		$info = D('merchant')->where($where)->field('remain,trade,account')->select();
		$trade = $info[0]['trade'];
		$award = '0.00元';
		$remain = $info[0]['remain'];

        	$data['remain'] = sprintf("%.2f",$remain)."元";
		$data['deposit'] = $this->depositGet($muid);
		$data['account'] = $info[0]['account'];
		$data['award'] = $award;

		echo json_encode($data);

		

		
	}

	public function creditApp()
	{
		$merchant = post('merchant');
		$credit_sum = post('credit_sum');
		$datetime = currentTime();
		$state = 'wait';

		$credit = M('merchant_credit');
		$record = array(
			'merchant' => $merchant, 'credit_sum' => $credit_sum,
			'datetime' => $datetime, 'state' => $state
		);

		$result['result_code'] = $credit->add($record);
		echo json_encode($result);
	}	
	
	public function creditGet()
	{
		$muid = post('muid');
		
		$merchant = D('merchant');
		$where['muid'] = $muid;
		$data_m = $merchant->where($where)->select();
		$credit_sum = $data_m[0]['auth_sum'];
		
		$turnover = M('merchant_turnover');
		$where_t['merchant'] = $phone;
		$data_t = $turnover->where($where_t)->select();
	
		
		$turnover_sum = $data_t[0]['sum'];

		$credit_remain = redAsDouble($credit_sum,$turnover_sum);
		
		$data['sum'] = $credit_sum;
		$data['remain'] = $credit_remain;

		echo json_encode($data);
		
	}
	
	public function deposit()
	{
		$muid = post('muid');
		$data['deposit'] = $this->depositGet($muid);
		echo json_encode($data);

	}
		

	public function vipGet()
	{
		$muid = post('muid');
		//$muid = 'm_12dd6779e1';
		$card = D('UserCard');
		$where['merchant'] = $muid;
		$data = $card
		->join('cn_user ON cn_user.uuid = cn_user_card.user')
		->where($where)
		->field('nickname as user,sex,phone,card_code,card_level,address,headImage,card_remain as remain,uuid')
		->group('user')
		->select();
	
		echo json_encode($data);
	}

	public function videoCommit()
        {
                $insert = array(
                        'merchant'=>post('muid'), 'video'=>post('video')
                );
                $video = D('merchant_video');
                $result['result_code'] = $video->add($insert);
                echo json_encode($result);

        }

	public function videoDel()
	{
		$where['merchant'] = post('muid');
		$video = D('merchant_video');
		$result['result_code'] = $video->where($where)->delete();
                echo json_encode($result);
	}

	public function videoGet()
        {
                $where['merchant'] = post('muid');
                $video = D('merchant_video');
		$result = $video->where($where)->select();
                echo json_encode($result);
        }

	public function cashPay()
	{
		$time = currentTime();
		$record_m = array(
			'merchant'=>post('merchant'),'name'=>post('name'),'sum'=>post('sum'),
			'datetime'=>$time,'orderNum'=>'CP'.strtotime($time)
		);
		$tally = M('record_tally');
		$result['result_code'] = $tally->add($record_m);
		echo json_encode($result);
	}
	
	public function cashGet()
	{
		$where['merchant'] = post('merchant');
		$tally = M('record_tally');
		$result = $tally->where($where)->select();
		echo json_encode($result);
	}

	public function authGet()
	{
		$merchant = D('merchant');
		$muid = post('muid');
		$where1['muid'] = $muid;
		$info = $merchant->where($where1)->select();
		$auth_sum = $info[0]['auth_sum'];
		
		$turnover = D('merchant_turnover');
		$where2['merchant'] = $muid;
		$info = $turnover->where($where2)->select();
		$turnover_sum = $info[0]['sum'];
		
		$remain['remain'] = redAsDouble($auth_sum,$turnover_sum)."元";
		echo json_encode($remain);

	}
	
	public function listGet()
	{
		$eare = post('eare');
		$index = post('index');
		$page_num = '5';
		
		//$eare = '雁塔区';
		//$index = '1';

		$where['address'] = array("like","%$eare%");
		$page = $index.",".$page_num;

		$data = showDataGet($where,$page);
		//dump($data);
		echo json_encode($data);
	}
	
	public function infoGet()
	{
		$muid = post('muid');
		//$muid = 'm_6d4e76ca11';
		$data = storeDataGet($muid);
		
		//dump($data);
		echo json_encode($data);
	}
	
	public function errorCode($code)
	{
		$data['result_code'] = $code;
                return json_encode($data);
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
			switch($result_m[0]['state'])
			{
				case 'null':
				{
					$result = $this->result('user_not_auth',$result_m,$result_a);
					break;
				}
				case 'false' :
				{
					$result = $this->result('user_auth_fail',$result_m,$result_a);
					break;
				}
				case 'incomplete' :
                                {
                                        $result = $this->result('incomplete',$result_m,$result_a);
                                        break;
                                }

				case 'true' :
				{
					$result = $this->result('login_access',$result_m,$result_a);
					break;
				}
				default :
				{
					$result = $this->errorCode('error');
					break;
				}
			}
			return $result;
		}
		
		else
		{
			return $this->errorCode('passwd_wrong');
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

	public function depositGet($muid)
	{
		$merchant = D('merchant');
                $where['muid'] = $muid;
                $data_m = $merchant->where($where)->select();
                $credit_sum = $data_m[0]['auth_sum'];

                $turnover = M('merchant_turnover');
                $where_t['merchant'] = $muid;
                $data_t = $turnover->where($where_t)->select();
                $turnover_sum = $data_t[0]['sum'];
	
		switch($credit_sum)
                {
                        case '10000元':
                        {
                                $deposit = '0.00元';
                                break;
                        }

                        case '50000元':
                        {
                                $deposit = redAsDouble($turnover_sum,'10000') * 0.1;
                                $deposit = sprintf('%.2f',$deposit);
                                break;
                        }

                        case '200000元':
                        {
                                $deposit = redAsDouble($turnover_sum,'50000') * 0.2 + 4000;
                                $deposit = sprintf('%.2f',$deposit);
                                break;
                        }

                        case '500000元':
                        {
                                $deposit = redAsDouble($turnover_sum,'200000') * 0.3 + 34000;
                                $deposit = sprintf('%.2f',$deposit);
                                break;
                        }

                        default:
                                break;

                }
		
		return $deposit;

	}
}
