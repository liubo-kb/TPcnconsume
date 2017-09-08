/*****手机号码验证*****/
function phoneCheck(phone,tipTxt){//手机号码dom对象，提示框dom对象
    if(!(/^1(3|4|5|7|8)\d{9}$/.test(phone.val()))){
    	tipTxt.html("手机号码格式有误");
    	tipTxt.show();
        return false; 
    }else{
    	tipTxt.hide();
    	return true;
    }
}

/******密码验证******/
function passwordCheck(password,tipTxt){//密码dom对象，提示框dom对象
    if(password.val().length<6){
    	tipTxt.html("请输入6~16位有效字符");
    	tipTxt.show();
        return false; 
    }else{
    	tipTxt.hide();
    	return true;
    }
}

/******验证码验证******/
function vCCheck(VC,tipTxt){//密码dom对象，提示框dom对象
	var vcCode=localStorage.getItem("vc");
    if(VC.val()!=vcCode){
    	tipTxt.html("验证码错误");
    	tipTxt.show();
        return false; 
    }else{
    	tipTxt.hide();
    	return true;
    }
}
/*****登录验证***/
$("#phone").blur(function(){
	phoneCheck($("#phone"),$("#l_phone_tip"));
});
$("#pas").blur(function(){
	passwordCheck($("#pas"),$("#l_psa_tip"));
});

$(".login_a").click(function(){
	if(phoneCheck($("#phone"),$("#l_phone_tip"))&&passwordCheck($("#pas"),$("#l_psa_tip"))){
		alert(1);
	}else{
		alert(2)
	}
})

/***注册验证***********/
$("#r_phone").blur(function(){
	phoneCheck($("#r_phone"),$("#r_phone_tip"));
});
$("#r_pas").blur(function(){
	passwordCheck($("#r_pas"),$("#r_psa_tip"));
});

$("#verificationCode").blur(function(){
	vCCheck($("#verificationCode"),$(".registBox .VC_errMeg"));
});
$(".regist_a").click(function(){
	if(phoneCheck($("#r_phone"),$("#r_phone_tip"))&&passwordCheck($("#r_pas"),$("#r_psa_tip"))&&vCCheck($("#verificationCode"),$(".VC_errMeg"))){
		alert(1);
	}else{
		alert(2)
	}
})

/***重置密码验证验证***********/
$("#f_phone").blur(function(){
	phoneCheck($("#f_phone"),$("#f_phone_tip"));
});
$("#f_pas").blur(function(){
	passwordCheck($("#f_pas"),$("#f_psa_tip"));
});

$("#f_verificationCode").blur(function(){
	vCCheck($("#f_verificationCode"),$(".forgotPasswordBox .VC_errMeg"));
});
$(".forgotPassword_a").click(function(){
	if(phoneCheck($("#f_phone"),$("#f_phone_tip"))&&passwordCheck($("#f_pas"),$("#f_psa_tip"))&&vCCheck($("#f_verificationCode"),$(".VC_errMeg"))){
		alert(1);
	}else{
		alert(2)
	}
})


$(".getVerificationCode").click(function(){
	var s=$("#r_phone").val();
	var $this=$(this);
	getVcCode(s,$("#r_phone"),$("#r_phone_tip"),$this);
	if(phoneCheck($("#r_phone"),$("#r_phone_tip"))){
		clock($this)
	}
})
$(".f_getVerificationCode").click(function(){
	var s=$("#f_phone").val();
	var $this=$(this);
	getVcCode(s,$("#f_phone"),$("#f_phone_tip"),$this)
	if(phoneCheck($("#f_phone"),$("#f_phone_tip"))){		
		clock($this)
	}
})