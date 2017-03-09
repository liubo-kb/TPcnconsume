function config( para )
{
	var paras = eval(para);
	var account = paras.account;
	var type = paras.type;
	var upload_id = "#"+paras.upload_id;
	var img_id = "#"+paras.img_id;
	var bar_id = paras.bar_id;
	var check_id = "#"+paras.check_id;	
	
	//alert('1');
		
	$(upload_id).uploadify({
		
		'width': 80,

		'height': 20,

		'buttonText':'本地上传',

		'auto': true,

		'fileTypeExts'  : '*.jpg;*.jpge;*.gif;*.png',

		'fileSizeLimit' : '2MB',

		 //swf的地址
       	 	'swf'      : '../../Public/swf/uploadify.swf',

		//后台处理接口
                'uploader' : '../upload/upload',

		//传输数据的方式
                'method'   : 'post',

		//上传时携带的数据
                'formData' : { 'name' : account , 'type' : type},
		
		//设置进度条位置
		'queueID' : bar_id,
		
		//设置忽略事件
		'overrideEvents': ['onSelectError','onDialogClose'],

		//设置文件异常
		'onSelectError' : function(file, errorCode, errorMsg)
		{
                	switch(errorCode) 
			{
                    		case -110:
                        		alert("文件大小超出系统限制");
                        		break;
                    		case -120:
                        		alert("文件大小异常！");
                        		break;
                    		case -130:
                        		alert("文件类型不正确！");
                        		break;	
                	}
            	},

		//上传成功
                'onUploadSuccess' : function(file, data, response)
                {
			$("#"+bar_id).html('');
                	$(check_id).val('uploads/1.jpg');	
                	$(img_id).attr('src','http://101.201.100.191/cnconsum/Public/Uploads/'+type+'Image/'+account+'.png?'+Math.random());
                },

        });
}
