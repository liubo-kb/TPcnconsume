<?php

/*
*       用户银行卡控制器:
*               initialize()： 初始化操作
*               get()：获取预约列表操作
*               app()：申请预约操作
*               stateSet()：处理预约操作
*               
*/


namespace App\Controller\UserType;
use Think\Controller;
use App\Model\AppointModel;
class AppointController extends Controller 
{
	private $merchant;
	private $name;
	private $user;
	private $content;
	private $date;
	private $time;
	private $phone;
	private $state;
	function _initialize()
	{
		$this->merchant = post('muid');
		$this->name = post('name');
		$this->user = post('uuid');
		$this->phone = post('phone');
		$this->content = post('content');
		$this->date = post('date');
		$this->time = post('time');
                $this->state = post('state');

	}

	public function get()
	{
		$appoint = D('appoint');
		$where['merchant'] = $this->merchant;
		if($this->state =='null')
		{
			$where['state'] = 'null';
		}
		else
		{
			$where['state'] = array('neq','null');
		}
		$data = $appoint->where($where)->order("datetime desc")->select();
		
		echo json_encode($data);
	}

	public function check()
	{
		$appoint = D('appoint');
		$where['merchant'] = $this->merchant;
		$where['user'] = $this->user;
		$data = $appoint->where($where)->select();
		echo json_encode($data);
	}

	public function app()
	{
		$appoint = D('appoint');
		$record = array(
			'date' => $this->date,'time' => $this->time, 'content' => $this->content,
			'name' => $this->name,'phone' => $this->phone,'merchant' => $this->merchant,
			'state' => 'null','user'=>$this->user,'datetime' => currentTime(),
		);
		$result['result_code'] = $appoint->addWithCheck($record);
		echo json_encode($result);
	}

	public function stateSet()
	{
		$appoint = D('appoint');
		$set['state'] = $this->state;
		$where['user'] = $this->user;
		$where['merchant'] = $this->merchant;
		$where['date'] = $this->date;
		$where['time'] = $this->time;
		
		if( $this->state == 'access' )
		{
			$set['reason'] = '预约成功';
		}
		else
		{
			$set['reason'] = post('reason');
		}

		$result['result_code'] = $appoint->where($where)->save($set);
		echo json_encode($result);
		
	}
}
