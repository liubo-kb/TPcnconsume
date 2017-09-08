// JavaScript Document
   function login() 
   {
	var us = $("#username").val();
        var ps = $("#password").val();
	var ca = $("#captcha").val();
	var msg_alet = document.getElementById("msg_alet");
	if (us == "") 
	{
		$("#msg_alet").html("请输入用户名"); 
		msg_alet.style.display = 'block';
		return false;
	}
	else if(ps == "")
	{
		$("#msg_alet").html("请输入密码"); 
		msg_alet.style.display = 'block';
		return false;
	}
	else if(ca == "")
	{
		$("#msg_alet").html("请输入验证码"); 
		msg_alet.style.display = 'block';
		return false;
	}
	else
	{
		msg_alet.style.display = 'none';
		var url = 'login';
		var subdata = {phone:us,passwd:ps};
		var ret = ajaxcheck(url,subdata);
		if(ret.status ==  0 )
		{
			$("#msg_alet").html(ret.tip);
			msg_alet.style.display = 'block';
			return false;
		}
		else
		{
				//alert('wrong');
				window.location.href = ret.url;
		}
								 
	}
}

$(function()
{
            <!--调用Luara示例-->
            $(".example2").luara({width:"1400",height:"465",interval:3500,selected:"seleted",deriction:"left"});
});
