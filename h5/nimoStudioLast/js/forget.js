/***判断屏幕代码***/
/* function browserRedirect() {
     var sUserAgent = navigator.userAgent.toLowerCase();
     var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
     var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
     var bIsMidp = sUserAgent.match(/midp/i) == "midp";
     var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
     var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
     var bIsAndroid = sUserAgent.match(/android/i) == "android";
     var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
     var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
     document.writeln("您的浏览设备为：");
     if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) {
         alert("phone");
     } else {
        alert("pc");
     }
 }

 browserRedirect();*/

$('.returnPage').click(function() {
	window.location="login.html";

});

function lono() {
	window.location = "login.html";
}

$("#rulePage").click(function() {
	$('.ruleMask').show();
});

$('.zhuceRuleSureBtn').click(function() {
	$('.ruleMask').hide();
});


/***密码重置按钮****/
function reSetPassword(){
	var phoneNum=$("#phone").val();
	var userPassword=$("#passwd_set").val();
	if(checkVerificationCode()&&checkPassword()){
		$.post(
			'../../../App/Extra/game/resetPasswd',
			{
				"phone":phoneNum,
				"new_passwd":userPassword
			},
			function(data){
				var result=eval("("+data+")");
				if((result.result_code==1)||(result.result_code==-1)){
					alert("修改成功，去登录！")
					window.location="login.html";
				}else{
					alert("修改失败！")
				}
			}
		);
	}
}

function lo(){
	window.location="login.html";
}
