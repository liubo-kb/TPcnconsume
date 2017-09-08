 
 var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        spaceBetween: 30,
        effect: 'fade',
        autoplay:3000,
        loop:true,
        observer:true,
        observeParents:true,
        autoplayDisableOnInteraction : false
    });
//console.log($('body').width())
$(".login").click(function(){
	
	$(".loginMask").show();
	console.log($("body").width())
	var nowDivceHeight=$(window).height();
	$(".loginMask").height(nowDivceHeight);
	$(".loginMask").css("top",$(document).scrollTop())
	$(".loginMask").css("left",$(document).scrollLeft())
	$('body').css({ 
         
         "overflow-y":"hidden"     
   });
});


$(".loginBox").click(function(){
	return false
})

$(".regist").click(function(){
	var oR=$(".registMask");
	oR.show();
	var nowDivceHeight=$(window).height();
	oR.height(nowDivceHeight);
	oR.css("top",$(document).scrollTop())
	oR.css("left",$(document).scrollLeft())
	$('body').css({ 
         
         "overflow-y":"hidden"     
   });
});


$(".registBox").click(function(e){
	 e.stopPropagation();
})

function closeMask(str){
	if(str==1){
		$(".loginMask").hide();
	}else if(str==2){
		$(".registMask").hide();
	}else{
		$(".forgotPasswordMask").hide();
	}
	$('body').css({"overflow-y":"auto"});
}

/******头部登录注册按钮hover事件***/
$('.login').hover(
	function(){
		var iTop=$(document).scrollTop();
		if(iTop==0){
			$(this).css({
				"background":"#fff",
				"color":"#333"
			})
		}else{
			$(this).css({
				"background":"#2c3e50",
				"color":"#fff"
			})
		}
	},
	function(){
		var iTop=$(document).scrollTop();
		if(iTop==0){
			$(this).css({
				"background":"",
				"color":"#fff"
			})
		}else{
			$(this).css({
				"background":"",
				"color":"#333"
			})
		}
	}
)
$('.regist').hover(
	function(){
		var iTop=$(document).scrollTop();
		if(iTop==0){
			$(this).css({
				"background":"#fff",
				"color":"#333"
			})
		}else{
			$(this).css({
				"background":"#2c3e50",
				"color":"#fff"
			})
		}
	},
	function(){
		var iTop=$(document).scrollTop();
		if(iTop==0){
			$(this).css({
				"background":"",
				"color":"#fff"
			})
		}else{
			$(this).css({
				"background":"",
				"color":"#333"
			})
		}
	}
)

/****页面滚动事件****/
window.onscroll=function(){
	var iTop=$(document).scrollTop();
	var iLeft=$(document).scrollLeft();
	console.log(iLeft)
	if(iTop>0){
		$(".header").css("background","rgba(255,255,255,0.8)");
		$(".login").css({"border-color":"#333","color":"#333"});
		$(".regist").css({"border-color":"#333","color":"#333"});
	}else{
		$(".header").css("background","rgba(255,255,255,0)");
		$(".login").css({"border-color":"#fff","color":"#fff"});
		$(".regist").css({"border-color":"#fff","color":"#fff"});
	}
	$(".header").css('left',-iLeft);
}

/****忘记密码弹窗弹出*********/
$('.foMM p').click(function(){
	var oF=$(".forgotPasswordMask");
	var oL=$(".loginMask");
	oL.hide();
	oF.show();
	var nowDivceHeight=$(window).height();
	oF.height(nowDivceHeight);
	oF.css("top",$(document).scrollTop())
	oF.css("left",$(document).scrollLeft())
	$('body').css({ 
         
         "overflow-y":"hidden"     
   });
})


/***页面尺寸改变重新定位头部***/
window.onresize=function(){
	var iLeft=$(document).scrollLeft();
	$(".header").css('left',-iLeft);
}

/****立即注册****/
$(".fastRegist").click(function(){
	var nowDivceHeight=$(window).height();
	$(".loginMask").hide();
	$(".registMask").show();
	$(".registMask").height(nowDivceHeight);
})

/****立即登录*****/
$(".fastLogin").click(function(){
	var nowDivceHeight=$(window).height();
	$(".registMask").hide();
	$(".loginMask").show();
	$(".loginMask").height(nowDivceHeight);
})

/***又想起来了***/
$(".f_f").click(function(){
	var nowDivceHeight=$(window).height();
	$(".forgotPasswordMask").hide();
	$(".loginMask").show();
	$(".loginMask").height(nowDivceHeight);
})
/****立即注册****/
$(".forgotPasswordMask .fastRegist").click(function(){
	var nowDivceHeight=$(window).height();
	$(".forgotPasswordMask").hide();
	$(".registMask").show();
	$(".registMask").height(nowDivceHeight);
})