<?php
namespace App\Controller\UserType;
use Think\Controller;
class ClaimController extends Controller 
{
	//申请理赔
	function commit()
	{
		$uuid = post('uuid');
		$muid = post('muid');
		$card_code = post('card_code');
		$card_level = post('card_level');
		$card_type = post('card_type');
		$reason = post('reason');
		
		$start_time = currentTime();
		$end_time = "0-0-0 00:00:00";
		$state = 'COMMITTED';
		$sum = '0.00';
		
		$record = array(
			"uuid" => $uuid,"muid" => $muid,"card_code" => $card_code,"card_level" => $card_level,"card_type" => $card_type,
			"reason" => $reason,"start_time" => $start_time,"end_time" => $end_time,"state" => $state,"sum" => $sum
		);
		
		$table = D("user_claim");
		$result['result_code'] = addWithCheck($table,$record);
		
		
		$where['user'] = $uuid;
		$where['merchant'] = $muid;
		$where['card_code'] = $card_code;
		$where['card_level'] = $card_level;
		$where['card_type'] = $card_type;
		$table = D("user_card");
		$set['claim_state'] = "COMMITTED";
		$result['result_code'] = saveWithCheck($table,$where,$set);
		
		echo json_encode($result);
		
	}
	
	//获去理赔过程
	function get()
	{
		$uuid = post('uuid');
		$muid = post('muid');
		$card_code = post('card_code');
		$card_level = post('card_level');
		$card_type = post('card_type');
		
		$where['uuid'] = $uuid;
		$where['muid'] = $muid;
		$where['card_code'] = $card_code;
		$where['card_level'] = $card_level;
		$where['card_type'] = $card_type;
		$table = D("user_claim");
		$result = $table->where($where)->select();
		echo json_encode($result);
	}

	//撤销理赔
	function revoke()
	{
		$uuid = post('uuid');
		$muid = post('muid');
		$card_code = post('card_code');
		$card_level = post('card_level');
		$card_type = post('card_type');

		$where['uuid'] = $uuid;
		$where['muid'] = $muid;
		$where['card_code'] = $card_code;
		$where['card_level'] = $card_level;
		$where['card_type'] = $card_type;
		$table = D("user_claim");
		$result = $table->where($where)->delete();


		$where_u['user'] = $uuid;
		$where_u['merchant'] = $muid;
		$where_u['card_code'] = $card_code;
		$where_u['card_level'] = $card_level;
		$where_u['card_type'] = $card_type;
		$table = D("user_card");
		$set['claim_state'] = "null";
		$info['result_code'] = saveWithCheck($table,$where_u,$set);

		echo json_encode($info);

	}
}
