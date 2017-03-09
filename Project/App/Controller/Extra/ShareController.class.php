<?php
namespace App\Controller\Extra;
use Think\Controller;
class ShareController extends Controller 
{
	public function share()
	{
		$referrer = get('phone');
		$table = D('user');
		$where['phone']	 = $referrer;
		$info = $table->where($where)->select()[0];
			
		$this->assign("headImage",$info['headimage']);
		$this->assign("phone",$info['phone']);
		$this->assign("nickname",$info['nickname']);
		$this->display("Share/share");
	}

	public function download()
	{
		$this->display("Share/download");
	}
	
	public function registerView()
	{
		$referrer = get('referrer');
		$this->assign("referrer",$referrer);
		$this->display("Share/register");
	}

	public function register()
	{
		$phone = get('phone');
		$passwd = get('passwd');
		$type = get('type');
		$referrer = get('referrer');
		if( $type == 'user' )
		{
			$result = $this->user($phone,$passwd,$referrer);
		}
		else
		{
                        $result = $this->merchant($phone,$passwd,$referrer);
		}
			
		switch( $result )
		{
			case 'phone_duplicate' :
			{

				echo "<script>history.go(-1);alert('手机号已经注册过，请直接登录')</script>";	
				break;
			}

			case 'referrer_not_exist' :
			{
				echo "<script>history.go(-1);alert('推荐人账号，不存在！')</script>";
				break;
			}
			
			case 'access' :
                        {
                                $this->display("Share/download");
                                break;
                        }
			
			default:
				break;

		}

	}

	public function merchant($phone,$passwd,$referrer)
	{
		$muid = get_uuid('m_');
		
		$datetime = currentTime();
		
		$merchant = D('merchant');
		$where_ex['phone'] = $phone;
                $check_ex = $merchant->where($where_ex)->count();
		if($check_ex > 0)
		{
			return 'phone_duplicate';
		}
		if($referrer != '无人推荐')
                {
			$user = D('user');
                        $where_ex['phone'] = $referrer;
                        $check_ex = $user->where($where_ex)->count();

                        if($check_ex <= 0)
                        {
                                return 'referrer_not_exist';
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

		return "access";
		
	}


	public function user($phone,$passwd,$referrer)
	{
		$user = D('User');
		$uuid = get_uuid('u_');
		$datetime = currentTime();

		
                $where_ex['phone'] = $phone;
                $check_ex = $user->where($where_ex)->count();

		if($check_ex > 0)
                {
                        return 'phone_duplicate';
                }
	
		
		if($referrer != '无人推荐')
                {
			$where_ex['phone'] = $referrer;
                	$check_ex = $user->where($where_ex)->count();

                	if($check_ex <= 0)
                	{
                        	return 'referrer_not_exist';
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
                        checkUserLevel($referrer_uuid);

			//处理推荐红包
			$sum = getSystemPara($datetime,'reward_referrer')['user']; //获取系统推荐政策
			setRedPacket($referrer_uuid,$sum);
			
			//更新推荐收入
			setReferrerSum($referrer_uuid,'u',$sum);
			
			//设置推荐收入记录
			$record = array('datetime'=>$datetime,'tip' => '推荐用户奖励', 'sum' => $sum,'type' => 'u', 'id' => $referrer_uuid);
			setIncomeRecord($record);
			
                }
		else
		{
			$referrer_uuid = '无人推荐';
		}

		
		//写入注册信息
		$record_u = array(
			'uuid'=>$uuid,'phone' => $phone, 'nickname' => $phone, 'passwd' => $passwd, 'referrer' => $referrer_uuid,'datetime' => $datetime,'user_level' => 'ORD'
		);

		$data = $user->addWithCheck($record_u);
		while($data == '1062')
		{
			 $uuid = get_uuid('u_');
                         $record_u = array(
                         	'muid'=>$muid, 'phone'=>$phone,  'nickname' => $phone, 'passwd'=>$passwd,  'referrer'=>$referrer_uuid,'datetime'=>$datetime);
                         $data = $user->addWithCheck($record_u);
		}
		

		//添加环信账号	
		$im = new \Org\IM\ImConnect();
                $im->createUser($uuid,'000000');

		//注册送红包		
                $sum = getSystemPara($datetime,'reward_referrer')['user']; //获取系统推荐政策
                setRedPacket($uuid,$sum);
		
		//设置注册奖励记录
                $record = array('datetime'=>$datetime,'tip' => '注册奖励', 'sum' => $sum,'type' => 'u', 'id' => $uuid);
                setIncomeRecord($record);

		return "access";
	}
	
}
