function createXmlHttp() 
{  
    var xmlHttp = null;  
   
    try 
	{     //Firefox, Opera 8.0+, Safari  
        xmlHttp = new XMLHttpRequest();  
    }
	
	catch (e) 
	{  
        //IE  
        try {  
            	xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");  
        	}
			
		catch (e)
		{  
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");  
        }  
    }
	
    return xmlHttp;  
}  
   
function submitForm() 
{  
    var xmlHttp = createXmlHttp();
	
    if(!xmlHttp)
	{  
        alert("您的浏览器不支持AJAX！");  
        return 0;  
    }  
	
	
    var url = 'resource_updated.php';  

    var software = "";  
	var cpu = "";  
	var memory = "";  
	var nc = "";
	var gpu = "";  
	var mic = "";  
	var machine = "";  

	software = "software=" + document.getElementById('software').value; 
	cpu = "&cpu=" + document.getElementById('cpu').value;  
	memory = "&memory=" + document.getElementById('memory').value;  
	nc = "&nc=" + document.getElementById('nc').value;
	gpu = "&gpu=" + document.getElementById('gpu').value;
	mic = "&mic=" + document.getElementById('mic').value;
	machine = "&machine=" + document.getElementById('machine').value;
	
    xmlHttp.open("POST", url, true);  
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
    xmlHttp.onreadystatechange = function() 
	{  
	if(xmlHttp.readyState == 4 && xmlHttp.status == 200) 
		{  
			if(xmlHttp.responseText == '1')
			{
				alert("更新成功！");
			}
			else
			{
				alert('更新失败:'+xmlHttp.responseText);
			}
        }  
    }
	
	var sign = "&sign="+document.getElementById('sign').value;
   	xmlHttp.send(software+cpu+nc+memory+gpu+mic+machine+sign);
}  
