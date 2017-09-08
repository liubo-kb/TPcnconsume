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
class MealCardController extends Controller 
{
	private $muid;				//	1,商户注册id
	private $code;				//	2,套餐卡编号
	private $uuid;				//	3,用户注册id
	private $price;				//	4,套餐卡价格
	private $des;				//	5,套餐卡描述
	private $option_num;		//	6,套餐项目总数
	private $indate;			//	7,套餐卡有效期
	private $template;			//	8,套餐卡板式
	
	private $pay_sum;			//	9，商户收款额
	
	//初始化post参数
	function _initialize()
	{
		$this->muid = post('muid');
		$this->code = post('code');
		$this->uuid = post('uuid');
		$this->pay_sum = post('pay_sum');
		
		//logIn('test:'.$this->muid.$this->code.$this->uuid.$this->pay_sum);
		
		/*$this->muid = 'm_d7c116a9cc';
		$this->code = 'meal_9783b2aaa2';
		$this->uuid = 'u_uuid0148';*/
		
	}
	
	//初始化套餐卡其它参数
	function initExtra()
	{
		$table = D('merchant_card_meal');
		$where['muid'] = $this->muid;
		$where['code'] = $this->code;
		$info = $table->where($where)->select()[0];
		
		$this->price = $info['price'];
		$this->des = $info['des'];
		$this->option_num = $info['option_num'];
		$this->indate = $info['indate'];
		$this->template = $info['template'];
	}
	
	
	//购买会员卡
	public function buy()
	{	
		//初始化套餐卡其它参数
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

		//用户添加套餐卡
		$record	= array(
			'user' => $this->uuid,'merchant' => $this->muid,'card_code' => $this->code,
			'card_level' => '套餐卡','card_type'=>'套餐卡','card_remain' => $this->price,
			'card_temp_color' => $this->template,'evaluate' => 'false','indate' => $indate, 'date_start' => $date_start,'date_end' => $date_end,'state' => 'null'
		);
		
		$table = D('UserCard');
		addWithCheck($table,$record);
		
		//用户添加套餐卡选项
		$where['muid'] = $this->muid;
		$where['code'] = $this->code;
		$table = D('meal_merchant_option');
		$info = $table->where($where)->select();
		for($i = 0; $i < count($info); $i++)
		{
			$info[$i]['uuid'] = $this->uuid;
			$table = D('meal_user_option');
			addWithCheck($table,$info[$i]);
		}
	
	
		//添加购买记录
		$record_buy = array(
				'user' => $this->uuid,'merchant' => $this->muid,'card_code' => $this->code,
				'card_level' => '套餐卡','card_type'=>'套餐卡','sum' => $this->pay_sum,
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

	
	//套餐卡支付	
	public function pay()
	{
		//减少套餐卡项目
		$option_id = post('option_id');
		//$option_id = 'opt_63a1e7955e';
		$where['uuid'] = $this->uuid;
		$where['muid'] = $this->muid;
		$where['code'] = $this->code;
		$where['option_id'] = $option_id;
		$table = D('meal_user_option');
		$remain = $table->where($where)->select()[0]['option_count'];
		
		if($remain <= 1)
		{
			$table->where($where)->delete();
		}
		else
		{
			$set['option_count'] = $remain - 1;
			saveWithCheck($table,$where,$set);
		}
		
		//添加项目消费记录
		$where_m['id'] = $option_id;
		$where_m['muid'] = $this->muid;
		$table = D('meal_option');
		$info = $table->where($where_m)->select()[0];
		
		//获取店铺名称
		$table = D('merchant');
		$where_c['muid'] = $this->muid;
		$store = $table->where($where_c)->select()[0]['store'];
	
		//添加消费记录
		$content = $store.'■■项目名称♥♥'.$info['name']."★★项目价格♥♥".$info['price'];
		$record = array(
				'user' => $this->uuid,'content' => $content, 'datetime' => currentTime(),
				'merchant' => $this->muid,'sum' => $info['price'],'state' => 'false','evaluate_state' => 'false','check_state' => 'false'
		);
		$table = M('record_consum');
		$result['result_code'] = $table->add($record);
		echo json_encode($result);
	}
	
	public function pay_v2()
	{
		//减少套餐卡项目
		$option_id = post('option_id');
		//$option_id = 'opt_63a1e7955e';
		$where['uuid'] = $this->uuid;
		$where['muid'] = $this->muid;
		$where['code'] = $this->code;
		$where['option_id'] = $option_id;
		$table = D('meal_user_option');
		$remain = $table->where($where)->select()[0]['option_count'];
		
		if($remain <= 1)
		{
			$table->where($where)->delete();
		}
		else
		{
			$set['option_count'] = $remain - 1;
			saveWithCheck($table,$where,$set);
		}
		
		//添加项目消费记录
		$where_m['id'] = $option_id;
		$where_m['muid'] = $this->muid;
		$table = D('meal_option');
		$info = $table->where($where_m)->select()[0];
		
		//获取店铺名称
		$table = D('merchant');
		$where_c['muid'] = $this->muid;
		$store = $table->where($where_c)->select()[0]['store'];
	
		//添加消费记录
		$content = array(
			array( "item" => "商户", "value" => $store ),
			array( "item" => "会员卡类型", "value" => "套餐卡" ),
			array( "item" => "消费项目", "value" => $info['name'] ),
			array( "item" => "项目价格", "value" => $info['price'] ),
		);
		$record = array(
				'user' => $this->uuid,'content' => json_encode($content), 'datetime' => currentTime(),
				'merchant' => $this->muid,'card_type' => '套餐卡','sum' => $info['price'],'state' => 'false','show_state' => 'true','evaluate_state' => 'false','check_state' => 'false'
		);
		$table = M('record_consum');
		$result['result_code'] = $table->add($record);
		echo json_encode($result);
	}
	//获取套餐卡详情
	public function detailGet()
	{
		$table = D('UserCard');
        $where['user'] = $this->uuid;
		$where['merchant'] = $this->muid;
		$where['card_code'] = $this->code;
		$data = $table
		->join('cn_merchant_card_meal on muid = merchant and code = card_code')
		->field('cn_user_card.*,price,option_num,option_sum')
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

	
	//获取套餐项
	public function getOption()
	{
		$table = D('meal_user_option');
		$where['cn_meal_user_option.muid'] = $this->muid;
		$where['uuid'] = $this->uuid;
		$where['code'] = $this->code;
		$data = $table
		->where($where)
		->join("cn_meal_option on id = option_id")
		->order('datetime')
		->select();
		echo json_encode($data);
	}
	

	//获取购买状态
	public function stateGet()
	{
		
	}
	
	//套餐卡分享
	public function share()
    {
		
    }

	//套餐卡分享列表
	public function share_list()
	{
		
	}
	
	//套餐卡分享删除
	public function share_del()
	{
		
	}

}

