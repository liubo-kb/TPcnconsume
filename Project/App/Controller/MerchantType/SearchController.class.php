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

		$data = showDataGet($where,$page);
		
		//dump($data);
		echo json_encode($data);
	}
}
