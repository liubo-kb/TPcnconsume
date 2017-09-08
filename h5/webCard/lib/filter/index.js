var fter = angular.module('app.filters',['ionic']);


/*******************************************商铺详情************************************/


//会员卡类别过滤
fter.filter('cardTypeStr',function(){
	return function(obj){
		if(obj.type == "计次卡"){
			var newStr = obj.rule+"次"
			return newStr
		}else if(obj.type == "体验卡"){
			return 
		}else if(obj.type == "套餐卡"){
			return
		}else if(obj.type == "储值卡"){
			var newStr = obj.rule/10+"折"
			return newStr
		}
	}
})

//会员卡使用日期过滤

fter.filter('cardDateStr',function(){
	return function(str){
		
		if(str == '0'){
			return "无期限"
		}else if(str == '0.5'){
			return "半年"
		}else if(str == '1'){
			return "一年"
		}else if(str == '2'){
			return "两年"
		}else if(str == '3'){
			return "三年"
		}
		
	}
})


/********************************************我的消费************************************/

fter.filter('strSubName',function(){
	return function(str){
		var a = str.indexOf('■');
    	var b = str.substring(0,a);
    	return b;
	}
})

fter.filter('strSubStyle',function(){
	return function(str){
    	var c = str.lastIndexOf('♥');
		var d = str.substring(c-5,c-1);
		return d;
	}
})


fter.filter('strSubSumName',function(){
	return function(str){
    	var c = str.indexOf('■');
		var d = str.substring(c+2,c+6);
		
		if(d == "结算次数"){
			return "计次数量"
		}else{
			return "付款金额"
		}
	}
})

//套餐卡：项目名称

fter.filter('strItemName',function(){
	return function(str){
    	var c = str.indexOf('♥');
    	var d = str.indexOf('★')
		var e = str.substring(c+2,d);
		
		return e;
	}
})


fter.filter('strSubMon',function(){
	return function(str){
		var c = str.indexOf('■');
		var d = str.substring(c+2,c+6);
		var e = str.lastIndexOf('♥');
		var f = str.substring(e+1);
		
		
		if(d == "结算次数"){
			return f+'次'
		}else{
			var newStr = Number(f).toFixed(2)+'元'
			return newStr
		}
		
	}
})

fter.filter('strSubState',function(){
	return function(str){
		if(str=="true"){
			var g = "支付成功"
			return g;
		}

	}
})

fter.filter('strSubUnit',function(){
	return function(str){
    	var c = str.lastIndexOf('♥');
		var d = str.substring(c-5,c-1);
		if(d == "结算金额"){
			return '元'
		}

		if(d == "结算次数"){
			return "次"
		}
	}
})

fter.filter('strSubCard',function(){
	return function(str){
    	var c = str.indexOf('■');
		var d = str.substring(c+2,c+6);
		
		if(d == "结算金额"){
			return '储值卡支付'
		}else if(d == "项目名称"){
			return '套餐卡支付'
		}else if(d == "结算次数"){
			return "计次卡支付"
		}

	}
})


fter.filter('dataCardStyle',function(){
	return function(str){
    	var c = str.lastIndexOf('■');
		var d = str.substring(c+1,c+5);
		
		if(d == "结算金额"){
			return "储值卡"
		}else if(d == "结算次数"){
			return "计次卡"
		}else if(d == "项目名称"){
			return "套餐卡"
		}
	}
})


fter.filter('dataCardInfo',function(){
	return function(str){
    	var cardContent = str.content;
    	var c = cardContent.lastIndexOf('■');
		var d = cardContent.substring(c+1,c+5);
		
		if(d == "结算金额"){
//			var beforePrice = Number(str.sum).toFixed(2);
//			var newStr = "原价:"+beforePrice;
			return;
			
		}else if(d == "结算次数"){
			return "美甲"
			
		}else if(d == "项目名称"){
			var a = cardContent.indexOf('♥')
			var b = cardContent.indexOf('★')
			var e = cardContent.substring(a+2,b);
			var newStr = e+"1次";
			return newStr;
		}
	}
})


fter.filter('dataNowPrice',function(){
	return function(str){
    	var cardContent = str.content;
    	var c = cardContent.lastIndexOf('■');
		var d = cardContent.substring(c+1,c+5);
		
		if(d == "结算金额"){
			var aIndex = cardContent.lastIndexOf('♥');
			var strIndex = cardContent.substring(aIndex+1);
			var nowPrice = Number(strIndex).toFixed(2);
			var newStr = "现价:"+nowPrice;
			return newStr;
			
		}else if(d == "结算次数"){
			return ""
			
		}else if(d == "项目名称"){
			return "";
		}
	}
})

fter.filter('dataResult',function(){
	return function(str){
		//截取字符串，判断卡类别
    	var c = str.lastIndexOf('■');
		var d = str.substring(c+1,c+5);
		//截取消费金额
		var e = str.lastIndexOf('♥');
		var strResult = str.substring(e+1);
		var numResult = Number(strResult).toFixed(2);
		
		if(d == "结算金额"){
			var newStr = numResult+"元";
			return newStr
		}else if(d == "结算次数"){
			var newStr = strResult+"次";
			return newStr
		}else if(d == "项目名称"){
			var newStr = "1项";
			return newStr
		}
	}
})


fter.filter('dataState',function(){
	return function(str){
    	if(str == "false"){
    		return "评价"
    	}else if(str == "true"){
    		return "已评价"
    	}
	}
})



fter.filter('strItem',function(){
	return function(str){
    	var c = str.indexOf('♥');
    	var d = str.indexOf('★')
    	var e = str.substring(c+2,d);
    	console.log(e);
    	
		
	}
})




/**************************************登录状态************************************/

fter.filter('strSubNickName',function(){
	return function(str){

		if(str){
			return str
		}else{
			return "未登录"
		}

	}
})


fter.filter('disFilter',function(){
	return function(str){
    	if(str == null){
			var spt="暂无折扣!"
			return spt

		}else if(str == "100"){
			var sale=0;
			return sale;
    	}else{

			var newStr = (str*0.1).toFixed(1)+"折"
			return newStr
		}

	}
})



fter.filter('strSubImg',function(){

	return function(str){

		if(str=="未设置"){
			return "had.png"
		}else if(str==""){
			return "had.png"
		}else if(str == null){
			return "had.png"
		}else{
			return str
		}
	}
})

fter.filter('cardRebate',function(){

	return function(str){
		if(str.card_type == "储值卡"){
			var rebate = str.rule/10+'折';
			return rebate;
		}else if(str.card_type == "计次卡"){
			var newStr=""
			return newStr;
		}
	}
})




fter.filter('cardCount',function(){

	return function(str){
		if(str.card_type == "储值卡"){
			str.card_remain;
			return str.card_remain
		}else if(str.card_type == "计次卡"){
			var count = Math.floor(str.card_remain/(str.price/str.rule));
			return count;
		}
	}
})


fter.filter('dateStr',function(){
	return function(str){
		
		var d = str.substr(0,10);
		
		return d;
	}
})

fter.filter('couShow',function(){
	return function(str){
		console.log(str)
		if(str == null){
			var newStr=""
			return newStr
		}else{
			var show=str+'元优惠券'
			return show;
		}

	}
})


fter.filter('showSum',function(){
	return function(str){
		console.log(str)
		if(str == null){
			return '无可用'
		}else{
			return str;
		}

	}
})

fter.filter('introStr',function(){
	return function(str){
		if(str==null){
			var init='暂无介绍！';
			return init
		}else{
			if(str==""){
				var init='暂无介绍！';
				return init
			}else{
				return str
			}
		}
	}
})


fter.filter('newStar',function(){
	return function(str){
    	var newStar = Math.floor(str);
		return newStar;
	}
})

fter.filter('numStr',function(){
	return function(str){
		var newStr = str.substr(str.length-4);
		return newStr;
	}
})

fter.filter('merName',function(){
	return function(str){
		if(str == null){
			var newStr = "未知"
			return newStr
		}else{
			return str
		}
	}
})



fter.filter('merState',function(){
	return function(str){
		if(str == "Auditing"){
			var newStr = "审核中！"
			return newStr
		}else if(str == "ONLINE"){
			var newStr = "已上线！"
			return newStr
		}
	}
})

fter.filter('unique', function () {
        return function (collection, keyname) {
            var output = [],
                keys = [];
            angular.forEach(collection, function (item) {
                var key = item[keyname];
                if (keys.indexOf(key) === -1) {
                    keys.push(key);
                    output.push(item);
                }
            });
            return output;
        }
});


fter.filter('merName',function(){
	return function(str){
		if(str == null){
			var newStr = "未知"
			return newStr
		}else{
			return str
		}
	}
})


//百度地图计算距离

fter.filter('numRang',function(){
	return function(str){
		var pointLongA = localStorage.getItem('pointLong');
		var pointLatA = localStorage.getItem('pointLat');
		var pointLongB = str.longtitude;
		var pointLatB = str.latitude;

		//创建地图
		var map = new BMap.Map("allMap");
		var pointA = new BMap.Point(pointLongA,pointLatA);
		var pointB = new BMap.Point(pointLongB,pointLatB);
		var distance = (map.getDistance(pointA,pointB)/1000).toFixed(2);
	    return distance;
	}
})





fter.filter("strRang",function(){
	return function(str){
		if(parseInt(str)>1000){
			var newStr = Number(str/1000).toFixed(2)+"km";
			return newStr;
		}else{
			var newStr = parseInt(str)+"m";
			return newStr;
		}
	}
})


//过滤集合
app.filter('staticDistance', function () {
	return function (input) {
//		console.log(input)
		var pointLongA = localStorage.getItem('pointLong');
		var pointLatA = localStorage.getItem('pointLat');
		var out = [];

	angular.forEach(input, function (str) {

		var pointLongB = str.longtitude;
		var pointLatB = str.latitude;

		//创建地图
		var map = new BMap.Map("allMap");
		var pointA = new BMap.Point(pointLongA,pointLatA);
		var pointB = new BMap.Point(pointLongB,pointLatB);
		var distance = (map.getDistance(pointA,pointB)/1000).toFixed(2);

		str.distance = distance;

		out.push(str);
	});
		return out;
   }

});

//领取优惠券状态判断

fter.filter('stateShow',function(){
	return function(str){
		if(str == "true"){
			var newStr = "已领取"
			return newStr
		}else if(str == "false"){
			var newStr = "领取"
			return newStr
		}
	}
})


//储值卡，计次卡包含项目说明过滤

fter.filter("cardItem",function(){
	return function(str){
		if(str == "储值卡"){
			var newStr = "店内项目可使用会员卡任意消费。"
			return newStr
		}else if(str == "计次卡"){
			var newStr = "计次卡用完为止。"
			return newStr
		}
	}
})


//套餐卡，体验卡有效期说明过滤

fter.filter("cardContent",function(){
	return function(str){
		if(str == "套餐卡"){
			var newStr = "长期有效,套餐用完为止。"
			return newStr
		}else if(str == "体验卡"){
			var newStr = "仅使用一次,长期有效。"
			return newStr
		}
	}
})

/************************会员卡投诉理赔状态************************/

fter.filter("claimState",function(){
	return function(str){
		if(str == null){
			return ""
		}else if(str == "COMMITTED"){
			var newStr = "处理中"
			return newStr
		}else if(str == 'CHECK_FAILED'){
			var newStr = "核查失败"
			return newStr
		}else if(str == "ACCESS"){
			var newStr = "处理成功"
			return newStr
		}
	}
})


/****************************积分商城*************************/


fter.filter("markFont",function(){
	return function(str){
		if(str == "true"){
			return "立即使用"
		}else if(str == "false"){
			return "立即领取"
		}
	}
})


fter.filter("inteState",function(){
	return function(str){
		if(str == null){
			return 0
		}else{
			return str
		}
	}
})


