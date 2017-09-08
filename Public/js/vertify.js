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

function clock(btn)
{
	
	document.getElementById(btn).value="( "+c+"S )"
	c=c-1
	if(parseInt(c) < 0)
	{
		document.getElementById(btn).value="重新获取";
		document.getElementById(btn).disabled=false;
		document.getElementById(btn).style.background="#b4b4b4"
	}
	else
	{
		t=setTimeout("clock('btn')",1000)
	}
	
	
}

function vertify(btn)
{
	//alert("1");
	//alert("当前验证码:"+getCookie('vertifyCode'));
	var phon = document.getElementById('phone').value;
	var url = 'http://www.cnconsum.com/smsVertify/Demo/sendMSG.php';	
	
	$.post( url,{phone:phon},function(data,status){
		var obj = eval(data);
		setCookie('vertifyCode',obj[0],1);
		//alert("本次验证码:"+obj[0]);
		c=60
		document.getElementById(btn).disabled=true
		document.getElementById(btn).style.background="#e26666"
		document.getElementById(btn).style.color="#fff"
		clock(btn);
	});
	
}
