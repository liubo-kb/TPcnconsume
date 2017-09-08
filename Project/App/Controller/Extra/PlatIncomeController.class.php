<?php
namespace App\Controller\Extra;
use Think\Controller;
class PlatIncomeController extends Controller 
{
	function record()
	{
		$table = D("record_plat_income");
		$id = post('id');  //操作人ID
		$type = post('type'); //操作人类型
		$event = post('event'); //操作事件
		$pay_sum = post('pay_sum'); //支付金额
		$pay_type = post('pay_type'); //支付类型
		$datetime = currentTime();  //支付时间
		
		$record = array(
			'id' => $id, 'type' => $type, 'event' => $event,
			'pay_sum' => $pay_sum, 'pay_type' => $pay_type, 'datetime' => $datetime
		);
		
		addWithCheck($table,$record);
	}
}
