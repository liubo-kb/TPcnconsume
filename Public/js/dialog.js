function del(msg,account){
        Dialog.confirm(msg,function(){ 
				window.location.href="../admin/del?account="+account;
			
	});
}

function delCommodity(msg,code){
        Dialog.confirm(msg,function(){
                                window.location.href="del?code="+code;

        });
}

