<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<title>hello <?php echo ($name); ?></title>
	</head>

	<body>
		
		<!--  循环输出 -->
		<?php if(is_array($person)): $i = 0; $__LIST__ = array_slice($person,0,4,true);if( count($__LIST__)==0 ) : echo "没有数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; echo ($data['name']); ?>------<?php echo ($data['age']); ?><br/><?php endforeach; endif; else: echo "没有数据" ;endif; ?>
		<br/>


		<!--<?php $__FOR_START_2095547094__=1;$__FOR_END_2095547094__=10;for($k=$__FOR_START_2095547094__;$k <= $__FOR_END_2095547094__;$k+=1){ echo ($k); ?><br/><?php } ?>-->

		<!--  条件语句 -->
		<?php if($num > 10): ?>num 大于10
		<?php elseif($num < 10): ?> num 小于10
		<?php else: ?> num 等于10<?php endif; ?>		
		<br/>
	

		<!--  switch语句 -->
		<?php switch($num): case "10": ?>数字10<?php break;?>
			<?php case "20": ?>数字20<?php break;?>
			<?php case "30": ?>数字30<?php break;?>
			<?php default: ?>默认数字<?php endswitch;?>	
		<br/>

		<!--  比较 -->
		<?php if(($num) == "10"): ?>num = 10
			<?php else: ?> num = <?php echo ($num); endif; ?>

		<br/>

		<?php if(($num) == "10"): ?>num eq 10
		<?php else: ?>num eq <?php echo ($num); endif; ?>
		</br>
		
		<!--  区间 -->
		<?php if(in_array(($num), explode(',',"10,20,30"))): ?>在这个区间
		<?php else: ?>不在这个区间<?php endif; ?>
		<br/>

		<?php $_RANGE_VAR_=explode(',',"10,30");if($num>= $_RANGE_VAR_[0] && $num<= $_RANGE_VAR_[1]):?>在10-30之间
		<?php else: ?>不在10-30之间<?php endif; ?>
	
	</body>
</html>