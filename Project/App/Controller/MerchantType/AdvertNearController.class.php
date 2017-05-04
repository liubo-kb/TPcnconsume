<?php
namespace App\Controller\MerchantType;
use Think\Controller;
class AdvertNearController extends Controller 
{

	public function remove($arr,$tmp)
	{
		foreach( $arr as $k=>$v )
		{
			if($tmp == $v)
			{
				unset($arr[$k]);
			}
		}
		return $arr;
	}


	public function getPosition()
	{
		$result['check'] = "false";
		$muid = post("muid");
		$address = post('address');
		$table = D('advert_near_list');


		$where_c['address'] = $address;
		$where_c['muid'] = $muid;
		$where_c['state'] = array("neq","ONLINE");
		$count = $table->where($where_c)->count();
		if( $count > 0 )
		{
			$result['check'] = "true";
		}


		$where['address'] = $address;
		$position = $table
		->where($where)
		->order('position')
		->select();

	
		for($i = 1; $i <= 20; $i++)
		{
			$arr[$i] = "$i";
		}
		
		for($i = 0; $i < count($position); $i++)
		{
			$tmp[$i] = $position[$i]['position'];
		}

		for($i = 0; $i < count($tmp); $i++)
                {
                        $arr = $this->remove($arr,$tmp[$i]);
                }
		
		$arr = array_values($arr);
			
		$result['current_position'] = $arr;
		echo json_encode($result);
	}

	public function add()
	{
		$table = D('advert_near_list');
		$address = post('address');
		$muid = post('muid');
		$position = post('position');
		$pay_type = post('pay_type');
		$pay_content = post('pay_content');
		$datetime = currentTime();
		$state = "COMMITTED";

		$para = array(
                        'address' => $address,'position' => $position,'pay_content' => $pay_content
                );
                $sum = advertPay($pay_type,'near',$para);


		$record = array(
			'address' => $address, 'muid' => $muid, 'pay_type' => $pay_type,'position' => $position,
			'pay_content' => $pay_content, 'remain' => $pay_content,'datetime' => $datetime,'state' => $state,'sum' => $sum,
			'advert_type' => '周边广告类型',
		);
		
		$result['result_code'] = addWithCheck($table,$record);
		echo json_encode($result);
	}
	
	public function getList()
	{
		$table = D('advert_near_list');
		$address = post('address');
		$state = "ONLINE";

		$where['address'] = array("like","%".$address);
		//$where['state'] = $state;
		
		$count = $table->where($where)->count();
		$list = $table
		->where($where)
		->order('position asc')
		->select();

		$result = array();	
	
		for($i=0; $i<$count; $i++)
		{
			$where_c['muid'] = $list[$i]['muid'];
			$result[$i]['advert'] = $list[$i];
                	$result[$i]['info'] = showDataGet($where_c,"1,20");
		}
		echo json_encode($result);
	}

	public function set()
        {
                $where['address'] = post('id');
                $where['muid'] = post('muid');
                $where['position'] = post('position');
                $set['datetime'] = currentTime();
                $set['state'] = "ONLINE";
                D('advert_near_list')->where($where)->save($set);
        }

	public function del()   
        {
                $where['address'] = post('address');
                $where['muid'] = post('muid');
                $where['position'] = post('position');
                $result['result_code'] = D('advert_near_list')->where($where)->delete();
                echo json_encode($result);
        }
	
}
