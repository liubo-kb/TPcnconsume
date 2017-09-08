<?php

/*
*       用户评价控制器:
*               initialize()： 初始化操作
*               get()：获取评价内容操作
*               commit()：上传评价内容操作
*               delete()：删除未评价条目操作
*		listGet() :获取未评价列表
*               
*/


namespace App\Controller\UserType;
use Think\Controller;
use App\Model\EvaluateModel;
class EvaluateController extends Controller 
{
	private $merchant;
	private $user;
	private $content;
	private $stars;
	private $datetime;
	private $code;
	private $level;
	private $type;
	private $price;
	private $card_temp_color;

	function _initialize()
	{
		$this->merchant = post('muid');
		$this->user = post('uuid');
		$this->content = post('content');
		$this->stars = post('stars');
		$this->datetime = currentTime();
		$this->code = post('cardCode');
		$this->level = post('cardLevel');
		$this->type = post('cardType');
		$this->price = post('price');
		$this->card_temp_color = post('card_temp_color');

		/*$this->merchant = "m_6d4e76ca11";
		$this->user = "u_4a48e91e08";
		$this->code = "card001";
		$this->level = "金卡";
		$this->type = "储值卡";
		$this->price = "100元";
		*/

		//$this->merchant = 'm_6d4e76ca11';

	}

	public function get()
	{
		$page = post('index').",20";
		
		$evaluate = D('evaluate');

		$where['merchant'] = $this->merchant;			

		$data = $evaluate
		->join('cn_user ON cn_user.uuid = cn_evaluate.user')
		->field('cn_evaluate.*,nickname,headImage')
		->where($where)
		->page($page)
		->order('cn_evaluate.datetime desc')
		->select();

		echo json_encode($data);
	}

	public function userGet()
	{
		$table = D('evaluate');
		$where['user'] = $this->user;
		$data = $table
		->join("cn_user on cn_user.uuid = cn_evaluate.user")
		->join("cn_merchant on cn_merchant.muid = cn_evaluate.merchant")
		->field("cn_evaluate.*,nickname,headImage,store")
		->where($where)
		->select();
		echo json_encode($data);
	}
	
	public function listGet()
	{
		$merchant = D('merchant');
		$where['user'] = $this->user;
		$where['evaluate'] = 'false';
		$data = $merchant
		->where($where)
		->join('cn_user_card ON cn_merchant.muid = cn_user_card.merchant')
		->field('store,merchant,card_code,card_level,card_type,card_remain,card_temp_color')
		->select();
		echo json_encode($data);
	}

	public function commit()
	{
		$evaluate = D('evaluate');
		$record = array(
			'merchant' => $this->merchant, 'user' => $this->user,'content' => $this->content,'stars' => $this->stars,
			'datetime' => currentTime(), 'card_code' => $this->code, 'card_level' => $this->level,'card_type' => $this->type,
			'card_price' => $this->price,'card_image_url' => $this->card_temp_color
		);

		$result['result_code'] = addWithCheck($evaluate,$record);

		$card = D('record_consum');
		$where['user'] = $this->user;
		$where['datetime'] = post('datetime');
		$set['evaluate_state'] = "true";
		
		$result['result_code'] = $card->where($where)->save($set);


		echo json_encode($result);

	}

	
	
	public function delete()
	{
		$card = D('user_card');
		$where['user'] = $this->user;
		$where['merchant'] = $this->merchant;
		$where['card_code'] = $this->code;
		$where['card_level'] = $this->level;
		$set['evaluate'] = 'true';
		$result['result_code'] = $card->where($where)->save($set);
		echo json_encode($result);
	}
	
}
