<?php
namespace App\Controller\MerchantType;
use Think\Controller;
class AdvertActivityController extends Controller 
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

	public function get()
	{
		$table = D('advert_activity');
		$address = post('address');
		//$address = '西安市';
		$where['address'] = $address;
		$result = $table->where($where)->select();
		//dump($result);
		echo json_encode($result);
	}
	

	public function getPosition()
	{
		$result['check'] = "false";
		$muid = post("muid");
		$id = post('advert_id');
		$table = D('advert_activity_list');


		$where_c['id'] = $id;
		$where_c['muid'] = $muid;
		$where_c['state'] = array("neq","ONLINE");
		$count = $table->where($where_c)->count();
		if( $count > 0 )
		{
			$result['check'] = "true";
		}


		$where['id'] = $id;
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
		$table = D('advert_activity_list');
		$id = post('advert_id');
		$muid = post('muid');
		$position = post('position');
		$title = post('title');
		$info = post('info');
		$image_url = post('image_url');
		$pay_type = post('pay_type');
		$pay_content = post('pay_content');
		$datetime = currentTime();
		$state = "COMMITTED";

		$para = array(
                        'id' => $id,'position' => $position,'pay_content' => $pay_content
                );
                $sum = advertPay($pay_type,'activity',$para);


		$record = array(
			'id' => $id, 'muid' => $muid, 'position' => $position, 'title' => $title, 'info' => $info,
			'image_url' => $image_url, 'pay_type' => $pay_type, 'pay_content' => $pay_content, 'remain' => $pay_content,'datetime' => $datetime,
			'sum' => $sum,'state' => $state
		);
		
		$result['result_code'] = addWithCheck($table,$record);
		echo json_encode($result);
	}
	
	public function getList()
	{
		$table = D('advert_activity_list');
		$muid = post('muid');
		$state = post('state');
		$advert_id = post('advert_id');
		if($muid != 'null')
		{
			$where['muid'] = $muid;
		}
		if($state != 'null')
		{
			$where['state'] = $state;
		}
		if($advert_id != 'null')
		{
			$where['id'] = $advert_id;
		}
		$result = $table
		->order('position')
		->where($where)
		->select();
		echo json_encode($result);
	}

	public function set()
        {
                $where['id'] = post('id');
                $where['muid'] = post('muid');
                $where['position'] = post('position');
                $set['datetime'] = currentTime();
                $set['state'] = "ONLINE";
                D('advert_activity_list')->where($where)->save($set);
        }

        public function del()
        {
                $where['id'] = post('id');
                $where['muid'] = post('muid');
                $where['position'] = post('position');
                $result['result_code'] = D('advert_activity_list')->where($where)->delete();
                echo json_encode($result);

        }
	
}
