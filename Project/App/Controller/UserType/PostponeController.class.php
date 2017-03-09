<?php

/*
*       预约控制器:
*               initialize()： 初始化操作
*               get()：获取预约列表操作
*               app()：申请预约操作
*               stateSet()：处理预约操作
*               
*/


namespace App\Controller\UserType;
use Think\Controller;
class PostponeController extends Controller 
{
	private $merchant;
	private $user;
	private $card_code;
	private $card_level;
	private $card_type;
	private $postpone;
	private $state;
	function _initialize()
	{
		$this->merchant = post('muid');
		$this->user = post('uuid');
		$this->card_code = post('card_code');
		$this->card_level = post('card_level');
		$this->card_type = post('card_type');
		$this->postpone = post('postpone');
                $this->state = post('state');

	}

	public function get()
	{
		$postpone = D('postpone');
		$where['merchant'] = $this->merchant;
		if($this->state =='null')
		{
			$where['state'] = 'null';
		}
		else
		{
			$where['state'] = array('neq','null');
		}
		$data = $postpone
		->where($where)
		->join("cn_user on cn_postpone.user = cn_user.uuid ")
		->select();
	
	
		echo json_encode($data);
	}

	public function check()
	{
		$postpone = D('postpone');
                $where['merchant'] = $this->merchant;
		$where['user'] = $this->user;
		$data = $postpone->where($where)->select();
                echo json_encode($data);
	}

	public function app()
	{
		$postpone = D('postpone');
		$record = array(
			'postpone' => $this->postpone, 'card_code' => $this->card_code,
			'card_level' => $this->card_level,'card_type' => $this->card_type,'merchant' => $this->merchant,
			'state' => 'null','user'=>$this->user,'datetime' => currentTime(),
		);
		$result['result_code'] = $postpone->addWithCheck($record);
		echo json_encode($result);
	}

	public function stateSet()
	{
		$postpone = D('postpone');
		$set['state'] = $this->state;
		$where['user'] = $this->user;
		$where['merchant'] = $this->merchant;
		$where['card_code'] = $this->card_code;
		$where['card_level'] = $this->card_level;

		if( $this->state == 'access')
		{
			$table = D("user_card");

			$date_start = $table->where($where)->select()[0]['date_end'];
                        $operate = '+ '.( doubleval($this->postpone) *12 ).' month';
			$result['flag'] = $operate;
                        $date_end = getTime($date_start,$operate);
		
			$set_c["date_end"] = $date_end;
			$table->where($where)->save($set_c);
		}

		$result['result_code'] = $postpone->where($where)->save($set);
		echo json_encode($result);
		
	}
}
