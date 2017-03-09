<?php
namespace App\Controller\MerchantType;
use Think\Controller;
class IndexController extends Controller 
{
	public function index()
	{
		echo '商户端控制器--索引';
		$year = date('Y',time());
		$date_start = $year.""
	}	
}
