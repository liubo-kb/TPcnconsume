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
			$where['parentId'] = $proId;
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
                $where['parentId'] = $cityId;
                $where['level'] = '3';
                $result = $table->where($where)->select();
                //dump($result);
                echo json_encode($result);
        }
	
	public function getStreet()
        {
                $table = D('address');
		$streetId = post('district_id');
                $where['parentId'] = $streetId;
                $where['level'] = '4';
                $result = $table->where($where)->select();
                //dump($result);
                echo json_encode($result);
        }

	public function getCodeByName()
	{
		$table = D('address');
		$name = post('name');
		//$name = '西安市';
		$where['name'] = $name;
		$result = $table->where($where)->select();
		echo json_encode($result);
	}
	
}
