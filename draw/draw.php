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
		'0' => array( 'id' => 0, 'angle' => '0', 'prize' => '再来一次', 'v' => 1 ),   
		'1' => array( 'id' => 1, 'angle' => '45', 'prize' => '相机一部', 'v' => 1 ),   
		'2' => array( 'id' => 2, 'angle' => '90', 'prize' => 'iphone6s一部', 'v' => 1 ),   
		'3' => array( 'id' => 3, 'angle' => '135', 'prize' => '￥50元代金券', 'v' => 1 ),   
		'4' => array( 'id' => 4, 'angle' => '180', 'prize' => '耳机一部', 'v' => 1 ),   
		'5' => array( 'id' => 5, 'angle' => '225', 'prize' => '￥30元代金券', 'v' => 93 ),
		'6' => array( 'id' => 6, 'angle' => '270', 'prize' => '手表一块', 'v' => 1 ),   
		'7' => array( 'id' => 7, 'angle' => '315', 'prize' => '咖啡机一台', 'v' => 1 ),   
	); 
	
	foreach ($prize_arr as $key => $val)
	{   
		$arr[$val['id']] = $val['v'];   
	}

	$rid = get_rand($arr); //根据概率获取奖项id   
  
	$res['result'] = $prize_arr[$rid]; //中奖项
	
	echo json_encode($res);
	
?>
