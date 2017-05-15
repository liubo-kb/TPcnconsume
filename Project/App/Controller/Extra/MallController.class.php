<?php
namespace App\Controller\Extra;
use Think\Controller;
class MallController extends Controller 
{
	public function index()
	{
		echo '其它控制器索引';
	}
	
	public function getGoods()
        {
		$table = D('mall_goods');
		$where['state'] = 'true';
		$result = $table->where($where)->select();
		echo json_encode($result);		
        }	

	public function getAdverts()
	{
		$table = D('mall_advert');
		$where['state'] = 'true';
                $result = $table->where($where)->select();
                echo json_encode($result);
	}

	public function getConsume()
	{
		$table = D('mall_consume');
		$uuid = post('uuid');
		$where['uuid'] = $uuid;
		$result = $table
		->order("datetime desc")
		->where($where)
		->select();
		echo json_encode($result);
	}

	public function getExchange()
        {
                $table = D('mall_exchange');
                $uuid = post('uuid');
                $where['uuid'] = $uuid;
                $result = $table
		->join('cn_mall_goods on cn_mall_goods.id = cn_mall_exchange.goods_id')
		->where($where)
		->order("datetime desc")
		->select();
                echo json_encode($result);
        }

	public function exchange()
	{
		$uuid = post('uuid');
		$goods_id = post('goods_id');
		$address = post('address');
		$phone = post('phone');
		$name = post('name');
		$sum = post('sum');
		$datetime = currentTime();
		/*修改积分余额*/
		$table = D('user');
		$where['uuid'] = $uuid;
		$integral = $table->where($where)->select()[0]['integral'];
		$set['integral'] = redAsInt($integral,$sum);
		$table->where($where)->save($set);
		/*记录积分明细*/
		$table = D('mall_goods');
		$where['id'] = $goods_id;
		$goods_name = $table->where($where)->select()[0]['name'];
		$content = "兑换礼品：".$goods_name;
		$table = D('mall_consume');
		$record = array(
			'uuid' => $uuid, 'type' => $content, 'integral' => "-".$sum, 'datetime' => $datetime
		);
		addwithCheck($table,$record);
		/*增加兑换记录*/
		$table = D('mall_exchange');
		$record = array(
			'uuid' => $uuid, 'goods_id' => $goods_id, 'address' => $address, 'datetime' => $datetime,
			'phone' => $phone, 'name' => $name
		);
		addwithCheck($table,$record);
	
		$result['result_code'] = "1";
		echo json_encode($result);	
	}

	public function getAddList()
	{
		$uuid = post('uuid');
		$where['uuid'] = $uuid;
		$table = D('receiver_address');
		$result = $table->where($where)->select();
		echo json_encode($result);
	}

	public function getDefaultAdd()
	{
		$uuid = post('uuid');
		$state = 'default';
                $where['uuid'] = $uuid;
		$where['state'] = $state;
                $table = D('receiver_address');
                $result = $table->where($where)->select()[0];
                echo json_encode($result);
	}

	public function addAdd()
	{
		$uuid = post('uuid');
		$phone = post('phone');
		$name = post('name');
		$address = post('address');
		$state = 'usual';
		$add_id = get_uuid('add_');

		$record = array(
			'uuid' => $uuid, 'add_id' => $add_id, 'phone' => $phone, 'name' => $name,
			'address' => $address, 'state' => $state
		);
		$table = D('receiver_address');
		$result['result_code'] = addWithCheck($table,$record);
		//$result['result_code'] = $table->add($record);
		echo json_encode($result);
	}

	public function setDefaultAdd()
	{
		$uuid = post('uuid');
		$add_id = post('add_id');
		$where['uuid'] = $uuid;
		$where['add_id'] = $add_id;
		$set['state'] = 'default';
		$clear['state'] = 'usual';
		$table = D('receiver_address');
		$where1[''] = '1';
		$table->where($where1)->save($clear);
		$result['result_code'] = $table->where($where)->save($set);
		echo json_encode($result);
	}

	public function sign()
	{
		$uuid = post("uuid");
                $tip = "签到";
                $date = currentDate();
                $where['uuid'] = $uuid;
                $where['type'] = $tip;
                $where['datetime'] = array("like","%".$date."%");
                $count = D('mall_consume')->where($where)->count();
                if($count >= 1 )
                {
                        $result["result_code"] = "0";
                }
                else
                {
                        addIntegral(post('uuid'),$tip,'share');
                        $result["result_code"] = "1";
                        $result["reward"] = "20";
                }
                echo json_encode($result);
	
	}

	public function getIntegral()
	{
		$result['signed'] = "no";
		$uuid = post("uuid");
                $tip = "签到";
                $date = currentDate();
                $where['uuid'] = $uuid;
                $where['type'] = $tip;
                $where['datetime'] = array("like","%".$date."%");
                $count = D('mall_consume')->where($where)->count();
                if($count >= 1 )
                {
                        $result["signed"] = "yes";
                }

		$where_u['uuid'] = $uuid;
		$result['integral'] = D('user')->where($where_u)->select()[0]['integral'];
		echo json_encode($result);
		

	}

}
