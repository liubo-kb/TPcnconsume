<?php
namespace App\Controller\UserType;
use Think\Controller;
class SearchController extends Controller 
{
	public function getHotSearch()
	{
		$result['hot_search'] = array("商消乐","美容","美发","养发","美甲","母婴","足疗","KTV");
		echo json_encode($result);
	}
}
