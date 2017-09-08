/***获取验证码***/
var time=60;
//var uuid;//获取用户唯一标识
function getValidationCode(){
	
	if(checkPhoneNum()){
		var phone=Number($('#phone').val());
		$.post(
			'../../../Sms/SendWebMsg.php',
			{
				"phone":phone,
				"token":"from_web_server"
			},
			function(data){
				var dataCode=eval("("+data+")");
				console.log(dataCode);
				localStorage.setItem("dataCode",dataCode[0]);
				time=60; //重置验证码获取时间为一分钟
				$("#button_vertify").addClass("disabled");
				//document.getElementById('button_vertify').style.background="#cdcdcd";
				clock();
			}
		);
	}
}

/*****倒计时****/
function clock(){
		document.getElementById('button_vertify').innerHTML="( "+time+"S )";
		var iTimer=setInterval(function(){
			document.getElementById('button_vertify').innerHTML="( "+time+"S )";
			time=time-1;
			if(time < 0)
			{
				document.getElementById('button_vertify').innerHTML="重新获取";
				//document.getElementById('button_vertify').style.background="#939393"
				$("#button_vertify").removeClass("disabled");
				window.clearInterval(iTimer);
			}
		},1000)
}


/****手机号码验证****/

function checkPhoneNum(){
	var str=$("#phone").val();
	if(str&&/^1\d{10}$/.test(str)){
		return true;
	}else{
		alert("手机号码不能为空或手机号码格式错误！");
		return false;
	}
}


/***验证码输入验证*********/

function checkVerificationCode(){
	var iVerificationCode=localStorage.getItem('dataCode'); //获取存储在本地的验证码
	var iUserInputCode=$("#vertcode").val(); //获取用户输入的验证码
	if(iUserInputCode&&(iVerificationCode==iUserInputCode)){
		return true;
	}else{
		alert("验证码不能为空或输入错误！")
		return false;
	}
}



/****密码验证*****/

function checkPassword(){
	var iPassword=$("#passwd_set").val();
	if(iPassword.length>=6){
		return true;
	}else{
		alert("密码设置不正确！");
		return false;
	}
}


/****注册****/

$('.hehe').click(function(){
	oShare.link="http://www.cnconsum.com/cnconsum/h5/nimoStudioLast/html/guidePage.html?re="+$("#phone").val();
	share(oShare);
	localStorage.setItem("phoneNum",$("#phone").val());
	if(checkVerificationCode()&&checkPassword()){
		regist();
	}
});


/****注册请求****/
function regist(){
	var phoneNum=$("#phone").val();
	var userPassword=$("#passwd_set").val();
	var referrer=getUrl();
	$.post(
		"../../../App/Extra/game/register",
		{
			"phone":phoneNum,
			"passwd":userPassword,
			"referrer":referrer
		},
		function(data){
			var result=eval("("+data+")");
			console.log(result)
			if(result.result_code=="phone_duplicate"){
				if(confirm("该手机号已经注册过,直接登录？")){
					window.location="login.html";
				}
			}else if(result.result_code=="1"){
				$('.registerMask').show();
				localStorage.setItem("uuid",result.uuid)
			}
			
		}
	);
}


/***获取地址栏信息***/
function getUrl(){
	var tjr=location.href;
	if(tjr.indexOf("?")==-1){
		return " ";
	}else{
		var str=tjr.substr(tjr.indexOf("?")+1);
		var num=str.indexOf("=");
		var iph=str.substring(num+1);
		return iph;
	}
}



/***开始游戏按钮***********/

$('.freePrize').click(function(){
	/*var str=$(".freePrize").html();
	if(str=="开始游戏"){*/
		window.location='guess.php';
		//localStorage.setItem("uuid",uuid);
	/*}else{
		window.location="https://itunes.apple.com/cn/app/shang-xiao-le/id1130860710?mt=8";
	}*/
	
});


/****点击按钮分享弹出用户引导图片****/

function guide(){
	var str=$(".useNow").html();
	if(str=="分享"){
		$(".guideShare").show();
		$(".useNow").html("下载APP");
		$(".useNow").css("background","#46acd6");
	}else{
		localStorage.setItem("num",1);
		window.location="../html/downloadApp.html";
	}
}

var oShare={
 			"title":"看图猜成语，赢取大奖",
 			"link":"",
 			"desc":"你是否觉得自己满腹经纶？你是否能通过所有关卡拿到大奖？史上最好玩的猜成语游戏，等你挑战！！！",
 			"imgUrl":"http://101.201.100.191/cnconsum/Public/Uploads/gameImage/question/乐山大佛.png"
 		}
/*****分享***/
