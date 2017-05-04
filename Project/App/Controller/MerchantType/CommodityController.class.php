<?php

/*
*       商户商品控制器
*         add() ：增加商品操作
*         del() ：删除商品操作
*         mod() ：修改商品操作
*         get() ：获取商品操作          
*/


namespace App\Controller\MerchantType;
use Think\Controller;
use App\Model\CommodityModel;
class CommodityController extends Controller 
{
	public function add()
	{
		$commodity = D('commodity');
		$merchant = post('muid');
		$name = post('name');
		$code = post('code');
		$price = post('price');
		$remain = post('remain');
		$image_url = post('image_url');

		$record = array(
			'merchant' => $merchant,'name' => $name,
			'number' => $code,'price' => $price,
			'remain' => $remain,'image_url' => $image_url,
		);		

		$result['result_code'] = $commodity ->addWithCheck($record);
		echo json_encode($result);
		 
	}

	public function del()
	{
		$merchant = post('muid');
		$code = post('code');
			
		$commodity = D('commodity');
		$where['merchant'] = $merchant;
		$where['number'] = $code;

		$result['result_code'] = $commodity->where($where)->delete();
		echo json_encode($result);
	}

	public function mod()
	{
		$merchant = post('muid');
                $name = post('name');
                $code = post('code');
                $price = post('price');
                $remain = post('remain');
		
		$ecode = post('ecode');

		
		$commodity = D('commodity');
		$where['merchant'] = $merchant;
                $where['number'] = $ecode;

               	$set = array(
                        'name' => $name,
                        'number' => $code,'price' => $price,
                        'remain' => $remain
                );


		$result['result_code'] = $commodity->where($where)->save($set);
		echo json_encode($result);

	}
	
	public function get()
	{
		$merchant = post('muid');
		$where['merchant'] = $merchant;	
		//$where['number'] = $code;
		
		$commodity = D('commodity');
		$result = $commodity
		//->join("cn_merchant ON cn_merchant.muid = cn_commodity.merchant")
		//->field("cn_commodity.*,cn_merchant.image_url")
		->where($where)
		->select();

		echo json_encode($result);
	}

	public function getInfo()
        {
                $merchant = post('muid');
                $code = post('code');
                $where['merchant'] = $merchant;
                $where['number'] = $code;

                $commodity = D('commodity');
                $result = $commodity
                ->where($where)
                ->select();

                echo json_encode($result);
        }


}
