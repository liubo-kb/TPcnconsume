 var swiper = new Swiper('.swiper-container', {
	pagination: '.swiper-pagination',
	paginationClickable: true
});


getGamePoss();
/***根据答题情况判断关卡显示情况***/
function judgeLoc() {
	var n = Number(localStorage.getItem('flag'));
	var aLi=$(".swiper-slide li");
	for(var i=0;i<5;i++){
		//console.log(aLi[i].getAttribute("a"))
		if(n>(aLi[i].getAttribute("a")-10)){
			aLi[i].style.backgroundImage="url(../img/"+i+".png)";
			aLi[i].setAttribute("btn","true");
		}
	}
}

/***获取当前游戏数据***/
function getGamePoss() {
	var uuid = localStorage.getItem('uuid');
	$.post(
		'../../../App/Extra/game/start', {
			"uuid": uuid
		},
		function(data) {
			var result = eval("(" + data + ")");
			var num = result.current_num;
			localStorage.setItem("flag", Number(num) + 1);
			console.log(result);
			judgeLoc();
		}
	);
}


/***返回首页****/
$("#returnIndex").click(function(){
	window.location="../index.html";
})




$(".swiper-slide li").click(function(){
	var $index=$(this).attr("btn");
	var num=$(".swiper-slide li").index(this);
	var n = Number(localStorage.getItem('flag'));
	if($index){
		window.location="guess.php";
	}else{
		if(num<5){
			$(".wkq").show();
		}else{
			$(".wjs").show();
		}
		
	}
})


$(".wkq_sure").click(function(){
	$(".wkq").hide();
})

$(".wjs_sure").click(function(){
	$(".wjs").hide();
})
