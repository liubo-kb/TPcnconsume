<?php

/*
*       商户会员卡控制器
		initialize()： 	初始化操作
		add():			添加体验卡
		mod():			编辑体验卡
		del():			删除体验卡
		addOption():	添加体验卡选项
		delOption():	删除体验卡选项
		getOption():	获取体验卡选项
		setOption():	设置体验卡选项
*/


namespace App\Controller\MerchantType;
use Think\Controller;
class ExperienceCardController extends Controller 
{
	private $muid;				//	1,商户注册id
	private $code;				//	2,体验卡编号
	private $template;			//	3,体验卡板式
	private $price;				//	4,体验卡价格
	private $des;				//	5,体验卡描述
	private $indate;			//	6,体验卡有效期
	private $display;			//	7,上架状态
	private $state;				//	8,审核状态

	
	//初始化参数
	function _initialize()
	{
		$this->muid = post('muid');
		$this->code = post('code');
		$this->template = post('template');
		$this->price = post('price');
		$this->des = post('des');
		$this->indate = post('indate');
		$this->display = post('display');
		$this->state = post('state');
	}

	//添加体验卡
	function add()
	{
		$record = array(
			'muid' => $this->muid, 'code' => get_uuid('exp_'), 'template' => $this->template,
			'price' => $this->price, 'des' => $this->des, 'indate' => $this->indate, 'display' => 'null', 'state' => 'true'
		);
		$table = D('merchant_card_experience');
		$result['result_code'] = addWithCheck($table,$record);
		echo json_encode($result);
	}
	
	//获取体验卡
	function get()
	{
		$where['muid'] = $this->muid;
		$where['display'] = $this->display;
		$table = D('merchant_card_experience');
		$data = $table->where($where)->select();
		echo json_encode($data);
	}
	
	//上下架体验卡
	function turn()
	{
		$table = D('merchant_card_experience');
		$where['muid'] = $this->muid;
		$where['code'] = $this->code;
		$set['display'] = post('display');
		$result['result_code'] = saveWithCheck($table,$where,$set);
		echo json_encode($result);
	}
	
	//编辑体验卡
	function mod()
	{
		$where['muid'] = $this->muid;
		$where['code'] = $this->code;
	
		$set['template'] = $this->template;
		$set['price'] = $this->price;
		$set['des'] = $this->des;
		$set['indate'] = $this->indate;
		
		$table = D('merchant_card_experience');
		$result['result_code'] = saveWithCheck($table,$where,$set);
		echo json_encode($result);
	}
	
	//删除体验卡
	function del()
	{
		$where['muid'] = $this->muid;
		$where['code'] = $this->code;
		$table = D('merchant_card_experience');
		$result['result_code'] = $table->where($where)->delete();
		echo json_encode($result);
	}
	
}
