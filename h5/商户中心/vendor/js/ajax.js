/****获取验证码*******/

function getVcCode(phoneNum,objPhone,objTipTxt){ //phoneNum:手机号，objPhone:手机号dom对象,objTipTxt:提示框dom
	
	if(phoneCheck(objPhone,objTipTxt)){
		$.post(
			'../../Sms/SendWebMsg.php',
			{
				"phone":phoneNum,
				"token":"from_web_server"
			},
			function(data){
				var dataCode=eval("("+data+")");
				localStorage.setItem("vc",dataCode[0]);
			}
		);
	}
}


/*****倒计时****/
function clock(obj){
	obj.addClass("disabled");
	var num=60;
	var iTimer=setInterval(function(){
		if(num>1){
			num--;
			obj.html(num+"s重新获取");
		}else{
			obj.html("重新获取");
			obj.removeClass("disabled");
			window.clearInterval(iTimer);
		}	
	},1000)
}


