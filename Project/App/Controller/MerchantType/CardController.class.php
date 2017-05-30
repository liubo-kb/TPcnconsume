<?php

/*
*       商户会员卡控制器
*	  _inititlize()：初始化操作
*         add() ：添加会员卡操作
*         get() ：获取会员卡操作
*	  levelGet()：获取会员卡所有级别操作
*		          
*/


namespace App\Controller\MerchantType;
use Think\Controller;
use App\Model\MerchantCardModel;
class CardController extends Controller 
{
	private $code;
	private $level;
	private $type;
	private $color;
	private $content;
	private $merchant;
	private $price;
	private $rule;
	private $addition;
	private $state;
	private $indate;
		
	function _initialize()
	{
		$this->code = post('code');
		$this->level = post('level');
		$this->color = post('color');
		$this->type = post('type');
		$this->content = post('content');
		$this->merchant = post('muid');
		$this->price = post('price');
		$this->rule = post('rule');
		$this->addition = post('addition');
		$this->indate = post('indate');
		$this->state = post('state');

	}

	public function addSeries()
	{
		$table = D('card_series');
		$record = array(
			"merchant" => $this->merchant, "type" => $this->type,
			"id" => get_uuid("vipc_"),"name" => post('name'), "state" => "access"
		);
		$result['result_code'] = addWithCheck($table,$record);
		echo json_encode($result);
	}

	public function getSeries()
	{
		$table = D('card_series');
		$where['merchant'] = $this->merchant;
		$where['type'] = $this->type;
		$data = $table->where($where)->select();
		echo json_encode($data);

	}


	public function turn()
	{
		$table = D('merchant_card');
		$where['merchant'] = $this->merchant;
		$where['code'] = $this->code;
		$where['level'] = $this->level;
		$set['display_state'] = post('display_state');
		$result['result_code'] = saveWithCheck($table,$where,$set);
		echo json_encode($result);
	}

	
	public function mod()
	{
		$table = D('merchant_card');
                $where['merchant'] = $this->merchant;
                $where['code'] = $this->code;

		$set['level'] = $this->level;
		$set['type'] = $this->type;
                $set['card_temp_color'] = $this->color;
		$set['content'] = $this->content;
		$set['price'] = $this->price;
                $set['rule'] = $this->rule;
		$set['state'] = 'true';
		$set['addition_sum'] = $this->addition;
		$set['indate'] = $this->indate;
                $set['display_state'] = 'null';

		$result['result_code'] = saveWithCheck($table,$where,$set);
		echo json_encode($result);
		
	}

	public function del()
	{
		$table = D('merchant_card');
                $where['merchant'] = $this->merchant;
                $where['code'] = $this->code;
		$result['result_code'] = $table->where($where)->delete();
		echo json_encode($result);
	}

	public function add()
	{
		$card = D('merchant_card');

		$record = array(
			 'merchant' => $this->merchant,'code' => $this->code,'level' => $this->level,'type' => $this->type,
                         'card_temp_color' => $this->color,'content' => $this->content,'price' => $this->price,
			 'rule' => $this->rule,'state' => 'true','addition_sum'=>$this->addition,'indate' => $this->indate,
			'display_state' => 'null'
			);
		$result['result_code'] = $card->addWithCheck($record);
		echo json_encode($result);
	}
	
	public function get()
	{
		$where['merchant'] = $this->merchant;
		//$where['merchant'] = "m_6d4e76ca11";	
		$where['state'] = 'true';
		//$where['display_state']	 = 'on';
	
		$card = D('merchant_card');
		$result = $card
		->where($where)
		->select();
		
		echo json_encode($result);
	}

	public function levelGet()
	{
		$card = D('merchant_card');
		$where['merchant'] = $this->merchant;
		$where['code'] = $this->code;
		$where['state'] = 'true';

		$result = $card
                ->where($where)
		->field('level,price')
                ->select();
                echo json_encode($result);

	}

	public function cardTempGet()
	{
		$card = D('card_temp');
		$result = $card->select();
		echo json_encode($result);
	}	

	public function share()
	{
		$user = D('user');
		$where['phone'] = post('phone');
		$data = $user->where($where)->select();
		$shara_id = $data[0]['uuid'];
		$posit_id = post('uuid');
		$card_code = post('card_code');
		$card_level = post('card_level');

		$card = D('card_share');
		$record = array(
			'posit_id' => $posit_id,
			'share_id' => $share_id,
			'card_code' => $card_code,
			'card_level' => $card_level
		);
		$result['result_code'] = $card->add($record);
		echo json_encode($result);
	}	
}
