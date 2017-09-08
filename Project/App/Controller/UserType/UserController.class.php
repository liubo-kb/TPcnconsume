<?php

/*
*       用户控制器:
*               login()： 用户登陆操作
*               register()：用户注册操作
*               complete()：用户完善信息操作
*               accountSet()：账户信息设置操作
*               accountGet()：账户信息获取操作
*               recharge()：钱包余额充值操作
*               voucherGet()：获取代金卷操作
*               voucherMod()：修改代金卷操作
*		cnCmt()：写入消费记录操作
*		cnGet()：获取消费记录操作
*		cnDel()：删除消费记录操作
*		withdraw()：申请提现操作
*		cardGet()：获取可用来支付的会员卡操作
*               
*/


namespace App\Controller\UserType;
use Think\Controller;
use App\Model\UserModel;
class UserController extends Controller 
{

	public function test()
	{
		$datetime = '2016-12-01 00:00:00';
		$sum = getSystemPara($datetime,'reward_referrer')['user'];
		$uuid = 'u_28105ef407';
		$type = 'u';
		//setRedPacket($uuid,$sum); 
		//setReferrerSum($uuid,$type,$sum);
		//echo "<br/>1";
		checkUserLevel($uuid);
	}
	
	public function sxlCouponMod()
	{
		$uuid = post('uuid');
		$id = post('content');


		$where['uuid'] = $uuid;
		$where['id'] = $id;
		$table = D('sxl_user_coupon');
		$table->where($where)->delete();
	}

	public function getSxlCoupon()
	{
		$uuid = post('uuid');
		$muid = post('muid');
		if( $muid != 'null' )
		{
			$table = D('merchant');
			$where_m['muid'] = $muid;
			$trade = $table->where($where)->select()[0]['trade'];
			$where['cn_sxl_coupon.coupon_type'] = array('in',$trade.',通用');
		}
		$where['uuid'] = $uuid;
		$where['cn_sxl_coupon.date_end'] = array('egt',currentDate());
		$table = D('sxl_user_coupon');
		$data = $table
		->where($where)
		->join('cn_sxl_coupon on cn_sxl_coupon.coupon_id = cn_sxl_user_coupon.coupon_id')
		->select();
		echo json_encode($data);
	}

	public function getBill()
	{
		$where['uuid'] = post("uuid");
		$result = D("record_package_income")
		->order("datetime desc")
		->where($where)
		->select();
		echo json_encode($result);
	}

	public function getRedPacket()
	{
		$uuid = post("uuid");
		$page = post('page').",10";
		
		$table = D("red_packet");
		$where["user"] = $uuid;
		$data['sum'] = $table->where($where)->select()['0']['sum'];
		
		$table = D("record_income");
		$where_r['id'] = $uuid;
		$data['record'] = $table
		->where($where_r)
		 ->order("datetime desc")
		->field("datetime,tip,sum,type")
		->page($page)
		->select();

		echo json_encode($data);
		
	}


	public function withdrawRedPacket()
	{
		$uuid = post("uuid");
		$sum = post("sum");

		$where['user'] = $uuid;		
		$table = D('red_packet');
		$remain = $table->where($where)->select()[0]['sum'];
		$remain = redAsDouble($remain,$sum);
		$set['sum'] = $remain;
		$table->where($where)->save($set);

		$where_u['uuid'] = $uuid;
                $table = D('user');
                $remain = $table->where($where_u)->select()[0]['remain'];
                $remain = addAsDouble($remain,$sum);
                $set_u['remain'] = $remain;
                $table->where($where_u)->save($set_u);

		$record = array( 'id' => $uuid, 'sum' => '-'.$sum, 'datetime' => currentTime(), 'tip' => '红包提现','type' => 'withdraw',);
		$table = D('record_income');
		$table->add($record);

		$record = array(
			'uuid' => $uuid, 'tip' => '红包提现', 'sum' => $sum,
			'datetime' => currentTime(),
		);
		$table = D('record_package_income');
		$table->add($record);
		
		$result['result_code'] = '1';

		echo json_encode($result);



	}

	//使用代金券
	public function couponMod()
	{
		$where['uuid'] = post('uuid');
		$where['coupon_id'] = post('content');
		$table = D('user_coupon');
		$set['state'] = 'used';
		setWithCheck($table,$where,$set);
	}


	//使用红包
	public function redPacketMod()
	{
		$uuid = post('uuid');
		$where['user'] = $uuid;
                $sum = post('content');
		$red_packet = $sum;
                $table = D('red_packet');
		$remain = $table->where($where)->select()[0]['sum'];
		$sum = redAsInt($remain,$sum);
		$set['sum'] = $sum;
		$table->where($where)->save($set);
	
		//logIn($table->getLastSql());
	
		$record = array(
			'id' => $uuid, 'datetime' => currentTime(),tip => post('type'),
			'type' => 'consume', sum => "-".$red_packet
		);
		
		setIncomeRecord($record);
	}
	
	public function login()
	{
		$user = D('User');
		$phone = post('phone');
                $passwd = post('passwd');
		
		$where['phone'] = $phone;
		$count = $user->where($where)->count();
		if($count <=0 )
		{
			$result['result_code'] = 'user_not_found';
		}
		else
		{
			$data = $user->where($where)->select();
			$data[0]['state'] = $data[0]['auth_state'];
			if($data[0]['passwd'] == $passwd)
			{
				 /*if($data[0]['state'] == 'not_auth')
				 {
					$result['result_code'] = 'incomplete';	
					$result['info'] = $data;
   				 }
				 else
				 {
					$result['result_code'] = 'login_access';
                                        $result['info'] = $data;
				 }*/
				
				 $result['result_code'] = 'login_access';
                                 $result['info'] = $data;

			}			
			else
			{
				 $result['result_code'] = 'passwd_wrong';
			}
		}

		echo json_encode($result);
	
	}

	public function register_test()
	{
		$result['result_code']= '1';
                $this->ajaxReturn($result);
		echo "2";	
	}
	
	public function register()
	{
		$user = D('User');
		$uuid = get_uuid('u_');
		$phone = post('phone');
		$passwd = post('passwd');
		$referrer = post('referrer');
		$datetime = currentTime();

		
		$where_ex['phone'] = $phone;
		$check_ex = $user->where($where_ex)->count();

		if($check_ex > 0)
		{
			$result['result_code']= 'phone_duplicate';
			echo json_encode($result);
			return;
		}
	
		
		if($referrer != '无人推荐')
		{
			$where_ex['phone'] = $referrer;
			$check_ex = $user->where($where_ex)->count();

			if($check_ex <= 0)
			{
					$result['result_code']= 'referrer_not_exist';
					echo json_encode($result);
					return;
			}

			//写入推荐关系信息
			$data = $user->where($where_ex)->select();
			$referrer_uuid = $data[0]['uuid'];
			$record_r = array(
					'referrer' => $referrer_uuid,
					'recommend'=>$uuid,
					'type'=>'u',
					'sum'=>'0',
					'state'=>'ONLINE'
			);
			$ref = M('referrer');
			$ref->add($record_r);

			//检测用户当前级别
            		//checkUserLevel($referrer_uuid);

			//处理推荐红包
			$sum = getSystemPara($datetime,'reward_referrer')['user']; //获取系统推荐政策
			setRedPacket($referrer_uuid,$sum);
			
			//更新推荐收入
			setReferrerSum($referrer_uuid,'u',$sum);
			
			//设置推荐收入记录
			$record = array('datetime'=>$datetime,'tip' => '推荐用户奖励', 'sum' => $sum,'type' => 'u', 'id' => $referrer_uuid);
			setIncomeRecord($record);
		
			//处理推荐送积分
			addIntegral($referrer_uuid,'推荐用户','ref_user');	
        }
		else
		{
			$referrer_uuid = '无人推荐';
		}

		
		//写入注册信息
		$record_u = array(
			'uuid'=>$uuid,'phone' => $phone, 'auth_state' => 'not_auth', 'nickname' => $phone, 'passwd' => $passwd,'remain' => '0.00', 
			'referrer' => $referrer_uuid,'datetime' => $datetime,'user_level' => 'ORD','address' => '未设置','mail' => '未设置',
			'sex' => '未设置','age' => '未设置','occupation' => '未设置','education' => '未设置','mate' => '未设置','hobby' => '未设置',
			'pay_passwd' => '未设置'
		);

		$data = $user->addWithCheck($record_u);
		while($data == '1062')
		{
			$uuid = get_uuid('u_');
			$record_u = array(
				'uuid'=>$uuid,'phone' => $phone, 'auth_state' => 'not_auth', 'nickname' => $phone, 'passwd' => $passwd,'remain' => '0.00', 
				'referrer' => $referrer_uuid,'datetime' => $datetime,'user_level' => 'ORD','address' => '未设置','mail' => '未设置',
				'sex' => '未设置','age' => '未设置','occupation' => '未设置','education' => '未设置','mate' => '未设置','hobby' => '未设置',
				'pay_passwd' => '未设置'
			);
			$data = $user->addWithCheck($record_u);
		}
		

		//添加环信账号	
		$im = new \Org\IM\ImConnect();
        	$im->createUser($uuid,'000000');

		//注册送红包		
        	$sum = getSystemPara($datetime,'reward_referrer')['user']; //获取系统推荐政策
		$sum = '10';
        	setRedPacket($uuid,$sum);
		
		//设置注册奖励记录
		$record = array('datetime'=>$datetime,'tip' => '注册奖励', 'sum' => $sum,'type' => 'u', 'id' => $uuid);
		setIncomeRecord($record);

		//送平台优惠卷
		addSxlCoupon($uuid);

		//记录IM账号
		 $imAccount = D('im_account');
                $record = array( 'account' => $uuid, 'passwd' => '000000', 'phone' => $phone, 'name' => $nickname, 'headImage' => $phone);
                $imAccount->add($record);
	
		
		$result['result_code']= $data;
		echo json_encode($result);


	}

	
	public function complete()
	{
		$phone = post('phone');
		$nickname = post('nickname');
		
		$user = D('user');
                $where['phone'] = $phone;
		$info = $user->where($where)->select();
		$uuid = $info[0]['uuid'];
	
		$set = array(
			'nickname' => $nickname, 'address' => post('address'), 'mail' => '未设置',
			'sex' => '未设置', 'age' => '未设置', 'remain' => '0.00元', 'protocol' => 'agree',
			'headImage' => '未设置', 'name' => post('name'), 'id' => post('id'), 'integral' => '0',
			'occupation' => '未设置','education' => '未设置','mate' => '未设置','hobby' => '未设置',
			'pay_passwd' => post('pay_passwd'),
		);

		$user = D('user');
		$where['phone'] = $phone;
		$result['result_code'] = $user->where($where)->save($set);

		$imAccount = D('im_account');
		$record = array( 'account' => $uuid, 'passwd' => '000000', 'phone' => $phone, 'name' => $nickname, 'headImage' => '未设置');
		$imAccount->add($record);
		
		echo json_encode($result);
	}

	public function accountSet()
	{
		$uuid = post('uuid');
		$type = post('type');

		$user = D('user');
		$where['uuid'] = $uuid;
		
		$im_account = D('im_account');
		$where_im['account'] = $uuid;	


		if($type == 'passwd')
		{
			$passwd_old = post('pwd_old');
            $passwd_new = post('pwd_new');
			//$passwd_old = '111111';
			//$passwd_new = '111';			

			$check = $user->where($where)->select();
			if($passwd_old == $check[0]['passwd'])
			{
				$set['passwd'] = $passwd_new;
				$result['result_code'] = $user
				->where($where)
				->save($set);
				$result['type'] = $type;
				$result['para'] = $passwd_new;
				echo json_encode($result);
					
			}
			else
			{
				$result['result_code'] = 'old_passwd_wrong';
				echo json_encode($result);
			 
			}

		}

		else if($type == 'integral')
		{
			$sum = post('sum');
			$user = D('user');
			$data = $user->where($where)->select();
			$remain = $data[0]['integral'];

			$newRemain = addAsDouble($remain,$sum);

			$set['integral'] = $newRemain;

			$result['result_code'] = $user->where($where)->save($set);			
			echo json_encode($result);
			
		}		

		else
		{
			//处理送积分
			$result['award'] = handleAward($uuid,$type);
			if($type == 'nickname' || $type == 'headImage')
			{
				setImAccount($uuid,$type,$para);
			}

			$para = post('para');
			$set[$type] = $para;	
	
			$result['result_code'] = setWithCheck($user,$where,$set);
			$im_account->where($where_im)->save($set);

			$result['type'] = $type;
			$result['para'] = $para;
			echo json_encode($result);
		
		}
	}

	public function accountGet()
	{
		$uuid = post('uuid');
		$type = post('type');

		$user = D('user');
		$where['uuid'] = $uuid;
		
		$data = $user->where($where)->select();
		$result[$type] = $data[0][$type];
		echo json_encode($result);
	}

	
	public function recharge()
	{
		$uuid = post('uuid');
		$sum = post('sum');
		$datetime = currentTime();
		$nickname = post('nickname');
		
		$where['uuid'] = $uuid;		

		$user = D('user');
		$data = $user->where($where)->select();
		$remain = $data[0]['remain'];
		
		$newRemain = addAsDouble($remain,$sum)."元";
		
		$set['remain'] = $newRemain;

		$result['result_code'] = $user->where($where)->save($set);
		
		$list = M('record_recharge');
		$record = array(
			'user' => $uuid,'nickname' => $nickname,
			'sum' => $sum,'date' => $datetime
		);
		$list->add($record);

		echo json_encode($result);
			
	}

	function voucherGet()
	{
		$uuid = post('uuid');
		$where['user'] = $uuid;
		$voucher = M('user_voucher');
		$data = $voucher
			->where($where)
			->field('type,deadline,num')
			->select();
		echo json_encode($data);
	}
	
	function voucherMod()
	{
		$user = post('uuid');
		$type = post('sum');
		

		$voucher = M('user_voucher');
		$where['user'] = $user;
		$where['type'] = $type;
		
		$data = $voucher->where($where)->select();
		$num = $data[0]['num'];
		
		$newNum = redAsInt($num,'1');
		if( intval($num) > 1)
		{
			$set['num'] = $newNum;
			$result['result_code'] = $voucher->where($where)->save($set);
		}
		else
		{
			$result['result_code'] = $voucher->where($where)->delete();
		}
		
		echo json_encode($result);		
	
	}

	public function integralMod()
	{
		$user = D('user');
		$uuid = post('uuid');
		$sum = post('sum');
		$where['uuid'] = $uuid;
		$info = $user->where($where)->select();
		$integral_re = $info[0]['integral'];
		
		$integral_new = redAsInt($integral_re,$sum);
		$set['integral'] = $integral_new;
		$user->where($where)->save($set);
	}

	public function cnCmt()
	{
		$user = post('uuid');
		$content = post('content');
		$datetime = currentTime();
		$sum = post('sum');

		
		$merchant = explode('■■',$content)[0];
		$where['muid'] = $merchant;
		$info = D('merchant');
		$data = $info->where($where)->select();
		$store = $data[0]['store'];		

		$consum = explode('■■',$content)[1];
		$content = $store.'■■'.$consum;

		$record = array(
				'user' => $user,'content' => $content, 'datetime' => $datetime,
				'merchant' => $merchant,'sum' => $sum,'state' => 'true'
				);

		$cnList = M('record_consum');
		$result['result_code'] = $cnList->add($record);
		echo json_encode($result);
	}

	public function cnGet()
	{
		$user = post('uuid');
		//$user = "u_28105ef406";
		$where['user'] = $user;
		$where['state'] = array('in',array('true','false'));
		$cnList = M('record_consum');
        	$result = $cnList
		->order("datetime desc")
		->where($where)
		->select();
        	echo json_encode($result);

	}

	public function cnDel()
	{
		$user = post('uuid');
		$datetime = post('datetime');
        $where['user'] = $user;
		$where['datetime'] = $datetime;
		$set['state'] = 'del';
		$cnList = M('record_consum');
		$result['result_code'] = $cnList->where($where)->save($set);
        echo json_encode($result);

	}

	public function withdraw()
    {
        $uuid = post('uuid');
		$nickname = post('nickname');
        $sum = post('sum');

		$name = post('name');
		$bank = post('bank');
		$account = post('account');
		$datetime = currentTime();

		
		$record_w = array(
				'user'=>$uuid, 'nickname'=>$nickname, 'sum'=>$sum,'state' => 'wait',
				'name'=>$name, 'bank'=>$bank,'account'=>$account,'datetime'=>$datetime,
		);


		$withdraw = M('user_withdraw');
		$result['result_code'] = $withdraw->add($record_w);


		$record = array(
			'uuid'=>$uuid, 'tip'=>'提现','sum'=>"-".$sum,'datetime'=>$datetime,
		);
		$table = D('record_package_income');
		addWithCheck($table,$record);

		$table = D('user');
		$where['uuid'] = $uuid;
		$remain = $table->where($where)->select()[0]['remain'];
		$newRemain = redAsDouble($remain,$sum);
		$set['remain'] = $newRemain;
		setWithCheck($table,$where,$set);

        echo json_encode($result);

    }


	public function cardGet()
	{
		$user = post('uuid');
		$merchant = post('muid');
		$type = post('type');
	
		/*$user = 'u_4a48e91e08';
                $merchant = 'm_6d4e76ca11';
                $type = '储值卡';
		*/	
		$card = D('UserCard');
		$where['card_type'] = $type;
		$where['cn_user_card.merchant'] = $merchant;
		$where['user'] = $user;

		$u = 'cn_user_card.';
		$m = 'cn_merchant_card.';
		$join = "cn_merchant_card ON $m merchant = $u merchant and $m code = $u card_code and $m level = $u card_level and $m type = $u card_type";

		$data = $card->where($where)->join($join)->field('cn_user_card.*,price,rule')->select();
		//dump($data);
		echo json_encode($data);
	}
}
