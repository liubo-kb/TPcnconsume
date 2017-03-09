window.onload = function(){
 var bodyh = document.documentElement.clientHeight;
 var top = document.getElementById("top");
 var bottom = document.getElementById("bottom");
 var height = bodyh/2-8;
 top.style.height= height+'px';
 bottom.style.height= height+'px';
	}
//风控后台登录AJAX异步验证
function login(){
	if(check()){
		 LoginSuccess();
		}
}
function check(){
	var us =$("#user").val();
	var pa =$("#password").val();
	var msg_alet_user = document.getElementById("msg_alet_user");
	var msg_alet_pass = document.getElementById("msg_alet_pass");
	if(us == "")
		{
			$("#msg_alet_user").html("请输入用户名");
            msg_alet_pass.style.display='none';
			msg_alet_user.style.display='block';
			return false;
		}
		else if(pa == "")
		{
			$("#msg_alet_pass").html("请输入密码");
			msg_alet_user.style.display='none';
			msg_alet_pass.style.display='block';
			return false;
		}else{
			msg_alet_user.style.display = 'none';
			msg_alet_pass.style.display = 'none';
			return true;       
	}
}

function LoginSuccess(){
    var retstr;
    $.ajax({
            type:"POST",
            url:"enter",
            data:{account:$("#user").val(),passwd:$("#password").val()},
            contentType : "application/x-www-form-urlencoded; charset=utf-8",         
            success:function(msg)
	    {
            	if(msg !== null || msg !== undefined)
	    	{
		    switch(msg)
		    {
			case 'not_found':
			{
				$("#msg_alet_user").html("账户不存在");
            			msg_alet_pass.style.display='none';
                        	msg_alet_user.style.display='block';
				break;
			}
			case 'passwd_wrong':
			{
				$("#msg_alet_pass").html("密码错误");
                        	msg_alet_user.style.display='none';
                        	msg_alet_pass.style.display='block';
				break;
			}
			case 'access':
			{
				window.location.href = '../main/settle';
				break;
			}
			default:
				break;
		    }
	        }
	    }          
         });
		 return retstr;
    }

