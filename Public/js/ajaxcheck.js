function ajaxcheck(url, data){
	var retstr = '';
	$.ajax({    
		type: "post",
		async: false,
		url: url,
		data: data,
		contentType : "application/x-www-form-urlencoded; charset=utf-8",
		success: function(msg){
			if(msg !== null || msg !== undefined){
				retstr = JSON.parse(msg);
			}
		}
	});
	return retstr;
}
function formcheck(url, subdata, formid, other){
	var ret = ajaxcheck(url,subdata);
	if(ret.status != 1){
		Dialog.alert(ret.tip);
	}else{
		Dialog.alert(ret.tip);
		if(ret.url != '#'){
			window.location.href = ret.url;
		}else if(formid != ''){
			$('#'+formid)[0].reset();
		}else{
			
		}
	}
}
