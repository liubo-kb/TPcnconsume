// JavaScript Document
function login() 
{
	var us = $("#username").val();
        var ps = $("#password").val();
	var ca = $("#captcha").val();
	var msg_alet = document.getElementById("msg_alet");

	if (us == "") 
	{
		$("#msg_alet").html("请输入用户"); 
		msg_alet.style.display = 'block';
	}
	else if(ps == "")
	{
		$("#msg_alet").html("请输入密码"); 
		msg_alet.style.display = 'block';
	}
	else if(ca == "")
	{
		$("#msg_alet").html("请输入验证码"); 
		msg_alet.style.display = 'block';
	}
	else
	{
		msg_alet.style.display = 'none';						 
	}
}
		      
$(function(){
            <!--调用Luara示例-->
            $(".example2").luara({width:"1400",height:"465",interval:3500,selected:"seleted",deriction:"left"});
});
