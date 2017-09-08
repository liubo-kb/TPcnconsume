if(typeof FileReader == 'undefined'){  
		    document.getElementById("result").InnerHTML="<p>你的浏览器不支持FileReader接口！</p>";  
		    //使选择控件不可操作  
		    //file.setAttribute("disabled","disabled");  
		} 
		var oImg=document.getElementById("choose");
		oImg.onchange=function(){
			var file=this.files[0];
			console.log(file.size)
			if(file.size>(1024*100)){
				alert("图片大小不能超过100块k");
			}else{
				 var reader = new FileReader();  
		    	//将文件以Data URL形式读入页面 
		    
		   		reader.readAsDataURL(file);
		    	reader.onload=function(e){  
			        var result=document.getElementById("result");  
			        //显示文件  
			        result.innerHTML=this.result;  
			        var str=this.result;
			        var s=str.split(",")[1];
			        var text = window.atob(s);
					/*var buffer = new Uint8Array(text.length);
					console.log(buffer)
					var pecent = 0,
						loop = null;
					for(var i = 0; i < text.length; i++) {
						buffer[i] = text.charCodeAt(i);
					}
					var blob = getBlob([buffer], type);
					console.log(blob)*/
			        var timestamp=new Date().getTime();
			        $.post(
			        	"../../App/Extra/upload/upload",
			        	{
			        		"type":"head_image",
			        		"name":"u_b721513291_"+timestamp,
			        		"file1":text
			        	},
			        	function(data){
			        		console.log(data);
			        	}
			        )
		    	}  
			}
			
		}