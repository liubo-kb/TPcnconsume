<?php
namespace App\Controller\Extra;
use Think\Controller;
class GameController extends Controller 
{
	
	function get_rand($proArr)
	{   
		$result = '';    
		//概率数组的总概率精度   
		$proSum = array_sum($proArr);  
		//概率数组循环   
		foreach ($proArr as $key => $proCur)
		{   
			$randNum = mt_rand(1, $proSum);  
			if ($randNum <= $proCur) 
			{   
				$result = $key;   
				break;   
			} 
			else 
			{   
				$proSum -= $proCur;   
			}         
		}   
		unset ($proArr);    
		return $result;   	
	}   
	
	//获取抽奖结果,并记录
	function getResult()
	{
		$uuid = post("uuid");
		$table = D("game_award");
		$prize_arr = $table->select();
		foreach ($prize_arr as $key => $val)
		{   
			$arr[$val['id']] = $val['prob'];   
		}
		$id = $this->get_rand($arr); //根据概率获取奖项id   
		while( !$this->checkResult( $id ) )
		{
		
			$id = $this->get_rand($arr); //根据概率获取奖项id  
		}
		$where['id'] = $id;
		$res['result'] = $table->where($where)->select()[0];
		
		$record = array("uuid" => $uuid, "award_id" => $id, "datetime" => currentTime());
		$table = D("game_winner");
		addWithCheck($table,$record);
		
		echo json_encode($res);
	}

	//根据参与人数核验结果合法性
	function checkResult( $id )
	{
		$attendNum = D("game_winner")->count();
		$flag = false;
		//参与人数小于100，只能抽中1，2
		if($attendNum < 100)
		{
			if( $id == '0001' || $id == '0002')
			{
				$flag = true;
			}
		}
		//参与人数大于100小于500，只能抽中1，2，3
		else if($attendNum >= 100 && $attendNum < 500)
		{
			if( $id == '0001' || $id == '0002' || $id == '0004')
			{
				$flag = true;
			}
		}
		//参与人数大于500小于1000，只能抽中1，2，3，4
		else if($attendNum >= 500 && $attendNum < 1000)
		{
			if( $id != '0005' && $id != '0006' )
			{
				$flag = true;
			}
		}
		//参与人数大于1000小于1500，只能抽中1，2，3，4，5
		else if($attendNum >= 1000 && $attendNum < 1500)
		{
			if( $id != '0006' )
			{
				$flag = true;
			}
		}
		//参与人数大于100，都可抽中
		else
		{
			$flag = true;
		}
		return $flag;
	}
	
	//获取中奖名单
	function getWinnerList()
	{
		$table = D("game_winner");
		$result = $table
		->join("cn_game_award on cn_game_award.id = cn_game_winner.award_id")
		->field("cn_game_award.*,cn_game_winner.datetime,cn_game_winner.uuid")
		->select();
		echo json_encode($result);
	}
	
	//获取奖品清单
	function getAwardList()
	{
		$table = D("game_award");
		$result = $table->select();
		echo json_encode($result);
	}
	
	
	
	//开始游戏
	public function start()
	{
		$uuid = post('uuid');
		//获取答题记录
		$table = D('game_record');
		$where['uuid'] = $uuid;
		$check = $table->where($where)->count();
		if( $check <= 0 )
		{
			//生成答题记录
			$list = range(1,60);
			shuffle($list);
			$record = array(
				"uuid" => $uuid, "list" => json_encode($list),
				"current_num" => 0, "current_integral" => 0,"datetime" => currentTime()
			);
			addWithCheck($table,$record);
			$result['list'] = $list;
			$result['current_time'] = 0;
		}
		else
		{
			$result = $table->field("list,current_num")->where($where)->select()[0];
		}
		
		$que_num = $result['current_num']; //当前题目序号
		$answer_id = json_decode($result["list"])[$que_num];	//当前题目id
		$info = $this->getQueInfo($answer_id,$que_num);
		$info['current_num'] = $que_num;
		$info['current_integral'] = $this->get_integral($uuid);
		echo json_encode($info);
	}
	
	//获取每道题目
	public function getQue()
	{
		$uuid = post("uuid");
		$result = $this->getCntQue($uuid);
		$que_num = $result['current_num']; //当前题目序号
		$answer_id = json_decode($result["list"])[$que_num];	//当前题目id
		$info = $this->getQueInfo($answer_id,$que_num);
		$info['current_num'] = $que_num;
		$info['current_integral'] = $this->get_integral($uuid);
		echo json_encode($info);
	}
	
	//答对题目后
	function accessCommit()
	{
		$uuid = post("uuid");
		$result = $this->getCntQue($uuid);
		$use_tool = post("use_tool");
		$que_num = $result['current_num']; //当前题目序号
	
		//题目序号加一
		$table = D("game_record");
		$where['uuid'] = $uuid;
		$set['current_num'] = $que_num + 1;
		setWithCheck($table,$where,$set);
		
		//获取当前升级的级别
		$data = $this->getUpgLevel($que_num+1);
		if($data != null)
		{
			$data['state'] = "yes";
		}
		else
		{
			$data['state'] = 'no';
		}
		
		$data['current_time'] = $que_num+1; //当前题目序号
		if($use_tool == 'yes')
		{
			$operate = 'red';
		}
		else
		{
			$operate = 'add';
		}
		$this->handle_integral($uuid,"4",$operate);
		echo json_encode($data);
	}
	
	//使用提示
	function use_tip($uuid)
	{
		$result['result_code'] = $this->handle_integral($uuid,"2","red");
		$result['current_integral'] = $this->get_integral($uuid);
		echo json_encode($result);
	}
	
	//获取题目信息
	function getQueInfo($answer_id,$que_num)
	{
		//获取题目答案
		$table = D('game_question_bank');
		$where_qb['id'] = $answer_id;
		$result = $table->where($where_qb)->select()[0];
		
		$answer_str = $result['answer'];
		$answer = explode(" ",$answer_str);
		$answer_length = count($answer); //答案字数
		$option_length = 24 - $answer_length; //随机字数
	
		
		//生成题目选项
		$set = range(1,3500);
		shuffle($set);
		$ids = array_slice($set,0,$option_length);
		
		$table = D('game_chinese');
		$where['id'] = array('in',$ids);
		$data = $table->field('content')->where($where)->select();
		
		for($i=$option_length,$j=0;$i<24;$i++)
		{
			$data[$i]['content'] = $answer[$j++];
		}
		
		for($i=0; $i<count($data);$i++)
		{
			$options[$i] = $data[$i]['content'];
		}
		
		//打乱题目选项
		shuffle($options);
		$info['answer'] = strtr($result['answer'],array(' '=>''));
		$info['answer_length'] = $answer_length;
		$info['answer_image'] = $result['image'];
		$info['answer_type'] = $result['type'];
		$info['options'] = $options;
	
		$info['cnt_level'] = $this->getCntLevel($que_num);
		return $info;
	}
	
	//获取当前的题目
	function getCntQue( $uuid )
	{
		$where['uuid'] = $uuid;
		$table = D("game_record");
		$cnt_que = $table->where($where)->field("list,current_num")->select()[0];
		return $cnt_que;
	}
	
	//获取当前级别
	function getCntLevel($que_num)
	{
		if($que_num <= 10)
		{
			$where['id'] = '001';
		}
		else if($que_num > 10 && $que_num <= 20)
		{
			$where['id'] = '002';
		}
		else if($que_num > 20 && $que_num <= 30)
		{
			$where['id'] = '003';
		}
		else if($que_num > 30 && $que_num <= 40)
		{
			$where['id'] = '004';
		}
		else if($que_num > 40)
		{
			$where['id'] = '005';
		}
		else
		{
			$where['id'] = '001';
		}
		$table = D('game_level');
		$data = $table
		->field("cnt_img,cnt_txt")
		->where($where)
		->select()[0];
		return $data;
	}
	
	//获取升级级别
	function getUpgLevel($que_num)
	{
		switch($que_num)
		{
			case 10:
				$where['id'] = '002';break;
			case 20:
				$where['id'] = '003';break;
			case 30:
				$where['id'] = '004';break;
			case 40:
				$where['id'] = '005';break;
			default:
				$where['id'] = '000';break;
		}
		$table = D('game_level');
		$data = $table
		->field("upg_img,upg_txt")
		->where($where)
		->select()[0];
		return $data;
	}

	
	//用户注册
	function register()
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
			
		if($referrer != 'null')
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
		
		$result['result_code']= $data;
		$result['uuid'] = $uuid;
		echo json_encode($result);
	}
	
	//用户登录
	function login()
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
	
	
	//重置密码
	function resetPasswd()
	{
		$phone = post('phone');
		$new_passwd = post('new_passwd');
		$table = D('user');
		$where['phone'] = $phone;
		$passwd = $table->where($where)->select()[0]['passwd'];
		if($passwd == $new_passwd)
		{
			$result['result_code'] = '-1';
		}
		else
		{
			$set['passwd'] = $new_passwd;
			$result['result_code'] = saveWithCheck($table,$where,$set); 
		}
		echo json_encode($result);
	}
	
	//记录点击数
	function click()
	{
		$client_ip = $this->get_client_ip();
		$datetime = currentTime();
		$record = array(
						"client_ip" => $client_ip,"datetime" => $datetime,
		);
		$table = D('game_click');
		$result['result_code'] = addWithCheck($table,$record);
		echo json_encode($result);
	}
	
	//记录分享数
	function share()
	{
		$client_ip = $this->get_client_ip();
		$datetime = currentTime();
		$uuid = post('uuid');
		$record = array(
						"client_ip" => $client_ip,"datetime" => $datetime,"uuid" => $uuid,
		);
		$table = D('game_share');
		$result['result_code'] = addWithCheck($table,$record);
		echo json_encode($result);
	}
	
	//处理积分
	function handle_integral( $uuid, $sum, $operate)
	{
		$table = D('game_record');
		$integral = $this->get_integral($uuid);
		if($operate == 'add')
		{
			$set['current_integral'] = addAsInt($integral,$sum);
		}
		else
		{
			$set['current_integral'] = redAsInt($integral,$sum);
		}
		$where['uuid'] = $uuid;
		return saveWithCheck($table,$where,$set);
		
	}
	
	//获取积分
	function get_integral( $uuid )
	{
		$table = D('game_record');
		$where['uuid'] = $uuid;
		$integral = $table->where($where)->select()[0]['current_integral'];
		return $integral;
	}
	
	
	//重置题目
	function resetQue()
	{
		$uuid = post('uuid');
		$table = D('game_record');
		$where['uuid'] = $uuid;
		//生成新答题记录
		$list = range(1,60);
		shuffle($list);
		$set['list'] = json_encode($list);
		$set['current_num'] = 0;
		$set['current_integral'] = 0;
		$result['result_code'] = saveWithCheck($table,$where,$set);
		$result['uuid'] = $uuid;
		echo json_encode($result);
		
	}
	
	
	/**
     * 获取访问者IP
     *
     */
    public function get_client_ip()
	{
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
		{
            $CLIENT_IP = getenv('HTTP_CLIENT_IP');
        } 
		elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) 
		{
            $CLIENT_IP = getenv('HTTP_X_FORWARDED_FOR');
        } 
		elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
		{
            $CLIENT_IP = getenv('REMOTE_ADDR');
        } 
		elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) 
		{
            $CLIENT_IP = $_SERVER['REMOTE_ADDR'];
        }
        return $CLIENT_IP;
    }
}
