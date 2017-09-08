<?php
namespace App\Controller\Extra;
use Think\Controller;
class TradeController extends Controller 
{
	//获取上层分类的行业图标
	public function getUp()
	{
		$table = D('trade_up');
		$data = $table
		->field('id,icon_url,text')
		->order('id asc')
		->select();
		echo json_encode($data);
	}
	
	//获取下层的行业分类图标
	public function getSub()
	{
		$table = D('trade_sub');
		$up_id = post('up_id');
		if($up_id != "null")
		{
			$where['id'] = array("like",substr($up_id,0,2)."%");
		}
		$data = $table
		->where($where)
		->field('icon_url,text')
		->order('id asc')
		->select();
		echo json_encode($data);
	}
	
	
	//获取上层行业的广告
	public function getContent()
	{
		
	}
	
}
