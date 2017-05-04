/*function removeRow(r)
{
	var root = r.parentNode;
	var allRows = root.getElementsByTagName('tr')
	for( i=1;i<allRows.length;i++) {
		root.removeChild(r);
	}
}*/
var item=localStorage.getItem('getTab.rows.length');
	console.log(item);
function removeRow(r)
{
	var root = r.parentNode;
//	var kk = r.cells[0].childNodes[0];
	var states = r.cells[0].childNodes[0].checked
	//console.log(r.cells[0].childNodes[0]);
	if(states == true){
		root.removeChild(r);
	}else{
		alert("未选中");
	}
}

$(function(){
	
	
	
	
	$('#modaltrigger').click(function(e){
		return false;
	});/**
    $("#surebtn").click(function(){
		alert("添加成功");
	});**/
	$("#backbtn").click(function(){
		$('#loginmodal').hide();
		$("#lean_overlay").css('display','none');
	});
	$('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: ".hidemodal" });
	
	$('form').submit(function(){
		addTr();
		$('#loginmodal').hide();
		$("#lean_overlay").css('display','none');
		
		$.ajax({
		    type:"post",
		    url:"xxx.php",      // 这里是提交到什么地方的url
		    data:{},            // 这里把表单里面的数据放在这里传到后台
		    dataType:"json",
		    success:function(res){
		        // 调用回调函数
		    }
		});
		
		
		
	})
	
});

function getdate(){
	var newDate = new Date();
	var year = newDate.getFullYear();
	var month = newDate.getMonth()+1;
		if(month<10){
			month = '0' + month;
		}
	var date = newDate.getDate();
	    if(date < 10){
	    	date = '0' + date;
	    }
	    
	return year+'/'+month+'/'+date;   
}








function addTr(){
	var getTab=document.getElementById('tab');
	var getTbody=getTab.childNodes[1];
	console.log(getTbody);
	var createTr = document.createElement('tr');
	console.log(createTr);
	var useName = document.getElementById('user');
	var passWord = document.getElementById('password');
	
			if(useName.value && passWord.value){
		 createTr.innerHTML = '<td><input type="checkbox" style="margin-top: 10px;"/></td>'+
					    '<td>'+getTab.rows.length+'</td>'+
					    '<td>'+useName.value+'</td>'+
					    '<td>'+passWord.value+'</td>'+
					    '<td>'+getdate()+'</td>'+
					    '<td>高存</td>'+
					    '<td><a onclick="removeRow(this.parentNode.parentNode)" class="abtn_01 abtn-nbd abtn-org_01">删除</a></td>'
	getTbody.appendChild(createTr);				   
	getTab.appendChild(getTbody);
	localStorage.setItem(getTab.rows.length,'Administration.html');
	
	}else{
		alert('亲，请重新输入！')
	}
	
}
