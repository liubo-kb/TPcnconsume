
//办卡的图表
function loadChartBuy()
{
	var title = "8月办卡数据";
	var dataXAx = new Array(
		"8/1","8/2","8/3","8/4","8/5","8/6","8/7","8/8","8/9","8/10","8/11","8/12","8/13","8/14",
		"8/15","8/16","8/17","8/18","8/19","8/20","8/21","8/22","8/23","8/24","8/25","8/26","8/27","8/28"
	);
	var dataYAx = new Array(
		2000,3000,1880,1110,457,2220,5609,1099,222,3445,213,4545,657,2222,3232,1222,2323,543,1232,2432,5454,1232,1232,3434,2321,682,2134	
	);
	loadChartLine(title,dataXAx,dataYAx);
}

//充值的图表
function loadChartReg()
{
	var title = "8月充值数据";
	var dataXAx = new Array(
		"8/1","8/2","8/3","8/4","8/5","8/6","8/7","8/8","8/9","8/10","8/11","8/12","8/13","8/14",
		"8/15","8/16","8/17","8/18","8/19","8/20","8/21","8/22","8/23","8/24","8/25","8/26","8/27","8/28"
	);
	var dataYAx = new Array(
		200,300,180,110,157,220,609,99,2222,445,2213,445,6572,222,322,2222,223,5423,1232,232,454,232,2232,344,2321,6282,234	
	);
	loadChartLine(title,dataXAx,dataYAx);
}

//加油的图表
function loadChartConsum()
{
	//总加油量
	var titleLine = "8月加油数据";
	var lineXAx = new Array(
		"8/1","8/2","8/3","8/4","8/5","8/6","8/7","8/8","8/9","8/10","8/11","8/12","8/13","8/14",
		"8/15","8/16","8/17","8/18","8/19","8/20","8/21","8/22","8/23","8/24","8/25","8/26","8/27","8/28"
	);
	var lineYAx = new Array(
		20010,3020,18990,11210,4257,22220,51609,10299,2122,3445,2113,41545,6157,1222,1232,12222,2123,1543,1212,1432,2454,1212,12232,1434,1321,2821,2134	
	);
	loadChartLine(titleLine,lineXAx,lineYAx);
	
	//各油号加油量
	var bar01Line = "各油号8月销量";
	var bar01XAx = new Array(
		'95#','92#','0#柴油','-10#柴油','润滑油'
	);
	var bar01YAx = new Array(
		8000, 7000, 2300, 3300, 1000
	);
	loadChartBar01(bar01Line,bar01XAx,bar01YAx);
	
	//各分站加油量
	var bar02Line = "各分站8月销量";
	var bar02XAx = new Array(
		18203, 23489, 29034, 104970, 131744, 630230
	);
	var bar02YAx = new Array(
		'科技二路站','富鱼路站','沣惠南路站','科创路站','电子二路站','小寨路站'
	);
	loadChartBar02(bar02Line,bar02XAx,bar02YAx);
	
	//各渠道加油量
	var pieLine = "各渠道8月销量";
	var pieData = new Array(
		{value:335, name:'一键加油'},
		{value:650, name:'油卡支付'}
	);
	loadChartPie(pieLine,pieData);
}

//曲线图
function loadChartLine( title, dataXAx, dataYAx )
{
	var myChart = echarts.init(document.getElementById('line')); 

	var option = {
		title : {
			text: title,
			subtext: '数据来自商消乐'
		},
		tooltip : {
			trigger: 'axis'
		},
		color : ["#45b97c",],
		legend: {
			show:false,
			data:['8月营业总额',],
			textStyle:{
				color:"#45b97c",
			},
		},
		
		grid:{
			show:true,
		},
		toolbox: {
			show : false,
			feature : {
				mark : {show: true},
				dataView : {show: true, readOnly: false},
				magicType : {show: true, type: ['line', 'bar']},
				restore : {show: true},
				saveAsImage : {show: true}
			}
		},
		calculable : true,
		xAxis : [
			{
				show : true,
				type : 'category',
				boundaryGap : false,
				data : dataXAx,
				axisLine:{
					lineStyle:{
						type:'sold',
						color:'#fff',
						width:'0',
					}
				},
				axisLabel:{
					textStyle:{
						color:'#333',
					}
				},
				axisTick:
				{
					show:false,
				}
			}
		],
		yAxis : [
			{
				type : 'value',
				axisLabel : {
					formatter: '{value} ￥'
				},
				axisLabel:{
					textStyle:{
						color:'#e0861a',
					}
				},
				
			}
		],
		series : [
			{
				name:'营业额',
				type:'line',
				smooth:"true",
				data:dataYAx,
				itemStyle : {
					normal : { borderColor:"#45a07c",shadowColor:"#fff"}
				},
				markPoint : {
					data : [
						{type : 'max', name: '峰值'},
						{type : 'min', name: '谷值'}
					]
				},
				markLine : {
					data : [
						{type : 'average', name: '均值'}
					]
				},
			},
		],
		backgroundColor : ["#FdFdFd"],
		
	};

	// 为echarts对象加载数据 
	myChart.setOption(option); 
}

//横向条形图
function loadChartBar01( title, dataXAx, dataYAx )
{
	// 基于准备好的dom，初始化echarts图表
	var myChart = echarts.init(document.getElementById('bar01')); 

	var option = {
		title : {
		text: title,
		subtext: '数据来自商消乐'
		},
		tooltip : {
			trigger: 'axis'
		},
		legend: {
			show:false,
			data:['各油号8月销量',]
		},
		toolbox: {
			show : false,
			feature : {
				mark : {show: true},
				dataView : {show: true, readOnly: false},
				magicType : {show: true, type: ['line', 'bar']},
				restore : {show: true},
				saveAsImage : {show: true}
			}
		},
		calculable : true,
		xAxis : [
			{
				type : 'category',
				data : dataXAx,
				axisLine:{
					lineStyle:{
						type:'sold',
						color:'#fff',
						width:'0',
					}
				},
				axisLabel:{
					textStyle:{
						color:'#333',
					}
				},
				axisTick:
				{
					show:false,
				}
			}
		],
		yAxis : [
			{
				type : 'value'
			}
		],
		series : [
			{
				name:'销量',
				type:'bar',
				data:dataYAx,
				markPoint : {
					data : [
						{type : 'max', name: '最大值'},
						{type : 'min', name: '最小值'}
					]
				},
				markLine : {
					data : [
						{type : 'average', name: '平均值'}
					]
				}
			},
		]
		
	};

	// 为echarts对象加载数据 
	myChart.setOption(option); 
}

//纵向条形图
function loadChartBar02( title, dataXAx, dataYAx )
{
	// 基于准备好的dom，初始化echarts图表
	var myChart = echarts.init(document.getElementById('bar02')); 
	
	var option = {
		title : {
			text : title,
			subtext: '数据来自商消乐'
		},
		tooltip : {
			trigger: 'axis'
		},
		legend: {
			show:false,
			data:['各分站8月营业额', ]
		},
		toolbox: {
			show : false,
			feature : {
				mark : {show: true},
				dataView : {show: true, readOnly: false},
				magicType: {show: true, type: ['line', 'bar']},
				restore : {show: true},
				saveAsImage : {show: true}
			}
		},
		calculable : true,
		xAxis : [
			{
				type : 'value',
				boundaryGap : [0, 0.01],
				axisLine:{
					lineStyle:{
						type:'sold',
						color:'#fff',
						width:'0',
					}
				},
				axisLabel:{
					textStyle:{
						color:'#333',
					}
				},
				axisTick:
				{
					show:false,
				}
				
			}
		],
		yAxis : [
			{
				type : 'category',
				data : dataYAx
			}
		],
		series : [
			{
				name:'营业额',
				type:'bar',
				barWidth:40,
				data:dataXAx
			},
		]
		
	};

	// 为echarts对象加载数据 
	myChart.setOption(option); 
}

//饼状图
function loadChartPie( title, data )
{
	// 基于准备好的dom，初始化echarts图表
	var myChart = echarts.init(document.getElementById('pie')); 

	var option = {
		title : {
			text: title,
			subtext: '数据来自商消乐',
			x:'center'
		},
		tooltip : {
			trigger: 'item',
			formatter: "{a} <br/>{b} : {c} ({d}%)"
		},
		legend: {
			orient : 'vertical',
			x : 'left',
			data:['一键加油','油卡支付',]
		},
		toolbox: {
			show : false,
			feature : {
				mark : {show: true},
				dataView : {show: true, readOnly: false},
				magicType : {
					show: true, 
					type: ['pie', 'funnel'],
					option: {
						funnel: {
							x: '25%',
							width: '50%',
							funnelAlign: 'left',
							max: 1548
						}
					}
				},
				restore : {show: true},
				saveAsImage : {show: true}
			}
		},
		calculable : true,
		series : [
			{
				name:'渠道营收',
				type:'pie',
				radius : '55%',
				center: ['50%', '60%'],
				data:data
			}
		]
		
	};

	// 为echarts对象加载数据 
	myChart.setOption(option); 
}
	
//加载时间选择器
function loadPicker()
{
	$("#datepicker").datepicker();
}
