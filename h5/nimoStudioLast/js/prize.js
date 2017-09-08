
var rotateFunc = function(awards, angle, text) { //awards:奖项，angle:奖项对应的角度
	$('#i_bg').stopRotate();
	$("#i_bg").rotate({
		angle: 0,
		duration: 3000,
		animateTo: angle + 1440, //angle是图片上各奖项对应的角度，1440是我要让指针旋转4圈。所以最后的结束的角度就是这样子^^
		callback: function() {
			//$(".prizeButton").removeClass("disabled");
			$(".prizeButton").css("background","#82BAFF")
			$(".mask").show();
			$(".prize_img").attr("src",text);
			if((awards==0001)||(awards==0002)){
				$(".prize_txt").attr("src","../img/prizeSandengjiang.png");
			}else if((awards==0003)||(awards==0004)||(awards==0005)){
				$(".prize_txt").attr("src","../img/prizeErdengjiang.png");
			}else{
				$(".prize_txt").attr("src","../img/prizeYidengjiang.png");
			}
		}
	});
};


$(".prizeButton").click(function(){
	$(".mask").show();
});
$("#i_con").click(function(){
	//rotateFunc(360);
	$(this).addClass("disabled");
	get_prize();
	
});
$(".prizeClose").click(function(){
	$(".mask").hide();		
});


/****获取商品列表****/
get_goodslist();
function get_goodslist(){
	$.post(
		'../../../App/Extra/game/getAwardList',
		function(data){ 
			var da=eval("("+data+")");
			console.log(da);
			var oImg=$("ul li img");
			var otxt=$("ul li dd");
			console.log(otxt)
			for(var i=0;i<da.length;i++){
				oImg[da.length-1-i].src=da[i].image;
				otxt[da.length-1-i].innerHTML=da[i].name;
			}
			
		}
	);
}

/*******获取奖品***/
get_prize();
function get_prize(){
	var uuid=localStorage.getItem("uuid");
	$.post(
		'../../../App/Extra/game/getResult',
		{"uuid":uuid},
		function(data){ 
			var da=eval("("+data+")");
			console.log(da)
			var angle=Number(da.result.angle);
			rotateFunc(da.result.id, angle, da.result.image_tm)
		}
	);
}


/***获取中奖列表***/
get_parizeList();
function get_parizeList(){
	$.get(
		'../../../App/Extra/game/getWinnerList',
		function(data){ 
			var da=eval("("+data+")");
			console.log(da)
			app_data(da);
			is_prize(da);
		}
	);
}

/***给页面添加数据***/

function app_data(obj){
	var a;
	for(var i=0;i<obj.length;i++){
		if((obj[i].id==0001)||(obj[i].id==0002)){
				a="三等奖"
			}else if((obj[i].id==0003)||(obj[i].id==0004)||(obj[i].id==0005)){
				a="二等奖";
			}else{
				a="一等奖";
			}
		$("#prize_list_con").append(
			'<div class="prizeNameList">'+
					'<div class="name">'+
						'<div class="nameImg">'+
							'<img src="../img/prizeTouxiang.png" alt="" />'+
						'</div>'+
						'<div class="nameTime fn12">'+
							'<span id="nicheng">'+obj[i].uuid+'</span>'+
							'<span id="time">'+
								'中奖时间：<i class="prizeTime">'+obj[i].datetime+'</i>'+
							'</span>'+
						'</div>'+
						'<div class="namePrize fn12">'+
							'<div class="prizeTxt">'+a+'</div>'+
							'<img src="'+obj[i].image+'" alt="" />'+
						'</div>'+
					'</div>'+
			'</div>'
		);
	}
}

$(".downLoadApp").click(function(){
	localStorage.setItem("num",2);
	window.location="downloadApp.html";
});

$(".returnPage").click(function(){
	window.location="redPacket.html";
})

/***判断用户是否抽过奖****/

function is_prize(obj){
	var user=localStorage.getItem("uuid");
	for(var i=0;i<obj.length;i++){
		if(user==obj[i].uuid){
			$(".prizeButton").css("background","#82BAFF");
			$("#i_con").addClass("disabled");
			$(".mask").show();
			if((obj[i].id==0001)||(obj[i].id==0002)){
				$(".prize_txt").attr("src","../img/prizeSandengjiang.png");
			}else if((obj[i].id==0003)||(obj[i].id==0004)||(obj[i].id==0005)){
				$(".prize_txt").attr("src","../img/prizeErdengjiang.png");
			}else{
				$(".prize_txt").attr("src","../img/prizeYidengjiang.png");
			}
			$.post(
				'../../../App/Extra/game/getResult',
				{"uuid":localStorage.getItem("uuid")},
				function(data){ 
					var da=eval("("+data+")");
					$(".prize_img").attr("src",da.result.image);
				}
			);
			break;
		}
	}
}

/****分享按钮点击操作***********/
$(".shareBtn").click(function(){
	$(".shareMask").show();
});
$(".shareMask").click(function(){
	$(this).hide();
})