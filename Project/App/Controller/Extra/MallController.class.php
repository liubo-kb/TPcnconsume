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
		$result = $table->where($where)->select();
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
		->select();
                echo json_encode($result);
        }

	public function exchange()
	{
		$uuid = post('uuid');
		$goods_id = post('goods_id');
		$address = post('address');
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
			'uuid' => $uuid, 'content' => $content, 'sum' => $sum, 'datetime' => $datetime
		);
		addwithCheck($table,$record);
		/*增加兑换记录*/
		$table = D('mall_exchange');
		$record = array(
			'uuid' => $uuid, 'goods_id' => $goods_id, 'address' => $address, 'datetime' => $datetime
		);
		addwithCheck($table,$record);
	
		$result['result_code'] = "1";
		echo json_encode($result);	
	}

}
