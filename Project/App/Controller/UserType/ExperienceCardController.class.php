<?php
/*       用户会员卡控制器:
              initialize()： 初始化操作
              get()：获取会员卡操作
              buy()：购买会员卡操作
              renew()：会员卡续卡操作
              upgrade()：会员卡升级操作
              pay()：会员卡支付操作
	      stateGet()：获取会员卡状态(是否拥有)操作
	      detailGet()：获取会员卡信息(IOS刷新)操作               
*/
namespace App\Controller\UserType;
use Think\Controller;
class ExperienceCardController extends Controller 
{
	private $muid;				//	1,商户注册id
	private $code;				//	2,体验卡编号
	private $uuid;				//	3,用户注册id
	private $price;				//	4,体验卡价格
	private $des;				//	5,体验卡描述
	private $indate;			//	6,体验卡有效期
	private $template;			//	7,体验卡板式
	
	private $pay_sum;			//	8,商户收益
	
	//初始化post参数
	function _initialize()
	{
		$this->muid = post('muid');
		$this->code = post('code');
		$this->uuid = post('uuid');
		$this->pay_sum = post('pay_sum');
		
		/*$this->muid = 'm_d7c116a9cc';
		$this->code = 'meal_9783b2aaa2';
		$this->uuid = 'u_uuid0148';*/
		
	}
	
	//初始化体验卡其它参数
	function initExtra()
	{
		$table = D('merchant_card_experience');
		$where['muid'] = $this->muid;
		$where['code'] = $this->code;
		$info = $table->where($where)->select()[0];
		
		$this->price = $info['price'];
		$this->des = $info['des'];
		$this->indate = $info['indate'];
		$this->template = $info['template'];
	}
	
	
	//购买会员卡
	public function buy()
	{	
		//初始化体验卡其它参数
		$this->initExtra();
	
		//计算有效期日期
		if( $this->indate == 0 )
		{
			$indate = "no";
			$date_start = currentTime();
			$operate = '+ '.($indate*100).' month';
            $date_end = getTime($date_start,$operate);
		}
		else
		{
			
			$date_start = currentTime();
			$operate = '+ '.($indate*12).' month';
			$indate = "yes";
			$date_end = getTime($date_start,$operate);
		}

		//用户添加体验卡
		$record	= array(
			'user' => $this->uuid,'merchant' => $this->muid,'card_code' => $this->code,
			'card_level' => '体验卡','card_type'=>'体验卡','card_remain' => $this->price,
			'card_temp_color' => $this->template,'evaluate' => 'false','indate' => $indate, 'date_start' => $date_start,'date_end' => $date_end,'state' => 'null'
		);
		
		$table = D('UserCard');
		addWithCheck($table,$record);
		
	
	
		//添加购买记录
		$record_buy = array(
				'user' => $this->uuid,'merchant' => $this->muid,'card_code' => $this->code,
				'card_level' => '体验卡','card_type'=>'体验卡','sum' => $this->pay_sum,
				'card_temp_color' => $this->template,'datetime' => currentTime()
		);
		$table = M('record_buy');
		addWithCheck($table,$record_buy);

		//更新产生的推荐收入
		setReferrerSum($this->muid,"m",$this->pay_sum);
		
		//更新商户的营业额
		setTurnover($this->muid,$this->pay_sum);

		//产生积分处理
		addIntegral($this->uuid,'办卡消费','consum',$this->pay_sum);

	}

	
	//体验卡支付	
	public function pay()
	{
		//获取体验卡信息
		$table = D('merchant_card_experience');
		$where['muid'] = $this->muid;
		$where['code'] = $this->code;
		$info = $table->where($where)->select()[0];
		
		//清除体验卡余额
		$table = D('UserCard');
		$where_u['user'] = $this->uuid;
		$where_u['merchant'] = $this->muid;
		$where_u['card_code'] = $this->code;
		$where_u['card_type'] = "体验卡";
		
		$table->where($where_u)->delete();
		
		//获取店铺名称
		$table = D('merchant');
		$where['muid'] = $this->muid;
		$store = $table->where($where)->select()[0]['store'];
	
		//添加消费记录
		$content = $store.'■■结算金额♥♥'.$info['price'];
		$record = array(
				'user' => $this->uuid,'content' => $content, 'datetime' => currentTime(),
				'merchant' => $this->muid,'sum' => $info['price'],'state' => 'false','evaluate_state' => 'false'
		);
		$table = M('record_consum');
		$result['result_code'] = $table->add($record);
		echo json_encode($result);
	}
	
	public function pay_v2()
	{
		//获取体验卡信息
		$table = D('merchant_card_experience');
		$where['muid'] = $this->muid;
		$where['code'] = $this->code;
		$info = $table->where($where)->select()[0];
		
		//清除体验卡余额
		$table = D('UserCard');
		$where_u['user'] = $this->uuid;
		$where_u['merchant'] = $this->muid;
		$where_u['card_code'] = $this->code;
		$where_u['card_type'] = "体验卡";
		
		$table->where($where_u)->delete();
		
		//获取店铺名称
		$table = D('merchant');
		$where['muid'] = $this->muid;
		$store = $table->where($where)->select()[0]['store'];
	
		//添加消费记录
		
		$content = array(
			array( "item" => "商户", "value" => $store ),
			array( "item" => "会员卡类型", "value" => "体验卡" ),
			array( "item" => "结算金额", "value" => $info['price'] ),
		);
	
		$record = array(
				'user' => $this->uuid,'content' => json_encode($content), 'datetime' => currentTime(),
				'merchant' => $this->muid,'card_type' => '体验卡','sum' => $info['price'],'state' => 'false','show_state' => 'true','evaluate_state' => 'false'
		);
		$table = M('record_consum');
		$result['result_code'] = $table->add($record);
		echo json_encode($result);
	}
	

	//获取购买状态
	public function stateGet()
	{
		
	}
	
	public function detailGet()
	{
		$table = D('UserCard');
                $where['user'] = $this->uuid;
		$where['merchant'] = $this->muid;
		$where['card_code'] = $this->code;
                $data = $table
                ->join('cn_merchant_card_experience on muid = merchant and code = card_code')
                ->field('cn_user_card.*,price,des')
                ->where($where)
                ->select();
                $data = $this->setExtra($data);
                echo json_encode($data);
	
	}
	 public function setExtra( $data )
        {
                $table = D("merchant");

                for($i=0; $i<count($data); $i++)
                {
                        $where['muid'] = $data[$i]['merchant'];
                        $info = $table->where($where)->select();
                        $data[$i]['store'] = $info[0]['store'];
                }

                return $data;
        }

	
}

