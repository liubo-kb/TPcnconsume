<?php
namespace App\Controller\Extra;
use Think\Controller;
class AddressController extends Controller 
{
	public function index()
	{
		echo '地址控制器索引';
	}
	
	public function getProvince()
	{
		$table = D('address');
		$where['level'] = '1';
		$result = $table->where($where)->select();
		//dump($result);
		echo json_encode($result);
	}

	public function getCity()
        {
                $table = D('address');
		$proId = post('pro_id');
		if($proId != "null")
		{
			$where['parentid'] = $proId;
		}
                $where['level'] = '2';
                $result = $table->where($where)->select();
                //dump($result);
                echo json_encode($result);
        }

	public function getDistrict()
        {
                $table = D('address');
		$cityId = post('city_id');
                $where['parentid'] = $cityId;
                $where['level'] = '3';
                $result = $table->where($where)->select();
                //dump($result);
                echo json_encode($result);
        }

	public function getStreet()
        {
                $table = D('address');
		$districtId = post('district_id');
                $where['parentid'] = $streetId;
                $where['level'] = '4';
                $result = $table->where($where)->select();
                //dump($result);
                echo json_encode($result);
        }
	
}
