<?php
namespace App\Controller\UserType;
use Think\Controller;
class RecordController extends Controller 
{
	public function card()
	{
		$uuid = post('uuid');
		$table = D('record_buy');
		$where['user'] = $uuid;
		$data = $table
		->join('cn_merchant on cn_merchant.muid = cn_record_buy.merchant')
		->where($where)
		->field('cn_record_buy.*,store')
		->order('cn_record_buy.datetime desc')
		->select();
		echo json_encode($data);
	}
		
	public function pay()
	{
		$uuid = post('uuid');
		$where['user'] = $uuid;
		$where['show_state'] = "true";
		//$where['cn_record_consum.state'] = array('in','true,false');
		$table = M('record_consum');
        $data = $table
		->order("cn_record_consum.datetime desc")
		->join('cn_merchant on cn_merchant.muid = cn_record_consum.merchant')
		->field('cn_record_consum.*,store,image_url')
		->where($where)
		->select();
        echo json_encode($data);
	}
	
	public function payDel()
	{
		$user = post('uuid');
		$datetime = post('datetime');
        $where['user'] = $user;
		$where['datetime'] = $datetime;
		$set['show_state'] = 'false';
		$table = M('record_consum');
		$result['result_code'] = $table->where($where)->save($set);
        echo json_encode($result);

	}
}
