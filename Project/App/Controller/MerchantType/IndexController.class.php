<?php
namespace App\Controller\MerchantType;
use Think\Controller;
class IndexController extends Controller 
{
	public function index()
	{
		$date1 = "2017-05-01";
                $date2 = "2017-05-02";
	
		if ( dateComp($date1,$date2) )
		{
			echo "true";
		}
		else
		{
			echo "false";
		}
	}
}
