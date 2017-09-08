<?php
	function get_rand($proArr)
	{   
		$result = '';    
		//概率数组的总概率精度   
		$proSum = array_sum($proArr);  
		//概率数组循环   
		foreach ($proArr as $key => $proCur)
		{   
			$randNum = mt_rand(1, $proSum);   
			if ($randNum <= $proCur) 
			{   
				$result = $key;   
				break;   
			} 
			else 
			{   
				$proSum -= $proCur;   
			}         
		}   
		unset ($proArr);    
		return $result;   	
	}   
	
	$prize_arr = array(   
		'0' => array( 'id' => 0, 'angle' => '0', 'prize' => '一等奖', 'v' => 1 ),   
		'1' => array( 'id' => 1, 'angle' => '60', 'prize' => '充电宝', 'v' => 1 ),   
		'2' => array( 'id' => 2, 'angle' => '120', 'prize' => '20元优惠卷', 'v' => 1 ),   
		'3' => array( 'id' => 3, 'angle' => '180', 'prize' => '洗护套装', 'v' => 1 ),   
		'4' => array( 'id' => 4, 'angle' => '240', 'prize' => '10元优惠卷', 'v' => 1 ),   
		'5' => array( 'id' => 5, 'angle' => '300', 'prize' => '小风扇', 'v' => 95 ),   
	); 
	
	foreach ($prize_arr as $key => $val)
	{   
		$arr[$val['id']] = $val['v'];   
	}

	$rid = get_rand($arr); //根据概率获取奖项id   
  
	$res['result'] = $prize_arr[$rid]; //中奖项
	
	echo json_encode($res);
	
?>
