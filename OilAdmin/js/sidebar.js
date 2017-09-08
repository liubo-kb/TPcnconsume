$(document).ready(function(){
	
	/* 办卡记录 */
	//表格记录
	$("#buy-table").click(function(){
		$("#title").html("数据统计");
		$("#sub-title").html("办卡记录");
		$("#header-tip").html("");
		$("#content").load("html/buy-table.html");
	});
	//图表
	$("#buy-chart").click(function(){
		$("#title").html("数据统计");
		$("#sub-title").html("办卡记录");
		$("#tip").html("统计图表");
		$("#sub-tip").html("本日");
		var chartList = "<div class='line-chart-box'><div id='line' class='line-chart-bg'></div></div>";
		$("#content").html(chartList);
		var selectList = "<span id='tip'>办卡数据：</span>"+
						 "<select name='select-date' id='select-date' style='width:120px;height:auto;font-size:14px'>"+
								"<option>本日</option>"+
								"<option selected='selected'>本月</option>"+
								"<option>本年</option>"+
						"</select>"+
						"<span id='tip' style='margin-left:150px'>共计金额：</span>"+
						"<span id='tip' style='color:#f00'>16000元<span>";
		$("#header-tip").html(selectList);
		
		
		loadChartBuy();
		//loadChartBar01();
		//loadChartBar02();
		//loadChartPie();
	});
	
	/*	充值记录	*/
	$("#reg-table").click(function(){
		$("#title").html("数据统计");
		$("#sub-title").html("充值记录");
		$("#tip").html("充值记录");
		$("#sub-tip").html("本日");
		$("#header-tip").html("");
		$("#content").load("html/reg-table.html");
		
	});
	
	$("#reg-chart").click(function(){
		$("#title").html("数据统计");
		$("#sub-title").html("充值记录");
		$("#tip").html("统计图表");
		$("#sub-tip").html("本日");
		var chartList = "<div class='line-chart-box'><div id='line' class='line-chart-bg'></div></div>";
		$("#content").html(chartList);
		
		
		var selectList = "<span id='tip'>充值数据：</span>"+
						 "<select name='select-date' id='select-date' style='width:120px;height:auto;font-size:14px'>"+
								"<option>本日</option>"+
								"<option selected='selected'>本月</option>"+
								"<option>本年</option>"+
						"</select>"+
						"<span id='tip' style='margin-left:150px'>共计金额：</span>"+
						"<span id='tip' style='color:#f00'>230000元<span>";
		$("#header-tip").html(selectList);
		
		loadChartReg();
		
	});
	
	/*	加油记录	*/
	$("#consum-chart").click(function(){
		$("#title").html("数据统计");
		$("#sub-title").html("加油记录");
		$("#tip").html("统计图表");
		$("#sub-tip").html("本日");
		var chartList = "<div class='line-chart-box'><div id='line' class='line-chart-bg'></div></div>"+
						"<div class='bar02-chart-box'><div id='bar02' class='bar02-chart-bg'></div></div>"+
						"<div class='bar01-chart-box'>"+
							"<div id='bar01' class='bar01-chart-bg'></div>"+
							"<div id='pie' class='pie-chart-bg'></div>"+
						"</div>";
		$("#content").html(chartList);
		
		
		var selectList = "<span id='tip'>营业数据：</span>"+
						 "<select name='select-date' id='select-date' style='width:120px;height:auto;font-size:14px'>"+
								"<option>本日</option>"+
								"<option selected='selected'>本月</option>"+
								"<option>本年</option>"+
						"</select>"+
						"<span id='tip' style='margin-left:150px'>共计金额：</span>"+
						"<span id='tip' style='color:#f00'>18000000元<span>";
		$("#header-tip").html(selectList);
		
		loadChartConsum();
	});
	
	$("#consum-table").click(function(){
		$("#title").html("数据统计");
		$("#sub-title").html("加油记录");
		$("#header-tip").html("记录详情");
		$("#content").load("html/consum-table.html");
	});
	
	/*	客户分析	*/
	$("#member").click(function(){
		$("#title").html("数据统计");
		$("#sub-title").html("客户分析");
		$("#tip").html("客户分析");
		$("#sub-tip").html("本日");
		
		$("#header-tip").html("");
		$("#content").html("客户分析");
	});
	
	
	
	/*	创建加油卡	*/
	$("#card-create").click(function(){
		$("#title").html("油卡管理");
		$("#sub-title").html("创建油卡");
		$("#tip").html("创建油卡");
		$("#header-tip").html("创建油卡");
		$("#content").load("html/card-create.html");
	});
	
	
});
