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
use App\Model\UserCardModel;
class CardController extends Controller 
{
	private $code;
	private $level;
	private $cate;
	private $color;
	private $user;
	private $merchant;
	private $sum;
	private $evaluate;
	private $user_phone;
	private $user_address;
	private $user_sex;
	private $new_level;
	
	function _initialize()
	{
		$this->code = post('cardCode');
		$this->level = post('cardLevel');
		$this->cate = post('cardType');
		$this->color = post('image_url');
		$this->user = post('uuid');
		$this->merchant = post('muid');
		$this->sum = post('sum');
		$this->evaluate = 'false';
		$this->user_phone = post('user_phone');
		$this->user_address = post('user_address');

		$this->new_level = post('new_level');


		/*logInfo('code: '.$this->code);
		logInfo('level: '.$this->level);
		logInfo('type: '.$this->cate);
		logInfo('image_url: '.$this->image_url);
		logInfo('user: '.$this->user);
		logInfo('merchant: '.$this->merchant);
		logInfo('sum: '.$this->sum);
		logInfo('new_level: '.$this->new_level);
		*/

		/*$this->code = 'A0002';
                $this->level = '普卡';
                $this->cate = '计次卡';
                $this->image_url = 'card01.png';
                $this->user = 'u_76aab9b66f';
                $this->merchant = 'm_9ba5e2b48b';
                $this->sum = '10';
                $this->evaluate = 'false';
              

                $this->new_level = post('new_level');
		*/
		
	}

	
	public function multiFilter()
	{
		//获取储值卡
		$data['value'] = $this->getValueCard();

		//获取计次卡
		$data['count'] = $this->getCountCard();
		
		//获取套餐卡
		$data['meal'] = $this->getMealCard();
		
		//获取体验卡
		$data['experience'] = $this->getExperienceCard();
		
		//获取分享卡
		$data['share'] = $this->getShareCard();
		
		$data['num'] = count($data['value'])+count($data['count'])+count($data['meal'])+count($data['experience'])+count($data['share']);
		
		echo json_encode($data);
	}

	
	public function multiGet()
	{
		//获取储值卡
		$data['value'] = $this->getValueCard();

		//获取计次卡
		$data['count'] = $this->getCountCard();
		
		//获取套餐卡
		$data['meal'] = $this->getMealCard();
		
		//获取体验卡
		$data['experience'] = $this->getExperienceCard();
		
		//获取分享卡
		$data['share'] = $this->getShareCard();
		
		echo json_encode($data);
	}
	
	//获取储值卡
	function getValueCard()
	{
		$table = D('UserCard');
		$user = $this->user;
		if( $this->merchant != "null")
		{
			$where['cn_user_card.merchant'] = $this->merchant;
		}
		$type = '储值卡';
		$join = "cn_merchant_card.merchant = cn_user_card.merchant and type = card_type and code = card_code and level = card_level";
		$where['user'] = $user;
		$where['card_type'] = $type;
		$data = $table
		->join("cn_merchant_card ON $join ")
		->field('cn_user_card.*,price,rule,addition_sum')
		->where($where)
		->select();
		$data = $this->setExtra($data);
		return $data;
	}
	
	//获取计次卡
	function getCountCard()
	{
		$table = D('UserCard');
		$user = $this->user;
		if( $this->merchant != "null")
                {
                        $where['cn_user_card.merchant'] = $this->merchant;
                }
		$type = '计次卡';
		$join = "cn_merchant_card.merchant = cn_user_card.merchant and type = card_type and code = card_code and level = card_level";
		$where['user'] = $user;
		$where['card_type'] = $type;
		$data = $table
		->join("cn_merchant_card ON $join ")
		->field('cn_user_card.*,price,rule,addition_sum')
		->where($where)
		->select();
		$data = $this->setExtra($data);
		return $data;
	}
	
	//获取分享卡
	function getShareCard()
	{
		$table = D('card_share');
		$where_s['share_id'] = $this->user;
		if( $this->merchant != "null")
                {
                        $where_s['cn_user_card.merchant'] = $this->merchant;
                }

		$join1 = "cn_merchant_card.merchant = cn_card_share.merchant and cn_merchant_card.code = cn_card_share.card_code and cn_merchant_card.level = cn_card_share.card_level";
		$join2 = "cn_user_card.user = cn_card_share.posit_id and cn_user_card.merchant = cn_card_share.merchant and cn_user_card.card_code = cn_card_share.card_code and cn_user_card.card_level = cn_card_share.card_level";
		$data = $table
		->join("cn_merchant_card ON $join1")
		->join("cn_user_card ON $join2")
		->field('cn_user_card.*,price,rule,addition_sum')
		->where($where_s)
		->select();
		$data = $this->setExtra($data);
		return $data;
	}
	
	//获取套餐卡
	function getMealCard()
	{
		$table = D('UserCard');
		$where['user'] = $this->user;
		if( $this->merchant != "null")
                {
                        $where['cn_user_card.merchant'] = $this->merchant;
                }
		$data = $table
		->join('cn_merchant_card_meal on muid = merchant and code = card_code')
		->field('cn_user_card.*,price,option_num,option_sum')
		->where($where)
		->select();
		$data = $this->setExtra($data);
		return $data;
	}
	
	//获取体验卡
	function getExperienceCard()
	{
		$table = D('UserCard');
		$where['user'] = $this->user;
		if( $this->merchant != "null")
                {
                        $where['cn_user_card.merchant'] = $this->merchant;
                }
		$data = $table
		->join('cn_merchant_card_experience on muid = merchant and code = card_code')
		->field('cn_user_card.*,price,des')
		->where($where)
		->select();
		$data = $this->setExtra($data);
		return $data;
	}
	
	
	
	public function marketGet()
	{
	}
	

	public function rateGet()
	{
		$where['muid'] = $this->merchant;
		$where['uuid'] = $this->user;
		$where['card_code'] = $this->code;
		$where['card_level'] = $this->level;
		$where['method'] = post('method');
		
		$result['rate'] = D('card_market')->where($where)->select()[0]['rate'];
		echo json_encode($result);
		
	}
	
	public function moveFromMarket()
	{
		$where['muid'] = $this->merchant;
                $where['uuid'] = $this->user;
                $where['card_code'] = $this->code;
                $where['card_level'] = $this->level;
                $where['method'] = post('method');
		
		$result['result_code'] = D('card_market')->where($where)->delete();
		echo json_encode($result);

		$card = D('user_card');
                $where_c['user'] = $this->user;
                $where_c['merchant'] = $this->merchant;
                $where_c['card_code'] = $this->code;
                $where_c['card_level'] = $this->level;
                $set['state'] = 'null';
                $card->where($where_c)->save($set);
	}

	public function rateSet()
	{
		$where['muid'] = $this->merchant;
                $where['uuid'] = $this->user;
                $where['card_code'] = $this->code;
                $where['card_level'] = $this->level;
                $where['method'] = post('method');
		
		$set['rate'] = post('rate');
		$result['result_code'] = D('card_market')->where($where)->save($set);
		echo json_encode($result);
	}


	public function upToTransfer()
	{
		$this->upToMarket("transfer");
	}

	public function upToShare()
	{
		$this->upToMarket("share");
	}

	public function upToMarket( $method )
	{
		$where_m['muid'] = $this->merchant;
		$where_m['code'] = $this->code;
		$where_m['level'] = $this->level;
		$where_m['type'] = $this->cate;
		$rule = D('merchant_card')->where($where_m)->select()[0]['rule'];
		

		
		 $record = array(
                        'muid' => $this->merchant, 'uuid' => $this->user, 'card_code' => $this->code,
                        'card_level' => $this->level, 'card_type' => $this->cate, 'card_temp_color' => $this->color,
                        'card_remain' => $this->sum, 'method' => $method, 'rate' => post('rate'),
                        'datetime' => currentTime(),'rule' => $rule
                );
                $market = D('card_market');
                $result['result_code'] = addWithCheck($market,$record);
                echo json_encode($result);

		$card = D('user_card');
		$where['user'] = $this->user;
		$where['merchant'] = $this->merchant;
		$where['card_code'] = $this->code;
		$where['card_level'] = $this->level;
		$set['state'] = $method;
		$card->where($where)->save($set);

	}	


	public function filter()
	{
		
		$card = D('UserCard');
                $join = "cn_merchant_card.merchant = cn_user_card.merchant and type = card_type and code = card_code and level = card_level";
                $where['cn_user_card.user'] = $this->user;
		$where['cn_user_card.merchant'] = $this->merchant;
		
		$data['num'] = $card->where($where)->count();
		

                $data['info'] = $card
                ->join("cn_merchant_card ON $join ")
                ->field('cn_user_card.*,price,rule,addition_sum')
                ->where($where)
                ->select();

		echo json_encode($data);

		
	}


	
	public function get()
	{
		//setIntegral('u_4a48e91e08','100');
		//setTurnover('m_0deb263d26','100');
		//setMerchantRemain('m_6d4e76ca11','100');
		//$addSum =  getAddPrice('m_6d4e76ca11','card_068','金卡');
		//$sum = addAsInt('0.01元')
		
		//储值计次卡
		$card = D('UserCard');
		$user = $this->user;
		$join = "cn_merchant_card.merchant = cn_user_card.merchant and type = card_type and code = card_code and level = card_level";
		$where['user'] = $user;
		$data['self'] = $card
		->join("cn_merchant_card ON $join ")
		->field('cn_user_card.*,price,rule,addition_sum')
		->where($where)
		->select();
		$data['self'] = $this->setExtra( $data['self'] );

		//分享卡
		$share = D('card_share');
		$where_s['share_id'] = $user;
		$join1 = "cn_merchant_card.merchant = cn_card_share.merchant and cn_merchant_card.code = cn_card_share.card_code and cn_merchant_card.level = cn_card_share.card_level";
		$join2 = "cn_user_card.user = cn_card_share.posit_id and cn_user_card.merchant = cn_card_share.merchant and cn_user_card.card_code = cn_card_share.card_code and cn_user_card.card_level = cn_card_share.card_level";
		$data['share'] = $share
		->join("cn_merchant_card ON $join1")
		->join("cn_user_card ON $join2")
		->field('cn_user_card.*,price,rule,addition_sum')
		->where($where_s)
		->select();
		$data['share'] = $this->setExtra($data['share']);
				
		echo json_encode($data);
		//dump($data);

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

	public function test()
	{
		//handleReferrer($this->user,$this->merchant,$this->sum);
		//setMerchantRemain($this->merchant,$this->sum);
		getTime($w,$e);
	}

	public function detailGet()
	{
		$cardu = D('UserCard');
		$whereu['user'] = $this->user;
		$whereu['merchant'] = $this->merchant;
		$whereu['card_code'] = $this->code;
		$whereu['card_level'] = $this->level;
		
		$datau = $cardu->where($whereu)->select();
		
		$cardm = D('MerchantCard');
		$wherem['merchant'] = $this->merchant;
                $wherem['code'] = $this->code;
                $wherem['level'] = $this->level;
		$datam = $cardm->where($wherem)->field('price,rule,display_state')->select();

		//$data = array_merge($datau,$datam);
		$data['card_remain'] = $datau[0]['card_remain'];
		$data['card_level'] = $datau[0]['card_level'];
		$data['card_type'] = $datau[0]['card_type'];
		$data['card_code'] = $datau[0]['card_code'];

		$data['indate'] = $datau[0]['indate'];
		$data['date_start'] = $datau[0]['date_start'];
		$data['date_end'] = $datau[0]['date_end'];
		$data['state'] = $datau[0]['state'];
		$data['claim_state'] = $datau[0]['claim_state'];

		$data['card_temp_color'] = $datau[0]['card_temp_color'];
		$data['merchant'] = $datau[0]['merchant'];
		$data['price'] = $datam[0]['price'];
		$data['rule'] = $datam[0]['rule'];
		$data['display_state'] = $datam[0]['display_state'];

		$table = D("merchant");
		$where['muid'] = $this->merchant;
		$data['store'] = $table->where($where)->select()[0]['store'];
		echo json_encode($data);
	}
	
	public function buy()
	{
		//添加会员卡
		$addPrice = getExtra($this->merchant,$this->code,$this->level)[0]['addition_sum'];
		$color = getExtra($this->merchant,$this->code,$this->level)[0]['card_temp_color'];
		$indate = doubleval( getExtra($this->merchant,$this->code,$this->level)[0]['indate'] );
		$remain = getExtra($this->merchant,$this->code,$this->level)[0]['price'];

		if( $indate == 0 )
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



		$sum = addAsDouble($remain,$addPrice);
		//logInfo('sum:: '.$this->sum);
		//logInfo('add:: '.$addPrice);
		
		$record	= array(
					'user' => $this->user,'merchant' => $this->merchant,'card_code' => $this->code,
					'card_level' => $this->level,'card_type'=>$this->cate,'card_remain' => $sum,
					'card_temp_color' => $color,'evaluate' => 'false','indate' => $indate, 'date_start' => $date_start,'date_end' => $date_end,'state' => 'null','claim_state' => 'null'
				);
		$card = D('UserCard');
		$card->addWithCheck($record);
	
	
		//添加购买记录
		$record_buy = array(
                                        'user' => $this->user,'merchant' => $this->merchant,'card_code' => $this->code,
                                        'card_level' => $this->level,'card_type'=>$this->cate,'sum' => $this->sum,
                                        'card_temp_color' => $color,'datetime' => currentTime(),'w_state' => 'false','check_state' => 'false'
                                );
		$buyRecord = M('record_buy');
		$buyRecord->add($record_buy);

		//更新产生的推荐收入
		setReferrerSum($this->merchant,"m",$this->sum);
		

		//更新商户的余额
		//setMerchantRemain($this->merchant,$this->sum);

		//更新商户的营业额
		setTurnover($this->merchant,$this->sum);

		//产生积分处理
		//setIntegral($this->user,$this->sum);
		addIntegral($this->user,'办卡消费','consum',$this->sum);

		
	}

	public function renew()
	{
		//设置会员卡余额
		$card = D('UserCard');
		$where['user'] = $this->user;
		$where['merchant'] = $this->merchant;
		$where['card_code'] = $this->code;
		$where['card_level'] = $this->level;
		
		$data = $card->where($where)->select();
		$remain = $data[0]['card_remain'];
		$newRemain = addAsDouble($this->sum,$remain);
		$set['card_remain'] = $newRemain;
		$card->where($where)->save($set);

		//添加续卡记录
                $record_renew = array(
                                        'user' => $this->user,'merchant' => $this->merchant,'card_code' => $this->code,
                                        'card_level' => $this->level,'sum' => $this->sum,'datetime' => currentTime()
                                );
                $renewRecord = M('record_renew');
                $renewRecord->add($record_renew);

		//更新产生的推荐收入
                setReferrerSum($this->merchant,"m",$this->sum);

		//更新商户的余额
                //setMerchantRemain($this->merchant,$this->sum);

                //更新商户的营业额
                setTurnover($this->merchant,$this->sum);

                //产生积分处理
                //setIntegral($this->user,$this->sum);
		addIntegral($this->user,'续卡消费','consum',$this->sum);

		
		
		

	}


	public function setLevel()
	{
		//获取新卡的色值
		$table = D('MerchantCard');
		$where['merchant'] = $this->merchant;
		$where['code'] = $this->code;
		$where['level'] = $this->new_level;
		$data = $table->where($where)->select();
                $new_image_url = $data[0]['card_temp_color'];

		//设置新卡的信息
		$table = D('UserCard');
                $where_n['user'] = $this->user;
                $where_n['merchant'] = $this->merchant;
                $where_n['card_code'] = $this->code;
                $where_n['card_level'] = $this->level;

                $set['card_level'] = $this->new_level;
                $set['card_temp_color'] = $new_image_url;
                $result['result_code'] = $table->where($where_n)->save($set);
		echo json_encode($result);

	}

	public function upgrade()
    {
                //设置会员卡余额，级别，和图像
                $cardm = D('MerchantCard');
               
                $wherem['merchant'] = $this->merchant;
                $wherem['code'] = $this->code;
                $wherem['level'] = $this->new_level;

                $data = $cardm->where($wherem)->select();
                $new_image_url = $data[0]['card_temp_color'];
		
		$cardu = D('UserCard');
		$whereu['user'] = $this->user;
		$whereu['card_code'] = $this->code;
		$whereu['card_level'] = $this->level;
		$whereu['merchant'] = $this->merchant;
		$data = $cardu->where($whereu)->select();

		$remain = $data[0]['card_remain'];
                $newRemain = addAsDouble($this->sum,$remain);
                $set['card_remain'] = $newRemain;
		$set['card_level'] = $this->new_level;
		$set['card_temp_color'] = $new_image_url;
                $cardu->where($whereu)->save($set);

                //添加升级记录
                $record_upgrade = array(
                                        'user' => $this->user,'merchant' => $this->merchant,'card_code' => $this->code,
                                        'old_card_level' => $this->level,'new_card_level' => $this->new_level,
					'sum' => $this->sum,'datetime' => currentTime()
                                );
                $upgradeRecord = M('record_upgrade');
                $upgradeRecord->add($record_upgrade);

               	//更新产生的推荐收入
                setReferrerSum($this->merchant,"m",$this->sum);

		//更新商户的余额
                //setMerchantRemain($this->merchant,$this->sum);

                //更新商户的营业额
                setTurnover($this->merchant,$this->sum);

                //产生积分处理
                //setIntegral($this->user,$this->sum);
		addIntegral($this->user,'升级消费','consum',$this->sum);


        }
		
	public function pay()
	{
		//修改会员卡余额
		$card = D('UserCard');
		$where['user'] = $this->user;
		$where['merchant'] = $this->merchant;
		$where['card_code'] = $this->code;
		$where['card_level'] = $this->level;
		$where['card_type'] = $this->cate;
		
		$data = $card->where($where)->select();
		$remain = $data[0]['card_remain'];
		$newRemain = redAsDouble($remain,$this->sum);
		
		$set['card_remain'] = $newRemain;
		$card->where($where)->save($set);

		$table = D('merchant');
		$where_m['muid'] = $this->merchant;
		$data = $table->where($where_m)->select();
		$store = $data[0]['store'];
		
		if( $this->cate == '储值卡')
		{
			$content = $store.'■■结算金额♥♥'.$this->sum;
		}
		else
		{
			$card = D('MerchantCard');
			$wherem['merchant'] = $this->merchant;
			$wherem['code'] = $this->code;
            $wherem['level'] = $this->level;
            $wherem['type'] = $this->cate;
			$data = $card->where($wherem)->select();
			$price = intval( $data[0]['price'] ) / intval( $data[0]['rule'] ) ;
			$sum = intval( $this->sum ) / $price ;
			$content = $store.'■■结算次数♥♥'.$sum;
			
		}

		$record = array(
						'user' => $this->user,'content' => $content, 'datetime' => currentTime(),
						'merchant' => $this->merchant,'sum' => $this->sum,'state' => 'false','evaluate_state' => 'false','check_state' => 'false'
		);

		$cnList = M('record_consum');
		$result['result_code'] = $cnList->add($record);
		echo json_encode($result);
		

		/*更新商户的消费额(计算授信剩余额度)*/
		$auth = M('merchant_consum');
		$where_auth['merchant'] = $this->merchant;
		//$where_auth['merchant'] = "m_6d4e76ca11";
		
		$check = $auth->where($where_auth)->count();
		if($check > 0)
		{
			$data = $auth->where($where_auth)->select();
			$remain = $data[0]['sum'];
			$newRemain = addAsDouble($remain,$this->sum);
			$set_auth['sum'] = $newRemain;
			$result['result_code'] = $auth->where($where_auth)->save($set_auth);
			//echo json_encode($result);
		}
		else
		{
			$record = array('merchant' => $this->merchant,'sum' => $this->sum);
			$result['result_code'] = $auth->add($record);
			//echo json_encode($result);
		}

		//同步卡市的数据
		$where_cm = array(
			'uuid' => $this->user, 'muid' => $this->merchant, 'card_level' => $this->level
		);
		setCardMarket($where_cm,$this->sum);
	}
	
	//储值卡消费
	public function value_pay()
	{
		/*减少会员卡余额*/
		$this->redCardRemain();
		
		/*记录消费数据*/
		
		//获取店铺名
		$table = D('merchant');
		$where_m['muid'] = $this->merchant;
		$data = $table->where($where_m)->select();
		$store = $data[0]['store'];
		
		//设置记录详情
		$content = array(
			array( "item" => "商户", "value" => $store ),
			array( "item" => "会员卡类型", "value" => "储值卡" ),
			array( "item" => "会员卡级别", "value" => $this->level ),
			array( "item" => "结算金额", "value" => $this->sum ),
		);
		$record = array(
			'user' => $this->user,'content' => json_encode( $content ), 'datetime' => currentTime(),
			'merchant' => $this->merchant,'card_type' => '储值卡','sum' => $this->sum,'state' => 'false','show_state' => 'true','evaluate_state' => 'false','check_state' => 'false'
		);
		$cnList = M('record_consum');
		$result['result_code'] = $cnList->add($record);
		echo json_encode($result);
		
		/*同步卡市的数据*/
		$where_cm = array(
			'uuid' => $this->user, 'muid' => $this->merchant, 'card_level' => $this->level
		);
		setCardMarket($where_cm,$this->sum);
	}
	
	//计次卡消费
	public function count_pay()
	{
		/*减少会员卡余额*/
		$this->redCardRemain();
		
		/*记录消费数据*/
		
		//获取店铺名
		$table = D('merchant');
		$where_m['muid'] = $this->merchant;
		$data = $table->where($where_m)->select();
		$store = $data[0]['store'];
		
		//获取消费次数
		$card = D('MerchantCard');
		$wherem['merchant'] = $this->merchant;
		$wherem['code'] = $this->code;
		$wherem['level'] = $this->level;
		$wherem['type'] = $this->cate;
		$data = $card->where($wherem)->select();
		$price = intval( $data[0]['price'] ) / intval( $data[0]['rule'] ) ;
		$num = round( intval( $this->sum ) / $price ) ;
		
		//设置记录详情
		$content = array(
			array( "item" => "商户", "value" => $store ),
			array( "item" => "会员卡类型", "value" => "计次卡" ),
			array( "item" => "会员卡级别", "value" => $this->level ),
			array( "item" => "结算次数", "value" => $num ),
		);
		
		$record = array(
			'user' => $this->user,'content' => json_encode( $content ), 'datetime' => currentTime(),
			'merchant' => $this->merchant,'sum' => $this->sum,'card_type' => '计次卡','state' => 'false','show_state' => 'true','evaluate_state' => 'false','check_state' => 'false'
		);
		$table = M('record_consum');
		$result['result_code'] = $table->add($record);
		echo json_encode($result);
	}
	
	//减少会员卡余额
	function redCardRemain()
	{
		$card = D('UserCard');
		$where['user'] = $this->user;
		$where['merchant'] = $this->merchant;
		$where['card_code'] = $this->code;
		$where['card_level'] = $this->level;
		$where['card_type'] = $this->cate;
		
		$data = $card->where($where)->select();
		$remain = $data[0]['card_remain'];
		$newRemain = redAsDouble($remain,$this->sum);
		
		$set['card_remain'] = $newRemain;
		$card->where($where)->save($set);
	}
	
	
	public function stateGet()
	{
		$card = D('UserCard');
		$where['merchant'] = $this->merchant;
		$where['user'] = $this->user;
		$where['card_code'] = $this->code;
		$where['card_level'] = $this->level;
		$where['card_type'] = $this->cate;
		$check = $card->where($where)->count();
		if($check > 0)
		{
			$result['result_code'] = 'true';
		}
		else
		{
			$result['result_code'] = 'false';
		}
		echo json_encode($result);
	}

	public function share()
    {
                $user = D('user');
                $where['phone'] = post('phone');
		//$where['phone'] = '13488199837';
                $data = $user->where($where)->select();
                $share_id = $data[0]['uuid'];
                $posit_id = post('uuid');
		$merchant = post('muid');
                $card_code = post('card_code');
                $card_level = post('card_level');

                $card = D('card_share');
                $record = array(
                        'posit_id' => $posit_id,
                        'share_id' => $share_id,
			'merchant' => $merchant,
                        'card_code' => $card_code,
                        'card_level' => $card_level
                );
                $result['result_code'] = $card->add($record);
                echo json_encode($result);
        }

	public function share_list()
	{
		$card = D('card_share');
		$where['posit_id'] = post('uuid');
		$where['merchant'] = post('muid');
                $where['card_code'] = post('card_code');
                $where['card_level'] = post('card_level');
		$data = $card
		->field('uuid,phone,name,headImage')
		->join("cn_user ON cn_user.uuid = cn_card_share.share_id")
		->where($where)
		->select();
		echo json_encode($data);
	}

	public function share_del()
	{
		$card = D('card_share');
		$where['posit_id'] = post('uuid');
		$where['share_id'] = post('share_id');
		$where['merchant'] = post('muid');
		$where['card_code'] = post('card_code');
		$where['card_level'] = post('card_level');
		$result['result_code'] = $card->where($where)->delete();
		echo json_encode($result);
	}

}

