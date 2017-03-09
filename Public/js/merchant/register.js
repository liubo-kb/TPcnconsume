	
	var c=60
	var t
	
	function getCookie(c_name)
	{
		if (document.cookie.length>0)
  		{
  			c_start=document.cookie.indexOf(c_name + "=")
  			if (c_start!=-1)
    		{ 
    			c_start=c_start + c_name.length+1 
    			c_end=document.cookie.indexOf(";",c_start)
    			if (c_end==-1) c_end=document.cookie.length
    			return unescape(document.cookie.substring(c_start,c_end))
    		} 
  		}
	return ""
	}

	function setCookie(c_name,value,expiredays)
	{
		var exdate=new Date()
		exdate.setDate(exdate.getDate()+expiredays)
		document.cookie=c_name+ "=" +escape(value)+
		((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
	}


	function checkCookie()
	{
		username=getCookie('username')
		if (username!=null && username!="")
  		{
			alert('Welcome again '+username+'!')
		}
		else 
  		{
  			username=prompt('Please enter your name:',"")
  			if (username!=null && username!="")
    		{
    			setCookie('username',username,365)
    		}
  		}
	}
	
	function replaceNotNumber(hehe)
	{
  		var pattern = /[^0-9]/g;
  		if(pattern.test(hehe.value))
  		{
    		hehe.value = hehe.value.replace(pattern,"");
  		}
	}
	
	function replaceWith(hehe)
	{
  		var pattern = /[^0-9a-zA-Z]/g ;
  		if(pattern.test(hehe.value))
  		{
    		hehe.value = hehe.value.replace(pattern,"");
  		}
		
	}
	
	function createXmlHttp()
	{
		var xmlHttp = null;
		try
		{
			xmlHttp = new XMLHttpRequest();
		}
		catch(e)
		{
			try
			{
				xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e)
			{
				xmlHttp = new ActiveXobject("Microsoft.XMLHTTP");
			}
		}
		
		return xmlHttp;
	 }
	
	
	

	function register(tt,referrer)
	{
		var phone = document.getElementById('phone').value;
		var passwd_set = document.getElementById('passwd_set').value;
		var passwd = document.getElementById('passwd_conf').value;
		var vertcode = document.getElementById('vertcode').value;
		if(phone == '111')
		{
			window.location.href='download.html';
		}
		if(phone == '请输入您的手机号')
		{
			alert("请输入手机号！");
		}
		else if(vertcode == '请输入您的验证码')
		{
			alert("请输入验证码！");
		}
		else if(vertcode != getCookie('vertifyCode'))
		{
			alert("验证码有误！");
		}
		else if(passwd_set == '请输入密码(六位以上字母数字组合)')
		{
			alert("请输入密码！");
		}
		else if(passwd == '请确认密码(六位以上字母数字组合)')
		{
			alert("请确认密码！");
		}
		
		else if(passwd_set != passwd)
		{
			alert("两次密码输入不一致！")
		}
		else
		{
			window.location.href="register?type=" +tt+ "&phone=" +phone+ "&passwd=" +passwd+ "&referrer=" +referrer;
		}
		
	}
	
	function vertify()
	{
		//alert("1");
		//alert("当前验证码:"+getCookie('vertifyCode'));
		
		var phone = document.getElementById('phone').value;
		
		var url = 'http://www.cnconsum.com/smsVertify/Demo/sendMSG.php';	
		
		/*$.post( url,{phone:phon},function(data,status){
			//var obj = eval(data);
			alert(data);
		});*/
		
		var postParas = 'phone=' + phone;
		//alert(postParas);
		var xmlHttp = createXmlHttp();
		if(!xmlHttp)
		{
			alert("您的浏览器不支持AJAX!");
			return;
		}
		
		//tipsWindown("1","text:lb","250","150","true","","true","msg");
		
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
		xmlHttp.onreadystatechange = function()
		{
			if(xmlHttp.readyState ==4 && xmlHttp.status == 200)
			{
				//alert(xmlHttp.responseText);
				var obj = eval(xmlHttp.responseText);
				setCookie('vertifyCode',obj[0],1);
				//alert("本次验证码:"+obj[0]);
				c=60
				document.getElementById('button_vertify').disabled=true;
				document.getElementById('button_vertify').style.background="#cdcdcd";
				document.getElementById('button_vertify').style.border="#cecece solid 3px";
				clock();
				
				
			}
		};
		
		xmlHttp.send(postParas);
		
	}
	
	
	function clock()
	{
		
		document.getElementById('button_vertify').value="( "+c+"S )"
		c=c-1
		if(parseInt(c) < 0)
		{
			document.getElementById('button_vertify').value="重新获取";
			document.getElementById('button_vertify').style.background="#939393"
			document.getElementById('button_vertify').style.border="#929292 solid 3px";
			document.getElementById('button_vertify').disabled=false
		}
		else
		{
 			t=setTimeout("clock()",1000)
		}
		
		
	}
	// JavaScript Document
