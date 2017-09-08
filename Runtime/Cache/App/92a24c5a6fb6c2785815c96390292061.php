<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</head>
<body>

    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="bar02" style="height:350px">
	</div>
    <!-- ECharts单文件引入 -->
    <script src="/cnconsum/Public/js/chart/echarts-all.js"></script>
    <script src="/cnconsum/Public/js/chart/chart.js"></script>
	<script>
		//各分站加油量
		var bar02Line = "各渠道营业分布";
		var bar02XAx = new Array(
			<?php echo ($data["card_buy"]["sum"]); ?>, <?php echo ($data["card_renew"]["sum"]); ?>, <?php echo ($data["card_upgrade"]["sum"]); ?>
		);
		var bar02YAx = new Array(
			'办卡','续卡','升级'
		);
		loadChartBar02(bar02Line,bar02XAx,bar02YAx);
	</script>
</body>