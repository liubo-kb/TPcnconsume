<?php

/*
*         搜索控制器
*	  get() ：查询操作
*/


namespace App\Controller\MerchantType;
use Think\Controller;

class SearchController extends Controller 
{
	public function get()
	{
		$eare = post('eare');
		$trade = post('trade');
		$index = post('index');
		$page_num = '10';

		//$eare = '雁塔区';
		//$trade = '美发';
		//$index = "1";

		$page = $index.",".$page_num;

		$where['address'] = array("like","%$eare%");
		$where['trade'] = array("like","%$trade%");
		$where['state'] = 'true';

		$data = showDataGet($where,$page);
		
		//dump($data);
		echo json_encode($data);
	}

	public function multiGet()
	{
		$eare = post('eare');
                $trade = post('trade');


		//$eare = "西安市雁塔区";
		//$trade = "美发";               

		/*广告区域*/
		$table = D('advert_near_list');
                $address = $eare;
                $state = "ONLINE";

                $where['cn_advert_near_list.address'] = array("like","%".$address."%");
		$where['trade'] = array("like","%".$trade."%");
                //$where['state'] = $state;

                $count = $table
		->where($where)
		->join("cn_merchant on cn_merchant.muid = cn_advert_near_list.muid")
		->count();

                $list = $table
                ->where($where)
		->join("cn_merchant on cn_merchant.muid = cn_advert_near_list.muid")
		->field('cn_advert_near_list.*')
                ->order('position asc')
                ->select();

                $result = array();
		$muidArray = array();
                for($i=0; $i<$count; $i++)
                {
                        $where_c['muid'] = $list[$i]['muid'];
			$muidArray[$i] = $list[$i]['muid'];
                        $result['advert'][$i]['para'] = $list[$i];
                        $result['advert'][$i]['info'] = showDataGet($where_c,"1,20");
                }

		//dump($muidArray);	
		
		/*线上商户区域*/

                $where_m['address'] = array("like","%$eare%");
                $where_m['trade'] = array("like","%$trade%");
		$where_m['state'] = 'true';
		//$where_m['muid'] = array("not in",$muidArray);
                $result['merchant'] = showDataGet($where_m,"1,10");
	
		//dump($result);	
                echo json_encode($result);
	
	}
}
